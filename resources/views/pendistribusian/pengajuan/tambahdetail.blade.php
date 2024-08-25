@section('title',$title)
@extends('layout.app')
@section('content')
<?php
use Carbon\Carbon;
$date = Carbon::now()->format('Y-m-d');
?>
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop-breadcrumb">

                            <div class="breadcrumb-main">
                                <h4 class="text-capitalize breadcrumb-title">Data Proposal</h4>
                                <div class="breadcrumb-action justify-content-center flex-wrap">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>Proposal</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Data Proposal</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
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
                  


   


        



<script type="text/javascript">
    function checkAll(source) {
        checkboxes = document.getElementsByName('selectedItems[]');
        for(var i=0, n=checkboxes.length;i<n;i++) {
            checkboxes[i].checked = source.checked;
        }
    }
</script>
        
                  <div class="row">
                      <div class="col-lg-12">
                      <form action="{{ route('pendistribusian.tasaruf.postdetailpengajuan',$id) }}" method="POST">
                      @csrf     
                          <div class="userDatatable orderDatatable sellerDatatable global-shadow mb-30 py-30 px-sm-30 px-20 radius-xl w-100">
                            
                              <div class="table-responsive">
                                  <table class="table mb-0 table-borderless border-0">
                                      <thead>
                                          <tr class="userDatatable-header">
                                          <th scope="col"> <input class="checkbox" type="checkbox" id="check-5" onclick="checkAll(this)"></th>
                                          <th scope="col">Nomor Transaksi</th>
                                          <th scope="col">Nama Pemohon</th>
                                             <th scope="col">Tanggal </th>
                                             <th scope="col">Jumlah</th>
                                             <th scope="col">Keterangan</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                      @foreach($data as $key => $d)
                                      <tr>
                                      <td>
                                   
                                   <input class="checkbox" type="checkbox" id="check-grp-12"  name="selectedItems[]" value="{{ $d->id }}">
                                   

                </td>
                <td>{{ $d->kode_transaksi }}</td>
                <td>{{ $d->muzaki }}</td>
                                          <td>{{ date('d F Y', strtotime($d->tanggal)) }}</td>
                                          <td>{{ 'Rp ' . number_format($d->jumlah, 0, ',', '.')}}</td>
                                          <td>{{ $d->keterangan }}</td>
                                       
                                      
                                          </tr>
                                          @endforeach
                                       
  
  
  
                                      </tbody>
                                  </table>
                              </div>
  
                              <div class="d-flex content-center ">
                                    <br/>
                                    <button type="submit" class="btn btn-primary btn-xs btn-squared">Ajukan Data</button>

                                </div> 
</form>
                              <div class="d-flex justify-content-center mt-15 pt-25">
                             
                                <nav class="dm-page ">
                                  <ul class="dm-pagination d-flex">
                                      {{ $data->onEachSide(2)->withQueryString()->links('pagination') }}
                                  </ul>
                                </nav>
  
  
                             </div>
                              
                          </div>
                      </div>
      </div>
  </div>
  @endsection
  
  
  
  