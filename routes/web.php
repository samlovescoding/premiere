<?php

use App\Facades\Route;
use App\Http\Middleware\WithLayout;
use App\Livewire\Accounts;
use App\Livewire\AccountsCreate;
use App\Livewire\Login;
use App\Livewire\Metadata;
use App\Livewire\Recovery;
use App\Livewire\Register;
use App\Livewire\Settings;
use App\Livewire\Welcome;

Route::get('/', Welcome::class)->name('index');

Route::middleware(WithLayout::class.':layouts.auth')
    ->group(function () {
        Route::get('/login', Login::class)->name('login');
        Route::get('/register', Register::class)->name('register');
        Route::get('/recovery', Recovery::class)->name('recovery');
    });

Route::middleware('auth')
    ->middleware(WithLayout::class.':layouts.dashboard')
    ->group(function () {
        Route::get('/home', Welcome::class)->name('home');

        Route::get('/movies', Welcome::class)->name('movies');
        Route::get('/shows', Welcome::class)->name('shows');
        Route::get('/import', Welcome::class)->name('import');
        Route::get('/metadata', Metadata::class)->name('metadata');

        Route::get('/accounts', Accounts::class)->name('accounts');
        Route::get('/accounts/create', AccountsCreate::class)->name('accounts.create');
        Route::get('/settings', Settings::class)->name('settings');
    });
