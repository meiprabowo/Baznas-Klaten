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
        Schema::create('baznas', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('website')->nullable();
            $table->string('email')->nullable();
            $table->string('telp')->nullable();
            $table->string('logo')->nullable();
            $table->string('proposal')->nullable();
            $table->string('penerimaan')->nullable();
            $table->string('keuangan')->nullable();
            $table->string('sdm_umum')->nullable();
            $table->string('ka_proposal')->nullable();
            $table->string('ka_penerimaan')->nullable();
            $table->string('ka_keuangan')->nullable();
            $table->string('ka_sdm_umum')->nullable();
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
        Schema::dropIfExists('baznas');
    }
};
