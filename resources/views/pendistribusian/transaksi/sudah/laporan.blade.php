@section('title',$title)
@extends('layout.app')
@section('content')
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop-breadcrumb">

                            <div class="breadcrumb-main">
                                <h4 class="text-capitalize breadcrumb-title">Data Transaksi SPJ Tasaruf </h4>
                                <div class="breadcrumb-action justify-content-center flex-wrap">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>Pendistribusian </a></li>
                                            <li class="breadcrumb-item" aria-current="page">Tasaruf</li>
                                            <li class="breadcrumb-item active" aria-current="page">Sudah</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
               <!-- Display success message -->
            <div class="container-fluid">

            
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('warning'))
        <div class="alert alert-warning">
            {{ session('warning') }}
        </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif


    <div class="row ">
                  


   


        

    <script>
function exportToExcel(tableId, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableId);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify filename
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}
</script>


        
                <div class="row">
                    <div class="col-lg-12">


                        <div class="userDatatable orderDatatable sellerDatatable global-shadow mb-30 py-30 px-sm-30 px-20 radius-xl w-100">
                            <div class="project-top-wrapper d-flex justify-content-between flex-wrap mb-25 mt-n10">
                                <div class="d-flex align-items-center flex-wrap justify-content-center">
                                    <div class="project-search order-search  global-shadow mt-10">
                                       
                                    </div>
                                </div>
                                <div class="content-center">
                                    <div class="button-group m-0 mt-sm-0 mt-10 order-button-group">
                                  <button onclick="exportToExcel('myTable', 'table_data')" type="button" class="btn btn-warning btn-xs btn-squared">Export</button>
</div>                                  

                                </div>
                            </div>
                            <div class="table-responsive">
                            <table id="myTable" class="table mb-0 table-borderless border-0">
    <thead>
        <tr role="row">
            <th width="5%">No</th>
            <th>Bulan</th>
            <th>Jumlah Realisasi</th>
            <th>Total</th>
        </tr>
    </thead>

    <tbody>
    @php
    $no = 1;
    $total_realisasi = 0; // Menyimpan total jumlah realisasi
    @endphp
    @for ($row = 1; $row <= 12; $row++)
        @php
        $pembagi = App\Models\Kas::whereMonth('tanggal', $row)
                    ->where('tahun', session('tahun_aktif'))
                    ->where('pengirim', 'P')
                    ->where('type', 'SPJ')
                    ->get(); // Jalankan query untuk mendapatkan data
        @endphp
        <tr>
            <td>{{ $no }}</td>
            <td>
                @php
                switch ($row) {
                    case 1: echo "Januari"; break;
                    case 2: echo "Februari"; break;
                    case 3: echo "Maret"; break;
                    case 4: echo "April"; break;
                    case 5: echo "Mei"; break;
                    case 6: echo "Juni"; break;
                    case 7: echo "Juli"; break;
                    case 8: echo "Agustus"; break;
                    case 9: echo "September"; break;
                    case 10: echo "Oktober"; break;
                    case 11: echo "November"; break;
                    case 12: echo "Desember"; break;
                }
                @endphp
            </td>
            <td>
                @php
                // Menghitung jumlah realisasi
                $jml = $pembagi->count();
                echo $jml;
                @endphp
            </td>
            <td>    
                @php
                // Menghitung jumlah realisasi
                $jumlah_realisasi = $pembagi->sum('jumlah');
                $total_realisasi += $jumlah_realisasi; // Menambahkan jumlah realisasi ke total
                @endphp
                {{ 'Rp ' . number_format($jumlah_realisasi, 0, ',', '.')}},- </td>
        </tr>
        @php
        $no++;
        @endphp
    @endfor
    <tr>
        <td colspan="3" align="right"><strong>Total</strong></td>
        <td>{{ 'Rp ' . number_format($total_realisasi, 0, ',', '.')}},-</td> <!-- Menampilkan total -->
    </tr>
    </tbody>
</table>


                            </div>

                           
                            
                        </div>
                    </div>
    </div>
</div>
@endsection



