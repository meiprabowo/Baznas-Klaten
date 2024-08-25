<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AkunKeuangan;
use App\Models\Kasbon;
use App\Models\User;
use App\Models\Kas;
use Validator;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Exports\SdmumumExport;
use App\Exports\MutasiPExport;
use App\Exports\JurnalExport;

 
class MutasiController extends Controller
{

    public function index()
    {
        $data['title'] = "Master Mutasi SDM umum";
        $limit = request('limit', 10);
        
        
        $data['data']=Kas::join('akunkeuangan', 'kas.kredit', '=', 'akunkeuangan.id')
        ->select('kas.id', 'kas.kredit','kas.keterangan', 'akunkeuangan.uraian', 'kas.jumlah', 'kas.tanggal','kas.file', 'kas.kode_transaksi')
        ->orderBy('kas.id','DESC')
        ->orderBy('kas.tanggal', 'DESC')
        ->where('kas.pengirim', 'SDM')
        ->where('kas.type', 'M')
        ->where('kas.tahun', session('tahun_aktif')) ->paginate($limit);

         return view('sdm.mutasi.index', $data);         
    }
    

    public function laporan()
    {
         $data['title'] = "Master Mutasi SDM umum";
         $data['program'] = AkunKeuangan::orderBy('uraian','ASC')->where('level','3')->get();
         return view('keuangan.laporan.index', $data);         
    }

    public function laporanpen()
    {
         $data['title'] = "Master Mutasi SDM umum";
         $data['program'] = AkunKeuangan::orderBy('uraian','ASC')->where('level','3')->get();
         return view('pendistribusian.laporan.index', $data);         
    }


    public function laporanbukubesar(Request $request)
    {
        $data['title'] = "Laporan Buku Besar";
        $key = $request->input('detail_program'); // Mendapatkan query pencarian dari input form
        $bulan = $request->input('bulan'); // Mendapatkan query pencarian dari input form
        
        // Ambil tahun dari tanggal sekarang
        $tahun_sekarang = session('tahun_aktif');
        
        // Buat array untuk menyimpan data dari bulan Januari sampai bulan yang dipilih
        $data_bulan = [];
        for ($i = 1; $i <= $bulan; $i++) {
            $data_bulan[] = [
                'bulan' => $i,
                'tahun' => $tahun_sekarang
            ];
        }
    
        // Query untuk mengambil data
        $mergedData = collect(); // Inisialisasi koleksi kosong
        foreach ($data_bulan as $item) {
            $debetData = Kas::select(
                    'kas.*',
                    'kas.jumlah as ketdebet',
                    DB::raw('0 as ketkredit')
                )
                ->join('akunkeuangan', 'kas.kredit', '=', 'akunkeuangan.id')
                ->whereYear('kas.tanggal', $item['tahun'])
                ->whereMonth('kas.tanggal', $item['bulan'])
                ->where('debet', $key)
                ->get();
                
            $kreditData = Kas::select(
                    'kas.*',
                    'kas.jumlah as ketkredit',
                    DB::raw('0 as ketdebet')
                )
                ->join('akunkeuangan', 'kas.debet', '=', 'akunkeuangan.id')
                ->whereYear('kas.tanggal', $item['tahun'])
                ->whereMonth('kas.tanggal', $item['bulan'])
                ->where('kredit', $key)
                ->get();
    
            $mergedData = $mergedData->merge($debetData)->merge($kreditData);
        }
    
        // Lakukan pengurutan data berdasarkan tanggal secara keseluruhan
        $sortedData = $mergedData->sortBy('tanggal');
    
        $data['data'] = $sortedData;
        $data['awal'] = Kas::where('pengirim', 'SA')
        ->where('type', 'TU')
        ->where('tahun', session('tahun_aktif'))
        ->where(function($query) use ($key) {
            $query->where('debet', $key)
                  ->orWhere('kredit', $key);
        })
        ->first();

        
        return view('keuangan.laporan.bukubesar', $data);
    }
    

    public function laporanbukubesarpen(Request $request)
    {
        $data['title'] = "Laporan Buku Besar";
        $key = $request->input('detail_program'); // Mendapatkan query pencarian dari input form
        $bulan = $request->input('bulan'); // Mendapatkan query pencarian dari input form
        
        // Ambil tahun dari tanggal sekarang
        $tahun_sekarang = session('tahun_aktif');
        
        // Buat array untuk menyimpan data dari bulan Januari sampai bulan yang dipilih
        $data_bulan = [];
        for ($i = 1; $i <= $bulan; $i++) {
            $data_bulan[] = [
                'bulan' => $i,
                'tahun' => $tahun_sekarang
            ];
        }
    
        // Query untuk mengambil data
        $mergedData = collect(); // Inisialisasi koleksi kosong
        foreach ($data_bulan as $item) {
            $debetData = Kas::select(
                    'kas.*',
                    'kas.jumlah as ketdebet',
                    DB::raw('0 as ketkredit')
                )
                ->join('akunkeuangan', 'kas.kredit', '=', 'akunkeuangan.id')
                ->whereYear('kas.tanggal', $item['tahun'])
                ->whereMonth('kas.tanggal', $item['bulan'])
                ->where('debet', $key)
                ->get();
                
            $kreditData = Kas::select(
                    'kas.*',
                    'kas.jumlah as ketkredit',
                    DB::raw('0 as ketdebet')
                )
                ->join('akunkeuangan', 'kas.debet', '=', 'akunkeuangan.id')
                ->whereYear('kas.tanggal', $item['tahun'])
                ->whereMonth('kas.tanggal', $item['bulan'])
                ->where('kredit', $key)
                ->get();
    
            $mergedData = $mergedData->merge($debetData)->merge($kreditData);
        }
    
        // Lakukan pengurutan data berdasarkan tanggal secara keseluruhan
        $sortedData = $mergedData->sortBy('tanggal');
    
        $data['data'] = $sortedData;
        $data['awal'] = Kas::where('pengirim', 'SA')
        ->where('type', 'TU')
        ->where('tahun', session('tahun_aktif'))
        ->where(function($query) use ($key) {
            $query->where('debet', $key)
                  ->orWhere('kredit', $key);
        })
        ->first();

        
        return view('pendistribusian.laporan.bukubesar', $data);
    }
    

    
    

