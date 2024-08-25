@section('title',$title)
@extends('layout.app')
@section('content')
<?php
   if($_GET['jenis'] == 1)
{
    $jenis = "ZAKAT";
} else if($_GET['jenis'] == 2) {
    $jenis = "INFAK DAN SEDEKAH";
} else if($_GET['jenis'] == 3) {
    $jenis = "AMIL";
} else if($_GET['jenis'] == 5) {
    $jenis = "APBN/APBD";
} else if($_GET['jenis'] == 6) {
    $jenis = "JASA GIRO";

}
?>

<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop-breadcrumb">

                            <div class="breadcrumb-main">
                                <h4 class="text-capitalize breadcrumb-title">Laporan Perubahan Dana
                                    
                                </h4>
                                <div class="breadcrumb-action justify-content-center flex-wrap">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>Keuangan </a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Laporan Perubahan Dana</li>
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
            <th scope="col">No</th>
            <th scope="col">Kode</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Realisasi s/d Bulain ini</th>
   
        </tr>
    </thead>
    <tbody>
    <tr>    
    <td colspan="3"><b> SALDO AWAL <?php echo"$jenis"; ?></b></td>    
    <?php $totalSaldoAwal = 0; ?> <!-- Menambahkan variabel totalSaldoAwal -->
    @foreach($dataawal as $key => $d) 
        <td>{{ 'Rp ' . number_format($d->saldo, 0, ',', '.')}}</td>
        <?php $totalSaldoAwal += $d->saldo; ?> <!-- Menambahkan saldo awal ke totalSaldoAwal -->
    @endforeach   
</tr>

<?php $no=1; $totalSaldo = 0; ?> <!-- Menambahkan variabel totalSaldo -->
@foreach($data as $key => $d)
    <tr>
        <td>{{ $no }}</td>
        <td>{{ $d->kode }}</td>
        <td>{{ $d->uraian }}</td>
        <td>{{ 'Rp ' . number_format($d->saldo, 0, ',', '.') }}</td>
        <?php $totalSaldo += $d->saldo; ?> <!-- Menambahkan saldo ke totalSaldo -->
    </tr>
    <?php $no++; ?>
@endforeach

<tr>    
    <td colspan="3"><b> JUMLAH PENGUMPULAN DANA  <?php echo"$jenis"; ?> </b></td>    
    <?php $totalPengumpulan = 0; ?> <!-- Menambahkan variabel totalPengumpulan -->
    @foreach($datasaldo as $key => $d) 
        <td>{{ 'Rp ' . number_format($d->saldo, 0, ',', '.')}}</td>
        <?php $totalPengumpulan += $d->saldo; ?> <!-- Menambahkan saldo pengumpulan ke totalPengumpulan -->
    @endforeach   
</tr>

<?php $no=1; $totalPenyaluran = 0; ?> <!-- Menambahkan variabel totalPenyaluran -->
@foreach($dataku as $key => $d)
    <tr>
        <td>{{ $no }}</td>
        <td>{{ $d->kode }}</td>
        <td>{{ $d->uraian }}</td>
        <td>{{ 'Rp ' . number_format($d->saldo, 0, ',', '.')}}</td>
        @if($d->level == 5) <!-- Memeriksa apakah level adalah 5 -->
        <?php $totalPenyaluran += $d->saldo; ?> <!-- Menambahkan saldo penyaluran ke totalPenyaluran -->
        @endif
    </tr>
    <?php $no++; ?>
@endforeach

<tr>    
    <td colspan="3"><b> TOTAL PENYALURAN  <?php echo"$jenis"; ?> </b></td>    
    <td>{{ 'Rp ' . number_format($totalPenyaluran, 0, ',', '.')}}</td> <!-- Menampilkan total saldo -->
</tr>


<tr>    
    <td colspan="3"><b> TOTAL PENGUMPULAN + SALDO AWAL  </b></td>    
    <td>{{ 'Rp ' . number_format(($totalSaldoAwal + $totalPengumpulan), 0, ',', '.')}}</td> <!-- Menampilkan total saldo -->
</tr>

<tr>    
    <td colspan="3"><b> TOTAL SALDO <?php echo"$jenis"; ?> </b></td>    
    <td>{{ 'Rp ' . number_format(($totalSaldoAwal + $totalPengumpulan - $totalPenyaluran), 0, ',', '.')}}</td> <!-- Menampilkan total saldo -->
</tr>


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
            XLSX.writeFile(wb, "laporan-perubahan-dana.xlsx");
        }
    </script>
                          
                        </div>
                    </div>
    </div>
</div>
@endsection



