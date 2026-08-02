@extends('layouts.app')

@section('title', 'Detail Laporan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3 no-print">
    <h3><i class="bi bi-bar-chart-line me-2"></i>Detail Laporan #{{ $laporan->kode_laporan }}</h3>
    <div>
        <button onclick="window.print()" class="btn btn-primary btn-sm"><i class="bi bi-printer me-1"></i>Cetak / Unduh</button>
        <a href="{{ route('kasir.laporan.index') }}" class="btn btn-outline-secondary btn-sm">&larr; Kembali</a>
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success no-print">{{ session('success') }}</div>
@endif

<div class="card mb-4 no-print">
    <div class="card-body">
        <h5 class="card-title"><i class="bi bi-graph-up me-2"></i>Grafik Pendapatan</h5>
        <canvas id="grafikPendapatan" height="90"></canvas>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="text-center mb-3">
            <h5 class="mb-0">Pak Resto UNIKOM</h5>
            <small class="text-muted">Laporan Pendapatan {{ $laporan->periode }}</small>
        </div>
        <hr>
        <div class="row mb-3">
            <div class="col-md-6">
                <p class="mb-1"><strong>Periode:</strong> {{ $laporan->periode }}</p>
                <p class="mb-1"><strong>Rentang:</strong> {{ $start->format('d/m/Y') }} — {{ $end->format('d/m/Y') }}</p>
            </div>
            <div class="col-md-6 text-md-end">
                <p class="mb-1"><strong>Dibuat oleh:</strong> {{ $laporan->kasir->nama_pegawai }}</p>
                <p class="mb-1"><strong>Kode Laporan:</strong> #{{ $laporan->kode_laporan }}</p>
            </div>
        </div>

        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>No. Transaksi</th>
                    <th>Meja</th>
                    <th>Kasir</th>
                    <th>Waktu</th>
                    <th class="text-end">Total Tagihan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transaksi as $t)
                    <tr>
                        <td>#{{ $t->nomor_transaksi }}</td>
                        <td>{{ $t->pesanan->nomor_meja }}</td>
                        <td>{{ $t->kasir->nama_pegawai }}</td>
                        <td>{{ \Carbon\Carbon::parse($t->waktu_transaksi)->format('d/m/Y H:i') }}</td>
                        <td class="text-end">Rp {{ number_format($t->total_tagihan, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center text-muted">Tidak ada transaksi pada periode ini.</td></tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr class="fw-bold table-light">
                    <td colspan="4" class="text-end">Total Pendapatan</td>
                    <td class="text-end">Rp {{ number_format($laporan->total_pendapatan, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<style>
    @media print {
        .no-print, nav { display: none !important; }
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
<script>
    const ctx = document.getElementById('grafikPendapatan');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($labelGrafik) !!},
            datasets: [{
                label: 'Pendapatan (Rp)',
                data: {!! json_encode($dataGrafik) !!},
                backgroundColor: '#8a4b26',
                borderRadius: 4,
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function (value) { return 'Rp ' + value.toLocaleString('id-ID'); }
                    }
                }
            }
        }
    });
</script>
@endsection
