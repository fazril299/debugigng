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
| 1 | `database/migrations/2025_01_01_000001_create_todos_table.php` | Default value enum status tidak valid | Nilai default kolom enum diatur ke `'pending'`, padahal pilihan opsi enum hanya `['Todo', 'doing', 'done']`. | Ubah default menjadi `'Todo'` agar sesuai dengan opsi enum yang tersedia. | Selesai |
| 2 | `database/seeders/DatabaseSeeder.php` | Class `UsersSeeder` tidak ditemukan | Pemanggilan seeder menggunakan nama jamak `UsersSeeder::class`, sedangkan nama class file yang ada adalah `UserSeeder`. | Ganti pemanggilan menjadi `$this->call(UserSeeder::class);`. | Selesai |
| 3 | `database/seeders/UserSeeder.php` | Password seeder disimpan dalam bentuk plain text | Password `'password123'` di-insert langsung tanpa di-hash, sehingga gagal saat dicocokkan oleh `Auth::attempt()`. | Bungkus password dengan `Hash::make('password123')` dan import Facade `Hash`. | Selesai |
| 4 | `app/Models/User.php` | Model User tidak memiliki casting auto-hash password | Atribut password tidak memiliki casting `'password' => 'hashed'`, sehingga tidak otomatis di-hash saat mass assignment. | Tambahkan method `casts(): array` berisi `'password' => 'hashed'`. | Selesai |
| 5 | `app/Models/Todo.php` | Atribut `$fillable` tidak cocok dengan database (`title` vs `name`) | Model mendaftarkan field `'title'`, padahal kolom pada database, controller, dan view bernama `'name'`. | Ganti `'title'` menjadi `'name'` pada array `$fillable`. | Selesai |
| 6 | `app/Http/Middleware/IsLoggedIn.php` | Typo deklarasi namespace | Namespace ditulis `App\Http\Middlewares` (jamak/plural), bukan `App\Http\Middleware`. | Ubah namespace menjadi `namespace App\Http\Middleware;`. | Selesai |
| 7 | `app/Http/Middleware/IsLoggedIn.php` | Logika pengecekan status login terbalik | Kondisi `if (Auth::check())` me-redirect user yang sudah login kembali ke halaman login. | Ubah kondisi menjadi `if (!Auth::check())` agar hanya user yang belum login yang di-redirect. | Selesai |
| 8 | `bootstrap/app.php` | Typo penamaan alias middleware (`isLoggedin`) | Pendaftaran alias middleware menggunakan `'isLoggedin'` (huruf kecil 'i'), tidak sesuai dengan route yang memanggil `'isLoggedIn'`. | Samakan nama alias menjadi `'isLoggedIn'` di `bootstrap/app.php`. | Selesai |
| 9 | `routes/web.php` | Pemanggilan method login yang tidak ada di `AuthController` | Route `POST /login` memanggil method `login`, padahal di `AuthController` method bernama `authenticate`. | Ubah target route menjadi `[AuthController::class, 'authenticate']`. | Selesai |
| 10 | `app/Http/Controllers/AuthController.php` | Redirect ke route yang salah pasca login (`todo.index`) | Menggunakan nama route singular `todo.index`, padahal nama route terdaftar adalah `todos.index`. | Ubah redirect menjadi `return redirect()->route('todos.index');`. | Selesai |
| 11 | `app/Http/Controllers/TodoController.php` | Sintaks pemanggilan `Auth::id` tanpa kurung | Mengakses `Auth::id` sebagai properti/konstanta alih-alih memanggil method `Auth::id()`. | Ubah menjadi `Auth::id()`. | Selesai |
| 12 | `app/Http/Controllers/TodoController.php` | Nama variabel ke view tidak cocok (`$todo` vs `$todos`) | Controller mengirim `compact('todo')` (singular), sedangkan view me-looping variable `$todos` (plural). | Ubah variabel menjadi `$todos` dan kirim `compact('todos')`. | Selesai |
| 13 | `app/Http/Controllers/TodoController.php` | Route Model Binding tidak cocok pada method `destroy` | Parameter method dideklarasikan `Todo $id`, tidak sesuai dengan route parameter `{todo}`. | Ganti parameter menjadi `Todo $todo` dan gunakan `$todo->delete();` serta tambahkan otorisasi user. | Selesai |
| 14 | `resources/views/login.blade.php` | Form login tidak memiliki token CSRF | Tag form login tidak menyertakan `@csrf`, menyebabkan HTTP `419 Page Expired`. | Tambahkan direktif `@csrf` di dalam form login. | Selesai |
| 15 | `resources/views/todos/index.blade.php` | Method HTTP form status tidak cocok (`PUT` vs `PATCH`) | Form update status menggunakan `@method('PUT')`, sedangkan route di `routes/web.php` didaftarkan dengan `PATCH`. | Ubah `@method('PUT')` menjadi `@method('PATCH')` dan sesuaikan route agar fleksibel menerima match `['put', 'patch']`. | Selesai |

Terdapat sebanyak **15 error**

## 4. Ketentuan Selesai

Tugas dinyatakan selesai jika:

- [x] Semua error berhasil diperbaiki
- [x] Fitur utama Todo dapat digunakan
- [x] Setiap temuan error dicatat di buku
- [x] Catatan menjelaskan **error, penyebab, dan perbaikan**

**Fokus tugas bukan hanya membuat aplikasi berjalan, tetapi memahami proses menemukan dan memperbaiki error.**
