@section('title',$title)
@extends('layout.app')
@section('content')
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop-breadcrumb">

                            <div class="breadcrumb-main">
                                <h4 class="text-capitalize breadcrumb-title">Data Muzaki / Mustahik Perseorangan</h4>
                                <div class="breadcrumb-action justify-content-center flex-wrap">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>Pengumpulan </a></li>
                                            <li class="breadcrumb-item" aria-current="page">Muzaki / Mustahik</li>
                                            <li class="breadcrumb-item active" aria-current="page">Registrasi</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
         <div class="card">
                    <div class="card-header">
                        <h5>Form Tambah Muzaki / Mustahik</h5>
                    </div>


                    <div class="card-body">
                        <form method="POST" action="{{ route('pengumpulan.muzaki.storelembaga') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3">
                                
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="nama_muzaki">NPWZ</label>
                                        <input class="form-control" id="nama_muzaki" type="text" name="npwz" placeholder="NPWZ">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="nama_muzaki">Nama Muzaki</label>
                                        <input class="form-control" id="nama_muzaki" type="text" name="nama_muzaki" placeholder="Nama Muzaki" >
                                    </div>

                             </div>
                                    <div class="row g-3">
                                        <div class="col-md-6 mb-3">
                                                    <label class="form-label" for="nik">NIK</label>
                                                    <input class="form-control" id="nik" type="text" name="nik" placeholder="NIK">
                                        </div>
                                      
                                    </div>

                                    
                                    <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label" for="tgl_register">Tanggal Register</label>
                                        <input class="form-control" id="tgl_register" type="date" name="tgl_register">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label" for="telp">Telepon</label>
                                        <input class="form-control" id="telp" type="text" name="telp" placeholder="Telepon" >
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="hp">HP</label>
                                        <input class="form-control" id="hp" type="text" name="hp" placeholder="HP" >
                                    </div>
                                    </div>

                                    <div class="row g-3">
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label" for="alamat">Alamat</label>
                                        <input class="form-control" id="alamat" type="text" name="alamat" placeholder="Alamat" >
                                        </div>
                                    </div>
                                    <div class="row g-3">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="email">Email</label>
                                        <input class="form-control" id="email" type="text" name="email" placeholder="Email" >
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="npwp">NPWP</label>
                                        <input class="form-control" id="npwp" type="text" name="npwp" placeholder="NPWP">
                                    </div>
                                    </div>
                                   
                                  
                                    <div class="row g-3">

                                 
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label" for="keterangan">Keterangan</label>
                                            <input class="form-control" id="keterangan" type="text" name="keterangan" placeholder="Keterangan">
                                        </div>
                                    </div>

                               
                        

                          <button class="btn btn-primary" type="submit">Simpan</button>
                        </form>
                      </div>
                    </div>



                
                        </form>
                    </div>
                </div>
      </div>
   </div>
</div>
@endsection



