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
                                <h4 class="text-capitalize breadcrumb-title">Data Pengajuan</h4>
                                <div class="breadcrumb-action justify-content-center flex-wrap">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>Pengajuan</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Data Pengajuan</li>
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
                  
                      <form action="{{ route('keuangan.tasaruf.postdetailpengajuanku',$id) }}" method="POST">
                      @csrf     
                          <div class="userDatatable orderDatatable sellerDatatable global-shadow mb-30 py-30 px-sm-30 px-20 radius-xl w-100">
                            
                              <div class="table-responsive">
                                  <table class="table mb-0 table-borderless border-0">
                                      <thead>
                                          <tr class="userDatatable-header">
                                          <th scope="col"> No</th>
                                          <th scope="col">Nomor Transaksi</th>
                                             <th scope="col">Tanggal </th>
                                             <th scope="col">Jumlah</th>
                                             <th scope="col">Keterangan</th>
                                             <th scope="col">Status</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                        <?php $no=1; ?>
                                      @foreach($data as $key => $d)
                                      <tr>
                                      <td>
                                   
                                 <?php echo"$no"; ?>
                                   

                                            </td>
                                          <td>{{ $d->kode_transaksi }}</td>
                                          <td>{{ date('d F Y', strtotime($d->tanggal)) }}</td>
                                          <td>{{ 'Rp ' . number_format($d->jumlah, 0, ',', '.')}}</td>
                                          <td>{{ $d->keterangan }}</td>
                                          <td> <input type="hidden" name="idd[]" value="{{ $d->id }}" />

                                          <select name="status[]" class="form-control">
                          
                            <option value="P" {{ $d->status == 'P' ? 'selected' : '' }} >Pendding</option>
                            <option value="R" {{ $d->status == 'R' ? 'selected' : '' }} >Revisi</option>
                            <option value="S" {{ $d->status == 'S' ? 'selected' : '' }} >Sukses</option>
                        </select>

                                        </td>

                                       
                                      
                                          </tr>
                                          <?php $no++; ?>
                                          @endforeach
                                       
  
  
  
                                      </tbody>
                                  </table>
                              </div>
  
                              <div class="content-center">
                                    <div class="button-group m-0 mt-sm-0 mt-10 order-button-group">
                                     <button type="submit" name="sukses" class="btn btn-info btn-xs btn-squared">Submit</button>
                                
                                     </div></div>
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
  
  
  
  