@section('title',$title)
@extends('layout.app')
@section('content')
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop-breadcrumb">

                            <div class="breadcrumb-main">
                                <h4 class="text-capitalize breadcrumb-title">Data Transaksi SPJ Tasaruf </h4>
                                <div class="breadcrumb-action justify-content-center flex-wrap">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>Pendistribusian </a></li>
                                            <li class="breadcrumb-item" aria-current="page">Tasaruf</li>
                                            <li class="breadcrumb-item active" aria-current="page">Sudah</li>
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
                  


   


        




        
                <div class="row">
                    <div class="col-lg-12">


                        <div class="userDatatable orderDatatable sellerDatatable global-shadow mb-30 py-30 px-sm-30 px-20 radius-xl w-100">
                            <div class="project-top-wrapper d-flex justify-content-between flex-wrap mb-25 mt-n10">
                                <div class="d-flex align-items-center flex-wrap justify-content-center">
                                    <div class="project-search order-search  global-shadow mt-10">
                                        <form action="{{ route('pendistribusian.tasaruf.searchsudah') }}" class="order-search__form">
                                            <img src="{{ asset('assets/img/svg/search.svg') }}" alt="search" class="svg">
                                            <input class="form-control me-sm-2 border-0 box-shadow-none" type="search" name="keyword" placeholder="Filter by keyword" aria-label="Search">
                                        </form>
                                    </div>
                                </div>
                                <div class="content-center">
                                    <div class="button-group m-0 mt-sm-0 mt-10 order-button-group">
                                    <a href="{{ route('pendistribusian.tasaruf.exportsudah',['keyword'=>request('keyword')]) }}">  <button type="button" class="btn btn-warning btn-xs btn-squared">Export</button></a>
</div>
                                </div>
                            </div>
                            <script type="text/javascript">
    function checkAll(source) {
        checkboxes = document.getElementsByName('selectedItems[]');
        for(var i=0, n=checkboxes.length;i<n;i++) {
            checkboxes[i].checked = source.checked;
        }
    }
</script>   <form action="{{ route('pendistribusian.tasaruf.destroyy') }}" method="POST">
    @csrf
    @method('DELETE')
                            <div class="table-responsive">
                                <table class="table mb-0 table-borderless border-0">
                                    <thead>
                                        <tr class="userDatatable-header">
                                        <tr class="userDatatable-header">
                                        <th>
                                      
                                                <input class="checkbox" type="checkbox" id="check-5" onclick="checkAll(this)">
                                               
                                       </th>
                                           <th scope="col">Nomor Pemohon</th>
                                           <th scope="col">Nama Lengkap </th>
                                           <th scope="col">Kode Transaksi</th>
                                           <th scope="col">Tanggal</th>
                                            <th scope="col">Jenis</th>
                                           <th scope="col">HP</th>
                                           <th scope="col">Nominal</th>
                                           <th scope="col" width="10%"><center>Aksi</center></th>
                                        </tr>
                                     </thead>
                                    <tbody>
                                    @foreach($data as $key => $d)
                                    <tr>
                                    <td>
                                   
                                   <input class="checkbox" type="checkbox" id="check-grp-12"  name="selectedItems[]" value="{{ $d->id }}">
                                   

                </td>
                                        <td>{{ $d->nomor_proposal }}</td>
                                        <td>{{ $d->nama_pemohon }}</td>
                                        <td>{{ $d->kode_transaksi }}</td>
                                        <td>{{ date('d F Y', strtotime($d->tanggal)) }}</td>
                                        <td>{{ $d->jenis_kas }}</td>
                                        <td>{{ $d->alamat_lengkap }}</td>
                                        <td>
                                        {{ 'Rp ' . number_format($d->jumlah, 0, ',', '.')}}

                                        </td>
                                  
                        
                                        <td style="text-align: center;">
        <center>
                       <div class="project-progress"> 


<div class="dropdown  dropdown-click ">

    <button class="btn-link border-0 bg-transparent p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img src="{{ asset('assets/img/svg/layers.svg') }}" alt="more-horizontal" class="svg">
    </button>
        <div class="dropdown-default dropdown-bottomLeft dropdown-menu-right dropdown-menu--dynamic dropdown-menu">
            @if($d->jenis_kas=='uang')
            <a class="dropdown-item" href="{{ route('pendistribusian.tasaruf.edituang', $d->id) }}">Edit</a>
            @else
            <a class="dropdown-item" href="{{ route('pendistribusian.tasaruf.editbarang', $d->id) }}">Edit</a>
            @endif
            @if($d->file!='')
            <a class="dropdown-item" href="{{ url('/sdmumum/'.$d->file) }}" target="_blank">Berkas SPJ</a>
            @endif
            <a class="dropdown-item" href="{{ route('pendistribusian.tasaruf.cetak', $d->id) }}">Cetak</a>
            @if($d->proposal!='')
                <a class="dropdown-item" href="{{ url('/proposal/'.$d->proposal) }}" target="_blank">Proposal</a>
            @endif
            <a class="dropdown-item" href="{{ route('pendistribusian.tasaruf.destroy', $d->id) }}" onclick="return confirm('Apakah Anda Yakin ?');" >Hapus Data</a>
        </div>
</div>
</div>


</center>
                        </td>
                                        </td>
                                        </tr>
                                        @endforeach
                                     



                                    </tbody>
                                </table>
                            </div>
                            <button type="Submit" class="btn btn-danger btn-xs btn-squared" onclick="return confirm('Apakah Anda Yakin ?');">Hapus Data</button>
</form> 
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



