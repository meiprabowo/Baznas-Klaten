<?php

namespace App\Imports;

use App\Models\AkunKeuangan;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class AkunkeuanganImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;

    private $successCount = 0;
    private $errorCount = 0;

    public function model(array $row)
    {
        ++$this->successCount;
        return new AkunKeuangan([
            'kode' => $row['kode'],
            'uraian' => $row['uraian'],
            'level' => $row['level'],
            'sifat' => $row['sifat'],
            'kelompok' => $row['kelompok'],
            'jenis_akun' => $row['jenis_akun'],
        ]);
    }

    public function getRowCount(): int
    {
        return $this->successCount;
    }

    public function rules(): array
    {
        // Atur aturan validasi untuk setiap kolom yang dibutuhkan
        return [
            'kode' => 'required|unique:akunkeuangan',
            'uraian' => 'required',
            'level' => 'required|numeric', // Memastikan level adalah angka
            'sifat' => 'required|in:D,K', // Memastikan sifat hanya 'D' atau 'K'
            'kelompok' => 'required',
            'jenis_akun' => 'required',
        ];
    }
}
