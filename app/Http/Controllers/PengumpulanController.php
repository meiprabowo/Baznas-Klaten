<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kas;
use App\Models\Muzaki;
use App\Models\AkunKeuangan;
use Validator;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Exports\MuzakiExport;
use App\Exports\MasterTransaksi;
use App\Exports\TransaksiExport;
use App\Exports\LappengExport;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Imports\TransaksiImport;


 


class PengumpulanController extends Controller
{

  
    public function index()
    {
        $data['title'] = "Master Transaksi Pengumpulan";
        $limit = request('limit', 10);
        
        
        $data['data']=Kas::join('akunkeuangan', 'kas.debet', '=', 'akunkeuangan.id')
        ->join('muzaki', 'kas.id_muzaki', '=', 'muzaki.id')
        ->select('muzaki.nama_muzaki','kas.id', 'kas.debet','kas.keterangan', 'akunkeuangan.uraian', 'kas.jumlah', 'kas.tanggal','kas.kode_transaksi')
        ->orderBy('kas.id','DESC')
        ->orderBy('kas.tanggal', 'DESC')
        ->where('kas.pengirim', 'PG')
        ->where('kas.type', 'SPJ')
        ->where('kas.tahun', session('tahun_aktif')) ->paginate($limit);

         return view('pengumpulan.transaksi.index', $data);

         
    }
    

    public function wa(Request $request)
    {

        $data['title'] = "Master Transaksi Pengumpulan";
        $limit = $request->input('limit', 10);
        $bulan = (int) $request->input('bulan'); // Assuming 'bulan' is the parameter you want to check
        
        $laporanQuery = Kas::join('muzaki', 'kas.dinas', '=', 'muzaki.id')
                        ->where('kas.tahun', session('tahun_aktif'));
    
        if (!empty($bulan)) {
            $laporanQuery->whereMonth('kas.tanggal', $bulan);
        }
    
        $data['data'] = $laporanQuery
        ->select('kas.dinas', 'muzaki.nama_muzaki')
        ->where(function ($query) {
            $query->where('wa', 'B')
                  ->orWhere('wa', 'S');
        })
        ->groupBy('kas.dinas', 'muzaki.nama_muzaki')
        ->orderBy('muzaki.nama_muzaki', 'ASC')
        ->paginate($limit);
    
           
    $data['jml'] = $laporanQuery
                        ->select('kas.dinas', 'muzaki.nama_muzaki','muzaki.hp','kas.wa')
                        ->where('kas.wa','B')
                        ->groupBy('kas.dinas', 'muzaki.nama_muzaki')
                        ->orderBy('muzaki.nama_muzaki', 'ASC')
                        ->count();
     $data['sudah'] = $laporanQuery
                        ->select('kas.dinas', 'muzaki.nama_muzaki','muzaki.hp','kas.wa')
                        ->where('kas.wa','S')
                        ->groupBy('kas.dinas', 'muzaki.nama_muzaki')
                        ->orderBy('muzaki.nama_muzaki', 'ASC')
                        ->count();
           

        foreach ($data['data'] as $datalalu) {
        
  
            $zakat = Kas::join('akunkeuangan', 'kas.debet', '=', 'akunkeuangan.id')->where('akunkeuangan.jenis_akun','like','%ZKT%')
            ->where('kas.pengirim', 'PG')->where('kas.type','SPJ')
            ->whereYear('kas.tanggal', session('tahun_aktif'))
            ->whereMonth('kas.tanggal',$bulan)->select(\DB::raw('SUM(kas.jumlah) as zakattotal'))->first();
            
            $datalalu->zakattotal = $zakat ? $zakat->zakattotal : null;              

            $infaq = Kas::join('akunkeuangan', 'kas.debet', '=', 'akunkeuangan.id')
            ->where('akunkeuangan.jenis_akun','like','%%IFQ%%')
            ->where('kas.pengirim', 'PG')->where('kas.type','SPJ')
            ->whereYear('kas.tanggal', session('tahun_aktif'))
            ->whereMonth('kas.tanggal', $bulan)
            ->select(\DB::raw('SUM(kas.jumlah) as infaqtotal'))
            ->first();
         
            $datalalu->infaqtotal = $infaq ? $infaq->infaqtotal : null;              

        }
    
        return view('pengumpulan.transaksi.wa', $data);

    }

