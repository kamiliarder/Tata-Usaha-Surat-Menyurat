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
        Schema::create('tb_pesan', function (Blueprint $table) {
            $table->bigIncrements('id_pesan');
            $table->string('nomor_pesan', 50)->unique()->notNullable();
            $table->string('judul', 200)->notNullable();
            $table->text('perihal')->nullable();
            $table->enum('kategori', ['akademik', 'kesiswaan', 'keuangan', 'umum', 'non_akademik', 'sarpras'])->default('umum')->notNullable();
            $table->enum('tipe', ['masuk', 'keluar'])->notNullable();
            $table->dateTime('tanggal_kirim')->useCurrent();
            $table->string('pengirim', 200)->notNullable();
            $table->unsignedInteger('id_penerima')->notNullable();
            $table->enum('status_pesan', ['pending', 'diterima', 'dalam_proses', 'perlu_perbaikan', 'disetujui', 'ditolak'])->default('pending')->notNullable();
            $table->string('instansi', 50)->nullable();
            $table->string('kontak_pengirim', 100)->nullable(); // WhatsApp/Email contact
            $table->string('alamat_pengirim', 255)->nullable(); // Address if needed
            $table->unsignedBigInteger('id_pesan_terkait')->nullable(); // Related message ID for threading

            $table->foreign('id_penerima')->references('id_pengguna')->on('tb_pengguna');
            $table->foreign('id_pesan_terkait')->references('id_pesan')->on('tb_pesan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_pesan');
    }
};
