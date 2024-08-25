<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat_masuk extends Model
{
    use HasFactory;
    protected $table = 'surat_masuk';

    protected $fillable = [
        'nomor_surat',
        'perihal',
        'kepada',       
        'pengirim',       
        'lampiran',     
        'tanggal',        
        'tahun',        
        'deskripsi',    
    ];
}
