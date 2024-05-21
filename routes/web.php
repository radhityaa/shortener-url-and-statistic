<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShortenerController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::get('/dashboard', DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('products', ProductController::class);

Route::get('shorteners', [ShortenerController::class, 'index'])->name('shorteners.index');
Route::get('shorteners/{shortener}/stats', [ShortenerController::class, 'stats'])->name('shorteners.stats');

require __DIR__ . '/auth.php';

Route::get('/{shortener}', [ShortenerController::class, 'show'])->name('shortener.show');
