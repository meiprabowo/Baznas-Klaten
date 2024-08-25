<style>
    @page {
        margin-top: 10mm;
        margin-bottom: 10mm;
        margin-left: 5mm;
        margin-right: 5mm;
    }

   table {
       border-collapse: collapse;
       width: 100%;
       font-family: "Arial", sans-serif;
       font-size: 10px;

   }

   table, th, td {
       border: 1px solid #ddd;
   }

   th {
       background-color: #f2f2f2;
       color: #333;
   }

   th, td {
       padding: 8px;
       text-align: left;
   }

   tr:nth-child(even) {
       background-color: #f9f9f9;
   }

   tr:hover {
       background-color: #f5f5f5;
   }
</style>
<table>
    <thead>
       <tr>
        <th>ID</th>
        <th>Kode</th>
        <th>Keterangan</th>
        <th>Level</th>
        <th>Sifat</th>
        <th>Jumlah</th>
       </tr>
    </thead>
    <tbody>
      
       
        @foreach($data as $key => $d)
        @php
        $jml = DB::table('rencana')->where('id_akun',$d->id)->first();
        @endphp
   
    <tr>
        <td>{{ $d->id }}</td>
        <td>{{ $d->kode }}</td>
        <td>{{ $d->uraian }}</td>
        <td>{{ $d->level }}</td>
        <td>{{ $d->sifat }}</td>
        @if(Route::current()->getName() == 'master.rencana.export')
        <td>{{ $jml ? $jml->jumlah : '0' }}</td>
        @elseif(Route::current()->getName() == 'master.rencana.download')
        <td>{{ $d->jumlah ? 'Rp ' . number_format($d->jumlah, 0, ',', '.') : '0' }}</td>
        @endif
    </tr>
       
       @endforeach
   
    </tbody>
 </table>