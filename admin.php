<?php
session_start();
include('config.php');

if (!isset($_SESSION['users']) || $_SESSION['users']['role'] != 'admin') {
    header('Location: login.php');
    exit;
}

$q = "SELECT * FROM pesan"; 
$hasil = $koneksi->query($q);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Administrator</title>
    <link rel="stylesheet" href="utama.css?v=<?= time(); ?>" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script.js?v=<?= time(); ?>"></script>
</head>
<body>
    <div class="header">
        <div class="header-left">
            <a href="kotak.php"><button>Pesanan</button></a>
            <a href="admin.php"><button>Dashboard</button></a>
        </div>
        <div class="header-right">
            <button id="logout-btn">Logout</button>
        </div>
    </div>

    <div class="container">
    <div class="welcome-box">
    <img src="img/admin.png" alt="Admin Photo" class="profile-image">
    <h4>Selamat datang, Administrator</h4>
</div>


        <div class="data-box">
            <h2>Daftar Barang</h2>
            <table>
                <tr>
                    <th>Barang</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>

                <?php
                while ($row = $hasil->fetch_row()) {
                    echo "
                    <tr>
                        <td>$row[0]</td>
                        <td>$row[1]</td>
                        <td>$row[2]</td>
                        <td>
                            <a href='input.php?nama=$row[0]&action=Edit'>
                                <button>Edit</button>
                            </a>
                            <a href='proses.php?nama=$row[0]&action=Hapus'>
                                <button type='button'>Hapus</button>
                            </a>
                        </td>
                    </tr>";
                }
                ?>
            </table>
        </div>

        <div class="data-box">
            <a href="input.php">
                <button>Input Barang Baru</button>
            </a>
        </div>
    </div>
</body>
</html>
