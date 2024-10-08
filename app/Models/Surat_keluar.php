<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat_keluar extends Model
{
    use HasFactory;
    protected $table = 'surat_keluar';

    protected $fillable = [
        'nomor_surat',
        'perihal',
        'kepada',       
        'lampiran',     
        'tanggal',        
        'tahun',        
        'lokasi_tujuan',        
        'tembusan',        
        'isi_surat',    
        'file_lampiran',       
    ];
}
