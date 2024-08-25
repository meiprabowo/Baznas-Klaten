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


class SpjController extends Controller
{

    public function index()
    {
        $data['title'] = "Master SPJ SDM umum";
        $limit = request('limit', 10);
        
        
        $data['data']=Kas::join('akunkeuangan', 'kas.kredit', '=', 'akunkeuangan.id')
        ->select('kas.id', 'kas.kredit','kas.keterangan', 'akunkeuangan.uraian', 'kas.jumlah', 'kas.tanggal','kas.file', 'kas.kode_transaksi')
        ->orderBy('kas.id','DESC')
        ->orderBy('kas.tanggal', 'DESC')
        ->where('kas.pengirim', 'SDM')
        ->where('kas.type', 'TU')
        ->where('kas.tahun', session('tahun_aktif')) ->paginate($limit);

         return view('sdm.spj.index', $data);

         
    }
    
    public function create()
    {
        $data['title'] = "Master Tambah Transaksi SDM umum";


        $data['sumber']=AkunKeuangan::where('jenis_akun','like','%VIASDM%')->orderBy('uraian','ASC')->get();
        $data['tujuan']=AkunKeuangan::where('jenis_akun','like','%TSDM%')->where('level','5')->orderBy('uraian','ASC')->get();

        return view('sdm.spj.tambah', $data);
    }
    
    public function store(request $request)
    {
        $jumlah = str_replace('.', '', $request->input('jumlah'));

        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date',
            'sumber' => 'required',
            'keperluan' => 'required',
            'jumlah' => 'required',
            'file' => 'mimes:jpeg,png,jpg,pdf,doc,docx|max:2048',
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
            $tujuan_upload = 'sdmumum';
            $file->move($tujuan_upload,$nama_file);         
            Kas::create([
                    'tanggal' => $request->tanggal,
                    'kode_transaksi' => Kas::generateTransactionCode($request->tanggal),
                    'jenis_kas' =>  'uang',
                    'pengirim' =>  'SDM',
                    'debet' =>  $request->keperluan,
                    'kredit' => $request->sumber,
                    'jumlah' =>  $jumlah,
                    'qty' =>  $request->qty,
                    'keterangan' =>  $request->keterangan,
                    'file' => $nama_file,
                    'tahun' => session('tahun_aktif'),
                    'user_id' => Auth::user()->id,
            ]);


        } else {

            Kas::create([
                'tanggal' => $request->tanggal,
                'kode_transaksi' => Kas::generateTransactionCode($request->tanggal),
                'jenis_kas' =>  'uang',
                'pengirim' =>  'SDM',
                'debet' =>  $request->keperluan,
                'kredit' => $request->sumber,
                'qty' =>  $request->qty,
                'jumlah' =>  $jumlah,
                'keterangan' =>  $request->keterangan,
                'tahun' => session('tahun_aktif'),
                'user_id' => Auth::user()->id,
            ]);


        
        }
        return redirect()->route('sdm.spj.index')
        ->with('success','Data Berhasil disimpan.');
    
        }
    }
    

    public function destroy($id)
    {
        Kas::where('id',$id)->where('pengirim', 'SDM')->where('type', 'TU')->delete();
        return redirect()->route('sdm.spj.index')->with('warning', 'Data berhasil dihapus.');
    }

    public function edit(string $id)
    {
        $data['title'] = "Master Edit Spj";
    
        $data['data'] = Kas::where('id', $id)->where('pengirim', 'SDM')->where('type', 'TU')->first();
    
        $data['sumber'] = AkunKeuangan::where('jenis_akun', 'like', '%VIASDM%')->orderBy('uraian', 'ASC')->get();
    
        $data['tujuan'] = AkunKeuangan::where('jenis_akun', 'like', '%TSDM%')->where('level', 5)->orderBy('uraian', 'ASC')->get();
    
        return view('sdm.spj.edit', $data);
    }
    

    public function update(Request $request, string $id)
    {
        $jumlah = str_replace('.', '', $request->input('jumlah'));

        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date',
            'sumber' => 'required',
            'keperluan' => 'required',
            'jumlah' => 'required',
            'file' => 'mimes:jpeg,png,jpg,pdf,doc,docx|max:2048',
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
            $tujuan_upload = 'sdmumum';
            $file->move($tujuan_upload,$nama_file);         
            Kas::where('id', $id)
            ->update([
                    'tanggal' => $request->tanggal,
                    'kode_transaksi' => Kas::generateTransactionCode($request->tanggal),
                    'jenis_kas' =>  'uang',
                    'pengirim' =>  'SDM',
                    'debet' =>  $request->keperluan,
                    'kredit' => $request->sumber,
                    'jumlah' =>  $jumlah,
                    'keterangan' =>  $request->keterangan,
                    'file' => $nama_file,
                    'tahun' => session('tahun_aktif'),
                    'user_id' => Auth::user()->id,
            ]);


        } else {

            Kas::where('id', $id)
            ->update([
                'tanggal' => $request->tanggal,
                'kode_transaksi' => Kas::generateTransactionCode($request->tanggal),
                'jenis_kas' =>  'uang',
                'pengirim' =>  'SDM',
                'debet' =>  $request->keperluan,
                'kredit' => $request->sumber,
                'jumlah' =>  $jumlah,
                'keterangan' =>  $request->keterangan,
                'tahun' => session('tahun_aktif'),
                'user_id' => Auth::user()->id,
            ]);


        
        }
        return redirect()->route('sdm.spj.index')
        ->with('success','Data Berhasil disimpan.');
    
        }
    }

    public function search(Request $request) // Use Request class
    {
        $dataku['title'] = "Master Spj";
        $limit = request('limit', 10);
    
        $key = $request->input('keyword'); // Mendapatkan query pencarian dari input form
    
        // Validasi query pencarian
        if (empty($key)) {
            return redirect()->route('sdm.spj.index');
        }
    
        // Query pencarian
        $dataku['data'] = Kas::join('akunkeuangan', 'kas.kredit', '=', 'akunkeuangan.id')
            ->select('kas.id', 'kas.kredit', 'kas.keterangan', 'akunkeuangan.uraian', 'kas.jumlah', 'kas.tanggal','kas.file', 'kas.kode_transaksi')
            ->where('kas.pengirim', 'SDM')
            ->where('kas.type', 'TU')
            ->where('kas.tahun', session('tahun_aktif'))
            ->where(function ($query) use ($key) {
                $query->where('kas.kode_transaksi', 'LIKE', '%' . $key . '%')
                    ->orWhere('kas.keterangan', 'LIKE', '%' . $key . '%')
                    ->orWhere('akunkeuangan.uraian', 'LIKE', '%' . $key . '%');
            })
            ->orderBy('kas.id','DESC')
            ->orderBy('kas.tanggal', 'DESC')
            ->paginate($limit);
    
        return view('sdm.spj.index', $dataku);
    }
    
    

 
    public function export(Request $request)
    {
        $key = $request->input('keyword');
    
        $data = Kas::join('akunkeuangan', 'kas.kredit', '=', 'akunkeuangan.id')
            ->select('kas.id', 'kas.kredit', 'kas.keterangan', 'akunkeuangan.uraian', 'kas.jumlah', 'kas.tanggal','kas.file', 'kas.kode_transaksi')
            ->where('kas.pengirim', 'SDM')
            ->where('kas.type', 'TU')
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
    

}