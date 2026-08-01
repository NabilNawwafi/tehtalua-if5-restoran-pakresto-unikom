<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use App\Models\Meja;
use App\Models\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ---- Akun pegawai contoh (1 tiap role, sesuai KK-01) ----
        Pegawai::create([
            'nama_pegawai' => 'Ani (Pelayan)',
            'role' => 'Pelayan',
            'username' => 'pelayan1',
            'password' => Hash::make('password'),
        ]);

        Pegawai::create([
            'nama_pegawai' => 'Budi (Koki)',
            'role' => 'Koki',
            'username' => 'koki1',
            'password' => Hash::make('password'),
        ]);

        Pegawai::create([
            'nama_pegawai' => 'Citra (Kasir)',
            'role' => 'Kasir',
            'username' => 'kasir1',
            'password' => Hash::make('password'),
        ]);

        // ---- Contoh meja (Dt-2) ----
        foreach ([2, 2, 4, 4, 6, 8] as $i => $kapasitas) {
            Meja::create([
                'kapasitas_meja' => $kapasitas,
                'status_meja' => 'Tersedia',
            ]);
        }

        // ---- Contoh menu (Dt-3) ----
        $menus = [
            ['nama_menu' => 'Nasi Goreng Spesial', 'kategori' => 'Makanan', 'harga' => 25000],
            ['nama_menu' => 'Ayam Bakar', 'kategori' => 'Makanan', 'harga' => 30000],
            ['nama_menu' => 'Mie Goreng', 'kategori' => 'Makanan', 'harga' => 22000],
            ['nama_menu' => 'Es Teh Manis', 'kategori' => 'Minuman', 'harga' => 8000],
            ['nama_menu' => 'Jus Alpukat', 'kategori' => 'Minuman', 'harga' => 15000],
        ];
        foreach ($menus as $m) {
            Menu::create($m + ['status_ketersediaan' => 'Tersedia']);
        }
    }
}