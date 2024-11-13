<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\APIContr;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\pengukuran\PengukuranController;
use App\Http\Controllers\Permission;
use App\Http\Controllers\PunchController;
use App\Http\Controllers\Role;
use App\Http\Controllers\Users;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {

    Route::get('/', [AuthController::class, 'login'])->name('login');

    Route::post('/login-auth', [AuthController::class, 'login_auth'])->name('login-auth');

    Route::get('/audit-trail', [AuditController::class, 'audit_trail_guest']);
});


Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard-admin', [AdminController::class, 'dashboard'])->name('dashboard');

    //Manajemen User
    Route::get('/manajemen-user', [Users::class, 'manajemen_user'])->name('user');
    Route::post('/add-user', [Users::class, 'add_user'])->name('add-user');
    Route::get('/edit-user/{id}', [Users::class, 'edit_user']);
    Route::post('/update-user', [Users::class, 'update_user']);

    //Manajemen Role
    Route::get('/manajemen-role', [Role::class, 'manajemen_role'])->name('roles');
    Route::post('/save-role', [Role::class, 'add_role'])->name('add-role');
    Route::get('/view-role/{id}', [Role::class, 'view_role']);
    Route::get('/edit-role/{id}', [Role::class, 'edit_role']);
    Route::post('/update-role', [Role::class, 'update_role']);
    Route::get('/delete-role/{id}', [Role::class, 'del_role']);

    //Manajemen Permission
    Route::get('/manajemen-permissions', [Permission::class, 'manajemen_permission'])->name('permissions');
    Route::get('/save-permission', [Permission::class, 'add_permission'])->name('add-permissions');
    Route::get('/delete-permission/{id}', [Permission::class, 'del_permission']);
    Route::get('/edit-permission/{id}', [Permission::class, 'edit_permission']);
    Route::post('/update-permission', [Permission::class, 'update_permission']);

    //Data Pengukuran
    //Punch Atas
    Route::get('/data/punch-atas', [PunchController::class, 'show_all_punch']);
    Route::get('/data/punch-atas/pengukuran-awal', [PengukuranController::class, 'create_data_pengukuran_awal']);

    Route::get('/data/punch-atas/pengukuran-awal/view_pengukuran', [PengukuranController::class, 'view_form_pengukuran']);

    Route::post('/data/punch-atas/create-data', [PengukuranController::class, 'create_data_punch']);


    //Logout
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});


//test
Route::get('/getDataPermission', [APIContr::class,'getDataPermission_api'])->name('permission_api');
Route::get('/getDataPermission/{id}', [APIContr::class,'getDataPermission_api'])->name('permission_api');