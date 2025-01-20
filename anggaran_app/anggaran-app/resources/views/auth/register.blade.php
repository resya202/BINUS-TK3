<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - TALaK</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .register-container {
            background: #ffffff;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        .register-container h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;
        }
        .register-container h2 {
            font-size: 18px;
            color: #007bff;
            margin-bottom: 20px;
        }
        .register-container label {
            font-size: 14px;
            color: #555;
            margin-bottom: 5px;
            display: block;
            text-align: left;
        }
        .register-container input,
        .register-container select {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }
        .register-container button {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .register-container button:hover {
            background-color: #0056b3;
        }
        .register-container .login-link {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }
        .register-container .login-link a {
            color: #007bff;
            text-decoration: none;
        }
        .register-container .login-link a:hover {
            text-decoration: underline;
        }
        .error-message {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h1>Register</h1>
        <h2>Transparansi Anggaran dan Laporan Korupsi (TALaK)</h2>
        @if ($errors->any())
            <div class="error-message">
                {{ $errors->first() }}
            </div>
        @endif
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <label for="name">Nama</label>
            <input type="text" id="name" name="name" placeholder="Masukkan nama" required>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Masukkan email" required>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Masukkan password" required>
            <label for="password_confirmation">Konfirmasi Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi password" required>
            <label for="role">Role</label>
            <select id="role" name="role">
                <option value="masyarakat">Masyarakat</option>
                <option value="pengawas">Pengawas</option>
                <option value="admin">Admin</option>
            </select>
            <button type="submit">Register</button>
        </form>
        <div class="login-link">
            <p>Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></p>
        </div>
    </div>
</body>
</html>
