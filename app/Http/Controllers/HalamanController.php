<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Tahun;
use App\Models\Muzaki;
use App\Models\Proposal;
use App\Models\Kas;
use App\Models\Laporan;
use App\Models\Informasi;
use App\Models\Agenda;
use App\Models\AkunKeuangan;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use PDF;


class HalamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $tahun;

    public function __construct()
    {
        $tahunaktif = Tahun::where('status', 'A')->first();
        $this->tahun = $tahunaktif ? $tahunaktif->nama_tahun : null;
    }
    


    public function laporantahunan(request $request)
    {
 
        $data['title'] = "Laporan Tahunan";
        $limit = request('limit', 10);
        $data['data'] = Laporan::orderBy('tahun', 'DESC')->paginate($limit);
        return view('laporantahunan', $data);

    }

    public function cekproposal(request $request)
    {
 
        $data['title'] = "Cek Proposal";
       
        return view('proposal',$data);

    }

    public function cekstoran(request $request)
    {
 
        $data['title'] = "Cek Storan";
       
        return view('storan',$data);

    }

    public function cekproposalact(request $request)
    {
 
        $data['title'] = "Cek Proposal";
        $kode = $request->kode;
        $nik = $request->nik;

        $data['data'] = Proposal::where('nomor_proposal',$kode)->where('nik',$nik)->first();

     
        return view('proposalact',$data);

    }

    public function download(Request $request, $id, $random, $userr)
    {
        $data = Kas::join('akunkeuangan', 'kas.debet', '=', 'akunkeuangan.id')
            ->join('muzaki', 'kas.id_muzaki', '=', 'muzaki.id')
            ->select('muzaki.nama_muzaki', 'kas.id', 'kas.debet', 'kas.kredit', 'kas.keterangan',
                'akunkeuangan.uraian', 'kas.jumlah', 'kas.tanggal', 'kas.kode_transaksi',
                'muzaki.npwp', 'muzaki.npwz', 'muzaki.hp', 'muzaki.email', 'muzaki.telp', 'muzaki.alamat')
            ->orderBy('kas.id', 'DESC')
            ->orderBy('kas.tanggal', 'DESC')
            ->where('kas.pengirim', '=', 'PG')
            ->where('kas.kode_transaksi', '=', $id)
            ->where('kas.id_muzaki', '=', $userr)
            ->where('kas.type', '=', 'SPJ')
            ->where('kas.tahun', '=', $this->tahun)
            ->first();
    
        // Periksa apakah data tidak kosong sebelum melakukan iterasi

        foreach ($data as $cetak) { 
            $via = AkunKeuangan::find($data->kredit);
            $data->kredituraian = $via ? $via->uraian : null;              
        }

        $nomor = $data->kode_transaksi;
        $muzaki = $data->nama_muzaki;
        $keterangan = $data->keterangan;
       
           $text = "
               Nomor Transaksi: $nomor
               Muzaki :  $muzaki
               Keterangan : $keterangan
           ";
       
           $qrCode = QrCode::size(300)->generate($text);
       
           $data = [
               'data' => $data,
               'qrCode' => $qrCode
           ];

           $pdf = PDF::loadView('cetak', $data)->setPaper('A4', 'portrait');
           return $pdf->stream('transaksi.pdf');
    
    }
    
    public function cekstoranact(Request $request)
    {
        $data['title'] = "Cek Setoran";
        $kode = $request->kode;
        $nik = $request->nik;
    
        $muzaki = Muzaki::where('npwz', $kode)
                        ->where('nik', $nik)
                        ->first();
    
        if ($muzaki) {
            $data['data'] = $muzaki;
    
            $kas = Kas::where('id_muzaki', $muzaki->id)
                        ->where('pengirim', 'PG')
                        ->where('type', 'SPJ')
                        ->get();
    
            if ($kas) {
                $data['kas'] = $kas;
            } else {
                $data['kas'] = null; // Tidak ada data kas yang ditemukan
            }
        } else {
            $data['data'] = null; // Tidak ada data muzaki yang ditemukan
            $data['kas'] = null;
        }
    
        return view('storanact', $data);
    }
    
    




    public function rekappendistribusian(request $request)
    {
        $data['title'] = "Rekap Pendistribusian";

        $bulan = date("n");
        $tahunAktif = $this->tahun;
        
        $data['program'] = AkunKeuangan::orderBy('uraian','ASC')
        ->where('jenis_akun','like','%PROGRAM%')->where('level','3')->get();

        foreach ($data['program'] as $d) {



            $debet = DB::table('kas')
            ->join('akunkeuangan', 'akunkeuangan.id', '=', 'kas.debet')
            ->where('akunkeuangan.kode', 'like', $d->kode . '%')
            ->whereYear('kas.tanggal', $tahunAktif)
            ->whereMonth('kas.tanggal', '<=', $bulan) // Menyesuaikan operator untuk menyertakan bulan ini juga
            ->sum('kas.jumlah');

            $kredit = DB::table('kas')
            ->join('akunkeuangan', 'akunkeuangan.id', '=', 'kas.kredit')
            ->where('akunkeuangan.kode', 'like', $d->kode . '%')
            ->whereYear('kas.tanggal', $tahunAktif)
            ->whereMonth('kas.tanggal', '<=', $bulan) // Menyesuaikan operator untuk menyertakan bulan ini juga
            ->sum('kas.jumlah');


            $d->debet = $debet;
            $d->kredit = $kredit;

            $d->saldo = $debet - $kredit; 

        }


        return view('distribusi', $data);

    }

    public function rekappengumpulan(request $request)
    {
        $data['title'] = "Rekap Pengumpulan";
        $limit = $request->input('limit', 100);
        $bulan = date("n");

        $data['data'] = Kas::join('muzaki', 'kas.dinas', '=', 'muzaki.id')
                        ->where('kas.tahun', $this->tahun)
                        ->whereMonth('kas.tanggal', $bulan)
                        ->select('kas.dinas', 'muzaki.nama_muzaki')
                        ->groupBy('kas.dinas', 'muzaki.nama_muzaki')
                        ->orderBy('muzaki.nama_muzaki', 'ASC')
                        ->paginate($limit);

           

        foreach ($data['data'] as $datalalu) {
        
            $tgl = Kas::where('kas.dinas', $datalalu->dinas)
            ->whereMonth('kas.tanggal', $bulan)
            ->orderby('kas.tanggal','DESC')
            ->first();
            $datalalu->tanggal = $tgl ? $tgl->tanggal : null;      



            
            $bulanlalu = Kas::whereMonth('kas.tanggal', '<', $bulan)
            ->where('kas.pengirim', 'PG')->where('kas.type','SPJ')
            ->whereYear('kas.tanggal',  $this->tahun)
            ->where('kas.dinas', $datalalu->dinas)
            ->select(\DB::raw('SUM(kas.jumlah) as total_nominal_kemarin'))->first();
            $datalalu->jmlblnkemarin = $bulanlalu ? $bulanlalu->total_nominal_kemarin : null;              

            $zakat = Kas::join('akunkeuangan', 'kas.kredit', '=', 'akunkeuangan.id')->where('akunkeuangan.jenis_akun','like','%ZKT%')
            ->where('kas.pengirim', 'PG')->where('kas.type','SPJ')
            ->whereYear('kas.tanggal',  $this->tahun)
            ->where('kas.dinas', $datalalu->dinas)
            ->whereMonth('kas.tanggal',$bulan)->select(\DB::raw('SUM(kas.jumlah) as zakattotal'))->first();
            
            $datalalu->zakattotal = $zakat ? $zakat->zakattotal : null;              

            $infaq = Kas::join('akunkeuangan', 'kas.kredit', '=', 'akunkeuangan.id')
            ->where('kas.pengirim', 'PG')->where('kas.type','SPJ')
            ->whereYear('kas.tanggal',  $this->tahun)
            ->where('akunkeuangan.jenis_akun','like','%%IFQ%%')
            ->whereMonth('kas.tanggal', $bulan)
            ->where('kas.dinas', $datalalu->dinas)
            ->select(\DB::raw('SUM(kas.jumlah) as infaqtotal'))
            ->first();
         
            $datalalu->infaqtotal = $infaq ? $infaq->infaqtotal : null;        

        }
    
        return view('pengumpulan', $data);
    }

    public function rekap(){
        $data['title'] = "Executive Summary";
    
        $bulan = date("n"); 
        $tahun_sekarang = $this->tahun;
    
        $data['pengumpulan'] = Kas::where('pengirim','PG')->where('type','SPJ')->where('tahun',$tahun_sekarang)->sum('jumlah');
        $data['jmlpengumpulan'] = Kas::where('pengirim','PG')->where('type','SPJ')->where('tahun',$tahun_sekarang)->count();

   
        $data['distribusi'] = Kas::where('pengirim','P')->where('type','SPJ')->where('tahun',$tahun_sekarang)->sum('jumlah');
        $data['jmldistribusi'] = Kas::where('pengirim','P')->where('type','SPJ')->where('tahun',$tahun_sekarang)->count();

        $data['data'] = Akunkeuangan::where('kode', 'like', '1%%')->where('level','3')->orderBy('kode', 'ASC')->get();

   
    $data['dataaktifa'] = Akunkeuangan::where('kode', 'like', '1%%')->where('level','3')->orderBy('kode', 'ASC')->get();
    $data['datapasifa'] = Akunkeuangan::where('kode', 'like', '2%%')->where('level','3')->orderBy('kode', 'ASC')->get();
    $data['datapasifaa'] = Akunkeuangan::where('kode', 'like', '3%%')->where('level','3')->orderBy('kode', 'ASC')->get();
 

    foreach ($data['dataaktifa'] as $item) {
        $akun = $kredit = 0;

        for ($i = 1; $i <= $bulan; $i++) {

            $akun += DB::table('kas')
            ->join('akunkeuangan', 'akunkeuangan.id', '=', 'kas.debet') // Join tabel 'akunkeuangan'
            ->where('akunkeuangan.kode', 'like', '1%%') // Filter kode akun yang sesuai dengan pola level 4
            ->whereYear('kas.tanggal', $tahun_sekarang)
            ->whereMonth('kas.tanggal', $i)
            ->sum('kas.jumlah');
            $kredit += DB::table('kas')
            ->join('akunkeuangan', 'akunkeuangan.id', '=', 'kas.kredit') // Join tabel 'akunkeuangan'
            ->where('akunkeuangan.kode', 'like', '1%%') // Filter kode akun yang sesuai dengan pola level 4
            ->whereYear('kas.tanggal', $tahun_sekarang)
            ->whereMonth('kas.tanggal', $i)
            ->sum('kas.jumlah');


        }

        $item->ketdebet = $akun ?: null;
        $item->ketkredit = $kredit ?: null;


    }


    foreach ($data['datapasifa'] as $item) {
        $akun = $kredit = 0;

        for ($i = 1; $i <= $bulan; $i++) {

            $akun += DB::table('kas')
            ->join('akunkeuangan', 'akunkeuangan.id', '=', 'kas.debet') // Join tabel 'akunkeuangan'
            ->where('akunkeuangan.kode', 'like', '2%%') // Filter kode akun yang sesuai dengan pola level 4
            ->whereYear('kas.tanggal', $tahun_sekarang)
            ->whereMonth('kas.tanggal', $i)
            ->sum('kas.jumlah');
            $kredit += DB::table('kas')
            ->join('akunkeuangan', 'akunkeuangan.id', '=', 'kas.kredit') // Join tabel 'akunkeuangan'
            ->where('akunkeuangan.kode', 'like', '2%%') // Filter kode akun yang sesuai dengan pola level 4
            ->whereYear('kas.tanggal', $tahun_sekarang)
            ->whereMonth('kas.tanggal', $i)
            ->sum('kas.jumlah');


        }
 
        $item->ketdebet = $akun ?: null;
        $item->ketkredit = $kredit ?: null;


    }


    foreach ($data['datapasifaa'] as $item) {
        $akun = $kredit = 0;

        for ($i = 1; $i <= $bulan; $i++) {

            $akun += DB::table('kas')
            ->join('akunkeuangan', 'akunkeuangan.id', '=', 'kas.debet') // Join tabel 'akunkeuangan'
            ->where('akunkeuangan.kode', 'like', '3%%') // Filter kode akun yang sesuai dengan pola level 4
            ->whereYear('kas.tanggal', $tahun_sekarang)
            ->whereMonth('kas.tanggal', $i)
            ->sum('kas.jumlah');
            $kredit += DB::table('kas')
            ->join('akunkeuangan', 'akunkeuangan.id', '=', 'kas.kredit') // Join tabel 'akunkeuangan'
            ->where('akunkeuangan.kode', 'like', '3%%') // Filter kode akun yang sesuai dengan pola level 4
            ->whereYear('kas.tanggal', $tahun_sekarang)
            ->whereMonth('kas.tanggal', $i)
            ->sum('kas.jumlah');


        }

        $item->ketdebet = $akun ?: null;
        $item->ketkredit = $kredit ?: null;


    }


    $data['dataku'] = Akunkeuangan::where('kode', 'like', '2%%')->where('level','3')->orWhere(function ($query) {
        $query->where('kode', 'like', '3%%')->where('level', '2');
    })->orderBy('kode', 'ASC')->get();

  



    foreach ($data['dataku'] as $item) {
        $akun = $kredit = 0;
        $pema = $pemb = 0;
        $pemaa = $pemba = 0;
            if($item->kode == '3.1')
            {
                $coda = $item->cod = '1';
            } else if($item->kode == '3.2') {
                $coda =  $item->cod = '2';
            } else if($item->kode == '3.3') {
                $coda =  $item->cod = '3';
            } else if($item->kode == '3.5') {
                $coda = $item->cod = '5';
            } else {
                $coda =  $item->cod = '6';
            }
        $codafil = "4.$coda";
        $codafila = "5.$coda";

        $pema += DB::table('kas')
            ->join('akunkeuangan', 'akunkeuangan.id', '=', 'kas.debet')
            ->where('akunkeuangan.kode', 'like', $codafil . '%%')
            ->where('kas.tahun', $tahun_sekarang)
            ->whereMonth('kas.tanggal','<=',$bulan)
            ->sum('kas.jumlah');
        $pemb += DB::table('kas')
            ->join('akunkeuangan', 'akunkeuangan.id', '=', 'kas.kredit')
            ->where('akunkeuangan.kode', 'like', $codafil . '%%')
            ->whereYear('kas.tanggal', $tahun_sekarang)
            ->whereMonth('kas.tanggal','<=',$bulan)
            ->sum('kas.jumlah');
            

        $pemaa += DB::table('kas')
            ->join('akunkeuangan', 'akunkeuangan.id', '=', 'kas.debet')
            ->where('akunkeuangan.kode', 'like', $codafila . '%%')
            ->where('kas.tahun', $tahun_sekarang)
            ->whereMonth('kas.tanggal','<=',$bulan)
            ->sum('kas.jumlah');
        $pemba += DB::table('kas')
            ->join('akunkeuangan', 'akunkeuangan.id', '=', 'kas.kredit')
            ->where('akunkeuangan.kode', 'like', $codafila . '%%')
            ->whereYear('kas.tanggal', $tahun_sekarang)
            ->whereMonth('kas.tanggal','<=',$bulan)
            ->sum('kas.jumlah');


            $cek = substr($item->kode, 0, 1);
            if($cek=='3') {
            $item->pema = $pema ?: null;
            $item->pemb = $pemb ?: null;   
            $item->pemaa = $pemaa ?: null;
            $item->pemba = $pemba ?: null;    
            }

        for ($i = 1; $i <= $bulan; $i++) {
            list($akun, $kredit) = $this->processKasData($item, $i, $tahun_sekarang, $akun, $kredit);
        }


        $item->ketdebet = $akun ?: null;
        $item->ketkredit = $kredit ?: null;
        if($cek=='3') {
        $item->saldo = $akun - $kredit;
        } else {
        $item->saldo = $kredit - $akun ;   
        }
                        
        
    }



    foreach ($data['data'] as $item) {
        $akun = $kredit = 0;

        for ($i = 1; $i <= $bulan; $i++) {
            list($akun, $kredit) = $this->processKasData($item, $i, $tahun_sekarang, $akun, $kredit);
        }

        $item->ketdebet = $akun ?: null;
        $item->ketkredit = $kredit ?: null;
    }
    
        return view('rekap', $data);
    }
    
  
    
    private function processKasData($item, $i, $tahun_sekarang, $akun, $kredit)
{
    $akun += DB::table('kas')
        ->join('akunkeuangan', 'akunkeuangan.id', '=', 'kas.debet')
        ->where('akunkeuangan.kode', 'like', $item->kode . '%%')
        ->whereYear('kas.tanggal', $tahun_sekarang)
        ->whereMonth('kas.tanggal', $i)
        ->sum('kas.jumlah');

    $kredit += DB::table('kas')
        ->join('akunkeuangan', 'akunkeuangan.id', '=', 'kas.kredit')
        ->where('akunkeuangan.kode', 'like', $item->kode . '%%')
        ->whereYear('kas.tanggal', $tahun_sekarang)
        ->whereMonth('kas.tanggal', $i)
        ->sum('kas.jumlah');

    return [$akun, $kredit];
}







    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function infografis()
    {
        $data['title'] = "Homepage";
        $data['description'] = "Homepage";
    

$data['allproposal'] = Proposal::orderBy('id', 'DESC')
        ->orderBy('tanggal_masuk', 'DESC')
        ->where('tahun', $this->tahun)
        ->count();

$data['belum'] = Proposal::orderBy('id', 'DESC')
        ->orderBy('tanggal_masuk', 'DESC')
        ->where('status', "B")
        ->where('tahun', $this->tahun)->count();


$data['onproses'] = Proposal::orderBy('id', 'DESC')
        ->orderBy('tanggal_masuk', 'DESC')
        ->where('status', "O")
        ->where('tahun', $this->tahun)->count();

$data['terima'] = Proposal::orderBy('id', 'DESC')
        ->orderBy('tanggal_masuk', 'DESC')
        ->where('status', "A")
        ->where('tahun', $this->tahun)->count();

$data['tolak'] = Proposal::orderBy('id', 'DESC')
        ->orderBy('tanggal_masuk', 'DESC')
        ->where('status', "N")
        ->where('tahun', $this->tahun)->count();


        $data['belumtertasarufkan'] = Proposal::orderBy('id', 'DESC')
        ->orderBy('tanggal_masuk', 'DESC')
        ->where('tahun', $this->tahun)
        ->where('status','A')
        ->whereNotExists(function ($query) {
            $query->select('id')
                ->from('kas')
                ->where('pengirim','P')
                ->where('type','SPJ')
                ->whereColumn('kas.id_muzaki', 'proposal.id');
        })->count();
$data['sudahtertasarufkan'] =Kas::join('proposal', 'kas.id_muzaki', '=', 'proposal.id')
        ->select(
            'kas.id','kas.kode_transaksi', 'kas.tanggal', 'kas.jenis_kas','kas.file', 
            'proposal.nomor_proposal','proposal.proposal','proposal.nama_pemohon','proposal.hp'
        )
        ->where('kas.tahun', $this->tahun)
        ->where('kas.pengirim', 'P')
        ->where('kas.type', 'SPJ')->count();

        $zakatData = [];
        $infaqData = [];    
        // Loop untuk mengambil data Zakat dari database
        
        
        for ($row = 1; $row <= 12; $row++) {
            // Query untuk mengambil data Zakat
            $zakat = Kas::join('akunkeuangan', 'kas.kredit', 'akunkeuangan.id')
                ->whereMonth('kas.tanggal', $row)
                ->where('kas.pengirim', 'PG')
                ->where('kas.type', 'SPJ')
                ->where('kas.tahun', $this->tahun)
                ->where('akunkeuangan.jenis_akun', 'like', '%ZKT%')
                ->sum('kas.jumlah');
        
            // Query untuk mengambil data Infaq
            $infaq = Kas::join('akunkeuangan', 'kas.kredit', 'akunkeuangan.id')
                ->whereMonth('tanggal', $row)
                ->where('pengirim', 'PG')
                ->where('type', 'SPJ')
                ->where('tahun', $this->tahun)
                ->where('akunkeuangan.jenis_akun', 'like', '%IFQ%')
                ->sum('kas.jumlah');
        
            $zakatData[] = $zakat;
            $infaqData[] = $infaq;
        }
        
      
        
        
            // Menambahkan data Zakat dan Infaq ke dalam variabel $data
            $data['zakatData'] = $zakatData;
            $data['infaqData'] = $infaqData;

                
    

        // Kemudian, gunakan nilai yang telah diperiksa ke dalam pembuatan grafik
        return view('grafis',$data);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function blog(Request $request)
    {
        $data['title'] = "Informasi";
        $limit = request('limit', 10);
        $data['data'] = Informasi::orderBy('id', 'DESC')->paginate($limit);
        return view('informasi', $data);
    }

    public function detailBlog($id)
{
    $blog = Informasi::find($id);
    $data['title'] = $blog->judul;
    $data['data'] = $blog;
    return view('detailinformasi', $data);
}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function agenda()
    {
        $data['title'] = "Data Agenda";
        $data['data'] = Agenda::all()->where('status','Aktif');
        return view('agenda', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perkecamatan($id,$kecamatan)
    {
       
        $data['title'] = "Data Perkecamatan";

        $tahunAktif = $this->tahun;
        $jenisAkun = ['cerdas', 'peduli', 'makmur', 'taqwa', 'sehat'];
    
        foreach ($jenisAkun as $jenis) {
            $debet = DB::table('kas')
            ->join('akunkeuangan', 'akunkeuangan.id', '=', 'kas.debet')
            ->join('proposal', 'proposal.id', '=', 'kas.id_muzaki')
            ->where('proposal.kecamatan',$id)
            ->where('akunkeuangan.jenis_akun', 'like', '%' . $jenis . '%')
                ->whereYear('kas.tanggal', $tahunAktif)
                ->sum('kas.jumlah');
    
            $kredit = DB::table('kas')
                ->join('akunkeuangan', 'akunkeuangan.id', '=', 'kas.kredit')
                ->join('proposal', 'proposal.id', '=', 'kas.id_muzaki')
                ->where('proposal.kecamatan',$id)
                ->where('akunkeuangan.jenis_akun', 'like', '%' . $jenis . '%')
                    ->whereYear('kas.tanggal', $tahunAktif)
                ->sum('kas.jumlah');
    
            $data['jml' . $jenis] = DB::table('kas')
                ->join('akunkeuangan', 'akunkeuangan.id', '=', 'kas.debet')
                ->join('proposal', 'proposal.id', '=', 'kas.id_muzaki')
                ->where('proposal.kecamatan',$id)
                    ->where('akunkeuangan.jenis_akun', 'like', '%' . $jenis . '%')
                ->whereYear('kas.tanggal', $tahunAktif)
                ->count();
    
            $data['saldo' . $jenis] = $debet - $kredit;
        }
        $data['kecamatan'] = $kecamatan;
        return view('detailkecamatan', $data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
     public function wakirim()
     {
         $proposals = Kas::
         join('muzaki','kas.id_muzaki','=','muzaki.id')
         ->where('kas.wa','N')
         ->where('kas.pengirim','PG')
         ->whereRaw('kas.id % 2 = 1') // Mengambil data dengan ID ganjil
         ->where('kas.type','SPJ')
         ->whereRaw('LENGTH(muzaki.hp) BETWEEN 9 AND 13') // Panjang karakter 10-13
         ->orderBy('kas.id', 'ASC')
         ->first(); // Mengambil semua proposal
 
         if ($proposals){
         $randomString = Str::random(50);
         $phoneNumber = $proposals->hp;
         $jumlah = $proposals->jumlah;
         $kas = $proposals->kode_transaksi;
         $muzaki = $proposals->id_muzaki;
         $jmlh = number_format($jumlah, 0, ',', '.');
         $nama = $proposals->nama_muzaki;
         $tgl = $proposals->tanggal;
         $tanggal = Carbon::parse($tgl)->format('d F Y');
         $phoneNumberWithoutZero = ltrim($phoneNumber, '0');
         $phoneNumberWithCountryCode = "62" . $phoneNumberWithoutZero;

         
         $dataSending = [
             "api_key" => "JVVEQVNYGOWIZ2HF",
             "number_key" => "ycrjXnF2mkujBIGf",
             "phone_no" => $phoneNumberWithCountryCode,
             "message" => "
 _Assalammu'alaikum wr wb_
 Terima kasih atas pembayaran ZIS 
 Tanggal *$tanggal*
 Sebesar *Rp. $jmlh,-* atas nama sdr/i  $nama
 Semoga Allah SWT memberikan pahala atas ZIS yang ditunaikan, menjadikan berkah dan suci atas harta yang lainnya. Berikut juga kami lampirkan bukti setor ZIS.
 
 Bukti Pembayaran bisa anda download di link berikut ini :
 http://masboy.baznasboyolali.or.id/cek/download/$kas/$randomString/$muzaki
 
 Untuk cek setoran bulan-bulan sebelumnya, langsung klik 
 http://masboy.baznasboyolali.or.id/cek/storan
 
 Apabila ada setoran tidak sesuai, atau ada data yang salah silakah hubungi admin bidang pengumpulan. Hery wa.me/62895393234144
 
 *BAZNAS KABUPATEN BOYOLALI*
 _Wassalammu'alaikum wr wb_
 
             "
         ];
     
       
             $curl = curl_init();
             curl_setopt_array($curl, [
                 CURLOPT_URL => 'https://api.watzap.id/v1/send_message',
                 CURLOPT_RETURNTRANSFER => true,
                 CURLOPT_ENCODING => '',
                 CURLOPT_MAXREDIRS => 10,
                 CURLOPT_TIMEOUT => 0,
                 CURLOPT_FOLLOWLOCATION => true,
                 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                 CURLOPT_CUSTOMREQUEST => 'POST',
                 CURLOPT_POSTFIELDS => json_encode($dataSending),
                 CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
             ]);
             $response = curl_exec($curl);
             curl_close($curl);
            echo $response;
             Kas::where('kode_transaksi', $kas)->where('id_muzaki',$muzaki)
             ->update([
                 'wa' => "S",
             ]);

         } else {
             echo"data kosong";
         }
        
     }
 
     public function wakirima()
     {
         $proposals = Kas::
         join('muzaki','kas.id_muzaki','=','muzaki.id')
         ->where('kas.wa','N')
         ->where('kas.pengirim','PG')
         ->whereRaw('kas.id % 2 = 0') // Mengambil data dengan ID genap
         ->whereRaw('LENGTH(muzaki.hp) BETWEEN 9 AND 13') // Panjang karakter 10-13
         ->where('kas.type','SPJ')
         ->orderBy('kas.id', 'ASC')
         ->first(); // Mengambil semua proposal
 
         if ($proposals){
         $randomString = Str::random(50);
         $phoneNumber = $proposals->hp;
         $jumlah = $proposals->jumlah;
         $kas = $proposals->kode_transaksi;
         $muzaki = $proposals->id_muzaki;
         $jmlh = number_format($jumlah, 0, ',', '.');
         $nama = $proposals->nama_muzaki;
         $tgl = $proposals->tanggal_masuk;
         $tanggal = Carbon::parse($tgl)->format('d F Y');
         $phoneNumberWithoutZero = ltrim($phoneNumber, '0');
         $phoneNumberWithCountryCode = "62" . $phoneNumberWithoutZero;

         
         $dataSending = [
             "api_key" => "JVVEQVNYGOWIZ2HF",
             "number_key" => "Lq65TspYK0Z0rFyA",
             "phone_no" => $phoneNumberWithCountryCode,
             "message" => "
 _Assalammu'alaikum wr wb_
 Terima kasih atas pembayaran ZIS 
 Tanggal *$tanggal*
 Sebesar *Rp. $jmlh,-* atas nama sdr/i  $nama
 Semoga Allah SWT memberikan pahala atas ZIS yang ditunaikan, menjadikan berkah dan suci atas harta yang lainnya. Berikut juga kami lampirkan bukti setor ZIS.
 
 Bukti Pembayaran bisa anda download di link berikut ini :
 http://masboy.baznasboyolali.or.id/cek/download/$kas/$randomString/$muzaki
 
 Untuk cek setoran bulan-bulan sebelumnya, langsung klik 
 http://masboy.baznasboyolali.or.id/cek/storan
 
 Apabila ada setoran tidak sesuai, atau ada data yang salah silakah hubungi admin bidang pengumpulan. Hery wa.me/62895393234144
 
 *BAZNAS KABUPATEN BOYOLALI*
 _Wassalammu'alaikum wr wb_
 
             "
         ];
     
       
             $curl = curl_init();
             curl_setopt_array($curl, [
                 CURLOPT_URL => 'https://api.watzap.id/v1/send_message',
                 CURLOPT_RETURNTRANSFER => true,
                 CURLOPT_ENCODING => '',
                 CURLOPT_MAXREDIRS => 10,
                 CURLOPT_TIMEOUT => 0,
                 CURLOPT_FOLLOWLOCATION => true,
                 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                 CURLOPT_CUSTOMREQUEST => 'POST',
                 CURLOPT_POSTFIELDS => json_encode($dataSending),
                 CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
             ]);
             $response = curl_exec($curl);
             curl_close($curl);
             echo $response;

             Kas::where('kode_transaksi', $kas)->where('id_muzaki',$muzaki)
             ->update([
                 'wa' => "S",
             ]);

         } else {
             echo"data kosong";
         }
        
     }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
