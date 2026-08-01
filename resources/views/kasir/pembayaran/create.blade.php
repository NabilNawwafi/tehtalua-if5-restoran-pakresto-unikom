@extends('layouts.app')

@section('title', 'Proses Pembayaran')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Proses Pembayaran — Pesanan #{{ $pesanan->nomor_pesanan }}</h3>
    <a href="{{ route('kasir.pembayaran.index') }}" class="btn btn-outline-secondary btn-sm">&larr; Kembali</a>
</div>

@if ($errors->any())
    <div class="alert alert-danger">{{ $errors->first() }}</div>
@endif
@if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="row">
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Rincian Pesanan — Meja {{ $pesanan->nomor_meja }}</h5>
                <table class="table table-sm">
                    <thead>
                        <tr><th>Menu</th><th>Qty</th><th class="text-end">Subtotal</th></tr>
                    </thead>
                    <tbody>
                        @foreach ($pesanan->detailPesanan as $d)
                            <tr>
                                <td>{{ $d->menu->nama_menu }}</td>
                                <td>{{ $d->jumlah_porsi }}</td>
                                <td class="text-end">Rp {{ number_format($d->subtotal, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="fw-bold">
                            <td colspan="2">Total Tagihan</td>
                            <td class="text-end">Rp {{ number_format($totalTagihan, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Input Pembayaran</h5>
                <form method="POST" action="{{ route('kasir.pembayaran.store', $pesanan->nomor_pesanan) }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Jumlah Dibayar (Rp)</label>
                        <input type="number" name="jumlah_dibayar" class="form-control" min="{{ $totalTagihan }}"
                               value="{{ old('jumlah_dibayar', $totalTagihan) }}" required>
                        <div class="form-text">Minimal Rp {{ number_format($totalTagihan, 0, ',', '.') }}</div>
                    </div>
                    <button type="submit" class="btn btn-primary">Bayar &amp; Cetak Nota</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
