@php
use Carbon\Carbon;
@endphp
<table>
    <thead>
       <tr>
       <th scope="col">id</th>
       <th scope="col">Nomor Pemohon</th>
       <th scope="col">Nama </th>
       <th scope="col">NIK </th>
       <th scope="col">Tanggal Permohonan</th>
       <th scope="col">Telp</th>
       <th scope="col">Pekerjaan</th>
       <th scope="col">Alamat</th>
       <th scope="col">Program</th>
       <th scope="col">Sub Program</th>
       <th scope="col">Detail Program</th>
       <th scope="col">Nominal Pengajuan</th>
       <th scope="col">Keterangan Pengajuan</th>
       <th scope="col">Petugas Survey</th>
       <th scope="col">tanggal</th>
       <th scope="col">status</th>
       <th scope="col">lokasi</th>
       <th scope="col">keterangan</th>
       </tr>
    </thead>
    <tbody>
      
    @foreach($data as $key => $d)
                                    <tr>
                                        <td>{{ $d->id }}</td>
                                        <td>{{ $d->nomor_proposal }}</td>
                                        <td>{{ $d->nama_pemohon }}</td>
                                        <td>{{ $d->nik }}</td>
                                        <td>{{ date('d F Y', strtotime($d->tanggal_masuk)) }}</td>
                                        <td>{{ $d->hp }}</td>
                                        <td>{{ $d->pekerjaan }}</td>
                                        <td>{{ $d->alamat_lengkap }}</td>
                                        <td>{{  $d->uraianprogram }}</td>
                                        <td>{{  $d->uraiansubprogram }}</td>
                                        <td>{{  $d->detailprogram }}</td>
                                        <td>{{ 'Rp ' . number_format($d->nominal_pengajuan, 0, ',', '.')}}</td>
                                        <td>{{  $d->keterangan }}</td>
                                        <td>{{  $d->petugass }}</td>
                                       <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
       </tr>
       
       @endforeach
   
    </tbody>
 </table>