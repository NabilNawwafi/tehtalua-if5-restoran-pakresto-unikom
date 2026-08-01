@extends('layouts.app')

@section('title', 'Modul Meja')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Modul Meja</h3>
    <a href="{{ route('pelayan.dashboard') }}" class="btn btn-outline-secondary btn-sm">&larr; Kembali ke Dashboard</a>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="row g-3">
    @foreach ($mejas as $meja)
        <div class="col-md-3 col-sm-6">
            <div class="card h-100 {{ $meja->status_meja === 'Tersedia' ? 'border-success' : 'border-danger' }}">
                <div class="card-body text-center">
                    <h5 class="card-title">Meja #{{ $meja->nomor_meja }}</h5>
                    <p class="card-text text-muted mb-2">Kapasitas: {{ $meja->kapasitas_meja }} orang</p>

                    @if ($meja->status_meja === 'Tersedia')
                        <span class="badge bg-success mb-3">Tersedia</span><br>
                        <form method="POST" action="{{ route('pelayan.meja.pilih', $meja->nomor_meja) }}">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm">Pilih Meja Ini</button>
                        </form>
                    @else
                        <span class="badge bg-danger mb-2">Terisi</span>
                        <p class="small text-muted mb-0">
                            Sejak: {{ \Carbon\Carbon::parse($meja->waktu_checkin)->format('d/m/Y H:i') }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
