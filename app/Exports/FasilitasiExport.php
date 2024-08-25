<?php

namespace App\Exports; 
    
use App\Models\Perkara;
use App\Models\Verifikasi;
use App\Models\Klarifikasi;
use App\Models\Fasilitasi;
use App\Models\Petugas_fasilitasi;
use App\Models\Dokumentasi_fasilitasi;
use App\Models\Telaah;
use App\Models\Users;
use Maatwebsite\Excel\Concerns\FromCollection; //Harus diimport untuk men-convert blade menjadi file excel
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;


class FasilitasiExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
  
    use Exportable;
  
    protected $data;
    public function __construct($data)
    {
        $this->data = $data;
    }


    
    public function view(): View
    {

        $data = $this->data;
        return view('fasilitasi.export', ['data' => $data]);
    
    
    }
}
