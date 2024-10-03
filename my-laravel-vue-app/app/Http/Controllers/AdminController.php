<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        $user->lvl = $request->level;
        
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
        ]);

        // Create a new student
        $student = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'teacher_id' => $request->teacher_id,
            'role' => 'student',
        ]);

        // Fire the Registered event to send email verification
        event(new Registered($student));

        return redirect()->route('admin.index')->with('success', 'Student created successfully!');
    }
}
?>