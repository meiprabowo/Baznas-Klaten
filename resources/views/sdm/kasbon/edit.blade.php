@section('title',$title)
@extends('layout.app')
@section('content')
<?php
use Carbon\Carbon;
$date = Carbon::now()->format('Y-m-d');
?>
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop-breadcrumb">

                            <div class="breadcrumb-main">
                                <h4 class="text-capitalize breadcrumb-title">Data Kasbon</h4>
                                <div class="breadcrumb-action justify-content-center flex-wrap">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>Kasbon</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Data Kasbon</li>
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
                        <h5>Form Tambah Kasbon</h5>
                    </div>


                    <div class="card-body">
                    <form method="POST"  action="{{ route('sdm.kasbon.update', $data->id) }}" enctype="multipart/form-data">
                            @csrf                             @method('PUT')
                            <div class="row g-3">
                                <div class="col-md-3 mb-3">
                                    <label class="form-label" for="validationDefault02">Tanggal</label>
                                    <input class="form-control" type="date" name="tanggal" value="{{ $data->tanggal }}">
                                  
                                </div>
                                <div class="col-md-5 mb-3">
                                    <label class="form-label" for="validationDefault02">Jumlah</label>
                                    <input class="form-control" id="validationDefault01" type="text" value="{{ number_format($data->jumlah, 0, ',', '.') }}" name="jumlah" oninput="formatNominal(this)">
                                </div>
                             </div>
                            
                                           
                            <div class="row g-3">
                               
                                <div class="col-md-12 mb-3">
                                    <label class="form-label" for="validationDefault02">Keterangan</label>
                                    <input class="form-control" id="validationDefault01" type="text" value="{{ $data->keterangan }}" name="keterangan" >

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



