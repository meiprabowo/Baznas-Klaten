@php
use Carbon\Carbon;
@endphp
<table>
    <thead>
       <tr>
          <th scope="col">Nomor Transaksi</th>
          <th scope="col">Tanggal</th>
          <th scope="col">Keterangan</th>
          <th scope="col">Sumber</th>
          <th scope="col">Jumlah</th>
          <th scope="col">qty</th>
          <th scope="col">sisa</th>
       </tr>
    </thead>
    <tbody>
      
       @foreach($data as $key => $d)
       @php
       $tanggal = Carbon::parse($d['tanggal'])->format('d F Y');
       @endphp
       <tr>
          <td>{{ $d->kode_transaksi }}</td>
          <td>{{ $tanggal }}</td>
          <td>{{ $d->keterangan }}</td>
          <td>{{ $d->uraian }}</td>
          <td>{{ 'Rp ' . number_format($d->jumlah, 0, ',', '.')}}</td>
          <td>{{ $d->qty }}</td>
          <td>{{ $d->qty }}</td>
    
       </tr>
       
       @endforeach
   
    </tbody>
 </table>