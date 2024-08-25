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
                    @foreach($data as $key => $d)
                    <div class="col-xl-4 col-md-6 mb-25">
                   <?php $jdl = str_replace(" ", "+", $d->judul); ?>

<div class="blog-card">
    <div class="blog-card__thumbnail">
    <a href="{{ route('detailblog', [$d->id, $jdl]) }}">
        <img src="{{ url('/informasi/'.$d->file) }}" alt="#"> 
        </a>
    </div>
    <div class="blog-card__details">
        <div class="blog-card__content">
         
            <h4 class="blog-card__title">
                <a href="{{ route('detailblog', [$d->id, $jdl]) }}" class="entry-title" rel="bookmark">{{ $d->judul }}</a>
            </h4>
            <?php
            $potongan = substr($d->keterangan, 0, 250);
?>
            <?php echo"$potongan"; ?>
        </div>
        <div class="blog-card__meta">
            <div class="blog-card__meta-profile">
                <img src="{{ asset('assets/img/user.png') }}" alt="">
                <span>Administrator</span>
            </div>
            <div class="blog-card__meta-count">
                <ul>
               
                    <li>
                        <div class="blog-card__meta-doc-wrapper">
                            <span class="blog-card__meta-doc">SHARE</span>
                            <img src="{{ asset('assets/img/svg/send.svg') }}" alt="sand" class="svg">
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

</div>

@endforeach
                    </div>
    </div>
    </div>
    </div>
@endsection



