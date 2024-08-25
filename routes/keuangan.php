<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasarufController;
use App\Http\Controllers\KasbonController;
use App\Http\Controllers\MutasiController;



/************************ Dashboard Routes Start ******************************/
Route::group(['middleware'=>'checkRole:KU,A'],function(){
        Route::group(['prefix'=>'keuangan','as'=>'keuangan.'],function(){
            
                
                /************************ Kasbon Routes Start ******************************/
                Route::get('/persetujuan/kasbon', [KasbonController::class, 'indexkeuangan'])->name('kasbon.indexkeuangan');
                Route::get('/persetujuan/kasbon/detail/{id}', [KasbonController::class, 'detailkeuangan'])->name('kasbon.detailkeuangan');
                Route::post('/persetujuan/kasbon/detail/{id}', [KasbonController::class, 'persetujuan'])->name('kasbon.persetujuan');
                Route::get('/persetujuan/kasbon/destroy/{id}', [KasbonController::class, 'destroykeuangan'])->name('kasbon.destroykeuangan');
                Route::get('/persetujuan/kasbon/cetak/{id}', [KasbonController::class, 'cetakkeuangan'])->name('kasbon.cetakkeuangan');
                Route::get('/persetujuan/kasbon/tolak/{id}', [KasbonController::class, 'tolak'])->name('kasbon.tolak');
                Route::get('/persetujuan/kasbon/edit/{id}', [KasbonController::class, 'editkeuangan'])->name('kasbon.editkeuangan');
                Route::PUT('/persetujuan/kasbon/edit/{id}', [KasbonController::class, 'updatekeuangan'])->name('kasbon.updatekeuangan');
                Route::get('/persetujuan/kasbon/search', [KasbonController::class, 'searchkeuangan'])->name('kasbon.searchkeuangan');
                Route::get('/persetujuan/kasbon/export', [KasbonController::class, 'exportkeuangan'])->name('kasbon.exportkeuangan');
                Route::get('/persetujuan/kasbon/cetak/{id}/persetujuan', [KasbonController::class, 'persetujuann'])->name('kasbon.persetujuann');

             
       

                Route::get('/mutasi', [MutasiController::class, 'indexkeuangan'])->name('mutasi.indexkeuangan');
                Route::get('/mutasi/create', [MutasiController::class, 'createkeuangan'])->name('mutasi.createkeuangan');
                Route::POST('/mutasi/create', [MutasiController::class, 'storekeuangan'])->name('mutasi.storekeuangan');
                Route::get('/mutasi/hapus/{id}', [MutasiController::class, 'destroykeuangan'])->name('mutasi.destroykeuangan');
                Route::get('/mutasi/edit/{id}', [MutasiController::class, 'editkeuangan'])->name('mutasi.editkeuangan');
                Route::PUT('/mutasi/edit/{id}', [MutasiController::class, 'updatekeuangan'])->name('mutasi.updatekeuangan');
                Route::get('/mutasi/search', [MutasiController::class, 'searchkeuangan'])->name('mutasi.searchkeuangan');
                Route::get('/mutasi/destroy/{id}', [MutasiController::class, 'destroykeuangan'])->name('mutasi.destroykeuangan');
                Route::get('/mutasi/export', [MutasiController::class, 'exportkeuangan'])->name('mutasi.exportkeuangan');
                Route::get('/mutasi/detail/{id}', [MutasiController::class, 'detailkeuangan'])->name('mutasi.detailkeuangan');

         
                
                Route::get('/laporan', [MutasiController::class, 'laporan'])->name('mutasi.laporan');
                Route::get('/laporan/bukubesar', [MutasiController::class, 'laporanbukubesar'])->name('mutasi.laporanbukubesar');
                Route::get('/laporan/neraca', [MutasiController::class, 'neraca'])->name('mutasi.neraca');
                Route::get('/laporan/realisasi/anggaran', [MutasiController::class, 'realisasianggaran'])->name('mutasi.realisasianggaran');
                Route::get('/laporan/perubahan/anggaran', [MutasiController::class, 'perubahan'])->name('mutasi.perubahan');




                Route::get('/pengajuan', [TasarufController::class, 'pengajuanku'])->name('tasaruf.pengajuanku');
                Route::get('/pengajuan/detail/{id}', [TasarufController::class, 'detailpengajuanku'])->name('tasaruf.detailpengajuanku');
                Route::post('/pengajuan/detail/{id}', [TasarufController::class, 'postdetailpengajuanku'])->name('tasaruf.postdetailpengajuanku');
                Route::get('/pengajuan/hapus/{id}', [TasarufController::class, 'hapuspengajuanku'])->name('tasaruf.hapuspengajuanku');
                Route::get('/pengajuan/detail/lihat/{id}', [TasarufController::class, 'detaillihatpengajuanku'])->name('tasaruf.detaillihatpengajuanku');
                Route::get('/pengajuan/detail/pending/{id}', [TasarufController::class, 'detaillihatpengajuanpku'])->name('tasaruf.detaillihatpengajuanpku');
                Route::get('/pengajuan/detail/cetak/{id}', [TasarufController::class, 'cetakdetaillihatpengajuanku'])->name('tasaruf.cetakdetaillihatpengajuanku');
                
        });    
});
/************************ Dashboard Routes Ends ******************************/ 