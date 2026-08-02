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

        foreach ([2, 2, 4, 4, 6, 8] as $kapasitas) {
            Meja::create([
                'kapasitas_meja' => $kapasitas,
                'status_meja' => 'Tersedia',
            ]);
        }

        // Menu contoh, sudah termasuk stok awal (fitur Manajemen Stok per Porsi)
        $menus = [
            ['nama_menu' => 'Nasi Goreng Spesial', 'kategori' => 'Makanan', 'harga' => 25000, 'stok' => 20],
            ['nama_menu' => 'Ayam Bakar', 'kategori' => 'Makanan', 'harga' => 30000, 'stok' => 15],
            ['nama_menu' => 'Mie Goreng', 'kategori' => 'Makanan', 'harga' => 22000, 'stok' => 20],
            ['nama_menu' => 'Es Teh Manis', 'kategori' => 'Minuman', 'harga' => 8000, 'stok' => 50],
            ['nama_menu' => 'Jus Alpukat', 'kategori' => 'Minuman', 'harga' => 15000, 'stok' => 10],
        ];
        foreach ($menus as $m) {
            $menu = new Menu($m);
            $menu->sinkronStatusDariStok();
            $menu->save();
        }
    }
}
