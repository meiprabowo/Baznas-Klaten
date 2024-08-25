<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tahun;
use Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TahunExport;

class TahunController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = "Master Tahun";
        $limit = request('limit', 10);
        $data['data'] = Tahun::orderBy('nama_tahun', 'DESC')->paginate($limit);
        return view('master.tahun.index', $data);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = "Tambah Master Tahun";
        return view('master.tahun.tambah', $data);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'nama' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            Tahun::create([
                'nama_tahun' => $request->nama,
        ]);
        }

        return redirect()->route('master.tahun.index')
        ->with('success','Data Berhasil disimpan.');

    }

   
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['title'] = "Edit Tahun";
        $data['data'] = Tahun::find($id);
        return view('master.tahun.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'nama' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {

            Tahun::where('id', $id)
            ->update([
                'nama_tahun' => $request->nama,
                'status' => $request->status,
            ]);


        }
        return redirect()->route('master.tahun.index')
        ->with('success','Data Berhasil diperbaharui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Tahun::find($id)->delete();
        return redirect()->route('master.tahun.index')->with('warning', 'Data berhasil dihapus.');
    }



    public function search(Request $request)
    {

        $data['title'] = "Cari Data";
        $limit = request('limit', 10); // Jika tidak ada input dari pengguna, gunakan nilai default 10

        $keyword = $request->input('keyword');    
        $query = Tahun::query()->orderBy('nama_tahun', 'ASC');
        
        $query->where(function ($query) use ($keyword) {
                $query->where('nama_tahun', 'like', "%$keyword%");
            });
      
        
        $data['data'] = $query->paginate($limit);

        
        return view('master.tahun.index',$data);
    }



    public function export(Request $request)
    {
        $keyword = $request->input('keyword'); // Ambil kata kunci pencarian dari input form
        $query = Tahun::query()->orderBy('nama_tahun', 'ASC');
      
        if ($keyword) {
            $query->where(function ($query) use ($keyword) {
                    $query->where('nama_tahun', 'like', "%$keyword%");
                });
        }
    
        $data = $query->get();   
        return Excel::download(new TahunExport($data), 'Data.xlsx');
    }
    



    

}
