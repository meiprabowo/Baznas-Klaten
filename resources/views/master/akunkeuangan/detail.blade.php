@section('title',$title)
@extends('layout.app')
@section('content')
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop-breadcrumb">

                            <div class="breadcrumb-main">
                                <h4 class="text-capitalize breadcrumb-title">Data Akun Keuangan {{ $jenis_akun->nama_akun }}</h4>
                                <div class="breadcrumb-action justify-content-center flex-wrap">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>Akun Keuangan</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Data Akun Keuangan</li>
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
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session()->has('success'))
    <div class="alert alert-success dark" role="alert">
        <p>{{ session('success') }}</p>
    </div>
@endif

@if (session()->has('warning'))
    <div class="alert alert-danger dark" role="alert">
        <p>{{ session('warning') }}</p>
    </div>
@endif





        
                <div class="row">
                    <div class="col-lg-12">
                        <div class="userDatatable orderDatatable sellerDatatable global-shadow mb-30 py-30 px-sm-30 px-20 radius-xl w-100">
                            <div class="project-top-wrapper d-flex justify-content-between flex-wrap mb-25 mt-n10">
                                <div class="d-flex align-items-center flex-wrap justify-content-center">
                                    <div class="project-search order-search  global-shadow mt-10">
                                        <form action="{{ route('master.akun.searchdetailjenis', $jenis_akun->id) }}" class="order-search__form">
                                            <input type="hidden" name="id" value="{{ request('id') }}">
                                            <img src="{{ asset('assets/img/svg/search.svg') }}" alt="search" class="svg">
                                            <input class="form-control me-sm-2 border-0 box-shadow-none" type="search" name="keyword" placeholder="Filter by keyword" aria-label="Search">
                                        </form>
                                    </div>
                                </div>
                                <div class="content-center">
                                    <div class="button-group m-0 mt-sm-0 mt-10 order-button-group">
                                    <a href="{{ route('master.akun.exportakun', ['id' => $jenis_akun->id, 'keyword' => request('keyword')]) }}">
                                         <button type="button" class="btn btn-warning btn-xs btn-squared">Export</button>
                                    </a>
                           
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table mb-0 table-borderless border-0">
                                    <thead>
                                        <tr class="userDatatable-header">
                                           <th scope="col">Kode</th>
                                           <th scope="col">Uraian</th>
                                           <th scope="col">Level</th>
                                           <th scope="col">Sifat</th>
                                           <th scope="col">Kelompok</th>
                                           <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $key => $d)
                                        <tr>
                                        <td>{{ $d->kode }}</td>
                                            <td>{{ $d->uraian }}</td>
                                            <td>{{ $d->level }}</td>
                                            <td>{{ $d->sifat == 'D' ? 'Debet' : 'Kredit' }}</td>
                                            <td>{{ $d->kelompok }}</td>
                                            <td>{{ $d->status == 'A' ? 'Aktif' : 'Non-Aktif' }}</td>

                                           
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



