<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    // READ: tampilkan semua menu
    public function index()
    {
        $menus = Menu::orderByDesc('id')->get();
        return view('menu.index', compact('menus'));
    }

    // Form tambah
    public function create()
    {
        return view('menu.form');
    }

    // CREATE: simpan data baru
    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['foto'] = $this->uploadFoto($request);
        $data['halal'] = $request->has('halal') ? 1 : 0;

        Menu::create($data);

        return redirect()->route('menu.index')->with('success', 'Menu berhasil ditambahkan!');
    }

    // Form edit
    public function edit(Menu $menu)
    {
        return view('menu.form', compact('menu'));
    }

    // UPDATE: simpan perubahan
    public function update(Request $request, Menu $menu)
    {
        $data = $this->validated($request);

        if ($request->hasFile('foto')) {
            $this->hapusFoto($menu->foto);
            $data['foto'] = $this->uploadFoto($request);
        }

        $data['halal'] = $request->has('halal') ? 1 : 0;

        $menu->update($data);

        return redirect()->route('menu.index')->with('success', 'Menu berhasil diperbarui.');
    }

    // DELETE: hapus data
    public function destroy(Menu $menu)
    {
        $this->hapusFoto($menu->foto);
        $menu->delete();

        return redirect()->route('menu.index')->with('success', 'Menu berhasil dihapus.');
    }

    // ---------- fungsi bantu ----------
    private function validated(Request $request): array
    {
        return $request->validate([
            'nama'     => 'required|string|max:100',
            'kategori' => 'required|string|max:50',
            'harga'    => 'required|numeric|min:0',
            'foto'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
    }

    private function uploadFoto(Request $request): ?string
    {
        if (!$request->hasFile('foto')) {
            return null;
        }
        $file = $request->file('foto');
        $namaBaru = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        
        // Disimpan ke public/uploads
        $file->move(public_path('uploads'), $namaBaru);
        return $namaBaru;
    }

    private function hapusFoto(?string $foto): void
    {
        if ($foto && file_exists(public_path('uploads/' . $foto))) {
            @unlink(public_path('uploads/' . $foto));
        }
    }
}