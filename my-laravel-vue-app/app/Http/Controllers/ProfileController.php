<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    public function show()
    {
        return view('profile');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Validate the input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'lvl' => 'required|integer',
            'city' => 'required|string|max:255',
            'sex' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'current_password' => 'required|string',
            'new_password' => 'nullable|string|min:8|confirmed',
        ]);

        // Update the user's information
       // Check if current password is correct
       if (!Hash::check($request->current_password, $user->password)) {
        return back()->withErrors(['current_password' => 'Current password is incorrect.']);
    }

    // Update user details
    $user->name = $request->name;
    $user->email = $request->email;
    $user->lvl = $request->lvl;
    $user->city = $request->city;
    $user->sex = $request->sex;
    $user->address = $request->address;

    // Update subject if role is teacher
    if ($user->role === 'teacher') {
        $user->subject = $request->subject;
    }

    // Update password if new password is provided
    if ($request->new_password) {
        $user->password = Hash::make($request->new_password);
    }

    $user->save();

    return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}