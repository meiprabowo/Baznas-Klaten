<?php

namespace App\Exports;
    
use App\Models\Surat_masuk; //App\User adalah model User
use Maatwebsite\Excel\Concerns\FromCollection; //Harus diimport untuk men-convert blade menjadi file excel
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;


class Surat_masukExport implements FromView
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
        return view('sdm.surat.suratmasuk_unduh', ['data' => $data]);
    
    
    }
}
