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
        Schema::table('orders', function (Blueprint $column) {
            $column->string('no_telepon')->nullable()->after('username');
            $column->string('email')->nullable()->after('no_telepon');
            $column->text('alamat')->nullable()->after('email');
            $column->string('kota')->nullable()->after('alamat');
            $column->string('provinsi')->nullable()->after('kota');
            $column->string('kode_pos')->nullable()->after('provinsi');
            
            $column->decimal('subtotal', 15, 2)->default(0)->after('total_harga');
            $column->decimal('diskon', 15, 2)->default(0)->after('subtotal');
            $column->decimal('pajak', 15, 2)->default(0)->after('diskon');
            $column->decimal('biaya_tambahan', 15, 2)->default(0)->after('pajak');
            
            $column->string('resi')->nullable()->after('proof_image');
            $column->string('estimasi_hari')->nullable()->after('resi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $column) {
            $column->dropColumn([
                'no_telepon', 'email', 'alamat', 'kota', 'provinsi', 'kode_pos',
                'subtotal', 'diskon', 'pajak', 'biaya_tambahan',
                'resi', 'estimasi_hari'
            ]);
        });
    }
};
