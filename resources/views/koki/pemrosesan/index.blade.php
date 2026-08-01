@extends('layouts.app')

@section('title', 'Modul Pemrosesan Pesanan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Modul Pemrosesan Pesanan</h3>
    <a href="{{ route('koki.dashboard') }}" class="btn btn-outline-secondary btn-sm">&larr; Kembali ke Dashboard</a>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<p class="text-muted">Daftar pesanan diurutkan FIFO (yang masuk lebih dulu diproses lebih dulu).</p>

@forelse ($pesanans as $pesanan)
    <div class="card mb-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h5 class="card-title mb-1">Pesanan #{{ $pesanan->nomor_pesanan }} — Meja {{ $pesanan->nomor_meja }}</h5>
                    <p class="text-muted small mb-2">
                        Dipesan: {{ \Carbon\Carbon::parse($pesanan->waktu_pesan)->format('d/m/Y H:i') }}
                    </p>
                    <table class="table table-sm mb-3">
                        <thead>
                            <tr><th>Menu</th><th>Jumlah</th><th style="width:160px">Aksi</th></tr>
                        </thead>
                        <tbody>
                            @foreach ($pesanan->detailPesanan as $d)
                                <tr>
                                    <td>{{ $d->menu->nama_menu }}</td>
                                    <td>x{{ $d->jumlah_porsi }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('koki.pemrosesan.bahanHabis', [$pesanan->nomor_pesanan, $d->menu->kode_menu]) }}"
                                              onsubmit="return confirm('Tandai {{ $d->menu->nama_menu }} habis?');">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger btn-sm">Tandai Habis</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <span class="badge bg-warning text-dark">Diproses</span>
            </div>

            <form method="POST" action="{{ route('koki.pemrosesan.selesai', $pesanan->nomor_pesanan) }}" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-success btn-sm">Tandai Selesai Dimasak</button>
            </form>
        </div>
    </div>
@empty
    <p class="text-muted">Tidak ada pesanan yang perlu diproses saat ini.</p>
@endforelse
@endsection
