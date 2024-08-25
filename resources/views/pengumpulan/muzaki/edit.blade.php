@section('title',$title)
@extends('layout.app')
@section('content')
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop-breadcrumb">

                            <div class="breadcrumb-main">
                                <h4 class="text-capitalize breadcrumb-title">Data Tahun </h4>
                                <div class="breadcrumb-action justify-content-center flex-wrap">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>Tahun </a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Data Tahun </li>
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
                        <h5>Form Edit Tahun</h5>
                    </div>


                    <div class="card-body">
                        <form method="POST"  action="{{ route('pengumpulan.muzaki.update', $data->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                     
            <div class="row g-3">
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="nama_muzaki">NPWZ</label>
                    <input class="form-control" id="nama_muzaki" type="text" name="npwz" placeholder="NPWZ Muzaki" value="{{ $data->npwz }}">
                </div>
            </div>
            <div class="row g-3">
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="nama_muzaki">Nama Muzaki</label>
                    <input class="form-control" id="nama_muzaki" type="text" name="nama_muzaki" placeholder="Nama Muzaki" value="{{ $data->nama_muzaki }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="nik">NIK</label>
                    <input class="form-control" id="nik" type="text" name="nik" placeholder="NIK" value="{{ $data->nik }}">
                </div>
            </div>
            <div class="row g-3">
                <div class="col-md-2 mb-3">
                    <label class="form-label" for="tgl_register">Tanggal Register</label>
                    <input class="form-control" id="tgl_register" type="date" name="tgl_register" value="{{ $data->tgl_register }}">
                </div>
                  <div class="col-md-4 mb-3">
                    <label class="form-label" for="jenis_kelamin">Jenis Kelamin</label>
                    <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="L" {{ $data->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ $data->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
              
            </div>
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label" for="telp">Telepon</label>
                    <input class="form-control" id="telp" type="text" name="telp" placeholder="Telepon" value="{{ $data->telp }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="hp">HP</label>
                    <input class="form-control" id="hp" type="text" name="hp" placeholder="HP" value="{{ $data->hp }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label" for="alamat">Alamat</label>
                    <input class="form-control" id="alamat" type="text" name="alamat" placeholder="Alamat" value="{{ $data->alamat }}">
                </div>
            </div>
            <div class="row g-3">
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="email">Email</label>
                    <input class="form-control" id="email" type="email" name="email" placeholder="Email" value="{{ $data->email }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="npwp">NPWP</label>
                    <input class="form-control" id="npwp" type="text" name="npwp" placeholder="NPWP" value="{{ $data->npwp }}">
                </div>
            </div>
            <div class="row g-3">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Dinas</label>
                    <select name="dinas" id="select-search" class="form-control" placeholder="-- Pilih Dinas --">
                        <option value=""> -- Pilih Dinas -- </option>
                        @foreach($dinas as $d)
                        <option value="{{ $d->id }}" {{ $data->dinas == $d->id ? 'selected' : '' }}> {{ $d->nama_muzaki }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-8 mb-3">
                    <label class="form-label" for="keterangan">Keterangan</label>
                    <input class="form-control" id="keterangan" type="text" name="keterangan" placeholder="Keterangan" value="{{ $data->keterangan }}">
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

@section('script')
@endsection