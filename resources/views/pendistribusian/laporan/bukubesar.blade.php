@section('title',$title)
@extends('layout.app')
@section('content')

<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop-breadcrumb">

                            <div class="breadcrumb-main">
                                <h4 class="text-capitalize breadcrumb-title">Laporan Buku Besar </h4>
                                <div class="breadcrumb-action justify-content-center flex-wrap">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>Keuangan </a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Laporan Keuangan</li>
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
                            <table class="table mb-0 table-borderless border-0"  id="data-table">
    <thead>
        <tr class="userDatatable-header">
            <th scope="col">No</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Uraian</th>
            <th scope="col">Debet</th>
            <th scope="col">Kredit</th>
            <th scope="col">Saldo</th>
        </tr>
    </thead>
    <tbody>
        @php
            use Carbon\Carbon;
            $saldo = 0; // Inisialisasi saldo awal
        @endphp
       <?php if (!empty($awal)) { ?>
    <tr>
        <td></td>
        <td>{{ Carbon::parse($awal->tanggal)->format('d F Y') }}</td>
        <td>Saldo</td>
        <td>
        <?php
$jml = $awal->jumlah;
$jmlsd = 0; // Inisialisasi $jmlsd di luar dari blok kondisional

if ($awal->debet == '0') {
    $jmlsd = -$jml;
    echo '-';
} else {
    echo 'Rp ' . number_format($jml, 0, ',', '.');
}

?>

</td>
<td>

<?php
if ($awal->kredit == '0') {
    $jmlsd = $jml;
    echo '-';
} else {
    echo 'Rp ' . number_format($jml, 0, ',', '.');
}

?>

</td>
<td>

<?php
// Hitung saldo
$saldo += $jmlsd;
echo 'Rp ' . number_format($saldo, 0, ',', '.');
?>

</td>
</tr>
<?php } ?>



        <?php $no=1; ?>
        @foreach($data as $key => $d)
            <tr>
                <td>{{ $no }}</td>
                <td>{{ Carbon::parse($d->tanggal)->format('d F Y') }}</td>
                <td>{{ $d->keterangan }}</td>
                <td>{{ 'Rp ' . number_format($d->ketdebet, 0, ',', '.')}}</td>
                <td>{{ 'Rp ' . number_format($d->ketkredit, 0, ',', '.')}}</td>
                <td>
                    @php
                        // Hitung saldo

                        
                        $saldo += $d->ketdebet - $d->ketkredit;
                      

                    @endphp
                    {{ 'Rp ' . number_format($saldo, 0, ',', '.')}}
                </td>
            </tr>
            <?php $no++; ?>
        @endforeach
    </tbody>
</table>


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
                    </div>
    </div>
</div>
@endsection



