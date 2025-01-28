<?php
session_start();
include '../config/db.php';

// Validasi role masyarakat
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'masyarakat') {
    header('Location: ../login.php');
    exit;
}

// Ambil informasi akun
$username = $_SESSION['username'];
$role = $_SESSION['role'];

// Ambil data anggaran
$query = $conn->query("SELECT * FROM anggaran");
$anggaran = $query->fetchAll(PDO::FETCH_ASSOC);

// Pastikan tabel laporan memiliki kolom anggaran_id dan ambil data laporan masyarakat
$masyarakat_id = $_SESSION['id'];
try {
    $stmt = $conn->prepare("
        SELECT laporan.id, laporan.deskripsi, laporan.status, laporan.tanggal_laporan, 
               anggaran.nama_kegiatan AS anggaran_nama
        FROM laporan
        LEFT JOIN anggaran ON laporan.anggaran_id = anggaran.id
        WHERE laporan.masyarakat_id = :masyarakat_id
        ORDER BY laporan.tanggal_laporan DESC
    ");
    $stmt->bindParam(':masyarakat_id', $masyarakat_id);
    $stmt->execute();
    $laporan = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching data: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Masyarakat</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <!-- Header Info Akun dan Logout -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <strong>Logged in as:</strong> <?= htmlspecialchars($username); ?> 
                (<em><?= htmlspecialchars($role); ?></em>)
            </div>
            <a href="../logout.php" class="btn btn-danger btn-sm">Logout</a>
        </div>

        <!-- Judul Dashboard -->
        <h1 class="text-center">Dashboard Masyarakat</h1>

        <!-- Data Anggaran -->
        <div class="my-4">
            <h2>Data Anggaran</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kegiatan</th>
                        <th>Jumlah Anggaran</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($anggaran as $index => $row): ?>
                        <tr>
                            <td><?= $index + 1; ?></td>
                            <td><?= htmlspecialchars($row['nama_kegiatan']); ?></td>
                            <td>Rp <?= number_format($row['jumlah_anggaran'], 2, ',', '.'); ?></td>
                            <td><?= $row['tanggal']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Data Laporan -->
        <div class="my-4">
            <h2>Laporan Anda</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Deskripsi</th>
                        <th>Anggaran Terkait</th>
                        <th>Status</th>
                        <th>Tanggal Laporan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($laporan as $index => $row): ?>
                        <tr>
                            <td><?= $index + 1; ?></td>
                            <td><?= htmlspecialchars($row['deskripsi']); ?></td>
                            <td><?= htmlspecialchars($row['anggaran_nama'] ?? 'Tidak Diketahui'); ?></td> <!-- Kolom anggaran terkait -->
                            <td><?= ucfirst($row['status']); ?></td>
                            <td><?= $row['tanggal_laporan']; ?></td>
                            <td>
                                <a href="detail_laporan.php?id=<?= $row['id']; ?>" class="btn btn-info btn-sm">Detail</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Form Kirim Laporan -->
        <div class="my-4">
            <h2>Buat Laporan</h2>
            <form action="laporan.php" method="POST">
                <div class="mb-3">
                    <label for="anggaran_id" class="form-label">Pilih Anggaran</label>
                    <select name="anggaran_id" id="anggaran_id" class="form-select" required>
                        <option value="" disabled selected>Pilih anggaran</option>
                        <?php foreach ($anggaran as $row): ?>
                            <option value="<?= $row['id']; ?>"><?= htmlspecialchars($row['nama_kegiatan']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi Laporan</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control" rows="5" placeholder="Tulis laporan Anda di sini..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Kirim Laporan</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
