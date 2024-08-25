<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\rencana;
use App\Models\tahun;
use App\Models\AkunKeuangan;
use Validator;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RencanaExport;
use App\Imports\RencanaImport;



class RencanaController extends Controller
{
    public function index()
    {
        $limit = request('limit', 10);
        $title = "Master RKAT";
        $tahunAktif = session('tahun_aktif');
        
        $dataku = DB::table('akunkeuangan')
            ->where('kelompok', '=', 'LRA')
            ->orderBy('kode', 'asc')
            ->paginate($limit);
    
        foreach ($dataku as $d) {
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
        }
    
        return view('master.rencana.index', compact('dataku', 'title'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function import()
    {
        $data['title'] = "Import RKAT";
        return view('master.rencana.import', $data);

    }

    public function export()
    {
        $tahunAktif = session('tahun_aktif');

        $data = AkunKeuangan::where(function($query){
            $query->where('kelompok', '=', 'LRA')->where('level', '=', '5')
                ->orderBy('kode', 'asc');
         })->get();
         foreach ($data as $d) {
            $jml = DB::table('rencana')
                ->where('id_akun', $d->id)
                ->where('tahun', session('tahun_aktif'))
                ->value('jumlah');
       
                $d->jumlah = $jml; // Menyimpan jumlah pada objek $d
         }
         return Excel::download(new RencanaExport($data), 'Rencana_Tahunan.xlsx');
    }



    public function download(Request $request)
    {
        $tahunAktif = session('tahun_aktif');

       
        $key = $request->input('keyword'); // Ambil kata kunci pencarian dari input form

        if ($key) {
        $data = DB::table('akunkeuangan')
        ->where('kelompok', 'LRA')
        ->where(function ($query) use ($key) {
            $query->where('uraian', 'LIKE', '%' . $key . '%')
                  ->orWhere('kode', 'LIKE', '%' . $key . '%');
        })
        ->orderBy('kode', 'asc')
        ->get();

    foreach ($data as $d) {
        $jml = 0;

        $jml = DB::table('rencana')
            ->join('akunkeuangan', 'rencana.id_akun', '=', 'akunkeuangan.id')
            ->where('rencana.tahun', $tahunAktif)
            ->when($d->level == '5', function ($query) use ($d) {
                $query->where('id_akun', $d->id);
            })
            ->when(in_array($d->level, ['4', '3', '2', '1']), function ($query) use ($d) {
                $query->where('akunkeuangan.kode', 'LIKE', $d->kode . '%');
            })
            ->sum('rencana.jumlah');

        $d->jumlah = $jml;
                 }
        } else {
            $data = DB::table('akunkeuangan')
            ->where('kelompok', '=', 'LRA')
            ->orderBy('kode', 'asc')
            ->get();
    
        foreach ($data as $d) {
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
        }
    


        }




         return Excel::download(new RencanaExport($data), 'Rencana_Tahunan.xlsx');
    }




    public function importstore(Request $request)
    {
        //
        $file = $request->file('file')->store('public/import');
        $import = new RencanaImport();
        $import->import($file);
        $sukses = $import->getRowCount();
        
        if($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures())->with('gagal',$import->getRowCount()
            
        );;
     
        }
        
    return redirect()->route('master.rencana.index')->with('success', 'Data berhasil diimport '.$import->getRowCount().' Data');

    } 

    /**
     * Display the specified resource.
     */
     
     public function search(Request $request)
     {
         $key = $request->input('keyword');
         $title = "Master RKAT";
         $limit = $request->input('limit', 10);
     
         $tahunAktif = session('tahun_aktif');
     




         $dataku = DB::table('akunkeuangan')
             ->where('kelompok', 'LRA')
             ->where(function ($query) use ($key) {
                 $query->where('uraian', 'LIKE', '%' . $key . '%')
                       ->orWhere('kode', 'LIKE', '%' . $key . '%');
             })
             ->orderBy('kode', 'asc')
             ->paginate($limit);
     
         foreach ($dataku as $d) {
             $jml = 0;
     
             $jml = DB::table('rencana')
                 ->join('akunkeuangan', 'rencana.id_akun', '=', 'akunkeuangan.id')
                 ->where('rencana.tahun', $tahunAktif)
                 ->when($d->level == '5', function ($query) use ($d) {
                     $query->where('id_akun', $d->id);
                 })
                 ->when(in_array($d->level, ['4', '3', '2', '1']), function ($query) use ($d) {
                     $query->where('akunkeuangan.kode', 'LIKE', $d->kode . '%');
                 })
                 ->sum('rencana.jumlah');
     
             $d->jumlah = $jml;
         }
     
         return view('master.rencana.index', compact('dataku', 'title'));
     }
     


}
