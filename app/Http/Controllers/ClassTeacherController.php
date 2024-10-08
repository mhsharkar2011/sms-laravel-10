<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\Subject;
use App\Models\ClassSubject;
use App\Models\ClassTeacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\LaravelIgnition\Recorders\DumpRecorder\Dump;

class ClassTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['header_title'] = 'Assign Teacher';
        $data['assignTeachers'] = ClassTeacher::select(
            'class_teachers.*', 
            'classes.name as class_name',
            'teachers.first_name as teacher_name',
            'creators.first_name as created_by_name'
            )
            ->join('users as teachers', 'teachers.id', '=', 'class_teachers.teacher_id')
            ->join('users as creators', 'creators.id', '=', 'class_teachers.created_by')
            ->join('classes', 'classes.id', '=', 'class_teachers.class_id')
            ->where('class_teachers.is_deleted', 0);
        if (!empty($request->class_name)) {
            $data['assignTeachers'] = $data['assignTeachers']->where('classes.name', 'LIKE', '%' . $request->class_name . '%');
        }
        if (!empty($request->teacher_name)) {
            $data['assignTeachers'] = $data['assignTeachers']->where('users.first_name', 'LIKE', '%' . $request->teacher_name . '%');
        }
        if (!empty($request->date)) {
            $data['assignTeachers'] = $data['assignTeachers']->whereDate('class_teachers.created_at', '=', $request->date);
        }
        $data['assignTeachers'] =  $data['assignTeachers']->get();

        return view('admin.assign_class_teacher.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['header_title'] = 'Assign Teachers';
        $data['teachers'] = User::where('users.is_deleted', '=', 0)
            ->where('users.user_type', '=', 2)
            ->where('users.status', '=', 0)
            ->orderBy('users.first_name', 'asc')
            ->get();
        $data['classes'] = ClassModel::where('classes.is_deleted', '=', 0)
            ->where('classes.status', '=', 0)
            ->orderBy('classes.name', 'asc')
            ->get();
        return view('admin.assign_class_teacher.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!empty($request->teacher_id)) {
            foreach ($request->teacher_id as $teacher_id) {
                $input = new ClassTeacher();
                $input->class_id = $request->class_id;
                $input->teacher_id = $teacher_id;
                $input->status = $request->status;
                $input->created_by = Auth::user()->id;
                $input->save();
            }
            return redirect()->route('admins.assign_class_teachers.index')->with('success', 'Teacher assign to class successfully');
        } else {
            return redirect()->back()->with('error', 'Invalid');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ClassSubject $assignSubject)
    {
        $data['header_title'] = 'Show Assigned Teacher';

        if (!empty($assignSubject)) {
            $data['assignSubject'] = $assignSubject;
            $data['getClass'] = ClassModel::getClass();
            $data['getSubject'] = Subject::getSubject();
            $data['getTeacher'] = User::getTeacher();
            return view('admin.assign_class_teacher.show', $data);
        } else {
            abort(404);
        }
    }

    public function update_single(ClassTeacher $classTeacher)
    {
        dd('ok');
        return view('assign_class_teacher.edit');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClassSubject $assignSubject)
    {
        $data['header_title'] = 'Edit Assignment Subject';

        if (!empty($assignSubject)) {
            $data['assignSubject'] = $assignSubject;
            $assignSubject = $assignSubject;
            $data['getAssignSubjectId'] = ClassSubject::getAssignSubjectId($assignSubject->class_id);
            $data['getClass'] = ClassModel::getClass();
            $data['getSubject'] = Subject::getSubject();
            return view('admin.assign_class_teacher.edit', $data);
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        ClassSubject::deleteSubject($request->class_id);

        foreach ($request->subject_id as $subject_id) {
            $existingRecord = ClassSubject::where('class_id', $request->class_id)
                ->where('subject_id', $subject_id)
                ->first();
            if ($existingRecord) {
                // If an existing record is found, update its status
                $existingRecord->status = $request->status;
                $existingRecord->save();
            } else {
                $input = new ClassSubject;
                $input->class_id = $request->class_id;
                $input->subject_id = $subject_id;
                $input->status = $request->status;
                $input->created_by = Auth::user()->id;
                $input->save();
            }
        }
        return redirect()->route('admins.assign_class_teachers.index')->with('Class Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClassTeacher $classTeacher)
    {
    }

    public function myClassSubject()
    {
        $data['header_title'] = 'My Classes & Subjects';
        $data['getRecord'] = ClassTeacher::getMyClassSubject(Auth::user()->id);
        return view('teacher.my-class-subject', $data);
    }

    public function myStudent()
    {
        $data['header_title'] = 'My Students';
        $data['getRecord'] = ClassTeacher::getTeacherStudent(Auth::user()->id);
        return view('teacher.my-student', $data);
    }

}
