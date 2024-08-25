@extends('layouts.simple.master')
@section('title', 'Sample Page')

@section('css')
@endsection

@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">

@endsection

@section('breadcrumb-title')
<h3>Halaman Ruang</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Beranda</li>
<li class="breadcrumb-item"><a href="{{ route('ruang.index') }}">Ruang</a></li>
<li class="breadcrumb-item active">Tambah</li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">

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
                        <h5>Form Tambah Ruang</h5>
                    </div>


                    <div class="card-body">
                        <form method="POST" action="{{ route('ruang.store') }}" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="row g-3">
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="validationDefault01">Kode Ruang</label>
                                <input class="form-control" id="validationDefault01" type="text" name="kode"  placeholder="Kode Ruang" required="" >
                              </div>
                             
                              <div class="col-md-6 mb-3">
                                <label class="form-label" for="validationDefault01">Nama Ruang</label>
                                <input class="form-control" id="validationDefault01" type="text" name="nama"  placeholder="Nama ruang" required="" >
                              </div>
                             
                           
                              </div>
                              <div class="row g-3">
                              <div class="col-md-8">
                                    <label class="form-label" for="validationDefault02">Penanggung Jawab</label>
                                    <select class="js-example-basic-single" id="validationDefault01" name="pj">
                                        @foreach($pegawai as $key => $d)
                                        <option value="{{ $d->id }}"> {{ $d->nama_lengkap }}</option>
                                        @endforeach
                                      </select>  
                                </div>
                             
                              <div class="col-md-12 mb-3">
                                <label class="form-label" for="validationDefault01">Keterangan</label>
                                <input class="form-control" id="validationDefault01" type="text" name="keterangan"  >
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

<script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
<script src="{{asset('assets/js/select2/select2-custom.js')}}"></script>

@endsection