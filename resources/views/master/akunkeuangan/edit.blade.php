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
                    <form method="POST"  action="{{ route('master.akun.update', $data->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row g-3">
                                <div class="col-md-4">
                                  <label class="form-label" for="validationDefault01">Kode</label>
                                  <input class="form-control" id="validationDefault01" type="text" name="kode" placeholder="Kode Akun" value="{{ $data->kode }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                  <label class="form-label" for="validationDefault02">Uraian</label>
                                  <input class="form-control" id="validationDefault02" type="text" name="uraian" placeholder="Uraian / Keterangan" value="{{ $data->uraian }}">
                                </div>
                               
                              </div>
                              <div class="row g-3">
                                <div class="col-md-2">
                                    <label class="form-label" for="validationDefault01">Level</label>
                                    <input class="form-control" id="validationDefault01" type="text" name="level" placeholder="Level Akun" value="{{ $data->level }}">
                                  </div>
                                  <div class="col-md-3">
                                    <label class="form-label" for="validationDefault02">Sifat</label>
                                    <select class="form-select form-control-inverse" name="sifat">
                                      <option> -- Pilihan Sifat --</option>
                                      <option value="D"  {{ $data->sifat == 'D' ? 'selected' : '' }} >Debet</option>
                                      <option value="K"  {{ $data->sifat == 'K' ? 'selected' : '' }} >Kredit</option>
                                    </select>                     
                                  </div>
                                  <div class="col-md-3">
                                    <label class="form-label" for="validationDefault01">Kelompok</label>
                                    <input class="form-control" id="validationDefault01" type="text" name="kelompok" placeholder="Kelompok Akun" value="{{ $data->kelompok }}">
                                  </div>
                                  <div class="col-md-3">
                                    <label class="form-label" for="validationDefault02">Status</label>
                                    <select class="form-select form-control-inverse" name="status">
                                      <option> -- Pilihan Sifat --</option>
                                      <option value="A"  {{ $data->status == 'A' ? 'selected' : '' }} >Aktif</option>
                                      <option value="N"  {{ $data->status == 'N' ? 'selected' : '' }} >Non Aktif</option>
                                    </select>                     
                                  </div>

                                  
                                  <div class="row g-3">
                          <div class="col-md-12  mb-3">
                          <?php
                        $cek = $data->jenis_akun;

                        $_arrNilai = explode(',',$cek) 
                        ?>

                        @foreach($dataku as $key => $d)
                       
                        <?php  $_ck = (array_search($d['kode_akun'], $_arrNilai) === false)? '' : 'checked'; ?>
                        <input class="form-check-input" name="jenis_akun[]" id="flexCheckDefault" type="checkbox" value="{{ $d->kode_akun }}" <?php echo"$_ck"; ?>>
                            <label class="form-check-label" for="flexCheckDefault">{{ $d->nama_akun }}</label>
                        
                         @endforeach
                              </div>
                            </div>
 
                            
                          
                            <button class="btn btn-primary" type="submit">Submit form</button>
                        </form>
                    </div>
                </div>
      </div>
   </div>
</div>
@endsection



