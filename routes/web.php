<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\APIContr;
use App\Http\Controllers\approval\ApprovalController;
use App\Http\Controllers\approval\ApprovalDisposalController;
use App\Http\Controllers\approval\ApprovalPengukuranAwalController;
use App\Http\Controllers\approval\ApprovalPengukuranRutinController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiesController;
use App\Http\Controllers\disposal\DisposalController;
use App\Http\Controllers\KodeProdukController;
use App\Http\Controllers\LineController;
use App\Http\Controllers\MesinController;
use App\Http\Controllers\NamaProdukController;
use App\Http\Controllers\pengukuran\PengukuranController;
use App\Http\Controllers\Permission;
use App\Http\Controllers\PunchController;
use App\Http\Controllers\Role;
use App\Http\Controllers\Users;
use Illuminate\Support\Facades\Route;


Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::redirect('/', '/login');

Route::post('/login-auth', [AuthController::class, 'login_auth']);

Route::get('/audit-trail', [AuditController::class, 'audit_trail_guest']);

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(['auth', 'CheckRoleUser']);

Route::prefix('Admin')->name('admin.')->middleware(['auth', 'CheckRoleUser'])->group(function(){
    Route::prefix('users')->name('users.')->group(function(){
        Route::get('users', [Users::class, 'manajemen_user'])->name('index');
        Route::post('add-user', [Users::class, 'add_user'])->name('create');
        Route::get('/edit-user/{id}', [Users::class, 'edit_user'])->name('edit');
        Route::post('update-user', [Users::class, 'update_user'])->name('update');
        Route::get('/delete-user/{id}', [Users::class, 'delete_user'])->name('delete');
    });
    Route::prefix('role')->name('role.')->group(function(){
        Route::get('roles', [Role::class, 'manajemen_role'])->name('index');
        Route::post('add', [Role::class, 'add_role'])->name('create');
        Route::get('/view/{id}', [Role::class, 'view_role'])->name('view');
        Route::get('/edit/{id}', [Role::class, 'edit_role'])->name('edit');
        Route::post('/update/{id}', [Role::class, 'update_role'])->name('update');
        Route::get('/delete/{id}', [Role::class, 'del_role'])->name('delete');
    });
    Route::prefix('permission')->name('permission.')->group(function(){
        Route::get('permissions', [Permission::class, 'manajemen_permission'])->name('index');
    });
    Route::prefix('line')->name('line.')->group(function(){
        Route::get('lines', [LineController::class, 'manajemen_line'])->name('index');
        Route::post('create-line', [LineController::class, 'add_line'])->name('create');
        Route::get('/edit-line/{id}', [LineController::class, 'edit_line'])->name('edit');
        Route::post('update-line', [LineController::class, 'update_line'])->name('update');
        Route::get('/delete-permission/{id}', [LineController::class, 'delete_line'])->name('delete');
    });
    Route::prefix('mesin')->name('mesin.')->group(function () {
        Route::get('index', [MesinController::class, 'index'])->name('index');
        Route::post('create-mesin', [MesinController::class, 'store'])->name('create');
        Route::get('/edit-mesin/{id}', [MesinController::class, 'edit'])->name('edit');
        Route::post('update-mesin', [MesinController::class, 'update'])->name('update');
        Route::get('/delete-mesin/{id}', [MesinController::class, 'destroy'])->name('delete');
    });
    Route::prefix('nama-produk')->name('namaProduk.')->group(function () {
        Route::get('index', [NamaProdukController::class, 'index'])->name('index');
        Route::post('create-produk', [NamaProdukController::class, 'store'])->name('create');
        Route::get('/edit-produk/{id}', [NamaProdukController::class, 'edit'])->name('edit');
        Route::post('update-produk', [NamaProdukController::class, 'update'])->name('update');
        Route::get('/delete-produk/{id}', [NamaProdukController::class, 'destroy'])->name('delete');
    });
    Route::prefix('kode-produk')->name('kodeProduk.')->group(function () {
        Route::get('index', [KodeProdukController::class, 'index'])->name('index');
        Route::post('create-produk', [KodeProdukController::class, 'store'])->name('create');
        Route::get('/edit-produk/{id}', [KodeProdukController::class, 'edit'])->name('edit');
        Route::post('update-produk', [KodeProdukController::class, 'update'])->name('update');
        Route::get('/delete-produk/{id}', [KodeProdukController::class, 'destroy'])->name('delete');
    });
});

