<?php
session_start();
include "koneksi.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar ke APK</title>
    <link rel="stylesheet" href="login.css" />
</head>
<body>
    <div class="container">
        <div class="login-box">
            <?php
                if (isset($_POST['username'])) {
                    $nama = $_POST['nama'];
                    $username = $_POST['username'];
                    $password = $_POST['password']; 

                    if (empty($nama) || empty($username) || empty($password)) {
                        echo '<script>alert("Semua kolom harus diisi.")</script>';
                    } else {
                        $passwordHash = md5($password); 

                        $query = mysqli_query($koneksi, "INSERT INTO user(nama, username, password, role) VALUES('$nama', '$username', '$passwordHash', 'customer')");

                        if ($query) {
                            echo '<script>alert("Selamat, pendaftaran anda berhasil.")</script>';
                            echo '<script>window.location="login.php";</script>'; 
                        } else {
                            echo '<script>alert("Pendaftaran gagal. Silakan coba lagi.")</script>';
                        }
                    }
                }
            ?>

            <form method="POST">
                <h3>Pendaftaran Akun</h3>
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" placeholder="Masukan Nama">
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Masukan Username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Masukan Password">
                </div>
                <div class="form-group">
                    <button type="submit">Daftar User</button>
                </div>
                <p>Sudah punya akun? <a href="login.php">Login</a></p>
            </form>
        </div>
    </div>
</body>
</html>
