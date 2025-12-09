<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminUserStatusController extends Controller
{
    private function ensureAdmin()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }
    }

    public function index()
    {
        $this->ensureAdmin();

        $instructors = User::where('role', 'instructor')->orderBy('id')->get();
        $students    = User::where('role', 'student')->orderBy('id')->get();

        return view('admin.user_status.index', compact('instructors', 'students'));
    }

    public function toggle(User $user)
    {
        $this->ensureAdmin();

        // prevent admin from deactivating themselves
        if ($user->id === Auth::id()) {
            return redirect()->back()->with('error', 'You cannot change your own status.');
        }

        $user->is_active = !$user->is_active;
        $user->save();

        return redirect()->back()->with('success', 'User status updated.');
    }
}
