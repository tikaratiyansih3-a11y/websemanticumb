<?php
// htdocs/api/dosen.php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../config/database.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        try {
            if (isset($_GET['id'])) {
                $stmt = $pdo->prepare("SELECT d.*, p.nama_prodi, f.nama_fakultas 
                                       FROM dosen d 
                                       JOIN prodi p ON d.id_prodi = p.id_prodi 
                                       JOIN fakultas f ON p.id_fakultas = f.id_fakultas 
                                       WHERE d.id_dosen = ?");
                $stmt->execute([$_GET['id']]);
                $result = $stmt->fetch();

                if ($result) {
                    http_response_code(200);
                    echo json_encode(["status" => "success", "data" => $result]);
                } else {
                    http_response_code(404);
                    echo json_encode(["status" => "error", "message" => "Data dosen tidak ditemukan"]);
                }
            } else {
                $stmt = $pdo->query("SELECT d.*, p.nama_prodi, f.nama_fakultas 
                                     FROM dosen d 
                                     JOIN prodi p ON d.id_prodi = p.id_prodi 
                                     JOIN fakultas f ON p.id_fakultas = f.id_fakultas 
                                     ORDER BY d.id_dosen DESC");
                $result = $stmt->fetchAll();

                http_response_code(200);
                echo json_encode(["status" => "success", "total_records" => count($result), "data" => $result]);
            }
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        if (!$data) $data = $_POST;

        if (!empty($data['nama'])) {
            try {
                $sql = "INSERT INTO dosen (nomor_registrasi, nuptk, nip, nama, id_prodi, jabatan_fungsional, kepangkatan, pendidikan_terakhir, rumpun_ilmu, status_serdos, status_pegawai, ikatan_kerja, status_aktivitas, penempatan) 
                        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    $data['nomor_registrasi'] ?? null,
                    $data['nuptk'] ?? null,
                    $data['nip'] ?? null,
                    $data['nama'],
                    $data['id_prodi'] ?? 1,
                    $data['jabatan_fungsional'] ?? null,
                    $data['kepangkatan'] ?? null,
                    $data['pendidikan_terakhir'] ?? null,
                    $data['rumpun_ilmu'] ?? null,
                    $data['status_serdos'] ?? 'Belum Sertifikasi',
                    $data['status_pegawai'] ?? null,
                    $data['ikatan_kerja'] ?? null,
                    $data['status_aktivitas'] ?? 'Aktif',
                    $data['penempatan'] ?? null
                ]);

                http_response_code(201);
                echo json_encode(["status" => "success", "message" => "Data dosen berhasil ditambahkan", "id_dosen" => $pdo->lastInsertId()]);
            } catch (PDOException $e) {
                http_response_code(500);
                echo json_encode(["status" => "error", "message" => $e->getMessage()]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["status" => "error", "message" => "Nama dosen wajib diisi"]);
        }
        break;

    case 'DELETE':
        $id = $_GET['id'] ?? null;
        if (!$id) {
            $input = json_decode(file_get_contents("php://input"), true);
            $id = $input['id'] ?? null;
        }

        if ($id) {
            try {
                $stmt = $pdo->prepare("DELETE FROM dosen WHERE id_dosen = ?");
                $stmt->execute([$id]);

                http_response_code(200);
                echo json_encode(["status" => "success", "message" => "Data dosen berhasil dihapus"]);
            } catch (PDOException $e) {
                http_response_code(500);
                echo json_encode(["status" => "error", "message" => $e->getMessage()]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["status" => "error", "message" => "Parameter ID dosen tidak ditemukan"]);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(["status" => "error", "message" => "Method Not Allowed"]);
        break;
}
?>