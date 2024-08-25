<div class="sidebar__menu-group">
    <ul class="sidebar_nav">
        <li>
            <a href="{{ route('index') }}" class="">
                <span class="nav-icon uil uil-home"></span>
                <span class="menu-text">Beranda</span>
               
            </a>
          
        </li>           
      
      
        @if(auth()->check())


        <?php
        if(auth()->user()->status === 'A') {
            ?>

           


        <li class="has-child  {{ Str::is('master*', Request::path()) ? 'open' : '' }}">
            <a href="#" class="{{ Str::is('master*', Request::path()) ? 'active' : '' }}">
                <span class="nav-icon uil uil-setting"></span>
                <span class="menu-text text-initial">Master </span>
                <span class="toggle-icon"></span>
            </a>
            <ul>
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
        <?php } ?>

        <?php
        if(auth()->user()->status === 'PR'  || auth()->user()->status === 'PG' || auth()->user()->status === 'KU' || auth()->user()->status === 'SD' ) {
            ?>

        <li class="has-child  {{ Str::is('master*', Request::path()) ? 'open' : '' }}">
            <a href="#" class="{{ Str::is('master*', Request::path()) ? 'active' : '' }}">
                <span class="nav-icon uil uil-setting"></span>
                <span class="menu-text text-initial">Master </span>
                <span class="toggle-icon"></span>
            </a>
            <ul>
            <li><a href="#"  onclick="toggleMode(); return false;" >Dark / Light</a></li>
                            <li><a href="#" onclick="topmenu(); return false;" >Top / Side</a><li>

            </ul>
        </li>

        <?php } ?>

        <?php
        if(auth()->user()->status === 'A'  || auth()->user()->status === 'PR') {
            ?>



        <li class="menu-title mt-30">
            <span>Permohonan</span> 
        </li>

        <li class="has-child  {{ Str::is('proposal/permohonan*', Request::path()) ? 'open' : '' }}">
            <a href="#" class="{{ Str::is('proposal/permohonan*', Request::path()) ? 'active' : '' }}">
                <span class="nav-icon uil uil-images"></span>
                <span class="menu-text text-initial">Pendataan Proposal</span>
                <span class="toggle-icon"></span>
            </a>
            <ul>
                <li><a href="{{ route('proposal.proposal.index') }}" class="{{ Str::is('proposal/permohonan', Request::path()) ? 'active' : '' }}">Data Proposal</a></li>
                <li><a href="{{ route('proposal.proposal.perseorangan') }}" class="{{ Str::is('proposal/permohonan/perseorangan', Request::path()) ? 'active' : '' }}">Proposal Perseorangan</a></li>
                <li><a href="{{ route('proposal.proposal.lembaga') }}" class="{{ Str::is('proposal/permohonan/lembaga', Request::path()) ? 'active' : '' }}">Proposal Lembaga</a></li>
                <li><a href="{{ route('proposal.proposal.upload') }}" class="{{ Str::is('proposal/permohonan/upload', Request::path()) ? 'active' : '' }}">Upload Proposal</a></li>
            </ul>
        </li>

        <li class="has-child  {{ (Str::is('proposal/proses*', Request::path()) || Str::is('proposal/lanjut*', Request::path()) || Str::is('proposal/akhir*', Request::path()) ) ? 'open' : '' }}">
             <a href="#" class="{{ (Str::is('proposal/proses*', Request::path()) || Str::is('proposal/lanjut*', Request::path()) || Str::is('proposal/akhir*', Request::path()) ) ? 'active' : '' }}">

                <span class="nav-icon uil uil-window"></span>
                <span class="menu-text text-initial">Proses Proposal</span>
                <span class="toggle-icon"></span>
            </a>
            <ul>
                <li><a href="{{ route('proposal.proposal.proses') }}" class="{{ Str::is('proposal/proses*', Request::path()) ? 'active' : '' }}">Pembagian Data Survey</a></li>
                <li><a href="{{ route('proposal.proposal.lanjut') }}" class="{{ Str::is('proposal/lanjut*', Request::path()) ? 'active' : '' }}">Tindak Lanjut</a></li>
                <li><a href="{{ route('proposal.proposal.akhir') }}" class="{{ Str::is('proposal/akhir*', Request::path()) ? 'active' : '' }}">Data Akhir</a></li>
            </ul>
        </li>


        <li class="has-child  {{ (Str::is('proposal/wilayah/full*', Request::path()) || Str::is('proposal/akun*', Request::path())  ) ? 'open' : '' }}">
            <a href="#" class="{{ (Str::is('proposal/wilayah/full*', Request::path()) || Str::is('proposal/akun*', Request::path())  ) ? 'active' : '' }}">
                <span class="nav-icon uil uil-database"></span>
                <span class="menu-text text-initial">Data Pendukung</span>
                <span class="toggle-icon"></span>
            </a>
            <ul>
            <li><a href="{{ route('proposal.akun.index') }}" class="{{ Str::is('proposal/akun*', Request::path()) ? 'active' : '' }}">Akun Keuangan</a></li>
            <li><a href="{{ route('proposal.wilayah.full') }}" class="{{ Str::is('proposal/wilayah/full*', Request::path()) ? 'active' : '' }}">Wilayah</a></li>
           </ul>
        </li>

        <li class="has-child  {{ (Str::is('proposal/kirimwa*', Request::path()) || Str::is('proposal/gis*', Request::path())  ) ? 'open' : '' }}">
     
            <a href="#" class="{{ (Str::is('proposal/kirimwa*', Request::path()) || Str::is('proposal/gis*', Request::path())  ) ? 'active' : '' }}">
                <span class="nav-icon uil uil-bag"></span>
                <span class="menu-text text-initial">Laporan</span>
                <span class="toggle-icon"></span>
            </a>
            <ul>
                <li><a href="{{ route('proposal.proposal.gis') }}" class="{{ Str::is('proposal/gis*', Request::path()) ? 'active' : '' }}">GIS Mustahik</a></li>
                <li><a href="{{ route('proposal.proposal.kirimwa') }}" class="{{ Str::is('proposal/kirimwa/penerimaan*', Request::path()) ? 'active' : '' }}">Kirim WA</a></li>
           </ul>
        </li>

        <?php } ?>


        <?php
        if(auth()->user()->status === 'A'  || auth()->user()->status === 'PG') {
            ?>



        <li class="menu-title mt-30">
            <span>Pengumpulan</span>
        </li>
            <li class="has-child  {{ (Str::is('pengumpulan/muzaki*', Request::path()) || Str::is('pengumpulan/lembaga*', Request::path())  ) ? 'open' : '' }}">
             <a href="#" class="{{ (Str::is('pengumpulan/muzaki*', Request::path()) || Str::is('pengumpulan/lembaga*', Request::path())  ) ? 'active' : '' }}">

                <span class="nav-icon uil uil-book-open"></span>
                <span class="menu-text text-initial">Registrasi</span>
                <span class="toggle-icon"></span>
            </a>
            <ul>
                <li><a href="{{ route('pengumpulan.muzaki.index') }}" class="{{ Str::is('pengumpulan/muzaki*', Request::path()) ? 'active' : '' }}">Perseorangan</a></li>
                <li><a href="{{ route('pengumpulan.muzaki.lembaga') }}" class="{{ Str::is('pengumpulan/lembaga*', Request::path()) ? 'active' : '' }}">Lembaga</a></li>
            </ul>
        </li>
        <li class="has-child  {{ (Str::is('pengumpulan/transaksi*', Request::path()) || Str::is('pengumpulan/mutasi*', Request::path()) 
            || Str::is('pengumpulan/hapus*', Request::path()) 
            
            
            ) ? 'open' : '' }}">
             <a href="#" class="{{ (Str::is('pengumpulan/transaksi*', Request::path()) || Str::is('pengumpulan/mutasi*', Request::path()) 
                || Str::is('pengumpulan/hapus/transaksi*', Request::path()) 
                 ) ? 'active' : '' }}">

        
                <span class="nav-icon uil uil-bill"></span>
                <span class="menu-text text-initial">Transaksi</span>
                <span class="toggle-icon"></span>
            </a>
            <ul>
                <li><a href="{{ route('pengumpulan.pengumpulan.index') }}" class="{{ Str::is('pengumpulan/transaksi*', Request::path()) ? 'active' : '' }}">Pengumpulan</a></li>
                <li><a href="{{ route('pengumpulan.mutasi.indexpengumpulan') }}" class="{{ Str::is('pengumpulan/mutasi*', Request::path()) ? 'active' : '' }}">Mutasi</a></li>
                <li><a href="{{ route('pengumpulan.pengumpulan.hapusdata') }}" class="{{ Str::is('pengumpulan/hapus/transaksi*', Request::path()) ? 'active' : '' }}">Hapus Transaksi</a></li>
            </ul>
        </li>
        
        <li class="has-child  {{ (Str::is('pengumpulan/laporan*', Request::path())  ) ? 'open' : '' }}">
             <a href="#" class="{{ (Str::is('pengumpulan/laporan*', Request::path()) ) ? 'active' : '' }}">
             <span class="nav-icon uil uil-bag"></span>
                <span class="menu-text text-initial">Laporan</span>
                <span class="toggle-icon"></span>
            </a>
            <ul>
                <li><a href="{{ route('pengumpulan.pengumpulan.wa') }}" class="{{ Str::is('pengumpulan/laporan/whatsapp*', Request::path()) ? 'active' : '' }}">Kirim WA</a></li>
                <li><a href="{{ route('pengumpulan.pengumpulan.laporan') }}" class="{{ Str::is('pengumpulan/laporan/transaksi*', Request::path()) ? 'active' : '' }}">Laporan</a></li>
            </ul>
        </li>
        <?php } ?>


        <?php
        if(auth()->user()->status === 'A'  || auth()->user()->status === 'PR') {
            ?>

        <li class="menu-title mt-30">
            <span>Pendistribusian</span>
        </li>

        <li class="has-child  {{ (Str::is('pendistribusian/kasbon*', Request::path()) 
            || Str::is('pendistribusian/pembelian*', Request::path()) 
            || Str::is('pendistribusian/tasaruf/belum*', Request::path()) 
            || Str::is('pendistribusian/tasaruf/sudah*', Request::path()) 
            || Str::is('pendistribusian/mutasi*', Request::path()) 
             ) ? 'open' : '' }}">
             <a href="#" class="{{  (Str::is('pendistribusian/kasbon*', Request::path()) 
            || Str::is('pendistribusian/pembelian*', Request::path()) 
            || Str::is('pendistribusian/tasaruf/belum*', Request::path()) 
            || Str::is('pendistribusian/tasaruf/sudah*', Request::path()) 
            || Str::is('pendistribusian/mutasi*', Request::path())   ) ? 'active' : '' }}">
                <span class="nav-icon uil uil-truck"></span>
                <span class="menu-text text-initial">Pendistribusian</span>
                <span class="toggle-icon"></span>
            </a>
            <ul>
            <li><a href="{{ route('pendistribusian.kasbon.indexpd') }}" class="{{ Str::is('pendistribusian/kasbon*', Request::path()) ? 'active' : '' }}">Kasbon</a></li>
            <li><a href="{{ route('pendistribusian.pembelian.index') }}" class="{{ Str::is('pendistribusian/pembelian*', Request::path()) ? 'active' : '' }}">Pembelian Barang</a></li>
            <li><a href="{{ route('pendistribusian.tasaruf.index') }}" class="{{ Str::is('pendistribusian/tasaruf/belum*', Request::path()) ? 'active' : '' }}">Belum di proses </a></li>
            <li><a href="{{ route('pendistribusian.tasaruf.indexsudah') }}" class="{{ Str::is('pendistribusian/tasaruf/sudah*', Request::path()) ? 'active' : '' }}">Tertasaruf</a></li>
            <li><a href="{{ route('pendistribusian.mutasi.indexp') }}" class="{{ Str::is('pendistribusian/mutasi*', Request::path()) ? 'active' : '' }}">Mutasi Kas</a></li>
 </ul>
        </li>
     



        <li class="has-child  {{ Str::is('pendistribusian/laporan/tasaruf*', Request::path())
            || Str::is('pendistribusian/laporan/', Request::path()) 
            || Str::is('pendistribusian/laporan/pengajuan*', Request::path()) 
             ? 'open' : '' }}">
            <a href="#" class="{{ Str::is('pendistribusian/laporan/tasaruf*', Request::path()) 
                || Str::is('pendistribusian/laporan/pengajuan*', Request::path()) 
                || Str::is('pendistribusian/laporan/', Request::path()) 
                ? 'active' : '' }}">
                <span class="nav-icon uil uil-bag"></span>
                <span class="menu-text text-initial">Laporan</span>
                <span class="toggle-icon"></span>
            </a>
            <ul>
            <li><a href="{{ route('pendistribusian.tasaruf.laporan') }}" class="{{ Str::is('pendistribusian/laporan/tasaruf*', Request::path()) ? 'active' : '' }}">Laporan</a></li>
            <li><a href="{{ route('pendistribusian.mutasi.laporanpen') }}" class="{{ Str::is('pendistribusian/laporan*', Request::path()) ? 'active' : '' }}">Laporan Keuangan</a></li>

            <li><a href="{{ route('pendistribusian.tasaruf.pengajuan') }}" class="{{ Str::is('pendistribusian/laporan/pengajuan*', Request::path()) ? 'active' : '' }}">Pengajuan Data</a></li>
            </ul>
        </li>
     
