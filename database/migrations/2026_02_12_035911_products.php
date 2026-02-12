<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->string('sku')->unique();
            $table->text('deskripsi')->nullable();
            $table->enum('kategori', ['pc', 'mini pc', 'laptop', 'gaming', 'hardware']);
            $table->decimal('harga', 14, 2);
            $table->string('gambar')->nullable();
            $table->integer('stok')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
