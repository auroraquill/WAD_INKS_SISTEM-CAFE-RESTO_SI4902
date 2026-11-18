<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PegawaiSeeder extends Seeder
{
    public function run(): void
    {
        // Hanya isi kalau tabel masih kosong, jadi data yang sudah ada nggak dobel
        if (DB::table('pegawai')->count() > 0) {
            return;
        }

        DB::table('pegawai')->insert([
            ['id' => 1, 'nama' => 'Rora',    'jabatan' => 'Kasir',  'kontak' => '08937829812'],
            ['id' => 2, 'nama' => 'Cantika', 'jabatan' => 'Waiter', 'kontak' => '08390191292'],
            ['id' => 4, 'nama' => 'Qila',    'jabatan' => 'Waiter', 'kontak' => '082145678997'],
            ['id' => 5, 'nama' => 'Moja',    'jabatan' => 'Chef',   'kontak' => '08673289967'],
            ['id' => 8, 'nama' => 'Daaniys', 'jabatan' => 'Chef',   'kontak' => '082145667899'],
            ['id' => 9, 'nama' => 'Villa',   'jabatan' => 'Waiter', 'kontak' => '08976589556'],
            
        ]);
    }
}