    public function wabelumact(Request $request, $id)
    {
        $bulan = $request->input('bulan'); // Menggunakan input dari request untuk mendapatkan nilai 'bulan'
        
        Kas::where('dinas', $id)
            ->whereMonth('tanggal', $bulan)
            ->update([
                'wa' => "B",
            ]);
    
        return redirect()->back()->with('success', 'Data Berhasil diupdate.');
    }
    
    public function wabelum(Request $request)
    {

        $data['title'] = "Master Transaksi Pengumpulan";
        $limit = $request->input('limit', 10);
        $bulan = (int) $request->input('bulan'); // Assuming 'bulan' is the parameter you want to check
        
        $laporanQuery = Kas::join('muzaki', 'kas.dinas', '=', 'muzaki.id')
                        ->where('kas.tahun', session('tahun_aktif'));
    
        if (!empty($bulan)) {
            $laporanQuery->whereMonth('kas.tanggal', $bulan);
        }
    
        $data['data'] = $laporanQuery
                        ->select('kas.dinas', 'muzaki.nama_muzaki')
                        ->groupBy('kas.dinas', 'muzaki.nama_muzaki')
                        ->where('wa','N')
                        ->orderBy('muzaki.nama_muzaki', 'ASC')
                        ->paginate($limit);
           
    $data['jml'] = $laporanQuery
                        ->select('kas.dinas', 'muzaki.nama_muzaki','muzaki.hp','kas.wa')
                        ->where('kas.wa','B')
                        ->groupBy('kas.dinas', 'muzaki.nama_muzaki')
                        ->orderBy('muzaki.nama_muzaki', 'ASC')
                        ->count();
     $data['sudah'] = $laporanQuery
                        ->select('kas.dinas', 'muzaki.nama_muzaki','muzaki.hp','kas.wa')
                        ->where('kas.wa','S')
                        ->groupBy('kas.dinas', 'muzaki.nama_muzaki')
                        ->orderBy('muzaki.nama_muzaki', 'ASC')
                        ->count();
           

        foreach ($data['data'] as $datalalu) {
        
  
            $zakat = Kas::join('akunkeuangan', 'kas.debet', '=', 'akunkeuangan.id')->where('akunkeuangan.jenis_akun','like','%ZKT%')
            ->where('kas.pengirim', 'PG')->where('kas.type','SPJ')
            ->whereYear('kas.tanggal', session('tahun_aktif'))


            ->whereMonth('kas.tanggal',$bulan)->select(\DB::raw('SUM(kas.jumlah) as zakattotal'))->first();
            
            $datalalu->zakattotal = $zakat ? $zakat->zakattotal : null;              

            $infaq = Kas::join('akunkeuangan', 'kas.debet', '=', 'akunkeuangan.id')
            ->where('akunkeuangan.jenis_akun','like','%%IFQ%%')
            ->where('kas.pengirim', 'PG')->where('kas.type','SPJ')
            ->whereYear('kas.tanggal', session('tahun_aktif'))


            ->whereMonth('kas.tanggal', $bulan)
            ->select(\DB::raw('SUM(kas.jumlah) as infaqtotal'))
            ->first();
         
            $datalalu->infaqtotal = $infaq ? $infaq->infaqtotal : null;              

        }
        $data['bulan'] = (int) $request->input('bulan'); // Assuming 'bulan' is the parameter you want to check

        return view('pengumpulan.transaksi.wa', $data);

    }



