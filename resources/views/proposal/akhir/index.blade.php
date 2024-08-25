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
                         <a href="{{ route('proposal.proposal.all') }}"><div class="ap-po-details__titlebar">
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
                        <a href="{{ route('proposal.proposal.allonproses') }}">
                              <div class="ap-po-details__titlebar">
                              <p>On Proses</p>
                              <h1>{{ number_format($onproses, 0, ',', '.')}}</h1>
  
                           </div>
                        </a>
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
                        <a href="{{ route('proposal.proposal.diterimaex') }}">
                           <div class="ap-po-details__titlebar">
                              <p>Diterima</p>

                              <h1>{{ number_format($terima, 0, ',', '.')}}</h1>
                    
                           </div>
</a>
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
                        <a href="{{ route('proposal.proposal.ditolakex') }}">
                           <div class="ap-po-details__titlebar">
                              <p>Ditolak</p>
                              <h1>{{ number_format($tolak, 0, ',', '.')}}</h1>
  
                           </div>
</a>
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
                                        <form action="{{ route('proposal.proposal.searchakhir') }}" class="order-search__form">
                                            <img src="{{ asset('assets/img/svg/search.svg') }}" alt="search" class="svg">
                                            <input class="form-control me-sm-2 border-0 box-shadow-none" type="search" name="keyword" placeholder="Filter by keyword" aria-label="Search">
                                        </form>
                                    </div>
                                </div>
                                <div class="content-center">
                                    <div class="button-group m-0 mt-sm-0 mt-10 order-button-group">
                                    <a href="{{ route('proposal.proposal.exportakhir',['keyword'=>request('keyword')]) }}">  <button type="button" class="btn btn-warning btn-xs btn-squared">Export</button></a>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table mb-0 table-borderless border-0">
                                    <thead>
                                        <tr class="userDatatable-header">
                                           <th scope="col">Nomor Pemohon</th>
                                           <th scope="col">Nama </th>
                                           <th scope="col">Tanggal Permohonan</th>
                                           <th scope="col">Jenis</th>
                                           <th scope="col">Telp</th>
                                           <th scope="col">Status</th>
                                           <th scope="col" width="10%"><center>Aksi</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $key => $d)
                                    <tr>
                                    <td>{{ $d->nomor_proposal }}
                                    @if($d->jml >1)   
                                        <div class="userDatatable-content d-inline-block">
                                             <span class="bg-opacity-danger  color-warning rounded-pill userDatatable-content-status active">{{ $d->jml }}</span>
                                          </div>
                                          @endif
                                        </td>
                                        
                                        <td>{{ $d->nama_pemohon }}</td>
                                        <td>{{ date('d F Y', strtotime($d->tanggal_masuk)) }}</td>
                                        <td>{{ $d->jenis_permohonan }}</td>
                                        <td>{{ $d->hp }}</td>
                                        <td><span style="color: 
    @switch($d->status)
        @case('B') orange @break
        @case('O') blue @break
        @case('A') green @break
        @case('N') red @break
        @default black
    @endswitch">
    {{ 
        $d->status == 'B' ? 'Belum diproses' : 
        ($d->status == 'O' ? 'On Proses' : 
        ($d->status == 'A' ? 'Diterima' : 'Ditolak')) 
    }}
</span>
</td>
                        
                                            <td>
                                               
                                            <div class="project-progress text-end">


                                                <div class="dropdown  dropdown-click ">

                                                    <button class="btn-link border-0 bg-transparent p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <img src="{{ asset('assets/img/svg/layers.svg') }}" alt="more-horizontal" class="svg">
                                                    </button>
                                                        <div class="dropdown-default dropdown-bottomLeft dropdown-menu-right dropdown-menu--dynamic dropdown-menu">
                                                            <a class="dropdown-item" href="{{ route('proposal.proposal.edit', $d->id) }}">Edit</a>
                                                            <a class="dropdown-item" href="{{ route('proposal.proposal.detail', $d->id) }}">Detail</a>
                                                            <a class="dropdown-item" href="{{ route('proposal.proposal.bukti', $d->id) }}">Cetak</a>
                                                            <a class="dropdown-item" href="{{ route('proposal.proposal.cetaksurvey', $d->id) }}">Form Survey</a>
                                                            <a class="dropdown-item" href="{{ route('proposal.proposal.prosess', $d->id) }}">Proses</a>

                                                            @if($d->proposal!='')
                                                            <a class="dropdown-item" href="{{ url('/proposal/'.$d->proposal) }}" target="_blank">Proposal</a>
                                                            @endif
                                                            @if($d->spj!='')
                                                            <a class="dropdown-item" href="{{ url('/sdmumum/'.$d->spj) }}" target="_blank">SPJ</a>
                                                            @endif

                                                            <a class="dropdown-item" href="{{ route('proposal.proposal.destroy', $d->id) }}" onclick="return confirm('Apakah Anda Yakin ?');" >Hapus Data</a>
                                                        </div>
                                                </div>
                                            </div>






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



