<?php
session_start();
include('koneksi.php');

if (!isset($_SESSION['users'])) {
    header('Location: login.php');
    exit;
}

$nama_pengguna = $_SESSION['users']['nama']; 
$edit = 0;
$nama = "";
$deskripsi = ""; 
$harga = "";
$id = rand(100000, 2147483646);  

if (isset($_GET['nama']) && isset($_GET['action'])) {
    $nama = $koneksi->real_escape_string($_GET['nama']);
    $action = $_GET['action'];

    $q = "SELECT * FROM pesan WHERE nama = '$nama'";  
    $hasil = $koneksi->query($q);

    if ($hasil && $hasil->num_rows > 0) {
        $row = $hasil->fetch_assoc();
        $nama = $row['nama'];
        $deskripsi = $row['deskripsi']; 
        $harga = $row['harga']; 

        if ($action === 'Pesan') {
            $edit = 2; 
        } elseif ($action === 'Edit') {
            $edit = 1; 
        }
    } else {
        echo "<p>Barang tidak ditemukan di daftar barang.</p>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ($edit == 2 ? "Pesan Barang" : ($edit == 1 ? "Edit Barang" : "Tambah Barang")); ?></title>
    <link rel="stylesheet" href="login.css" />
</head>
<body>
    <div class="container">
        <div class="login-box">
            <h3>
                <?php
                if ($edit == 2) {
                    echo "Pesan Barang";
                } elseif ($edit == 1) {
                    echo "Edit Barang";
                } else {
                    echo "Tambah Barang";
                }
                ?>
            </h3>
            <form action="proses.php" method="POST">
                <?php if ($edit == 2) { ?>
                    <div class="form-group">
                        <label for="konsumen">Konsumen</label>
                        <input type="text" id="konsumen" name="konsumen" value="<?php echo $nama_pengguna; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="id">ID Barang</label>
                        <input type="text" id="id" name="id" value="<?php echo $id; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Barang</label>
                        <input type="text" id="nama" name="nama" value="<?php echo $nama; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga Barang</label>
                        <input type="text" id="harga" name="harga" value="<?php echo $harga; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" id="alamat" name="alamat" required>
                    </div>
                    <div class="form-group">
                        <label for="nomer_hp">No HP</label>
                        <input type="text" id="nomer_hp" name="nomer_hp" required>
                    </div>
                <?php } elseif ($edit == 1 || $edit == 0) { ?>
                    <div class="form-group">
                        <label for="nama">Nama Barang</label>
                        <input type="text" id="nama" name="nama" value="<?php echo $nama; ?>" <?php echo ($edit == 1) ? "readonly" : ""; ?>>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi Barang</label>
                        <textarea id="deskripsi" name="deskripsi"><?php echo $deskripsi; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga Barang</label>
                        <input type="text" id="harga" name="harga" value="<?php echo $harga; ?>">
                    </div>
                <?php } ?>

                <div class="form-group">
                    <button type="submit" name="proses" value="<?php echo ($edit == 2 ? "Pesan Barang" : ($edit == 1 ? "Edit" : "Tambah Barang")); ?>">
                        <?php echo ($edit == 2 ? "Pesan Barang" : ($edit == 1 ? "Edit Barang" : "Tambah Barang")); ?>
                    </button>
                </div>
            </form>
            <p><a href="<?php echo ($edit == 2) ? 'customer.php' : 'admin.php'; ?>">Back</a></p>
        </div>
    </div>
</body>
</html>
