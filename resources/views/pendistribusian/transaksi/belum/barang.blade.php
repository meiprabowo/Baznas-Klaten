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
                                <h4 class="text-capitalize breadcrumb-title">Detail Proposal </h4>
                                <div class="breadcrumb-action justify-content-center flex-wrap">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>Pendistribusian </a></li>
                                            <li class="breadcrumb-item" aria-current="page">Tasaruf</li>
                                            <li class="breadcrumb-item active" aria-current="page">Belum</li>
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
                        <h5>Form Tasaruf ( Barang )</h5>
                    </div>


                    <div class="card-body">
                    <form method="POST"  action="{{ route('pendistribusian.tasaruf.barangstore', $data->id) }}" enctype="multipart/form-data">
                            @csrf                               

                            <div class="row g-3">

                       


                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="validationDefault02">Nomor Proposal</label>
                                    <input class="form-control" type="text" name="nomor" value="{{ $data->nomor_proposal }}" disabled> 
                                    <input type="hidden" name="id" value="{{ $data->id }}"> 
                                </div>
      
                                <div class="col-md-5  mb-3">
                                    <label class="form-label" for="validationDefault02">Nama Pemohon</label>
                                    <input class="form-control" type="text" name="nama" value="{{ $data->nama_pemohon }}" disabled>    
                                </div>
                             
                                 
                             </div>


                             <div class="row g-3">

                                <div class="col-md-2 mb-3">
                                        <label class="form-label" for="validationDefault02">Tanggal</label>
                                        <input class="form-control" type="date" name="tanggal" value="{{ $data->tanggal_masuk }}"> 
                                    </div>
                                

                                <div class="col-md-4">
                                    <label class="form-label" for="validationDefault02">Sumber</label>
                                    <div class="dm-select ">
                                        <select name="sumber" id="select-search" class="form-control ">      
                                        @foreach($sumber as $key => $d)
                                            @if($d->qty > $d->jml)
                                        <option value="{{ $d->id }}"> {{ $d->keterangan }} (<?php $sisa = $d->qty - $d->jml; echo"$sisa"; ?>)</option>
                                            @endif
                                        @endforeach
                                      </select>
                                    </div>  
                                </div>



                            
                            </div>


                            <div class="row g-3">

                                <div class="col-md-4">
                                    <label class="form-label" for="validationDefault02">Program</label>
                                        <select class="form-control px-15" id="program" name="program" id="exampleFormControlSelect1" required="">
                                            <option value="0">Pilih Program</option>
                                            @foreach($program as $key => $pro)
                                            <option value="{{ $pro->kode }}"  {{ $data->program == $pro->kode ? 'selected' : '' }} >{{ $pro->uraian }}</option>
                                            @endforeach
                                        </select>
                                </div>
                             
                                <div class="col-md-4">
                                    <label class="form-label" for="validationDefault02">Sub Program</label>
                                        <select class="form-control px-15" id="subprogram" name="subprogram" id="exampleFormControlSelect1" required="">
                                            <option value="0">-- Pilih Subprogram --</option>
                                            @foreach($subprogram as $key => $sub)
                                            <option value="{{ $sub->kode }}"  {{ $data->sub_program == $sub->kode ? 'selected' : '' }} >{{ $sub->uraian }}</option>
                                            @endforeach
                                        </select>
                                </div>
                             
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="validationDefault02">Detail Program</label>
                                    <select class="form-control px-15" id="detailprogram" name="detailprogram" id="exampleFormControlSelect1" required="">
                                            <option value="0">-- Pilih Detail Program --</option>
                                            @foreach($detailprogram as $key => $del)
                                            <option value="{{ $del->id }}"  {{ $data->detail_program == $del->id ? 'selected' : '' }} >{{ $del->uraian }}</option>
                                            @endforeach

                                          </select>
                                </div>
                             
                             </div>
                            

                            


                            <div class="row g-3">

                                <div class="col-md-10 mb-3">
                                    <label class="form-label" for="validationDefault02">Keterangan</label>
                                    <input class="form-control" type="text" name="keterangan" value="{{ $data->keterangan }}">
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



