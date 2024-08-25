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
                        <div class="shop-breadcrumb">

                            <div class="breadcrumb-main">
                                <h4 class="text-capitalize breadcrumb-title">Informasi  </h4>
                                <div class="breadcrumb-action justify-content-center flex-wrap">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>Beranda </a></li>
                                            <li class="breadcrumb-item active" aria-current="page"> Informasi  </li>
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
                 
                    <div class="row justify-content-center">
            <div class="col-lg-8 col-12">
                <div class="blog-details-thumbnail">
                    <img src="{{ url('/informasi/'.$data->file) }} " alt="">
                </div>
                <article class="blog-details">
                    <div class="blog-details-content">
                        <h1 class="main-title mb-30">{{ $data->judul}}</h1>
                        <ul class="blog-details-meta">
                            <li class="blog-author">
                                <a href="#">
                                    <img src="{{ asset('assets/img/user.png') }} " alt="">
                                </a>
                                <a href="#">
                                    <span>Administrator</span>
                                </a>
                            </li>
                            <li class="author-name">
                                <a href="#" rel="bookmark">   <?php 
                     $tanggal = Carbon::parse($data['tanggal'])->format('d F Y');
                     ?>
                                    <time class="entry-date published updated" datetime="2022-01-25T10:55:00+06:00">{{ $tanggal }}</time>
                                </a>
                            </li>
                           
                        </ul>
                        <div class="blog-body">
                            <p class="mb-20">
                            <?php echo $data->keterangan; ?>
                            </p>

                        </div>
                    </div>
            </article>
   </div>
</div>

                    </div>
    </div>
    </div>
    </div>
@endsection



