<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Fitur tambahan: Manajemen Stok per Porsi
// Menambahkan kolom stok pada Data Menu (Dt-3) sehingga status_ketersediaan
// otomatis diturunkan dari nilai stok (stok > 0 => Tersedia, stok = 0 => Habis)
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('menu', function (Blueprint $table) {
            $table->unsignedInteger('stok')->default(0)->after('harga');
        });
    }

    public function down(): void
    {
        Schema::table('menu', function (Blueprint $table) {
            $table->dropColumn('stok');
        });
    }
};
