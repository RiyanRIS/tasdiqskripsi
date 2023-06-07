-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2023 at 10:44 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci4`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id_admin` int(11) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_admin`, `nama`, `username`, `password`) VALUES
(1, 'Admin', 'admin', '$2y$10$n03IiSBvcspr3nW3shQy8.PL875QlwiHpgZHz8BuI6ubYVxIUZQl6');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dt_pribadi`
--

CREATE TABLE `tbl_dt_pribadi` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tmpt_lahir` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan','','') NOT NULL,
  `agama` enum('Islam','Kristen','Khatolik','Hindu','Budha','Konghuchu') NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `asl_sekolah` varchar(50) NOT NULL,
  `no_tlpn` varchar(16) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_dt_pribadi`
--

INSERT INTO `tbl_dt_pribadi` (`id`, `nama`, `tmpt_lahir`, `tgl_lahir`, `jenis_kelamin`, `agama`, `alamat`, `asl_sekolah`, `no_tlpn`, `email`, `username`, `password`) VALUES
(1, 'nama', 'dawsd', '2023-06-06', 'Laki-laki', 'Kristen', 'awd', 'asd', '123', 'asd', '123', '$2y$10$QUjuozBaSReSM5kU2DPaluorIgJOYy2lNX6dAjfAuo.JT2dr7./eC'),
(2, 'nama lengkap', 'tempatnya', '2023-06-08', 'Laki-laki', 'Khatolik', 'asd', 'dwds', '123', 'asd@ss.d', 'admin', '$2y$10$7iI3G4tHOU7v8XSVtp971ule7t6UNt9JNa7IZaH/ePZPg8rbVR3uC');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nilai`
--

CREATE TABLE `tbl_nilai` (
  `id_nilai` int(11) NOT NULL,
  `id_dt_pribadi` int(11) NOT NULL,
  `nilai_un` int(11) NOT NULL,
  `nilai_raport` int(11) NOT NULL,
  `nilai_ps` int(11) NOT NULL,
  `nilai_pa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengumuman`
--

CREATE TABLE `tbl_pengumuman` (
  `id_pengumuman` int(11) NOT NULL,
  `id_nilai` int(11) NOT NULL,
  `tgl_pengumuman` datetime NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `id_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tbl_dt_pribadi`
--
ALTER TABLE `tbl_dt_pribadi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_nilai`
--
ALTER TABLE `tbl_nilai`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `nilai_dt_pribadi` (`id_dt_pribadi`);

--
-- Indexes for table `tbl_pengumuman`
--
ALTER TABLE `tbl_pengumuman`
  ADD PRIMARY KEY (`id_pengumuman`),
  ADD KEY `pengumuman_admin` (`id_admin`),
  ADD KEY `pengumuman_nilai` (`id_nilai`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_dt_pribadi`
--
ALTER TABLE `tbl_dt_pribadi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_nilai`
--
ALTER TABLE `tbl_nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_pengumuman`
--
ALTER TABLE `tbl_pengumuman`
  MODIFY `id_pengumuman` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_nilai`
--
ALTER TABLE `tbl_nilai`
  ADD CONSTRAINT `nilai_dt_pribadi` FOREIGN KEY (`id_dt_pribadi`) REFERENCES `tbl_dt_pribadi` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_pengumuman`
--
ALTER TABLE `tbl_pengumuman`
  ADD CONSTRAINT `pengumuman_admin` FOREIGN KEY (`id_admin`) REFERENCES `tbl_admin` (`id_admin`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pengumuman_nilai` FOREIGN KEY (`id_nilai`) REFERENCES `tbl_nilai` (`id_nilai`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
