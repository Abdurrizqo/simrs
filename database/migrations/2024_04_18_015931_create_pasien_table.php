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
        Schema::create('pasien', function (Blueprint $table) {
            $table->bigIncrements('no_rm');
            $table->string('nama_pasien');
            $table->string('no_ktp', 40);
            $table->enum('jenis_kelamin', ['PRIA', 'WANITA']);
            $table->string('tempat_lahir', 120);
            $table->date('tanggal_lahir');
            $table->string('nama_ibu')->nullable();
            $table->longText('alamat');
            $table->enum('gol_darah', ['A', 'B', 'O', 'AB', '-'])->nullable();
            $table->string('pekerjaan', 60)->nullable();
            $table->enum('stts_nikah', ['BELUM MENIKAH', 'MENIKAH', 'JANDA', 'DUDHA', 'SINGLE'])->nullable();
            $table->string('agama', 12)->nullable();
            $table->date('tgl_daftar')->nullable();
            $table->string('no_tlp', 40)->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('suku')->nullable();
            $table->string('bahasa')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('cacat_fisik')->nullable();
            $table->string('pendidikan')->nullable();
            $table->string('keluarga')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasien');
    }
};
