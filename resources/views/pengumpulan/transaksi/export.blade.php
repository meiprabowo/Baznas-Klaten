@php
use Carbon\Carbon;
@endphp
<table>
    <thead>
       <tr>
       <th scope="col">Nomor Transaksi</th>
       <th scope="col">Nama</th>
       <th scope="col">Dinas</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Kredit</th>
                        <th scope="col">Debet</th>
                        <th scope="col">Jumlah</th>
      </tr>
    </thead>
    <tbody>
      
    @foreach($data as $key => $d)  <?php 
                                          $tanggal = Carbon::parse($d['tanggal'])->format('d F Y');

                     ?>
                                    <tr>
                                    <td>{{ $d->kode_transaksi }}</td>
                                    <td>{{ $d->nama_muzaki }}</td>
                                    <td>{{ $d->dinas }}</td>
                        <td>{{ $tanggal }}</td>
                        <td>{{ $d->kredituraian }}</td>
                        <td>{{ $d->uraian }}</td>
                        <td>{{ 'Rp ' . number_format($d->jumlah, 0, ',', '.')}}</td>
       </tr>
       
       @endforeach
   
    </tbody>
 </table>