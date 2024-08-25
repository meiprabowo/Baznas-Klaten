<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KasbonController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\MutasiController;
use App\Http\Controllers\TasarufController;



/************************ Dashboard Routes Start ******************************/
Route::group(['middleware'=>'checkRole:A,PR'],function(){
        Route::group(['prefix'=>'pendistribusian','as'=>'pendistribusian.'],function(){
            
                /************************ Kasbon Routes Start ******************************/
                Route::get('/kasbon', [KasbonController::class, 'indexpd'])->name('kasbon.indexpd');
                Route::get('/kasbon/create', [KasbonController::class, 'createpd'])->name('kasbon.createpd');
                Route::POST('/kasbon/create', [KasbonController::class, 'storepd'])->name('kasbon.storepd');
                Route::get('/kasbon/hapus/{id}', [KasbonController::class, 'destroypd'])->name('kasbon.destroypd');
                Route::get('/kasbon/edit/{id}', [KasbonController::class, 'editpd'])->name('kasbon.editpd');
                Route::PUT('/kasbon/edit/{id}', [KasbonController::class, 'updatepd'])->name('kasbon.updatepd');
                Route::get('/kasbon/search', [KasbonController::class, 'searchpd'])->name('kasbon.searchpd');
                Route::get('/kasbon/destroy/{id}', [KasbonController::class, 'destroypd'])->name('kasbon.destroypd');
                Route::get('/kasbon/export', [KasbonController::class, 'exportpd'])->name('kasbon.exportpd');
                Route::get('/kasbon/cetak', [KasbonController::class, 'cetakpd'])->name('kasbon.cetakpd');
                Route::get('/kasbon/detail/{id}', [KasbonController::class, 'detailpd'])->name('kasbon.detailpd');
                Route::get('/persetujuan/kasbon/cetak/{id}', [KasbonController::class, 'cetakkeuangan'])->name('kasbon.cetakkeuangan');

                /************************ Pembelian Routes Start ******************************/
                Route::get('/pembelian', [PembelianController::class, 'index'])->name('pembelian.index');
                Route::get('/pembelian/create', [PembelianController::class, 'create'])->name('pembelian.create');
                Route::POST('/pembelian/create', [PembelianController::class, 'store'])->name('pembelian.store');
                Route::get('/pembelian/hapus/{id}', [PembelianController::class, 'destroy'])->name('pembelian.destroy');
                Route::get('/pembelian/edit/{id}', [PembelianController::class, 'edit'])->name('pembelian.edit');
                Route::PUT('/pembelian/edit/{id}', [PembelianController::class, 'update'])->name('pembelian.update');
                Route::get('/pembelian/search', [PembelianController::class, 'search'])->name('pembelian.search');
                Route::get('/pembelian/destroy/{id}', [PembelianController::class, 'destroy'])->name('pembelian.destroy');
                Route::get('/pembelian/export', [PembelianController::class, 'export'])->name('pembelian.export');
                Route::get('/pembelian/cetak/{id}', [PembelianController::class, 'cetak'])->name('pembelian.cetak');

                /************************ Belum di Proses ******************************/
                Route::get('/tasaruf/belum', [TasarufController::class, 'index'])->name('tasaruf.index');
                Route::get('/tasaruf/belum/uang/{id}', [TasarufController::class, 'edit'])->name('tasaruf.edit');
                Route::POST('/tasaruf/belum/uang/{id}', [TasarufController::class, 'store'])->name('tasaruf.store');
                Route::get('/tasaruf/belum/barang/{id}', [TasarufController::class, 'barang'])->name('tasaruf.barang');
                Route::POST('/tasaruf/belum/barang/{id}', [TasarufController::class, 'barangstore'])->name('tasaruf.barangstore');
                Route::get('/tasaruf/belum/upload', [TasarufController::class, 'upload'])->name('tasaruf.upload');
                Route::get('/tasaruf/belum/export/uang', [TasarufController::class, 'exportuang'])->name('tasaruf.exportuang');
                Route::get('/tasaruf/belum/export/barang', [TasarufController::class, 'exportbarang'])->name('tasaruf.exportbarang');
                Route::POST('/tasaruf/belum/export/uang', [TasarufController::class, 'postuang'])->name('tasaruf.postuang');
                Route::POST('/tasaruf/belum/export/barang', [TasarufController::class, 'postbarang'])->name('tasaruf.postbarang');
                Route::get('/tasaruf/belum/export', [TasarufController::class, 'export'])->name('tasaruf.export');
                Route::get('/tasaruf/belum/search', [TasarufController::class, 'search'])->name('tasaruf.search');
                Route::get('/tasaruf/sudah', [TasarufController::class, 'indexsudah'])->name('tasaruf.indexsudah');
                Route::get('/tasaruf/sudah/uang/{id}', [TasarufController::class, 'edituang'])->name('tasaruf.edituang');
                Route::get('/tasaruf/sudah/barang/{id}', [TasarufController::class, 'editbarang'])->name('tasaruf.editbarang');
                Route::PUT('/tasaruf/sudah/uang/{id}', [TasarufController::class, 'pedituang'])->name('tasaruf.pedituang');
                Route::PUT('/tasaruf/sudah/barang/{id}', [TasarufController::class, 'peditbarang'])->name('tasaruf.peditbarang'); 
                Route::get('/tasaruf/sudah/export', [TasarufController::class, 'exportsudah'])->name('tasaruf.exportsudah');
                Route::get('/tasaruf/sudah/cetak/{id}', [TasarufController::class, 'cetak'])->name('tasaruf.cetak');
                Route::get('/tasaruf/sudah/search', [TasarufController::class, 'searchsudah'])->name('tasaruf.searchsudah');
                Route::get('/tasaruf/sudah/hapus/{id}', [TasarufController::class, 'destroy'])->name('tasaruf.destroy');

                /************************ Mutasi Routes Start ******************************/
                Route::get('/mutasi', [MutasiController::class, 'indexp'])->name('mutasi.indexp');
                Route::get('/mutasi/create', [MutasiController::class, 'createp'])->name('mutasi.createp');
                Route::POST('/mutasi/create', [MutasiController::class, 'storep'])->name('mutasi.storep');
                Route::get('/mutasi/hapus/{id}', [MutasiController::class, 'destroyp'])->name('mutasi.destroyp');
                Route::get('/mutasi/edit/{id}', [MutasiController::class, 'editp'])->name('mutasi.editp');
                Route::PUT('/mutasi/edit/{id}', [MutasiController::class, 'updatep'])->name('mutasi.updatep');
                Route::get('/mutasi/search', [MutasiController::class, 'searchp'])->name('mutasi.searchp');
                Route::get('/mutasi/destroy/{id}', [MutasiController::class, 'destroyp'])->name('mutasi.destroyp');
                Route::get('/mutasi/export', [MutasiController::class, 'exportp'])->name('mutasi.exportp');
                Route::get('/mutasi/detail/{id}', [MutasiController::class, 'detailp'])->name('mutasi.detailp');



                Route::get('/laporan/tasaruf', [TasarufController::class, 'laporan'])->name('tasaruf.laporan');
                Route::get('/laporan/pengajuan', [TasarufController::class, 'pengajuan'])->name('tasaruf.pengajuan');
                Route::get('/laporan/pengajuan/tambah', [TasarufController::class, 'tambahpengajuan'])->name('tasaruf.tambahpengajuan');
                Route::post('/laporan/pengajuan/tambah', [TasarufController::class, 'tambahpengajuanpost'])->name('tasaruf.tambahpengajuanpost');
                Route::get('/laporan/pengajuan/detail/{id}', [TasarufController::class, 'detailpengajuan'])->name('tasaruf.detailpengajuan');
                Route::post('/laporan/pengajuan/detail/{id}', [TasarufController::class, 'postdetailpengajuan'])->name('tasaruf.postdetailpengajuan');
                Route::get('/laporan/pengajuan/hapus/{id}', [TasarufController::class, 'hapuspengajuan'])->name('tasaruf.hapuspengajuan');
                Route::get('/laporan/pengajuan/detail/lihat/{id}', [TasarufController::class, 'detaillihatpengajuan'])->name('tasaruf.detaillihatpengajuan');
                Route::get('/laporan/pengajuan/detail/pending/{id}', [TasarufController::class, 'detaillihatpengajuanp'])->name('tasaruf.detaillihatpengajuanp');
                Route::get('/laporan/pengajuan/detail/cetak/{id}', [TasarufController::class, 'cetakdetaillihatpengajuan'])->name('tasaruf.cetakdetaillihatpengajuan');
                Route::delete('/sudah/destroy', [TasarufController::class, 'destroyy'])->name('tasaruf.destroyy');


                Route::get('/laporan', [MutasiController::class, 'laporanpen'])->name('mutasi.laporanpen');
                Route::get('/laporan/bukubesar', [MutasiController::class, 'laporanbukubesarpen'])->name('mutasi.laporanbukubesarpen');
                Route::get('/laporan/neraca', [MutasiController::class, 'neracapen'])->name('mutasi.neracapen');
                Route::get('/laporan/realisasi/anggaran', [MutasiController::class, 'realisasianggaranpen'])->name('mutasi.realisasianggaranpen');
                Route::get('/laporan/perubahan/anggaran', [MutasiController::class, 'perubahanpen'])->name('mutasi.perubahanpen');







        });     
});
/************************ Dashboard Routes Ends ******************************/ 