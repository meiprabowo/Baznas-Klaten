<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\Surat_keluar;
use App\Models\Surat_masuk;
use Dompdf\Dompdf;
use App\Exports\Surat_keluarExport;
use App\Exports\Surat_masukExport;
use Validator;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;



class SuratController extends Controller
{

    public function index()
    {
        $data['title'] = "Master Surat Keluar";
        $limit = request('limit', 10);
        $data['data']=Surat_keluar::orderBy('id', 'DESC')->paginate($limit);
        return view('sdm.surat.index',$data);
    }

    public function masuk()
    {
        $data['title'] = "Master Surat Masuk";
        $limit = request('limit', 10);
        $data['data']=Surat_masuk::orderBy('id', 'DESC')->paginate(10);
        return view('sdm.surat.masuk', $data);
    }


    public function create()
    {
        $data['title'] = "Master Surat Keluar";

        return view('sdm.surat.tambahkeluar',$data);

    }


    public function tambah()
    {
        $data['title'] = "Master Surat Masuk";


        return view('sdm.surat.tambah',$data);

    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'tanggal' => 'required',
            'nomor' => 'required',
            'kepada' => 'required',
            'lokasi_tujuan' => 'required',
            'perihal' => 'required',
            'file_lampiran' => 'mimes:jpeg,png,jpg,pdf,doc,docx|max:10048',

        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            if ($request->hasFile('file_lampiran')) {
            $file = $request->file('file_lampiran');
            $nama_file = time()."_".$file->getClientOriginalName();
            $tujuan_upload = 'surat';
            $file->move($tujuan_upload,$nama_file);         
            Surat_keluar::create([
                'tahun' => session('tahun_aktif'),
                'tanggal' => $request->tanggal,
                'kepada' => $request->kepada,
                'lokasi_tujuan' => $request->lokasi_tujuan,
                'nomor_surat' => $request->nomor,
                    'perihal' => $request->perihal,
                    'isi_surat' => $request->diskripsi,
                    'lampiran' => $request->lampiran,
                    'tembusan' => $request->tembusan,
                    'file_lampiran' => $nama_file,
            ]);
        } else {
            Surat_keluar::create([
                'tahun' => session('tahun_aktif'),
                'tanggal' => $request->tanggal,
                'kepada' => $request->kepada,
                'nomor_surat' => $request->nomor,
                'lokasi_tujuan' => $request->lokasi_tujuan,
                'perihal' => $request->perihal,
                'tembusan' => $request->tembusan,
                'isi_surat' => $request->diskripsi,
                'lampiran' => $request->lampiran,
        ]);
    
        }
        }
        return redirect()->route('sdm.surat.index')->with('success','Data Berhasil disimpan.');
    
    }



  public function storemasuk(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'tanggal' => 'required',
            'nomor' => 'required',
            'kepada' => 'required',
            'perihal' => 'required',
            'file_lampiran' => 'mimes:jpeg,png,jpg,pdf,doc,docx|max:10048',

        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            if ($request->hasFile('lampiran')) {
            $file = $request->file('lampiran');
            $nama_file = time()."_".$file->getClientOriginalName();
            $tujuan_upload = 'surat';
            $file->move($tujuan_upload,$nama_file);         
            Surat_masuk::create([
                'tahun' => session('tahun_aktif'),
                'tanggal' => $request->tanggal,
                'kepada' => $request->kepada,
                'nomor_surat' => $request->nomor,
                    'pengirim' => $request->pengirim,
                    'perihal' => $request->perihal,
                    'deskripsi' => $request->deskripsi,
                    'lampiran' => $nama_file,
            ]);
        } else {
            Surat_masuk::create([
                'tahun' => session('tahun_aktif'),
                'tanggal' => $request->tanggal,
                'kepada' => $request->kepada,
                'pengirim' => $request->pengirim,
                'nomor_surat' => $request->nomor,
                'perihal' => $request->perihal,
                'deskripsi' => $request->diskripsi,
        ]);
    
        }
        }
        return redirect()->route('sdm.surat.masuk')->with('success','Data Berhasil disimpan.');
    
    }





    public function show(string $id)
    {

    $data = Surat_keluar::find($id);

    $pdf = PDF::loadView('sdm.surat.export', compact('data'));
    
    return $pdf->download('nama-file.pdf');
    }

    
    public function edit(string $id)
    {
        $data['title'] = "Master Surat Keluar";
        $data['data'] = Surat_keluar::find($id);
        return view('sdm.surat.edit', $data);
    }

 
     
    public function editmasuk(string $id)
    {
        $data['title'] = "Master Surat Masuk";
        $data['data'] = Surat_masuk::find($id);
        return view('sdm.surat.editmasuk', $data);
    }

 
    public function update(Request $request, string $id)
    {

         $validator = Validator::make($request->all(), [
            'tanggal' => 'required',
            'nomor' => 'required',
            'kepada' => 'required',
            'lokasi_tujuan' => 'required',
            'perihal' => 'required',
            'isi_surat' => 'required',
            'file_lampiran' => 'mimes:jpeg,png,jpg,pdf,doc,docx|max:10048',

        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            if ($request->hasFile('file_lampiran')) {
            $file = $request->file('file_lampiran');
            $nama_file = time()."_".$file->getClientOriginalName();
            $tujuan_upload = 'surat';
            $file->move($tujuan_upload,$nama_file);         
          Surat_keluar::where('id', $id)
        ->update([
                'tahun' => session('tahun_aktif'),
                'tanggal' => $request->tanggal,
                'kepada' => $request->kepada,
                'lokasi_tujuan' => $request->lokasi_tujuan,
                'nomor_surat' => $request->nomor,
                    'perihal' => $request->perihal,
                    'isi_surat' => $request->isi_surat,
                    'lampiran' => $request->lampiran,
                    'tembusan' => $request->tembusan,
                    'file_lampiran' => $nama_file,
            ]);
        } else {
            Surat_keluar::where('id', $id)
        ->update([
                'tahun' => session('tahun_aktif'),
                'tanggal' => $request->tanggal,
                'kepada' => $request->kepada,
                'nomor_surat' => $request->nomor,
                'lokasi_tujuan' => $request->lokasi_tujuan,
                'perihal' => $request->perihal,
                'tembusan' => $request->tembusan,
                'isi_surat' => $request->isi_surat,
                'lampiran' => $request->lampiran,
        ]);
    
        }
        }
        return redirect()->route('sdm.surat.index')->with('success','Data Berhasil disimpan.');

    }


    public function updatemasuk(Request $request, string $id)
    {

         $validator = Validator::make($request->all(), [
            'tanggal' => 'required',
            'nomor' => 'required',
            'kepada' => 'required',
            'perihal' => 'required',
            'lampiran' => 'mimes:jpeg,png,jpg,pdf,doc,docx|max:10048',

        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            if ($request->hasFile('lampiran')) {
            $file = $request->file('lampiran');
            $nama_file = time()."_".$file->getClientOriginalName();
            $tujuan_upload = 'surat';
            $file->move($tujuan_upload,$nama_file);         
          Surat_masuk::where('id', $id)
        ->update([
                'tahun' => session('tahun_aktif'),
                'tanggal' => $request->tanggal,
                'kepada' => $request->kepada,
                'pengirim' => $request->pengirim,
                'nomor_surat' => $request->nomor,
                    'perihal' => $request->perihal,
                    'deskripsi' => $request->deskripsi,
                    'lampiran' => $nama_file,
            ]);
        } else {
            Surat_masuk::where('id', $id)
        ->update([
                'tahun' => session('tahun_aktif'),
                'tanggal' => $request->tanggal,
                'kepada' => $request->kepada,
                'pengirim' => $request->pengirim,
                'nomor_surat' => $request->nomor,
                    'perihal' => $request->perihal,
                    'deskripsi' => $request->deskripsi,
        ]);
    
        }
        }
        return redirect()->route('sdm.surat.masuk')->with('success','Data Berhasil disimpan.');

    }


    public function destroy(string $id)
    {

        Surat_keluar::find($id)->delete();

        return redirect()->route('sdm.surat.index')->with('warning', 'Data berhasil dihapus.');

    }

    public function hapus(string $id)
    {

        Surat_masuk::find($id)->delete();

        return redirect()->route('sdm.surat.masuk')->with('warning', 'Data berhasil dihapus.');

    }


    public function export(Request $request) 
    {
        $keyword = $request->input('keyword'); // Ambil kata kunci pencarian dari input form
        $query = Surat_masuk::query()->orderBy('id', 'DESC');
      
        if ($keyword) {
            $query->where(function ($query) use ($keyword) {
                    $query->where('nomor_surat', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('kepada', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('pengirim', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('perihal', 'LIKE', '%' . $keyword . '%');
                });
        }
    
        $data = $query->get();   
    

        return Excel::download(new Surat_masukExport($data), 'Surat_Masuk.xlsx');
        
    }

  
    public function download(Request $request) 
    {
        $keyword = $request->input('keyword'); // Ambil kata kunci pencarian dari input form
        $query = Surat_keluar::query()->orderBy('id', 'DESC');
      
        if ($keyword) {
            $query->where(function ($query) use ($keyword) {
                    $query->where('nomor_surat', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('kepada', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('perihal', 'LIKE', '%' . $keyword . '%');
                });
        }
    
        $data = $query->get();   





        return Excel::download(new Surat_KeluarExport($data), 'Surat_keluar.xlsx');
        
    }

   
    public function search(Request $request)
    {

      


         $query = $request->input('keyword'); // Mendapatkan query pencarian dari input form
         $limit = $request->input('limit', 10); // Perbaikan: Menggunakan $request->input() untuk mendapatkan nilai 'limit'
         $data['title'] = "Master Surat Keluar";
     
         $data['data'] = Surat_keluar::where('nomor_surat', 'LIKE', '%' . $query . '%')
             ->orWhere('kepada', 'LIKE', '%' . $query . '%')
             ->orWhere('perihal', 'LIKE', '%' . $query . '%')
             ->paginate($limit); 
    
             

        
        return view('sdm.surat.index',$data); 


    }

    public function cari(Request $request)
    {
        $query = $request->input('keyword'); // Mendapatkan query pencarian dari input form
        $limit = $request->input('limit', 10); // Perbaikan: Menggunakan $request->input() untuk mendapatkan nilai 'limit'
        $data['title'] = "Master Surat Keluar";
    
        $data['data'] = Surat_masuk::where('nomor_surat', 'LIKE', '%' . $query . '%')
            ->orWhere('kepada', 'LIKE', '%' . $query . '%')
            ->orWhere('pengirim', 'LIKE', '%' . $query . '%')
            ->orWhere('perihal', 'LIKE', '%' . $query . '%')
            ->paginate($limit); 
    
        return view('sdm.surat.masuk', $data); 
    }

    


    public function cetak(string $id)
    {
        
     
    $data = Surat_keluar::find($id);

    $ttdonline = " 
    Nomor Surat : $data[nomor_surat]
    Perihal : $data[perihal]
    Tujuan : $data[kepada]
    ";
     
    $qrCode = QrCode::size(100)->generate($ttdonline);
    
    return view('sdm.surat.export', compact('data', 'qrCode'));
    }

 



}
