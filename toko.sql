-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Apr 2025 pada 05.18
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `brg`
--

CREATE TABLE `brg` (
  `konsumen` varchar(100) DEFAULT NULL,
  `id` varchar(50) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `nomer_hp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `brg`
--

INSERT INTO `brg` (`konsumen`, `id`, `nama`, `harga`, `alamat`, `nomer_hp`) VALUES
('Budi', 'R01', 'Router NeuraLink', 899000.00, 'Jl. Melati No. 5', '081234567890'),
('Sari', 'R02', 'Router Mini', 499000.00, 'Jl. Mawar No. 12', '081234567891'),
('jos', '456766020', 'Router NeuraLink', 899000.00, '111111', '1111111');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesan`
--

CREATE TABLE `pesan` (
  `nama` varchar(100) NOT NULL DEFAULT '',
  `deskripsi` text DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pesan`
--

INSERT INTO `pesan` (`nama`, `deskripsi`, `harga`) VALUES
('Dd', 'garang, hitam, berotot', 100000.00),
('Router Mini', 'Router rumahan hemat energi', 1.00),
('Router NeuraLink', 'kljkln keamanan maksimal', 899000.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','customer') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`, `role`) VALUES
(1, 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(2, 'jos', 'jos', '698d51a19d8a121ce581499d7b701668', 'customer'),
(3, 'joshua', 'joshua', '3b2285b348e95774cb556cb36e583106', 'customer'),
(4, 'fahri', 'fahri', '698d51a19d8a121ce581499d7b701668', 'customer'),
(5, 'caca', 'caca', '698d51a19d8a121ce581499d7b701668', 'customer'),
(6, 'joshua', 'rafael', '698d51a19d8a121ce581499d7b701668', 'customer'),
(7, 'fahri', 'fahri123', '25d55ad283aa400af464c76d713c07ad', 'customer'),
(8, 'josh', 'josh123', 'd2104a400c7f629a197f33bb33fe80c0', 'customer'),
(9, 'sangid', 'rombong', 'c4ca4238a0b923820dcc509a6f75849b', 'customer'),
(10, 'TheBeatles', 'ringo', '698d51a19d8a121ce581499d7b701668', 'customer'),
(11, 'ringgo', '000', 'c6f057b86584942e415435ffb1fa93d4', 'customer');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`nama`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
