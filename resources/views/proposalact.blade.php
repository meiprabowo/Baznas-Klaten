@section('title',$title)
@extends('layout.app')
@section('content')
@php
use Carbon\Carbon;
@endphp
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop-breadcrumb">

                            <div class="breadcrumb-main">
                                <h4 class="text-capitalize breadcrumb-title">Data Pengaju Proposal </h4>
                                <div class="breadcrumb-action justify-content-center flex-wrap">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>Beranda </a></li>
                                            <li class="breadcrumb-item active" aria-current="page"> Laporan Tahunan  </li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
               <!-- Display success message -->
            <div class="container-fluid">

            

        
                <div class="row">
                    <div class="col-lg-12">
                        <div class="userDatatable orderDatatable sellerDatatable global-shadow mb-30 py-30 px-sm-30 px-20 radius-xl w-100">

                        <?php if(!empty($data)) { ?>


                            <div class="card">
                    <div class="card-header">
                        <h5>Pemohon</h5>
                    </div>


                    <div class="card-body">
                     
                    <div class="row g-3">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="validationDefault02">Kode Proposal : </label>
                                    {{ $data->nomor_proposal }}
                                  
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="validationDefault02">Nama Pemohon:</label>
                                    {{ $data->nama_pemohon }}
                                  
                                </div>
                             
                             </div>
                          
                                           
                             <div class="row g-3">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="validationDefault02">Tanggal Permohonan : </label>
                                   <?php
                                       $tanggal = Carbon::parse($data->tanggal_masuk)->format('d F Y');
                                       $tanggal_survey = Carbon::parse($data->tanggal_survey)->format('d F Y');
                                       $tanggal_penetapan = Carbon::parse($data->tanggal_penetapan)->format('d F Y');
                                       ?> {{ $tanggal }}
                                  
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="validationDefault02">Nomor HP:</label>
                                    {{ $data->hp }}
                                  
                                </div>
                             
                             </div>
                          
                                           
                         
                                           
        
                        
  
        
                        

                      </div>
                    </div>





                            <!-- <div class="widget-header-title px-20 py-15">
                           <h6 class="d-flex align-content-center fw-500">
                              Kode Proposal : {{ $data->nomor_proposal }}
                           </h6>
                        </div> -->
                            <br/>
                            <div class="table-responsive">
                            <table class="table table-border-horizontal">
                                <thead>
                                    <tr>
                                    <th width="5%">No</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Keterangan</th>

                                    </tr>
                                </thead>
                                <tbody>
                                
                                    <tr>
                                        <td>1.</td>
                                        <td> {{ $tanggal }} </td>
                                        <td> Terdaftar di System</td>
                                    </tr>
                                    <?php if(!empty($data->petugas_survey)) { ?>
                                    <tr>
                                        <td>2.</td>
                                        <td> {{ $tanggal_survey }} </td>
                                        <td> Masuk pada tahapan On Proses Survey</td>
                                    </tr>
                                    <?php if(!empty($data->tanggal_penetapan)) { ?>
                                    <tr>
                                        <td>3.</td>
                                        <td> {{ $tanggal_penetapan }} </td>
                                        <td> <?php if($data->status == 'A') { ?>
                                            Proposal Anda diterima, selanjutnya menunggu pendistribusian barang dari total_nominal_kemarin
                                             <?php } ?>
                                             <?php if($data->status == 'N') { ?>
                                                Mohon Maaf, Proposal Anda belum bisa di setujui
                                                <?php } ?>
                                        </td>
                                    </tr>

                                        <?php } ?>
                                    <?php } ?>

                                    
                                
                                </tbody>
                            </table>
                            </div>

                        <?php } else { ?>
                        
                        
                        <center><h1>MOHON MAAF... !! DATA TIDAK DI TEMUKAN</h1>
                        <br/>
                        <br/>
                        <a href="{{ route('cekproposal') }}">  <button type="button" class="btn btn-danger btn-xs btn-squared">KEMBALI</button></a>

                    </center>


                        <?php } ?>


                           
                            
                        </div>
                    </div>
    </div>
</div>
@endsection



