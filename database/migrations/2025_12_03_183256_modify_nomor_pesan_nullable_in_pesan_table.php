<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tb_pesan', function (Blueprint $table) {
            // Hapus unique constraint dulu
            $table->dropUnique(['nomor_pesan']);

            // Ubah kolom jadi nullable dan tambah unique constraint
            // MySQL secara default mengizinkan multiple NULL values dalam unique constraint
            $table->string('nomor_pesan', 50)->nullable()->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_pesan', function (Blueprint $table) {
            // Hapus unique constraint
            $table->dropUnique(['nomor_pesan']);

            // Ubah kembali jadi not nullable dengan unique constraint
            $table->string('nomor_pesan', 50)->nullable(false)->unique()->change();
        });
    }
};
