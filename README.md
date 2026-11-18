# Sistem Data Pegawai Restaurant & Cafe

Aplikasi Laravel untuk mengelola data pegawai restoran dengan hak akses berdasarkan role.

Aurora Aquilla Pramesti (NIM 102022500058).

---

## Hak Akses

Admin
- Melihat, menambah, mengubah, dan menghapus data pegawai.
- Bisa membuatkan akun login saat menambah pegawai baru.

Pegawai
- Hanya bisa melihat profil sendiri.
- Tidak bisa membuka halaman data pegawai (muncul error 403).

---

## Kebutuhan

- PHP 8.3 atau lebih baru
- Composer
- MySQL (Laragon atau XAMPP)
- Internet (DataTables dan jQuery dimuat dari CDN)

---

## Cara Menjalankan

1. Clone repo, lalu masuk ke foldernya.

   git clone https://github.com/auroraquill/102022500058-AURORA-AQUILLA-PRAMESTI-HAK-ASES.git
   cd 102022500058-AURORA-AQUILLA-PRAMESTI-HAK-ASES
   

2. Pasang dependency.

   composer install
   

3. Salin konfigurasi dan buat app key.

   cp .env.example .env
   php artisan key:generate

4. Buat database kosong bernama `db_pegawai` di MySQL, lalu cek file `.env`.

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=db_pegawai
   DB_USERNAME=root
   DB_PASSWORD=

5. Buat tabel dan isi data awal.

   php artisan migrate --seed

6. Jalankan server, lalu buka http://localhost:8000

   php artisan serve

---

## Akun Demo

Admin:
- Email: `admin@resto.test`
- Password: `admin123`

Pegawai (password semuanya `pegawai123`):
- `rora@resto.test`
- `cantika@resto.test`
- `qila@resto.test`
- `moja@resto.test`
- `daaniys@resto.test`
- `villa@resto.test`

Akun ini hanya untuk tugas, jangan dipakai di server produksi.

## Cara Menguji Hak Akses

1. Login sebagai admin. Kamu masuk ke halaman Data Pegawai dan bisa tambah, ubah, hapus.
2. Logout, lalu login sebagai pegawai. Kamu masuk ke halaman Profil Saya.
3. Sebagai pegawai, buka `http://localhost:8000/staff`. Hasilnya error 403.

## File Penting

- `routes/web.php` : pembagian route admin dan pegawai
- `app/Http/Middleware/RoleMiddleware.php` : pembatas akses per role
- `app/Http/Controllers/` : AuthController, StaffController, StaffEditController
- `database/migrations/` : struktur tabel pegawai dan users
- `database/seeders/` : data pegawai dan akun demo
- `resources/views/` : halaman login, data pegawai, dan profil