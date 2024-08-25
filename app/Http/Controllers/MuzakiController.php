<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Muzaki;
use Validator;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Exports\MuzakiExport;
use App\Exports\MasterMuzakiExport;
use App\Exports\MasterMuzakiLExport;
use App\Exports\MuzakiLembagaExport;

use App\Imports\MuzakiImport;
use App\Imports\MuzakiLImport;





class MuzakiController extends Controller
{

    public function index()
    {
        $data['title'] = "Master Muzaki dan Mustahik Perseorangan";
        $limit = request('limit', 10);
                
        $data['data'] = Muzaki::orderBy('id','DESC')
        ->where('type','P')
        ->paginate($limit);

        return view('pengumpulan.muzaki.index', $data);         
    }
   


    public function lembaga()
    {
        $data['title'] = "Master Muzaki dan Mustahik Perseorangan";
        $limit = request('limit', 10);
                
        $data['data'] = Muzaki::orderBy('nama_muzaki','ASC')
        ->where('type','L')
        ->paginate($limit);

        return view('pengumpulan.muzaki.lembaga', $data);         
    }
   


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = "Tambah Master Muzaki dan mustahik";
        $data['dinas'] = Muzaki::orderBy('nama_muzaki','ASC')
        ->where('type','L')
        ->get();

