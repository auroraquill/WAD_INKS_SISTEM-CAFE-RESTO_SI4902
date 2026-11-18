{{-- Navigasi: menu yang tampil menyesuaikan role --}}
<nav class="navbar">
    <a href="{{ route('menu.index') }}">Buku Menu</a>
    <a href="{{ route('meja.index') }}">Meja &amp; Area</a>
    @if (auth()->user()->isAdmin())
        <a href="{{ route('staff.index') }}">Staff &amp; Pegawai</a>
    @else
        <a href="{{ route('profil') }}">Profil Saya</a>
    @endif

    <span class="nav-user">
        {{ auth()->user()->name }} <span class="badge badge-{{ auth()->user()->role }}">{{ ucfirst(auth()->user()->role) }}</span>
        <form action="{{ route('logout') }}" method="POST" class="form-inline-hapus">
            @csrf
            <button type="submit" class="tombol-aksi hapus">Logout</button>
        </form>
    </span>
</nav>
