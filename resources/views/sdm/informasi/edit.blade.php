@section('title',$title)
@extends('layout.app')
@section('content')

<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop-breadcrumb">

                            <div class="breadcrumb-main">
                                <h4 class="text-capitalize breadcrumb-title">Data Informasi</h4>
                                <div class="breadcrumb-action justify-content-center flex-wrap">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>SDM Umum</a></li>
                                            <li class="breadcrumb-item active" aria-current="page"> Informasi</li>
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
                        <h5>Form Edit Informasi</h5>
                    </div>


                    <div class="card-body">
                    <form method="POST"  action="{{ route('sdm.informasi.update', $data->id) }}" enctype="multipart/form-data">
                    @csrf                             @method('PUT')
                            <div class="row g-3">
                            <div class="col-md-6 mb-3">
                                    <label class="form-label" for="validationDefault02">Judul</label>
                                    <input class="form-control" type="text" name="judul" value="{{ $data->judul }}">
                                  
                                </div>
                             
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="validationDefault02">Tanggal</label>
                                    <input class="form-control" type="date" name="tanggal" value="{{ $data->tanggal }}">
                                  
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
        <label class="form-label" for="validationDefault02">Keterangan</label>
        <!-- Ensure the textarea has an ID -->
        <textarea name="keterangan" id="editor">{{ $data->keterangan }}</textarea>
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
                            
                                <div class="col-md-6 mb-3">
                                  <label class="form-label" for="validationDefault02">File
                                  @if($data->file!='')
                                  <a class="pdf" href="{{ url('/informasi/'.$data->file) }}" target="_blank"><i class="icofont icofont-file-pdf"> </i> <b> ==> File Informasi <== </b></a>
                                  @endif
                                  </label>
                                  <input class="form-control" type="file" name="file"> 
                                  
                              </div>
                            </div>
  
        
                        

                          <button class="btn btn-primary" type="submit">Simpan</button>
                        </form>
                      </div>
                    </div>



                
                       
                    </div>
                </div>
      </div>
   </div>
</div>
@endsection



