<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use Illuminate\Http\Request;

class MejaController extends Controller
{
    // READ: tampilkan semua meja
    public function index()
    {
        $mejas = Meja::all();
        return view('meja.index', compact('mejas'));
    }

    // Tampilkan form tambah
    public function create()
    {
        return view('meja.form');
    }

    // CREATE: simpan data baru
    public function store(Request $request)
    {
        $data = $this->validasi($request);
        Meja::create($data);

        return redirect()->route('meja.index')->with('success', 'Meja berhasil ditambahkan!');
    }

    // Tampilkan form edit
    public function edit(Meja $meja)
    {
        return view('meja.form', compact('meja'));
    }

    // UPDATE: simpan perubahan
    public function update(Request $request, Meja $meja)
    {
        $data = $this->validasi($request);
        $meja->update($data);

        return redirect()->route('meja.index')->with('success', 'Meja berhasil diupdate!');
    }

    // DELETE: hapus data
    public function destroy(Meja $meja)
    {
        $meja->delete();

        return redirect()->route('meja.index')->with('success', 'Meja berhasil dihapus!');
    }

    // Validasi dipakai bareng oleh store & update
    private function validasi(Request $request)
    {
        return $request->validate([
            'nomor_meja' => 'required|string|max:20',
            'kapasitas'  => 'required|in:2,4,8',
            'zonasi'     => 'required|in:Indoor,VIP',
            'status'     => 'required|in:Tersedia,Terisi,Reserved',
        ]);
    }
}