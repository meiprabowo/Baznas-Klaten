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
                        <form method="POST" action="{{ route('sdm.tasaruf.tambahpengajuanpostsdm') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row g-3">

                                <div class="col-md-2">
                                    <label class="form-label" for="validationDefault02">Tanggal</label>
                                    <input class="form-control" type="date" name="tanggal" value="<?php echo"$date"; ?>"> 
                                </div>
                             
                                <div class="col-md-3 mb-3">
                                    <label class="form-label" for="validationDefault02">Nomor Pengajuan</label>
                                    <input class="form-control" type="text" name="pengajuan">   
                                </div>
                             
                             </div>
 
                     


                            <div class="row g-3">

                                <div class="col-md-10 mb-3">
                                    <label class="form-label" for="validationDefault02">Keterangan</label>
                                    <input class="form-control" type="text" name="keterangan">    
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



