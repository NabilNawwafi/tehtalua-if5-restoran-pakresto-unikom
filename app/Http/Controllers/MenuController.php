<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

// Implementasi Pro-7 (Pengelolaan Katalog Menu): KK-04, KK-18, KK-19
class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::orderBy('kategori')->orderBy('nama_menu')->get();

        return view('koki.menu.index', compact('menus'));
    }

    public function create()
    {
        return view('koki.menu.create');
    }

    // Aliran 7.1-7.2: Koki menambahkan data menu, sistem menyimpan ke D3
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_menu' => ['required', 'string', 'max:100'],
            'kategori' => ['required', 'in:Makanan,Minuman'],
            'harga' => ['required', 'integer', 'min:0'],
            'foto_menu' => ['nullable', 'image', 'max:2048'],
            'status_ketersediaan' => ['required', 'in:Tersedia,Habis'],
        ]);

        if ($request->hasFile('foto_menu')) {
            $validated['foto_menu'] = $request->file('foto_menu')->store('menu', 'public');
        }

        Menu::create($validated);

        return redirect()->route('koki.menu.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit(Menu $menu)
    {
        return view('koki.menu.edit', compact('menu'));
    }

    // Aliran 7.1-7.2: Koki mengubah data/status menu, sistem menyimpan perubahan ke D3
    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'nama_menu' => ['required', 'string', 'max:100'],
            'kategori' => ['required', 'in:Makanan,Minuman'],
            'harga' => ['required', 'integer', 'min:0'],
            'foto_menu' => ['nullable', 'image', 'max:2048'],
            'status_ketersediaan' => ['required', 'in:Tersedia,Habis'],
        ]);

        if ($request->hasFile('foto_menu')) {
            if ($menu->foto_menu) {
                Storage::disk('public')->delete($menu->foto_menu);
            }
            $validated['foto_menu'] = $request->file('foto_menu')->store('menu', 'public');
        }

        $menu->update($validated);

        return redirect()->route('koki.menu.index')->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy(Menu $menu)
    {
        if ($menu->foto_menu) {
            Storage::disk('public')->delete($menu->foto_menu);
        }
        $menu->delete();

        return back()->with('success', 'Menu berhasil dihapus.');
    }
}
