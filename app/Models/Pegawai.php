<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pegawai extends Authenticatable
{
    use HasFactory;

    protected $table = 'pegawai';
    protected $primaryKey = 'id_pegawai';

    protected $fillable = [
        'nama_pegawai',
        'role',
        'username',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Laravel auth pakai kolom 'username' bukan 'email' -> diatur di config/auth.php & LoginController

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'id_pelayan', 'id_pegawai');
    }

    public function transaksiPembayaran()
    {
        return $this->hasMany(TransaksiPembayaran::class, 'id_kasir', 'id_pegawai');
    }

    public function laporanPendapatan()
    {
        return $this->hasMany(LaporanPendapatan::class, 'id_kasir', 'id_pegawai');
    }

    // Helper role check, dipakai di middleware & view
    public function isPelayan(): bool
    {
        return $this->role === 'Pelayan';
    }

    public function isKoki(): bool
    {
        return $this->role === 'Koki';
    }

    public function isKasir(): bool
    {
        return $this->role === 'Kasir';
    }
}
