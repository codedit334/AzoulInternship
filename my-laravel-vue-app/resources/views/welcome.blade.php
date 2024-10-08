<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Teacher Student Management App</title>
    @vite(['resources/js/app.js'])
</head>

<body class="fixed-background img-1">
    @extends('layouts.app')

    <div id="app"></div> <!-- Vue will mount here -->
</body>

</html>