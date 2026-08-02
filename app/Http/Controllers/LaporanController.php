<?php

namespace App\Http\Controllers;

use App\Models\LaporanPendapatan;
use App\Models\TransaksiPembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

// Implementasi Pro-6 (Pelaporan Pendapatan): KK-16, KK-17
class LaporanController extends Controller
{
    public function index()
    {
        $laporans = LaporanPendapatan::with('kasir')
            ->orderByDesc('tanggal_dibuat')
            ->orderByDesc('kode_laporan')
            ->get();

        return view('kasir.laporan.index', compact('laporans'));
    }

    public function generate(Request $request)
    {
        $validated = $request->validate([
            'periode' => ['required', 'in:Harian,Mingguan,Bulanan,Tahunan'],
            'tanggal' => ['required', 'date'],
        ]);

        [$start, $end] = $this->rentangTanggal($validated['periode'], $validated['tanggal']);

        $totalPendapatan = TransaksiPembayaran::whereBetween('waktu_transaksi', [$start, $end])
            ->sum('total_tagihan');

        $laporan = LaporanPendapatan::create([
            'periode' => $validated['periode'],
            'tanggal_dibuat' => $validated['tanggal'],
            'total_pendapatan' => $totalPendapatan,
            'id_kasir' => Auth::id(),
        ]);

        return redirect()->route('kasir.laporan.show', $laporan->kode_laporan)
            ->with('success', 'Laporan berhasil dibuat.');
    }

    public function show(LaporanPendapatan $laporan)
    {
        $laporan->load('kasir');

        [$start, $end] = $this->rentangTanggal($laporan->periode, $laporan->tanggal_dibuat);

        $transaksi = TransaksiPembayaran::with(['pesanan.meja', 'kasir'])
            ->whereBetween('waktu_transaksi', [$start, $end])
            ->orderBy('waktu_transaksi')
            ->get();

        // Fitur tambahan: rekap pendapatan untuk grafik.
        // Periode Tahunan direkap per bulan (12 titik), selain itu direkap per hari.
        $labelGrafik = [];
        $dataGrafik = [];

        if ($laporan->periode === 'Tahunan') {
            $rekapBulanan = $transaksi->groupBy(fn ($t) => Carbon::parse($t->waktu_transaksi)->format('Y-m'))
                ->map(fn ($grup) => $grup->sum('total_tagihan'));

            $kursor = $start->copy()->startOfMonth();
            while ($kursor->lte($end)) {
                $key = $kursor->format('Y-m');
                $labelGrafik[] = $kursor->translatedFormat('M Y');
                $dataGrafik[] = (int) ($rekapBulanan[$key] ?? 0);
                $kursor->addMonth();
            }
        } else {
            $rekapHarian = $transaksi->groupBy(fn ($t) => Carbon::parse($t->waktu_transaksi)->format('Y-m-d'))
                ->map(fn ($grup) => $grup->sum('total_tagihan'));

            $kursor = $start->copy()->startOfDay();
            while ($kursor->lte($end)) {
                $key = $kursor->format('Y-m-d');
                $labelGrafik[] = $kursor->format('d/m');
                $dataGrafik[] = (int) ($rekapHarian[$key] ?? 0);
                $kursor->addDay();
            }
        }

        return view('kasir.laporan.show', compact('laporan', 'transaksi', 'start', 'end', 'labelGrafik', 'dataGrafik'));
    }

    private function rentangTanggal(string $periode, string $tanggalAcuan): array
    {
        $tanggal = Carbon::parse($tanggalAcuan);

        return match ($periode) {
            'Harian' => [$tanggal->copy()->startOfDay(), $tanggal->copy()->endOfDay()],
            'Mingguan' => [$tanggal->copy()->startOfWeek(), $tanggal->copy()->endOfWeek()],
            'Bulanan' => [$tanggal->copy()->startOfMonth(), $tanggal->copy()->endOfMonth()],
            'Tahunan' => [$tanggal->copy()->startOfYear(), $tanggal->copy()->endOfYear()],
        };
    }
}
