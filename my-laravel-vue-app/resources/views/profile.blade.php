<nav class="navbar" style=" margin-bottom: 55px; ">
    <div class="navbar-content">
        @auth
        <span class="user-name">Hello, {{ Auth::user()->name }}</span>
        <a href="{{ route('profile') }}" class="profile-link">My Profile</a>
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="logout-button">Logout</button>
        </form>
        @else
        <a href="{{ route('login') }}" class="login-link">Login</a>
        @endauth
    </div>
</nav>

@extends('layouts.app')

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

@section('content')
<div class="profile-container">

    <h1 class="title">My Profile</h1>

    <!-- Display current profile picture -->
    <div class="profile-picture">
        @if (Auth::user()->profile_picture)
        <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile Picture" class="profile-img">
        @else
        <img src="{{ asset('images/default-profile.png') }}" alt="Default Profile Picture" class="profile-img">
        @endif
    </div>

    <!-- Profile Update Form -->
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" required>
        </div>

        <div class="form-group">
            <label for="lvl">Level</label>
            <input type="number" id="lvl" name="lvl" value="{{ old('lvl', Auth::user()->lvl) }}" min="1" max="6"
                required>
        </div>

        <div class="form-group">
            <label for="city">City</label>
            <input type="text" id="city" name="city" value="{{ old('city', Auth::user()->city) }}" required>
        </div>

        <div class="form-group">
            <label for="sex">Sex</label>
            <input type="text" id="sex" name="sex" value="{{ old('sex', Auth::user()->sex) }}" required>
        </div>

        @if (Auth::user()->role === 'admin' || Auth::user()->role === 'teacher')
        <div class="form-group">
            <label for="subject">Subject</label>
            <input type="text" id="subject" name="subject" value="{{ old('subject', Auth::user()->subject) }}">
        </div>
        @endif

        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" id="address" name="address" value="{{ old('address', Auth::user()->address) }}" required>
        </div>

        <!-- Add file input for profile picture -->
        <div class="form-group">
            <label for="profile_picture">Profile Picture</label>
            <input type="file" id="profile_picture" name="profile_picture" accept="image/*">
        </div>

        <div class="form-group">
            <label>Role</label>
            <input type="text" value="{{ Auth::user()->role }}" disabled>
        </div>

        <h2 class="password-title">Change Password</h2>

        <div class="form-group">
            <label for="current_password">Current Password</label>
            <input type="password" id="current_password" name="current_password" required>
        </div>

        <div class="form-group">
            <label for="new_password">New Password</label>
            <input type="password" id="new_password" name="new_password" required>
        </div>

        <div class="form-group">
            <label for="new_password_confirmation">Confirm New Password</label>
            <input type="password" id="new_password_confirmation" name="new_password_confirmation" required>
        </div>

        <button type="submit" class="save-button">Save Changes</button>
    </form>
</div>
@endsection


<style>
.profile-container {
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

.password-title {
    margin-top: 20px;
    color: #3498db;
    /* Change this to your preferred color */
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

.form-group input {
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.save-button {
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

.save-button:hover {
    background-color: #2980b9;
}

/* Styling for profile picture */
.profile-picture {
    text-align: center;
    margin-bottom: 20px;
}

.profile-img {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #ddd;
}
</style>