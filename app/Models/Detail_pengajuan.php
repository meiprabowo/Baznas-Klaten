<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_pengajuan extends Model
{
    use HasFactory;
    protected $table = 'detail_pengajuan';

    protected $fillable = [
        'tanggal',
        'id_pengajuan',
        'id_kas',
        'status',
    ];
}
