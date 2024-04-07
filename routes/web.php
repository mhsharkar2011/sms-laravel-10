<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ClassSubjectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

// Public Route
Route::get('/', [AuthController::class, 'login']);
Route::post('login', [AuthController::class, 'AuthLogin']);
Route::get('forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('forgot-password', [AuthController::class, 'postForgotPassword']);
Route::get('reset/{token}', [AuthController::class, 'resetPassword']);
Route::post('reset/{token}', [AuthController::class, 'postResetPassword']);
Route::get('destroy', [AuthController::class, 'destroy']);

Route::get('parents/profile/{user}', [ProfileController::class, 'parentProfile'])->name('parents.profile');



// Admin Middleware =================================================================
Route::group(['middleware' => 'admin'], function () {
    Route::get('admin/admin-dashboard', [DashboardController::class, 'dashboard']);
    Route::get('admins/students', [StudentController::class, 'index'])->name('students.index');
    Route::get('admins/teachers', [TeacherController::class, 'index'])->name('teachers.index');
    // Admin Route
    Route::get('admins', [AdminController::class, 'index'])->name('admins.index');
    Route::get('admins/create', [AdminController::class, 'create'])->name('admins.create');
    Route::post('admins', [AdminController::class, 'store'])->name('admins.store');
    Route::get('admins/profile/{user}', [AdminController::class, 'show'])->name('admins.show');
    Route::get('admins/profile/edit/{user}', [AdminController::class, 'edit'])->name('admins.edit');
    Route::put('admins/profile/update/{user}', [AdminController::class, 'update'])->name('admins.update');
// User Profile
    Route::get('admins/profile/{user}', [ProfileController::class, 'adminProfile'])->name('admins.profile');
    Route::post('profile/update/{user}', [ProfileController::class, 'Update'])->name('profile.update');

    Route::get('change_password', [ProfileController::class, 'change_password'])->name('change_password');
    Route::post('change_password', [ProfileController::class, 'update_password'])->name('update_password');
    

    Route::get('admins/delete/{user}', [AdminController::class, 'destroy'])->name('admins.destroy');
    // Class Route
    Route::get('classes', [ClassController::class, 'index'])->name('classes.index');
    Route::get('classes/create', [ClassController::class, 'create'])->name('classes.create');
    Route::post('classes', [ClassController::class, 'store'])->name('classes.store');
    Route::get('classes/edit/{class}', [ClassController::class, 'edit'])->name('classes.edit');
    Route::put('classes/update/{class}', [ClassController::class, 'update'])->name('classes.update');
    Route::get('classes/delete/{id}', [ClassController::class, 'destroy'])->name('classes.delete');

    // Subject Route
    Route::get('admins/subjects', [SubjectController::class, 'index'])->name('admins.subjects');
    Route::get('admins/subjects/create', [SubjectController::class, 'create'])->name('admins.subjects.create');
    Route::post('admins/subjects', [SubjectController::class, 'store'])->name('admins.subjects.store');
    Route::get('admins/subjects/edit/{subject}', [SubjectController::class, 'edit'])->name('admins.subjects.edit');
    Route::put('admins/subjects/update/{subject}', [SubjectController::class, 'update'])->name('admins.subjects.update');
    Route::get('admins/subjects/delete/{subject}', [SubjectController::class, 'destroy'])->name('admins.subjects.delete');

    // assign_subjects
    Route::get('assign_subjects', [ClassSubjectController::class, 'index'])->name('assign_subjects.index');
    Route::get('assign_subjects/create', [ClassSubjectController::class, 'create'])->name('assign_subjects.create');
    Route::post('assign_subjects', [ClassSubjectController::class, 'store'])->name('assign_subjects.store');
    Route::get('assign_subjects/show/{assignSubject}', [ClassSubjectController::class, 'show'])->name('assign_subjects.show');
    Route::put('assign_subjects/single_update/{update_single}', [ClassSubjectController::class, 'update_single'])->name('assign_subjects.update_single');
    Route::get('assign_subjects/edit/{assignSubject}', [ClassSubjectController::class, 'edit'])->name('assign_subjects.edit');
    Route::put('assign_subjects/update/{assignSubject}', [ClassSubjectController::class, 'update'])->name('assign_subjects.update');
    Route::get('assign_subjects/delete/{assignSubject}', [ClassSubjectController::class, 'destroy'])->name('assign_subjects.delete');

});

// Teacher Middleware =================================================================
Route::group(['middleware' => 'teacher'], function () {
    Route::get('teacher/teacher-dashboard', [DashboardController::class, 'dashboard']);
    Route::get('teachers', [TeacherController::class, 'index'])->name('teachers.index');

    Route::get('teachers/profile/{user}', [ProfileController::class, 'teacherProfile'])->name('teachers.profile');

});

// Student Middleware =================================================================
Route::group(['middleware' => 'student'], function () {
    Route::get('student/student-dashboard', [DashboardController::class, 'dashboard']);
    // Students Route
    Route::get('students', [StudentController::class, 'index'])->name('students.index');
    Route::get('students/teachers', [TeacherController::class, 'index'])->name('teachers.index');
    Route::get('students/create', [StudentController::class, 'create'])->name('students.create');
    Route::post('students', [StudentController::class, 'store'])->name('students.store');

    Route::get('students/profile/{user}', [ProfileController::class, 'studentProfile'])->name('students.profile');
    Route::get('students/profile/edit/{user}', [StudentController::class, 'edit'])->name('students.edit');
    Route::post('students/profile/update/{user}', [StudentController::class, 'update'])->name('students.update');

    Route::get('students/delete/{user}', [StudentController::class, 'destroy'])->name('students.destroy');

});

// Parent Middleware =================================================================
Route::group(['middleware' => 'parent'], function () {
    Route::get('parents/parent-dashboard', [DashboardController::class, 'dashboard']);
    Route::get('parents', [ParentController::class, 'index'])->name('parents.index');
    Route::get('parents/student', [StudentController::class, 'index'])->name('students.index');
    Route::get('parents/profile/{user}', [ParentController::class, 'show'])->name('parents.show');
    Route::get('parents/profile/edit/{user}', [ParentController::class, 'edit'])->name('parents.edit');
    Route::put('parents/profile/update/{user}', [ParentController::class, 'update'])->name('parents.update');
    Route::get('parents/delete/{user}', [ParentController::class, 'destroy'])->name('parents.destroy');

    Route::get('parents/profile/{user}', [ProfileController::class, 'parentProfile'])->name('parents.profile');

    Route::get('students', [StudentController::class, 'index'])->name('students.index');

});
