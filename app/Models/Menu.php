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
        'foto_menu',
        'status_ketersediaan',
    ];

    public function detailPesanan()
    {
        return $this->hasMany(DetailPesanan::class, 'kode_menu', 'kode_menu');
    }
}
