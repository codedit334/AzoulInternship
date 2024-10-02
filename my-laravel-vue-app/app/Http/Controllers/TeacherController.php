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

    // Fetch students NOT assigned to this teacher
    $unassignedStudents = User::where('role', 'student') // Assuming 'role' column distinguishes roles
                            ->where('teacher_id', '!=', $teacher->id) // Exclude students with this teacher_id
                            ->orWhereNull('teacher_id') // Include students without any teacher
                            ->get();
                            
    // Return Inertia response with the data
    return Inertia::render('Teachers/MyStudents', [
        'students' => $students,
        'unassignedStudents' => $unassignedStudents,
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
        //  $request->validate([
        //      'name' => 'required|string|max:255',
        //      'email' => 'required|string|email|max:255|unique:users',
        //      'teacher_id' => 'required|exists:users,id', // Ensure the teacher exists
        //  ]);
 
        //  // Create a new student
        //  User::create($request->all());


         // Validate the request
    // $validatedData = $request->validate([
    //     'name' => 'required|string|max:255',
    //     'email' => 'required|string|email|max:255|unique:users',
    //     'teacher_id' => 'required|exists:users,id', // Ensure the teacher exists
    // ]);

    // create test object
    $validatedData = [
        'name' => 'John Doe',
        'email' => 'Lp0pB@example.com',
        'teacher_id' => 1010
    ];
       
    try {
        // Create a new student
        User::create($validatedData);

        // Return a successful response
        return response()->json(['message' => 'Student created successfully!'], 201);
    } catch (QueryException $e) {
        // Handle database-related errors
        return response()->json(['error' => 'Database error: ' . $e->getMessage()], 500);
    } catch (\Exception $e) {
        // Handle other errors
        return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
    }
 
         // Redirect back to the student's list with a success message
        //  return redirect()->route('teachers.my_students')->with('success', 'Student created successfully!');
     }
 
     // Delete a student
     public function destroy($id)
     {
         // Find the student by ID
         $student = User::findOrFail($id);
         $student->delete();
 
         // Return a JSON response
         return response()->json(['message' => 'Student deleted successfully!']);
     }
}