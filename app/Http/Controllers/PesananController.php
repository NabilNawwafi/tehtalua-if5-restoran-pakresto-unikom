<?php

namespace App\Http\Controllers;

use App\Models\DetailPesanan;
use App\Models\Meja;
use App\Models\Menu;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

// Implementasi Pro-2 (Pemesanan Menu): KK-05, KK-06, KK-07
// + Fitur tambahan: validasi & pengurangan Stok per Porsi saat pesanan dibuat
class PesananController extends Controller
{
    public function index()
    {
        $mejaTerisi = Meja::where('status_meja', 'Terisi')->orderBy('nomor_meja')->get();

        $pesananAktif = Pesanan::with(['meja', 'detailPesanan.menu'])
            ->where('status_pesanan', '!=', 'Disajikan')
            ->orderByDesc('waktu_pesan')
            ->get();

        return view('pelayan.pesanan.index', compact('mejaTerisi', 'pesananAktif'));
    }

    // Aliran 2.2: Sistem menampilkan menu yang berstatus Tersedia beserta stoknya (baca D3)
    public function create(Meja $meja)
    {
        if ($meja->status_meja !== 'Terisi') {
            return redirect()->route('pelayan.pesanan.index')
                ->with('error', 'Meja ini belum ditempati, tidak bisa membuat pesanan.');
        }

        $menus = Menu::where('status_ketersediaan', 'Tersedia')
            ->where('stok', '>', 0)
            ->orderBy('kategori')->orderBy('nama_menu')
            ->get();

        return view('pelayan.pesanan.create', compact('meja', 'menus'));
    }

    // Aliran 2.1, 2.4, 2.5, 2.6: Pelayan input pesanan, sistem validasi stok mencukupi,
    // simpan ke D4 & D5, kurangi stok menu, lalu kirim notifikasi ke Koki
    public function store(Request $request, Meja $meja)
    {
        $validated = $request->validate([
            'items' => ['required', 'array'],
            'items.*' => ['nullable', 'integer', 'min:0', 'max:99'],
        ]);

        $items = array_filter($validated['items'], fn ($qty) => $qty > 0);

        if (empty($items)) {
            return back()->with('error', 'Pilih minimal 1 menu dengan jumlah porsi lebih dari 0.');
        }

        // Validasi stok mencukupi untuk setiap item sebelum menyimpan apa pun
        foreach ($items as $kodeMenu => $jumlahPorsi) {
            $menu = Menu::findOrFail($kodeMenu);
            if ($menu->stok < $jumlahPorsi) {
                return back()->withInput()->with('error',
                    "Stok {$menu->nama_menu} tidak mencukupi (tersisa {$menu->stok} porsi).");
            }
        }

        DB::transaction(function () use ($items, $meja) {
            $pesanan = Pesanan::create([
                'nomor_meja' => $meja->nomor_meja,
                'id_pelayan' => Auth::id(),
                'waktu_pesan' => now(),
                'status_pesanan' => 'Diproses',
            ]);

            foreach ($items as $kodeMenu => $jumlahPorsi) {
                $menu = Menu::findOrFail($kodeMenu);

                DetailPesanan::create([
                    'nomor_pesanan' => $pesanan->nomor_pesanan,
                    'kode_menu' => $menu->kode_menu,
                    'jumlah_porsi' => $jumlahPorsi,
                    'subtotal' => $menu->harga * $jumlahPorsi,
                ]);

                // Kurangi stok menu, otomatis sinkronkan status_ketersediaan
                $menu->stok -= $jumlahPorsi;
                $menu->sinkronStatusDariStok();
                $menu->save();
            }
        });

        return redirect()->route('pelayan.pesanan.index')
            ->with('success', "Pesanan untuk Meja {$meja->nomor_meja} berhasil disimpan.");
    }
}
