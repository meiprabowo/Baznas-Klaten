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
use App\Exports\PembelianExport;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class PembelianController extends Controller
{

    public function index()
    {
        $data['title'] = "Master Pembelian Barang";
        $limit = request('limit', 10);
        
        
        $data['data']=Kas::join('akunkeuangan', 'kas.kredit', '=', 'akunkeuangan.id')
        ->select('kas.id', 'kas.kredit','kas.keterangan','kas.qty', 'akunkeuangan.uraian', 'kas.jumlah', 'kas.tanggal','kas.file', 'kas.kode_transaksi')
        ->orderBy('kas.id','DESC')
        ->orderBy('kas.tanggal', 'DESC')
        ->where('kas.pengirim', 'P')
        ->where('kas.type', 'TU')
        ->where('kas.tahun', session('tahun_aktif')) ->paginate($limit);

 
 
        foreach ($data['data'] as $sumber) {
            $tertasarufkan = Kas::where('kasbon', $sumber->id)
                ->where('pengirim', 'P')
                ->where('type', 'SPJ')
                ->where('tahun', session('tahun_aktif'))
                ->count();
                $sumber->jml = $tertasarufkan;


        }

         return view('pendistribusian.pembelian.index', $data);

         
    }
    
    public function create()
    {
        $data['title'] = "Master Tambah Transaksi SDM umum";


        $data['sumber']=AkunKeuangan::where('jenis_akun','like','%VIAPD%')->orderBy('uraian','ASC')->get();

        return view('pendistribusian.pembelian.tambah', $data);
    }


    
    public function store(request $request)
    {
        $jumlah = str_replace('.', '', $request->input('jumlah'));

        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date',
            'sumber' => 'required',
            'jumlah' => 'required',
            'file' => 'mimes:jpeg,png,jpg,pdf,doc,docx|max:5048',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
       
        $keperluan = AkunKeuangan::where('jenis_akun','like','%PBPD%')->orderBy('uraian','ASC')->first();

        if ($request->hasFile('file')) {

            $file = $request->file('file');
            $nama_file = time()."_".$file->getClientOriginalName();
            $tujuan_upload = 'pembelian';
            $file->move($tujuan_upload,$nama_file);         
            Kas::create([
                    'tanggal' => $request->tanggal,
                    'kode_transaksi' => Kas::generateTransactionCode($request->tanggal),
                    'jenis_kas' =>  'barang',
                    'pengirim' =>  'P',
                    'debet' =>  $keperluan->id,
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
                'jenis_kas' =>  'barang',
                'pengirim' =>  'P',
                'debet' =>  $keperluan->id,
                'kredit' => $request->sumber,
                'qty' =>  $request->qty,
                'jumlah' =>  $jumlah,
                'keterangan' =>  $request->keterangan,
                'tahun' => session('tahun_aktif'),
                'user_id' => Auth::user()->id,
            ]);


        
        }
        return redirect()->route('pendistribusian.pembelian.index')
        ->with('success','Data Berhasil disimpan.');
    
        }
    }
    

    public function destroy($id)
    {
        Kas::where('id',$id)->where('pengirim', 'P')->where('type', 'TU')->delete();
        return redirect()->route('pendistribusian.pembelian.index')->with('warning', 'Data berhasil dihapus.');
    }

    public function edit(string $id)
    {
        $data['title'] = "Master Edit Pembelian Barang";
    
        $data['data'] = Kas::where('id', $id)->where('pengirim', 'P')->where('type', 'TU')->first();
    
        $data['sumber'] = AkunKeuangan::where('jenis_akun', 'like', '%VIAPD%')->orderBy('uraian', 'ASC')->get();
    
    
        return view('pendistribusian.pembelian.edit', $data);
    }
    

    public function update(Request $request, string $id)
    {
        $jumlah = str_replace('.', '', $request->input('jumlah'));

        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date',
            'sumber' => 'required',
            'jumlah' => 'required',
            'file' => 'mimes:jpeg,png,jpg,pdf,doc,docx|max:5048',
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
            $tujuan_upload = 'pembelian';
            $file->move($tujuan_upload,$nama_file);         
            Kas::where('id', $id)
            ->update([
                    'tanggal' => $request->tanggal,
                    'kredit' => $request->sumber,
                    'jumlah' =>  $jumlah,
                    'keterangan' =>  $request->keterangan,
                    'qty' =>  $request->qty,
                    'file' => $nama_file,
                    'user_id' => Auth::user()->id,
            ]);


        } else {

            Kas::where('id', $id)
            ->update([
                'tanggal' => $request->tanggal,
                'kredit' => $request->sumber,
                'qty' =>  $request->qty,
                'jumlah' =>  $jumlah,
                'keterangan' =>  $request->keterangan,
                'user_id' => Auth::user()->id,
            ]);


        
        }
        return redirect()->route('pendistribusian.pembelian.index')
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
            ->select('kas.id', 'kas.kredit', 'kas.keterangan', 'kas.qty','akunkeuangan.uraian', 'kas.jumlah', 'kas.tanggal','kas.file', 'kas.kode_transaksi')
            ->where('kas.pengirim', 'P')
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
    
            foreach ($dataku['data'] as $sumber) {
                $tertasarufkan = Kas::where('kasbon', $sumber->id)
                                    ->where('pengirim', 'P')
                                    ->where('type', 'SPJ')
                                    ->where('tahun', session('tahun_aktif'))
                                    ->count();
                $sumber->jml = $tertasarufkan;
            }



        return view('pendistribusian.pembelian.index', $dataku);
    }
    
    

 
    public function export(Request $request)
    {
        $key = $request->input('keyword');
    
        $data = Kas::join('akunkeuangan', 'kas.kredit', '=', 'akunkeuangan.id')
            ->select('kas.id', 'kas.kredit', 'kas.keterangan', 'kas.qty', 'akunkeuangan.uraian', 'kas.jumlah', 'kas.tanggal','kas.file', 'kas.kode_transaksi')
            ->where('kas.pengirim', 'P')
            ->where('kas.type', 'TU')
            ->where('kas.tahun', session('tahun_aktif'))
            ->where(function ($query) use ($key) {
                $query->where('kas.kode_transaksi', 'LIKE', '%' . $key . '%')
                    ->orWhere('kas.keterangan', 'LIKE', '%' . $key . '%')
                     ->orWhere('akunkeuangan.uraian', 'LIKE', '%' . $key . '%');
            })
            ->orderBy('kas.id','DESC')
            ->orderBy('kas.tanggal', 'DESC')->get();
    
        return Excel::download(new PembelianExport($data), 'Pembelian.xlsx');
    }
    

    public function cetak(Request $request, $id)
    {
        $kas = Kas::where('id',$id)
        ->where('kas.pengirim', 'P')
        ->where('kas.type', 'TU')->first();  
        
               // Ambil nomor proposal dari data proposal
               $nomor = $kas->kode_transaksi;
               $keterangan = $kas->keterangan;
               $qty = $kas->qty;
           
               // Buat teks untuk QR code
               $text = "
                   Nomor Transaksi: $nomor
                   Pembelian Barang: $keterangan
                   QTY: $qty
               ";
           
               // Generate QR code dengan teks
               $qrCode = QrCode::size(300)->generate($text);
           
               // Masukkan data proposal dan QR code ke dalam array data
               $data = [
                   'data' => $kas,
                   'qrCode' => $qrCode
               ];




        $pdf = PDF::loadView('pendistribusian.pembelian.cetak', $data)->setPaper('F4', 'portrait');
        return $pdf->download('detail_pembelian.pdf');


    }
}