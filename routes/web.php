<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\DestinationController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AdminDashboardController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/api/search/suggestions', [SearchController::class, 'suggestions'])->name('search.suggestions');
Route::get('/api/search/popular', [SearchController::class, 'popular'])->name('search.popular');
Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/destinations', [DestinationController::class, 'index'])->name('destinations.index');
Route::get('/destinations/{destination}', [DestinationController::class, 'show'])->name('destinations.show');

// Admin Routes - Protected by admin middleware
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/destinations', [DestinationController::class, 'adminIndex'])->name('admin.destinations.index');
    Route::post('/destinations/bulk-action', [DestinationController::class, 'bulkAction'])->name('admin.destinations.bulk-action');
    Route::get('/destinations/create', [DestinationController::class, 'create'])->name('admin.destinations.create');
    Route::post('/destinations', [DestinationController::class, 'store'])->name('admin.destinations.store');
    Route::get('/destinations/{destination}/edit', [DestinationController::class, 'edit'])->name('admin.destinations.edit');
    Route::put('/destinations/{destination}', [DestinationController::class, 'update'])->name('admin.destinations.update');
    Route::delete('/destinations/{destination}', [DestinationController::class, 'destroy'])->name('admin.destinations.destroy');

    Route::get('/bookings', [BookingController::class, 'adminIndex'])->name('admin.bookings.index');
    Route::patch('/bookings/{booking}/status', [BookingController::class, 'updateStatus'])->name('admin.bookings.updateStatus');
    Route::patch('/bookings/{booking}', [BookingController::class, 'update'])->name('admin.bookings.update');
});

// User Routes - Protected by auth middleware
Route::middleware(['auth'])->group(function () {
    Route::post('/book/{destination}', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/my-bookings', [BookingController::class, 'userBookings'])->name('user.bookings');
});


require __DIR__.'/auth.php';
