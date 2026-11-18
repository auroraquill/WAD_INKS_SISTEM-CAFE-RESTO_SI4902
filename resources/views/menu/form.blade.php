@php $isEdit = isset($menu); @endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $isEdit ? 'Edit Menu' : 'Tambah Menu' }} - Sistem Restoran</title>
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
    <div class="container">
        
        <!-- Tombol Kembali ke Daftar Menu di Atas -->
        <div style="margin-bottom: 20px;">
            <a href="{{ route('menu.index') }}" class="btn">&larr; Kembali ke Daftar Menu</a>
        </div>

        <!-- Kartu Pembungkus Form (Konsisten dan Rapi) -->
        <div class="card" style="padding: 30px;">
            <div class="card-head" style="margin-bottom: 25px;">
                <div>
                    <h2>{{ $isEdit ? 'Formulir Edit Menu' : 'Formulir Tambah Menu' }}</h2>
                    <p class="card-subtitle" style="margin: 0; color: #6b7280; font-size: 14px;">
                        {{ $isEdit ? 'Ubah data item menu di bawah ini.' : 'Isi data item menu baru di bawah ini.' }}
                    </p>
                </div>
            </div>

            @if ($errors->any())
                <div style="background: #fee2e2; color: #991b1b; padding: 10px 15px; border-radius: 6px; font-size: 13px; margin-bottom: 20px;">
                    <ul style="margin: 0; padding-left: 15px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ $isEdit ? route('menu.update', $menu) : route('menu.store') }}"
                  method="POST" enctype="multipart/form-data">
                @csrf
                @if ($isEdit)
                    @method('PUT')
                @endif

                <div class="form-group">
                    <label for="nama">Nama Item:</label>
                    <input type="text" id="nama" name="nama" value="{{ old('nama', $menu->nama ?? '') }}" required class="form-control" placeholder="Masukkan nama item...">
                </div>

                <div class="form-group">
                    <label for="kategori">Kategori:</label>
                    <input type="text" id="kategori" name="kategori" value="{{ old('kategori', $menu->kategori ?? '') }}" required class="form-control" placeholder="Masukkan kategori...">
                </div>

                <div class="form-group">
                    <label for="harga">Harga:</label>
                    <input type="number" id="harga" name="harga" value="{{ old('harga', $menu->harga ?? '') }}" required class="form-control" placeholder="Masukkan harga...">
                </div>

                <div class="form-group">
                    <label for="foto">Foto Menu{{ $isEdit ? ' (kosongkan jika tidak diganti)' : '' }}:</label>
                    @if ($isEdit && $menu->foto)
                        <div style="margin-bottom: 10px;">
                            <img src="{{ asset('storage/' . $menu->foto) }}" alt="foto lama" style="max-height: 100px; border-radius: 6px; border: 1px solid #e5e7eb;">
                        </div>
                    @endif
                    <input type="file" id="foto" name="foto" accept="image/*" style="font-size: 14px;">
                </div>

                <div class="form-checkbox-group">
                    <input type="checkbox" id="halal" name="halal" value="1" {{ old('halal', $menu->halal ?? false) ? 'checked' : '' }}>
                    <label for="halal">Halal</label>
                </div>

                <button type="submit" class="btn" style="padding: 10px 25px; font-size: 14px; font-weight: 500; background: #4f46e5; color: #fff; border: none; border-radius: 6px; cursor: pointer;">
                    {{ $isEdit ? 'Update Data' : 'Simpan Data' }}
                </button>
            </form>
        </div>
    </div>

</body>
</html>