<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Meja</title>
  <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
  <h1>Daftar Meja</h1>
  <hr>
  <p>Halaman ini menampilkan data meja restoran.</p>

  @if(session('success'))
    <p class="sukses">{{ session('success') }}</p>
  @endif

  <table>
    <tr>
      <th>Nomor Meja</th>
      <th>Kapasitas</th>
      <th>Zonasi</th>
      <th>Status</th>
      <th>Aksi</th>
    </tr>
    @forelse($mejas as $m)
      <tr>
        <td>{{ $m->nomor_meja }}</td>
        <td>{{ $m->kapasitas }} Kursi</td>
        <td>{{ $m->zonasi }}</td>
        <td>{{ $m->status }}</td>
        <td>
          <a href="{{ route('meja.edit', $m->id) }}">Edit</a> |
          <form class="inline" method="POST" action="{{ route('meja.destroy', $m->id) }}"
                onsubmit="return confirm('Yakin hapus data?')">
            @csrf
            @method('DELETE')
            <button type="submit">Hapus</button>
          </form>
        </td>
      </tr>
    @empty
      <tr><td colspan="5">Belum ada data meja.</td></tr>
    @endforelse
  </table>
  <br>
  <a href="{{ route('meja.create') }}">Tambah Meja Baru</a>
</body>
</html>