<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
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

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>

<style>
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