@extends('layouts.app')

@section('title', 'Buat Pesanan - Meja ' . $meja->nomor_meja)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Buat Pesanan — Meja #{{ $meja->nomor_meja }}</h3>
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

@if ($menus->isEmpty())
    <div class="alert alert-warning">Belum ada menu yang tersedia. Hubungi Koki untuk menambahkan menu.</div>
@else
    <form method="POST" action="{{ route('pelayan.pesanan.store', $meja->nomor_meja) }}">
        @csrf

        @foreach ($menus->groupBy('kategori') as $kategori => $items)
            <h5 class="mt-4">{{ $kategori }}</h5>
            <table class="table table-bordered bg-white align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nama Menu</th>
                        <th style="width:150px">Harga</th>
                        <th style="width:150px">Jumlah Porsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $menu)
                        <tr>
                            <td>{{ $menu->nama_menu }}</td>
                            <td>Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
                            <td>
                                <input type="number" name="items[{{ $menu->kode_menu }}]"
                                       class="form-control form-control-sm" min="0" max="99" value="0">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach

        <button type="submit" class="btn btn-primary mt-3">Simpan Pesanan</button>
    </form>
@endif
@endsection
