<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;
    
    protected $table = 'asset';

    protected $fillable = [
        'id_kas',
        'id_ruang',       
        'id_akun',       
        'harga',       
        'kode_asset',       
        'keterangan',       
    ];
}
