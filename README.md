# Latihan 4a: Setup Laravel dan Konfigurasi MySQL

|        |                        |
| ------ | ---------------------- |
| Nama   | Muhammad Faisal Hanief |
| NPM    | 24312201               |
| Kelas  | IF 24 B                |
| Branch | `Lat-4a_SetupLaravel`  |

Studi kasus: website portofolio mahasiswa. Latihan ini memastikan lingkungan backend Laravel berjalan dan terhubung ke MySQL.

## Versi yang dipilih dan alasannya

- **PHP 8.4**: masih berada di rentang yang diminta (8.2 sampai 8.4), mendapat dukungan aktif, dan bisa dipasang berdampingan dengan versi lain di Laragon sehingga mudah berpindah.
- **Laravel 12**: versi yang saya pakai sejak awal proyek. Konsep dasar yang dipelajari (MVC, routing, migration, Eloquent, seeder) sama dengan Laravel 10/11. Perbedaan yang saya temui: konfigurasi middleware dan routing ada di `bootstrap/app.php` seperti Laravel 11, dan `routes/api.php` diaktifkan dengan `php artisan install:api`.
- **MySQL 8 (Laragon)** dengan database `portofolio_web`.

## Bukti pengerjaan

![Halaman welcome dengan kartu identitas dan nama database aktif](docs/screenshots/lat4a-welcome.webp)

Halaman `/welcome` menampilkan identitas pengembang, versi PHP, versi Laravel, dan nama database aktif yang dibaca dengan `DB::connection()->getDatabaseName()`.

## Cara menjalankan

```bash
composer install
npm install
copy .env.example .env
php artisan key:generate
```

Buat database kosong `portofolio_web` di MySQL, sesuaikan nilai `DB_*` di `.env` (di Laragon: user `root`, password kosong), lalu:

```bash
php artisan migrate:fresh --seed
npm run build
```

Buka `http://portfolio.test/welcome` (Laragon) atau jalankan `php artisan serve`.

## Penjelasan folder penting Laravel

| Folder atau file       | Fungsi                                                                                     |
| ---------------------- | ------------------------------------------------------------------------------------------ |
| `app/Models`           | Model Eloquent, representasi tabel database (M pada MVC)                                   |
| `app/Http/Controllers` | Controller, tempat logika pemrosesan request (C pada MVC)                                  |
| `bootstrap/app.php`    | Pusat konfigurasi aplikasi: routing, middleware, dan penanganan error (Laravel 11 ke atas) |
| `config`               | File konfigurasi aplikasi (database, session, dan lain-lain)                               |
| `database/migrations`  | Script pembuatan dan perubahan tabel                                                       |
| `database/seeders`     | Script pengisian data awal                                                                 |
| `public`               | Root server; `index.php` adalah pintu masuk semua request                                  |
| `resources/views`      | Template Blade (V pada MVC)                                                                |
| `routes`               | Definisi rute: `web.php` untuk halaman, `api.php` untuk API                                |
| `storage`              | Log, cache, dan file yang dibuat aplikasi                                                  |
| `.env`                 | Konfigurasi lingkungan (kredensial database dan lainnya), tidak boleh diunggah ke Git      |

## Perintah Artisan yang dipakai

| Perintah                           | Fungsi                                                            |
| ---------------------------------- | ----------------------------------------------------------------- |
| `php artisan migrate`              | Membuat tabel berdasarkan file migration                          |
| `php artisan migrate:fresh --seed` | Menghapus semua tabel, membuatnya ulang, lalu mengisi data seeder |
| `php artisan make:model Nama -m`   | Membuat Model sekaligus file migration                            |
| `php artisan make:controller Nama` | Membuat Controller                                                |
| `php artisan make:seeder Nama`     | Membuat Seeder                                                    |
| `php artisan route:list`           | Menampilkan semua rute yang terdaftar                             |
| `php artisan config:clear`         | Membersihkan cache konfigurasi setelah mengubah `.env`            |
| `php artisan key:generate`         | Membuat `APP_KEY` baru                                            |

## Keamanan

- File `.env` tidak diunggah ke GitHub. Yang diunggah hanya `.env.example` (tanpa password dan rahasia asli).
- `php artisan config:cache` tidak dijalankan selama pengembangan lokal. Di lokal memakai `php artisan config:clear`.
