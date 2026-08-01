@extends('layouts.app')

@section('title', 'Dashboard Koki')

@section('content')
<h3>Selamat datang, {{ $user->nama_pegawai }}</h3>
<p class="text-muted">Dashboard Koki — Modul Menu &amp; Pemrosesan Pesanan akan ditambahkan di sini (Hari 2 &amp; 4).</p>

<div class="alert alert-info">
    Modul yang akan dibangun di sini: Pengelolaan Katalog Menu (Pro-7), Pemrosesan Pesanan (Pro-3).
</div>
@endsection
