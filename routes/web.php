<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\CategoryController;

// Rute User App
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/event/1', [EventController::class, 'show'])->name('events.show');

Route::get('/checkout', [EventController::class, 'checkout'])->name('checkout');

Route::get('/my-ticket', [EventController::class, 'ticket'])->name('ticket');

Route::get('/kontak', function () {
    return view('contact');
});
Route::get('/profile', function () {
    return view('profile');
});
Route::get('/katalog', function () {
    return view('katalog');
});
Route::get('/bantuan', function () {
    return view('bantuan');
});

// Rute Admin Area
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/events', [AdminEventController::class, 'indexAdmin'])->name('events.index');

    Route::get('/transactions', [AdminEventController::class, 'transactions'])->name('transactions');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
});
