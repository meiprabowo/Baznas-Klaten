<?php

namespace App\Exports;
    
use App\Models\Kas; //App\User adalah model User
use App\Models\AkunKeuangan; //App\User adalah model User
use App\Models\Asset; //App\User adalah model User
use App\Models\Ruang; //App\User adalah model User
use Maatwebsite\Excel\Concerns\FromCollection; //Harus diimport untuk men-convert blade menjadi file excel
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;


class AssetExport implements FromView
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
        return view('asset.export', ['data' => $data]);
    
    
    }
}
