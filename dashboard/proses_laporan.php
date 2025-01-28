<?php
session_start();
include '../config/db.php';

// Validasi role petugas
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'petugas') {
    header('Location: ../login.php');
    exit;
}

// Ambil ID dan status laporan dari URL
if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = $_GET['id'];
    $status = $_GET['status'];

    // Validasi status yang diperbolehkan
    if (in_array($status, ['diterima', 'ditolak'])) {
        $stmt = $conn->prepare("UPDATE laporan SET status = :status WHERE id = :id");
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            header('Location: petugas.php');
            exit;
        } else {
            echo "Gagal memproses laporan.";
        }
    } else {
        echo "Status tidak valid.";
    }
} else {
    header('Location: petugas.php');
    exit;
}
?>
