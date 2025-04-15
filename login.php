<?php
session_start();
include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? md5($_POST['password']) : ''; 

    if ($username && $password) {
        $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' AND password='$password'");
        
        if ($query === false) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Terjadi kesalahan dalam query: ' . mysqli_error($koneksi)
            ]);
            exit();
        }

        if (mysqli_num_rows($query) > 0) {
            $data = mysqli_fetch_assoc($query);
            $_SESSION['users'] = $data;

            if ($data['role'] === 'admin') {
                echo json_encode([
                    'status' => 'success',
                    'role' => 'admin',
                    'name' => $data['nama'],
                    'redirect' => 'admin.php'
                ]);
            } else {
                echo json_encode([
                    'status' => 'success',
                    'role' => 'customer',
                    'name' => $data['nama'],
                    'redirect' => 'customer.php'
                ]);
            }
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Username atau Password tidak sesuai.'
            ]);
        }
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Username dan Password harus diisi.'
        ]);
    }
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login ke APK</title>
    <link rel="stylesheet" href="login.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="login-box">
            <form id="login-form" method="POST">
                <h3>Login Akun</h3>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Masukan Username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Masukan Password" required>
                </div>
                <div class="form-group">
                    <button type="button" id="login-btn">Login</button>
                </div>
                <p>Belum punya akun? <a href="daftar.php">Daftar</a></p>
            </form>
        </div>
    </div>

    <script type="text/javascript">
    $(document).ready(function () {
        $('#login-btn').click(function () {

            const username = $('#username').val();
            const password = $('#password').val();

            $.ajax({
                url: 'login.php',
                type: 'POST',
                data: {
                    username: username,
                    password: password
                },
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        // Tampilkan pesan selamat datang
                        alert('Selamat datang, ' + response.name + '!');

                        // Redirect ke halaman sesuai role
                        window.location.href = response.redirect;
                    } else {
                        // Tampilkan pesan kesalahan
                        alert(response.message);
                    }
                },
                error: function () {
                    alert('Terjadi kesalahan, silakan coba lagi.');
                }
            });

            return false;
        });

        $('#login-form').on('keypress', function (e) {
            if (e.which === 13) {
                $('#login-btn').click(); 
            }
        });
    });
</script>

</body>
</html>
