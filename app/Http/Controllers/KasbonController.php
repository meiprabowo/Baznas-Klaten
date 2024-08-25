<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kasbon;
use App\Models\Kas;
use App\Models\AkunKeuangan;
use Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Kasbonxport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Exports\SdmkasbonExport;
use App\Exports\KasbonExport;




use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class KasbonController extends Controller
{

    public function index()
    {
        $data['title'] = "Master Tambah Kasbon";
        $limit = request('limit', 10);
        $data['data']=Kasbon::where('tahun', session('tahun_aktif'))
        ->where('pemohon', 'SDM')
        ->orderBy('id','DESC')
        ->paginate($limit);
        foreach ($data['data'] as $item) {
         $akun = DB::table('kas')
         ->select('jumlah', 'tanggal')
         ->where('kasbon', '=', $item->id)->first();
         if ($akun) {
             $item->jml = $akun->jumlah; // Menyimpan jumlah pada objek $d
             $item->tgl = $akun->tanggal; // Menyimpan jumlah pada objek $d
         } else {
             $item->jml = null; // Menyimpan jumlah pada objek $d
             $item->tgl = null; // Menyimpan jumlah pada objek $d
         }
         }
         return view('sdm.kasbon.index', $data);

         
    }


    public function indexpd()
    {
        $data['title'] = "Master Tambah Kasbon";
        $limit = request('limit', 10);
        $data['data']=Kasbon::where('tahun', session('tahun_aktif'))
        ->where('pemohon', 'PD')
        ->orderBy('id','DESC')
        ->paginate($limit);
        foreach ($data['data'] as $item) {
         $akun = DB::table('kas')
         ->select('jumlah', 'tanggal')
         ->where('kasbon', '=', $item->id)->first();
         if ($akun) {
             $item->jml = $akun->jumlah; // Menyimpan jumlah pada objek $d
             $item->tgl = $akun->tanggal; // Menyimpan jumlah pada objek $d
         } else {
             $item->jml = null; // Menyimpan jumlah pada objek $d
             $item->tgl = null; // Menyimpan jumlah pada objek $d
         }
         }
         return view('pendistribusian.kasbon.index', $data);

         
    }
    
    public function create()
    {
        $data['title'] = "Master Tambah Kasbon";
        return view('sdm.kasbon.tambah', $data);
    }
    
    public function createpd()
    {
        $data['title'] = "Master Tambah Kasbon";
        return view('pendistribusian.kasbon.tambah', $data);
    }
    
  
  
    public function store(request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date',
        ]);
        $jumlah = str_replace('.', '', $request->input('jumlah'));

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $kasbon =  Kasbon::create([
                'tanggal' => $request->tanggal,
                'kode_kasbon' => Kasbon::generateTransactionCode($request->tanggal),
                'jumlah' =>  $jumlah,
                'keterangan' =>  $request->keterangan,
                'validator' =>  $request->tujuan,
                'tahun' => session('tahun_aktif'),
                'user_id' => Auth::user()->id,
        ]);
        }
        return redirect()->route('sdm.kasbon.index')->with('success','Data Berhasil disimpan.');

    }
    

    public function storepd(request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date',
        ]);
        $jumlah = str_replace('.', '', $request->input('jumlah'));

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $kasbon =  Kasbon::create([
                'tanggal' => $request->tanggal,
                'kode_kasbon' => Kasbon::generateTransactionCode($request->tanggal),
                'jumlah' =>  $jumlah,
                'keterangan' =>  $request->keterangan,
                'validator' =>  $request->tujuan,
                'pemohon' =>  "PD",
                'tahun' => session('tahun_aktif'),
                'user_id' => Auth::user()->id,
        ]);
        }
        return redirect()->route('pendistribusian.kasbon.indexpd')->with('success','Data Berhasil disimpan.');

    }
    



    public function destroy($id)
    {
        Kasbon::where('id',$id)->where('pemohon','SDM')->delete();
        return redirect()->route('sdm.kasbon.index')->with('warning', 'Data berhasil dihapus.');
    }


    public function destroypd($id)
    {
        Kasbon::where('id',$id)->where('pemohon','PD')->delete();
        return redirect()->route('pendistribusian.kasbon.indexpd')->with('warning', 'Data berhasil dihapus.');
    }
    public function destroykeuangan($id)
    {
        // Menghapus data dari tabel Kasbon
        Kasbon::where('id', $id)->delete();
    
        // Menghapus data dari tabel Kas jika ada
        $kas = Kas::where('kasbon', $id)->first();
        if ($kas) {
            $kas->delete();
        }
    
        return redirect()->route('keuangan.kasbon.indexkeuangan')->with('warning', 'Data berhasil dihapus.');
    }
    
    public function edit(string $id)
    {

        $data['title'] = "Master Edit Kasbon";

        $data['data'] = Kasbon::where('id', $id)->where('pemohon', 'SDM')->first();

        return view('sdm.kasbon.edit', $data);

    }

   
    public function editkeuangan(string $id)
    {

        $data['title'] = "Master Edit Kasbon";

        $data['data'] = Kasbon::where('id', $id)->first();

        return view('keuangan.kasbon.edit', $data);

    }


    public function editpd(string $id)
    {

        $data['title'] = "Master Edit Kasbon";

        $data['kasbon'] = Kasbon::where('id', $id)->where('pemohon', 'PD')->first();

        return view('pendistribusian.kasbon.edit', $data);

    }


    public function update(Request $request, string $id)
    {
        //
  
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date',
        ]);
        $jumlah = str_replace('.', '', $request->input('jumlah'));

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
       
        // $cek = Kasbon::where('id', $id)->where('tanggal', $request->tanggal)


        Kasbon::where('id', $id)
        ->update([
        'tanggal' => $request->tanggal,
        'kode_kasbon' => Kasbon::generateTransactionCode($request->tanggal),
        'jumlah' =>  $jumlah,
        'keterangan' =>  $request->keterangan,
        'tahun' => session('tahun_aktif'),
        'user_id' => Auth::user()->id,
        ]);
        
      
        return redirect()->route('sdm.kasbon.index')
        ->with('success','Data Berhasil dirubah.');
    
        }
    }




    public function updatekeuangan(Request $request, string $id)
    {
        //
  
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date',
        ]);
        $jumlah = str_replace('.', '', $request->input('jumlah'));

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
       
   
        Kasbon::where('id', $id)
        ->update([
        'tanggal' => $request->tanggal,
        'kode_kasbon' => Kasbon::generateTransactionCode($request->tanggal),
        'jumlah' =>  $jumlah,
        'keterangan' =>  $request->keterangan,
        'tahun' => session('tahun_aktif'),
        'user_id' => Auth::user()->id,
        ]);
        
      
        return redirect()->route('keuangan.kasbon.indexkeuangan')
        ->with('success','Data Berhasil dirubah.');
    
        }
    }







    public function updatepd(Request $request, string $id)
    {
        //
  
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date',
        ]);
        $jumlah = str_replace('.', '', $request->input('jumlah'));

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
       
        // $cek = Kasbon::where('id', $id)->where('tanggal', $request->tanggal)


        Kasbon::where('id', $id)
        ->update([
        'tanggal' => $request->tanggal,
        'kode_kasbon' => Kasbon::generateTransactionCode($request->tanggal),
        'jumlah' =>  $jumlah,
        'keterangan' =>  $request->keterangan,
        'tahun' => session('tahun_aktif'),
        'user_id' => Auth::user()->id,
        ]);
        
      
        return redirect()->route('pendistribusian.kasbon.indexpd')
        ->with('success','Data Berhasil dirubah.');
    
        }
    }





    public function tolak(Request $request, string $id)
    {
       
        Kasbon::where('id', $id)
        ->update([
        'status' => "N",
        'user_id' => Auth::user()->id,
        ]);
        
      
        return redirect()->route('keuangan.kasbon.indexkeuangan')
        ->with('success','Data Berhasil dirubah.');
    
    }









    public function search(Request $request) // Use Request class
    {
        $dataku['title'] = "Master Kasbon";
        $limit = request('limit', 10);

        $key = $request->input('keyword'); // Mendapatkan query pencarian dari input form
    
        $dataku['data'] = Kasbon::where('tahun', session('tahun_aktif'))
        ->where('pemohon', 'SDM')
            ->where(function ($query) use ($key) {
                $query->where('kode_kasbon', 'LIKE', '%' . $key . '%')
                ->orWhere('keterangan', 'LIKE', '%' . $key . '%')
                ->orWhere('jumlah', 'LIKE', '%' . $key . '%');
            })
            ->orderByDesc('id')
            ->orderByDesc('tanggal')
            ->paginate($limit);
    
        foreach ($dataku['data'] as $item) {
            $akun = DB::table('kas')
                ->select('jumlah', 'tanggal')
                ->where('kasbon', '=', $item->id)
                ->first();
    
            if ($akun) {
                $item->jml = $akun->jumlah; // Menyimpan jumlah pada objek $d
                $item->tgl = $akun->tanggal; // Menyimpan jumlah pada objek $d
            } else {
                $item->jml = null; // Menyimpan jumlah pada objek $d
                $item->tgl = null; // Menyimpan jumlah pada objek $d
            }
        }
    
        return view('sdm.kasbon.index', $dataku);
    }
    

 



    public function searchkeuangan(Request $request) // Use Request class
    {
        $dataku['title'] = "Master Kasbon";
        $limit = request('limit', 10);

        $key = $request->input('keyword'); // Mendapatkan query pencarian dari input form
    
        $dataku['data'] = Kasbon::where('tahun', session('tahun_aktif'))
            ->where(function ($query) use ($key) {
                $query->where('kode_kasbon', 'LIKE', '%' . $key . '%')
                ->orWhere('keterangan', 'LIKE', '%' . $key . '%')
                ->orWhere('jumlah', 'LIKE', '%' . $key . '%');
            })
            ->orderByDesc('id')
            ->orderByDesc('tanggal')
            ->paginate($limit);
    
            foreach ( $dataku['data'] as $item) {
                $akun = DB::table('kas')
                    ->select('jumlah', 'tanggal', 'kode_transaksi')
                    ->where('kasbon', '=', $item->id)
                    ->first();
                        
                if ($akun) {
                    $item->jml = $akun->jumlah; // Menyimpan jumlah pada objek $d
                    $item->tgl = $akun->tanggal; // Menyimpan jumlah pada objek $d
                    $item->kode = $akun->kode_transaksi; // Menyimpan jumlah pada objek $d
                } else {
                    $item->jml = null; // Menyimpan jumlah pada objek $d
                    $item->kode = null; // Menyimpan jumlah pada objek $d
                    $item->tgl = null; // Menyimpan jumlah pada objek $d
                }
            }
    
        return view('keuangan.kasbon.index', $dataku);
    }
    

 





    public function searchpd(Request $request) // Use Request class
    {
        $dataku['title'] = "Master Kasbon";
        $limit = request('limit', 10);

        $key = $request->input('keyword'); // Mendapatkan query pencarian dari input form
    
        $dataku['data'] = Kasbon::where('tahun', session('tahun_aktif'))
        ->where('pemohon', 'PD')
            ->where(function ($query) use ($key) {
                $query->where('kode_kasbon', 'LIKE', '%' . $key . '%')
                ->orWhere('keterangan', 'LIKE', '%' . $key . '%')
                ->orWhere('jumlah', 'LIKE', '%' . $key . '%');
            })
            ->orderByDesc('id')
            ->orderByDesc('tanggal')
            ->paginate($limit);
    
        foreach ($dataku['data'] as $item) {
            $akun = DB::table('kas')
                ->select('jumlah', 'tanggal')
                ->where('kasbon', '=', $item->id)
                ->first();
    
            if ($akun) {
                $item->jml = $akun->jumlah; // Menyimpan jumlah pada objek $d
                $item->tgl = $akun->tanggal; // Menyimpan jumlah pada objek $d
            } else {
                $item->jml = null; // Menyimpan jumlah pada objek $d
                $item->tgl = null; // Menyimpan jumlah pada objek $d
            }
        }
    
        return view('pendistribusian.kasbon.index', $dataku);
    }
    


    public function export(Request $request) // Use Request class
    {
        $key = $request->input('keyword'); // Mendapatkan query pencarian dari input form
        
        $data = Kasbon::where('tahun', session('tahun_aktif'))
        ->where('pemohon', 'SDM')
            ->when($key, function ($query) use ($key) {
                $query->where(function ($query) use ($key) {
                    $query->where('kode_kasbon', 'LIKE', '%' . $key . '%')
                          ->orWhere('keterangan', 'LIKE', '%' . $key . '%')
                          ->orWhere('jumlah', 'LIKE', '%' . $key . '%');
                });
            })
            ->orderByDesc('id')
            ->orderByDesc('tanggal')
            ->get();
    
        foreach ($data as $item) {
            $akun = DB::table('kas')
                ->select('jumlah', 'tanggal', 'kode_transaksi')
                ->where('kasbon', '=', $item->id)
                ->first();
                    
            if ($akun) {
                $item->jml = $akun->jumlah; // Menyimpan jumlah pada objek $d
                $item->tgl = $akun->tanggal; // Menyimpan jumlah pada objek $d
                $item->kode = $akun->kode_transaksi; // Menyimpan jumlah pada objek $d
            } else {
                $item->jml = null; // Menyimpan jumlah pada objek $d
                $item->kode = null; // Menyimpan jumlah pada objek $d
                $item->tgl = null; // Menyimpan jumlah pada objek $d
            }
        }
    
        return Excel::download(new SdmkasbonExport($data), 'Kasbon_SDMUmum.xlsx');
    }
    



    public function exportkeuangan(Request $request) // Use Request class
    {
        $key = $request->input('keyword'); // Mendapatkan query pencarian dari input form
        
        $data = Kasbon::where('tahun', session('tahun_aktif'))
            ->when($key, function ($query) use ($key) {
                $query->where(function ($query) use ($key) {
                    $query->where('kode_kasbon', 'LIKE', '%' . $key . '%')
                          ->orWhere('keterangan', 'LIKE', '%' . $key . '%')
                          ->orWhere('jumlah', 'LIKE', '%' . $key . '%');
                });
            })
            ->orderByDesc('id')
            ->orderByDesc('tanggal')
            ->get();
    
        foreach ($data as $item) {
            $akun = DB::table('kas')
                ->select('jumlah', 'tanggal', 'kode_transaksi')
                ->where('kasbon', '=', $item->id)
                ->first();
                    
            if ($akun) {
                $item->jml = $akun->jumlah; // Menyimpan jumlah pada objek $d
                $item->tgl = $akun->tanggal; // Menyimpan jumlah pada objek $d
                $item->kode = $akun->kode_transaksi; // Menyimpan jumlah pada objek $d
            } else {
                $item->jml = null; // Menyimpan jumlah pada objek $d
                $item->kode = null; // Menyimpan jumlah pada objek $d
                $item->tgl = null; // Menyimpan jumlah pada objek $d
            }
        }
    
        return Excel::download(new KasbonExport($data), 'Kasbon.xlsx');
    }
    





    public function exportpd(Request $request) // Use Request class
    {
        $key = $request->input('keyword'); // Mendapatkan query pencarian dari input form
        
        $data = Kasbon::where('tahun', session('tahun_aktif'))
        ->where('pemohon', 'PD')
            ->when($key, function ($query) use ($key) {
                $query->where(function ($query) use ($key) {
                    $query->where('kode_kasbon', 'LIKE', '%' . $key . '%')
                          ->orWhere('keterangan', 'LIKE', '%' . $key . '%')
                          ->orWhere('jumlah', 'LIKE', '%' . $key . '%');
                });
            })
            ->orderByDesc('id')
            ->orderByDesc('tanggal')
            ->get();
    
        foreach ($data as $item) {
            $akun = DB::table('kas')
                ->select('jumlah', 'tanggal', 'kode_transaksi')
                ->where('kasbon', '=', $item->id)
                ->first();
                    
            if ($akun) {
                $item->jml = $akun->jumlah; // Menyimpan jumlah pada objek $d
                $item->tgl = $akun->tanggal; // Menyimpan jumlah pada objek $d
                $item->kode = $akun->kode_transaksi; // Menyimpan jumlah pada objek $d
            } else {
                $item->jml = null; // Menyimpan jumlah pada objek $d
                $item->kode = null; // Menyimpan jumlah pada objek $d
                $item->tgl = null; // Menyimpan jumlah pada objek $d
            }
        }
    
        return Excel::download(new SdmkasbonExport($data), 'Kasbon_Pendistribusian.xlsx');
    }
    
    public function indexkeuangan()
    {
        $data['title'] = "Master Persetujuan Kasbon";
        $limit = request('limit', 10);

        $data['data']=Kasbon::where('tahun', session('tahun_aktif'))
        ->orderBy('id','DESC')
        ->paginate($limit);

        foreach ($data['data'] as $item) {
         $akun = DB::table('kas')
         ->select('jumlah', 'tanggal','kode_transaksi')
         ->where('kasbon', '=', $item->id)->first();
         if ($akun) {
             $item->jml = $akun->jumlah; // Menyimpan jumlah pada objek $d
             $item->tgl = $akun->tanggal; // Menyimpan jumlah pada objek $d
             $item->kode_trx = $akun->kode_transaksi; // Menyimpan jumlah pada objek $d
         } else {
             $item->jml = null; // Menyimpan jumlah pada objek $d
             $item->tgl = null; // Menyimpan jumlah pada objek $d
             $item->kode_trx = null; // Menyimpan jumlah pada objek $d
         }



         }
         return view('keuangan.kasbon.index', $data);

         
    }
    public function detailkeuangan(string $id)
    {
        $data['title'] = "Master Persetujuan Kasbon";
    
        $data['data'] = Kasbon::where('id', $id)->first();
    
        // Memastikan data ditemukan sebelum melakukan iterasi
        if ($data['data']) {
            $akun = DB::table('kas')
                ->select('jumlah', 'tanggal', 'kode_transaksi','keterangan','debet','kredit')
                ->where('kasbon', $data['data']->id)
                ->first();
            if ($akun) {
                $data['data']->jml = $akun->jumlah; // Menyimpan jumlah pada objek $data['data']
                $data['data']->tgll = $akun->tanggal; // Menyimpan jumlah pada objek $data['data']
                $data['data']->ket = $akun->keterangan; // Menyimpan jumlah pada objek $data['data']
                $data['data']->debet = $akun->debet; // Menyimpan jumlah pada objek $data['data']
                $data['data']->kredit = $akun->kredit; // Menyimpan jumlah pada objek $data['data']
            } else {
                $data['data']->jml = null; // Menyimpan jumlah pada objek $data['data']
                $data['data']->tgll = null; // Menyimpan jumlah pada objek $data['data']
                $data['data']->ket = null; // Menyimpan jumlah pada objek $data['data']
                $data['data']->debet = null; // Menyimpan jumlah pada objek $data['data']
                $data['data']->kredit =null; // Menyimpan jumlah pada objek $data['data']
           }
        } else {
            // Jika data tidak ditemukan, atur $data['data']->jml ke null
            $data['data']->jml = null;
            $data['data']->tgll = null; // Menyimpan jumlah pada objek $data['data']
            $data['data']->ket = null; // Menyimpan jumlah pada objek $data['data']
            $data['data']->debet = null; // Menyimpan jumlah pada objek $data['data']
            $data['data']->kredit =null; // Menyimpan jumlah pada objek $data['data']
      }
    
        // Mengatur sumber dan tujuan sesuai dengan kondisi
        $data['sumber'] = AkunKeuangan::where('jenis_akun', 'like', '%VIAPG%')->where('level', '5')->orderBy('uraian', 'ASC')->get();
    
        if ($data['data'] && $data['data']->pemohon == 'SDM') {
            $data['tujuan'] = AkunKeuangan::where('jenis_akun', 'like', '%VIASDM%')->where('level', '5')->orderBy('uraian', 'ASC')->get();
        } else {
            $data['tujuan'] = AkunKeuangan::where('jenis_akun', 'like', '%VIAPG%')->where('level', '5')->orderBy('uraian', 'ASC')->get();
        }
    
        return view('keuangan.kasbon.detail', $data);
    }
    

    public function persetujuan(Request $request, string $id)
    {
        $jumlah = str_replace('.', '', $request->input('jml_acc'));
    
        $validator = Validator::make($request->all(), [
            'tanggal_acc' => 'required|date',
            'sumber' => 'required',
            'keperluan' => 'required',
        ]);
    
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            // Periksa apakah kasbon dengan ID yang diberikan sudah ada
            $kasbon = Kas::where('kasbon', $id)->where('tahun', session('tahun_aktif'))->first();
    
            // Jika sudah ada
            if ($kasbon) {
                $kasbon->update([
                    'debet' => $request->keperluan,
                    'tanggal' => $request->tanggal_acc,
                    'kredit' => $request->sumber,
                    'jumlah' => $jumlah,
                    'keterangan' => $request->keterangan,
                    'user_id' => Auth::user()->id,
                ]);
            } else { // Jika belum ada
                Kas::create([
                    'tanggal' => $request->tanggal_acc,
                    'kode_transaksi' => Kas::generateTransactionCode($request->tanggal_acc),
                    'jenis_kas' => 'uang',
                    'kasbon' => $id,
                    'pengirim' => 'KU',
                    'type' => 'SPJ',
                    'debet' => $request->keperluan,
                    'kredit' => $request->sumber,
                    'qty' => $request->qty,
                    'jumlah' => $jumlah,
                    'keterangan' => $request->keterangan,
                    'tahun' => session('tahun_aktif'),
                    'user_id' => Auth::user()->id,
                ]);
    
                // Update status kasbon menjadi "A" (disetujui)
                Kasbon::where('id', $id)
                    ->update([
                        'status' => "A",
                        'user_id' => Auth::user()->id,
                    ]);
            }
    
            return redirect()->route('keuangan.kasbon.indexkeuangan')
                ->with('success', 'Data Berhasil disimpan.');
        }
    }
    

    public function cetakkeuangan(Request $request, $id)
    {
        $kas = Kasbon::where('id',$id)->first();  
        
               $nomor = $kas->kode_kasbon;
               $keterangan = $kas->keterangan;
               $tanggal = $kas->tanggal;
               $jumlah = $kas->jumlah;
           
               // Buat teks untuk QR code
               $text = "
                   Nomor Kasbon: $nomor
                   Keterangan: $keterangan
                   Jumlah: $jumlah
                   tanggal: $tanggal
               ";
           
               // Generate QR code dengan teks
               $qrCode = QrCode::size(300)->generate($text);
           
               // Masukkan data proposal dan QR code ke dalam array data
               $data = [
                   'data' => $kas,
                   'qrCode' => $qrCode
               ];




        $pdf = PDF::loadView('keuangan.kasbon.cetak', $data)->setPaper('A5', 'landscape');
        return $pdf->download('kasbon.pdf');


    }

    

    public function persetujuann(Request $request, $id)
    {
        $kas = Kasbon::where('tahun', session('tahun_aktif'))
                     ->where('id', $id)
                     ->first();
    
        if ($kas) {
            $akun = Kas::join('akunkeuangan', 'akunkeuangan.id', '=', 'kas.kredit')
            ->select('kas.jumlah', 'kas.tanggal', 'kas.kode_transaksi', 'akunkeuangan.uraian', 'kas.keterangan')
            ->where('kas.kasbon', '=', $kas->id)
            ->first();
 
            if ($akun) {
                $kas->kre = $akun->uraian;
                $kas->ket = $akun->keterangan;
                $kas->jml = $akun->jumlah;
                $kas->tgl = $akun->tanggal;
                $kas->kode_trx = $akun->kode_transaksi;
            } else {
                $kas->kre = null;
                $kas->ket = null;
                $kas->jml = null;
                $kas->tgl = null;
                $kas->kode_trx = null;
            }
    
            $nomor = $kas->kode_kasbon;
            $keterangan = $kas->keterangan;
            $tanggal = $kas->tanggal;
            $jumlah = $kas->jumlah;
    
            // Buat teks untuk QR code
            $text = "
                Nomor Kasbon: $nomor
                Keterangan: $keterangan
                Jumlah: $jumlah
                Tanggal: $tanggal
            ";
    
            // Generate QR code dengan teks
            $qrCode = QrCode::size(300)->generate($text);
    
            // Masukkan data proposal dan QR code ke dalam array data
            $data = [
                'data' => $kas,
                'qrCode' => $qrCode
            ];
    
            $pdf = PDF::loadView('keuangan.kasbon.persetujuan', $data)->setPaper('A4', 'portrait');
            return $pdf->download('persetujuan_kasbon.pdf');
        } else {
            // Tindakan jika data kasbon tidak ditemukan
            return response()->json(['error' => 'Kasbon tidak ditemukan'], 404);
        }
    }
    

    
}
