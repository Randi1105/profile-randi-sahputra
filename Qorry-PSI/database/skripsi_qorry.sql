-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Feb 2025 pada 14.19
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skripsi_qorry`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `nama_karyawan` varchar(30) NOT NULL,
  `jk_karyawan` enum('Laki-laki','Perempuan') NOT NULL,
  `simpan_karyawan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nama_karyawan`, `jk_karyawan`, `simpan_karyawan`) VALUES
(1, 'Andika Putra', 'Laki-laki', '2025-02-14 06:43:07'),
(2, 'Karta Suryaningrat', 'Perempuan', '2025-02-13 19:17:58'),
(3, 'betti Yulianita', 'Perempuan', '2025-02-13 19:18:24'),
(4, 'Bunga Septia', 'Perempuan', '2025-02-13 19:18:55'),
(5, 'Mardhatillah ', 'Perempuan', '2025-02-13 19:19:24'),
(6, 'Depisyah Putra', 'Laki-laki', '2025-02-14 06:43:20'),
(7, 'Alvandi Yulisman', 'Laki-laki', '2025-02-14 06:43:32'),
(8, 'Meary Gustianti', 'Perempuan', '2025-02-13 19:20:58'),
(9, 'Adib farras', 'Laki-laki', '2025-02-13 19:21:28'),
(10, 'Riki Jamal', 'Perempuan', '2025-02-14 05:37:40'),
(11, 'Yuandre Mardinata', 'Laki-laki', '2025-02-14 06:43:49'),
(12, 'Riyan Yendi Pernando', 'Laki-laki', '2025-02-14 06:43:58'),
(13, 'bayu Riansyah', 'Laki-laki', '2025-02-14 06:44:06'),
(14, 'Abdi Pratama', 'Laki-laki', '2025-02-14 06:44:15'),
(15, 'Ruri Puspita Sari', 'Perempuan', '2025-02-13 19:23:42'),
(16, 'Nefri Arjuna', 'Laki-laki', '2025-02-14 06:44:25'),
(17, 'Edwin', 'Laki-laki', '2025-02-14 06:44:35'),
(18, 'Ahmad Zamil', 'Laki-laki', '2025-02-14 06:44:44'),
(19, 'Andriko irwan Saputra', 'Laki-laki', '2025-02-14 06:44:53'),
(20, 'Rian Rahmad Putra', 'Perempuan', '2025-02-14 06:45:06'),
(21, 'Linda Gusnarti', 'Perempuan', '2025-02-13 19:26:26'),
(22, 'Tiara Wahyuni', 'Perempuan', '2025-02-13 19:26:48'),
(23, 'Syabrina Aulia Fitri', 'Perempuan', '2025-02-13 19:27:21'),
(24, 'Rio Fernando', 'Laki-laki', '2025-02-14 06:45:21'),
(25, 'Rido Makaido', 'Laki-laki', '2025-02-14 06:45:30'),
(26, 'Novi Yulviana', 'Perempuan', '2025-02-13 19:30:07'),
(27, 'Wahyu Govinda', 'Laki-laki', '2025-02-14 06:45:38'),
(28, 'Rani Ramadani', 'Perempuan', '2025-02-13 19:30:45'),
(29, 'Beniqno Jonardi Putra', 'Laki-laki', '2025-02-14 06:45:49'),
(30, 'Syafri jami', 'Laki-laki', '2025-02-14 06:45:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `kode_kriteria` varchar(10) NOT NULL,
  `nama_kriteria` varchar(30) NOT NULL,
  `jenis_kriteria` enum('Benefit','Cost') NOT NULL,
  `tipe_kriteria` enum('Inputan','Pilihan') NOT NULL,
  `simpan_kriteria` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`kode_kriteria`, `nama_kriteria`, `jenis_kriteria`, `tipe_kriteria`, `simpan_kriteria`) VALUES
('C1', 'Kehadiran', 'Benefit', 'Pilihan', '2025-02-11 16:57:53'),
('C2', 'Telat', 'Benefit', 'Pilihan', '2025-02-11 16:58:14'),
('C3', 'Masa kerja', 'Benefit', 'Pilihan', '2025-02-13 18:54:32'),
('C4', 'Kerapian', 'Benefit', 'Pilihan', '2025-02-11 16:58:40'),
('C5', 'Tanggung jawab', 'Benefit', 'Pilihan', '2025-02-11 16:58:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` varchar(20) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `periode` int(11) NOT NULL,
  `C1` float NOT NULL,
  `C2` float NOT NULL,
  `C3` float NOT NULL,
  `C4` float NOT NULL,
  `C5` float NOT NULL,
  `simpan_nilai` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `id_karyawan`, `periode`, `C1`, `C2`, `C3`, `C4`, `C5`, `simpan_nilai`) VALUES
