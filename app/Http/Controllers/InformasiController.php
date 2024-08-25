<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Informasi;
use Validator;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;



class InformasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = "Master Informasi";
        $limit = request('limit', 10);
        $data['data'] = Informasi::orderBy('id', 'DESC')->paginate($limit);
        return view('sdm.informasi.index', $data);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = "Tambah Master Informasi";
        return view('sdm.informasi.tambah', $data);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
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
            $tujuan_upload = 'informasi';
            $file->move($tujuan_upload,$nama_file);     

            Informasi::create([
                'tanggal' => $request->tanggal,
                'judul' => $request->judul,
                'keterangan' => $request->keterangan,
                'file' => $nama_file,
                'user_id' => Auth::user()->id,


        ]);

    } else {

        Informasi::create([
            'tanggal' => $request->tanggal,
            'judul' => $request->judul,
            'keterangan' => $request->keterangan,
            'user_id' => Auth::user()->id,

    ]);



    }
        }

        return redirect()->route('sdm.informasi.index')
        ->with('success','Data Berhasil disimpan.');

    }

   
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['title'] = "Edit Informasi";
        $data['data'] = Informasi::find($id);
        return view('sdm.informasi.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
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
                $tujuan_upload = 'informasi';
                $file->move($tujuan_upload,$nama_file);     
    

            Informasi::where('id', $id)
            ->update([
                'tanggal' => $request->tanggal,
                'judul' => $request->judul,
                'keterangan' => $request->keterangan,
                'file' => $nama_file,
                'user_id' => Auth::user()->id,
            ]);
        } else {

            Informasi::where('id', $id)
            ->update([
                'tanggal' => $request->tanggal,
                'judul' => $request->judul,
                'keterangan' => $request->keterangan,
                'user_id' => Auth::user()->id,
            ]);

        }

        }
        return redirect()->route('sdm.informasi.index')
        ->with('success','Data Berhasil diperbaharui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Informasi::find($id)->delete();
        return redirect()->route('sdm.informasi.index')->with('warning', 'Data berhasil dihapus.');
    }



    public function search(Request $request)
    {

        $data['title'] = "Cari Data";
        $limit = request('limit', 10); // Jika tidak ada input dari pengguna, gunakan nilai default 10
        $keyword = $request->input('keyword');    

        $query = Informasi::query()->orderBy('id', 'DESC');
        
        $query->where(function ($query) use ($keyword) {
            $query->where('judul', 'like', "%$keyword%")
            ->orWhere('keterangan', 'LIKE', '%' . $keyword . '%');

        });
      
        
        $data['data'] = $query->paginate($limit);

        
        return view('sdm.informasi.index',$data);
    }





    

}
