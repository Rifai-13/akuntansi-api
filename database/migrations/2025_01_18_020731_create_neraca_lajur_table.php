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
        Schema::create('neraca_lajur', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('akun_id')->constrained('akun')->cascadeOnDelete();
            $table->foreignUuid('perusahaan_id')->constrained('perusahaan')->cascadeOnDelete();
            $table->foreignUuid('sub_akun_id')->constrained('sub_akun')->cascadeOnDelete()->nullable();
            $table->foreignUuid('penyesuaian_id')->constrained('penyesuaian')->cascadeOnDelete();
            $table->foreignUuid('laba_rugi_id')->constrained('laba_rugi')->cascadeOnDelete();
            $table->foreignUuid('perubahan_ekuitas_id')->constrained('perubahan_ekuitas')->cascadeOnDelete();
            $table->foreignUuid('posisi_keuangan_id')->constrained('posisi_keuangan')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('neraca_lajur');
    }
};
