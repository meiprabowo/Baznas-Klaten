<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AkunKeuangan extends Model
{
    use HasFactory;
    protected $table = 'akunkeuangan';

    protected $fillable = [
        'uraian',
        'id',
        'kode',
        'level',
        'sifat',
        'kelompok',
        'jenis_akun',
        'status', 
    ];
}
