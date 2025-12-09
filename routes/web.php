<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminProgramController;
use App\Http\Controllers\AdminUserStatusController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // ADMIN: Program & Course Management
Route::middleware('auth')->group(function () {
    Route::middleware([])->group(function () {
        // program CRUD
        Route::get('/admin/programs', [AdminProgramController::class, 'index'])->name('admin.programs.index');
        Route::get('/admin/programs/create', [AdminProgramController::class, 'create'])->name('admin.programs.create');
        Route::post('/admin/programs', [AdminProgramController::class, 'store'])->name('admin.programs.store');
        Route::get('/admin/programs/{program}/edit', [AdminProgramController::class, 'edit'])->name('admin.programs.edit');
        Route::put('/admin/programs/{program}', [AdminProgramController::class, 'update'])->name('admin.programs.update');
        Route::delete('/admin/programs/{program}', [AdminProgramController::class, 'destroy'])->name('admin.programs.destroy');

        // courses under a program
        Route::get('/admin/programs/{program}/courses', [AdminProgramController::class, 'courses'])->name('admin.programs.courses');
        Route::post('/admin/programs/{program}/courses', [AdminProgramController::class, 'storeCourse'])->name('admin.programs.courses.store');
        Route::put('/admin/programs/{program}/courses/{course}', [AdminProgramController::class, 'updateCourse'])->name('admin.programs.courses.update');

        // ADMIN: activate/deactivate users
        Route::get('/admin/user-status', [AdminUserStatusController::class, 'index'])->name('admin.user_status.index');
        Route::post('/admin/user-status/{user}/toggle', [AdminUserStatusController::class, 'toggle'])->name('admin.user_status.toggle');
        Route::get('/admin/user-status/create', [AdminUserStatusController::class, 'create'])->name('admin.user_status.create');
        Route::post('/admin/user-status', [AdminUserStatusController::class, 'store'])->name('admin.user_status.store');

    });
});

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
