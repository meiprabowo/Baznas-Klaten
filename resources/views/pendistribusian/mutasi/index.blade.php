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
                                <h4 class="text-capitalize breadcrumb-title">Data Mutasi Pendistribusian </h4>
                                <div class="breadcrumb-action justify-content-center flex-wrap">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>Pendistribusian </a></li>
                                            <li class="breadcrumb-item active" aria-current="page"> Mutasi  </li>
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
        
                <div class="row">
                    <div class="col-lg-12">
                        <div class="userDatatable orderDatatable sellerDatatable global-shadow mb-30 py-30 px-sm-30 px-20 radius-xl w-100">
                            <div class="project-top-wrapper d-flex justify-content-between flex-wrap mb-25 mt-n10">
                                <div class="d-flex align-items-center flex-wrap justify-content-center">
                                    <div class="project-search order-search  global-shadow mt-10">
                                        <form action="{{ route('pendistribusian.mutasi.searchp') }}" class="order-search__form">
                                            <img src="{{ asset('assets/img/svg/search.svg') }}" alt="search" class="svg">
                                            <input class="form-control me-sm-2 border-0 box-shadow-none" type="search" name="keyword" placeholder="Filter by keyword" aria-label="Search">
                                        </form>
                                    </div>
                                </div>
                                <div class="content-center">
                                    <div class="button-group m-0 mt-sm-0 mt-10 order-button-group">
                                    <a href="{{ route('pendistribusian.mutasi.exportp',['keyword'=>request('keyword')]) }}">  <button type="button" class="btn btn-warning btn-xs btn-squared">Export</button></a>

                                    <a href="{{ route('pendistribusian.mutasi.createp') }}">  <button type="button" class="btn btn-info btn-xs btn-squared">Tambah Data</button></a>
</div>
                                </div>
                            </div>
                            <div class="table-responsive">
                            <table class="table table-border-horizontal">
                  <thead>
                     <tr>
                     <th scope="col">Nomor Transaksi</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Sumber</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col" width="15%"><center>Aksi</center></th>

                     </tr>
                  </thead>
                  <tbody>
                    
                     @foreach($data as $key => $d)
                     <?php 
                     $tanggal = Carbon::parse($d['tanggal'])->format('d F Y');
                     ?>
                     <tr>
                        <td>{{ $d->kode_transaksi }}</td>
                        <td>{{ $tanggal }}</td>
                        <td>{{ $d->keterangan }}</td>
                        <td>{{ $d->uraian }}</td>
                        <td>{{ 'Rp ' . number_format($d->jumlah, 0, ',', '.')}}</td>
                        <td style="text-align: right;">
                        <ul class="orderDatatable_actions mb-0 d-flex flex-wrap float-end">
                                               

                      


                                            @if($d->file!='')
                                             <li>
                                                <a href="{{ url('/sdmumum/'.$d->file) }}" target="_blank" class="view">
                                                   <i class="uil uil-eye"></i>
                                                </a>
                                             </li>
                                            @endif




                                               <li>
                                                   <a href="{{ route('pendistribusian.mutasi.editp', $d->id) }}" class="edit">
                                                       <i class="uil uil-edit"></i>
                                                   </a>
                                                 
                                               </li>
                                               <li>
                                                   <a href="{{ route('pendistribusian.mutasi.destroyp', $d->id) }}"  onclick="return confirm('Apakah Anda Yakin ?');"  class="remove">
                                                       <i class="uil uil-trash-alt"></i>
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



