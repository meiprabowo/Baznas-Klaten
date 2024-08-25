<?php

namespace App\Imports;

use App\Models\Rencana;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Illuminate\Support\Facades\Session;

 

class RencanaImport implements ToModel,  WithHeadingRow, WithValidation, SkipsOnFailure
{
 
    use Importable, SkipsFailures;
    
    private $successCount = 0;
    private $errorCount = 0;


    public function model(array $row)
    {
        ++$this->successCount;


        $existingData = Rencana::where('id_akun', $row['id'])
        ->where('tahun', session('tahun_aktif'))
        ->first();

        if ($existingData) {
        $existingData->update(['jumlah' => $row['jumlah']]);
        return $existingData;
        } else {
        return new Rencana([
            'id_akun' =>  $row['id'],
            'jumlah' =>  $row['jumlah'],
            'tahun' =>  session('tahun_aktif'),
        ]);
        }




    }

   
    public function getRowCount(): int
    {
        return $this->successCount;
    }


    public function rules(): array
    {
        // Atur aturan validasi untuk setiap kolom yang dibutuhkan
        return [
           'jumlah' => 'required|numeric',           
            // ...
        ];
    }




    



}