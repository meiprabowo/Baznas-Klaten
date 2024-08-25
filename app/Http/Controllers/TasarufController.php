<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AkunKeuangan;
use App\Models\Proposal;
use App\Models\User;
use App\Models\Kelurahan;
use App\Models\Kecamatan;
use App\Models\Kas;
use Validator;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Exports\ExportUang;
use App\Exports\ExportBarang;
use App\Exports\ExportProposalBelum;
use App\Exports\ExportSudah;
use App\Imports\UangImport;
use App\Imports\BarangImport;
use App\Imports\ProposalLanjutImport;
use App\Models\Pengajuan;
use App\Models\Detail_pengajuan;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use PDF;




class TasarufController extends Controller
{
    public function index()
    {
        $data['title'] = "Data Belum Tasarufkan";
        $limit = request('limit', 10);
        
        $data['data'] = Proposal::orderBy('id', 'DESC')
                                ->orderBy('tanggal_masuk', 'DESC')
                                ->where('tahun', session('tahun_aktif'))
                                ->where('status','A')
                                ->whereNotExists(function ($query) {
                                    $query->select('id')
                                          ->from('kas')
                                          ->where('pengirim','P')
                                          ->where('type','SPJ')

                                          ->whereColumn('kas.id_muzaki', 'proposal.id');
                                })
                                ->paginate($limit);
        
        return view('pendistribusian.transaksi.belum.index', $data);
    }
    
 

    public function edit(string $id)
    {
        //
        $dataku['title'] = "Tasaruf Proposal";
        $dataku['data'] = Proposal::find($id);
        $dataku['sumber']=AkunKeuangan::where('jenis_akun','like','%VIAP%')->orderBy('uraian','ASC')->get();

        $dataku['program'] = AkunKeuangan::orderBy('uraian','ASC')->where('jenis_akun','like','%PROGRAM%')->where('level','3')->get();
        $program_id = $dataku['data']->program; // Ambil id program dari data proposal
        $subprogram_id = $dataku['data']->sub_program; // Ambil id program dari data proposal
        $dataku['subprogram'] = AkunKeuangan::orderBy('uraian','ASC')->where('jenis_akun','like','%PROGRAM%')
        ->where('kode','like',$program_id . '%')
        ->where('level','4')->get();
        $dataku['detailprogram'] = AkunKeuangan::orderBy('uraian','ASC')->where('jenis_akun','like','%PROGRAM%')
        ->where('kode','like',$subprogram_id . '%')
        ->where('level','5')->get();
        return view('pendistribusian.transaksi.belum.uang', $dataku);
    }



