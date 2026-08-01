<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPembayaran extends Model
{
    use HasFactory;

    protected $table = 'transaksi_pembayaran';
    protected $primaryKey = 'nomor_transaksi';

    protected $fillable = [
        'nomor_pesanan',
        'id_kasir',
        'total_tagihan',
        'jumlah_dibayar',
        'kembalian',
        'waktu_transaksi',
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'nomor_pesanan', 'nomor_pesanan');
    }

    public function kasir()
    {
        return $this->belongsTo(Pegawai::class, 'id_kasir', 'id_pegawai');
    }
}
