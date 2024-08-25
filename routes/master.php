<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TahunController;
use App\Http\Controllers\AkunkeuanganController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RencanaController;
use App\Http\Controllers\SaldoController;
use App\Http\Controllers\WilayahController;



/************************ Dashboard Routes Start ******************************/
Route::group(['middleware'=>'checkRole:A'],function(){
        Route::group(['prefix'=>'master','as'=>'master.'],function(){
            Route::get('/',[PerkaraController::class,'index'])->name('index');

            /************************ User Routes Start ******************************/
 
            Route::get('/identitas', [UserController::class, 'identitas'])->name('user.identitas');
            Route::PUT('/identitas/update', [UserController::class, 'upiden'])->name('user.upiden');
        
            /************************ User Routes Start ******************************/
           Route::get('/user', [UserController::class, 'index'])->name('user.index');
           Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
           Route::POST('/user/create', [UserController::class, 'store'])->name('user.store');
           Route::get('/hapus/{id}', [UserController::class, 'destroy'])->name('user.destroy');
           Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
           Route::PUT('/user/edit/{id}', [UserController::class, 'update'])->name('user.update');
           Route::get('/user/search', [UserController::class, 'search'])->name('user.search');
           Route::get('/user/destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');

            /************************ Tahun Routes Start ******************************/
            Route::get('/tahun', [TahunController::class, 'index'])->name('tahun.index');
            Route::get('/tahun/create', [TahunController::class, 'create'])->name('tahun.create');
            Route::POST('/tahun/create', [TahunController::class, 'store'])->name('tahun.store');
            Route::get('/hapus/{id}', [TahunController::class, 'destroy'])->name('tahun.destroy');
            Route::get('/tahun/edit/{id}', [TahunController::class, 'edit'])->name('tahun.edit');
            Route::PUT('/tahun/edit/{id}', [TahunController::class, 'update'])->name('tahun.update');
            Route::get('/tahun/search', [TahunController::class, 'search'])->name('tahun.search');
            Route::get('/tahun/export', [TahunController::class, 'export'])->name('tahun.export');
            Route::get('/tahun/destroy', [TahunController::class, 'destroy'])->name('tahun.destroy');

            /************************ Jenis Akun Keuangan Routes Start ******************************/

            Route::get('/jenis/akun', [AkunkeuanganController::class, 'jenis'])->name('akun.jenis');
            Route::get('/jenis/akun/{id}', [AkunkeuanganController::class, 'detailjenis'])->name('akun.detailjenis');
            Route::get('/jenis/akun/{id}/search', [AkunkeuanganController::class, 'searchdetailjenis'])->name('akun.searchdetailjenis');
            Route::get('/jenis/akun/{id}/export', [AkunkeuanganController::class, 'exportakun'])->name('akun.exportakun');
 

            /************************ Akun Keuangan Routes Start ******************************/
            Route::get('/akun', [AkunkeuanganController::class, 'index'])->name('akun.index');
            Route::get('/akun/create', [AkunkeuanganController::class, 'create'])->name('akun.create');
            Route::POST('/akun/create', [AkunkeuanganController::class, 'store'])->name('akun.store');
            Route::get('/hapus/{id}', [AkunkeuanganController::class, 'destroy'])->name('akun.destroy');
            Route::get('/akun/edit/{id}', [AkunkeuanganController::class, 'edit'])->name('akun.edit');
            Route::PUT('/akun/edit/{id}', [AkunkeuanganController::class, 'update'])->name('akun.update');
            Route::get('/akun/search', [AkunkeuanganController::class, 'search'])->name('akun.search');
            Route::get('/akun/export', [AkunkeuanganController::class, 'export'])->name('akun.export');
            Route::get('/akun/destroy/{id}', [AkunkeuanganController::class, 'destroy'])->name('akun.destroy');
            Route::get('/akun/import', [AkunkeuanganController::class, 'import'])->name('akun.import');
            Route::POST('/akun/import', [AkunkeuanganController::class, 'storeimport'])->name('akun.storeimport');


            /************************ RKAT Routes Start ******************************/
            Route::get('/rencana', [RencanaController::class, 'index'])->name('rencana.index');
            Route::get('/rencana/search', [RencanaController::class, 'search'])->name('rencana.search');
            Route::get('/rencana/export', [RencanaController::class, 'export'])->name('rencana.export');
            Route::get('/rencana/download', [RencanaController::class, 'download'])->name('rencana.download');
            Route::get('/rencana/import', [RencanaController::class, 'import'])->name('rencana.import');
            Route::POST('/rencana/import', [RencanaController::class, 'importstore'])->name('rencana.importstore');


            /************************ RKAT Routes Start ******************************/
            Route::get('/saldo', [SaldoController::class, 'index'])->name('saldo.index');
            Route::get('/saldo/search', [SaldoController::class, 'search'])->name('saldo.search');
            Route::get('/saldo/export', [SaldoController::class, 'export'])->name('saldo.export');
            Route::get('/saldo/download', [SaldoController::class, 'download'])->name('saldo.download');
            Route::get('/saldo/import', [SaldoController::class, 'import'])->name('saldo.import');
            Route::POST('/saldo/import', [SaldoController::class, 'importstore'])->name('saldo.importstore');

 

            /************************ Wilayah Routes Start ******************************/
            Route::get('/wilayah', [WilayahController::class, 'index'])->name('wilayah.index');
            Route::get('/wilayah/full', [WilayahController::class, 'full'])->name('wilayah.full');
            Route::POST('/wilayah/create', [WilayahController::class, 'store'])->name('wilayah.store');
            Route::POST('/wilayah/kelurahan/create', [WilayahController::class, 'storee'])->name('wilayah.storee');
            Route::PUT('/wilayah/edit/{id}', [WilayahController::class, 'update'])->name('wilayah.update');
            Route::PUT('/wilayah/edit/kelurahan/{id}', [WilayahController::class, 'updatee'])->name('wilayah.updatee');
            Route::get('/wilayah/detail/{id}', [WilayahController::class, 'detail'])->name('wilayah.detail');
            Route::get('/wilayah/kelurahan/destroy/{id}', [WilayahController::class, 'destroyk'])->name('wilayah.destroyk');
            Route::get('/wilayah/search', [WilayahController::class, 'search'])->name('wilayah.search');
            Route::get('/wilayah/kecamatan/destroy/{id}', [WilayahController::class, 'destroy'])->name('wilayah.destroy');




        


        });    
});
/************************ Dashboard Routes Ends ******************************/ 