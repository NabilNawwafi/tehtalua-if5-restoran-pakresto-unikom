@extends('layouts.app')

@section('title', 'Nota Transaksi')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3 no-print">
    <h3>Nota Transaksi</h3>
    <div>
        <button onclick="window.print()" class="btn btn-primary btn-sm">Cetak Nota</button>
        <a href="{{ route('kasir.pembayaran.index') }}" class="btn btn-outline-secondary btn-sm">&larr; Kembali</a>
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success no-print">{{ session('success') }}</div>
@endif

<div class="card mx-auto" style="max-width: 400px;">
    <div class="card-body">
        <div class="text-center mb-3">
            <h5 class="mb-0">Pak Resto UNIKOM</h5>
            <small class="text-muted">Nota Transaksi</small>
        </div>
        <hr>
        <p class="mb-1 small">No. Transaksi: #{{ $pesanan->transaksiPembayaran->nomor_transaksi }}</p>
        <p class="mb-1 small">No. Pesanan: #{{ $pesanan->nomor_pesanan }}</p>
        <p class="mb-1 small">Meja: {{ $pesanan->nomor_meja }}</p>
        <p class="mb-1 small">Kasir: {{ $pesanan->transaksiPembayaran->kasir->nama_pegawai }}</p>
        <p class="mb-1 small">Waktu: {{ \Carbon\Carbon::parse($pesanan->transaksiPembayaran->waktu_transaksi)->format('d/m/Y H:i') }}</p>
        <hr>
        <table class="table table-sm mb-0">
            <tbody>
                @foreach ($pesanan->detailPesanan as $d)
                    <tr>
                        <td>{{ $d->menu->nama_menu }} x{{ $d->jumlah_porsi }}</td>
                        <td class="text-end">Rp {{ number_format($d->subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <hr>
        <div class="d-flex justify-content-between">
            <span>Total Tagihan</span>
            <strong>Rp {{ number_format($pesanan->transaksiPembayaran->total_tagihan, 0, ',', '.') }}</strong>
        </div>
        <div class="d-flex justify-content-between">
            <span>Dibayar</span>
            <span>Rp {{ number_format($pesanan->transaksiPembayaran->jumlah_dibayar, 0, ',', '.') }}</span>
        </div>
        <div class="d-flex justify-content-between">
            <span>Kembalian</span>
            <span>Rp {{ number_format($pesanan->transaksiPembayaran->kembalian, 0, ',', '.') }}</span>
        </div>
        <hr>
        <p class="text-center small text-muted mb-0">Terima kasih atas kunjungan Anda!</p>
    </div>
</div>

<style>
    @media print {
        .no-print, nav { display: none !important; }
    }
</style>
@endsection
