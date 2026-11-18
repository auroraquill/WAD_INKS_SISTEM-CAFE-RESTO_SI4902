<?php

namespace Database\Seeders;

use App\Models\Staff;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(PegawaiSeeder::class);

        // Akun admin
        User::updateOrCreate(['email' => 'admin@resto.test'], [
            'name'     => 'Admin',
            'password' => 'admin123',
            'role'     => 'admin',
        ]);

        // Akun semua pegawai (id pegawai => email)
        $akunPegawai = [
            1 => 'rora@resto.test',
            2 => 'cantika@resto.test',
            4 => 'qila@resto.test',
            5 => 'moja@resto.test',
            8 => 'daaniys@resto.test',
            9 => 'villa@resto.test',
        ];

        foreach ($akunPegawai as $id => $email) {
            $p = Staff::find($id);
            if (! $p) {
                continue;
            }

            User::updateOrCreate(['email' => $email], [
                'name'       => $p->nama,
                'password'   => 'pegawai123',
                'role'       => 'pegawai',
                'pegawai_id' => $p->id,
            ]);
        }

        // Hapus akun Rora yang lama biar nggak dobel
        User::where('email', 'pegawai@resto.test')->delete();
    }
}