<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use App\Models\User;
use App\Models\Proposal;
use App\Models\AkunKeuangan;
use App\Models\Tahun;
use App\Models\Kas;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;



 
class AuthController extends Controller {
    
    /**
     * Display login of the resource.
     *
     * @return \Illuminate\View\View
     */


     protected $tahun;

     public function __construct()
     {
         $tahunaktif = Tahun::where('status', 'A')->first();
         $this->tahun = $tahunaktif ? $tahunaktif->nama_tahun : null;
     }



     public function index(Request $request) {
        $data['title'] = "Homepage";
        $tahunAktif = $this->tahun;
        $jenisAkun = ['cerdas', 'peduli', 'makmur', 'taqwa', 'sehat'];
    
        foreach ($jenisAkun as $jenis) {
            $debet = DB::table('kas')
                ->join('akunkeuangan', 'akunkeuangan.id', '=', 'kas.debet')
                ->where('akunkeuangan.jenis_akun', 'like', '%' . $jenis . '%')
                ->whereYear('kas.tanggal', $tahunAktif)
                ->sum('kas.jumlah');
    
            $kredit = DB::table('kas')
                ->join('akunkeuangan', 'akunkeuangan.id', '=', 'kas.kredit')
                ->where('akunkeuangan.jenis_akun', 'like', '%' . $jenis . '%')
                ->whereYear('kas.tanggal', $tahunAktif)
                ->sum('kas.jumlah');
    
            $data['jml' . $jenis] = DB::table('kas')
                ->join('akunkeuangan', 'akunkeuangan.id', '=', 'kas.debet')
                ->where('akunkeuangan.jenis_akun', 'like', '%' . $jenis . '%')
                ->whereYear('kas.tanggal', $tahunAktif)
                ->count();
    
            $data['saldo' . $jenis] = $debet - $kredit;
        }
    
        return view('index', $data);
    }
    
    public function login(){
        $title = "Login";
        $description = "Some description for the page";
        return view('auth.login',compact('title','description'));
    }



  
    /**
     * Display register of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function register(){
        $title = "Register";
        $description = "Some description for the page";
        return view('auth.register',compact('title','description'));
    }

    /**
     * Display forget password of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function forgetPassword(){
        $title = "Forget Password";
        $description = "Some description for the page";
        return view('auth.forget_password',compact('title','description'));
    }

    /**
     * make the user able to register
     *
     * @return 
     */
  
    /**
     * make the user able to login
     *
     * @return 
     */
    public function authenticate(Request $request)
    {
        $validators = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        if ($validators->fails()) {
            return redirect()->route('login')->withErrors($validators)->withInput();
        } else {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $tahunAktif = DB::table('tahun')->where('status', 'A')->value('nama_tahun');
                $systembaznas = DB::table('baznas')->first();
                
                if ($tahunAktif) {
                    Session::put('tahun_aktif', $tahunAktif);
                    Session::put('nama', $systembaznas->nama);
                    Session::put('lokasi', $systembaznas->lokasi);
                    Session::put('email', $systembaznas->email);
                    Session::put('website', $systembaznas->website);
                    Session::put('logo', $systembaznas->logo);
                    Session::put('wilayah', $systembaznas->wilayah);
                    Session::put('ka_proposal', $systembaznas->ka_proposal);
                    Session::put('proposal', $systembaznas->proposal);
                    Session::put('ka_sdm_umum', $systembaznas->ka_sdm_umum);
                    Session::put('sdm_umum', $systembaznas->sdm_umum);
                    Session::put('ka_keuangan', $systembaznas->ka_keuangan);
                    Session::put('keuangan', $systembaznas->keuangan);
                    Session::put('ketua_iv', $systembaznas->ketua_iv);

                    return redirect()->intended(route('dashboard.index', 'en'))->with('message', 'Welcome back!');
                } else {
                    return redirect()->route('login')->with('message', 'Login failed! No active year found.');
                }
            } else {
                return redirect()->route('login')->with('message', 'Login failed! Email/Password is incorrect!');
            }
        }
    }
    
    /**
     * make the user able to logout
     *
     * @return 
     */
    public function logout(){  
        Auth::logout(); 
        return redirect()->route('index')->with('message','Successfully Logged out !');       
    }
}