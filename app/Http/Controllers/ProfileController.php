<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function show(User $user)
    {
        $data['header_title'] = "Admin Profile";
        $data['user'] = $user;
        return view('profile.show', $data);
    }

    public function teacherProfile(User $user)
    {
        $data['header_title'] = "Teacher Profile";
        $data['user'] = $user;
        return view('profile.show', $data);
    }
    public function studentProfile(User $user)
    {
        $data['header_title'] = "Student Profile";
        $data['user'] = $user;
        return view('profile.show', $data);
    }

    public function parentProfile(User $user)
    {
        $data['header_title'] = "Parent Profile";
        $data['user'] = $user;
        return view('parent.profile', $data);
    }

    public function edit(User $user)
    {
        $data['header_title'] = "Update Profile";
        $data['user'] = $user;
        return view('profile.edit', $data);
    }
    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request)
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return redirect()->route('admins.index')->with('success', 'Profile has been updated');
    }


    public function change_password()
    {
        $data['header_title'] = "Change Password";

        return view('profile.change_password',$data);
    }

    public function update_password(Request $request, User $user) 
    {
       $user = User::find(Auth::user()->id);
       if(Hash::check($request->old_password, $user->password)){
        $user->password = Hash::make($request->new_password);
        $user->save();
        Auth::logout();
        return redirect()->to('/')->with('success', 'Password has been changed');
       }else
       {
            return redirect()->back()->with('error', 'Old Password is not match');
       }
        return Redirect::route('profile.change_password')->with('status', 'profile-updated');
    }


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
