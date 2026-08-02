@extends('layouts.app')

@section('title', 'Nota Transaksi')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3 no-print">
    <h3><i class="bi bi-receipt me-2"></i>Nota Transaksi</h3>
    <div>
        <button onclick="window.print()" class="btn btn-primary btn-sm"><i class="bi bi-printer me-1"></i>Cetak Nota</button>
        <a href="{{ route('kasir.pembayaran.index') }}" class="btn btn-outline-secondary btn-sm">&larr; Kembali</a>
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success no-print">{{ session('success') }}</div>
@endif

<div class="struk mx-auto">
    <div class="text-center">
        <div class="struk-logo"><i class="bi bi-egg-fried"></i></div>
        <div class="struk-nama">PAK RESTO UNIKOM</div>
        <div class="struk-alamat">Sistem Informasi Restoran</div>
    </div>
    <div class="struk-garis"></div>
    <div class="struk-info">
        <div>No. Transaksi</div><div>: #{{ $pesanan->transaksiPembayaran->nomor_transaksi }}</div>
        <div>No. Pesanan</div><div>: #{{ $pesanan->nomor_pesanan }}</div>
        <div>Meja</div><div>: {{ $pesanan->nomor_meja }}</div>
        <div>Kasir</div><div>: {{ $pesanan->transaksiPembayaran->kasir->nama_pegawai }}</div>
        <div>Waktu</div><div>: {{ \Carbon\Carbon::parse($pesanan->transaksiPembayaran->waktu_transaksi)->format('d/m/Y H:i') }}</div>
    </div>
    <div class="struk-garis"></div>
    @foreach ($pesanan->detailPesanan as $d)
        <div class="struk-item">
            <div>{{ $d->menu->nama_menu }}</div>
            <div class="text-muted">{{ $d->jumlah_porsi }} x Rp {{ number_format($d->menu->harga, 0, ',', '.') }}</div>
        </div>
        <div class="struk-item-total">Rp {{ number_format($d->subtotal, 0, ',', '.') }}</div>
    @endforeach
    <div class="struk-garis"></div>
    <div class="struk-total-row">
        <div>TOTAL</div><div>Rp {{ number_format($pesanan->transaksiPembayaran->total_tagihan, 0, ',', '.') }}</div>
    </div>
    <div class="struk-info mt-1">
        <div>Dibayar</div><div>: Rp {{ number_format($pesanan->transaksiPembayaran->jumlah_dibayar, 0, ',', '.') }}</div>
        <div>Kembalian</div><div>: Rp {{ number_format($pesanan->transaksiPembayaran->kembalian, 0, ',', '.') }}</div>
    </div>
    <div class="struk-garis"></div>
    <div class="text-center struk-footer">
        *** TERIMA KASIH ***<br>
        Atas kunjungan Anda
    </div>
</div>

<style>
    .struk {
        max-width: 320px;
        background: #fff;
        padding: 20px 18px;
        font-family: 'Courier New', Courier, monospace;
        font-size: 0.85rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        border-radius: 4px;
    }
    .struk-logo { font-size: 1.6rem; color: var(--brand-color); }
    .struk-nama { font-weight: 700; letter-spacing: 1px; margin-top: 2px; }
    .struk-alamat { font-size: 0.75rem; color: #777; }
    .struk-garis {
        border-top: 1px dashed #999;
        margin: 10px 0;
    }
    .struk-info {
        display: grid;
        grid-template-columns: 90px 1fr;
        row-gap: 2px;
    }
    .struk-item {
        display: flex;
        justify-content: space-between;
        margin-top: 6px;
    }
    .struk-item-total {
        text-align: right;
        font-weight: 600;
    }
    .struk-total-row {
        display: flex;
        justify-content: space-between;
        font-weight: 700;
        font-size: 1rem;
    }
    .struk-footer {
        font-size: 0.8rem;
        margin-top: 4px;
    }
    @media print {
        .no-print, nav { display: none !important; }
        body { background: #fff; }
        .struk { box-shadow: none; }
    }
</style>
@endsection
