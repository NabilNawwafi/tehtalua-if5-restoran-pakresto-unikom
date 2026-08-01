<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Sumber: Kamus Data - Data Transaksi Pembayaran (Dt-6)
// Struktur: Nomor_Transaksi + Nomor_Pesanan + ID_Kasir + Total_Tagihan + Jumlah_Dibayar + Kembalian + Waktu_Transaksi
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi_pembayaran', function (Blueprint $table) {
            $table->id('nomor_transaksi');
            $table->foreignId('nomor_pesanan')->constrained('pesanan', 'nomor_pesanan');
            $table->foreignId('id_kasir')->constrained('pegawai', 'id_pegawai');
            $table->unsignedInteger('total_tagihan');
            $table->unsignedInteger('jumlah_dibayar');
            $table->unsignedInteger('kembalian');
            $table->dateTime('waktu_transaksi');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi_pembayaran');
    }
};
