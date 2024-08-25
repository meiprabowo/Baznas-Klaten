<!DOCTYPE html>
<html>
<head>
    <style>
        .line {
            border: 0;
            border-style: inset;
            border-top: 1px solid #000;
        }
        @page { margin: 10px; }
        body { 
            margin: 10px;
        }
    </style>
</head>
<body>
    <table style='border-top: 1px solid; color: blue; border-bottom: 1px solid; border-left: 1px solid; border-right:1px solid; width: 100%;'>
        <tr>
            <td style="position: relative;">
            <img src="{{ public_path('identitas/'.session('logo')) }}" width="100px" height="70px" style="position: absolute; left: -5px; top: 3px; padding: 5px;">
                <div style="padding-left: 100px;">
                    <div style="font-size: 19px; font-weight: bold;"> <font  face='Arial, Helvetica, sans-serif'>Badan Amil Zakat Nasional</font></div>
                    <div style="font-size: 24px; font-weight: bold;"> <font  face='Arial, Helvetica, sans-serif'>{{ session('nama') }}</font></div>
                    <div style="font-size: 12px; font-style: italic;"> <font  face='Arial, Helvetica, sans-serif'>{{ session('lokasi') }}</font></div>
                    <div style="font-size: 12px;"> <font  face='Arial, Helvetica, sans-serif'> Website: <a href="{{ session('website') }}">{{ session('website') }}</a>, Email: {{ session('email') }}</font></div>
                </div>
            </td>
        </tr>
    </table>
    <table style='border-left: 1px solid; border-right:1px solid; width: 100%; color: blue;'>
        <tr>
            <td>
                <center><b><u><font face='Arial, Helvetica, sans-serif'>  KWITANSI </font> </u></b><br/>
                {{ $data->kode_transaksi }}<br/><br/>
                </center>
            </td>
        </tr>
    </table>
    <table style='padding-left: 10px; border-left: 1px solid; border-right:1px solid; width: 100%; color: blue;'>
        <tr>
            <td width="120px" style="color: blue; height: 30px; ">
                <font  size='15px' face='Arial, Helvetica, sans-serif'> Dibayarkan Kepada <br/><i> paid to</i> </font>
            </td> 
            <td width="1px" style="color: blue;">  :</td>
            <td style="border-bottom: 1px solid; color: blue;">
                <font  size='16px' face='Monospace'>   {{ $data->nama_pemohon }} ({{ $data->alamat_lengkap }}) </font>
            </td>
        </tr>
        <tr>
            <td width="120" style="color: blue;  height: 30px">
                <font  size='15px' face='Arial, Helvetica, sans-serif'>  Jumlah   <br/> <i>Amount</i></font>
            </td>
            <td width="1px" style="color: blue;">  :</td>
            <td style="background-color: #c7cfd7;">
                <font  size='16px' face='Monospace'> 
<?php 
 function penyebut($nilai) {
 $nilai = abs($nilai);
 $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
 $temp = "";
 if ($nilai < 12) {
 $temp = " ". $huruf[$nilai];
 } else if ($nilai <20) {
 $temp = penyebut($nilai - 10). " belas";
 } else if ($nilai < 100) {
 $temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
 } else if ($nilai < 200) {
 $temp = " seratus" . penyebut($nilai - 100);
 } else if ($nilai < 1000) {
 $temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
 } else if ($nilai < 2000) {
 $temp = " seribu" . penyebut($nilai - 1000);
 } else if ($nilai < 1000000) {
 $temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
 } else if ($nilai < 1000000000) {
 $temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
 } else if ($nilai < 1000000000000) {
 $temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
 } else if ($nilai < 1000000000000000) {
 $temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
 }     
 return $temp;
 }
 
 function terbilang($nilai) {
 if($nilai<0) {
 $hasil = "minus ". trim(penyebut($nilai));
 } else {
 $hasil = trim(penyebut($nilai));
 }     
 return $hasil;
 }
 
 
 $angka = $data->jumlah;
 echo terbilang($angka); 
 ?> Rupiah
</font>
            </td>
        </tr>
        <tr>
            <td width="120" style="color: blue;">
                <font  size='15px' face='Arial, Helvetica, sans-serif'>  Untuk Pembayaran </font>
            </td>
            <td width="1px" style="color: blue;">  :</td>
            <td style="border-bottom: 1px solid; color: blue;">
                <font  size='16px' face='Monospace'> {{ $data->uraian }}</font>
            </td>
        </tr>
    </table>
    <table style='border-left: 1px solid;color: blue; border-right:1px solid; width: 100%;'>
        <tr>
            <td width="100%"> <br/>   </td>
        </tr>
    </table>
    <table style='border-left: 1px solid; border-right:1px solid; width: 100%; color: blue;'>
        <tr>
            <td width="2%">        </td>
            <td width="35%" style="background-color: #c7cfd7;">
                <font  size='16px' face='Monospace'>  {{ 'Rp ' . number_format($data->jumlah, 0, ',', '.')}},- </font>
            </td>
            <td width="38%">        
                <font  size='12px' face='Arial, Helvetica, sans-serif'>   </font>
            </td>
            <td width="40%">        
                <font  size='15px' face='Arial, Helvetica, sans-serif'> Boyolali , {{ date('d F Y', strtotime($data->tanggal)) }}</font>
            </td>
        </tr>
    </table>
    <table style='border-left: 1px solid; border-right:1px solid; width: 100%; color: blue;'>
        <tr>
            <td width="100%"> <Br/>        </td>
        </tr>
    </table>
    <table style='padding-left: 5px; border-left: 1px solid; border-right:1px solid; width: 100%; color: blue;'>
        <tr>
            <td width="40%"> 
                <font  size='15px' face='Arial, Helvetica, sans-serif'>   
                    BADAN AMIL ZAKAT NASIONAL <br/>
                    {{ session('nama') }} <br/>
                    {{ session('lokasi') }} <br/>
                    {{ session('email') }} 
                </font>
            </td>
            <td width="30%"> 
                <center>  
                    <br/><br/><br/>
                    <u><font  size='16px' face='Monospace'> <br/>{{ $data->nama_pemohon }}</font></u><br/>
                    <font  size='15px' face='Arial, Helvetica, sans-serif'> Penerima </font>  
                </center> 
            </td>
            <td width="30%"> 
                <center> 
                    <img src="data:image/png;base64,{{ base64_encode($qrCode) }}" with="80px" height="80px">  
                    <br/>
                    <u><font  size='16px' face='Monospace'>   {{ Auth::user()->name }}</font></u><br/>
                    <font  size='15px' face='Arial, Helvetica, sans-serif'>    Petugas    </font>
                </center> 
            </td>
        </tr>
    </table>
    <table style='border-left: 1px solid; border-right:1px solid; border-bottom:1px solid; border-top:1px solid; width: 100%; color: blue;'>
        <tr>
            <td align="left"> 
                <font  size='15px' face='Arial, Helvetica, sans-serif'>{{ session('website') }} </font>
            </td>
            <td align="right">
                <font  size='15px' face='Arial, Helvetica, sans-serif'>  Penerima </font>
            </td>
        </tr>
    </table>
</body>
</html>
