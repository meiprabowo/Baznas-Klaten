<?php

namespace App\Imports;

use App\Models\Muzaki;
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




class MuzakiLImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;
    
    private $successCount = 0;
    private $errorCount = 0;

    public function model(array $row)
    {
        ++$this->successCount;

        $tanggal = $row['tanggal_registrasi'];
        $tanggal = Date::excelToTimestamp($tanggal);
        
        $tanggal = date('Y-m-d', $tanggal);



        return new Muzaki([
            'npwz' => $row['npwz'],
            'nama_muzaki' => $row['nama'],
            'tgl_register' => $tanggal,
            'telp' => $row['telp'],
            'hp' => $row['hp'],
            'alamat' => $row['alamat'],
            'type' => "L",
            'email' => $row['email'],
            'npwp' => $row['npwp'],
            'keterangan' => $row['keterangan'],
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
   //         'jumlah' => 'required|numeric',
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
