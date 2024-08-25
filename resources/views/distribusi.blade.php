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
                                <h4 class="text-capitalize breadcrumb-title">Rekap Pendistribusian </h4>
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
            <th scope="col">No</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Jumlah</th>
        </tr>
    </thead>
    <tbody>
    <?php $no=1; ?>
    @foreach($program as $key => $d)
        <tr>
            <td><?php echo $no; ?></td>
            <td>{{ $d->uraian }}</td>
            <td>  {{ 'Rp ' . number_format($d->saldo, 0, ',', '.')}}</td>
        </tr>
    <?php $no++; ?>
    @endforeach
    </tbody>
</table>

                            </div>

                          
                        </div>
                    </div>



                  


                
                                 
                                <br/><br/><br/>

    </div>
</div>
@endsection



