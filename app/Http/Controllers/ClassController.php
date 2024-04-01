<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['header_title'] = 'Class List';
        $data['getClass'] = ClassModel::getClass();
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
    public function store(Request $request, ClassModel $class)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:classes,name,' . $class->id . 'id|min:3',
        ]);

       $class->name = $validatedData['name'];
       $class->status = $request->status;
       $class->created_by = Auth::user()->id;
       $class->save();
        return back()->with('success', 'Class added successfully');
    }

    public function edit(ClassModel $class)
    {
        $data['header_titles'] = 'Class Edit';
        $data['class'] = $class;
        return view('class.class-edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClassModel $class)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:classes,name,' . $class->id . 'id|min:3',
            'status' =>''
        ]);
        $class->update($validatedData);
        return redirect()->route('classes.index')->with('Class Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClassModel $class)
    {
        $class->is_deleted = 1;
        $class->save();
        return redirect()->route('classes.index')->with('success','Class Deleted successfully');
    }
}
