<?php
session_start();
session_destroy(); // Hapus semua data sesi
header('Location: /TALK/login.php'); // Redirect ke halaman login
exit;
?>