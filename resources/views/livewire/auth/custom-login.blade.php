<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Features;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth.custom-login')] class extends Component {
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    public $successMessage = '';
    public $errorMessage = '';

    public function login(): void
    {
        // Hapus pesan sebelumnya
        $this->successMessage = '';
        $this->errorMessage = '';

        $this->validate();

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            $this->errorMessage = 'Login gagal! Email atau password salah.';
            $this->addError('email', 'Email atau password salah.');
            $this->addError('password', 'Email atau password salah.');

            // Trigger animasi shake lewat JavaScript
            $this->dispatch('login-failed');
            return;
        }

        Session::regenerate();

        // Tampilkan pesan sukses
        $this->successMessage = 'Login berhasil! Mengarahkan ke dashboard...';

        // Redirect setelah tampilkan pesan sukses
        $this->js('
            setTimeout(() => {
                window.location.href = "' . route('dashboard') . '";
            }, 2000);
        ');
    }
}; ?>

<div>
    <!-- Konten utama form login -->
    <div>
        <h2 class="login-title">LOGIN</h2>

        <!-- Alert Error -->
        @if($errorMessage)
            <div class="error-alert" id="error-alert">
                <div class="flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                    </svg>
                    <span>{{ $errorMessage }}</span>
                </div>
            </div>
        @endif

        <form wire:submit.prevent="login" class="login-form" novalidate id="loginForm">
            <!-- Email dengan Icon -->
            <div class="form-group">
                <div class="input-wrapper">
                    <span class="input-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </span>
                    <input
                        wire:model="email"
                        id="email"
                        name="email"
                        type="text"
                        placeholder="Email"
                        class="form-input @error('email') input-error @enderror"
                    />
                </div>
                <span class="field-error" id="email-error"></span>
            </div>

            <!-- Password dengan Icon Mata Saja -->
            <div class="form-group">
                <div class="input-wrapper">
                    <input
                        wire:model="password"
                        id="password"
                        name="password"
                        type="password"
                        placeholder="Kata sandi"
                        class="form-input form-input-password @error('password') input-error @enderror"
                    />
                    <button type="button" class="password-toggle" onclick="togglePassword()">
                        <svg id="eye-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </button>
                </div>
                <span class="field-error" id="password-error"></span>
            </div>


            <!-- Tombol login -->
            <button type="submit" class="login-button">
                Log in
            </button>
        </form>
    </div>

    <!-- Notifikasi sukses -->
    @if($successMessage)
        <div class="success-notification" id="success-notification">
            <div class="success-content">
                <svg class="success-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ $successMessage }}</span>
            </div>
        </div>
    @endif

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

        // Sembunyikan pesan error otomatis setelah 5 detik
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

        // Trigger animasi shake ketika login gagal
        function triggerShakeAnimation(inputElement) {
            inputElement.classList.remove('input-error');
            // Paksa reflow buat restart animasi
            void inputElement.offsetWidth;
            inputElement.classList.add('input-error');
        }

        // Dengerin event login-failed dari Livewire
        document.addEventListener('livewire:init', () => {
            Livewire.on('login-failed', () => {
                const emailInput = document.getElementById('email');
                const passwordInput = document.getElementById('password');

                // Trigger animasi shake untuk kedua field
                triggerShakeAnimation(emailInput);
                triggerShakeAnimation(passwordInput);

                // Sembunyikan otomatis setelah 5 detik
                const emailError = document.getElementById('email-error');
                const passwordError = document.getElementById('password-error');

                setTimeout(() => {
                    emailInput.classList.remove('input-error');
                    passwordInput.classList.remove('input-error');
                }, 5000);
            });
        });

        // Validasi form
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('loginForm');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const emailError = document.getElementById('email-error');
            const passwordError = document.getElementById('password-error');
            const errorAlert = document.getElementById('error-alert');

            // Sembunyikan error alert otomatis setelah 5 detik
            if (errorAlert) {
                setTimeout(() => {
                    errorAlert.style.transition = 'opacity 0.3s ease-out';
                    errorAlert.style.opacity = '0';
                    setTimeout(() => {
                        errorAlert.remove();
                    }, 300);
                }, 5000);
            }

            form.addEventListener('submit', function(e) {
                let isValid = true;

                // Hapus error sebelumnya
                emailError.textContent = '';
                passwordError.textContent = '';
                emailError.classList.remove('fade-out');
                passwordError.classList.remove('fade-out');
                emailInput.classList.remove('input-error');
                passwordInput.classList.remove('input-error');

                // Validasi email
                if (!emailInput.value.trim()) {
                    emailError.textContent = 'Email tidak boleh kosong';
                    emailInput.classList.add('input-error');
                    autoHideError(emailError, emailInput);
                    isValid = false;
                }

                // Validasi password
                if (!passwordInput.value.trim()) {
                    passwordError.textContent = 'Password tidak boleh kosong';
                    passwordInput.classList.add('input-error');
                    autoHideError(passwordError, passwordInput);
                    isValid = false;
                }

                // Kalau validasi gagal, cegah form submit
                if (!isValid) {
                    e.preventDefault();
                    e.stopPropagation();
                }
            });

            // Hapus error saat input - hilangkan outline langsung ketika user ngetik
            emailInput.addEventListener('input', function() {
                if (emailInput.value.trim()) {
                    emailError.classList.add('fade-out');
                    emailInput.classList.remove('input-error');
                    setTimeout(() => {
                        emailError.textContent = '';
                        emailError.classList.remove('fade-out');
                    }, 300);
                }
            });

            passwordInput.addEventListener('input', function() {
                if (passwordInput.value.trim()) {
                    passwordError.classList.add('fade-out');
                    passwordInput.classList.remove('input-error');
                    setTimeout(() => {
                        passwordError.textContent = '';
                        passwordError.classList.remove('fade-out');
                    }, 300);
                }
            });
        });
    </script>
</div>
