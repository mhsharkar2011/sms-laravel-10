<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['header_title'] = 'Teachers List';
        $data['getTeacher'] = User::select('users.*', DB::raw("CONCAT(users.first_name, ' ', users.last_name) AS created_by_name"))
                                ->where('users.user_type',2);
        
        if (!empty($request->first_name)) {
            $data['getTeacher'] = $data['getTeacher']->where('users.first_name', 'LIKE', '%' . $request->first_name . '%');
        }
        if (!empty($request->last_name)) {
            $data['getTeacher'] = $data['getTeacher']->where('users.last_name', 'LIKE', '%' . $request->last_name . '%');
        }
         if (!empty($request->email)) {
            $data['getTeacher'] = $data['getTeacher']->where('users.email', 'LIKE', '%' . $request->email . '%');
        }
        if (!empty($request->date)) {
            $data['getTeacher'] = $data['getTeacher']->whereDate('users.created_at', '=', $request->date);
        }
        $data['getTeacher'] = $data['getTeacher']->get();
        return view('teacher.teacher-list',$data);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['header_title'] = 'Teacher Create';
        return view('teacher.teacher-create', $data);
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
            'user_type' =>2,
            'created_by' => Auth::user()->id,
            'password' => Hash::make($validatedData['password']),
        ]);

        return redirect()->route('admins.teacher.index')->with('success', 'Teacher added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $data['header_title'] = 'Teacher Show';
        $data['user'] = $user; 
        return view('profile.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $data['header_title'] = 'Teacher Profile Edit';
        $data['user'] = $user;
        return view('teacher.edit', $data);
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
            Storage::delete('public/avatars/' . $user->avatar);
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
        return redirect()->route('admins.teachers.index')->with('success', 'Teacher Info Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if(Auth::user()->user_type == 1){
            $user->is_deleted = 1;
            $user->save();
        }
        return redirect()->route('admins.teachers.index')->with('success', 'Teacher deleted successfully');
    }

    public function restore(User $user)
    {
        if(Auth::user()->user_type == 1){
        $user->is_deleted = 0;
        $user->save();
        }
        return redirect()->route('admins.teachers.index')->with('success', 'Teacher Restored successfully');
    }
}
