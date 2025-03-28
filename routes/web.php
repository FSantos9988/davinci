<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ClientController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('clients', function () {
    return Inertia::render('Client');
})->middleware(['auth', 'verified'])->name('client');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
