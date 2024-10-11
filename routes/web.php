<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {

    Route::get('/', [AuthController::class, 'login'])->name('login');

    Route::post('/login-auth', [AuthController::class, 'login_auth'])->name('login-auth');
});


Route::middleware(['auth', 'verified'])->group(function () {


    Route::get('/dashboard-admin', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('/data/punch-atas', function () {
        return view('engineer.data.punch_atas');
    });

    Route::get('/manajemen-user', [AdminController::class, 'manajemen_user'])->name('user');
    Route::post('/add-user', [AdminController::class, 'add_user'])->name('add-user');



    //Logout
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});