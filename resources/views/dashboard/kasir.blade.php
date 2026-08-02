@extends('layouts.app')

@section('title', 'Dashboard Kasir')

@section('content')
<div class="welcome-banner mb-4">
    <div>
        <h3 class="mb-1">Selamat datang, {{ $user->nama_pegawai }} 👋</h3>
        <p class="mb-0 opacity-75">Semoga hari kerjamu lancar. Berikut ringkasan kasir hari ini.</p>
    </div>
    <i class="bi bi-cash-coin banner-icon"></i>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-4 col-sm-6">
        <div class="stat-card">
            <div class="stat-icon bg-primary bg-opacity-10 text-primary"><i class="bi bi-graph-up-arrow"></i></div>
            <div>
                <div class="stat-number">Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}</div>
                <div class="stat-label">Pendapatan Hari Ini</div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="stat-card">
            <div class="stat-icon bg-success bg-opacity-10 text-success"><i class="bi bi-receipt"></i></div>
            <div>
                <div class="stat-number">{{ $transaksiHariIni }}</div>
                <div class="stat-label">Transaksi Hari Ini</div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="stat-card">
            <div class="stat-icon bg-warning bg-opacity-10 text-warning"><i class="bi bi-hourglass-split"></i></div>
            <div>
                <div class="stat-number">{{ $jumlahBelumBayar }}</div>
                <div class="stat-label">Belum Dibayar</div>
            </div>
        </div>
    </div>
</div>

<h5 class="mb-3">Menu Kerja</h5>
<div class="row g-3">
    <div class="col-md-4">
        <div class="card h-100 position-relative">
            @if ($jumlahBelumBayar > 0)
                <span class="badge bg-danger position-absolute top-0 end-0 translate-middle rounded-pill">
                    {{ $jumlahBelumBayar }}
                </span>
            @endif
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-cash-coin me-2"></i>Modul Pembayaran</h5>
                <p class="card-text small text-muted">Pembayaran &amp; cetak nota (Pro-5).</p>
                <a href="{{ route('kasir.pembayaran.index') }}" class="btn btn-primary btn-sm">Buka Modul</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-bar-chart-line me-2"></i>Modul Laporan Pendapatan</h5>
                <p class="card-text small text-muted">Laporan pendapatan (Pro-6).</p>
                <a href="{{ route('kasir.laporan.index') }}" class="btn btn-primary btn-sm">Buka Modul</a>
            </div>
        </div>
    </div>
</div>
@endsection
