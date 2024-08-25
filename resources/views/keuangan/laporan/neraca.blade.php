@section('title',$title)
@extends('layout.app')
@section('content')
@php
            use Carbon\Carbon;
         @endphp
        <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop-breadcrumb">

                            <div class="breadcrumb-main">
                                <h4 class="text-capitalize breadcrumb-title">Laporan Neraca </h4>
                                <div class="breadcrumb-action justify-content-center flex-wrap">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>Keuangan </a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Laporan Neraca</li>
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

            <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.4/xlsx.full.min.js"></script>
        
            <div id="data-table">
                <div class="row">
                   
                
                
                
                <div class="col-lg-6">
                        <div class="userDatatable orderDatatable sellerDatatable global-shadow mb-30 py-30 px-sm-30 px-20 radius-xl w-100">
                            
                            <div class="table-responsive">
                            <table class="table mb-0 table-borderless border-0">
    <thead>
        <tr class="userDatatable-header">
            <th scope="col">Kode</th>
            <th scope="col">Uraian</th>
            <th scope="col">Jumlah</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $key => $d)
            <tr>
                <td>{{ $d->kode }}</td>
                <td>{{ $d->uraian }}</td>
                <td>
                <?php $saldo = $d->ketdebet - $d->ketkredit; ?>    
          
                {{ 'Rp ' . number_format($saldo, 0, ',', '.')}}
              
            </td>
            </tr>
        @endforeach
    </tbody>
</table>

                            </div>

                          
                        </div>
                    </div>




                <div class="col-lg-6">
                    
                        <div class="userDatatable orderDatatable sellerDatatable global-shadow mb-30 py-30 px-sm-30 px-20 radius-xl w-100">
                           
                            <div class="table-responsive">
                            <table class="table mb-0 table-borderless border-0">
    <thead>
        <tr class="userDatatable-header">
            <th scope="col">Kode</th>
            <th scope="col">Uraian</th>
            <th scope="col">Jumlah</th>
        </tr>
    </thead>
    <tbody>
<?php    $totalok = 0;  ?>
        @foreach($dataku as $key => $d)
            <tr>
            <td>{{ $d->kode }}</td>
                <td>{{ $d->uraian }}      </td>
                <td>
                    @php
                        $pemasukan = $d->pemb - $d->pemba  ;
                        $pengeluaran = $d->pemaa - $d->pemba;
                        
                        $saldo = $d->saldo;
                        $total = ($saldo + $pemasukan) - $pengeluaran;
                    @endphp
                     @if($d->level == 2) 
        <?php $totalok += $total; ?> <!-- Menambahkan saldo penyaluran ke totalPenyaluran -->
        @endif
   
                    {{ 'Rp ' . number_format($total, 0, ',', '.')}}


                </td>
            </tr>
        @endforeach
        
    </tbody>
</table>

                            </div>

                          
                        </div>
                        

                     




                    </div>


                    <div class="col-lg-6">
                     <div class="row">
                        <div class="col-12">
                           <div class="card card-default card-md mb-4">
                              <div class="card-header">
                                @foreach($dataaktifa as $key => $d)

                                 @php
                       $saldo = $d->ketdebet - $d->ketkredit;
                    @endphp
          <b>  Total Saldo :        {{ 'Rp ' . number_format($saldo, 0, ',', '.')}}</b>
        @endforeach
                               
                                 </div>
                                 </div>
                                 </div>
                                 </div>
                                 </div>
                                 <div class="col-lg-6">
                     <div class="row">
                        <div class="col-12">
                           <div class="card card-default card-md mb-4">
                              <div class="card-header">
                         

<b>Total saldo: {{ 'Rp ' . number_format($totalok, 0, ',', '.') }}   </b>


                                 </div>
                                 </div>
                                 </div>
                                 </div>
                                 </div></div>
                                 <div class="content-center">
                                    <div class="button-group m-0 mt-sm-0 mt-10 order-button-group">

                                    <button type="button" onclick="exportToExcel()" class="btn btn-info btn-xs btn-squared">Export to Exel</button>

                                    <script>
        function exportToExcel() {
            /* Fetch table element */
            var table = document.getElementById("data-table");
            /* Generate workbook */
            var wb = XLSX.utils.table_to_book(table);
            /* Generate Excel file */
            XLSX.writeFile(wb, "buku_besar.xlsx");
        }
    </script>
</div>
                                </div>
                                <br/><br/><br/>

    </div>
</div>
@endsection



