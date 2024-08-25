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


            <script>
function goBack() {
  window.history.back();
}
</script>

         <div class="card">
                    <div class="card-header">
                        <h5>Detail Proposal</h5>
                       
                        <button type="button" class="btn btn-primary btn-xs btn-squared" onclick="goBack()">Kembali</button>
                    </div>


                    <div class="card-body">
                

                            <div class="row g-3">

                                <div class="col-md-6  mb-3">
                                    <label class="form-label" for="validationDefault02">Nomor Proposal</label>
                                    <input class="form-control" type="text" name="tanggal" value="{{ $data->nomor_proposal }}" disabled> 
                                </div>
      
                             
                             </div>

                
                        <div class="row g-3">

                                <div class="col-md-2">
                                    <label class="form-label" for="validationDefault02">Tanggal</label>
                                    <input class="form-control" type="date" name="tanggal" value="{{ $data->tanggal_masuk }}" disabled> 
                                </div>
                             
                                <div class="col-md-3 mb-3">
                                    <label class="form-label" for="validationDefault02">Jenis Permohonan</label>
                                        <select class="form-control px-15" name="sifat" id="exampleFormControlSelect1" disabled>
                                            <option value="uang"  {{ $data->jenis_permohonan == 'uang' ? 'selected' : '' }}>Uang</option>
                                            <option value="barang"  {{ $data->jenis_permohonan == 'barang' ? 'selected' : '' }}>Barang</option>
                                        </select> 
                                </div>
                             
                             </div>

                
                
                
                             <div class="row g-3">

                                <div class="col-md-4">
                                    <label class="form-label" for="validationDefault02">Nama Pemohon</label>
                                    <input class="form-control" type="text" name="nama" value="{{ $data->nama_pemohon }}" disabled>    
                                </div>
                             
                                <div class="col-md-4">
                                    <label class="form-label" for="validationDefault02">NIK</label>
                                    <input class="form-control" type="text" name="nik" value="{{ $data->nik }}" disabled>    
                                </div>
                             
                           
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="validationDefault02">Jenis Kelamin</label>
                                        <select class="form-control px-15" name="jenis_kelamin" disabled>
                                            <option value="L"  {{ $data->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki - laki</option>
                                            <option value="P"  {{ $data->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                                        </select> 
                                </div>
                             
                             </div>

                            <div class="row g-3">

                                <div class="col-md-3">
                                    <label class="form-label" for="validationDefault02">Tempat Lahir</label>
                                    <input class="form-control" type="text" name="tempat_lahir"  value="{{ $data->tempat_lahir }}" disabled>    
                                </div>
                             
                                <div class="col-md-2 mb-3">
                                    <label class="form-label" for="validationDefault02">Tanggal Lahir</label>
                                    <input class="form-control" type="date" name="tanggal_lahir"  value="{{ $data->tanggal_lahir }}" disabled>    
                                </div>
                             
                             </div>
                        

                            <div class="row g-3">

                                <div class="col-md-3">
                                    <label class="form-label" for="validationDefault02">HP</label>
                                    <input class="form-control" type="text" name="hp"  value="{{ $data->hp }}" disabled>    
                                </div>
                             
                                <div class="col-md-5 mb-3">
                                    <label class="form-label" for="validationDefault02">Pekerjaan</label>
                                    <input class="form-control" type="text" name="pekerjaan"  value="{{ $data->pekerjaan }}" disabled>    
                                </div>
                             
                             </div>
                        

                            <div class="row g-3">

                                <div class="col-md-10 mb-3">
                                    <label class="form-label" for="validationDefault02">Alamat Lengkap</label>
                                    <input class="form-control" type="text" name="alamat"  value="{{ $data->alamat_lengkap }}" disabled>    
                                </div>
                             </div>
                        

                            <div class="row g-3">

                                <div class="col-md-6">
                                    <label class="form-label" for="validationDefault02">Kecamatan</label>
                                        
                                        <select class="form-control px-15" id="kecamatan" name="kecamatan" id="exampleFormControlSelect1" disabled>
                                            <option value="0">-- Pilih Kecamatan --</option>
                                            @foreach($kecamatan as $key => $kec)
                                            <option value="{{ $kec->id }}" {{ $data->kecamatan == $kec->id ? 'selected' : '' }}>{{ $kec->nama_kecamatan }}</option>
                                            @endforeach
                                        </select>   
                                    </div>
                             
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" for="validationDefault02">Kelurahan</label>
                                          <select class="form-control px-15" id="kelurahan" name="kelurahan" id="exampleFormControlSelect1" disabled>
                                            <option value="0">-- Pilih Keluharan --</option>
                                            @foreach($kelurahan as $key => $kel)
                                            <option value="{{ $kel->id }}" {{ $data->kelurahan == $kel->id ? 'selected' : '' }}>{{ $kel->nama_kelurahan }}</option>
                                            @endforeach
                                          </select>
                                    </div>
                             
                             </div>
                        

                            <div class="row g-3">

                                <div class="col-md-2">
                                    <label class="form-label" for="validationDefault02">RT</label>
                                    <input class="form-control" type="text" name="rt" value="{{ $data->rt }}" disabled>
                                </div>
                             
                                <div class="col-md-2 mb-3">
                                    <label class="form-label" for="validationDefault02">RW</label>
                                    <input class="form-control" type="text" name="rw" value="{{ $data->rw }}" disabled>
                                </div>
                             
                             </div>
                        

                      

                            <div class="row g-3">

                                <div class="col-md-4">
                                    <label class="form-label" for="validationDefault02">Program</label>
                                        <select class="form-control px-15" id="program" name="program" id="exampleFormControlSelect1" disabled>
                                            <option value="0">Pilih Program</option>
                                            @foreach($program as $key => $pro)
                                            <option value="{{ $pro->kode }}"  {{ $data->program == $pro->kode ? 'selected' : '' }} >{{ $pro->uraian }}</option>
                                            @endforeach
                                        </select>
                                </div>
                             
                                <div class="col-md-4">
                                    <label class="form-label" for="validationDefault02">Sub Program</label>
                                        <select class="form-control px-15" id="subprogram" name="subprogram" id="exampleFormControlSelect1" disabled>
                                            <option value="0">-- Pilih Subprogram --</option>
                                            @foreach($subprogram as $key => $sub)
                                            <option value="{{ $sub->kode }}"  {{ $data->sub_program == $sub->kode ? 'selected' : '' }} >{{ $sub->uraian }}</option>
                                            @endforeach
                                        </select>
                                </div>
                             
                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="validationDefault02">Detail Program</label>
                                    <select class="form-control px-15" id="detailprogram" name="detailprogram" id="exampleFormControlSelect1" disabled>
                                            <option value="0">-- Pilih Detail Program --</option>
                                            @foreach($detailprogram as $key => $del)
                                            <option value="{{ $del->id }}"  {{ $data->detail_program == $del->id ? 'selected' : '' }} >{{ $del->uraian }}</option>
                                            @endforeach

                                          </select>
                                </div>
                             
                             </div>
                            

                            <div class="row g-3">

                                <div class="col-md-7 mb-3">
                                    <label class="form-label" for="validationDefault02">Jumlah Nominal</label>
                                    <input class="form-control" type="text" name="nominal"  value="{{ $data->nominal_pengajuan }}" oninput="formatNominal(this)" disabled>
                                </div>
                             
                             
                             </div>
                            


                            <div class="row g-3">

                                <div class="col-md-10 mb-3">
                                    <label class="form-label" for="validationDefault02">Keterangan</label>
                                    <input class="form-control" type="text" name="keterangan" value="{{ $data->keterangan }}" disabled>
                                </div>
                             
                             
                             </div>
                            


                            <div class="row g-3">

                                <div class="col-md-7 mb-3">
                                    <label class="form-label" for="validationDefault02">File Proposal</label>
                                    <input class="form-control" type="file" name="proposal" disabled>
                                </div>
                             
                             
                             </div>
                            
                        <div class="row g-3">

                                <div class="col-md-3 mb-3">
                                    <label class="form-label" for="validationDefault02">Tanggal Submit Survery</label>
                                    <input class="form-control" type="text"  value="{{ date('d F Y', strtotime($data->tanggal_input_survey)) }}" disabled>    
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label" for="validationDefault02">Petugas Survey</label>
                                    <select class="form-control px-15"  name="petugas_survey" id="exampleFormControlSelect1" disabled>
                                            <option value="0">-- Pilih Petugas Survey --</option>
                                            @foreach($petugas as $key => $petugas)
                                            <option value="{{ $petugas->id }}"  {{ $data->petugas_survey == $petugas->id ? 'selected' : '' }} >{{ $petugas->name }}</option>
                                            @endforeach

                                          </select>
                                </div>

                                <div class="col-md-5 mb-3">
                                    <label class="form-label" for="validationDefault02">Keterangan Survey</label>
                                    <input class="form-control" type="text" name="keterangan_survey"  value="{{ $data->keterangan_survey }}" disabled>    
                                </div>

                        </div>
                        

                       <div class="row g-3">

                       <div class="col-md-2 mb-3">
                                    <label class="form-label" for="validationDefault02">Tanggal Penetapan</label>
                                    <input class="form-control" type="date" name="tanggal_penetapan" value="{{ $data->tanggal_penetapan }}" disabled>    
                                </div>

                                <div class="col-md-2 mb-3">
                                    <label class="form-label" for="validationDefault02">Lokasi</label>
                                    <input class="form-control" type="text" name="lokasi" value="{{ $data->lokasi }}" disabled>    
                                </div>
                                <div class="col-md-5 mb-3">
                                    <label class="form-label" for="validationDefault02">Keterangan Akhir</label>
                                    <input class="form-control" type="text" name="keterangan_akhir"  value="{{ $data->keterangan_penolakan }}" disabled>    
                                </div>

                        </div>
                        

 
 
                       <div class="row g-3">

                       <div class="col-md-5 mb-3">
                                    <label class="form-label" for="validationDefault02">Status Akhir</label>
                                    <select class="form-control px-15" name="status_akhir" id="exampleFormControlSelect1" disabled>
                                            <option value="B"  {{ $data->status == 'B' ? 'selected' : '' }}>Belum diproses</option>
                                            <option value="O"  {{ $data->status == 'O' ? 'selected' : '' }}>On Proses</option>
                                            <option value="N"  {{ $data->status == 'N' ? 'selected' : '' }}>Ditolak</option>
                                            <option value="A"  {{ $data->status == 'A' ? 'selected' : '' }}>Diterima</option>
                                        </select> 
                                </div>

                            
                        </div>
                        

 
 
 
                     
                      </div>
                    </div>



                
                        </form>
                    </div>
                </div>
      </div>
   </div>
</div>
<br/><br/>
@endsection



