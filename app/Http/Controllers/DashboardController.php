<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Meja;
use App\Models\Pesanan;
use App\Models\TransaksiPembayaran;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function pelayan()
    {
        return view('dashboard.pelayan', [
            'user' => Auth::user(),
            'jumlahSiapDisajikan' => Pesanan::where('status_pesanan', 'Selesai')->count(),
            'mejaTersedia' => Meja::where('status_meja', 'Tersedia')->count(),
            'mejaTerisi' => Meja::where('status_meja', 'Terisi')->count(),
            'pesananAktif' => Pesanan::where('status_pesanan', '!=', 'Disajikan')->count(),
        ]);
    }

    public function koki()
    {
        return view('dashboard.koki', [
            'user' => Auth::user(),
            'jumlahMenunggu' => Pesanan::where('status_pesanan', 'Diproses')->count(),
            'menuTersedia' => Menu::where('status_ketersediaan', 'Tersedia')->count(),
            'menuHabis' => Menu::where('status_ketersediaan', 'Habis')->count(),
        ]);
    }

    public function kasir()
    {
        $pendapatanHariIni = TransaksiPembayaran::whereDate('waktu_transaksi', today())
            ->sum('total_tagihan');

        $transaksiHariIni = TransaksiPembayaran::whereDate('waktu_transaksi', today())->count();

        return view('dashboard.kasir', [
            'user' => Auth::user(),
            'jumlahBelumBayar' => Pesanan::where('status_pesanan', 'Disajikan')
                ->whereDoesntHave('transaksiPembayaran')->count(),
            'pendapatanHariIni' => $pendapatanHariIni,
            'transaksiHariIni' => $transaksiHariIni,
        ]);
    }
}
