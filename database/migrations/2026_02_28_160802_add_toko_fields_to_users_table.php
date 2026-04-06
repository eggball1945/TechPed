<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nama_toko')->nullable()->after('email');
            $table->string('email_toko')->nullable()->after('nama_toko');
            $table->string('url_toko')->nullable()->after('email_toko');
            $table->string('telepon_toko')->nullable()->after('url_toko');
            $table->text('deskripsi_toko')->nullable()->after('telepon_toko');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nama_toko', 'email_toko', 'url_toko', 'telepon_toko', 'deskripsi_toko']);
        });
    }
};
