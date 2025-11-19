<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
        @livewireStyles
        <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
        <!-- Google Font AFACAD -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Afacad:wght@400;500;600;700&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="login-container login-bg">
            <!-- Left side with image -->
            <div class="building-image-container">
                <img src="{{ asset('assets/left-image.png') }}" alt="Building" class="building-image" />
            </div>

            <!-- Right side with login form -->
            <div class="form-container">
                <div class="form-wrapper">
                    <!-- Form container with white background -->
                    <div class="login-card">
                        <!-- Logo inside card -->
                        <div class="logo-container">
                            <a href="{{ url('/') }}"><img src="{{ asset('assets/logo.png') }}" alt="{{ config('app.name') }} Logo" class="logo"/></a>
                        </div>
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
        @livewireScripts
        @fluxScripts
    </body>
</html>
