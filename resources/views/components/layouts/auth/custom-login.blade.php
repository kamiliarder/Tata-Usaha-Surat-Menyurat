<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
        <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
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
                            <img src="{{ asset('assets/logo.png') }}" alt="{{ config('app.name') }} Logo" class="logo" />
                        </div>
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
        @fluxScripts
    </body>
</html>
