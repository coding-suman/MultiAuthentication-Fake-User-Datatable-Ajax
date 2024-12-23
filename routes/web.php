<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware('guest')->group( function () {
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login/authenticate', [LoginController::class, 'authenticate'])->name('user.authenticate');
    Route::get('/register', [LoginController::class, 'register'])->name('register');
    Route::post('/register', [LoginController::class, 'processRegister'])->name('user.register');
});

Route::middleware('auth')->group( function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});
Route::middleware(['auth', 'rolemanager:user'])->group( function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');
});
Route::middleware(['auth', 'rolemanager:admin'])->group( function () {
    Route::get('admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
    // composer require yajra/laravel-datatables
    Route::get('admin/users', [DashboardController::class, 'getUserList'])->name('user.list');
    Route::get('admin/users/data', [DashboardController::class, 'getUserData'])->name('user.data');
});

