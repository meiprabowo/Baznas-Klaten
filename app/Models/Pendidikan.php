<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pendidikan extends Model
{
    use HasFactory;
    
    protected $table = 'Pendidikan';

    protected $fillable = [
        'id_kepegawaian',
        'jurusan',
        'tahun',       
        'file',       
    ];
}
