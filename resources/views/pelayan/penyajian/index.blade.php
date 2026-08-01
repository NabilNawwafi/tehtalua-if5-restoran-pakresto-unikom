@extends('layouts.app')

@section('title', 'Modul Penyajian')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Modul Penyajian</h3>
    <a href="{{ route('pelayan.dashboard') }}" class="btn btn-outline-secondary btn-sm">&larr; Kembali ke Dashboard</a>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<p class="text-muted">Pesanan berikut sudah selesai dimasak Koki dan siap diantar ke meja.</p>

@forelse ($pesanans as $pesanan)
    <div class="card mb-3 border-info">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h5 class="card-title mb-1">Pesanan #{{ $pesanan->nomor_pesanan }} — Meja {{ $pesanan->nomor_meja }}</h5>
                    <ul class="mb-0">
                        @foreach ($pesanan->detailPesanan as $d)
                            <li>{{ $d->menu->nama_menu }} x{{ $d->jumlah_porsi }}</li>
                        @endforeach
                    </ul>
                </div>
                <span class="badge bg-info text-dark">Selesai — Siap Diantar</span>
            </div>

            <form method="POST" action="{{ route('pelayan.penyajian.sajikan', $pesanan->nomor_pesanan) }}" class="mt-3">
                @csrf
                <button type="submit" class="btn btn-primary btn-sm">Tandai Sudah Disajikan</button>
            </form>
        </div>
    </div>
@empty
    <p class="text-muted">Tidak ada pesanan yang siap disajikan saat ini.</p>
@endforelse
@endsection
