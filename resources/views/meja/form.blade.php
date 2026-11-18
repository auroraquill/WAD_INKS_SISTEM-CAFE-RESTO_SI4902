@php $isEdit = isset($meja); @endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $isEdit ? 'Edit Meja' : 'Tambah Meja' }} - Sistem Restoran</title>
    <!-- Memanggil CSS Eksternal -->
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
        
        <!-- Tombol Kembali di Atas -->
        <div style="margin-bottom: 20px;">
            <a href="{{ route('meja.index') }}" class="btn">&larr; Kembali ke Daftar Meja</a>
        </div>

        <!-- Kartu Pembungkus Form (Konsisten dan Rapi) -->
        <div class="card" style="padding: 30px;">
            <div class="card-head" style="margin-bottom: 25px;">
                <div>
                    <h2>{{ $isEdit ? 'Formulir Edit Meja' : 'Formulir Tambah Meja Baru' }}</h2>
                    <p class="card-subtitle" style="margin: 0; color: #6b7280; font-size: 14px;">
                        {{ $isEdit ? 'Ubah data meja restoran di bawah ini.' : 'Isi data meja restoran baru di bawah ini.' }}
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

            <form action="{{ $isEdit ? route('meja.update', $meja) : route('meja.store') }}" method="POST">
                @csrf
                @if($isEdit)
                    @method('PUT')
                @endif

                <div class="form-group">
                    <label for="nomor_meja">Nomor Meja</label>
                    <input type="text" id="nomor_meja" name="nomor_meja" value="{{ old('nomor_meja', $meja->nomor_meja ?? '') }}" required placeholder="Contoh: Meja 01 / VIP 1" class="form-control">
                </div>

                <div class="form-group">
                    <label for="kapasitas">Kapasitas (Orang)</label>
                    <input type="number" id="kapasitas" name="kapasitas" value="{{ old('kapasitas', $meja->kapasitas ?? '') }}" required min="1" placeholder="Contoh: 4" class="form-control">
                </div>

                <div class="form-group" style="margin-bottom: 25px;">
                    <label for="status">Status</label>
                    <select id="status" name="status" required class="form-control">
                        <option value="tersedia" {{ (old('status', $meja->status ?? '') == 'tersedia') ? 'selected' : '' }}>Tersedia</option>
                        <option value="terisi" {{ (old('status', $meja->status ?? '') == 'terisi') ? 'selected' : '' }}>Terisi</option>
                    </select>
                </div>

                <button type="submit" class="btn" style="padding: 10px 25px; font-size: 14px; font-weight: 500; background: #4f46e5; color: #fff; border: none; border-radius: 6px; cursor: pointer;">
                    {{ $isEdit ? 'Update Data' : 'Simpan Data' }}
                </button>
            </form>
        </div>
    </div>

</body>
</html>