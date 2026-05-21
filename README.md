# Cahaya ATK Mandiri

Aplikasi web sederhana untuk memproses dan menampilkan pesanan alat tulis kantor dengan tampilan UI yang modern dan informatif.

## Fitur Utama:

* **UI/UX Modern, Bersih dan Simpel:** Menggunakan kerangka kerja Bootstrap 5 untuk tampilan yang bersih, kartu dengan efek bayangan, form dengan efek terapung, dan responsif terhadap perangkat mobile.
* **Pemilihan Alat Tulis:** Menu pemilihan alat tulis menggunakan drop down dengan harga satuan yang jelas.
* **Perhitungan Diskon Otomatis:** Memberikan diskon 10% jika total harga pemesanan lebih dari Rp 50.000.
* **Nota Pemesanan Informatif:** Menampilkan nota dalam bentuk list yang rapi, lengkap dengan detail nama, jumlah barang, potongan diskon, dan total tagihan.
* **Penyimpanan JSON:** Setiap pesanan berhasil disimpan ke dalam file `data.json`.
* **Kode yang Bersih:** Menggunakan fungsi PHP `htmlspecialchars()` untuk sanitasi data input agar lebih aman.
* **Struktur Folder yang Rapi:** Menempatkan file aset (CSS, img) ke dalam folder yang sesuai.

## Struktur Proyek:

```text
TugasPraktik_KakaDaviDharmawan/
├── assets/
│   ├── css/
│   │   └── bootstrap.css      (File CSS custom dan library bootstrap)
|   |   └── style.css
│   ├── img/
│   │   └── logo.png       (File logo cahaya atk mandiri)
├── index.php             (Halaman formulir pemesanan)
├── data.json             (File penyimpanan data pesanan)
└── README.md             (File deskripsi proyek)
```

## Cara Menjalankan Proyek:

1. **Siapkan Server Lokal (Web Server):**
   * Pastikan Anda sudah menginstal aplikasi server lokal seperti **XAMPP**
   * Aktifkan modul **Apache** pada *control panel* aplikasi server.

2. **Pindahkan Folder Proyek:**
   * Ekstrak atau pindahkan seluruh folder proyek `TugasPraktik_KakaDaviDharmawan` ke dalam direktori root server lokal Anda misalnya **XAMPP** kemudian pindahkan ke `C:\xampp\htdocs\`

3. **Siapkan File Aset (Opsional):**
   * Pastikan Anda sudah meletakkan gambar logo toko pilihan Anda di dalam folder `assets/img/` dengan nama file `logo.png`.

4. **Akses Melalui Browser:**
   * Buka browser favorit Anda (Google Chrome, Microsoft Edge, dll.).
   * Akses URL proyek dengan mengetikkan alamat berikut pada kolom *address bar*:
     ```text
     http://localhost/TugasPraktik_KakaDaviDharmawan/
     ```

5. **Simulasi Transaksi & Validasi:**
   * Isikan data pada **Formulir Pemesanan** (Nama, Pilihan Varian ATK dari Dropdown Array, dan Jumlah Barang).
   * Klik tombol **Proses Pesanan**.
   * Halaman akan melakukan pemrosesan data secara aman di sisi server (*server-side processing*) dan langsung bertukar tampilan menjadi lembar **Nota Pemesanan** di halaman yang sama tanpa memicu duplikasi kode.
   * Klik tombol **Cek File JSON** untuk memvalidasi bahwa data transaksi Anda telah berhasil terekam ke dalam struktur file `data.json`.

---