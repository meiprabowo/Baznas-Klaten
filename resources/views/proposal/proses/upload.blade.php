@section('title',$title)
@extends('layout.app')
@section('content')
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop-breadcrumb">

                            <div class="breadcrumb-main">
                                <h4 class="text-capitalize breadcrumb-title">Upload Data Proposal</h4>
                                <div class="breadcrumb-action justify-content-center flex-wrap">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>Proposal</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Upload Data</li>
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

@if (session()->has('success'))
    <div class="alert alert-success dark" role="alert">
        <p>{{ session('success') }}</p>
    </div>
@endif

@if (session()->has('warning'))
    <div class="alert alert-danger dark" role="alert">
        <p>{{ session('warning') }}</p>
    </div>
@endif
@if (session()->has('failures'))
    @php
        $failureCount = count(session('failures'));
    @endphp
    <div class="alert alert-warning dark" role="alert">
        <p>
            Berhasil diUpload: {{ session('gagal') }} Data<br/>
            Gagal diUpload: {{ $failureCount }} Data ==> 
            <a href="#" onclick="downloadTableAsExcel()"><b> DOWNLOAD DATA GAGAL</b></a> <==
        </p>
    </div>
    <script>
        function downloadTableAsExcel() {
            var table = document.getElementById('downloaded');
            var html = table.outerHTML;

            // Convert HTML to Blob
            var blob = new Blob([html], { type: 'application/vnd.ms-excel' });

            // Create download link and trigger click
            var a = document.createElement('a');
            a.href = window.URL.createObjectURL(blob);
            a.download = 'failed_data.xls';
            document.body.appendChild(a);
            a.click();

            // Remove the temporary link
            document.body.removeChild(a);
        }
    </script>
    <table border="1" id="downloaded" style="display: none;">
        <tr> 
            <th>Baris</th>
            <th>Atribut</th>
            <th>Error</th>
            <th>Value</th>
        </tr>
        @foreach (session()->get('failures') as $validasi)
    <tr>
        <td>{{ $validasi->row() }}</td>
        <td>{{ $validasi->attribute() }}</td>
        <td>
            @foreach ($validasi->errors() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </td>
        <td>
            {{-- Ambil nilai yang gagal dari baris data --}}
            {{ $row[$validasi->attribute()] ?? 'Tidak ada nilai' }}
        </td>
    </tr>
@endforeach

    </table>
@endif

<div class="col-12">
                  <div class="bg-white p-25 mb-25 radius-xl">
                     <div class="row">
                        <div class="col-lg-6 col-md-6">
                           <figure class="feature-cards7 feature-cards7--1">
                              <div class="banner-card banner-card-border">
                                 <div class="banner-card__top align-center-v justify-content-between">
                                 <h5 class="banner-card__title">
                                    Form Upload Proses Proposal
                                    </h5>
                                 </div>
                                 <div class="banner-card__body">
                                    <p>
                                        
                                    <form method="POST" action="{{ route('proposal.proposal.importproses') }}" enctype="multipart/form-data">
                                    @csrf
                                    Upload Data  Proses Proposal <small class="display-block">Migrasi harus menggunakan format yang telah ditentukan yaitu dalam bentuk xls / xlsx.                               <span><br/>
                                    <code class="text-danger"> Download template <a href="{{ route('proposal.proposal.prosesexport') }}" target="_blank"> ==> <b>DOWNLOAD</b> <== </a></code>
    </small>
                                    </p>
                                 </div>
                                 <div class="banner-card__bottom  align-center-v justify-content-between">
                                    
                                 <div class="col-md-12 mb-3">
                             
                             <input class="form-control" type="file" name="file">
                           </div>
                           <button class="btn btn-primary" type="submit">Simpan</button>
                                 </div>
                                 </form>
                              </div>
                           </figure>
                        </div>
                        <div class="col-lg-6 col-md-6">
                           <figure class="feature-cards7 feature-cards7--1">
                              <div class="banner-card banner-card-border">
                                 <div class="banner-card__body">
                                 <div class="table-responsive">
        <table class="table table-borderless">
            <thead>
                <tr class="userDatatable-header">
                    <th scope="col">Kode Data Pegawai</th>
                    <th scope="col">Nama  Petugas</th>
                </tr>
            </thead>
            <tbody>
                @foreach($petugas as $d)
                <tr>
                    <td><center>{{ $d->id }}</center></td>
                    <td>{{ $d->name }}</td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>

                                 </div>
                                 
                              </div>
                           </figure>
                        </div>
                        
                     </div>
                  </div>
               </div>

                </div>
      </div>
   </div>
</div>
@endsection



