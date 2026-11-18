<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Restoran</title>
    <!-- Memanggil CSS Eksternal yang Rapi -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <!-- Navbar Atas: Sistem Restoran di Kiri, Teks & Logo serta Info Akun di Kanan -->
    <div class="navbar" style="align-items: center; padding: 15px 30px;">
        <h2>Sistem Restoran</h2>
        
        <!-- Bagian Kanan Navbar (Restaurant & Cafe, Logo, Halo Admin, & Logout) -->
        <div style="display: flex; align-items: center; gap: 20px;">
            <div style="display: flex; align-items: center; gap: 10px;">
                <span style="font-weight: 600; color: #4f46e5; font-size: 14px;">Restaurant & Cafe</span>
                <img src="{{ asset('images/logo.png') }}" alt="Logo TRES" class="logo" style="max-height: 38px; width: auto;">
            </div>
            
            <div style="display: flex; align-items: center; gap: 10px; border-left: 1px solid #e5e7eb; padding-left: 20px;">
                <span style="font-size: 13px; color: #4b5563;">Halo, <strong>{{ auth()->user()->name ?? 'Admin' }}</strong></span>
                <span class="badge-role" style="font-size: 10px; padding: 2px 8px;">{{ auth()->user()->role ?? 'ADMIN' }}</span>
                <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" class="btn-logout" style="padding: 5px 12px; font-size: 12px;">Logout</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Konten Utama -->
    <div class="container">
        
        <!-- Kartu Selamat Datang (Bersih tanpa duplikasi info akun) -->
        <div class="welcome-card" style="margin-bottom: 25px;">
            <h3 style="margin-bottom: 8px;">Selamat Datang di Panel Manajemen Restoran</h3>
            <p style="margin: 0; color: #6b7280;">Gunakan menu di bawah ini untuk mengelola operasional restoran sesuai dengan hak akses akun kamu.</p>
        </div>

        <div class="menu-grid">
            <!-- Modul Profil Saya (Hanya muncul untuk Pegawai, disembunyikan untuk Admin) -->
            @if(!auth()->user()->isAdmin())
            <div class="card-module" style="border-top-color: #6366f1;">
                <h3>Profil Saya</h3>
                <p>Lihat informasi data diri, jabatan, dan nomor kontak akun kamu.</p>
                <a href="{{ route('staff.profil') }}" class="btn-action" style="background: #6366f1;">Lihat Profil</a>
            </div>
            @endif

            <!-- Modul Menu -->
            <div class="card-module">
                <h3>Kelola Menu</h3>
                <p>Tambah, edit, atau lihat daftar menu makanan dan minuman restoran.</p>
                <a href="{{ route('menu.index') }}" class="btn-action">Buka Menu</a>
            </div>

            <!-- Modul Meja -->
            <div class="card-module" style="border-top-color: #059669;">
                <h3>Kelola Meja</h3>
                <p>Lihat, tambah, edit, atau hapus data meja restoran.</p>
                <a href="{{ route('meja.index') }}" class="btn-action" style="background: #059669;">Buka Meja</a>
            </div>

            <!-- Modul Staff (Khusus Admin) -->
            @if(auth()->user()->isAdmin())
            <div class="card-module" style="border-top-color: #d97706;">
                <h3>Kelola Staff / Pegawai</h3>
                <p>Tambah, edit data, atau hapus akun pegawai restoran.</p>
                <a href="{{ route('staff.index') }}" class="btn-action" style="background: #d97706;">Buka Staff</a>
            </div>
            @endif
        </div>
    </div>

</body>
</html>