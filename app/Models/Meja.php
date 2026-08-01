<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    use HasFactory;

    protected $table = 'meja';
    protected $primaryKey = 'nomor_meja';

    protected $fillable = [
        'kapasitas_meja',
        'status_meja',
        'waktu_checkin',
    ];

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'nomor_meja', 'nomor_meja');
    }
}
