<x-guest-layout>
    <div class="login-container">
        <div class="form-wrapper">
            <div class="login-card">
                <!-- Logo -->
                <div class="logo-container">
                    <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="logo">
                    <hr class="logo-divider">
                </div>

                <!-- Title -->
                <h2 class="login-title">LOGIN</h2>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Username Input -->
                    <div class="form-group">
                        <input type="text"
                               name="email"
                               class="form-input"
                               placeholder="Nama pengguna"
                               required
                               autofocus>
                        <span class="input-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </span>
                    </div>

                    <!-- Password Input -->
                    <div class="form-group">
                        <input type="password"
                               name="password"
                               id="password"
                               class="form-input"
                               placeholder="Kata sandi"
                               required>
                        <button type="button"
                                class="password-toggle"
                                onclick="togglePassword()">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </button>
                    </div>

                    <!-- Remember Me -->
                    <div class="remember-me">
                        <input type="checkbox"
                               id="remember"
                               name="remember"
                               class="checkbox-input">
                        <label for="remember" class="checkbox-label">
                            Ingat saya
                        </label>
                    </div>

                    <!-- Login Button -->
                    <button type="submit" class="login-button">
                        Login
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const password = document.getElementById('password');
            const icon = document.querySelector('.password-toggle svg');

            if (password.type === 'password') {
                password.type = 'text';
                icon.innerHTML = `
                    <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                    <line x1="1" y1="1" x2="23" y2="23"></line>
                `;
            } else {
                password.type = 'password';
                icon.innerHTML = `
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                    <circle cx="12" cy="12" r="3"></circle>
                `;
            }
        }
    </script>
</x-guest-layout>