    public function laporan(Request $request)
    {
        $data['title'] = "Master Transaksi Pengumpulan";
        $limit = $request->input('limit', 10);
        $bulan = (int) $request->input('bulan'); // Assuming 'bulan' is the parameter you want to check
        
        $laporanQuery = Kas::join('muzaki', 'kas.dinas', '=', 'muzaki.id')
                        ->where('kas.tahun', session('tahun_aktif'));
    
        if (!empty($bulan)) {
            $laporanQuery->whereMonth('kas.tanggal', $bulan);
        }
    
        $data['data'] = $laporanQuery
                        ->select('kas.dinas', 'muzaki.nama_muzaki')
                        ->groupBy('kas.dinas', 'muzaki.nama_muzaki')
                        ->orderBy('muzaki.nama_muzaki', 'ASC')
                        ->paginate($limit);
     

    
        
            foreach ($data['data'] as $datalalu) {
        
                $tgl = Kas::where('kas.dinas', $datalalu->dinas)
                ->whereMonth('kas.tanggal', $bulan)
                ->orderby('kas.tanggal','DESC')
                ->first();
                $datalalu->tanggal = $tgl ? $tgl->tanggal : null;      
    
    
    
                
                $bulanlalu = Kas::whereMonth('kas.tanggal', '<', $bulan)
                ->where('kas.pengirim', 'PG')->where('kas.type','SPJ')
                ->whereYear('kas.tanggal', session('tahun_aktif'))
                ->where('kas.dinas', $datalalu->dinas)
                ->select(\DB::raw('SUM(kas.jumlah) as total_nominal_kemarin'))->first();
                $datalalu->jmlblnkemarin = $bulanlalu ? $bulanlalu->total_nominal_kemarin : null;              
    
                $zakat = Kas::join('akunkeuangan', 'kas.kredit', '=', 'akunkeuangan.id')->where('akunkeuangan.jenis_akun','like','%ZKT%')
                ->where('kas.pengirim', 'PG')->where('kas.type','SPJ')
                ->whereYear('kas.tanggal',  session('tahun_aktif'))
                ->where('kas.dinas', $datalalu->dinas)
                ->whereMonth('kas.tanggal',$bulan)->select(\DB::raw('SUM(kas.jumlah) as zakattotal'))->first();
                
                $datalalu->zakattotal = $zakat ? $zakat->zakattotal : null;              
    
                $infaq = Kas::join('akunkeuangan', 'kas.kredit', '=', 'akunkeuangan.id')
                ->where('kas.pengirim', 'PG')->where('kas.type','SPJ')
                ->whereYear('kas.tanggal',  session('tahun_aktif'))
                ->where('akunkeuangan.jenis_akun','like','%%IFQ%%')
                ->whereMonth('kas.tanggal', $bulan)
                ->where('kas.dinas', $datalalu->dinas)
                ->select(\DB::raw('SUM(kas.jumlah) as infaqtotal'))
                ->first();
             
                $datalalu->infaqtotal = $infaq ? $infaq->infaqtotal : null;        
          

        }
    
        return view('pengumpulan.transaksi.laporan', $data);
    }
    
public function laporanexport(Request $request)
{
    $keyword = $request->input('keyword'); // Ambil kata kunci pencarian dari input form
    $bulan = (int) $request->input('bulan'); // Ambil bulan dari input form

    $query = Kas::join('muzaki', 'kas.dinas', '=', 'muzaki.id')
                ->where('kas.tahun', session('tahun_aktif'))
                ->whereMonth('kas.tanggal', $bulan);

    $query->select('kas.dinas', 'muzaki.nama_muzaki')
          ->groupBy('kas.dinas', 'muzaki.nama_muzaki')
          ->orderBy('muzaki.nama_muzaki', 'ASC');

    if ($keyword) {
        $query->where(function ($query) use ($keyword) {
            $query->where('muzaki.nama_muzaki', 'like', "%$keyword%")
                ;
        });
    }

    $data = $query->get();

 



    foreach ($data as $datalalu) {

        $tgl = Kas::where('kas.dinas', $datalalu->dinas)
        ->whereMonth('kas.tanggal', $bulan)
        ->orderby('kas.tanggal','DESC')
        ->first();
        $datalalu->tanggal = $tgl ? $tgl->tanggal : null;      



        $bulanlalu = Kas::where('kas.tahun', session('tahun_aktif'))
                        ->whereMonth('kas.tanggal', '<', $bulan)
                        ->where('kas.pengirim', 'PG')->where('kas.type','SPJ')
                        ->where('kas.dinas', $datalalu->dinas)
                        ->select(\DB::raw('SUM(kas.jumlah) as total_nominal_kemarin'))
                        ->first();
        $datalalu->jmlblnkemarin = $bulanlalu ? $bulanlalu->total_nominal_kemarin : null;

        $zakat = Kas::join('akunkeuangan', 'kas.kredit', '=', 'akunkeuangan.id')
                    ->where('akunkeuangan.jenis_akun', 'like', '%ZKT%')
                    ->where('kas.pengirim', 'PG')->where('kas.type','SPJ')
                    ->whereYear('kas.tanggal', session('tahun_aktif'))

                            ->whereMonth('kas.tanggal', $bulan)
                    ->where('kas.dinas', $datalalu->dinas)
                    ->select(\DB::raw('SUM(kas.jumlah) as zakattotal'))
                    ->first();
        $datalalu->zakattotal = $zakat ? $zakat->zakattotal : null;
        $datalalu->count_zakat = Kas::join('akunkeuangan', 'kas.kredit', '=', 'akunkeuangan.id')
        ->where('akunkeuangan.jenis_akun', 'like', '%ZKT%')
        ->where('kas.pengirim', 'PG')->where('kas.type', 'SPJ')
        ->whereYear('kas.tanggal', session('tahun_aktif'))
        ->whereMonth('kas.tanggal', $bulan)
        ->where('kas.dinas', $datalalu->dinas)
        ->count();



        $infaq = Kas::join('akunkeuangan', 'kas.kredit', '=', 'akunkeuangan.id')
                    ->where('akunkeuangan.jenis_akun', 'like', '%IFQ%')
                    ->where('kas.pengirim', 'PG')->where('kas.type','SPJ')
                    ->whereYear('kas.tanggal', session('tahun_aktif'))

                            ->whereMonth('kas.tanggal', $bulan)
                    ->where('kas.dinas', $datalalu->dinas)
                    ->select(\DB::raw('SUM(kas.jumlah) as infaqtotal'))
                    ->first();
        $datalalu->infaqtotal = $infaq ? $infaq->infaqtotal : null;
        $datalalu->count_infaq = Kas::join('akunkeuangan', 'kas.kredit', '=', 'akunkeuangan.id')
        ->where('akunkeuangan.jenis_akun', 'like', '%IFQ%')
        ->where('kas.pengirim', 'PG')->where('kas.type', 'SPJ')
        ->whereYear('kas.tanggal', session('tahun_aktif'))
        ->whereMonth('kas.tanggal', $bulan)
        ->where('kas.dinas', $datalalu->dinas)
        ->count();
    }

    return Excel::download(new LappengExport($data), 'transaksi_pengumpulan.xlsx');
}

    


