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
    </style>
</head>
<body>
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

<table style='border-collapse: collapse; border: 1px solid #000; width: 100%;'>
    <tr>
        <td style="text-align: center;">
            <b>PEMBELIAN BARANG</b>
        </td>
    </tr>
</table>

<table style='border-collapse: collapse; border: 0.5px solid #000; width: 100%;'>
    <tr>
        <td style="padding: 5px;" width="20%">Nomor</td>
        <td style="padding: 5px;">: {{ $data->kode_transaksi }}</td>
    </tr>
    <tr>
        <td style="padding: 5px;">Tanggal</td>
        <td style="padding: 5px;">: {{ date('d F Y', strtotime($data->tanggal)) }}</td>
    </tr>
    <tr>
        <td style="padding: 5px;">Jumlah</td>
        <td style="padding: 5px;">: {{ $data->qty }} QTY</td>
    </tr>
    <tr>
        <td style="padding: 5px;">Nominal</td>
        <td style="padding: 5px;">: Rp {{ number_format($data->jumlah, 0, ',', '.') }}</td>
    </tr>
    <tr>
        <td style="padding: 5px;">Keterangan</td>
        <td style="padding: 5px;">: {{ $data->keterangan }}</td>
    </tr>
</table>

<table style='border-collapse: collapse; border: 1px solid #000; width: 100%;'>
    <tr>
        <td style="text-align: right; padding: 5px;">
            {{ session('wilayah') }}, {{ date('d F Y', strtotime($data->tanggal)) }}<br>
            Petugas Bidang Pendistribusian
            <br><img src="data:image/png;base64,{{ base64_encode($qrCode) }}" with="80px" height="80px"> <br>
            {{ Auth::user()->name }}
        </td>
    </tr>
</table>

</body>
</html>
