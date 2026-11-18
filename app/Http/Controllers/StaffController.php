<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        $pegawai = Staff::orderBy('id', 'desc')->get();
        return view('staff.index', compact('pegawai'));
    }

    // Hak akses Pegawai: hanya lihat profil sendiri
    public function profil()
    {
        $staff = Staff::find(auth()->user()->pegawai_id);
        return view('staff.profil', compact('staff'));
    }

    public function create()
    {
        return view('staff.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'     => 'required|string|max:100',
            'jabatan'  => 'required|string|max:50',
            'kontak'   => 'required|string|max:20',
            'email'    => 'nullable|email|unique:users,email',
            'password' => 'nullable|required_with:email|min:6',
        ]);

        DB::transaction(function () use ($data) {
            $staff = Staff::create([
                'nama'    => $data['nama'],
                'jabatan' => $data['jabatan'],
                'kontak'  => $data['kontak'],
            ]);

            // Kalau email diisi, sekalian bikin akun login role pegawai
            if (!empty($data['email'])) {
                User::create([
                    'name'       => $data['nama'],
                    'email'      => $data['email'],
                    'password'   => bcrypt($data['password']),
                    'role'       => 'pegawai',
                    'pegawai_id' => $staff->id,
                ]);
            }
        });

        // Diarahkan langsung ke index agar data terlihat di tabel
        return redirect()->route('staff.index')
            ->with('success', 'Pegawai ' . $data['nama'] . ' berhasil ditambahkan.');
    }

    public function destroy(Staff $staff)
    {
        // Akun login pegawai ikut dihapus
        User::where('pegawai_id', $staff->id)->delete();
        $staff->delete();
        
        return redirect()->route('staff.index')
            ->with('success', 'Data pegawai berhasil dihapus.');
    }
}