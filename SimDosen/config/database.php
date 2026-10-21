<?php
// config/database.php

$host = "sql307.infinityfree.com"; // MySQL Hostname dari vPanel
$user = "if0_43163109";            // MySQL Username dari vPanel
$pass = "cLMQKgpzDas";     // Password akun InfinityFree
$db   = "if0_43163109_simdosen";  // Nama Database Lengkap di vPanel

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Koneksi Database Gagal: " . $e->getMessage());
}
?>