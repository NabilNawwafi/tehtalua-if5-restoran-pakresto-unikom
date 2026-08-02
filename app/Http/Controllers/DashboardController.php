<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function pelayan()
    {
        // Badge: jumlah pesanan yang sudah selesai dimasak, siap disajikan
        $jumlahSiapDisajikan = Pesanan::where('status_pesanan', 'Selesai')->count();

        return view('dashboard.pelayan', [
            'user' => Auth::user(),
            'jumlahSiapDisajikan' => $jumlahSiapDisajikan,
        ]);
    }

    public function koki()
    {
        // Badge: jumlah pesanan baru yang menunggu diproses
        $jumlahMenunggu = Pesanan::where('status_pesanan', 'Diproses')->count();

        return view('dashboard.koki', [
            'user' => Auth::user(),
            'jumlahMenunggu' => $jumlahMenunggu,
        ]);
    }

    public function kasir()
    {
        // Badge: jumlah pesanan yang sudah disajikan tapi belum dibayar
        $jumlahBelumBayar = Pesanan::where('status_pesanan', 'Disajikan')
            ->whereDoesntHave('transaksiPembayaran')
            ->count();

        return view('dashboard.kasir', [
            'user' => Auth::user(),
            'jumlahBelumBayar' => $jumlahBelumBayar,
        ]);
    }
}