    public function create(Request $request)
    {
        $data['title'] = "Transaksi Pengumpulan";
        $limit = request('limit', 10); // Jika tidak ada input dari pengguna, gunakan nilai default 10

        $keyword = $request->input('keyword');    
        $query = Muzaki::query()->orderBy('nama_muzaki', 'ASC');
        
        $query->where(function ($query) use ($keyword) {
                $query->where('nama_muzaki', 'like', "%$keyword%")
                ->orWhere('npwz', 'LIKE', '%' . $keyword . '%')
                ->orWhere('npwp', 'LIKE', '%' . $keyword . '%')
                ->orWhere('hp', 'LIKE', '%' . $keyword . '%')
                ;
            });

        $data['data'] = $query->paginate($limit);

        return view('pengumpulan.transaksi.tambah', $data);

    }

  

    public function bayar(string $id)
    {
        $data['title'] = "Transaksi Pengumpulan";
 
        $data['data'] = Muzaki::find($id);
        $data['sumber']=AkunKeuangan::where('jenis_akun','like','%VIAPG%')->where('level','5')->orderBy('uraian','ASC')->get();
        $data['tujuan']=AkunKeuangan::where('jenis_akun','like','%TPG%')->where('level','5')->orderBy('uraian','ASC')->get();


        return view('pengumpulan.transaksi.bayar', $data);

    }


