<x-guest-layout>
    <!-- Google Font AFACAD -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Afacad:wght@400;500;600;700&display=swap" rel="stylesheet">

    <div class="login-container">
        <div class="form-wrapper">
            <div class="login-card">
                <!-- Logo -->
                <div class="logo-container">
                    <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="logo">
                </div>

                <!-- Title -->
                <h2 class="login-title">LOGIN</h2>

                <form method="POST" action="{{ route('login') }}" novalidate id="loginForm" class="login-form">
                    @csrf

                    <!-- Username Input -->
                    <div class="form-group">
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                            </span>
                            <input type="text"
                                   name="email"
                                   id="email"
                                   class="form-input"
                                   placeholder="Nama pengguna"
                                   autofocus>
                        </div>
                        <span class="field-error" id="email-error"></span>
                    </div>

                    <!-- Password Input - No Lock Icon -->
                    <div class="form-group">
                        <div class="input-wrapper">
                            <input type="password"
                                   name="password"
                                   id="password"
                                   class="form-input form-input-password"
                                   placeholder="Kata sandi">
                            <button type="button"
                                    class="password-toggle"
                                    onclick="togglePassword()">
                                <svg id="eye-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </button>
                        </div>
                        <span class="field-error" id="password-error"></span>
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
            const icon = document.getElementById('eye-icon');

            if (password.type === 'password') {
                password.type = 'text';
                icon.innerHTML = `
                    <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24" stroke-width="2"></path>
                    <line x1="1" y1="1" x2="23" y2="23" stroke-width="2"></line>
                `;
            } else {
                password.type = 'password';
                icon.innerHTML = `
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" stroke-width="2"></path>
                    <circle cx="12" cy="12" r="3" stroke-width="2"></circle>
                `;
            }
        }

        // Auto-hide error messages after 5 seconds
        function autoHideError(errorElement, inputElement) {
            if (errorElement && errorElement.textContent.trim() !== '') {
                setTimeout(() => {
                    errorElement.classList.add('fade-out');
                    setTimeout(() => {
                        errorElement.textContent = '';
                        errorElement.classList.remove('fade-out');
                        if (inputElement) {
                            inputElement.classList.remove('input-error');
                        }
                    }, 300);
                }, 5000);
            }
        }

        // Form validation
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('loginForm');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const emailError = document.getElementById('email-error');
            const passwordError = document.getElementById('password-error');

            form.addEventListener('submit', function(e) {
                let isValid = true;
                
                // Clear previous errors
                emailError.textContent = '';
                passwordError.textContent = '';
                emailError.classList.remove('fade-out');
                passwordError.classList.remove('fade-out');
                emailInput.classList.remove('input-error');
                passwordInput.classList.remove('input-error');

                // Validate email
                if (!emailInput.value.trim()) {
                    emailError.textContent = 'Email tidak boleh kosong';
                    emailInput.classList.add('input-error');
                    autoHideError(emailError, emailInput);
                    isValid = false;
                }

                // Validate password
                if (!passwordInput.value.trim()) {
                    passwordError.textContent = 'Password tidak boleh kosong';
                    passwordInput.classList.add('input-error');
                    autoHideError(passwordError, passwordInput);
                    isValid = false;
                }

                // If validation fails, prevent form submission
                if (!isValid) {
                    e.preventDefault();
                    e.stopPropagation();
                }
            });

            // Clear error on input
            emailInput.addEventListener('input', function() {
                if (emailInput.value.trim()) {
                    emailError.classList.add('fade-out');
                    setTimeout(() => {
                        emailError.textContent = '';
                        emailError.classList.remove('fade-out');
                        emailInput.classList.remove('input-error');
                    }, 300);
                }
            });

            passwordInput.addEventListener('input', function() {
                if (passwordInput.value.trim()) {
                    passwordError.classList.add('fade-out');
                    setTimeout(() => {
                        passwordError.textContent = '';
                        passwordError.classList.remove('fade-out');
                        passwordInput.classList.remove('input-error');
                    }, 300);
                }
            });
        });
    </script>
</x-guest-layout>
                    }, 300);
                }
            });
        });
    </script>
</x-guest-layout>
