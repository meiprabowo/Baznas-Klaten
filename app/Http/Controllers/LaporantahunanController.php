<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use Validator;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;



class LaporantahunanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = "Master Laporan Tahunan";
        $limit = request('limit', 10);
        $data['data'] = Laporan::orderBy('tahun', 'DESC')->paginate($limit);
        return view('sdm.laporan.index', $data);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = "Tambah Master Laporan Tahunan";
        return view('sdm.laporan.tambah', $data);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'tahun' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            if ($request->hasFile('file')) {
            $file = $request->file('file');
            $nama_file = time()."_".$file->getClientOriginalName();
            $tujuan_upload = 'laporan';
            $file->move($tujuan_upload,$nama_file);     

            Laporan::create([
                'tahun' => $request->tahun,
                'keterangan' => $request->keterangan,
                'laporan' => $nama_file,
                'user_id' => Auth::user()->id,


        ]);

    } else {

        Laporan::create([
            'tahun' => $request->tahun,
            'keterangan' => $request->keterangan,
            'user_id' => Auth::user()->id,

    ]);



    }
        }

        return redirect()->route('sdm.laporantahunan.index')
        ->with('success','Data Berhasil disimpan.');

    }

   
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['title'] = "Edit Laporan  Tahunan";
        $data['data'] = Laporan::find($id);
        return view('sdm.laporan.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'tahun' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {


            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $nama_file = time()."_".$file->getClientOriginalName();
                $tujuan_upload = 'laporan';
                $file->move($tujuan_upload,$nama_file);     


            Laporan::where('id', $id)
            ->update([
                'tahun' => $request->tahun,
                'keterangan' => $request->keterangan,
                'laporan' => $nama_file,
                'user_id' => Auth::user()->id,
            ]);
        } else {

            Laporan::where('id', $id)
            ->update([
                'tahun' => $request->tahun,
                'keterangan' => $request->keterangan,
                'user_id' => Auth::user()->id,
            ]);

        }

        }
        return redirect()->route('sdm.laporantahunan.index')
        ->with('success','Data Berhasil diperbaharui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Laporan::find($id)->delete();
        return redirect()->route('sdm.laporantahunan.index')->with('warning', 'Data berhasil dihapus.');
    }



    public function search(Request $request)
    {

        $data['title'] = "Cari Data";
        $limit = request('limit', 10); // Jika tidak ada input dari pengguna, gunakan nilai default 10
           
        $query = Laporan::query()->orderBy('nama_tahun', 'ASC');
        
        $query->where(function ($query) use ($keyword) {
            $query->where('tahun', 'like', "%$keyword%")
            ->orWhere('keterangan', 'LIKE', '%' . $key . '%');

        });
      
        
        $data['data'] = $query->paginate($limit);

        
        return view('sdm.laporan.index',$data);
    }





    

}
