<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ClassSubjectController;
use App\Http\Controllers\ClassTeacherController;
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
Route::get('profile/edit/{user}', [ProfileController::class, 'edit'])->name('profile.edit');
Route::get('teacher/profile/edit/{user}', [ProfileController::class, 'teacherEdit'])->name('teacher.profile.edit');
Route::get('student/profile/edit/{user}', [ProfileController::class, 'studentEdit'])->name('student.profile.edit');
Route::get('parent/profile/edit/{user}', [ProfileController::class, 'parentEdit'])->name('parent.profile.edit');
Route::post('profile/edit/{user}', [ProfileController::class, 'update'])->name('profile.update');
Route::post('teacher/profile/edit/{user}', [ProfileController::class, 'teacherUpdate'])->name('teacher.profile.update');
Route::post('student/profile/edit/{user}', [ProfileController::class, 'studentUpdate'])->name('student.profile.update');
Route::post('parent/profile/edit/{user}', [ProfileController::class, 'parentUpdate'])->name('parent.profile.update');
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
        Route::get('profile/show/{user}', [ProfileController::class, 'profile'])->name('profile.show');
        Route::get('profile/edit/{user}', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::get('profile/delete/{user}', [AdminController::class, 'destroy'])->name('profile.destroy');
        Route::get('profile/restore/{user}', [AdminController::class, 'restore'])->name('profile.restore');

        // Teachers Route
        Route::resource('teachers', TeacherController::class);
        Route::get('teachers/delete/{user}', [TeacherController::class, 'destroy'])->name('teachers.destroy');
        Route::get('teachers/restore/{user}', [TeacherController::class, 'restore'])->name('teachers.restore');


        // Assign Subject to Class Route
        Route::resource('assign_subjects', ClassSubjectController::class)->except('show');
        Route::get('assign_subjects/{id}', [ClassSubjectController::class, 'destroy'])->name('assign_subjects.destroy');
        Route::put('assign_subjects/single_update/{update_single}', [ClassSubjectController::class, 'update_single'])->name('assign_subjects.update_single');

        // Assign Class to Teacher Route
        Route::resource('assign_class_teachers', ClassTeacherController::class)->except('show');
        Route::get('assign_class_teachers/{id}', [ClassTeacherController::class, 'destroy'])->name('assign_class_teachers.destroy');
        Route::put('assign_class_teachers/single_update/{update_single}', [ClassTeacherController::class, 'update_single'])->name('assign_class_teachers.update_single');

        // Students Route
        Route::resource('students', StudentController::class);
        Route::get('students/delete/{user}', [StudentController::class, 'destroy'])->name('students.destroy');
        Route::get('students/restore/{user}', [StudentController::class, 'restore'])->name('students.restore');
        

        // Parents Route
        Route::resource('parents', ParentController::class);
       

        // Attendance Route
        Route::get('attendance', [AttendanceController::class, 'index'])->name('attendance.index');
        Route::get('attendance/students/{id}', [AttendanceController::class, 'studentAttendance'])->name('attendance.student');
        Route::get('attendance/teachers/{id}', [AttendanceController::class, 'teacherAttendance'])->name('attendance.teacher');

        // Class Route
        Route::resource('classes', ClassController::class)->except(['show', 'destroy']);
        Route::get('classes/delete/{class}', [ClassController::class, 'destroy'])->name('classes.destroy');
        Route::get('classes/restore/{class}', [ClassController::class, 'restore'])->name('classes.restore');
        
        // Subject Route
        Route::resource('subjects', SubjectController::class)->except('show');
        Route::get('subjects/delete/{subject}', [SubjectController::class, 'destroy'])->name('subjects.destroy');
       

        // Assign Subject to Class Route
        Route::resource('assign_subjects', ClassSubjectController::class)->except('show');
        Route::get('assign_subjects/{id}', [ClassSubjectController::class, 'destroy'])->name('assign_subjects.destroy');
        Route::put('assign_subjects/single_update/{update_single}', [ClassSubjectController::class, 'update_single'])->name('assign_subjects.update_single');
    });
});


// Teachers Middleware =================================================================
Route::group(['middleware' => 'teacher'], function () {
    Route::resource('teachers', TeacherController::class);
    Route::prefix('teachers')->name('teachers.')->group(function () {
        Route::get('teacher-dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
        Route::get('profile/show/{id}', [ProfileController::class, 'profile'])->name('profile.show');
        Route::get('profile/edit/{user}', [TeacherController::class, 'edit'])->name('profile.edit');
        Route::put('profile/update/{user}', [TeacherController::class, 'update'])->name('teachers.profile.update');
    });
});

// Students Middleware =================================================================
Route::group(['middleware' => 'student'], function () {
    Route::resource('students', StudentController::class)->except('show');
    Route::prefix('students')->name('students.')->group(function () {
        Route::get('student-dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
        Route::get('profile/show/{user}', [ProfileController::class, 'profile'])->name('profile.show');
        Route::get('profile/edit/{user}', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('profile/update/{user}', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('delete/{user}', [StudentController::class, 'destroy'])->name('destroy');
        Route::get('student-teachers', [StudentController::class, 'studentTeacher'])->name('teachers');
        Route::get('teachers/profile/show/{user}', [ProfileController::class, 'profile'])->name('teacher.profile.show');
    });
});

// Parent Middleware =================================================================
Route::group(['middleware' => 'parent'], function () {
    Route::get('parent-dashboard', [DashboardController::class, 'dashboard'])->name('parents.dashboard');
    Route::resource('parents', ParentController::class);

    Route::get('profile/show/{user}', [ProfileController::class, 'profile'])->name('profile.show');
    Route::get('students', [StudentController::class, 'index'])->name('students.index');
});


Route::fallback(function () {
    return "<h1>Page Not Found</h1>";
});
