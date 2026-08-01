@extends('layouts.app')

@section('title', 'Modul Pembayaran')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Modul Pembayaran</h3>
    <a href="{{ route('kasir.dashboard') }}" class="btn btn-outline-secondary btn-sm">&larr; Kembali ke Dashboard</a>
</div>

@if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<p class="text-muted">Pesanan berikut sudah disajikan dan siap dibayar.</p>

<table class="table table-bordered bg-white align-middle">
    <thead class="table-light">
        <tr>
            <th>No. Pesanan</th>
            <th>Meja</th>
            <th>Item</th>
            <th>Total Tagihan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($pesanans as $pesanan)
            <tr>
                <td>#{{ $pesanan->nomor_pesanan }}</td>
                <td>Meja {{ $pesanan->nomor_meja }}</td>
                <td>
                    <ul class="mb-0 ps-3 small">
                        @foreach ($pesanan->detailPesanan as $d)
                            <li>{{ $d->menu->nama_menu }} x{{ $d->jumlah_porsi }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>Rp {{ number_format($pesanan->detailPesanan->sum('subtotal'), 0, ',', '.') }}</td>
                <td>
                    <a href="{{ route('kasir.pembayaran.create', $pesanan->nomor_pesanan) }}" class="btn btn-primary btn-sm">
                        Proses Pembayaran
                    </a>
                </td>
            </tr>
        @empty
            <tr><td colspan="5" class="text-center text-muted">Tidak ada pesanan yang siap dibayar.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
