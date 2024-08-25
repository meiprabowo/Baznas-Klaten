@php
use Carbon\Carbon;
@endphp
<table width="700px">
    <thead>
       <tr>
          <th scope="col">Nomor Transaksi</th>
          <th scope="col">Tanggal</th>
          <th scope="col">Keterangan</th>
          <th scope="col">Jumlah</th>
          <th scope="col">Kode Transaksi</th>
          <th scope="col">Tanggal</th>
          <th scope="col">Penerimaan</th>
      
       </tr>
    </thead>
    <tbody>
      
       @foreach($data as $key => $d)
       <?php 
       $tanggal = Carbon::parse($d['tanggal'])->format('d F Y');
       ?>
       <tr>
          <td>{{ $d->kode_kasbon }}</td>
          <td>{{ $tanggal }}</td>
          <td>{{ $d->keterangan }}</td>
          <td>{{ 'Rp ' . number_format($d->jumlah, 0, ',', '.')}}</td>
          <td>{{ $d->kode }}</td>
          <td><?php
            if(empty($d->jml)) {
             echo "-"; } else {
               $tgl = Carbon::parse($d['tgl'])->format('d F Y');
         echo $tgl ; }
          ?></td>
          <td>{{ 'Rp ' . number_format($d->jml, 0, ',', '.')}}</td>
         
         
         </tr>
       
       @endforeach
   
    </tbody>
 </table>