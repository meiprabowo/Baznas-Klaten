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
                                <h4 class="text-capitalize breadcrumb-title">Laporan Tahunan </h4>
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

                            <div class="table-responsive">
                            <table class="table table-border-horizontal">
                  <thead>
                     <tr>
                     <th scope="col">No</th>
                        <th scope="col">Tahun</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">File</th>

                     </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; ?>
                     @foreach($data as $key => $d)
                     <tr>
                        <td>{{ $no }}</td>
                        <td>{{ $d->tahun }}</td>
                        <td>{{ $d->keterangan }}</td>
                        <td>  <a href="{{ url('/laporan/'.$d->laporan) }}" target="_blank" class="view"><b>DOWNLOAD</b></a></td>

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
@endsection



