<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Staff - Sistem Restoran</title>
    <!-- Memanggil CSS Terpusat -->
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

    <!-- Konten Utama -->
    <div class="container menu-page-container">
        
        <!-- Tombol Kembali ke Dashboard -->
        <div class="back-nav-wrap" style="margin-bottom: 20px;">
            <a href="{{ route('dashboard') }}" class="btn">&larr; Kembali ke Dashboard</a>
        </div>

        <div class="card" style="padding: 30px;">
            <div class="card-head" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <div>
                    <h2>Data Pegawai</h2>
                    <p class="card-subtitle" style="margin: 0; color: #6b7280; font-size: 14px;">Kelola informasi akun pegawai dan jabatan restoran.</p>
                </div>
                <a href="{{ route('staff.create') }}" class="btn-tambah" style="background: #059669; color: white; padding: 10px 18px; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 14px;">+ Tambah Baru</a>
            </div>

            @if(session('success'))
                <div style="background: #d1fae5; color: #065f46; padding: 12px 15px; border-radius: 6px; font-size: 14px; margin-bottom: 20px;">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Tabel Data Pegawai -->
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 14px;">
                    <thead>
                        <tr style="border-bottom: 2px solid #e5e7eb; color: #374151;">
                            <th style="padding: 12px 10px;">NO.</th>
                            <th style="padding: 12px 10px;">NAMA PEGAWAI</th>
                            <th style="padding: 12px 10px;">JABATAN</th>
                            <th style="padding: 12px 10px;">NOMOR KONTAK</th>
                            <th style="padding: 12px 10px; text-align: center;">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pegawai as $index => $p)
                        <tr style="border-bottom: 1px solid #f3f4f6;">
                            <td style="padding: 12px 10px; color: #6b7280;">{{ $index + 1 }}</td>
                            <td style="padding: 12px 10px; font-weight: 600; color: #1f2937;">{{ $p->nama }}</td>
                            <td style="padding: 12px 10px; color: #4b5563;">{{ $p->jabatan }}</td>
                            <td style="padding: 12px 10px; color: #4b5563;">{{ $p->kontak }}</td>
                            <td style="padding: 12px 10px; text-align: center;">
                                <div style="display: flex; justify-content: center; gap: 6px; align-items: center;">
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('staff.edit', $p->id) }}" style="background: #f59e0b; color: white; padding: 6px 12px; border-radius: 4px; font-size: 12px; font-weight: 600; text-decoration: none;">EDIT</a>
                                    
                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('staff.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pegawai ini?')" style="display: inline-block; margin: 0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background: #ef4444; color: white; border: none; padding: 6px 12px; border-radius: 4px; font-size: 12px; font-weight: 600; cursor: pointer;">HAPUS</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" style="text-align: center; color: #6b7280; padding: 40px;">
                                Belum ada data pegawai.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</body>
</html>