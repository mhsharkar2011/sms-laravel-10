<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\forgotPasswordMail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login()
    {
        // dd(Hash::make(12345678));
        $data['header_title'] = 'Login';
        if (!empty(Auth::check())) {
            if (Auth::user()->user_type == 1) {
                return redirect()->route('admins.dashboard')->with('success', 'Hello!' . Auth::user()->first_name . 'Welcome to School Management System');
            } else if (Auth::user()->user_type == 2) {
                return redirect()->route('teachers.dashboard')->with('success', 'Hello!' . Auth::user()->first_name . 'Welcome to School Management System');
            } else if (Auth::user()->user_type == 3) {
                return redirect()->route('students.dashboard')->with('success', 'Hello!' .  Auth::user()->first_name . 'Welcome to School Management System');
            } else if (Auth::user()->user_type == 4) {
                return redirect()->route('parents.dashboard')->with('success', 'Hello!' .  Auth::user()->first_name . 'Welcome to School Management System');
            }
        }
        return view('auth.login', $data);
    }

    public function AuthLogin(Request $request)
    {
        $data['header_title'] = 'Auth Login';
        $remember = !empty($request->remember) ? true : false;
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            if (Auth::user()->user_type == 1) {
                return redirect()->route('admins.dashboard')->with('success', 'Hello! ' . Auth::user()->first_name . ' Welcome to School Management System');
            } else if (Auth::user()->user_type == 2) {
                return redirect()->route('teachers.dashboard')->with('success', 'Hello! ' . Auth::user()->first_name . ' Welcome to School Management System');
            } else if (Auth::user()->user_type == 3) {
                return redirect()->route('students.dashboard')->with('success', 'Hello! ' . Auth::user()->first_name . ' Welcome to School Management System');
            } else if (Auth::user()->user_type == 4) {
                return redirect()->route('parents.dashboard')->with('success', 'Hello! ' . Auth::user()->first_name . ' Welcome to School Management System');
            }
        } else {
            return redirect()->back()->with('error', 'Please enter correct email and password');
        }
    }

    // Forgot Password
    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function postForgotPassword(Request $request)
    {
        $user = User::getSingleEmail($request->email);
        if (!empty($user)) {
            $user->remember_token = Str::random(16);
            $user->save();
            Mail::to($user->email)->send(new forgotPasswordMail($user));
            return redirect()->back()->with('success', 'Please check your email and reset your password');
        } else {
            return redirect()->back()->with('error', 'Email not found');
        }
    }

    // Reset password
    public function resetPassword($remember_token)
    {
        $user = User::getSingleToken($remember_token);
        if (!empty($user)) {
            $data['user'] = $user;
            return view('auth.reset', $data);
        } else {
            abort(404);
        }
    }

    public function postResetPassword($token, Request $request)
    {
        if ($request->password == $request->cpassword) {
            $user = User::getSingleToken($token);
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect(url('/'))->with('success', 'Password reset successfully');
        } else {
            return redirect()->back()->with('error', 'Password and Confirm Password does not match');
        }
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
