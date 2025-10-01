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
        Schema::create('tb_lampiran', function (Blueprint $table) {
            $table->bigIncrements('id_lampiran');
            $table->unsignedBigInteger('id_pesan');
            $table->string('nama_file', 255)->notNullable();
            $table->string('path_file', 255)->notNullable();

            $table->foreign('id_pesan')->references('id_pesan')->on('tb_pesan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_lampiran');
    }
};
