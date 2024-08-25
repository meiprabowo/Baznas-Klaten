<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\AkunkeuanganController;
use App\Http\Controllers\WilayahController;


 
/************************ Dashboard Routes Start ******************************/
Route::group(['middleware'=>'checkRole:A,PR'],function(){
        Route::group(['prefix'=>'proposal','as'=>'proposal.'],function(){
            
                /************************ Proposal Routes Start ******************************/
                Route::get('/permohonan', [ProposalController::class, 'index'])->name('proposal.index');
                Route::get('/permohonan/create/{id}', [ProposalController::class, 'create'])->name('proposal.create');
                Route::POST('/permohonan/create', [ProposalController::class, 'store'])->name('proposal.store');
                Route::get('/permohonan/hapus/{id}', [ProposalController::class, 'destroy'])->name('proposal.destroy');
                Route::get('/permohonan/edit/{id}', [ProposalController::class, 'edit'])->name('proposal.edit');
                Route::get('/permohonan/proses/{id}', [ProposalController::class, 'prosess'])->name('proposal.prosess');
                Route::get('/permohonan/getkelurahan/{id}', [ProposalController::class, 'getkelurahan'])->name('proposal.getkelurahan');
                Route::get('/permohonan/getsubprogram/{id}', [ProposalController::class, 'getsubprogram'])->name('proposal.getsubprogram');
                Route::get('/permohonan/detailprogram/{id}', [ProposalController::class, 'detailprogram'])->name('proposal.detailprogram');
                Route::get('/permohonan/getsubprogramm/{id}', [ProposalController::class, 'getsubprogramm'])->name('proposal.getsubprogramm');
                Route::get('/permohonan/detailprogramm/{id}', [ProposalController::class, 'detailprogramm'])->name('proposal.detailprogramm');
                Route::get('/permohonan/survey/{id}', [ProposalController::class, 'cetaksurvey'])->name('proposal.cetaksurvey');
                Route::get('/permohonan/bukti/{id}', [ProposalController::class, 'bukti'])->name('proposal.bukti');
                Route::PUT('/permohonan/edit/{id}', [ProposalController::class, 'update'])->name('proposal.update');
                Route::PUT('/permohonan/edit/proses/{id}', [ProposalController::class, 'postprosess'])->name('proposal.postprosess');
                Route::get('/permohonan/search', [ProposalController::class, 'search'])->name('proposal.search');
                Route::get('/permohonan/destroy/{id}', [ProposalController::class, 'destroy'])->name('proposal.destroy');
                Route::delete('/permohonan/destroy', [ProposalController::class, 'destroyy'])->name('proposal.destroyy');
                Route::get('/permohonan/export', [ProposalController::class, 'export'])->name('proposal.export');
                Route::get('/permohonan/cetak', [ProposalController::class, 'cetak'])->name('proposal.cetak');
                Route::get('/permohonan/upload', [ProposalController::class, 'upload'])->name('proposal.upload');
                Route::get('/permohonan/detail/{id}', [ProposalController::class, 'detail'])->name('proposal.detail');
                Route::POST('/permohonan/import/perseorangan', [ProposalController::class, 'importperseorang'])->name('proposal.importperseorang');
                Route::POST('/permohonan/import/lembaga', [ProposalController::class, 'importlembaga'])->name('proposal.importlembaga');
                Route::get('/permohonan/search', [ProposalController::class, 'search'])->name('proposal.search');

                /************************ Proposal Export ******************************/
                Route::get('/permohonan/all', [ProposalController::class, 'all'])->name('proposal.all');
                Route::get('/permohonan/allonproses', [ProposalController::class, 'allonproses'])->name('proposal.allonproses');
                Route::get('/permohonan/diterima/export', [ProposalController::class, 'diterimaex'])->name('proposal.diterimaex');
                Route::get('/permohonan/ditolak/export', [ProposalController::class, 'ditolakex'])->name('proposal.ditolakex');



                /************************ Proposal Peseorangan ******************************/
                Route::get('/permohonan/perseorangan', [ProposalController::class, 'perseorangan'])->name('proposal.perseorangan');
                Route::get('/permohonan/perseorangan/hapus/{id}', [ProposalController::class, 'pdestroy'])->name('proposal.pdestroy');
                Route::get('/permohonan/perseorangan/edit/{id}', [ProposalController::class, 'pedit'])->name('proposal.pedit');
                Route::get('/permohonan/perseorangan/export', [ProposalController::class, 'pexport'])->name('proposal.pexport');
                Route::get('/permohonan/perseorangan/search', [ProposalController::class, 'psearch'])->name('proposal.psearch');
                Route::get('/permohonan/perseorangan/create/{id}', [ProposalController::class, 'pcreate'])->name('proposal.pcreate');
                Route::POST('/permohonan/perseorangan/create', [ProposalController::class, 'pstore'])->name('proposal.pstore');
                Route::PUT('/permohonan/perseorangan/edit/{id}', [ProposalController::class, 'pupdate'])->name('proposal.pupdate');






                /************************ Proposal Lembaga ******************************/
                Route::get('/permohonan/lembaga', [ProposalController::class, 'lembaga'])->name('proposal.lembaga');
                Route::get('/permohonan/lembaga/hapus/{id}', [ProposalController::class, 'ldestroy'])->name('proposal.ldestroy');
                Route::get('/permohonan/lembaga/edit/{id}', [ProposalController::class, 'ledit'])->name('proposal.ledit');
                Route::get('/permohonan/lembaga/export', [ProposalController::class, 'lexport'])->name('proposal.lexport');
                Route::get('/permohonan/lembaga/search', [ProposalController::class, 'lsearch'])->name('proposal.lsearch');
                Route::get('/permohonan/lembaga/create/{id}', [ProposalController::class, 'lcreate'])->name('proposal.lcreate');
                Route::POST('/permohonan/lembaga/create', [ProposalController::class, 'lstore'])->name('proposal.lstore');
                Route::PUT('/permohonan/lembaga/edit/{id}', [ProposalController::class, 'lupdate'])->name('proposal.lupdate');








                /************************ Proposal Proses Start ******************************/
   
                Route::get('/proses', [ProposalController::class, 'proses'])->name('proposal.proses');
                Route::POST('/proses/bagi', [ProposalController::class, 'prosesbagi'])->name('proposal.prosesbagi');
                Route::get('/proses/upload', [ProposalController::class, 'prosesupload'])->name('proposal.prosesupload');
                Route::get('/proses/export', [ProposalController::class, 'prosesexport'])->name('proposal.prosesexport');
                Route::POST('/proses/importproses', [ProposalController::class, 'importproses'])->name('proposal.importproses');
                Route::get('/proses/search', [ProposalController::class, 'searchproses'])->name('proposal.searchproses');


                /************************ Proposal Tindak Lanjut Start ******************************/

                Route::get('/lanjut', [ProposalController::class, 'lanjut'])->name('proposal.lanjut');
                Route::POST('/lanjut/bagi', [ProposalController::class, 'prosestindaklanjut'])->name('proposal.prosestindaklanjut');
                Route::get('/lanjut/upload', [ProposalController::class, 'lanjutupload'])->name('proposal.lanjutupload');
                Route::get('/lanjut/export', [ProposalController::class, 'lanjutexport'])->name('proposal.lanjutexport');
                Route::POST('/lanjut/importproses', [ProposalController::class, 'lanjutimport'])->name('proposal.lanjutimport');
                Route::get('/lanjut/search', [ProposalController::class, 'lanjutsearch'])->name('proposal.lanjutsearch');


                /************************ Proposal Proses Akhir ******************************/

                Route::get('/akhir', [ProposalController::class, 'akhir'])->name('proposal.akhir');
                Route::get('/akhir/edit/{id}', [ProposalController::class, 'editakhir'])->name('proposal.editakhir');
                Route::get('/akhir/detail/{id}', [ProposalController::class, 'detailakhir'])->name('proposal.detailakhir');
                Route::PUT('/akhir/edit/{id}', [ProposalController::class, 'postakhir'])->name('proposal.postakhir');
                Route::get('/akhir/search', [ProposalController::class, 'searchakhir'])->name('proposal.searchakhir');
                Route::get('/akhir/export', [ProposalController::class, 'exportakhir'])->name('proposal.exportakhir');




                Route::get('/kirimwa/penerimaan', [ProposalController::class, 'kirimwa'])->name('proposal.kirimwa');
                Route::get('/kirimwa/status/akhir', [ProposalController::class, 'kirimwas'])->name('proposal.kirimwas');
                Route::get('/kirimwa/status/terakhir', [ProposalController::class, 'kirimwasa'])->name('proposal.kirimwasa');


                Route::get('/gis', [ProposalController::class, 'gis'])->name('proposal.gis');




                Route::get('/download/master/perseorangan', [ProposalController::class, 'ddownload'])->name('proposal.ddownload');
                Route::get('/akun', [AkunkeuanganController::class, 'index'])->name('akun.index');
                Route::get('/wilayah/full', [WilayahController::class, 'full'])->name('wilayah.full');
                Route::get('/akun/search', [AkunkeuanganController::class, 'search'])->name('akun.search');









        });    
});
/************************ Dashboard Routes Ends ******************************/ 