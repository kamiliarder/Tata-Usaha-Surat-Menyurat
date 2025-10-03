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
    #[Validate('required|string')]
    public string $username = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    public function login(): void
    {
        $this->validate();

        $this->ensureIsNotRateLimited();

        if (!Auth::attempt(['username' => $this->username, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'username' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());

        Session::regenerate();

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }

    protected function ensureIsNotRateLimited(): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'username' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->username).'|'.request()->ip());
    }
}; ?>

<div>
    <h2 class="login-title">LOGIN</h2>

    <form wire:submit="login" class="login-form">
        <!-- Username -->
        <div class="form-group">
            <input
                wire:model="username"
                id="username"
                name="username"
                type="text"
                required
                placeholder="Nama pengguna"
                class="form-input"
            />
            @error('username')
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
        <div>
            <button type="submit" class="login-button">
                Login
            </button>
        </div>
    </form>
</div>
