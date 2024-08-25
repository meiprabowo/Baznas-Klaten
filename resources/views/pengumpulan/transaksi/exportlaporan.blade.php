@php
use Carbon\Carbon;
@endphp
<table>
    <thead>
       <tr>
       <th scope="col" width="3%">No</th>
                     <th scope="col">Nama UPZ</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">s/d Bulan lalu</th>
                        <th scope="col">Jumlah Muzaki</th>
                        <th scope="col">Zakat</th>
                        <th scope="col">Jumlah Munfik</th>
                        <th scope="col">Infak</th>
                        <th scope="col">Total Bulan ini</th>
                        <th scope="col">Jumlah</th>
      </tr>
    </thead>
    <tbody>
    <?php 
    $no = 1; 
    $total_jmlblnkemarin = 0;
    $total_zakattotal = 0;
    $total_infaqtotal = 0;
    $total_count_zakat = 0;
    $total_count_infaq = 0;
?>

@foreach($data as $key => $d)
    <?php 
        $tanggal = Carbon::parse($d['tanggal'])->format('d F Y');
        $totalbln = $d->infaqtotal + $d->zakattotal;
        $total = $d->jmlblnkemarin + $totalbln;

        // Accumulate totals
        $total_jmlblnkemarin += $d->jmlblnkemarin;
        $total_zakattotal += $d->zakattotal;
        $total_infaqtotal += $d->infaqtotal;
        $total_count_zakat += $d->count_zakat;
        $total_count_infaq += $d->count_infaq;
    ?>
    <tr>
        <td>{{ $no }}</td>
        <td>{{ $d->nama_muzaki }}</td>
        <td>{{ $tanggal }}</td>
        <td>{{ 'Rp ' . number_format($d->jmlblnkemarin, 0, ',', '.') }}</td>
        <td>{{ $d->count_zakat }}</td>
        <td>{{ 'Rp ' . number_format($d->zakattotal, 0, ',', '.') }}</td>
        <td>{{ $d->count_infaq }}</td>
        <td>{{ 'Rp ' . number_format($d->infaqtotal, 0, ',', '.') }}</td>
        <td>{{ 'Rp ' . number_format($totalbln, 0, ',', '.') }}</td>
        <td>{{ 'Rp ' . number_format($total, 0, ',', '.') }}</td>
    </tr>
    <?php $no++; ?>
@endforeach

<tr>
    <td colspan="3"><strong>Total</strong></td>
    <td><strong>{{ 'Rp ' . number_format($total_jmlblnkemarin, 0, ',', '.') }}</strong></td>
    <td><strong>{{ $total_count_zakat }}</strong></td>
    <td><strong>{{ 'Rp ' . number_format($total_zakattotal, 0, ',', '.') }}</strong></td>
    <td><strong>{{ $total_count_infaq }}</strong></td>
    <td><strong>{{ 'Rp ' . number_format($total_infaqtotal, 0, ',', '.') }}</strong></td>
    <td></td>
    <td><strong>{{ 'Rp ' . number_format($total_jmlblnkemarin + $total_zakattotal + $total_infaqtotal, 0, ',', '.') }}</strong></td>
</tr>


                     
   
    </tbody>
 </table>