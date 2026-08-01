@extends('layouts.app')

@section('title', 'Dashboard Kasir')

@section('content')
<h3>Selamat datang, {{ $user->nama_pegawai }}</h3>
<p class="text-muted">Dashboard Kasir.</p>

<div class="row g-3 mt-2">
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">Modul Pembayaran</h5>
                <p class="card-text small text-muted">Pembayaran &amp; cetak nota (Pro-5).</p>
                <a href="{{ route('kasir.pembayaran.index') }}" class="btn btn-primary btn-sm">Buka Modul</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">Modul Laporan Pendapatan</h5>
                <p class="card-text small text-muted">Laporan pendapatan (Pro-6) — akan ditambahkan Hari 6.</p>
                <button class="btn btn-secondary btn-sm" disabled>Segera Hadir</button>
            </div>
        </div>
    </div>
</div>
@endsection