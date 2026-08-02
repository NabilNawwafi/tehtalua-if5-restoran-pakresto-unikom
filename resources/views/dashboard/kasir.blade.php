@extends('layouts.app')

@section('title', 'Dashboard Kasir')

@section('content')
<h3>Selamat datang, {{ $user->nama_pegawai }} 👋</h3>
<p class="text-muted">Dashboard Kasir.</p>

<div class="row g-3 mt-2">
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
