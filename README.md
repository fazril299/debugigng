# 🔧 Tugas Debugging Laravel

## Tujuan

Project ini sengaja memiliki beberapa **error/bug** pada bagian migration, model, controller, route, view, dan seeder. Tugas kamu adalah menemukan, menganalisis, dan memperbaiki error tersebut.

## 1. Clone Project

Clone repository yang diberikan:

```bash
git clone [URL-REPOSITORY]
cd [NAMA-PROJECT]
```

Install dependency:

```bash
composer install
```

Buat file `.env` kemudian salin isi file `.env.example` simpan pada `.env`, sesuaikan **konfigurasi database** lalu jalankan :

```bash
php artisan key:generate
```

Jalankan juga:

```bash
php artisan migrate --seed
php artisan serve
```

## 2. Lakukan Debugging

Buka aplikasi melalui browser dan coba seluruh fitur:

- Login
- Melihat daftar Todo
- Menambah Todo
- Mengedit Status Todo
- Menghapus Todo

Temukan error yang muncul dan **perbaiki satu per satu**. **MATIKAN INTERNET** jika visual studio code kamu terintegrasi dengan copilot/AI lainnya. **CARI DAN PERBAIKI ERROR TANPA BANTUAN TOOLS APAPUN**

## 3. Catat Setiap Temuan di Buku

Setiap error yang ditemukan **wajib dicatat** dengan format:

| No | Bagian File Terkait | Nama/Detail Error | Penyebab | Perbaikan | Waktu Penyelesaian |
|---:|---|---|---|---|---|
| 1 | | | | | |
| 2 | | | | | |
| 3 | | | | | |
| 4 | | | | | |
| 5 | | | | | |
| 6 | | | | | |
| 7 | | | | | |
| 8 | | | | | |

Terdapat sebanyak **15 error**

## 4. Ketentuan Selesai

Tugas dinyatakan selesai jika:

- [ ] Semua error berhasil diperbaiki
- [ ] Fitur utama Todo dapat digunakan
- [ ] Setiap temuan error dicatat di buku
- [ ] Catatan menjelaskan **error, penyebab, dan perbaikan**

**Fokus tugas bukan hanya membuat aplikasi berjalan, tetapi memahami proses menemukan dan memperbaiki error.**
