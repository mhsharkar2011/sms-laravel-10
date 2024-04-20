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

Route::get('change_password', [ProfileController::class, 'change_password'])->name('change_password');
Route::post('change_password', [ProfileController::class, 'update_password'])->name('update_password');



// Admin Middleware =================================================================
Route::group(['middleware' => 'admin'], function () {
    Route::get('admin/admin-dashboard', [DashboardController::class, 'dashboard']);
    Route::get('admins/teachers', [TeacherController::class, 'index'])->name('teachers.index');
    Route::get('admins/students', [StudentController::class, 'index'])->name('students.index');
    Route::get('admins/parents', [ParentController::class, 'index'])->name('parents.index');
    // Admin Route
    Route::get('admins/list', [AdminController::class, 'index'])->name('admins.index');
    Route::get('admins/create', [AdminController::class, 'create'])->name('admins.create');
    Route::post('admins/store', [AdminController::class, 'store'])->name('admins.store');

    Route::get('admins/profile/show/{user}', [ProfileController::class, 'adminProfile'])->name('admins.profile.show');
    Route::get('profile/edit/{user}', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile/update/{user}', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('admins/delete/{user}', [AdminController::class, 'destroy'])->name('admins.destroy');
    Route::get('admins/restore/{user}', [AdminController::class, 'restore'])->name('admins.restore');
    
    // Class Route
    Route::get('admins/classes', [ClassController::class, 'index'])->name('admins.classes.index');
    Route::get('admins/classes/create', [ClassController::class, 'create'])->name('admins.classes.create');
    Route::post('admins/classes', [ClassController::class, 'store'])->name('admins.classes.store');
    Route::get('admins/classes/edit/{class}', [ClassController::class, 'edit'])->name('admins.classes.edit');
    Route::put('admins/classes/update/{class}', [ClassController::class, 'update'])->name('admins.classes.update');
    Route::get('admins/classes/delete/{id}', [ClassController::class, 'destroy'])->name('admins.classes.delete');

    // Subject Route
    Route::get('admins/subjects', [SubjectController::class, 'index'])->name('admins.subjects');
    Route::get('admins/subjects/create', [SubjectController::class, 'create'])->name('admins.subjects.create');
    Route::post('admins/subjects', [SubjectController::class, 'store'])->name('admins.subjects.store');
    Route::get('admins/subjects/edit/{subject}', [SubjectController::class, 'edit'])->name('admins.subjects.edit');
    Route::put('admins/subjects/update/{subject}', [SubjectController::class, 'update'])->name('admins.subjects.update');
    Route::get('admins/subjects/delete/{subject}', [SubjectController::class, 'destroy'])->name('admins.subjects.delete');

    // assign_subjects
    Route::get('admins/assign_subjects', [ClassSubjectController::class, 'index'])->name('assign_subjects.index');
    Route::get('admins/assign_subjects/create', [ClassSubjectController::class, 'create'])->name('assign_subjects.create');
    Route::post('admins/assign_subjects/store', [ClassSubjectController::class, 'store'])->name('assign_subjects.store');
    Route::get('admins/assign_subjects/show/{assignSubject}', [ClassSubjectController::class, 'show'])->name('assign_subjects.show');
    Route::put('admins/assign_subjects/single_update/{update_single}', [ClassSubjectController::class, 'update_single'])->name('assign_subjects.update_single');
    Route::get('admins/assign_subjects/edit/{assignSubject}', [ClassSubjectController::class, 'edit'])->name('assign_subjects.edit');
    Route::put('admins/assign_subjects/update/{assignSubject}', [ClassSubjectController::class, 'update'])->name('assign_subjects.update');
    Route::get('admins/assign_subjects/delete/{assignSubject}', [ClassSubjectController::class, 'destroy'])->name('assign_subjects.delete');

});

// Teacher Middleware =================================================================
Route::group(['middleware' => 'teacher'], function () {
    Route::get('teacher/teacher-dashboard', [DashboardController::class, 'dashboard']);
    Route::get('teachers', [TeacherController::class, 'index'])->name('teachers.index');

    Route::get('teachers/profile/show/{user}', [ProfileController::class, 'show'])->name('teachers.profile.show');
    Route::get('teachers/profile/edit/{user}', [ProfileController::class, 'edit'])->name('teachers.profile.edit');
    Route::put('teachers/profile/update/{user}', [ProfileController::class, 'update'])->name('teachers.profile.update');


});

// Student Middleware =================================================================
Route::group(['middleware' => 'student'], function () {
    Route::get('student/student-dashboard', [DashboardController::class, 'dashboard']);
    // Students Route
    Route::get('students', [StudentController::class, 'index'])->name('students.index');
    Route::get('students/teachers', [TeacherController::class, 'index'])->name('teachers.index');
    Route::get('students/create', [StudentController::class, 'create'])->name('students.create');
    Route::post('students', [StudentController::class, 'store'])->name('students.store');

    Route::get('students/profile/show/{user}', [ProfileController::class, 'show'])->name('students.profile.show');
    Route::get('students/profile/edit/{user}', [ProfileController::class, 'edit'])->name('students.profile.edit');
    Route::put('students/profile/update/{user}', [ProfileController::class, 'update'])->name('students.profile.update');

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
