-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Agu 2021 pada 01.02
-- Versi server: 10.1.36-MariaDB
-- Versi PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `kode_admin` varchar(50) NOT NULL,
  `nama_admin` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`kode_admin`, `nama_admin`, `username`, `password`) VALUES
('ADM001', 'Taufik Rahman', 'rahman', '$2y$10$vZRnpXIXvPgSACn9Krvx5u.tHL.zVMFY8kBrNbL1snBTM0pknAa9q'),
('ADM002', 'Novian', 'novian', '$2y$10$SQfh.KXBXDWk80qzFX8F4esjiNf1ETQw5aHkeqz/a5ImduX7owT5i'),
('ADM003', 'Admin', 'admin', '$2y$10$.4IGBu9i9fwa4MHvkc9aUu2m7/afx9xrIdDaXdzWD8Xz5dxZAI8si');

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `kode_anggota` varchar(50) NOT NULL,
  `nama_anggota` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`kode_anggota`, `nama_anggota`, `tanggal_lahir`, `jenis_kelamin`, `alamat`, `foto`) VALUES
('AGT001', 'Taufik Rahman', '1995-05-24', 'Laki-laki', 'Pantai Hambawang', 'taufik.jpg'),
('AGT002', 'Nimatul Izati', '1995-01-09', 'Perempuan', 'Banua Kepayang', '606f0d61a1a9e.jpg'),
('AGT003', 'Asari', '1995-08-10', 'Laki-laki', 'Bankep', '607b9aa33433c.png'),
('AGT004', 'Nanang Astari', '1995-05-26', 'Perempuan', 'Banua Kepayang', '6107479b1d582.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `kode_buku` varchar(50) NOT NULL,
  `judul_buku` varchar(150) NOT NULL,
  `pengarang` varchar(100) NOT NULL,
  `penerbit` varchar(100) NOT NULL,
  `stok` varchar(50) NOT NULL,
  `kode_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`kode_buku`, `judul_buku`, `pengarang`, `penerbit`, `stok`, `kode_kategori`) VALUES
('BKU001', 'Kalor', 'Perry Sandria', 'PT Indah Jaya', '5', 'KTG001'),
('BKU002', 'Belajar Akuntansi Dasar', 'Nanang Suraji', 'PT Winanda Jaya', '5', 'KTG003'),
('BKU003', 'Belajar Corel Draw', 'Sanol', 'Mustika', '1', 'KTG005');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `kode_kategori` varchar(50) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`kode_kategori`, `nama_kategori`) VALUES
('KTG001', 'Ilmu Pengetahuan Alam'),
('KTG002', 'Ilmu Pengetahuan Sosial'),
('KTG003', 'Sosiologi'),
('KTG004', 'Pemprograman'),
('KTG005', 'Desain Grafis');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kembali`
--

CREATE TABLE `kembali` (
  `kode_kembali` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `kode_admin` varchar(50) NOT NULL,
  `kode_anggota` varchar(50) NOT NULL,
  `kode_kategori` varchar(50) NOT NULL,
  `kode_buku` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pinjam`
--

CREATE TABLE `pinjam` (
  `kode_pinjam` varchar(50) NOT NULL,
  `kode_admin` varchar(50) NOT NULL,
  `kode_anggota` varchar(50) NOT NULL,
  `kode_kategori` varchar(50) NOT NULL,
  `kode_buku` varchar(50) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pinjam`
--

INSERT INTO `pinjam` (`kode_pinjam`, `kode_admin`, `kode_anggota`, `kode_kategori`, `kode_buku`, `tanggal_pinjam`, `tanggal_kembali`) VALUES
('PJM001', 'ADM001', 'AGT001', 'KTG001', 'BKU001', '2021-08-02', '2021-08-09');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`kode_admin`);

--
-- Indeks untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`kode_anggota`);

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`kode_buku`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kode_kategori`);

--
-- Indeks untuk tabel `kembali`
--
ALTER TABLE `kembali`
  ADD PRIMARY KEY (`kode_kembali`);

--
-- Indeks untuk tabel `pinjam`
--
ALTER TABLE `pinjam`
  ADD PRIMARY KEY (`kode_pinjam`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
