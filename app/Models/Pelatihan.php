<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelatihan extends Model
{
    use HasFactory;
    protected $table = 'Pelatihan';

    protected $fillable = [
        'id_kepegawaian',
        'nama_pelatihan',
        'tanggal_pelatihan',       
        'dokumen',       
    ];
}
