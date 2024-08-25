<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Proposal extends Model
{
    use HasFactory;

    protected $table = 'proposal';

    protected $fillable = [
        'tanggal_masuk',
        'nomor_proposal',
        'jenis_permohonan',
        'nama_pemohon',
        'nik',
        'hp',
        'pekerjaan',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat_lengkap',
        'kecamatan',
        'kelurahan',
        'rw',
        'rt',
        'program',
        'sub_program',
        'detail_program',
        'nominal_pengajuan',
        'keterangan',
        'status',
        'petugas_survey',
        'tanggal_survey',
        'tanggal_input_survey',
        'keterangan_survey',
        'tanggal_penetapan',
        'keterangan_penolakan',
        'program_disetujui',
        'wa_status',
        'tahun',
        'proposal',
        'user_id',
        'jenis_kelamin',
        'jenis_pemohon',
        'lokasi',
        'wa_akhir',
    ];

 
     
    public static function Perseorangan($tanggal)
    {
        // Mendapatkan tanggal dalam format yang sesuai dengan format tanggal di kode transaksi
        $formattedDate = Carbon::parse($tanggal)->format('Y-m-d');
        
        // Mendapatkan transaksi terakhir berdasarkan tanggal
        $lastTransaction = Proposal::whereDate('tanggal_masuk', $formattedDate)->where('jenis_pemohon','P')
            ->orderBy('id', 'desc')
            ->first();
        
        if (!$lastTransaction) {
            return 'PRP-' . $formattedDate . '-00001';
        }
        
        $lastCode = $lastTransaction->nomor_proposal;
        $lastNumber = intval(substr($lastCode, strrpos($lastCode, '-') + 1));
        $paddedNumber = str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);
    
        return 'PRP-' . $formattedDate . '-' . $paddedNumber;
    }
    
    
    public static function Lembaga($tanggal)
    {
        // Mendapatkan tanggal dalam format yang sesuai dengan format tanggal di kode transaksi
        $formattedDate = Carbon::parse($tanggal)->format('Y-m-d');
        
        // Mendapatkan transaksi terakhir berdasarkan tanggal
        $lastTransaction = Proposal::whereDate('tanggal_masuk', $formattedDate)->where('jenis_pemohon','L')
            ->orderBy('id', 'desc')
            ->first();
        
        if (!$lastTransaction) {
            return 'PRL-' . $formattedDate . '-00001';
        }
        
        $lastCode = $lastTransaction->nomor_proposal;
        $lastNumber = intval(substr($lastCode, strrpos($lastCode, '-') + 1));
        $paddedNumber = str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);
    
        return 'PRL-' . $formattedDate . '-' . $paddedNumber;
    }
    
     





}
