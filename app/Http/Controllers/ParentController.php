<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ParentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['header_title'] = 'Parent List';
        $data['getRecord'] = User::getParent();
        return view('parent.parent-list',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['header_title'] = 'Parent List';
        return view('parent.parent-create',$data);
    }


    public function generateParentId()
    {
        $prefix = 'P-';
        $lastRecord = User::orderBy('id', 'desc')->first();
        if ($lastRecord) {
            $lastParentId = intval(substr($lastRecord->parent_id, strlen($prefix)));
            $newParentId = $lastParentId + 1;
        } else {
            $newParentId = 1;
        }
        return $prefix . str_pad($newParentId, 6, '0', STR_PAD_LEFT); // CS-000001
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
            'user_type' => 4,
            'parent_id' => $this->generateParentId(),
            'created_by' => Auth::user()->id,
            'password' => Hash::make($validatedData['password']),
        ]);

        return redirect()->route('admins.parents.index')->with('success', 'Parent added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $data['header_title'] = 'Parent Profile Show';
        $data['user'] = $user; 
        return view('profile.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $data['header_title'] = 'Parent Profile Edit';
        $data['user'] = "";
        return view('profile.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $id)
    {
        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            //'email' => 'required|email|unique:users|max:255'.$user->id,
            //'password' => 'required|string|min:8',
        ]);

        $input = Arr::except($validatedData, 'avatar');

        if ($id->avatar && $request->hasFile('avatar')) {
            Storage::delete('public/avatars' . $id->avatar);
            $id->avatar = null;
        }
        if (!empty($request->email)) {
            $id->email = $request->email;
            $id->save();
        }
        if (!empty($request->password)) {
            $id->password = Hash::make($request->password);
            $id->save();
        }
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = $id->id . '-' . $id->name . '-' . date('Ymd_Hsi') . '.' . $avatar->getClientOriginalExtension();
            $avatar->storeAs('public/avatars', $filename);
            $id->avatar = $filename;
            $id->save();
        }

        $id->update($input);
        return redirect()->route('admins.parents.index')->with('success', 'Parent Info Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $id)
    {
        if(Auth::user()->user_type == 4){
            $id->is_deleted = 1;
            $id->save();
        }
        return redirect()->route('admins.parents.index')->with('success', 'Parents deleted successfully');
    }

    public function restore(User $id)
    {
        if(Auth::user()->user_type == 4){
        $id->is_deleted = 0;
        $id->save();
        }
        return redirect()->route('admins.parents.index')->with('success', 'Parents Restored successfully');
    }
}
