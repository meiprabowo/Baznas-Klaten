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
        Schema::create('akunkeuangan', function (Blueprint $table) {
            $table->id();
            $table->string('uraian');
            $table->string('kode');
            $table->integer('level');
            $table->enum('sifat', ['D', 'A'])->default('D');
            $table->string('kelompok');
            $table->enum('status', ['A', 'N'])->default('A');
            $table->string('jenis_akun')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akunkeuangan');
    }
};
