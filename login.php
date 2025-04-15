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
            $_SESSION['user'] = $data;

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

<!-- HTML login tetap sama -->
