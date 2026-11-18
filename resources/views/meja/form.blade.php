<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>{{ isset($meja) ? 'Edit Meja' : 'Tambah Meja' }}</title>
  <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
  <h1>{{ isset($meja) ? 'Edit Meja' : 'Tambah Meja' }}</h1>
  <hr>

  @if($errors->any())
    <div class="error">
      <ul>
        @foreach($errors->all() as $err)
          <li>{{ $err }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form method="POST"
        action="{{ isset($meja) ? route('meja.update', $meja->id) : route('meja.store') }}">
    @csrf
    @if(isset($meja))
      @method('PUT')
    @endif

    <label for="nomor_meja">Nomor Meja:</label>
    <input type="text" id="nomor_meja" name="nomor_meja"
           value="{{ old('nomor_meja', $meja->nomor_meja ?? '') }}" required>

    <label for="kapasitas">Kapasitas:</label>
    <select id="kapasitas" name="kapasitas">
      @foreach([2, 4, 8] as $k)
        <option value="{{ $k }}" {{ old('kapasitas', $meja->kapasitas ?? '') == $k ? 'selected' : '' }}>
          {{ $k }} Kursi
        </option>
      @endforeach
    </select>

    <label for="zonasi">Zonasi:</label>
    <select id="zonasi" name="zonasi">
      @foreach(['Indoor', 'VIP'] as $z)
        <option value="{{ $z }}" {{ old('zonasi', $meja->zonasi ?? '') == $z ? 'selected' : '' }}>
          {{ $z }}
        </option>
      @endforeach
    </select>

    <label for="status">Status:</label>
    <select id="status" name="status">
      @foreach(['Tersedia', 'Terisi', 'Reserved'] as $s)
        <option value="{{ $s }}" {{ old('status', $meja->status ?? '') == $s ? 'selected' : '' }}>
          {{ $s }}
        </option>
      @endforeach
    </select>

    <button type="submit">{{ isset($meja) ? 'Update' : 'Simpan' }}</button>
  </form>
  <br>
  <a href="{{ route('meja.index') }}">Kembali ke Daftar Meja</a>
</body>
</html>