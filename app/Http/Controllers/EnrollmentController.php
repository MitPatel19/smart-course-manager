<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function manage(Course $course)
    {
        $students    = User::where('role', 'student')->get();
        $enrolledIds = $course->students->pluck('id')->toArray();

        return view('enrollments.manage', compact('course', 'students', 'enrolledIds'));
    }

    public function update(Request $request, Course $course)
    {
        $studentIds = $request->input('students', []);
        $course->students()->sync($studentIds);

        return redirect()->route('courses.show', $course)->with('success', 'Enrollments updated.');
    }
}
