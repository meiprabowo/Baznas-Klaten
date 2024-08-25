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
        Schema::create('surat_masuk', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal')->nullable();
            $table->string('nomor_surat')->nullable();
            $table->string('pengirim')->nullable();
            $table->string('kepada')->nullable();
            $table->string('perihal')->nullable();
            $table->string('lampiran')->nullable();
            $table->integer('tahun')->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_masuk');
    }
};
