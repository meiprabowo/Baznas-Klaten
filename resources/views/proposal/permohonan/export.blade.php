@php
use Carbon\Carbon;
@endphp
<table>
    <thead>
       <tr>
       <th scope="col">Nomor Pemohon</th>
       <th scope="col">Nama </th>
       <th scope="col">NIK </th>
       <th scope="col">Tanggal Permohonan</th>
       <th scope="col">Jenis</th>
       <th scope="col">Telp</th>
       <th scope="col">Pekerjaan</th>
       <th scope="col">Tempat Lahir</th>
       <th scope="col">Tanggal Lahir</th>
       <th scope="col">Alamat</th>
       <th scope="col">Kecamatan</th>
       <th scope="col">Kelurahan</th>
       <th scope="col">RT</th>
       <th scope="col">RW</th> 
       <th scope="col">Program</th>
       <th scope="col">Sub Program</th>
       <th scope="col">Detail Program</th>
       <th scope="col">Nominal Pengajuan</th>
       <th scope="col">Keterangan</th>
       <th scope="col">Survey</th>
       <th scope="col">Tanggal Input Survey</th>
       <th scope="col">Petugas Survey</th>
       <th scope="col">Tanggal Penetapan</th>
       <th scope="col">Lokasi</th>
       <th scope="col">File Proposal</th>
       <th scope="col">Keterangan Akhir</th>
       <th scope="col">Status</th>
      </tr>
    </thead>
    <tbody>
      
    @foreach($data as $key => $d)
                                    <tr>
                                        <td>{{ $d->nomor_proposal }}</td>
                                        <td>{{ $d->nama_pemohon }}</td>
                                        <td>{{ $d->nik }}</td>
                                        <td>{{ date('d F Y', strtotime($d->tanggal_masuk)) }}</td>
                                        <td>{{ $d->jenis_permohonan }}</td>
                                        <td>{{ $d->hp }}</td>
                                        <td>{{ $d->pekerjaan }}</td>
                                        <td>{{ $d->tempat_lahir }}</td>
                                        <td>{{ date('d F Y', strtotime($d->tanggal_lahir)) }}</td>
                                        <td>{{ $d->alamat_lengkap }}</td>
                                        <td>{{ $d->kecamatan }}</td>
                                        <td>{{ $d->kelurahan }}</td>
                                        <td>{{ $d->rt }}</td>
                                        <td>{{ $d->rw }}</td>
                                        <td>{{  $d->uraianprogram }}</td>
                                        <td>{{  $d->uraiansubprogram }}</td>
                                        <td>{{  $d->detailprogram }}</td>
                                        <td>{{ 'Rp ' . number_format($d->nominal_pengajuan, 0, ',', '.')}}</td>
                                        <td>{{  $d->keterangan }}</td>
                                        <td>{{  $d->keterangan_survey }}</td>
                                        <td>{{ date('d F Y', strtotime($d->tanggal_input_survey)) }}</td>
                                        <td>{{  $d->petugas }}</td>
                                        <td>{{ date('d F Y', strtotime($d->tanggal_penetapan)) }}</td>
                                        <td>{{  $d->lokasi }}</td>
                                        <td>
                                            @if($d->proposal!='')
                                            {{ url('/proposal/'.$d->proposal) }}
                                            @endif
                                        </td>
                                        <td>{{  $d->keterangan_penolakan }}</td>

                                        <td><span style="color: 
    @switch($d->status)
        @case('B') orange @break
        @case('O') blue @break
        @case('A') green @break
        @case('N') red @break
        @default black
    @endswitch">
    {{ 
        $d->status == 'B' ? 'Belum diproses' : 
        ($d->status == 'O' ? 'Masih dalam proses' : 
        ($d->status == 'A' ? 'Diterima' : 'Ditolak')) 
    }}
</span>
</td>
                        
                                            <td>
       </tr>
       
       @endforeach
   
    </tbody>
 </table>