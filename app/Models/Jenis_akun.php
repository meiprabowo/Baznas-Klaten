<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis_akun extends Model
{
    use HasFactory;
    protected $table = 'jenis_akun';

    protected $fillable = [
        'id',
        'kode_akun',
        'nama_akun',
    ];
}
