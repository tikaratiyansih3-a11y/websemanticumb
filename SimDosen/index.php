<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMDOSEN - Universitas Muhammadiyah Bengkulu</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        .hero-section {
            background: linear-gradient(135deg, #0d6efd 0%, #0a4b9c 100%);
            color: white;
            padding: 80px 0;
        }
        .feature-card {
            border: none;
            border-radius: 12px;
            transition: transform 0.2s ease-in-out;
        }
        .feature-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">
                <i class="bi bi-mortarboard-fill me-2"></i>SIMDOSEN UMB
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li class="nav-item me-2">
                            <a href="dashboard.php" class="btn btn-outline-light"><i class="bi bi-speedometer2 me-1"></i> Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a href="logout.php" class="btn btn-danger"><i class="bi bi-box-arrow-right me-1"></i> Logout</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a href="login.php" class="btn btn-primary px-4"><i class="bi bi-box-arrow-in-right me-1"></i> Login Portal</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 fw-bold mb-3">Sistem Informasi Manajemen Dosen</h1>
            <p class="lead mb-4">Fakultas Teknik - Program Studi Teknik Informatika<br>Universitas Muhammadiyah Bengkulu</p>
            <div>
                <?php if (!isset($_SESSION['user_id'])): ?>
                    <a href="login.php" class="btn btn-light btn-lg text-primary fw-bold px-4 me-2 shadow">Masuk Ke Sistem</a>
                <?php else: ?>
                    <a href="dashboard.php" class="btn btn-warning btn-lg fw-bold px-4 me-2 shadow">Buka Dashboard</a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <!-- Features Section -->
    <section class="container my-5">
        <div class="row g-4 text-center">
            <div class="col-md-4">
                <div class="card p-4 shadow-sm feature-card bg-white h-100">
                    <div class="text-primary mb-3">
                        <i class="bi bi-person-lines-fill display-4"></i>
                    </div>
                    <h5 class="fw-bold">Pendataan Terintegrasi</h5>
                    <p class="text-muted">Pengelolaan data dosen mulai dari NUPTK, NIP, Jabatan Fungsional, Kepangkatan hingga Serdos secara terpusat.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-4 shadow-sm feature-card bg-white h-100">
                    <div class="text-success mb-3">
                        <i class="bi bi-shield-lock-fill display-4"></i>
                    </div>
                    <h5 class="fw-bold">Keamanan RBAC</h5>
                    <p class="text-muted">Hak akses bertingkat berbasis peran (Role-Based Access Control) untuk Admin, Pimpinan, dan Dosen.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-4 shadow-sm feature-card bg-white h-100">
                    <div class="text-warning mb-3">
                        <i class="bi bi-file-earmark-pdf-fill display-4"></i>
                    </div>
                    <h5 class="fw-bold">Laporan & API</h5>
                    <p class="text-muted">Cetak laporan resmi daftar dosen aktif serta layanan RESTful API untuk integrasi sistem external.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <div class="container">
            <small>&copy; <?= date('Y') ?> Universitas Muhammadiyah Bengkulu. All rights reserved.</small>
        </div>
    </footer>

    <script href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>