    public function store(Request $request, string $id)
    {

        $jumlah = str_replace('.', '', $request->input('nominal'));

        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date',
            'sumber' => 'required',
            'nominal' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
       
     

            Kas::create([
                'tanggal' => $request->tanggal,
                'kode_transaksi' => Kas::GenerateSPJ($request->tanggal),
                'jenis_kas' =>  'uang',
                'pengirim' =>  'P',
                'type' =>  'SPJ',
                'debet' =>  $request->detailprogram,
                'kredit' => $request->sumber,
                'id_muzaki' => $request->id,
                'qty' =>  "1",
                'jumlah' =>  $jumlah,
                'keterangan' =>  $request->keterangan,
                'tahun' => session('tahun_aktif'),
                'user_id' => Auth::user()->id,
            ]);


        
       
        return redirect()->route('pendistribusian.tasaruf.index')
        ->with('success','Data Berhasil disimpan.');
    
        }



    }
    
    

    public function barang(string $id)
    {
        $dataku['title'] = "Tasaruf Proposal";
        $dataku['data'] = Proposal::find($id);
    
        $dataku['sumber'] = Kas::where('pengirim', 'P')
            ->where('type', 'TU')
            ->orderBy('keterangan', 'ASC')
            ->get();
    

        foreach ($dataku['sumber'] as $sumber) {
            $tertasarufkan = Kas::where('kasbon', $sumber->id)
                ->where('pengirim', 'P')
                ->where('type', 'SPJ')
                ->where('tahun', session('tahun_aktif'))
                ->count();
                $sumber->jml = $tertasarufkan;

                
        }





        $program_id = $dataku['data']->program; // Ambil id program dari data proposal
        $subprogram_id = $dataku['data']->sub_program; // Ambil id program dari data proposal
    
        $dataku['program'] = AkunKeuangan::orderBy('uraian', 'ASC')
            ->where('jenis_akun', 'like', '%PROGRAM%')
            ->where('level', '3')
            ->get();
    
        $dataku['subprogram'] = AkunKeuangan::orderBy('uraian', 'ASC')
            ->where('jenis_akun', 'like', '%PROGRAM%')
            ->where('kode', 'like', $program_id . '%')
            ->where('level', '4')
            ->get();
    
        $dataku['detailprogram'] = AkunKeuangan::orderBy('uraian', 'ASC')
            ->where('jenis_akun', 'like', '%PROGRAM%')
            ->where('kode', 'like', $subprogram_id . '%')
            ->where('level', '5')
            ->get();
    
        return view('pendistribusian.transaksi.belum.barang', $dataku);
    }
    




    public function barangstore(Request $request, string $id)
    {


        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date',
            'sumber' => 'required',
        ]);


        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
       
            $pembagi = Kas::find($request->sumber);
            $jumlah = $pembagi->jumlah / $pembagi->qty;
            
            $keperluan = AkunKeuangan::where('jenis_akun','like','%PBPD%')->orderBy('uraian','ASC')->first();


            Kas::create([
                'tanggal' => $request->tanggal,
                'kode_transaksi' => Kas::GenerateSPJ($request->tanggal),
                'jenis_kas' =>  'barang',
                'pengirim' =>  'P',
                'type' =>  'SPJ',
                'kasbon' =>  $request->sumber,
                'debet' =>  $request->detailprogram,
                'kredit' => $keperluan->id,
                'id_muzaki' => $request->id,
                'qty' =>  "1",
                'jumlah' =>  $jumlah,
                'keterangan' =>  $request->keterangan,
                'tahun' => session('tahun_aktif'),
                'user_id' => Auth::user()->id,
            ]);


        
       
        return redirect()->route('pendistribusian.tasaruf.index')
        ->with('success','Data Berhasil disimpan.');
    
        }



    }
    





    public function upload(Request $request)
    {

        $data['title'] = "Upload SPJ Pentasarufan";
        $data['sumber'] = Kas::where('pengirim', 'P')
        ->where('type', 'TU')
        ->orderBy('keterangan', 'ASC')
        ->get();


         foreach ($data['sumber'] as $sumber) {
        $tertasarufkan = Kas::where('kasbon', $sumber->id)
            ->where('pengirim', 'P')
            ->where('type', 'SPJ')
            ->where('tahun', session('tahun_aktif'))
            ->count();
            $sumber->jml = $tertasarufkan;

            
    }
        return view('pendistribusian.transaksi.belum.upload', $data);


    }


    

    public function exportuang(Request $request)
    {

        $query =  Proposal::orderBy('id', 'DESC')
        ->orderBy('tanggal_masuk', 'DESC')
        ->where('tahun', session('tahun_aktif'))
        ->where('status','A')
        ->where('jenis_permohonan','uang')
        ->whereNotExists(function ($query) {
            $query->select('id')
                  ->from('kas')
                  ->whereColumn('kas.id_muzaki', 'proposal.id');
        });
        $data = $query->get();


        foreach ($data as $proposal) {

            $kelurahan = Kelurahan::find($proposal->kelurahan);
            $kecamatan = Kecamatan::find($proposal->kecamatan);
            $proposal->kelurahan = $kelurahan ? $kelurahan->nama_kelurahan : null;
            $proposal->kecamatan = $kecamatan ? $kecamatan->nama_kecamatan : null;
          
            $this->fetchProgramDetails($proposal, 'program', 'uraianprogram', 'kode');
            $this->fetchProgramDetails($proposal, 'sub_program', 'uraiansubprogram', 'kode');
            $this->fetchProgramDetails($proposal, 'detail_program', 'detailprogram', 'id');
        }




        return Excel::download(new ExportUang($data), 'permohonan_uang.xlsx');
    }

  
    


    public function postuang(Request $request)
    {
     //
     $file = $request->file('file')->store('public/import');
     $import = new UangImport(); 
     $import->import($file);
     $sukses = $import->getRowCount();
     
     if($import->failures()->isNotEmpty()) {
         return back()->withFailures($import->failures())->with('gagal',$import->getRowCount()
         
     );;
  
     }

     return redirect()->route('pendistribusian.tasaruf.index')->with('success', 'Data berhasil diimport '.$import->getRowCount().' Data');
        
    }
    



    public function exportbarang(Request $request)
    {

        $query =  Proposal::orderBy('id', 'DESC')
        ->orderBy('tanggal_masuk', 'DESC')
        ->where('tahun', session('tahun_aktif'))
        ->where('status','A')
        ->where('jenis_permohonan','barang')
        ->whereNotExists(function ($query) {
            $query->select('id')
                  ->from('kas')
                  ->whereColumn('kas.id_muzaki', 'proposal.id');
        });
        $data = $query->get();


        foreach ($data as $proposal) {

            $kelurahan = Kelurahan::find($proposal->kelurahan);
            $kecamatan = Kecamatan::find($proposal->kecamatan);
            $proposal->kelurahan = $kelurahan ? $kelurahan->nama_kelurahan : null;
            $proposal->kecamatan = $kecamatan ? $kecamatan->nama_kecamatan : null;
          
            $this->fetchProgramDetails($proposal, 'program', 'uraianprogram', 'kode');
            $this->fetchProgramDetails($proposal, 'sub_program', 'uraiansubprogram', 'kode');
            $this->fetchProgramDetails($proposal, 'detail_program', 'detailprogram', 'id');
        }




        return Excel::download(new ExportBarang($data), 'permohonan_barang.xlsx');
    }
    


 

    public function postbarang(Request $request)
    {
     //
     $file = $request->file('file')->store('public/import');
     $sumber = $request->sumber;
     $import = new BarangImport($sumber); 
     $import->import($file);
     $sukses = $import->getRowCount();
     
     if($import->failures()->isNotEmpty()) {
         return back()->withFailures($import->failures())->with('gagal',$import->getRowCount()
         
     );;
  
     }

     return redirect()->route('pendistribusian.tasaruf.index')->with('success', 'Data berhasil diimport '.$import->getRowCount().' Data');
        
    }
    




    public function search(Request $request) // Use Request class
    {
        $dataku['title'] = "Master Proposal Belum Tertasarufkan";
        $limit = request('limit', 10);
    
        $key = $request->input('keyword'); // Mendapatkan query pencarian dari input form

        // Query pencarian
        $dataku['data'] = Proposal::where('tahun', session('tahun_aktif'))
            ->where(function ($query) use ($key) {
                $query->where('nomor_proposal', 'LIKE', '%' . $key . '%')
                    ->orWhere('nama_pemohon', 'LIKE', '%' . $key . '%')
                    ->orWhere('hp', 'LIKE', '%' . $key . '%');
            })
            ->where('status','A')
            ->whereNotExists(function ($query) {
                $query->select('id')
                      ->from('kas')
                      ->whereColumn('kas.id_muzaki', 'proposal.id');
            })

            ->orderBy('proposal.id','DESC')
            ->orderBy('proposal.tanggal_masuk', 'DESC')
            ->paginate($limit);
    
        return view('pendistribusian.transaksi.belum.index', $dataku);
    }
    






    public function export(Request $request)
    {

        $keyword = $request->input('keyword');
        $query = Proposal::where('tahun', session('tahun_aktif'))
        ->where('status','A')
        ->whereNotExists(function ($query) {
            $query->select('id')
                  ->from('kas')
                  ->whereColumn('kas.id_muzaki', 'proposal.id');
        })
                        ->orderBy('proposal.id', 'DESC')
                        ->orderBy('proposal.tanggal_masuk', 'DESC');
    
        if ($keyword) {
            $query->where(function ($query) use ($keyword) {
                $query->where('nomor_proposal', 'LIKE', '%' . $keyword . '%')
                      ->orWhere('nama_pemohon', 'LIKE', '%' . $keyword . '%')
                      ->orWhere('hp', 'LIKE', '%' . $keyword . '%');
            });
        }
    
        $data = $query->get();
     
        // Loop through the data and fetch program details for each proposal
        foreach ($data as $proposal) {

            $kelurahan = Kelurahan::find($proposal->kelurahan);
            $kecamatan = Kecamatan::find($proposal->kecamatan);
            $proposal->kelurahan = $kelurahan ? $kelurahan->nama_kelurahan : null;
            $proposal->kecamatan = $kecamatan ? $kecamatan->nama_kecamatan : null;


          
            $this->fetchProgramDetails($proposal, 'program', 'uraianprogram', 'kode');
            $this->fetchProgramDetails($proposal, 'sub_program', 'uraiansubprogram', 'kode');
            $this->fetchProgramDetails($proposal, 'detail_program', 'detailprogram', 'id');
        }



        return Excel::download(new ExportProposalBelum($data), 'belum_tertasarufkan.xlsx');
    }
    

 

 public function laporan()
{
    $data['title'] = "Data Tasarufkan";
  
   

    return view('pendistribusian.transaksi.sudah.laporan', $data);
}


    public function indexsudah()
    {
        $data['title'] = "Data  Tasarufkan";
        $limit = request('limit', 10);
        
        $data['data'] =Kas::join('proposal', 'kas.id_muzaki', '=', 'proposal.id')
        ->select(
            'kas.id','kas.kode_transaksi', 'kas.tanggal', 'kas.jenis_kas','kas.jumlah', 'kas.file', 
            'proposal.nomor_proposal','proposal.proposal','proposal.nama_pemohon','proposal.hp','proposal.alamat_lengkap'
        )
        ->where('kas.tahun', session('tahun_aktif'))
        ->where('kas.pengirim', 'P')
        ->where('kas.type', 'SPJ')
        ->orderby('kas.id','DESC')
        ->orderby('kas.tanggal','DESC')
        ->paginate($limit);



        return view('pendistribusian.transaksi.sudah.index', $data);
    }
     
    public function edituang(string $id)
    {
        $data['title'] = "Master Edit SPJ Tasaruf";
    
        $data['data'] = Kas::join('proposal', 'kas.id_muzaki', '=', 'proposal.id')
        ->select('kas.id','kas.tanggal','kas.debet','kas.jumlah','kas.kredit','kas.keterangan','kas.file','proposal.nomor_proposal','proposal.nama_pemohon')
        ->where('kas.id', $id)->where('kas.pengirim', 'P')->where('kas.jenis_kas', 'uang')->where('kas.type', 'SPJ')->first();
    

        $data['sumber'] = AkunKeuangan::where('jenis_akun', 'like', '%VIAP%')->orderBy('uraian', 'ASC')->get();
    
        $program = $data['data']->debet;
    
        $hasil = DB::select("
            SELECT
            SUBSTRING_INDEX(SUBSTRING_INDEX(kode, '.', 3), '.', 3) AS pro_utama, 
            SUBSTRING_INDEX(SUBSTRING_INDEX(kode, '.', 4), '.', 4) AS sub_utama 
            FROM akunkeuangan 
            WHERE id = ?
        ", [$program]);
    
        if (empty($hasil)) {
            abort(404, 'Program data not found');
        }
    
        $data['hasil'] = $hasil[0];
    
        $program_id = $data['hasil']->pro_utama; // Ambil id program dari data proposal
        $subprogram_id = $data['hasil']->sub_utama; // Ambil id program dari data proposal
    
        $data['program'] = AkunKeuangan::orderBy('uraian', 'ASC')
            ->where('jenis_akun', 'like', '%PROGRAM%')
            ->where('level', '3')->get();
    
        $data['subprogram'] = AkunKeuangan::orderBy('uraian', 'ASC')
            ->where('jenis_akun', 'like', '%PROGRAM%')
            ->where('kode', 'like', "%$program_id%")
            ->where('level', '4')->get();
    
        $data['detailprogram'] = AkunKeuangan::orderBy('uraian', 'ASC')
            ->where('jenis_akun', 'like', '%PROGRAM%')
            ->where('kode', 'like', "%$subprogram_id%")
            ->where('level', '5')->get();
    
        return view('pendistribusian.transaksi.sudah.edituang', $data);
    }
    
      
    public function pedituang(Request $request,string $id)
    {

        $jumlah = str_replace('.', '', $request->input('nominal'));

        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date',
            'sumber' => 'required',
            'detailprogram' => 'required',
            'nominal' => 'required',
            'file' => 'mimes:jpeg,png,jpg,pdf,doc,docx|max:10048',
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
                    'kode_transaksi' => Kas::GenerateSPJ($request->tanggal),
                    'jenis_kas' =>  'uang',
                    'pengirim' =>  'P',
                    'type' =>  'SPJ',
                    'debet' =>  $request->detailprogram,
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
                'kode_transaksi' => Kas::GenerateSPJ($request->tanggal),
                'jenis_kas' =>  'uang',
                'pengirim' =>  'P',
                'type' =>  'SPJ',
                'debet' =>  $request->detailprogram,
                'kredit' => $request->sumber,
                'jumlah' =>  $jumlah,
                'keterangan' =>  $request->keterangan,
                'tahun' => session('tahun_aktif'),
                'user_id' => Auth::user()->id,
            ]);


        
        }
        return redirect()->route('pendistribusian.tasaruf.indexsudah')
        ->with('success','Data Berhasil disimpan.');
    
        }


    }



     
    public function editbarang(string $id)
    {
        $data['title'] = "Master Edit SPJ Tasaruf";
    
        $data['data'] = Kas::join('proposal', 'kas.id_muzaki', '=', 'proposal.id')
        ->select('kas.id','kas.tanggal','kas.debet','kas.kasbon','kas.jumlah','kas.kredit','kas.keterangan','kas.file','proposal.nomor_proposal','proposal.nama_pemohon')
        ->where('kas.id', $id)->where('kas.pengirim', 'P')->where('kas.type', 'SPJ')->where('kas.jenis_kas', 'barang')->first();
    

        $data['sumber'] = AkunKeuangan::where('jenis_akun', 'like', '%VIAP%')->orderBy('uraian', 'ASC')->get();
    

        $kredit = $data['data']->kasbon; 
           
        $data['sumberawal'] = Kas::where('id',$kredit)->first();
    




        $program = $data['data']->debet;
    
        $hasil = DB::select("
            SELECT
            SUBSTRING_INDEX(SUBSTRING_INDEX(kode, '.', 3), '.', 3) AS pro_utama, 
            SUBSTRING_INDEX(SUBSTRING_INDEX(kode, '.', 4), '.', 4) AS sub_utama 
            FROM akunkeuangan 
            WHERE id = ?
        ", [$program]); 
    
        $data['sumber'] = Kas::where('pengirim', 'P')
            ->where('type', 'TU')
            ->orderBy('keterangan', 'ASC')
            ->get();
    

        foreach ($data['sumber'] as $sumber) {
            $tertasarufkan = Kas::where('kasbon', $sumber->id)
                ->where('pengirim', 'P')
                ->where('type', 'SPJ')
                ->where('tahun', session('tahun_aktif'))
                ->count();
                $sumber->jml = $tertasarufkan;

                
        }


    
        $data['hasil'] = $hasil[0];
    
        $program_id = $data['hasil']->pro_utama; // Ambil id program dari data proposal
        $subprogram_id = $data['hasil']->sub_utama; // Ambil id program dari data proposal
    
        $data['program'] = AkunKeuangan::orderBy('uraian', 'ASC')
            ->where('jenis_akun', 'like', '%PROGRAM%')
            ->where('level', '3')->get();
    
        $data['subprogram'] = AkunKeuangan::orderBy('uraian', 'ASC')
            ->where('jenis_akun', 'like', '%PROGRAM%')
            ->where('kode', 'like', "%$program_id%")
            ->where('level', '4')->get();
    
        $data['detailprogram'] = AkunKeuangan::orderBy('uraian', 'ASC')
            ->where('jenis_akun', 'like', '%PROGRAM%')
            ->where('kode', 'like', "%$subprogram_id%")
            ->where('level', '5')->get();
    
        return view('pendistribusian.transaksi.sudah.editbarang', $data);
    }
    



    public function peditbarang(Request $request,string $id)
    {


        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date',
            'sumber' => 'required',
            'detailprogram' => 'required',
            'file' => 'mimes:jpeg,png,jpg,pdf,doc,docx|max:10048',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {

            $pembagi = Kas::find($request->sumber);
            $jumlah = $pembagi->jumlah / $pembagi->qty;
            $keperluan = AkunKeuangan::where('jenis_akun','like','%PBPD%')->orderBy('uraian','ASC')->first();



        if ($request->hasFile('file')) {

            $file = $request->file('file');
            $nama_file = time()."_".$file->getClientOriginalName();
            $tujuan_upload = 'sdmumum';
            $file->move($tujuan_upload,$nama_file);         
            Kas::where('id', $id)
            ->update([
                    'tanggal' => $request->tanggal,
                    'kode_transaksi' => Kas::GenerateSPJ($request->tanggal),
                    'jenis_kas' =>  'barang',
                    'pengirim' =>  'P',
                    'type' =>  'SPJ',
                    'debet' =>  $request->detailprogram,
                    'kredit' => $keperluan->id,
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
                'kode_transaksi' => Kas::GenerateSPJ($request->tanggal),
                'jenis_kas' =>  'barang',
                'pengirim' =>  'P',
                'type' =>  'SPJ',
                'debet' =>  $request->detailprogram,
                'kredit' => $keperluan->id,
                'jumlah' =>  $jumlah,
                'keterangan' =>  $request->keterangan,
                'tahun' => session('tahun_aktif'),
                'user_id' => Auth::user()->id,
            ]);


        
        }
        return redirect()->route('pendistribusian.tasaruf.indexsudah')
        ->with('success','Data Berhasil disimpan.');
    
        }


    }





    public function destroy($id)
    {

        Kas::where('id',$id)->where('pengirim','P')->where('type','SPJ')
        ->delete();
        return redirect()->route('pendistribusian.tasaruf.indexsudah')->with('warning', 'Data berhasil dihapus.');

    }


   

    public function cetak($id)
    {

        $kas = Kas::join('proposal', 'kas.id_muzaki', '=', 'proposal.id')
        ->join('akunkeuangan', 'kas.debet', '=', 'akunkeuangan.id')
        ->select('kas.id','kas.tanggal','kas.debet','kas.kode_transaksi','kas.jumlah','kas.kredit','kas.keterangan','kas.file','proposal.nomor_proposal','proposal.nama_pemohon'
        ,'akunkeuangan.uraian','proposal.alamat_lengkap')
        ->where('kas.id', $id)->where('kas.pengirim', 'P')->where('kas.type', 'SPJ')->first();

     
        
               // Ambil nomor proposal dari data proposal
               $nomor = $kas->kode_transaksi;
               $keterangan = $kas->keterangan;
               $nama = $kas->nama_pemohon;
           
               // Buat teks untuk QR code
               $text = "
Nomor Transaksi: $nomor
Mustahik : $nama
Keterangan : $keterangan
               ";
           
               // Generate QR code dengan teks
               $qrCode = QrCode::size(300)->generate($text);
           
               // Masukkan data proposal dan QR code ke dalam array data
               $data = [
                   'data' => $kas,
                   'qrCode' => $qrCode,
                   
               ];




        $pdf = PDF::loadView('pendistribusian.transaksi.sudah.cetak', $data)->setPaper('A5', 'landscape');
        return $pdf->stream('cetak_SPK_perorangan.pdf');
    }




    public function searchsudah(Request $request) // Use Request class
    {
        $data['title'] = "Master SPJ Tertasarufkan";
        $limit = request('limit', 10);
  
        $key = $request->input('keyword'); // Mendapatkan query pencarian dari input form

        $data['data'] =Kas::join('proposal', 'kas.id_muzaki', '=', 'proposal.id')
        ->select(
            'kas.id','kas.kode_transaksi', 'kas.tanggal', 'kas.jenis_kas','kas.file', 'kas.jumlah', 
            'proposal.nomor_proposal','proposal.proposal','proposal.nama_pemohon','proposal.hp'
        )
        ->where('kas.tahun', session('tahun_aktif'))
        ->where('kas.pengirim', 'P')
        ->where('kas.type', 'SPJ')
        ->where(function ($query) use ($key) {
            $query
            ->where('proposal.nomor_proposal', 'LIKE', '%' . $key . '%')
            ->orWhere('proposal.nama_pemohon', 'LIKE', '%' . $key . '%')
            ->orWhere('kas.kode_transaksi', 'LIKE', '%' . $key . '%')
            ->orWhere('kas.tanggal', 'LIKE', '%' . $key . '%')
            ->orWhere('proposal.hp', 'LIKE', '%' . $key . '%');
        })
        ->orderby('kas.id','DESC')
        ->orderby('kas.tanggal','DESC')
        ->paginate($limit);
        
       
    
        return view('pendistribusian.transaksi.sudah.index', $data);
    }
    






    public function exportsudah(Request $request)
    {

        $keyword = $request->input('keyword');
        $query = Kas::join('proposal', 'kas.id_muzaki', '=', 'proposal.id')
        ->select(
            'kas.*',
            'proposal.*',
            'proposal.keterangan AS proposal_keterangan', // Memberikan alias untuk proposal.keterangan
            'kas.keterangan AS kas_keterangan' // Memberikan alias untuk kas.keterangan
        )
        ->where('kas.pengirim', 'P')
        ->where('kas.type', 'SPJ')
        ->where('kas.tahun', session('tahun_aktif'))
        ->orderBy('kas.id', 'DESC')
        ->orderBy('kas.tanggal', 'DESC');

    
        if ($keyword) {
            $query->where(function ($query) use ($keyword) {
                $query->where('nomor_proposal', 'LIKE', '%' . $keyword . '%')
                      ->orWhere('nama_pemohon', 'LIKE', '%' . $keyword . '%')
                      ->orWhere('hp', 'LIKE', '%' . $keyword . '%');
            });
        }
    
        $data = $query->get();
     
        // Loop through the data and fetch program details for each proposal
        foreach ($data as $proposal) {
            $cibicaca = $proposal->debet;
            $kelurahan = Kelurahan::find($proposal->kelurahan);
            $kecamatan = Kecamatan::find($proposal->kecamatan);
            $petugas = User::find($proposal->petugas_survey);
            $detailp = AkunKeuangan::find($proposal->debet);
            $kreditp = AkunKeuangan::find($proposal->kredit);
        
            $hasil = DB::select("
                SELECT
                SUBSTRING_INDEX(SUBSTRING_INDEX(kode, '.', 3), '.', 3) AS pro_utama, 
                SUBSTRING_INDEX(SUBSTRING_INDEX(kode, '.', 4), '.', 4) AS sub_utama 
                FROM akunkeuangan 
                WHERE id = ?
            ", [$cibicaca]);
        
            if (!empty($hasil)) {
                $hasilla = $hasil[0]->pro_utama;
                $hasillaa = $hasil[0]->sub_utama;
        
                $pasa = AkunKeuangan::where('kode', $hasilla)->first();
                $proposal->pros = $pasa ? $pasa->uraian : null;
        
                $pasaa = AkunKeuangan::where('kode', $hasillaa)->first();
                $proposal->pross = $pasaa ? $pasaa->uraian : null;
            } else {
                $proposal->pros = null;
                $proposal->pross = null;
            }
        
            $proposal->kreditp = $kreditp ? $kreditp->uraian : null;
            $proposal->detailp = $detailp ? $detailp->uraian : null;
            $proposal->petugas = $petugas ? $petugas->name : null;
            $proposal->nama_kelurahan = $kelurahan ? $kelurahan->nama_kelurahan : null;
            $proposal->nama_kecamatan = $kecamatan ? $kecamatan->nama_kecamatan : null;
        
            $this->fetchProgramDetails($proposal, 'program', 'uraianprogram', 'kode');
            $this->fetchProgramDetails($proposal, 'sub_program', 'uraiansubprogram', 'kode');
            $this->fetchProgramDetails($proposal, 'detail_program', 'detailprogram', 'id');
        }
        
        return Excel::download(new ExportSudah($data), 'SPJ_Tasaruf.xlsx');
    }


 

    private function fetchProgramDetails($proposal, $programKey, $uraianKey, $field)
    {
        $programId = $proposal->$programKey;
        $program = AkunKeuangan::where($field, $programId)->first();
    
        if ($program) {
            $proposal->$uraianKey = $program->uraian;
        } else {
            $proposal->$uraianKey = null;
        }
    }



    public function pengajuan()
    {
        $data['title'] = "Pengajuan Data";
        $limit = request('limit', 10);
        
        $data['data'] = Pengajuan::orderBy('id', 'DESC')
            ->where('tahun', session('tahun_aktif'))
            ->where('pengaju', 'P')
            ->paginate($limit);
    
        foreach ($data['data'] as $cek) {
            $revisi = Detail_pengajuan::where('id_pengajuan', $cek->id)->where('status','R')->count();
            $cek->revisi = $revisi;
            $pendding = Detail_pengajuan::where('id_pengajuan', $cek->id)->where('status','P')->count();
            $cek->pendding = $pendding;
            $sukses = Detail_pengajuan::where('id_pengajuan', $cek->id)->where('status','S')->count();
            $cek->sukses = $sukses;
        }
        
        return view('pendistribusian.pengajuan.index', $data);
    }
    

    public function pengajuanku()
    {
        $data['title'] = "Pengajuan Data";
        $limit = request('limit', 10);
        
        $data['data'] = Pengajuan::orderBy('id', 'DESC')
            ->where('tahun', session('tahun_aktif'))
            ->paginate($limit);
    
        foreach ($data['data'] as $cek) {
            $revisi = Detail_pengajuan::where('id_pengajuan', $cek->id)->where('status','R')->count();
            $cek->revisi = $revisi;
            $pendding = Detail_pengajuan::where('id_pengajuan', $cek->id)->where('status','P')->count();
            $cek->pendding = $pendding;
            $sukses = Detail_pengajuan::where('id_pengajuan', $cek->id)->where('status','S')->count();
            $cek->sukses = $sukses;
        }
        
        return view('keuangan.pengajuan.index', $data);
    }
    

    

    
    public function pengajuansdm()
    {
        $data['title'] = "Pengajuan Data";
        $limit = request('limit', 10);
        
        $data['data'] = Pengajuan::orderBy('id', 'DESC')
            ->where('tahun', session('tahun_aktif'))
            ->where('pengaju', 'SDM')
            ->paginate($limit);
    
        foreach ($data['data'] as $cek) {
            $revisi = Detail_pengajuan::where('id_pengajuan', $cek->id)->where('status','R')->count();
            $cek->revisi = $revisi;
            $pendding = Detail_pengajuan::where('id_pengajuan', $cek->id)->where('status','P')->count();
            $cek->pendding = $pendding;
            $sukses = Detail_pengajuan::where('id_pengajuan', $cek->id)->where('status','S')->count();
            $cek->sukses = $sukses;
        }
        
        return view('sdm.pengajuan.index', $data);
    }
    



    
    public function tambahpengajuan()
    {
        $data['title'] = "Pengajuan Data";
        $limit = request('limit', 10);
        
        $data['data'] = Pengajuan::orderBy('id', 'DESC')
        ->where('tahun', session('tahun_aktif'))
        ->where('pengaju', 'P')
        ->paginate($limit);
        
        return view('pendistribusian.pengajuan.tambah', $data);
    }
    
   
    
    public function tambahpengajuansdm()
    {
        $data['title'] = "Pengajuan Data";
        $limit = request('limit', 10);
        
        $data['data'] = Pengajuan::orderBy('id', 'DESC')
        ->where('tahun', session('tahun_aktif'))
        ->where('pengaju', 'SDM')
        ->paginate($limit);
        
        return view('sdm.pengajuan.tambah', $data);
    }
    
   
    public function tambahpengajuanpost(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date',
            'pengajuan' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput(); 
        } else {
            $pengajuan = Pengajuan::create([
                'tanggal' => $request->tanggal,
                'pengaju' =>  "P",
                'nomor_pengajuan' =>  $request->pengajuan,
                'keterangan' =>  $request->keterangan,
                'tahun' => session('tahun_aktif'),
                'user_id' => Auth::user()->id,
            ]);
    
            // Mendapatkan ID pengajuan yang baru saja dibuat
            $id_pengajuan_baru = $pengajuan->id;


        
       
            return redirect()->route('pendistribusian.tasaruf.detailpengajuan', ['id' => $id_pengajuan_baru])
            ->with('success','Data Berhasil disimpan.');
    
        }



    }
    
    
    public function tambahpengajuanpostsdm(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date',
            'pengajuan' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput(); 
        } else {
            $pengajuan = Pengajuan::create([
                'tanggal' => $request->tanggal,
                'pengaju' =>  "SDM",
                'nomor_pengajuan' =>  $request->pengajuan,
                'keterangan' =>  $request->keterangan,
                'tahun' => session('tahun_aktif'),
                'user_id' => Auth::user()->id,
            ]);
    
            // Mendapatkan ID pengajuan yang baru saja dibuat
            $id_pengajuan_baru = $pengajuan->id;


        
       
            return redirect()->route('sdm.tasaruf.detailpengajuansdm', ['id' => $id_pengajuan_baru])
            ->with('success','Data Berhasil disimpan.');
    
        }



    }
    
    




    public function detailpengajuan(Request $request,$id)
    {

        $data['title'] = "Detail Pengajuan Data";
        $data['id'] = $id;
        $limit = request('limit', 10);


        $data['data'] = Kas::where('pengirim', 'P')
        ->where('type', 'SPJ')
        ->whereNotExists(function ($query)  {
            $query->select('id')
                  ->from('detail_pengajuan')
                  ->whereColumn('kas.id', 'detail_pengajuan.id_kas'); // Mengganti '.id_kas' menjadi 'detail_pengajuan.id_kas'
        })
        ->orderByDesc('kas.id') // Mengubah 'orderby' menjadi 'orderByDesc' dan mengganti urutan menjadi 'orderByDesc'
        ->orderByDesc('tanggal') // Mengubah urutan menjadi 'orderByDesc'
        ->paginate($limit);
    

        foreach ($data['data'] as $cek) {
            $muzaki = Proposal::where('id', $cek->id_muzaki)->first();
           
            $cek->muzaki = $muzaki ? $muzaki->nama_pemohon : null;
        }



        return view('pendistribusian.pengajuan.tambahdetail', $data);

    }



    public function detailpengajuansdm(Request $request,$id)
    {

        $data['title'] = "Detail Pengajuan Data";
        $data['id'] = $id;
        $limit = request('limit', 10);


        $data['data'] = Kas::where('pengirim', 'SDM')
        ->where('type', 'TU')
        ->whereNotExists(function ($query)  {
            $query->select('id')
                  ->from('detail_pengajuan')
                  ->whereColumn('kas.id', 'detail_pengajuan.id_kas'); // Mengganti '.id_kas' menjadi 'detail_pengajuan.id_kas'
        })
        ->orderByDesc('kas.id') // Mengubah 'orderby' menjadi 'orderByDesc' dan mengganti urutan menjadi 'orderByDesc'
        ->orderByDesc('tanggal') // Mengubah urutan menjadi 'orderByDesc'
        ->paginate($limit);
    


        return view('sdm.pengajuan.tambahdetail', $data);

    }



    public function detailpengajuanku(Request $request,$id)
    {

        $data['title'] = "Detail Pengajuan Data";
        $data['id'] = $id;
        $limit = request('limit', 10);


        $data['data'] = Kas::whereNotExists(function ($query)  {
            $query->select('id')
                  ->from('detail_pengajuan')
                  ->whereColumn('kas.id', 'detail_pengajuan.id_kas'); // Mengganti '.id_kas' menjadi 'detail_pengajuan.id_kas'
        })
        ->orderByDesc('kas.id') // Mengubah 'orderby' menjadi 'orderByDesc' dan mengganti urutan menjadi 'orderByDesc'
        ->orderByDesc('tanggal') // Mengubah urutan menjadi 'orderByDesc'
        ->paginate($limit);
    


        return view('keuangan.pengajuan.tambahdetail', $data);

    }



    public function postdetailpengajuan(Request $request,$id)
    {

    
         // Mendapatkan array dari item yang dipilih
         $selectedItems = $request->input('selectedItems');

         // Lakukan sesuatu dengan setiap item yang dipilih
         foreach ($selectedItems as $selectedItem) {
            Detail_pengajuan::create([
                'tanggal' => now()->format('Y-m-d'), // gunakan format() untuk format tanggal
                'id_kas' => $selectedItem,
                'id_pengajuan' => $id,
                'status' => "P",
            ]);
        }
    

          // Jika Anda ingin menghitung jumlah item yang berhasil diajukan
        $itemCount = count($selectedItems);

        // Pesan sukses dengan jumlah item yang berhasil diajukan
        return redirect()->route('pendistribusian.tasaruf.pengajuan')->with('success', "Berhasil mengajukan $itemCount item.");
   


    }


    public function postdetailpengajuanku(Request $request)
{
    // Validasi input
    $request->validate([
        'status.*' => 'required|in:P,R,S', // Pastikan status ada di antara P, R, atau S
        'idd.*' => 'required', // Pastikan idd tidak kosong
    ]);

    // Loop through each input and store/update data accordingly
    foreach ($request->idd as $key => $idd) {
        // Cari data berdasarkan ID
        $data = Detail_pengajuan::where('id_kas', $idd)->first(); // Gunakan first() untuk mendapatkan satu objek saja

        if ($data) {
            // Update status
            $data->status = $request->status[$key]; // Menggunakan $request->status[$key] untuk mendapatkan status yang sesuai
            $data->save();
        }
    }

    $itemCount = count($request->idd);

    // Pesan sukses dengan jumlah item yang berhasil diajukan
    return redirect()->route('keuangan.tasaruf.pengajuanku')->with('success', "Berhasil dirubah $itemCount item.");
}

    




    public function postdetailpengajuansdm(Request $request,$id)
    {

    
         // Mendapatkan array dari item yang dipilih
         $selectedItems = $request->input('selectedItems');

         // Lakukan sesuatu dengan setiap item yang dipilih
         foreach ($selectedItems as $selectedItem) {
            Detail_pengajuan::create([
                'tanggal' => now()->format('Y-m-d'), // gunakan format() untuk format tanggal
                'id_kas' => $selectedItem,
                'id_pengajuan' => $id,
                'status' => "P",
            ]);
        }
    

          // Jika Anda ingin menghitung jumlah item yang berhasil diajukan
        $itemCount = count($selectedItems);

        // Pesan sukses dengan jumlah item yang berhasil diajukan
        return redirect()->route('sdm.tasaruf.pengajuansdm')->with('success', "Berhasil mengajukan $itemCount item.");
   


    }


    
    public function hapuspengajuan(Request $request,$id)
     {

        Pengajuan::where('id',$id)->where('pengaju','P')
        ->delete();
        Detail_pengajuan::where('id_pengajuan',$id)
        ->delete();

        return redirect()->route('pendistribusian.tasaruf.pengajuan')->with('success', "Berhasil menghapus data ... !");


    }

     
    public function hapuspengajuansdm(Request $request,$id)
    {

       Pengajuan::where('id',$id)->where('pengaju','SDM')
       ->delete();
       Detail_pengajuan::where('id_pengajuan',$id)
       ->delete();

       return redirect()->route('sdm.tasaruf.pengajuansdm')->with('success', "Berhasil menghapus data ... !");


   }

    
   public function detaillihatpengajuanp(Request $request,$id)
   {

      Detail_pengajuan::where('id_kas', $id)
          ->update([
              'status' => "P"
          ]);

    

      return redirect()->route('pendistribusian.tasaruf.pengajuan')->with('success', "Data Berhasil dirubah ... !");


  }


  
  public function detaillihatpengajuanpsdm(Request $request,$id)
  {

     Detail_pengajuan::where('id_kas', $id)
         ->update([
             'status' => "P"
         ]);

   

     return redirect()->route('sdm.tasaruf.pengajuansdm')->with('success', "Data Berhasil dirubah ... !");


 }





 public function detaillihatpengajuan(Request $request, $id)
 {
     $data['title'] = "Detail Pengajuan Data";
     $data['id'] = $id;
     $limit = $request->input('limit', 10);
 
     $data['data'] = Kas::where('pengirim', 'P')
         ->where('type', 'SPJ')
         ->whereExists(function ($query) use ($id) {
             $query->select('id')
                 ->from('detail_pengajuan')
                 ->where('id_pengajuan', $id)
                 ->whereColumn('kas.id', 'detail_pengajuan.id_kas');
         })
         ->orderByDesc('kas.id')
         ->orderByDesc('tanggal')
         ->paginate($limit);
 
     foreach ($data['data'] as $cek) {
         $status = Detail_pengajuan::where('id_kas', $cek->id)->first();
         // Pastikan objek $status tidak null sebelum mengakses properti status
         $cek->status = $status ? $status->status : null;


         $muzaki = Proposal::where('id', $cek->id_muzaki)->first();
         // Pastikan objek $status tidak null sebelum mengakses properti status
         $cek->muzaki = $muzaki ? $muzaki->nama_pemohon : null;




     }
 
     return view('pendistribusian.pengajuan.lihat', $data);
 }
 


 public function detaillihatpengajuanku(Request $request, $id)
 {
     $data['title'] = "Detail Pengajuan Data";
     $data['id'] = $id;
     $limit = $request->input('limit', 10);
 
     $data['data'] = Kas::whereExists(function ($query) use ($id) {
             $query->select('id')
                 ->from('detail_pengajuan')
                 ->where('id_pengajuan', $id)
                 ->whereColumn('kas.id', 'detail_pengajuan.id_kas');
         })
         ->orderByDesc('kas.id')
         ->orderByDesc('tanggal')
         ->paginate($limit);
 
     foreach ($data['data'] as $cek) {
         $status = Detail_pengajuan::where('id_kas', $cek->id)->first();
         // Pastikan objek $status tidak null sebelum mengakses properti status
         $cek->status = $status ? $status->status : null;

         
     }
 
     return view('keuangan.pengajuan.lihat', $data);
 }
 

 

 public function detaillihatpengajuansdm(Request $request, $id)
 {
     $data['title'] = "Detail Pengajuan Data";
     $data['id'] = $id;
     $limit = $request->input('limit', 10);
 
     $data['data'] = Kas::where('pengirim', 'SDM')
         ->whereExists(function ($query) use ($id) {
             $query->select('id')
                 ->from('detail_pengajuan')
                 ->where('id_pengajuan', $id)
                 ->whereColumn('kas.id', 'detail_pengajuan.id_kas');
         })
         ->orderByDesc('kas.id')
         ->orderByDesc('tanggal')
         ->paginate($limit);
 
     foreach ($data['data'] as $cek) {
         $status = Detail_pengajuan::where('id_kas', $cek->id)->first();
         // Pastikan objek $status tidak null sebelum mengakses properti status
         $cek->status = $status ? $status->status : null;
     }
 
     return view('sdm.pengajuan.lihat', $data);
 }
 

 


 public function cetakdetaillihatpengajuan(Request $request, $id)
 {
     $data['title'] = "Detail Pengajuan Data";
     $data['id'] = $id;
 
     $pengajuan = Pengajuan::where('pengaju', 'P')
         ->where('id', $id)
         ->where('tahun', session('tahun_aktif'))
         ->orderByDesc('id')
         ->orderByDesc('tanggal')
         ->first();
 
     $data['data'] = $pengajuan;
 
     $detail_pengajuan = Detail_pengajuan::join('kas', 'kas.id', 'detail_pengajuan.id_kas')
         ->where('detail_pengajuan.id_pengajuan', $id)
         ->orderByDesc('detail_pengajuan.id')
         ->orderByDesc('detail_pengajuan.tanggal')
         ->get();
 
     foreach ($detail_pengajuan as $keuangan) {
        $proposal = Proposal::find($keuangan->id_muzaki);
        $debet = AkunKeuangan::find($keuangan->debet);
        $kredit = AkunKeuangan::find($keuangan->kredit);
        $keuangan->proposal = $proposal ? $proposal->nama_pemohon : null;
        $keuangan->debett = $debet ? $debet->uraian : null;
        $keuangan->kreditt = $kredit ? $kredit->uraian : null;
     }
 
     $data['detail'] = $detail_pengajuan;
     $nomor = $pengajuan->nomor_pengajuan;
     $tanggal = $pengajuan->tanggal;
     $keterangan = $pengajuan->keterangan;
     $text = "
     Nomor Transaksi: $nomor
     Tanggal : $tanggal
     Keterangan: $keterangan
     ";
 
     $data['qrCode'] = QrCode::size(300)->generate($text);
 
     $pdf = PDF::loadView('pendistribusian.pengajuan.cetak', $data)->setPaper('F4', 'landscape');
     return $pdf->stream('pengajuan.pdf');
 }
 



 public function cetakdetaillihatpengajuansdm(Request $request, $id)
 {
     $data['title'] = "Detail Pengajuan Data";
     $data['id'] = $id;
 
     $pengajuan = Pengajuan::where('pengaju', 'SDM')
         ->where('id', $id)
         ->where('tahun', session('tahun_aktif'))
         ->orderByDesc('id')
         ->orderByDesc('tanggal')
         ->first();
 
     $data['data'] = $pengajuan;
 
     $detail_pengajuan = Detail_pengajuan::join('kas', 'kas.id', 'detail_pengajuan.id_kas')
         ->where('detail_pengajuan.id_pengajuan', $id)
         ->orderByDesc('detail_pengajuan.id')
         ->orderByDesc('detail_pengajuan.tanggal')
         ->get();
 
     foreach ($detail_pengajuan as $keuangan) {
         $debet = AkunKeuangan::find($keuangan->debet);
         $kredit = AkunKeuangan::find($keuangan->kredit);
         $keuangan->debett = $debet ? $debet->uraian : null;
         $keuangan->kreditt = $kredit ? $kredit->uraian : null;
     }
 
     $data['detail'] = $detail_pengajuan;
     $nomor = $pengajuan->nomor_pengajuan;
     $tanggal = $pengajuan->tanggal;
     $keterangan = $pengajuan->keterangan;
     $text = "
     Nomor Transaksi: $nomor
     Tanggal : $tanggal
     Keterangan: $keterangan
     ";
 
     $data['qrCode'] = QrCode::size(300)->generate($text);
 
     $pdf = PDF::loadView('sdm.pengajuan.cetak', $data)->setPaper('F4', 'landscape');
     return $pdf->stream('pengajuan.pdf');
 }
 




 public function cetakdetaillihatpengajuanku(Request $request, $id)
 {
     $data['title'] = "Detail Pengajuan Data";
     $data['id'] = $id;
 
     $pengajuan = Pengajuan::where('id', $id)
         ->where('tahun', session('tahun_aktif'))
         ->orderByDesc('id')
         ->orderByDesc('tanggal')
         ->first();
 
     $data['data'] = $pengajuan;
 
     $detail_pengajuan = Detail_pengajuan::join('kas', 'kas.id', 'detail_pengajuan.id_kas')
         ->where('detail_pengajuan.id_pengajuan', $id)
         ->orderByDesc('detail_pengajuan.id')
         ->orderByDesc('detail_pengajuan.tanggal')
         ->get();
 
     foreach ($detail_pengajuan as $keuangan) {
         $debet = AkunKeuangan::find($keuangan->debet);
         $kredit = AkunKeuangan::find($keuangan->kredit);
         $keuangan->debett = $debet ? $debet->uraian : null;
         $keuangan->kreditt = $kredit ? $kredit->uraian : null;
     }
 
     $data['detail'] = $detail_pengajuan;
     $nomor = $pengajuan->nomor_pengajuan;
     $tanggal = $pengajuan->tanggal;
     $keterangan = $pengajuan->keterangan;
     $text = "
     Nomor Transaksi: $nomor
     Tanggal : $tanggal
     Keterangan: $keterangan
     ";
 
     $data['qrCode'] = QrCode::size(300)->generate($text);
 
     $pdf = PDF::loadView('keuangan.pengajuan.cetak', $data)->setPaper('F4', 'landscape');
     return $pdf->stream('pengajuan.pdf');
 }
 




 public function destroyy(Request $request) {
    $selectedItems = $request->input('selectedItems');

    if($selectedItems) {
        $deletedCount = Kas::whereIn('id', $selectedItems)->where('pengirim','P')->where('type','SPJ')->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus ' . $deletedCount . ' item.');
    } else {
        return redirect()->back()->with('error', 'Tidak ada item yang dipilih untuk dihapus.');
    }


}




}
