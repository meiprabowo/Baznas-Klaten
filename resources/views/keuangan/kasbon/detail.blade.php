@section('title',$title)
@extends('layout.app')
@section('content')
<?php
use Carbon\Carbon;
$date = Carbon::now()->format('Y-m-d');
if ($data->tgll!='') {
    $tglllll = $data->tgll ;
} else {
    $tglllll = $date;
}
?>
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop-breadcrumb">

                            <div class="breadcrumb-main">
                                <h4 class="text-capitalize breadcrumb-title">Data Transaksi Pengumpulan</h4>
                                <div class="breadcrumb-action justify-content-center flex-wrap">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>Pengumpulan</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Transaksi</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
         <div class="card">
                    <div class="card-header">
                        <h5>Form Tambah Transaksi Pengumpulan</h5>
                    </div>


                    <div class="card-body">
                    <form method="POST"  action="{{ route('keuangan.kasbon.persetujuan', $data->id) }}" enctype="multipart/form-data">
                        @csrf
                            <div class="row g-3">
                            <div class="col-md-4 mb-3">
                                    <label class="form-label" for="validationDefault02">Kode Kasbon</label>
                                    <input class="form-control" type="text"  value="{{ $data->kode_kasbon }}" disabled>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="validationDefault02">Pemohon</label>
                                    @if($data->pemohon == 'SDM')
                                    <input class="form-control" type="text" value="SDM Umum" disabled>
                                    @else 
                                    <input class="form-control" type="text" value="Pendistribusian" disabled>
                                    @endif
                                </div>
                            </div>
                            <div class="row g-3">
                               
                                <div class="col-md-3 mb-3">
                                    <?php 
                     $tanggal = Carbon::parse($data->tanggal)->format('d F Y');
                     ?>
                                    <label class="form-label" for="validationDefault02">Tanggal</label>
                                    <input class="form-control" type="text" name="tanggal" value="{{ $tanggal }}" disabled>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="validationDefault02">Nominal Pengajuan</label>
                                    <input class="form-control" id="validationDefault01" type="text" name="jumlah" value="Rp. {{ number_format($data->jumlah, 0, ',', '.') }},-" disabled>
                                </div>
                             </div>
                             <div class="row g-3">
                                <div class="col-md-2 mb-3">
                                    <label class="form-label" for="validationDefault02">Tanggal</label>
                                    <input class="form-control" type="date" name="tanggal_acc" value="{{ $tglllll }}" >
                                </div>
                       
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="validationDefault02">Nominal ACC</label>
                                    <input class="form-control" id="validationDefault01" type="text" name="jml_acc" value="{{ number_format($data->jml, 0, ',', '.') }}" oninput="formatNominal(this)">

                                </div>
                          
                               
                            </div>
                                         
                            
                            <div class="row g-3">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="validationDefault02">Sumber</label>
                                    <div class="dm-select ">
                                        <select name="sumber" class="form-control ">      
                                        @foreach($sumber as $key => $d)
                                        <option value="{{ $d->id }}"  {{ $d->id == $data->kredit ? 'selected' : '' }}> {{ $d->uraian }}</option>
                                        @endforeach
                                      </select>
                                    </div>  
                                </div>
                       
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="validationDefault02">Tujuan</label>
                                    <div class="dm-select ">
                                        <select name="keperluan" class="form-control ">      
                                        @foreach($tujuan as $tu => $t)
                                        <option value="{{ $t->id }}"  {{ $t->id == $data->debet ? 'selected' : '' }} > {{ $t->uraian }}</option>
                                        @endforeach
                                      </select> 
                                    </div> 
                                </div>
                          
                               
                            </div>
                                         



                            <div class="row g-3">
                            
                           
                                <div class="col-md-8 mb-3">
                                    <label class="form-label" for="validationDefault02">Keterangan</label>
                                    <input class="form-control" id="validationDefault01" type="text" name="keterangan"  value="{{ $data->ket }}" placeholder="Keterangan">
                                </div>
                            </div>
                                           
        
                        
        
                        

                          <button class="btn btn-primary" type="submit">Simpan</button>
                        </form>
                      </div>
                    </div>



                
                        </form>
                    </div>
                </div>
      </div>
   </div>
</div>
@endsection



