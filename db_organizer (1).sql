-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Jun 2024 pada 06.05
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_organizer`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telepon` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `nama_lengkap`, `username`, `password`, `alamat`, `email`, `telepon`) VALUES
(1, 'admin febii\r\n', 'admin', 'admin', 'Jl. Imam Bonjol No.179, Teladan, Kisaran, Kabupaten Asahan, Sumatera Utara 21211', 'pink@gmail.com', '087856543456');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_conten`
--

CREATE TABLE `tbl_conten` (
  `id_conten` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` varchar(2000) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_conten`
--

INSERT INTO `tbl_conten` (`id_conten`, `judul`, `deskripsi`, `foto`) VALUES
(6, 'Lokasi Pink&#039;s Organizer', 'Usaha kami beradaa di daerah kota yang mudah ditemui, ikuti saja maps ini yaa!!', '665c87f0a11fe.jpg'),
(7, 'Undangan ', 'Undangan Pernikahan Galaksi &amp; Kejora', '665c88d7df6ef.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_paket`
--

CREATE TABLE `tbl_paket` (
  `nama_paket` varchar(25) NOT NULL,
  `harga` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_paket`
--

INSERT INTO `tbl_paket` (`nama_paket`, `harga`) VALUES
('Paket A', 'Rp 125.000.000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pemesan`
--

CREATE TABLE `tbl_pemesan` (
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_wa` varchar(18) NOT NULL,
  `paket` varchar(10) NOT NULL,
  `waktu_pesan` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_tamu`
--

CREATE TABLE `tbl_tamu` (
  `id_tamu` int(11) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `nomor_telepon` varchar(13) NOT NULL,
  `foto` varchar(255) NOT NULL DEFAULT 'default-tamu.jpeg',
  `kode_undangan` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `tanggal_registrasi` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_tamu`
--

INSERT INTO `tbl_tamu` (`id_tamu`, `nama_lengkap`, `alamat`, `nomor_telepon`, `foto`, `kode_undangan`, `password`, `tanggal_registrasi`) VALUES
(16, 'Choi Seungchol', 'Bali', '78687868', '665c8a3549079.jpg', 'vV1gJb', '1234', '10:15:22'),
(18, 'Ibu Founder Pink&#039;s Organize', 'Jl. Hos. Cokroaminoto', '0860485694', '665c8a94a86bc.jpeg', 'CuyAJI', '1234', NULL),
(19, 'Kim  Mingyu', 'Singapura', '767547654', '665c8d5107b40.jpeg', 'srEJwn', '1234', '10:15:01'),
(20, 'MeiMei dan Mail', 'Malaysia', '888899990000', '665c8d9e06a49.jpg', 'T1kmga', '123', '16:03:04'),
(21, 'Minichayon Tararak', 'Thailand', '787878', '665c8ddd5e6f5.jpeg', '3LOBVA', '123', '16:21:44');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_conten`
--
ALTER TABLE `tbl_conten`
  ADD PRIMARY KEY (`id_conten`);

--
-- Indeks untuk tabel `tbl_paket`
--
ALTER TABLE `tbl_paket`
  ADD PRIMARY KEY (`nama_paket`);

--
-- Indeks untuk tabel `tbl_pemesan`
--
ALTER TABLE `tbl_pemesan`
  ADD PRIMARY KEY (`nama`);

--
-- Indeks untuk tabel `tbl_tamu`
--
ALTER TABLE `tbl_tamu`
  ADD PRIMARY KEY (`id_tamu`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_conten`
--
ALTER TABLE `tbl_conten`
  MODIFY `id_conten` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tbl_tamu`
--
ALTER TABLE `tbl_tamu`
  MODIFY `id_tamu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
