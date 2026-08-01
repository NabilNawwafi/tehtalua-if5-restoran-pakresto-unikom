@extends('layouts.app')

@section('title', 'Modul Pemesanan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Modul Pemesanan</h3>
    <a href="{{ route('pelayan.dashboard') }}" class="btn btn-outline-secondary btn-sm">&larr; Kembali ke Dashboard</a>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<h5 class="mt-4">Meja Terisi — Buat Pesanan Baru</h5>
@if ($mejaTerisi->isEmpty())
    <p class="text-muted">Belum ada meja yang terisi. Tempatkan meja dulu di Modul Meja.</p>
@else
    <div class="row g-3 mb-4">
        @foreach ($mejaTerisi as $meja)
            <div class="col-md-3 col-sm-6">
                <div class="card h-100 border-warning">
                    <div class="card-body text-center">
                        <h5 class="card-title">Meja #{{ $meja->nomor_meja }}</h5>
                        <p class="card-text text-muted mb-2">Kapasitas: {{ $meja->kapasitas_meja }} orang</p>
                        <a href="{{ route('pelayan.pesanan.create', $meja->nomor_meja) }}" class="btn btn-primary btn-sm">
                            Buat Pesanan
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif

<h5 class="mt-4">Pesanan Aktif</h5>
<table class="table table-bordered bg-white align-middle">
    <thead class="table-light">
        <tr>
            <th>No. Pesanan</th>
            <th>Meja</th>
            <th>Item</th>
            <th>Total</th>
            <th>Status</th>
            <th>Waktu Pesan</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($pesananAktif as $pesanan)
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
                    @php
                        $badge = match($pesanan->status_pesanan) {
                            'Diproses' => 'bg-warning text-dark',
                            'Bahan Habis' => 'bg-danger',
                            'Selesai' => 'bg-info text-dark',
                            default => 'bg-secondary',
                        };
                    @endphp
                    <span class="badge {{ $badge }}">{{ $pesanan->status_pesanan }}</span>
                </td>
                <td>{{ \Carbon\Carbon::parse($pesanan->waktu_pesan)->format('d/m/Y H:i') }}</td>
            </tr>
        @empty
            <tr><td colspan="6" class="text-center text-muted">Belum ada pesanan aktif.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
