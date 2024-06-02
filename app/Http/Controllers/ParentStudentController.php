<?php

namespace App\Http\Controllers;

use App\Models\parentStudent;
use Illuminate\Http\Request;

class ParentStudentController extends Controller
{
    public function index(Request $request)
    {
        $data['header_title'] = 'Parent Students';
        $data['parentStudents'] = parentStudent::select(
            'parent_students.*',
            'classes.name as class_name',
            'students.first_name as student_name',
            'creators.first_name as created_by_name',
            'parents.first_name as parent_name'
        )
            ->join('users as students', 'students.id', '=', 'parent_students.student_id')
            ->join('users as parents', 'parents.id', '=', 'parent_students.student_id')
            ->join('users as creators', 'creators.id', '=', 'class_students.created_by')
            ->join('classes', 'classes.id', '=', 'class_students._id')->get();

        return view('parent.my-student', $data);
    }
}
