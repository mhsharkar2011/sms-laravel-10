<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        // dd(Hash::make(12345678));
        if(!empty(Auth::check())){
            return redirect('admin/dashboard');
        }
            return view('auth.login');
    }

    public function AuthLogin(Request $request)
    {
        // dd($request->all());

        $remember = !empty($request->remember) ? true : false;
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            return redirect('admin/dashboard');
        } else {
            return redirect()->back()->with('error', 'Please enter correct email and password');
        }
    }

    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $admins = User::all();
    //     return view('admin.admin.list',compact('admins'));
    // }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //dd(Hash::make(123456));
        if (!empty(Auth::check())) {
            return redirect('admin/dashboard');
        }
        return view('auth.login');
    }

    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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