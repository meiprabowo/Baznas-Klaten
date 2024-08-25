<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;
    protected $table = 'Absensi';

    protected $fillable = [
        'id_kepegawaian',
        'tanggal',
        'jam_masuk',       
        'jam_pulang',       
        'status',       
        'tahun',       
    ];
}
