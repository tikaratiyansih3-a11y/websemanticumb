<?php
require_once 'config/database.php';
require_once 'config/auth.php';
checkLogin();

// Ambil data dosen terurut
$sql = "SELECT d.*, p.nama_prodi, f.nama_fakultas 
        FROM dosen d 
        JOIN prodi p ON d.id_prodi = p.id_prodi 
        JOIN fakultas f ON p.id_fakultas = f.id_fakultas 
        ORDER BY d.id_dosen ASC";
$stmt = $pdo->query($sql);
$dosen_list = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Daftar Dosen Aktif Universitas</title>
    <style>
        /* Pengaturan Halaman Cetak Kertas A4 Portrait */
        @page {
            size: A4 portrait;
            margin: 8mm;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 7.5pt;
            color: #000;
            margin: 0;
            padding: 0;
            background-color: #fff;
        }

        .no-print {
            background: #f8f9fa;
            padding: 10px 15px;
            border-bottom: 1px solid #dee2e6;
            margin-bottom: 15px;
        }

        .header-laporan {
            margin-bottom: 12px;
        }

        .header-laporan h3 {
            margin: 0 0 6px 0;
            font-size: 11pt;
            font-weight: bold;
            text-transform: uppercase;
        }

        .header-laporan table {
            border: none;
            width: auto;
            margin-bottom: 5px;
        }

        .header-laporan td {
            border: none;
            padding: 1px 6px 1px 0;
            font-size: 8.5pt;
        }

        /* Tabel Data 13 Kolom Ditata Kompak untuk Portrait */
        table.data-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        table.data-table, table.data-table th, table.data-table td {
            border: 1px solid #000;
        }

        table.data-table th {
            background-color: #e9ecef;
            padding: 4px 2px;
            text-align: center;
            font-weight: bold;
            font-size: 7pt;
            word-wrap: break-word;
        }

        table.data-table td {
            padding: 3px 2px;
            vertical-align: middle;
            font-size: 6.5pt;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        .text-center { text-align: center; }

        /* Pengaturan Cetak / Print */
        @media print {
            .no-print { display: none !important; }
            body { margin: 0; }
            table.data-table th {
                background-color: #f2f2f2 !important;
                -webkit-print-color-adjust: exact;
            }
        }
    </style>
</head>
<body>

    <!-- Tombol Aksi Non-Print -->
    <div class="no-print">
        <button onclick="window.print()" style="padding: 8px 16px; background-color: #0d6efd; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">
            🖨️ Cetak / Simpan PDF (A4 Portrait)
        </button>
        <a href="dosen.php" style="margin-left: 15px; text-decoration: none; color: #333; font-size: 9pt;">← Kembali ke Data Dosen</a>
    </div>

    <div style="padding: 5px;">
        <!-- Header Laporan Sesuai Gambar -->
        <div class="header-laporan">
            <h3>Daftar Dosen Aktif Universitas</h3>
            <table>
                <tr>
                    <td><strong>Universitas</strong></td>
                    <td>: Universitas Muhammadiyah Bengkulu</td>
                </tr>
                <tr>
                    <td><strong>Fakultas</strong></td>
                    <td>: Teknik</td>
                </tr>
                <tr>
                    <td><strong>Program Studi</strong></td>
                    <td>: Teknik Informatika</td>
                </tr>
            </table>
        </div>

        <!-- Tabel Data 13 Kolom Disesuaikan untuk A4 Portrait -->
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 3%;">No</th>
                    <th style="width: 7%;">Nomor Registrasi</th>
                    <th style="width: 7%;">NUPTK</th>
                    <th style="width: 13%;">Nama</th>
                    <th style="width: 7%;">NIP</th>
                    <th style="width: 8%;">Jabatan Fungsional</th>
                    <th style="width: 8%;">Kepangkatan</th>
                    <th style="width: 6%;">Pendidikan Terakhir</th>
                    <th style="width: 8%;">Rumpun Ilmu</th>
                    <th style="width: 7%;">Status Serdos</th>
                    <th style="width: 7%;">Status Pegawai</th>
                    <th style="width: 6%;">Ikatan Kerja</th>
                    <th style="width: 6%;">Status Aktivitas</th>
                    <th style="width: 7%;">Penempatan</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($dosen_list) > 0): ?>
                    <?php $no = 1; foreach ($dosen_list as $row): ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td><?= htmlspecialchars($row['nomor_registrasi'] ?? '') ?></td>
                        <td><?= htmlspecialchars($row['nuptk'] ?? '') ?></td>
                        <td><strong><?= htmlspecialchars($row['nama'] ?? '') ?></strong></td>
                        <td><?= htmlspecialchars($row['nip'] ?? '') ?></td>
                        <td><?= htmlspecialchars($row['jabatan_fungsional'] ?? '') ?></td>
                        <td><?= htmlspecialchars($row['kepangkatan'] ?? '') ?></td>
                        <td class="text-center"><?= htmlspecialchars($row['pendidikan_terakhir'] ?? '') ?></td>
                        <td><?= htmlspecialchars($row['rumpun_ilmu'] ?? '') ?></td>
                        <td class="text-center"><?= htmlspecialchars($row['status_serdos'] ?? '') ?></td>
                        <td><?= htmlspecialchars($row['status_pegawai'] ?? '') ?></td>
                        <td><?= htmlspecialchars($row['ikatan_kerja'] ?? '') ?></td>
                        <td class="text-center"><?= htmlspecialchars($row['status_aktivitas'] ?? '') ?></td>
                        <td><?= htmlspecialchars($row['penempatan'] ?? '') ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="14" class="text-center" style="padding: 15px;">Data dosen tidak ditemukan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>
</html>