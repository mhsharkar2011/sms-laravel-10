<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{

    public function showProfile($id)
    {
        $data['header_title'] = "Profile";
        $data['user'] = User::getSingleUser($id);
        return view('profile.show', $data);
    }

    public function editProfile(User $user)
    {
        $data['header_title'] = "Update Profile";
        $data['user'] = $user;
        return view('profile.edit', $data);
    }

    public function updateProfile(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'required|string|min:8',
            'email' => 'required|email|unique:users|max:255'.$user->id,
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
        return redirect()->back()->with('success', 'User Info Updated Successfully');
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

    // public function destroy(Request $request): RedirectResponse
    // {
    //     $request->validateWithBag('userDeletion', [
    //         'password' => ['required', 'current_password'],
    //     ]);
    //     $user = $request->user();
    //     Auth::logout();
    //     $user->delete();
    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();
    //     return Redirect::to('/');
    // }


    public function destroyProfile(User $user)
    {
        $user->is_deleted = 1;
        $user->save();
        return redirect()->back()->with('success', 'User deleted successfully');
    }

    public function restoreProfile(User $user)
    {
        $user->is_deleted = 0;
        $user->save();
        return redirect()->back()->with('success', 'User Restored successfully');
    }
}
