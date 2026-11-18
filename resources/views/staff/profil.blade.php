<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <!-- Navbar Atas Konsisten -->
    <div class="navbar">
        <h2>Sistem Restoran</h2>
        <div class="user-info">
            <span style="font-weight: 600; color: #4f46e5;">Restaurant & Cafe</span>
            <img src="{{ asset('images/logo.png') }}" alt="Logo TRES" class="logo" style="max-height: 40px; width: auto;">
        </div>
    </div>

    <div class="container">
        
        <!-- Tombol Kembali ke Dashboard -->
        <div style="margin-bottom: 20px;">
            <a href="{{ route('dashboard') }}" class="btn">&larr; Kembali ke Dashboard</a>
        </div>

        <div class="card">
            <div class="card-head">
                <div>
                    <h2>Profil Saya</h2>
                    <p class="card-subtitle">Kelola dan lihat informasi data diri akun pegawai restoran.</p>
                </div>
            </div>

            <div style="padding: 10px 0;">
                <table class="profile-table">
                    <tr>
                        <td class="label-col">Nama Pegawai</td>
                        <td>{{ $staff->name ?? auth()->user()->name }}</td>
                    </tr>
                    <tr>
                        <td class="label-col">Jabatan</td>
                        <td>{{ $staff->jabatan ?? auth()->user()->role ?? 'Staff' }}</td>
                    </tr>
                    <tr>
                        <td class="label-col">Nomor Kontak</td>
                        <td>{{ $staff->kontak ?? $staff->no_kontak ?? '-' }}</td>
                    </tr>
                </table>
            </div>

        </div>
    </div>

</body>
</html>