    public function laporanbukubesara(Request $request)
    {
        $data['title'] = "Laporan Buku Besar";
        $key = $request->input('detail_program'); // Mendapatkan query pencarian dari input form
        $bulan = $request->input('bulan'); // Mendapatkan query pencarian dari input form
        
        // Ambil tahun dari tanggal sekarang
        $tahun_sekarang = session('tahun_aktif');
        
        // Buat array untuk menyimpan data dari bulan Januari sampai bulan yang dipilih
        $data_bulan = [];
        for ($i = 1; $i <= $bulan; $i++) {
            $data_bulan[] = [
                'bulan' => $i,
                'tahun' => $tahun_sekarang
            ];
        }
    
        // Query untuk mengambil data
        $mergedData = collect(); // Inisialisasi koleksi kosong
        foreach ($data_bulan as $item) {
            $debetData = Kas::select(
                    'kas.*',
                    'kas.jumlah as ketdebet',
                    DB::raw('0 as ketkredit')
                )
                ->join('akunkeuangan', 'kas.kredit', '=', 'akunkeuangan.id')
                ->whereYear('kas.tanggal', $item['tahun'])
                ->whereMonth('kas.tanggal', $item['bulan'])
                ->where('debet', $key)
                ->get();
                
            $kreditData = Kas::select(
                    'kas.*',
                    'kas.jumlah as ketkredit',
                    DB::raw('0 as ketdebet')
                )
                ->join('akunkeuangan', 'kas.debet', '=', 'akunkeuangan.id')
                ->whereYear('kas.tanggal', $item['tahun'])
                ->whereMonth('kas.tanggal', $item['bulan'])
                ->where('kredit', $key)
                ->get();
    
            $mergedData = $mergedData->merge($debetData)->merge($kreditData);
        }
    
        // Lakukan pengurutan data berdasarkan tanggal secara keseluruhan
        $sortedData = $mergedData->sortBy('tanggal');
    
        $data['data'] = $sortedData;
        $data['awal'] = Kas::where('pengirim', 'SA')
        ->where('type', 'TU')
        ->where('tahun', session('tahun_aktif'))
        ->where(function($query) use ($key) {
            $query->where('debet', $key)
                  ->orWhere('kredit', $key);
        })
        ->first();

        
        return view('pendistribusian.laporan.bukubesar', $data);
    }
    




