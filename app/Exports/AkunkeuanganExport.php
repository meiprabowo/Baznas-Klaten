<?php

namespace App\Exports;
    
use App\Models\AkunKeuangan; //App\User adalah model User
use App\Models\Jenis_akun;
use Maatwebsite\Excel\Concerns\FromCollection; //Harus diimport untuk men-convert blade menjadi file excel
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;


class AkunkeuanganExport implements FromView
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
        return view('master.akunkeuangan.export', ['data' => $data]);
    
    
    }
}