    public function bayarpost(request $request, string $id)
    {
        $jumlah = str_replace('.', '', $request->input('jumlah'));

        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date',
            'sumber' => 'required',
            'keperluan' => 'required',
            'jumlah' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {

            $muzaki  = Muzaki::find($id);
            if($muzaki->type == 'P')
            {
                $dinas = $muzaki->dinas;
            } else {
                $dinas = $muzaki->id;
            }

            Kas::create([
                    'tanggal' => $request->tanggal,
                    'kode_transaksi' => Kas::SPJKas($request->tanggal),
                    'jenis_kas' =>  'uang',
                    'pengirim' =>  'PG',
                    'type' =>  'SPJ',
                    'id_muzaki' =>  $id,
                    'debet' =>  $request->sumber,
                    'kredit' => $request->keperluan,
                    'jumlah' =>  $jumlah,
                    'dinas' =>  $dinas,
                    'qty' =>  "1",
                    'keterangan' =>  $request->keterangan,
                    'tahun' => session('tahun_aktif'),
                    'user_id' => Auth::user()->id,
            ]);

        return redirect()->route('pengumpulan.pengumpulan.index')
        ->with('success','Data Berhasil disimpan.');
    
        }
    }
    


    public function searchdetail(Request $request)
    {
        $data['title'] = "Transaksi Pengumpulan";
        $limit = request('limit', 10); // Jika tidak ada input dari pengguna, gunakan nilai default 10

        $keyword = $request->input('keyword');    
        $query = Muzaki::query()->orderBy('nama_muzaki', 'ASC');
        
        $query->where(function ($query) use ($keyword) {
                $query->where('nama_muzaki', 'like', "%$keyword%")
                ->orWhere('npwz', 'LIKE', '%' . $keyword . '%')
                ->orWhere('npwp', 'LIKE', '%' . $keyword . '%')
                ->orWhere('hp', 'LIKE', '%' . $keyword . '%')
                ;
            });

        $data['data'] = $query->paginate($limit);

        return view('pengumpulan.transaksi.tambah', $data);

    }

  
 
   
    public function cetak(Request $request, $id)
    {
        $data = Kas::join('akunkeuangan', 'kas.debet', '=', 'akunkeuangan.id')
            ->join('muzaki', 'kas.id_muzaki', '=', 'muzaki.id')
            ->select('muzaki.nama_muzaki', 'kas.id', 'kas.debet','kas.kredit', 'kas.keterangan', 
            'akunkeuangan.uraian', 'kas.jumlah', 'kas.tanggal', 'kas.kode_transaksi'
            , 'muzaki.npwp','muzaki.npwz','muzaki.hp','muzaki.email','muzaki.telp','muzaki.alamat')
            ->where('kas.id', $id)
            ->where('kas.pengirim', '=', 'PG')
            ->where('kas.type', '=', 'SPJ')
            ->where('kas.tahun', '=', session('tahun_aktif'))
            ->first();
            
            foreach ($data as $cetak) { 
                $via = AkunKeuangan::find($data->kredit);
                $data->kredituraian = $via ? $via->uraian : null;              
            }

            $nomor = $data->kode_transaksi;
            $muzaki = $data->nama_muzaki;
            $keterangan = $data->keterangan;
           
               $text = "
                   Nomor Transaksi: $nomor
                   Muzaki :  $muzaki
                   Keterangan : $keterangan
               ";
           
               $qrCode = QrCode::size(300)->generate($text);
           
               $data = [
                   'data' => $data,
                   'qrCode' => $qrCode
               ];

               $pdf = PDF::loadView('pengumpulan.transaksi.cetak', $data)->setPaper('A4', 'portrait');
               return $pdf->stream('transaksi.pdf');


    }



    public function destroy($id)
    {

        Kas::where('id',$id)->where('pengirim','PG')
        ->where('type','SPJ')
        ->delete();
        return redirect()->route('pengumpulan.pengumpulan.index')->with('warning', 'Data berhasil dihapus.');

    }