    public function neracapen(Request $request)
    {
        $data['title'] = "Laporan Neraca";
        $bulan = $request->input('bulan');
        $tahun_sekarang = session('tahun_aktif');
    
        $data['data'] = Akunkeuangan::where('kode', 'like', '1%%')->orderBy('kode', 'ASC')->get();
    
       
        $data['dataaktifa'] = Akunkeuangan::where('kode', 'like', '1%%')->where('level','1')->orderBy('kode', 'ASC')->get();
        $data['datapasifa'] = Akunkeuangan::where('kode', 'like', '2%%')->where('level','1')->orderBy('kode', 'ASC')->get();
        $data['datapasifaa'] = Akunkeuangan::where('kode', 'like', '3%%')->where('level','1')->orderBy('kode', 'ASC')->get();
     
    
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
    
    
        $data['dataku'] = Akunkeuangan::where('kode', 'like', '2%%')->orWhere(function ($query) {
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
    
        return view('pendistribusian.laporan.neraca', $data);
    }




public function neraca(Request $request)
{
    $data['title'] = "Laporan Neraca";
    $bulan = $request->input('bulan');
    $tahun_sekarang = session('tahun_aktif');

    $data['data'] = Akunkeuangan::where('kode', 'like', '1%%')->orderBy('kode', 'ASC')->get();

   
    $data['dataaktifa'] = Akunkeuangan::where('kode', 'like', '1%%')->where('level','1')->orderBy('kode', 'ASC')->get();
    $data['datapasifa'] = Akunkeuangan::where('kode', 'like', '2%%')->where('level','1')->orderBy('kode', 'ASC')->get();
    $data['datapasifaa'] = Akunkeuangan::where('kode', 'like', '3%%')->where('level','1')->orderBy('kode', 'ASC')->get();
 

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


    $data['dataku'] = Akunkeuangan::where('kode', 'like', '2%%')->orWhere(function ($query) {
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

    return view('keuangan.laporan.neraca', $data);
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


    
    

    public function indexkeuangan()
    {
        $data['title'] = "Jurnal Memorial";
        $limit = request('limit', 10);
        
        
        $data['data']=Kas::join('akunkeuangan', 'kas.kredit', '=', 'akunkeuangan.id')
        ->select('kas.id', 'kas.kredit','kas.debet','kas.keterangan', 'akunkeuangan.uraian', 'kas.jumlah', 'kas.tanggal','kas.file', 'kas.kode_transaksi')
        ->orderBy('kas.id','DESC')
        ->orderBy('kas.tanggal', 'DESC')
        ->where('kas.pengirim', 'KU')
        ->where('kas.type', 'M')
        ->where('kas.tahun', session('tahun_aktif')) ->paginate($limit);

        foreach ($data['data'] as $item) {
            $akun = DB::table('akunkeuangan')
                ->select('uraian')
                ->where('id', '=', $item->debet)
                ->first();
    
            if ($akun) {
                $item->ketdebet = $akun->uraian; // Menyimpan jumlah pada objek $d
            } else {
                $item->ketdebet = null; // Menyimpan jumlah pada objek $d
            }
        }
    

         return view('keuangan.mutasi.index', $data);         
    }
    

    public function indexpengumpulan()
    {
        $data['title'] = "Master Mutasi Pengumpulan";
        $limit = request('limit', 10);
        
        
        $data['data']=Kas::join('akunkeuangan', 'kas.kredit', '=', 'akunkeuangan.id')
        ->select('kas.id', 'kas.kredit','kas.keterangan', 'akunkeuangan.uraian', 'kas.jumlah', 'kas.tanggal','kas.file', 'kas.kode_transaksi')
        ->orderBy('kas.id','DESC')
        ->orderBy('kas.tanggal', 'DESC')
        ->where('kas.pengirim', 'PG')
        ->where('kas.type', 'M')
        ->where('kas.tahun', session('tahun_aktif')) ->paginate($limit);

         return view('pengumpulan.mutasi.index', $data);

         
    }
    




    public function indexp()
    {
        $data['title'] = "Master Mutasi Pendistribusian";
        $limit = request('limit', 10);
        
        
        $data['data']=Kas::join('akunkeuangan', 'kas.kredit', '=', 'akunkeuangan.id')
        ->select('kas.id', 'kas.kredit','kas.keterangan', 'akunkeuangan.uraian', 'kas.jumlah', 'kas.tanggal','kas.file', 'kas.kode_transaksi')
        ->orderBy('kas.id','DESC')
        ->orderBy('kas.tanggal', 'DESC')
        ->where('kas.pengirim', 'P')
        ->where('kas.type', 'M')
        ->where('kas.tahun', session('tahun_aktif')) ->paginate($limit);

         return view('pendistribusian.mutasi.index', $data);

         
    }
    
    public function create()
    {
        $data['title'] = "Master Mutasi SDM umum";


        $data['sumber']=AkunKeuangan::where('jenis_akun','like','%VIASDM%')->orderBy('uraian','ASC')->get();
        $data['tujuan']=AkunKeuangan::where('jenis_akun','like','%VIASDM%')->where('level','5')->orderBy('uraian','ASC')->get();

        return view('sdm.mutasi.tambah', $data);
    }
    
     
    public function createpengumpulan()
    {
        $data['title'] = "Master Mutasi Pengumpulan";


        $data['sumber']=AkunKeuangan::where('jenis_akun','like','%VIAPG%')->where('level','5')->orderBy('uraian','ASC')->get();
        $data['tujuan']=AkunKeuangan::where('jenis_akun','like','%VIAPG%')->where('level','5')->orderBy('uraian','ASC')->get();

        return view('pengumpulan.mutasi.tambah', $data);
    }
    
       
    public function createkeuangan()
    {
        $data['title'] = "Master Mutasi Pengumpulan";


        $data['sumber']=AkunKeuangan::where('level','5')->orderBy('uraian','ASC')->get();
        $data['tujuan']=AkunKeuangan::where('level','5')->orderBy('uraian','ASC')->get();

        return view('keuangan.mutasi.tambah', $data);
    }
    
   
    public function createp()
    {
        $data['title'] = "Master Mutasi Pendistribusian";


        $data['sumber']=AkunKeuangan::where('jenis_akun','like','%VIAP%')->orderBy('uraian','ASC')->get();
        $data['tujuan']=AkunKeuangan::where('jenis_akun','like','%VIAP%')->where('level','5')->orderBy('uraian','ASC')->get();

        return view('pendistribusian.mutasi.tambah', $data);
    }




    public function store(request $request)
    {
        $jumlah = str_replace('.', '', $request->input('jumlah'));

        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date',
            'sumber' => 'required',
            'keperluan' => 'required',
            'jumlah' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
       
       
            Kas::create([
                'tanggal' => $request->tanggal,
                'kode_transaksi' => Kas::MutasiSDM($request->tanggal),
                'type' =>  'M',
                'jenis_kas' =>  'uang',
                'pengirim' =>  'SDM',
                'debet' =>  $request->keperluan,
                'kredit' => $request->sumber,
                'qty' =>  "1",
                'jumlah' =>  $jumlah,
                'keterangan' =>  $request->keterangan,
                'tahun' => session('tahun_aktif'),
                'user_id' => Auth::user()->id,
            ]);


        
        
        return redirect()->route('sdm.mutasi.index')
        ->with('success','Data Berhasil disimpan.');
    
        }
    }
    



    public function storepengumpulan(request $request)
    {
        $jumlah = str_replace('.', '', $request->input('jumlah'));

        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date',
            'sumber' => 'required',
            'keperluan' => 'required',
            'jumlah' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
       
       
            Kas::create([
                'tanggal' => $request->tanggal,
                'kode_transaksi' => Kas::MutasiPengumpulan($request->tanggal),
                'type' =>  'M',
                'jenis_kas' =>  'uang',
                'pengirim' =>  'PG',
                'debet' =>  $request->keperluan,
                'kredit' => $request->sumber,
                'qty' =>  "1",
                'jumlah' =>  $jumlah,
                'keterangan' =>  $request->keterangan,
                'tahun' => session('tahun_aktif'),
                'user_id' => Auth::user()->id,
            ]);


        
        
        return redirect()->route('pengumpulan.mutasi.indexpengumpulan')
        ->with('success','Data Berhasil disimpan.');
    
        }
    }
    




    public function storekeuangan(request $request)
    {
        $jumlah = str_replace('.', '', $request->input('jumlah'));

        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date',
            'sumber' => 'required',
            'keperluan' => 'required',
            'jumlah' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
       
       
            Kas::create([
                'tanggal' => $request->tanggal,
                'kode_transaksi' => Kas::MutasiKeuangan($request->tanggal),
                'type' =>  'M',
                'jenis_kas' =>  'uang',
                'pengirim' =>  'KU',
                'debet' =>  $request->keperluan,
                'kredit' => $request->sumber,
                'qty' =>  "1",
                'jumlah' =>  $jumlah,
                'keterangan' =>  $request->keterangan,
                'tahun' => session('tahun_aktif'),
                'user_id' => Auth::user()->id,
            ]);


        
        
        return redirect()->route('keuangan.mutasi.indexkeuangan')
        ->with('success','Data Berhasil disimpan.');
    
        }
    }
    









    public function storep(request $request)
    {
        $jumlah = str_replace('.', '', $request->input('jumlah'));

        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date',
            'sumber' => 'required',
            'keperluan' => 'required',
            'jumlah' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
       
       
            Kas::create([
                'tanggal' => $request->tanggal,
                'kode_transaksi' => Kas::MutasiP($request->tanggal),
                'type' =>  'M',
                'jenis_kas' =>  'uang',
                'pengirim' =>  'P',
                'debet' =>  $request->keperluan,
                'kredit' => $request->sumber,
                'qty' =>  "1",
                'jumlah' =>  $jumlah,
                'keterangan' =>  $request->keterangan,
                'tahun' => session('tahun_aktif'),
                'user_id' => Auth::user()->id,
            ]);


        
        
        return redirect()->route('pendistribusian.mutasi.indexp')
        ->with('success','Data Berhasil disimpan.');
    
        }
    }
    





    public function destroy($id)
    {
        Kas::where('id',$id)->where('pengirim', 'SDM')->where('type', 'M')->delete();
        return redirect()->route('sdm.mutasi.index')->with('warning', 'Data berhasil dihapus.');
    }




    public function destroyp($id)
    {
        Kas::where('id',$id)->where('pengirim', 'P')->where('type', 'M')->delete();
        return redirect()->route('pendistribusian.mutasi.indexp')->with('warning', 'Data berhasil dihapus.');
    }




    public function destroypengumpulan($id)
    {
        Kas::where('id',$id)->where('pengirim', 'PG')->where('type', 'M')->delete();
        return redirect()->route('pengumpulan.mutasi.indexpengumpulan')->with('warning', 'Data berhasil dihapus.');
    }





    public function destroykeuangan($id)
    {
        Kas::where('id',$id)->where('pengirim', 'KU')->where('type', 'M')->delete();
        return redirect()->route('keuangan.mutasi.indexkeuangan')->with('warning', 'Data berhasil dihapus.');
    }




    public function edit(string $id)
    {
        $data['title'] = "Master Edit Mutasi";
    
        $data['data'] = Kas::where('id', $id)->where('pengirim', 'SDM')->where('type', 'M')->first();
    
        $data['sumber'] = AkunKeuangan::where('jenis_akun', 'like', '%VIASDM%')->orderBy('uraian', 'ASC')->get();
    
        $data['tujuan'] = AkunKeuangan::where('jenis_akun', 'like', '%VIASDM%')->where('level', 5)->orderBy('uraian', 'ASC')->get();
    
        return view('sdm.mutasi.edit', $data);
    }
    



    public function editkeuangan(string $id)
    {
        $data['title'] = "Master Jurnal Memorial";
    
        $data['data'] = Kas::where('id', $id)->where('pengirim', 'KU')->where('type', 'M')->first();
    
        $data['sumber'] = AkunKeuangan::where('level', 5)->orderBy('uraian', 'ASC')->get();
    
        $data['tujuan'] = AkunKeuangan::where('level', 5)->orderBy('uraian', 'ASC')->get();
    
        return view('keuangan.mutasi.edit', $data);
    }
    




    public function editpengumpulan(string $id)
    {
        $data['title'] = "Master Edit Mutasi";
    
        $data['data'] = Kas::where('id', $id)->where('pengirim', 'PG')->where('type', 'M')->first();
    
        $data['sumber'] = AkunKeuangan::where('jenis_akun', 'like', '%VIAPG%')->orderBy('uraian', 'ASC')->get();
    
        $data['tujuan'] = AkunKeuangan::where('jenis_akun', 'like', '%VIAPG%')->where('level', 5)->orderBy('uraian', 'ASC')->get();
    
        return view('pengumpulan.mutasi.edit', $data);
    }
    



    public function editp(string $id)
    {
        $data['title'] = "Master Edit Mutasi";
    
        $data['data'] = Kas::where('id', $id)->where('pengirim', 'P')->where('type', 'M')->first();
    
        $data['sumber'] = AkunKeuangan::where('jenis_akun', 'like', '%VIAP%')->orderBy('uraian', 'ASC')->get();
    
        $data['tujuan'] = AkunKeuangan::where('jenis_akun', 'like', '%VIAP%')->where('level', 5)->orderBy('uraian', 'ASC')->get();
    
        return view('pendistribusian.mutasi.edit', $data);
    }
    

    public function update(Request $request, string $id)
    {
        $jumlah = str_replace('.', '', $request->input('jumlah'));

        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date',
            'sumber' => 'required',
            'keperluan' => 'required',
            'jumlah' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
       
        

            Kas::where('id', $id)
            ->update([
                'tanggal' => $request->tanggal,
                'jenis_kas' =>  'uang',
                'pengirim' =>  'SDM',
                'type' =>  'M',
                'debet' =>  $request->keperluan,
                'kredit' => $request->sumber,
                'jumlah' =>  $jumlah,
                'keterangan' =>  $request->keterangan,
                'tahun' => session('tahun_aktif'),
                'user_id' => Auth::user()->id,
            ]);


        
        
        return redirect()->route('sdm.mutasi.index')
        ->with('success','Data Berhasil disimpan.');
    
        }
    }




