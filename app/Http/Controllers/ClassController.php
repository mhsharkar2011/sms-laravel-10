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
    public function store(Request $request)
    {
       $class = new ClassModel;
       $class->name = $request->name;
       $class->status = $request->status;
       $class->created_by = Auth::user()->id;
       $class->save();
        return redirect()->route('classes.create')->with('success', 'Class added successfully');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClassModel $ClassModel)
    {
        $data['header_titles'] = 'Class Edit';
        $data['classModel'] = $ClassModel;
        return view('class.class-create',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClassModel $ClassModel)
    {
        $class = $request->all();
        $request->class()->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $class= ClassModel::findOrFail($id);
        $class->is_deleted = 1;
        $class->save();
        return redirect()->route('classes.index')->with('success','Class Deleted successfully');
    }
}
