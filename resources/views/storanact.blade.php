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
                                <h4 class="text-capitalize breadcrumb-title">Cek Setoran </h4>
                                <div class="breadcrumb-action justify-content-center flex-wrap">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>Beranda </a></li>
                                            <li class="breadcrumb-item active" aria-current="page"> Cek Setoran  </li>
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
                        <h5>Muzaki</h5>
                    </div>


                    <div class="card-body">
                     
                    <div class="row g-3">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="validationDefault02">NPWZ : </label>
                                    {{ $data->npwz }}
                                  
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="validationDefault02">Nama :</label>
                                    {{ $data->nama_muzaki }}
                                  
                                </div>
                             
                             </div>
                          
                                           
                             <div class="row g-3">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="validationDefault02">HP : </label>
                                  {{ $data->hp }}
                                  
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="validationDefault02">Alamat:</label>
                                    {{ $data->alamat }}
                                  
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
                                        <th scope="col">Kode Transaksi</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Aksi</th>

                                    </tr>
                                </thead>
                                <tbody>
                                <?php $no = 1; ?>

@if($kas)
    @foreach($kas as $key => $item)
  <?php   $randomText = Str::random(45); // Menghasilkan string acak dengan panjang 10 karakter ?>

    <?php 
                                          $tanggal = Carbon::parse($item->tanggal)->format('d F Y');

                     ?>
                             <tr>
            <td>{{ $no }}</td>
            <td>{{ $item->kode_transaksi }}</td>
            <td>{{ $tanggal }}</td>
            <td>{{ 'Rp ' . number_format($item->jumlah, 0, ',', '.')}},-</td>
            <td><b><a href="{{ route('download', ['id' => $item->kode_transaksi, 'random' => $randomText, 'userr' => $data->id]) }}" target="_blank">Download Bukti</a></td>
        </tr>
        <?php $no++; ?>
    @endforeach
@else
    <tr>
        <td colspan="4">Data kas tidak tersedia.</td>
    </tr>
@endif


                                       
                                  
                                    
                                
                                </tbody>
                            </table>
                            </div>

                        <?php } else { ?>
                        
                        
                        <center><h1>MOHON MAAF... !! DATA TIDAK DI TEMUKAN</h1>
                        <br/>
                        <br/>
                        <a href="{{ route('cekstoran') }}">  <button type="button" class="btn btn-danger btn-xs btn-squared">KEMBALI</button></a>

                    </center>


                        <?php } ?>


                           
                            
                        </div>
                    </div>
    </div>
</div>
@endsection



