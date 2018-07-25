-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2018 at 11:13 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_perpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `idAdmin` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `usernm` varchar(20) NOT NULL,
  `passwrd` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`idAdmin`, `nama`, `usernm`, `passwrd`) VALUES
(1, 'Administrator', 'admin', 'perpus');

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `noAnggota` varchar(10) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `tmpLahir` varchar(150) NOT NULL,
  `tglLahir` date NOT NULL,
  `alamat` text NOT NULL,
  `noHp` varchar(20) NOT NULL,
  `thnDaftar` varchar(4) NOT NULL,
  `jmlpinjam` int(4) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`noAnggota`, `nama`, `tmpLahir`, `tglLahir`, `alamat`, `noHp`, `thnDaftar`, `jmlpinjam`) VALUES
('001', 'hernanda lucyanaw', 'surabaya', '0000-00-00', 'sda JATIM', '0875468906', '2018', 1),
('002', 'iga', 'Surabaya', '1999-09-09', 'Sidoarjo', '09892388393', '2018', 2);

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `kodeBuku` varchar(20) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `pengarang` varchar(150) NOT NULL,
  `pen_jawab` varchar(150) DEFAULT NULL,
  `isbn` varchar(100) DEFAULT NULL,
  `issn` varchar(100) DEFAULT NULL,
  `idPenerbit` int(11) NOT NULL,
  `thnTerbit` varchar(4) NOT NULL,
  `tmpTerbit` varchar(150) DEFAULT NULL,
  `sumberBuku` varchar(50) DEFAULT NULL,
  `bahasa` varchar(20) DEFAULT NULL,
  `tebalHalaman` varchar(50) NOT NULL,
  `sinopsis` text,
  `idKategori` int(11) NOT NULL,
  `jmlBuku` int(4) NOT NULL,
  `no_induk` int(4) DEFAULT NULL,
  `stok` int(4) NOT NULL,
  `keterangan` text NOT NULL,
  `cover_buku` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`kodeBuku`, `judul`, `pengarang`, `pen_jawab`, `isbn`, `issn`, `idPenerbit`, `thnTerbit`, `tmpTerbit`, `sumberBuku`, `bahasa`, `tebalHalaman`, `sinopsis`, `idKategori`, `jmlBuku`, `no_induk`, `stok`, `keterangan`, `cover_buku`) VALUES
('B001', 'apa aja', 'wiwi', 'budi', '990', '991', 1, '2018', 'sby', 'suzana', 'jawa', '200', 'nugas', 90, 10, 220, 11, 'nsjaja', 'jn'),
('B002', 'Laskar Pelangi', 'Sutrisno', 'Iga', NULL, NULL, 111, '2000', 'Sidoarjo', 'Nidji', 'Indonesia', '60', 'Pertemanan', 123, 3, 6789, 40, 'Ready', 'sah');

-- --------------------------------------------------------

--
-- Table structure for table `buku_kategori`
--

CREATE TABLE `buku_kategori` (
  `idKategori` varchar(3) NOT NULL,
  `namaKategori` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buku_kategori`
--

INSERT INTO `buku_kategori` (`idKategori`, `namaKategori`) VALUES
('090', 'BINI'),
('afa', 'agaga'),
('BIN', 'Bahasa Indonesia'),
('IPA', 'Ilmu Pengetahuan Alam'),
('KOM', 'Komputer'),
('MTK', 'Matematika');

-- --------------------------------------------------------

--
-- Table structure for table `buku_penerbit`
--

CREATE TABLE `buku_penerbit` (
  `idPenerbit` int(11) NOT NULL,
  `namaPenerbit` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buku_penerbit`
--

INSERT INTO `buku_penerbit` (`idPenerbit`, `namaPenerbit`) VALUES
(1, 'ewinn'),
(2, 'weedz'),
(3, 'frezz');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `idGallery` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `pathfoto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`idGallery`, `keterangan`, `pathfoto`) VALUES
(5, 'foto', 'duh-buku-bahasa-indonesia-berisi-kata-kata-kasar.jpg'),
(6, 'foto', 'DSC_0265.jpg'),
(8, 'foto', 'images (3).jpg'),
(10, 'Picture', 'IMG-20180215-WA0006.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `noPeminjaman` varchar(12) NOT NULL,
  `kodeBuku` varchar(20) NOT NULL,
  `noAnggota` varchar(10) NOT NULL,
  `tglPinjam` date NOT NULL,
  `tglKembali` date NOT NULL,
  `stsPinjam` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`noPeminjaman`, `kodeBuku`, `noAnggota`, `tglPinjam`, `tglKembali`, `stsPinjam`) VALUES
('', 'B001', '001', '2018-07-23', '2018-07-30', '1'),
('20170401001', '000001110117', '2016000001', '2017-04-01', '2017-04-08', '2');

--
-- Triggers `peminjaman`
--
DELIMITER $$
CREATE TRIGGER `peminjaman_after_delete` AFTER DELETE ON `peminjaman` FOR EACH ROW BEGIN
	UPDATE buku SET stok = stok + 1 WHERE kodeBuku = OLD.kodeBuku;
	UPDATE anggota SET jmlpinjam = jmlpinjam + 1 WHERE noAnggota = OLD.noAnggota;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `peminjaman_after_insert` AFTER INSERT ON `peminjaman` FOR EACH ROW BEGIN
	UPDATE buku SET stok = stok -1 WHERE kodeBuku = NEW.kodeBuku;
	UPDATE anggota SET jmlpinjam = jmlpinjam -1 WHERE noAnggota = NEW.noAnggota;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `noPeminjaman` varchar(12) NOT NULL,
  `tglKembalib` date NOT NULL,
  `lamaPinjam` int(11) NOT NULL,
  `terLambat` int(11) NOT NULL,
  `denda` decimal(10,0) NOT NULL,
  `dendaRusak` decimal(10,0) NOT NULL,
  `keterangan` text NOT NULL,
  `stsBuku` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staff_laporan`
--

CREATE TABLE `staff_laporan` (
  `idLaporan` int(11) NOT NULL,
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
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff_laporan`
--

INSERT INTO `staff_laporan` (`idLaporan`, `judulLaporan`, `penyusun`, `thnPembuatan`, `idPenerbit`, `noInduk`, `noKelas`, `tglTerima`, `lemari`, `rak`, `kegiatan`, `jumlah`, `deskripsi`) VALUES
(1, 'Belum ada Judul', 'Iga', '2018', 1, 12, 1, '0000-00-00', '1', '3', 'supranatural', 4, 'ucnh'),
(2, 'Belum ada ', 'Erwin', '2018', 1, 8908, 13, '0000-00-00', '1', '2', 'Membaca', 1, 'Membaca Buku');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idAdmin`);

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`noAnggota`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`kodeBuku`);

--
-- Indexes for table `buku_kategori`
--
ALTER TABLE `buku_kategori`
  ADD PRIMARY KEY (`idKategori`);

--
-- Indexes for table `buku_penerbit`
--
ALTER TABLE `buku_penerbit`
  ADD PRIMARY KEY (`idPenerbit`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`idGallery`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`noPeminjaman`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`noPeminjaman`);

--
-- Indexes for table `staff_laporan`
--
ALTER TABLE `staff_laporan`
  ADD PRIMARY KEY (`idLaporan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `idAdmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `buku_penerbit`
--
ALTER TABLE `buku_penerbit`
  MODIFY `idPenerbit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `idGallery` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `staff_laporan`
--
ALTER TABLE `staff_laporan`
  MODIFY `idLaporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
