@section('title',$title)
@extends('layout.app')
@section('content')
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop-breadcrumb">

                            <div class="breadcrumb-main">
                                <h4 class="text-capitalize breadcrumb-title">Identitas</h4>
                                <div class="breadcrumb-action justify-content-center flex-wrap">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>Master</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Identitas</li>
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
                        <h5>Identitas System Informasi</h5>
                    </div>


                    <div class="card-body">
                    <form method="POST"  action="{{ route('master.user.upiden') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row g-3">
                                <div class="col-md-6">
                                  <label class="form-label" for="validationDefault01">Nama </label>
                                  <input class="form-control" id="validationDefault01" type="text" name="nama" placeholder="Nama Baznas" value="{{ $data->nama }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                  <label class="form-label" for="validationDefault02">Email</label>
                                  <input class="form-control" id="validationDefault02" type="email" name="email" placeholder="Email" value="{{ $data->email }}">
                                </div>
                               
                              </div>
                              <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label" for="validationDefault01">Telepon</label>
                                    <input class="form-control" id="validationDefault01" type="text" name="telp" placeholder="Telepon" value="{{ $data->telp }}">
                                  </div>
                                  <div class="col-md-4 mb-3">
                                    <label class="form-label" for="validationDefault02">Website </label>
                                    <input class="form-control" id="validationDefault01" type="text" name="website" placeholder="website" value="{{ $data->website }}">
                                    </div>
                                 
                                </div>
                              
                            
                              
                                <div class="row g-3">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label" for="validationDefault01">Alamat</label>
                                    <input class="form-control" id="validationDefault01" type="text" name="alamat" placeholder="Alamat" value="{{ $data->lokasi }}">
                                  </div>
                              
                                 
                                </div>
                              
                                <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="validationDefault01">Bagian Pendistribusian</label>
                                    <input class="form-control" id="validationDefault01" type="text" name="pendistribusian" placeholder="Bagian Pendistribusian" value="{{ $data->proposal }}">
                                  </div>
                                  <div class="col-md-6 mb-3">
                                    <label class="form-label" for="validationDefault02">Ketua Pendistribusian </label>
                                    <input class="form-control" id="validationDefault01" type="text" name="kapendistribusian" placeholder="Ketua Pendistribusian" value="{{ $data->ka_proposal }}">
                                    </div>
                                 
                                </div>

                  
                                <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="validationDefault01">Bagian Pengumpulan</label>
                                    <input class="form-control" id="validationDefault01" type="text" name="pengumpulan" placeholder="Bagian Pengumpulan" value="{{ $data->penerimaan }}">
                                  </div>
                                  <div class="col-md-6 mb-3">
                                    <label class="form-label" for="validationDefault02">Ketua Pengumpulan </label>
                                    <input class="form-control" id="validationDefault01" type="text" name="kapengumpulan" placeholder="Ketua Pengumpulan" value="{{ $data->ka_penerimaan }}">
                                    </div>
                                 
                                </div>

                  
                                <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="validationDefault01">Bagian Keuangan</label>
                                    <input class="form-control" id="validationDefault01" type="text" name="keuangan" placeholder="Bagian Keuangan" value="{{ $data->keuangan }}">
                                  </div>
                                  <div class="col-md-6 mb-3">
                                    <label class="form-label" for="validationDefault02">Ketua Keuangan </label>
                                    <input class="form-control" id="validationDefault01" type="text" name="kakeuangan" placeholder="Ketua Keuangan" value="{{ $data->ka_keuangan }}">
                                    </div>
                                 
                                </div>

                                <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="validationDefault01">Bagian SDM Umum</label>
                                    <input class="form-control" id="validationDefault01" type="text" name="sdmumum" placeholder="Bagian SDM Umum" value="{{ $data->sdm_umum }}">
                                  </div>
                                  <div class="col-md-6 mb-3">
                                    <label class="form-label" for="validationDefault02">Ketua IV</label>
                                    <input class="form-control" id="validationDefault01" type="text" name="ketua_iv" placeholder="ketua_iv" value="{{ $data->ketua_iv }}">
                                    </div>
                                 
                                </div>

                                <div class="row g-3">

                                  <div class="col-md-6 mb-3">
                                    <label class="form-label" for="validationDefault02">Ketua </label>
                                    <input class="form-control" id="validationDefault01" type="text" name="kasdmumum" placeholder="Ketua" value="{{ $data->ka_sdm_umum }}">
                                    </div>
                                 
                                </div>


                                <div class="row g-3">
                                    <div class="col-md-3 mb-3">
                                        <div class="avatar">
                                            <img class="img-100 rounded-circle" src="{{ url('/identitas/'.$data->logo) }}" alt="#" width="200px" height="100px">
                                            <div class="status status-online"></div>
                                          </div> <br/>
                                      <label class="form-label" for="validationDefault02">Logo</label>
                                      <input class="form-control" type="file" name="foto">
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



