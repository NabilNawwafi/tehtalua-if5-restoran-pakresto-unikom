<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Sumber: Kamus Data - Data Detail Pesanan (Dt-5)
// Struktur: Nomor_Pesanan + Kode_Menu + Jumlah_Porsi + Subtotal
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_pesanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nomor_pesanan')->constrained('pesanan', 'nomor_pesanan')->cascadeOnDelete();
            $table->foreignId('kode_menu')->constrained('menu', 'kode_menu');
            $table->unsignedTinyInteger('jumlah_porsi');
            $table->unsignedInteger('subtotal'); // harga menu x jumlah_porsi, dalam Rupiah
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_pesanan');
    }
};
