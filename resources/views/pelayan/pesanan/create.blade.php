@extends('layouts.app')

@section('title', 'Buat Pesanan - Meja ' . $meja->nomor_meja)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3><i class="bi bi-cart-plus me-2"></i>Buat Pesanan — Meja #{{ $meja->nomor_meja }}</h3>
    <a href="{{ route('pelayan.pesanan.index') }}" class="btn btn-outline-secondary btn-sm">&larr; Kembali</a>
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
@if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

@if ($menus->isEmpty())
    <div class="alert alert-warning">Belum ada menu yang tersedia (stok kosong). Hubungi Koki untuk restock.</div>
@else
    <form method="POST" action="{{ route('pelayan.pesanan.store', $meja->nomor_meja) }}" id="formPesanan">
        @csrf

        @foreach ($menus->groupBy('kategori') as $kategori => $items)
            <div class="kategori-section mb-4">
                <h5 class="kategori-title">
                    <i class="bi {{ $kategori === 'Makanan' ? 'bi-egg-fried' : 'bi-cup-straw' }} me-2"></i>{{ $kategori }}
                </h5>
                <div class="row g-3">
                    @foreach ($items as $menu)
                        <div class="col-md-4 col-sm-6">
                            <div class="card h-100 kartu-menu">
                                <div class="kartu-menu-foto">
                                    @if ($menu->foto_menu)
                                        <img src="{{ asset('storage/'.$menu->foto_menu) }}" alt="{{ $menu->nama_menu }}">
                                    @else
                                        <div class="kartu-menu-foto-kosong"><i class="bi bi-image"></i></div>
                                    @endif
                                    <span class="badge kartu-menu-stok">{{ $menu->stok }} porsi</span>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h6 class="card-title mb-1">{{ $menu->nama_menu }}</h6>
                                    <p class="text-primary fw-bold mb-2">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>

                                    <div class="mt-auto">
                                        <label class="form-label small text-muted mb-1">Jumlah Porsi</label>
                                        <input type="number" name="items[{{ $menu->kode_menu }}]"
                                               class="form-control form-control-sm input-qty mb-2"
                                               data-harga="{{ $menu->harga }}"
                                               min="0" max="{{ $menu->stok }}" value="0">
                                        <div class="text-end small text-muted">
                                            Subtotal: <span class="subtotal-cell fw-semibold text-dark">Rp 0</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        <div class="card mt-2 mb-3 border-primary">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Total Pesanan</h5>
                <h4 class="mb-0 text-primary" id="totalPesanan">Rp 0</h4>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Pesanan</button>
    </form>
@endif

<style>
    .kategori-title {
        border-bottom: 2px solid var(--brand-accent);
        padding-bottom: 8px;
        margin-bottom: 16px;
    }
    .kartu-menu-foto {
        position: relative;
        height: 130px;
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
        font-size: 2rem;
        color: #c9bdae;
    }
    .kartu-menu-stok {
        position: absolute;
        top: 8px;
        right: 8px;
        background: rgba(0,0,0,0.55);
    }
</style>

<script>
function formatRupiah(angka) {
    return 'Rp ' + angka.toLocaleString('id-ID');
}
function hitungUlangTotal() {
    let total = 0;
    document.querySelectorAll('.input-qty').forEach(function (input) {
        const harga = parseInt(input.dataset.harga, 10) || 0;
        const jumlah = parseInt(input.value, 10) || 0;
        const subtotal = harga * jumlah;
        total += subtotal;
        input.closest('.card-body').querySelector('.subtotal-cell').textContent = formatRupiah(subtotal);
    });
    document.getElementById('totalPesanan').textContent = formatRupiah(total);
}
document.querySelectorAll('.input-qty').forEach(function (input) {
    input.addEventListener('input', hitungUlangTotal);
});
</script>
@endsection
