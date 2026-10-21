<?php
require_once 'config/database.php';
require_once 'config/auth.php';
checkRole(['admin']);

if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("DELETE FROM dosen WHERE id_dosen = ?");
    $stmt->execute([$_GET['id']]);
}

header("Location: dosen.php");
exit;