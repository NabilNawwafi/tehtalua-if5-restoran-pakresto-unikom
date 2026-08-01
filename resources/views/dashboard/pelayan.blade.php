@extends('layouts.app')

@section('title', 'Dashboard Pelayan')

@section('content')
<h3>Selamat datang, {{ $user->nama_pegawai }}</h3>
<p class="text-muted">Dashboard Pelayan — Modul Meja &amp; Pemesanan akan ditambahkan di sini (Hari 2-3).</p>

<div class="alert alert-info">
    Modul yang akan dibangun di sini: Penempatan Meja (Pro-1), Pemesanan Menu (Pro-2), Penyajian (Pro-4).
</div>
@endsection
