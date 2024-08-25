<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Muzaki extends Model
{
    use HasFactory;
    protected $table = 'muzaki';

    protected $fillable = [
        'nama_muzaki',
        'npwz',
        'alamat',       
        'telp',       
        'hp',       
        'email',       
        'dinas',       
        'type',       
        'type_muzaki',       
        'keterangan',
        'npwp','jenis_kelamin', 'nik','tgl_register'       
    ];


    
    public static function generateTransactionCode(  )
    {
       
        $lastTransaction = Muzaki::orderBy('id', 'desc')->where('type_muzaki','Z')->first();

        if (!$lastTransaction) {
            return 'MZ-101000001';
        }
    
        $lastCode = $lastTransaction->npwz;
        $lastNumber = intval(substr($lastCode, strrpos($lastCode, '-') + 1));
        $paddedNumber = str_pad($lastNumber + 1, 9, '0', STR_PAD_LEFT);
    
        return 'MZ-' . $paddedNumber;

        
    }

    public static function DonaturCode(  )
    {
       
        $lastTransaction = Muzaki::orderBy('id', 'desc')->where('type_muzaki','I')->first();

        if (!$lastTransaction) {
            return 'DR-101000001';
        }
    
        $lastCode = $lastTransaction->npwz;
        $lastNumber = intval(substr($lastCode, strrpos($lastCode, '-') + 1));
        $paddedNumber = str_pad($lastNumber + 1, 9, '0', STR_PAD_LEFT);
    
        return 'DR-' . $paddedNumber;

        
    }
    

    public static function WakifCode(  )
    {
       
        $lastTransaction = Muzaki::orderBy('id', 'desc')->where('type_muzaki','W')->first();

        if (!$lastTransaction) {
            return 'WK-101000001';
        }
    
        $lastCode = $lastTransaction->npwz;
        $lastNumber = intval(substr($lastCode, strrpos($lastCode, '-') + 1));
        $paddedNumber = str_pad($lastNumber + 1, 9, '0', STR_PAD_LEFT);
    
        return 'WK-' . $paddedNumber;

        
    }
    

    public static function ClientCode(  )
    {
       
        $lastTransaction = Muzaki::orderBy('id', 'desc')->where('type_muzaki','PL')->first();

        if (!$lastTransaction) {
            return 'CL-101000001';
        }
    
        $lastCode = $lastTransaction->npwz;
        $lastNumber = intval(substr($lastCode, strrpos($lastCode, '-') + 1));
        $paddedNumber = str_pad($lastNumber + 1, 9, '0', STR_PAD_LEFT);
    
        return 'CL-' . $paddedNumber;

        
    }
    


}
