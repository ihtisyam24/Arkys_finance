-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Sep 2025 pada 16.25
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
-- Database: `stokbarang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bebanpokokpenjualan`
--

CREATE TABLE `bebanpokokpenjualan` (
  `idbebanpokok` int(100) NOT NULL,
  `tanggal3` varchar(50) NOT NULL,
  `outlet3` varchar(50) NOT NULL,
  `persediaanawal` int(50) NOT NULL,
  `belanjaproduksi` int(50) NOT NULL,
  `persediaanakhir` int(50) NOT NULL,
  `persediaanakhirmurni` int(50) NOT NULL,
  `totalhargapokokpenjualan` int(50) NOT NULL,
  `labakotor` int(50) NOT NULL,
  `idoutlet` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `keluar`
--

CREATE TABLE `keluar` (
  `idkeluar` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `keterangan` varchar(25) NOT NULL,
  `qty` varchar(25) NOT NULL,
  `penerima` varchar(50) NOT NULL,
  `idoutlet` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `keluar`
--

INSERT INTO `keluar` (`idkeluar`, `idbarang`, `tanggal`, `keterangan`, `qty`, `penerima`) VALUES
(2, 16, '2022-07-03 01:14:32', 'Bimoli', '5', 'Pembeli'),
(3, 17, '2022-07-03 05:04:00', 'Daia Bunga', '15', 'Pembeli'),
(4, 18, '2022-07-03 05:47:28', 'Indomie', '5', 'Pembeli'),
(5, 18, '2022-07-04 12:01:46', 'sedap', '9', 'Pembeli'),
(6, 24, '2022-07-05 01:32:30', 'ABCD', '4', 'Pembeli'),
(7, 24, '2022-07-05 01:58:15', 'ABCD', '1', 'Bagian Gudang  Tata'),
(8, 24, '2022-07-05 01:58:32', 'ABCD', '3', 'Bagian Gudang Budi'),
(10, 26, '2022-07-05 14:07:56', 'sedap', '5', 'Bagian Gudang Budi'),
(11, 28, '2022-07-05 14:08:53', 'sedap', '5', 'Pembeli'),
(12, 28, '2022-07-05 14:09:50', 'sedap', '94', 'Pembeli'),
(13, 33, '2022-07-15 05:29:59', 'box', '5', 'Pembeli'),
(14, 33, '2022-07-15 06:01:11', 'box', '2', 'Bagian Gudang Budi'),
(15, 35, '2022-07-15 13:05:40', 'box', '100', 'Pembeli'),
(16, 35, '2022-07-15 13:06:14', 'box', '50', 'Pembeli'),
(17, 37, '2022-07-17 08:40:30', 'tabung', '5', 'Pembeli'),
(18, 46, '2022-07-21 04:21:05', 'Galon', '19', 'Pembeli'),
(20, 47, '2022-07-21 08:44:54', 'Tabung', '501', 'Pembeli'),
(21, 49, '2022-07-23 14:03:49', 'Jerigen', '1', 'Pembeli'),
(22, 49, '2022-07-24 06:52:54', 'Jerigen', '603', 'Pembeli'),
(23, 8, '2023-12-05 04:25:58', '1', '1', '1'),
(24, 11, '2023-12-05 14:26:44', 'rara', '1', 'rara'),
(25, 13, '2023-12-05 14:55:10', 'wad', '11', 'sad'),
(27, 25, '2025-07-19 05:07:10', 'Bungkus', '2', 'Ulin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keluaroutlet`
--

CREATE TABLE `keluaroutlet` (
  `idkeluar1` int(11) NOT NULL,
  `transaksi` varchar(20) NOT NULL,
  `idbarang1` int(11) NOT NULL,
  `tanggal1` date NOT NULL,
  `keterangan1` varchar(25) NOT NULL,
  `qty1` varchar(25) NOT NULL,
  `outlet` varchar(50) NOT NULL,
  `outlettujuan` varchar(20) NOT NULL,
  `idoutlet` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `keluaroutlet`
--

INSERT INTO `keluaroutlet` (`idkeluar1`, `transaksi`, `idbarang1`, `tanggal1`, `keterangan1`, `qty1`, `outlet`, `outlettujuan`) VALUES
(2, 'Mutasi', 12, '0000-00-00', 'Karung', '1', 'Ulin', 'Cafe'),
(8, 'Mutasi', 8, '0000-00-00', 'Karung', '1', 'Loa Bakung', 'Cafe'),
(9, 'Mutasi', 12, '0000-00-00', 'Karung', '1', 'Ulin', 'Loa Bakung'),
(10, 'Mutasi', 10, '0000-00-00', 'Bungkus', '1', 'Cafe', 'Loa Bakung');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keuangan`
--

CREATE TABLE `keuangan` (
  `idkeuangan` int(100) NOT NULL,
  `tanggal2` varchar(15) NOT NULL,
  `outlet2` varchar(50) NOT NULL,
  `shiftpagi` int(50) NOT NULL,
  `shiftmalam` int(50) NOT NULL,
  `debittransfer` int(50) NOT NULL,
  `qris` int(50) NOT NULL,
  `gojek` int(50) NOT NULL,
  `grab` int(50) NOT NULL,
  `total` int(100) NOT NULL,
  `persediaanawal` int(50) NOT NULL,
  `belanjaproduksi` int(50) NOT NULL,
  `persediaanakhir` int(50) NOT NULL,
  `persediaanakhirmurni` int(50) NOT NULL,
  `totalhargapokokpenjualan` int(50) NOT NULL,
  `labakotor` int(50) NOT NULL,
  `biayaoperasional` int(100) NOT NULL,
  `biayasewabangunan` int(100) NOT NULL,
  `bebangaji` int(100) NOT NULL,
  `pln` int(100) NOT NULL,
  `pdam` int(100) NOT NULL,
  `wifi` int(100) NOT NULL,
  `bebanpajak` int(100) NOT NULL,
  `totalbp` int(100) NOT NULL,
  `lababersih` int(100) NOT NULL,
  `idoutlet` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `keuangan`
--

INSERT INTO `keuangan` (`idkeuangan`, `tanggal2`, `outlet2`, `shiftpagi`, `shiftmalam`, `debittransfer`, `qris`, `gojek`, `grab`, `total`, `persediaanawal`, `belanjaproduksi`, `persediaanakhir`, `persediaanakhirmurni`, `totalhargapokokpenjualan`, `labakotor`, `biayaoperasional`, `biayasewabangunan`, `bebangaji`, `pln`, `pdam`, `wifi`, `bebanpajak`, `totalbp`, `lababersih`) VALUES
(1, '18/09/2025', 'Loa Bakung', 10000, 500000, 300000, 100000, 5000000, 500000, 6410000, 1000000, 1000000, 1000000, 1000000, 3000000, 3410000, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, '19/09/2025', 'Ulin', 1000000, 1000000, 300000, 500000, 600000, 600000, 4000000, 1000000, 1000000, 1000000, 1000000, 3000000, 1000000, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, '20/09/2025', 'Cafe', 1000000, 1000000, 500000, 300000, 300000, 300000, 3400000, 1000000, 1000000, 1000000, 1000000, 3000000, 400000, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6, '19/09/2025', 'Cafe', 1000000, 1000000, 1000000, 1000000, 1000000, 1000000, 6000000, 1000000, 1000000, 1000000, 1000000, 3000000, 3000000, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(7, '20/09/2025', 'Loa Bakung', 1000000, 1000000, 1000000, 1000000, 1000000, 1000000, 6000000, 10000000, 1000000, 1000000, 1000000, 12000000, -6000000, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(8, '21/09/2025', 'Ulin', 1000000, 1000000, 1000000, 1000000, 1000000, 1000000, 6000000, 1000000, 1000000, 1000000, 1000000, 3000000, 3000000, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan`
--

CREATE TABLE `laporan` (
  `idlaporan` int(100) NOT NULL,
  `idkeuangan` int(100) NOT NULL,
  `idbebanpokok` int(100) NOT NULL,
  `total2` int(100) NOT NULL,
  `idoutlet` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `iduser` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` varchar(20) NOT NULL,
  `idoutlet` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`iduser`, `email`, `password`, `level`) VALUES
(1, 'admin@gmail.com', '12345678', 'Admin'),
(3, 'yusufmuhammad230899@gmail.com', '12345678', 'Leader/Kapten'),
(20, 'hafiz@gmail.com', '12345678', 'Kepala Gudang'),
(22, 'arimbi@gmail.com', '12345678', 'Finance');

-- --------------------------------------------------------

--
-- Struktur dari tabel `masuk`
--

CREATE TABLE `masuk` (
  `idmasuk` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `keterangan` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL,
  `penerima` varchar(25) NOT NULL,
  `idoutlet` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `masuk`
--

INSERT INTO `masuk` (`idmasuk`, `idbarang`, `tanggal`, `keterangan`, `qty`, `penerima`) VALUES
(12, 16, '2022-07-03 01:14:02', 'Bimoli', 10, 'Bagian Gudang Budi'),
(13, 17, '2022-07-03 05:03:44', 'Daia Bunga', 20, 'Bagian Gudang  Tata'),
(14, 18, '2022-07-04 11:54:01', 'ABCD', 2, 'Pembeli'),
(15, 21, '2022-07-04 12:56:44', 'kapal Api', 6, 'Bagian Gudang Budi'),
(16, 22, '2022-07-04 13:00:15', 'Daia', 1, 'Bagian Gudang Budi'),
(17, 23, '2022-07-04 13:23:52', 'Ultramilk', 3, 'Bagian Gudang Budi'),
(19, 26, '2022-07-05 02:16:19', 'sedap', 5, 'Bagian Gudang Budi'),
(20, 27, '2022-07-05 10:35:26', 'ABCD', 5, 'Bagian Gudang Budi'),
(21, 26, '2022-07-05 14:07:17', 'sedap', 5, 'Bagian Gudang Budi'),
(22, 28, '2022-07-06 03:57:52', 'sedap', 9, 'Bagian Gudang  Tata'),
(23, 22, '2022-07-11 13:00:58', 'sedap', 5, 'Bagian Gudang Budi'),
(24, 0, '2022-07-12 14:57:57', 'ABCD', 5, 'Bagian Gudang Budi'),
(25, 0, '2022-07-12 14:57:57', 'ABCD', 5, 'Bagian Gudang Budi'),
(26, 0, '2022-07-12 14:58:20', 'su', 10, 'Bagian Gudang Budi'),
(27, 0, '2022-07-12 14:58:20', 'su', 10, 'Bagian Gudang Budi'),
(28, 33, '2022-07-15 05:29:31', 'dus', 5, 'Bagian Gudang Budi'),
(29, 33, '2022-07-16 12:38:48', 'box', 5, 'Bagian Gudang Budi'),
(30, 37, '2022-07-17 08:40:10', 'tabung', 10, 'Bagian Gudang Budi'),
(31, 46, '2022-07-21 04:20:24', 'Galon', 10, 'Bagian Gudang Budi'),
(32, 47, '2022-07-21 08:44:32', 'Tabung', 100, 'Bagian Gudang Budi'),
(33, 48, '2022-07-23 08:56:37', 'cek', 10, 'cek'),
(34, 47, '2022-07-23 08:57:11', 'ABCD', 10, 'cek'),
(35, 47, '2022-07-23 12:39:59', 'tes', 2, 'tes'),
(36, 47, '2022-07-23 14:02:04', 'Tabung', 11, 'Pembeli'),
(37, 47, '2022-07-24 06:49:39', 'Tabung', 10, 'Bagian Gudang Budi'),
(38, 47, '2022-07-24 06:49:40', 'Tabung', 10, 'Bagian Gudang Budi'),
(39, 47, '2022-07-24 06:49:40', 'Tabung', 10, 'Bagian Gudang Budi'),
(40, 47, '2022-07-24 06:49:40', 'Tabung', 10, 'Bagian Gudang Budi'),
(41, 47, '2022-07-24 06:49:40', 'Tabung', 10, 'Bagian Gudang Budi'),
(42, 47, '2022-07-24 06:49:40', 'Tabung', 10, 'Bagian Gudang Budi'),
(43, 47, '2022-07-24 06:49:41', 'Tabung', 10, 'Bagian Gudang Budi'),
(44, 49, '2022-07-24 06:50:43', 'Jerigen', 19, 'Bagian Gudang Budi'),
(45, 49, '2022-07-24 06:54:46', 'Jerigen', 5, 'Bagian Gudang Budi'),
(46, 50, '2022-07-24 06:55:20', 'tes', 2, 'tesssssssssssssssssssssss'),
(47, 10, '2023-12-05 13:26:17', 'wd', 1, 'adw'),
(48, 9, '2023-12-05 13:26:29', 'wadaw', 21, 'awd'),
(49, 11, '2023-12-05 14:26:34', 'rara rara2', 12, 'rara'),
(50, 12, '2023-12-05 14:47:19', 'asdasd', 221, 'fds'),
(51, 13, '2023-12-05 14:47:27', 'dasdas', 12, 'das'),
(52, 15, '2025-07-02 03:04:00', 'bungkus', 2, 'Nolan'),
(53, 18, '2025-07-19 01:17:04', 'Karung', 2, 'Nolan'),
(54, 25, '2025-07-19 05:06:43', 'Bungkus', 10, 'Nolan'),
(55, 25, '2025-07-19 05:08:11', 'Bungkus', 5, 'Nolan'),
(56, 15, '2025-09-13 01:11:38', 'bungkus', 1, 'Julita');

-- --------------------------------------------------------

--
-- Struktur dari tabel `masukoutlet`
--

CREATE TABLE `masukoutlet` (
  `idmasuk1` int(11) NOT NULL,
  `idbarang1` int(11) NOT NULL,
  `tanggal1` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `transaksi` varchar(50) NOT NULL,
  `keterangan1` varchar(50) NOT NULL,
  `qty1` int(11) NOT NULL,
  `outletasal` varchar(20) NOT NULL,
  `outlet` varchar(20) NOT NULL,
  `idoutlet` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `masukoutlet`
--

INSERT INTO `masukoutlet` (`idmasuk1`, `idbarang1`, `tanggal1`, `transaksi`, `keterangan1`, `qty1`, `outletasal`, `outlet`) VALUES
(12, 9, '2025-07-14 03:03:35', 'Mutasi', 'Karung', 1, 'Ulin', 'Cafe'),
(13, 8, '2025-09-14 10:15:38', 'P553456', 'Karung', 3, 'CK SAMARINDA', 'Loa Bakung');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mutasi`
--

CREATE TABLE `mutasi` (
  `idbarang2` int(11) NOT NULL,
  `tanggal2` varchar(20) NOT NULL,
  `namabarang2` varchar(50) NOT NULL,
  `keterangan2` varchar(50) NOT NULL,
  `qty2` int(11) NOT NULL,
  `outlet2` varchar(20) NOT NULL,
  `idoutlet` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `outlet`
--

CREATE TABLE `outlet` (
  `idoutlet` int(100) NOT NULL,
  `namaoutlet` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `outlet`
--

INSERT INTO `outlet` (`idoutlet`, `namaoutlet`) VALUES
(4, 'Ulin'),
(5, 'Cafe'),
(6, 'Loa Bakung'),
(7, 'Brigjen Katamso Bontang'),
(8, 'Berbas Bontang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `po`
--

CREATE TABLE `po` (
  `idpo` int(150) NOT NULL,
  `idbarang` varchar(50) NOT NULL,
  `tanggal2` timestamp NOT NULL DEFAULT current_timestamp(),
  `keterangan` varchar(50) NOT NULL,
  `qty` varchar(25) NOT NULL,
  `kode_transaksi` varchar(50) NOT NULL,
  `Status` int(11) NOT NULL,
  `penerima` varchar(150) NOT NULL,
  `Supplier` varchar(25) NOT NULL,
  `idoutlet` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `po`
--

INSERT INTO `po` (`idpo`, `idbarang`, `tanggal2`, `keterangan`, `qty`, `kode_transaksi`, `Status`, `penerima`, `Supplier`) VALUES
(12, '15', '2025-07-09 03:42:16', 'Bungkus', '6', 'PO-20250709155', 1, 'CK Samarinda', 'Ciomas'),
(13, '18', '2025-07-14 01:46:54', 'Karung', '10', 'PO-20250714384', 1, 'Ulin', 'Ciomas'),
(14, '18', '2025-07-14 01:53:30', 'karung', '3', 'PO-20250714376', 1, 'Ulin', 'Ciomas'),
(15, '15', '2025-07-14 01:55:20', 'bungkus', '2', 'PO-20250714496', 1, 'CK Samarinda', 'Ciomas'),
(16, '25', '2025-07-19 05:07:44', 'Bungkus', '5', 'PO-20250719658', 1, 'CK Samarinda', 'Ciomas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock`
--

CREATE TABLE `stock` (
  `idbarang` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `namabarang` varchar(50) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `Harga` int(100) NOT NULL,
  `stock` int(11) NOT NULL,
  `stockfisik` int(11) NOT NULL,
  `stocksisa` int(11) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `idoutlet` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `stock`
--

INSERT INTO `stock` (`idbarang`, `tanggal`, `namabarang`, `keterangan`, `Harga`, `stock`, `stockfisik`, `stocksisa`, `kategori`) VALUES
(15, '2025-09-13 01:15:41', 'Dori', 'bungkus', 5000, 13, 13, 0, 'Barang Olahan'),
(18, '2025-09-13 01:15:47', 'Beras', 'karung', 5000, 14, 10, -4, 'Barang Jadi'),
(22, '2025-09-13 00:53:45', 'Milo', 'bungkus', 5000, 15, 17, 2, 'Barang Jadi'),
(25, '2025-09-13 00:53:55', 'Patty Chicken', 'Bungkus', 5000, 13, 12, -1, 'Barang Jadi'),
(26, '2025-09-13 00:58:30', 'Ayam Utuh', 'Karung', 500000, 3, 0, 0, 'Barang Olahan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stockoutlet`
--

CREATE TABLE `stockoutlet` (
  `idbarang1` int(11) NOT NULL,
  `tanggal1` datetime NOT NULL DEFAULT current_timestamp(),
  `namabarang1` varchar(50) NOT NULL,
  `keterangan1` varchar(50) NOT NULL,
  `Harga1` int(100) NOT NULL,
  `stock1` int(11) NOT NULL,
  `stockfisik1` int(11) NOT NULL,
  `stocksisa1` int(11) NOT NULL,
  `kategori1` varchar(30) NOT NULL,
  `idoutlet` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `stockoutlet`
--

INSERT INTO `stockoutlet` (`idbarang1`, `tanggal1`, `namabarang1`, `keterangan1`, `Harga1`, `stock1`, `stockfisik1`, `stocksisa1`, `kategori1`) VALUES
(8, '2025-07-03 12:51:11', 'Beras Loa Bakung', 'Karung', 400000, 19, 22, 3, 'Barang Jadi'),
(10, '2025-07-09 11:34:36', 'Dori', 'Bungkus', 20000, 4, 0, -4, 'Barang Jadi'),
(13, '2025-09-13 09:27:06', 'Meatball', 'Pieces', 0, 12, 0, 0, 'Barang Olahan');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bebanpokokpenjualan`
--
ALTER TABLE `bebanpokokpenjualan`
  ADD PRIMARY KEY (`idbebanpokok`);

--
-- Indeks untuk tabel `keluar`
--
ALTER TABLE `keluar`
  ADD PRIMARY KEY (`idkeluar`);

--
-- Indeks untuk tabel `keluaroutlet`
--
ALTER TABLE `keluaroutlet`
  ADD PRIMARY KEY (`idkeluar1`);

--
-- Indeks untuk tabel `keuangan`
--
ALTER TABLE `keuangan`
  ADD PRIMARY KEY (`idkeuangan`);

--
-- Indeks untuk tabel `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`idlaporan`),
  ADD KEY `idkeuangan` (`idkeuangan`),
  ADD KEY `idbebanpokok` (`idbebanpokok`);

--
-- Indeks untuk tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`iduser`);

--
-- Indeks untuk tabel `masuk`
--
ALTER TABLE `masuk`
  ADD PRIMARY KEY (`idmasuk`);

--
-- Indeks untuk tabel `masukoutlet`
--
ALTER TABLE `masukoutlet`
  ADD PRIMARY KEY (`idmasuk1`);

--
-- Indeks untuk tabel `outlet`
--
ALTER TABLE `outlet`
  ADD PRIMARY KEY (`idoutlet`);

--
-- Indeks untuk tabel `po`
--
ALTER TABLE `po`
  ADD PRIMARY KEY (`idpo`);

--
-- Indeks untuk tabel `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`idbarang`);

--
-- Indeks untuk tabel `stockoutlet`
--
ALTER TABLE `stockoutlet`
  ADD PRIMARY KEY (`idbarang1`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bebanpokokpenjualan`
--
ALTER TABLE `bebanpokokpenjualan`
  MODIFY `idbebanpokok` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `keluar`
--
ALTER TABLE `keluar`
  MODIFY `idkeluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `keluaroutlet`
--
ALTER TABLE `keluaroutlet`
  MODIFY `idkeluar1` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `keuangan`
--
ALTER TABLE `keuangan`
  MODIFY `idkeuangan` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `laporan`
--
ALTER TABLE `laporan`
  MODIFY `idlaporan` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `login`
--
ALTER TABLE `login`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `masuk`
--
ALTER TABLE `masuk`
  MODIFY `idmasuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT untuk tabel `masukoutlet`
--
ALTER TABLE `masukoutlet`
  MODIFY `idmasuk1` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `outlet`
--
ALTER TABLE `outlet`
  MODIFY `idoutlet` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `po`
--
ALTER TABLE `po`
  MODIFY `idpo` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `stock`
--
ALTER TABLE `stock`
  MODIFY `idbarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `stockoutlet`
--
ALTER TABLE `stockoutlet`
  MODIFY `idbarang1` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `laporan`
--
ALTER TABLE `laporan`
  ADD CONSTRAINT `laporan_ibfk_1` FOREIGN KEY (`idkeuangan`) REFERENCES `keuangan` (`idkeuangan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `laporan_ibfk_2` FOREIGN KEY (`idbebanpokok`) REFERENCES `bebanpokokpenjualan` (`idbebanpokok`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `laporan_ibfk_3` FOREIGN KEY (`idoutlet`) REFERENCES `outlet` (`idoutlet`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `bebanpokokpenjualan`
--
ALTER TABLE `bebanpokokpenjualan`
  ADD CONSTRAINT `bebanpokokpenjualan_ibfk_1` FOREIGN KEY (`idoutlet`) REFERENCES `outlet` (`idoutlet`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `keluar`
--
ALTER TABLE `keluar`
  ADD CONSTRAINT `keluar_ibfk_1` FOREIGN KEY (`idoutlet`) REFERENCES `outlet` (`idoutlet`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `keluaroutlet`
--
ALTER TABLE `keluaroutlet`
  ADD CONSTRAINT `keluaroutlet_ibfk_1` FOREIGN KEY (`idoutlet`) REFERENCES `outlet` (`idoutlet`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `keuangan`
--
ALTER TABLE `keuangan`
  ADD CONSTRAINT `keuangan_ibfk_1` FOREIGN KEY (`idoutlet`) REFERENCES `outlet` (`idoutlet`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`idoutlet`) REFERENCES `outlet` (`idoutlet`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `masuk`
--
ALTER TABLE `masuk`
  ADD CONSTRAINT `masuk_ibfk_1` FOREIGN KEY (`idoutlet`) REFERENCES `outlet` (`idoutlet`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `masukoutlet`
--
ALTER TABLE `masukoutlet`
  ADD CONSTRAINT `masukoutlet_ibfk_1` FOREIGN KEY (`idoutlet`) REFERENCES `outlet` (`idoutlet`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `mutasi`
--
ALTER TABLE `mutasi`
  ADD CONSTRAINT `mutasi_ibfk_1` FOREIGN KEY (`idoutlet`) REFERENCES `outlet` (`idoutlet`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `po`
--
ALTER TABLE `po`
  ADD CONSTRAINT `po_ibfk_1` FOREIGN KEY (`idoutlet`) REFERENCES `outlet` (`idoutlet`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`idoutlet`) REFERENCES `outlet` (`idoutlet`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `stockoutlet`
--
ALTER TABLE `stockoutlet`
  ADD CONSTRAINT `stockoutlet_ibfk_1` FOREIGN KEY (`idoutlet`) REFERENCES `outlet` (`idoutlet`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
