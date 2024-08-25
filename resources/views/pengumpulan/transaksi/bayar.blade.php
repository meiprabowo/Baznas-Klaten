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
                                <h4 class="text-capitalize breadcrumb-title">Data Transaksi Pengumpulan</h4>
                                <div class="breadcrumb-action justify-content-center flex-wrap">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>Pengumpulan</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Transaksi</li>
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
                        <h5>Form Tambah Transaksi Pengumpulan</h5>
                    </div>


                    <div class="card-body">
                    <form method="POST"  action="{{ route('pengumpulan.pengumpulan.bayarpost', $data->id) }}" enctype="multipart/form-data">
                        @csrf
                            <div class="row g-3">
                                <div class="col-md-3 mb-3">
                                    <label class="form-label" for="validationDefault02">Tanggal</label>
                                    <input class="form-control" type="date" name="tanggal" value="<?php echo"$date"; ?>">
                                </div>
                           
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="validationDefault02">NPWZ</label>
                                    <input class="form-control" type="text" value="{{ $data->npwz }}" disabled>
                                </div>
                            
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="validationDefault02">Nama Lengkap</label>
                                    <input class="form-control" type="text"  value="{{ $data->nama_muzaki }}" disabled>
                                </div>
                             </div>
                             <div class="row g-3">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="validationDefault02">Debet</label>
                                    <div class="dm-select ">
                                        <select name="sumber" class="form-control"  id="select-search" >      
                                        @foreach($sumber as $key => $d)
                                        <option value="{{ $d->id }}"> {{ $d->uraian }}</option>
                                        @endforeach
                                      </select>
                                    </div>  
                                </div>
                       
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="validationDefault02">Kredit</label>
                                    <div class="dm-select ">
                                        <select name="keperluan" id="keperluan" class="form-control">      
                                        @foreach($tujuan as $tu => $t)
                                        <option value="{{ $t->id }}"> {{ $t->uraian }}</option>
                                        @endforeach
                                      </select> 
                                    </div> 
                                </div>
                          
                               
                            </div>
                                           
                            <div class="row g-3">
                            
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="validationDefault02">Jumlah</label>
                                    <input class="form-control" id="validationDefault01" type="text" name="jumlah" placeholder="Jumlah" oninput="formatNominal(this)">
                                </div>
                          
                                <div class="col-md-8 mb-3">
                                    <label class="form-label" for="validationDefault02">Keterangan</label>
                                    <input class="form-control" id="validationDefault01" type="text" name="keterangan" placeholder="Keterangan">
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
<script type="text/javascript"> 
 $(document).ready(function() {
 $('#keperluan').select2();
 });
</script>

@endsection



