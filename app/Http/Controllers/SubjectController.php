<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('subject.subject-create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // Define validation rules
        $rules = [
            'name' => 'required|string|max:255',
            // Add more validation rules for other fields if necessary
        ];

        // Validate the incoming request data
        $validation = Validator::make($request->all(), $rules);

        // Check if validation fails
        if ($validation->fails()) {
            return back()->withErrors($validation)->withInput();
        }

        // If validation passes, proceed with storing the data
        $subject = Subject::create($request->all());

        return back()->with('success', 'Data inserted successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        //
    }
}
