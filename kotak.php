<?php
session_start();
include('koneksi.php');

$konsumen = $_SESSION['users']['nama'];

if ($_SESSION['users']['role'] == 'admin') {
    $q = "SELECT * FROM brg";
} else {
    $q = "SELECT * FROM brg WHERE konsumen = '$konsumen'";
}

$hasil = $koneksi->query($q);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan</title>
    <link rel="stylesheet" href="utama.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function validateForm() {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
            if (checkboxes.length == 0) {
                alert('Pilih pesanan yang ingin dibatalkan');
                return false; 
            }
            var confirmation = confirm("Apakah Anda yakin ingin membatalkan pesanan yang dipilih?");
            return confirmation;
        }
    </script>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="header-left">
            <a href="kotak.php"><button>Pesanan</button></a>
            <?php if ($_SESSION['users']['role'] == 'admin'): ?>
                <a href="admin.php"><button>Dashboard</button></a>
            <?php else: ?>
                <a href="customer.php"><button>Dashboard</button></a>
            <?php endif; ?>
        </div>
        <div class="header-right">
            <button id="logout-btn">Logout</button>
        </div>
    </div>

    <!-- Container -->
    <div class="container">
        <div class="welcome-box">
            <?php if ($_SESSION['users']['role'] == 'admin'): ?>
                <h3>Halaman Pesanan Admin</h3>
            <?php else: ?>
                <h3>Halaman Pesanan Pelanggan: <?php echo $konsumen; ?></h3>
            <?php endif; ?>
        </div>

        <div class="data-box">
            <h2>Daftar Pesanan</h2>
            <?php if ($_SESSION['users']['role'] == 'customer'): ?>
                <form action="proses.php" method="POST" onsubmit="return validateForm()">
                    <table>
                        <tr>
                            <th>Pilih</th>
                            <th>Konsumen</th>
                            <th>ID barang</th>
                            <th>barang</th>
                            <th>Harga</th>
                            <th>Alamat</th>
                            <th>No HP</th>
                        </tr>
                        <?php while ($row = $hasil->fetch_row()): ?>
                            <tr>
                                <td align="center"><input type="checkbox" name="id[]" value="<?php echo $row[1]; ?>"></td>
                                <td align="center"><?php echo $row[0]; ?></td>
                                <td><?php echo $row[1]; ?></td>
                                <td align="center"><?php echo $row[2]; ?></td>
                                <td><?php echo $row[3]; ?></td>
                                <td><?php echo $row[4]; ?></td>
                                <td><?php echo $row[5]; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </table>
                    <br><br>
                    <input type="hidden" name="proses" value="Batal">
                    <input type="submit" value="Batalkan Pesanan">
                </form>
            <?php else: ?>
                <table>
                    <tr>
                        <th>Konsumen</th>
                        <th>ID brg</th>
                        <th>brg</th>
                        <th>Harga</th>
                        <th>Alamat</th>
                        <th>No HP</th>
                    </tr>
                    <?php while ($row = $hasil->fetch_row()): ?>
                        <tr>
                            <td align="center"><?php echo $row[0]; ?></td>
                            <td><?php echo $row[1]; ?></td>
                            <td align="center"><?php echo $row[2]; ?></td>
                            <td><?php echo $row[3]; ?></td>
                            <td><?php echo $row[4]; ?></td>
                            <td><?php echo $row[5]; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            <?php endif; ?>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#logout-btn').click(function () {
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