('2024-010973', 30, 2024, 4, 5, 4, 3, 5, '2025-02-14 05:55:09'),
('2024-026135', 8, 2024, 3, 5, 4, 1, 5, '2025-02-14 05:55:09'),
('2024-138171', 2, 2024, 2, 5, 4, 4, 5, '2025-02-14 05:55:09'),
('2024-164832', 12, 2024, 4, 5, 4, 4, 5, '2025-02-14 05:55:09'),
('2024-212565', 15, 2024, 3, 4, 3, 4, 5, '2025-02-14 05:55:09'),
('2024-285493', 28, 2024, 3, 5, 4, 4, 5, '2025-02-14 05:55:09'),
('2024-292795', 26, 2024, 4, 5, 4, 4, 5, '2025-02-14 05:55:09'),
('2024-311748', 29, 2024, 4, 5, 4, 1, 5, '2025-02-14 05:55:09'),
('2024-317666', 4, 2024, 2, 4, 4, 3, 5, '2025-02-14 05:55:09'),
('2024-330697', 9, 2024, 3, 5, 4, 3, 5, '2025-02-14 05:55:09'),
('2024-338108', 22, 2024, 2, 4, 4, 4, 5, '2025-02-14 05:55:09'),
('2024-386396', 14, 2024, 4, 5, 4, 4, 5, '2025-02-14 05:55:09'),
('2024-404537', 24, 2024, 4, 4, 4, 5, 5, '2025-02-14 05:55:09'),
('2024-411483', 21, 2024, 3, 5, 4, 3, 5, '2025-02-14 05:55:09'),
('2024-466020', 27, 2024, 4, 4, 3, 5, 5, '2025-02-14 05:55:09'),
('2024-468684', 23, 2024, 4, 5, 4, 4, 5, '2025-02-14 05:55:09'),
('2024-469270', 18, 2024, 3, 4, 4, 5, 5, '2025-02-14 05:55:09'),
('2024-510616', 3, 2024, 2, 4, 4, 4, 5, '2025-02-14 05:55:09'),
('2024-553535', 5, 2024, 1, 4, 4, 5, 5, '2025-02-14 05:55:09'),
('2024-554651', 10, 2024, 1, 5, 4, 5, 4, '2025-02-14 05:55:09'),
('2024-621850', 7, 2024, 3, 5, 4, 3, 5, '2025-02-14 05:55:09'),
('2024-671196', 19, 2024, 3, 4, 3, 1, 5, '2025-02-14 05:55:09'),
('2024-676309', 6, 2024, 1, 5, 3, 4, 5, '2025-02-14 05:55:09'),
('2024-710948', 11, 2024, 3, 5, 4, 4, 5, '2025-02-14 05:55:09'),
('2024-729324', 25, 2024, 3, 4, 4, 1, 5, '2025-02-14 05:55:09'),
('2024-780446', 16, 2024, 4, 5, 4, 5, 5, '2025-02-14 05:55:09'),
('2024-787549', 13, 2024, 3, 4, 4, 1, 5, '2025-02-14 05:55:09'),
('2024-821293', 20, 2024, 4, 5, 3, 5, 5, '2025-02-14 05:55:09'),
('2024-828760', 17, 2024, 3, 5, 4, 4, 5, '2025-02-14 05:55:09'),
('﻿2024-891398', 1, 2024, 2, 5, 4, 3, 5, '2025-02-14 05:55:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(10) NOT NULL,
  `nama_pengguna` varchar(30) NOT NULL,
  `jabatan` varchar(30) NOT NULL,
  `foto_pengguna` text NOT NULL,
  `simpan_pengguna` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `username`, `password`, `nama_pengguna`, `jabatan`, `foto_pengguna`, `simpan_pengguna`) VALUES
(1, 'admin', 'admin', 'Qorry Aquino', 'Admin', 'Qorry AquinoQorry ganteng.jpg', '2025-02-14 06:59:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sub_kriteria`
--

CREATE TABLE `sub_kriteria` (
  `id_sub` int(11) NOT NULL,
  `kode_kriteria` varchar(10) NOT NULL,
  `nama_sub` varchar(30) NOT NULL,
  `nilai_sub` int(11) NOT NULL,
  `simpan_sub` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `sub_kriteria`
--

INSERT INTO `sub_kriteria` (`id_sub`, `kode_kriteria`, `nama_sub`, `nilai_sub`, `simpan_sub`) VALUES
(17, 'C2', '1 - 59 Menit', 5, '2025-02-13 18:04:29'),
(18, 'C2', '> 60 Menit', 4, '2025-02-13 18:04:03'),
(19, 'C4', 'Tidak Rapi', 1, '2025-02-13 18:03:04'),
(20, 'C4', 'Kurang Rapi', 2, '2025-02-13 18:02:28'),
(21, 'C4', 'Cukup Rapi', 3, '2025-02-13 18:01:43'),
(22, 'C4', 'Rapi', 4, '2025-02-13 18:01:12'),
(23, 'C4', 'Sangat Rapi', 5, '2025-02-13 18:00:56'),
(30, 'C1', '< 19 Hari', 1, '2025-02-13 17:59:46'),
(31, 'C1', '20 - 21 Hari', 2, '2025-02-13 17:58:34'),
(32, 'C1', '22 - 23 Hari', 3, '2025-02-13 17:58:57'),
(33, 'C1', '24 - 25 Hari', 4, '2025-02-13 17:59:18'),
(34, 'C1', '26 Hari', 5, '2025-02-13 17:59:31'),
(35, 'C5', 'Iya', 5, '2025-02-13 18:00:07'),
(36, 'C5', 'Tidak', 4, '2025-02-13 18:00:29'),
(37, 'C3', '>= 10  Tahun', 5, '2025-02-13 18:33:33'),
(38, 'C3', '5 – 9 Tahun', 4, '2025-02-13 18:34:24'),
(39, 'C3', '< 5 Tahun', 3, '2025-02-13 18:34:56');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`kode_kriteria`);

--
-- Indeks untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `id_karyawan` (`id_karyawan`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indeks untuk tabel `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD PRIMARY KEY (`id_sub`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  MODIFY `id_sub` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
