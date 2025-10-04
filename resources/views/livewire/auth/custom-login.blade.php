<?php

use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
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

        $this->ensureIsNotRateLimited();

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            $this->errorMessage = 'Login gagal! Email atau password salah.';

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());

        Session::regenerate();

        // Show success message
        $this->successMessage = 'Login berhasil! Mengarahkan ke dashboard...';

        // Add a small delay before redirect to show the success message
        $this->dispatch('show-success-alert');

        // Redirect after a short delay
        $this->js('setTimeout(() => { window.location.href = "' . route('dashboard') . '" }, 1500)');
    }

    protected function ensureIsNotRateLimited(): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
    }
}; ?>

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
        <button type="submit" class="ms-3 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
            {{ __('Log in') }}
        </button>
    </form>
</div>
