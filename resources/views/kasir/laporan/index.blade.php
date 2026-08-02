@extends('layouts.app')

@section('title', 'Modul Laporan Pendapatan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3><i class="bi bi-bar-chart-line me-2"></i>Modul Laporan Pendapatan</h3>
    <a href="{{ route('kasir.dashboard') }}" class="btn btn-outline-secondary btn-sm">&larr; Kembali ke Dashboard</a>
</div>

@if ($errors->any())
    <div class="alert alert-danger">{{ $errors->first() }}</div>
@endif

<div class="card mb-4">
    <div class="card-body">
        <h5 class="card-title">Buat Laporan Baru</h5>
        <form method="POST" action="{{ route('kasir.laporan.generate') }}" class="row g-3 align-items-end">
            @csrf
            <div class="col-md-4">
                <label class="form-label">Periode</label>
                <select name="periode" class="form-select" required>
                    <option value="Harian">Harian</option>
                    <option value="Mingguan">Mingguan</option>
                    <option value="Bulanan">Bulanan</option>
                    <option value="Tahunan">Tahunan</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Tanggal Acuan</label>
                <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
                <div class="form-text">Sistem otomatis menghitung rentang periode dari tanggal ini.</div>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-file-earmark-bar-graph me-1"></i>Buat Laporan</button>
            </div>
        </form>
    </div>
</div>

<h5>Riwayat Laporan</h5>
<table class="table table-bordered bg-white align-middle">
    <thead class="table-light">
        <tr>
            <th>Kode</th>
            <th>Periode</th>
            <th>Tanggal Acuan</th>
            <th>Total Pendapatan</th>
            <th>Dibuat Oleh</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($laporans as $laporan)
            <tr>
                <td>#{{ $laporan->kode_laporan }}</td>
                <td><span class="badge bg-secondary">{{ $laporan->periode }}</span></td>
                <td>{{ \Carbon\Carbon::parse($laporan->tanggal_dibuat)->format('d/m/Y') }}</td>
                <td>Rp {{ number_format($laporan->total_pendapatan, 0, ',', '.') }}</td>
                <td>{{ $laporan->kasir->nama_pegawai }}</td>
                <td>
                    <a href="{{ route('kasir.laporan.show', $laporan->kode_laporan) }}" class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-eye"></i> Lihat
                    </a>
                </td>
            </tr>
        @empty
            <tr><td colspan="6" class="text-center text-muted">Belum ada laporan yang dibuat.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
