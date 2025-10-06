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
        // Clear previous messages
        $this->successMessage = '';
        $this->errorMessage = '';

        $this->validate();

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            $this->errorMessage = 'Login gagal! Email atau password salah.';

            $this->addError('email', 'Email atau password salah.');
            return;
        }

        Session::regenerate();

        // Redirect to dashboard
        $this->redirect(route('dashboard'));
    }
}; ?>

<style>
/* Login page styles */
.login-container {
    min-height: 100vh;
    display: flex;
}

.login-bg {
    background-image: url('/assets/bg-login.png');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

.building-image-container {
    display: none;
    width: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 4rem; /* Increased padding */
    height: 100vh; /* Full viewport height */
}

.building-image {
    width: 95%; /* Slightly increased width */
    height: 85vh; /* Set specific height relative to viewport */
    object-fit: cover;
    border-radius: 24px;
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1); /* Add subtle shadow */
}

.form-container {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
}

.form-wrapper {
    width: 100%;
    max-width: 28rem;
}

.login-card {

}

.logo-container {
    display: flex;
    flex-direction: column;
    align-items: center; /* Center logo horizontally */
    justify-content: center;
    margin-bottom: 2rem;
    position: relative;
    padding-bottom: 1.5rem;
}

.logo {
    height: auto;
    width: 200px;
    object-fit: contain; /* Maintains aspect ratio */
}

.logo-container::after {
    content: '';
    bottom: 0;
    width: 100%;
    height: 2px;
    background-color: #000000;
}

.login-title {
    font-size: 1.875rem;
    font-weight: 700;
    text-align: center;
    color: #271111;
    margin-bottom: 2rem;
}

.login-form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-input {
    width: 100%;
    padding: 0.75rem 1rem;
    color: #111827;
    background-color: #f3f4f6;
    border: none;
    border-radius: 0.5rem;
    outline: none;
}

.form-input:focus {
    outline: 2px solid #ef4444;
    outline-offset: 2px;
}

.remember-me {
    display: flex;
    align-items: center;
}

.checkbox-input {
    height: 1rem;
    width: 1rem;
    border-radius: 0.25rem;
    border-color: #d1d5db;
    accent-color: #ef4444;
}

.checkbox-label {
    margin-left: 0.5rem;
    font-size: 0.875rem;
    color: #4b5563;
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

.error-message {
    margin-top: 0.5rem;
    font-size: 0.875rem;
    color: #ef4444;
}

@media (min-width: 1024px) {
    .building-image-container {
        display: flex;
    }

    .form-container {
        width: 50%;
        padding: 4rem;
        height: 100vh; /* Match container height */
    }
}
</style>

<div>
    <h2 class="login-title">LOGIN</h2>

    <!-- Success Alert -->
    @if($successMessage)
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-800 rounded-md">
            <div class="flex items-center text-green-800">
                <svg class="w-5 h-5 mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <span class="text-green-800">{{ $successMessage }}</span>
            </div>
        </div>
    @endif

    <!-- Error Alert -->
    @if($errorMessage)
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-800 rounded-md">
            <div class="flex items-center text-red-800">
                <svg class="w-5 h-5 mr-2 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                </svg>
                <span class="text-red-800">{{ $errorMessage }}</span>
            </div>
        </div>
    @endif

    <form wire:submit.prevent="login" class="login-form">
        <!-- Username -->
        <div class="form-group">
            <input
                wire:model="email"
                id="email"
                name="email"
                type="text"
                required
                placeholder="Email"
                class="form-input"
            />
            @error('email')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="form-group">
            <input
                wire:model="password"
                id="password"
                name="password"
                type="password"
                required
                placeholder="Kata sandi"
                class="form-input"
            />
            @error('password')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember me -->
        <div class="remember-me">
            <input
                wire:model="remember"
                id="remember"
                name="remember"
                type="checkbox"
                class="checkbox-input"
            />
            <span class="checkbox-label">Ingat saya</span>
        </div>

        <!-- Login button -->
        <button type="submit" class="login-button">
            {{ __('Log in') }}
        </button>
    </form>
</div>
