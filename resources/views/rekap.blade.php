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
                                <h4 class="text-capitalize breadcrumb-title">Executive Summary ( Laporan Sampai Tanggal <span style="color: red;"> {{ \Carbon\Carbon::now()->formatLocalized('%d %B %Y')  }} </span> )</h4>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
               <!-- Display success message -->
            <div class="container-fluid">

        
        
            <div id="data-table">
                <div class="row">
                   
      
                
                
                <div class="col-lg-6">

                        <div class="userDatatable orderDatatable sellerDatatable global-shadow mb-30 py-30 px-sm-30 px-20 radius-xl w-100 ">
                            
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
    <?php 
    $totalSaldo = 0;
    $pengurang = 0; // Inisialisasi variabel $pengurang
?>
@foreach($data as $key => $d)
    <tr>
        <td>{{ $d->kode }}</td>
        <td>{{ $d->uraian }}</td>
        <td>
        <?php 
            $saldo = $d->ketdebet - $d->ketkredit; 
            $totalSaldo += $saldo; // Menambahkan saldo saat ini ke total saldo
            if ($d->kode == '1.2.01' || $d->kode == '1.2.02') { 
                $pengurang += $saldo; // Menambahkan saldo saat ini ke variabel $pengurang
            }
        ?>    
            {{ 'Rp ' . number_format($saldo, 0, ',', '.')}}
        </td>
    </tr>
@endforeach
<tr>
    <td colspan="2" align="right"><b>Jumlah</b></td>
    <td><b>{{ 'Rp ' . number_format($totalSaldo, 0, ',', '.')}}</b></td> <!-- Mencetak total saldo -->
</tr>

</tbody>
</table>

                            </div>

                          
                        </div>
                    </div>



                    <div class="col-lg-6">

                        <div class="userDatatable orderDatatable sellerDatatable global-shadow mb-30 py-30 px-sm-30 px-20 radius-xl w-100 ">
                            
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
     
    @php
    $totalok = 0;
    $bersih = 0;
@endphp

@foreach($dataku as $key => $d)
    <tr>
        <td>{{ $d->kode }} </td>
        <td>{{ $d->uraian }}</td>
        <td>
            @php
                $pemasukan = $d->pemb - $d->pemba;
                $pengeluaran = $d->pemaa - $d->pemba;
                
                $saldo = $d->saldo;
                $total = ($saldo + $pemasukan) - $pengeluaran;
                if ($d->kode == '3.3') { 
                $bersih += $total; // Menambahkan saldo saat ini ke variabel $pengurang
                 }
               
                    $totalok += $total;
              
            @endphp
            <?php if ($d->kode == '3.3') {  ?>
            <font color="white">Rp {{ number_format($total, 0, ',', '.') }} </font>
            <?php } else { ?>
            Rp {{ number_format($total, 0, ',', '.') }}
            <?php } ?>
        </td>
    </tr>
 



<?php if ($d->kode == '3.3') {  ?>
    <tr>
        <td> </td>
        <td>Asset Bersih Amil</td>
        <td>{{ 'Rp ' . number_format($pengurang, 0, ',', '.')}}
            

        </td>
         
    </tr>
    
    <tr>
        <td> </td>
        <?php $danabersih = $bersih - $pengurang ; ?>
        <td>Kas Tunai Bersih Amil</td>
        <td>{{ 'Rp ' . number_format($danabersih, 0, ',', '.')}}
         
    </tr>
<?php } ?>
@endforeach

<tr>
    <td colspan="2" align="right"><b>Jumlah</b></td>
    <td><b>Rp {{ number_format($totalok, 0, ',', '.') }}</b></td>
</tr>

    </tbody>
</table>

                            </div>

                          
                        </div>
                    </div>



                    <div class="col-lg-6">

<div class="userDatatable orderDatatable sellerDatatable global-shadow mb-30 py-30 px-sm-30 px-20 radius-xl w-100 ">
    
    <div class="table-responsive">
    <table class="table mb-0 table-borderless border-0">
<thead>
<tr class="userDatatable-header">
<th scope="col" width="10%">No.</th>
<th scope="col">Keterangan</th>
<th scope="col">Jumlah</th>
</tr>
</thead>
<tbody>

<tr>
    <td>1.</td>
    <td>Total Pengumpulan</td>
    <td>{{ 'Rp ' . number_format($pengumpulan, 0, ',', '.')}}</td>
</tr>

<tr>
    <td>2.</td>
    <td>Total Transaksi</td>
    <td>{{ '' . number_format($jmlpengumpulan, 0, ',', '.')}}</td>
</tr>


<tr>
    <td colspan="3"><center>Lihat Detail Pengumpulan <b><a href="{{ route('rekappengumpulan') }}" target="_blank">Klik di sini</a></b></center></td>
</tr>


</tbody>
</table>

    </div>

  
</div>
</div>

<div class="col-lg-6">

<div class="userDatatable orderDatatable sellerDatatable global-shadow mb-30 py-30 px-sm-30 px-20 radius-xl w-100 ">
    
    <div class="table-responsive">
    <table class="table mb-0 table-borderless border-0">
<thead>
<tr class="userDatatable-header">
<th scope="col" width="10%">No.</th>
<th scope="col">Keterangan</th>
<th scope="col">Jumlah</th>
</tr>
</thead>
<tbody>

    <tr>
        <td>1.</td>
        <td>Total Pendistribusian</td>
        <td>{{ 'Rp ' . number_format($distribusi, 0, ',', '.')}}</td>
    </tr>


    <tr>
        <td>2.</td>
        <td>Penerima Manfaat</td>
        <td>{{ '' . number_format($jmldistribusi, 0, ',', '.')}}</td>
    </tr>

    <tr>
    <td colspan="3"><center>Lihat Detail Pendistribusian <b><a href="{{ route('rekappendistribusian') }}" target="_blank">Klik di sini</a></b></center></td>
</tr>

</tbody>
</table>

    </div>

  
</div>
</div>


                
                                 
                                <br/><br/><br/>

    </div>
</div>
@endsection



