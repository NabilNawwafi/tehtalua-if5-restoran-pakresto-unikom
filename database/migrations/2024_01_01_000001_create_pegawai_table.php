<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Sumber: Kamus Data - Data Pegawai (Dt-1)
// Struktur: ID_Pegawai + Nama_Pegawai + Role + Username + Password
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id('id_pegawai');
            $table->string('nama_pegawai', 100);
            $table->enum('role', ['Pelayan', 'Koki', 'Kasir']);
            $table->string('username', 50)->unique();
            $table->string('password'); // di-hash pakai bcrypt saat insert
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pegawai');
    }
};
