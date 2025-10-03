<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

// Authentication Routes
Volt::route('/login', 'auth.custom-login')
    ->name('login')
    ->middleware('guest');
