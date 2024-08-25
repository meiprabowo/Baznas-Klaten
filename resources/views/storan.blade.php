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
                                <h4 class="text-capitalize breadcrumb-title">Cek Setoran </h4>
                                <div class="breadcrumb-action justify-content-center flex-wrap">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>Beranda </a></li>
                                            <li class="breadcrumb-item active" aria-current="page"> Cek Setoran  </li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
               <!-- Display success message -->
               <div class="row justify-content-center">
               <div class="col-xxl-3 col-xl-4 col-md-6 col-sm-8">
                  <div class="edit-profile">
                  <br/><br/><br/><br/>
                     <div class="card border-0">
                        <div class="card-header">
                           <div class="edit-profile__title">
                              <h6>Cek Setoran</h6>
                           </div>
                        </div>
                        <div class="card-body">
                        <form method="POST" action="{{ route('cekstoranact') }}" enctype="multipart/form-data">
                        @csrf
                           <div class="edit-profile__body">
                              <div class="form-group mb-25">
                                 <label for="username">NPWZ</label>
                                 <input type="text" class="form-control" name="kode" placeholder="Nomor Pokok Wajib Pajak">
                              </div>
                              <div class="form-group mb-15">
                                 <label for="password-field">NIK</label>
                                 <div class="position-relative">
                                 <input type="text" class="form-control" name="nik" placeholder="NIK">
                                    
                                    </div>
                                 </div>
                              </div>
                              <div class="admin__button-group button-group d-flex pt-1 justify-content-md-start justify-content-center">
                                 <button type="submit" class="btn btn-primary btn-default w-100 btn-squared text-capitalize lh-normal px-50 signIn-createBtn ">
                                    Cek Setoran
                                 </button>
                              </div>
                           </form>
                           </div>
                        </div><!-- End: .card-body -->
                        
                     </div><!-- End: .card -->
                  </div><!-- End: .edit-profile -->
               </div><!-- End: .col-xl-5 -->
            </div>

@endsection



