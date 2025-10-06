<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Afacad:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                font-family: 'Afacad', sans-serif;
                background-image: url("{{ asset('assets/bg-login.png') }}");
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
            }

            .login-button {
                width: 100%;
                padding: 0.875rem;
                background-color: #F92020;
                color: white;
                font-size: 1rem;
                font-weight: 500;
                border: none;
                border-radius: 12px;
                cursor: pointer;
                transition: background-color 0.2s ease;
            }

            .login-button:hover {
                background-color: #e31c1c;
            }

            .login-button:focus {
                outline: none;
                box-shadow: 0 0 0 2px rgba(249, 32, 32, 0.25);
            }
        </style>
    </head>
    <body>
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            {{ $slot }}
        </div>
    </body>
</html>
