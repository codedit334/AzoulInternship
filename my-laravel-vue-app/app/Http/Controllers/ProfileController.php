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
        ]);

        // Update the user's information
        $user->update($request->only(['name', 'email', 'lvl', 'city', 'sex', 'subject', 'address']));

        return redirect()->route('profile')->with('success', 'Profile updated successfully');
    }
}