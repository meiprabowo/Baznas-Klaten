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
                                <h4 class="text-capitalize breadcrumb-title">Laporan Data Transaksi Pengumpulan </h4>
                                <div class="breadcrumb-action justify-content-center flex-wrap">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>Pengumpulan </a></li>
                                            <li class="breadcrumb-item active" aria-current="page"> Transaksi  </li>
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
                    <div class="row">
                    <div class="col-lg-12">
                        <div class="userDatatable orderDatatable sellerDatatable global-shadow mb-30 py-30 px-sm-30 px-20 radius-xl w-100">
                           
                            
                            <div class="table-responsive">
                            <table class="table table-border-horizontal">
                  <thead>
                     <tr>
                     <th scope="col" width="3%">No</th>
                     <th scope="col">Nama UPZ</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">s/d Bulan lalu</th>
                        <th scope="col">Zakat</th>
                        <th scope="col">Infak</th>
                        <th scope="col">Total Bulan ini</th>
                        <th scope="col">Jumlah</th>

                     </tr>
                  </thead>
                  <tbody>  
                  <?php $no=1; ?>
                     @foreach($data as $key => $d)
                     <?php 
                                          $tanggal = Carbon::parse($d['tanggal'])->format('d F Y');

                     ?>
                     <tr>
                     <td>{{ $no }}</td>
                     <td>{{ $d->nama_muzaki }}</td>
                        <td>{{ $tanggal }}</td>
                        <td>{{ 'Rp ' . number_format($d->jmlblnkemarin, 0, ',', '.')}}</td>
                        <td>{{ 'Rp ' . number_format($d->zakattotal, 0, ',', '.')}}</td>
                        <td>{{ 'Rp ' . number_format($d->infaqtotal, 0, ',', '.')}}</td>
                        <td><?php $totalbln = $d->infaqtotal + $d->zakattotal  ; ?> {{ 'Rp ' . number_format($totalbln, 0, ',', '.')}}</td>
                        <td><?php $total = $d->jmlblnkemarin + $totalbln ; ?> {{ 'Rp ' . number_format($total, 0, ',', '.')}}</td>
                        
                     </tr>
                     <?php $no++; ?>
                     @endforeach
                 
                  </tbody>
               </table>
                            </div>

                            <div class="d-flex justify-content-end mt-15 pt-25 border-top">

                              <nav class="dm-page ">
                                <ul class="dm-pagination d-flex">
                                    {{ $data->onEachSide(2)->withQueryString()->links('pagination') }}
                                </ul>
                              </nav>


                           </div>
                            
                        </div>
                    </div>
                    </div>
                </div>
         

    </div>
</div>
@endsection



