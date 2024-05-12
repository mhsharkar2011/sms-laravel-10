<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['header_title'] = 'Student List';
        $data['getStudent'] = User::select('users.*', DB::raw("CONCAT(users.first_name, ' ', users.last_name) AS created_by_name"))
                                ->where('users.is_delete', 0)
                                ->where('users.user_type',3);
        
        if (!empty($request->first_name)) {
            $data['getStudent'] = $data['getStudent']->where('users.first_name', 'LIKE', '%' . $request->first_name . '%');
        }
        if (!empty($request->last_name)) {
            $data['getStudent'] = $data['getStudent']->where('users.last_name', 'LIKE', '%' . $request->last_name . '%');
        }
         if (!empty($request->email)) {
            $data['getStudent'] = $data['getStudent']->where('users.email', 'LIKE', '%' . $request->email . '%');
        }
        if (!empty($request->date)) {
            $data['getStudent'] = $data['getStudent']->whereDate('users.created_at', '=', $request->date);
        }
        $data['getStudent'] = $data['getStudent']->get();
        return view('student.student-list',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['header_title'] = 'Student Create';
        return view('student.student-create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'user_type' =>3,
            'created_by' => Auth::user()->id,
            'password' => Hash::make($validatedData['password']),
        ]);

        return redirect()->route('admins.students.index')->with('success', 'Student added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        $header_title = 'Student Profile';
        return view('profile.show',compact('header_title','user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $data['header_title'] = 'Student Profile Edit';
        $data['user'] = $user;
        return view('student.student-edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            //'email' => 'required|email|unique:users|max:255'.$user->id,
            //'password' => 'required|string|min:8',
        ]);

        $input = Arr::except($validatedData, 'avatar');

        if ($user->avatar && $request->hasFile('avatar')) {
            Storage::delete('public/avatars' . $user->avatar);
            $user->avatar = null;
        }
        if (!empty($request->email)) {
            $user->email = $request->email;
            $user->save();
        }
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
            $user->save();
        }
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = $user->id . '-' . $user->name . '-' . date('Ymd_Hsi') . '.' . $avatar->getClientOriginalExtension();
            $avatar->storeAs('public/avatars', $filename);
            $user->avatar = $filename;
            $user->save();
        }

        $user->update($input);
        return redirect()->route('admins.students.index')->with('success', 'Student Info Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if(Auth::user()->user_type == 1){
            $user->is_delete = 1;
            $user->save();
        }
        return redirect()->route('admins.students.index')->with('success', 'Student deleted successfully');
    }

    public function restore(User $user)
    {
        if(Auth::user()->user_type == 1){
        $user->is_delete = 0;
        $user->save();
        }
        return redirect()->route('admins.students.index')->with('success', 'Student Restored successfully');
    }
}
