<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SchoolClassController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [AuthController::class, 'login']);
Route::post('login', [AuthController::class, 'AuthLogin']);
Route::get('forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('forgot-password', [AuthController::class, 'postForgotPassword']);
Route::get('reset/{token}', [AuthController::class, 'resetPassword']);
Route::post('reset/{token}', [AuthController::class, 'postResetPassword']);
Route::get('logout', [AuthController::class, 'logout']);



// Admin Route
Route::group(['middleware' => 'admin'], function () {
    Route::get('admin/admin-dashboard',[DashboardController::class, 'dashboard']);
    // Admin Route
    Route::get('admins',[AdminController::class,'index'])->name('admins.index');
    Route::get('admins/create',[AdminController::class,'create'])->name('admins.create');
    Route::post('admins',[AdminController::class,'store'])->name('admins.store');
    Route::get('admins/profile/{user}',[AdminController::class,'show'])->name('admins.show');
    Route::get('admins/profile/edit/{user}',[AdminController::class,'edit'])->name('admins.edit');
    Route::put('admins/profile/edit/{user}',[AdminController::class,'update'])->name('admins.update');
    Route::get('admins/delete/{user}',[AdminController::class,'destroy'])->name('admins.destroy');
    // Class Route
    Route::get('classes',[SchoolClassController::class,'index'])->name('classes.index');
    Route::get('classes',[SchoolClassController::class,'create'])->name('classes.create');

});

Route::group(['middleware' => 'teacher'], function () {
    Route::get('teacher/teacher-dashboard',[DashboardController::class, 'dashboard']);
});

Route::group(['middleware' => 'student'], function () {
    Route::get('student/student-dashboard',[DashboardController::class, 'dashboard']);
});

Route::group(['middleware' => 'parent'], function () {
    Route::get('parent/parent-dashboard',[DashboardController::class, 'dashboard']);
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';
