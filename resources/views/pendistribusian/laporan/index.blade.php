@section('title',$title)
@extends('layout.app')
@section('content')
@php
use Carbon\Carbon;
@endphp
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop-breadcrumb">

                            <div class="breadcrumb-main">
                                <h4 class="text-capitalize breadcrumb-title">Laporan Keuangan </h4>
                                <div class="breadcrumb-action justify-content-center flex-wrap">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>Keuangan </a></li>
                                            <li class="breadcrumb-item active" aria-current="page"> Laporan</li>
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
                url: '/proposal/permohonan/getsubprogramm/' + kecamatanId,
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
                url: '/proposal/permohonan/detailprogramm/' + kecamatanId,
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



                <div class="row">
                    
                    <div class="col-lg-12">
                          <div class="card card-default card-md mb-4">
                            
                              <div class="card-header">
                                 <h6>Laporan Buku Besar</h6>
                              </div>
                              <div class="card-body">
                        <form action="{{ route('pendistribusian.mutasi.laporanbukubesarpen') }}" enctype="multipart/form-data">
                          
                            <div class="row g-3">
                                
                                    
                                    <div class="col-md-3 mb-3">
                                    <label class="form-label">Periode Laporan : </label>
                                        <select class="form-select" id="bulan" name="bulan" required>
                                        <option value=""> ==> Pilih Periode Laporan <== </option>
							<option value="01">Januari</option>
							<option value="02">Februari</option>
							<option value="03">Maret</option>
							<option value="04">April</option>
							<option value="05">Mei</option>
							<option value="06">Juni</option>
							<option value="07">Juli</option>
							<option value="08">Agustus</option>
							<option value="09">September</option>
							<option value="10">Oktober</option>
							<option value="11">November</option>
							<option value="12">Desember</option>
                                        </select>
                                    </div>

                             </div>
                             <div class="row g-3">
                                        <div class="col-md-4 mb-3">
                                                    <label class="form-label" for="nik">Kas</label>
                                                    <select class="form-control px-15" id="program" name="program" id="exampleFormControlSelect1" required="">
                                            <option value="0">Pilih Program</option>
                                            @foreach($program as $key => $pro)
                                            <option value="{{ $pro->kode }}">{{ $pro->uraian }}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                        <label class="form-label" for="jenis_kelamin">Sub Kas : </label>
                                        <select class="form-control px-15" id="subprogram" name="subprogram" id="exampleFormControlSelect1" required="">
                                            <option value="0">-- Pilih Subprogram --</option>
                                          </select>
                                          </div></div>
                                        <div class="row g-3">
                                        <div class="col-md-5 mb-3">
                                        <label class="form-label" for="jenis_kelamin">Detail Kas : </label>
                                        <select class="form-control px-15" id="detailprogram" name="detail_program" id="exampleFormControlSelect1" required="">
                                            <option value="0">-- Pilih Detail Program --</option>
                                          </select>
                                        </div>
                                    </div>

                                  
                                  
                                   

                               
                        

                          <button class="btn btn-primary" type="submit">Simpan</button>
                        </form>
                      </div>
                    </div>        

                                </div>
                              </div>
                              <div class="col-lg-12">
                          <div class="card card-default card-md mb-4">
                            
                              <div class="card-header">
                                 <h6>Neraca</h6>
                              </div>
                              <div class="card-body">
                        <form action="{{ route('pendistribusian.mutasi.neracapen') }}" enctype="multipart/form-data">
                          
                            <div class="row g-3">
                                
                                    
                                    <div class="col-md-3 mb-3">
                                    <label class="form-label">Periode Laporan : </label>
                                        <select class="form-select" id="bulan" name="bulan" >
                                        <option> ==> Pilih Periode Laporan <== </option>
							<option value="01">Januari</option>
							<option value="02">Februari</option>
							<option value="03">Maret</option>
							<option value="04">April</option>
							<option value="05">Mei</option>
							<option value="06">Juni</option>
							<option value="07">Juli</option>
							<option value="08">Agustus</option>
							<option value="09">September</option>
							<option value="10">Oktober</option>
							<option value="11">November</option>
							<option value="12">Desember</option>
                                        </select>
                                    </div>

                             </div>
                             
                                  
                                  
                                   

                               
                        

                          <button class="btn btn-primary" type="submit">Simpan</button>
                        </form>
                      </div>
                    </div>        



                    <div class="col-lg-12">
                          <div class="card card-default card-md mb-4">
                            
                              <div class="card-header">
                                 <h6>Laporan Realisasi Anggaran
</h6>
                              </div>
                              <div class="card-body">
                        <form action="{{ route('pendistribusian.mutasi.realisasianggaranpen') }}" enctype="multipart/form-data">
                          
                            <div class="row g-3">
                                
                                    
                                    <div class="col-md-3 mb-3">
                                    <label class="form-label">Periode Laporan : </label>
                                        <select class="form-select" id="bulan" name="bulan" >
                                        <option> ==> Pilih Periode Laporan <== </option>
							<option value="01">Januari</option>
							<option value="02">Februari</option>
							<option value="03">Maret</option>
							<option value="04">April</option>
							<option value="05">Mei</option>
							<option value="06">Juni</option>
							<option value="07">Juli</option>
							<option value="08">Agustus</option>
							<option value="09">September</option>
							<option value="10">Oktober</option>
							<option value="11">November</option>
							<option value="12">Desember</option>
                                        </select>
                                    </div>

                             </div>
                             
                                  
                                  
                                   

                               
                        

                          <button class="btn btn-primary" type="submit">Simpan</button>
                        </form>
                      </div>
                    </div>       



                    <div class="col-lg-12">
                          <div class="card card-default card-md mb-4">
                            
                              <div class="card-header">
                                 <h6>Laporan Perubahan Dana
</h6>
                              </div>
                              <div class="card-body">
                        <form action="{{ route('pendistribusian.mutasi.perubahanpen') }}" enctype="multipart/form-data">
                          
                            <div class="row g-3">
                                
                                    
                                    <div class="col-md-3 mb-3">
                                    <label class="form-label">Periode Laporan : </label>
                                        <select class="form-select" id="bulan" name="bulan" >
                                        <option> ==> Pilih Periode Laporan <== </option>
							<option value="01">Januari</option>
							<option value="02">Februari</option>
							<option value="03">Maret</option>
							<option value="04">April</option>
							<option value="05">Mei</option>
							<option value="06">Juni</option>
							<option value="07">Juli</option>
							<option value="08">Agustus</option>
							<option value="09">September</option>
							<option value="10">Oktober</option>
							<option value="11">November</option>
							<option value="12">Desember</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                    <label class="form-label">Jenis Laporan : </label>
                                        <select class="form-select" id="bulan" name="jenis" >
                                        <option> ==> Pilih Jenis Laporan <== </option>
							<option value="1">Dana Zakat</option>
							<option value="2">Dana Infaq/Sedekah</option>
							<option value="3">Dana Amil</option>
							<option value="5">Dana APBN/APBD</option>
							<option value="6">Dana Jasa Giro</option>
							
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
</div>
@endsection



