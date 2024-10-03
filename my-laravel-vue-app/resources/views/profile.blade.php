<nav class="navbar">
    <div class="navbar-content">
        @auth
        <span class="user-name">Hello, {{ Auth::user()->name }}</span>
        <a href="{{ route('profile') }}" class="profile-link">My Profile</a>
        <a action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="logout-button">Logout</button>
        </a>
        @else
        <a href="{{ route('login') }}" class="login-link">Login</a>
        @endauth
    </div>
</nav>
<div class="profile-container">

    <h1 class="title">My Profile</h1>
    <form action="{{ route('profile.update') }}" method="POST">
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

        <!-- Conditionally render the subject field for admin and teacher -->
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

        <!-- Role is not editable -->
        <div class="form-group">
            <label>Role</label>
            <input type="text" value="{{ Auth::user()->role }}" disabled>
        </div>

        <button type="submit" class="save-button">Save Changes</button>
    </form>
</div>

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

.navbar {
    background-color: #3498db;
    padding: 15px;
    display: flex;
    justify-content: flex-end;
    align-items: center;
}

.navbar-content {
    display: flex;
    gap: 15px;
    align-items: center;
}

.user-name {
    color: white;
    font-size: 16px;
}

.profile-link,
.logout-button {
    padding: 10px 15px;
    /* Adjust padding for both buttons */
    border: none;
    /* Remove border for consistency */
    border-radius: 4px;
    /* Consistent border radius */
    cursor: pointer;
    /* Pointer cursor on hover */
    transition: background-color 0.3s ease;
    /* Smooth transition on hover */
    font-size: 16px;
    /* Ensure both buttons have the same font size */
}

.profile-link {
    background-color: #3498db;
    /* Profile button background */
    color: white;
    /* Text color */
    text-decoration: none;
    /* No underline */
}

.profile-link:hover {
    background-color: white;
    /* Hover background */
    color: #3498db;
    /* Hover text color */
}

.logout-button {
    background-color: #e74c3c;
    /* Logout button background */
    color: white;
    /* Text color */
}

.logout-button:hover {
    background-color: #c0392b;
    /* Darker shade on hover */
}


.login-link {
    color: white;
    text-decoration: none;
    font-size: 16px;
    padding: 8px 12px;
    border: 1px solid white;
    border-radius: 4px;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.login-link:hover {
    background-color: white;
    color: #3498db;
}
</style>