<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['header_title'] = 'Admin List';
        $data['getUser'] = User::getUser();
        return view('admin.admin-list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['header_title'] = 'User Create';
        return view('admin.admin-create', $data);
    }

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
            'user_type' => $request->user_type,
            'created_by' => Auth::user()->id,
            'password' => Hash::make($validatedData['password']),
        ]);

        return redirect()->route('admins.create')->with('success', 'User added successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $header_title = 'Profile';
        return view('profile.edit', compact('header_title', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $data['header_title'] = 'Profile Edit';
        $data['user'] = $user;
        return view('admin.admin-edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'required|string|min:8',
            // 'email' => 'required|email|unique:users|max:255'.$user->id,
        ]);

        $input = Arr::except($validatedData, 'avatar');

        if ($user->avatar && $request->hasFile('avatar')) {
            Storage::delete('public/avatars/' . $user->avatar);
            $user->avatar = null;
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
        return redirect()->route('admins.index')->with('success', 'User Info Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->is_delete = 1;
        $user->save();
        return redirect()->route('admins.index')->with('success', 'User deleted successfully');
    }
}
