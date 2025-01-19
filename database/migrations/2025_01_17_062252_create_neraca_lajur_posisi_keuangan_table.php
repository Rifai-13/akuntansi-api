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
        Schema::create('posisi_keuangan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('ringkasan_id')->constrained('ringkasan')->cascadeOnDelete();
            $table->integer('debit')->nullable();
            $table->integer('kredit')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posisi_keuangan');
    }
};
