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

    <style>
    body {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    form {
        margin: 0;
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

<body class="fixed-background img-1">
    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>

<style>
body {
    padding: 0;
    margin: 0 !important;
}

/* BG image */
.fixed-background {
    height: 120vh;
    --bg-image: url("https://picsum.photos/2016/1642?image=10");
    --start-color: #09f;
    --stop-color: #90f;
    background-position: center;
    background-size: cover;
    background-image: linear-gradient(to bottom,
            var(--start-color),
            var(--stop-color)),
        var(--bg-image);
    background-attachment: fixed;
    background-blend-mode: overlay, exclusion;
}

.img-1 {
    /* --start-color: #7c87a8;
    --stop-color: #ff0028; */
    --start-color: #ff0028;
    --stop-color: #7c87a8;
    --bg-image: url("https://picsum.photos/2016/1642?image=30");
    /* --bg-image: url("https://picsum.photos/2016/1642?image=40"); */
}
</style>