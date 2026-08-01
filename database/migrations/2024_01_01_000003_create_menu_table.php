<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Sumber: Kamus Data - Data Menu (Dt-3)
// Struktur: Kode_Menu + Nama_Menu + Kategori + Harga + Foto_Menu + Status_Ketersediaan
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->id('kode_menu');
            $table->string('nama_menu', 100);
            $table->enum('kategori', ['Makanan', 'Minuman']);
            $table->unsignedInteger('harga'); // dalam Rupiah
            $table->string('foto_menu')->nullable(); // nama file di storage/app/public/menu
            $table->enum('status_ketersediaan', ['Tersedia', 'Habis'])->default('Tersedia');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menu');
    }
};
