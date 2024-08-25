<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Kas extends Model
{
    use HasFactory;
    protected $table = 'kas';

    protected $fillable = [
        'id',
        'tanggal',
        'kode_transaksi',
        'jenis_kas',
        'pengirim',
        'debet',
        'kredit',
        'type',
        'qty',
        'jumlah',
        'keterangan',
        'kasbon',
        'id_muzaki',
        'tahun',
        'file',
        'user_id',
        'dinas',
    ];

    public static function generateTransactionCode($tanggal)
    {
       
        // Mendapatkan tanggal dalam format yang sesuai dengan format tanggal di kode transaksi
        $formattedDate = Carbon::parse($tanggal)->format('Y-m-d');
    
        // Mendapatkan transaksi terakhir berdasarkan tanggal
        $lastTransaction = Kas::whereDate('tanggal', $tanggal)
            ->where('pengirim', 'SDM')
            ->where('type', 'TU')
            ->orderBy('id', 'desc')
            ->first();
    
        if (!$lastTransaction) {
            return 'TRX-' . $formattedDate . '-00001';
        }
    
        $lastCode = $lastTransaction->kode_transaksi;
        $lastNumber = intval(substr($lastCode, strrpos($lastCode, '-') + 1));
        $paddedNumber = str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);

        return 'TRX-' . $formattedDate . '-' . $paddedNumber;
    }
    


    public static function SPJKas($tanggal)
    {
       
        // Mendapatkan tanggal dalam format yang sesuai dengan format tanggal di kode transaksi
        $formattedDate = Carbon::parse($tanggal)->format('Y-m-d');
    
        // Mendapatkan transaksi terakhir berdasarkan tanggal
        $lastTransaction = Kas::whereDate('tanggal', $tanggal)
            ->where('pengirim', 'PG')
            ->where('type', 'SPJ')
            ->orderBy('id', 'desc')
            ->first();
    
        if (!$lastTransaction) {
            return 'PTX-' . $formattedDate . '-00001';
        }
    
        $lastCode = $lastTransaction->kode_transaksi;
        $lastNumber = intval(substr($lastCode, strrpos($lastCode, '-') + 1));
        $paddedNumber = str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);

        return 'PTX-' . $formattedDate . '-' . $paddedNumber;
    }
    




    public static function GenerateSPJ($tanggal)
    {
       
        // Mendapatkan tanggal dalam format yang sesuai dengan format tanggal di kode transaksi
        $formattedDate = Carbon::parse($tanggal)->format('Y-m-d');
    
        // Mendapatkan transaksi terakhir berdasarkan tanggal
        $lastTransaction = Kas::whereDate('tanggal', $tanggal)
            ->where('pengirim', 'P')
            ->where('type', 'SPJ')
            ->orderBy('id', 'desc')
            ->first();
    
        if (!$lastTransaction) {
            return 'SPJ-' . $formattedDate . '-00001';
        }
    
        $lastCode = $lastTransaction->kode_transaksi;
        $lastNumber = intval(substr($lastCode, strrpos($lastCode, '-') + 1));
        $paddedNumber = str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);

        return 'SPJ-' . $formattedDate . '-' . $paddedNumber;
    }
    

    public static function MutasiSDM($tanggal)
    {
       
        // Mendapatkan tanggal dalam format yang sesuai dengan format tanggal di kode transaksi
        $formattedDate = Carbon::parse($tanggal)->format('Y-m-d');
    
        // Mendapatkan transaksi terakhir berdasarkan tanggal
        $lastTransaction = Kas::whereDate('tanggal', $tanggal)->where('type','M')->where('pengirim','SDM')
            ->orderBy('id', 'desc')
            ->first();
    
        if (!$lastTransaction) {
            return 'MTS-' . $formattedDate . '-00001';
        }
    
        $lastCode = $lastTransaction->kode_transaksi;
        $lastNumber = intval(substr($lastCode, strrpos($lastCode, '-') + 1));
        $paddedNumber = str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);

        return 'MTS-' . $formattedDate . '-' . $paddedNumber;
    }
    

    
    public static function MutasiP($tanggal)
    {
       
        // Mendapatkan tanggal dalam format yang sesuai dengan format tanggal di kode transaksi
        $formattedDate = Carbon::parse($tanggal)->format('Y-m-d');
    
        // Mendapatkan transaksi terakhir berdasarkan tanggal
        $lastTransaction = Kas::whereDate('tanggal', $tanggal)->where('type','M')->where('pengirim','P')
            ->orderBy('id', 'desc')
            ->first();
    
        if (!$lastTransaction) {
            return 'MTP-' . $formattedDate . '-00001';
        }
    
        $lastCode = $lastTransaction->kode_transaksi;
        $lastNumber = intval(substr($lastCode, strrpos($lastCode, '-') + 1));
        $paddedNumber = str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);

        return 'MTP-' . $formattedDate . '-' . $paddedNumber;
    }
    

    
    
    public static function MutasiPengumpulan($tanggal)
    {
       
        // Mendapatkan tanggal dalam format yang sesuai dengan format tanggal di kode transaksi
        $formattedDate = Carbon::parse($tanggal)->format('Y-m-d');
    
        // Mendapatkan transaksi terakhir berdasarkan tanggal
        $lastTransaction = Kas::whereDate('tanggal', $tanggal)->where('type','M')->where('pengirim','PG')
            ->orderBy('id', 'desc')
            ->first();
    
        if (!$lastTransaction) {
            return 'MPG-' . $formattedDate . '-00001';
        }
    
        $lastCode = $lastTransaction->kode_transaksi;
        $lastNumber = intval(substr($lastCode, strrpos($lastCode, '-') + 1));
        $paddedNumber = str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);

        return 'MPG-' . $formattedDate . '-' . $paddedNumber;
    }
    

 
    public static function MutasiKeuangan($tanggal)
    {
       
        // Mendapatkan tanggal dalam format yang sesuai dengan format tanggal di kode transaksi
        $formattedDate = Carbon::parse($tanggal)->format('Y-m-d');
    
        // Mendapatkan transaksi terakhir berdasarkan tanggal
        $lastTransaction = Kas::whereDate('tanggal', $tanggal)->where('type','M')->where('pengirim','KU')
            ->orderBy('id', 'desc')
            ->first();
    
        if (!$lastTransaction) {
            return 'MKU-' . $formattedDate . '-00001';
        }
    
        $lastCode = $lastTransaction->kode_transaksi;
        $lastNumber = intval(substr($lastCode, strrpos($lastCode, '-') + 1));
        $paddedNumber = str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);

        return 'MKU-' . $formattedDate . '-' . $paddedNumber;
    }
    




}