    public function edit(string $id)
    {
        $data['title'] = "Edit Transaksi Pengumpulan";
 
        $data['data'] = Kas::join('muzaki', 'kas.id_muzaki', '=', 'muzaki.id')
        ->select('kas.id','muzaki.nama_muzaki','muzaki.npwz','kas.debet','kas.kredit','kas.jumlah','kas.keterangan')
        ->where('kas.id',$id)->where('kas.pengirim','PG')
        ->where('kas.type','SPJ')->first();

        $data['sumber']=AkunKeuangan::where('jenis_akun','like','%VIAPG%')->where('level','5')->orderBy('uraian','ASC')->get();
        $data['tujuan']=AkunKeuangan::where('jenis_akun','like','%TPG%')->where('level','5')->orderBy('uraian','ASC')->get();


        return view('pengumpulan.transaksi.edit', $data);

    }



    public function update(request $request, string $id)
    {
        $jumlah = str_replace('.', '', $request->input('jumlah'));

        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date',
            'sumber' => 'required',
            'keperluan' => 'required',
            'jumlah' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            Kas::where('id', $id)
            ->update([
                    'tanggal' => $request->tanggal,
                    'jenis_kas' =>  'uang',
                    'debet' =>  $request->sumber,
                    'kredit' => $request->keperluan,
                    'jumlah' =>  $jumlah,
                    'keterangan' =>  $request->keterangan,
                    'tahun' => session('tahun_aktif'),
                    'user_id' => Auth::user()->id,
            ]);

        return redirect()->route('pengumpulan.pengumpulan.index')
        ->with('success','Data Berhasil diudpate.');
    
        }
    }
    


    public function import()
    {
        $data['title'] = "Import Data Transaksi";
        $data['sumber']=AkunKeuangan::where('jenis_akun','like','%VIAPG%')->where('level','5')->orderBy('uraian','ASC')->get();
        $data['dinas']=Muzaki::where('type','L')->orderBy('nama_muzaki','ASC')->get();

        return view('pengumpulan.transaksi.import', $data);

    }

     
   
    public function download()
    {
        return Excel::download(new MasterTransaksi(), 'import_transaksi.xlsx');

    }

     
    
    public function importstore(Request $request)
    {
     //
     $file = $request->file('file')->store('public/import');
     $sumber = $request->sumber;
     $dinas = $request->dinas;

     $import = new TransaksiImport($sumber,$dinas); 
     $import->import($file);
     $sukses = $import->getRowCount();
     
     if($import->failures()->isNotEmpty()) {
         return back()->withFailures($import->failures())->with('gagal',$import->getRowCount()
         
     );;
  
     }

     return redirect()->route('pengumpulan.pengumpulan.index')->with('success', 'Data berhasil diimport '.$import->getRowCount().' Data');
        
    }



    public function search(Request $request)
    {

        $data['title'] = "Cari Data";
        $limit = request('limit', 10); // Jika tidak ada input dari pengguna, gunakan nilai default 10

        $keyword = $request->input('keyword');    
        $query =   Kas::query()->join('akunkeuangan', 'kas.debet', '=', 'akunkeuangan.id')
        ->join('muzaki', 'kas.id_muzaki', '=', 'muzaki.id')
        ->select('muzaki.nama_muzaki','kas.id', 
        'muzaki.npwp','muzaki.hp',
        'kas.debet','kas.keterangan', 'akunkeuangan.uraian', 'kas.jumlah', 'kas.tanggal','kas.kode_transaksi')
        ->orderBy('kas.id','DESC')
        ->orderBy('kas.tanggal', 'DESC')
        ->where('kas.pengirim', 'PG')
        ->where('kas.type', 'SPJ')
        ->where('kas.tahun', session('tahun_aktif'));




        $query->where(function ($query) use ($keyword) {
                $query->where('muzaki.nama_muzaki', 'like', "%$keyword%")
                ->orWhere('muzaki.npwp', 'LIKE', '%' . $keyword . '%')
                ->orWhere('muzaki.hp', 'LIKE', '%' . $keyword . '%')
                ->orWhere('kas.kode_transaksi', 'LIKE', '%' . $keyword . '%')
                ;
            });
      
        
        $data['data'] = $query->paginate($limit);

        
        return view('pengumpulan.transaksi.index',$data);
    }

