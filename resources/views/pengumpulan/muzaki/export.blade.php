<table width="100%" border="1">
       <thead>
          <tr>

          <th scope="col">No</th>
          <th scope="col">NPWZ</th>
                                           <th scope="col">Nama</th>
                                           <th scope="col">HP</th>
                                           <th scope="col">Email</th>
                                           <th scope="col">Telp</th>
                                           <th scope="col">Jenis Kelamin</th>
                                           <th scope="col">Alamat</th>
                                           <th scope="col">Dinas</th>
                                           <th scope="col">Tanggal Register</th>
                                           <th scope="col">NPWP</th>
                                           <th scope="col">NIK</th>
                                           <th scope="col">Keterangan</th>
          </tr>
       </thead>
       <tbody>
         <?php $no = 1; ?>
      @foreach($data as $key => $d)
   
         <tr>
         <td>{{ $no }}</td>
         <td>{{ $d->npwz }}</td>
                     <td>{{ $d->nama_muzaki }}</td>
                     <td>{{ $d->hp }}</td>
                     <td>{{ $d->email }}</td>
                     <td>{{ $d->telp }}</td>
                     <td>{{ $d->jenis_kelamin }}</td>
                     <td>{{ $d->alamat }}</td>
                     <td>{{ $d->nama_muzaki }}</td>
                     <td>{{ date('d F Y', strtotime($d->tgl_register)) }}</td>
                     <td>{{ $d->npwp }}</td>
                     <td>{{ $d->nik }}</td>
                     <td>{{ $d->keterangan }}</td>
         </tr>
         <?php $no++; ?>
      @endforeach
      
       </tbody>
    </table>
