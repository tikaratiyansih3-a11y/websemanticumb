<?php
require_once 'config/database.php';
require_once 'config/auth.php';
checkRole(['admin']); // Hanya Admin yang bisa mengakses form ini

$id_dosen = $_GET['id'] ?? null;
$dosen = [
    'nomor_registrasi' => '', 'nuptk' => '', 'nip' => '', 'nama' => '',
    'id_prodi' => 1, 'jabatan_fungsional' => '', 'kepangkatan' => '',
    'pendidikan_terakhir' => '', 'rumpun_ilmu' => '', 'status_serdos' => 'Belum Sertifikasi',
    'status_pegawai' => '', 'ikatan_kerja' => '', 'status_aktivitas' => 'Aktif', 'penempatan' => ''
];

if ($id_dosen) {
    $stmt = $pdo->prepare("SELECT * FROM dosen WHERE id_dosen = ?");
    $stmt->execute([$id_dosen]);
    $data = $stmt->fetch();
    if ($data) $dosen = $data;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $params = [
        $_POST['nomor_registrasi'], $_POST['nuptk'], $_POST['nip'], $_POST['nama'],
        $_POST['id_prodi'], $_POST['jabatan_fungsional'], $_POST['kepangkatan'],
        $_POST['pendidikan_terakhir'], $_POST['rumpun_ilmu'], $_POST['status_serdos'],
        $_POST['status_pegawai'], $_POST['ikatan_kerja'], $_POST['status_aktivitas'], $_POST['penempatan']
    ];

    if ($id_dosen) {
        $sql = "UPDATE dosen SET nomor_registrasi=?, nuptk=?, nip=?, nama=?, id_prodi=?, jabatan_fungsional=?, kepangkatan=?, pendidikan_terakhir=?, rumpun_ilmu=?, status_serdos=?, status_pegawai=?, ikatan_kerja=?, status_aktivitas=?, penempatan=? WHERE id_dosen=?";
        $params[] = $id_dosen;
    } else {
        $sql = "INSERT INTO dosen (nomor_registrasi, nuptk, nip, nama, id_prodi, jabatan_fungsional, kepangkatan, pendidikan_terakhir, rumpun_ilmu, status_serdos, status_pegawai, ikatan_kerja, status_aktivitas, penempatan) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    header("Location: dosen.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $id_dosen ? 'Edit' : 'Tambah' ?> Dosen - SIMDOSEN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">

<div class="container bg-white p-4 rounded shadow-sm" style="max-width: 900px;">
    <h4 class="fw-bold mb-4"><?= $id_dosen ? 'Edit Data' : 'Tambah Data' ?> Dosen</h4>
    
    <form method="POST" class="row g-3">
        <div class="col-md-4">
            <label class="form-label">Nomor Registrasi</label>
            <input type="text" name="nomor_registrasi" class="form-control" value="<?= htmlspecialchars($dosen['nomor_registrasi'] ?? '') ?>">
        </div>
        <div class="col-md-4">
            <label class="form-label">NUPTK</label>
            <input type="text" name="nuptk" class="form-control" value="<?= htmlspecialchars($dosen['nuptk'] ?? '') ?>">
        </div>
        <div class="col-md-4">
            <label class="form-label">NIP</label>
            <input type="text" name="nip" class="form-control" value="<?= htmlspecialchars($dosen['nip'] ?? '') ?>">
        </div>

        <div class="col-md-8">
            <label class="form-label">Nama Dosen <span class="text-danger">*</span></label>
            <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($dosen['nama'] ?? '') ?>" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Program Studi</label>
            <select name="id_prodi" class="form-select">
                <option value="1" <?= $dosen['id_prodi'] == 1 ? 'selected' : '' ?>>Teknik Informatika</option>
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Jabatan Fungsional</label>
            <input type="text" name="jabatan_fungsional" class="form-control" value="<?= htmlspecialchars($dosen['jabatan_fungsional'] ?? '') ?>">
        </div>
        <div class="col-md-6">
            <label class="form-label">Kepangkatan</label>
            <input type="text" name="kepangkatan" class="form-control" value="<?= htmlspecialchars($dosen['kepangkatan'] ?? '') ?>">
        </div>

        <div class="col-md-4">
            <label class="form-label">Pendidikan Terakhir</label>
            <input type="text" name="pendidikan_terakhir" class="form-control" placeholder="S2 / S3" value="<?= htmlspecialchars($dosen['pendidikan_terakhir'] ?? '') ?>">
        </div>
        <div class="col-md-4">
            <label class="form-label">Rumpun Ilmu</label>
            <input type="text" name="rumpun_ilmu" class="form-control" value="<?= htmlspecialchars($dosen['rumpun_ilmu'] ?? '') ?>">
        </div>
        <div class="col-md-4">
            <label class="form-label">Status Serdos</label>
            <select name="status_serdos" class="form-select">
                <option value="Lulus" <?= ($dosen['status_serdos'] ?? '') === 'Lulus' ? 'selected' : '' ?>>Lulus</option>
                <option value="Belum Sertifikasi" <?= ($dosen['status_serdos'] ?? '') === 'Belum Sertifikasi' ? 'selected' : '' ?>>Belum Sertifikasi</option>
            </select>
        </div>

        <div class="col-md-4">
            <label class="form-label">Status Pegawai</label>
            <input type="text" name="status_pegawai" class="form-control" value="<?= htmlspecialchars($dosen['status_pegawai'] ?? '') ?>">
        </div>
        <div class="col-md-4">
            <label class="form-label">Ikatan Kerja</label>
            <input type="text" name="ikatan_kerja" class="form-control" value="<?= htmlspecialchars($dosen['ikatan_kerja'] ?? '') ?>">
        </div>
        <div class="col-md-4">
            <label class="form-label">Status Aktivitas</label>
            <select name="status_aktivitas" class="form-select">
                <option value="Aktif" <?= ($dosen['status_aktivitas'] ?? '') === 'Aktif' ? 'selected' : '' ?>>Aktif</option>
                <option value="Cuti" <?= ($dosen['status_aktivitas'] ?? '') === 'Cuti' ? 'selected' : '' ?>>Cuti</option>
                <option value="Tugas Belajar" <?= ($dosen['status_aktivitas'] ?? '') === 'Tugas Belajar' ? 'selected' : '' ?>>Tugas Belajar</option>
            </select>
        </div>

        <div class="col-md-12">
            <label class="form-label">Penempatan</label>
            <input type="text" name="penempatan" class="form-control" value="<?= htmlspecialchars($dosen['penempatan'] ?? '') ?>">
        </div>

        <div class="col-12 mt-4">
            <button type="submit" class="btn btn-success">Simpan Data</button>
            <a href="dosen.php" class="btn btn-secondary me-2">Batal</a>
        </div>
    </form>
</div>

</body>
</html>