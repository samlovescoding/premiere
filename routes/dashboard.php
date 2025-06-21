<?php

use App\Facades\Route;
use App\Livewire\Welcome;

Route::get('/home', Welcome::class)->name('home');
