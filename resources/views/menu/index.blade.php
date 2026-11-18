<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modul Buku Menu - Sistem Restoran</title>
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

    <div class="container menu-page-container">
        
        <!-- Tombol Kembali ke Dashboard -->
        <div class="back-nav-wrap" style="margin-bottom: 20px;">
            <a href="{{ route('dashboard') }}" class="btn">&larr; Kembali ke Dashboard</a>
        </div>

        <div class="card">
            <div class="card-head">
                <div>
                    <h2>Daftar Menu Restoran</h2>
                    <p class="card-subtitle">Pilihan menu makanan dan minuman terbaik.</p>
                </div>
                <a href="{{ route('menu.create') }}" class="btn-tambah">+ Tambah Menu Baru</a>
            </div>

            @if(session('success'))
                <div class="alert-success" style="margin-top: 15px; padding: 10px 15px; background: #d1fae5; color: #065f46; border-radius: 6px;">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Grid Menu Langsung Berjejer Rapi -->
            <div class="menu-grid-container" style="margin-top: 20px;">
                @isset($menus)
                    @forelse($menus as $menu)
                    <div class="menu-card-item" style="background: #fff; border: 1px solid #e5e7eb; border-radius: 8px; padding: 15px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); display: flex; flex-direction: column; justify-content: space-between;">
                        <div>
                            @if(!empty($menu->foto))
                                {{-- Menggunakan asset('uploads/' . ...) karena file disimpan di public/uploads --}}
                                <img src="{{ asset('uploads/' . $menu->foto) }}" alt="{{ $menu->nama }}" style="width: 100%; height: 160px; object-fit: cover; border-radius: 6px; margin-bottom: 12px; background: #f3f4f6;">
                            @else
                                <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=300" alt="Menu Default" style="width: 100%; height: 160px; object-fit: cover; border-radius: 6px; margin-bottom: 12px; background: #f3f4f6;">
                            @endif

                            <h4 style="margin: 0 0 5px 0; font-size: 16px; color: #1f2937;">{{ $menu->nama ?? 'Nama Menu' }}</h4>
                            <div class="menu-category" style="color: #6b7280; font-size: 13px; margin-bottom: 8px;">{{ $menu->kategori ?? 'Umum' }}</div>
                            <div class="menu-price" style="font-weight: 600; color: #4f46e5; font-size: 15px; margin-bottom: 15px;">Rp {{ number_format($menu->harga ?? 0, 0, ',', '.') }}</div>
                        </div>

                        <div class="menu-actions" style="display: flex; gap: 8px; align-items: center;">
                            <a href="{{ route('menu.edit', $menu) }}" class="aksi edit" style="flex: 1; text-align: center; padding: 6px; background: #f59e0b; color: white; text-decoration: none; border-radius: 4px; font-size: 12px; font-weight: 600;">EDIT</a>
                            <form action="{{ route('menu.destroy', $menu) }}" method="POST" onsubmit="return confirm('Yakin hapus menu ini?')" style="flex: 1; margin: 0;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="aksi hapus" style="width: 100%; padding: 6px; background: #ef4444; color: white; border: none; border-radius: 4px; font-size: 12px; font-weight: 600; cursor: pointer;">HAPUS</button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="empty-menu-state" style="grid-column: 1 / -1; text-align: center; color: #6b7280; padding: 40px;">
                        Belum ada data menu.
                    </div>
                    @endforelse
                @else
                    <div class="empty-menu-state" style="grid-column: 1 / -1; text-align: center; color: #6b7280; padding: 40px;">
                        Belum ada data menu.
                    </div>
                @endisset
            </div>

        </div>
    </div>

</body>
</html>