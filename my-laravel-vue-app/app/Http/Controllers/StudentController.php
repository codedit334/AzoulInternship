<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        {
            // Get the currently authenticated student
            $student = auth()->user();
    
            // Get the teacher assigned to this student
            $teacher = User::find($student->teacher_id);
    
            // Get students with the same teacher (excluding the current student)
            $similarStudents = User::where('teacher_id', $student->teacher_id)
                                    ->where('id', '!=', $student->id) // Exclude the current student
                                    ->get();
    
            // Get all students
            $allStudents = User::where('role', 'student')->get();
    
            // Return Inertia response with the data
            return Inertia::render('Students/Index', [
                'teacher' => $teacher,
                'similarStudents' => $similarStudents,
                'allStudents' => $allStudents,
            ]);
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        $validated['role'] = 'student';

        return User::create($validated);
    }

    public function show($id)
    {
        return User::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validated = $request->validate([
            'name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users,email,' . $user->id,
        ]);

        if ($request->has('password')) {
            $validated['password'] = bcrypt($request->password);
        }

        $user->update($validated);
        return $user;
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->noContent();
    }
}