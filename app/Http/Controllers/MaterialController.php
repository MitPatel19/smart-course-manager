<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\DownloadLog;
use App\Models\Material;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{
    public function create(Course $course)
    {
        $this->authorizeInstructorOfCourse($course);
        return view('materials.create', compact('course'));
    }

    public function store(Request $request, Course $course)
    {
        $this->authorizeInstructorOfCourse($course);

        $data = $request->validate([
            'title'    => 'required',
            'category' => 'required',
            'file'     => 'required|file',
        ]);

        $file = $request->file('file');
        $path = $file->store('materials', 'public');

        $material = Material::create([
            'course_id'   => $course->id,
            'title'       => $data['title'],
            'file_path'   => $path,
            'file_type'   => $file->getClientOriginalExtension(),
            'category'    => $data['category'],
            'uploaded_by' => Auth::id(),
        ]);

        // notify students
        foreach ($course->students as $student) {
            Notification::create([
                'user_id' => $student->id,
                'message' => "New material '{$material->title}' uploaded in {$course->course_code}.",
            ]);
        }

        return redirect()->route('courses.show', $course)->with('success', 'Material uploaded.');
    }

    public function download(Material $material)
    {
        $user = Auth::user();

        DownloadLog::create([
            'material_id'   => $material->id,
            'user_id'       => $user->id,
            'downloaded_at' => now(),
        ]);

        return Storage::disk('public')->download(
            $material->file_path,
            $material->title . '.' . $material->file_type
        );
    }

    public function destroy(Material $material)
    {
        $course = $material->course;
        $this->authorizeInstructorOfCourse($course);

        Storage::disk('public')->delete($material->file_path);
        $material->delete();

        return redirect()->route('courses.show', $course)->with('success', 'Material deleted.');
    }

    private function authorizeInstructorOfCourse(Course $course)
    {
        $user = Auth::user();

        if (!($user->role === 'instructor' && $course->instructor_id == $user->id) && $user->role !== 'admin') {
            abort(403, 'Unauthorized');
        }
    }
}
