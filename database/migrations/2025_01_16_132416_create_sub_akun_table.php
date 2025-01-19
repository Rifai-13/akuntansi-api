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
        Schema::create('sub_akun', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->integer('kode');
            $table->string('nama');
            $table->foreignUuid('akun_id')->constrained('akun')->cascadeOnDelete();
            $table->foreignUuid('perusahaan_id')->constrained('perusahaan')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_akun');
    }
};
