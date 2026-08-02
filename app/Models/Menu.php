<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menu';
    protected $primaryKey = 'kode_menu';

    protected $fillable = [
        'nama_menu',
        'kategori',
        'harga',
        'stok',
        'foto_menu',
        'status_ketersediaan',
    ];

    public function detailPesanan()
    {
        return $this->hasMany(DetailPesanan::class, 'kode_menu', 'kode_menu');
    }

    // Menyamakan status_ketersediaan dengan nilai stok (dipanggil setiap kali stok berubah)
    public function sinkronStatusDariStok(): void
    {
        $this->status_ketersediaan = $this->stok > 0 ? 'Tersedia' : 'Habis';
    }
}
