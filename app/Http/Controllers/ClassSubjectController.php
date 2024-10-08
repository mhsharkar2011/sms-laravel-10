<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\ClassSubject;
use App\Models\Subject;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassSubjectController extends Controller
{
    public function index(Request $request)
    {

        $data['header_title'] = 'Subject Assignment';
        $data['assignSubjects'] = ClassSubject::getClassSubject();
        if (!empty($request->class_name)) {
            $data['assignSubjects'] = $data['assignSubjects']->where('classes.name', 'LIKE', '%' . $request->class_name . '%');
        }
        if (!empty($request->subject_name)) {
            $data['assignSubjects'] = $data['assignSubjects']->where('subjects.name', 'LIKE', '%' . $request->subject_name . '%');
        }
        if (!empty($request->date)) {
            $data['assignSubjects'] = $data['assignSubjects']->whereDate('class_subjects.created_at', '=', $request->date);
        }

        $data['assignSubjects'] =  $data['assignSubjects']->get();

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
            ->orderBy('classes.id', 'asc')
            ->get();
        return view('admin.assign_subject.create', $data);
    }
    public function store(Request $request)
    {
        if (!empty($request->subject_id)) {
            foreach ($request->subject_id as $subject_id) {
                $input = new ClassSubject;
                $input->class_id = $request->class_id;
                $input->subject_id = $subject_id;
                $input->status = $request->status;
                $input->created_by = Auth::user()->id;
                $input->save();
            }
            return redirect()->route('admins.assign_subjects.index')->with('success', 'Subject assign to class successfully');
        } else {
            return redirect()->back()->with('error', 'Invalid');
        }
    }

    public function show(ClassSubject $assignSubject)
    {
        dd('ok');
        // $data['header_title'] = 'Show Assigned Subject';

        // if (!empty($assignSubject)) {
        //     $data['assignSubject'] = $assignSubject;
        //     $data['getClass'] = ClassModel::getClass();
        //     $data['getSubject'] = Subject::getSubject();
        //     return view('admin.assign_subject.show', $data);
        // } else {
        //     abort(404);
        // }
    }

    public function update_single(Request $request)
    {

        $existingRecord = ClassSubject::where('class_id', $request->class_id)
            ->where('subject_id', $request->subject_id)
            ->first();
        if ($existingRecord) {
            // If an existing record is found, update its status
            $existingRecord->status = $request->status;
            $existingRecord->save();
        } else {
            $input = new ClassSubject;
            $input->class_id = $request->class_id;
            $input->subject_id = $request->subject_id;
            $input->status = $request->status;
            $input->created_by = Auth::user()->id;
            $input->save();
        }
        return redirect()->route('admins.assign_subjects.index')->with('Class Updated Successfully');
    }

    public function edit(ClassSubject $assignSubject)
    {
        $data['header_title'] = 'Edit Assignment Subject';
         
        if (!empty($assignSubject)) {
            $data['assignSubject'] = $assignSubject;
            $assignSubject = $assignSubject;
            $data['getAssignSubjectId'] = ClassSubject::getAssignSubjectId($assignSubject->class_id);
            $data['getClass'] = ClassModel::getClass();
            $data['getSubject'] = Subject::getSubject();
            return view('admin.assign_subject.edit', $data);
        } else {
            abort(404);
        }
    }

    public function update(Request $request, ClassSubject $assignSubject)
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
        return redirect()->route('admins.assign_subjects.index')->with('Class Updated Successfully');
    }

    public function destroy(ClassSubject $id)
    {
        $id->is_deleted = 1;
        $id->status = 1;
        $id->save();
        return redirect()->route('admins.assign_subjects.index')->with('success', 'Assigned Subject Deleted successfully');
    }

    public function restore(ClassSubject $id)
    {
        $id->is_deleted = 0;
        $id->status = 0;
        $id->save();
        return redirect()->route('admins.assign_subjects.index')->with('success', 'Assigned Subject Restored successfully');
    }
}
