@extends('layouts.app')

@section('title', 'Dashboard Koki')

@section('content')
<div class="welcome-banner mb-4">
    <div>
        <h3 class="mb-1">Selamat datang, {{ $user->nama_pegawai }} 👋</h3>
        <p class="mb-0 opacity-75">Semoga hari kerjamu lancar. Berikut ringkasan dapur saat ini.</p>
    </div>
    <i class="bi bi-egg-fried banner-icon"></i>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-4 col-sm-6">
        <div class="stat-card">
            <div class="stat-icon bg-warning bg-opacity-10 text-warning"><i class="bi bi-hourglass-split"></i></div>
            <div>
                <div class="stat-number">{{ $jumlahMenunggu }}</div>
                <div class="stat-label">Pesanan Menunggu</div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="stat-card">
            <div class="stat-icon bg-success bg-opacity-10 text-success"><i class="bi bi-check-circle"></i></div>
            <div>
                <div class="stat-number">{{ $menuTersedia }}</div>
                <div class="stat-label">Menu Tersedia</div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="stat-card">
            <div class="stat-icon bg-secondary bg-opacity-10 text-secondary"><i class="bi bi-x-circle"></i></div>
            <div>
                <div class="stat-number">{{ $menuHabis }}</div>
                <div class="stat-label">Menu Habis</div>
            </div>
        </div>
    </div>
</div>

<h5 class="mb-3">Menu Kerja</h5>
<div class="row g-3">
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-journal-text me-2"></i>Modul Menu</h5>
                <p class="card-text small text-muted">Pengelolaan katalog menu (Pro-7).</p>
                <a href="{{ route('koki.menu.index') }}" class="btn btn-primary btn-sm">Buka Modul</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100 position-relative">
            @if ($jumlahMenunggu > 0)
                <span class="badge bg-danger position-absolute top-0 end-0 translate-middle rounded-pill">
                    {{ $jumlahMenunggu }}
                </span>
            @endif
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-fire me-2"></i>Modul Pemrosesan Pesanan</h5>
                <p class="card-text small text-muted">Pemrosesan pesanan (Pro-3).</p>
                <a href="{{ route('koki.pemrosesan.index') }}" class="btn btn-primary btn-sm">Buka Modul</a>
            </div>
        </div>
    </div>
</div>
@endsection
