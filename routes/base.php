<?php

use App\Livewire\Installer\PanelInstaller;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RequireTwoFactorAuthentication;

Route::get('installer', PanelInstaller::class)->name('installer')
    ->withoutMiddleware(['auth', RequireTwoFactorAuthentication::class]);

// Redirection vers le panel client
Route::get('/', function () {
    return redirect('/client');
})->name('home');
