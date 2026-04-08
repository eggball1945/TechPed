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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('petugas_id')->nullable()->constrained('petugas')->nullOnDelete();
            $table->enum('type', ['DAMAGED', 'DELAYED']);
            $table->text('description');
            $table->string('evidence_video')->nullable(); // For damaged items
            $table->enum('status', ['PENDING', 'IN_PROGRESS', 'RESOLVED', 'REJECTED'])->default('PENDING');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
