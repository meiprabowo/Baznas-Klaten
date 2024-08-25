<?php

namespace App\Imports;

use App\Models\Proposal;
use App\Models\AkunKeuangan;
use App\Models\Kelurahan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Facades\Excel; // Import Excel facade for chunking
use Illuminate\Support\Facades\DB; // Memperbaiki namespace untuk DB
use Illuminate\Support\Collection;

class ProposalLanjutImport implements ToCollection, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;

    private $successCount = 0;
    private $errorCount = 0;


    
    public function collection(Collection $rows)
    {

  



        foreach ($rows as $row) {

            $tanggalMySQL = $row['tanggal'];
            $tanggalMySQL = Date::excelToTimestamp($tanggalMySQL);
            
            $tanggalMySQL = date('Y-m-d', $tanggalMySQL);

            
            
            $firstColumnValue = $row['id']; // Accessing the first column
    
            if ($firstColumnValue) {
                // Update data based on the first column value (assuming it's the ID)
                Proposal::where('id', $firstColumnValue)->update([
                    'status' => $row['status'],
                    'tanggal_penetapan' => $tanggalMySQL,
                    'keterangan_penolakan' => $row['keterangan'],
                    'lokasi' => $row['lokasi'],
                    'wa_status' => "BW"
                    
                    // Add more fields as needed
                ]);
    
                $this->successCount++;
            }
        }
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
            // 'kode_petugas' => 'required|numeric',
        ];
    }
}
