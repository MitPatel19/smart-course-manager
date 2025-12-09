<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Material;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $coursesCount   = Course::count();
            $materialsCount = Material::count();
            $usersCount     = User::count();

            return view('dashboards.admin', compact('coursesCount', 'materialsCount', 'usersCount'));
        }

        if ($user->role === 'instructor') {
            $courses = $user->coursesTeaching()->with('materials')->get();
            return view('dashboards.instructor', compact('courses'));
        }

        // student
        $courses = $user->coursesEnrolled()->with('materials')->get();
        $latestMaterials = Material::whereIn('course_id', $courses->pluck('id'))
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        $notifications = Notification::where('user_id', $user->id)
            ->where('is_read', false)
            ->get();

        return view('dashboards.student', compact('courses', 'latestMaterials', 'notifications'));
    }
}
