<table width="100%" border="1">
       <thead>
          <tr>
          <th scope="col">ID</th>
          <th scope="col">Kode</th>
                                           <th scope="col">Uraian</th>
                                           <th scope="col">Level</th>
                                           <th scope="col">Sifat</th>
                                           <th scope="col">Kelompok</th>
                                           <th scope="col">Status</th>
          </tr>
       </thead>
       <tbody>
         
      @foreach($data as $key => $d)
         <tr>
         <td>{{ $d->id }}</td>
         <td>{{ $d->kode }}</td>
                                            <td>{{ $d->uraian }}</td>
                                            <td>{{ $d->level }}</td>
                                            <td>{{ $d->sifat == 'D' ? 'Debet' : 'Kredit' }}</td>
                                            <td>{{ $d->kelompok }}</td>
                                            <td>{{ $d->status == 'A' ? 'Aktif' : 'Non-Aktif' }}</td>
         </tr>
      @endforeach
      
       </tbody>
    </table>
