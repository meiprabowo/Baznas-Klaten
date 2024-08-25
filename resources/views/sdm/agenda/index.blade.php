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
                                <h4 class="text-capitalize breadcrumb-title">Data Agenda </h4>
                                <div class="breadcrumb-action justify-content-center flex-wrap">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>SDM Umum </a></li>
                                            <li class="breadcrumb-item active" aria-current="page"> Agenda  </li>
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
                                        <form action="{{ route('sdm.agenda.search') }}" class="order-search__form">
                                            <img src="{{ asset('assets/img/svg/search.svg') }}" alt="search" class="svg">
                                            <input class="form-control me-sm-2 border-0 box-shadow-none" type="search" name="keyword" placeholder="Filter by keyword" aria-label="Search">
                                        </form>
                                    </div>
                                </div>
                                <div class="content-center">
                                    <div class="button-group m-0 mt-sm-0 mt-10 order-button-group">

                                    <a href="{{ route('sdm.agenda.create') }}">  <button type="button" class="btn btn-info btn-xs btn-squared">Tambah Data</button></a>
                                    <form style="display:none;" id="logoutForm" action="{{ route('logout') }}" method="POST">
    @csrf
    @method('post')
</form>

<a href="{{ route('agenda') }}" id="agendaLink" target="_blank">
    <button type="button" class="btn btn-warning btn-xs btn-squared" onclick="clearSessionsAndRedirect()">Lihat Agenda</button>
</a>

<script>
    function clearSessionsAndRedirect() {
        // Submit form logout saat tombol diklik
        document.getElementById("logoutForm").submit();
        // Redirect ke halaman agenda setelah menghapus sesi
        document.getElementById("agendaLink").click();
    }
</script>
</div>
                                </div>
                            </div>
                            <div class="table-responsive">
                            <table class="table table-border-horizontal">
                  <thead>
                     <tr>
                     <th scope="col" width="10%">No</th>
                        <th scope="col">Kegiatan</th>
                        <th scope="col">Waktu Pelaksanaan</th>
                        <th scope="col">Status</th>
                        <th scope="col" width="15%"><center>Aksi</center></th>

                     </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; ?>
                     @foreach($data as $key => $d)
                    
                     <tr>
                        <td>{{ $no }}</td>
                        <td>{{ $d->kegiatan }}</td>
                        <td>{{ $d->waktu_pelaksanaan }}</td>
                        <td>{{ $d->status }}</td>
                        <td>
                        <ul class="orderDatatable_actions mb-0 d-flex flex-wrap float-end">
                                               

                      

                                               <li>
                                                   <a href="{{ route('sdm.agenda.edit', $d->id) }}" class="edit">
                                                       <i class="uil uil-edit"></i>
                                                   </a>
                                                 
                                               </li>
                                               <li>
                                                   <a href="{{ route('sdm.agenda.destroy', $d->id) }}"  onclick="return confirm('Apakah Anda Yakin ?');"  class="remove">
                                                       <i class="uil uil-trash-alt"></i>
                                                   </a>
                                               </li>
                                           </ul>
                        </td>
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



