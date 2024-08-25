@extends('layouts.simple.master')
@section('title', 'Sample Page')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Halaman User</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Beranda</li>
<li class="breadcrumb-item"><a href="{{ route('user.index') }}">User</a></li>
<li class="breadcrumb-item active">Import</li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">

@if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
@endif

@if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
@endif

@if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all as $error)
            {{ session('error') }}
            @endforeach
        </div>
@endif



 @if (session()->has('failures'))
<table class="table table-border-horizontal">
    <tr> 
        <th>Baris</th>
        <th>Baris</th>
     
    </tr>

@foreach (session()->get('failures') as $validasi)
<tr>
    <td></td>
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
                        <h5>Form Import User</h5>
                    </div>


                    <div class="card-body">
                        <form method="POST" action="{{ route('user.import') }}" enctype="multipart/form-data">
                            @csrf
                          
                          
                          
                            <div class="row g-3">
                            
                                <div class="col-md-6 mb-3">
                                  <label class="form-label" for="validationDefault02">Data User</label>
                                  <input class="form-control" type="file" name="file">
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

@section('script')
@endsection