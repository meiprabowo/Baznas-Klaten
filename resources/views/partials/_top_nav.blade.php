<nav class="navbar navbar-light">
    <div class="navbar-left">
        <div class="logo-area">
            <a class="navbar-brand" href=""{{ route('index') }}">
                <img class="dark" src="{{ asset('assets/img/logo-dark.png') }}" alt="svg">
                <img class="light" src="{{ asset('assets/img/logo-white.png') }}" alt="img">
            </a>
            <a href="#" class="sidebar-toggle">
                <img class="svg" src="{{ asset('assets/img/svg/align-center-alt.svg') }}" alt="img"></a>
        </div>
        
        <div class="top-menu">
            <div class="hexadash-top-menu position-relative">
                <ul>
                   
                    @if(auth()->check())
                    <li class="has-Menu">
                         <a href="{{ route('index') }}" class="{{ Request::is('dashboards/*') ? 'active':'' }}">  
                         <img src="{{ asset('assets/img/svg/home.svg') }}" alt="grid" class="svg nav-icon">

                                Beranda</a>
                    </li>
                    <li class="has-subMenu">
                        
                        <a href="#" class="{{ Request::is('master/*') ? 'active':'' }}">
                        <img src="{{ asset('assets/img/svg/settings.svg') }}" alt="grid" class="svg nav-icon">
                        Master</a>
                        <ul class="subMenu">
                        <li><a href="{{ route('master.user.identitas') }}" class="{{ Str::is('master/identitas', Request::path()) ? 'active' : '' }}">Identitas</a></li>
                <li><a href="{{ route('master.user.index') }}" class="{{ Str::is('master/user', Request::path()) ? 'active' : '' }}">Data User</a></li>
                <li><a href="{{ route('master.tahun.index') }}" class="{{ Str::is('master/tahun*', Request::path()) ? 'active' : '' }}">Tahun</a></li>
                <li><a href="{{ route('master.akun.jenis') }}" class="{{ Str::is('master/jenis*', Request::path()) ? 'active' : '' }}">Jenis Akun</a></li>
                <li><a href="{{ route('master.akun.index') }}" class="{{ Str::is('master/akun*', Request::path()) ? 'active' : '' }}">Master Akun</a></li>
                <li><a href="{{ route('master.rencana.index') }}" class="{{ Str::is('master/rencana*', Request::path()) ? 'active' : '' }}">RKAT</a></li>
                <li><a href="{{ route('master.saldo.index') }}" class="{{ Str::is('master/saldo*', Request::path()) ? 'active' : '' }}">Saldo Awal</a></li>
                <li><a href="{{ route('master.wilayah.index') }}" class="{{ Str::is('master/wilayah', Request::path()) ? 'active' : '' }}">Wilayah</a></li>
                <li><a href="#"  onclick="toggleMode(); return false;" >Dark / Light</a></li>
                            <li><a href="#" onclick="topmenu(); return false;" >Top / Side</a><li>
                        </ul>
                    </li>
                    <li class="has-subMenu">
                        <a href="#" class="{{ Request::is('proposal/*') ? 'active':'' }}">
                        <img src="{{ asset('assets/img/svg/image.svg') }}" alt="grid" class="svg nav-icon">

                        Proposal</a>
                        <ul class="subMenu">


                        
                        <li class="has-subMenu-left">
                              <a href="{{ route('proposal.proposal.index') }}" class="{{ Str::is('proposal/permohonan', Request::path()) ? 'active' : '' }}">
                              
                                 <span class="menu-text">Data Proposal</span>
                              </a>
                              <ul class="subMenu">
                                    <li><a href="{{ route('proposal.proposal.perseorangan') }}" class="{{ Str::is('proposal/permohonan/perseorangan', Request::path()) ? 'active' : '' }}">Proposal Perseorangan</a></li>
                                    <li><a href="{{ route('proposal.proposal.lembaga') }}" class="{{ Str::is('proposal/permohonan/lembaga', Request::path()) ? 'active' : '' }}">Proposal Lembaga</a></li>
                                    <li><a href="{{ route('proposal.proposal.upload') }}" class="{{ Str::is('proposal/permohonan/upload', Request::path()) ? 'active' : '' }}">Upload Proposal</a></li>
                            </ul>
                           </li>

                                              
                           <li class="has-subMenu-left">
                              <a href="#" class="{{ Str::is('proposal/permohonan', Request::path()) ? 'active' : '' }}">
                             
                                 <span class="menu-text">Proses</span>
                              </a>
                              <ul class="subMenu">
                                    <li><a href="{{ route('proposal.proposal.proses') }}" class="{{ Str::is('proposal/proses*', Request::path()) ? 'active' : '' }}">Pembagian Data Survey</a></li>
                                    <li><a href="{{ route('proposal.proposal.lanjut') }}" class="{{ Str::is('proposal/lanjut*', Request::path()) ? 'active' : '' }}">Tindak Lanjut</a></li>
                                    <li><a href="{{ route('proposal.proposal.akhir') }}" class="{{ Str::is('proposal/akhir*', Request::path()) ? 'active' : '' }}">Data Akhir</a></li>
                            </ul>
                           </li>

                         
                           <li class="has-subMenu-left">
                              <a href="#" class="{{ Str::is('proposal/permohonan', Request::path()) ? 'active' : '' }}">
                             
                                 <span class="menu-text">Laporan</span>
                              </a>
                              <ul class="subMenu">
                                     <li><a href="#">GIS Mustahik</a></li>
                                   <li><a href="{{ route('proposal.proposal.kirimwa') }}" class="{{ Str::is('proposal/kirimwa/penerimaan*', Request::path()) ? 'active' : '' }}">Kirim WA</a></li>
                            </ul>
                           </li>


                        </ul>
                     </li>

                     <li class="has-subMenu">
                        <a href="#" class="{{ (Str::is('pengumpulan/muzaki*', Request::path()) || Str::is('pengumpulan/lembaga*', Request::path())  ) ? 'active' : '' }}">
                        <img src="{{ asset('assets/img/svg/book-open.svg') }}" alt="grid" class="svg nav-icon">

                        Pengumpulan</a>
                        <ul class="subMenu">


                        
                        <li class="has-subMenu-left">
                              <a href="#" class="{{ (Str::is('pengumpulan/muzaki*', Request::path()) || Str::is('pengumpulan/lembaga*', Request::path())  ) ? 'active' : '' }}">
                              
                                 <span class="menu-text">Registrasi</span>
                              </a>
                              <ul class="subMenu">
                                    <li><a href="{{ route('pengumpulan.muzaki.index') }}" class="{{ Str::is('pengumpulan/muzaki*', Request::path()) ? 'active' : '' }}">Perseorangan</a></li>
                                    <li><a href="{{ route('pengumpulan.muzaki.lembaga') }}" class="{{ Str::is('pengumpulan/lembaga*', Request::path()) ? 'active' : '' }}">Lembaga</a></li>
                            </ul>
                           </li>

                       
           
                           <li class="has-subMenu-left">
                              <a href="#" class="{{ (Str::is('pengumpulan/transaksi*', Request::path()) || Str::is('pengumpulan/mutasi*', Request::path())  ) ? 'active' : '' }}">
                              
                                 <span class="menu-text">Transaksi</span>
                              </a>
                              <ul class="subMenu">
                                 <li><a href="{{ route('pengumpulan.pengumpulan.index') }}" class="{{ Str::is('pengumpulan/transaksi*', Request::path()) ? 'active' : '' }}">Pengumpulan</a></li>
                                 <li><a href="{{ route('pengumpulan.mutasi.indexpengumpulan') }}" class="{{ Str::is('pengumpulan/mutasi*', Request::path()) ? 'active' : '' }}">Mutasi</a></li>
                            </ul>
                           </li>

                       

                           <li class="has-subMenu-left">
                              <a href="#" class="{{ (Str::is('pengumpulan/laporan*', Request::path()) ) ? 'active' : '' }}">
                              
                                 <span class="menu-text">Laporan</span>
                              </a>
                              <ul class="subMenu">
                              <li><a href="{{ route('pengumpulan.pengumpulan.wa') }}" class="{{ Str::is('pengumpulan/laporan/whatsapp*', Request::path()) ? 'active' : '' }}">Kirim WA</a></li>
                <li><a href="{{ route('pengumpulan.pengumpulan.laporan') }}" class="{{ Str::is('pengumpulan/laporan/transaksi*', Request::path()) ? 'active' : '' }}">Laporan</a></li>
                            </ul>
                           </li>

                       


                        </ul>
                     </li>



                     <li class="has-subMenu">
                        <a href="#" class="{{  (Str::is('pendistribusian/kasbon*', Request::path()) 
            || Str::is('pendistribusian/pembelian*', Request::path()) 
            || Str::is('pendistribusian/tasaruf/belum*', Request::path()) 
            || Str::is('pendistribusian/tasaruf/sudah*', Request::path()) 
            || Str::is('pendistribusian/mutasi*', Request::path())   ) ? 'active' : '' }}">
                        <img src="{{ asset('assets/img/svg/truck.svg') }}" alt="grid" class="svg nav-icon">

                        Pendistribusian</a>
                        <ul class="subMenu">


                        
                        <li class="has-subMenu-left">
                              <a href="#" class="{{  (Str::is('pendistribusian/kasbon*', Request::path()) 
            || Str::is('pendistribusian/pembelian*', Request::path()) 
            || Str::is('pendistribusian/tasaruf/belum*', Request::path()) 
            || Str::is('pendistribusian/tasaruf/sudah*', Request::path()) 
            || Str::is('pendistribusian/mutasi*', Request::path())   ) ? 'active' : '' }}">
                              
                                 <span class="menu-text">Pendistribusian</span>
                              </a>
                              <ul class="subMenu">
                              <li><a href="{{ route('pendistribusian.kasbon.indexpd') }}" class="{{ Str::is('pendistribusian/kasbon*', Request::path()) ? 'active' : '' }}">Kasbon</a></li>
            <li><a href="{{ route('pendistribusian.pembelian.index') }}" class="{{ Str::is('pendistribusian/pembelian*', Request::path()) ? 'active' : '' }}">Pembelian Barang</a></li>
            <li><a href="{{ route('pendistribusian.tasaruf.index') }}" class="{{ Str::is('pendistribusian/tasaruf/belum*', Request::path()) ? 'active' : '' }}">Belum di proses </a></li>
            <li><a href="{{ route('pendistribusian.tasaruf.indexsudah') }}" class="{{ Str::is('pendistribusian/tasaruf/sudah*', Request::path()) ? 'active' : '' }}">Tertasaruf</a></li>
            <li><a href="{{ route('pendistribusian.mutasi.indexp') }}" class="{{ Str::is('pendistribusian/mutasi*', Request::path()) ? 'active' : '' }}">Mutasi Kas</a></li>
                            </ul>
                           </li>

                           <li class="has-subMenu-left">
                              <a href="#" class="{{ Str::is('pendistribusian/laporan/tasaruf*', Request::path()) ? 'active' : '' }}">
                              
                                 <span class="menu-text">Laporan</span>
                              </a>
                              <ul class="subMenu">
                              <li><a href="{{ route('pendistribusian.tasaruf.laporan') }}" class="{{ Str::is('pendistribusian/laporan/tasaruf*', Request::path()) ? 'active' : '' }}">Laporan</a></li>
                              <li><a href="{{ route('pendistribusian.tasaruf.pengajuan') }}" class="{{ Str::is('pendistribusian/laporan/pengajuan*', Request::path()) ? 'active' : '' }}">Pengajuan Data</a></li>
                              <li><a href="{{ route('pendistribusian.mutasi.laporanpen') }}" class="{{ Str::is('keuangan/laporan*', Request::path()) ? 'active' : '' }}">Laporan Keuangan</a></li>


                            </ul>
                           </li>

                       

                       


                        </ul>
                     </li>


                     
                     <li class="has-subMenu">
                        <a href="#" class="{{ (Str::is('sdm/kasbon*', Request::path()) || Str::is('sdm/mutasi*', Request::path()) || Str::is('sdm/spj*', Request::path())) ? 'active' : '' }}" alt="grid" class="svg nav-icon">
                        <img src="{{ asset('assets/img/svg/command.svg') }}" alt="grid" class="svg nav-icon">

                        SDM Umum</a>
                        <ul class="subMenu">


                        
                     

                        <li class="has-subMenu-left">
                              <a href="#" class="{{ (Str::is('sdm/kasbon*', Request::path()) || Str::is('sdm/mutasi*', Request::path()) || Str::is('sdm/spj*', Request::path())) ? 'active' : '' }}">
                              
                                 <span class="menu-text">SDM Umum</span>
                              </a>
                              <ul class="subMenu">
                                  <li><a href="{{ route('sdm.kasbon.index') }}" class="{{ Str::is('sdm/kasbon*', Request::path()) ? 'active' : '' }}">Kasbon</a></li>
                                <li><a href="{{ route('sdm.spj.index') }}" class="{{ Str::is('sdm/spj*', Request::path()) ? 'active' : '' }}">SPJ</a></li>
                                <li><a href="{{ route('sdm.mutasi.index') }}" class="{{ Str::is('sdm/mutasi*', Request::path()) ? 'active' : '' }}">Mutasi</a></li>
                            </ul>
                           </li>

                      
                           <li class="has-subMenu-left">
                              <a href="#" class="{{ (Str::is('sdm/surat-masuk*', Request::path()) || Str::is('sdm/surat-keluar*', Request::path()) ) ? 'active' : '' }}">
                              
                                 <span class="menu-text">Persuratan</span>
                              </a>
                              <ul class="subMenu">
                              <li><a href="{{ route('sdm.surat.masuk') }}" class="{{ Str::is('sdm/surat-masuk*', Request::path()) ? 'active' : '' }}">Surat Masuk</a></li>
                             <li><a href="{{ route('sdm.surat.index') }}" class="{{ Str::is('sdm/surat-keluar*', Request::path()) ? 'active' : '' }}">Surat Keluar</a></li>
                            </ul>
                           </li>

                   
                           <li class="has-subMenu-left">
                              <a href="#" class="{{ (Str::is('sdm/laporsdm*', Request::path()) || Str::is('sdm/informasi*', Request::path()) ) ? 'active' : '' }}">
                              
                                 <span class="menu-text">Informasi Umum</span>
                              </a>
                              <ul class="subMenu">
                              <li><a href="{{ route('sdm.laporantahunan.index') }}" class="{{ Str::is('sdm/laporsdm', Request::path()) ? 'active' : '' }}">Laporan Tahunan</a></li>
                <li><a href="{{ route('sdm.informasi.index') }}" class="{{ Str::is('sdm/informasi', Request::path()) ? 'active' : '' }}">Informasi</a></li>
                <li><a href="{{ route('sdm.agenda.index') }}" class="{{ Str::is('sdm/agenda*', Request::path()) ? 'active' : '' }}">Agenda</a></li>
   <li><a href="{{ route('sdm.tasaruf.pengajuansdm') }}" class="{{ Str::is('sdm/laporan/pengajuan*', Request::path()) ? 'active' : '' }}">Pengajuan Data</a></li>
           </ul>
                           </li>

                       

                       


                        </ul>
                     </li>


                     
                     <li class="has-subMenu">
                        <a href="#" class="{{ Str::is('keuangan/persetujuan*', Request::path()) ? 'active' : '' }}" alt="grid" class="svg nav-icon">
                        <img src="{{ asset('assets/img/svg/dollar-sign.svg') }}" alt="grid" class="svg nav-icon">

                        Keuangan</a>
                        <ul class="subMenu">


                        
                     

                        <li class="has-subMenu-left">
                              <a href="#" class="{{ Str::is('keuangan/persetujuan*', Request::path()) ? 'active' : '' }}">
                              
                                 <span class="menu-text">Approved</span>
                              </a>
                              <ul class="subMenu">
                              <li><a href="{{ route('keuangan.kasbon.indexkeuangan') }}" class="{{ Str::is('keuangan/persetujuan/kasbon*', Request::path()) ? 'active' : '' }}"> Kasbon</a></li>
                              <li><a href="{{ route('keuangan.tasaruf.pengajuanku') }}" class="{{ Str::is('keuangan/pengajuan*', Request::path()) ? 'active' : '' }}"> Pengajuan Data</a></li>
   </ul>
                           </li>

                 
                           <li class="has-subMenu-left">
                              <a href="#" class="{{ (Str::is('keuangan/mutasi*', Request::path()) || Str::is('keuangan/laporan*', Request::path()) ) ? 'active' : '' }}">
                              
                                 <span class="menu-text">Laporan</span>
                              </a>
                              <ul class="subMenu">
                              <li><a href="{{ route('keuangan.mutasi.indexkeuangan') }}" class="{{ Str::is('keuangan/mutasi*', Request::path()) ? 'active' : '' }}"> Jurnal Memorial</a></li>
                <li><a href="{{ route('keuangan.mutasi.laporan') }}" class="{{ Str::is('keuangan/laporan*', Request::path()) ? 'active' : '' }}">Laporan Keuangan</a></li>
                            </ul>
                           </li>

                      
                     

                       

                       


                        </ul>
                     </li>


                     


                     @else
                     <li class="has-Menu">
                         <a href="{{ route('index') }}" class="{{ Request::is('dashboards/*') ? 'active':'' }}">  
                            <img src="{{ asset('assets/img/svg/home.svg') }}" alt="grid" class="svg nav-icon">
                                Beranda</a>
                    </li>

                  
                     <li class="has-Menu">
                         <a href="{{ route('blog') }}" class="{{ Request::is('dashboards/*') ? 'active':'' }}">  
                            <img src="{{ asset('assets/img/svg/grid.svg') }}" alt="grid" class="svg nav-icon">
                                Informasi</a>
                    </li>

                    <li class="has-Menu">
                        
                        <a href="{{ route('laporantahunan') }}" class="{{ Request::is('dashboards/*') ? 'active':'' }}">
                        <img src="{{ asset('assets/img/svg/bar-chart-2.svg') }}" alt="grid" class="svg nav-icon">
