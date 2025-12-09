<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\MaterialController;
use Illuminate\Support\Facades\Route;

// Add inside Route::middleware(['auth'])->group(function () { ... });

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('courses', CourseController::class);

Route::get('courses/{course}/materials/create', [MaterialController::class, 'create'])->name('materials.create');
Route::post('courses/{course}/materials', [MaterialController::class, 'store'])->name('materials.store');
Route::get('materials/{material}/download', [MaterialController::class, 'download'])->name('materials.download');
Route::delete('materials/{material}', [MaterialController::class, 'destroy'])->name('materials.destroy');

Route::get('courses/{course}/enrollments', [EnrollmentController::class, 'manage'])->name('enrollments.manage');
Route::post('courses/{course}/enrollments', [EnrollmentController::class, 'update'])->name('enrollments.update');
