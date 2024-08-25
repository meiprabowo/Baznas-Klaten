<?php

namespace App\Exports;
    
use App\Models\Kepegawaian; //App\User adalah model User
use Maatwebsite\Excel\Concerns\FromCollection; //Harus diimport untuk men-convert blade menjadi file excel
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;


class MasterMuzakiLExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
  
    use Exportable;
  
  
    public function view(): View
    {
        return view('pengumpulan.muzaki.masterlembaga');    
    
    }
}
