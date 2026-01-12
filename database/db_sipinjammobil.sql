-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2026 at 05:29 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sipinjammobil`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_logpeminjaman`
--

CREATE TABLE `tbl_logpeminjaman` (
  `idLog` varchar(20) NOT NULL,
  `idPeminjaman` varchar(20) NOT NULL,
  `aksi` int(11) NOT NULL,
  `idUser` varchar(10) NOT NULL,
  `createdAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_logpeminjaman`
--

INSERT INTO `tbl_logpeminjaman` (`idLog`, `idPeminjaman`, `aksi`, `idUser`, `createdAt`) VALUES
('Log-0000000001', 'PM-0000000001', 0, 'U-0003', '2026-01-12 08:55:44'),
('Log-0000000002', 'PM-0000000001', 0, 'U-0003', '2026-01-12 09:00:02'),
('Log-0000000003', 'PM-0000000001', 1, 'U-0003', '2026-01-12 09:00:41'),
('Log-0000000004', 'PM-0000000001', 2, 'U-0001', '2026-01-12 09:06:45'),
('Log-0000000005', 'PM-0000000001', 3, 'U-0001', '2026-01-12 09:24:23'),
('Log-0000000006', 'PM-0000000001', 4, 'U-0003', '2026-01-12 09:39:02'),
('Log-0000000007', 'PM-0000000001', 8, 'U-0001', '2026-01-12 09:44:06'),
('Log-0000000008', 'PM-0000000002', 1, 'U-0003', '2026-01-12 09:46:21'),
('Log-0000000009', 'PM-0000000002', 2, 'U-0001', '2026-01-12 10:43:58'),
('Log-0000000010', 'PM-0000000002', 3, 'U-0001', '2026-01-12 10:48:21'),
('Log-0000000011', 'PM-0000000002', 4, 'U-0003', '2026-01-12 10:50:45'),
('Log-0000000012', 'PM-0000000002', 7, 'U-0001', '2026-01-12 10:51:13'),
('Log-0000000013', 'PM-0000000002', 8, 'U-0001', '2026-01-12 10:51:59');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mobil`
--

CREATE TABLE `tbl_mobil` (
  `idMobil` varchar(10) NOT NULL,
  `namaMobil` varchar(100) NOT NULL,
  `kondisiMobil` int(11) NOT NULL,
  `platNomor` varchar(10) NOT NULL,
  `transmisi` int(11) NOT NULL,
  `noBPKB` varchar(10) NOT NULL,
  `atasNama` varchar(100) NOT NULL,
  `merkMobil` varchar(100) NOT NULL,
  `ket` varchar(100) NOT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_mobil`
--

INSERT INTO `tbl_mobil` (`idMobil`, `namaMobil`, `kondisiMobil`, `platNomor`, `transmisi`, `noBPKB`, `atasNama`, `merkMobil`, `ket`, `createdAt`, `updatedAt`) VALUES
('M-0001', 'Kijang Innova G 1', 2, 'B 1371 KQ', 2, 'Data 1', 'Kanwil DJP Jawa Barat II', 'Toyota', '', NULL, '2026-01-12 06:10:56'),
('M-0002', 'Kijang Innova G 2', 3, 'B 1374 KQ', 2, 'Data 2', 'Kanwil DJP Jawa Barat II', 'Toyota', '', NULL, '2026-01-12 10:59:45'),
('M-0003', 'Kijang Innova G 3', 1, 'B 1382 N', 2, 'Data 3', 'Kanwil DJP Jawa Barat II', 'Toyota', '', NULL, '2026-01-12 06:11:23'),
('M-0004', 'Kijang Innova G 4', 1, 'B 1377 K', 2, 'Data 4', 'Kanwil DJP Jawa Barat II', 'Toyota', '', NULL, '2026-01-12 06:11:38'),
('M-0005', 'Kijang Innova G 5', 1, 'B 1375 Q', 2, 'Data 5', 'Kanwil DJP Jawa Barat II', 'Toyota', '', NULL, '2026-01-12 06:11:50'),
('M-0006', 'XPander 1.5L Exceed-K', 1, 'B 1562 QN', 1, 'Data 6', 'KPP Pratama Pondok Gede', 'Mitshubishi', '', NULL, '2026-01-12 06:12:02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_peminjaman`
--

CREATE TABLE `tbl_peminjaman` (
  `idPeminjaman` varchar(20) NOT NULL,
  `idPeminjam` varchar(10) NOT NULL,
  `idSeksi` varchar(10) NOT NULL,
  `tglPeminjaman` date NOT NULL,
  `tglPengembalian` date NOT NULL,
  `preferensiTransmisi` int(11) NOT NULL,
  `keperluan` int(11) NOT NULL,
  `tujuan` text NOT NULL,
  `lampiran` varchar(255) DEFAULT NULL,
  `idMobil` varchar(10) NOT NULL,
  `token` varchar(8) NOT NULL,
  `statusPinjam` int(11) NOT NULL,
  `bensinPemakaian` int(11) NOT NULL,
  `bensinInspeksi` int(11) NOT NULL,
  `catatanPeminjam` text NOT NULL,
  `catatanInspeksi` text NOT NULL,
  `idVerifikator` varchar(10) NOT NULL,
  `idPenerima` varchar(10) NOT NULL,
  `idPemberi` varchar(10) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_peminjaman`
--

INSERT INTO `tbl_peminjaman` (`idPeminjaman`, `idPeminjam`, `idSeksi`, `tglPeminjaman`, `tglPengembalian`, `preferensiTransmisi`, `keperluan`, `tujuan`, `lampiran`, `idMobil`, `token`, `statusPinjam`, `bensinPemakaian`, `bensinInspeksi`, `catatanPeminjam`, `catatanInspeksi`, `idVerifikator`, `idPenerima`, `idPemberi`, `createdAt`, `updatedAt`) VALUES
('PM-0000000001', 'U-0003', 'S-0007', '2026-01-12', '2026-01-12', 3, 1, 'Pondok Gede', '', 'M-0002', 'DHZEP67J', 8, 5, 4, '', '', 'U-0001', 'U-0001', 'U-0001', '2026-01-12 08:55:44', '2026-01-12 09:44:06'),
('PM-0000000002', 'U-0003', 'S-0007', '2026-01-12', '2026-01-12', 3, 2, 'Jakasampurna', NULL, 'M-0002', 'ATYDYBYX', 8, 4, 3, '', '', 'U-0001', 'U-0001', 'U-0001', '2026-01-12 09:46:21', '2026-01-12 10:51:59');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_perlengkapan`
--

CREATE TABLE `tbl_perlengkapan` (
  `idPerlengkapan` varchar(10) NOT NULL,
  `namaPerlengkapan` varchar(100) NOT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_perlengkapan`
--

INSERT INTO `tbl_perlengkapan` (`idPerlengkapan`, `namaPerlengkapan`, `createdAt`, `updatedAt`) VALUES
('P0001', 'Charger Hp', NULL, NULL),
('P0002', 'X banner', NULL, NULL),
('P0003', 'Port USB', NULL, NULL),
('P0004', 'Tripod', NULL, NULL),
('P0005', 'ATK', '2026-01-11 19:18:34', '2026-01-11 19:18:34');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_perlengkapanpeminjaman`
--

CREATE TABLE `tbl_perlengkapanpeminjaman` (
  `idPerlengkapanPeminjaman` int(10) NOT NULL,
  `idPeminjaman` varchar(20) NOT NULL,
  `idPerlengkapan` varchar(10) NOT NULL,
  `isDikembalikan` int(11) NOT NULL,
  `isAda` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_perlengkapanpeminjaman`
--

INSERT INTO `tbl_perlengkapanpeminjaman` (`idPerlengkapanPeminjaman`, `idPeminjaman`, `idPerlengkapan`, `isDikembalikan`, `isAda`, `status`) VALUES
(31, 'PM-0000000001', 'P0001', 1, 0, 0),
(32, 'PM-0000000001', 'P0002', 1, 0, 0),
(33, 'PM-0000000002', 'P0002', 1, 1, 1),
(34, 'PM-0000000002', 'P0003', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_seksi`
--

CREATE TABLE `tbl_seksi` (
  `idSeksi` varchar(10) NOT NULL,
  `namaSeksi` varchar(100) NOT NULL,
  `ket` varchar(100) NOT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_seksi`
--

INSERT INTO `tbl_seksi` (`idSeksi`, `namaSeksi`, `ket`, `createdAt`, `updatedAt`) VALUES
('S-0001', 'Sub Bagian Umum dan Kepatuhan Internal', 'Lt 6', NULL, NULL),
('S-0002', 'Pelayanan', '', NULL, NULL),
('S-0003', 'Penjamin Kualitas Data', '', NULL, NULL),
('S-0004', 'Pelayanan', '', NULL, NULL),
('S-0005', 'Pemeriksaan,Penilaian dan Penagihan', '', NULL, NULL),
('S-0006', 'Pengawasan 1', '', NULL, NULL),
('S-0007', 'Pengawasan 2', '', NULL, NULL),
('S-0008', 'Pengawasan 3', '', NULL, NULL),
('S-0009', 'Pengawasan 4', '', NULL, NULL),
('S-0010', 'Pengawasan 5', '', NULL, NULL),
('S-0011', 'Pengawasan 6', '', NULL, NULL),
('S-0012', 'Fungsional', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_userpegawai`
--

CREATE TABLE `tbl_userpegawai` (
  `idUser` varchar(10) NOT NULL,
  `password` varchar(250) NOT NULL,
  `namaPegawai` varchar(255) NOT NULL,
  `nip` varchar(15) NOT NULL,
  `idSeksi` varchar(10) NOT NULL,
  `role` int(11) NOT NULL,
  `noHp` varchar(13) NOT NULL,
  `isActive` int(11) NOT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_userpegawai`
--

INSERT INTO `tbl_userpegawai` (`idUser`, `password`, `namaPegawai`, `nip`, `idSeksi`, `role`, `noHp`, `isActive`, `createdAt`, `updatedAt`) VALUES
('U-0001', '$2y$10$MX1IbzD28FtlGHLLL1rBE.eaFSNiGdFXf8O3dQoB2cw47FvypfzxG', 'Admin Admin', '01010101', 'S-0001', 1, '087897877411', 1, NULL, '2026-01-08 00:00:00'),
('U-0002', '$2y$10$wbPRefIsC0oH2a2/HhNkGe.9VmoXw.g75HMMHbuJGc3.cczZjQNXe', 'Was 1', '000000002', 'S-0006', 2, '08129991023', 1, '2026-01-09 03:35:42', '2026-01-09 00:00:00'),
('U-0003', '$2y$10$LiH4NYqx9VYZJ50hYl//KewxR6oSpUoQNEv4PRnUWDI3qpFnVABWe', 'Was 2', '000000003', 'S-0007', 2, '08129991023', 1, '2026-01-09 03:36:14', '2026-01-09 00:00:00'),
('U-0004', '$2y$10$xXpUcVFH/IHLUSBhnkHWSex.X2UqsO5.RF.9OqC9ZVX6UN0grPaBq', 'Was 3', '000000004', 'S-0008', 2, '08129991023', 1, '2026-01-09 03:37:24', NULL),
('U-0005', '$2y$10$V.ZtR8AOM0qwAYwwPqNjZeTTmGyIQKn1xhGbG2uWzYDjSuqxNkPz6', 'Admin 1', '000000005', 'S-0001', 1, '086612357833', 1, '2026-01-09 03:38:08', NULL),
('U-0006', '$2y$10$cq/Brwunh/l8WDu/oorhKuYKjWwbi1Xl4ICi7Z8El3tqUvJQN8/4i', 'PKD', '000000006', 'S-0003', 2, '081367642788', 0, '2026-01-09 03:38:36', '2026-01-12 06:29:49'),
('U-0007', '$2y$10$RyIpgUHXcyr8avmfxJoLsuA69ztX78Qp1Cmb46NAPL/MZPX2ah9By', 'Was 2 Lain', '000000007', 'S-0007', 2, '08129991023', 1, '2026-01-09 04:10:29', '2026-01-09 00:00:00'),
('U-0008', '$2y$10$B4K49RM76RZBnUnwXmVYI.jLkQLzxj51kBAZSJFlP0//wPyIu6uTK', 'Penyuluh', '000000008', 'S-0002', 2, '08129991023', 1, '2026-01-12 06:27:19', '2026-01-12 06:28:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_logpeminjaman`
--
ALTER TABLE `tbl_logpeminjaman`
  ADD PRIMARY KEY (`idLog`);

--
-- Indexes for table `tbl_mobil`
--
ALTER TABLE `tbl_mobil`
  ADD PRIMARY KEY (`idMobil`);

--
-- Indexes for table `tbl_peminjaman`
--
ALTER TABLE `tbl_peminjaman`
  ADD PRIMARY KEY (`idPeminjaman`);

--
-- Indexes for table `tbl_perlengkapan`
--
ALTER TABLE `tbl_perlengkapan`
  ADD PRIMARY KEY (`idPerlengkapan`);

--
-- Indexes for table `tbl_perlengkapanpeminjaman`
--
ALTER TABLE `tbl_perlengkapanpeminjaman`
  ADD PRIMARY KEY (`idPerlengkapanPeminjaman`);

--
-- Indexes for table `tbl_seksi`
--
ALTER TABLE `tbl_seksi`
  ADD PRIMARY KEY (`idSeksi`);

--
-- Indexes for table `tbl_userpegawai`
--
ALTER TABLE `tbl_userpegawai`
  ADD PRIMARY KEY (`idUser`),
  ADD KEY `seksiUser` (`idSeksi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_perlengkapanpeminjaman`
--
ALTER TABLE `tbl_perlengkapanpeminjaman`
  MODIFY `idPerlengkapanPeminjaman` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_userpegawai`
--
ALTER TABLE `tbl_userpegawai`
  ADD CONSTRAINT `seksiUser` FOREIGN KEY (`idSeksi`) REFERENCES `tbl_seksi` (`idSeksi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
