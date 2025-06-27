# SPK Waspas - Sistem Penunjang Keputusan Munaqashah

## Persyaratan

- PHP 8 ke atas (disarankan menggunakan XAMPP atau Laragon)
- VS Code
- Ekstensi `zip` harus aktif pada PHP

### Cara mengaktifkan ekstensi ZIP:

**XAMPP**

1. Buka `php.ini` dari control panel XAMPP.
2. Cari baris `;extension=zip` dan hapus titik koma (`;`) di depannya.
3. Restart Apache.

**Laragon**

1. Buka `php.ini` dari menu Laragon > PHP > php.ini.
2. Cari baris `;extension=zip` dan hapus titik koma (`;`) di depannya.
3. Restart Laragon.

## Langkah Instalasi

1. Buat database baru dengan nama: `db_spk_waspas` (bisa diganti sesuai kebutuhan).
2. Jalankan perintah berikut di terminal:
   ```bash
   php spark migrate
   php spark db:seed DefaultSeeder
   ```
3. Jalankan server:
   ```bash
   php spark serve
   ```
4. Buka browser dan akses: `http://localhost:8080`
5. Selesai 🎉

## Akun Default

### Admin

- Email: admin@gmail.com
- Password: admin

### Guru Penguji

- Email: gurupenguji@gmail.com
- Password: gurupenguji
