# 📰 News Portal Platform

![Laravel](https://img.shields.io/badge/Laravel-Framework-red)
![License](https://img.shields.io/github/license/muhamadandy/news-portal-platform)

News Portal Platform adalah aplikasi web portal berita yang dibangun menggunakan **Laravel** dan **Tailwind CSS**. Aplikasi ini memungkinkan admin mengelola berita, kategori, dan konten lainnya secara efisien.

---

## 🚀 Fitur

- 📝 Manajemen Berita (CRUD)
- 📂 Kategori Berita
- 🔐 Autentikasi Pengguna (Login & Register)
- 📱 Desain Responsif (Tailwind CSS)
- ⚡ Build Frontend dengan Vite

---

## ⚙️ Prasyarat

Pastikan kamu sudah menginstall:

- PHP >= 8.x
- Composer
- Node.js & npm
- MySQL / MariaDB

---

## 📦 Instalasi

```bash
git clone https://github.com/muhamadandy/news-portal-platform.git
cd news-portal-platform

# Install dependency backend
composer install

# Install dependency frontend
npm install

cp .env.example .env

php artisan key:generate

### Konfigurasi `.env`
```md
## ⚙️ Konfigurasi Environment

Edit file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=


### Jalankan Aplikasi
```md
## ▶️ Menjalankan Aplikasi

```bash
npm run dev
php artisan serve


