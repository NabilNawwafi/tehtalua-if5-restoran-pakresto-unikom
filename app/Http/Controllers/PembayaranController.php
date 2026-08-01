<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\TransaksiPembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

// Implementasi Pro-5 (Pembayaran & Cetak Nota): KK-12, KK-13, KK-14, KK-15
class PembayaranController extends Controller
{
    // Aliran 5.2: Sistem menampilkan pesanan yang sudah disajikan dan belum dibayar (baca D4)
    public function index()
    {
        $pesanans = Pesanan::with(['meja', 'detailPesanan.menu'])
            ->where('status_pesanan', 'Disajikan')
            ->whereDoesntHave('transaksiPembayaran')
            ->orderBy('waktu_pesan')
            ->get();

        return view('kasir.pembayaran.index', compact('pesanans'));
    }

    // Aliran 5.2, 5.3: Sistem menghitung total tagihan dari detail pesanan (baca D4 & D5)
    public function create(Pesanan $pesanan)
    {
        if ($pesanan->transaksiPembayaran) {
            return redirect()->route('kasir.pembayaran.nota', $pesanan->nomor_pesanan);
        }

        if ($pesanan->status_pesanan !== 'Disajikan') {
            return redirect()->route('kasir.pembayaran.index')
                ->with('error', 'Pesanan ini belum disajikan, belum bisa dibayar.');
        }

        $pesanan->load('detailPesanan.menu', 'meja');
        $totalTagihan = $pesanan->detailPesanan->sum('subtotal');

        return view('kasir.pembayaran.create', compact('pesanan', 'totalTagihan'));
    }

    // Aliran 5.1, 5.4, 5.5, 5.6: Kasir input pembayaran, sistem validasi,
    // simpan transaksi (tulis D6), reset status meja (tulis D2), tampilkan nota
    public function store(Request $request, Pesanan $pesanan)
    {
        $totalTagihan = $pesanan->detailPesanan->sum('subtotal');

        $validated = $request->validate([
            'jumlah_dibayar' => ['required', 'integer', 'min:0'],
        ]);

        if ($validated['jumlah_dibayar'] < $totalTagihan) {
            return back()->withInput()->with('error', 'Jumlah pembayaran kurang dari total tagihan.');
        }

        $kembalian = $validated['jumlah_dibayar'] - $totalTagihan;

        DB::transaction(function () use ($pesanan, $totalTagihan, $validated, $kembalian) {
            TransaksiPembayaran::create([
                'nomor_pesanan' => $pesanan->nomor_pesanan,
                'id_kasir' => Auth::id(),
                'total_tagihan' => $totalTagihan,
                'jumlah_dibayar' => $validated['jumlah_dibayar'],
                'kembalian' => $kembalian,
                'waktu_transaksi' => now(),
            ]);

            // Aliran 5.5: reset status meja jadi 'Tersedia' kembali
            $pesanan->meja->update([
                'status_meja' => 'Tersedia',
                'waktu_checkin' => null,
            ]);
        });

        return redirect()->route('kasir.pembayaran.nota', $pesanan->nomor_pesanan)
            ->with('success', 'Pembayaran berhasil. Meja telah tersedia kembali.');
    }

    // Aliran 5.6: Menampilkan nota transaksi
    public function nota(Pesanan $pesanan)
    {
        $pesanan->load('detailPesanan.menu', 'meja', 'transaksiPembayaran.kasir');

        if (! $pesanan->transaksiPembayaran) {
            abort(404, 'Transaksi untuk pesanan ini belum ada.');
        }

        return view('kasir.pembayaran.nota', compact('pesanan'));
    }
}
