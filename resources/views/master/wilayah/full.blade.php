@section('title',$title)
@extends('layout.app')
@section('content')
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop-breadcrumb">

                            <div class="breadcrumb-main">
                                <h4 class="text-capitalize breadcrumb-title">Data Wilayah </h4>
                                <div class="breadcrumb-action justify-content-center flex-wrap">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>Master </a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Wilayah</li>
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

                            <div class="table-responsive">
                                <table class="table mb-0 table-borderless border-0">
                                    <thead>
                                        <tr class="userDatatable-header">
                                        <th scope="col" width="5%">Kode Kelurahan</th>
                                        <th scope="col">Kelurahan</th>
                                        <th scope="col">koordinat</th>
                                        <th scope="col">Kecamatan</th>
                                   
                                        </tr>
                                    </thead>
                                    <tbody>
                
                                    @foreach($data as $key => $d)
                                  <tr>
                                    <td>{{ $d->id }}</td>
                                    <td>{{ $d->nama_kelurahan }}</td>
                                    <td>{{ $d->koordinat }}</td>
                                    <td>{{ $d->nama_kecamatan }}</td>
                                        
                                         
                                        </tr>
                                     
                                        @endforeach
                                     



                                    </tbody>
                                </table>
                            </div>

                            
                        </div>
                    </div>
    </div>
</div>
@endsection



