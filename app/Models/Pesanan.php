<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';
    protected $primaryKey = 'nomor_pesanan';

    protected $fillable = [
        'nomor_meja',
        'id_pelayan',
        'waktu_pesan',
        'status_pesanan',
    ];

    public function meja()
    {
        return $this->belongsTo(Meja::class, 'nomor_meja', 'nomor_meja');
    }

    public function pelayan()
    {
        return $this->belongsTo(Pegawai::class, 'id_pelayan', 'id_pegawai');
    }

    public function detailPesanan()
    {
        return $this->hasMany(DetailPesanan::class, 'nomor_pesanan', 'nomor_pesanan');
    }

    public function transaksiPembayaran()
    {
        return $this->hasOne(TransaksiPembayaran::class, 'nomor_pesanan', 'nomor_pesanan');
    }

    // Helper: total tagihan dihitung dari seluruh detail pesanan (dipakai Proses 5.0)
    public function getTotalTagihanAttribute(): int
    {
        return $this->detailPesanan->sum('subtotal');
    }
}
