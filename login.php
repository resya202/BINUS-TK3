<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transparansi Anggaran dan Laporan Korupsi (TALK) - Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            position: relative;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: black;
            font-weight: bold;
            font-family: 'Arial', sans-serif;
            overflow: hidden;
        }
        /* Latar belakang dengan filter gelap */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('images/31507.jpg') no-repeat center center fixed;
            background-size: cover;
            filter: brightness(90%); /* Menggelapkan gambar */
            z-index: -1;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            background-color: rgba(255, 255, 255, 0.85); /* Transparansi latar belakang card */
        }
        .card-header {
            border-radius: 15px 15px 0 0;
            font-size: 1.5rem;
            font-weight: bold;
            background: linear-gradient(to right, #2575fc, #6a11cb);
            text-align: center;
            color: white;
        }
        .form-control {
            border-radius: 10px;
            padding: 12px;
            font-size: 1rem;
            border: 1px solid #ddd;
        }
        .btn-success {
            border-radius: 10px;
            font-size: 1rem;
            font-weight: bold;
            transition: 0.3s ease;
        }
        .btn-success:hover {
            background-color: #45c163;
            transform: scale(1.05);
        }
        .btn-secondary {
            border-radius: 10px;
            font-size: 1rem;
            font-weight: bold;
        }
        .card-body {
            padding: 30px;
        }
        .title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 20px;
            color: black;
        }
        .title span {
            color: #ffeb3b;
        }
        .subtitle {
            text-align: center;
            font-size: 1.2rem;
            font-weight: normal;
            margin-bottom: 20px;
            color: black;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="title">
                    Transparansi Anggaran dan <br> Laporan Korupsi (<span>TALK</span>)
                </div>
                <div class="subtitle">
                    Selamat datang di sistem pelaporan dan transparansi anggaran.
                </div>
                <div class="card">
                    <div class="card-header">
                        Login
                    </div>
                    <div class="card-body">
                        <form action="process/login.php" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Enter your username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success">Login</button>
                                <a href="register.php" class="btn btn-secondary">Register</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
