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
                                <h4 class="text-capitalize breadcrumb-title">Data Transaksi Pengumpulan</h4>
                                <div class="breadcrumb-action justify-content-center flex-wrap">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>Pengumpulan</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Transaksi</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
<!-- Jika terdapat pesan kesalahan -->
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif         <div class="card">
                    <div class="card-header">
                        <h5>Hapus Data Transaksi Pengumpulan</h5>
                    </div>


                    <div class="card-body">
                        
                    <form method="POST"  action="{{ route('pengumpulan.pengumpulan.hapusdatsa') }}" enctype="multipart/form-data">
                        @csrf
                            <div class="row g-3">
                                <div class="col-md-3 mb-3">
                                    <label class="form-label" for="validationDefault02">Tanggal</label>
                                    <input class="form-control" type="date" name="tanggal" required>
                                </div>
                           
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="validationDefault02">UPZ</label>
                                    <div class="dm-select ">
                                        <select name="dinas" id="select-search"  class="form-control" required>    
                                        <option value=""> -- Pilih UPZ --</option>

                                        @foreach($data as $tu => $t)
                                        <option value="{{ $t->id }}"> {{ $t->nama_muzaki }}</option>
                                        @endforeach
                                      </select> 
                                    </div> 
                                </div>
                          
                           
                             </div>
                            
        
                        
        
                        

                          <button class="btn btn-danger" type="submit">Hapus</button>
                        </form>
                      </div>
                    </div>



                
                        </form>
                    </div>
                </div>
      </div>
   </div>
</div>
@endsection