Route::prefix('pnd')->name('pnd.')->middleware(['auth', 'CheckRoleUser'])->group(function() {
    Route::prefix('pengukuran-awal')->name('pa.')->group(function() {
        Route::prefix('punch-atas')->name('atas.')->group(function(){
            //Route untuk Buat Punch
            Route::get('', [PunchController::class, 'show_all_punch'])->name('index');
            Route::post('create', [PunchController::class, 'create_data'])->name('create');
            Route::get('delete-punch/{id}', [PunchController::class, 'delete_data'])->name('delete');

            //Route untuk buat pengukuran awal
            Route::get('pilih-pengukuran/{id}', [PengukuranController::class, 'pilih_pengukuran'])->name('list');
            Route::get('create-pengukuran-awal', [PengukuranController::class, 'create_data_pengukuran_awal'])->name('create-punch');
            Route::get('view_pengukuran/{id}', [PengukuranController::class, 'view_pengukuran'])->name('view');
            Route::get('form_pengukuran', [PengukuranController::class, 'form_pengukuran'])->name('show-form');
            Route::post('simpan', [PengukuranController::class, 'simpan_pengukuran'])->name('store');
            Route::get('buat_pengukuran/{id}', [PengukuranController::class, 'buat_pengukuran'])->name('create-pengukuran');
            Route::get('cek_pengukuran/{id}', [PengukuranController::class, 'cek_pengukuran'])->name('cek-pengukuran');
            Route::post('simpan-note', [PengukuranController::class, 'add_note_pa'])->name('create-note');
            Route::get('set-status', [PengukuranController::class, 'set_draft_status'])->name('draft');
            Route::get('print/{id}', [PengukuranController::class, 'print'])->name('print');
        });
        Route::prefix('punch-bawah')->name('bawah.')->group(function(){
            //Route Untuk Buat Punch
            Route::get('', [PunchController::class, 'show_all_punch'])->name('index');
            Route::post('create', [PunchController::class, 'create_data'])->name('create');
            Route::get('delete-punch/{id}', [PunchController::class, 'delete_data'])->name('delete');
            
            //Route untuk buat pengukuran awal
            Route::get('pilih-pengukuran/{id}', [PengukuranController::class, 'pilih_pengukuran'])->name('list');
            Route::get('create-pengukuran-awal', [PengukuranController::class, 'create_data_pengukuran_awal'])->name('create-punch');
            Route::get('view_pengukuran/{id}', [PengukuranController::class, 'view_pengukuran'])->name('view');
            Route::get('form_pengukuran', [PengukuranController::class, 'form_pengukuran'])->name('show-form');
            Route::post('simpan', [PengukuranController::class, 'simpan_pengukuran'])->name('store');
            Route::get('buat_pengukuran/{id}', [PengukuranController::class, 'buat_pengukuran'])->name('create-pengukuran');
            Route::get('cek_pengukuran/{id}', [PengukuranController::class, 'cek_pengukuran'])->name('cek-pengukuran');
            Route::post('simpan-note', [PengukuranController::class, 'add_note_pa'])->name('create-note');
            Route::get('set-status', [PengukuranController::class, 'set_draft_status'])->name('draft');
            Route::get('print/{id}', [PengukuranController::class, 'print'])->name('print');
        });
        Route::prefix('dies')->name('dies.')->group(function(){
            //Route Untuk buat dies
            Route::get('', [DiesController::class, 'show_all_dies'])->name('index');
            Route::post('create', [DiesController::class, 'create_data'])->name('create');
            Route::get('delete-dies/{id}', [DiesController::class, 'delete_data'])->name('delete');

            //route untuk buat pengukuran awal
            Route::get('pilih-pengukuran/{id}', [PengukuranController::class, 'pilih_pengukuran'])->name('list');
            Route::get('create-pengukuran-awal', [PengukuranController::class, 'create_data_pengukuran_awal'])->name('create-dies');
            Route::get('view_pengukuran/{id}', [PengukuranController::class, 'view_pengukuran'])->name('view');
            Route::get('form_pengukuran', [PengukuranController::class, 'form_pengukuran'])->name('show-form');
            Route::post('simpan', [PengukuranController::class, 'simpan_pengukuran'])->name('store');
            Route::get('buat_pengukuran/{id}', [PengukuranController::class, 'buat_pengukuran'])->name('create-pengukuran');
            Route::get('cek_pengukuran/{id}', [PengukuranController::class, 'cek_pengukuran'])->name('cek-pengukuran');
            Route::post('simpan-note', [PengukuranController::class, 'add_note_pa'])->name('create-note');
            Route::get('set-status', [PengukuranController::class, 'set_draft_status'])->name('draft');
            Route::get('print/{id}', [PengukuranController::class, 'print'])->name('print');
        });
    });

    Route::prefix('pengukuran-rutin')->name('pr.')->group(function() {
        Route::prefix('punch-atas')->name('atas.')->group(function(){
            Route::get('', [PunchController::class, 'show_all_punch'])->name('index');

            Route::get('buat_pengukuran/{id}', [PengukuranController::class, 'create_data_pengukuran_rutin'])->name('create');
            Route::get('view_pengukuran/{id}', [PengukuranController::class, 'view_pengukuran_rutin'])->name('view');
            Route::get('form_pengukuran', [PengukuranController::class, 'form_pengukuran_rutin'])->name('form');
            Route::post('simpan', [PengukuranController::class, 'simpan_pengukuran_rutin'])->name('store');
            Route::get('opsi/{id}', [PengukuranController::class, 'opsi_pengukuran'])->name('opsi');
            Route::get('info/{id}', [PengukuranController::class, 'info_pengukuran'])->name('info');
            Route::get('pilih-pengukuran/{id}', [PengukuranController::class, 'pilih_pengukuran'])->name('list');
            Route::get('cek_pengukuran/{id}', [PengukuranController::class, 'cek_pengukuran_rutin'])->name('cek-pengukuran');
            Route::post('simpan-note', [PengukuranController::class, 'add_note_rutin'])->name('create-note');
            Route::get('set-status', [PengukuranController::class, 'set_draft_status_rutin'])->name('draft');
            Route::get('print/{id}', [PengukuranController::class, 'print'])->name('print');
        });
        Route::prefix('punch-bawah')->name('bawah.')->group(function(){
            Route::get('', [PunchController::class, 'show_all_punch'])->name('index');
            
            Route::get('buat_pengukuran/{id}', [PengukuranController::class, 'create_data_pengukuran_rutin'])->name('create');
            Route::get('view_pengukuran/{id}', [PengukuranController::class, 'view_pengukuran_rutin'])->name('view');
            Route::get('form_pengukuran', [PengukuranController::class, 'form_pengukuran_rutin'])->name('form');
            Route::post('simpan', [PengukuranController::class, 'simpan_pengukuran_rutin'])->name('store');
            Route::get('opsi/{id}', [PengukuranController::class, 'opsi_pengukuran'])->name('opsi');
            Route::get('info/{id}', [PengukuranController::class, 'info_pengukuran'])->name('info');
            Route::get('pilih-pengukuran/{id}', [PengukuranController::class, 'pilih_pengukuran'])->name('list');
            Route::get('cek_pengukuran/{id}', [PengukuranController::class, 'cek_pengukuran_rutin'])->name('cek-pengukuran');
            Route::post('simpan-note', [PengukuranController::class, 'add_note_rutin'])->name('create-note');
            Route::get('set-status', [PengukuranController::class, 'set_draft_status_rutin'])->name('draft');
            Route::get('print/{id}', [PengukuranController::class, 'print'])->name('print');
        });
        Route::prefix('dies')->name('dies.')->group(function(){
            Route::get('', [DiesController::class, 'show_all_dies'])->name('index');
            
            Route::get('buat_pengukuran/{id}', [PengukuranController::class, 'create_data_pengukuran_rutin'])->name('create');
            Route::get('view_pengukuran/{id}', [PengukuranController::class, 'view_pengukuran_rutin'])->name('view');
            Route::get('form_pengukuran', [PengukuranController::class, 'form_pengukuran_rutin'])->name('form');
            Route::post('simpan', [PengukuranController::class, 'simpan_pengukuran_rutin'])->name('store');
            Route::get('opsi/{id}', [PengukuranController::class, 'opsi_pengukuran'])->name('opsi');
            Route::get('info/{id}', [PengukuranController::class, 'info_pengukuran'])->name('info');
            Route::get('pilih-pengukuran/{id}', [PengukuranController::class, 'pilih_pengukuran'])->name('list');
            Route::get('cek_pengukuran/{id}', [PengukuranController::class, 'cek_pengukuran_rutin'])->name('cek-pengukuran');
            Route::post('simpan-note', [PengukuranController::class, 'add_note_rutin'])->name('create-note');
            Route::get('set-status', [PengukuranController::class, 'set_draft_status_rutin'])->name('draft');
            Route::get('print/{id}', [PengukuranController::class, 'print'])->name('print');
        });
    });

    Route::prefix('approval')->name('approval.')->group(function(){
        Route::prefix('pengukuran-awal')->name('pa.')->group(function(){
            Route::get('index', [ApprovalPengukuranAwalController::class, 'index'])->name('index');
            Route::get('show/{id}', [ApprovalPengukuranAwalController::class, 'show'])->name('show');
            Route::get('approve/{id}', [ApprovalPengukuranAwalController::class, 'approve'])->name('approve');
            Route::get('reject/{id}', [ApprovalPengukuranAwalController::class, 'reject'])->name('reject');
        });
        Route::prefix('pengukuran-rutin')->name('pr.')->group(function(){
            Route::get('index', [ApprovalPengukuranRutinController::class, 'index'])->name('index');
            Route::get('show/{id}', [ApprovalPengukuranRutinController::class, 'show'])->name('show');
            Route::get('approve/{id}', [ApprovalPengukuranRutinController::class, 'approve'])->name('approve');
            Route::get('reject/{id}', [ApprovalPengukuranRutinController::class, 'reject'])->name('reject');
        });
        Route::prefix('disposal')->name('dis.')->group(function(){
            Route::get('index', [ApprovalDisposalController::class, 'index'])->name('index');
            Route::get('show/{id}', [ApprovalDisposalController::class, 'show'])->name('show');
            Route::post('status/{id}', [ApprovalDisposalController::class, 'setStatus'])->name('setStatus');
        });
        Route::prefix('histori')->name('histori.')->group(function(){
            Route::get('histori', [ApprovalController::class, 'show_history'])->name('index');
            Route::get('pengukuran/{id}', [ApprovalController::class, 'detail_data_history'])->name('show-detail-pengukuran');
        });
    });

    Route::prefix('request')->name('request.')->group(function(){
        Route::prefix('disposal')->name('disposal.')->group(function(){
            Route::get('index', [DisposalController::class, 'index'])->name('index');
            Route::get('show/{id}', [DisposalController::class, 'show'])->name('show');
            Route::get('create/{id}', [DisposalController::class, 'create'])->name('create');
            Route::post('store/{id}', [DisposalController::class, 'store'])->name('store');
            Route::post('draft/{id}', [DisposalController::class, 'saveDraft'])->name('draft');
        });
    });
});


// Route::middleware(['auth', 'verified'])->group(function () {
//     //QA
//     //Approval Pengukuran
        
//         //Approval Disposal
//         Route::get('/data/approval/disposal', [ApprovalController::class, 'show_data_approval']);
    
// });