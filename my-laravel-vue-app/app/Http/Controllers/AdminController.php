<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
// Get all users (teachers and students)
public function index()
    {
        // Fetch all teachers and students
        $teachers = User::where('role', 'teacher')->get();
        $students = User::where('role', 'student')->get();

        // Return Inertia response with the data
        return Inertia::render('Admin/Index', [
            'teachers' => $teachers,
            'students' => $students,
        ]);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('message', 'User deleted successfully!');
    }

    public function createTeacher()
    {
        return Inertia::render('Admin/CreateTeacher');
    }

    public function storeTeacher(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            // Add additional validations as needed
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'teacher', // Assign the role as 'teacher'
        ]);

        return redirect()->route('admin.index')->with('message', 'Teacher created successfully!');
    }

    public function createStudent()
    {
        return Inertia::render('Admin/CreateStudent');
    }

    public function storeStudent(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            // Add additional validations as needed
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'student', // Assign the role as 'student'
        ]);

        return redirect()->route('admin.index')->with('message', 'Student created successfully!');
    }
}
?>