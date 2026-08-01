@extends('layouts.app')

@section('title', 'Dashboard Koki')

@section('content')
<h3>Selamat datang, {{ $user->nama_pegawai }}</h3>
<p class="text-muted">Dashboard Koki.</p>

<div class="row g-3 mt-2">
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">Modul Menu</h5>
                <p class="card-text small text-muted">Pengelolaan katalog menu (Pro-7).</p>
                <a href="{{ route('koki.menu.index') }}" class="btn btn-primary btn-sm">Buka Modul</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">Modul Pemrosesan Pesanan</h5>
                <p class="card-text small text-muted">Pemrosesan pesanan (Pro-3) — akan ditambahkan Hari 4.</p>
                <button class="btn btn-secondary btn-sm" disabled>Segera Hadir</button>
            </div>
        </div>
    </div>
</div>
@endsection