<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Kasbon extends Model
{
    use HasFactory;
    protected $table = 'kasbon';

    protected $fillable = [
        'tanggal',
        'kode_kasbon',
        'keterangan',
        'detail',
        'status',
        'validator',
        'kategori',
        'jumlah',
        'tahun',
        'pemohon',
        'user_id',
    ];
    public static function generateTransactionCode($tanggal)
    {
       
        // Mendapatkan tanggal dalam format yang sesuai dengan format tanggal di kode transaksi
        $formattedDate = Carbon::parse($tanggal)->format('Y-m-d');
    
        // Mendapatkan transaksi terakhir berdasarkan tanggal
        $lastTransaction = Kasbon::whereDate('tanggal', $tanggal)
            ->orderBy('id', 'desc')
            ->first();
    
        if (!$lastTransaction) {
            return 'KAS-' . $formattedDate . '-0001';
        }
    
        $lastCode = $lastTransaction->kode_kasbon;
        $lastNumber = intval(substr($lastCode, strrpos($lastCode, '-') + 1));
        $paddedNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);

        return 'KAS-' . $formattedDate . '-' . $paddedNumber;
    }

}
