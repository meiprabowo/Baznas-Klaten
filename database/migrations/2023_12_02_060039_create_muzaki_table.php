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
        Schema::create('muzaki', function (Blueprint $table) {
            $table->id();
            $table->string('npwz')->nullable();
            $table->string('nama')->nullable();
            $table->text('alamat')->nullable();
            $table->string('telp')->nullable();
            $table->string('hp')->nullable();
            $table->string('email')->nullable();
            $table->enum('type', ['P', 'L'])->default('P');
            $table->enum('jenis_kalamin', ['P', 'L'])->default('P');
            $table->text('keterangan')->nullable();
            $table->date('tgl_register')->nullable();
            $table->text('npwp')->nullable();
            $table->text('nik')->nullable();
            $table->text('dinas')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('muzaki');
    }
};
