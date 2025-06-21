<?php

use App\Livewire\Login;
use App\Livewire\Recovery;
use App\Livewire\Register;
use App\Facades\Route;

Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');
Route::get('/recovery', Recovery::class)->name('recovery');
