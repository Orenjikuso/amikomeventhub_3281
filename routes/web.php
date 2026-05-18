<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController as EventAdminController;
use App\Http\Controllers\Admin\CategoryController;

// Rute User App
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/event/{event}', [EventController::class, 'show'])->name('events.show');

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
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('events', EventAdminController::class);

    Route::get('/transactions', [EventAdminController::class, 'transactions'])->name('transactions.index');

    Route::resource('categories', CategoryController::class)->only(['index', 'store', 'update', 'destroy']);
});
