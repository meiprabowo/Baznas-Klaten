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
                                <h4 class="text-capitalize breadcrumb-title">Data Agenda</h4>
                                <div class="breadcrumb-action justify-content-center flex-wrap">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>SDM Umum</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Agenda</li>
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
                        <h5>Form Tambah Agenda</h5>
                    </div>


                    <div class="card-body">
                        <form method="POST" action="{{ route('sdm.agenda.store') }}" enctype="multipart/form-data">
                        @csrf
                            <div class="row g-3">
                            <div class="col-md-12 mb-3">
                                    <label class="form-label" for="validationDefault02">Kegiatan</label>
                                    <input class="form-control" type="text" name="kegiatan" >
                                  
                                </div>
                             
                              
                             
                             </div>
                          
                                             
        
                            <div class="row g-3">
                            
                            <div class="col-md-12 mb-3">
                                    <label class="form-label" for="validationDefault02">Waktu Pelaksanaan</label>
                                    <input class="form-control" type="text" name="waktu_pelaksanaan" >
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



