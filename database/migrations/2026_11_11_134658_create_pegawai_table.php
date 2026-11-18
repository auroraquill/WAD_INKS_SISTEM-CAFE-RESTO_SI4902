<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    // kalau tabel sudah ada (dari import SQL), dilewati
    if (Schema::hasTable('pegawai')) {
        return;
    }

    Schema::create('pegawai', function (Blueprint $table) {
        $table->increments('id');
        $table->string('nama', 100);
        $table->enum('jabatan', ['Chef', 'Waiter', 'Kasir']);
        $table->string('kontak', 20);
    });
}

public function down(): void
{
    Schema::dropIfExists('pegawai');
}
};
