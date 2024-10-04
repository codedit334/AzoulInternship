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

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;



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
            'address' => 'required|string|max:255',
            'current_password' => 'required|string',
            'new_password' => 'nullable|string|min:8|confirmed',
            'subject' => [
            'nullable', // Allow null value
            'string',
            'max:255',
            // Conditionally require subject if the user is a teacher
            Rule::requiredIf($user->role === 'teacher'),
        ],
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the profile picture

        ]);


        // Update the user's information
       // Check if current password is correct
       if (!Hash::check($request->current_password, $user->password)) {
        return back()->with(['error' => 'Current password is incorrect.']);
        }

        // Handle file upload
    if ($request->hasFile('profile_picture')) {
        // Delete the old profile picture if it exists
        if ($user->profile_picture) {
            Storage::delete($user->profile_picture);
        }

        // Store the new profile picture
        $filePath = $request->file('profile_picture')->store('profile_pictures', 'public');
        $user->profile_picture = $filePath;
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