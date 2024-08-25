@section('title',$title)
@extends('layout.app')
@section('content')
@php
use Carbon\Carbon;
@endphp
<div class="blog-page">
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                          <div class="breadcrumb-main">
                                <h4 class="text-capitalize breadcrumb-title">Agenda  </h4>
                                <div class="breadcrumb-action justify-content-center flex-wrap">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>Beranda </a></li>
                                            <li class="breadcrumb-item active" aria-current="page"> Agenda  </li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>

                  </div>
                
            

        
<div class="row">
    <div class="col-lg-12">
        <div class="userDatatable orderDatatable sellerDatatable global-shadow mb-30 py-30 px-sm-30 px-20 radius-xl w-100">

            <div class="table-responsive">

            <table class="table table-border-horizontal">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Kegiatan</th>
                <th scope="col">Waktu Pelaksanaan</th>
            </tr>
        </thead>
      
    </table>
    <marquee behavior="scroll" direction="up" scrollamount="2">
    <table class="table table-border-horizontal">
        <thead>
        <?php $no=1; ?>
        @foreach($data as $key => $d)
            <tr>
            <th scope="col">{{ $no }}</th>
            <th scope="col">{{ $d->kegiatan }}</th>
            <th scope="col">{{ $d->waktu_pelaksanaan }}</th>
            </tr>
            <?php $no++; ?> <br/>
            @endforeach
        </thead>
      
    </table>
    <br/><br/><br/><br/><br/><br/><br/>
</marquee>


      
          
      
</div>
</div>