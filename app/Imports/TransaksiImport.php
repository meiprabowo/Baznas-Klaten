<?php

namespace App\Imports;

use App\Models\Muzaki;
use App\Models\Kas;
use App\Models\AkunKeuangan;
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




class TransaksiImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;
    
    private $successCount = 0;
    private $errorCount = 0;
    private $sumber;
    private $dinas;

    public function __construct($sumber, $dinas)
    {
        $this->sumber = $sumber;
        $this->dinas = $dinas;
    }


    public function model(array $row)
    {
        ++$this->successCount;

        $tanggal = $row['tanggal'];
        $tanggal = Date::excelToTimestamp($tanggal);
        $tanggal = date('Y-m-d', $tanggal);

        if($row['zakat']!='')
        {
            $zakat = AkunKeuangan::where('jenis_akun','like','%%zakat%%')->first();
            $debet = $zakat->id;
            $nominal = $row['zakat'];
        } else {
            $infaq = AkunKeuangan::where('jenis_akun','like','%%infaq%%')->first();
            $debet = $infaq->id;
            $nominal = $row['infaq'];
        }

        $muzaki = Muzaki::where('npwz', $row['npwz'])->first();
        



        return new Kas([

            'type' => "SPJ",
            'pengirim' => "PG",
            'tanggal' => $tanggal,
            'kode_transaksi' => Kas::SPJKas($tanggal),
            'kredit' => $debet,
            'id_muzaki' => $muzaki->id,
            'dinas' => $this->dinas,
            'debet' => $this->sumber,
            'qty' => "1",
            'jumlah' => $nominal,
            'keterangan' => $row['keterangan'],
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