public function searchh(Request $request)
{
    $title = "Cari Data";
    $limit = $request->input('limit', 10); // Jika tidak ada input dari pengguna, gunakan nilai default 10

    $keyword = $request->input('keyword'); // Ambil kata kunci pencarian dari input form
    $bulan = (int) $request->input('bulan'); // Ambil bulan dari input form

    $query = Kas::join('muzaki', 'kas.dinas', '=', 'muzaki.id')
                ->where('kas.tahun', session('tahun_aktif'))
                ->whereMonth('kas.tanggal', $bulan);

    $query->select('kas.dinas', 'muzaki.nama_muzaki')
          ->groupBy('kas.dinas', 'muzaki.nama_muzaki')
          ->orderBy('muzaki.nama_muzaki', 'ASC');

    if ($keyword) {
        $query->where(function ($query) use ($keyword) {
            $query->where('muzaki.nama_muzaki', 'like', "%$keyword%");
        });
    }

    $data = $query->paginate($limit);

    foreach ($data as $datalalu) {
        $bulanlalu = Kas::where('kas.tahun', session('tahun_aktif'))
                        ->whereMonth('kas.tanggal', '<', $bulan)
                        ->where('kas.dinas', $datalalu->dinas)
                        ->select(\DB::raw('SUM(kas.jumlah) as total_nominal_kemarin'))
                        ->first();
        $datalalu->jmlblnkemarin = $bulanlalu ? $bulanlalu->total_nominal_kemarin : null;

        $zakat = Kas::join('akunkeuangan', 'kas.debet', '=', 'akunkeuangan.id')
                    ->where('akunkeuangan.jenis_akun', 'like', '%ZKT%')
                    ->where('kas.pengirim', 'PG')->where('kas.type','SPJ')
                    ->whereYear('kas.tanggal', session('tahun_aktif'))
                    ->whereMonth('kas.tanggal', $bulan)
                    ->where('kas.dinas', $datalalu->dinas)
                    ->select(\DB::raw('SUM(kas.jumlah) as zakattotal'))
                    ->first();
        $datalalu->zakattotal = $zakat ? $zakat->zakattotal : null;

        $infaq = Kas::join('akunkeuangan', 'kas.debet', '=', 'akunkeuangan.id')
                    ->where('akunkeuangan.jenis_akun', 'like', '%IFQ%')
                    ->where('kas.pengirim', 'PG')->where('kas.type','SPJ')
                    ->whereYear('kas.tanggal', session('tahun_aktif'))
                    ->whereMonth('kas.tanggal', $bulan)
                    ->where('kas.dinas', $datalalu->dinas)
                    ->select(\DB::raw('SUM(kas.jumlah) as infaqtotal'))
                    ->first();
        $datalalu->infaqtotal = $infaq ? $infaq->infaqtotal : null;
    }

    return view('pengumpulan.transaksi.laporan', compact('data', 'title'));
}



