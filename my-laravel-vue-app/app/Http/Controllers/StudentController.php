<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
{
    $teachers = Teacher::all(); // Get all teachers
    return view('student.dashboard', compact('teachers'));
}
}