<?php
session_start();
include "koneksi.php";

header('Content-Type: application/json');

if (!$koneksi) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Gagal koneksi ke database: ' . mysqli_connect_error()
    ]);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $newPassword = $_POST['new-password'] ?? '';
    $confirmPassword = $_POST['confirm-password'] ?? '';

    if ($username && $newPassword && $confirmPassword) {
        if ($newPassword === $confirmPassword) {
            $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");

            if (mysqli_num_rows($query) > 0) {
                $hashed = md5($newPassword); // Boleh diganti dengan password_hash
                $update = mysqli_query($koneksi, "UPDATE users SET password='$hashed' WHERE username='$username'");

                if ($update) {
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Password berhasil diperbarui!'
                    ]);
                } else {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Gagal mengupdate password.'
                    ]);
                }
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Username tidak ditemukan.'
                ]);
            }
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Password dan konfirmasi tidak cocok.',
                'field' => 'confirm-password'
            ]);
        }
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Semua kolom harus diisi.'
        ]);
    }
}
?>
