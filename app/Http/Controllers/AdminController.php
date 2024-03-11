<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['header_title'] = 'Admin List';
        $data['admins'] = User::where('user_type',1)->get();
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
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users|max:255',
        'password' => 'required|string|min:8', // You may need to adjust this based on your requirements
    ]);

    // Create a new user with validated data
    User::create([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'user_type' => 1, // Assuming the default user type is 1 for admins
        'password' => bcrypt($validatedData['password']), // Hash the password for security
    ]);

    // Redirect back with success message
    return back()->with('success', 'User added successfully');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('admin.admin-show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
