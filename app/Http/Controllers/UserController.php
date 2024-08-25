<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Identitas;
use Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UserExport;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = "Master User";
        $limit = request('limit', 10);
        $data['data'] = User::orderBy('id', 'DESC')->paginate($limit);
        return view('master.user.index', $data);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = "Tambah Master User";
        return view('master.user.tambah', $data);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          //
          $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required|email|unique:users|max:255',
            'hp' => 'required|numeric',
            'status' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
       
        if ($request->hasFile('foto')) {

        $file = $request->file('foto');
        $nama_file = time()."_".$file->getClientOriginalName();
        $tujuan_upload = 'data_file';
        $file->move($tujuan_upload,$nama_file);
         
        User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make(123456),
            'hp' => $request->hp,
            'status' => $request->status,
            'aktif' => "A",
            'foto' => $nama_file
        ]);

       } else {

        User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make(123456),
            'hp' => $request->hp,
            'aktif' => "A",
            'status' => $request->status,
            'foto' =>"default.jpg"
        ]);

      }
        return redirect()->route('master.user.index')
                        ->with('success','Data Berhasil disimpan.');
    }


    }

   
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['title'] = "Edit Master User";
        $data['data'] = User::find($id);
        return view('master.user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
      
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'hp' => 'required|numeric',
            'status' => 'required',
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


        User::where('id', $id)
            ->update([
            'name' => $request->nama,
            'email' => $request->email,     
            'hp' => $request->hp,
            'status' => $request->status,
            'aktif' => $request->aktif,
            'foto' => $nama_file
        ]);
          } else {
        User::where('id', $id)
            ->update([
            'name' => $request->nama,
            'email' => $request->email,
            'hp' => $request->hp,
            'status' => $request->status,
            'password' => Hash::make($ok),
            'aktif' => $request->aktif,
            'foto' => $nama_file
        ]);


     }

       } else {


        if (empty($ok)) {
        User::where('id', $id)
        ->update([
            'name' => $request->nama,
            'email' => $request->email,
          
            'hp' => $request->hp,
            'status' => $request->status,
            'aktif' => $request->aktif,
        ]);
    } else {
        User::where('id', $id)
        ->update([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($ok),
            'hp' => $request->hp,
            'status' => $request->status,
            'aktif' => $request->aktif,
        ]);
 
    }

      }
        return redirect()->route('master.user.index')
                        ->with('success','Data Berhasil diperbaharui.');
    }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('master.user.index')->with('warning', 'Data berhasil dihapus.');
    }



    public function search(Request $request)
    {

        $data['title'] = "Cari Data";
        $limit = request('limit', 10); // Jika tidak ada input dari pengguna, gunakan nilai default 10

        $keyword = $request->input('keyword');    
        $query = User::query()->orderBy('name', 'ASC');
        
        $query->where(function ($query) use ($keyword) {
                $query->where('name', 'like', "%$keyword%")
                ->orWhere('email', 'LIKE', '%' . $keyword . '%')
                ->orWhere('email', 'hp', '%' . $keyword . '%')
                ;
            });
      
        
        $data['data'] = $query->paginate($limit);

        
        return view('master.user.index',$data);
    }




    public function identitas()
    {
        $data['title'] = "Identitas Baznas";
        $data['data'] = Identitas::find('1');
        return view('master.identitas', $data);
    }

    
     
    public function upiden(Request $request)
    {

     // Validate the incoming request data
    $validatedData = $request->validate([
        'nama' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'telp' => 'nullable|string|max:20',
        'website' => 'nullable|string|max:255',
        'alamat' => 'nullable|string|max:255',
        'pendistribusian' => 'nullable|string|max:255',
        'kapendistribusian' => 'nullable|string|max:255',
        'pengumpulan' => 'nullable|string|max:255',
        'kapengumpulan' => 'nullable|string|max:255',
        'keuangan' => 'nullable|string|max:255',
        'kakeuangan' => 'nullable|string|max:255',
        'sdmumum' => 'nullable|string|max:255',
        'kasdmumum' => 'nullable|string|max:255',
        'ketua_iv' => 'nullable|string|max:255',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

        $user = Identitas::findOrFail('1');

        // Update the user record with the validated data
        $user->nama = $validatedData['nama'];
        $user->email = $validatedData['email'];
        $user->telp = $validatedData['telp'];
        $user->website = $validatedData['website'];
        $user->lokasi = $validatedData['alamat'];
        $user->proposal = $validatedData['pendistribusian'];
        $user->ka_proposal = $validatedData['kapendistribusian'];
        $user->penerimaan = $validatedData['pengumpulan'];
        $user->ka_penerimaan = $validatedData['kapengumpulan'];
        $user->keuangan = $validatedData['keuangan'];
        $user->ka_keuangan = $validatedData['kakeuangan'];
        $user->sdm_umum = $validatedData['sdmumum'];
        $user->ka_sdm_umum = $validatedData['kasdmumum'];
        $user->ketua_iv = $validatedData['ketua_iv'];
    
        // Handle file upload if a new photo is provided
        if ($request->hasFile('foto')) {

            $file = $request->file('foto');
            $nama_file = time()."_".$file->getClientOriginalName();
            $tujuan_upload = 'identitas';
            $file->move($tujuan_upload,$nama_file);         
            $user->logo = $nama_file;
        }
    
        // Save the updated user record
        $user->save();
        
        
        return redirect()->back()
        ->with('success','Data Berhasil disimpan.');
    
    
    }




}
