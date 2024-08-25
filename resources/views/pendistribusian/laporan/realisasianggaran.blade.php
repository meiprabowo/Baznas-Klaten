@section('title',$title)
@extends('layout.app')
@section('content')
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop-breadcrumb">

                            <div class="breadcrumb-main">
                                <h4 class="text-capitalize breadcrumb-title">Data Akun Keuangan</h4>
                                <div class="breadcrumb-action justify-content-center flex-wrap">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>Akun Keuangan</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Data Akun Keuangan</li>
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
                                    <button type="button" onclick="exportToExcel()" class="btn btn-info btn-xs btn-squared">Export to Exel</button>
                           

                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table mb-0 table-borderless border-0" id="data-table">
                                    <thead>
                                        <tr class="userDatatable-header">
                                            <th scope="col">Kode</th>
                                            <th scope="col">Keterangan</th>
                                            <th scope="col">Rencana</th>
                                            <th scope="col">Realisasi s/d Bulan lalu	    </th>
                                            <th scope="col">Realisasi Bulan ini	</th>
                                            <th scope="col">Komulatif Realisasi</th>
                                            <th scope="col">Lebih / Kurang	</th>
                                            <th scope="col">Porsentase	</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $key => $d)
                                        <tr>
                                            <td>{{ $d->kode }}</td>
                                            <td>{{ $d->uraian }}</td>
                                            <td>{{ 'Rp ' . number_format($d->jumlah, 0, ',', '.') }}</td>
                                            <td>{{ 'Rp ' . number_format($d->saldobulankemarin, 0, ',', '.') }}</td>
                                            <td>{{ 'Rp ' . number_format($d->saldobulanini, 0, ',', '.') }}</td>
                                            <?php $komulatif = $d->saldobulankemarin + $d->saldobulanini; ?>
                                            <td>{{ 'Rp ' . number_format($komulatif, 0, ',', '.') }}</td>
                                            <?php $kurang = $komulatif - $d->jumlah ; ?>
                                            <td>{{ 'Rp ' . number_format($kurang, 0, ',', '.') }}</td>
                                            <?php 
                                                $persentasi = $d->jumlah != 0 ? round(($komulatif / $d->jumlah) * 100) : 0;
                                                $persentasiFormatted = number_format($persentasi, 0, ',', '.');
                                            ?>
                                            <td>{{ isset($persentasiFormatted) ? number_format($persentasiFormatted, 2) . '%' : '0%' }}</td>
                                                                            
                                            
                                        </tr>
                   
                   @endforeach
                                     



                                    </tbody>
                                </table>
                            </div>

                       
<script>
        function exportToExcel() {
            /* Fetch table element */
            var table = document.getElementById("data-table");
            /* Generate workbook */
            var wb = XLSX.utils.table_to_book(table);
            /* Generate Excel file */
            XLSX.writeFile(wb, "laporan-realisasi-anggaran.xlsx");
        }
    </script>
                        </div>
                    </div>
    </div>
</div>
@endsection



