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
                                <h4 class="text-capitalize breadcrumb-title">Kirim WA ke Muzaki </h4>
                                <div class="breadcrumb-action justify-content-center flex-wrap">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>Pengumpulan </a></li>
                                            <li class="breadcrumb-item active" aria-current="page"> Kirim WA  </li>
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
            <?php if (request()->has('bulan') && !empty(request('bulan'))) { ?>

                <div class="row">
                    <div class="col-lg-12">
                    <div class="row">
                    <div class="col-lg-12">
                        <div class="userDatatable orderDatatable sellerDatatable global-shadow mb-30 py-30 px-sm-30 px-20 radius-xl w-100">
                            <div class="project-top-wrapper d-flex justify-content-between flex-wrap mb-25 mt-n10">
                                <div class="d-flex align-items-center flex-wrap justify-content-center">
                                    <div class="project-search order-search  global-shadow mt-10">
                                        <form action="{{ route('pengumpulan.pengumpulan.searchh') }}" class="order-search__form">
                                            <img src="{{ asset('assets/img/svg/search.svg') }}" alt="search" class="svg">
                                            <input type="hidden" name="bulan" value="<?php echo"$_GET[bulan]"; ?>" />
                                            <input class="form-control me-sm-2 border-0 box-shadow-none" type="search" name="keyword" placeholder="Filter by keyword" aria-label="Search">
                                        </form>
                                    </div>
                                </div>
                                <div class="content-center">
                                    <div class="button-group m-0 mt-sm-0 mt-10 order-button-group">
                                    <a href="{{ route('pengumpulan.pengumpulan.wabelum',['bulan'=>request('bulan')]) }}">  <button type="button" class="btn btn-warning btn-xs btn-squared">Belum</button></a>
                                    <a href="{{ route('pengumpulan.pengumpulan.wa',['bulan'=>request('bulan')]) }}">  <button type="button" class="btn btn-danger btn-xs btn-squared">Sudah</button></a>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="table-responsive">
                            <table class="table table-border-horizontal">
                  <thead>
                     <tr>
                     <th scope="col" width="3%">No</th>
                     <th scope="col">Nama UPZ</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Zakat</th>
                        <th scope="col">Infak</th>
                        <th scope="col">Total Bulan ini</th>
                        <th scope="col">Status</th>
                        @if(Request::is('pengumpulan/laporan/whatsapp/belum*'))
                            <th scope="col">Aksi</th>
                            @endif


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
                        <td>{{ 'Rp ' . number_format($d->zakattotal, 0, ',', '.')}}</td>
                        <td>{{ 'Rp ' . number_format($d->infaqtotal, 0, ',', '.')}}</td>
                        <td><?php $totalbln = $d->infaqtotal + $d->zakattotal  ; ?> {{ 'Rp ' . number_format($totalbln, 0, ',', '.')}}</td>
                        <td> belum : {{ $jml }} | sudah : {{ $sudah }}  </td>

                        @if(Request::is('pengumpulan/laporan/whatsapp/belum*'))

                        <td><a href="{{ route('pengumpulan.pengumpulan.wabelumact', ['id' => $d->dinas, 'bulan' => $bulan]) }}"><b>Kirim WA</b></a></td>
                        @endif

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
            <?php } else { ?>



                <div class="row">
                    <div class="col-lg-12">
                          <div class="card card-default card-md mb-4">
                              <div class="card-header">
                                 <h6>Kirim WA ke Muzaki</h6>
                              </div>
                              <div class="card-body">
                              <div class="form-group">
                              <form action="{{ route('pengumpulan.pengumpulan.wa') }}" method="GET" >
<div class="col-sm-5">
        
        <label class="form-label" for="validationDefault02">Bulan :</label>
                                    <div class="dm-select ">
                                        <select name="bulan" class="form-control ">      
                                            <option> ==> Pilih Periode Laporan <== </option>
    <option value="01">Januari</option>
    <option value="02">Februari</option>
    <option value="03">Maret</option>
    <option value="04">April</option>
    <option value="05">Mei</option>
    <option value="06">Juni</option>
    <option value="07">Juli</option>
    <option value="08">Agustus</option>
    <option value="09">September</option>
    <option value="10">Oktober</option>
    <option value="11">November</option>
    <option value="12">Desember</option>

    </select>						
    </div> <br/>  <button class="btn btn-primary" type="submit">Simpan</button>
    </div>
</form>

</div>
                              </div>
                          </div>
                    </div>
            </div>


             <?php } ?>

    </div>
</div>
@endsection



