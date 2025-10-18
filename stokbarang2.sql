-- MySQL dump 10.13  Distrib 8.0.43, for Linux (x86_64)
--
-- Host: localhost    Database: stokbarang
-- ------------------------------------------------------
-- Server version	8.0.43-0ubuntu0.22.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bebanpokokpenjualan`
--

DROP TABLE IF EXISTS `bebanpokokpenjualan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bebanpokokpenjualan` (
  `idbebanpokok` int NOT NULL AUTO_INCREMENT,
  `tanggal3` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `outlet3` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `persediaanawal` int NOT NULL,
  `belanjaproduksi` int NOT NULL,
  `persediaanakhir` int NOT NULL,
  `persediaanakhirmurni` int NOT NULL,
  `totalhargapokokpenjualan` int NOT NULL,
  `labakotor` int NOT NULL,
  `idoutlet` int DEFAULT NULL,
  PRIMARY KEY (`idbebanpokok`),
  KEY `bebanpokokpenjualan_ibfk_1` (`idoutlet`),
  CONSTRAINT `bebanpokokpenjualan_ibfk_1` FOREIGN KEY (`idoutlet`) REFERENCES `outlet` (`idoutlet`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bebanpokokpenjualan`
--

LOCK TABLES `bebanpokokpenjualan` WRITE;
/*!40000 ALTER TABLE `bebanpokokpenjualan` DISABLE KEYS */;
/*!40000 ALTER TABLE `bebanpokokpenjualan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `keluar`
--

DROP TABLE IF EXISTS `keluar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `keluar` (
  `idkeluar` int NOT NULL AUTO_INCREMENT,
  `idbarang` int NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `keterangan` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `qty` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `penerima` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `idoutlet` int DEFAULT NULL,
  PRIMARY KEY (`idkeluar`),
  KEY `keluar_ibfk_1` (`idoutlet`),
  CONSTRAINT `keluar_ibfk_1` FOREIGN KEY (`idoutlet`) REFERENCES `outlet` (`idoutlet`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `keluar`
--

LOCK TABLES `keluar` WRITE;
/*!40000 ALTER TABLE `keluar` DISABLE KEYS */;
/*!40000 ALTER TABLE `keluar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `keluaroutlet`
--

DROP TABLE IF EXISTS `keluaroutlet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `keluaroutlet` (
  `idkeluar1` int NOT NULL AUTO_INCREMENT,
  `transaksi` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `idbarang1` int NOT NULL,
  `tanggal1` date NOT NULL,
  `keterangan1` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `qty1` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `outlet` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `outlettujuan` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `idoutlet` int DEFAULT NULL,
  PRIMARY KEY (`idkeluar1`),
  KEY `keluaroutlet_ibfk_1` (`idoutlet`),
  CONSTRAINT `keluaroutlet_ibfk_1` FOREIGN KEY (`idoutlet`) REFERENCES `outlet` (`idoutlet`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `keluaroutlet`
--

LOCK TABLES `keluaroutlet` WRITE;
/*!40000 ALTER TABLE `keluaroutlet` DISABLE KEYS */;
/*!40000 ALTER TABLE `keluaroutlet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `keuangan`
--

DROP TABLE IF EXISTS `keuangan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `keuangan` (
  `idkeuangan` int NOT NULL AUTO_INCREMENT,
  `tanggal2` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `outlet2` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `shiftpagi` int NOT NULL,
  `shiftmalam` int NOT NULL,
  `debittransfer` int NOT NULL,
  `qris` int NOT NULL,
  `gojek` int NOT NULL,
  `grab` int NOT NULL,
  `total` int NOT NULL,
  `persediaanawal` int NOT NULL,
  `belanjaproduksi` int NOT NULL,
  `persediaanakhir` int NOT NULL,
  `persediaanakhirmurni` int NOT NULL,
  `totalhargapokokpenjualan` int NOT NULL,
  `labakotor` int NOT NULL,
  `biayaoperasional` int NOT NULL,
  `biayasewabangunan` int NOT NULL,
  `bebangaji` int NOT NULL,
  `pln` int NOT NULL,
  `pdam` int NOT NULL,
  `wifi` int NOT NULL,
  `bebanpajak` int NOT NULL,
  `totalbp` int NOT NULL,
  `lababersih` int NOT NULL,
  `idoutlet` int DEFAULT NULL,
  PRIMARY KEY (`idkeuangan`),
  KEY `keuangan_ibfk_1` (`idoutlet`),
  CONSTRAINT `keuangan_ibfk_1` FOREIGN KEY (`idoutlet`) REFERENCES `outlet` (`idoutlet`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `keuangan`
--

LOCK TABLES `keuangan` WRITE;
/*!40000 ALTER TABLE `keuangan` DISABLE KEYS */;
/*!40000 ALTER TABLE `keuangan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `laporan`
--

DROP TABLE IF EXISTS `laporan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `laporan` (
  `idlaporan` int NOT NULL AUTO_INCREMENT,
  `idkeuangan` int NOT NULL,
  `idbebanpokok` int NOT NULL,
  `total2` int NOT NULL,
  `idoutlet` int DEFAULT NULL,
  PRIMARY KEY (`idlaporan`),
  KEY `idkeuangan` (`idkeuangan`),
  KEY `idbebanpokok` (`idbebanpokok`),
  KEY `laporan_ibfk_3` (`idoutlet`),
  CONSTRAINT `laporan_ibfk_1` FOREIGN KEY (`idkeuangan`) REFERENCES `keuangan` (`idkeuangan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `laporan_ibfk_2` FOREIGN KEY (`idbebanpokok`) REFERENCES `bebanpokokpenjualan` (`idbebanpokok`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `laporan_ibfk_3` FOREIGN KEY (`idoutlet`) REFERENCES `outlet` (`idoutlet`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `laporan`
--

LOCK TABLES `laporan` WRITE;
/*!40000 ALTER TABLE `laporan` DISABLE KEYS */;
/*!40000 ALTER TABLE `laporan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `login` (
  `iduser` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `level` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `idoutlet` int DEFAULT NULL,
  PRIMARY KEY (`iduser`),
  KEY `login_ibfk_1` (`idoutlet`),
  CONSTRAINT `login_ibfk_1` FOREIGN KEY (`idoutlet`) REFERENCES `outlet` (`idoutlet`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login`
--

LOCK TABLES `login` WRITE;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` VALUES (1,'admin@gmail.com','12345678','Admin',NULL),(3,'yusufmuhammad230899@gmail.com','12345678','Leader/Kapten',5),(20,'hafiz@gmail.com','12345678','Kepala Gudang',5),(22,'arimbi@gmail.com','12345678','Finance',NULL),(25,'gudang1@gmail.com','12345678','Kepala Gudang',4),(26,'gudang2@gmail.com','12345678','Kepala Gudang',5),(27,'leader1@gmail.com','12345678','Leader/Kapten',4),(28,'leader2@gmail.com','12345678','Leader/Kapten',5),(29,'testgudang@gmail.com','12345678','Kepala Gudang',8);
/*!40000 ALTER TABLE `login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `masuk`
--

DROP TABLE IF EXISTS `masuk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `masuk` (
  `idmasuk` int NOT NULL AUTO_INCREMENT,
  `idbarang` int NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `keterangan` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `qty` int NOT NULL,
  `penerima` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `idoutlet` int DEFAULT NULL,
  PRIMARY KEY (`idmasuk`),
  KEY `masuk_ibfk_1` (`idoutlet`),
  CONSTRAINT `masuk_ibfk_1` FOREIGN KEY (`idoutlet`) REFERENCES `outlet` (`idoutlet`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `masuk`
--

LOCK TABLES `masuk` WRITE;
/*!40000 ALTER TABLE `masuk` DISABLE KEYS */;
INSERT INTO `masuk` VALUES (60,33,'2025-10-01 17:58:55','Minyak goreng 1L',10,'Bagian Gudang Budi',NULL);
/*!40000 ALTER TABLE `masuk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `masukoutlet`
--

DROP TABLE IF EXISTS `masukoutlet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `masukoutlet` (
  `idmasuk1` int NOT NULL AUTO_INCREMENT,
  `idbarang1` int NOT NULL,
  `tanggal1` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `transaksi` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `keterangan1` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `qty1` int NOT NULL,
  `outletasal` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `outlet` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `idoutlet` int DEFAULT NULL,
  PRIMARY KEY (`idmasuk1`),
  KEY `masukoutlet_ibfk_1` (`idoutlet`),
  CONSTRAINT `masukoutlet_ibfk_1` FOREIGN KEY (`idoutlet`) REFERENCES `outlet` (`idoutlet`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `masukoutlet`
--

LOCK TABLES `masukoutlet` WRITE;
/*!40000 ALTER TABLE `masukoutlet` DISABLE KEYS */;
/*!40000 ALTER TABLE `masukoutlet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mutasi`
--

DROP TABLE IF EXISTS `mutasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mutasi` (
  `idbarang2` int NOT NULL,
  `tanggal2` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `namabarang2` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `keterangan2` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `qty2` int NOT NULL,
  `outlet2` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `idoutlet` int DEFAULT NULL,
  KEY `mutasi_ibfk_1` (`idoutlet`),
  CONSTRAINT `mutasi_ibfk_1` FOREIGN KEY (`idoutlet`) REFERENCES `outlet` (`idoutlet`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mutasi`
--

LOCK TABLES `mutasi` WRITE;
/*!40000 ALTER TABLE `mutasi` DISABLE KEYS */;
/*!40000 ALTER TABLE `mutasi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `outlet`
--

DROP TABLE IF EXISTS `outlet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `outlet` (
  `idoutlet` int NOT NULL AUTO_INCREMENT,
  `namaoutlet` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idoutlet`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `outlet`
--

LOCK TABLES `outlet` WRITE;
/*!40000 ALTER TABLE `outlet` DISABLE KEYS */;
INSERT INTO `outlet` VALUES (4,'Ulin'),(5,'Cafe'),(6,'Loa Bakung'),(7,'Brigjen Katamso Bontang'),(8,'Berbas Bontang');
/*!40000 ALTER TABLE `outlet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `po`
--

DROP TABLE IF EXISTS `po`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `po` (
  `idpo` int NOT NULL AUTO_INCREMENT,
  `idbarang` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal2` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `keterangan` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `qty` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `kode_transaksi` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Status` int NOT NULL,
  `penerima` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `Supplier` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `idoutlet` int DEFAULT NULL,
  PRIMARY KEY (`idpo`),
  KEY `po_ibfk_1` (`idoutlet`),
  CONSTRAINT `po_ibfk_1` FOREIGN KEY (`idoutlet`) REFERENCES `outlet` (`idoutlet`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `po`
--

LOCK TABLES `po` WRITE;
/*!40000 ALTER TABLE `po` DISABLE KEYS */;
/*!40000 ALTER TABLE `po` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock`
--

DROP TABLE IF EXISTS `stock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stock` (
  `idbarang` int NOT NULL AUTO_INCREMENT,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `namabarang` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `keterangan` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Harga` int NOT NULL,
  `stock` int NOT NULL,
  `stockfisik` int DEFAULT NULL,
  `stocksisa` int DEFAULT NULL,
  `kategori` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `idoutlet` int DEFAULT NULL,
  PRIMARY KEY (`idbarang`),
  KEY `stock_ibfk_1` (`idoutlet`),
  CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`idoutlet`) REFERENCES `outlet` (`idoutlet`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock`
--

LOCK TABLES `stock` WRITE;
/*!40000 ALTER TABLE `stock` DISABLE KEYS */;
INSERT INTO `stock` VALUES (33,'2025-10-01 17:58:55','Bimoli','Keterangan barang 1',50000,110,NULL,NULL,'Makanan',NULL),(34,'2025-10-01 17:57:34','Garam','Keterangan barang 2',25000,50,NULL,NULL,'Minuman',NULL);
/*!40000 ALTER TABLE `stock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stockoutlet`
--

DROP TABLE IF EXISTS `stockoutlet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stockoutlet` (
  `idbarang1` int NOT NULL AUTO_INCREMENT,
  `tanggal1` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `namabarang1` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `keterangan1` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Harga1` int NOT NULL,
  `stock1` int NOT NULL,
  `stockfisik1` int DEFAULT NULL,
  `stocksisa1` int DEFAULT NULL,
  `kategori1` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `idoutlet` int DEFAULT NULL,
  PRIMARY KEY (`idbarang1`),
  KEY `stockoutlet_ibfk_1` (`idoutlet`),
  CONSTRAINT `stockoutlet_ibfk_1` FOREIGN KEY (`idoutlet`) REFERENCES `outlet` (`idoutlet`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stockoutlet`
--

LOCK TABLES `stockoutlet` WRITE;
/*!40000 ALTER TABLE `stockoutlet` DISABLE KEYS */;
INSERT INTO `stockoutlet` VALUES (22,'2025-10-02 01:00:00','Bimoli','Keterangan barang 1',50000,100,0,0,'Makanan',NULL),(23,'2025-10-02 01:00:00','Garam','Keterangan barang 2',25000,50,0,0,'Minuman',NULL);
/*!40000 ALTER TABLE `stockoutlet` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-10-02  7:19:28
