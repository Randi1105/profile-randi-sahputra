-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 20, 2024 at 04:45 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_jne`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `idadmin` int NOT NULL,
  `nama` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pass` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `foto` text NOT NULL,
  `wsimpan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`idadmin`, `nama`, `user`, `pass`, `foto`, `wsimpan`) VALUES
(1, 'Randi Sahputra', 'randi', 'admin', 'randi.jpg', '2023-06-10 19:46:41');

-- --------------------------------------------------------

--
-- Table structure for table `bobot`
--

CREATE TABLE `bobot` (
  `id_bobot` int NOT NULL,
  `C1` float NOT NULL,
  `C2` float NOT NULL,
  `C3` float NOT NULL,
  `C4` float NOT NULL,
  `C5` float NOT NULL,
  `wsimpan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bobot`
--

INSERT INTO `bobot` (`id_bobot`, `C1`, `C2`, `C3`, `C4`, `C5`, `wsimpan`) VALUES
(1, 0.26, 0.23, 0.15, 0.14, 0.22, '2024-08-20 14:30:59');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `idkaryawan` int NOT NULL,
  `nama` varchar(30) NOT NULL,
  `posisi` varchar(30) NOT NULL,
  `jabatan` varchar(30) NOT NULL,
  `tgljoin` varchar(30) NOT NULL,
  `jk` varchar(15) NOT NULL,
  `wsimpan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`idkaryawan`, `nama`, `posisi`, `jabatan`, `tgljoin`, `jk`, `wsimpan`) VALUES
(2, 'Imbra Fernandes', 'Operasional', 'Staff', '2011-03-24', 'Laki-laki', '2023-06-10 15:59:08'),
(3, 'Siska Dinasari', 'Customer Service', 'Staff', '2008-02-07', 'Perempuan', '2023-06-10 18:36:00'),
(4, 'Ria Gustina', 'Customer Service', 'Staff', '2012-07-16', 'Perempuan', '2023-06-10 18:36:36'),
(5, 'Yoga Burhan Putra', 'Operasional', 'Staff', '2013-01-02', 'Laki-laki', '2023-06-10 18:37:20'),
(6, 'Yona Martavia', 'Accounting', 'Staff', '2015-03-18', 'Perempuan', '2023-06-10 21:16:14'),
(7, 'Anggi putri irman', 'Accounting', 'Staff', '2015-03-06', 'Perempuan', '2023-06-10 21:13:57'),
(8, 'Doni kurniawan', 'Operasional', 'Staff', '2016-05-16', 'Laki-laki', '2023-06-10 21:14:05'),
(9, 'Andri Salno', 'Operasional', 'Staff', '2016-10-05', 'Laki-laki', '2023-06-10 21:16:01'),
(10, 'Danil Caniago', 'Operasional', 'Staff', '2016-12-07', 'Laki-laki', '2023-06-10 21:15:18'),
(11, 'Nadya Edrina', 'Accounting', 'Staff', '2016-12-27', 'Perempuan', '2023-06-10 21:15:50');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `idnilai` int NOT NULL,
  `idkaryawan` int NOT NULL,
  `C1` int NOT NULL,
  `C2` int NOT NULL,
  `C3` int NOT NULL,
  `C4` int NOT NULL,
  `C5` int NOT NULL,
  `wsimpan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`idnilai`, `idkaryawan`, `C1`, `C2`, `C3`, `C4`, `C5`, `wsimpan`) VALUES
(16, 5, 90, 80, 90, 90, 50, '2024-08-20 14:40:31'),
(18, 4, 80, 90, 80, 90, 90, '2024-08-20 14:26:09'),
(19, 3, 80, 90, 80, 60, 90, '2024-08-20 14:31:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idadmin`);

--
-- Indexes for table `bobot`
--
ALTER TABLE `bobot`
  ADD PRIMARY KEY (`id_bobot`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`idkaryawan`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`idnilai`),
  ADD KEY `idkaryawan` (`idkaryawan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `idadmin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bobot`
--
ALTER TABLE `bobot`
  MODIFY `id_bobot` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `idkaryawan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `idnilai` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `penilaian_ibfk_1` FOREIGN KEY (`idkaryawan`) REFERENCES `karyawan` (`idkaryawan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
