<!DOCTYPE html>
<html>
<head>
    <style>
        .line {
            border: 0;
            border-style: inset;
            border-top: 1px solid #000;
        }

        .p {
            face: Arial, Helvetica, sans-serif;
        }
           /* Penyesuaian lebar halaman */

        body {
            margin-left: -0.2in; /* Menambahkan margin kiri 0.5 inci */
            margin-top: -0.2in; /* Menambahkan margin kanan 0.5 inci */
            margin-right: -0.2in; /* Menambahkan margin kanan 0.5 inci */
        }
    </style>
</head>
<body>
    
<table style='width: 100%;'>
    <tr>
    <td style="position: relative; text-align: center;">
            <img src="{{ public_path('identitas/'.session('logo')) }}" width="100px" height="70px" style="position: absolute; left: -5px; top: 3px; padding: 5px;">
            <div style="padding-left: 100px;">
                <div style="font-size: 18px; font-weight: bold;">Badan Amil Zakat Nasional</div>
                <div style="font-size: 24px; font-weight: bold;">{{ session('nama') }}</div>
                <div style="font-size: 12px; font-style: italic;">{{ session('lokasi') }}</div>
                <div style="font-size: 12px;">Website: <a href="{{ session('website') }}">{{ session('website') }}</a>, Email: {{ session('email') }}</div>
            </div>
        </td>
    </tr>
    <tr>
        <td style="border-top: 1px solid #000;"></td>
    </tr>
</table>


<table style='width: 100%;'>
    <tr>
        <td style="text-align: center;">
        <br/>
            <b><u>PENGAJUAN PENGESAHAN KE BENDAHARA</u></b> <br/>
            {{ $data->nomor_pengajuan }} <br/>
        </td>
    </tr>
</table> <br/>
<table style='border-collapse: collapse; width: 100%;'>
<thead>
    <tr style="border: 0.5px solid #000; background-color: #f2f2f2;">
        <td style="padding: 5px; border: 0.5px solid #000;" width="5%">No.</td>
        <td style="padding: 5px; border: 0.5px solid #000;">Kode Transaksi</td>
        <td style="padding: 5px; border: 0.5px solid #000;">Nama</td>
        <td style="padding: 5px; border: 0.5px solid #000;">Tanggal</td>
        <td style="padding: 5px; border: 0.5px solid #000;">Debet</td>
        <td style="padding: 5px; border: 0.5px solid #000;">Kredit</td>
        <td style="padding: 5px; border: 0.5px solid #000;">Jumlah</td>
        <td style="padding: 5px; border: 0.5px solid #000;">Keterangan</td>
    </tr>
</thead>
<tbody>
    <?php $no=1; $totalJumlah = 0; ?>
    @foreach($detail as $key => $d)
    <tr style="border: 0.5px solid #000;">
        <td style="padding: 5px; border: 0.5px solid #000;"><?php echo $no; ?></td>
        <td style="padding: 5px; border: 0.5px solid #000;">{{ $d->kode_transaksi }}</td>
        <td style="padding: 5px; border: 0.5px solid #000;">{{ $d->proposal }}</td>
        <td style="padding: 5px; border: 0.5px solid #000;">{{ date('d F Y', strtotime($d->tanggal)) }}</td>
        <td style="padding: 5px; border: 0.5px solid #000;">{{ $d->debett }}</td>
        <td style="padding: 5px; border: 0.5px solid #000;">{{ $d->kreditt }}</td>
        <td style="padding: 5px; border: 0.5px solid #000;">{{ 'Rp ' . number_format($d->jumlah, 0, ',', '.')}}</td>
        <td style="padding: 5px; border: 0.5px solid #000;">{{ $d->keterangan }}</td>
    </tr>
    <?php 
        $no++; 
        $totalJumlah += $d->jumlah;
    ?>
    @endforeach
    <tr style="border: 0.5px solid #000;">
        <td colspan="6" style="text-align: right; padding-right: 10px; font-weight: bold;">Total Jumlah:</td>
        <td style="padding: 5px; border: 0.5px solid #000; font-weight: bold;">{{ 'Rp ' . number_format($totalJumlah, 0, ',', '.')}}</td>
        <td></td>
    </tr>
</tbody>
</table>


<table style='border-collapse: collapse; border: 1px solid #000; width: 100%;'>
    <tr>
  
        <td style="text-align: center; padding: 5px;">
            {{ session('wilayah') }}, {{ date('d F Y', strtotime($data->tanggal)) }}<br>
            Petugas Bidang    @if($data->pengaju == 'P')
            Pendistribusian
                                    @else 
                                    SDM Umum         
                                    @endif
            <br><img src="data:image/png;base64,{{ base64_encode($qrCode) }}" with="80px" height="80px"> <br>
            {{ Auth::user()->name }}
        </td>
    </tr>
</table>
 
</body>
</html>
