namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
// Get all users (teachers and students)
public function index()
{
return User::all(); // Fetch all users regardless of their role
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