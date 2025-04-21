<?php
$host = "localhost";
$user = "admin";
$pass = "";
$db = "toko";

$koneksi = new mysqli($host, $user, $pass);

// Buat database jika belum ada
$koneksi->query("CREATE DATABASE IF NOT EXISTS $db");
$koneksi->select_db($db);

// Tabel users
$koneksi->query("CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','customer') DEFAULT 'customer'
)");

// Tabel pesan
$koneksi->query("CREATE TABLE IF NOT EXISTS pesan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_barang VARCHAR(100) NOT NULL,
    deskripsi TEXT NOT NULL,
    harga INT NOT NULL
)");

// Tabel brg
$koneksi->query("CREATE TABLE IF NOT EXISTS brg (
    id VARCHAR(50) NOT NULL,
    konsumen VARCHAR(100) NOT NULL,
    nama_barang VARCHAR(100) NOT NULL,
    harga INT NOT NULL,
    alamat TEXT NOT NULL,
    nomer_hp VARCHAR(20) NOT NULL,
    PRIMARY KEY (id, konsumen)
)");

// Tambahkan user admin jika belum ada
$cekAdmin = $koneksi->query("SELECT * FROM users WHERE username = 'admin'");
if ($cekAdmin->num_rows === 0) {
    $koneksi->query("INSERT INTO users (nama, username, password, role) 
        VALUES ('Administrator', 'admin', MD5('admin'), 'admin')");
}
?>
