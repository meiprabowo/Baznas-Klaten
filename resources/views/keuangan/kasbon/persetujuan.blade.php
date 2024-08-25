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

<table style='border-collapse: collapse;  width: 100%;'>
    <tr>
        <td style="position: relative;">
        <img src="{{ public_path('identitas/'.session('logo')) }}" width="100px" height="70px" style="position: absolute; left: -5px; top: 3px; padding: 5px;">
            <div style="padding-left: 100px;">
                <div style="font-size: 18px; font-weight: bold;">Badan Amil Zakat Nasional</div>
                <div style="font-size: 24px; font-weight: bold;">{{ session('nama') }}</div>
                <div style="font-size: 12px; font-style: italic;">{{ session('lokasi') }}</div>
                <div style="font-size: 12px;">Website: <a href="{{ session('website') }}">{{ session('website') }}</a>, Email: {{ session('email') }}
                </div>
            </div>
        </td>
    </tr>
</table>
<hr/>
<table style=' width: 100%;'>
    <tr>
        <td>
 <center><b><u><font face='Arial, Helvetica, sans-serif'>  PERSETUJUAN PERMOHONAN KASBON </font> </u></b><br/> {{ $data->kode_trx }}
 <br/>
    
    </center>
        </td>
    </tr>
<br/>
</table>


<table style=' width: 100%; border: 1px solid ; border-collapse: collapse; '>

 <tr style='border: 1px solid ; border-collapse: collapse'>
        <td align="center" width="25px" style='border: 1px solid ; border-collapse: collapse'>No </td>
        <td align="center" style='border: 1px solid ; border-collapse: collapse'> Kode Kasbon </td>
        <td align="center" style='border: 1px solid ; border-collapse: collapse'> Anggaran  </td>
        <td align="center" style='border: 1px solid ; border-collapse: collapse'> Kecukupan  </td>
        <td align="center" style='border: 1px solid ; border-collapse: collapse'> Keterangan  </td>
        <td align="center" style='border: 1px solid ; border-collapse: collapse'> Sumber Dana  </td>
</tr>


<tr style='border: 1px solid ; border-collapse: collapse'>
        <td align="center" width="25px" style='border: 1px solid ; border-collapse: collapse'>1. </td>
        <td align="center" style='border: 1px solid ; border-collapse: collapse'> {{ $data->kode_kasbon }} </td>
        <td align="center" style='border: 1px solid ; border-collapse: collapse'> {{ 'Rp ' . number_format($data->jumlah, 0, ',', '.')}}  </td>
        <td align="center" style='border: 1px solid ; border-collapse: collapse'>{{ 'Rp ' . number_format($data->jml, 0, ',', '.')}}  </td>
        <td align="center" style='border: 1px solid ; border-collapse: collapse'>  {{ $data->ket }}  </td>
        <td align="center" style='border: 1px solid ; border-collapse: collapse'> {{ $data->kre }}  </td>
</tr>
    
    
</table>

<br/>  
     
<table style='width: 100%;'>
    <tr>
<td align="left" style=" width: 67%;  height:100px">   <br/>
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Mengetahui,<br/> 
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Wakil Ketua III
 <br/>
<br/>
<br/>
<br/>   
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  {{ session('ka_keuangan') }}    </td>
        <td  align="left"  style="  height:100px">
<br/>

Boyolali, {{ date('d F Y', strtotime($data->tanggal)) }}
<br/>Disetujui, <br/> Ketua
<br/><br/><br/><br/>
{{ session('ka_sdm_umum') }}
    </td>
    </tr>
    
    
        <tr>
<td align="left" style=" width: 67%;  height:100px">   <br/>
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Diserahkan,<br/> 
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Petugas Keuangan
 <br/>
<br/>
<br/>
<br/>   
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; {{ session('keuangan') }}  </td>
        <td  align="left"  style="  height:100px">
<br/>

<br/>Diterima, <br/> Pembantu Petugas Keuangan
<br/><br/><br/><br/>
@if ($data->pemohon == 'PD')
    {{ session('proposal') }}
@else
    {{ session('sdm_umum') }}
@endif
<br/><br/>
    </td>
    </tr>

</table>


</table>

