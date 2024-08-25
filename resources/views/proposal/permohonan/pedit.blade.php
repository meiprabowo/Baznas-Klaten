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
                                <h4 class="text-capitalize breadcrumb-title">Data Proposal</h4>
                                <div class="breadcrumb-action justify-content-center flex-wrap">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>Proposal</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Data Proposal</li>
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


<!-- Sertakan jQuery sebelum menggunakan kode jQuery Anda -->

<script>
$(document).ready(function(){
    // Menangani perubahan dropdown kecamatan
    $('#kecamatan').change(function(){
        var kecamatanId = $(this).val();
        $('#kelurahan').empty();
        $('#kelurahan').append('<option value="">Pilih Kelurahan</option>');
        if(kecamatanId){
            // Mengisi dropdown kelurahan berdasarkan kecamatan yang dipilih
            $.ajax({
                url: '/proposal/permohonan/getkelurahan/' + kecamatanId,
                type: 'GET',
                dataType: 'json',
                success: function(response){
                    $.each(response, function(key, value){
                        $('#kelurahan').append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        }
    });
});
</script>


<script>
$(document).ready(function(){
    // Menangani perubahan dropdown kecamatan
    $('#program').change(function(){
        var kecamatanId = $(this).val();
        $('#subprogram').empty();
        $('#subprogram').append('<option value="">Pilih Sub Program</option>');
        if(kecamatanId){
            // Mengisi dropdown kelurahan berdasarkan kecamatan yang dipilih
            $.ajax({
                url: '/proposal/permohonan/getsubprogram/' + kecamatanId,
                type: 'GET',
                dataType: 'json',
                success: function(response){
                    $.each(response, function(key, value){
                        $('#subprogram').append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        }
    });
});
</script>

<script>
$(document).ready(function(){
    // Menangani perubahan dropdown kecamatan
    $('#subprogram').change(function(){
        var kecamatanId = $(this).val();
        $('#detailprogram').empty();
        $('#detailprogram').append('<option value="">Pilih Detail Program</option>');
        if(kecamatanId){
            // Mengisi dropdown kelurahan berdasarkan kecamatan yang dipilih
            $.ajax({
                url: '/proposal/permohonan/detailprogram/' + kecamatanId,
                type: 'GET',
                dataType: 'json',
                success: function(response){
                    $.each(response, function(key, value){
                        $('#detailprogram').append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        }
    });
});
</script>


         <div class="card">
                    <div class="card-header">
                        <h5>Form Tambah Proposal</h5>
                    </div>


                    <div class="card-body">
                    <form method="POST"  action="{{ route('proposal.proposal.pupdate', $data->id) }}" enctype="multipart/form-data">
                            @csrf                             @method('PUT')

                            <div class="row g-3">

                                <div class="col-md-6  mb-3">
                                    <label class="form-label" for="validationDefault02">Nomor Proposal</label>
                                    <input class="form-control" type="text" name="tanggal" value="{{ $data->nomor_proposal }}" disabled> 
                                </div>
      
                             
                             </div>

                
                        <div class="row g-3">

                                <div class="col-md-2">
                                    <label class="form-label" for="validationDefault02">Tanggal</label>
                                    <input class="form-control" type="date" name="tanggal" value="{{ $data->tanggal_masuk }}"> 
                                </div>
                             
                                <div class="col-md-3 mb-3">
                                    <label class="form-label" for="validationDefault02">Jenis Permohonan</label>
                                        <select class="form-control px-15" name="sifat" id="exampleFormControlSelect1" required="">
                                            <option value="uang"  {{ $data->jenis_permohonan == 'uang' ? 'selected' : '' }}>Uang</option>
                                            <option value="barang"  {{ $data->jenis_permohonan == 'barang' ? 'selected' : '' }}>Barang</option>
                                        </select> 
                                </div>
                             
                             </div>

                
                
                
                             <div class="row g-3">

                                <div class="col-md-4">
                                    <label class="form-label" for="validationDefault02">Nama Pemohon</label>
                                    <input class="form-control" type="text" name="nama" value="{{ $data->nama_pemohon }}">    
                                </div>
                             
                                <div class="col-md-4">
                                    <label class="form-label" for="validationDefault02">NIK</label>
                                    <input class="form-control" type="text" name="nik" value="{{ $data->nik }}">    
                                </div>
                             
                           
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="validationDefault02">Jenis Kelamin</label>
                                        <select class="form-control px-15" name="jenis_kelamin">
                                            <option value="L"  {{ $data->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki - laki</option>
                                            <option value="P"  {{ $data->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                                        </select> 
                                </div>
                             
                             </div>

                            <div class="row g-3">

                                <div class="col-md-3">
                                    <label class="form-label" for="validationDefault02">Tempat Lahir</label>
                                    <input class="form-control" type="text" name="tempat_lahir"  value="{{ $data->tempat_lahir }}">    
                                </div>
                             
                                <div class="col-md-2 mb-3">
                                    <label class="form-label" for="validationDefault02">Tanggal Lahir</label>
                                    <input class="form-control" type="date" name="tanggal_lahir"  value="{{ $data->tanggal_lahir }}">    
                                </div>
                             
                             </div>
                        

                            <div class="row g-3">

                                <div class="col-md-3">
                                    <label class="form-label" for="validationDefault02">HP</label>
                                    <input class="form-control" type="text" name="hp"  value="{{ $data->hp }}">    
                                </div>
                             
                                <div class="col-md-5 mb-3">
                                    <label class="form-label" for="validationDefault02">Pekerjaan</label>
                                    <input class="form-control" type="text" name="pekerjaan"  value="{{ $data->pekerjaan }}">    
                                </div>
                             
                             </div>
                        

                            <div class="row g-3">

                                <div class="col-md-10 mb-3">
                                    <label class="form-label" for="validationDefault02">Alamat Lengkap</label>
                                    <input class="form-control" type="text" name="alamat"  value="{{ $data->alamat_lengkap }}">    
                                </div>
                             </div>
                        

                            <div class="row g-3">

                                <div class="col-md-6">
                                    <label class="form-label" for="validationDefault02">Kecamatan</label>
                                        
                                        <select class="form-control px-15" id="kecamatan" name="kecamatan" id="exampleFormControlSelect1" required="">
                                            <option value="0">-- Pilih Kecamatan --</option>
                                            @foreach($kecamatan as $key => $kec)
                                            <option value="{{ $kec->id }}" {{ $data->kecamatan == $kec->id ? 'selected' : '' }}>{{ $kec->nama_kecamatan }}</option>
                                            @endforeach
                                        </select>   
                                    </div>
                             
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="validationDefault02">Kelurahan</label>
                                          <select class="form-control px-15" id="kelurahan" name="kelurahan" id="exampleFormControlSelect1" required="">
                                            <option value="0">-- Pilih Keluharan --</option>
                                            @foreach($kelurahan as $key => $kel)
                                            <option value="{{ $kel->id }}" {{ $data->kelurahan == $kel->id ? 'selected' : '' }}>{{ $kel->nama_kelurahan }}</option>
                                            @endforeach
                                          </select>
                                    </div>
                             
                             </div>
                        

                            <div class="row g-3">

                                <div class="col-md-2">
                                    <label class="form-label" for="validationDefault02">RT</label>
                                    <input class="form-control" type="text" name="rt" value="{{ $data->rt }}">
                                </div>
                             
                                <div class="col-md-2 mb-3">
                                    <label class="form-label" for="validationDefault02">RW</label>
                                    <input class="form-control" type="text" name="rw" value="{{ $data->rw }}">
                                </div>
                             
                             </div>
                        

                      

                            <div class="row g-3">

                                <div class="col-md-4">
                                    <label class="form-label" for="validationDefault02">Asnaf</label>
                                        <select class="form-control px-15" id="program" name="program" id="exampleFormControlSelect1" required="">
                                            <option value="0">Pilih Program</option>
                                            @foreach($program as $key => $pro)
                                            <option value="{{ $pro->kode }}"  {{ $data->program == $pro->kode ? 'selected' : '' }} >{{ $pro->uraian }}</option>
                                            @endforeach
                                        </select>
                                </div>
                             
                                <div class="col-md-4">
                                    <label class="form-label" for="validationDefault02">Program</label>
                                        <select class="form-control px-15" id="subprogram" name="subprogram" id="exampleFormControlSelect1" required="">
                                            <option value="0">-- Pilih Subprogram --</option>
                                            @foreach($subprogram as $key => $sub)
                                            <option value="{{ $sub->kode }}"  {{ $data->sub_program == $sub->kode ? 'selected' : '' }} >{{ $sub->uraian }}</option>
                                            @endforeach
                                        </select>
                                </div>
                             
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="validationDefault02">Sub Program</label>
                                    <select class="form-control px-15" id="detailprogram" name="detailprogram" id="exampleFormControlSelect1" required="">
                                            <option value="0">-- Pilih Detail Program --</option>
                                            @foreach($detailprogram as $key => $del)
                                            <option value="{{ $del->id }}"  {{ $data->detail_program == $del->id ? 'selected' : '' }} >{{ $del->uraian }}</option>
                                            @endforeach

                                          </select>
                                </div>
                             
                             </div>
                            

                            <div class="row g-3">

                                <div class="col-md-7 mb-3">
                                    <label class="form-label" for="validationDefault02">Jumlah Nominal</label>
                                    <input class="form-control" type="text" name="nominal"  value="{{ $data->nominal_pengajuan }}" oninput="formatNominal(this)">
                                </div>
                             
                             
                             </div>
                            


                            <div class="row g-3">

                                <div class="col-md-10 mb-3">
                                    <label class="form-label" for="validationDefault02">Keterangan</label>
                                    <input class="form-control" type="text" name="keterangan" value="{{ $data->keterangan }}">
                                </div>
                             
                             
                             </div>
                            


                             <div class="row g-3">

<div class="col-md-6 mb-3">
        <label class="form-label" for="validationDefault02">File Proposal                  
        @if($data->proposal!='')
                                <a  href="{{ url('/proposal/'.$data->proposal) }}" target="_blank">==> Download File <==</a>
                                @endif</label>
</label>
        <input class="form-control" type="file" name="proposal">
    </div>
 
    <div class="col-md-6 mb-3">
        <label class="form-label" for="validationDefault02">Bukti Tasaruf                  
        @if($kas && $kas->file != '')
                                <a  href="{{ url('/sdmumum/'.$kas->file) }}" target="_blank">==> Download File <==</a>
                            
                                @endif
                            </label>
</label>
        <input class="form-control" type="file" name="kasfile">
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
  $('#kecamatan, #kelurahan, #program, #subprogram, #detailprogram').select2();
});
</script>

@endsection



