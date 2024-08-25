@section('title',$title)
@extends('layout.app')
@section('content')
<?php
use Carbon\Carbon;
$date = Carbon::now()->format('Y-m-d');
?>
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop-breadcrumb">

                            <div class="breadcrumb-main">
                                <h4 class="text-capitalize breadcrumb-title">Data Surat Keluar</h4>
                                <div class="breadcrumb-action justify-content-center flex-wrap">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>SDM Umum</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Surat Keluar</li>
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
                        <h5>Form Tambah Surat Keluar</h5>
                    </div>


                    <div class="card-body">
                    <form method="POST" action="{{ route('sdm.surat.store') }}" enctype="multipart/form-data">
                            @csrf
                          <div class="row g-3">
                            <div class="col-md-6 mb-3">
                              <label class="form-label" for="validationDefault01">Tanggal</label>
                              <input class="form-control" id="validationDefault01" type="date" name="tanggal" placeholder="Tahun" required="">
                            </div>
                      </div>

                      <div class="row g-3">
                        <div class="col-md-6">
                          <label class="form-label" for="validationDefault01">Nomor</label>
                          <input class="form-control" id="validationDefault01" type="text" name="nomor" placeholder="Nomor Surat" required="">
                        </div>
                          <div class="col-md-6 mb-3">
                            <label class="form-label" for="validationDefault01">Perihal</label>
                            <input class="form-control" id="validationDefault01" type="text" name="perihal" placeholder="Perihal" required="">
                          </div>      
                      </div>
                      <div class="row g-3">
                       
                          <div class="col-md-5">
                            <label class="form-label" for="validationDefault01">Kepada</label>
                            <input class="form-control" id="validationDefault01" type="text" name="kepada" placeholder="Tujuan Surat" required="">
                          </div>
                          <div class="col-md-3 mb-3">
                            <label class="form-label" for="validationDefault01">Lokasi Penerima</label>
                            <input class="form-control" id="validationDefault01" type="text" name="lokasi_tujuan" placeholder="lokasi" required="">
                          </div>      
                      </div>
                      <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
<style>
    /* Style the textarea to set its height */
    #editor {
        min-height: 300px; /* Set the desired minimum height here */
    }
</style>

<div class="row g-3">
    <div class="col-md-12 mb-3">
    <label class="form-label" for="validationDefault01">Isi Surat</label>
        <!-- Ensure the textarea has an ID -->
        <textarea name="diskripsi" id="editor"></textarea>
    </div>
</div>

<script>
    // Initialize CKEditor with the matching ID
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
</script>
                          <div class="row g-3">
                            <div class="col-md-2 mb-3">
                              <label class="form-label" for="validationDefault01"> Jumlah Lampiran </label>
                              <input class="form-control" id="validationDefault01" type="text" name="lampiran" placeholder="Lampiran">
                            </div>
                            <div class="col-md-6 mb-3">
                              <label class="form-label" for="validationDefault01"> File Lampiran </label>
                              <input class="form-control" type="file" name="file_lampiran">
                            </div> 
                            <div class="row g-3">
                              <div class="col-md-12 mb-3">
                                <label class="form-label" for="validationDefault01">Tembusan</label>
                                <textarea class="form-control" id="floatingTextarea" name="tembusan" placeholder="Tembusan"></textarea>
                              </div>
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



