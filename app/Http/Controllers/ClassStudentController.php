<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\ClassStudent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassStudentController extends Controller
{
    public function index(Request $request)
    {
        $data['header_title'] = 'Assign Students';
        $data['assignStudents'] = ClassStudent::select('class_students.*', 'classes.name as class_name', 'students.first_name as student_name', 'creators.first_name as created_by_name')
            ->join('users as students', 'students.id', '=', 'class_students.student_id')
            ->join('users as creators', 'creators.id', '=', 'class_students.created_by')
            ->join('classes', 'classes.id', '=', 'class_students.class_id')
            ->where('class_students.is_deleted', 0);
        if (!empty($request->class_name)) {
            $data['assignStudents'] = $data['assignStudents']->where('classes.name', 'LIKE', '%' . $request->class_name . '%');
        }
        if (!empty($request->student_name)) {
            $data['assignStudents'] = $data['assignStudents']->where('students.first_name', 'LIKE', '%' . $request->student_name . '%');
        }
        if (!empty($request->date)) {
            $data['assignStudents'] = $data['assignStudents']->whereDate('class_students.created_at', '=', $request->date);
        }

        $data['assignStudents'] =  $data['assignStudents']->get();
        return view('admin.assign_class_student.list', $data);
    }

    public function create()
    {
        $data['header_title'] = 'Assign Students';
        $data['students'] = User::getStudent();
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
                $input->status = $request->status;
                $input->created_by = Auth::user()->id;
                $input->save();
                $user = User::find($student_id);
                $user->class_id = $input->class_id;
                $user->save();
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
            $data['getTeacher'] = User::getStudent();
            return view('admin.assign_class_student.show', $data);
        } else {
            abort(404);
        }
    }
}
