-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2023 at 04:27 AM
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `tgl_buka` date DEFAULT NULL,
  `tgl_tutup` date DEFAULT NULL,
  `tgl_pengumuman` date DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `isDelete` int(1) DEFAULT NULL COMMENT 'null = belum kehapus, 1 sudah kehapus'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_angkatan`
--

INSERT INTO `tbl_angkatan` (`id_angkatan`, `angkatan`, `tahun`, `tgl_buka`, `tgl_tutup`, `tgl_pengumuman`, `status`, `isDelete`) VALUES
(1, '2022/2023', '2022', NULL, NULL, NULL, 0, NULL),
(2, '2021/2022', '2021', NULL, NULL, NULL, 0, NULL),
(3, '2023/2024', '2023', '2023-08-01', '2023-08-30', '2023-09-04', 1, NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `password` varchar(64) NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nilai`
--

CREATE TABLE `tbl_nilai` (
  `id_nilai` int(11) NOT NULL,
  `id_dt_pribadi` int(11) NOT NULL,
  `un_mat` int(11) DEFAULT NULL,
  `un_bi` int(11) DEFAULT NULL,
  `un_ipa` int(11) DEFAULT NULL,
  `un_bing` int(11) DEFAULT NULL,
  `nilai_ps` int(11) NOT NULL,
  `nilai_pa` int(11) NOT NULL,
  `nilai_wawancara` int(11) NOT NULL,
  `rata` int(11) NOT NULL,
  `berkas` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT "{}"
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_smp`
--

CREATE TABLE `tbl_smp` (
  `id_smp` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_smp`
--

INSERT INTO `tbl_smp` (`id_smp`, `nama`) VALUES
(2, 'SMP NEGERI 1 BLANGKEJEREN'),
(3, 'SMP NEGERI 2 BLANGKEJEREN'),
(4, 'SMP NEGERI 3 BLANGKEJEREN'),
(5, 'SMP NEGERI 4 PERSIAPAN BLANGKEJEREN'),
(6, 'SMP NEGERI SATU ATAP AGUSEN'),
(7, 'SMP TERPADU MUHAMMADIYAH GAYO LUES'),
(8, 'SMPIT BUNAYYA'),
(9, 'SMPIT RAUDLATUL JANNAH'),
(10, 'SMPS SHALAHUDDIIN'),
(11, 'SMP NEGERI 2 KUTAPANJANG'),
(12, 'SMP NEGERI 1 KUTAPANJANG'),
(13, 'SMP RAUDHATUL QURAN'),
(14, 'SMPIT LADIA GALASKA'),
(15, 'SMP NEGERI 1 RIKIT GAIP'),
(16, 'SMP NEGERI 1 TERANGUN'),
(17, 'SMP NEGERI 2 TERANGUN'),
(18, 'SMP NEGERI 3 TERANGUN'),
(19, 'SMP NEGERI 4 TERANGUN'),
(20, 'SMPIT NURUL HIKMAH'),
(21, 'SMPN SATUU ATAP TERANGUN'),
(22, 'SMP NEGERI 1 PINING'),
(23, 'SMP NEGERI 2 PINING'),
(24, 'SMPN SATU ATAP LESTEN'),
(25, 'SMPN SATU ATAP PASIR PUTIH'),
(26, 'SMP NEGERI 1 BELANGJERANGO'),
(27, 'SMP NEGERI 2 BELANGJERANGO'),
(28, 'SMPS TERPADU BUSTANUL ARIFIN'),
(29, 'SMP NEGERI 1 PUTRI BETUNG'),
(30, 'SMP NEGERI 2 PUTRI BETUNG'),
(31, 'SMP NEGERI 1 DABUN GELANG'),
(32, 'SMP NEGERI SATU ATAP BLANGTEMUNG'),
(33, 'SMP NEGERI SATU ATAP KENDAWI'),
(34, 'SMPIT SERAMBI DARUSSALAM'),
(35, 'SMP NEGERI 1 BLANGPEGAYON'),
(36, 'SMPIT BADRUL ULUM'),
(37, 'SMP NEGERI 1 PANTAN CUACA'),
(38, 'SMPN SATU ATAP PANTAN CUACA'),
(39, 'SMP NEGERI 1 TRIPE JAYA'),
(40, 'SMP NEGERI 2 TRIPE JAYA'),
(41, 'MTSN 1 GAYO LUES'),
(42, 'MTS RUHUL A\'ZHAM'),
(43, 'MTSS UJUNG BARO'),
(44, 'MTS NURSSALAM');

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
-- Indexes for table `tbl_smp`
--
ALTER TABLE `tbl_smp`
  ADD PRIMARY KEY (`id_smp`);

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
  MODIFY `id_berkas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_dt_pribadi`
--
ALTER TABLE `tbl_dt_pribadi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_nilai`
--
ALTER TABLE `tbl_nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_smp`
--
ALTER TABLE `tbl_smp`
  MODIFY `id_smp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

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
