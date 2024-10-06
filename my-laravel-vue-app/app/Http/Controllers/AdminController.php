<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\School;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;

class AdminController extends Controller
{
    // Get all users (teachers and students)
    public function index()
    {
        // Fetch all teachers and students
        // $teachers = User::where('role', 'teacher')->get();
        
        $teachers = User::where('role', 'teacher')
                ->with('schools')  // Load schools relationship
                ->get();

        
                
        $students = User::where('role', 'student')
                ->with('schools')  // Assuming you have a `school()` relationship defined
                ->get();
        // $students = User::where('role', 'student')->get();

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

    // Display the form to create a teacher
    public function createTeacher()
    {
        return Inertia::render('Admin/CreateTeacher');
    }

    // Store a new teacher
    public function storeTeacher(Request $request)
    {
        // Validate the input fields
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'sex' => 'required|string|max:6',
            'subject' => 'nullable|string|max:255', // Subject is nullable but required if teacher
            'level' => 'required|integer|min:1|max:6',
        ]);

        // Return validation errors if any
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Create a new user (teacher)
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->address = $request->address;
        $user->city = $request->city;
        $user->sex = $request->sex;
        $user->lvl = $request->level; // Updated field name

        // Set role to 'teacher' by default for this method
        $user->role = 'teacher';

        // Set subject only if the role is 'teacher'
        if ($user->role === 'teacher') {
            $user->subject = $request->subject;
        }

        $user->save();

        // Redirect to a success page or return a success response
        return redirect()->route('admin.index')->with('success', 'Teacher created successfully!');
    }

    // Display the form to create a student
    public function createStudent()
    {
        $teachers = User::where('role', 'teacher')->get(); // Fetch all teachers
        return Inertia::render('Admin/CreateStudent', [
            'teachers' => $teachers, // Pass the teachers to the view
        ]);
    }

    // Store a new student
    public function storeStudent(Request $request)
    {
        // Validate request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'teacher_id' => 'required|exists:users,id', // Ensure the teacher exists
            'level' => 'required|integer|min:1|max:6', // Assuming levels are from 1 to 6
            'sex' => 'required|string|max:10', // 'Male', 'Female', or other options
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
        ]);

        // Create a new student
        $student = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'teacher_id' => $request->teacher_id,
            'level' => $request->level,
            'sex' => $request->sex,
            'address' => $request->address,
            'city' => $request->city,
            'role' => 'student',
        ]);

        // Fire the Registered event to send email verification
        event(new Registered($student));

        return redirect()->route('admin.index')->with('success', 'Student created successfully!');
    }

    public function editStudent($id)
{
    $student = User::findOrFail($id);
    $teachers = User::where('role', 'teacher')->get(); // Fetch all teachers

    return Inertia::render('Admin/EditStudent', [
        'student' => $student, // Pass the student data to the view
        'teachers' => $teachers, // Pass the teachers to the view
    ]);
}

public function updateStudent(Request $request, $id)
{
    
    $student = User::findOrFail($id);

    // Validate request data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $student->id,
        'password' => 'nullable|string|min:8|confirmed',
        'teacher_id' => 'required|exists:users,id', // Ensure the teacher exists
        'level' => 'required|integer|min:1|max:6', // Assuming levels are from 1 to 6
        'sex' => 'required|string|max:10', // 'Male', 'Female', or other options
        'address' => 'required|string|max:255',
        'city' => 'required|string|max:255',
    ]);


    // Update student data
    $student->name = $request->name;
    $student->email = $request->email;

    // Only update the password if it's provided
    if ($request->password) {
        $student->password = Hash::make($request->password);
    }
    

    $student->teacher_id = $request->teacher_id;
    $student->lvl = $request->level;
    $student->sex = $request->sex;
    $student->address = $request->address;
    $student->city = $request->city;
    
    $student->save();

    return redirect()->route('admin.index')->with('success', 'Student updated successfully!');
}

// Display the form to edit a teacher
public function editTeacher($id)
{
    $teacher = User::findOrFail($id); // Fetch the teacher by ID
    return Inertia::render('Admin/EditTeacher', [
        'teacher' => $teacher, // Pass the teacher data to the view
    ]);
}

// Update the teacher details
public function updateTeacher(Request $request, $id)
{
    // Validate the input fields
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,'.$id,
        'password' => 'nullable|string|min:8|confirmed',
        'address' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'sex' => 'required|string|max:6',
        'subject' => 'nullable|string|max:255',
        'level' => 'required|integer|min:1|max:6',
    ]);

    // Return validation errors if any
    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    // Find the teacher and update their details
    $teacher = User::findOrFail($id);
    $teacher->name = $request->name;
    $teacher->email = $request->email;

    // Update password only if provided
    if ($request->password) {
        $teacher->password = Hash::make($request->password);
    }

    $teacher->address = $request->address;
    $teacher->city = $request->city;
    $teacher->sex = $request->sex;
    $teacher->subject = $request->subject;
    $teacher->lvl = $request->level;

    $teacher->save(); // Save the changes

    return redirect()->route('admin.index')->with('success', 'Teacher updated successfully!');
}

public function storeSchool(Request $request)
{
    // Validate the school name
    $request->validate([
        'name' => 'required|string|max:255',
        'address' => 'required|string|max:255',
    ]);

    // Create the school
    School::create([
        'name' => $request->name,
        'address' => $request->address,
    ]);

    // Redirect with a success message
    return redirect()->route('admin.create-school')->with('success', 'School created successfully!');
}

public function createSchool()
{
    // Fetch all schools from the users table
    $schools = School::all(); // Retrieve all schools from the School model

    return Inertia::render('Admin/AddSchool', [
        'schools' => $schools, // Pass the schools to the view
    ]);
}

}