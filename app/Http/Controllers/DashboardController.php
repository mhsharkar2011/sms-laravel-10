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
        $data['admins'] = User::where('user_type',1)->count();
        $data['teachers'] = User::where('user_type',2)->count();
        $data['students'] = User::where('user_type',3)->count();
        $data['parents'] = User::where('user_type',4)->count();
        
        if (Auth::user()->user_type == 1) {
            return view('admin.admin-dashboard', $data);
        } else if (Auth::user()->user_type == 2) {
            $data['admins'] = User::all();
            return view('teacher.teacher-dashboard', $data);
        } else if (Auth::user()->user_type == 3) {
            $data['admins'] = User::all();
            return view('student.student-dashboard', $data);
        } else if (Auth::user()->user_type == 4) {
            $data['admins'] = User::all();
            return view('parent.parent-dashboard', $data);
        }
    }
}
