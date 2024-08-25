<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposal', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_masuk');
            $table->string('nomor_proposal');
            $table->enum('jenis_permohonan', ['barang', 'uang']);
            $table->string('nama_pemohon');
            $table->string('nik');
            $table->string('hp');
            $table->string('pekerjaan')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->text('alamat_lengkap')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('rw')->nullable();
            $table->string('rt')->nullable();
            $table->string('program')->nullable();
            $table->string('sub_program')->nullable();
            $table->string('detail_program')->nullable();
            $table->decimal('nominal_pengajuan', 15, 2);
            $table->text('keterangan')->nullable();
            $table->enum('status', ['B','O','A','N']);
            $table->Integer('petugas_survey')->nullable();
            $table->date('tanggal_input_survey')->nullable();
            $table->text('keterangan_survey')->nullable();
            $table->date('tanggal_input_survey')->nullable();
            $table->date('tanggal_penetapan')->nullable();
            $table->text('keterangan_penolakan')->nullable();
            $table->string('program_disetujui')->nullable();
            $table->enum('wa_status', ['B', 'S']);
            $table->string('proposal')->nullable();
            $table->enum('jenis_pemohon', ['P', 'L']);
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->Integer('tahun');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proposal');
    }
};
