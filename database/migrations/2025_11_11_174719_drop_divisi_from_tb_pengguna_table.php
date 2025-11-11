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
        Schema::table('tb_pengguna', function (Blueprint $table) {
            $table->dropColumn('divisi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_pengguna', function (Blueprint $table) {
            $table->enum('divisi', ['akademik', 'kesiswaan', 'keuangan', 'umum', 'non_akademik', 'sarpras'])
                ->default('umum')
                ->notNullable()
                ->after('role');
        });
    }
};
