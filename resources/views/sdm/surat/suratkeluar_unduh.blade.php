@php
use Carbon\Carbon;
@endphp
<table width="100%" border="1">
       <thead>
          <tr>

          <th scope="col">No</th>
          <th scope="col">Nomor Surat</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Perihal</th>
                        <th scope="col">Tujuan</th>
          </tr>
       </thead>
       <tbody>
         <?php $no = 1; ?>
      @foreach($data as $key => $d)
      @php
                      $tanggal = Carbon::parse($d['tanggal'])->format('d F Y');
                      @endphp
         <tr>
         <td>{{ $no }}</td>
         <td>{{ $d->nomor_surat }}</td>
                        <td>{{ $tanggal }}</td>
                        <td>{{ $d->perihal }}</td>
                        <td>{{ $d->kepada }} </td>
         </tr>
         <?php $no++; ?>
      @endforeach
      
       </tbody>
    </table>
