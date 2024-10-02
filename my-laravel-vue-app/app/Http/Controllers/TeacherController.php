<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TeacherController extends Controller
{
    // Get all teachers
    public function index()
    {
        $teachers = User::where('role', 'teacher')->get();

        return Inertia::render('Teachers/Index', [
            'teachers' => $teachers,
        ]);
    }

    public function myStudents()
{
    // Get the currently authenticated teacher
    $teacher = auth()->user();

    // Fetch students assigned to this teacher
    $students = $teacher->students; // Using the relationship

    // Return Inertia response with the data
    return Inertia::render('Teachers/MyStudents', [
        'students' => $students,
    ]);
}
    
    // Store a new teacher
    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users',
    //         'password' => 'required|string|min:8',
    //     ]);

    //     $validated['password'] = Hash::make($validated['password']);
    //     $validated['role'] = 'teacher';

    //     return User::create($validated);
    // }

    // // Show a specific teacher
    // public function show($id)
    // {
    //     return User::findOrFail($id);
    // }

    // // Update a teacher's information
    // public function update(Request $request, $id)
    // {
    //     $user = User::findOrFail($id);
        
    //     $validated = $request->validate([
    //         'name' => 'sometimes|string|max:255',
    //         'email' => 'sometimes|string|email|max:255|unique:users,email,' . $user->id,
    //         'password' => 'sometimes|string|min:8',
    //     ]);

    //     if ($request->has('password')) {
    //         $validated['password'] = Hash::make($validated['password']);
    //     }

    //     $user->update($validated);
    //     return response()->json(['message' => 'Teacher updated successfully!', 'teacher' => $user]);
    // }

    // // Delete a teacher
    // public function destroy($id)
    // {
    //     $user = User::findOrFail($id);
    //     $user->delete();
    //     return response()->json(['message' => 'Teacher deleted successfully!']);
    // }
}