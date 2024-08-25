@section('title',$title)
@extends('layout.app')
@section('content')

<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop-breadcrumb">

                            <div class="breadcrumb-main">
                                <h4 class="text-capitalize breadcrumb-title">Data Agenda</h4>
                                <div class="breadcrumb-action justify-content-center flex-wrap">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>SDM Umum</a></li>
                                            <li class="breadcrumb-item active" aria-current="page"> Agenda</li>
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
                        <h5>Form Edit Agenda</h5>
                    </div>


                    <div class="card-body">
                    <form method="POST"  action="{{ route('sdm.agenda.update', $data->id) }}" enctype="multipart/form-data">
                    @csrf                             @method('PUT')
                            <div class="row g-3">
                            <div class="col-md-12 mb-3">
                                    <label class="form-label" for="validationDefault02">Kegiatan</label>
                                    <input class="form-control" type="text" name="kegiatan" value="{{ $data->kegiatan }}">
                                  
                                </div>
                             
                             
                             
                             </div>
                            
                             <div class="row g-3">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label" for="validationDefault02">Waktu Pelaksanaan</label>
                                    <input class="form-control" type="text" name="waktu_pelaksanaan" value="{{ $data->waktu_pelaksanaan }}">
                                  
                                </div>
                             </div>               
        
                            
                             <div class="row g-3">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label" for="validationDefault02">Status</label>
                                    <select class="form-select form-control-inverse" name="status">
                                    <option> -- Pilihan Status --</option>
                                    <option value="Aktif"  {{ $data->status == 'Aktif' ? 'selected' : '' }}> Aktif</option>
                                    <option value="Non-Aktif" {{ $data->status == 'Non-Aktif' ? 'selected' : '' }} >Non-Aktif</option>
                                  </select> 
                                  
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



