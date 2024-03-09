<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $data['header_title'] = 'Dashboard';
        if (Auth::user()->user_type == 1) {
            $data['admins'] = User::where('user_type = 1')->all();
            return view('admin.dashboard', $data);
        } else if (Auth::user()->user_type == 2) {
            $data['admins'] = User::all();
            return view('teacher.dashboard', $data);
        } else if (Auth::user()->user_type == 3) {
            $data['admins'] = User::all();
            return view('student.dashboard', $data);
        } else if (Auth::user()->user_type == 4) {
            $data['admins'] = User::all();
            return view('parent.dashboard', $data);
        }
    }
}
