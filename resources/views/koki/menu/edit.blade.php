@extends('layouts.app')

@section('title', 'Edit Menu')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3><i class="bi bi-journal-text me-2"></i>Edit Menu</h3>
    <a href="{{ route('koki.menu.index') }}" class="btn btn-outline-secondary btn-sm">&larr; Kembali</a>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('koki.menu.update', $menu->kode_menu) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Nama Menu</label>
                <input type="text" name="nama_menu" class="form-control" value="{{ old('nama_menu', $menu->nama_menu) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="kategori" class="form-select" required>
                    <option value="Makanan" {{ old('kategori', $menu->kategori) === 'Makanan' ? 'selected' : '' }}>Makanan</option>
                    <option value="Minuman" {{ old('kategori', $menu->kategori) === 'Minuman' ? 'selected' : '' }}>Minuman</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Harga (Rp)</label>
                <input type="number" name="harga" class="form-control" value="{{ old('harga', $menu->harga) }}" min="0" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Stok Saat Ini (porsi)</label>
                <input type="number" name="stok" class="form-control" value="{{ old('stok', $menu->stok) }}" min="0" required>
                <div class="form-text">
                    Status saat ini:
                    <span class="badge {{ $menu->status_ketersediaan === 'Tersedia' ? 'bg-success' : 'bg-secondary' }}">
                        {{ $menu->status_ketersediaan }}
                    </span>
                    — ubah angka stok untuk restock atau menandai habis.
                </div>
            </div>
            @if ($menu->foto_menu)
                <div class="mb-3">
                    <label class="form-label d-block">Foto Saat Ini</label>
                    <img src="{{ asset('storage/'.$menu->foto_menu) }}" width="100" height="100" style="object-fit:cover;">
                </div>
            @endif
            <div class="mb-3">
                <label class="form-label">Ganti Foto (opsional)</label>
                <input type="file" name="foto_menu" class="form-control" accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
</div>
@endsection
