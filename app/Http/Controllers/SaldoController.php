<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AkunKeuangan;
use Validator;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SaldoExport;
use App\Imports\SaldoImport;

class SaldoController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $kodeawal;

    public function __construct()
    
    {
        // perlu logika kedepannya
         $this->kodeawal = ['SA'];

    }

     


    public function index()
    {
        
              
        $data['title'] = "Master Saldo Awal";
        $limit = request('limit', 10);

        $data['data'] = DB::table('akunkeuangan')
        ->where('jenis_akun', 'LIKE', '%' . $this->kodeawal[0] . '%')
        ->orderBy('kode', 'asc');
        $data['data']  = $data['data']->paginate($limit);
        
        foreach ($data['data'] as $d) {
            $jml = 0;
    
        $cek = substr($d->kode, 0, 1);

        if($cek == '2') {
            $kete = "kredit";
        } else {
            $kete = "debet";
        }

        if ($d->level == '5') {
            $jml = DB::table('kas')
                ->where($kete, $d->id)
                ->where('pengirim', 'SA')
                ->where('type', 'TU')
                ->where('tahun', session('tahun_aktif'))
                ->value('jumlah');
        } elseif ($d->level >= '2' && $d->level <= '4') {
            $jml = DB::table('kas')
                ->join('akunkeuangan', 'kas.' . $kete, '=', 'akunkeuangan.id')
                ->where('akunkeuangan.kode', 'like', $d->kode . '%')
                ->where('kas.tahun', session('tahun_aktif'))
                ->sum('kas.jumlah');
        }


        $d->jumlah = $jml; // Menyimpan jumlah pada objek $d
    
                
             }
             
        return view('master.saldo.index', $data);

    }


    public function import()
    {
        $data['title'] = "Import Saldo Awal";
        return view('master.saldo.import', $data);

    }


    public function export()
    {
        $tahunAktif = session('tahun_aktif');
        $jenisAkun = $this->kodeawal[0];
    
        $data = DB::table('akunkeuangan')
            ->where('jenis_akun', 'LIKE', "%$jenisAkun%")
            ->where('level', 5)
            ->orderBy('kode', 'asc')
            ->get();
    
        foreach ($data as $d) {
            $jml = DB::table('kas')
                ->where('pengirim', 'SA')
                ->where('debet', $d->id)
                ->where('tahun', $tahunAktif)
                ->where('keterangan', 'Saldo Awal')
                ->value('jumlah');
    
            $d->jumlah = $jml ?? 0; // Assign the value if it exists, otherwise default to 0
        }
    
        return Excel::download(new SaldoExport($data), 'Saldo_awal_tahun.xlsx');
    }
    



    /**
     * Store a newly created resource in storage.
     */
    public function importstore(Request $request)
    {
        //
        $file = $request->file('file')->store('public/import');
        $import = new SaldoImport();
        $import->import($file);
        $sukses = $import->getRowCount();
        
        if($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures())->with('gagal',$import->getRowCount()
            
        );;
     
        }

        return redirect()->route('master.saldo.index')->with('success', 'Data berhasil diimport '.$import->getRowCount().' Data');

    }

    
    public function search(Request $request)
{
    $title = "Master RKAT";

    $key = $request->input('keyword');

    $data = DB::table('akunkeuangan')
        ->where('jenis_akun', 'LIKE', '%' . $this->kodeawal[0] . '%')
        ->where(function ($query) use ($key) {
            $query->where('uraian', 'LIKE', "%$key%")
                ->orWhere('kode', 'LIKE', "%$key%");
        })
        ->orderBy('kode', 'asc')
        ->paginate(10);

    foreach ($data as $d) {
        $jml = 0;

        if ($d->level >= 1 && $d->level <= 5) {
            $jml = DB::table('kas')
                ->join('akunkeuangan', 'kas.debet', '=', 'akunkeuangan.id')
                ->where('akunkeuangan.kode', 'like', $d->kode . '%')
                ->where('kas.tahun', session('tahun_aktif'))
                ->when($d->level == 5, function ($query) use ($d) {
                    $query->where('debet', $d->id);
                })
                ->sum('kas.jumlah');
        }

        $d->jumlah = $jml;
    }

    return view('master.saldo.index', compact('data', 'title'));
}

public function download(Request $request)
{
    $key = $request->input('keyword');
    
    $data = DB::table('akunkeuangan')
        ->where('jenis_akun', 'LIKE', '%' . $this->kodeawal[0] . '%')
        ->orderBy('kode', 'asc');

    if ($key) {
        $data = $data->where(function ($query) use ($key) {
            $query->where('uraian', 'LIKE', "%$key%")
                ->orWhere('kode', 'LIKE', "%$key%");
        })->get();

        foreach ($data as $d) {
            $jml = 0;

            if ($d->level >= 1 && $d->level <= 5) {
                $jml = DB::table('kas')
                    ->join('akunkeuangan', 'kas.debet', '=', 'akunkeuangan.id')
                    ->where('akunkeuangan.kode', 'like', $d->kode . '%')
                    ->where('kas.tahun', session('tahun_aktif'))
                    ->when($d->level == 5, function ($query) use ($d) {
                        $query->where('debet', $d->id);
                    })
                    ->sum('kas.jumlah');
            }

            $d->jumlah = $jml;
        }
    } else {
        $data = $data->get();

        foreach ($data as $d) {
            $jml = 0;

            if ($d->level >= 1 && $d->level <= 5) {
                $jml = DB::table('kas')
                    ->join('akunkeuangan', 'kas.debet', '=', 'akunkeuangan.id')
                    ->where('akunkeuangan.kode', 'like', $d->kode . '%')
                    ->where('kas.tahun', session('tahun_aktif'))
                    ->when($d->level == 5, function ($query) use ($d) {
                        $query->where('debet', $d->id);
                    })
                    ->sum('kas.jumlah');
            }

            $d->jumlah = $jml;
        }
    }

    return Excel::download(new SaldoExport($data), 'Saldo_awal_tahun.xlsx');
}

}