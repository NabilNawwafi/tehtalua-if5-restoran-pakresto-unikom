<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Sumber: Kamus Data - Data Pesanan (Dt-4)
// Struktur: Nomor_Pesanan + Nomor_Meja + ID_Pelayan + Waktu_Pesan + Status_Pesanan
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id('nomor_pesanan');
            $table->foreignId('nomor_meja')->constrained('meja', 'nomor_meja');
            $table->foreignId('id_pelayan')->constrained('pegawai', 'id_pegawai');
            $table->dateTime('waktu_pesan');
            $table->enum('status_pesanan', ['Diproses', 'Bahan Habis', 'Selesai', 'Disajikan'])
                  ->default('Diproses');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};
