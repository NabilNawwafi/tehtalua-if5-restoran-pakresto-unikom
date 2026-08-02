@extends('layouts.app')

@section('title', 'Modul Menu')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3><i class="bi bi-journal-text me-2"></i>Modul Menu</h3>
    <div>
        <a href="{{ route('koki.menu.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg me-1"></i>Tambah Menu</a>
        <a href="{{ route('koki.dashboard') }}" class="btn btn-outline-secondary btn-sm">&larr; Kembali ke Dashboard</a>
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="mb-4">
    <input type="text" id="cariMenu" class="form-control" placeholder="🔍 Cari nama menu...">
</div>

<div class="row g-4" id="galeriMenu">
    @forelse ($menus as $menu)
        <div class="col-md-4 col-sm-6 kartu-menu-wrapper">
            <div class="card h-100 kartu-menu">
                <div class="kartu-menu-foto">
                    @if ($menu->foto_menu)
                        <img src="{{ asset('storage/'.$menu->foto_menu) }}" alt="{{ $menu->nama_menu }}">
                    @else
                        <div class="kartu-menu-foto-kosong"><i class="bi bi-image"></i></div>
                    @endif
                    <span class="badge kartu-menu-kategori">{{ $menu->kategori }}</span>
                    <span class="badge kartu-menu-status {{ $menu->status_ketersediaan === 'Tersedia' ? 'bg-success' : 'bg-secondary' }}">
                        {{ $menu->status_ketersediaan }}
                    </span>
                </div>
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title mb-1 nama-menu">{{ $menu->nama_menu }}</h5>
                    <p class="text-primary fw-bold mb-2">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>
                    <p class="mb-3">
                        <span class="badge {{ $menu->stok <= 3 && $menu->stok > 0 ? 'bg-warning text-dark' : ($menu->stok == 0 ? 'bg-secondary' : 'bg-light text-dark border') }}">
                            <i class="bi bi-box-seam me-1"></i>Stok: {{ $menu->stok }} porsi
                        </span>
                    </p>
                    <div class="mt-auto d-flex gap-2">
                        <a href="{{ route('koki.menu.edit', $menu->kode_menu) }}" class="btn btn-sm btn-outline-primary flex-fill">
                            <i class="bi bi-pencil me-1"></i>Edit
                        </a>
                        <form action="{{ route('koki.menu.destroy', $menu->kode_menu) }}" method="POST" onsubmit="return confirm('Hapus menu ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <p class="text-center text-muted py-5"><i class="bi bi-journal-x fs-1 d-block mb-2"></i>Belum ada menu.</p>
        </div>
    @endforelse
</div>

<style>
    .kartu-menu-foto {
        position: relative;
        height: 160px;
        overflow: hidden;
        border-radius: 0.375rem 0.375rem 0 0;
        background: #f0ebe4;
    }
    .kartu-menu-foto img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .kartu-menu-foto-kosong {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        color: #c9bdae;
    }
    .kartu-menu-kategori {
        position: absolute;
        top: 8px;
        left: 8px;
        background: rgba(0,0,0,0.55);
    }
    .kartu-menu-status {
        position: absolute;
        top: 8px;
        right: 8px;
    }
    .nama-menu {
        min-height: 48px;
    }
</style>

<script>
document.getElementById('cariMenu').addEventListener('input', function () {
    const kata = this.value.toLowerCase();
    document.querySelectorAll('.kartu-menu-wrapper').forEach(function (kartu) {
        const nama = kartu.querySelector('.nama-menu').textContent.toLowerCase();
        kartu.style.display = nama.includes(kata) ? '' : 'none';
    });
});
</script>
@endsection
