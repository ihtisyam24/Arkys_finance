-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 18, 2025 at 12:44 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `finance`
--

-- --------------------------------------------------------

--
-- Table structure for table `bebanpokokpenjualan`
--

CREATE TABLE `bebanpokokpenjualan` (
  `idbebanpokok` int(11) NOT NULL,
  `tanggal3` varchar(50) NOT NULL,
  `outlet3` varchar(50) NOT NULL,
  `persediaanawal` int(11) NOT NULL,
  `belanjaproduksi` int(11) NOT NULL,
  `persediaanakhir` int(11) NOT NULL,
  `persediaanakhirmurni` int(11) NOT NULL,
  `totalhargapokokpenjualan` int(11) NOT NULL,
  `labakotor` int(11) NOT NULL,
  `idoutlet` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `keluar`
--

CREATE TABLE `keluar` (
  `idkeluar` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `keterangan` varchar(25) NOT NULL,
  `qty` varchar(25) NOT NULL,
  `penerima` varchar(50) NOT NULL,
  `idoutlet` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `keluaroutlet`
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
  `idoutlet` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `keuangan`
--

CREATE TABLE `keuangan` (
  `idkeuangan` int(11) NOT NULL,
  `tanggal2` varchar(15) NOT NULL,
  `outlet2` varchar(50) NOT NULL,
  `shiftpagi` int(11) NOT NULL,
  `shiftmalam` int(11) NOT NULL,
  `debittransfer` int(11) NOT NULL,
  `qris` int(11) NOT NULL,
  `gojek` int(11) NOT NULL,
  `grab` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `persediaanawal` int(11) NOT NULL,
  `belanjaproduksi` int(11) NOT NULL,
  `persediaanakhir` int(11) NOT NULL,
  `persediaanakhirmurni` int(11) NOT NULL,
  `totalhargapokokpenjualan` int(11) NOT NULL,
  `labakotor` int(11) NOT NULL,
  `biayaoperasional` int(11) NOT NULL,
  `biayasewabangunan` int(11) NOT NULL,
  `bebangaji` int(11) NOT NULL,
  `pln` int(11) NOT NULL,
  `pdam` int(11) NOT NULL,
  `wifi` int(11) NOT NULL,
  `bebanpajak` int(11) NOT NULL,
  `totalbp` int(11) NOT NULL,
  `lababersih` int(11) NOT NULL,
  `idoutlet` int(11) DEFAULT NULL,
  `es_batu` int(11) DEFAULT NULL,
  `galon` int(11) DEFAULT NULL,
  `gas` int(11) DEFAULT NULL,
  `barang_lainya` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `idlaporan` int(11) NOT NULL,
  `idkeuangan` int(11) NOT NULL,
  `idbebanpokok` int(11) NOT NULL,
  `total2` int(11) NOT NULL,
  `idoutlet` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `iduser` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` varchar(20) NOT NULL,
  `idoutlet` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`iduser`, `email`, `password`, `level`, `idoutlet`) VALUES
(1, 'admin@gmail.com', '12345678', 'Admin', NULL),
(3, 'yusufmuhammad230899@gmail.com', '12345678', 'Leader/Kapten', 5),
(20, 'hafiz@gmail.com', '12345678', 'Kepala Gudang', 5),
(22, 'arimbi@gmail.com', '12345678', 'Finance', NULL),
(25, 'gudang1@gmail.com', '12345678', 'Kepala Gudang', 4),
(26, 'gudang2@gmail.com', '12345678', 'Kepala Gudang', 5),
(27, 'leader1@gmail.com', '12345678', 'Leader/Kapten', 4),
(28, 'leader2@gmail.com', '12345678', 'Leader/Kapten', 5),
(29, 'testgudang@gmail.com', '12345678', 'Kepala Gudang', 8);

-- --------------------------------------------------------

--
-- Table structure for table `masuk`
--

CREATE TABLE `masuk` (
  `idmasuk` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `keterangan` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL,
  `penerima` varchar(25) NOT NULL,
  `idoutlet` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `masuk`
--

INSERT INTO `masuk` (`idmasuk`, `idbarang`, `tanggal`, `keterangan`, `qty`, `penerima`, `idoutlet`) VALUES
(60, 33, '2025-10-01 17:58:55', 'Minyak goreng 1L', 10, 'Bagian Gudang Budi', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `masukoutlet`
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
  `idoutlet` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mutasi`
--

CREATE TABLE `mutasi` (
  `idbarang2` int(11) NOT NULL,
  `tanggal2` varchar(20) NOT NULL,
  `namabarang2` varchar(50) NOT NULL,
  `keterangan2` varchar(50) NOT NULL,
  `qty2` int(11) NOT NULL,
  `outlet2` varchar(20) NOT NULL,
  `idoutlet` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `outlet`
--

CREATE TABLE `outlet` (
  `idoutlet` int(11) NOT NULL,
  `namaoutlet` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `outlet`
--

INSERT INTO `outlet` (`idoutlet`, `namaoutlet`) VALUES
(4, 'Ulin'),
(5, 'Cafe'),
(6, 'Loa Bakung'),
(7, 'Brigjen Katamso Bontang'),
(8, 'Berbas Bontang');

-- --------------------------------------------------------

--
-- Table structure for table `po`
--

CREATE TABLE `po` (
  `idpo` int(11) NOT NULL,
  `idbarang` varchar(50) NOT NULL,
  `tanggal2` timestamp NOT NULL DEFAULT current_timestamp(),
  `keterangan` varchar(50) NOT NULL,
  `qty` varchar(25) NOT NULL,
  `kode_transaksi` varchar(50) NOT NULL,
  `Status` int(11) NOT NULL,
  `penerima` varchar(150) NOT NULL,
  `Supplier` varchar(25) NOT NULL,
  `idoutlet` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `idbarang` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `namabarang` varchar(50) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `Harga` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `stockfisik` int(11) DEFAULT NULL,
  `stocksisa` int(11) DEFAULT NULL,
  `kategori` varchar(50) NOT NULL,
  `idoutlet` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`idbarang`, `tanggal`, `namabarang`, `keterangan`, `Harga`, `stock`, `stockfisik`, `stocksisa`, `kategori`, `idoutlet`) VALUES
(33, '2025-10-01 17:58:55', 'Bimoli', 'Keterangan barang 1', 50000, 110, NULL, NULL, 'Makanan', NULL),
(34, '2025-10-01 17:57:34', 'Garam', 'Keterangan barang 2', 25000, 50, NULL, NULL, 'Minuman', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stockoutlet`
--

CREATE TABLE `stockoutlet` (
  `idbarang1` int(11) NOT NULL,
  `tanggal1` datetime NOT NULL DEFAULT current_timestamp(),
  `namabarang1` varchar(50) NOT NULL,
  `keterangan1` varchar(50) NOT NULL,
  `Harga1` int(11) NOT NULL,
  `stock1` int(11) NOT NULL,
  `stockfisik1` int(11) DEFAULT NULL,
  `stocksisa1` int(11) DEFAULT NULL,
  `kategori1` varchar(30) NOT NULL,
  `idoutlet` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stockoutlet`
--

INSERT INTO `stockoutlet` (`idbarang1`, `tanggal1`, `namabarang1`, `keterangan1`, `Harga1`, `stock1`, `stockfisik1`, `stocksisa1`, `kategori1`, `idoutlet`) VALUES
(22, '2025-10-02 01:00:00', 'Bimoli', 'Keterangan barang 1', 50000, 100, 0, 0, 'Makanan', NULL),
(23, '2025-10-02 01:00:00', 'Garam', 'Keterangan barang 2', 25000, 50, 0, 0, 'Minuman', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bebanpokokpenjualan`
--
ALTER TABLE `bebanpokokpenjualan`
  ADD PRIMARY KEY (`idbebanpokok`),
  ADD KEY `bebanpokokpenjualan_ibfk_1` (`idoutlet`);

--
-- Indexes for table `keluar`
--
ALTER TABLE `keluar`
  ADD PRIMARY KEY (`idkeluar`),
  ADD KEY `keluar_ibfk_1` (`idoutlet`);

--
-- Indexes for table `keluaroutlet`
--
ALTER TABLE `keluaroutlet`
  ADD PRIMARY KEY (`idkeluar1`),
  ADD KEY `keluaroutlet_ibfk_1` (`idoutlet`);

--
-- Indexes for table `keuangan`
--
ALTER TABLE `keuangan`
  ADD PRIMARY KEY (`idkeuangan`),
  ADD KEY `keuangan_ibfk_1` (`idoutlet`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`idlaporan`),
  ADD KEY `idkeuangan` (`idkeuangan`),
  ADD KEY `idbebanpokok` (`idbebanpokok`),
  ADD KEY `laporan_ibfk_3` (`idoutlet`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`iduser`),
  ADD KEY `login_ibfk_1` (`idoutlet`);

--
-- Indexes for table `masuk`
--
ALTER TABLE `masuk`
  ADD PRIMARY KEY (`idmasuk`),
  ADD KEY `masuk_ibfk_1` (`idoutlet`);

--
-- Indexes for table `masukoutlet`
--
ALTER TABLE `masukoutlet`
  ADD PRIMARY KEY (`idmasuk1`),
  ADD KEY `masukoutlet_ibfk_1` (`idoutlet`);

--
-- Indexes for table `mutasi`
--
ALTER TABLE `mutasi`
  ADD KEY `mutasi_ibfk_1` (`idoutlet`);

--
-- Indexes for table `outlet`
--
ALTER TABLE `outlet`
  ADD PRIMARY KEY (`idoutlet`);

--
-- Indexes for table `po`
--
ALTER TABLE `po`
  ADD PRIMARY KEY (`idpo`),
  ADD KEY `po_ibfk_1` (`idoutlet`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`idbarang`),
  ADD KEY `stock_ibfk_1` (`idoutlet`);

--
-- Indexes for table `stockoutlet`
--
ALTER TABLE `stockoutlet`
  ADD PRIMARY KEY (`idbarang1`),
  ADD KEY `stockoutlet_ibfk_1` (`idoutlet`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bebanpokokpenjualan`
--
ALTER TABLE `bebanpokokpenjualan`
  MODIFY `idbebanpokok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `keluar`
--
ALTER TABLE `keluar`
  MODIFY `idkeluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `keluaroutlet`
--
ALTER TABLE `keluaroutlet`
  MODIFY `idkeluar1` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `keuangan`
--
ALTER TABLE `keuangan`
  MODIFY `idkeuangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `idlaporan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `masuk`
--
ALTER TABLE `masuk`
  MODIFY `idmasuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `masukoutlet`
--
ALTER TABLE `masukoutlet`
  MODIFY `idmasuk1` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `outlet`
--
ALTER TABLE `outlet`
  MODIFY `idoutlet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `po`
--
ALTER TABLE `po`
  MODIFY `idpo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `idbarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `stockoutlet`
--
ALTER TABLE `stockoutlet`
  MODIFY `idbarang1` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bebanpokokpenjualan`
--
ALTER TABLE `bebanpokokpenjualan`
  ADD CONSTRAINT `bebanpokokpenjualan_ibfk_1` FOREIGN KEY (`idoutlet`) REFERENCES `outlet` (`idoutlet`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `keluar`
--
ALTER TABLE `keluar`
  ADD CONSTRAINT `keluar_ibfk_1` FOREIGN KEY (`idoutlet`) REFERENCES `outlet` (`idoutlet`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `keluaroutlet`
--
ALTER TABLE `keluaroutlet`
  ADD CONSTRAINT `keluaroutlet_ibfk_1` FOREIGN KEY (`idoutlet`) REFERENCES `outlet` (`idoutlet`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `keuangan`
--
ALTER TABLE `keuangan`
  ADD CONSTRAINT `keuangan_ibfk_1` FOREIGN KEY (`idoutlet`) REFERENCES `outlet` (`idoutlet`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `laporan`
--
ALTER TABLE `laporan`
  ADD CONSTRAINT `laporan_ibfk_1` FOREIGN KEY (`idkeuangan`) REFERENCES `keuangan` (`idkeuangan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `laporan_ibfk_2` FOREIGN KEY (`idbebanpokok`) REFERENCES `bebanpokokpenjualan` (`idbebanpokok`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `laporan_ibfk_3` FOREIGN KEY (`idoutlet`) REFERENCES `outlet` (`idoutlet`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`idoutlet`) REFERENCES `outlet` (`idoutlet`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `masuk`
--
ALTER TABLE `masuk`
  ADD CONSTRAINT `masuk_ibfk_1` FOREIGN KEY (`idoutlet`) REFERENCES `outlet` (`idoutlet`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `masukoutlet`
--
ALTER TABLE `masukoutlet`
  ADD CONSTRAINT `masukoutlet_ibfk_1` FOREIGN KEY (`idoutlet`) REFERENCES `outlet` (`idoutlet`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mutasi`
--
ALTER TABLE `mutasi`
  ADD CONSTRAINT `mutasi_ibfk_1` FOREIGN KEY (`idoutlet`) REFERENCES `outlet` (`idoutlet`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `po`
--
ALTER TABLE `po`
  ADD CONSTRAINT `po_ibfk_1` FOREIGN KEY (`idoutlet`) REFERENCES `outlet` (`idoutlet`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`idoutlet`) REFERENCES `outlet` (`idoutlet`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stockoutlet`
--
ALTER TABLE `stockoutlet`
  ADD CONSTRAINT `stockoutlet_ibfk_1` FOREIGN KEY (`idoutlet`) REFERENCES `outlet` (`idoutlet`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
