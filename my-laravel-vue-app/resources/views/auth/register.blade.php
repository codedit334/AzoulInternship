<!-- resources/views/auth/register.blade.php -->
@extends('layouts.app')

@section('content')
<div class="register-container">
    <h1 class="title">Register</h1>
    <form action="{{ route('register') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>

        <div class="form-group">
            <label for="role">Role</label>
            <select id="role" name="role" required
                onchange="document.getElementById('subject-group').style.display = this.value === 'teacher' ? 'block' : 'none';">
                <option value="" disabled selected>Select your role</option>
                <option value="student">Student</option>
                <option value="teacher">Teacher</option>
            </select>
        </div>

        <div class="form-group">
            <label for="lvl">Level</label>
            <input type="number" id="lvl" name="lvl" value="{{ old('lvl') }}" min="1" max="6" required>
        </div>

        <div class="form-group">
            <label for="city">City</label>
            <input type="text" id="city" name="city" value="{{ old('city') }}" required>
        </div>

        <div class="form-group">
            <label for="sex">Sex</label>
            <input type="text" id="sex" name="sex" value="{{ old('sex') }}" required>
        </div>

        <div class="form-group" id="subject-group" style="display: none;">
            <label for="subject">Subject</label>
            <input type="text" id="subject" name="subject" value="{{ old('subject') }}">
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" id="address" name="address" value="{{ old('address') }}" required>
        </div>

        <button type="submit" class="register-button">Register</button>
    </form>
</div>

@section('scripts')
<script>
// Optional: If you want to ensure the subject field is hidden initially based on role selection
document.addEventListener('DOMContentLoaded', function() {
    const roleSelect = document.getElementById('role');
    const subjectGroup = document.getElementById('subject-group');
    subjectGroup.style.display = roleSelect.value === 'teacher' ? 'block' : 'none';
});
</script>
@endsection

@endsection

<style>
.register-container {
    max-width: 600px;
    margin: 20px auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.title {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

.form-group input,
.form-group select {
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.register-button {
    display: block;
    width: 100%;
    padding: 10px;
    background-color: #3498db;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.register-button:hover {
    background-color: #2980b9;
}
</style>