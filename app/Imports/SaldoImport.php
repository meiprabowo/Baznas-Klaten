<?php

namespace App\Imports;

use App\Models\Kas;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Illuminate\Support\Facades\Session;



class SaldoImport implements ToModel,  WithHeadingRow, WithValidation, SkipsOnFailure
{
 
    use Importable, SkipsFailures;
    
    private $successCount = 0;
    private $errorCount = 0;


    public function model(array $row)
    {
        ++$this->successCount;

        $tahun = session('tahun_aktif');
        $tanggalberjalan = "$tahun-01-01";

        $cek = substr($row['kode'], 0, 1);

        if($cek == '2') {
            $data = "kredit";
        } else {
            $data = "debet";
        }

        $existingData = Kas::where($data, $row['id'])
                ->where('pengirim', 'SA')
                ->where('tahun', session('tahun_aktif'))
                ->where('keterangan', 'Saldo Awal')
                ->first();

        if ($existingData) {
        $existingData->update(['jumlah' => $row['jumlah']]);
        return $existingData;

        } else {


            $cek = substr($row['kode'], 0, 1);

            if($cek == '2') {
                $kredit = $row['id'];
                $debet =  "0";
            } else {
                $kredit = "0";
                $debet =  $row['id'];
            }
            
        return new Kas([
            'kredit' =>  $kredit,
            'debet' =>  $debet,
            'tanggal' =>  $tanggalberjalan,
            'pengirim' =>  "SA",
            'kode_transaksi' =>  Kas::generateTransactionCode($tanggalberjalan),
            'jumlah' =>  $row['jumlah'],
            'keterangan' =>  "Saldo Awal",
            'user_id' =>  "1",
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