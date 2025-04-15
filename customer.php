<?php
session_start();
include('koneksi.php');

if (!isset($_SESSION['users']) || $_SESSION['users']['role'] != 'customer') {
    header("Location: login.php");
    exit;
}

$q = "SELECT * FROM pesan";
$hasil = $koneksi->query($q);

if ($hasil === false) {
    die("Error dalam query: " . $koneksi->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Pelanggan</title>
    <link rel="stylesheet" href="utama.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="header-left">
            <a href="kotak.php"><button>Pesanan</button></a>
            <a href="customer.php"><button>Dashboard</button></a>
        </div>
        <div class="header-right">
            <button id="logout-btn">Logout</button>
        </div>
    </div>

    <!-- Container -->
    <div class="container">
        <div class="welcome-box">
        <img src="img/customer.png" alt="Pelanggan Photo" class="profile-image">
        <h3>Selamat datang, <?php echo $_SESSION['users']['nama']; ?></h3>
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
                            <a href='input.php?nama=$row[0]&action=Pesan'>
                                <button type='button'>Pesan</button>
                            </a>
                        </td>
                    </tr>";
                }
                ?>
            </table>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#logout-btn').click(function (event) {
                event.preventDefault();

                if (confirm('Apakah Anda yakin ingin keluar dari akun?')) {
                    $.ajax({
                        url: 'logout.php',
                        type: 'POST',
                        data: { action: 'logout' },
                        success: function (response) {
                            const result = JSON.parse(response);
                            if (result.status === 'success') {
                                alert(result.message);
                                location.href = 'login.php';
                            }
                        },
                        error: function () {
                            alert('Terjadi kesalahan saat logout.');
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
