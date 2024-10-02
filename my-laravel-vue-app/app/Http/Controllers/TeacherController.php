<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
{
    // $students = Student::all(); // Get all students
    // return view('teacher.dashboard', compact('students'));
    
    $students = User::where('role', 'student')->get();
    return view('teachers.index', compact('students'));
}

public function myStudents()
    {
        $teacherId = auth()->id(); // Get the authenticated teacher's ID
        $students = User::where('teacher_id', $teacherId)->get(); // Assuming you have a teacher_id field in the users table
        return view('teachers.my_students', compact('students'));
    }

    // Add a new student
    public function create()
    {
        return view('teachers.create_student');
    }

    // Store a new student
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $student = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'student',
            'teacher_id' => auth()->id(), // Assign the authenticated teacher as the student’s teacher
        ]);

        return redirect()->route('teachers.my_students')->with('success', 'Student added successfully.');
    }

    // Delete a student
    public function destroy($id)
    {
        $student = User::findOrFail($id);
        $student->delete();
        return redirect()->route('teachers.my_students')->with('success', 'Student deleted successfully.');
    }

}