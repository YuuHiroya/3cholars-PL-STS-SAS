<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\ScholarshipsController;
use App\Http\Controllers\Admin\AdminController as AdminSettingsController;
use App\Http\Controllers\AdminAuthController;



/** ============== Admin Authentication Routes ============== **/

Route::prefix('admin')->group(function () {
    // Admin Login Routes (Guest Only)
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
    });

    // Admin Protected Routes
    Route::middleware('admin.auth')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/users', [UsersController::class, 'index'])->name('admin.users');
        Route::get('/scholarships', [ScholarshipsController::class, 'index'])->name('admin.scholarships');
        Route::get('/admin', [AdminSettingsController::class, 'index'])->name('admin.admin');
        Route::post('/admins/promote', [AdminSettingsController::class, 'promote'])->name('admin.admins.promote');
        Route::delete('/admins/{admin}', [AdminSettingsController::class, 'destroy'])->name('admin.admins.destroy');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    });
});

/** ============== End Admin Routes ============== **/

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

/** Route Forgot Password */
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

/** Profile */

Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
