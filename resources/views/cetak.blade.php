<style>

.line {
border:0;
border-style:inset;
border-top: 1px solid #000;
}

.p {
 face :Arial, Helvetica, sans-serif;
}
</style>
<?php  
use Carbon\Carbon;
?>

<table style='border-collapse: collapse; border: 1px solid #000; width: 100%;'>
    <tr>
        <td style="position: relative;">
        <img src="{{ public_path('identitas/logo.png') }}" width="100px" height="70px" style="position: absolute; left: -5px; top: 3px; padding: 5px;">
            <div style="padding-left: 100px;">
                <div style="font-size: 18px; font-weight: bold;">Badan Amil Zakat Nasional</div>
                <div style="font-size: 24px; font-weight: bold;">Baznas Kabupaten Boyolali</div>
                <div style="font-size: 12px; font-style: italic;">Jalan Merdeka Timur, Kompleks Perkantoran PEMDA Kabupaten Boyolali</div>
                <div style="font-size: 12px;">Website: http://www.baznasboyolali.or.id, Email: docbaznas@gmail.com </div>
            </div>
        </td>
    </tr>
</table>

<table style='border-left: 1px solid; border-right:1px solid; width: 100%;'>
    <tr>
        <td>
 <center><b><u>BUKTI SETORAN ZIS</u></b><br/><br/>
    
    </center>
        </td>
    </tr>
</table>
<table style='border-left: 1px solid; border-right:1px solid; width: 100%;'>
    <tr>
        <td width="20%"> Nomor   </td>
        <td> :     {{ $data->kode_transaksi }}</td>
    </tr>
    <tr>
        <td> Periode  </td>

        <td> :     <?php  $tanggal = Carbon::parse($data->tanggal)->format('d F Y');
        $tgll = explode(" ",$tanggal);
         echo "$tgll[1] $tgll[2] "; ?> </td>
    </tr>
</table>
<table style='border-left: 1px solid; border-right:1px solid; width: 100%;'>
    <tr>
        <td>
     <br/>
        </td>
    </tr>
</table>
<table style='border-top: 1px solid; border-left: 1px solid; border-right:1px solid; width: 100%;'>
    <tr>
        <td width="20%"><br/> Telah terima dari   </td>
        <td> <br/>:     {{ $data->nama_muzaki }}</td>
    </tr>
    <tr>
        <td> NPWZ </td>
        <td> : {{ $data->npwz }}</td>
    </tr>
    <tr>
        <td> NPWP </td>
        <td> : {{ $data->npwp }}</td>
    </tr>
    <tr>
        <td> Alamat </td>
        <td> : {{ $data->alamat }}</td>
    </tr>
    <tr>
        <td> HP / Email </td>
        <td> : {{ $data->hp }} / {{ $data->email }}</td>
    </tr>
</table>
<table style='border-left: 1px solid; border-right:1px solid; width: 100%;'>
    <tr>
        <td>
     <br/>
        </td>
    </tr>
</table> 



<table style='border-top: 1px solid; border-left: 1px solid; border-right:1px solid; width: 100%'>
    <tr align="center" style="border-bottom: 1px solid;">
        <td style="border-right: 1px solid; width: 25%"> Objek ZIS   </td>
        <td style="border-right: 1px solid; width: 25%"> Keterangan </td>
        <td style="border-right: 1px solid; width: 25%"> Via </td>
        <td style="width: 25%"> Jumlah   </td>
    </tr>
</table>
<table  valign='middle' style='border: 1px solid; width: 100%'>
    <tr align="center" style="border-bottom: 1px solid;">
        <td style="border-right: 1px solid; width: 25%;  height:100px"> {{ $data->uraian }}</td>
        <td style="border-right: 1px solid; width: 25%"> {{ $data->keterangan }}</td>
        <td style="border-right: 1px solid; width: 25%"> {{ $data->kredituraian }} </td>
        <td style="width: 25%">{{ 'Rp ' . number_format($data->jumlah, 0, ',', '.')}},- </td>
    </tr>
</table>
<table style='border-bottom: 1px solid; border-left: 1px solid; border-right:1px solid; width: 100%'>
    <tr align="center" style="border-bottom: 1px solid;">
        <td style="border-right: 1px solid; width: 75%"> Total   </td>

        <td style="width: 25%">{{ 'Rp ' . number_format($data->jumlah, 0, ',', '.')}},-   </td>
    </tr>
</table>
<table style='border-bottom: 1px solid; border-left: 1px solid; border-right:1px solid; width: 100%'>
    <tr align="left" style="border-bottom: 1px solid;">
        <td style=" padding-left: 10px;"> <br/>Terbilang : <br/>
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
 <br/><br/>
          </td>
    </tr>
</table>

<table style='border-left: 1px solid; border-right:1px solid; width: 100%'>
    <tr align="center" style="border-bottom: 1px solid;">
        <td style=" padding-left: 20px;"> <br/>
Semoga Allah SWT memberikan pahala kepada Anda atas harta yang telah dikeluarkan
dan menjadi berkah dan suci atas harta yang lainnya. <br/><br/>
          </td>
    </tr>
</table>

<table style='border-top: 1px solid; border-bottom: 1px solid; border-left: 1px solid; border-right:1px solid; width: 100%;'>
    <tr>
        <td align="center" style="border-right: 1px solid; width: 50%;  height:100px"><br/>
Pengesahan Petugas Amil 
<br/>
<img src="data:image/png;base64,{{ base64_encode($qrCode) }}" with="100px" height="100px"><br/>



{{ session('nama') }}<br/>
        </td>
        <td  align="center"  style="width: 50%;  height:100px">
        Penyetor / Wajib Zakat<br/>
        {{ session('wilayah') }}, {{ date('d F Y', strtotime($data->tanggal)) }}
<br/>
<br/>
<br/><br/>
<br/>
{{ $data->nama_muzaki }}



    </td>
    </tr>
</table>
<table style='border-bottom: 1px solid; border-left: 1px solid; border-right:1px solid; width: 100%;'>
    <tr valign="top">
        <td style="padding-bottom: 5px;">
           
            <font size='-3'>
                * Kepada para muzaki, BAZNAS memberikan bukti setoran zakat sesuai dengan UU No 23 tahun 2011 pasal 23 ayat 1. <br/>
                ** Bukti setoran zakat ini dapat digunakan sebagai pengurang penghasilan kena pajak (UU no 23 tahun 2011 pasal 23 ayat 2). <br/>
                *** BAZNAS hanya menerima donasi dari sumber yang halal, tidak bertentangan dengan peraturan yang berlaku, dan bukan merupakan pencucian uang.<br/>
                **** Nilai donasi natura ditaksir dalam jumlah rupiah oleh petugas yang mengesahkan bukti setoran zakat.<br/> 
                ***** Harta wajib zakat dimiliki secara sempurna (kepemilikan penuh). <br/>
                ****** Bukti Setoran ini di tanda tangani dan di validasi secara elektronik  <br/>
            </font>
          
        </td>
    </tr>
</table>
