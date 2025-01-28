<?php
session_start();
include '../config/db.php';

// Validasi role masyarakat
if ($_SESSION['role'] !== 'masyarakat') {
    header('Location: ../login.php');
    exit;
}

// Proses kirim laporan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $masyarakat_id = $_SESSION['id'];
    $anggaran_id = $_POST['anggaran_id'];
    $deskripsi = $_POST['deskripsi'];

    $stmt = $conn->prepare("INSERT INTO laporan (masyarakat_id, anggaran_id, deskripsi, status) VALUES (:masyarakat_id, :anggaran_id, :deskripsi, 'pending')");
    $stmt->bindParam(':masyarakat_id', $masyarakat_id);
    $stmt->bindParam(':anggaran_id', $anggaran_id);
    $stmt->bindParam(':deskripsi', $deskripsi);

    if ($stmt->execute()) {
        header('Location: masyarakat.php');
        exit;
    } else {
        echo "Gagal mengirim laporan.";
    }
}
?>
