<?php
session_start();
include('koneksi.php');

if (!isset($_SESSION['users']['nama'])) {
    header('Location: login.php');
    exit;
}

if (isset($_GET['action']) && $_GET['action'] == 'Hapus') {
    $nama = $_GET['nama'];
    $q = "DELETE FROM pesan WHERE nama = '$nama'";

    if ($koneksi->query($q)) {
        header('Location: admin.php');
        exit;
    }
}

if (isset($_POST['proses']) && $_POST['proses'] === 'Edit') {
    if (isset($_POST['nama']) && isset($_POST['deskripsi']) && isset($_POST['harga'])) {
        $nama = $_POST['nama'];
        $deskripsi = $_POST['deskripsi'];
        $harga = $_POST['harga'];
}
        $q = "UPDATE pesan SET deskripsi = '$deskripsi', harga = '$harga' WHERE nama = '$nama'";
        if ($koneksi->query($q)) {
            header('Location: admin.php');
            exit;
        } 
    }


if (isset($_POST['proses']) && $_POST['proses'] == 'Tambah Barang') {
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];

    if (empty($nama) || empty($deskripsi) || empty($harga)) {
        echo '<script>alert("Semua kolom harus diisi.")</script>';
        echo '<script>window.location="input.php";</script>';
        exit;
    }

    $cekQuery = "SELECT COUNT(*) FROM pesan WHERE nama = '$nama'";
    $result = $koneksi->query($cekQuery);
    $row = $result->fetch_row();

    if ($row[0] > 0) {
        echo "<script>alert('Barang dengan nama \"$nama\" sudah ada!');</script>";
        echo "<script>window.location='admin.php';</script>";
        exit;
    }

    $q = "INSERT INTO pesan (nama, deskripsi, harga) VALUES('$nama', '$deskripsi', '$harga')";
    
    if ($koneksi->query($q)) {
        header("Location: admin.php");
        exit;
    }
}

if (isset($_POST['proses']) && $_POST['proses'] == 'Pesan Barang') {
    $konsumen = $_POST['konsumen'];
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $alamat = $_POST['alamat'];
    $nomer_hp = $_POST['nomer_hp'];

    $checkQuery = "SELECT 1 FROM brg WHERE id = '$id' AND konsumen = '$konsumen'";
    $checkResult = $koneksi->query($checkQuery);

    if ($checkResult && $checkResult->num_rows > 0) {
        exit;
    } else {
        $q = "INSERT INTO brg (konsumen, id, nama, harga, alamat, nomer_hp) 
              VALUES ('$konsumen', '$id', '$nama', '$harga', '$alamat', '$nomer_hp')";
        if ($koneksi->query($q)) {
            header('Location: customer.php');
            exit;
        } else {
            echo "Terjadi kesalahan: " . $koneksi->error;
        }
    }
}


if (isset($_POST['proses']) && $_POST['proses'] == 'Batal') {
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id_barang = $_POST['id'];
        $konsumen = $_SESSION['users']['nama']; 

        foreach ($id_barang as $id) {
            $q = "DELETE FROM brg WHERE id = '$id' AND konsumen = '$konsumen'"; 

            if (!$koneksi->query($q)) {
                echo "Terjadi kesalahan: " . $koneksi->error;
                exit;
            }
        }
        header('Location: kotak.php');
        exit;
    } else {
        echo " <script>
        function validateForm() {
            var checkboxes = document.querySelectorAll('input[type='checkbox']:checked');
            if (checkboxes.length == 0) {
                alert('Pilih pesanan yang ingin dibatalkan');
                return false; 
            }
            return true; 
        }
    </script>";
    }
}

?>
