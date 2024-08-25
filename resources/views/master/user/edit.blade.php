@section('title',$title)
@extends('layout.app')
@section('content')
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop-breadcrumb">

                            <div class="breadcrumb-main">
                                <h4 class="text-capitalize breadcrumb-title">Data User</h4>
                                <div class="breadcrumb-action justify-content-center flex-wrap">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>Master</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Data User</li>
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
                    <form method="POST"  action="{{ route('master.user.update', $data->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row g-3">
                                <div class="col-md-6">
                                  <label class="form-label" for="validationDefault01">Nama Lengkap</label>
                                  <input class="form-control" id="validationDefault01" type="text" name="nama" placeholder="Nama Lengkap" value="{{ $data->name }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                  <label class="form-label" for="validationDefault02">Email</label>
                                  <input class="form-control" id="validationDefault02" type="email" name="email" placeholder="Email" value="{{ $data->email }}">
                                </div>
                               
                              </div>
                              <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label" for="validationDefault01">Telepon / HP</label>
                                    <input class="form-control" id="validationDefault01" type="text" name="hp" placeholder="Telepon" value="{{ $data->hp }}">
                                  </div>
                                  <div class="col-md-4 mb-3">
                                    <label class="form-label" for="validationDefault02">Bagian </label>



                                      <select class="form-select form-control-inverse" name="status">
                                    <option> -- Pilihan Bagian --</option>
                                    <option value="A" {{ $data->status == 'A' ? 'selected' : '' }}>Administrator</option>
                                    <option value="PR" {{ $data->status == 'PR' ? 'selected' : '' }}>Penerimaan Proposal</option>
                                    <option value="PG" {{ $data->status == 'PG' ? 'selected' : '' }}>Pengumpulan</option>
                                    <option value="KU" {{ $data->status == 'KU' ? 'selected' : '' }}>Keuangan</option>
                                    <option value="SD" {{ $data->status == 'SD' ? 'selected' : '' }}>SDM Umum</option>
                                    <option value="B" {{ $data->status == 'B' ? 'selected' : '' }}>User Baru</option>
                                  </select>


                                    </div>
                                    <div class="col-md-4 mb-3">
                                <label class="form-label" for="validationDefault02">Status</label>
                                <select class="form-select form-control-inverse" name="aktif">
                                    <option> -- Pilihan Status --</option>
                                    <option value="A"  {{ $data->aktif == 'A' ? 'selected' : '' }}> Aktif</option>
                                    <option value="N" {{ $data->aktif == 'N' ? 'selected' : '' }} >Non-Aktif</option>
                                  </select>
                                </div>
                                </div>
                              
                             
                                <div class="row g-3">
                                    <div class="col-md-3 mb-3">
                                        <div class="avatar">
                                            <img class="img-100 rounded-circle" src="{{ url('/data_file/'.$data->foto) }}" alt="#">
                                            <div class="status status-online"></div>
                                          </div> <br/>
                                      <label class="form-label" for="validationDefault02">Foto Pegawai</label>
                                      <input class="form-control" type="file" name="foto">
                                  </div>
                                 
                            </div>
                                
                            <div class="row g-3">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="validationDefault02">Password</label>
                                    <input class="form-control" id="validationDefault02" type="password" name="password">
                                    <div class="invalid-feedback">Silahkan di kosongkan apabila tidak dirubah</div>
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



