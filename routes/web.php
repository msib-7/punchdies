<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\APIContr;
use App\Http\Controllers\approval\ApprovalController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DiesController;
use App\Http\Controllers\LineController;
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
    
    //Manajemen Line
    Route::get('/manajemen-line', [LineController::class, 'manajemen_line'])->name('lines');
    Route::post('/add-line', [LineController::class, 'add_line'])->name('add-line');
    Route::get('/edit-line/{id}', [LineController::class, 'edit_line']);
    Route::post('/update-line', [LineController::class, 'update_line']);
    

    //Data Pengukuran Awal
    //Punch Atas
        Route::get('/data/punch-atas', [PunchController::class, 'show_all_punch']);
        Route::post('/data/punch-atas/create-data', [PunchController::class, 'create_data']);
        Route::get('/data/punch-atas/delete-data/{id}', [PunchController::class, 'delete_data']);
        Route::get('/data/punch-atas/pengukuran-awal', [PengukuranController::class, 'create_data_pengukuran_awal']);

        Route::get('/data/punch-atas/pengukuran-awal/buat_pengukuran/{id}', [PengukuranController::class, 'buat_pengukuran']);
        Route::get('/data/punch-atas/pengukuran-awal/cek_pengukuran/{id}', [PengukuranController::class, 'cek_pengukuran']);
        Route::get('/data/punch-atas/pengukuran-awal/view_pengukuran/{id}', [PengukuranController::class, 'view_pengukuran']);
        Route::get('/data/punch-atas/pengukuran-awal/form_pengukuran', [PengukuranController::class, 'form_pengukuran']);
        Route::post('/data/punch-atas/pengukuran-awal/simpan', [PengukuranController::class, 'simpan_pengukuran']);
        Route::post('/data/punch-atas/pengukuran-awal/simpan/note', [PengukuranController::class, 'add_note_pa']);
        Route::get('/data/punch-atas/pengukuran-awal/set-status', [PengukuranController::class, 'set_draft_status']);
    //

    //Punch Bawah
        Route::get('/data/punch-bawah', [PunchController::class, 'show_all_punch']);
        Route::post('/data/punch-bawah/create-data', [PunchController::class, 'create_data']);
        Route::get('/data/punch-bawah/delete-data/{id}', [PunchController::class, 'delete_data']);
        Route::get('/data/punch-bawah/pengukuran-awal', [PengukuranController::class, 'create_data_pengukuran_awal']);
        
        Route::get('/data/punch-bawah/pengukuran-awal/buat_pengukuran/{id}', [PengukuranController::class, 'buat_pengukuran']);
        Route::get('/data/punch-bawah/pengukuran-awal/cek_pengukuran/{id}', [PengukuranController::class, 'cek_pengukuran']);
        Route::get('/data/punch-bawah/pengukuran-awal/view_pengukuran/{id}', [PengukuranController::class, 'view_pengukuran']);
        Route::get('/data/punch-bawah/pengukuran-awal/form_pengukuran', [PengukuranController::class, 'form_pengukuran']);
        Route::post('/data/punch-bawah/pengukuran-awal/simpan', [PengukuranController::class, 'simpan_pengukuran']);
        Route::post('/data/punch-bawah/pengukuran-awal/simpan/note', [PengukuranController::class, 'add_note_pa']);
        Route::get('/data/punch-bawah/pengukuran-awal/set-status', [PengukuranController::class, 'set_draft_status']);
    //
    
    //Dies
        Route::get('/data/dies', [DiesController::class, 'show_all_dies']);
        Route::post('/data/dies/create-data', [DiesController::class, 'create_data']);
        Route::get('/data/dies/delete-data/{id}', [DiesController::class, 'delete_data']);
        Route::get('/data/dies/pengukuran-awal', [PengukuranController::class, 'create_data_pengukuran_awal']);
        
        Route::get('/data/dies/pengukuran-awal/buat_pengukuran/{id}', [PengukuranController::class, 'buat_pengukuran']);
        Route::get('/data/dies/pengukuran-awal/cek_pengukuran/{id}', [PengukuranController::class, 'cek_pengukuran']);
        Route::get('/data/dies/pengukuran-awal/view_pengukuran/{id}', [PengukuranController::class, 'view_pengukuran']);
        Route::get('/data/dies/pengukuran-awal/form_pengukuran', [PengukuranController::class, 'form_pengukuran']);
        Route::post('/data/dies/pengukuran-awal/simpan', [PengukuranController::class, 'simpan_pengukuran']);
        Route::post('/data/dies/pengukuran-awal/simpan/note', [PengukuranController::class, 'add_note_pa']);
        Route::get('/data/dies/pengukuran-awal/set-status', [PengukuranController::class, 'set_draft_status']);
        //
        
    
    //Data Pengukuran Rutin

    Route::prefix('rutin')->name('rutin.')->middleware(['auth'])->group(function() {
        Route::prefix('punch-atas')->name('pa.')->group(function() {
            Route::get('', [PunchController::class, 'index'])->name('index');
        });
        Route::prefix('punch-bawah')->name('pb.')->group(function() {
            Route::get('', [PunchController::class, 'index'])->name('index');
        });
        Route::prefix('dies')->name('dies.')->group(function() {
            Route::get('', [PunchController::class, 'index'])->name('index');
        });
    });
    //Punch Atas
        Route::get('/data/rutin/punch-atas', [PunchController::class, 'show_all_punch']);

        Route::get('/data/punch-atas/pengukuran-rutin/opsi/{id}', [PengukuranController::class, 'opsi_pengukuran']);
        Route::get('/data/punch-atas/pengukuran-rutin/info/{id}', [PengukuranController::class, 'info_pengukuran']);
        Route::get('/data/punch-atas/pengukuran-rutin/buat_pengukuran/{id}', [PengukuranController::class, 'create_data_pengukuran_rutin']);
        Route::get('/data/punch-atas/pengukuran-rutin/cek_pengukuran/{id}', [PengukuranController::class, 'cek_pengukuran']);
        Route::get('/data/punch-atas/pengukuran-rutin/view_pengukuran/{id}', [PengukuranController::class, 'view_pengukuran']);
        Route::get('/data/punch-atas/pengukuran-rutin/form_pengukuran', [PengukuranController::class, 'form_pengukuran_rutin']);
        Route::post('/data/punch-atas/pengukuran-rutin/simpan', [PengukuranController::class, 'simpan_pengukuran_rutin']);
        Route::post('/data/punch-atas/pengukuran-rutin/save-interval', [PengukuranController::class, 'simpan_pengukuran_rutin_interval']);
        Route::post('/data/punch-atas/pengukuran-rutin/simpan/note', [PengukuranController::class, 'add_note_pa']);
        Route::get('/data/punch-atas/pengukuran-rutin/set-status', [PengukuranController::class, 'set_draft_status']);
        //
        
        //Punch Bawah
        Route::get('/data/rutin/punch-bawah', [PunchController::class, 'show_all_punch']);
        Route::get('/data/punch-bawah/pengukuran-rutin', [PengukuranController::class, 'create_data_pengukuran_rutin']);
        
        Route::get('/data/punch-bawah/pengukuran-rutin/opsi/{id}', [PengukuranController::class, 'opsi_pengukuran']);
        Route::get('/data/punch-bawah/pengukuran-rutin/buat_pengukuran/{id}', [PengukuranController::class, 'buat_pengukuran']);
        Route::get('/data/punch-bawah/pengukuran-rutin/cek_pengukuran/{id}', [PengukuranController::class, 'cek_pengukuran']);
        Route::get('/data/punch-bawah/pengukuran-rutin/view_pengukuran/{id}', [PengukuranController::class, 'view_pengukuran']);
        Route::get('/data/punch-bawah/pengukuran-rutin/form_pengukuran', [PengukuranController::class, 'form_pengukuran']);
        Route::post('/data/punch-bawah/pengukuran-rutin/simpan', [PengukuranController::class, 'simpan_pengukuran']);
        Route::post('/data/punch-bawah/pengukuran-rutin/simpan/note', [PengukuranController::class, 'add_note_pa']);
        Route::get('/data/punch-bawah/pengukuran-rutin/set-status', [PengukuranController::class, 'set_draft_status']);
        //
        
    //Dies
        Route::get('/data/rutin/dies', [DiesController::class, 'show_all_dies']);
    
        Route::get('/data/dies/pengukuran-rutin/opsi/{id}', [PengukuranController::class, 'opsi_pengukuran']);
        Route::get('/data/dies/pengukuran-rutin', [PengukuranController::class, 'create_data_pengukuran_rutin']);
        Route::get('/data/dies/pengukuran-rutin/buat_pengukuran/{id}', [PengukuranController::class, 'buat_pengukuran']);
        Route::get('/data/dies/pengukuran-rutin/cek_pengukuran/{id}', [PengukuranController::class, 'cek_pengukuran']);
        Route::get('/data/dies/pengukuran-rutin/view_pengukuran/{id}', [PengukuranController::class, 'view_pengukuran']);
        Route::get('/data/dies/pengukuran-rutin/form_pengukuran', [PengukuranController::class, 'form_pengukuran']);
        Route::post('/data/dies/pengukuran-rutin/simpan', [PengukuranController::class, 'simpan_pengukuran']);
        Route::post('/data/dies/pengukuran-rutin/simpan/note', [PengukuranController::class, 'add_note_pa']);
        Route::get('/data/dies/pengukuran-rutin/set-status', [PengukuranController::class, 'set_draft_status']);
    //


        
    //QA
    //Approval Pengukuran
        Route::get('/data/approval/pengukuran', [ApprovalController::class, 'show_data_approval']);
        Route::get('/data/approval/pengukuran/detail/{req_id}', [ApprovalController::class, 'detail_data_approval']);
        Route::get('/data/approval/pengukuran/approve/{req_id}', [ApprovalController::class, 'update_approval_status']);
        Route::get('/data/approval/pengukuran/reject/{req_id}', [ApprovalController::class, 'update_approval_status']);
        
        
        //Approval Disposal
        Route::get('/data/approval/disposal', [ApprovalController::class, 'show_data_approval']);

        
        //Approval History
        Route::get('/data/approval/history', [ApprovalController::class, 'show_history']);
        Route::get('/data/approval/history/pengukuran/{req_id}', [ApprovalController::class, 'detail_data_history']);


    
    //Logout
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});