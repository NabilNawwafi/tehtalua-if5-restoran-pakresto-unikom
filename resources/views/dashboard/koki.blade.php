@extends('layouts.app')

@section('title', 'Dashboard Koki')

@section('content')
<h3>Selamat datang, {{ $user->nama_pegawai }} 👋</h3>
<p class="text-muted">Dashboard Koki.</p>

<div class="row g-3 mt-2">
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
