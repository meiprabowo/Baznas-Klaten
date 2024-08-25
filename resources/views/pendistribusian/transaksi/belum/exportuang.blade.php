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
       <th scope="col">Alamat</th>
       <th scope="col">Program</th>
       <th scope="col">Sub Program</th>
       <th scope="col">Detail Program</th>
       <th scope="col">Uraian Diterima</th>
       <th scope="col">Nominal Pengajuan</th>
       <th scope="col">Tanggal Penetapan</th>
       <th scope="col">Tujuan</th>
       <th scope="col">Nominal</th>
       <th scope="col">Sumber</th>
       <th scope="col">Tanggal</th>
       <th scope="col">Keterangan</th>
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
                                        <td>{{ $d->alamat_lengkap }}</td>
                                        <td>{{  $d->uraianprogram }}</td>
                                        <td>{{  $d->uraiansubprogram }}</td>
                                        <td>{{  $d->detailprogram }}</td>
                                        <td>{{  $d->keterangan_penolakan }}</td>
                                        <td>{{ 'Rp ' . number_format($d->nominal_pengajuan, 0, ',', '.')}}</td>
                                        <td>{{ date('d F Y', strtotime($d->tanggal_penetapan)) }}</td>
                                        <td>{{  $d->detail_program }}</td>
                                        <td> </td>
                                        <td> </td>
                                        <td> </td>
                                                  </tr>
       
       @endforeach
   
    </tbody>
 </table>