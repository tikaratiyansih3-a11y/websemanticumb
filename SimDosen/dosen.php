<?php
require_once 'config/database.php';
require_once 'config/auth.php';
checkLogin();

// Ambil Seluruh Data Dosen
$sql = "SELECT d.*, p.nama_prodi, f.nama_fakultas 
        FROM dosen d 
        JOIN prodi p ON d.id_prodi = p.id_prodi 
        JOIN fakultas f ON p.id_fakultas = f.id_fakultas 
        ORDER BY d.id_dosen DESC";
$stmt = $pdo->query($sql);
$dosen_list = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Dosen - SIMDOSEN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body class="bg-light p-4">

    <div class="container-fluid bg-white p-4 rounded shadow-sm">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-0">Daftar Dosen Aktif</h3>
                <small class="text-muted">Fakultas Teknik - Program Studi Teknik Informatika</small>
            </div>
            <div>
                <?php if ($_SESSION['role'] === 'admin'): ?>
                    <a href="dosen_form.php" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i> Tambah Dosen</a>
                <?php endif; ?>
                <a href="laporan.php" class="btn btn-success"><i class="bi bi-printer me-1"></i> Cetak Laporan</a>
                <a href="dashboard.php" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i> Dashboard</a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-striped border align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>No. Registrasi</th>
                        <th>NUPTK</th>
                        <th>Nama Dosen</th>
                        <th>NIP</th>
                        <th>Jabatan Fungsional</th>
                        <th>Pendidikan</th>
                        <th>Serdos</th>
                        <th>Status Aktivitas</th>
                        <?php if ($_SESSION['role'] === 'admin'): ?><th>Aksi</th><?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($dosen_list) > 0): ?>
                        <?php $no = 1; foreach ($dosen_list as $row): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($row['nomor_registrasi'] ?? '-') ?></td>
                            <td><?= htmlspecialchars($row['nuptk'] ?? '-') ?></td>
                            <td class="text-start fw-bold"><?= htmlspecialchars($row['nama']) ?></td>
                            <td><?= htmlspecialchars($row['nip'] ?? '-') ?></td>
                            <td><?= htmlspecialchars($row['jabatan_fungsional'] ?? '-') ?></td>
                            <td><?= htmlspecialchars($row['pendidikan_terakhir'] ?? '-') ?></td>
                            <td>
                                <span class="badge <?= $row['status_serdos'] === 'Lulus' ? 'bg-success' : 'bg-secondary' ?>">
                                    <?= htmlspecialchars($row['status_serdos']) ?>
                                </span>
                            </td>
                            <td><span class="badge bg-primary"><?= htmlspecialchars($row['status_aktivitas']) ?></span></td>
                            <?php if ($_SESSION['role'] === 'admin'): ?>
                            <td>
                                <a href="dosen_form.php?id=<?= $row['id_dosen'] ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i></a>
                                <a href="dosen_delete.php?id=<?= $row['id_dosen'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="bi bi-trash"></i></a>
                            </td>
                            <?php endif; ?>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="10" class="text-center py-4 text-muted">Belum ada data dosen tersimpan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>