Laporan Tahunan</a>
                    </li>

                    <li class="has-Menu">
                        <a href="{{ route('rekap') }}" class="{{ Request::is('executive-summary/*') ? 'active':'' }}">
                        <img src="{{ asset('assets/img/svg/clipboard.svg') }}" alt="grid" class="svg nav-icon">
Executive Summary</a>
                    </li>
                    <li class="has-Menu">
                        <a href="{{ route('infografis') }}" class="{{ Request::is('info-grafis/*') ? 'active':'' }}">
                        <img src="{{ asset('assets/img/svg/pie-chart.svg') }}" alt="grid" class="svg nav-icon">
Info Grafis</a>
                    </li>
                    <li class="has-Menu">
                        <a href="{{ route('cekproposal') }}" class="{{ Request::is('dashboards/*') ? 'active':'' }}">
                        <img src="{{ asset('assets/img/svg/book.svg') }}" alt="grid" class="svg nav-icon">
Cek Proposal</a>
                    </li>

                    <li class="has-Menu">
                        <a href="{{ route('cekstoran') }}" class="{{ Request::is('dashboards/*') ? 'active':'' }}">
                        <img src="{{ asset('assets/img/svg/columns.svg') }}" alt="grid" class="svg nav-icon">
Cek Setoran</a>
                    </li>

                     @endif


                </ul>
            </div>
        </div>
    </div>


    @auth
    <div class="navbar-right">
        <ul class="navbar-right__menu">
           
            <li class="nav-author">
                <div class="dropdown-custom">
                    <a href="javascript:;" class="nav-item-toggle"><img src="{{ asset('assets/img/author-nav.jpg') }}" alt="" class="rounded-circle">
                        @if(Auth::check())
                            <span class="nav-item__title">{{ Auth::user()->name }}<i class="las la-angle-down nav-item__arrow"></i></span>
                        @endif
                    </a>
                    <div class="dropdown-wrapper">
                        <div class="nav-author__info">
                            <div class="author-img">
                                <img src="{{ asset('assets/img/author-nav.jpg') }}" alt="" class="rounded-circle">
                            </div>
                            <div>
                                @if(Auth::check())
                                    <h6 class="text-capitalize">{{ Auth::user()->name }}</h6>
                                @endif
                                <span>
                                        @if(Auth::user()->status =='A')
                                        Administrator
                                        @endif
                                        @if(Auth::user()->status =='PR')
                                        Pendistribusian
                                        @endif
                                        @if(Auth::user()->status =='PG')
                                        Pengumpulan
                                        @endif
                                        @if(Auth::user()->status =='KU')
                                        Keuangan
                                        @endif
                                        @if(Auth::user()->status =='SD')
                                        SDM Umum
                                        @endif


                                </span>
                            </div>
                        </div>
                        <div class="nav-author__options">
                            <ul>
                                <li>
                                    <a href="{{ route('dashboard.user') }}">
                                        <img src="{{ asset('assets/img/svg/user.svg') }}" alt="user" class="svg"> Profile</a>
                                </li>
                             
                            </ul>
                            <a href="" class="nav-author__signout" onclick="event.preventDefault();document.getElementById('logout').submit();">
                                <img src="{{ asset('assets/img/svg/log-out.svg') }}" alt="log-out" class="svg">
                                 Sign Out</a>
                                <form style="display:none;" id="logout" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    @method('post')
                                </form>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        <div class="navbar-right__mobileAction d-md-none">
            <a href="#" class="btn-search">
                <img src="{{ asset('assets/img/svg/search.svg') }}" alt="search" class="svg feather-search">
                <img src="{{ asset('assets/img/svg/x.svg') }}" alt="x" class="svg feather-x">
            </a>
            <a href="#" class="btn-author-action">
                <img src="{{ asset('assets/img/svg/more-vertical.svg') }}" alt="more-vertical" class="svg"></a>
        </div>
    </div>

    @else 
    <ul class="navbar-right__menu">
    <li class="has-Menu">
        <a href="{{ route('login') }}" style="text-decoration: none; color: inherit;">
            <i class="uil uil-sign-out-alt">Login</i>
        </a>
    </li>
</ul>
@endauth
</nav>
