<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Pesanan;
use Illuminate\Http\Request;

// Implementasi Pro-3 (Pemrosesan Pesanan): KK-08, KK-09, KK-10
class PemrosesanController extends Controller
{
    // Aliran 3.2: Sistem menampilkan daftar pesanan urutan FIFO (baca D4)
    public function index()
    {
        $pesanans = Pesanan::with(['meja', 'detailPesanan.menu'])
            ->where('status_pesanan', 'Diproses')
            ->orderBy('waktu_pesan')
            ->get();

        return view('koki.pemrosesan.index', compact('pesanans'));
    }

    // Aliran 3.3, 3.5: Koki menandai pesanan selesai dimasak,
    // sistem update status (tulis D4) dan notifikasi ke Pelayan
    public function selesai(Pesanan $pesanan)
    {
        $pesanan->update(['status_pesanan' => 'Selesai']);

        return back()->with('success', "Pesanan #{$pesanan->nomor_pesanan} ditandai selesai dimasak.");
    }

    // Aliran 3.3, 3.4, 3.5: Koki menandai bahan menu tertentu habis,
    // sistem update status menu (tulis D3) & status pesanan (tulis D4),
    // lalu notifikasi ke Pelayan
    public function bahanHabis(Pesanan $pesanan, Menu $menu)
    {
        $menu->update(['status_ketersediaan' => 'Habis']);
        $pesanan->update(['status_pesanan' => 'Bahan Habis']);

        return back()->with('error', "Menu '{$menu->nama_menu}' ditandai habis. Pesanan #{$pesanan->nomor_pesanan} diberi tahu ke Pelayan.");
    }
}
