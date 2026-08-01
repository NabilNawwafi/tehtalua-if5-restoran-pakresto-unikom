<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use Illuminate\Http\Request;

// Implementasi Pro-1 (Penempatan Meja): KK-02, KK-03
class MejaController extends Controller
{
    // Aliran 1.3: Sistem menampilkan daftar meja beserta status (baca D2)
    public function index()
    {
        $mejas = Meja::orderBy('nomor_meja')->get();

        return view('pelayan.meja.index', compact('mejas'));
    }

    // Aliran 1.1-1.2: Pelayan memilih meja sesuai jumlah tamu,
    // sistem update status meja jadi 'Terisi' (tulis D2)
    public function pilih(Meja $meja)
    {
        if ($meja->status_meja !== 'Tersedia') {
            return back()->with('error', 'Meja ini sudah terisi, silakan pilih meja lain.');
        }

        $meja->update([
            'status_meja' => 'Terisi',
            'waktu_checkin' => now(),
        ]);

        // Aliran 1.4: Sistem menampilkan konfirmasi meja kepada pelayan
        return back()->with('success', "Meja {$meja->nomor_meja} berhasil ditempatkan.");
    }
}
