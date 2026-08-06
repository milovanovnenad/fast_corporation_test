<?php

use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::livewire('a', 'a.view')->name('a');
    Route::livewire('b', 'b.view')->name('b');
    Route::livewire('unauthorized', 'unauthorized.view')->name('unauthorized');

    Route::middleware(IsAdmin::class)->group(function () {
        Route::livewire('statistics', 'statistics.view')->name('statistics');
        Route::livewire('reports', 'reports.view')->name('reports');
    });
});

require __DIR__.'/settings.php';
