<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use Illuminate\Http\Request;

class SchoolClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['header_title'] = 'Class List';
        $data['getClass'] = SchoolClass::getClass();
        return view('class.class-list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['header_title'] = 'Class Create';
        return view('class.class-create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        SchoolClass::create([
            'name' => $validatedData['name']
        ]);
        return redirect()->route('class.create')->with('success', 'Class added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(SchoolClass $schoolClass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SchoolClass $schoolClass)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SchoolClass $schoolClass)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SchoolClass $schoolClass)
    {
        //
    }
}
