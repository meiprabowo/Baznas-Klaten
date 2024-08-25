<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Validator;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\WilayahImport;



class WilayahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = "Master Wilayah";
        $limit = request('limit', 10);
        $data['data'] = Kecamatan::orderBy('nama_kecamatan', 'ASC')->paginate($limit);
        foreach ($data['data'] as $kec) {

            $kelurahan = Kelurahan::where('id_kecamatan',$kec->id)->count();
      
            $kec->jmlkel = $kelurahan ? $kelurahan : "0";


        }


        return view('master.wilayah.index', $data);
    }
    
    public function full()
    {
        $data['title'] = "Master Wilayah";
        $data['data'] = Kelurahan::join('kecamatan','kecamatan.id','kelurahan.id_kecamatan')->orderby('kecamatan.nama_kecamatan','ASC')
                        ->select('kelurahan.id','kelurahan.nama_kelurahan','kelurahan.koordinat','kecamatan.nama_kecamatan')
                        ->get();


        return view('master.wilayah.full', $data);
}
  
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            Kecamatan::create([
                'nama_kecamatan' => $request->nama,
        ]);
        }

        return redirect()->route('master.wilayah.index')
        ->with('success','Data Berhasil disimpan.');

    }

    public function storee(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            Kelurahan::create([
                'nama_kelurahan' => $request->nama,
                'koordinat' => $request->koordinat,
                'id_kecamatan' => $request->id,
            ]);
        }

        return redirect()->back()
        ->with('success','Data Berhasil disimpan.');

    }

   
  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {

            Kecamatan::where('id', $id)
            ->update([
                'nama_kecamatan' => $request->nama,
            ]);


        }
        return redirect()->route('master.wilayah.index')
        ->with('success','Data Berhasil diperbaharui.');
    }

       /**
     * Update the specified resource in storage.
     */
    public function updatee(Request $request, string $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {

            Kelurahan::where('id', $id)
            ->update([
                'nama_kelurahan' => $request->nama,
                'koordinat' => $request->koordinat,
            ]);


        }
        return redirect()->back()

        ->with('success','Data Berhasil diperbaharui.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function detail($id)
    {
        $data['title'] = "Master Kelurahan";



        $data['id'] = $id;


        $data['data'] = Kecamatan::join('kelurahan', 'kecamatan.id', 'kelurahan.id_kecamatan')
                                ->select('kecamatan.nama_kecamatan','kelurahan.nama_kelurahan','kelurahan.koordinat','kelurahan.id')
                                ->where('kecamatan.id', $id)
                                ->get();
        return view('master.wilayah.detail',$data);
    }
    

    public function search(Request $request)
    {

        $data['title'] = "Cari Data";
        $limit = request('limit', 10); // Jika tidak ada input dari pengguna, gunakan nilai default 10

        $keyword = $request->input('keyword');    
        $query = Kecamatan::query()->orderBy('nama_tahun', 'ASC');
        
        $query->where(function ($query) use ($keyword) {
                $query->where('nama_tahun', 'like', "%$keyword%");
            });
      
        
        $data['data'] = $query->paginate($limit);

        
        return view('master.wilayah.index',$data);
    }



    public function export(Request $request)
    {
        $keyword = $request->input('keyword'); // Ambil kata kunci pencarian dari input form
        $query = Kecamatan::query()->orderBy('nama_tahun', 'ASC');
      
        if ($keyword) {
            $query->where(function ($query) use ($keyword) {
                    $query->where('nama_tahun', 'like', "%$keyword%");
                });
        }
    
        $data = $query->get();   
        return Excel::download(new TahunExport($data), 'Data.xlsx');
    }
    


    public function destroyk($id)
    {
        Kelurahan::find($id)->delete();
        return redirect()->back()->with('warning', 'Data berhasil dihapus.');
    }
    

    public function destroy($id)
    {
        Kecamatan::find($id)->delete();
        return redirect()->back()->with('warning', 'Data berhasil dihapus.');
    }
    

}
