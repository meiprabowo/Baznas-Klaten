<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kas', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('kode_transaksi');
            $table->ENUM('jenis_kas',['uang','barang'])->default('uang');
            $table->ENUM('pengirim',['SA','KU','P','SDM','PG'])->default('KU');
            $table->ENUM('type',['Z','H','R','PL','TU','JM','PWR','BANK'])->default('TU');
            $table->integer('debet');
            $table->integer('kredit');
            $table->integer('qty')->nullable();
            $table->bigInteger('jumlah')->nullable();
            $table->text('keterangan')->nullable();
            $table->integer('kasbon')->nullable();
            $table->integer('tahun');
            $table->string('file')->nullable();
            $table->integer('user_id');
            $table->integer('id_muzaki')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kas');
    }
};
