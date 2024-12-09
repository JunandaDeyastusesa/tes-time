-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2023 at 12:59 PM
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
-- Database: `db_bimbelonline`
--

-- --------------------------------------------------------

--
-- Table structure for table `table_fasilitas`
--

CREATE TABLE `table_fasilitas` (
  `id_fasilitas` int(11) NOT NULL,
  `nama_fasilitas` varchar(255) NOT NULL,
  `jumlah` int(16) NOT NULL,
  `status_fasilitas` enum('Lengkap','Tidak Lengkap','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_fasilitas`
--

INSERT INTO `table_fasilitas` (`id_fasilitas`, `nama_fasilitas`, `jumlah`, `status_fasilitas`) VALUES
(33, 'sasas', 2, 'Tidak Lengkap'),
(21, 'sasas', 12, 'Tidak Lengkap'),
(111, 'sas', 12, 'Lengkap');

-- --------------------------------------------------------

--
-- Table structure for table `table_jadwal`
--

CREATE TABLE `table_jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `id_mentor` int(13) NOT NULL,
  `id_kelas` int(16) NOT NULL,
  `no_ruang` varchar(11) NOT NULL,
  `hari` varchar(255) NOT NULL,
  `jam_kelas` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_jadwal`
--

INSERT INTO `table_jadwal` (`id_jadwal`, `id_mentor`, `id_kelas`, `no_ruang`, `hari`, `jam_kelas`) VALUES
(110111, 1, 222, '02', 'Senin', '16:00:00'),
(110112, 12001, 333, '02', 'Selasa', '16:00:00'),
(110113, 333, 444, '01', 'Senin', '16:40:00'),
(110114, 333, 333, '02', 'Senin', '17:00:00'),
(110115, 333, 222, '01', 'Rabu', '12:00:00'),
(110116, 1, 222, '02', 'Kamis', '12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `table_mentor`
--

CREATE TABLE `table_mentor` (
  `id_mentor` int(13) NOT NULL,
  `nama_mentor` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telp` int(13) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_mentor`
--

INSERT INTO `table_mentor` (`id_mentor`, `nama_mentor`, `email`, `telp`, `tgl_lahir`, `alamat`) VALUES
(1, 'Hesti Nawang', 'hesti@gmail.com', 321212, '1997-12-22', 'Ngawi'),
(333, 'Azizah', 'azizahrosidah@gmail.com', 2147483647, '2023-02-06', 'Malang'),
(12001, 'Regina Ayu', 'regina@gmail.com', 2147483647, '2000-06-12', 'Ngawi');

-- --------------------------------------------------------

--
-- Table structure for table `table_paket_kls`
--

CREATE TABLE `table_paket_kls` (
  `id_kelas` int(16) NOT NULL,
  `nama_kelas` varchar(255) NOT NULL,
  `kapasitas_kelas` int(5) NOT NULL,
  `harga` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_paket_kls`
--

INSERT INTO `table_paket_kls` (`id_kelas`, `nama_kelas`, `kapasitas_kelas`, `harga`) VALUES
(222, 'SKD Kedinasan', 10, '450000'),
(333, 'TNI - Polri Reguler', 12, '500000'),
(444, 'Bahasa Inggris', 12, '350000'),
(555, 'SKD CPNS', 12, '550000');

-- --------------------------------------------------------

--
-- Table structure for table `table_pembayaran`
--

CREATE TABLE `table_pembayaran` (
  `id_bayar` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_kelas` int(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_pembayaran`
--

INSERT INTO `table_pembayaran` (`id_bayar`, `tanggal`, `id_siswa`, `id_kelas`) VALUES
(50001, '2023-01-01', 12041959, 444),
(50002, '2023-07-01', 12041960, 222),
(50003, '2023-11-23', 12322121, 333),
(50004, '2023-11-02', 12041960, 222),
(50005, '2023-05-23', 12041960, 333),
(50006, '2023-12-22', 12041960, 222),
(50007, '2023-11-24', 12041960, 222);

-- --------------------------------------------------------

--
-- Table structure for table `table_siswa`
--

CREATE TABLE `table_siswa` (
  `id_siswa` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `siswa_no_telp` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `tgl_daftar` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_siswa`
--

INSERT INTO `table_siswa` (`id_siswa`, `nama`, `siswa_no_telp`, `tanggal_lahir`, `alamat`, `tgl_daftar`) VALUES
(111, 'JUNANDA DEYASTUSESA', '12', '0021-12-21', 'sdsd', '1212-11-16'),
(444, 'www', '22', '0022-02-22', '222', '2023-11-04'),
(12041959, 'SASA', '083287228918', '2023-12-23', 'SASA', '2023-09-22'),
(12041960, 'Nur Azizah Malang', '08563228918', '0102-01-01', 'Surabaya', '2023-12-23'),
(12322121, 'Adam Rendi', '08213228918', '2023-12-19', 'Malang', '2023-12-23'),
(20230001, 'M Hakim', '08123291232', '2003-01-08', 'Surabaya', '2023-12-24'),
(1204220029, 'JUNANDA DEYASTUSESA', '08213223254', '2023-09-12', 'Ngawi', '2023-12-11');

-- --------------------------------------------------------

--
-- Table structure for table `table_user`
--

CREATE TABLE `table_user` (
  `id_akun` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_user`
--

INSERT INTO `table_user` (`id_akun`, `username`, `pass`) VALUES
(1, 'junanda', 'juna123'),
(2, '123', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `table_jadwal`
--
ALTER TABLE `table_jadwal`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_mentor` (`id_mentor`) USING BTREE;

--
-- Indexes for table `table_mentor`
--
ALTER TABLE `table_mentor`
  ADD PRIMARY KEY (`id_mentor`);

--
-- Indexes for table `table_paket_kls`
--
ALTER TABLE `table_paket_kls`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `table_pembayaran`
--
ALTER TABLE `table_pembayaran`
  ADD PRIMARY KEY (`id_bayar`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_siswa` (`id_siswa`,`id_kelas`) USING BTREE;

--
-- Indexes for table `table_siswa`
--
ALTER TABLE `table_siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indexes for table `table_user`
--
ALTER TABLE `table_user`
  ADD PRIMARY KEY (`id_akun`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `table_user`
--
ALTER TABLE `table_user`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `table_pembayaran`
--
ALTER TABLE `table_pembayaran`
  ADD CONSTRAINT `table_pembayaran_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `table_paket_kls` (`id_kelas`),
  ADD CONSTRAINT `table_pembayaran_ibfk_2` FOREIGN KEY (`id_siswa`) REFERENCES `table_siswa` (`id_siswa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
