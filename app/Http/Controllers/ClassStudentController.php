<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\ClassStudent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassStudentController extends Controller
{
    public function index()
    {
        $data['header_title'] = 'Assign Student';
        $data['getRecord'] = ClassStudent::getAssignStudentRecord();
       
            
        // if (!empty($request->class_name)) {
        //     $data['getRecord'] = $data['getRecord']->where('classes.name', 'LIKE', '%' . $request->class_name . '%');
        // }
        // if (!empty($request->student_name)) {
        //     $data['getRecord'] = $data['getRecord']->where('students.first_name', 'LIKE', '%' . $request->student_name . '%');
        // }
        // if (!empty($request->date)) {
        //     $data['getRecord'] = $data['getRecord']->whereDate('class_students.created_at', '=', $request->date);
        // }
        // $data['getRecord'] =  $data['getRecord']->get();

        return view('admin.assign_class_student.list', $data);
    }

    public function create()
    {
        $data['header_title'] = 'Assign Students';
        $assignedStudentIds = ClassStudent::getAssignStudent();
        $students = User::whereNotIn('id', $assignedStudentIds)->where('user_type','=','3')->get();
        $data['students'] = $students;
        $data['classes'] = ClassModel::getClass();
        return view('admin.assign_class_student.create', $data);
    }
    public function store(Request $request)
    {
        if (!empty($request->student_id)) {
            foreach ($request->student_id as $student_id) {
                $input = new ClassStudent();
                $input->class_id = $request->class_id;
                $input->student_id = $student_id;
                $input->save();
            }
            return redirect()->route('admins.assign_class_students.index')->with('success', 'student assign to class successfully');
        } else {
            return redirect()->back()->with('error', 'Invalid');
        }
    }
    public function show(ClassStudent $classStudent)
    {
        $data['header_title'] = 'Show Assigned Student';

        if (!empty($assignSubject)) {
            $data['assignSubject'] = $assignSubject;
            $data['getClass'] = ClassModel::getClass();
            $data['getStudent'] = User::getStudent();
            return view('admin.assign_class_student.show', $data);
        } else {
            abort(404);
        }
    }

    public function edit($classId)
    {
        $data['header_title'] = 'Assign Students';
        $assignedStudentIds = ClassStudent::where('class_id',$classId)->pluck('student_id')->toArray();
        $students = User::where('user_type','=',3)->whereNotIn('id', $assignedStudentIds)->get();
        $data['students'] = $students;
        $data['classes'] = ClassModel::getClass();
        return view('admin.assign_class_student.create', $data);
    }
}
