<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->enum('role', ['admin', 'pegawai'])->default('pegawai');
                $table->unsignedInteger('pegawai_id')->nullable();
                $table->rememberToken();
                $table->timestamps();
            });
            return;
        }

        // kalau tabel users sudah ada, tinggal tambah kolomnya
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'pegawai'])->default('pegawai')->after('password');
            $table->unsignedInteger('pegawai_id')->nullable()->after('role');
        });
    }

    public function down(): void
    {
        // Hanya hapus kolom yang ditambahkan migration ini, jangan seluruh tabel users
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                if (Schema::hasColumn('users', 'pegawai_id')) {
                    $table->dropColumn('pegawai_id');
                }
                if (Schema::hasColumn('users', 'role')) {
                    $table->dropColumn('role');
                }
            });
        }
    }
};