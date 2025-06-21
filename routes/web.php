<?php

use App\Facades\Route;
use App\Livewire\Welcome;

Route::get('/', Welcome::class)->name('index');

Route::layout("layouts.dashboard", 'dashboard.php');
Route::layout("layouts.auth", 'auth.php');

