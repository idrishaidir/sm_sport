````markdown
# SM Sport Center - Sistem Reservasi Lapangan Olahraga

SM Sport Center adalah aplikasi berbasis web yang dibangun menggunakan **Laravel** untuk memudahkan proses pemesanan atau reservasi lapangan olahraga (seperti Futsal dan Badminton). Aplikasi ini dilengkapi dengan fitur ketersediaan jadwal secara _real-time_, dashboard admin, serta sistem autentikasi dan verifikasi email bagi pengguna.

## 🚀 Fitur Utama

- **Autentikasi Pengguna:** Registrasi, Login, dan Reset Password yang aman.
- **Verifikasi Email:** Memastikan pengguna mendaftar dengan email yang valid.
- **Pemesanan Lapangan:** Pengguna dapat melakukan reservasi lapangan pada jam dan tanggal tertentu.
- **Cek Ketersediaan:** Menampilkan ketersediaan lapangan secara langsung (_real-time_).
- **Dashboard Admin:** Fitur khusus admin untuk mengelola pemesanan, melihat laporan, dan mencetak laporan reservasi.
- **Notifikasi Email:** Pengiriman status reservasi ke email pengguna.
- **Otomatisasi Sistem:** Pengecekan otomatis (cron/command) untuk reservasi yang sudah kedaluwarsa.

## 🛠️ Persyaratan Sistem (Prerequisites)

Sebelum menjalankan aplikasi ini, pastikan sistem Anda memiliki hal-hal berikut:

- **PHP** (Versi 8.1 atau lebih baru)
- **Composer** (Manajer paket PHP)
- **Node.js & NPM** (Untuk kompilasi aset _frontend_ dengan Vite)
- **MySQL / MariaDB** (Untuk database)
- **Git** (Opsional, untuk _cloning_ repositori)

## ⚙️ Cara Instalasi (Installation)

Ikuti langkah-langkah berikut untuk menjalankan proyek di _local environment_ Anda:

1. **Clone Repositori**
    ```bash
    git clone <url-repo-github-anda>
    cd sm_sport
    ```
````

2. **Install Dependensi PHP (Composer)**

```bash
composer install

```

3. **Install Dependensi Node.js (NPM)**

```bash
npm install

```

4. **Konfigurasi Environment**
   Salin file konfigurasi _environment_ bawaan:

```bash
cp .env.example .env

```

5. **Generate Application Key**

```bash
php artisan key:generate

```

6. **Konfigurasi Database**
   Buka file `.env` dan sesuaikan kredensial database Anda:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_anda
DB_USERNAME=root
DB_PASSWORD=

```

7. **Migrasi dan Seeding Database**
   Jalankan migrasi untuk membuat tabel beserta data _dummy_ awal (seperti akun Admin dan data Lapangan):

```bash
php artisan migrate --seed

```

8. **Kompilasi Aset Frontend**

```bash
npm run dev
```

9. **Jalankan Aplikasi**

```bash
php artisan serve

```

10. **Task Scheduleri**

```bash
php artisan schedule:work
```

Aplikasi Anda sekarang dapat diakses melalui `http://localhost:8000`.

---

## 📧 Pengaturan Email Verifikasi (SMTP Gmail)

Agar fitur verifikasi email dan notifikasi reservasi berjalan dengan baik, Anda perlu mengatur SMTP menggunakan akun Gmail Anda. Ikuti 3 langkah mudah ini:

### 1. Buat "App Password" di Akun Google Anda

Karena kebijakan keamanan Google, Anda tidak boleh menggunakan password asli Gmail Anda. Anda harus membuat sandi khusus aplikasi:

- Masuk ke Akun Google Anda (pastikan **Verifikasi 2 Langkah / 2-Step Verification** sudah aktif).
- Cari menu **Sandi Aplikasi (App Passwords)** di pengaturan keamanan akun Google Anda.
- Buat nama aplikasi baru (misal: _SM Sport Center_), lalu klik **Buat**.
- Google akan memberikan 16 digit sandi (tanpa spasi). **Salin sandi tersebut**.

### 2. Atur File `.env`

Buka file `.env` di proyek Anda, lalu ubah pengaturan `MAIL` menjadi seperti ini:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=email_gmail_anda@gmail.com
MAIL_PASSWORD=masukkan_16_digit_app_password_disini
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=email_gmail_anda@gmail.com
MAIL_FROM_NAME="${APP_NAME}"

```

_(Ganti `email_gmail_anda@gmail.com` dan `MAIL_PASSWORD` dengan data milik Anda)._

### 3. Bersihkan Cache Konfigurasi

Karena Laravel menyimpan memori _cache_ dari file `.env`, bersihkan _cache_ tersebut lewat terminal:

```bash
php artisan config:clear
php artisan cache:clear

```

## 🏗️ Struktur Teknologi (Tech Stack)

- **Framework:** Laravel (PHP)
- **Frontend:** Blade Templating, Tailwind CSS, Alpine.js (bawaan Laravel Breeze)
- **Database:** MySQL
- **Tooling:** Vite, Composer, Artisan

## 📄 Lisensi

Proyek ini dibuat untuk keperluan sistem SM Sport Center. Silakan sesuaikan kebijakan lisensi sesuai kebutuhan institusi atau hak cipta Anda.

```

```
