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
        // Mengubah kolom shipping menjadi string agar bisa menyimpan nama ekspedisi lengkap seperti 'JNE Reguler'
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE orders MODIFY shipping VARCHAR(255) DEFAULT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
};
