<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    use HasFactory;
    protected $table = 'Sertifikat';

    protected $fillable = [
        'id_kepegawaian',
        'nama_sertifikat',
        'nomor_sertifikat',       
        'tanggal_sertifikat',       
        'file',       
    ];
}
