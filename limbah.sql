-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Feb 2023 pada 09.45
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
-- Database: `limbah`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin_seksi`
--

CREATE TABLE `admin_seksi` (
  `id_seksi` int(11) NOT NULL,
  `seksi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin_seksi`
--

INSERT INTO `admin_seksi` (`id_seksi`, `seksi`) VALUES
(1, 'SCO'),
(2, 'SCP'),
(3, 'SRO'),
(4, 'SRP'),
(5, 'SCA'),
(6, 'SMB'),
(7, 'SGA-MO'),
(8, 'SMO'),
(9, 'SSW'),
(10, 'SMT'),
(11, 'SEP'),
(12, 'Petugas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin_table`
--

CREATE TABLE `admin_table` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(250) NOT NULL,
  `admin_contact_no` varchar(30) NOT NULL,
  `admin_email` varchar(250) NOT NULL,
  `admin_password` varchar(200) NOT NULL,
  `admin_profile` varchar(100) NOT NULL,
  `admin_type` text NOT NULL,
  `admin_seksi` text NOT NULL,
  `admin_created_on` datetime NOT NULL,
  `admin_status` enum('Enable','Disable','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin_table`
--

INSERT INTO `admin_table` (`admin_id`, `admin_name`, `admin_contact_no`, `admin_email`, `admin_password`, `admin_profile`, `admin_type`, `admin_seksi`, `admin_created_on`, `admin_status`) VALUES
(1, 'John Smith', '8569874587', 'johnsmith@gmail.com', '$2y$10$SY7Mc5BZsLlTjvNl70xhIOCyIVF9G7Xc1xqMzPmaSYTCrH.LG545q', 'images/22041.jpg', 'User', 'SMB', '2020-11-06 14:17:27', 'Enable'),
(2, 'Donna Huber', '8523698520', 'donnahuber@gmail.com', 'donna123', 'images/22308.jpg', 'User', 'SMB', '2020-11-08 09:08:33', 'Disable'),
(3, 'SEP', '7453952853', 'sep@gmail.com', '$2y$10$RjcczJE8PlKTr1jeLve2FuQW/jlySiQ9CL3h43hv8QXpvzrfFUaEu', 'images/880916378.png', 'Master', 'SEP', '2020-11-09 12:44:57', 'Enable'),
(4, 'Carl Meza', '9632585203', 'carlmeza@gmail.com', '$2y$10$gyv/CokUtimUAdXlQt9aRO8UBTnjSz.FqQQEk24vfQjgTppkFSz4q', 'images/1604922343.png', 'Petugas', 'Petugas', '2020-11-09 12:45:44', 'Enable'),
(5, 'Tyron Stein', '96369852635', 'tyronstein@gmail.com', '$2y$10$WIHtgnX5EqrKuruE31exGeZv.CLIHm52CggX1/vn.vr1d4tceFtsq', 'images/1604922395.png', 'Sep', 'SEP', '2020-11-09 12:46:35', 'Enable'),
(6, 'Peter Parker', '8569852632', 'peterparker@gmail.com', '$2y$10$uBTtPvR0YLH9f4FZt5uumeDz3HOmO8W2c.sNy8pvm7zvo8LHQ5zh.', 'images/6614.jpg', 'Kepseksi', 'SRO', '2020-11-11 14:00:27', 'Enable'),
(7, 'Sampe Gultom', '8569852632', 'sampe@gmail.com', '$2y$10$TEPbrptMa2BDv1pCoOQfJebDQud1pUXHZgT7r77Xj1vKq3DukZj/O', 'images/1173171134.jpg', 'Kepsep', 'SEP', '2023-01-31 03:41:06', 'Enable'),
(8, 'Harsel Purba', '7453952852', 'harsel@gmail.com', '$2y$10$oOs77OCJysyDFIM8NutEYOxbuPADEkFM1Bz0yIGf3HlfTr15GU34G', 'images/205768814.jpg', 'User', 'SSW', '2023-01-31 03:44:19', 'Enable');

-- --------------------------------------------------------

--
-- Struktur dari tabel `approval1`
--

CREATE TABLE `approval1` (
  `id_approval1` int(11) NOT NULL,
  `id_limbah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `approval1`
--

INSERT INTO `approval1` (`id_approval1`, `id_limbah`) VALUES
(1, 3),
(2, 4),
(3, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `approval2`
--

CREATE TABLE `approval2` (
  `id_approval2` int(11) NOT NULL,
  `id_approval1` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `approval2`
--

INSERT INTO `approval2` (`id_approval2`, `id_approval1`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `approval3`
--

CREATE TABLE `approval3` (
  `id_approval3` int(11) NOT NULL,
  `id_approval2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `form_table`
--

CREATE TABLE `form_table` (
  `id` int(11) NOT NULL,
  `admin_seksi` text NOT NULL,
  `nomor_request` varchar(50) NOT NULL,
  `tanggal_request` date NOT NULL,
  `tanggal_pengiriman` date NOT NULL,
  `keterangan` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `form_table`
--

INSERT INTO `form_table` (`id`, `admin_seksi`, `nomor_request`, `tanggal_request`, `tanggal_pengiriman`, `keterangan`) VALUES
(1, 'SRO', 'SRO-2-1', '2023-02-10', '2023-02-12', 'terdiri 4 limbah b3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_limbah`
--

CREATE TABLE `jenis_limbah` (
  `id_limbah` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `nama_limbah` text NOT NULL,
  `jumlah_limbah` float NOT NULL,
  `sifat` text NOT NULL,
  `bentuk` text NOT NULL,
  `kondisi` text NOT NULL,
  `status` enum('waiting','approval','reject','') NOT NULL DEFAULT 'waiting'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jenis_limbah`
--

INSERT INTO `jenis_limbah` (`id_limbah`, `id`, `nama_limbah`, `jumlah_limbah`, `sifat`, `bentuk`, `kondisi`, `status`) VALUES
(1, 1, 'Refraktory (B417)', 1, 'Beracun', 'Bongkahan', 'Belum Terkemas', 'approval'),
(2, 1, 'Butt Dust (B313-6)', 30, 'Beracun', 'Curah', 'Belum Terkemas', 'reject'),
(3, 1, 'Sludge dari IPAL (B313-8)', 12.4, 'Beracun', 'Bongkahan', 'Belum Terkemas', 'approval'),
(4, 1, 'Sludge dari IPAL (B313-8)', 4.6, '', '', '', 'approval');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nama_limbah`
--

CREATE TABLE `nama_limbah` (
  `id_namalimbah` int(11) NOT NULL,
  `limbah` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `nama_limbah`
--

INSERT INTO `nama_limbah` (`id_namalimbah`, `limbah`) VALUES
(1, 'Katoda (spent pot lining) (B313-4)'),
(2, 'Refraktory (B417)'),
(3, 'Anode scraps (B313-1)'),
(4, 'Carbon Mix (B313-6)'),
(5, 'Butt Dust (B313-6)'),
(6, 'Baking Filter Dust (B313-6)'),
(7, 'Sludge dari IPAL (B313-8)'),
(8, 'Dross Hitam (B313-3)');

-- --------------------------------------------------------

--
-- Struktur dari tabel `neraca`
--

CREATE TABLE `neraca` (
  `sumber_limbah` text NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `jumlah_keluar` float NOT NULL,
  `tujuan` text NOT NULL,
  `bukti_nomor` text NOT NULL,
  `id_neraca` int(11) NOT NULL,
  `id_penyimpanan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `neraca`
--

INSERT INTO `neraca` (`sumber_limbah`, `tanggal_keluar`, `jumlah_keluar`, `tujuan`, `bukti_nomor`, `id_neraca`, `id_penyimpanan`) VALUES
('Pot Reconstruction', '2023-04-30', 12.4, 'pt luar', 'luar-limbah-b313-8-30', 1, 1),
('Pot Reconstruction', '2023-05-01', 1, 'pt luar negeri', 'bd-12', 2, 3),
('limbah', '2023-02-10', 4.6, 'pt luar negeri', 'luar-limbah-b313-8-10', 3, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penyimpanan_tps`
--

CREATE TABLE `penyimpanan_tps` (
  `id_penyimpanan` int(11) NOT NULL,
  `id_approval1` int(11) NOT NULL,
  `tps` int(11) NOT NULL,
  `tanggal_masuk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penyimpanan_tps`
--

INSERT INTO `penyimpanan_tps` (`id_penyimpanan`, `id_approval1`, `tps`, `tanggal_masuk`) VALUES
(1, 1, 5, '2023-02-13'),
(2, 2, 6, '2022-11-10'),
(3, 3, 5, '2023-02-17');

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
(1, 2, 'banyak campuran partikel lain.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `reject_penyimpanan`
--

CREATE TABLE `reject_penyimpanan` (
  `id_rejectp` int(11) NOT NULL,
  `id_approval` int(11) NOT NULL,
  `ket_rejectp` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(4, 'SEP', 'Sampe Gultom, Lutfi Abdul Aziz, Jerry R Butar Butar, Doni Eko Prayudi, Rozzy Pratama', '2020-11-07 08:08:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tps`
--

CREATE TABLE `tps` (
  `id_tps` int(11) NOT NULL,
  `nomor_tps` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tps`
--

INSERT INTO `tps` (`id_tps`, `nomor_tps`) VALUES
(1, '1'),
(2, '2'),
(3, '3'),
(4, '4'),
(5, '5'),
(6, '6'),
(7, '7'),
(8, '8'),
(9, '9'),
(10, '10');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin_seksi`
--
ALTER TABLE `admin_seksi`
  ADD PRIMARY KEY (`id_seksi`);

--
-- Indeks untuk tabel `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indeks untuk tabel `approval1`
--
ALTER TABLE `approval1`
  ADD PRIMARY KEY (`id_approval1`);

--
-- Indeks untuk tabel `approval2`
--
ALTER TABLE `approval2`
  ADD PRIMARY KEY (`id_approval2`);

--
-- Indeks untuk tabel `approval3`
--
ALTER TABLE `approval3`
  ADD PRIMARY KEY (`id_approval3`);

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
-- Indeks untuk tabel `nama_limbah`
--
ALTER TABLE `nama_limbah`
  ADD PRIMARY KEY (`id_namalimbah`);

--
-- Indeks untuk tabel `neraca`
--
ALTER TABLE `neraca`
  ADD PRIMARY KEY (`id_neraca`);

--
-- Indeks untuk tabel `penyimpanan_tps`
--
ALTER TABLE `penyimpanan_tps`
  ADD PRIMARY KEY (`id_penyimpanan`);

--
-- Indeks untuk tabel `reject`
--
ALTER TABLE `reject`
  ADD PRIMARY KEY (`id_reject`);

--
-- Indeks untuk tabel `reject_penyimpanan`
--
ALTER TABLE `reject_penyimpanan`
  ADD PRIMARY KEY (`id_rejectp`);

--
-- Indeks untuk tabel `seksi_table`
--
ALTER TABLE `seksi_table`
  ADD PRIMARY KEY (`seksi_id`);

--
-- Indeks untuk tabel `tps`
--
ALTER TABLE `tps`
  ADD PRIMARY KEY (`id_tps`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin_seksi`
--
ALTER TABLE `admin_seksi`
  MODIFY `id_seksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `admin_table`
--
ALTER TABLE `admin_table`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `approval1`
--
ALTER TABLE `approval1`
  MODIFY `id_approval1` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `approval2`
--
ALTER TABLE `approval2`
  MODIFY `id_approval2` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `approval3`
--
ALTER TABLE `approval3`
  MODIFY `id_approval3` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `form_table`
--
ALTER TABLE `form_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `jenis_limbah`
--
ALTER TABLE `jenis_limbah`
  MODIFY `id_limbah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `nama_limbah`
--
ALTER TABLE `nama_limbah`
  MODIFY `id_namalimbah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `neraca`
--
ALTER TABLE `neraca`
  MODIFY `id_neraca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `penyimpanan_tps`
--
ALTER TABLE `penyimpanan_tps`
  MODIFY `id_penyimpanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `reject`
--
ALTER TABLE `reject`
  MODIFY `id_reject` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `reject_penyimpanan`
--
ALTER TABLE `reject_penyimpanan`
  MODIFY `id_rejectp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `seksi_table`
--
ALTER TABLE `seksi_table`
  MODIFY `seksi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tps`
--
ALTER TABLE `tps`
  MODIFY `id_tps` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
