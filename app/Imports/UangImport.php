<?php

namespace App\Imports;

use App\Models\Kas;
use App\Models\Proposal;
use App\Models\AkunKeuangan;
use App\Models\Kelurahan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Facades\Excel; // Import Excel facade for chunking
use Illuminate\Support\Facades\DB; // Memperbaiki namespace untuk DB




class UangImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;
    
    private $successCount = 0;
    private $errorCount = 0;

    public function model(array $row)
    {
        ++$this->successCount;

        $tahun = session('tahun_aktif');

      
        $tanggal = $row['tanggal'];
        $tanggal = Date::excelToTimestamp($tanggal);
        $tanggal = date('Y-m-d', $tanggal);

   
        

        return new Kas([
            'tanggal' => $tanggal,
            'kode_transaksi' => Kas::GenerateSPJ($tanggal),
            'jenis_kas' =>  'uang',
            'pengirim' =>  'P',
            'type' =>  'SPJ',
            'debet' =>  $row['tujuan'],
            'id_muzaki' =>  $row['id'],
            'kredit' => $row['sumber'],
            'jumlah' =>  $row['nominal'],
            'qty' =>  "1",
            'keterangan' =>  $row['keterangan'],
            'tahun' => session('tahun_aktif'),
            'user_id' => Auth::user()->id,
        ]);
    }

    public function chunkSize(): int
    {
        return 5000; // Adjust the chunk size as needed
    }

    public function getRowCount(): int
    {
        return $this->successCount;
    }

    public function rules(): array
    {
        return [
            'nominal' => 'required|numeric',
     //       'tanggal' => 'required|date|date_format:Y-m-d', // Validasi format tanggal (YYYY-MM-DD)
        ];
    }

    public function importData(string $path)
    {
        Excel::filter('chunk')->load($path)->chunk(5000, function ($results) {
            foreach ($results as $row) {
                $this->model($row->toArray())->save(); // Process and insert each row into the database
            }
        });
    }
}
