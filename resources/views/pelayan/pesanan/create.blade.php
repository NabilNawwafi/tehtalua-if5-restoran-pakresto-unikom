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
            <h5 class="mt-4">{{ $kategori }}</h5>
            <table class="table table-bordered bg-white align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nama Menu</th>
                        <th style="width:150px">Harga</th>
                        <th style="width:100px">Sisa Stok</th>
                        <th style="width:130px">Jumlah Porsi</th>
                        <th style="width:150px" class="text-end">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $menu)
                        <tr>
                            <td>{{ $menu->nama_menu }}</td>
                            <td>Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
                            <td><span class="badge bg-light text-dark border">{{ $menu->stok }} porsi</span></td>
                            <td>
                                <input type="number" name="items[{{ $menu->kode_menu }}]"
                                       class="form-control form-control-sm input-qty"
                                       data-harga="{{ $menu->harga }}"
                                       min="0" max="{{ $menu->stok }}" value="0">
                            </td>
                            <td class="text-end subtotal-cell">Rp 0</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach

        <div class="card mt-3">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Total Pesanan</h5>
                <h4 class="mb-0 text-primary" id="totalPesanan">Rp 0</h4>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Simpan Pesanan</button>
    </form>
@endif

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

        const cellSubtotal = input.closest('tr').querySelector('.subtotal-cell');
        cellSubtotal.textContent = formatRupiah(subtotal);
    });
    document.getElementById('totalPesanan').textContent = formatRupiah(total);
}

document.querySelectorAll('.input-qty').forEach(function (input) {
    input.addEventListener('input', hitungUlangTotal);
});
</script>
@endsection
