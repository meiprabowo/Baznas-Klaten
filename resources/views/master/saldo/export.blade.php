<table width="100%" border="1">
       <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Kode</th>
            <th scope="col">Keterangan</th>
             <th scope="col">Level</th>
             <th scope="col">Sifat</th>
             <th scope="col">Jumlah</th>
          </tr>
       </thead>
       <tbody>
         
          @foreach($data as $key => $d)
        
          
          <tr>
            <td>{{ $d->id }}</td>
            <td>{{ $d->kode }}</td>
            <td>{{ $d->uraian }}</td>
             <td>{{ $d->level }}</td>
             <td>{{ $d->sifat }}</td>
             <td>{{ $d ? $d->jumlah : '0' }}</td>
          
            
          </tr>
          
          @endforeach
      
       </tbody>
    </table>