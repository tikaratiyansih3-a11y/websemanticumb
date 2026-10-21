<?php
require_once 'config/database.php';
require_once 'config/auth.php';
checkLogin();

// Hitung Ringkasan Data
try {
    $total_dosen  = $pdo->query("SELECT COUNT(*) FROM dosen")->fetchColumn();
    $dosen_aktif  = $pdo->query("SELECT COUNT(*) FROM dosen WHERE status_aktivitas = 'Aktif'")->fetchColumn();
    $dosen_serdos = $pdo->query("SELECT COUNT(*) FROM dosen WHERE status_serdos = 'Lulus'")->fetchColumn();
} catch (PDOException $e) {
    $total_dosen = $dosen_aktif = $dosen_serdos = 0;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SIMDOSEN UM Bengkulu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        .sidebar { min-height: 100vh; background-color: #1e293b; }
        .sidebar a { color: #cbd5e1; text-decoration: none; padding: 10px 15px; display: block; border-radius: 6px; }
        .sidebar a:hover, .sidebar a.active { background-color: #0d6efd; color: white; }
    </style>
</head>
<body class="bg-light">

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar Navigation -->
        <div class="col-md-3 col-lg-2 p-3 sidebar">
            <h5 class="text-white fw-bold mb-3"><i class="bi bi-mortarboard-fill me-2"></i>SIMDOSEN</h5>
            <div class="text-white-50 small mb-4">
                User: <strong><?= htmlspecialchars($_SESSION['nama']) ?></strong><br>
                Role: <span class="badge bg-info text-dark"><?= strtoupper($_SESSION['role']) ?></span>
            </div>
            <nav>
                <a href="dashboard.php" class="active mb-1"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
                <a href="dosen.php" class="mb-1"><i class="bi bi-people me-2"></i> Data Dosen</a>
                <a href="laporan.php" class="mb-1"><i class="bi bi-file-earmark-text me-2"></i> Laporan</a>
                <hr class="text-secondary">
                <a href="logout.php" class="text-danger"><i class="bi bi-box-arrow-right me-2"></i> Logout</a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 col-lg-10 p-4">
            <h3 class="fw-bold mb-1">Dashboard Utama</h3>
            <p class="text-muted">Selamat datang di Sistem Informasi Manajemen Dosen Universitas Muhammadiyah Bengkulu.</p>

            <div class="row g-3 mt-2">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm bg-primary text-white p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">Total Dosen</h6>
                                <h2 class="fw-bold mb-0"><?= $total_dosen ?></h2>
                            </div>
                            <i class="bi bi-people-fill display-4 opacity-50"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm bg-success text-white p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">Dosen Aktif</h6>
                                <h2 class="fw-bold mb-0"><?= $dosen_aktif ?></h2>
                            </div>
                            <i class="bi bi-check-circle-fill display-4 opacity-50"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm bg-warning text-dark p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">Sertifikasi Dosen (Serdos)</h6>
                                <h2 class="fw-bold mb-0"><?= $dosen_serdos ?></h2>
                            </div>
                            <i class="bi bi-award-fill display-4 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm mt-4 p-4">
                <h5 class="fw-bold mb-3">Informasi Program Studi</h5>
                <p class="mb-1"><strong>Fakultas:</strong> Teknik</p>
                <p class="mb-0"><strong>Program Studi:</strong> Teknik Informatika</p>
            </div>
        </div>
    </div>
</div>

</body>
</html>