<?php } ?>


<?php
        if(auth()->user()->status === 'A'  || auth()->user()->status === 'SD') {
            ?>


        <li class="menu-title mt-30">
            <span>SDM Umum</span>
        </li>
        <li class="has-child {{ (Str::is('sdm/kasbon*', Request::path()) || Str::is('sdm/mutasi*', Request::path()) || Str::is('sdm/spj*', Request::path())) ? 'open' : '' }}">
    <a href="#" class="{{ (Str::is('sdm/kasbon*', Request::path()) || Str::is('sdm/mutasi*', Request::path()) || Str::is('sdm/spj*', Request::path())) ? 'active' : '' }}">
     
                <span class="nav-icon uil uil-slack"></span>
                <span class="menu-text text-initial">SDM Umum</span>
                <span class="toggle-icon"></span>
            </a>
            <ul>
                <li><a href="{{ route('sdm.kasbon.index') }}" class="{{ Str::is('sdm/kasbon*', Request::path()) ? 'active' : '' }}">Kasbon</a></li>
                <li><a href="{{ route('sdm.spj.index') }}" class="{{ Str::is('sdm/spj*', Request::path()) ? 'active' : '' }}">SPJ</a></li>
                <li><a href="{{ route('sdm.mutasi.index') }}" class="{{ Str::is('sdm/mutasi*', Request::path()) ? 'active' : '' }}">Mutasi</a></li>
            </ul>
        </li>
        <li class="has-child {{ (Str::is('sdm/surat-masuk*', Request::path()) || Str::is('sdm/surat-keluar*', Request::path()) ) ? 'open' : '' }}">
    <a href="#" class="{{ (Str::is('sdm/surat-masuk*', Request::path()) || Str::is('sdm/surat-keluar*', Request::path()) ) ? 'active' : '' }}">
                <span class="nav-icon uil uil-envelope"></span>
                <span class="menu-text text-initial">Persuratan</span>
                <span class="toggle-icon"></span>
            </a>
            <ul>
                <li><a href="{{ route('sdm.surat.masuk') }}" class="{{ Str::is('sdm/surat-masuk*', Request::path()) ? 'active' : '' }}">Surat Masuk</a></li>
                <li><a href="{{ route('sdm.surat.index') }}" class="{{ Str::is('sdm/surat-keluar*', Request::path()) ? 'active' : '' }}">Surat Keluar</a></li>
            </ul>
        </li>


            <li class="has-child  
            {{ 
                (
                    Str::is('sdm/laporsdm*', Request::path()) ||
                    Str::is('sdm/laporan/pengajuan*', Request::path()) ||
                    Str::is('sdm/informasi*', Request::path())  ||
                    Str::is('sdm/agenda*', Request::path()) 
                 ) ? 'open' : '' }}">
             <a href="#" class="{{ (
                Str::is('sdm/laporsdm*', Request::path()) || 
                Str::is('sdm/laporan/pengajuan*', Request::path()) || 
                Str::is('sdm/informasi*', Request::path())  ||
                Str::is('sdm/agenda*', Request::path()) 
                ) ? 'active' : '' }}">

                <span class="nav-icon uil uil-bag"></span>
                <span class="menu-text text-initial">Informasi Umum</span>
                <span class="toggle-icon"></span>
            </a>
            <ul>
                <li><a href="{{ route('sdm.laporantahunan.index') }}" class="{{ Str::is('sdm/laporsdm', Request::path()) ? 'active' : '' }}">Laporan Tahunan</a></li>
                <li><a href="{{ route('sdm.informasi.index') }}" class="{{ Str::is('sdm/informasi', Request::path()) ? 'active' : '' }}">Informasi</a></li>
                <li><a href="{{ route('sdm.agenda.index') }}" class="{{ Str::is('sdm/agenda*', Request::path()) ? 'active' : '' }}">Agenda</a></li>
                <li><a href="{{ route('sdm.tasaruf.pengajuansdm') }}" class="{{ Str::is('sdm/laporan/pengajuan*', Request::path()) ? 'active' : '' }}">Pengajuan Data</a></li>

            </ul>
        </li>
