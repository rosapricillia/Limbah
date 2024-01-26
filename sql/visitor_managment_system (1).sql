-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Des 2022 pada 10.24
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `visitor_managment_system`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin_table`
--

CREATE TABLE `admin_table` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `admin_contact_no` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `admin_email` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `admin_password` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `admin_profile` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `admin_type` enum('Master','User') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `admin_created_on` datetime NOT NULL,
  `admin_status` enum('Enable','Disable') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin_table`
--

INSERT INTO `admin_table` (`admin_id`, `admin_name`, `admin_contact_no`, `admin_email`, `admin_password`, `admin_profile`, `admin_type`, `admin_created_on`, `admin_status`) VALUES
(1, 'SEP', '8569874587', 'sep@gmail.com', '$2y$10$SY7Mc5BZsLlTjvNl70xhIOCyIVF9G7Xc1xqMzPmaSYTCrH.LG545q', 'images/1776951990.png', 'Master', '2020-11-06 14:17:27', 'Enable'),
(2, 'Donna Huber', '8523698520', 'donnahuber@gmail.com', '$2y$10$2H2wHdkV8GJrV30TouhkXuTcP1gQeAY1rp7EGM4fYzOf/mibjzEg.', 'images/22308.jpg', 'User', '2020-11-08 09:08:33', 'Disable'),
(3, 'Colin Newton', '7453952852', 'colinnewton@gmail.com', '$2y$10$O.7mlW5/JC5ji5nF5YHDfuTFphnSbpsNN7FaQoG1BHEIEg4TVbLKW', 'images/31598.jpg', 'User', '2020-11-09 12:44:57', 'Enable'),
(4, 'Carl Meza', '9632585203', 'carlmeza@gmail.com', '$2y$10$gyv/CokUtimUAdXlQt9aRO8UBTnjSz.FqQQEk24vfQjgTppkFSz4q', 'images/1604922343.png', 'User', '2020-11-09 12:45:44', 'Enable'),
(5, 'Tyron Stein', '96369852635', 'tyronstein@gmail.com', '$2y$10$WIHtgnX5EqrKuruE31exGeZv.CLIHm52CggX1/vn.vr1d4tceFtsq', 'images/1604922395.png', 'User', '2020-11-09 12:46:35', 'Enable'),
(6, 'Peter Parker', '8569852632', 'peterparker@gmail.com', '$2y$10$uBTtPvR0YLH9f4FZt5uumeDz3HOmO8W2c.sNy8pvm7zvo8LHQ5zh.', 'images/6614.jpg', 'User', '2020-11-11 14:00:27', 'Enable');

-- --------------------------------------------------------

--
-- Struktur dari tabel `form_table`
--

