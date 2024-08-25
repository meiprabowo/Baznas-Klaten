<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KasbonController;
use App\Http\Controllers\SpjController;
use App\Http\Controllers\MutasiController;
use App\Http\Controllers\LaporantahunanController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\TasarufController;
use App\Http\Controllers\AgendaController;



/************************ Dashboard Routes Start ******************************/
Route::group(['middleware'=>'checkRole:A,SD'],function(){
        Route::group(['prefix'=>'sdm','as'=>'sdm.'],function(){
            
                /************************ Kasbon Routes Start ******************************/
                Route::get('/kasbon', [KasbonController::class, 'index'])->name('kasbon.index');
                Route::get('/kasbon/create', [KasbonController::class, 'create'])->name('kasbon.create');
                Route::POST('/kasbon/create', [KasbonController::class, 'store'])->name('kasbon.store');
                Route::get('/kasbon/hapus/{id}', [KasbonController::class, 'destroy'])->name('kasbon.destroy');
                Route::get('/kasbon/edit/{id}', [KasbonController::class, 'edit'])->name('kasbon.edit');
                Route::PUT('/kasbon/edit/{id}', [KasbonController::class, 'update'])->name('kasbon.update');
                Route::get('/kasbon/search', [KasbonController::class, 'search'])->name('kasbon.search');
                Route::get('/kasbon/destroy/{id}', [KasbonController::class, 'destroy'])->name('kasbon.destroy');
                Route::get('/kasbon/export', [KasbonController::class, 'export'])->name('kasbon.export');
                Route::get('/kasbon/cetak', [KasbonController::class, 'cetak'])->name('kasbon.cetak');
                Route::get('/kasbon/detail/{id}', [KasbonController::class, 'detail'])->name('kasbon.detail');
                Route::get('/kasbon/cetak/{id}', [KasbonController::class, 'cetakkeuangan'])->name('kasbon.cetakkeuangan');

                /************************ Spj Routes Start ******************************/
                Route::get('/spj', [SpjController::class, 'index'])->name('spj.index');
                Route::get('/spj/create', [SpjController::class, 'create'])->name('spj.create');
                Route::POST('/spj/create', [SpjController::class, 'store'])->name('spj.store');
                Route::get('/spj/hapus/{id}', [SpjController::class, 'destroy'])->name('spj.destroy');
                Route::get('/spj/edit/{id}', [SpjController::class, 'edit'])->name('spj.edit');
                Route::PUT('/spj/edit/{id}', [SpjController::class, 'update'])->name('spj.update');
                Route::get('/spj/search', [SpjController::class, 'search'])->name('spj.search');
                Route::get('/spj/destroy/{id}', [SpjController::class, 'destroy'])->name('spj.destroy');
                Route::get('/spj/export', [SpjController::class, 'export'])->name('spj.export');
                Route::get('/spj/cetak', [SpjController::class, 'cetak'])->name('spj.cetak');
                Route::get('/spj/detail/{id}', [SpjController::class, 'detail'])->name('spj.detail');

                /************************ Mutasi Routes Start ******************************/
                Route::get('/mutasi', [MutasiController::class, 'index'])->name('mutasi.index');
                Route::get('/mutasi/create', [MutasiController::class, 'create'])->name('mutasi.create');
                Route::POST('/mutasi/create', [MutasiController::class, 'store'])->name('mutasi.store');
                Route::get('/mutasi/hapus/{id}', [MutasiController::class, 'destroy'])->name('mutasi.destroy');
                Route::get('/mutasi/edit/{id}', [MutasiController::class, 'edit'])->name('mutasi.edit');
                Route::PUT('/mutasi/edit/{id}', [MutasiController::class, 'update'])->name('mutasi.update');
                Route::get('/mutasi/search', [MutasiController::class, 'search'])->name('mutasi.search');
                Route::get('/mutasi/destroy/{id}', [MutasiController::class, 'destroy'])->name('mutasi.destroy');
                Route::get('/mutasi/export', [MutasiController::class, 'export'])->name('mutasi.export');
                Route::get('/mutasi/detail/{id}', [MutasiController::class, 'detail'])->name('mutasi.detail');


                /************************ Informasi Routes Start ******************************/
                Route::get('/informasi', [InformasiController::class, 'index'])->name('informasi.index');
                Route::get('/informasi/create', [InformasiController::class, 'create'])->name('informasi.create');
                Route::POST('/informasi/create', [InformasiController::class, 'store'])->name('informasi.store');
                Route::get('/informasi/hapus/{id}', [InformasiController::class, 'destroy'])->name('informasi.destroy');
                Route::get('/informasi/edit/{id}', [InformasiController::class, 'edit'])->name('informasi.edit');
                Route::PUT('/informasi/edit/{id}', [InformasiController::class, 'update'])->name('informasi.update');
                Route::get('/informasi/search', [InformasiController::class, 'search'])->name('informasi.search');
                Route::get('/informasi/destroy/{id}', [InformasiController::class, 'destroy'])->name('informasi.destroy');
                Route::get('/informasi/export', [InformasiController::class, 'export'])->name('informasi.export');
                Route::get('/informasi/detail/{id}', [InformasiController::class, 'detail'])->name('informasi.detail');


                /************************ Laporantahunan Routes Start ******************************/
                Route::get('/laporsdm', [LaporantahunanController::class, 'index'])->name('laporantahunan.index');
                Route::get('/laporsdm/create', [LaporantahunanController::class, 'create'])->name('laporantahunan.create');
                Route::POST('/laporsdm/create', [LaporantahunanController::class, 'store'])->name('laporantahunan.store');
                Route::get('/laporsdm/hapus/{id}', [LaporantahunanController::class, 'destroy'])->name('laporantahunan.destroy');
                Route::get('/laporsdm/edit/{id}', [LaporantahunanController::class, 'edit'])->name('laporantahunan.edit');
                Route::PUT('/laporsdm/edit/{id}', [LaporantahunanController::class, 'update'])->name('laporantahunan.update');
                Route::get('/laporsdm/search', [LaporantahunanController::class, 'search'])->name('laporantahunan.search');
                Route::get('/laporsdm/destroy/{id}', [LaporantahunanController::class, 'destroy'])->name('laporantahunan.destroy');


                /************************ Agenda Routes Start ******************************/
                Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda.index');
                Route::get('/agenda/create', [AgendaController::class, 'create'])->name('agenda.create');
                Route::POST('/agenda/create', [AgendaController::class, 'store'])->name('agenda.store');
                Route::get('/agenda/hapus/{id}', [AgendaController::class, 'destroy'])->name('agenda.destroy');
                Route::get('/agenda/edit/{id}', [AgendaController::class, 'edit'])->name('agenda.edit');
                Route::PUT('/agenda/edit/{id}', [AgendaController::class, 'update'])->name('agenda.update');
                Route::get('/agenda/search', [AgendaController::class, 'search'])->name('agenda.search');
                Route::get('/agenda/destroy/{id}', [AgendaController::class, 'destroy'])->name('agenda.destroy');
                Route::get('/agenda/export', [AgendaController::class, 'export'])->name('agenda.export');
                Route::get('/agenda/detail/{id}', [AgendaController::class, 'detail'])->name('agenda.detail');

                /************************ Persuratan ******************************/

                Route::get('/surat-keluar', [SuratController::class, 'index'])->name('surat.index');
                Route::get('/surat-masuk', [SuratController::class, 'masuk'])->name('surat.masuk');
                Route::get('/surat-masuk/tambah', [SuratController::class, 'tambah'])->name('surat.tambah');
                Route::get('/tulis-surat', [SuratController::class, 'create'])->name('surat.create');
                Route::POST('/create', [SuratController::class, 'store'])->name('surat.store');
                Route::POST('/storemasuk', [SuratController::class, 'storemasuk'])->name('surat.storemasuk');
                Route::get('/cetak/{id}', [SuratController::class, 'show'])->name('surat.show');
                Route::get('/surat-keluar/edit/{id}', [SuratController::class, 'edit'])->name('surat.edit');
                Route::get('/surat-masuk/edit/{id}', [SuratController::class, 'editmasuk'])->name('surat.editmasuk');
                Route::PUT('/surat-masuk/edit/{id}', [SuratController::class, 'updatemasuk'])->name('surat.updatemasuk');
                Route::PUT('/edit/{id}', [SuratController::class, 'update'])->name('surat.update');
                Route::get('/hapus/{id}', [SuratController::class, 'destroy'])->name('surat.destroy');
                Route::get('/surat-masuk/delete/{id}', [SuratController::class, 'hapus'])->name('surat.hapus');
                Route::get('/surat-masuk/download', [SuratController::class, 'export'])->name('surat.export');
                Route::get('/surat-keluar/download', [SuratController::class, 'download'])->name('surat.download');
                Route::get('/surat-keluar/search', [SuratController::class, 'search'])->name('surat.search');
                Route::get('/surat-masuk/search', [SuratController::class, 'cari'])->name('surat.cari');
                Route::get('/surat-keluar/cetak/{id}', [SuratController::class, 'cetak'])->name('surat.cetak');


 
                
                Route::get('/laporan/tasaruf', [TasarufController::class, 'laporansdm'])->name('tasaruf.laporansdm');
                Route::get('/laporan/pengajuan', [TasarufController::class, 'pengajuansdm'])->name('tasaruf.pengajuansdm');
                Route::get('/laporan/pengajuan/tambah', [TasarufController::class, 'tambahpengajuansdm'])->name('tasaruf.tambahpengajuansdm');
                Route::post('/laporan/pengajuan/tambah', [TasarufController::class, 'tambahpengajuanpostsdm'])->name('tasaruf.tambahpengajuanpostsdm');
                Route::get('/laporan/pengajuan/detail/{id}', [TasarufController::class, 'detailpengajuansdm'])->name('tasaruf.detailpengajuansdm');
                Route::post('/laporan/pengajuan/detail/{id}', [TasarufController::class, 'postdetailpengajuansdm'])->name('tasaruf.postdetailpengajuansdm');
                Route::get('/laporan/pengajuan/hapus/{id}', [TasarufController::class, 'hapuspengajuansdm'])->name('tasaruf.hapuspengajuansdm');
                Route::get('/laporan/pengajuan/detail/lihat/{id}', [TasarufController::class, 'detaillihatpengajuansdm'])->name('tasaruf.detaillihatpengajuansdm');
                Route::get('/laporan/pengajuan/detail/pending/{id}', [TasarufController::class, 'detaillihatpengajuanpsdm'])->name('tasaruf.detaillihatpengajuanpsdm');
                Route::get('/laporan/pengajuan/detail/cetak/{id}', [TasarufController::class, 'cetakdetaillihatpengajuansdm'])->name('tasaruf.cetakdetaillihatpengajuansdm');






                
        });    
});
/************************ Dashboard Routes Ends ******************************/ 