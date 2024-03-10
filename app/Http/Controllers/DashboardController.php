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
        $data['admins'] = User::where('user_type', 1)->count();
        $data['teachers'] = User::where('user_type', 2)->count();
        $data['students'] = User::where('user_type', 3)->count();
        $data['parents'] = User::where('user_type', 4)->count();

        $dashboardView = '';
        switch (Auth::user()->user_type) {
            case 1:
                $dashboardView = 'admin.admin-dashboard';
                break;
            case 2:
                $dashboardView = 'teacher.teacher-dashboard';
                break;
            case 3:
                $dashboardView = 'student.student-dashboard';
                break;
            case 4:
                $dashboardView = 'parent.parent-dashboard';
                break;
            default:
                // Handle default case if necessary
                break;
        }

        return view($dashboardView, $data);
    }

    public function list()
{
    $data['header_title'] = 'Dashboard';

    // Retrieve users based on user type
    switch (Auth::user()->user_type) {
        case 1:
            $data['admins'] = User::where('user_type', 1)->get();
            $view = 'admin.admin-list';
            break;
        case 2:
            $data['teachers'] = User::where('user_type', 2)->get();
            $view = 'subject.subject-list';
            break;
        case 3:
            $data['students'] = User::where('user_type', 3)->get();
            $view = 'student.student-list';
            break;
        case 4:
            $data['parents'] = User::where('user_type', 4)->get();
            $view = 'parent.parent-list';
            break;
        default:
            // Handle default case if necessary
            break;
    }

    return view($view, $data);
}

}
