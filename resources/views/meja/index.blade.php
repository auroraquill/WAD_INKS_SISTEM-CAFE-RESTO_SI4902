<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Meja Restoran</title>
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
                    <h2>Daftar Meja Restoran</h2>
                    <p class="card-subtitle">Kelola status dan kapasitas meja restoran.</p>
                </div>
                <div>
                    <a href="{{ route('meja.create') }}" class="btn-tambah">+ Tambah Meja Baru</a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor Meja</th>
                        <th>Kapasitas</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($mejas)
                        @forelse($mejas as $index => $meja)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $meja->nomor_meja ?? $meja->nama_meja }}</td>
                            <td>{{ $meja->kapasitas }} Orang</td>
                            <td>
                                <span class="badge {{ ($meja->status == 'tersedia' || $meja->status == 'Tersedia') ? 'badge-tersedia' : 'badge-terisi' }}">
                                    {{ ucfirst($meja->status) }}
                                </span>
                            </td>
                            <td>
                                <div class="aksi-wrap">
                                    <a href="{{ route('meja.edit', $meja) }}" class="aksi edit">EDIT</a>
                                    <form action="{{ route('meja.destroy', $meja) }}" method="POST" onsubmit="return confirm('Yakin hapus meja ini?')" style="display:inline-block; margin:0; padding:0; background:none; border:none; box-shadow:none;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="aksi hapus">HAPUS</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" style="text-align: center; color: #6b7280; padding: 30px;">Belum ada data meja.</td>
                        </tr>
                        @endforelse
                    @else
                        <tr>
                            <td colspan="5" style="text-align: center; color: #6b7280; padding: 30px;">Belum ada data meja.</td>
                        </tr>
                    @endisset
                </tbody>
            </table>

        </div>
    </div>

</body>
</html>