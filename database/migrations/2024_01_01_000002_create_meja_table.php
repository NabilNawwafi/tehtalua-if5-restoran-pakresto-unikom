<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Sumber: Kamus Data - Data Meja (Dt-2)
// Struktur: Nomor_Meja + Kapasitas_Meja + Status_Meja + Waktu_Checkin
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('meja', function (Blueprint $table) {
            $table->id('nomor_meja');
            $table->unsignedTinyInteger('kapasitas_meja');
            $table->enum('status_meja', ['Tersedia', 'Terisi'])->default('Tersedia');
            $table->dateTime('waktu_checkin')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('meja');
    }
};
