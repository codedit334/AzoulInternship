<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // Show all students
    public function index()
    {
        $students = User::where('role', 'student')->get();
        return view('students.index', compact('students'));
    }

    // Show assigned teacher
    public function myTeacher()
    {
        $student = auth()->user(); // Get the authenticated student
        $teacher = User::find($student->teacher_id); // Get the student's teacher
        return view('students.my_teacher', compact('teacher'));
    }

    // Show similar students (students with the same teacher)
    public function similarStudents()
    {
        $student = auth()->user();
        $students = User::where('teacher_id', $student->teacher_id)
                        ->where('id', '!=', $student->id) // Exclude the current student
                        ->get();
        return view('students.similar_students', compact('students'));
    }
}