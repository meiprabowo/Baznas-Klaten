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
                            <div class="project-top-wrapper d-flex justify-content-between flex-wrap mb-25 mt-n10">
                                <div class="d-flex align-items-center flex-wrap justify-content-center">
                                    <div class="project-search order-search  global-shadow mt-10">
                                        <!-- <form action="{{ route('master.wilayah.search') }}" class="order-search__form">
                                            <img src="{{ asset('assets/img/svg/search.svg') }}" alt="search" class="svg">
                                            <input class="form-control me-sm-2 border-0 box-shadow-none" type="search" name="keyword" placeholder="Filter by keyword" aria-label="Search">
                                        </form> -->
                                    </div>
                                </div>
                                <div class="content-center">
                                    <div class="button-group m-0 mt-sm-0 mt-10 order-button-group">


                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-basic">Tambah</button>
                                    
<div class="modal-basic modal fade show" id="modal-basic" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-md" role="document">
   <div class="modal-content modal-bg-white ">
      <div class="modal-header">
      <h6 class="modal-title">Tambah Kelurahan</h6>
         <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <img src="{{ asset('assets/img/svg/x.svg') }}" alt="x" class="svg">
         </button>
      </div>
      <div class="modal-body">
      <form method="POST" action="{{ route('master.wilayah.storee') }}" enctype="multipart/form-data">
                            @csrf 
                          <div class="row g-3">
                          <div class="col-md-12 mb-3">
                                <input type="hidden" name="id" value="{{ $id }}" >
                              <label class="form-label" for="validationDefault01">Nama Kelurahan</label>
                              <input class="form-control" id="validationDefault01" type="text" name="nama" placeholder="Nama Kelurahan" required="">
                            </div>                          
                            <div class="col-md-12 mb-3">
                          
                              <label class="form-label" for="validationDefault01">Koordinat</label>
                              <input class="form-control" id="validationDefault01" type="text" name="koordinat" placeholder="Koordinat Kelurahan" required="">
                            </div>                          
                          </div>
     </div>
      <div class="modal-footer">
         <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
         <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
      </div>
      </form>
   </div>
</div>


</div>



</div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table mb-0 table-borderless border-0">
                                    <thead>
                                        <tr class="userDatatable-header">
                                        <th scope="col" width="5%">No</th>
                                        <th scope="col">Nama Kelurahan</th>
                                        <th scope="col">Koordinat</th>
                                           <th scope="col" width="10%"><center>Aksi</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                    <?php $no=1; ?>
                                    @foreach($data as $key => $d)
                     <tr>
                     <td>{{ $no }}</td>
                     <td>{{ $d->nama_kelurahan }} </td>
                     <td>{{ $d->koordinat }} </td>
                        
                                            <td>
                                                <ul class="orderDatatable_actions mb-0 d-flex flex-wrap float-end">
                                               
                                             
                                                <li>
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#modal-basicedit{{ $no }}" >
                                                            <i class="uil uil-edit"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('master.wilayah.destroyk', $d->id) }}"  onclick="return confirm('Apakah Anda Yakin ?');"  class="remove">
                                                            <i class="uil uil-trash-alt"></i>
                                                        </a>
                                                    </li>

                                                    <div class="modal-basic modal fade show" id="modal-basicedit{{ $no }}" tabindex="-1" role="dialog" aria-hidden="true">


<div class="modal-dialog modal-md" role="document">
   <div class="modal-content modal-bg-white ">
      <div class="modal-header">



         <h6 class="modal-title">Edit Kelurahan</h6>
         <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <img src="{{ asset('assets/img/svg/x.svg') }}" alt="x" class="svg">
         </button>
      </div>
      <div class="modal-body">
      <form method="POST" action="{{ route('master.wilayah.updatee', $d->id) }}" enctype="multipart/form-data">
      @csrf                             @method('PUT')
                          <div class="row g-3">
                          <div class="col-md-12 mb-3">
                            <label class="form-label" for="validationDefault01">Nama Kelurahan</label>
                              <input class="form-control" id="validationDefault01" type="text" name="nama" value="{{ $d->nama_kelurahan }}" placeholder="Nama Kecamatan" required="">
                            </div>
                           
                            <div class="col-md-12 mb-3">
                            <label class="form-label" for="validationDefault01">Koordinat</label>
                              <input class="form-control" id="validationDefault01" type="text" name="koordinat" value="{{ $d->koordinat }}" placeholder="Koordinat" required="">
                            </div>
                           
                           
                          </div>
                        

                      
      </div>
      <div class="modal-footer">
         <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
      </div>
      </form>
   </div>
</div>





                                                </ul>
                                            </td>
                                        </tr>
                                        <?php $no++; ?>
                                        @endforeach
                                     



                                    </tbody>
                                </table>
                            </div>

                   
                            
                        </div>
                    </div>
    </div>
</div>
@endsection



