-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.19-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table db_perpus.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `idAdmin` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `usernm` varchar(20) NOT NULL,
  `passwrd` varchar(10) NOT NULL,
  PRIMARY KEY (`idAdmin`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table db_perpus.admin: ~0 rows (approximately)
DELETE FROM `admin`;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`idAdmin`, `nama`, `usernm`, `passwrd`) VALUES
	(1, 'Administrator', 'admin', 'admin');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- Dumping structure for table db_perpus.anggota
CREATE TABLE IF NOT EXISTS `anggota` (
  `noAnggota` varchar(10) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `tmpLahir` varchar(150) NOT NULL,
  `tglLahir` date NOT NULL,
  `alamat` text NOT NULL,
  `noHp` varchar(20) NOT NULL,
  `thnDaftar` varchar(4) NOT NULL,
  `jmlpinjam` int(4) NOT NULL DEFAULT '2',
  PRIMARY KEY (`noAnggota`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_perpus.anggota: ~2 rows (approximately)
DELETE FROM `anggota`;
/*!40000 ALTER TABLE `anggota` DISABLE KEYS */;
INSERT INTO `anggota` (`noAnggota`, `nama`, `tmpLahir`, `tglLahir`, `alamat`, `noHp`, `thnDaftar`, `jmlpinjam`) VALUES
	('2016000001', 'Juno Chen You', 'Beijing', '2000-08-24', 'Jambi', '0899989', '2016', 8),
	('2016000002', 'Boe Sue', 'New York', '2003-05-24', 'The Hok', '0865878899', '2016', 5);
/*!40000 ALTER TABLE `anggota` ENABLE KEYS */;

-- Dumping structure for table db_perpus.buku
CREATE TABLE IF NOT EXISTS `buku` (
  `kodeBuku` varchar(20) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `pengarang` varchar(150) NOT NULL,
  `pen_jawab` varchar(150) NOT NULL,
  `isbn` varchar(100) NOT NULL,
  `issn` varchar(100) NOT NULL,
  `idPenerbit` int(11) NOT NULL,
  `thnTerbit` varchar(4) NOT NULL,
  `tmpTerbit` varchar(150) NOT NULL,
  `sumberBuku` varchar(50) NOT NULL,
  `bahasa` varchar(20) NOT NULL,
  `tebalHalaman` varchar(50) NOT NULL,
  `sinopsis` text NOT NULL,
  `idKategori` int(11) NOT NULL,
  `jmlBuku` int(4) NOT NULL,
  `no_induk` int(4) NOT NULL,
  `stok` int(4) NOT NULL,
  `keterangan` text NOT NULL,
  `cover_buku` text NOT NULL,
  PRIMARY KEY (`kodeBuku`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_perpus.buku: ~0 rows (approximately)
DELETE FROM `buku`;
/*!40000 ALTER TABLE `buku` DISABLE KEYS */;
/*!40000 ALTER TABLE `buku` ENABLE KEYS */;

-- Dumping structure for table db_perpus.buku_kategori
CREATE TABLE IF NOT EXISTS `buku_kategori` (
  `idKategori` varchar(3) NOT NULL,
  `namaKategori` varchar(150) NOT NULL,
  PRIMARY KEY (`idKategori`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_perpus.buku_kategori: ~2 rows (approximately)
DELETE FROM `buku_kategori`;
/*!40000 ALTER TABLE `buku_kategori` DISABLE KEYS */;
INSERT INTO `buku_kategori` (`idKategori`, `namaKategori`) VALUES
	('BIG', 'Bibliografi'),
	('KOM', 'Komputer');
/*!40000 ALTER TABLE `buku_kategori` ENABLE KEYS */;

-- Dumping structure for table db_perpus.buku_penerbit
CREATE TABLE IF NOT EXISTS `buku_penerbit` (
  `idPenerbit` int(11) NOT NULL AUTO_INCREMENT,
  `namaPenerbit` varchar(150) NOT NULL,
  PRIMARY KEY (`idPenerbit`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table db_perpus.buku_penerbit: ~8 rows (approximately)
DELETE FROM `buku_penerbit`;
/*!40000 ALTER TABLE `buku_penerbit` DISABLE KEYS */;
INSERT INTO `buku_penerbit` (`idPenerbit`, `namaPenerbit`) VALUES
	(1, 'Balai Pelestarian Cagar Budaya Jambi'),
	(2, 'Balai Pelestarian Peninggalan Purbakala Jambi'),
	(3, 'Balai Arkeologi Palembang'),
	(4, 'Suaka Peninggalan Sejarah Dan Purbakala Jambi'),
	(5, 'STKIP-PGRI Lubuklinggau'),
	(6, 'Marine Archaeologist COO Arqueonautas Worldwide'),
	(7, 'Direktorat Pelindungan Dan Pembinaan Peninggalan Sejarah Dan Purbakala'),
	(8, 'Balai Arkeologi Sumatera Selatan'),
	(9, 'Balai Pelestarian Peninggalan Purbakala Batusangkar');
/*!40000 ALTER TABLE `buku_penerbit` ENABLE KEYS */;

-- Dumping structure for table db_perpus.gallery
CREATE TABLE IF NOT EXISTS `gallery` (
  `idGallery` int(11) NOT NULL AUTO_INCREMENT,
  `keterangan` text NOT NULL,
  `pathfoto` text NOT NULL,
  PRIMARY KEY (`idGallery`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table db_perpus.gallery: ~2 rows (approximately)
DELETE FROM `gallery`;
/*!40000 ALTER TABLE `gallery` DISABLE KEYS */;
INSERT INTO `gallery` (`idGallery`, `keterangan`, `pathfoto`) VALUES
	(5, 'foto', 'duh-buku-bahasa-indonesia-berisi-kata-kata-kasar.jpg'),
	(6, 'foto', 'DSC_0265.jpg');
/*!40000 ALTER TABLE `gallery` ENABLE KEYS */;

-- Dumping structure for table db_perpus.peminjaman
CREATE TABLE IF NOT EXISTS `peminjaman` (
  `noPeminjaman` varchar(12) NOT NULL,
  `kodeBuku` varchar(20) NOT NULL,
  `noAnggota` varchar(10) NOT NULL,
  `tglPinjam` date NOT NULL,
  `tglKembali` date NOT NULL,
  `stsPinjam` varchar(1) NOT NULL,
  PRIMARY KEY (`noPeminjaman`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_perpus.peminjaman: ~0 rows (approximately)
DELETE FROM `peminjaman`;
/*!40000 ALTER TABLE `peminjaman` DISABLE KEYS */;
INSERT INTO `peminjaman` (`noPeminjaman`, `kodeBuku`, `noAnggota`, `tglPinjam`, `tglKembali`, `stsPinjam`) VALUES
	('20170401001', '000001110117', '2016000001', '2017-04-01', '2017-04-08', '2');
/*!40000 ALTER TABLE `peminjaman` ENABLE KEYS */;

-- Dumping structure for table db_perpus.pengembalian
CREATE TABLE IF NOT EXISTS `pengembalian` (
  `noPeminjaman` varchar(12) NOT NULL,
  `tglKembalib` date NOT NULL,
  `lamaPinjam` int(11) NOT NULL,
  `terLambat` int(11) NOT NULL,
  `denda` decimal(10,0) NOT NULL,
  `dendaRusak` decimal(10,0) NOT NULL,
  `keterangan` text NOT NULL,
  `stsBuku` varchar(1) NOT NULL,
  PRIMARY KEY (`noPeminjaman`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_perpus.pengembalian: ~0 rows (approximately)
DELETE FROM `pengembalian`;
/*!40000 ALTER TABLE `pengembalian` DISABLE KEYS */;
INSERT INTO `pengembalian` (`noPeminjaman`, `tglKembalib`, `lamaPinjam`, `terLambat`, `denda`, `dendaRusak`, `keterangan`, `stsBuku`) VALUES
	('20170401001', '2017-04-01', 0, 0, 0, 0, '', '1');
/*!40000 ALTER TABLE `pengembalian` ENABLE KEYS */;

-- Dumping structure for table db_perpus.staff_laporan
CREATE TABLE IF NOT EXISTS `staff_laporan` (
  `idLaporan` int(11) NOT NULL AUTO_INCREMENT,
  `judulLaporan` varchar(150) NOT NULL,
  `penyusun` varchar(100) NOT NULL,
  `thnPembuatan` varchar(4) NOT NULL,
  `idPenerbit` int(11) NOT NULL,
  `noInduk` int(11) NOT NULL,
  `noKelas` int(11) NOT NULL,
  `tglTerima` date NOT NULL,
  `lemari` varchar(2) NOT NULL,
  `rak` varchar(2) NOT NULL,
  `kegiatan` varchar(30) NOT NULL,
  `jumlah` int(4) NOT NULL,
  `deskripsi` text NOT NULL,
  PRIMARY KEY (`idLaporan`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=latin1;

-- Dumping data for table db_perpus.staff_laporan: ~74 rows (approximately)
DELETE FROM `staff_laporan`;
/*!40000 ALTER TABLE `staff_laporan` DISABLE KEYS */;
/*!40000 ALTER TABLE `staff_laporan` ENABLE KEYS */;

-- Dumping structure for trigger db_perpus.peminjaman_after_delete
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `peminjaman_after_delete` AFTER DELETE ON `peminjaman` FOR EACH ROW BEGIN
	UPDATE buku SET stok = stok + 1 WHERE kodeBuku = OLD.kodeBuku;
	UPDATE anggota SET jmlpinjam = jmlpinjam + 1 WHERE noAnggota = OLD.noAnggota;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger db_perpus.peminjaman_after_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `peminjaman_after_insert` AFTER INSERT ON `peminjaman` FOR EACH ROW BEGIN
	UPDATE buku SET stok = stok -1 WHERE kodeBuku = NEW.kodeBuku;
	UPDATE anggota SET jmlpinjam = jmlpinjam -1 WHERE noAnggota = NEW.noAnggota;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
