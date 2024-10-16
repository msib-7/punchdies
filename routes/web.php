<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\APIContr;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Permission;
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

    //Manajemen User
    Route::get('/manajemen-user', [AdminController::class, 'manajemen_user'])->name('user');
    Route::post('/add-user', [AdminController::class, 'add_user'])->name('add-user');

    //Manajemen Role
    Route::get('/manajemen-role', [AdminController::class, 'manajemen_role'])->name('roles');

    //Manajemen Permission
    Route::get('/manajemen-permissions', [Permission::class, 'manajemen_permission'])->name('permissions');
    Route::get('/save-permission', [Permission::class, 'add_permission'])->name('add-permissions');
    Route::get('/delete-permission/{id}', [Permission::class, 'del_permission']);
    Route::get('/edit-permission/{id}', [Permission::class, 'edit_permission']);
    Route::post('/update-permission', [Permission::class, 'update_permission']);



    //Logout
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});


//test
Route::get('/getDataPermission', [APIContr::class,'getDataPermission_api'])->name('permission_api');
Route::get('/getDataPermission/{id}', [APIContr::class,'getDataPermission_api'])->name('permission_api');