<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
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
Route::get('logout', [AuthController::class, 'logout']);

// Route::post('/create', [AuthController::class, 'AuthLogin'])->name('auth.login');



Route::get('admin/list', [AuthController::class, 'index']);

Route::group(['middleware' => 'admin'], function () {
    Route::get('admin/dashboard', function () {
        $admins = User::count();
        return view('admin.dashboard',compact('admins'));
    });
});

Route::group(['middleware' => 'teacher'], function () {
    Route::get('teacher/dashboard', function () {
        $admins = User::count();
        return view('teacher.dashboard',compact('admins'));
    });
});

Route::group(['middleware' => 'student'], function () {
    Route::get('student/dashboard', function () {
        $admins = User::count();
        return view('student.dashboard',compact('admins'));
    });
});

Route::group(['middleware' => 'parent'], function () {
    Route::get('parent/dashboard', function () {
        $admins = User::count();
        return view('parent.dashboard',compact('admins'));
    });
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
