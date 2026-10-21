<?php
// config/auth.php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function checkLogin() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php?msg=pls_login");
        exit;
    }
}

function checkRole(array $allowed_roles) {
    checkLogin();
    if (!in_array($_SESSION['role'], $allowed_roles)) {
        echo "<script>alert('Akses Ditolak! Anda tidak memiliki hak akses.'); window.location='dashboard.php';</script>";
        exit;
    }
}
?>