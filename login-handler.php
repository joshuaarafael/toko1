<?php
session_start();
include "config.php";

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = isset($_POST['password']) ? md5($_POST['password']) : '';

    // Cek apakah username ada dulu
    $checkUser = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");

    if (!$checkUser) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Terjadi kesalahan query.',
            'reason' => 'query_failed'
        ]);
        exit();
    }

    if (mysqli_num_rows($checkUser) === 0) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Username tidak terdaftar.',
            'reason' => 'username_not_found'
        ]);
        exit();
    }

    // Jika username ditemukan, cek password
    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    
    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);
        $_SESSION['users'] = $data;

        echo json_encode([
            'status' => 'success',
            'role' => $data['role'],
            'name' => $data['nama'],
            'redirect' => $data['role'] === 'admin' ? 'admin.php' : 'customer.php'
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Password salah.',
            'reason' => 'password_wrong'
        ]);
    }

    exit();
}
