<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Identitas extends Model
{
    use HasFactory;
    
    protected $table = 'baznas';

    protected $fillable = [
'nama',
'lokasi',
'website'
,'email'
,'telp'
,'logo'
,'proposal'
,'penerimaan'
,'keuangan'
,'sdm_umum'
,'ka_proposal'
,'ka_penerimaan'
,'ka_keuangan'
,'ka_sdm_umum'
,'wilayah'
,'ketua_iv'
    ];
}
