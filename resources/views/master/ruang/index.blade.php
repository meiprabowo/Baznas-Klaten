@extends('layouts.simple.master')
@section('title', 'Sample Page')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Halaman Ruang</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Beranda</li>
<li class="breadcrumb-item active">Ruang</li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">

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

         <div class="card">
            <div class="card-header">
               <h5>Ruang              </h5>
                <span>Halaman Data Ruang</span>

                        <div class="card-header-right">
                         
                      
                         
                           <a href="{{ route('ruang.create') }}">
                              <button class="btn btn-success active" type="button">Tambah Data</button>
                           </a>
                         
                                 </div>
                        
            </div>



        

           <div class="table-responsive">

               <table class="table table-border-horizontal">
                  <thead>
                     <tr>
                     <th scope="col">Kode Ruang</th>
                     <th scope="col">Nama Ruang</th>
                     <th scope="col">Penanggung Jawab</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col" width="10%"><center>Aksi</center></th>
                     </tr>
                  </thead>
                  <tbody>
                    
                     @foreach($dataku as $key => $d)
                     <tr>
                     <td>{{ $d->kode_ruang }}</td>
                     <td>{{ $d->nama_ruang }}</td>
                     <td>{{ $d->nama_lengkap }}</td>
                     <td>{{ $d->keterangan }}</td>
                        <td>
                           <ul class="action align-center"> 
                                 <li class="edit"> <a href="{{ route('ruang.edit', $d->id) }}"  data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Data..."><i class="icon-pencil-alt"></i></a></li>
                                 
                                 <li class="delete"><a href="{{ route('ruang.destroy', $d->id) }}" onclick="return confirm('Apakah Anda Yakin ?');"  data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Data..."><i class="icon-trash"></i></a></li>
                             
                           </ul>
                        </td>
                     </tr>
                     
                     @endforeach
                 
                  </tbody>
               </table>
 
              
               <div class="card-body">
                     <div class="card-header-right">
                      

                


                        <ul class="pagination justify-content-end pagin-border-danger pagination-danger">
                         
                             <span class="page-link" aria-hidden="true"> Showing {{ $dataku->currentPage() }} to  {{ $dataku->perPage() }} of {{ $dataku->total() }} results  </span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  
                        {{ $dataku->onEachSide(5)->withQueryString()->links('pagination::bootstrap-4') }}
                      </ul>
                  </div>
               </div>

            <br/>
            </div>
         </div>
      </div>
   </div>
</div>

@endsection

@section('script')
@endsection