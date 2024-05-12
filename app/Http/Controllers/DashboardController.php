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
        $data['totalAdmin'] = User::where('user_type', 1)
            ->where('is_delete', 0)
            ->count();
        $data['totalTeacher'] = User::where('user_type', 2)
            ->where('is_delete', 0)
            ->count();
        $data['totalStudent'] = User::where('user_type', 3)
            ->where('is_delete', 0)
            ->count();
        $data['totalParent'] = User::where('user_type', 4)
            ->where('is_delete', 0)
            ->count();

        if (Auth::user()->user_type == 1) {
            $data['admins'] = User::all();
            return view('admin.admin-dashboard', $data);
        } else if (Auth::user()->user_type == 2) {
            $data['teachers'] = User::all();
            return view('teacher.teacher-dashboard', $data);
        } else if (Auth::user()->user_type == 3) {
            $data['students'] = User::all();
            return view('student.student-dashboard', $data);
        } else if (Auth::user()->user_type == 4) {
            $data['parents'] = User::all();
            return view('parent.parent-dashboard', $data);
        }
    }
}
