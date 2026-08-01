@extends('layouts.app')

@section('title', 'Modul Menu')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Modul Menu</h3>
    <div>
        <a href="{{ route('koki.menu.create') }}" class="btn btn-primary btn-sm">+ Tambah Menu</a>
        <a href="{{ route('koki.dashboard') }}" class="btn btn-outline-secondary btn-sm">&larr; Kembali ke Dashboard</a>
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered align-middle bg-white">
    <thead class="table-light">
        <tr>
            <th>Foto</th>
            <th>Nama Menu</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($menus as $menu)
            <tr>
                <td style="width:80px">
                    @if ($menu->foto_menu)
                        <img src="{{ asset('storage/'.$menu->foto_menu) }}" alt="{{ $menu->nama_menu }}" width="60" height="60" style="object-fit:cover;">
                    @else
                        <span class="text-muted small">Tidak ada foto</span>
                    @endif
                </td>
                <td>{{ $menu->nama_menu }}</td>
                <td>{{ $menu->kategori }}</td>
                <td>Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
                <td>
                    <span class="badge {{ $menu->status_ketersediaan === 'Tersedia' ? 'bg-success' : 'bg-secondary' }}">
                        {{ $menu->status_ketersediaan }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('koki.menu.edit', $menu->kode_menu) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                    <form action="{{ route('koki.menu.destroy', $menu->kode_menu) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus menu ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6" class="text-center text-muted">Belum ada menu.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
