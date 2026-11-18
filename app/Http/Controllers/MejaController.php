<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use Illuminate\Http\Request;

class MejaController extends Controller
{
    public function index()
    {
        $mejas = Meja::orderByDesc('id')->get();
        return view('meja.index', compact('mejas'));
    }

    public function create()
    {
        return view('meja.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_meja' => 'required|string|max:50',
            'kapasitas'  => 'required|integer|min:1',
            'status'     => 'required|string',
        ]);

        Meja::create($request->all());

        return redirect()->route('meja.index')->with('success', 'Meja berhasil ditambahkan!');
    }

    public function edit(Meja $meja)
    {
        return view('meja.form', compact('meja'));
    }

    public function update(Request $request, Meja $meja)
    {
        $request->validate([
            'nomor_meja' => 'required|string|max:50',
            'kapasitas'  => 'required|integer|min:1',
            'status'     => 'required|string',
        ]);

        $meja->update($request->all());

        return redirect()->route('meja.index')->with('success', 'Meja berhasil diperbarui.');
    }

    public function destroy(Meja $meja)
    {
        $meja->delete();
        return redirect()->route('meja.index')->with('success', 'Meja berhasil dihapus.');
    }
}