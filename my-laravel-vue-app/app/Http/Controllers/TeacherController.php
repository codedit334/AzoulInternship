<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
{
    $students = Student::all(); // Get all students
    return view('teacher.dashboard', compact('students'));
}

public function store(Request $request)
{
    // Validate and add a student
}

public function destroy($id)
{
    // Delete a student
}

}