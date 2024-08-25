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
        <th scope="col">Nama</th>
        <th scope="col">Email</th>
        <th scope="col">Bagian</th>
        <th scope="col">Telp</th>
       </tr>
    </thead>
    <tbody>
      
       @foreach($data as $key => $d)
       <tr>
        <td>{{ $d->name }}</td>
        <td>{{ $d->email }}</td>
        <td>{{ $d->role }}</td>
        <td>{{ $d->telp }}</td>
        
       </tr>
       
       @endforeach
   
    </tbody>
 </table>