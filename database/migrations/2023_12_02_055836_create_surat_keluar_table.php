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
        Schema::create('surat_keluar', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal')->nullable();
            $table->string('nomor_surat')->nullable();
            $table->string('kepada')->nullable();
            $table->string('lokasi_tujuan')->nullable();
            $table->string('perihal')->nullable();
            $table->integer('lampiran')->nullable();
            $table->integer('tahun')->nullable();
            $table->string('file_lampiran')->nullable();
            $table->string('tembusan')->nullable();
            $table->text('isi_surat')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_keluar');
    }
};
