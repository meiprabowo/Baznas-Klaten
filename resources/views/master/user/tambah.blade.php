@section('title',$title)
@extends('layout.app')
@section('content')
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop-breadcrumb">

                            <div class="breadcrumb-main">
                                <h4 class="text-capitalize breadcrumb-title">Data Tahun</h4>
                                <div class="breadcrumb-action justify-content-center flex-wrap">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>Tahun</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Data Tahun</li>
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
                        <form method="POST" action="{{ route('master.user.store') }}" enctype="multipart/form-data">
                        @csrf
                          <div class="row g-3">
                            <div class="col-md-6">
                              <label class="form-label" for="validationDefault01">Nama Lengkap</label>
                              <input class="form-control" id="validationDefault01" type="text" name="nama" placeholder="Nama Lengkap" required="">
                            </div>
                            <div class="col-md-6 mb-3">
                              <label class="form-label" for="validationDefault02">Email</label>
                              <input class="form-control" id="validationDefault02" type="email" name="email" placeholder="Email" required="">
                            </div>
                           
                          </div>
                          <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label" for="validationDefault01">Telepon / HP</label>
                                <input class="form-control" id="validationDefault01" type="text" name="hp" placeholder="Telepon" required="">
                              </div>
                              <div class="col-md-4  mb-3">
                                <label class="form-label" for="validationDefault02">Bagian</label>
                                <select class="form-select form-control-inverse" name="status">
                                    <option> -- Pilihan Bagian --</option>
                                    <option value="A">Administrator</option>
                                    <option value="PR">Penerimaan Proposal</option>
                                    <option value="PG">Pengumpulan </option>
                                    <option value="KU">Keuangan</option>
                                    <option value="SD">SDM Umum</option>
                                    <option value="B">User Baru</option>
                                  </select>
                                </div>
                                
                            </div>
                          
                            <div class="row g-3">
                            
                                <div class="col-md-6 mb-3">
                                  <label class="form-label" for="validationDefault02">Foto</label>
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



