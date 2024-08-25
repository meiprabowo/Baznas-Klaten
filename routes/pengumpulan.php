<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MuzakiController;
use App\Http\Controllers\PengumpulanController;
use App\Http\Controllers\MutasiController;



/************************ Dashboard Routes Start ******************************/
Route::group(['middleware'=>'checkRole:A,PG'],function(){
        Route::group(['prefix'=>'pengumpulan','as'=>'pengumpulan.'],function(){
            
                /************************ Muzaki Perseoarang ******************************/

                Route::get('/muzaki', [MuzakiController::class, 'index'])->name('muzaki.index');
                Route::get('/muzaki/create', [MuzakiController::class, 'create'])->name('muzaki.create');
                Route::POST('/muzaki/create', [MuzakiController::class, 'store'])->name('muzaki.store');
                Route::get('/muzaki/hapus/{id}', [MuzakiController::class, 'destroy'])->name('muzaki.destroy');
                Route::get('/muzaki/edit/{id}', [MuzakiController::class, 'edit'])->name('muzaki.edit');
                Route::PUT('/muzaki/edit/{id}', [MuzakiController::class, 'update'])->name('muzaki.update');
                Route::get('/muzaki/search', [MuzakiController::class, 'search'])->name('muzaki.search');
                Route::get('/muzaki/destroy/{id}', [MuzakiController::class, 'destroy'])->name('muzaki.destroy');
                Route::get('/muzaki/export', [MuzakiController::class, 'export'])->name('muzaki.export');
                Route::get('/muzaki/import', [MuzakiController::class, 'import'])->name('muzaki.import');
                Route::get('/muzaki/import/template', [MuzakiController::class, 'download'])->name('muzaki.download');
                Route::POST('/muzaki/import', [MuzakiController::class, 'importstore'])->name('muzaki.importstore');

                /************************ Muzaki Lembaga ******************************/
                Route::get('/lembaga', [MuzakiController::class, 'lembaga'])->name('muzaki.lembaga');
                Route::get('/lembaga/create', [MuzakiController::class, 'createlembaga'])->name('muzaki.createlembaga');
                Route::POST('/lembaga/create', [MuzakiController::class, 'storelembaga'])->name('muzaki.storelembaga');
                Route::get('/lembaga/hapus/{id}', [MuzakiController::class, 'destroylembaga'])->name('muzaki.destroylembaga');
                Route::get('/lembaga/edit/{id}', [MuzakiController::class, 'editlembaga'])->name('muzaki.editlembaga');
                Route::PUT('/lembaga/edit/{id}', [MuzakiController::class, 'updatelembaga'])->name('muzaki.updatelembaga');
                Route::get('/lembaga/search', [MuzakiController::class, 'searchlembaga'])->name('muzaki.searchlembaga');
                Route::get('/lembaga/destroy/{id}', [MuzakiController::class, 'destroylembaga'])->name('muzaki.destroylembaga');
                Route::get('/lembaga/export', [MuzakiController::class, 'exportlembaga'])->name('muzaki.exportlembaga');
                Route::get('/lembaga/import', [MuzakiController::class, 'importlembaga'])->name('muzaki.importlembaga');
                Route::get('/lembaga/import/template', [MuzakiController::class, 'downloadlembaga'])->name('muzaki.downloadlembaga');
                Route::POST('/lembaga/import', [MuzakiController::class, 'importstorelembaga'])->name('muzaki.importstorelembaga');

                /************************ Muzaki Lembaga ******************************/
                Route::get('/transaksi', [PengumpulanController::class, 'index'])->name('pengumpulan.index');
                Route::get('/transaksi/create', [PengumpulanController::class, 'create'])->name('pengumpulan.create');
                Route::get('/transaksi/bayar/{id}', [PengumpulanController::class, 'bayar'])->name('pengumpulan.bayar');
                Route::POST('/transaksi/bayar/{id}', [PengumpulanController::class, 'bayarpost'])->name('pengumpulan.bayarpost');
                Route::get('/transaksi/search/detail', [PengumpulanController::class, 'searchdetail'])->name('pengumpulan.searchdetail');
                Route::get('/transaksi/cetak/{id}', [PengumpulanController::class, 'cetak'])->name('pengumpulan.cetak');
                Route::get('/transaksi/destroy/{id}', [PengumpulanController::class, 'destroy'])->name('pengumpulan.destroy');
                Route::get('/transaksi/edit/{id}', [PengumpulanController::class, 'edit'])->name('pengumpulan.edit');
                Route::PUT('/transaksi/edit/{id}', [PengumpulanController::class, 'update'])->name('pengumpulan.update');
                Route::get('/transaksi/import', [PengumpulanController::class, 'import'])->name('pengumpulan.import');
                Route::POST('/transaksi/import', [PengumpulanController::class, 'importstore'])->name('pengumpulan.importstore');
                Route::get('/transaksi/import/template', [PengumpulanController::class, 'download'])->name('pengumpulan.download');     
                Route::get('/transaksi/search', [PengumpulanController::class, 'search'])->name('pengumpulan.search');
                Route::get('/transaksi/export', [PengumpulanController::class, 'export'])->name('pengumpulan.export');
                Route::get('/laporan/whatsapp', [PengumpulanController::class, 'wa'])->name('pengumpulan.wa');
                Route::get('/laporan/whatsapp/belum', [PengumpulanController::class, 'wabelum'])->name('pengumpulan.wabelum');
                Route::get('/laporan/whatsapp/belum/{id}', [PengumpulanController::class, 'wabelumact'])->name('pengumpulan.wabelumact');
                Route::get('/laporan/transaksi', [PengumpulanController::class, 'laporan'])->name('pengumpulan.laporan');
                Route::get('/laporan/transaksi/export', [PengumpulanController::class, 'laporanexport'])->name('pengumpulan.laporanexport');
                Route::get('/laporan/transaksi/search/detail', [PengumpulanController::class, 'searchh'])->name('pengumpulan.searchh');

                Route::get('/laporan/kirim/whatsapp', [PengumpulanController::class, 'wa'])->name('pengumpulan.wakirim');


 

                           /************************ Mutasi Routes Start ******************************/
                Route::get('/mutasi', [MutasiController::class, 'indexpengumpulan'])->name('mutasi.indexpengumpulan');
                Route::get('/mutasi/create', [MutasiController::class, 'createpengumpulan'])->name('mutasi.createpengumpulan');
                Route::POST('/mutasi/create', [MutasiController::class, 'storepengumpulan'])->name('mutasi.storepengumpulan');
                Route::get('/mutasi/hapus/{id}', [MutasiController::class, 'destroypengumpulan'])->name('mutasi.destroypengumpulan');
                Route::get('/mutasi/edit/{id}', [MutasiController::class, 'editpengumpulan'])->name('mutasi.editpengumpulan');
                Route::PUT('/mutasi/edit/{id}', [MutasiController::class, 'updatepengumpulan'])->name('mutasi.updatepengumpulan');
                Route::get('/mutasi/search', [MutasiController::class, 'searchpengumpulan'])->name('mutasi.searchpengumpulan');
                Route::get('/mutasi/destroy/{id}', [MutasiController::class, 'destroypengumpulan'])->name('mutasi.destroypengumpulan');
                Route::get('/mutasi/export', [MutasiController::class, 'exportpengumpulan'])->name('mutasi.exportpengumpulan');
                Route::get('/mutasi/detail/{id}', [MutasiController::class, 'detailpengumpulan'])->name('mutasi.detailpengumpulan');

                Route::get('/hapus/transaksi', [PengumpulanController::class, 'hapusdata'])->name('pengumpulan.hapusdata');
                Route::post('/hapus/transaksi', [PengumpulanController::class, 'hapusdatsa'])->name('pengumpulan.hapusdatsa');

                
                
                
        });    
});
/************************ Dashboard Routes Ends ******************************/ 