@section('title',$title)
@extends('layout.app')
@section('content')

<div class="blog-page">
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop-breadcrumb">

                            <div class="breadcrumb-main">
                                <h4 class="text-capitalize breadcrumb-title">Beranda  </h4>
                                <div class="breadcrumb-action justify-content-center flex-wrap">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>Beranda </a></li>
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

            

        
                <div class="row">
                <div class="col-lg-5" style="border: 5px solid white; border-radius: 10px; padding-left: 0px;">
              
                <iframe width="101.6%" height="100%" src="https://www.youtube.com/embed/8rK-hZydwrs?autoplay=1" title="PROFIL BAZNAS KABUPATEN KLATEN #GerakanCintaZakat #BAZNAS" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

    
                    </div>
                    <div class="col-lg-7">
                       
                  
                        
                            <div class="userDatatable orderDatatable sellerDatatable global-shadow mb-30 py-30 px-sm-30 px-20 radius-xl w-100 ">
                            <h6> LAPORAN REALISASI PENDISTRIBUSIAN </h6> <br/>        <div class="table-responsive">
                            <table class="table mb-0 table-borderless border-0">
    <thead>
        <tr class="userDatatable-header">
            <th scope="col">No.</th>
            <th scope="col">Program</th>
            <th scope="col">Nilai</th>
            <th scope="col">Penerima Manfaat (Mustahik)</th>
        </tr>
    </thead>
    <tbody>
    <tr>
        <td>1.</td>
        <td>Klaten Cerdas</td>
        <td> {{ 'Rp ' . number_format($saldocerdas, 0, ',', '.')}}</td>
        <td> {{ number_format($jmlcerdas, 0, ',', '.')}} </td>
    </tr>
    <tr>
        <td>2.</td>
        <td>Klaten Peduli</td>
        <td> {{ 'Rp ' . number_format($saldopeduli, 0, ',', '.')}}</td>
        <td> {{ number_format($jmlpeduli, 0, ',', '.')}} </td>
    </tr>
    <tr>
        <td>3.</td>
        <td>Klaten Makmur</td>
        <td> {{ 'Rp ' . number_format($saldomakmur, 0, ',', '.')}}</td>
        <td> {{ number_format($jmlmakmur, 0, ',', '.')}} </td>
    </tr>
    <tr>
        <td>4.</td>
        <td>Klaten Taqwa</td>
        <td> {{ 'Rp ' . number_format($saldotaqwa, 0, ',', '.')}}</td>
        <td> {{ number_format($jmltaqwa, 0, ',', '.')}} </td>
    </tr>
    <tr>
        <td>5.</td>
        <td>Klaten Sehat</td>
        <td> {{ 'Rp ' . number_format($saldosehat, 0, ',', '.')}}</td>
        <td> {{ number_format($jmlsehat, 0, ',', '.')}} </td>
    </tr>
  
    <tr>
       
        <td colspan="2"><center>Total Data</center></td>
        <?php
            $totalkeseluruhan = $saldocerdas + $saldomakmur + $saldopeduli + $saldosehat + $saldotaqwa; 
            $totaljml = $jmlcerdas + $jmlmakmur + $jmlpeduli + $jmlsehat + $jmltaqwa; 
        ?>
        <td> {{ 'Rp ' . number_format($totalkeseluruhan, 0, ',', '.')}}</td>
        <td> {{ number_format($totaljml, 0, ',', '.')}} </td>
    </tr>
  
    

</tbody>
</table>
</div>
</div>
<br/>


                        
                  
                </div>
    </div>
    </div>
@endsection



