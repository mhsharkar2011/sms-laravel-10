<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;

// Public Route
Route::get('/', [AuthController::class, 'login']);
Route::post('login', [AuthController::class, 'AuthLogin']);
Route::get('forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('forgot-password', [AuthController::class, 'postForgotPassword']);
Route::get('reset/{token}', [AuthController::class, 'resetPassword']);
Route::post('reset/{token}', [AuthController::class, 'postResetPassword']);
Route::get('logout', [AuthController::class, 'logout']);



// Admin Middleware =================================================================
Route::group(['middleware' => 'admin'], function () {
    Route::get('admin/admin-dashboard', [DashboardController::class, 'dashboard']);
    // Admin Route
    Route::get('admins', [AdminController::class, 'index'])->name('admins.index');
    Route::get('admins/create', [AdminController::class, 'create'])->name('admins.create');
    Route::post('admins', [AdminController::class, 'store'])->name('admins.store');
    Route::get('admins/profile/{user}', [AdminController::class, 'show'])->name('admins.show');
    Route::get('admins/profile/edit/{user}', [AdminController::class, 'edit'])->name('admins.edit');
    Route::put('admins/profile/update/{user}', [AdminController::class, 'update'])->name('admins.update');
    Route::get('admins/delete/{user}', [AdminController::class, 'destroy'])->name('admins.destroy');
    // Class Route
    Route::get('classes', [ClassController::class, 'index'])->name('classes.index');
    Route::get('classes/create', [ClassController::class, 'create'])->name('classes.create');
    Route::post('classes', [ClassController::class, 'store'])->name('classes.store');
    Route::get('classes/delete/{id}', [ClassController::class, 'destroy'])->name('classes.delete');

    // Subject Route
    Route::get('subjects', [SubjectController::class, 'index'])->name('subject.index');
    Route::get('subjects/create', [SubjectController::class, 'create'])->name('subjects.create');
    Route::post('subjects', [SubjectController::class, 'store'])->name('subjects.store');
    Route::get('subjects/delete/{subject}', [SubjectController::class, 'destroy'])->name('subjects.delete');
});

// Teacher Middleware =================================================================
Route::group(['middleware' => 'teacher'], function () {
    Route::get('teacher/teacher-dashboard', [DashboardController::class, 'dashboard']);
});

// Student Middleware =================================================================
Route::group(['middleware' => 'student'], function () {
    Route::get('student/student-dashboard', [DashboardController::class, 'dashboard']);
    // Students Route
    Route::get('students', [StudentController::class, 'index'])->name('students.index');
    Route::get('students/create', [StudentController::class, 'create'])->name('students.create');
    Route::post('students', [StudentController::class, 'store'])->name('students.store');
    Route::get('students/profile/{user}', [StudentController::class, 'show'])->name('students.show');
    Route::get('students/profile/edit/{user}', [StudentController::class, 'edit'])->name('students.edit');
    Route::put('students/profile/update/{user}', [StudentController::class, 'update'])->name('students.update');
    Route::get('students/delete/{user}', [StudentController::class, 'destroy'])->name('students.destroy');
});

// Parent Middleware =================================================================
Route::group(['middleware' => 'parent'], function () {
    Route::get('parent/parent-dashboard', [DashboardController::class, 'dashboard']);
});
