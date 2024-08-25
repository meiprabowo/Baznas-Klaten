<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response; // Import the Response class
use Auth;
use App\Models\Proposal;
use App\Models\Kas;
use App\Models\AkunKeuangan;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class DashboardController extends Controller {
    
    /**
     * Display dashbnoard demo one of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(){
        $data['title'] = "Homepage";
        $data['description'] = "Homepage";
    

$data['allproposal'] = Proposal::orderBy('id', 'DESC')
        ->orderBy('tanggal_masuk', 'DESC')
        ->where('tahun', session('tahun_aktif'))
        ->count();

$data['belum'] = Proposal::orderBy('id', 'DESC')
        ->orderBy('tanggal_masuk', 'DESC')
        ->where('status', "B")
        ->where('tahun', session('tahun_aktif'))->count();


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


        $data['belumtertasarufkan'] = Proposal::orderBy('id', 'DESC')
        ->orderBy('tanggal_masuk', 'DESC')
        ->where('tahun', session('tahun_aktif'))
        ->where('status','A')
        ->whereNotExists(function ($query) {
            $query->select('id')
                ->from('kas')
                ->where('pengirim','P')
                ->where('type','SPJ')
                ->whereColumn('kas.id_muzaki', 'proposal.id');
        })->count();
$data['sudahtertasarufkan'] =Kas::join('proposal', 'kas.id_muzaki', '=', 'proposal.id')
        ->select(
            'kas.id','kas.kode_transaksi', 'kas.tanggal', 'kas.jenis_kas','kas.file', 
            'proposal.nomor_proposal','proposal.proposal','proposal.nama_pemohon','proposal.hp'
        )
        ->where('kas.tahun', session('tahun_aktif'))
        ->where('kas.pengirim', 'P')
        ->where('kas.type', 'SPJ')->count();

        $zakatData = [];
        $infaqData = [];    
        // Loop untuk mengambil data Zakat dari database
        
        
        for ($row = 1; $row <= 12; $row++) {
            // Query untuk mengambil data Zakat
            $zakat = Kas::join('akunkeuangan', 'kas.kredit', 'akunkeuangan.id')
                ->whereMonth('kas.tanggal', $row)
                ->where('kas.pengirim', 'PG')
                ->where('kas.type', 'SPJ')
                ->where('kas.tahun', session('tahun_aktif'))
                ->where('akunkeuangan.jenis_akun', 'like', '%ZKT%')
                ->sum('kas.jumlah');
        
            // Query untuk mengambil data Infaq
            $infaq = Kas::join('akunkeuangan', 'kas.kredit', 'akunkeuangan.id')
                ->whereMonth('tanggal', $row)
                ->where('pengirim', 'PG')
                ->where('type', 'SPJ')
                ->where('tahun', session('tahun_aktif'))
                ->where('akunkeuangan.jenis_akun', 'like', '%IFQ%')
                ->sum('kas.jumlah');
        
            $zakatData[] = $zakat;
            $infaqData[] = $infaq;
        }
        
      
        
        
            // Menambahkan data Zakat dan Infaq ke dalam variabel $data
            $data['zakatData'] = $zakatData;
            $data['infaqData'] = $infaqData;

                
    

        // Kemudian, gunakan nilai yang telah diperiksa ke dalam pembuatan grafik






        return view('dashboard',$data);
    }


    public function user(){

        $data['title'] = "Edit Profil";
        $data['data'] = User::find(Auth::user()->id);
        return view('profile', $data);

    }

    public function update(Request $request)
    {
      
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'hp' => 'required|numeric',
       
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
       
          $ok = $request->input('password');
             

        if ($request->hasFile('foto')) {

        $file = $request->file('foto');
        $nama_file = time()."_".$file->getClientOriginalName();
        $tujuan_upload = 'data_file';
        $file->move($tujuan_upload,$nama_file);
  
      


        if (empty($ok)) {


        User::where('id', Auth::user()->id)
            ->update([
            'name' => $request->nama,
            'email' => $request->email,     
            'hp' => $request->hp,
            'foto' => $nama_file
        ]);
          } else {
        User::where('id', Auth::user()->id)
            ->update([
            'name' => $request->nama,
            'email' => $request->email,
            'hp' => $request->hp,
            'password' => Hash::make($ok),
            'foto' => $nama_file
        ]);


     }

       } else {


        if (empty($ok)) {
        User::where('id', Auth::user()->id)
        ->update([
            'name' => $request->nama,
            'email' => $request->email,
          
            'hp' => $request->hp,
        ]);
    } else {
        User::where('id', Auth::user()->id)
        ->update([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($ok),
            'hp' => $request->hp,
        ]);
 
    }

      }
        return redirect()->route('dashboard.index')
                        ->with('success','Data Berhasil diperbaharui.');
    }


    }




}