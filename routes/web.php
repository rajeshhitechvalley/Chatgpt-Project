<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GameController;

Route::get('/', function () {
    return view('single');
});
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('users', [UserController::class, 'index']);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Games CRUD
    Route::resource('games', GameController::class);
    
    // Additional Game Routes
    Route::post('games/bulk-delete', [GameController::class, 'bulkDelete'])->name('games.bulk-delete');
    Route::post('games/{game}/toggle-status', [GameController::class, 'toggleStatus'])->name('games.toggle-status');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
