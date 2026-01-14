-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2026 at 04:11 PM
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
  `tahun` varchar(4) NOT NULL,
  `ket` varchar(100) NOT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_mobil`
--

INSERT INTO `tbl_mobil` (`idMobil`, `namaMobil`, `kondisiMobil`, `platNomor`, `transmisi`, `noBPKB`, `atasNama`, `merkMobil`, `tahun`, `ket`, `createdAt`, `updatedAt`) VALUES
('M-0001', 'Kijang Innova G 1', 1, 'B 1371 KQN', 2, 'Data 1', 'Kanwil DJP Jawa Barat II', 'Toyota', '2015', '', NULL, '2026-01-14 22:05:36'),
('M-0002', 'Kijang Innova G 2', 1, 'B 1374 KQ', 2, 'Data 2', 'Kanwil DJP Jawa Barat II', 'Toyota', '', '', NULL, '2026-01-14 21:34:14'),
('M-0003', 'Kijang Innova G 3', 1, 'B 1382 N', 2, 'Data 3', 'Kanwil DJP Jawa Barat II', 'Toyota', '', '', NULL, '2026-01-14 21:34:05'),
('M-0004', 'Kijang Innova G 4', 1, 'B 1377 K', 2, 'Data 4', 'Kanwil DJP Jawa Barat II', 'Toyota', '', '', NULL, '2026-01-13 14:30:47'),
('M-0005', 'Kijang Innova G 5', 1, 'B 1375 Q', 2, 'Data 5', 'Kanwil DJP Jawa Barat II', 'Toyota', '', '', NULL, '2026-01-12 06:11:50'),
('M-0006', 'XPander 1.5L Exceed-K', 1, 'B 1562 QN', 1, 'Data 6', 'KPP Pratama Pondok Gede', 'Mitshubishi', '', '', NULL, '2026-01-12 06:12:02');

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
('S-0012', 'Fungsional Pemeriksa Pajak', '', NULL, '2026-01-14 21:48:58');

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
('U-0002', '$2y$10$wbPRefIsC0oH2a2/HhNkGe.9VmoXw.g75HMMHbuJGc3.cczZjQNXe', 'Muchamad Riya Zakariya', '910222958', 'S-0006', 2, '0', 1, '2026-01-09 03:35:42', '2026-01-14 21:44:47'),
('U-0003', '$2y$10$LiH4NYqx9VYZJ50hYl//KewxR6oSpUoQNEv4PRnUWDI3qpFnVABWe', 'Alathiev Cahyo Baskoro', '817932292', 'S-0003', 2, '0', 1, '2026-01-09 03:36:14', '2026-01-14 21:44:18'),
('U-0004', '$2y$10$xXpUcVFH/IHLUSBhnkHWSex.X2UqsO5.RF.9OqC9ZVX6UN0grPaBq', 'Dudy Satriya Widjana', '060098955', 'S-0005', 2, '0', 1, '2026-01-09 03:37:24', '2026-01-14 21:43:45'),
('U-0005', '$2y$10$QfTc/jMeRvTP18PzKrsWTe6FFyWvL7HhDnnrGXnFKtLzpxhvQWBZu', 'Nuris Dwi Wardiansah', '060103371', 'S-0002', 2, '0', 1, '2026-01-09 03:38:08', '2026-01-14 21:37:56'),
('U-0006', '$2y$10$cq/Brwunh/l8WDu/oorhKuYKjWwbi1Xl4ICi7Z8El3tqUvJQN8/4i', 'Safira Laras Pramesthi', '958635283', 'S-0001', 2, '0', 1, '2026-01-09 03:38:36', '2026-01-14 21:37:26'),
('U-0007', '$2y$10$RyIpgUHXcyr8avmfxJoLsuA69ztX78Qp1Cmb46NAPL/MZPX2ah9By', 'Veny Ardian Sari', '060109892', 'S-0001', 2, '0', 1, '2026-01-09 04:10:29', '2026-01-14 21:36:59'),
('U-0008', '$2y$10$B4K49RM76RZBnUnwXmVYI.jLkQLzxj51kBAZSJFlP0//wPyIu6uTK', 'Zahrani Suryati Liza', '830602903', 'S-0001', 2, '0', 1, '2026-01-12 06:27:19', '2026-01-14 21:36:25'),
('U-0009', '$2y$10$IT5vL2RUfG0.vgB0/HJWjOv6pnZjCGAPDrTuKo/FLeSC4VKTQIywu', 'Ade Mulya Ramadhan', '810201610', 'S-0001', 2, '0000000000', 1, '2026-01-12 13:55:40', '2026-01-14 21:35:25'),
('U-0010', '$2y$10$xBRrM0s5r3Uiih6NrQV1v.oquAdgAwrTS95K1pRSr.T.tZXxAAsT.', 'Intan Budiastri', '815101198', 'S-0001', 1, '0000000000', 1, '2026-01-13 14:29:45', '2026-01-14 21:34:58'),
('U-0011', '$2y$10$fgw6dxwoM2kzJZcNaBTdi.ZNOFeieQWMFg/BjSt1./vw4tZIylvR2', 'Yayang Fadhyla Artamevia', '958633549', 'S-0001', 1, '0000000000000', 1, '2026-01-14 21:21:14', '2026-01-14 21:21:14'),
('U-0012', '$2y$10$eBEpYegqPelWn.UDhvHfHuSjXLv3xmCvu3QoORs1SKBtCWo8/4w7y', 'Jangkon Ivan Primaristo Sitohang', '910222977', 'S-0007', 2, '0', 1, '2026-01-14 21:46:13', '2026-01-14 21:46:13'),
('U-0013', '$2y$10$.HdUXMOPj2pvmRBULoZu1ulLa/zrjM.rVCc4JalziATqnd34Skeca', 'Paska Marpaung', '060109173', 'S-0008', 2, '0', 1, '2026-01-14 21:46:41', '2026-01-14 21:46:41'),
('U-0014', '$2y$10$mwxM20xYZ6LmgFCluNT4AewJhEUWm3jxRZi6wj2KKYcUhvD4enrsy', 'Muhamad Choirul Rizqi', '910222534', 'S-0009', 2, '0', 1, '2026-01-14 21:47:13', '2026-01-14 21:47:13'),
('U-0015', '$2y$10$fdXTs5H7eVVcxfsdNC2QxeYVAQj1s.fCx0UxVxcOzcrLskx/j9sUW', 'Muhammad Prabowo', '917318431', 'S-0010', 2, '0', 1, '2026-01-14 21:47:37', '2026-01-14 21:47:37'),
('U-0016', '$2y$10$CuadAcRqnVUaPm.StdW5muHPb0.KC4HtnBnYqPjFwBInq/iBkBKDa', 'Wildan Amri Yahya', '910222398', 'S-0011', 2, '0', 1, '2026-01-14 21:48:02', '2026-01-14 21:48:02'),
('U-0017', '$2y$10$O7ZDDsKt7EeEKVXxvEX.Au5nKC.cC78VZsMt7l7fEzlw/jVnBKFDq', 'Arif Indra Kusuma', '830602280', 'S-0012', 2, '0', 1, '2026-01-14 21:48:23', '2026-01-14 21:48:23'),
('U-0018', '$2y$10$PFQ1qJAbtxx3MOBt4.iN.e5IVW.UGQCXPGWWGlfMaNe3M2atTKODi', 'Rivaldi Irvan', '830203566', 'S-0012', 2, '0', 1, '2026-01-14 21:48:45', '2026-01-14 21:48:45');

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
  MODIFY `idPerlengkapanPeminjaman` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

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
