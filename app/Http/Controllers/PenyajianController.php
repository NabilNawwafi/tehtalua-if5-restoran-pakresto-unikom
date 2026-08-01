<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

// Implementasi Pro-4 (Penyajian): KK-11
class PenyajianController extends Controller
{
    // Menampilkan pesanan yang sudah 'Selesai' dimasak, siap disajikan
    public function index()
    {
        $pesanans = Pesanan::with(['meja', 'detailPesanan.menu'])
            ->where('status_pesanan', 'Selesai')
            ->orderBy('waktu_pesan')
            ->get();

        return view('pelayan.penyajian.index', compact('pesanans'));
    }

    // Aliran 4.1, 4.2: Pelayan konfirmasi pesanan sudah diantar,
    // sistem update status jadi 'Disajikan' (tulis D4)
    public function sajikan(Pesanan $pesanan)
    {
        $pesanan->update(['status_pesanan' => 'Disajikan']);

        return back()->with('success', "Pesanan #{$pesanan->nomor_pesanan} untuk Meja {$pesanan->nomor_meja} berhasil disajikan.");
    }
}
