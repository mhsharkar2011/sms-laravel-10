<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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
        $data['getAdmin'] = User::getAdmin();
        return view('admin.admin-list',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['header_title'] = 'Admin Create';
        return view('admin.admin-create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validate incoming request data
    // $validatedData = $request->validate([
    //     'name' => 'required|string|max:255',
    //     'email' => 'required|email|unique:users|max:255',
    //     'password' => 'required|string|min:8', // You may need to adjust this based on your requirements
    // ]);

    // Create a new user with validated data
    // User::create([
    //     'name' => $validatedData['name'],
    //     'email' => $validatedData['email'],
    //     'user_type' => 1, // Assuming the default user type is 1 for admins
    //     'password' => bcrypt($validatedData['password']), // Hash the password for security
    // ]);

    // Redirect back with success message
    $user = new User();
    $user->name = trim($request->name);
    $user->email = trim($request->email);
    $user->password = Hash::make($request->password);
    $user->user_type = 1;
    $user->save();
    return redirect()->route('admins.create')->with('success', 'User added successfully');
}


    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('admin.admin-show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.admin-edit',compact('user'));        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $input = $request->except('avatar');

        if ($user->avatar && $request->hasFile('avatar')) {
            Storage::delete('public/avatars/' . $user->avatar);
            $user->avatar = null;
        }
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = $user->id . '-' . $user->name . '-' . date('Ymd') . '.' . $avatar->getClientOriginalExtension();
            $avatar->storeAs('public/avatars', $filename);
            $user->avatar = $filename;
            $user->save();
        }

        $user->update($input);
        return redirect()->route('admins.index')->with('success','User Info Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->is_delete = 1;
        $user->save();
        return redirect()->route('admins.index')->with('success','User deleted successfully');
    }
}
