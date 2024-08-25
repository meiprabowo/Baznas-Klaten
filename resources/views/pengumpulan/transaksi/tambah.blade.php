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
                                <h4 class="text-capitalize breadcrumb-title">Transaksi Pengumpulan </h4>
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

            
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('warning'))
        <div class="alert alert-warning">
            {{ session('warning') }}
        </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
        
        
                <div class="col-md-8">
                  <div class="search-result global-shadow rounded-pill bg-white">
                     <form action="{{ route('pengumpulan.pengumpulan.searchdetail') }}" class="d-flex align-items-center justify-content-between">
                        <div class="border-right d-flex align-items-center w-100  ps-25 pe-sm-25 pe-0 py-1">
                        <img src="{{ asset('assets/img/svg/search.svg') }}" alt="search" class="svg">
                           <input class="form-control border-0 box-shadow-none" name="keyword" type="search" placeholder="Cari Data Muzaki" aria-label="Search">
                        </div>
                        <button type="button" class="border-0 bg-transparent px-25">search</button>
                     </form>
                  </div>
               </div>
               <br/><br/>
               <div class="row">
                    <div class="col-lg-12">
                        <div class="userDatatable orderDatatable sellerDatatable global-shadow mb-30 py-30 px-sm-30 px-20 radius-xl w-100">

                            <div class="table-responsive">
                            <table class="table table-border-horizontal">
                  <thead>
                     <tr>
                                          <th scope="col">NPWZ</th>
                                           <th scope="col">Nama</th>
                                           <th scope="col">HP</th>
                                           <th scope="col">Email</th>

                        <th scope="col" width="15%"><center>Aksi</center></th>

                     </tr>
                  </thead>
                  <tbody>
                    
                     @foreach($data as $key => $d)
                     <?php 
                     $tanggal = Carbon::parse($d['tanggal'])->format('d F Y');
                     ?>
                     <tr>
                     <td>
                     <a href="{{ route('pengumpulan.pengumpulan.bayar', $d->id) }}"> 
                        {{ $d->npwz }}
                    </a>
                     </td>
                     <td>{{ $d->nama_muzaki }}</td>
                     <td>{{ $d->hp }}</td>
                     <td>{{ $d->email }}</td>
                        <td style="text-align: right;">
                        <ul class="orderDatatable_actions mb-0 d-flex flex-wrap float-end">
                                               

                      

                                               <li>
                                                   <a href="{{ route('pengumpulan.pengumpulan.bayar', $d->id) }}" class="edit">
                                                       <i class="uil uil-money-bill"></i>
                                                   </a>
                                                 
                                               </li>
                                          
                                           </ul>
                        </td>
                     </tr>
                     
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
@endsection



