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
        Schema::create('tb_pengguna', function (Blueprint $table) {
            $table->increments('id_pengguna');
            $table->string('nama', 100)->notNullable();
            $table->string('email', 150)->unique()->notNullable();
            $table->string('password', 255)->notNullable();
            $table->enum('role', ['admin', 'guru'])->default('guru')->notNullable();
            $table->enum('divisi', ['akademik', 'kesiswaan', 'keuangan', 'umum', 'non_akademik', 'sarpras'])->default('umum')->notNullable();
            $table->timestamp('created_at')->useCurrent();
            $table->string('nomor_telp', 50)->notNullable();
            $table->unsignedBigInteger('nip')->notNullable();
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan'])->default('laki-laki')->notNullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_pengguna');
    }
};