public function export(Request $request)
{
    $keyword = $request->input('keyword'); // Ambil kata kunci pencarian dari input form

    $query = Kas::query()
        ->join('akunkeuangan', 'kas.debet', '=', 'akunkeuangan.id')
        ->join('muzaki', 'kas.id_muzaki', '=', 'muzaki.id')
        ->select('muzaki.nama_muzaki', 'kas.id', 'muzaki.npwp', 'kas.dinas', 'muzaki.hp', 'kas.debet', 'kas.kredit', 'kas.keterangan', 'akunkeuangan.uraian', 'kas.jumlah', 'kas.tanggal', 'kas.kode_transaksi')
        ->orderBy('kas.id', 'DESC')
        ->orderBy('kas.tanggal', 'DESC')
        ->where('kas.pengirim', 'PG')
        ->where('kas.type', 'SPJ')
        ->where('kas.tahun', session('tahun_aktif'));

    if ($keyword) {
        $query->where(function ($query) use ($keyword) {
            $query->where('muzaki.nama_muzaki', 'like', "%$keyword%")
                ->orWhere('muzaki.npwp', 'LIKE', '%' . $keyword . '%')
                ->orWhere('muzaki.hp', 'LIKE', '%' . $keyword . '%')
                ->orWhere('kas.kode_transaksi', 'LIKE', '%' . $keyword . '%');
        });
    }

    // Mengambil data dari query
    $data = $query->get();

    // Perbaikan pada foreach loop, seharusnya mengiterasi melalui $data, bukan $query
    foreach ($data as $item) {
        $kredit = AkunKeuangan::orderBy('uraian', 'ASC')->where('id', $item->kredit)->first();
        $item->kredituraian = ($kredit) ? $kredit->uraian : null;
        $dinas = Muzaki::where('id', $item->dinas)->first();
        $item->dinas = ($dinas) ? $dinas->nama_muzaki : null;
    }

    // Menggunakan method download setelah pengolahan data
    return Excel::download(new TransaksiExport($data), 'transaksi_pengumpulan.xlsx');
}

 

    public function wakirim()
    {
        $proposals = Kas::orderBy('id', 'ASC')->where('wa_status','B')
        ->where('pengirim','PG')
        ->limit(1)->first(); // Mengambil semua proposal

        if ($proposals){
        $phoneNumber = $proposals->hp;
        $jumlah = $proposals->jumlah;
        $jmlh = number_format($jumlah, 0, ',', '.');
        $nama = $proposals->nama_pemohon;
        $tgl = $proposals->tanggal_masuk;
        $tanggal = Carbon::parse($tgl)->format('d F Y');
        $phoneNumberWithoutZero = ltrim($phoneNumber, '0');
        $phoneNumberWithCountryCode = "62" . $phoneNumberWithoutZero;
        
        
        $dataSending = [
            "api_key" => "JVVEQVNYGOWIZ2HF",
            "number_key" => "0xVtoouWRGobvxpI",
            "phone_no" => $phoneNumberWithCountryCode,
            "message" => "
_Assalammu'alaikum wr wb_
Terima kasih atas pembayaran ZIS 
Tanggal *$tanggal*
Sebesar *Rp. $jmlh,-* atas nama sdr/i  $nama
Semoga Allah SWT memberikan pahala atas ZIS yang ditunaikan, menjadikan berkah dan suci atas harta yang lainnya. Berikut juga kami lampirkan bukti setor ZIS.

Bukti Pembayaran bisa anda download di link berikut ini :
http://masboy.baznasboyolali.or.id/cetak/cetakzismu/2023-04-01/[ID]/[KODE]

Untuk cek setoran bulan-bulan sebelumnya, langsung klik 
http://masboy.baznasboyolali.or.id/cetak/storan

Apabila ada setoran tidak sesuai, atau ada data yang salah silakah hubungi admin bidang pengumpulan. Hery wa.me/62895393234144

*BAZNAS KABUPATEN BOYOLALI*
_Wassalammu'alaikum wr wb_

            "
        ];
    
      
            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://api.watzap.id/v1/send_message',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($dataSending),
                CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
            ]);
            $response = curl_exec($curl);
            curl_close($curl);
    
            $proposals->update(['wa_status' => 'S']);
    
        } else {
            echo"data kosong";
        }
       
    }


    public function hapusdata()
    {

        $data['title'] = "Hapus Transaksi Pengumpulan";
 
        $data['data'] = Muzaki::all()->where('type','L');
     

        return view('pengumpulan.transaksi.hapus', $data);

    }
    
    public function hapusdatsa(Request $request)
    {
        // Lakukan pengecekan apakah ada data yang sesuai dengan kriteria
        $count = Kas::where('tanggal', $request->tanggal)
                    ->where('dinas', $request->dinas)
                    ->where('pengirim', 'PG')
                    ->where('type', 'SPJ')
                    ->count();
    
        // Jika tidak ada data yang sesuai, kembalikan ke halaman sebelumnya
        if ($count == 0) {
            return redirect()->back()->with('error', 'Tidak ada data yang sesuai untuk dihapus.');
        }
    
        // Jika ada data yang sesuai, lakukan penghapusan
        Kas::where('tanggal', $request->tanggal)
            ->where('dinas', $request->dinas)
            ->where('pengirim', 'PG')
            ->where('type', 'SPJ')
            ->delete();
    
        return redirect()->route('pengumpulan.pengumpulan.index')->with('warning', 'Data berhasil dihapus.');
    }
    
    
}
