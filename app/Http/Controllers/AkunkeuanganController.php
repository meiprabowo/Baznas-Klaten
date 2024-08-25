<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\AkunKeuangan;
use App\Models\Jenis_akun;
use Validator;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Exports\AkunkeuanganExport;
use App\Imports\AkunkeuanganImport;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;


class AkunkeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = "Master Akun Keuangan";
        $limit = request('limit', 10);
        $data['data'] = AkunKeuangan::orderBy('kode', 'ASC')->paginate($limit);
        return view('master.akunkeuangan.index', $data);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = "Tambah Master AkunKeuangan";
        $data['dataku'] = Jenis_akun::orderBy('nama_akun', 'ASC')->get();
        return view('master.akunkeuangan.tambah', $data);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
         //
         $validator = Validator::make($request->all(), [
            'kode' => 'required',
            'uraian' => 'required',
            'level' => 'required|numeric',
            'sifat' => 'required',
            'kelompok' => 'required',
        ]);


         $selectedAkun = $request->input('jenis_akun');
      
        
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
          
            if ($selectedAkun!='')  {
                $tag=implode(',',$selectedAkun);
                AkunKeuangan::create([
                    'kode' => $request->kode,
                    'uraian' => $request->uraian,
                    'level' => $request->level,
                    'sifat' => $request->sifat,
                    'kelompok' => $request->kelompok,
                    'jenis_akun' => $tag,
                ]);
            } else {
                AkunKeuangan::create([
                    'kode' => $request->kode,
                    'uraian' => $request->uraian,
                    'level' => $request->level,
                    'sifat' => $request->sifat,
                    'kelompok' => $request->kelompok,    
                ]);
            }
                
                
            

        }
        return redirect()->route('master.akun.index')
        ->with('success','Data Berhasil disimpan.');

    }

   
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['title'] = "Edit Master Akun Keuangan";
        $data['data'] = AkunKeuangan::find($id);
        $data['dataku'] = Jenis_akun::orderBy('nama_akun', 'ASC')->get();
        return view('master.akunkeuangan.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'kode' => 'required',
            'uraian' => 'required',
            'level' => 'required|numeric',
            'sifat' => 'required',
            'kelompok' => 'required',

        ]);

        
         $selectedAkun = $request->input('jenis_akun');
         $tag=implode(',',$selectedAkun);

    
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            AkunKeuangan::where('id', $id)
            ->update([
                'kode' => $request->kode,
                'uraian' => $request->uraian,
                'status' => $request->status,
                'level' => $request->level,
                'sifat' => $request->sifat,
                'kelompok' => $request->kelompok,
                'jenis_akun' => $tag,

            ]);

        }
        return redirect()->route('master.akun.index')
        ->with('success','Data Berhasil diperbaharui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        AkunKeuangan::find($id)->delete();
        return redirect()->route('master.akun.index')->with('warning', 'Data berhasil dihapus.');
    }



    public function search(Request $request)
    {

        $data['title'] = "Cari Data";
        $limit = request('limit', 10); // Jika tidak ada input dari pengguna, gunakan nilai default 10

        $keyword = $request->input('keyword');    
        $query = AkunKeuangan::query()->orderBy('kode', 'ASC');
        
        $query->where(function ($query) use ($keyword) {
                $query->where('uraian', 'like', "%$keyword%")
                ->orWhere('kode', 'LIKE', '%' . $keyword . '%');
        });
      
        
        $data['data'] = $query->paginate($limit);

        
        return view('master.akunkeuangan.index',$data);
    }



    public function export(Request $request)
    {
        $keyword = $request->input('keyword'); // Ambil kata kunci pencarian dari input form
        $query = AkunKeuangan::query()->orderBy('kode', 'ASC');
      
        if ($keyword) {
            $query->where(function ($query) use ($keyword) {
                    $query->where('uraian', 'like', "%$keyword%")
                    ->orWhere('kode', 'LIKE', '%' . $keyword . '%');
                });
        }
    
        $data = $query->get();   

        return Excel::download(new AkunkeuanganExport($data), 'Akun_Keuangan.xlsx');
    }
    


    public function import()
    {
        $data['title'] = "Import Akun Keuangan";
        return view('master.akunkeuangan.import', $data);
    }
  


    public function storeimport(Request $request)
    {

            //
            $file = $request->file('file')->store('public/import');
            $import = new AkunkeuanganImport;
            $import->import($file);
            $sukses = $import->getRowCount();
            
            if($import->failures()->isNotEmpty()) {
                return back()->withFailures($import->failures())->with('gagal',$import->getRowCount()
                
            );;
         
            }
    
            return redirect()->route('master.akun.index')->with('success', 'Data berhasil diimport '.$import->getRowCount().' Data');
      
   }




    /************************ Jenis Akun Keuangan Routes Start ******************************/

    public function jenis()
    {
        $data['title'] = "Jenis Akun Keuangan";
        $limit = request('limit', 10);
        $data['data'] = Jenis_akun::orderBy('nama_akun', 'ASC')->paginate($limit);
        return view('master.akunkeuangan.jenis', $data);
    }
    
  
    public function detailjenis(string $id)
    {
        $data['title'] = "Detail Master Jenis Akun Keuangan";
        
        // Find the Jenis_akun by ID
        $data['jenis_akun'] = Jenis_akun::find($id);
    
        // Check if Jenis_akun is found
        if (!$data['jenis_akun']) {
            // Handle the case when Jenis_akun is not found, for example, redirect or show an error message.
            return redirect()->route('error');
        }
    
        $limit = request('limit', 10);

        // Fetch related data from AkunKeuangan based on jenis_akun field
        $data['data'] = AkunKeuangan::orderBy('kode', 'ASC')
            ->where('jenis_akun', 'like', '%' . $data['jenis_akun']->kode_akun . '%')
            ->paginate($limit);
    
        return view('master.akunkeuangan.detail', $data);
    }
    
    public function searchdetailjenis(Request $request, $id)
    {
        $data['title'] = "Cari Data";
        $limit = $request->input('limit', 10); // Use input method on $request to get the value, and set default to 10
    
        $keyword = $request->input('keyword');
    
        $data['jenis_akun'] = Jenis_akun::find($id);
    
        // Check if Jenis_akun is found
        if (!$data['jenis_akun']) {
            // Handle the case when Jenis_akun is not found, for example, redirect or show an error message.
            return redirect()->route('error');
        }
    
        $query = AkunKeuangan::query()->orderBy('kode', 'ASC')->Where('jenis_akun', 'like', '%' . $data['jenis_akun']->kode_akun . '%');
    
        $query->where(function ($query) use ($keyword, $data) {
            $query->where('uraian', 'like', "%$keyword%")
                ->orWhere('kode', 'LIKE', "%$keyword%") ;
        });
    
        $data['data'] = $query->paginate($limit);
    
        return view('master.akunkeuangan.detail', $data);
    }
            

    
    public function exportakun(Request $request,$id)
    {
        $keyword = $request->input('keyword'); // Ambil kata kunci pencarian dari input form
        $data['jenis_akun'] = Jenis_akun::find($id);
        $query = AkunKeuangan::query()->orderBy('kode', 'ASC')->Where('jenis_akun', 'like', '%' . $data['jenis_akun']->kode_akun . '%');
      
        if ($keyword) {
            $query->where(function ($query) use ($keyword) {
                    $query->where('uraian', 'like', "%$keyword%")
                    ->orWhere('kode', 'LIKE', '%' . $keyword . '%');
                });
        }
    
        $data = $query->get();   

        return Excel::download(new AkunkeuanganExport($data), 'Akun_Keuangan.xlsx');
    }
    


}
