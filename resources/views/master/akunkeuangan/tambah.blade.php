@section('title',$title)
@extends('layout.app')
@section('content')
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop-breadcrumb">

                            <div class="breadcrumb-main">
                                <h4 class="text-capitalize breadcrumb-title">Data Akun Keuangan</h4>
                                <div class="breadcrumb-action justify-content-center flex-wrap">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>Akun Keuangan</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Data Akun Keuangan</li>
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
                        <h5>Form Tambah Tahun</h5>
                    </div>


                    <div class="card-body">
                        <form method="POST" action="{{ route('master.akun.store') }}" enctype="multipart/form-data">
                            @csrf
                          <div class="row g-3">
                            <div class="col-md-6">
                              <label class="form-label" for="validationDefault01">Kode</label>
                              <input class="form-control" id="validationDefault01" type="text" name="kode" placeholder="Kode Akun" required="">
                            </div>
                            <div class="col-md-6 mb-3">
                              <label class="form-label" for="validationDefault02">Uraian</label>
                              <input class="form-control" id="validationDefault02" type="text" name="uraian" placeholder="Uraian / Keterangan" required="">
                            </div>
                           
                          </div>
                          <div class="row g-3">
                            <div class="col-md-2">
                                <label class="form-label" for="validationDefault01">Level</label>
                                <input class="form-control" id="validationDefault01" type="text" name="level" placeholder="Level Akun" required="">
                              </div>
                              <div class="col-md-3 mb-3">
                                <label class="form-label" for="validationDefault02">Sifat</label>
                                <select class="form-control px-15" name="sifat" id="exampleFormControlSelect1" required="">
                                  <option> -- Pilihan Sifat --</option>
                                  <option value="D">Debet</option>
                                  <option value="K">Kredit</option>
                                </select>                     
                              </div>
                              <div class="col-md-3">
                                <label class="form-label" for="validationDefault01">Kelompok</label>
                                <input class="form-control" id="validationDefault01" type="text" name="kelompok" placeholder="Kelompok Akun" required="">
                              </div>
                            </div>
                        <div class="row g-3">
                          <div class="col-md-12  mb-3">
                        @foreach($dataku as $key => $d)
                        <input class="form-check-input" name="jenis_akun[]" id="flexCheckDefault" type="checkbox" value="{{ $d->kode_akun }}" >
                            <label class="form-check-label" for="flexCheckDefault">{{ $d->nama_akun }}</label>
                         @endforeach
                              </div>
                            </div>
                          
                         
                          <button class="btn btn-primary" type="submit">Simpan</button>
                        

                
                        </form>
                    </div>
                </div>
      </div>
   </div>
</div>
@endsection



