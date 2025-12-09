<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'instructor') {
            $courses = $user->coursesTeaching;
        } elseif ($user->role === 'student') {
            $courses = $user->coursesEnrolled;
        } else { // admin
            $courses = Course::with('instructor')->get();
        }

        return view('courses.index', compact('courses', 'user'));
    }

    public function create()
    {
        $this->authorizeAdminOrInstructor();
        $instructors = User::where('role', 'instructor')->get();
        return view('courses.create', compact('instructors'));
    }

    public function store(Request $request)
    {
        $this->authorizeAdminOrInstructor();

        $data = $request->validate([
            'course_code'   => 'required',
            'course_name'   => 'required',
            'semester'      => 'required',
            'instructor_id' => 'required|exists:users,id',
            'description'   => 'nullable',
        ]);

        Course::create($data);

        return redirect()->route('courses.index')->with('success', 'Course created.');
    }

    public function show(Course $course)
    {
        $course->load('materials', 'instructor');
        return view('courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        $this->authorizeAdminOrInstructor();
        $instructors = User::where('role', 'instructor')->get();
        return view('courses.edit', compact('course', 'instructors'));
    }

    public function update(Request $request, Course $course)
    {
        $this->authorizeAdminOrInstructor();

        $data = $request->validate([
            'course_code'   => 'required',
            'course_name'   => 'required',
            'semester'      => 'required',
            'instructor_id' => 'required|exists:users,id',
            'description'   => 'nullable',
        ]);

        $course->update($data);

        return redirect()->route('courses.index')->with('success', 'Course updated.');
    }

    public function destroy(Course $course)
    {
        $this->authorizeAdminOrInstructor();
        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Course deleted.');
    }

    private function authorizeAdminOrInstructor()
    {
        $role = Auth::user()->role;
        if (!in_array($role, ['admin', 'instructor'])) {
            abort(403, 'Unauthorized');
        }
    }
}
