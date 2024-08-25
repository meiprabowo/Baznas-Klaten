<table width="100%" border="1">
       <thead>
          <tr>
               <th scope="col">Tahun</th>
               <th scope="col">Status</th>
          </tr>
       </thead>
       <tbody>
         
      @foreach($data as $key => $d)
         <tr>
               <td>{{ $d->nama_tahun }}</td>
               <td>{{ $d->status == 'A' ? 'Aktif' : 'Non-Aktif' }}</td>           
         </tr>
      @endforeach
      
       </tbody>
    </table>
