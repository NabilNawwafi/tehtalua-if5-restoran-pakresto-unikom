@extends('layouts.app')

@section('title', 'Dashboard Pelayan')

@section('content')
<h3>Selamat datang, {{ $user->nama_pegawai }}</h3>
<p class="text-muted">Dashboard Pelayan.</p>

<div class="row g-3 mt-2">
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">Modul Meja</h5>
                <p class="card-text small text-muted">Penempatan meja pelanggan (Pro-1).</p>
                <a href="{{ route('pelayan.meja.index') }}" class="btn btn-primary btn-sm">Buka Modul</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">Modul Pemesanan</h5>
                <p class="card-text small text-muted">Pemesanan menu (Pro-2).</p>
                <a href="{{ route('pelayan.pesanan.index') }}" class="btn btn-primary btn-sm">Buka Modul</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">Modul Penyajian</h5>
                <p class="card-text small text-muted">Konfirmasi penyajian (Pro-4).</p>
                <a href="{{ route('pelayan.penyajian.index') }}" class="btn btn-primary btn-sm">Buka Modul</a>
            </div>
        </div>
    </div>
</div>
@endsection