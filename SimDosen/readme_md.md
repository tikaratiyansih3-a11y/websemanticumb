# 🎓 SIMDOSEN - Sistem Informasi Manajemen Dosen UM Bengkulu

Aplikasi Web Tradisional & RESTful Web Service (API) untuk pengelolaan data dosen berbasis PHP Native dan MySQL. Dikembangkan khusus untuk Program Studi Teknik Informatika, Fakultas Teknik, Universitas Muhammadiyah Bengkulu.

---

## 📌 Fitur Utama

- **Landing Page (Publik)**: Halaman depan responsif dengan informasi umum sistem.
- **Autentikasi & RBAC (Role-Based Access Control)**:
  - Multi-level user access (`admin`, `pimpinan`, `dosen`).
  - Proteksi halaman berbasis sesi dan middleware RBAC.
- **Dashboard Interaktif**: Ringkasan statistik jumlah dosen, dosen aktif, dan dosen tersertifikasi (Serdos).
- **Manajemen Data Dosen (CRUD)**:
  - Olah data kualifikasi akademik, jabatan fungsional, NUPTK, NIP, status serdos, hingga ikatan kerja.
- **Laporan Cetak (Format A4 Portrait)**:
  - Ekspor/Cetak laporan resmi daftar dosen aktif siap cetak atau simpan ke PDF.
- **RESTful Web Service (API)**:
  - Endpoint JSON (`GET`, `POST`, `DELETE`) untuk integrasi dengan sistem pihak ketiga atau aplikasi mobile.

---

## 📂 Struktur Direktori Proyek

```text
htdocs/
├── config/
│   ├── database.php        # Konfigurasi koneksi MySQL (PDO)
│   └── auth.php            # Middleware autentikasi & proteksi role
├── api/
│   └── dosen.php           # RESTful API Service (Format JSON)
├── index.php               # Landing Page utama
├── login.php               # Halaman Login
├── logout.php              # Sesi Logout
├── dashboard.php           # Panel Dashboard utama
├── dosen.php               # Tabel Data Dosen (Tampilan CRUD)
├── dosen_form.php          # Form Tambah & Edit Dosen
├── dosen_delete.php        # Handling aksi hapus data
└── laporan.php            # Format laporan cetak A4 Portrait
```

## 🔑 Akun Login Default

| Username     | Password   | Role             | Hak Akses                        |
| :----------- | :--------- | :--------------- | :------------------------------- |
| **admin**    | `admin123` | Administrator    | Akses Penuh (CRUD + Cetak + API) |
| **pimpinan** | `admin123` | Pimpinan / Dekan | Lihat Data + Cetak Laporan       |

---

## 🌐 Dokumentasi RESTful API

Base Endpoint: `http://<domain_anda>/api/dosen.php`

| Method     | URL / Endpoint        | Deskripsi                    | Form Body / Query                  |
| :--------- | :-------------------- | :--------------------------- | :--------------------------------- |
| **GET**    | `/api/dosen.php`      | Mengambil seluruh data dosen | -                                  |
| **GET**    | `/api/dosen.php?id=1` | Mengambil detail 1 dosen     | `id` (Query string)                |
| **POST**   | `/api/dosen.php`      | Menambah data dosen baru     | RAW JSON Body (`nama`, `nip`, dll) |
| **DELETE** | `/api/dosen.php?id=1` | Menghapus data dosen         | `id` (Query string)                |

---

## 🛠️ Teknologi yang Digunakan

- **PHP** (Native PDO)
- **MySQL** (Database relational)
- **Bootstrap 5** & **Bootstrap Icons** (UI Framework)
- **CSS3 `@page` Media Print** (Format Cetak A4 Portrait)
