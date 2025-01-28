<?php
session_start();
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Set session data
        $_SESSION['id'] = $user['id']; // Pastikan tabel users memiliki kolom id
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        // Arahkan ke dashboard sesuai role
        if ($user['role'] === 'admin') {
            header('Location: ../dashboard/admin.php');
        } elseif ($user['role'] === 'petugas') {
            header('Location: ../dashboard/petugas.php');
        } elseif ($user['role'] === 'masyarakat') {
            header('Location: ../dashboard/masyarakat.php');
        }
        exit;
    } else {
        // Jika login gagal
        $_SESSION['error'] = 'Invalid username or password';
        header('Location: ../login.php');
        exit;
    }
} else {
    header('Location: ../login.php');
    exit;
}
?>
