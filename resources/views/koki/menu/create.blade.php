@extends('layouts.app')

@section('title', 'Tambah Menu')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3><i class="bi bi-journal-plus me-2"></i>Tambah Menu</h3>
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
        <form method="POST" action="{{ route('koki.menu.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nama Menu</label>
                <input type="text" name="nama_menu" class="form-control" value="{{ old('nama_menu') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="kategori" class="form-select" required>
                    <option value="">-- Pilih Kategori --</option>
                    <option value="Makanan" {{ old('kategori') === 'Makanan' ? 'selected' : '' }}>Makanan</option>
                    <option value="Minuman" {{ old('kategori') === 'Minuman' ? 'selected' : '' }}>Minuman</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Harga (Rp)</label>
                <input type="number" name="harga" class="form-control" value="{{ old('harga') }}" min="0" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Stok Awal (porsi)</label>
                <input type="number" name="stok" class="form-control" value="{{ old('stok', 0) }}" min="0" required>
                <div class="form-text">Status ketersediaan otomatis mengikuti nilai stok (stok 0 = Habis).</div>
            </div>
            <div class="mb-3">
                <label class="form-label">Foto Menu (opsional)</label>
                <input type="file" name="foto_menu" class="form-control" accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary">Simpan Menu</button>
        </form>
    </div>
</div>
@endsection
