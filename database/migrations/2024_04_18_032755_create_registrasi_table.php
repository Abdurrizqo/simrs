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
        Schema::create('registrasi', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("no_rawat", 120);
            $table->time("waktu_registrasi");
            $table->integer("antrian_poli");
            $table->enum("status_periksa", ['Belum', 'Sudah', 'Batal', 'Berkas Diterima', 'Dirujuk', 'Meninggal', 'Dirawat', 'Pulang Paksa'])->default('belum');
            $table->boolean("status_bayar")->default(false);
            $table->uuid("poli")->nullable();
            $table->uuid("dokter")->nullable();
            $table->unsignedBigInteger("pasien");
            $table->foreign('poli')->references('id')->on('poli')->onDelete('set null');
            $table->foreign('dokter')->references('id')->on('dokter')->onDelete('set null');
            $table->foreign('pasien')->references('no_rm')->on('pasien')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrasi');
    }
};
