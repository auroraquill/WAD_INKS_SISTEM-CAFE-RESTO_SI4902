<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;

class StaffEditController
{
    public function edit(Staff $staff)
    {
        return view('staff.edit', compact('staff'));
    }

    public function update(Request $request, Staff $staff)
    {
        $data = $request->validate([
            'nama'    => 'required|string|max:100',
            'jabatan' => 'required|in:Chef,Waiter,Kasir',
            'kontak'  => 'required|string|max:20',
        ]);

        $staff->update($data);

        // nama di akun login ikut disamakan
        User::where('pegawai_id', $staff->id)->update(['name' => $data['nama']]);
        return redirect()->route('staff.index');
    }
}