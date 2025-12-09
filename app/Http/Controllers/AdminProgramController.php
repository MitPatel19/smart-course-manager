<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminProgramController extends Controller
{
    private function ensureAdmin()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }
    }

    // List all programs
    public function index()
    {
        $this->ensureAdmin();

        $programs = Program::withCount('courses')->get();
        return view('admin.programs.index', compact('programs'));
    }

    public function create()
    {
        $this->ensureAdmin();
        return view('admin.programs.create');
    }

    public function store(Request $request)
    {
        $this->ensureAdmin();

        $data = $request->validate([
            'code' => 'required|unique:programs,code',
            'name' => 'required',
            'description' => 'nullable',
        ]);

        Program::create($data);

        return redirect()->route('admin.programs.index')->with('success', 'Program created.');
    }

    public function edit(Program $program)
    {
        $this->ensureAdmin();
        return view('admin.programs.edit', compact('program'));
    }

    public function update(Request $request, Program $program)
    {
        $this->ensureAdmin();

        $data = $request->validate([
            'code' => 'required|unique:programs,code,' . $program->id,
            'name' => 'required',
            'description' => 'nullable',
        ]);

        $program->update($data);

        return redirect()->route('admin.programs.index')->with('success', 'Program updated.');
    }

    public function destroy(Program $program)
    {
        $this->ensureAdmin();
        $program->delete();

        return redirect()->route('admin.programs.index')->with('success', 'Program deleted.');
    }

    // ==========================
    // Program -> Courses section
    // ==========================
    public function courses(Program $program)
    {
        $this->ensureAdmin();

        $courses = $program->courses()->with('instructor')->get();
        $instructors = User::where('role', 'instructor')->where('is_active', true)->get();

        return view('admin.programs.courses', compact('program', 'courses', 'instructors'));
    }

    public function storeCourse(Request $request, Program $program)
    {
        $this->ensureAdmin();

        $data = $request->validate([
            'course_code'   => 'required',
            'course_name'   => 'required',
            'semester'      => 'required',
            'instructor_id' => 'required|exists:users,id',
            'description'   => 'nullable',
        ]);

        $data['program_id'] = $program->id;

        Course::create($data);

        return redirect()->route('admin.programs.courses', $program)->with('success', 'Course added to program.');
    }

    public function updateCourse(Request $request, Program $program, Course $course)
    {
        $this->ensureAdmin();

        $data = $request->validate([
            'course_code'   => 'required',
            'course_name'   => 'required',
            'semester'      => 'required',
            'instructor_id' => 'required|exists:users,id',
            'is_active'     => 'required|boolean',
            'description'   => 'nullable',
        ]);

        $course->update($data);

        return redirect()->route('admin.programs.courses', $program)->with('success', 'Course updated.');
    }
}