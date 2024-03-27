<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\ClassSubject;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassSubjectController extends Controller
{
    public function index()
    {
        $data['header_title'] = 'Subject Assignment';
        $data['assignSubjects'] = ClassSubject::select('class_subjects.*','classes.name as class_name','subjects.name as subject_name','users.name as created_by_name')
                                                ->join('subjects', 'subjects.id','=', 'class_subjects.subject_id')
                                                ->join('classes', 'classes.id','=', 'class_subjects.class_id')
                                                ->join('users', 'users.id','=', 'class_subjects.created_by')
                                                ->where('class_subjects.is_deleted',0)
                                                ->orderBy('class_subjects.id', 'desc')
                                                ->get();
        return view('admin.assign_subject.list', $data);
    }

    public function create()
    {
        $data['header_title'] = 'Subject Assignment';
        $data['subjects'] = Subject::where('subjects.is_deleted', '=', 0)
                                    ->where('subjects.status', '=', 0)
                                    ->orderBy('subjects.name', 'asc')
                                    ->get();
        $data['classes'] = ClassModel::where('classes.is_deleted', '=', 0)
                                    ->where('classes.status', '=', 0)
                                    ->orderBy('classes.name', 'asc')
                                    ->get();
        return view('admin.assign_subject.create', $data);
    }
    public function store(Request $request)
    {
        // dd($request->all());
        if(!empty($request->subject_id)){
            foreach($request->subject_id as $subject_id){
                $input = new ClassSubject;
                $input->class_id = $request->class_id;
                $input->subject_id = $subject_id;
                $input->status = $request->status;
                $input->created_by = Auth::user()->id;
                $input->save();
            }
            return redirect()->route('assign_subjects.index')->with('success', 'Subject assign to class successfully');
        }else{
            return redirect()->back()->with('error', 'Invalid');
        }
    }

    public function destroy(ClassSubject $assignSubject)
    {
        $assignSubject->is_deleted = 1;
        $assignSubject->save();
        return redirect()->route('assign_subjects.index')->with('success','Assigned Subject Deleted successfully');
    }
}
