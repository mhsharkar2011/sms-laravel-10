<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttendanceController;
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
Route::get('logout', [AuthController::class, 'logout']);



// Profile Route 
Route::get('profile/show/{user}', [ProfileController::class, 'show'])->name('profile.show');
Route::get('profile/edit/{user}', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('profile/edit/{user}', [ProfileController::class, 'update'])->name('profile.update');
Route::get('change_password', [ProfileController::class, 'change_password'])->name('change_password');
Route::post('change_password', [ProfileController::class, 'update_password'])->name('update_password');

// Admin Middleware =================================================================
Route::group(['middleware' => 'admin'], function () {
    Route::prefix('admins')->name('admins.')->group(function () {
        Route::get('admin-dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

        // Admins Route
        Route::get('list', [AdminController::class, 'index'])->name('index');
        Route::get('create', [AdminController::class, 'create'])->name('create');
        Route::post('store', [AdminController::class, 'store'])->name('store');
        Route::get('profile/delete/{user}', [AdminController::class, 'destroy'])->name('profile.destroy');
        Route::get('profile/restore/{user}', [AdminController::class, 'restore'])->name('profile.restore');

        // Teachers Route
        Route::resource('teachers',TeacherController::class);
        // Route::get('teachers/list', [TeacherController::class, 'index'])->name('teachers.index');
        // Route::get('teachers/create', [TeacherController::class, 'create'])->name('teachers.create');
        // Route::post('teachers/store', [TeacherController::class, 'store'])->name('teachers.store');
        // Route::get('teachers/show/{user}', [TeacherController::class, 'show'])->name('teachers.show');
        // Route::get('teachers/profile/edit/{user}', [TeacherController::class, 'edit'])->name('teachers.edit');
        // Route::post('teachers/profile/edit/{user}', [TeacherController::class, 'update'])->name('teachers.update');
        // Route::get('teachers/delete/{user}', [TeacherController::class, 'destroy'])->name('teachers.destroy');

        // Students Route
        Route::resource('students',StudentController::class);
        // Route::get('students/list', [StudentController::class, 'index'])->name('students.index');
        // Route::get('students/create', [StudentController::class, 'create'])->name('students.create');
        // Route::post('students/store', [StudentController::class, 'store'])->name('students.store');
        // Route::get('students/show/{user}', [StudentController::class, 'show'])->name('students.show');
        // Route::get('students/profile/edit/{user}', [StudentController::class, 'edit'])->name('students.edit');
        // Route::post('students/profile/edit/{user}', [StudentController::class, 'update'])->name('students.update');
        // Route::get('students/delete/{user}', [StudentController::class, 'destroy'])->name('students.destroy');

        // Parents Route
        Route::resource('parents',ParentController::class);
        // Route::get('parents/list', [ParentController::class, 'index'])->name('parents.index');
        // Route::get('parents/create', [ParentController::class, 'create'])->name('parents.create');
        // Route::post('parents/store', [ParentController::class, 'store'])->name('parents.store');
        // Route::get('parents/show/{user}', [ParentController::class, 'show'])->name('parents.show');
        // Route::get('parents/profile/edit/{user}', [ParentController::class, 'edit'])->name('parents.edit');
        // Route::post('parents/profile/edit/{user}', [ParentController::class, 'update'])->name('parents.update');
        // Route::get('parents/delete/{user}', [ParentController::class, 'destroy'])->name('parents.destroy');

        // Attendance Route
        Route::get('attendance', [AttendanceController::class, 'index'])->name('attendance.index');
        Route::get('attendance/students/{id}', [AttendanceController::class, 'studentAttendance'])->name('attendance.student');
        Route::get('attendance/teachers/{id}', [AttendanceController::class, 'teacherAttendance'])->name('attendance.teacher');

        // Class Route
        Route::resource('classes',ClassController::class);
        // Route::get('classes', [ClassController::class, 'index'])->name('classes.index');
        // Route::get('classes/create', [ClassController::class, 'create'])->name('classes.create');
        // Route::post('classes', [ClassController::class, 'store'])->name('classes.store');
        // Route::get('classes/edit/{class}', [ClassController::class, 'edit'])->name('classes.edit');
        // Route::put('classes/update/{class}', [ClassController::class, 'update'])->name('classes.update');
        // Route::get('classes/delete/{id}', [ClassController::class, 'destroy'])->name('classes.delete');

        // Subject Route
        Route::resource('subjects',SubjectController::class);
        // Route::get('subjects', [SubjectController::class, 'index'])->name('subjects');
        // Route::get('subjects/create', [SubjectController::class, 'create'])->name('subjects.create');
        // Route::post('subjects', [SubjectController::class, 'store'])->name('subjects.store');
        // Route::get('subjects/edit/{subject}', [SubjectController::class, 'edit'])->name('subjects.edit');
        // Route::put('subjects/update/{subject}', [SubjectController::class, 'update'])->name('subjects.update');
        // Route::get('subjects/delete/{subject}', [SubjectController::class, 'destroy'])->name('subjects.delete');

        // Assign Subject to Class Route
        Route::resource('assign_subjects', ClassSubjectController::class)->except('show');
        Route::get('assign_subjects/{id}', [ClassSubjectController::class, 'destroy'])->name('assign_subjects.destroy');
        Route::put('assign_subjects/single_update/{update_single}', [ClassSubjectController::class, 'update_single'])->name('assign_subjects.update_single');
    });
});


// Teachers Middleware =================================================================
Route::group(['middleware' => 'teacher'], function () {
    
    Route::get('teacher-dashboard', [DashboardController::class, 'dashboard']);

    Route::resource('teachers', TeacherController::class);
    // Route::get('profile/show/{user}', [TeacherController::class, 'show'])->name('teachers.profile.show');
    // Route::get('profile/edit/{user}', [TeacherController::class, 'edit'])->name('teachers.profile.edit');
    // Route::put('profile/update/{user}', [TeacherController::class, 'update'])->name('teachers.profile.update');
});


// Students Middleware =================================================================
Route::group(['middleware' => 'student'], function () {
    Route::get('student/student-dashboard', [DashboardController::class, 'dashboard']);
    Route::resource('students', StudentController::class);

    // Route::get('students', [StudentController::class, 'index'])->name('students.index');
    // Route::get('students/create', [StudentController::class, 'create'])->name('students.create');
    // Route::post('students', [StudentController::class, 'store'])->name('students.store');
    // Route::get('students/profile/show/{user}', [ProfileController::class, 'show'])->name('students.profile.show');
    // Route::get('students/profile/edit/{user}', [ProfileController::class, 'edit'])->name('students.profile.edit');
    // Route::put('students/profile/update/{user}', [ProfileController::class, 'update'])->name('students.profile.update');
    // Route::get('students/delete/{user}', [StudentController::class, 'destroy'])->name('students.destroy');

    // Students Teachers Route
    Route::get('students/teachers', [StudentController::class, 'studentTeacher'])->name('students.teachers.list');
});

// Parent Middleware =================================================================
Route::group(['middleware' => 'parent'], function () {
    Route::get('parents/parent-dashboard', [DashboardController::class, 'dashboard']);
    Route::resource('parents',ParentController::class);

    // Route::get('parents', [ParentController::class, 'index'])->name('parents.index');
    // Route::get('parents/profile/{user}', [ParentController::class, 'show'])->name('parents.show');
    // Route::get('parents/profile/edit/{user}', [ParentController::class, 'edit'])->name('parents.edit');
    // Route::put('parents/profile/update/{user}', [ParentController::class, 'update'])->name('parents.update');
    // Route::get('parents/delete/{user}', [ParentController::class, 'destroy'])->name('parents.destroy');
    Route::get('parents/profile/{user}', [ProfileController::class, 'parentProfile'])->name('parents.profile');
    Route::get('students', [StudentController::class, 'index'])->name('students.index');
});
