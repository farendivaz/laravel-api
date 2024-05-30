# Laravel API Project

## Deskripsi
Ini adalah project API Laravel yang mendukung operasi CRUD untuk produk. API ini mendukung fitur upload gambar untuk produk. Semua data produk disimpan menggunakan MySQL.

## API Endpoints
Berikut adalah daftar endpoint yang tersedia dalam API ini:

- **Get All Products**
  - **URL:** `http://localhost:8000/api/products`
  - **Method:** `GET`
  - **Description:** Mendapatkan daftar semua produk.

- **Get Single Product**
  - **URL:** `http://localhost:8000/api/products/{id}`
  - **Method:** `GET`
  - **Description:** Mendapatkan detail produk berdasarkan ID.

- **Create Product**
  - **URL:** `http://localhost:8000/api/products`
  - **Method:** `POST`
  - **Description:** Menambahkan produk baru. Termasuk mendukung upload gambar.

- **Update Product**
  - **URL:** `http://localhost:8000/api/products/{id}`
  - **Method:** `PATCH`
  - **Description:** Memperbarui informasi produk berdasarkan ID.

- **Delete Product**
  - **URL:** `http://localhost:8000/api/products/{id}`
  - **Method:** `DELETE`
  - **Description:** Menghapus produk berdasarkan ID.



### Langkah-langkah Instalasi

1. **Clone Repository:**
   ```bash
   git clone https://github.com/farendivaz/laravel-api.git
   cd laravel-api
   ```

2. **Instalasi Dependensi:**
   ```bash
   composer install
   ```

3. **Salin file .env.example ke .env:**
   ```bash
   cp .env.example .env
   ```

4. **Konfigurasi Environment:**
   Edit file `.env` dan sesuaikan konfigurasi database Anda:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=laravel_api
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Generate Application Key:**
   ```bash
   php artisan key:generate
   ```

6. **Migrasi Database:**
   ```bash
   php artisan migrate
   ```

7. **Import file SQL:**
   Impor file SQL yang telah disediakan.

8. **Membuat Symbolic Link untuk Storage:**
   ```bash
   php artisan storage:link
   ```

9. **Menjalankan Server:**
   ```bash
   php artisan serve
   ```

Server akan berjalan di `http://localhost:8000`.
