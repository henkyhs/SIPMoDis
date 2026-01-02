-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2025 at 12:54 AM
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
-- Table structure for table `tbl_logpinjam`
--

CREATE TABLE `tbl_logpinjam` (
  `idLog` int(11) NOT NULL,
  `idPinjam` varchar(10) NOT NULL,
  `aksi` varchar(100) NOT NULL,
  `idUser` varchar(10) NOT NULL,
  `waktuLog` date NOT NULL
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
  `ket` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_mobil`
--

INSERT INTO `tbl_mobil` (`idMobil`, `namaMobil`, `kondisiMobil`, `platNomor`, `ket`) VALUES
('M0001', 'Avanza', 1, 'B2882AR', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pegawai`
--

CREATE TABLE `tbl_pegawai` (
  `idPegawai` varchar(10) NOT NULL,
  `namaPegawai` varchar(100) NOT NULL,
  `nip` int(11) NOT NULL,
  `idSeksi` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_pegawai`
--

INSERT INTO `tbl_pegawai` (`idPegawai`, `namaPegawai`, `nip`, `idSeksi`) VALUES
('P-0000', 'Superadmin', 0, 'S-0001');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_peminjaman`
--

CREATE TABLE `tbl_peminjaman` (
  `idPinjam` varchar(10) NOT NULL,
  `idMobil` varchar(10) NOT NULL,
  `idUser` varchar(10) NOT NULL,
  `tglPinjam` date NOT NULL,
  `tglKembali` date NOT NULL,
  `bensinSebelum` varchar(255) NOT NULL,
  `bensinSesudah` varchar(255) NOT NULL,
  `fisikMobilSebelum` varchar(255) NOT NULL,
  `fisikMobilSesudah` varchar(255) NOT NULL,
  `statusPinjam` int(11) NOT NULL,
  `idApproval` varchar(10) NOT NULL,
  `lampiran` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_peminjaman`
--

INSERT INTO `tbl_peminjaman` (`idPinjam`, `idMobil`, `idUser`, `tglPinjam`, `tglKembali`, `bensinSebelum`, `bensinSesudah`, `fisikMobilSebelum`, `fisikMobilSesudah`, `statusPinjam`, `idApproval`, `lampiran`) VALUES
('P0001', 'Belum Ada', 'U-0003', '2025-07-12', '0000-00-00', '', '', '', '', 5, 'U-0004', 'c431a679df7526c1e5863bdaa5740015.pdf'),
('P0002', 'Belum Ada', 'U-0003', '2025-07-16', '0000-00-00', '', '', 'sadas', '', 3, 'U-0004', '40944477fa579cf5b2de5334ed46411a.pdf'),
('P0003', 'Belum Ada', 'U-0003', '2025-07-16', '0000-00-00', '', '', '', '', 1, 'Belum Ada', '75f2582b8d2941d38a1203616dc79211.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_seksi`
--

CREATE TABLE `tbl_seksi` (
  `idSeksi` varchar(10) NOT NULL,
  `namaSeksi` varchar(100) NOT NULL,
  `ket` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_seksi`
--

INSERT INTO `tbl_seksi` (`idSeksi`, `namaSeksi`, `ket`) VALUES
('S-0001', 'Sub Bagian Umum dan Kepatuhan Internal', 'Lt 6'),
('S0002', 'Pengawasan 1', 'Lt 7');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `idUser` varchar(10) NOT NULL,
  `idPegawai` varchar(10) NOT NULL,
  `role` int(11) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`idUser`, `idPegawai`, `role`, `password`) VALUES
('U-0000', 'P-0000', 1, 'Admin1234');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_userpegawai`
--

CREATE TABLE `tbl_userpegawai` (
  `idUser` varchar(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `namaPegawai` varchar(255) NOT NULL,
  `nip` varchar(15) NOT NULL,
  `idSeksi` varchar(10) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_userpegawai`
--

INSERT INTO `tbl_userpegawai` (`idUser`, `username`, `password`, `namaPegawai`, `nip`, `idSeksi`, `role`) VALUES
('U-0001', 'admin.admin', '$2y$10$MX1IbzD28FtlGHLLL1rBE.eaFSNiGdFXf8O3dQoB2cw47FvypfzxG', 'Admin Admin', '01010101', 'S-0001', 1),
('U-0002', 'adm.adm', '$2y$10$c5OddARn1vFl5AyXbcS4uOYRLDogk.KGkOHFhMLxOsmfrLR76jkLy', 'Admin 1', '01010102', 'S-0001', 1),
('U-0003', 'pinjam1', '$2y$10$5cGPV/nZykO9QpdhDUM4O.v0fPC9sKuwbW1L3dTRAAnPVdch0W0Wm', 'Peminjam 1', '01010103', 'S0002', 2),
('U-0004', 'appro', '$2y$10$4kngOnOZjckQPPE9r6Tl.OdTyHjjDkqIr5dQupPvaE5SklPQbX6lC', 'Approval', '01010104', 'S-0001', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_logpinjam`
--
ALTER TABLE `tbl_logpinjam`
  ADD PRIMARY KEY (`idLog`);

--
-- Indexes for table `tbl_mobil`
--
ALTER TABLE `tbl_mobil`
  ADD PRIMARY KEY (`idMobil`);

--
-- Indexes for table `tbl_pegawai`
--
ALTER TABLE `tbl_pegawai`
  ADD PRIMARY KEY (`idPegawai`),
  ADD KEY `idSeksi` (`idSeksi`);

--
-- Indexes for table `tbl_peminjaman`
--
ALTER TABLE `tbl_peminjaman`
  ADD PRIMARY KEY (`idPinjam`),
  ADD KEY `Mobil` (`idMobil`),
  ADD KEY `UserPeminjam` (`idUser`),
  ADD KEY `UserApproval` (`idApproval`);

--
-- Indexes for table `tbl_seksi`
--
ALTER TABLE `tbl_seksi`
  ADD PRIMARY KEY (`idSeksi`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`idUser`),
  ADD KEY `idPegawai` (`idPegawai`);

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
-- AUTO_INCREMENT for table `tbl_logpinjam`
--
ALTER TABLE `tbl_logpinjam`
  MODIFY `idLog` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_pegawai`
--
ALTER TABLE `tbl_pegawai`
  ADD CONSTRAINT `idSeksi` FOREIGN KEY (`idSeksi`) REFERENCES `tbl_seksi` (`idSeksi`);

--
-- Constraints for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD CONSTRAINT `tbl_user_ibfk_1` FOREIGN KEY (`idPegawai`) REFERENCES `tbl_pegawai` (`idPegawai`);

--
-- Constraints for table `tbl_userpegawai`
--
ALTER TABLE `tbl_userpegawai`
  ADD CONSTRAINT `seksiUser` FOREIGN KEY (`idSeksi`) REFERENCES `tbl_seksi` (`idSeksi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
