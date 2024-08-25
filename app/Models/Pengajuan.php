<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;
    protected $table = 'pengajuan';

    protected $fillable = [
        'tahun',
        'tanggal',
        'nomor_pengajuan',
        'user_id',
        'pengaju',
        'keterangan',
    ];
}
