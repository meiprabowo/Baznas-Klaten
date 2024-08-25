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

<table style='border-collapse: collapse; border: 1px solid #000; width: 100%;'>
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

<table style='border-left: 1px solid; border-right:1px solid; width: 100%;'>
    <tr>
        <td>
 <center><b><u>TANDA TERIMA PROPOSAL</u></b><br/><br/>
    
    </center>
        </td>
    </tr>
</table>
<table style='border-left: 1px solid; border-right:1px solid; width: 100%;'>
    <tr>
        <td width="20%"> Nomor   </td>
        <td> :    {{ $data->nomor_proposal }}</td>
    </tr>
    <tr>
        <td> Tanggal  </td>

        <td>: {{ date("d F Y", strtotime($data->tanggal_masuk)) }}</td>
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
        <td width="20%"><br/> Nama Pemohon   </td>
        <td> <br/>:    {{ $data->nama_pemohon }} </td>
    </tr>
    <tr>
        <td> NIK </td>
        <td> :  {{ $data->nik }}</td>
    </tr>
   
    <tr>
        <td> Alamat </td>
        <td> :  {{ $data->alamat_lengkap }}</td>
    </tr>
    <tr>
        <td> HP  </td>
        <td> :  {{ $data->hp }}</td>
    </tr>
</table>
<table style='border-left: 1px solid; border-right:1px solid; width: 100%;'>
    <tr>
        <td>
     <br/>
        </td>
    </tr>
</table>


<table style='border-top: 1px solid; border-bottom: 1px solid; border-left: 1px solid; border-right:1px solid; width: 100%;'>
    <tr>
        <td align="center" style="width: 100%;  height:100px">
Pengesahan Petugas Amil 
<br/>

<img src="data:image/png;base64,{{ base64_encode($qrCode) }}" with="120px" height="120px"> 
<br/>


{{ session('nama') }}<br/>
        </td>
      
    </tr>
</table>

<table style='border-bottom: 1px solid; border-left: 1px solid; border-right:1px solid; width: 100%'>
    <tr valign="up" align="left" style="border-bottom: 1px solid;">
        <td> <br/><font size='-3'> 
Kontek Person <br/>
{{ session('nama') }} ( 08813725915 )
<br/>
Cek data pengajuan proposal melalui link berikut ini : http://masboy.baznasboyolali.or.id/cetak/cek/ <br/>


</font> <br/> 

          </td>
    </tr>
</table>