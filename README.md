# 📰 News Portal Platform


## Akses aplikasi di browser:  
🌐 https://news-portal-platform-production.up.railway.app/

-login sebagai admin endpoint: /admin/login<br/>
-admin user:<br/>
-email: demo@gmail.com<br/> 
-password: demo1234<br/>

-login sebagai user biasa endpoint: /login<br/>
-user biasa :<br/>
-email: john@gmail.com <br/> 
-password: john1234<br/>


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

Clone repository:

<pre><code>git clone https://github.com/muhamadandy/news-portal-platform.git</code></pre>

Masuk ke folder project:

<pre><code>cd news-portal-platform</code></pre>

Install dependency backend:

<pre><code>composer install</code></pre>

Install dependency frontend:

<pre><code>npm install</code></pre>

Salin file konfigurasi environment:

<pre><code>cp .env.example .env</code></pre>

Generate application key:

<pre><code>php artisan key:generate</code></pre>

---

## ⚙️ Konfigurasi Environment

Edit file `.env` dan sesuaikan konfigurasi database kamu:

<pre><code>DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=
</code></pre>

---

## 🌱 Migrasi & Seeder

Jalankan migrasi database:

<pre><code>php artisan migrate</code></pre>

(Opsional) Isi database dengan data dummy:

<pre><code>php artisan db:seed</code></pre>

---

## ▶️ Menjalankan Aplikasi

Jalankan frontend (Vite):

<pre><code>npm run dev</code></pre>

Jalankan backend (Laravel):

<pre><code>php artisan serve</code></pre>
---
