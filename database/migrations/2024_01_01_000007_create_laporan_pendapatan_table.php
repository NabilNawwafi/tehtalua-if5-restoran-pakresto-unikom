<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Sumber: Kamus Data - Data Laporan Pendapatan (Dt-7)
// Struktur: Kode_Laporan + Periode + Tanggal_Dibuat + Total_Pendapatan + ID_Kasir
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporan_pendapatan', function (Blueprint $table) {
            $table->id('kode_laporan');
            $table->enum('periode', ['Harian', 'Mingguan', 'Bulanan', 'Tahunan']);
            $table->date('tanggal_dibuat');
            $table->unsignedInteger('total_pendapatan');
            $table->foreignId('id_kasir')->constrained('pegawai', 'id_pegawai');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan_pendapatan');
    }
};
