@extends('layouts.app')

@section('title', 'Dashboard Kasir')

@section('content')
<h3>Selamat datang, {{ $user->nama_pegawai }}</h3>
<p class="text-muted">Dashboard Kasir — Modul Pembayaran &amp; Laporan akan ditambahkan di sini (Hari 5-6).</p>

<div class="alert alert-info">
    Modul yang akan dibangun di sini: Pembayaran &amp; Cetak Nota (Pro-5), Pelaporan Pendapatan (Pro-6).
</div>
@endsection
