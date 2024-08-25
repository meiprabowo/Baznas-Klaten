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
        Schema::create('kasbon', function (Blueprint $table) {
            $table->id();
            $table->string('kode_kasbon')->nullable();
            $table->date('tanggal')->nullable();
            $table->bigInteger('jumlah')->nullable();
            $table->integer('tahun')->nullable();
            $table->integer('user_id');
            $table->enum('kategori', ['A','B','C','D'])->default('D');
            $table->enum('status', ['A', 'N','B'])->default('B');
            $table->integer('validator')->nullable();
            $table->text('keterangan')->nullable();
            $table->text('detail')->nullable();
            $table->enum('pemohon', ['SDM','PD'])->default('SDM');
     
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kasbon');
    }
};
