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
    $assignedStudents = $teacher->students; // Using the relationship

    // Fetch students NOT assigned to this teacher
    $unassignedStudents = User::where('role', 'student') // Assuming 'role' column distinguishes roles
                                ->where(function ($query) use ($teacher) {
                                    $query->where('teacher_id', '!=', $teacher->id)
                                          ->orWhereNull('teacher_id'); // Include students with null teacher_id
                                })
                                ->get();
                            
    // Return Inertia response with the data
    return Inertia::render('Teachers/MyStudents', [
        'assignedStudents' => $assignedStudents,
        'unassignedStudents' => $unassignedStudents,
    ]);

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
     }
     
     // Assign an unassigned student to the current teacher
     public function assignStudent(Request $request, $id)
{
     // Get the currently authenticated teacher
     $teacher = auth()->user(); // Get the authenticated user

    // Find the student and assign the teacher
    $student = User::findOrFail($id);
    $student->teacher_id = $teacher->id;
    $student->save();

    return redirect()->back()->with('success', 'Student assigned successfully.');
}

     // Unassign a student from the current teacher
     public function unassignStudent($id)
{
    // Get the authenticated teacher
    $teacher = auth()->user();

    // Find the student
    $student = User::where('role', 'student')->findOrFail($id);

    // Ensure the student is currently assigned to this teacher
    if ($student->teacher_id == $teacher->id) {
        // Unassign the student
        $student->teacher_id = null;
        $student->save();

        return redirect()->back()->with('success', 'Student unassigned successfully.');
    }

    return redirect()->back()->with('error', 'You cannot unassign this student.');
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