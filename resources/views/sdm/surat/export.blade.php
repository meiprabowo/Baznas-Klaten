<!DOCTYPE html>
<html>
<head>
  <title>Surat Keluar</title>
 <script>
  // Membuka dialog pencetakan
  window.print();
  setTimeout(function() {
  window.close();
}, 2000); // 5000 milidetik = 5 detik

  </script> 
 <style>
  @page {
     margin-top: 8mm;
     margin-bottom: 10mm;
     margin-left: 10mm;
     margin-right: 10mm;
 }
 body {
   font-family: Arial;
   font-size:12px;
   margin: 0;
   padding: 0;
 }

 .header {
   text-align: center;
   margin-bottom: 20px;
 }

 .logo {
   width: 100px;
   height: 100px;
   margin-bottom: 10px;
 }

 .company-name {
  font-family: Arial;
   padding-left: 100px;
   font-size: 20px;
   font-weight: bold;
 }

 .address {
  font-family: Arial;
   padding-left: 100px;
   font-size: 12px;
   color: #504a4a;
 }

 .content {
  font-family: Arial;
   margin: 20px;
   line-height: 1.5;
 }

 .footer {
   text-align: center;
   font-size: 12px;
   color: #888;
   margin-top: 50px;
 }
 .perihal {
   font-weight: bold;
   margin-bottom: 5px;
 }

 .nomor-surat {
   margin-bottom: 10px;
 }

 .qr-code {
            position: absolute;
            top: 900px; /* Atur posisi vertikal QR code */
            left:20px; /* Atur posisi horizontal QR code */
    }
  .tembusan {
    padding-bottom: 100px;

}

</style>

@php
use Carbon\Carbon;

$tanggal = Carbon::parse($data['tanggal'])->format('d F Y');
@endphp
</head>
<body>
  <div class="header">
    {{-- <div class="logo">  <img src="{{ public_path('assets/logo.png') }}" alt="#"></div> --}}
    <div class="company-name">Badan Amil Zakat Nasional <br/> Kabupaten Boyolali</div>
    <div class="address">Jalan Merdeka Kompleks Perkantoran Pemerintah Daerah Kabupaten Boyolali </div>
    <hr/>
  </div>
 

  <div class="content">
    <p>Nomor &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp: {{ $data->nomor_surat }} <br/> Perihal &nbsp &nbsp &nbsp &nbsp &nbsp : {{ $data->perihal }} <br/> Lampiran &nbsp &nbsp &nbsp : {{ $data->lampiran }}</p>
  
    <p>Kepada Yth : <br/>
    {{ $data->kepada }} <br/> di {{ $data->lokasi_tujuan }}<p>
<?php echo $data['isi_surat']; ?>

<table width="100%">
  <tr>
    <td width="60%">{{ $qrCode }}</td>
    <td>Boyolali, {{ $tanggal }} <br/>
      Ketua Baznas Boyolali <br/><br/><br/>
      <br/>
    
    
    
      Jamal Zayed, M.M</td>
    
  </tr>
</table>
@if($data->tembusan!='')
<div class="tembusan">
  <p><b>Tembusan</b> &nbsp &nbsp &nbsp : <br/>
    <?php echo $data['tembusan'] ?>
</div>
@endif
 
</p>




</div>
  <div class="footer">
    {{-- <p>Email: info@perusahaan.com | Telepon: 123456789</p> --}}
  </div>
</body>
</html>

@section('script')

<script src="{{asset('assets/js/print.js')}}"></script>
@endsection