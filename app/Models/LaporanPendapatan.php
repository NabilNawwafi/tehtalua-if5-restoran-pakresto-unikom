<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPendapatan extends Model
{
    use HasFactory;

    protected $table = 'laporan_pendapatan';
    protected $primaryKey = 'kode_laporan';

    protected $fillable = [
        'periode',
        'tanggal_dibuat',
        'total_pendapatan',
        'id_kasir',
    ];

    public function kasir()
    {
        return $this->belongsTo(Pegawai::class, 'id_kasir', 'id_pegawai');
    }
}
