@php $isEdit = isset($staff); @endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $isEdit ? 'Edit Pegawai' : 'Tambah Pegawai' }} - Sistem Restoran</title>
    <!-- Memanggil CSS Terpusat -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <!-- Navbar Atas Konsisten dengan Logo -->
    <div class="navbar">
        <h2>Sistem Restoran</h2>
        <div class="user-info">
            <span style="font-weight: 600; color: #4f46e5;">Restaurant & Cafe</span>
            <img src="{{ asset('images/logo.png') }}" alt="Logo TRES" class="logo" style="max-height: 40px; width: auto;">
        </div>
    </div>

    <!-- Konten Utama -->
    <div class="container" style="max-width: 800px; margin: 30px auto; padding: 0 20px;">
        
        <!-- Tombol Kembali di Atas -->
        <div style="margin-bottom: 20px;">
            <a href="{{ route('staff.index') }}" class="btn">&larr; Kembali ke Daftar Pegawai</a>
        </div>

        <!-- Kartu Pembungkus Form (Rapi, Terpusat, Profesional) -->
        <div class="card" style="padding: 35px; background: #fff; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
            <div class="card-head" style="margin-bottom: 25px;">
                <div>
                    <h2>{{ $isEdit ? 'Formulir Edit Pegawai' : 'Formulir Tambah Pegawai' }}</h2>
                    <p class="card-subtitle" style="margin: 0; color: #6b7280; font-size: 14px;">
                        {{ $isEdit ? 'Ubah data pegawai di bawah ini.' : 'Isi data pegawai baru pada formulir di bawah ini.' }}
                    </p>
                </div>
            </div>

            @if ($errors->any())
                <div style="background: #fee2e2; color: #991b1b; padding: 12px 15px; border-radius: 6px; font-size: 13px; margin-bottom: 25px;">
                    <ul style="margin: 0; padding-left: 15px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ $isEdit ? route('staff.update', $staff->id) : route('staff.store') }}" method="POST">
                @csrf
                @if($isEdit)
                    @method('PUT')
                @endif

                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="nama" style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">Nama Pegawai:</label>
                    <input type="text" id="nama" name="nama" value="{{ old('nama', $staff->nama ?? '') }}" required placeholder="Masukkan nama pegawai..." class="form-control" style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px;">
                </div>

                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="jabatan" style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">Jabatan:</label>
                    <select id="jabatan" name="jabatan" required class="form-control" style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px; background: #fff;">
                        <option value="">-- Pilih Jabatan --</option>
                        <option value="Chef" {{ (old('jabatan', $staff->jabatan ?? '') == 'Chef') ? 'selected' : '' }}>Chef</option>
                        <option value="Waiter" {{ (old('jabatan', $staff->jabatan ?? '') == 'Waiter') ? 'selected' : '' }}>Waiter</option>
                        <option value="Kasir" {{ (old('jabatan', $staff->jabatan ?? '') == 'Kasir') ? 'selected' : '' }}>Kasir</option>
                    </select>
                </div>

                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="kontak" style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">Nomor Kontak:</label>
                    <input type="text" id="kontak" name="kontak" value="{{ old('kontak', $staff->kontak ?? '') }}" required placeholder="Contoh: 081234567890" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px;">
                </div>

                <hr style="border: none; border-top: 1px solid #e5e7eb; margin: 25px 0;">

                <div style="margin-bottom: 15px;">
                    <h4 style="margin: 0 0 5px 0; color: #1f2937; font-size: 15px;">Akun Login</h4>
                    <p style="margin: 0; color: #6b7280; font-size: 13px;">Opsional, kosongkan kalau tidak ingin mengubah atau menambah akun login.</p>
                </div>

                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="email" style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">Email:</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $staff->email ?? '') }}" placeholder="email@domain.com" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px;">
                </div>

                <div class="form-group" style="margin-bottom: 25px;">
                    <label for="password" style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">Password:</label>
                    <input type="password" id="password" name="password" placeholder="Minimal 6 karakter" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px;">
                </div>

                <button type="submit" class="btn" style="padding: 10px 25px; font-size: 14px; font-weight: 500; background: #4f46e5; color: #fff; border: none; border-radius: 6px; cursor: pointer;">
                    {{ $isEdit ? 'Update Data' : 'Simpan Data' }}
                </button>
            </form>
        </div>
    </div>

</body>
</html>