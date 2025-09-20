# 🏫 Aplikasi Pembayaran SPP

Aplikasi sederhana untuk mengelola pembayaran SPP di sekolah. Aplikasi ini mendukung login untuk **Admin, Petugas, dan Siswa**, pencatatan pembayaran, dan pencetakan laporan.

## 🧑‍💼 Fitur Utama

* Login dengan username dan password:

  * **Admin / Petugas / Siswa**
  * Contoh login awal:

    * **Username:** `yamin123`
    * **Password:** `admin`
* Kelola data siswa
* Pencatatan pembayaran SPP per bulan:

  * Cari siswa berdasarkan **NISN**
  * Pilih tanggal pembayaran dan bayar
  * Pembayaran **tidak bisa double**
* Ganti password
* Cetak laporan pembayaran dengan nama petugas

## 💻 Instalasi

1. Pastikan sudah terinstall **XAMPP** atau server lokal lain yang mendukung PHP & MySQL
2. Clone atau download proyek ini
3. Letakkan di folder `htdocs` (jika menggunakan XAMPP)
4. Import database:

   * File database: `db_spp.sql` (terletak di root proyek)
   * Gunakan **phpMyAdmin** atau tool MySQL lain
5. Login melalui browser:

   ```
   http://localhost/Aplikasi-Pembayaran-SPP/
   ```

## 🛠️ Akun Pengguna

* Akun masih perlu ditambahkan **manual di database**, khususnya di tabel `petugas`
* Password disimpan dalam bentuk **SHA1**
* Contoh data akun:

```sql
INSERT INTO `petugas` (`id_petugas`, `username`, `password`, `nama_petugas`, `level`, `photo`) VALUES
(56, 'dedi123', 'a642a77abd7d4f51bf9226ceaf891fcbb5b299b8', 'Dedi Mulyadi', 'admin', 'default.png'),
(57, 'zaki123', '14993032bd035408dd9ab6f6e6ad0b023eced296', 'Muhammad Zaki', 'siswa', 'default.png'),
(58, 'aini123', 'f638e2789006da9bb337fd5689e37a265a70f359', 'Aini Fitriana', 'petugas', 'default.png'),
(60, 'yamin123', 'f865b53623b121fd34ee5426c792e5c33af8c227', 'Muhammad Yamin', 'admin', 'default.png');
```

> 💡 Catatan: Gunakan **SHA1('password')** untuk password baru jika menambahkan akun manual.

## 📝 Lisensi & Kredit

Aplikasi ini dikembangkan oleh **M. Yamin, S.Kom** untuk keperluan pengelolaan SPP sekolah.

Template HTML admin dashboard yang digunakan berdasarkan **Sufee HTML5 Admin Dashboard Template**.

**License**
Sufee is licensed under The MIT License (MIT).

**Dikembangkan oleh:** M. Yamin, S.Kom

---

> 💡 Catatan: Saat pertama kali login, disarankan untuk mengganti password default demi keamanan.
