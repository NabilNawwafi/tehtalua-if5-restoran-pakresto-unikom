@extends('layouts.app')

@section('title', 'Dashboard Pelayan')

@section('content')
<div class="welcome-banner mb-4">
    <div>
        <h3 class="mb-1">Selamat datang, {{ $user->nama_pegawai }} 👋</h3>
        <p class="mb-0 opacity-75">Semoga hari kerjamu lancar. Berikut ringkasan restoran saat ini.</p>
    </div>
    <i class="bi bi-person-badge banner-icon"></i>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-3 col-sm-6">
        <div class="stat-card">
            <div class="stat-icon bg-success bg-opacity-10 text-success"><i class="bi bi-check-circle"></i></div>
            <div>
                <div class="stat-number">{{ $mejaTersedia }}</div>
                <div class="stat-label">Meja Tersedia</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="stat-card">
            <div class="stat-icon bg-danger bg-opacity-10 text-danger"><i class="bi bi-table"></i></div>
            <div>
                <div class="stat-number">{{ $mejaTerisi }}</div>
                <div class="stat-label">Meja Terisi</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="stat-card">
            <div class="stat-icon bg-warning bg-opacity-10 text-warning"><i class="bi bi-hourglass-split"></i></div>
            <div>
                <div class="stat-number">{{ $pesananAktif }}</div>
                <div class="stat-label">Pesanan Aktif</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="stat-card">
            <div class="stat-icon bg-primary bg-opacity-10 text-primary"><i class="bi bi-truck"></i></div>
            <div>
                <div class="stat-number">{{ $jumlahSiapDisajikan }}</div>
                <div class="stat-label">Siap Disajikan</div>
            </div>
        </div>
    </div>
</div>

<h5 class="mb-3">Menu Kerja</h5>
<div class="row g-3">
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-table me-2"></i>Modul Meja</h5>
                <p class="card-text small text-muted">Penempatan meja pelanggan (Pro-1).</p>
                <a href="{{ route('pelayan.meja.index') }}" class="btn btn-primary btn-sm">Buka Modul</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-cart-plus me-2"></i>Modul Pemesanan</h5>
                <p class="card-text small text-muted">Pemesanan menu (Pro-2).</p>
                <a href="{{ route('pelayan.pesanan.index') }}" class="btn btn-primary btn-sm">Buka Modul</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100 position-relative">
            @if ($jumlahSiapDisajikan > 0)
                <span class="badge bg-danger position-absolute top-0 end-0 translate-middle rounded-pill">
                    {{ $jumlahSiapDisajikan }}
                </span>
            @endif
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-truck me-2"></i>Modul Penyajian</h5>
                <p class="card-text small text-muted">Konfirmasi penyajian (Pro-4).</p>
                <a href="{{ route('pelayan.penyajian.index') }}" class="btn btn-primary btn-sm">Buka Modul</a>
            </div>
        </div>
    </div>
</div>
@endsection
