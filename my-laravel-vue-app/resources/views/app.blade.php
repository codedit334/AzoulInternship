<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @routes
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead

    <style>
    body {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        position: relative;
        left: 60px;
        width: calc(100% - 60px)
    }

    .vsm--icon {
        display: none;
        color: lightgrey !important;
        background-color: #4b5563 !important;
    }

    .navbar {
        background-color: #3498db;
        /* padding: 15px 0 15px 15px; */
        padding: 15px;
        justify-content: flex-end;
        align-items: center;
        margin-bottom: 55px;
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

    .profile-link {
        color: white;
        text-decoration: none;
        font-size: 16px;
        padding: 8px 12px;
        border: 1px solid white;
        border-radius: 4px;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .profile-link:hover {
        background-color: white;
        color: #3498db;
    }

    .logout-button {
        background-color: #e74c3c;
        color: white;
        border: none;
        padding: 8px 12px;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .logout-button:hover {
        background-color: #c0392b;
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

</head>

<body class="font-sans antialiased">
    <nav class="navbar">
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

    @yield('scripts')
    @inertia
</body>

</html>

<style>

</style>