<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Carbon\Carbon;
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
        $localTimeZone = 'Asia/Dhaka';
        $subjects = Subject::all();
        foreach ($subjects as $subject) {
            $subject->created_at = Carbon::createFromFormat('Y-m-d H:i:s', $subject->created_at, 'UTC')
                ->setTimezone($localTimeZone);
        }
        $data['header_title'] = 'Subject List';
        $data['getSubject'] = Subject::getSubject();
        return view('subject.subject-list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['header_title'] = 'Subject Create';
        return view('subject.subject-create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request, Subject $subject)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:subjects,name,' . $subject->id . 'id|min:3',
        ]);

        $subject = new Subject;
        $subject->name = $validatedData['name'];
        $subject->status = $request->status;
        $subject->created_by = Auth::user()->id;
        $subject->save();
        return back()->with('success', 'Subject Created successfully');
    }


    public function edit(Subject $subject)
    {
        $data['header_title'] = "Subject Edit";
        $data['subject'] = $subject;
        return view('subject.subject-edit', $data);
    }

    public function update(Request $request, Subject $subject)
    {
        $subject->name = $request->name;
        $subject->status = $request->status;
        $subject->created_by = Auth::user()->id;
        $subject->created_at = Carbon::now('UTC');
        $subject->updated_at = Carbon::now('UTC');
        
        $subject->update();

        // $subject->update($request->all());
        return redirect()->route('admins.subjects.index')->with('success', 'Subject has been updated');
    }

    public function destroy(Subject $subject)
    {
        $subject->is_deleted = 1;
        $subject->status = 1;
        $subject->save();
        return redirect()->route('admins.subjects.index')->with('success', 'Subject Deleted successfully');
    }

    public function restore(Subject $subject)
    {
        $subject->is_deleted = 0;
        $subject->status = 0;
        $subject->save();
        return redirect()->route('admins.subjects.index')->with('success', 'Subjects Restored successfully');
    }
}
