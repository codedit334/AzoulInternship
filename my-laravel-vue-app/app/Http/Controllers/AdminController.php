<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Show all users
    public function index()
    {
        $users = User::all();
        return view('admin.index', compact('users'));
    }

    // Show specific user (teacher or student)
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.show_user', compact('user'));
    }

    // Create a new user (teacher or student)
    public function create()
    {
        return view('admin.create_user');
    }

    // Store a new user
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:teacher,student',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.index')->with('success', 'User created successfully.');
    }

    // Delete a user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.index')->with('success', 'User deleted successfully.');
    }
}