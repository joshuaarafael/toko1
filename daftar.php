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

                        $query = mysqli_query($koneksi, "INSERT INTO users(nama, username, password, role) VALUES('$nama', '$username', '$passwordHash', 'customer')");

                        if ($query) {
                            echo '<script>alert("Selamat, pendaftaran anda berhasil.")</script>';
                            echo '<script>window.location="login.php";</script>'; 
                        } else {
                            echo '<script>alert("Pendaftaran gagal. Silakan coba lagi.")</script>';
                        }
                    }
                }
            ?>

            <!-- HTML tetap sama -->
        </div>
    </div>
</body>
</html>
