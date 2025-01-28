<?php
session_start();
include '../config/db.php';

// Validasi role admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

// Hapus data berdasarkan ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM anggaran WHERE id = :id");
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        header('Location: admin.php');
        exit;
    } else {
        echo "Gagal menghapus data!";
    }
} else {
    header('Location: admin.php');
    exit;
}
?>