CREATE TABLE `form_table` (
  `id` int(11) NOT NULL,
  `seksi` text NOT NULL,
  `nomor_request` varchar(50) NOT NULL,
  `tanggal_request` date NOT NULL,
  `tanggal_pengiriman` date NOT NULL,
  `keterangan` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `form_table`
--

INSERT INTO `form_table` (`id`, `seksi`, `nomor_request`, `tanggal_request`, `tanggal_pengiriman`, `keterangan`) VALUES
(1, 'SCP', 'SCP-10-1', '2022-11-30', '2022-12-09', 'scp'),
(2, 'SQA', 'SQA-10-2', '2022-12-02', '2022-12-10', 'sqa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_limbah`
--

CREATE TABLE `jenis_limbah` (
  `id_limbah` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `nama_limbah` text NOT NULL,
  `jumlah_limbah` int(11) NOT NULL,
  `sifat` text NOT NULL,
  `bentuk` text NOT NULL,
  `kondisi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jenis_limbah`
--

INSERT INTO `jenis_limbah` (`id_limbah`, `id`, `nama_limbah`, `jumlah_limbah`, `sifat`, `bentuk`, `kondisi`) VALUES
(1, 1, 'Carbon Mix', 600, 'Beracun', 'Bongkahan', 'Terkemas'),
(2, 1, 'Dross Hitam', 400, 'Beracun', 'Curah', 'Terkemas'),
(3, 2, 'Anode scraps', 300, 'Beracun', 'Curah', 'Terkemas'),
(4, 2, 'Refraktory', 500, 'Beracun', 'Bongkahan', 'Belum Terkemas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `reject`
--

CREATE TABLE `reject` (
  `id_reject` int(11) NOT NULL,
  `id_limbah` int(11) NOT NULL,
  `keterangan_reject` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `reject`
--

INSERT INTO `reject` (`id_reject`, `id_limbah`, `keterangan_reject`) VALUES
(1, 1, '21'),
(2, 1, '22'),
(3, 1, '25'),
(4, 1, '25'),
(5, 2, '26'),
(6, 3, '27'),
(7, 0, '28'),
(8, 0, '29'),
(9, 0, '30'),
(10, 0, '31'),
(11, 0, '31'),
(12, 0, '31'),
(13, 0, '31'),
(14, 0, '31'),
(15, 1, '31'),
(16, 0, '32'),
(17, 1, '32'),
(18, 1, '33'),
(19, 0, '34'),
(20, 1, '34'),
(21, 1, '35'),
(27, 1, '37'),
(28, 0, '37'),
(29, 1, '38'),
(30, 1, '40'),
(31, 1, '41'),
(32, 1, '42'),
(33, 1, '43'),
(34, 1, '111'),
(35, 1, '12'),
(36, 1, '31'),
(37, 1, '222'),
(38, 1, '2223'),
(39, 1, '2223'),
(40, 1, '61'),
(41, 1, '512'),
(42, 0, '333'),
(43, 0, '333'),
(44, 0, '333'),
(45, 0, '333'),
(46, 0, '144'),
(47, 0, '12'),
(48, 0, '12'),
(49, 0, '12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `seksi_table`
--

CREATE TABLE `seksi_table` (
  `seksi_id` int(11) NOT NULL,
  `seksi_name` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `seksi_contact_person` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `seksi_created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `seksi_table`
--

INSERT INTO `seksi_table` (`seksi_id`, `seksi_name`, `seksi_contact_person`, `seksi_created_on`) VALUES
(3, 'Marketing', 'Leon Batz, Dessie Labadie, Jayda Keebler', '2020-11-07 08:07:09'),
(4, 'HR', 'Peter Parker', '2020-11-07 08:08:47'),
(5, 'Production', 'Aubrey Nelson, Zayan Humphrey, Harris Lowe, Imaan Villa', '2020-11-09 12:41:59'),
(6, 'Accounting', 'Youssef Hook, Yousef Haigh, Marlie Booker', '2020-11-09 12:42:43'),
(7, 'Purchase', 'Harlee Murillo, Helena Lloyd, Kairon Bauer', '2020-11-09 12:43:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tps`
--

CREATE TABLE `tps` (
  `kode_tps` char(2) NOT NULL,
  `tps` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indeks untuk tabel `form_table`
--
ALTER TABLE `form_table`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jenis_limbah`
--
ALTER TABLE `jenis_limbah`
  ADD PRIMARY KEY (`id_limbah`);

--
-- Indeks untuk tabel `reject`
--
ALTER TABLE `reject`
  ADD PRIMARY KEY (`id_reject`);

--
-- Indeks untuk tabel `seksi_table`
--
ALTER TABLE `seksi_table`
  ADD PRIMARY KEY (`seksi_id`);

--
-- Indeks untuk tabel `tps`
--
ALTER TABLE `tps`
  ADD PRIMARY KEY (`kode_tps`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin_table`
--
ALTER TABLE `admin_table`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `form_table`
--
ALTER TABLE `form_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `jenis_limbah`
--
ALTER TABLE `jenis_limbah`
  MODIFY `id_limbah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `reject`
--
ALTER TABLE `reject`
  MODIFY `id_reject` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT untuk tabel `seksi_table`
--
ALTER TABLE `seksi_table`
  MODIFY `seksi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
