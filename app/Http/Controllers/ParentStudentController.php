<?php

namespace App\Http\Controllers;

use App\Models\parentStudent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParentStudentController extends Controller
{
    public function index(Request $request)
    {
        $data['header_title'] = 'My Students';
        $data['getRecord'] = parentStudent::getParentStudent(Auth::user()->id);
        return view('parent.my-student', $data);
    }

}
