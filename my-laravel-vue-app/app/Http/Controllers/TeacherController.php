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
     // Show the form to create a new student
     public function create()
     {
         return Inertia::render('Teachers/CreateStudent');
     }
 
     // Store a new student in the database
     public function store(Request $request)
     {
         // Validate the incoming request data
         $request->validate([
             'name' => 'required|string|max:255',
             'email' => 'required|string|email|max:255|unique:students',
             'teacher_id' => 'required|exists:users,id', // Ensure the teacher exists
         ]);
 
         // Create a new student
         Student::create($request->all());
 
         // Redirect back to the student's list with a success message
         return redirect()->route('teachers.my_students')->with('success', 'Student created successfully!');
     }
 
     // Delete a student
     public function destroy($id)
     {
         // Find the student by ID
         $student = Student::findOrFail($id);
         $student->delete();
 
         // Return a JSON response
         return response()->json(['message' => 'Student deleted successfully!']);
     }
}