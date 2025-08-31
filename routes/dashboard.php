<?php

use App\Facades\Route;
use App\Livewire\Welcome;
use App\Livewire\Settings;

Route::get('/home', Welcome::class)->name('home');
Route::get('/settings', Settings::class)->name('settings');
