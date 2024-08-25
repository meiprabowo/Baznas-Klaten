@section('title',$title)
@extends('layout.app')
@section('content')
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop-breadcrumb">

                            <div class="breadcrumb-main">
                                <h4 class="text-capitalize breadcrumb-title">Data Proposal </h4>
                                <div class="breadcrumb-action justify-content-center flex-wrap">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>Proposal </a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Data Proposal </li>
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


    <div class="row ">
                  


    
    <div class="col-xxl-3 col-sm-6  col-ssm-12 mb-25">
                     <!-- Card 1  -->
                     <div class="ap-po-details ap-po-details--luodcy  overview-card-shape radius-xl d-flex justify-content-between">
                        <div class=" ap-po-details-content d-flex flex-wrap justify-content-between w-100">
                         <a href="#">
                            <div class="ap-po-details__titlebar">
                              <p>Total Porposal</p>
                              <h1>{{ number_format($allproposal, 0, ',', '.')}}</h1>
                           </div>
                        </a>
                           <div class="ap-po-details__icon-area color-primary">
                              <i class="uil uil-database"></i>
                           </div>
                        </div>

                     </div>
                     <!-- Card 1 End  -->
                  </div>


                  

                  <div class="col-xxl-3 col-sm-6  col-ssm-12 mb-25">
                     <!-- Card 1  -->
                     <div class="ap-po-details ap-po-details--luodcy  overview-card-shape radius-xl d-flex justify-content-between">
                        <div class=" ap-po-details-content d-flex flex-wrap justify-content-between w-100">
                           <div class="ap-po-details__titlebar">
                              <p>On Proses</p>
                              <h1>{{ number_format($onproses, 0, ',', '.')}}</h1>
  
                           </div>
                           <div class="ap-po-details__icon-area color-primary">
                              <i class="uil uil-process"></i>
                           </div>
                        </div>

                     </div>
                     <!-- Card 1 End  -->
                  </div>


                  

              
                  <div class="col-xxl-3 col-sm-6  col-ssm-12 mb-25">
                     <!-- Card 1  -->
                     <div class="ap-po-details ap-po-details--luodcy  overview-card-shape radius-xl d-flex justify-content-between">
                        <div class=" ap-po-details-content d-flex flex-wrap justify-content-between w-100">
                           <div class="ap-po-details__titlebar">
                              <p>Diterima</p>

                              <h1>{{ number_format($terima, 0, ',', '.')}}</h1>
                    
                           </div>
                           <div class="ap-po-details__icon-area color-primary">
                              <i class="uil uil-tachometer-fast"></i>
                           </div>
                        </div>

                     </div>
                     <!-- Card 1 End  -->
                  </div>


                  

              
                  <div class="col-xxl-3 col-sm-6  col-ssm-12 mb-25">
                     <!-- Card 1  -->
                     <div class="ap-po-details ap-po-details--luodcy  overview-card-shape radius-xl d-flex justify-content-between">
                        <div class=" ap-po-details-content d-flex flex-wrap justify-content-between w-100">
                           <div class="ap-po-details__titlebar">
                              <p>Ditolak</p>
                              <h1>{{ number_format($tolak, 0, ',', '.')}}</h1>
  
                           </div>
                           <div class="ap-po-details__icon-area color-primary">
                              <i class="uil uil-arrow-down"></i>
                           </div>
                        </div>

                     </div>
                     <!-- Card 1 End  -->
                  </div>


                  

                  

                  

                  

               </div>




        
                <div class="row">
                    <div class="col-lg-12">


                        <div class="userDatatable orderDatatable sellerDatatable global-shadow mb-30 py-30 px-sm-30 px-20 radius-xl w-100">
                            <div class="project-top-wrapper d-flex justify-content-between flex-wrap mb-25 mt-n10">
                                <div class="d-flex align-items-center flex-wrap justify-content-center">
                                    <div class="project-search order-search  global-shadow mt-10">
                                        <form action="{{ route('proposal.proposal.lanjutsearch') }}" class="order-search__form">
                                            <img src="{{ asset('assets/img/svg/search.svg') }}" alt="search" class="svg">
                                            <input class="form-control me-sm-2 border-0 box-shadow-none" type="search" name="keyword" placeholder="Filter by keyword" aria-label="Search">
                                        </form>
                                    </div>
                                </div>
                                <div class="content-center">
                                    <div class="button-group m-0 mt-sm-0 mt-10 order-button-group">
                                    <a href="{{ route('proposal.proposal.lanjutupload') }}">
                                        <button type="button" class="btn btn-warning btn-xs btn-squared">Upload Data</button>
                                    </a>
</div>
                                </div>
                            </div>
                            <form method="POST" action="{{ route('proposal.proposal.prosestindaklanjut') }}" enctype="multipart/form-data">
                                  @csrf
    <div class="table-responsive">
        <table class="table table-borderless">
            <thead>
                <tr class="userDatatable-header">
                    <th scope="col">Nomor Pemohon</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Tanggal Permohonan</th>
                    <th scope="col">Petugas Survey</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Status</th>
                    <th scope="col">Lokasi</th>
                    <th scope="col">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $d)
                
                <tr>
                    <td> <input type="hidden" name="id[]" value="{{ $d->id }}"/>{{ $d->nomor_proposal }}</td>
                    <td>{{ $d->nama_pemohon }}</td>
                    <td>{{ date('d F Y', strtotime($d->tanggal_masuk)) }}</td>
                    <td>{{ $d->petugass }}</td>
                   <td><input type="date" name="tanggal[]" class="form-control" /></td>
                    <td>
                        <select name="status[]" class="form-control">
                            <option value="0">-- Pilih Status --</option>
                            <option value="A">Diterima</option>
                            <option value="N">Ditolak</option>
                        </select>
                    </td>
                    <td><input type="text" name="lokasi[]" class="form-control" /></td>
                   <td><input type="text" name="keterangan[]" class="form-control"/></td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>  

    <div class="text-left mt-3">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>


</form>

    <div class="d-flex justify-content-end mt-15 pt-25 border-top">
        <nav class="dm-page">
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