    public function updatekeuangan(Request $request, string $id)
    {
        $jumlah = str_replace('.', '', $request->input('jumlah'));

        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date',
            'sumber' => 'required',
            'keperluan' => 'required',
            'jumlah' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
       
        

            Kas::where('id', $id)
            ->update([
                'tanggal' => $request->tanggal,
                'debet' =>  $request->keperluan,
                'kredit' => $request->sumber,
                'jumlah' =>  $jumlah,
                'keterangan' =>  $request->keterangan,
                'tahun' => session('tahun_aktif'),
                'user_id' => Auth::user()->id,
            ]);


        
        
        return redirect()->route('keuangan.mutasi.indexkeuangan')
        ->with('success','Data Berhasil disimpan.');
    
        }
    }





    public function updatep(Request $request, string $id)
    {
        $jumlah = str_replace('.', '', $request->input('jumlah'));

        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date',
            'sumber' => 'required',
            'keperluan' => 'required',
            'jumlah' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
       
        

            Kas::where('id', $id)
            ->update([
                'tanggal' => $request->tanggal,
                'jenis_kas' =>  'uang',
                'pengirim' =>  'P',
                'type' =>  'M',
                'debet' =>  $request->keperluan,
                'kredit' => $request->sumber,
                'jumlah' =>  $jumlah,
                'keterangan' =>  $request->keterangan,
                'tahun' => session('tahun_aktif'),
                'user_id' => Auth::user()->id,
            ]);


        
        
        return redirect()->route('pendistribusian.mutasi.indexp')
        ->with('success','Data Berhasil disimpan.');
    
        }
    }


    public function updatepengumpulan(Request $request, string $id)
    {
        $jumlah = str_replace('.', '', $request->input('jumlah'));

        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date',
            'sumber' => 'required',
            'keperluan' => 'required',
            'jumlah' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
       
        

            Kas::where('id', $id)
            ->update([
                'tanggal' => $request->tanggal,
                'jenis_kas' =>  'uang',
                'pengirim' =>  'PG',
                'type' =>  'M',
                'debet' =>  $request->keperluan,
                'kredit' => $request->sumber,
                'jumlah' =>  $jumlah,
                'keterangan' =>  $request->keterangan,
                'tahun' => session('tahun_aktif'),
                'user_id' => Auth::user()->id,
            ]);


        
        
        return redirect()->route('pengumpulan.mutasi.indexpengumpulan')
        ->with('success','Data Berhasil disimpan.');
    
        }
    }




    public function search(Request $request) // Use Request class
    {
        $dataku['title'] = "Master Mutasi";
        $limit = request('limit', 10);
    
        $key = $request->input('keyword'); // Mendapatkan query pencarian dari input form
    
        // Validasi query pencarian
        if (empty($key)) {
            return redirect()->route('sdm.mutasi.index');
        }
    
        // Query pencarian
        $dataku['data'] = Kas::join('akunkeuangan', 'kas.kredit', '=', 'akunkeuangan.id')
            ->select('kas.id', 'kas.kredit', 'kas.keterangan', 'akunkeuangan.uraian', 'kas.jumlah', 'kas.tanggal','kas.file', 'kas.kode_transaksi')
            ->where('kas.pengirim', 'SDM')
            ->where('kas.type', 'M')
            ->where('kas.tahun', session('tahun_aktif'))
            ->where(function ($query) use ($key) {
                $query->where('kas.kode_transaksi', 'LIKE', '%' . $key . '%')
                    ->orWhere('kas.keterangan', 'LIKE', '%' . $key . '%')
                    ->orWhere('akunkeuangan.uraian', 'LIKE', '%' . $key . '%');
            })
            ->orderBy('kas.id','DESC')
            ->orderBy('kas.tanggal', 'DESC')
            ->paginate($limit);
    
        return view('sdm.mutasi.index', $dataku);
    }
    
    


    public function searchkeuangan(Request $request) // Use Request class
    {
        $dataku['title'] = "Master Jurnal Memorial";
        $limit = request('limit', 10);
    
        $key = $request->input('keyword'); // Mendapatkan query pencarian dari input form
    
        // Validasi query pencarian
        if (empty($key)) {
            return redirect()->route('keuangan.mutasi.indexkeuangan');
        }
    
        // Query pencarian
        $dataku['data'] = Kas::join('akunkeuangan', 'kas.kredit', '=', 'akunkeuangan.id')
            ->select('kas.id', 'kas.kredit','kas.debet', 'kas.keterangan', 'akunkeuangan.uraian', 'kas.jumlah', 'kas.tanggal','kas.file', 'kas.kode_transaksi')
            ->where('kas.pengirim', 'KU')
            ->where('kas.type', 'M')
            ->where('kas.tahun', session('tahun_aktif'))
            ->where(function ($query) use ($key) {
                $query->where('kas.kode_transaksi', 'LIKE', '%' . $key . '%')
                    ->orWhere('kas.keterangan', 'LIKE', '%' . $key . '%')
                    ->orWhere('akunkeuangan.uraian', 'LIKE', '%' . $key . '%');
            })
            ->orderBy('kas.id','DESC')
            ->orderBy('kas.tanggal', 'DESC')
            ->paginate($limit);

            foreach ($dataku['data'] as $item) {
                $akun = DB::table('akunkeuangan')
                    ->select('uraian')
                    ->where('id', '=', $item->debet)
                    ->first();
        
                if ($akun) {
                    $item->ketdebet = $akun->uraian; // Menyimpan jumlah pada objek $d
                } else {
                    $item->ketdebet = null; // Menyimpan jumlah pada objek $d
                }
            }



        return view('keuangan.mutasi.index', $dataku);
    }
    
    


    public function searchpengumpulan(Request $request) // Use Request class
    {
        $dataku['title'] = "Master Mutasi";
        $limit = request('limit', 10);
    
        $key = $request->input('keyword'); // Mendapatkan query pencarian dari input form
    
        // Validasi query pencarian
        if (empty($key)) {
            return redirect()->route('pengumpulan.mutasi.index');
        }
    
        // Query pencarian
        $dataku['data'] = Kas::join('akunkeuangan', 'kas.kredit', '=', 'akunkeuangan.id')
            ->select('kas.id', 'kas.kredit', 'kas.keterangan', 'akunkeuangan.uraian', 'kas.jumlah', 'kas.tanggal','kas.file', 'kas.kode_transaksi')
            ->where('kas.pengirim', 'PG')
            ->where('kas.type', 'M')
            ->where('kas.tahun', session('tahun_aktif'))
            ->where(function ($query) use ($key) {
                $query->where('kas.kode_transaksi', 'LIKE', '%' . $key . '%')
                    ->orWhere('kas.keterangan', 'LIKE', '%' . $key . '%')
                    ->orWhere('akunkeuangan.uraian', 'LIKE', '%' . $key . '%');
            })
            ->orderBy('kas.id','DESC')
            ->orderBy('kas.tanggal', 'DESC')
            ->paginate($limit);
    
        return view('pengumpulan.mutasi.index', $dataku);
    }
    
    






    public function searchp(Request $request) // Use Request class
    {
        $dataku['title'] = "Master Mutasi";
        $limit = request('limit', 10);
    
        $key = $request->input('keyword'); // Mendapatkan query pencarian dari input form
    
        // Validasi query pencarian
        if (empty($key)) {
            return redirect()->route('pendistribusian.mutasi.index');
        }
    
        // Query pencarian
        $dataku['data'] = Kas::join('akunkeuangan', 'kas.kredit', '=', 'akunkeuangan.id')
            ->select('kas.id', 'kas.kredit', 'kas.keterangan', 'akunkeuangan.uraian', 'kas.jumlah', 'kas.tanggal','kas.file', 'kas.kode_transaksi')
            ->where('kas.pengirim', 'P')
            ->where('kas.type', 'M')
            ->where('kas.tahun', session('tahun_aktif'))
            ->where(function ($query) use ($key) {
                $query->where('kas.kode_transaksi', 'LIKE', '%' . $key . '%')
                    ->orWhere('kas.keterangan', 'LIKE', '%' . $key . '%')
                    ->orWhere('akunkeuangan.uraian', 'LIKE', '%' . $key . '%');
            })
            ->orderBy('kas.id','DESC')
            ->orderBy('kas.tanggal', 'DESC')
            ->paginate($limit);
    
        return view('pendistribusian.mutasi.index', $dataku);
    }
    
    

 
    public function export(Request $request)
    {
        $key = $request->input('keyword');
    
        $data = Kas::join('akunkeuangan', 'kas.kredit', '=', 'akunkeuangan.id')
            ->select('kas.id', 'kas.kredit', 'kas.keterangan', 'akunkeuangan.uraian', 'kas.jumlah', 'kas.tanggal','kas.file', 'kas.kode_transaksi')
            ->where('kas.pengirim', 'SDM')
            ->where('kas.type', 'M')
            ->where('kas.tahun', session('tahun_aktif'))
            ->where(function ($query) use ($key) {
                $query->where('kas.kode_transaksi', 'LIKE', '%' . $key . '%')
                    ->orWhere('kas.keterangan', 'LIKE', '%' . $key . '%')
                    ->orWhere('akunkeuangan.uraian', 'LIKE', '%' . $key . '%');
            })
            ->orderBy('kas.id','DESC')
            ->orderBy('kas.tanggal', 'DESC')->get();
    
        return Excel::download(new SdmumumExport($data), 'Transaksi_SDMUmum.xlsx');
    }
    

    public function exportkeuangan(Request $request)
    {
        $key = $request->input('keyword');
    
        $data = Kas::join('akunkeuangan', 'kas.kredit', '=', 'akunkeuangan.id')
            ->select('kas.id', 'kas.kredit','kas.debet', 'kas.keterangan', 'akunkeuangan.uraian', 'kas.jumlah', 'kas.tanggal','kas.file', 'kas.kode_transaksi')
            ->where('kas.pengirim', 'KU')
            ->where('kas.type', 'M')
            ->where('kas.tahun', session('tahun_aktif'))
            ->where(function ($query) use ($key) {
                $query->where('kas.kode_transaksi', 'LIKE', '%' . $key . '%')
                    ->orWhere('kas.keterangan', 'LIKE', '%' . $key . '%')
                    ->orWhere('akunkeuangan.uraian', 'LIKE', '%' . $key . '%');
            })
            ->orderBy('kas.id','DESC')
            ->orderBy('kas.tanggal', 'DESC')->get();
    
            foreach ($data as $item) {
                $akun = DB::table('akunkeuangan')
                    ->select('uraian')
                    ->where('id', '=', $item->debet)
                    ->first();
        
                if ($akun) {
                    $item->ketdebet = $akun->uraian; // Menyimpan jumlah pada objek $d
                } else {
                    $item->ketdebet = null; // Menyimpan jumlah pada objek $d
                }
            }
        

            


        return Excel::download(new JurnalExport($data), 'jurnalmemorial.xlsx');
    }
    


    public function exportp(Request $request)
    {
        $key = $request->input('keyword');
    
        $data = Kas::join('akunkeuangan', 'kas.kredit', '=', 'akunkeuangan.id')
            ->select('kas.id', 'kas.kredit', 'kas.keterangan', 'akunkeuangan.uraian', 'kas.jumlah', 'kas.tanggal','kas.file', 'kas.kode_transaksi')
            ->where('kas.pengirim', 'P')
            ->where('kas.type', 'M')
            ->where('kas.tahun', session('tahun_aktif'))
            ->where(function ($query) use ($key) {
                $query->where('kas.kode_transaksi', 'LIKE', '%' . $key . '%')
                    ->orWhere('kas.keterangan', 'LIKE', '%' . $key . '%')
                    ->orWhere('akunkeuangan.uraian', 'LIKE', '%' . $key . '%');
            })
            ->orderBy('kas.id','DESC')
            ->orderBy('kas.tanggal', 'DESC')->get();
    
        return Excel::download(new MutasiPExport($data), 'mutasi_pendistribusian.xlsx');
    }


    public function exportpengumpulan(Request $request)
    {
        $key = $request->input('keyword');
    
        $data = Kas::join('akunkeuangan', 'kas.kredit', '=', 'akunkeuangan.id')
            ->select('kas.id', 'kas.kredit', 'kas.keterangan', 'akunkeuangan.uraian', 'kas.jumlah', 'kas.tanggal','kas.file', 'kas.kode_transaksi')
            ->where('kas.pengirim', 'PG')
            ->where('kas.type', 'M')
            ->where('kas.tahun', session('tahun_aktif'))
            ->where(function ($query) use ($key) {
                $query->where('kas.kode_transaksi', 'LIKE', '%' . $key . '%')
                    ->orWhere('kas.keterangan', 'LIKE', '%' . $key . '%')
                    ->orWhere('akunkeuangan.uraian', 'LIKE', '%' . $key . '%');
            })
            ->orderBy('kas.id','DESC')
            ->orderBy('kas.tanggal', 'DESC')->get();
    
        return Excel::download(new MutasiPExport($data), 'mutasi.xlsx');
    }

    public function perubahan(Request $request)
    {

        $data['title'] = "Laporan Perubahan Dana";
        $bulan = $request->input('bulan');
        $jenis = $request->input('jenis');
        $tahunAktif = session('tahun_aktif');

      

        
        $data['data'] = DB::table('akunkeuangan')
        ->where('kode','like',  '4.' . $jenis . '%')
        ->orderBy('kode', 'asc')
        ->get();


        foreach ($data['data'] as $d) {

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

            $d->saldo = $kredit - $debet; 


        }

        
        $data['dataku'] = DB::table('akunkeuangan')
        ->where('kode','like',  '5.' . $jenis . '%')
        ->orderBy('kode', 'asc')
        ->get();


        foreach ($data['dataku'] as $d) {

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


             
        $data['dataawal'] = DB::table('akunkeuangan')
        ->where('kode','like',  '3.' . $jenis . '%')
        ->where('level','5')
        ->orderBy('kode', 'asc')
        ->get();


        foreach ($data['dataawal'] as $d) {

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


           
        $data['datasaldo'] = DB::table('akunkeuangan')
        ->where('kode','like',  '4.' . $jenis . '%')
        ->where('level','2')
        ->orderBy('kode', 'asc')
        ->get();


        foreach ($data['datasaldo'] as $d) {

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

            $d->saldo = $kredit - $debet; 


        }






        return view('keuangan.laporan.perubahan', $data);

    }



    
    public function perubahanpen(Request $request)
    {

        $data['title'] = "Laporan Perubahan Dana";
        $bulan = $request->input('bulan');
        $jenis = $request->input('jenis');
        $tahunAktif = session('tahun_aktif');

      

        
        $data['data'] = DB::table('akunkeuangan')
        ->where('kode','like',  '4.' . $jenis . '%')
        ->orderBy('kode', 'asc')
        ->get();


        foreach ($data['data'] as $d) {

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

            $d->saldo = $kredit - $debet; 


        }

        
        $data['dataku'] = DB::table('akunkeuangan')
        ->where('kode','like',  '5.' . $jenis . '%')
        ->orderBy('kode', 'asc')
        ->get();


        foreach ($data['dataku'] as $d) {

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


             
        $data['dataawal'] = DB::table('akunkeuangan')
        ->where('kode','like',  '3.' . $jenis . '%')
        ->where('level','5')
        ->orderBy('kode', 'asc')
        ->get();


        foreach ($data['dataawal'] as $d) {

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


           
        $data['datasaldo'] = DB::table('akunkeuangan')
        ->where('kode','like',  '4.' . $jenis . '%')
        ->where('level','2')
        ->orderBy('kode', 'asc')
        ->get();


        foreach ($data['datasaldo'] as $d) {

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

            $d->saldo = $kredit - $debet; 


        }






        return view('pendistribusian.laporan.perubahan', $data);

    }

    public function realisasianggaran(Request $request)
    {
        $data['title'] = "Laporan Realisasi Anggaran";
        $bulan = $request->input('bulan');
        $tahunAktif = session('tahun_aktif');
    
        $data['data'] = DB::table('akunkeuangan')
            ->where('kelompok', '=', 'LRA')
            ->orderBy('kode', 'asc')
            ->get();
    
        foreach ($data['data'] as $d) {
            $jml = 0;
    
            $jml = DB::table('rencana')
                ->join('akunkeuangan', 'rencana.id_akun', '=', 'akunkeuangan.id')
                ->where('rencana.tahun', $tahunAktif);
    
            if ($d->level == '5') {
                $jml->where('rencana.id_akun', $d->id);
            } else {
                $jml->where('akunkeuangan.kode', 'like', $d->kode . '%');
            }
    
            $d->jumlah = $jml->sum('rencana.jumlah');

    ////////////////////// Bulan ini /////////////////////
            $debet = DB::table('kas')
                ->join('akunkeuangan', 'akunkeuangan.id', '=', 'kas.debet')
                ->where('akunkeuangan.kode', 'like', $d->kode . '%')
                ->whereYear('kas.tanggal', $tahunAktif)
                ->whereMonth('kas.tanggal', $bulan)
                ->sum('kas.jumlah');
    
            $kredit = DB::table('kas')
                ->join('akunkeuangan', 'akunkeuangan.id', '=', 'kas.kredit')
                ->where('akunkeuangan.kode', 'like', $d->kode . '%')
                ->whereYear('kas.tanggal', $tahunAktif)
                ->whereMonth('kas.tanggal', $bulan)
                ->sum('kas.jumlah');
    
            $d->debet = $debet;
            $d->kredit = $kredit;

            if (substr($d->kode, 0, 1)=='4') {
            $d->saldobulanini = $kredit - $debet; 
            } else {
            $d->saldobulanini = $debet - $kredit;                 
            }

    ////////////////////// Bulan s/d KEMARIN /////////////////////
            $debetkemarin = DB::table('kas')
            ->join('akunkeuangan', 'akunkeuangan.id', '=', 'kas.debet')
            ->where('akunkeuangan.kode', 'like', $d->kode . '%')
            ->whereYear('kas.tanggal', $tahunAktif)
            ->whereMonth('kas.tanggal', '<', $bulan) // Mengubah operator menjadi '<' agar hanya mendapatkan data sebelum bulan yang ditentukan
            ->sum('kas.jumlah');

        // Menghitung kredit kemarin
            $kreditkemarin = DB::table('kas')
            ->join('akunkeuangan', 'akunkeuangan.id', '=', 'kas.kredit')
            ->where('akunkeuangan.kode', 'like', $d->kode . '%')
            ->whereYear('kas.tanggal', $tahunAktif)
            ->whereMonth('kas.tanggal', '<', $bulan) // Mengubah operator menjadi '<' agar hanya mendapatkan data sebelum bulan yang ditentukan
            ->sum('kas.jumlah');
    
            $d->debetkemarin = $debetkemarin;
            $d->kreditkemarin = $kreditkemarin;

            if (substr($d->kode, 0, 1)=='4') {
                $d->saldobulankemarin = $kreditkemarin - $debetkemarin; 
            } else {
                    $d->saldobulankemarin = $debetkemarin - $kreditkemarin; 
                }
        }
    
        return view('keuangan.laporan.realisasianggaran', $data);
    }
    

    
    public function realisasianggaranpen(Request $request)
    {
        $data['title'] = "Laporan Realisasi Anggaran";
        $bulan = $request->input('bulan');
        $tahunAktif = session('tahun_aktif');
    
        $data['data'] = DB::table('akunkeuangan')
            ->where('kelompok', '=', 'LRA')
            ->orderBy('kode', 'asc')
            ->get();
    
        foreach ($data['data'] as $d) {
            $jml = 0;
    
            $jml = DB::table('rencana')
                ->join('akunkeuangan', 'rencana.id_akun', '=', 'akunkeuangan.id')
                ->where('rencana.tahun', $tahunAktif);
    
            if ($d->level == '5') {
                $jml->where('rencana.id_akun', $d->id);
            } else {
                $jml->where('akunkeuangan.kode', 'like', $d->kode . '%');
            }
    
            $d->jumlah = $jml->sum('rencana.jumlah');

    ////////////////////// Bulan ini /////////////////////
            $debet = DB::table('kas')
                ->join('akunkeuangan', 'akunkeuangan.id', '=', 'kas.debet')
                ->where('akunkeuangan.kode', 'like', $d->kode . '%')
                ->whereYear('kas.tanggal', $tahunAktif)
                ->whereMonth('kas.tanggal', $bulan)
                ->sum('kas.jumlah');
    
            $kredit = DB::table('kas')
                ->join('akunkeuangan', 'akunkeuangan.id', '=', 'kas.kredit')
                ->where('akunkeuangan.kode', 'like', $d->kode . '%')
                ->whereYear('kas.tanggal', $tahunAktif)
                ->whereMonth('kas.tanggal', $bulan)
                ->sum('kas.jumlah');
    
            $d->debet = $debet;
            $d->kredit = $kredit;

            if (substr($d->kode, 0, 1)=='4') {
            $d->saldobulanini = $kredit - $debet; 
            } else {
            $d->saldobulanini = $debet - $kredit;                 
            }

    ////////////////////// Bulan s/d KEMARIN /////////////////////
            $debetkemarin = DB::table('kas')
            ->join('akunkeuangan', 'akunkeuangan.id', '=', 'kas.debet')
            ->where('akunkeuangan.kode', 'like', $d->kode . '%')
            ->whereYear('kas.tanggal', $tahunAktif)
            ->whereMonth('kas.tanggal', '<', $bulan) // Mengubah operator menjadi '<' agar hanya mendapatkan data sebelum bulan yang ditentukan
            ->sum('kas.jumlah');

        // Menghitung kredit kemarin
            $kreditkemarin = DB::table('kas')
            ->join('akunkeuangan', 'akunkeuangan.id', '=', 'kas.kredit')
            ->where('akunkeuangan.kode', 'like', $d->kode . '%')
            ->whereYear('kas.tanggal', $tahunAktif)
            ->whereMonth('kas.tanggal', '<', $bulan) // Mengubah operator menjadi '<' agar hanya mendapatkan data sebelum bulan yang ditentukan
            ->sum('kas.jumlah');
    
            $d->debetkemarin = $debetkemarin;
            $d->kreditkemarin = $kreditkemarin;

            if (substr($d->kode, 0, 1)=='4') {
                $d->saldobulankemarin = $kreditkemarin - $debetkemarin; 
            } else {
                    $d->saldobulankemarin = $debetkemarin - $kreditkemarin; 
                }
        }
    
        return view('pendistribusian.laporan.realisasianggaran', $data);
    }
    



}