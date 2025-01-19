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
        Schema::create('jurnal', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->date('tanggal');
            $table->string('bukti');
            $table->string('keterangan');
            $table->foreignUuid('akun_id')->constrained('akun')->cascadeOnDelete();
            $table->integer('debit')->nullable();
            $table->integer('kredit')->nullable();
            $table->foreignUuid('perusahaan_id')->constrained('perusahaan')->cascadeOnDelete();
            $table->foreignUuid('sub_akun_id')->constrained('sub_akun')->cascadeOnDelete()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jurnal');
    }
};
