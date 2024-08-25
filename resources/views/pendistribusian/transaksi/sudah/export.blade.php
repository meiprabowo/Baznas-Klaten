<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
            text-align: center; /* Pusatkan teks pada header */
        }

        td {
            text-align: center; /* Pusatkan teks pada sel selain header */
        }
    </style>
</head>
<body>
    <table border="1">
        <thead>
            <tr>
                <td rowspan="2"> No </td>
                <td colspan="19" align="center"> Data Pemohon </td>
                <td colspan="6" align="center"><center> Proses Proposal </center> </td>
                <td rowspan="2"  align="center">Status</td>
                <td colspan="9" align="center">Hasil Akhir Tasaruf</td>
            </tr>
            <tr>
                <th scope="col"  align="center">Nomor Pemohon</th>
                <th scope="col"  align="center">Nama</th>
                <th scope="col"  align="center">NIK</th>
                <th scope="col"  align="center">Tanggal Permohonan</th>
                <th scope="col"  align="center">Jenis</th>
                <th scope="col"  align="center">Telp</th>
                <th scope="col"  align="center">Pekerjaan</th>
                <th scope="col"  align="center">Tempat Lahir</th>
                <th scope="col"  align="center">Tanggal Lahir</th>
                <th scope="col"  align="center">Alamat</th>
                <th scope="col"  align="center">Kecamatan</th>
                <th scope="col"  align="center">Kelurahan</th>
                <th scope="col"  align="center">RT</th>
                <th scope="col"  align="center">RW</th>
                <th scope="col"  align="center">Program</th>
                <th scope="col"  align="center">Sub Program</th>
                <th scope="col"  align="center">Detail Program</th>
                <th scope="col"  align="center">Nominal Pengajuan</th>
                <th scope="col"  align="center">Keterangan</th>
                <th scope="col"  align="center">Survey</th>
                <th scope="col"  align="center">Tanggal Input Survey</th>
                <th scope="col"  align="center">Petugas Survey</th>
                <th scope="col"  align="center">Tanggal Penetapan</th>
                <th scope="col"  align="center">Lokasi</th>
                <th scope="col"  align="center">keterangan</th>
                <th scope="col"  align="center">Tanggal Tasaruf</th>
                <th scope="col"  align="center">Nomor SPJ Tasaruf</th>
                <th scope="col"  align="center">Jenis Tasaruf</th>
                <th scope="col"  align="center">Sumber Dana</th>
                <th scope="col"  align="center">Nominal</th>
                <th scope="col"  align="center">Program</th>
                <th scope="col"  align="center">Sub Program</th>
                <th scope="col"  align="center">Detail Program</th>
                <th scope="col"  align="center">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            @foreach($data as $key => $d)

           
            <tr>
                <td>{{ $no }}</td>
                <td>{{ $d->nomor_proposal }}</td>
                <td>{{ $d->nama_pemohon }}</td>
                <td>'{{ $d->nik }}</td>
                <td>{{ date('d F Y', strtotime($d->tanggal_masuk)) }}</td>
                <td>{{ $d->jenis_permohonan }}</td>
                <td>'{{ $d->hp }}</td>
                <td>{{ $d->pekerjaan }}</td>
                <td>{{ $d->tempat_lahir }}</td>
                <td>{{ date('d F Y', strtotime($d->tanggal_lahir)) }}</td>
                <td>{{ $d->alamat_lengkap }}</td>
                <td>{{ $d->nama_kecamatan }}</td>
                <td>{{ $d->nama_kelurahan }}</td>
                <td>{{ $d->rt }}</td>
                <td>{{ $d->rw }}</td>
                <td>{{ $d->uraianprogram }}</td>
                <td>{{ $d->uraiansubprogram }}</td>
                <td>{{ $d->detailprogram }}</td>
                <td>{{ 'Rp ' . number_format($d->nominal_pengajuan, 0, ',', '.') }}</td>
                <td>{{ $d->proposal_keterangan }}</td>
                <td>{{ $d->keterangan_survey }}</td>
                <td>{{ date('d F Y', strtotime($d->tanggal_input_survey)) }}</td>
                <td>{{ $d->petugas }}</td>
                <td>{{ date('d F Y', strtotime($d->tanggal_penetapan)) }}</td>
                <td>{{ $d->lokasi }}</td>
                <td>{{ $d->keterangan_penolakan }}</td>
              
                <td>
                    <span style="color: 
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
                <td>{{ date('d F Y', strtotime($d->tanggal)) }}</td>

                <td>{{ $d->kode_transaksi }}</td>
                <td>{{ $d->jenis_kas }}</td>
                <td>{{ $d->kreditp }}</td>
                <td>{{ 'Rp ' . number_format($d->jumlah, 0, ',', '.') }}</td>
                <td>{{ $d->pros }}</td>
                <td>{{ $d->pross }}</td>
                <td>{{ $d->detailp }}</td>
                <td>{{ $d->kas_keterangan }}</td>

                
            </tr>
            <?php $no++; ?>
            @endforeach
        </tbody>
    </table>
</body>
</html>
