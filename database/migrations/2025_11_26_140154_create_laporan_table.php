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
        Schema::create('laporan', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('lokasi');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('instansi_id')->constrained('instansi')->onDelete('cascade');
            $table->foreignId('admin_id')->nullable()->constrained('users')->onDelete('set null');
            $table->enum('status', ['terkirim', 'diverifikasi', 'diproses', 'ditolak', 'selesai'])->default('terkirim');
            $table->text('catatan_admin')->nullable();
            $table->json('bukti_files')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }
};
