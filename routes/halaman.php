<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HalamanController;
use App\Http\Controllers\LaporanController;

/************************ Dashboard Routes Start ******************************/

Route::get('/executive-summary',[HalamanController::class,'rekap'])->name('rekap');
Route::get('/pengumpulan/detail',[HalamanController::class,'rekappengumpulan'])->name('rekappengumpulan');
Route::get('/pendistribusian/detail',[HalamanController::class,'rekappendistribusian'])->name('rekappendistribusian');
Route::get('/laporan-tahunan',[HalamanController::class,'laporantahunan'])->name('laporantahunan');
Route::get('/cek/proposal',[HalamanController::class,'cekproposal'])->name('cekproposal');
Route::post('/cek/proposal/data',[HalamanController::class,'cekproposalact'])->name('cekproposalact');
Route::get('/cek/storan',[HalamanController::class,'cekstoran'])->name('cekstoran');
Route::post('/cek/storan/data',[HalamanController::class,'cekstoranact'])->name('cekstoranact');
Route::get('/cek/download/{id}/{random}/{userr}',[HalamanController::class,'download'])->name('download');
Route::get('/info-grafis',[HalamanController::class,'infografis'])->name('infografis');
Route::get('/blog',[HalamanController::class,'blog'])->name('blog');
Route::get('/agenda/agendabaznasboyolaliyangselalutersetrukturdansistematis.baznasboyolalijayaselamanya.sejahteraBaznasBoyolali jugamenggelarprogram-programkemanusiaanlainnya,sepertipembagiansembakobagikeluargakurangmampu,penyediaanfasilitaskesehatangratis,danpelatihanketerampilanuntukmeningkatkankemandirianekonomimasyarakat/',[HalamanController::class,'agenda'])->name('agenda');
Route::get('/blog/{id}/{detail}',[HalamanController::class,'detailblog'])->name('detailblog');
Route::get('/realisasi/{id}/{kecamatan}',[HalamanController::class,'perkecamatan'])->name('perkecamatan');
Route::get('/kirim/wa',[HalamanController::class,'wakirim'])->name('wakirim');
Route::get('/kirim/whatsapp',[HalamanController::class,'wakirima'])->name('wakirima');




/************************ Dashboard Routes Ends ******************************/ 