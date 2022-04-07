-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2022 at 06:06 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webmanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `stok_pengawas`
--

CREATE TABLE `stok_pengawas` (
  `id` int(11) NOT NULL,
  `nik` varchar(15) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `stok_pengawas` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stok_pengawas`
--

INSERT INTO `stok_pengawas` (`id`, `nik`, `id_barang`, `stok_pengawas`) VALUES
(17, '5', 1, 10),
(18, '5', 2, 10),
(19, '5', 3, 0),
(20, '5', 6, 0),
(21, '5', 7, 1000),
(22, '5', 8, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(20) NOT NULL,
  `stok` int(5) NOT NULL,
  `sisa_stok` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_barang`
--

INSERT INTO `tbl_barang` (`id_barang`, `nama_barang`, `stok`, `sisa_stok`) VALUES
(1, 'Modem', 116, 103),
(2, 'Router', 100, 89),
(3, 'ODP', 0, 0),
(6, 'Tang', 8, 1),
(7, 'Kabel', 1000, 1000),
(8, 'Konektor RJ45', 200, 200);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_karyawan`
--

CREATE TABLE `tbl_karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `nik` varchar(15) NOT NULL,
  `nama_karyawan` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_karyawan`
--

INSERT INTO `tbl_karyawan` (`id_karyawan`, `nik`, `nama_karyawan`, `jenis_kelamin`, `alamat`) VALUES
(1, '5', 'Pengawas', 'Laki-laki', 'Cipondoh'),
(2, '2', 'Operasional', 'Laki-laki', 'Cimone'),
(3, '3', 'Manajer', 'Laki-laki', 'Poris'),
(4, '12', 'Tes', 'Laki', 'Tes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_keluar`
--

CREATE TABLE `tbl_keluar` (
  `id_keluar` int(11) NOT NULL,
  `nik` varchar(15) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `qty` int(3) NOT NULL,
  `tgl_keluar` date NOT NULL,
  `kebutuhan` varchar(20) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_masuk`
--

CREATE TABLE `tbl_masuk` (
  `id_masuk` int(11) NOT NULL,
  `nik` varchar(15) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `qty` int(3) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_masuk`
--

INSERT INTO `tbl_masuk` (`id_masuk`, `nik`, `id_barang`, `qty`, `tgl_masuk`, `status`) VALUES
(10, '2', 7, 1000, '2022-02-13', 1),
(11, '2', 8, 100, '2022-02-13', 1),
(12, '5', 8, 100, '2022-02-13', 9),
(13, '5', 8, 100, '2022-02-13', 9),
(14, '2', 8, 100, '2022-02-13', 1),
(15, '5', 1, 10, '2022-02-13', 9),
(16, '5', 2, 10, '2022-02-13', 9);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pembelian`
--

CREATE TABLE `tbl_pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `nik` varchar(15) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jenis_pembelian` varchar(15) NOT NULL,
  `qty` int(5) NOT NULL,
  `harga` int(10) NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `keterangan` text NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pembelian`
--

INSERT INTO `tbl_pembelian` (`id_pembelian`, `nik`, `id_barang`, `jenis_pembelian`, `qty`, `harga`, `tanggal_pembelian`, `keterangan`, `status`) VALUES
(4, '2', 7, 'Barang Baru', 1000, 50000, '2022-02-13', 'Pengadaan Barang Baru', 3),
(5, '2', 8, 'Barang Baru', 100, 100000, '2022-02-13', 'Kebutuhan Barang Baru', 3),
(7, '2', 8, 'Barang Lama', 100, 100000, '2022-02-13', 'Kebutuhan Barang Baru', 0),
(8, '2', 8, 'Barang Lama', 100, 100000, '2022-02-13', 'Kebutuhan Barang Baru', 3),
(9, '2', 8, 'Barang Lama', 100, 100000, '2022-02-13', 'Kebutuhan Barang Baru', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_permintaan`
--

CREATE TABLE `tbl_permintaan` (
  `id_permintaan` int(11) NOT NULL,
  `nik` varchar(15) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `qty` int(5) NOT NULL,
  `tgl_permintaan` date NOT NULL,
  `keterangan` text NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_permintaan`
--

INSERT INTO `tbl_permintaan` (`id_permintaan`, `nik`, `id_barang`, `qty`, `tgl_permintaan`, `keterangan`, `status`) VALUES
(6, '5', 1, 10, '2022-02-13', 'Kebutuhan Pemasangan', 1),
(7, '5', 2, 10, '2022-02-13', 'Kebutuhan Pemasangan', 1),
(8, '5', 3, 10, '2022-02-13', 'Kebutuhan Pemasangan', 0),
(9, '5', 6, 10, '2022-02-13', 'Kebutuhan Pemasangan', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_permintaan_baru`
--

CREATE TABLE `tbl_permintaan_baru` (
  `id_permintaan_baru` int(11) NOT NULL,
  `nik` varchar(15) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `qty` int(5) NOT NULL,
  `tgl_permintaan_baru` date NOT NULL,
  `keterangan` text NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_permintaan_baru`
--

INSERT INTO `tbl_permintaan_baru` (`id_permintaan_baru`, `nik`, `nama_barang`, `qty`, `tgl_permintaan_baru`, `keterangan`, `status`) VALUES
(3, '5', 'Kabel', 1000, '2022-02-13', 'untuk keperluan pemasangan', 2),
(4, '5', 'Konektor RJ45', 100, '2022-02-13', 'Stok Baru Untuk Pemasangan / Perbaikan  Jaringan', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `nik` varchar(15) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `level` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `nik`, `username`, `password`, `level`) VALUES
(3, '2', 'Operasional', 'operasional', 'Operasional'),
(4, '3', 'Manajer', 'manajer', 'Manajer'),
(11, '5', 'pengawas@gmail.com', 'pengawas', 'Pengawas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `stok_pengawas`
--
ALTER TABLE `stok_pengawas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `tbl_karyawan`
--
ALTER TABLE `tbl_karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `tbl_keluar`
--
ALTER TABLE `tbl_keluar`
  ADD PRIMARY KEY (`id_keluar`);

--
-- Indexes for table `tbl_masuk`
--
ALTER TABLE `tbl_masuk`
  ADD PRIMARY KEY (`id_masuk`);

--
-- Indexes for table `tbl_pembelian`
--
ALTER TABLE `tbl_pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `tbl_permintaan`
--
ALTER TABLE `tbl_permintaan`
  ADD PRIMARY KEY (`id_permintaan`);

--
-- Indexes for table `tbl_permintaan_baru`
--
ALTER TABLE `tbl_permintaan_baru`
  ADD PRIMARY KEY (`id_permintaan_baru`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `stok_pengawas`
--
ALTER TABLE `stok_pengawas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_karyawan`
--
ALTER TABLE `tbl_karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_keluar`
--
ALTER TABLE `tbl_keluar`
  MODIFY `id_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_masuk`
--
ALTER TABLE `tbl_masuk`
  MODIFY `id_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_pembelian`
--
ALTER TABLE `tbl_pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_permintaan`
--
ALTER TABLE `tbl_permintaan`
  MODIFY `id_permintaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_permintaan_baru`
--
ALTER TABLE `tbl_permintaan_baru`
  MODIFY `id_permintaan_baru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
