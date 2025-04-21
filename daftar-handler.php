<?php
session_start();
include "koneksi.php";

header('Content-Type: application/json');

$nama = $_POST['nama'] ?? '';
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($nama) || empty($username) || empty($password)) {
    echo json_encode(['status' => 'error', 'message' => 'Semua kolom harus diisi.']);
    exit;
}

$passwordHash = md5($password);

$cek = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
if (mysqli_num_rows($cek) > 0) {
    echo json_encode(['status' => 'error', 'message' => 'Username sudah digunakan.']);
    exit;
}

$query = mysqli_query($koneksi, "INSERT INTO users(nama, username, password, role) VALUES('$nama', '$username', '$passwordHash', 'customer')");

if ($query) {
    echo json_encode(['status' => 'success', 'message' => 'Pendaftaran berhasil!']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Pendaftaran gagal. Coba lagi.']);
}
