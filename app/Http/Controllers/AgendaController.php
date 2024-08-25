<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agenda;
use Validator;
use Illuminate\Support\Facades\Auth;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = "Master Agenda";
        $limit = request('limit', 10);
        $data['data'] = Agenda::orderBy('id', 'DESC')->paginate($limit);
        return view('sdm.agenda.index', $data);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = "Tambah Master Agenda";
        return view('sdm.agenda.tambah', $data);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'kegiatan' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
         

            Agenda::create([
                'kegiatan' => $request->kegiatan,
                'waktu_pelaksanaan' => $request->waktu_pelaksanaan,
                'status' => "Aktif",

            ]);


    }
       

        return redirect()->route('sdm.agenda.index')
        ->with('success','Data Berhasil disimpan.');

    }

   
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['title'] = "Edit Agenda";
        $data['data'] = Agenda::find($id);
        return view('sdm.agenda.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'kegiatan' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {


        
            Agenda::where('id', $id)
            ->update([
                'kegiatan' => $request->kegiatan,
                'waktu_pelaksanaan' => $request->waktu_pelaksanaan,
                'status' => $request->status,
            ]);
    

        }
        return redirect()->route('sdm.agenda.index')
        ->with('success','Data Berhasil diperbaharui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Agenda::find($id)->delete();
        return redirect()->route('sdm.agenda.index')->with('warning', 'Data berhasil dihapus.');
    }



    public function search(Request $request)
    {

        $data['title'] = "Cari Data";
        $limit = request('limit', 10); // Jika tidak ada input dari pengguna, gunakan nilai default 10
        $keyword = $request->input('keyword');    

        $query = Agenda::query()->orderBy('id', 'DESC');
        
        $query->where(function ($query) use ($keyword) {
            $query->where('kegiatan', 'like', "%$keyword%")
            ->orWhere('waktu_pelaksanaan', 'LIKE', '%' . $keyword . '%');

        });
      
        
        $data['data'] = $query->paginate($limit);

        
        return view('sdm.agenda.index',$data);
    }





    

}
