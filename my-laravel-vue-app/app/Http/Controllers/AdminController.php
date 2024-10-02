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
        // Fetch all users and pass the data to the Vue component via Inertia
        $users = User::all();
        return Inertia::render('Admin/UsersIndex', [
            'users' => $users
        ]);
    }

// Show details of a specific user
public function show($id)
{
return User::findOrFail($id);
}

// Delete a user (teacher or student)
public function destroy($id)
{
$user = User::findOrFail($id);
$user->delete();
return response()->json(['message' => 'User deleted successfully!']);
}
}
?>