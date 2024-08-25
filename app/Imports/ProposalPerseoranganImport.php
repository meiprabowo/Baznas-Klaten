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
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Facades\Excel; // Import Excel facade for chunking
use Illuminate\Support\Facades\DB; // Memperbaiki namespace untuk DB




class ProposalPerseoranganImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;
    
    private $successCount = 0;
    private $errorCount = 0;

    public function model(array $row)
    {
        ++$this->successCount;

        $tahun = session('tahun_aktif');

        $kelurahan = Kelurahan::where('id', $row['kelurahan'])->first();

        $tanggalMySQL = $row['tanggal'];
        $tanggal_lahir = $row['tanggal_lahir'];
        $program = $row['program'];
        $tanggalTimestamp = Date::excelToTimestamp($tanggalMySQL);
        $tanggal_lahir = Date::excelToTimestamp($tanggal_lahir);
        
        $tanggalMySQL = date('Y-m-d', $tanggalTimestamp);
        $tanggal_lahir = date('Y-m-d', $tanggal_lahir);

        $hasil = DB::select("
        SELECT
        SUBSTRING_INDEX(SUBSTRING_INDEX(kode, '.', 3), '.', 3) AS pro_utama, 
        SUBSTRING_INDEX(SUBSTRING_INDEX(kode, '.', 4), '.', 4) AS sub_utama 
        FROM akunkeuangan 
        where id = '$program'
        ");

        if (!empty($hasil)) {
            $pro_utama = $hasil[0]->pro_utama;
            $sub_utama = $hasil[0]->sub_utama;
        } else {
            // Handle jika tidak ada data yang ditemukan
            $pro_utama = null;
            $sub_utama = null;
        }

        

        return new Proposal([
            'jenis_permohonan' => "P",
            'tanggal_masuk' => $tanggalMySQL,
            'nomor_proposal' => Proposal::Perseorangan($tanggalMySQL),
            'nama_pemohon' => $row['nama'],
            'nik' => $row['nik'],
            'jenis_permohonan' => $row['jenis_permohonan'],
            'jenis_kelamin' => $row['jenis_kelamin'],
            'tempat_lahir' => $row['tempat_lahir'],
            'tanggal_lahir' => $tanggal_lahir,
            'hp' => $row['hp'],
            'pekerjaan' => $row['pekerjaan'],
            'alamat_lengkap' => $row['alamat'],
            'kecamatan' => $kelurahan['id_kecamatan'],
            'kelurahan' => $row['kelurahan'],
            'rt' => $row['rt'],
            'rw' => $row['rw'],
            'detail_program' => $program,
            'sub_program' => $sub_utama,
            'program' => $pro_utama,
            'nominal_pengajuan' => $row['jumlah'],
            'keterangan' => $row['keterangan'],
            'tahun' => $tahun,
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
            // 'jumlah' => 'required|numeric',
        // 'tanggal_masuk' => 'required|date|date_format:Y-m-d', // Validasi format tanggal (YYYY-MM-DD)
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
