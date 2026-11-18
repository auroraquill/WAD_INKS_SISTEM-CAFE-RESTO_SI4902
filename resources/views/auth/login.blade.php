<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Restoran</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <div class="navbar">
        <h2>Sistem Restoran</h2>
        <div style="display: flex; align-items: center; gap: 10px;">
            <span style="font-weight: 600; color: #4f46e5; font-size: 14px;">Restaurant & Cafe</span>
            <img src="{{ asset('images/logo.png') }}" alt="Logo TRES" class="logo">
        </div>
    </div>

    <div class="container-center">
        <div class="card" style="padding: 30px;">
            <div style="text-align: center; margin-bottom: 25px;">
                <h2 style="margin-bottom: 5px; color: #1f2937;">Masuk ke Akun</h2>
                <p style="color: #6b7280; font-size: 14px; margin: 0;">Silakan masukkan email dan password Anda.</p>
            </div>

            @if($errors->any())
                <div style="background: #fee2e2; color: #991b1b; padding: 10px 15px; border-radius: 6px; font-size: 13px; margin-bottom: 20px;">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required placeholder="Masukkan email..." class="form-control">
                </div>

                <div class="form-group" style="margin-bottom: 25px;">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required placeholder="Masukkan password..." class="form-control">
                </div>

                <button type="submit" class="btn" style="width: 100%; padding: 12px; font-size: 15px; font-weight: 600; background: #4f46e5; color: #fff; border: none; border-radius: 6px; cursor: pointer;">Masuk</button>
            </form>
        </div>
    </div>

</body>
</html>