-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2023 at 08:12 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci4_tasdiq`
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
-- Table structure for table `tbl_angkatan`
--

CREATE TABLE `tbl_angkatan` (
  `id_angkatan` int(11) NOT NULL,
  `angkatan` varchar(10) NOT NULL,
  `tahun` varchar(5) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `isDelete` int(1) DEFAULT NULL COMMENT 'null = belum kehapus, 1 sudah kehapus'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_angkatan`
--

INSERT INTO `tbl_angkatan` (`id_angkatan`, `angkatan`, `tahun`, `status`, `isDelete`) VALUES
(1, '2022/2023', '2022', 0, NULL),
(2, '2021/2022', '2021', 0, NULL),
(3, '2023/2024', '2023', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_berkas`
--

CREATE TABLE `tbl_berkas` (
  `id_berkas` int(11) NOT NULL,
  `id_dt_pribadi` int(11) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `file` varchar(255) NOT NULL,
  `status` varchar(60) NOT NULL,
  `upload_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `alamat` varchar(50) NOT NULL,
  `asl_sekolah` varchar(50) NOT NULL,
  `no_tlpn` varchar(16) NOT NULL,
  `email` varchar(50) NOT NULL,
  `id_angkatan` int(1) NOT NULL,
  `jurusan` enum('IPA','IPS','','') NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_dt_pribadi`
--


--
-- Table structure for table `tbl_nilai`
--

CREATE TABLE `tbl_nilai` (
  `id_nilai` int(11) NOT NULL,
  `id_dt_pribadi` int(11) NOT NULL,
  `nilai_un` int(11) NOT NULL,
  `nilai_raport` int(11) NOT NULL,
  `nilai_ps` int(11) NOT NULL,
  `nilai_pa` int(11) NOT NULL,
  `nilai_wawancara` int(11) NOT NULL,
  `rata` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_nilai`
--


--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tbl_angkatan`
--
ALTER TABLE `tbl_angkatan`
  ADD PRIMARY KEY (`id_angkatan`);

--
-- Indexes for table `tbl_berkas`
--
ALTER TABLE `tbl_berkas`
  ADD PRIMARY KEY (`id_berkas`),
  ADD KEY `berkas_peserta` (`id_dt_pribadi`);

--
-- Indexes for table `tbl_dt_pribadi`
--
ALTER TABLE `tbl_dt_pribadi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `angkatan_peserta` (`id_angkatan`);

--
-- Indexes for table `tbl_nilai`
--
ALTER TABLE `tbl_nilai`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `nilai_dt_pribadi` (`id_dt_pribadi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_angkatan`
--
ALTER TABLE `tbl_angkatan`
  MODIFY `id_angkatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_berkas`
--
ALTER TABLE `tbl_berkas`
  MODIFY `id_berkas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `tbl_dt_pribadi`
--
ALTER TABLE `tbl_dt_pribadi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `tbl_nilai`
--
ALTER TABLE `tbl_nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_berkas`
--
ALTER TABLE `tbl_berkas`
  ADD CONSTRAINT `berkas_peserta` FOREIGN KEY (`id_dt_pribadi`) REFERENCES `tbl_dt_pribadi` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_dt_pribadi`
--
ALTER TABLE `tbl_dt_pribadi`
  ADD CONSTRAINT `angkatan_peserta` FOREIGN KEY (`id_angkatan`) REFERENCES `tbl_angkatan` (`id_angkatan`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_nilai`
--
ALTER TABLE `tbl_nilai`
  ADD CONSTRAINT `nilai_dt_pribadi` FOREIGN KEY (`id_dt_pribadi`) REFERENCES `tbl_dt_pribadi` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
