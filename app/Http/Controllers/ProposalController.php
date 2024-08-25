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
use App\Exports\ProposalExport;
use App\Exports\MperExport;
use App\Exports\OnprosesProposalExport;
use App\Exports\TindaklanjutProposalExport;
use App\Exports\AkhirProposalExport;
use App\Imports\ProposalPerseoranganImport;
use App\Imports\ProposalLembagaImport;
use App\Imports\ProposalProsesImport;
use App\Imports\ProposalLanjutImport;
use Carbon\Carbon;



use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;




class ProposalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = "Master Proposal Permohonan";
        $limit = request('limit', 10);
        
      


        $data['data'] = Proposal::orderBy('id', 'DESC')
                                ->orderBy('tanggal_masuk', 'DESC')
                                ->where('tahun', session('tahun_aktif'))
                                ->paginate($limit);
        $data['kas'] = Kas::where('id_muzaki', $data['data']->pluck('id')->toArray())->first();
                        
                          
        $data['allproposal'] = Proposal::orderBy('id', 'DESC')
                                ->orderBy('tanggal_masuk', 'DESC')
                                ->where('tahun', session('tahun_aktif'))
                                ->count();

        $data['onproses'] = Proposal::orderBy('id', 'DESC')
                                ->orderBy('tanggal_masuk', 'DESC')
                                ->where('status', "O")
                                ->where('tahun', session('tahun_aktif'))->count();

        $data['terima'] = Proposal::orderBy('id', 'DESC')
                                ->orderBy('tanggal_masuk', 'DESC')
                                ->where('status', "A")
                                ->where('tahun', session('tahun_aktif'))->count();

        $data['tolak'] = Proposal::orderBy('id', 'DESC')
                                ->orderBy('tanggal_masuk', 'DESC')
                                ->where('status', "N")
                                ->where('tahun', session('tahun_aktif'))->count();

        return view('proposal.permohonan.index', $data);
    }
    

    public function datapemohon()
    {
        $data['title'] = "Master Proposal Permohonan";
        $limit = request('limit', 10);
        
        $data['data'] = Proposal::orderBy('id', 'DESC')
                                ->orderBy('tanggal_masuk', 'DESC')
                                ->where('tahun', session('tahun_aktif'))
                                ->paginate($limit);
        
        $data['allproposal'] = Proposal::orderBy('id', 'DESC')
                                ->orderBy('tanggal_masuk', 'DESC')
                                ->where('tahun', session('tahun_aktif'))
                                ->count();

        $data['onproses'] = Proposal::orderBy('id', 'DESC')
                                ->orderBy('tanggal_masuk', 'DESC')
                                ->where('status', "O")
                                ->where('tahun', session('tahun_aktif'))->count();

        $data['terima'] = Proposal::orderBy('id', 'DESC')
                                ->orderBy('tanggal_masuk', 'DESC')
                                ->where('status', "A")
                                ->where('tahun', session('tahun_aktif'))->count();

        $data['tolak'] = Proposal::orderBy('id', 'DESC')
                                ->orderBy('tanggal_masuk', 'DESC')
                                ->where('status', "N")
                                ->where('tahun', session('tahun_aktif'))->count();

        return view('proposal.permohonan.index', $data);
    }
    




    public function perseorangan() 
    {
        $data['title'] = "Master Proposal Permohonan Perseorangan";
        $limit = request('limit', 10);
        

        $data['allproposal'] = Proposal::orderBy('id', 'DESC')
                                ->orderBy('tanggal_masuk', 'DESC')
                                ->where('jenis_pemohon', 'P')
                                ->where('tahun', session('tahun_aktif'))
                                ->count();

        $data['onproses'] = Proposal::orderBy('id', 'DESC')
                                ->orderBy('tanggal_masuk', 'DESC')
                                ->where('jenis_pemohon', 'P')
                                ->where('status', "O")
                                ->where('tahun', session('tahun_aktif'))->count();

        $data['terima'] = Proposal::orderBy('id', 'DESC')
                                ->orderBy('tanggal_masuk', 'DESC')
                                ->where('status', "A")
                                ->where('jenis_pemohon', 'P')
                                ->where('tahun', session('tahun_aktif'))->count();

        $data['tolak'] = Proposal::orderBy('id', 'DESC')
                                ->orderBy('tanggal_masuk', 'DESC')
                                ->where('status', "N")
                                ->where('jenis_pemohon', 'P')
                                ->where('tahun', session('tahun_aktif'))->count();

  


        $data['data'] = Proposal::orderBy('id', 'DESC')
                                ->orderBy('tanggal_masuk', 'DESC')
                                ->where('jenis_pemohon', 'P')
                                ->where('tahun', session('tahun_aktif'))
                                ->paginate($limit);
                                $data['kas'] = Kas::where('id_muzaki', $data['data']->pluck('id')->toArray())->first();

        return view('proposal.permohonan.perseorangan', $data);
    }
    
    public function lembaga()
    {
        $data['title'] = "Master Proposal Permohonan Lembaga";
        $limit = request('limit', 10);
        
         $data['allproposal'] = Proposal::orderBy('id', 'DESC')
                                ->orderBy('tanggal_masuk', 'DESC')
                                ->where('jenis_pemohon', 'L')
                                ->where('tahun', session('tahun_aktif'))
                                ->count();

        $data['onproses'] = Proposal::orderBy('id', 'DESC')
                                ->orderBy('tanggal_masuk', 'DESC')
                                ->where('jenis_pemohon', 'L')
                                ->where('status', "O")
                                ->where('tahun', session('tahun_aktif'))->count();

        $data['terima'] = Proposal::orderBy('id', 'DESC')
                                ->orderBy('tanggal_masuk', 'DESC')
                                ->where('status', "A")
                                ->where('jenis_pemohon', 'L')
                                ->where('tahun', session('tahun_aktif'))->count();

        $data['tolak'] = Proposal::orderBy('id', 'DESC')
                                ->orderBy('tanggal_masuk', 'DESC')
                                ->where('status', "N")
                                ->where('jenis_pemohon', 'L')
                                ->where('tahun', session('tahun_aktif'))->count();

        $data['data'] = Proposal::orderBy('id', 'DESC')
                                ->orderBy('tanggal_masuk', 'DESC')
                                ->where('jenis_pemohon', 'L')
                                ->where('tahun', session('tahun_aktif'))
                                ->paginate($limit);
                                $data['kas'] = Kas::where('id_muzaki', $data['data']->pluck('id')->toArray())->first();

        return view('proposal.permohonan.lembaga', $data);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $data['id'] = $id;
        $data['title'] = "Tambah Proposal Permohonan";
        $data['kecamatan'] = Kecamatan::orderBy('nama_kecamatan','ASC')->get();
        $data['program'] = AkunKeuangan::orderBy('uraian','ASC')->where('jenis_akun','like','%PROGRAM%')->where('level','3')->get();
        return view('proposal.permohonan.tambah', $data);

    }


    public function destroyy(Request $request) {
        $selectedItems = $request->input('selectedItems');
    
        if($selectedItems) {
            $deletedCount = Proposal::whereIn('id', $selectedItems)->delete();
            return redirect()->back()->with('success', 'Berhasil menghapus ' . $deletedCount . ' item.');
        } else {
            return redirect()->back()->with('error', 'Tidak ada item yang dipilih untuk dihapus.');
        }
    
    
    }

    



    public function pcreate($id)
    {
        $data['id'] = $id;
        $data['title'] = "Tambah Proposal Permohonan";
        $data['kecamatan'] = Kecamatan::orderBy('nama_kecamatan','ASC')->get();
        $data['program'] = AkunKeuangan::orderBy('uraian','ASC')->where('jenis_akun','like','%PROGRAM%')->where('level','3')->get();
        return view('proposal.permohonan.ptambah', $data);

    }

    public function lcreate($id)
    {
        $data['id'] = $id;
        $data['title'] = "Tambah Proposal Permohonan";
        $data['kecamatan'] = Kecamatan::orderBy('nama_kecamatan','ASC')->get();
        $data['program'] = AkunKeuangan::orderBy('uraian','ASC')->where('jenis_akun','like','%PROGRAM%')->where('level','3')->get();
        return view('proposal.permohonan.ltambah', $data);

    }


    public function getkelurahan($id)
    {
        $data = Kelurahan::where('id_kecamatan', $id)->pluck('nama_kelurahan', 'id');
        return response()->json($data);
    }
    
    public function getsubprogram($id)
    {
        $data = AkunKeuangan::where('kode', 'like', $id . '%')->where('jenis_akun', 'like', '%PROGRAM%')->where('level', '4')->pluck('uraian', 'kode');
        return response()->json($data);
    }
    
    
    public function getsubprogramm($id)
    {
        $data = AkunKeuangan::where('kode', 'like', $id . '%')->where('level', '4')->pluck('uraian', 'kode');
        return response()->json($data);
    }
    


    public function detailprogram($id)
    {
        $data = AkunKeuangan::where('kode', 'like', $id . '%')->where('jenis_akun', 'like', '%PROGRAM%')->where('level', '5')->pluck('uraian', 'id');
        return response()->json($data);
    }
 
    
    public function detailprogramm($id)
    {
        $data = AkunKeuangan::where('kode', 'like', $id . '%')->where('level', '5')->pluck('uraian', 'id');
        return response()->json($data);
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date',
            'sifat' => 'required|in:uang,barang',
            'jenis_pemohon' => 'required|in:P,L',
            'nama' => 'required|string',
            'nik' => 'required|string',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'hp' => 'nullable|string',
            'pekerjaan' => 'nullable|string',
            'alamat' => 'required|string',
            'kecamatan' => 'required|string',
            'kelurahan' => 'required|string',
            'rt' => 'required|string',
            'rw' => 'required|string',
            'detail_program' => 'required|string',
            'keterangan' => 'nullable|string',
            'proposal' => 'nullable|file|max:10240', // Max file size: 10MB
   
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {

            $nominal = str_replace('.', '', $request->input('nominal'));


            if ($request->jenis_pemohon == 'L') 
            {
                $kirim = Proposal::Lembaga($request->tanggal);
            } else {
                $kirim = Proposal::Perseorangan($request->tanggal);
            }

          // Pengecekan keberadaan file proposal
            if ($request->hasFile('proposal')) {
                $file = $request->file('proposal');
                $nama_file = time() . "_" . $file->getClientOriginalName();
                $tujuan_upload = 'proposal';
                $file->move($tujuan_upload, $nama_file);
            }

            // Persiapan data proposal
            $data = [
                'tanggal_masuk' => $request->tanggal,
                'nomor_proposal' => $kirim,
                'jenis_permohonan' => $request->sifat,
                'nama_pemohon' => $request->nama,
                'nik' => $request->nik,
                'jenis_pemohon' => $request->jenis_pemohon,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'hp' => $request->hp,
                'pekerjaan' => $request->pekerjaan,
                'alamat_lengkap' => $request->alamat,
                'kecamatan' => $request->kecamatan,
                'kelurahan' => $request->kelurahan,
                'rt' => $request->rw,
                'rw' => $request->rt,
                'program' => $request->program,
                'sub_program' => $request->subprogram,
                'detail_program' => $request->detail_program,
                'nominal_pengajuan' => $nominal,
                'keterangan' => $request->keterangan,
                'tahun' => session('tahun_aktif'),
                'user_id' => Auth::user()->id,
            ];

            // Jika file proposal ada, tambahkan nama file ke data proposal
            if (isset($nama_file)) {
                $data['proposal'] = $nama_file;
            }

            // Buat proposal
            Proposal::create($data);


            return redirect()->route('proposal.proposal.index')
            ->with('success','Data Berhasil disimpan.');
        }
    }

    public function pstore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date',
            'sifat' => 'required|in:uang,barang',
            'jenis_pemohon' => 'required|in:P,L',
            'nama' => 'required|string',
            'nik' => 'required|string',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'hp' => 'nullable|string',
            'pekerjaan' => 'nullable|string',
            'alamat' => 'required|string',
            'kecamatan' => 'required|string',
            'kelurahan' => 'required|string',
            'rt' => 'required|string',
            'rw' => 'required|string',
            'detail_program' => 'required|string',
            'keterangan' => 'nullable|string',
            'proposal' => 'nullable|file|max:10240', // Max file size: 10MB
   
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {

            $nominal = str_replace('.', '', $request->input('nominal'));


            if ($request->jenis_pemohon == 'L') 
            {
                $kirim = Proposal::Lembaga($request->tanggal);
            } else {
                $kirim = Proposal::Perseorangan($request->tanggal);
            }

          // Pengecekan keberadaan file proposal
            if ($request->hasFile('proposal')) {
                $file = $request->file('proposal');
                $nama_file = time() . "_" . $file->getClientOriginalName();
                $tujuan_upload = 'proposal';
                $file->move($tujuan_upload, $nama_file);
            }

            // Persiapan data proposal
            $data = [
                'tanggal_masuk' => $request->tanggal,
                'nomor_proposal' => $kirim,
                'jenis_permohonan' => $request->sifat,
                'nama_pemohon' => $request->nama,
                'nik' => $request->nik,
                'jenis_pemohon' => $request->jenis_pemohon,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'hp' => $request->hp,
                'pekerjaan' => $request->pekerjaan,
                'alamat_lengkap' => $request->alamat,
                'kecamatan' => $request->kecamatan,
                'kelurahan' => $request->kelurahan,
                'rt' => $request->rw,
                'rw' => $request->rt,
                'program' => $request->program,
                'sub_program' => $request->subprogram,
                'detail_program' => $request->detail_program,
                'nominal_pengajuan' => $nominal,
                'keterangan' => $request->keterangan,
                'tahun' => session('tahun_aktif'),
                'user_id' => Auth::user()->id,
            ];

            // Jika file proposal ada, tambahkan nama file ke data proposal
            if (isset($nama_file)) {
                $data['proposal'] = $nama_file;
            }

            // Buat proposal
            Proposal::create($data);


            return redirect()->route('proposal.proposal.perseorangan')
            ->with('success','Data Berhasil disimpan.');
        }
    }


    public function lstore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date',
            'sifat' => 'required|in:uang,barang',
            'jenis_pemohon' => 'required|in:P,L',
            'nama' => 'required|string',
            'nik' => 'required|string',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'hp' => 'nullable|string',
            'pekerjaan' => 'nullable|string',
            'alamat' => 'required|string',
            'kecamatan' => 'required|string',
            'kelurahan' => 'required|string',
            'rt' => 'required|string',
            'rw' => 'required|string',
            'detail_program' => 'required|string',
            'keterangan' => 'nullable|string',
            'proposal' => 'nullable|file|max:10240', // Max file size: 10MB
   
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {

            $nominal = str_replace('.', '', $request->input('nominal'));


            if ($request->jenis_pemohon == 'L') 
            {
                $kirim = Proposal::Lembaga($request->tanggal);
            } else {
                $kirim = Proposal::Perseorangan($request->tanggal);
            }

          // Pengecekan keberadaan file proposal
            if ($request->hasFile('proposal')) {
                $file = $request->file('proposal');
                $nama_file = time() . "_" . $file->getClientOriginalName();
                $tujuan_upload = 'proposal';
                $file->move($tujuan_upload, $nama_file);
            }

            // Persiapan data proposal
            $data = [
                'tanggal_masuk' => $request->tanggal,
                'nomor_proposal' => $kirim,
                'jenis_permohonan' => $request->sifat,
                'nama_pemohon' => $request->nama,
                'nik' => $request->nik,
                'jenis_pemohon' => $request->jenis_pemohon,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'hp' => $request->hp,
                'pekerjaan' => $request->pekerjaan,
                'alamat_lengkap' => $request->alamat,
                'kecamatan' => $request->kecamatan,
                'kelurahan' => $request->kelurahan,
                'rt' => $request->rw,
                'rw' => $request->rt,
                'program' => $request->program,
                'sub_program' => $request->subprogram,
                'detail_program' => $request->detail_program,
                'nominal_pengajuan' => $nominal,
                'keterangan' => $request->keterangan,
                'tahun' => session('tahun_aktif'),
                'user_id' => Auth::user()->id,
            ];

            // Jika file proposal ada, tambahkan nama file ke data proposal
            if (isset($nama_file)) {
                $data['proposal'] = $nama_file;
            }

            // Buat proposal
            Proposal::create($data);


            return redirect()->route('proposal.proposal.lembaga')
            ->with('success','Data Berhasil disimpan.');
        }
    }



    public function destroy($id)
    {

        Proposal::find($id)->delete();
        return redirect()->route('proposal.proposal.index')->with('warning', 'Data berhasil dihapus.');

    }


    public function pdestroy($id)
    {

        Proposal::where('id',$id)->where('jenis_pemohon','P')->delete();
        return redirect()->route('proposal.proposal.perseorangan')->with('warning', 'Data berhasil dihapus.');

    }

    public function ldestroy($id)
    {

        Proposal::where('id',$id)->where('jenis_pemohon','L')->delete();
        return redirect()->route('proposal.proposal.lembaga')->with('warning', 'Data berhasil dihapus.');

    }


    public function wdestroy($id)
    {

        Proposal::find($id)->where('jenis_pemohon','L')->delete();
        return redirect()->route('proposal.proposal.lembaga')->with('warning', 'Data berhasil dihapus.');

    }


 
    public function cetaksurvey($id)
    {
        $data['data'] = Proposal::find($id);                                
        $pdf = PDF::loadView('proposal.permohonan.cetaksurvey', $data)->setPaper('F4', 'portrait');
        return $pdf->download('form_survey.pdf');

    }



    public function bukti($id)
    {
        // Temukan data proposal berdasarkan ID
        $proposal = Proposal::find($id);
    
        // Ambil nomor proposal dari data proposal
        $nomor = $proposal->nomor_proposal;
        $namaPemohon = $proposal->nama_pemohon;
        $tanggal = $proposal->tanggal_masuk;
    
        // Buat teks untuk QR code
        $text = "
            Nomor Proposal: $nomor
            Nama Pemohon: $namaPemohon
            Tanggal: $tanggal
        ";
    
        // Generate QR code dengan teks
        $qrCode = QrCode::size(300)->generate($text);
    
        // Masukkan data proposal dan QR code ke dalam array data
        $data = [
            'data' => $proposal,
            'qrCode' => $qrCode
        ];
    
        // Load view PDF dengan data yang telah disiapkan
        $pdf = PDF::loadView('proposal.permohonan.bukti', $data)->setPaper('F4', 'portrait');
        
        // Download PDF
        return $pdf->download('bukti.pdf');
    }



    public function edit(string $id)
    {
        //
        $dataku['data'] = Proposal::find($id);
        $cek = $dataku['data']->kecamatan;
        $dataku['title'] = "Edit Proposal Permohonan";
        $dataku['kecamatan'] = Kecamatan::orderBy('nama_kecamatan','ASC')->get();
        $dataku['kelurahan'] = Kelurahan::orderBy('nama_kelurahan','ASC')->where('id_kecamatan',$cek)->get();
        $dataku['program'] = AkunKeuangan::orderBy('uraian','ASC')->where('jenis_akun','like','%PROGRAM%')->where('level','3')->get();
        $program_id = $dataku['data']->program; // Ambil id program dari data proposal
        $subprogram_id = $dataku['data']->sub_program; // Ambil id program dari data proposal
        $dataku['subprogram'] = AkunKeuangan::orderBy('uraian','ASC')->where('jenis_akun','like','%PROGRAM%')
        ->where('kode','like',$program_id . '%')
        ->where('level','4')->get();
        $dataku['detailprogram'] = AkunKeuangan::orderBy('uraian','ASC')->where('jenis_akun','like','%PROGRAM%')
        ->where('kode','like',$subprogram_id . '%')
        ->where('level','5')->get();



        $keywo = $dataku['data']->id;
        $dataku['kas'] = Kas::where('id_muzaki', $keywo)->first();




        return view('proposal.permohonan.edit', $dataku);
    }



    public function pedit(string $id)
    {
        //
        $dataku['data'] = Proposal::find($id);
        $cek = $dataku['data']->kecamatan;
        $dataku['title'] = "Edit Proposal Permohonan";
        $dataku['kecamatan'] = Kecamatan::orderBy('nama_kecamatan','ASC')->get();
        $dataku['kelurahan'] = Kelurahan::orderBy('nama_kelurahan','ASC')->where('id_kecamatan',$cek)->get();
        $dataku['program'] = AkunKeuangan::orderBy('uraian','ASC')->where('jenis_akun','like','%PROGRAM%')->where('level','3')->get();
        $program_id = $dataku['data']->program; // Ambil id program dari data proposal
        $subprogram_id = $dataku['data']->sub_program; // Ambil id program dari data proposal
        $dataku['subprogram'] = AkunKeuangan::orderBy('uraian','ASC')->where('jenis_akun','like','%PROGRAM%')
        ->where('kode','like',$program_id . '%')
        ->where('level','4')->get();
        $dataku['detailprogram'] = AkunKeuangan::orderBy('uraian','ASC')->where('jenis_akun','like','%PROGRAM%')
        ->where('kode','like',$subprogram_id . '%')
        ->where('level','5')->get();
            
        $keywo = $dataku['data']->id;
        $dataku['kas'] = Kas::where('id_muzaki', $keywo)->first();

        return view('proposal.permohonan.pedit', $dataku);
    }


    public function ledit(string $id)
    {
        //
        $dataku['data'] = Proposal::find($id);
        $cek = $dataku['data']->kecamatan;
        $dataku['title'] = "Edit Proposal Permohonan";
        $dataku['kecamatan'] = Kecamatan::orderBy('nama_kecamatan','ASC')->get();
        $dataku['kelurahan'] = Kelurahan::orderBy('nama_kelurahan','ASC')->where('id_kecamatan',$cek)->get();
        $dataku['program'] = AkunKeuangan::orderBy('uraian','ASC')->where('jenis_akun','like','%PROGRAM%')->where('level','3')->get();
        $program_id = $dataku['data']->program; // Ambil id program dari data proposal
        $subprogram_id = $dataku['data']->sub_program; // Ambil id program dari data proposal
        $dataku['subprogram'] = AkunKeuangan::orderBy('uraian','ASC')->where('jenis_akun','like','%PROGRAM%')
        ->where('kode','like',$program_id . '%')
        ->where('level','4')->get();
        $dataku['detailprogram'] = AkunKeuangan::orderBy('uraian','ASC')->where('jenis_akun','like','%PROGRAM%')
        ->where('kode','like',$subprogram_id . '%')
        ->where('level','5')->get();

            
        $keywo = $dataku['data']->id;
        $dataku['kas'] = Kas::where('id_muzaki', $keywo)->first();



        return view('proposal.permohonan.ledit', $dataku);
    }




    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date',
            'sifat' => 'required|in:uang,barang',
            'nama' => 'required|string',
            'nik' => 'required|string',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'hp' => 'nullable|string',
            'pekerjaan' => 'nullable|string',
            'alamat' => 'required|string',
            'kecamatan' => 'required|string',
            'kelurahan' => 'required|string',
            'rt' => 'required|string',
            'rw' => 'required|string',
            'detailprogram' => 'required|string',
            'keterangan' => 'nullable|string',
            'proposal' => 'nullable|file|max:10240', // Max file size: 10MB
        ]);
    
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $nominal = str_replace('.', '', $request->input('nominal'));
    
            if ($request->jenis_pemohon == 'L') {
                $kirim = Proposal::Lembaga($request->tanggal);
            } else {
                $kirim = Proposal::Perseorangan($request->tanggal);
            }
    
            // Pengecekan keberadaan file proposal
            if ($request->hasFile('proposal')) {
                $file = $request->file('proposal');
                $nama_file = time() . "_" . $file->getClientOriginalName();
                $tujuan_upload = 'proposal';
                $file->move($tujuan_upload, $nama_file);
            }
   
                 
   
                

            // Persiapan data proposal
            $data = [
                'tanggal_masuk' => $request->tanggal,
                // 'nomor_proposal' => $kirim,
                'nama_pemohon' => $request->nama,
                'nik' => $request->nik,
                'jenis_permohonan' => $request->sifat,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'hp' => $request->hp,
                'pekerjaan' => $request->pekerjaan,
                'alamat_lengkap' => $request->alamat,
                'kecamatan' => $request->kecamatan,
                'kelurahan' => $request->kelurahan,
                'rt' => $request->rw,
                'rw' => $request->rt,
                'program' => $request->program,
                'sub_program' => $request->subprogram,
                'detail_program' => $request->detailprogram,
                'nominal_pengajuan' => str_replace('.', '', $request->input('nominal')),
                'keterangan' => $request->keterangan,
                'tahun' => session('tahun_aktif'),
                'user_id' => Auth::user()->id,
            ];
     
            // Jika file proposal ada, tambahkan nama file ke data proposal
            if (isset($nama_file)) {
                $data['proposal'] = $nama_file;
            }
    
                // Pengecekan keberadaan file proposal
            if ($request->hasFile('kasfile')) {
                $filea = $request->file('kasfile');
                $nama_filea = time() . "_" . $filea->getClientOriginalName();
                $tujuan_uploada = 'sdmumum';
                $filea->move($tujuan_uploada, $nama_filea);
            }

            if (isset($nama_filea)) {
                $dataku['file'] = $nama_filea;
                $filekas = Kas::where('id_muzaki',$id);
                $filekas->update($dataku);        
            }
    

        
        
            // Perbarui proposal
            $proposal = Proposal::findOrFail($id);
            $proposal->update($data);
    
            return redirect()->route('proposal.proposal.index')
                ->with('success', 'Data Berhasil disimpan.');
        }
    }
    

    
    public function postprosess(Request $request, string $id)
    {
       
          
            // Mengambil proposal yang ada
            $proposal = Proposal::findOrFail($id);

            // Mendapatkan nilai status_akhir yang ada dalam database saat ini
            $oldStatusAkhir = $proposal->status;

            // Memeriksa apakah ada perubahan pada status_akhir
            if ($request->status_akhir != $oldStatusAkhir) {
                // Jika ada perubahan, tentukan nilai wa_status berdasarkan status_akhir yang baru
                if ($request->status_akhir == 'N' || $request->status_akhir == 'A') {
                    $waStatus = "SW";
                } else {
                    $waStatus = "BW";
                }
            } else {
                // Jika tidak ada perubahan, gunakan nilai wa_status yang ada sebelumnya
                $waStatus = $proposal->wa_status;
            }



            $data = [
                'tanggal_survey' => $request->tanggal_survey,
                'petugas_survey' => $request->petugas_survey,
                'keterangan_survey' => $request->keterangan_survey,
                'tanggal_penetapan' => $request->tanggal_penetapan,
                'lokasi' => $request->lokasi,
                'keterangan_penolakan' => $request->keterangan_akhir,
             
                'status' => $request->status_akhir,
                'wa_status' => $waStatus,
        
            ];
    
            $proposal = Proposal::findOrFail($id);
            $proposal->update($data);
    
            return redirect()->route('proposal.proposal.akhir')
                ->with('success', 'Data Berhasil disimpan.');
     
    }
    






    public function pupdate(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date',
            'sifat' => 'required|in:uang,barang',
            'nama' => 'required|string',
            'nik' => 'required|string',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'hp' => 'nullable|string',
            'pekerjaan' => 'nullable|string',
            'alamat' => 'required|string',
            'kecamatan' => 'required|string',
            'kelurahan' => 'required|string',
            'rt' => 'required|string',
            'rw' => 'required|string',
            'detailprogram' => 'required|string',
            'keterangan' => 'nullable|string',
            'proposal' => 'nullable|file|max:10240', // Max file size: 10MB
        ]);
    
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $nominal = str_replace('.', '', $request->input('nominal'));
    
            if ($request->jenis_pemohon == 'L') {
                $kirim = Proposal::Lembaga($request->tanggal);
            } else {
                $kirim = Proposal::Perseorangan($request->tanggal);
            }
    
            // Pengecekan keberadaan file proposal
            if ($request->hasFile('proposal')) {
                $file = $request->file('proposal');
                $nama_file = time() . "_" . $file->getClientOriginalName();
                $tujuan_upload = 'proposal';
                $file->move($tujuan_upload, $nama_file);
            }
    
            // Persiapan data proposal
            $data = [
                'tanggal_masuk' => $request->tanggal,
                // 'nomor_proposal' => $kirim,
                'nama_pemohon' => $request->nama,
                'nik' => $request->nik,
                'jenis_permohonan' => $request->sifat,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'hp' => $request->hp,
                'pekerjaan' => $request->pekerjaan,
                'alamat_lengkap' => $request->alamat,
                'kecamatan' => $request->kecamatan,
                'kelurahan' => $request->kelurahan,
                'rt' => $request->rw,
                'rw' => $request->rt,
                'program' => $request->program,
                'sub_program' => $request->subprogram,
                'detail_program' => $request->detailprogram,
                'nominal_pengajuan' => str_replace('.', '', $request->input('nominal')),
                'keterangan' => $request->keterangan,
                'tahun' => session('tahun_aktif'),
                'user_id' => Auth::user()->id,
            ];
    
            // Jika file proposal ada, tambahkan nama file ke data proposal
            if (isset($nama_file)) {
                $data['proposal'] = $nama_file;
            }
    
                            // Pengecekan keberadaan file proposal
                            if ($request->hasFile('kasfile')) {
                                $filea = $request->file('kasfile');
                                $nama_filea = time() . "_" . $filea->getClientOriginalName();
                                $tujuan_uploada = 'sdmumum';
                                $filea->move($tujuan_uploada, $nama_filea);
                            }
                
                            if (isset($nama_filea)) {
                                $dataku['file'] = $nama_filea;
                                $filekas = Kas::where('id_muzaki',$id);
                                $filekas->update($dataku);        
                            }

                            

            // Perbarui proposal
            $proposal = Proposal::findOrFail($id);
            $proposal->update($data);
    
            return redirect()->route('proposal.proposal.perseorangan')
                ->with('success', 'Data Berhasil disimpan.');
        }
    }
    



    public function lupdate(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date',
            'sifat' => 'required|in:uang,barang',
            'nama' => 'required|string',
            'nik' => 'required|string',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'hp' => 'nullable|string',
            'pekerjaan' => 'nullable|string',
            'alamat' => 'required|string',
            'kecamatan' => 'required|string',
            'kelurahan' => 'required|string',
            'rt' => 'required|string',
            'rw' => 'required|string',
            'detailprogram' => 'required|string',
            'keterangan' => 'nullable|string',
            'proposal' => 'nullable|file|max:10240', // Max file size: 10MB
        ]);
    
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $nominal = str_replace('.', '', $request->input('nominal'));
    
            if ($request->jenis_pemohon == 'L') {
                $kirim = Proposal::Lembaga($request->tanggal);
            } else {
                $kirim = Proposal::Perseorangan($request->tanggal);
            }
    
            // Pengecekan keberadaan file proposal
            if ($request->hasFile('proposal')) {
                $file = $request->file('proposal');
                $nama_file = time() . "_" . $file->getClientOriginalName();
                $tujuan_upload = 'proposal';
                $file->move($tujuan_upload, $nama_file);
            }
    
            // Persiapan data proposal
            $data = [
                'tanggal_masuk' => $request->tanggal,
                // 'nomor_proposal' => $kirim,
                'nama_pemohon' => $request->nama,
                'nik' => $request->nik,
                'jenis_permohonan' => $request->sifat,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'hp' => $request->hp,
                'pekerjaan' => $request->pekerjaan,
                'alamat_lengkap' => $request->alamat,
                'kecamatan' => $request->kecamatan,
                'kelurahan' => $request->kelurahan,
                'rt' => $request->rw,
                'rw' => $request->rt,
                'program' => $request->program,
                'sub_program' => $request->subprogram,
                'detail_program' => $request->detailprogram,
                'nominal_pengajuan' => str_replace('.', '', $request->input('nominal')),
                'keterangan' => $request->keterangan,
                'tahun' => session('tahun_aktif'),
                'user_id' => Auth::user()->id,
            ];
    
            // Jika file proposal ada, tambahkan nama file ke data proposal
            if (isset($nama_file)) {
                $data['proposal'] = $nama_file;
            }
    
                            // Pengecekan keberadaan file proposal
                            if ($request->hasFile('kasfile')) {
                                $filea = $request->file('kasfile');
                                $nama_filea = time() . "_" . $filea->getClientOriginalName();
                                $tujuan_uploada = 'sdmumum';
                                $filea->move($tujuan_uploada, $nama_filea);
                            }
                
                            if (isset($nama_filea)) {
                                $dataku['file'] = $nama_filea;
                                $filekas = Kas::where('id_muzaki',$id);
                                $filekas->update($dataku);        
                            }

                            


            // Perbarui proposal
            $proposal = Proposal::findOrFail($id);
            $proposal->update($data);
    
            return redirect()->route('proposal.proposal.lembaga')
                ->with('success', 'Data Berhasil disimpan.');
        }
    }
    


    public function search(Request $request) // Use Request class
    {
        $dataku['title'] = "Master Proposal Permohonan";
        $limit = request('limit', 10);
    
        $key = $request->input('keyword'); // Mendapatkan query pencarian dari input form
    
        $dataku['allproposal'] = Proposal::orderBy('id', 'DESC')
        ->orderBy('tanggal_masuk', 'DESC')
        ->where('tahun', session('tahun_aktif'))
        ->count();

        $dataku['onproses'] = Proposal::orderBy('id', 'DESC')
                ->orderBy('tanggal_masuk', 'DESC')
                ->where('status', "O")
                ->where('tahun', session('tahun_aktif'))->count();

        $dataku['terima'] = Proposal::orderBy('id', 'DESC')
                ->orderBy('tanggal_masuk', 'DESC')
                ->where('status', "A")
                ->where('tahun', session('tahun_aktif'))->count();

        $dataku['tolak'] = Proposal::orderBy('id', 'DESC')
                ->orderBy('tanggal_masuk', 'DESC')
                ->where('status', "N")
                ->where('tahun', session('tahun_aktif'))->count();


        // Validasi query pencarian
        if (empty($key)) {
            return redirect()->route('proposal.proposal.index');
        }
    
        // Query pencarian
        $dataku['data'] = Proposal::where('tahun', session('tahun_aktif'))
            ->where(function ($query) use ($key) {
                $query->where('nomor_proposal', 'LIKE', '%' . $key . '%')
                    ->orWhere('nama_pemohon', 'LIKE', '%' . $key . '%')
                    ->orWhere('hp', 'LIKE', '%' . $key . '%');
            })
            ->orderBy('proposal.id','DESC')
            ->orderBy('proposal.tanggal_masuk', 'DESC')
            ->paginate($limit);
        $dataku['kas'] = Kas::where('id_muzaki', $dataku['data']->pluck('id')->toArray())->first();

        return view('proposal.permohonan.index', $dataku);
    }
    

    public function psearch(Request $request) // Use Request class
    {
        $dataku['title'] = "Master Proposal Permohonan";
        $limit = request('limit', 10);
    
        $key = $request->input('keyword'); // Mendapatkan query pencarian dari input form
    

        $dataku['allproposal'] = Proposal::orderBy('id', 'DESC')
                                ->orderBy('tanggal_masuk', 'DESC')
                                ->where('jenis_pemohon', 'P')
                                ->where('tahun', session('tahun_aktif'))
                                ->count();

        $dataku['onproses'] = Proposal::orderBy('id', 'DESC')
                                ->orderBy('tanggal_masuk', 'DESC')
                                ->where('jenis_pemohon', 'P')
                                ->where('status', "O")
                                ->where('tahun', session('tahun_aktif'))->count();

        $dataku['terima'] = Proposal::orderBy('id', 'DESC')
                                ->orderBy('tanggal_masuk', 'DESC')
                                ->where('status', "A")
                                ->where('jenis_pemohon', 'P')
                                ->where('tahun', session('tahun_aktif'))->count();

        $dataku['tolak'] = Proposal::orderBy('id', 'DESC')
                                ->orderBy('tanggal_masuk', 'DESC')
                                ->where('status', "N")
                                ->where('jenis_pemohon', 'P')
                                ->where('tahun', session('tahun_aktif'))->count();

  
        // Validasi query pencarian
        if (empty($key)) {
            return redirect()->route('proposal.proposal.index');
        }
    
        // Query pencarian
        $dataku['data'] = Proposal::where('tahun', session('tahun_aktif'))
        ->where('jenis_pemohon','P')
            ->where(function ($query) use ($key) {
                $query->where('nomor_proposal', 'LIKE', '%' . $key . '%')
                    ->orWhere('nama_pemohon', 'LIKE', '%' . $key . '%')
                    ->orWhere('hp', 'LIKE', '%' . $key . '%');
            })
            ->orderBy('proposal.id','DESC')
            ->orderBy('proposal.tanggal_masuk', 'DESC')
            ->paginate($limit);
            $dataku['kas'] = Kas::where('id_muzaki', $dataku['data']->pluck('id')->toArray())->first();

        return view('proposal.permohonan.perseorangan', $dataku);
    }
    

    public function lsearch(Request $request) // Use Request class
    {
        $dataku['title'] = "Master Proposal Permohonan";
        $limit = request('limit', 10);
    
        $key = $request->input('keyword'); // Mendapatkan query pencarian dari input form
    

        $dataku['allproposal'] = Proposal::orderBy('id', 'DESC')
                                ->orderBy('tanggal_masuk', 'DESC')
                                ->where('jenis_pemohon', 'L')
                                ->where('tahun', session('tahun_aktif'))
                                ->count();

        $dataku['onproses'] = Proposal::orderBy('id', 'DESC')
                                ->orderBy('tanggal_masuk', 'DESC')
                                ->where('jenis_pemohon', 'L')
                                ->where('status', "O")
                                ->where('tahun', session('tahun_aktif'))->count();

        $dataku['terima'] = Proposal::orderBy('id', 'DESC')
                                ->orderBy('tanggal_masuk', 'DESC')
                                ->where('status', "A")
                                ->where('jenis_pemohon', 'L')
                                ->where('tahun', session('tahun_aktif'))->count();

        $dataku['tolak'] = Proposal::orderBy('id', 'DESC')
                                ->orderBy('tanggal_masuk', 'DESC')
                                ->where('status', "N")
                                ->where('jenis_pemohon', 'L')
                                ->where('tahun', session('tahun_aktif'))->count();

  
        // Validasi query pencarian
        if (empty($key)) {
            return redirect()->route('proposal.proposal.index');
        }
    
        // Query pencarian
        $dataku['data'] = Proposal::where('tahun', session('tahun_aktif'))
        ->where('jenis_pemohon','L')
            ->where(function ($query) use ($key) {
                $query->where('nomor_proposal', 'LIKE', '%' . $key . '%')
                    ->orWhere('nama_pemohon', 'LIKE', '%' . $key . '%')
                    ->orWhere('hp', 'LIKE', '%' . $key . '%');
            })
            ->orderBy('proposal.id','DESC')
            ->orderBy('proposal.tanggal_masuk', 'DESC')
            ->paginate($limit);
            $dataku['kas'] = Kas::where('id_muzaki', $dataku['data']->pluck('id')->toArray())->first();

        return view('proposal.permohonan.lembaga', $dataku);
    }
    

    public function all(Request $request)
    {
        $keyword = $request->input('keyword');
        $query = Proposal::where('tahun', session('tahun_aktif'))
                        ->orderBy('proposal.id', 'DESC')
                        ->orderBy('proposal.tanggal_masuk', 'DESC');
    
      
    
        $data = $query->get();
     
        // Loop through the data and fetch program details for each proposal
        foreach ($data as $proposal) {

            $kelurahan = Kelurahan::find($proposal->kelurahan);
            $kecamatan = Kecamatan::find($proposal->kecamatan);
            $petugas = User::find($proposal->petugas_survey);
            $proposal->kelurahan = $kelurahan ? $kelurahan->nama_kelurahan : null;
            $proposal->kecamatan = $kecamatan ? $kecamatan->nama_kecamatan : null;
            $proposal->petugas_survey = $petugas ? $petugas->name : null;


          
            $this->fetchProgramDetails($proposal, 'program', 'uraianprogram', 'kode');
            $this->fetchProgramDetails($proposal, 'sub_program', 'uraiansubprogram', 'kode');
            $this->fetchProgramDetails($proposal, 'detail_program', 'detailprogram', 'id');
        }

        return Excel::download(new ProposalExport($data), 'proposal.xlsx');
    }
    


    public function allonproses(Request $request)
    {
        $keyword = $request->input('keyword');
        $query = Proposal::where('tahun', session('tahun_aktif'))
                        ->where('status', "O")
                        ->orderBy('proposal.id', 'DESC')
                        ->orderBy('proposal.tanggal_masuk', 'DESC');
    
      
    
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

        return Excel::download(new ProposalExport($data), 'proposal.xlsx');
    }
    


    public function ddownload(Request $request)
    {
              return Excel::download(new MperExport(), 'master_import_perseorangan.xlsx');
    }
    




    public function diterimaex(Request $request)
    {
        $keyword = $request->input('keyword');
        $query = Proposal::where('tahun', session('tahun_aktif'))
                        ->where('status', "A")
                        ->orderBy('proposal.id', 'DESC')
                        ->orderBy('proposal.tanggal_masuk', 'DESC');
    
      
    
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

        return Excel::download(new ProposalExport($data), 'proposal_diterima.xlsx');
    }
     
    

    public function ditolakex(Request $request)
    {
        $keyword = $request->input('keyword');
        $query = Proposal::where('tahun', session('tahun_aktif'))
                        ->where('status', "N")
                        ->orderBy('proposal.id', 'DESC')
                        ->orderBy('proposal.tanggal_masuk', 'DESC');
    
      
    
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

        return Excel::download(new ProposalExport($data), 'proposal_ditolak.xlsx');
    }
    



    public function export(Request $request)
    {
        $keyword = $request->input('keyword');
        $query = Proposal::where('tahun', session('tahun_aktif'))
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
            $petugas = User::find($proposal->petugas_survey);
            $kecamatan = Kecamatan::find($proposal->kecamatan);
            $proposal->kelurahan = $kelurahan ? $kelurahan->nama_kelurahan : null;
            $proposal->kecamatan = $kecamatan ? $kecamatan->nama_kecamatan : null;
            $proposal->petugas = $petugas ? $petugas->name : null;


          
            $this->fetchProgramDetails($proposal, 'program', 'uraianprogram', 'kode');
            $this->fetchProgramDetails($proposal, 'sub_program', 'uraiansubprogram', 'kode');
            $this->fetchProgramDetails($proposal, 'detail_program', 'detailprogram', 'id');
        }




        
    
        return Excel::download(new ProposalExport($data), 'proposal.xlsx');
    }
    

    public function pexport(Request $request)
    {
        $keyword = $request->input('keyword');
        $query = Proposal::where('tahun', session('tahun_aktif'))
                        ->where('jenis_pemohon', 'P')
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
            $petugas = User::find($proposal->petugas_survey);
            $kecamatan = Kecamatan::find($proposal->kecamatan);
            $proposal->kelurahan = $kelurahan ? $kelurahan->nama_kelurahan : null;
            $proposal->kecamatan = $kecamatan ? $kecamatan->nama_kecamatan : null;
            $proposal->petugas = $petugas ? $petugas->name : null;
        }




        
    
        return Excel::download(new ProposalExport($data), 'proposal.xlsx');
    }
    
    public function lexport(Request $request)
    {
        $keyword = $request->input('keyword');
        $query = Proposal::where('tahun', session('tahun_aktif'))
                        ->where('jenis_pemohon', 'L')
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




        
    
        return Excel::download(new ProposalExport($data), 'proposal.xlsx');
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
    
    public function upload()
    {
        $data['title'] = "Upload Proposal Permohonan";
        return view('proposal.permohonan.upload', $data);

    }


    public function importperseorang(Request $request)
    {
     //
     $file = $request->file('file')->store('public/import');
     $import = new ProposalPerseoranganImport(); 
     $import->import($file);
     $sukses = $import->getRowCount();
     
     if($import->failures()->isNotEmpty()) {
         return back()->withFailures($import->failures())->with('gagal',$import->getRowCount()
         
     );;
  
     }

     return redirect()->route('proposal.proposal.perseorangan')->with('success', 'Data berhasil diimport '.$import->getRowCount().' Data');
        
    }
    

    public function importlembaga(Request $request)
    {
     //
     $file = $request->file('file')->store('public/import');
     $import = new ProposalLembagaImport(); 
     $import->import($file);
     $sukses = $import->getRowCount();
     
     if($import->failures()->isNotEmpty()) {
         return back()->withFailures($import->failures())->with('gagal',$import->getRowCount()
         
     );;
  
     }

     return redirect()->route('proposal.proposal.lembaga')->with('success', 'Data berhasil diimport '.$import->getRowCount().' Data');
        
    }


   /***************************************************** PROSES PROPOSAL *****************************************************/

   public function proses()
    {
        $data['title'] = "Proses Permohonan Proposal";
        $limit = request('limit', 10);
        
        $data['data'] = Proposal::orderBy('id', 'DESC')
                                ->orderBy('tanggal_masuk', 'DESC')
                                ->where('status', "B")
                                ->where('tahun', session('tahun_aktif'))
                                ->paginate($limit);
        
        $data['allproposal'] = Proposal::orderBy('id', 'DESC')
                                ->orderBy('tanggal_masuk', 'DESC')
                                ->where('tahun', session('tahun_aktif'))
                                ->count();

        $data['onproses'] = Proposal::orderBy('id', 'DESC')
                                ->orderBy('tanggal_masuk', 'DESC')
                                ->where('status', "O")
                                ->where('tahun', session('tahun_aktif'))->count();

        $data['terima'] = Proposal::orderBy('id', 'DESC')
                                ->orderBy('tanggal_masuk', 'DESC')
                                ->where('status', "A")
                                ->where('tahun', session('tahun_aktif'))->count();

        $data['tolak'] = Proposal::orderBy('id', 'DESC')
                                ->orderBy('tanggal_masuk', 'DESC')
                                ->where('status', "N")
                                ->where('tahun', session('tahun_aktif'))->count();

        $data['petugas'] = User::all();


        return view('proposal.proses.index', $data);
    }


    public function prosesbagi(Request $request)
    {
        $updatedProposalsCount = 0;
        
        foreach ($request->id as $key => $id) {
            $proposal = Proposal::findOrFail($id);
            $petugasId = $request->petugas[$key];
            $tangalId = $request->tanggal[$key];
            $keterangan = $request->keterangan[$key];
        
            if ($petugasId == '0') {
                $status = 'B';
            } else {
                $status = 'O';
                // Jika status berubah menjadi 'O', tambahkan ke jumlah proposal yang berhasil diupdate
                $updatedProposalsCount++;
            }
            $dateNow = date('Y-m-d');
            $proposal->petugas_survey = $petugasId;
            $proposal->tanggal_survey = $tangalId;
            $proposal->tanggal_input_survey = $dateNow;
            $proposal->keterangan_survey = $keterangan;
            $proposal->status = $status;
            $proposal->save();
        }
        
        // Buat pesan sukses dengan jumlah proposal yang berhasil diupdate menjadi 'O'
        $successMessage = 'Data Berhasil disimpan. Jumlah proposal yang berhasil : ' . $updatedProposalsCount;
        
        return redirect()->route('proposal.proposal.proses')
            ->with('success', $successMessage);
    }
    





   public function prosesupload()
   {

    $data['title'] = "Upload Proses Proposal Permohonan";
    $data['petugas'] = User::all();
 
    return view('proposal.proses.upload', $data);

   }




   public function prosesexport()
   {

        $query = Proposal::orderBy('id', 'DESC')
        ->orderBy('tanggal_masuk', 'DESC')
        ->where('status', "B")
        ->where('tahun', session('tahun_aktif'));
    

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

        return Excel::download(new OnprosesProposalExport($data), 'proposal_belum_terproses.xlsx');

   }


   public function importproses(Request $request)
   {
    //
    $file = $request->file('file')->store('public/import');
    $import = new ProposalProsesImport(); 
    $import->import($file);
    $sukses = $import->getRowCount();
    
    if($import->failures()->isNotEmpty()) {
        return back()->withFailures($import->failures())->with('gagal',$import->getRowCount()
        
    );;
 
    }

    return redirect()->route('proposal.proposal.proses')->with('success', 'Data berhasil diimport '.$import->getRowCount().' Data');
       
   }



   public function searchproses(Request $request) // Use Request class
   {
       $dataku['title'] = "Proses Proposal Permohonan";
       $limit = request('limit', 10);
   
       $key = $request->input('keyword'); // Mendapatkan query pencarian dari input form
   
       $dataku['allproposal'] = Proposal::orderBy('id', 'DESC')
       ->orderBy('tanggal_masuk', 'DESC')
       ->where('tahun', session('tahun_aktif'))
       ->count();

       $dataku['onproses'] = Proposal::orderBy('id', 'DESC')
               ->orderBy('tanggal_masuk', 'DESC')
               ->where('status', "O")
               ->where('tahun', session('tahun_aktif'))->count();

       $dataku['terima'] = Proposal::orderBy('id', 'DESC')
               ->orderBy('tanggal_masuk', 'DESC')
               ->where('status', "A")
               ->where('tahun', session('tahun_aktif'))->count();

       $dataku['tolak'] = Proposal::orderBy('id', 'DESC')
               ->orderBy('tanggal_masuk', 'DESC')
               ->where('status', "N")
               ->where('tahun', session('tahun_aktif'))->count();

        $dataku['petugas'] = User::all();

       // Validasi query pencarian
       if (empty($key)) {
           return redirect()->route('proposal.proposal.proses');
       }
   
       // Query pencarian
       $dataku['data'] = Proposal::where('tahun', session('tahun_aktif'))
            ->where('status', "B")
            ->where(function ($query) use ($key) {
               $query->where('nomor_proposal', 'LIKE', '%' . $key . '%')
                   ->orWhere('nama_pemohon', 'LIKE', '%' . $key . '%')
                   ->orWhere('hp', 'LIKE', '%' . $key . '%');
           })
           ->orderBy('proposal.id','DESC')
           ->orderBy('proposal.tanggal_masuk', 'DESC')
           ->paginate($limit);
   
       return view('proposal.proses.index', $dataku);
   }
   



   /***************************************************** TINDAK LANJUT PROPOSAL *****************************************************/



   public function lanjut()
    {
        $data['title'] = "Proses Permohonan Proposal";
        $limit = request('limit', 10);
        
        $data['data'] = Proposal::orderBy('id', 'DESC')
                                ->orderBy('tanggal_masuk', 'DESC')
                                ->where('status', "O")
                                ->where('tahun', session('tahun_aktif'))
                                ->paginate($limit);
        
        $data['allproposal'] = Proposal::orderBy('id', 'DESC')
                                ->orderBy('tanggal_masuk', 'DESC')
                                ->where('tahun', session('tahun_aktif'))
                                ->count();

        $data['onproses'] = Proposal::orderBy('id', 'DESC')
                                ->orderBy('tanggal_masuk', 'DESC')
                                ->where('status', "O")
                                ->where('tahun', session('tahun_aktif'))->count();

        $data['terima'] = Proposal::orderBy('id', 'DESC')
                                ->orderBy('tanggal_masuk', 'DESC')
                                ->where('status', "A")
                                ->where('tahun', session('tahun_aktif'))->count();

        $data['tolak'] = Proposal::orderBy('id', 'DESC')
                                ->orderBy('tanggal_masuk', 'DESC')
                                ->where('status', "N")
                                ->where('tahun', session('tahun_aktif'))->count();

        $data['petugas'] = User::all();

        foreach ($data['data'] as $id) {
            $petugas = User::find($id->petugas_survey);
            $id->petugass = $petugas ? $petugas->name : null;

        }
        return view('proposal.tindaklanjut.index', $data);
    }



    public function prosestindaklanjut(Request $request)
    {
        $updatedProposalsCount = 0;
        
        foreach ($request->id as $key => $id) {
            $proposal = Proposal::findOrFail($id);
            $tanggal = $request->tanggal[$key];
            $status = $request->status[$key];
            $keterangan = $request->keterangan[$key];
            $lokasi = $request->lokasi[$key];
        
            if ($status == 'A' || $status == 'N') {
                $statusa = $status;
                $updatedProposalsCount++;
            } else {
                $statusa = 'O';
            }
        
            $proposal->tanggal_penetapan = $tanggal;
            $proposal->keterangan_penolakan = $keterangan;
            $proposal->status = $statusa;
            $proposal->wa_status = "BW";
            $proposal->lokasi = $lokasi;
            $proposal->save();
        }
        
        // Buat pesan sukses dengan jumlah proposal yang berhasil diupdate menjadi 'O'
        $successMessage = 'Data Berhasil disimpan. Jumlah proposal yang berhasil : ' . $updatedProposalsCount;
        
        return redirect()->route('proposal.proposal.lanjut')
            ->with('success', $successMessage);
    }
    





   public function lanjutupload()
   {

    $data['title'] = "Upload Proses Proposal Permohonan";
    $data['petugas'] = User::all();
 
    return view('proposal.tindaklanjut.upload', $data);

   }




   public function lanjutexport()
   {

        $query = Proposal::orderBy('id', 'DESC')
        ->orderBy('tanggal_masuk', 'DESC')
        ->where('status', "O")
        ->where('tahun', session('tahun_aktif'));
    

        $data = $query->get();

       // Loop through the data and fetch program details for each proposal
       foreach ($data as $proposal) {

        $kelurahan = Kelurahan::find($proposal->kelurahan);
        $kecamatan = Kecamatan::find($proposal->kecamatan);
        $petugas = User::find($proposal->petugas_survey);
        $proposal->kelurahan = $kelurahan ? $kelurahan->nama_kelurahan : null;
        $proposal->kecamatan = $kecamatan ? $kecamatan->nama_kecamatan : null;
        $proposal->petugass = $petugas ? $petugas->name : null;
      
        $this->fetchProgramDetails($proposal, 'program', 'uraianprogram', 'kode');
        $this->fetchProgramDetails($proposal, 'sub_program', 'uraiansubprogram', 'kode');
        $this->fetchProgramDetails($proposal, 'detail_program', 'detailprogram', 'id');
        }

        return Excel::download(new TindaklanjutProposalExport($data), 'proposal_tindakan.xlsx');

   }


   public function lanjutimport(Request $request)
   {
    //
    $file = $request->file('file')->store('public/import');
    $import = new ProposalLanjutImport(); 
    $import->import($file);
    $sukses = $import->getRowCount();
    
    if($import->failures()->isNotEmpty()) {
        return back()->withFailures($import->failures())->with('gagal',$import->getRowCount()
        
    );;
 
    }

    return redirect()->route('proposal.proposal.lanjut')->with('success', 'Data berhasil diimport '.$import->getRowCount().' Data');
       
   }



   public function lanjutsearch(Request $request) // Use Request class
   {
       $dataku['title'] = "Proses Proposal Permohonan";
       $limit = request('limit', 10);
   
       $key = $request->input('keyword'); // Mendapatkan query pencarian dari input form
   
       $dataku['allproposal'] = Proposal::orderBy('id', 'DESC')
       ->orderBy('tanggal_masuk', 'DESC')
       ->where('tahun', session('tahun_aktif'))
       ->count();

       $dataku['onproses'] = Proposal::orderBy('id', 'DESC')
               ->orderBy('tanggal_masuk', 'DESC')
               ->where('status', "O")
               ->where('tahun', session('tahun_aktif'))->count();

       $dataku['terima'] = Proposal::orderBy('id', 'DESC')
               ->orderBy('tanggal_masuk', 'DESC')
               ->where('status', "A")
               ->where('tahun', session('tahun_aktif'))->count();

       $dataku['tolak'] = Proposal::orderBy('id', 'DESC')
               ->orderBy('tanggal_masuk', 'DESC')
               ->where('status', "N")
               ->where('tahun', session('tahun_aktif'))->count();

        $dataku['petugas'] = User::all();

       // Validasi query pencarian
       if (empty($key)) {
           return redirect()->route('proposal.proposal.proses');
       }
   
       // Query pencarian
       $dataku['data'] = Proposal::where('tahun', session('tahun_aktif'))
            ->where('status', "O")
            ->where(function ($query) use ($key) {
               $query->where('nomor_proposal', 'LIKE', '%' . $key . '%')
                   ->orWhere('nama_pemohon', 'LIKE', '%' . $key . '%')
                   ->orWhere('hp', 'LIKE', '%' . $key . '%');
           })
           ->orderBy('proposal.id','DESC')
           ->orderBy('proposal.tanggal_masuk', 'DESC')
           ->paginate($limit);
   
       return view('proposal.tindaklanjut.index', $dataku);
   }
   

   /***************************************************** AKHIR PROPOSAL *****************************************************/



   public function akhir()
    {
        $data['title'] = "Master Proposal Permohonan";
        $limit = request('limit', 10);
        
        $data['data'] = Proposal::orderBy('id', 'DESC')
                        ->orderBy('tanggal_masuk', 'DESC')
                        ->where('tahun', session('tahun_aktif'))
                        ->where(function ($query) {
                            $query->where('status', 'A')
                                  ->orWhere('status', 'N');
                        })
                        ->paginate($limit);
        
        $data['allproposal'] = Proposal::orderBy('id', 'DESC')
                                ->orderBy('tanggal_masuk', 'DESC')
                                ->where('tahun', session('tahun_aktif'))
                                ->count();

        $data['onproses'] = Proposal::orderBy('id', 'DESC')
                                ->orderBy('tanggal_masuk', 'DESC')
                                ->where('status', "O")
                                ->where('tahun', session('tahun_aktif'))->count();

        $data['terima'] = Proposal::orderBy('id', 'DESC')
                                ->orderBy('tanggal_masuk', 'DESC')
                                ->where('status', "A")
                                ->where('tahun', session('tahun_aktif'))->count();

        $data['tolak'] = Proposal::orderBy('id', 'DESC')
                                ->orderBy('tanggal_masuk', 'DESC')
                                ->where('status', "N")
                                ->where('tahun', session('tahun_aktif'))->count();

                                foreach ($data['data'] as $proposal) {
                                    // Menghitung jumlah proposal berdasarkan NIK
                                    $datapro = Proposal::where('nik', $proposal->nik)
                                    ->where('tahun', session('tahun_aktif'))
                                    ->count();
                                    
                                    // Menetapkan jumlah proposal jika lebih dari satu, jika tidak, maka tetapkan null
                                    $proposal->jml = ($datapro > 1) ? $datapro : null;
                                
                                    // Mengambil SPJ berdasarkan id_muzaki
                                    $spj = Kas::where('id_muzaki', $proposal->id)->first();
                                
                                    // Menetapkan file SPJ jika ditemukan, jika tidak, maka tetapkan null
                                    $proposal->spj = ($spj) ? $spj->file : null;
                                }
                                


        return view('proposal.akhir.index', $data);
    }
    



    public function kirimwa()
    {
        $data['title'] = "Kirim WA Notifikasi";
        $limit = request('limit', 10);
        
        $data['belum'] = Proposal::orderBy('id', 'DESC')
                        ->orderBy('tanggal_masuk', 'DESC')
                        ->where('tahun', session('tahun_aktif'))
                        ->where(function ($query) {
                            $query->where('wa_status', 'B')
                                ->orWhere('wa_status', 'BW');
                        })
                        ->count();
        
      
     
        
        $data['data'] = Proposal::orderBy('id', 'DESC')
                        ->orderBy('tanggal_masuk', 'DESC')
                        ->where('tahun', session('tahun_aktif'))
                        ->where(function ($query) {
                            $query->where('wa_status', 'B')
                                  ->orWhere('wa_status', 'BW');
                        })
                        ->paginate($limit);

        return view('proposal.wa.index', $data);
    }
    
    public function kirimwas()
    {
        $proposals = Proposal::orderBy('id', 'ASC')->where('wa_status','B')->limit(1)->first(); // Mengambil semua proposal

        if ($proposals){
        $phoneNumber = $proposals->hp;
        $nomor_proposal = $proposals->nomor_proposal;
        $nama = $proposals->nama_pemohon;
        $tgl = $proposals->tanggal_masuk;
        $tanggal = Carbon::parse($tgl)->format('d F Y');
        $phoneNumberWithoutZero = ltrim($phoneNumber, '0');
        $phoneNumberWithCountryCode = "62" . $phoneNumberWithoutZero;
        
        
        $dataSending = [
            "api_key" => "JVVEQVNYGOWIZ2HF",
            "number_key" => "MZO41Hm94rm4GOzR",
            "phone_no" => $phoneNumberWithCountryCode,
            "message" => "
*Bukti Penerimaan Proposal*

Tanggal: $tanggal

Narasi Penerimaan Proposal


Anda Bisa cek progres penerimaan proposal anda pada portal berikut ini :
https://

Hormat kami,
Baznas Kabupaten Klaten
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

    public function kirimwasa()
    {
        $proposals = Proposal::orderBy('id', 'ASC')->where('wa_status','BW')->limit(1)->first(); // Mengambil semua proposal

        if ($proposals){
        $phoneNumber = $proposals->hp;
        $nomor_proposal = $proposals->nomor_proposal;
        $nama = $proposals->nama_pemohon;
        $tgl = $proposals->tanggal_masuk;
        $tanggal = Carbon::parse($tgl)->format('d F Y');
        $phoneNumberWithoutZero = ltrim($phoneNumber, '0');
        $phoneNumberWithCountryCode = "62" . $phoneNumberWithoutZero;
        
        
        $dataSending = [
            "api_key" => "JVVEQVNYGOWIZ2HF",
            "number_key" => "MZO41Hm94rm4GOzR",
            "phone_no" => $phoneNumberWithCountryCode,
            "message" => "
*Bukti Penerimaan Proposal*

Tanggal: $tanggal

Narasi Penerimaan Proposal diteirma


Anda Bisa cek progres penerimaan proposal anda pada portal berikut ini :
https://

Hormat kami,
Baznas Kabupaten Klaten
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
    
            $proposals->update(['wa_status' => 'SW']);
    
        } else {
            echo"data kosong";
        }
       
    }
    



    public function editakhir(string $id)
    {
        //
        $dataku['data'] = Proposal::find($id);
        $cek = $dataku['data']->kecamatan;
        $dataku['title'] = "Edit Proposal Permohonan";
        $dataku['kecamatan'] = Kecamatan::orderBy('nama_kecamatan','ASC')->get();
        $dataku['kelurahan'] = Kelurahan::orderBy('nama_kelurahan','ASC')->where('id_kecamatan',$cek)->get();
        $dataku['program'] = AkunKeuangan::orderBy('uraian','ASC')->where('jenis_akun','like','%PROGRAM%')->where('level','3')->get();
        $program_id = $dataku['data']->program; // Ambil id program dari data proposal
        $subprogram_id = $dataku['data']->sub_program; // Ambil id program dari data proposal
        $dataku['subprogram'] = AkunKeuangan::orderBy('uraian','ASC')->where('jenis_akun','like','%PROGRAM%')
        ->where('kode','like',$program_id . '%')
        ->where('level','4')->get();
        $dataku['detailprogram'] = AkunKeuangan::orderBy('uraian','ASC')->where('jenis_akun','like','%PROGRAM%')
        ->where('kode','like',$subprogram_id . '%')
        ->where('level','5')->get();

        $dataku['petugas'] = User::all();


        
        return view('proposal.akhir.edit', $dataku);
    }




    public function detail(string $id)
    {
        //
        $dataku['data'] = Proposal::find($id);
        $cek = $dataku['data']->kecamatan;
        $dataku['title'] = "Edit Proposal Permohonan";
        $dataku['kecamatan'] = Kecamatan::orderBy('nama_kecamatan','ASC')->get();
        $dataku['kelurahan'] = Kelurahan::orderBy('nama_kelurahan','ASC')->where('id_kecamatan',$cek)->get();
        $dataku['program'] = AkunKeuangan::orderBy('uraian','ASC')->where('jenis_akun','like','%PROGRAM%')->where('level','3')->get();
        $program_id = $dataku['data']->program; // Ambil id program dari data proposal
        $subprogram_id = $dataku['data']->sub_program; // Ambil id program dari data proposal
        $dataku['subprogram'] = AkunKeuangan::orderBy('uraian','ASC')->where('jenis_akun','like','%PROGRAM%')
        ->where('kode','like',$program_id . '%')
        ->where('level','4')->get();
        $dataku['detailprogram'] = AkunKeuangan::orderBy('uraian','ASC')->where('jenis_akun','like','%PROGRAM%')
        ->where('kode','like',$subprogram_id . '%')
        ->where('level','5')->get();

        $dataku['petugas'] = User::all();


        
        return view('proposal.akhir.detail', $dataku);
    }




    public function prosess(string $id)
    {
        //
        $dataku['data'] = Proposal::find($id);
        $cek = $dataku['data']->kecamatan;
        $dataku['title'] = "Edit Proposal Permohonan";
        $dataku['kecamatan'] = Kecamatan::orderBy('nama_kecamatan','ASC')->get();
        $dataku['kelurahan'] = Kelurahan::orderBy('nama_kelurahan','ASC')->where('id_kecamatan',$cek)->get();
        $dataku['program'] = AkunKeuangan::orderBy('uraian','ASC')->where('jenis_akun','like','%PROGRAM%')->where('level','3')->get();
        $program_id = $dataku['data']->program; // Ambil id program dari data proposal
        $subprogram_id = $dataku['data']->sub_program; // Ambil id program dari data proposal
        $dataku['subprogram'] = AkunKeuangan::orderBy('uraian','ASC')->where('jenis_akun','like','%PROGRAM%')
        ->where('kode','like',$program_id . '%')
        ->where('level','4')->get();
        $dataku['detailprogram'] = AkunKeuangan::orderBy('uraian','ASC')->where('jenis_akun','like','%PROGRAM%')
        ->where('kode','like',$subprogram_id . '%')
        ->where('level','5')->get();

        $dataku['petugas'] = User::all();


        
        return view('proposal.akhir.proses', $dataku);
    }


    public function detailakhir(string $id)
    {
        //
        $dataku['data'] = Proposal::find($id);
        $cek = $dataku['data']->kecamatan;
        $dataku['title'] = "Edit Proposal Permohonan";
        $dataku['kecamatan'] = Kecamatan::orderBy('nama_kecamatan','ASC')->get();
        $dataku['kelurahan'] = Kelurahan::orderBy('nama_kelurahan','ASC')->where('id_kecamatan',$cek)->get();
        $dataku['program'] = AkunKeuangan::orderBy('uraian','ASC')->where('jenis_akun','like','%PROGRAM%')->where('level','3')->get();
        $program_id = $dataku['data']->program; // Ambil id program dari data proposal
        $subprogram_id = $dataku['data']->sub_program; // Ambil id program dari data proposal
        $dataku['subprogram'] = AkunKeuangan::orderBy('uraian','ASC')->where('jenis_akun','like','%PROGRAM%')
        ->where('kode','like',$program_id . '%')
        ->where('level','4')->get();
        $dataku['detailprogram'] = AkunKeuangan::orderBy('uraian','ASC')->where('jenis_akun','like','%PROGRAM%')
        ->where('kode','like',$subprogram_id . '%')
        ->where('level','5')->get();

        $dataku['petugas'] = User::all();


        
        return view('proposal.akhir.detail', $dataku);
    }





    public function postakhir(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date',
            'sifat' => 'required|in:uang,barang',
            'nama' => 'required|string',
            'nik' => 'required|string',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'hp' => 'nullable|string',
            'pekerjaan' => 'nullable|string',
            'alamat' => 'required|string',
            'kecamatan' => 'required|string',
            'kelurahan' => 'required|string',
            'rt' => 'required|string',
            'rw' => 'required|string',
            'detailprogram' => 'required|string',
            'keterangan' => 'nullable|string',
            'proposal' => 'nullable|file|max:10240', // Max file size: 10MB
        ]);
    
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $nominal = str_replace('.', '', $request->input('nominal'));
    
            if ($request->jenis_pemohon == 'L') {
                $kirim = Proposal::Lembaga($request->tanggal);
            } else {
                $kirim = Proposal::Perseorangan($request->tanggal);
            }
    
            // Pengecekan keberadaan file proposal
            if ($request->hasFile('proposal')) {
                $file = $request->file('proposal');
                $nama_file = time() . "_" . $file->getClientOriginalName();
                $tujuan_upload = 'proposal';
                $file->move($tujuan_upload, $nama_file);
            }
    
            // Persiapan data proposal
            $data = [
                'tanggal_masuk' => $request->tanggal,
                'nomor_proposal' => $kirim,
                'nama_pemohon' => $request->nama,
                'nik' => $request->nik,
                'jenis_permohonan' => $request->sifat,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'hp' => $request->hp,
                'pekerjaan' => $request->pekerjaan,
                'alamat_lengkap' => $request->alamat,
                'kecamatan' => $request->kecamatan,
                'kelurahan' => $request->kelurahan,
                'rt' => $request->rw,
                'rw' => $request->rt,
                'program' => $request->program,
                'sub_program' => $request->subprogram,
                'detail_program' => $request->detailprogram,
                'nominal_pengajuan' => str_replace('.', '', $request->input('nominal')),
                'keterangan' => $request->keterangan,
                'petugas_survey' => $request->petugas_survey,
                'keterangan_survey' => $request->keterangan_survey,
                'tanggal_penetapan' => $request->tanggal_penetapan,
                'tanggal_input_survey' => $request->tanggal_input_survey,
                'lokasi' => $request->lokasi,
                'keterangan_penolakan' => $request->keterangan_akhir,
                'status' => $request->status_akhir,
                'tahun' => session('tahun_aktif'),
                'user_id' => Auth::user()->id,
            ];
    
            // Jika file proposal ada, tambahkan nama file ke data proposal
            if (isset($nama_file)) {
                $data['proposal'] = $nama_file;
            }
    
            // Perbarui proposal
            $proposal = Proposal::findOrFail($id);
            $proposal->update($data);
    
            return redirect()->route('proposal.proposal.akhir')
                ->with('success', 'Data Berhasil disimpan.');
        }
    }
    


    public function searchakhir(Request $request) // Use Request class
    {
        $dataku['title'] = "Master Proposal Permohonan";
        $limit = request('limit', 10);
    
        $key = $request->input('keyword'); // Mendapatkan query pencarian dari input form
    
        $dataku['allproposal'] = Proposal::orderBy('id', 'DESC')
        ->orderBy('tanggal_masuk', 'DESC')
        ->where('tahun', session('tahun_aktif'))
        ->count();

        $dataku['onproses'] = Proposal::orderBy('id', 'DESC')
                ->orderBy('tanggal_masuk', 'DESC')
                ->where('status', "O")
                ->where('tahun', session('tahun_aktif'))->count();

        $dataku['terima'] = Proposal::orderBy('id', 'DESC')
                ->orderBy('tanggal_masuk', 'DESC')
                ->where('status', "A")
                ->where('tahun', session('tahun_aktif'))->count();

        $dataku['tolak'] = Proposal::orderBy('id', 'DESC')
                ->orderBy('tanggal_masuk', 'DESC')
                ->where('status', "N")
                ->where('tahun', session('tahun_aktif'))->count();


        // Validasi query pencarian
        if (empty($key)) {
            return redirect()->route('proposal.proposal.index');
        }
    
        // Query pencarian
        $dataku['data'] = Proposal::where('tahun', session('tahun_aktif'))
            ->where(function ($query) use ($key) {
                $query->where('nomor_proposal', 'LIKE', '%' . $key . '%')
                    ->orWhere('nama_pemohon', 'LIKE', '%' . $key . '%')
                    ->orWhere('hp', 'LIKE', '%' . $key . '%');
            })
            ->orderBy('proposal.id','DESC')
            ->where(function ($query) {
                $query->where('status', 'A')
                      ->orWhere('status', 'N');
            })
            ->orderBy('proposal.tanggal_masuk', 'DESC')
            ->paginate($limit);
    
        return view('proposal.akhir.index', $dataku);
    }
    



    public function exportakhir(Request $request)
    {
        $keyword = $request->input('keyword');
        $query = Proposal::where('tahun', session('tahun_aktif'))
                            ->where(function ($query) {
                                $query->where('status', 'A')
                                    ->orWhere('status', 'N');
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

            $petugas = User::find($proposal->petugas_survey);
            $proposal->petugas = $petugas ? $petugas->name : null;

          
            $this->fetchProgramDetails($proposal, 'program', 'uraianprogram', 'kode');
            $this->fetchProgramDetails($proposal, 'sub_program', 'uraiansubprogram', 'kode');
            $this->fetchProgramDetails($proposal, 'detail_program', 'detailprogram', 'id');
        }



 
        
    
        return Excel::download(new AkhirProposalExport($data), 'proposal.xlsx');
    }

    
    public function gis()
    {
        $data['title'] = "GIS Proposal Permohonan"; 
    
        $kecamatan = Kelurahan::all();
    
        $data['data'] = $kecamatan;
    
        return view('proposal.gis', $data);
    }
     

}
