<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['header_title'] = 'Subject List';
        $data['getSubject'] = Subject::getSubject();
        return view('subject.subject-list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['header_title'] = 'Class Create';
        return view('subject.subject-create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
       $subject = new Subject;
       $subject->name = $request->name;
       $subject->status = $request->status;
       $subject->created_by = Auth::user()->id;
        $subject->save();
        return back()->with('success', 'Subject Created successfully');
    }

    public function edit(Subject $subject)
    {
        $data['header_title'] = "Subject Edit";
        $data['subject'] = $subject;
        return view('subject.subject-edit',$data);
    }

    public function update(Request $request, Subject $subject)
    {
        $subject->update($request->all());
        return redirect()->route('subject.index')->with('success', 'Subject has been updated');
    }

    public function destroy(Subject $subject)
    {
        $subject->is_deleted = 1;
        $subject->save();
        return redirect()->route('admins.subjects')->with('success','Subject Deleted successfully');
    }
}
