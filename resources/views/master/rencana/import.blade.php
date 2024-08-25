@section('title',$title)
@extends('layout.app')
@section('content')
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop-breadcrumb">

                            <div class="breadcrumb-main">
                                <h4 class="text-capitalize breadcrumb-title">Import Data RKAT</h4>
                                <div class="breadcrumb-action justify-content-center flex-wrap">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>Import Data RKAT</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Data RKAT</li>
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
                <td>{{ $validasi->values()[$validasi->attribute()] }}</td>
            </tr>
        @endforeach
    </table>
@endif
         <div class="card">
                    <div class="card-header">
                        <h5>Form Import Data RKAT</h5>
                    </div>


                    <div class="card-body">
                        <form method="POST" action="{{ route('master.rencana.importstore') }}" enctype="multipart/form-data">
                            @csrf
                          <div class="row g-3">
                            <div class="col-md-6 mb-3">
                              <label class="form-label" for="validationDefault01">Import Data RKAT</label>
                              <input class="form-control" type="file" name="file">
                              <span><code class="text-danger">Download template <a href="{{ route('master.rencana.export') }}" target="_blank"> ==> <b>DOWNLOAD</b> <== </a></code> <br/></span>

                            </div>
                           
                           
                          </div>
                        

                          <button class="btn btn-primary" type="submit">Simpan</button>
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



