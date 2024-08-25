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
use Illuminate\Support\Facades\DB; // Memperbaiki namespace untuk DB




class ProposalLembagaImport implements ToModel,  WithHeadingRow, WithValidation, SkipsOnFailure
{
 
    use Importable, SkipsFailures;
    
    private $successCount = 0;
    private $errorCount = 0;


    public function model(array $row)
    {
        ++$this->successCount;

        $tahun = session('tahun_aktif');

        $kelurahan = Kelurahan::where('id',$row['kelurahan'])
        ->first();

        // $tanggalExcel = $row['tanggal']; // Misalkan '45209' adalah tanggal dari Excel
        // $tanggalTimestamp = Date::excelToTimestamp($tanggalExcel); // Konversi ke format timestamp
        // $tanggalMySQL = date('Y-m-d', $tanggalTimestamp); // Format tanggal sesuai MySQL (YYYY-MM-DD)
        
        // // Kemudian gunakan $tanggalMySQL untuk menyimpan tanggal_masuk dalam database
        

        $kelurahan = Kelurahan::where('id', $row['kelurahan'])->first();

        $tanggalMySQL = $row['tanggal'];
        $program = $row['program'];
        $tanggalTimestamp = Date::excelToTimestamp($tanggalMySQL);
        
        $tanggalMySQL = date('Y-m-d', $tanggalTimestamp);

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
            
            'jenis_permohonan' => $row['jenis_permohonan'],
            'tanggal_masuk' => $tanggalMySQL,
            'nomor_proposal' => Proposal::Lembaga($tanggalMySQL),
            'nama_pemohon' => $row['nama'],
            'nik' => $row['nik'],
            'jenis_permohonan' => $row['jenis_permohonan'],
            'hp' => $row['hp'],
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
            'jenis_pemohon' => "L",
            'user_id' => Auth::user()->id,

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
            // 'jumlah' => 'required|numeric',           
            // 'tanggal' => 'required|date_format:Y-m-d', // Aturan untuk format tanggal YMD
        ];
    }




    



}