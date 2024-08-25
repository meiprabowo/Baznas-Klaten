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
                        <form method="POST"  action="{{ route('master.tahun.update', $data->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                          <div class="row g-3">
                            <div class="col-md-6">
                              <label class="form-label" for="validationDefault01">Tahun</label>
                              <input class="form-control" id="validationDefault01" type="text" name="nama" value="{{ $data->nama_tahun }}"placeholder="Tahun" required="">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="validationDefault02">Status </label>
                                <select class="form-select form-control-inverse" name="status">
                                    <option> -- Pilihan Status --</option>
                                    <option value="A"  {{ $data->status == 'A' ? 'selected' : '' }}> Aktif</option>
                                    <option value="N" {{ $data->status == 'N' ? 'selected' : '' }} >Non-Aktif</option>
                                  </select>                              </div>
                           
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