        return view('pengumpulan.muzaki.tambah', $data);

    }


    /**
     * Show the form for creating a new resource.
     */
    public function createlembaga()
    {
        $data['title'] = "Tambah Master Muzaki dan mustahik";
        $data['dinas'] = Muzaki::orderBy('nama_muzaki','ASC')
        ->where('type','L')
        ->get();

        return view('pengumpulan.muzaki.tambahlembaga', $data);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'nama_muzaki' => 'required|string|max:255',
            'nik' => 'nullable|string|max:255',
            'jenis_kelamin' => 'nullable|in:L,P',
            'tgl_register' => 'nullable|date',
            'telp' => 'nullable|string|max:255',
            'hp' => 'required|string|max:255',
            'alamat' => 'nullable|required|string|max:255',
            'email' => 'nullable|email|max:255',
            'npwp' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',      
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            Muzaki::create([
                'npwz' => $request->npwz,
                'nama_muzaki' => $request->nama_muzaki,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tgl_register' => $request->tgl_register,
                'telp' => $request->telp,
                'hp' => $request->hp,
                'nik' => $request->nik,
                'alamat' => $request->alamat,
                'email' => $request->email,
                'npwp' => $request->npwp,
                'keterangan' => $request->keterangan,
                'dinas' => $request->dinas,
        ]);
        }

        return redirect()->route('pengumpulan.muzaki.index')
        ->with('success','Data Berhasil disimpan.');

    }

    public function storelembaga(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'nama_muzaki' => 'required|string|max:255',
            'nik' => 'nullable|string|max:255',
            'jenis_kelamin' => 'nullable|in:L,P',
            'tgl_register' => 'nullable|date',
            'telp' => 'nullable|string|max:255',
            'hp' => 'required|string|max:255',
            'alamat' => 'nullable|required|string|max:255',
            'email' => 'nullable|email|max:255',
            'npwp' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',      
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            Muzaki::create([
                'npwz' => $request->npwz,
                'nama_muzaki' => $request->nama_muzaki,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tgl_register' => $request->tgl_register,
                'telp' => $request->telp,
                'type' => "L",
                'hp' => $request->hp,
                'nik' => $request->nik,
                'alamat' => $request->alamat,
                'email' => $request->email,
                'npwp' => $request->npwp,
                'keterangan' => $request->keterangan,
        ]);
        }

        return redirect()->route('pengumpulan.muzaki.lembaga')
        ->with('success','Data Berhasil disimpan.');

    }

   
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['title'] = "Edit Master Muzaki dan mustahik";
        $data['data'] = Muzaki::find($id);


        $data['dinas'] = Muzaki::orderBy('nama_muzaki','ASC')
        ->where('type','L')
        ->get();

        return view('pengumpulan.muzaki.edit', $data);
    }

    public function editlembaga(string $id)
    {
        $data['title'] = "Edit Master Muzaki dan mustahik";
        $data['data'] = Muzaki::find($id);



        return view('pengumpulan.muzaki.editlembaga', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'nama_muzaki' => 'required|string|max:255',
            'nik' => 'nullable|string|max:255',
            'jenis_kelamin' => 'nullable|in:L,P',
            'tgl_register' => 'nullable|date',
            'telp' => 'nullable|string|max:255',
            'hp' => 'required|string|max:255',
            'alamat' => 'nullable|required|string|max:255',
            'email' => 'nullable|email|max:255',
            'npwp' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',      
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {

            Muzaki::where('id', $id)
            ->update([
                'npwz' => $request->npwz,
                'nama_muzaki' => $request->nama_muzaki,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tgl_register' => $request->tgl_register,
                'telp' => $request->telp,
                'hp' => $request->hp,
                'nik' => $request->nik,
                'alamat' => $request->alamat,
                'email' => $request->email,
                'npwp' => $request->npwp,
                'keterangan' => $request->keterangan,
                'dinas' => $request->dinas,
            ]);


        }
        return redirect()->route('pengumpulan.muzaki.index')
        ->with('success','Data Berhasil diperbaharui.');
    }


    public function updatelembaga(Request $request, string $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'nama_muzaki' => 'required|string|max:255',
            'nik' => 'nullable|string|max:255',
            'jenis_kelamin' => 'nullable|in:L,P',
            'tgl_register' => 'nullable|date',
            'telp' => 'nullable|string|max:255',
            'alamat' => 'nullable|required|string|max:255',
            'email' => 'nullable|email|max:255',
            'npwp' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',      
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {

            Muzaki::where('id', $id)
            ->update([
                'npwz' => $request->npwz,
                'nama_muzaki' => $request->nama_muzaki,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tgl_register' => $request->tgl_register,
                'telp' => $request->telp,
                'hp' => $request->hp,
                'nik' => $request->nik,
                'alamat' => $request->alamat,
                'email' => $request->email,
                'npwp' => $request->npwp,
                'keterangan' => $request->keterangan,
            ]);


        }
        return redirect()->route('pengumpulan.muzaki.lembaga')
        ->with('success','Data Berhasil diperbaharui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Muzaki::where('id',$id)->where('type','P')->delete();
        return redirect()->route('pengumpulan.muzaki.index')->with('warning', 'Data berhasil dihapus.');
    }

    public function destroylembaga($id)
    {
        Muzaki::where('id',$id)->where('type','L')->delete();
        return redirect()->route('pengumpulan.muzaki.lembaga')->with('warning', 'Data berhasil dihapus.');
    }



    public function search(Request $request)
    {

        $data['title'] = "Cari Data";
        $limit = request('limit', 10); // Jika tidak ada input dari pengguna, gunakan nilai default 10

        $keyword = $request->input('keyword');    
        $query = Muzaki::query()->orderBy('nama_muzaki', 'ASC')->where('type','P');
        
        $query->where(function ($query) use ($keyword) {
                $query->where('nama_muzaki', 'like', "%$keyword%")
                ->orWhere('npwz', 'LIKE', '%' . $keyword . '%')
                ->orWhere('npwp', 'LIKE', '%' . $keyword . '%')
                ->orWhere('hp', 'LIKE', '%' . $keyword . '%')
                ->orWhere('email', 'LIKE', '%' . $keyword . '%')
                ->orWhere('alamat', 'LIKE', '%' . $keyword . '%')
                ->orWhere('telp', 'LIKE', '%' . $keyword . '%')
                ;
            });
      
        
        $data['data'] = $query->paginate($limit);

        
        return view('pengumpulan.muzaki.index',$data);
    }



    public function searchlembaga(Request $request)
    {

        $data['title'] = "Cari Data";
        $limit = request('limit', 10); // Jika tidak ada input dari pengguna, gunakan nilai default 10

        $keyword = $request->input('keyword');    
        $query = Muzaki::query()->orderBy('nama_muzaki', 'ASC')->where('type','L');
        
        $query->where(function ($query) use ($keyword) {
                $query->where('nama_muzaki', 'like', "%$keyword%")
                ->orWhere('npwz', 'LIKE', '%' . $keyword . '%')
                ->orWhere('npwp', 'LIKE', '%' . $keyword . '%')
                ->orWhere('hp', 'LIKE', '%' . $keyword . '%')
                ->orWhere('email', 'LIKE', '%' . $keyword . '%')
                ->orWhere('alamat', 'LIKE', '%' . $keyword . '%')
                ->orWhere('telp', 'LIKE', '%' . $keyword . '%')
                ;
            });
      
        
        $data['data'] = $query->paginate($limit);

        
        return view('pengumpulan.muzaki.lembaga',$data);
    }



    public function export(Request $request)
    {
        $keyword = $request->input('keyword'); // Ambil kata kunci pencarian dari input form
        $query = Muzaki::query()->orderBy('nama_muzaki', 'ASC')->where('type','P');
      
        if ($keyword) {
            $query->where(function ($query) use ($keyword) {
                $query->where('nama_muzaki', 'like', "%$keyword%")
                ->orWhere('npwz', 'LIKE', '%' . $keyword . '%')
                ->orWhere('npwp', 'LIKE', '%' . $keyword . '%')
                ->orWhere('hp', 'LIKE', '%' . $keyword . '%')
                ->orWhere('email', 'LIKE', '%' . $keyword . '%')
                ->orWhere('alamat', 'LIKE', '%' . $keyword . '%')
                ->orWhere('telp', 'LIKE', '%' . $keyword . '%')
                ;
            });
        }
    
        $data = $query->get();  
        foreach ($data as $muzaki) {
            $dinas = Muzaki::find($muzaki->dinas);
            $muzaki->nama_dinas = $dinas ? $dinas->nama_muzaki : null;

            
        }
        return Excel::download(new MuzakiExport($data), 'muzaki.xlsx');
    }
    



    public function exportlembaga(Request $request)
    {
        $keyword = $request->input('keyword'); // Ambil kata kunci pencarian dari input form
        $query = Muzaki::query()->orderBy('nama_muzaki', 'ASC')->where('type','L');
      
        if ($keyword) {
            $query->where(function ($query) use ($keyword) {
                $query->where('nama_muzaki', 'like', "%$keyword%")
                ->orWhere('npwz', 'LIKE', '%' . $keyword . '%')
                ->orWhere('npwp', 'LIKE', '%' . $keyword . '%')
                ->orWhere('hp', 'LIKE', '%' . $keyword . '%')
                ->orWhere('email', 'LIKE', '%' . $keyword . '%')
                ->orWhere('alamat', 'LIKE', '%' . $keyword . '%')
                ->orWhere('telp', 'LIKE', '%' . $keyword . '%')
                ;
            });
        }
    
        $data = $query->get();  
      
        return Excel::download(new MuzakiLembagaExport($data), 'muzaki_lembaga.xlsx');
    }
    



    

    public function import()
    {
        $data['title'] = "Import Data Muzaki";
        return view('pengumpulan.muzaki.import', $data);

    }

  

    public function importlembaga()
    {
        $data['title'] = "Import Data Muzaki";
        return view('pengumpulan.muzaki.importlembaga', $data);

    }



   
    public function importstore(Request $request)
    {
     //
     $file = $request->file('file')->store('public/import');
     $import = new MuzakiImport(); 
     $import->import($file);
     $sukses = $import->getRowCount();
     
     if($import->failures()->isNotEmpty()) {
         return back()->withFailures($import->failures())->with('gagal',$import->getRowCount()
         
     );;
  
     }

     return redirect()->route('pengumpulan.muzaki.index')->with('success', 'Data berhasil diimport '.$import->getRowCount().' Data');
        
    }



    public function download()
    {
        return Excel::download(new MasterMuzakiExport(), 'template_muzaki.xlsx');
    }


    public function importstorelembaga(Request $request)
    {
     //
     $file = $request->file('file')->store('public/import');
     $import = new MuzakiLImport(); 
     $import->import($file);
     $sukses = $import->getRowCount();
     
     if($import->failures()->isNotEmpty()) {
         return back()->withFailures($import->failures())->with('gagal',$import->getRowCount()
         
     );;
  
     }

     return redirect()->route('pengumpulan.muzaki.lembaga')->with('success', 'Data berhasil diimport '.$import->getRowCount().' Data');
        
    }



    public function downloadlembaga()
    {
        return Excel::download(new MasterMuzakiLExport(), 'template_muzaki_lembaga.xlsx');
    }




}
