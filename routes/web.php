<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ClassStudentController;
use App\Http\Controllers\ClassSubjectController;
use App\Http\Controllers\ClassTeacherController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\ParentStudentController;
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
Route::get('profile/show/{user}', [ProfileController::class, 'showProfile'])->name('profile.show');
Route::get('profile/edit/{user}', [ProfileController::class, 'editProfile'])->name('profile.edit');
Route::post('profile/edit/{user}', [ProfileController::class, 'updateProfile'])->name('profile.update');
Route::get('profile/destroy/{user}', [ProfileController::class, 'destroyProfile'])->name('profile.destroy');
Route::get('profile/restore/{user}', [ProfileController::class, 'restoreProfile'])->name('profile.restore');
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

        // Teachers Route
        Route::get('teachers', [TeacherController::class,'index'])->name('teachers.index');
        Route::get('teachers/create', [TeacherController::class,'create'])->name('teachers.create');
        Route::post('teachers', [TeacherController::class,'store'])->name('teachers.store');

        // Students Route
        Route::get('students', [StudentController::class,'index'])->name('students.index');
        Route::get('students/create', [StudentController::class,'create'])->name('students.create');
        Route::post('students', [StudentController::class,'store'])->name('students.store');

        // Parents Route
        Route::get('parents', [ParentController::class,'index'])->name('parents.index');
        Route::get('parents/create', [ParentController::class,'create'])->name('parents.create');
        Route::post('parents', [ParentController::class,'store'])->name('parents.store');
        
        // Assign Subject to Class Route
        Route::resource('assign_subjects', ClassSubjectController::class)->except('show');
        Route::get('assign_subjects/{id}', [ClassSubjectController::class, 'destroy'])->name('assign_subjects.destroy');
        Route::put('assign_subjects/single_update/{update_single}', [ClassSubjectController::class, 'update_single'])->name('assign_subjects.update_single');

        // Assign Class to Teacher Route
        Route::resource('assign_class_teachers', ClassTeacherController::class)->except('show');
        Route::get('assign_class_teachers/{id}', [ClassTeacherController::class, 'destroy'])->name('assign_class_teachers.destroy');
        Route::put('assign_class_teachers/single_update/{update_single}', [ClassTeacherController::class, 'update_single'])->name('assign_class_teachers.update_single');

        // Assign Class to Student Route
        // Route::resource('assign_class_students', ClassStudentController::class)->except('show');
        Route::get('assign_class_students', [ClassStudentController::class,'index'])->name('assign_class_students.index');
        Route::get('assign_class_students/create', [ClassStudentController::class,'create'])->name('assign_class_students.create');
        Route::post('assign_class_students/store', [ClassStudentController::class,'store'])->name('assign_class_students.store');
        Route::get('assign_class_students/edit/{classId}', [ClassStudentController::class,'edit'])->name('assign_class_students.edit');
        Route::post('assign_class_students/update/{classId}', [ClassStudentController::class,'update'])->name('assign_class_students.update');
        Route::get('assign_class_students/{id}', [ClassStudentController::class, 'destroy'])->name('assign_class_students.destroy');
        Route::put('assign_class_students/single_update/{update_single}', [ClassStudentController::class, 'update_single'])->name('assign_class_students.update_single');

        // Assign Student to Parent Route
        Route::resource('assign_student_parents', ClassStudentController::class)->except('show');
        Route::get('assign_student_parents/{id}', [ClassStudentController::class, 'destroy'])->name('assign_student_parents.destroy');
        Route::put('assign_student_parents/single_update/{update_single}', [ClassStudentController::class, 'update_single'])->name('assign_student_parents.update_single');

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
    // Route::resource('teachers', TeacherController::class);
    Route::prefix('teachers')->name('teachers.')->group(function () {
        Route::get('teacher-dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
        Route::get('subjects',[SubjectController::class,'index'])->name('subjects.index');
        Route::get('my-class-subject', [ClassTeacherController::class,'myClassSubject'])->name('myClassSubject');
        Route::get('my-students', [ClassTeacherController::class,'myStudent'])->name('myStudents');
    });
});

// Students Middleware =================================================================
Route::group(['middleware' => 'student'], function () {
    Route::prefix('students')->name('students.')->group(function () {
        Route::get('student-dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
        Route::get('student-teachers', [StudentController::class, 'studentTeacher'])->name('teachers');
        Route::get('teachers/profile/show/{user}', [ProfileController::class, 'showProfile'])->name('teacher.profile.show');
    });
});

// Parent Middleware =================================================================
Route::group(['middleware' => 'parent'], function () {
    Route::prefix('parents')->name('parents.')->group(function () {
        Route::get('parent-dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
        Route::get('parents/students', [ParentStudentController::class, 'index'])->name('students.list');
    });
});


Route::fallback(function () {
    return "<h1>Page Not Found</h1>";
});