<?php } ?>

<?php
        if(auth()->user()->status === 'A'  || auth()->user()->status === 'KU') {
            ?>


        <li class="menu-title mt-30">
            <span>Keuangan</span>
        </li>

        <li class="has-child  {{ Str::is('keuangan/persetujuan*', Request::path())
            || Str::is('keuangan/pengajuan*', Request::path())
                 ? 'open' : '' }}">
            <a href="#" class="{{ Str::is('keuangan/persetujuan*', Request::path()) 
                || Str::is('keuangan/pengajuan*', Request::path())
   
                ? 'active' : '' }}">
                <span class="nav-icon uil uil-thumbs-up"></span>
                <span class="menu-text text-initial">Approved</span>
                <span class="toggle-icon"></span>
            </a> 
            <ul>
            <li><a href="{{ route('keuangan.kasbon.indexkeuangan') }}" class="{{ Str::is('keuangan/persetujuan/kasbon*', Request::path()) ? 'active' : '' }}"> Kasbon</a></li>
            <li><a href="{{ route('keuangan.tasaruf.pengajuanku') }}" class="{{ Str::is('keuangan/pengajuan*', Request::path()) ? 'active' : '' }}"> Pengajuan Data</a></li>
             
            </ul>
        </li>


            <li class="has-child {{ (Str::is('keuangan/mutasi*', Request::path()) || Str::is('keuangan/laporan*', Request::path()) ) ? 'open' : '' }}">
    <a href="#" class="{{ (Str::is('keuangan/mutasi*', Request::path()) || Str::is('keuangan/laporan*', Request::path()) ) ? 'active' : '' }}">
            <span class="nav-icon uil uil-books"></span>
                <span class="menu-text text-initial">Jurnal</span>
                <span class="toggle-icon"></span>
            </a>
            <ul>
                <li><a href="{{ route('keuangan.mutasi.indexkeuangan') }}" class="{{ Str::is('keuangan/mutasi*', Request::path()) ? 'active' : '' }}"> Jurnal Memorial</a></li>
                <li><a href="{{ route('keuangan.mutasi.laporan') }}" class="{{ Str::is('keuangan/laporan*', Request::path()) ? 'active' : '' }}">Laporan Keuangan</a></li>
            </ul>
        </li>


        <li class="menu-title mt-30">
            <span>Laporan</span>
        </li>
     
        <li>
             <a href="{{ route('keuangan.mutasi.laporan') }}" class="{{ Str::is('perkara', Request::path()) ? 'active' : '' }}">
                <span class="nav-icon uil uil-question-circle"></span>
                <span class="menu-text">Laporan</span>
            </a>
        </li>

        <li>
            <?php } ?>

        @else

   

                  
                     <li class="has-Menu">
                         <a href="{{ route('index') }}" class="{{ Request::is('dashboards/*') ? 'active':'' }}">  
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
                        <a href="{{ route('infografis') }}" class="{{ Request::is('dashboards/*') ? 'active':'' }}">
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
