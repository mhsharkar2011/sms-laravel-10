<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\parentStudent;
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


    public function index(Request $request)
    {
        $data['header_title'] = 'Student List';
        $data['getRecord'] = User::getStudent();

        // if (!empty($request->first_name)) {
        //     $data['getRecord'] = $data['getRecord']->where('users.first_name', 'LIKE', '%' . $request->first_name . '%');
        // }
        // if (!empty($request->last_name)) {
        //     $data['getRecord'] = $data['getRecord']->where('users.last_name', 'LIKE', '%' . $request->last_name . '%');
        // }
        // if (!empty($request->email)) {
        //     $data['getRecord'] = $data['getRecord']->where('users.email', 'LIKE', '%' . $request->email . '%');
        // }
        // if (!empty($request->date)) {
        //     $data['getRecord'] = $data['getRecord']->whereDate('users.created_at', '=', $request->date);
        // }

        // $data['getRecord'] = $data['getRecord']->get();

        return view('student.student-list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['header_title'] = 'Student Create';
        $data['classes'] = ClassModel::where('classes.is_deleted', '=', 0)
            ->where('classes.status', '=', 0)
            ->orderBy('classes.name', 'asc')
            ->get();
        $data['users'] = User::getParent();
        return view('student.student-create', $data);
    }

    public function generateStudentId()
    {
        $lastRecord = User::where('user_type',Auth::user()->user_type == 3)->orderBy('id', 'desc')->first();
        if ($lastRecord) {
            $lastStudentId = $lastRecord->student_id;
            $newStudentId = $lastStudentId + Auth::user()->id;
        } else {
            $newStudentId = 1;
        }
        return $newStudentId;
    }

    public function generateRollNumber()
    {
        $prefix = 'R-';
        $lastRecord = User::orderBy('id', 'desc')->first();
        if ($lastRecord) {
            $lastRollNumber = intval(substr($lastRecord->roll_number, strlen($prefix)));
            $newRollNumber = $lastRollNumber + 1;
        } else {
            $newRollNumber = 1;
        }
        return $prefix . str_pad($newRollNumber, 6, '0', STR_PAD_LEFT); // CS-000001
    }

    public function generateAdmissionNumber()
    {
        $prefix = 'AD-';
        $lastRecord = User::orderBy('id', 'desc')->first();
        if ($lastRecord) {
            $lastRollNumber = intval(substr($lastRecord->admission_number, strlen($prefix)));
            $newRollNumber = $lastRollNumber + 1;
        } else {
            $newRollNumber = 1;
        }
        return $prefix . str_pad($newRollNumber, 6, '0', STR_PAD_LEFT); // CS-000001
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:8',
        ]);

        $student = User::create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'admission_number' => $this->generateAdmissionNumber(),
            'roll_number' => $this->generateRollNumber(),
            'admission_date' => now()->format('Y-m-d'),
            'email' => $validatedData['email'],
            'user_type' => 3,
            'class_id' => $request->class_id,
            'created_by' => Auth::user()->id,
            'password' => Hash::make($validatedData['password']),
        ]);

        $parentStudent = new parentStudent();
        $parentStudent->parent_id = $request->parent_id;
        $parentStudent->student_id = $student->id;
        $parentStudent->save();

        return redirect()->route('admins.students.index')->with('success', 'Student added successfully');
    }

    /**
     * Display the specified resource.
     */
    // public function show(User $user)
    // {
    //     $data['header_title'] = 'Student Profile';
    //     // $data['user'] = $user;
    //     return view('profile.show',$data);
    // }

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
        if (Auth::user()->user_type == 1) {
            $user->is_deleted = 1;
            $user->save();
        }
        return redirect()->route('admins.students.index')->with('success', 'Student deleted successfully');
    }

    public function restore(User $user)
    {
        if (Auth::user()->user_type == 1) {
            $user->is_deleted = 0;
            $user->save();
        }
        return redirect()->route('admins.students.index')->with('success', 'Student Restored successfully');
    }


    public function studentTeacher()
    {
        $data['header_title'] = 'Student Assigned Teachers';
        $data['getStudentTeachers'] = User::getStudentTeachers();
        return view('student.student-teacher', $data);
    }
}
