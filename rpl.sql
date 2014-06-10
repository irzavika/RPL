-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Waktu pembuatan: 03. Juni 2014 jam 08:56
-- Versi Server: 5.5.8
-- Versi PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rpl`
--
CREATE DATABASE `rpl` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `rpl`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `beasiswa`
--

CREATE TABLE IF NOT EXISTS `beasiswa` (
  `id_beasiswa` int(10) NOT NULL AUTO_INCREMENT,
  `nama_beasiswa` varchar(50) NOT NULL,
  `pemberi_beasiswa` varchar(50) NOT NULL,
  `besar_beasiswa` varchar(50) NOT NULL,
  `tanggal_terima` date NOT NULL,
  `tanggal_berakhir` date NOT NULL,
  `kuota` int(11) NOT NULL,
  `syarat_ipk` float NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  PRIMARY KEY (`id_beasiswa`),
  KEY `id_beasiswa` (`id_beasiswa`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1023 ;

--
-- Dumping data untuk tabel `beasiswa`
--

INSERT INTO `beasiswa` (`id_beasiswa`, `nama_beasiswa`, `pemberi_beasiswa`, `besar_beasiswa`, `tanggal_terima`, `tanggal_berakhir`, `kuota`, `syarat_ipk`, `keterangan`) VALUES
(1001, 'Beasiswa Djarum', 'PT. Djarum rk', '1500000', '2014-01-01', '2014-12-31', 100, 2.99, 'mengumpulkan syarat - syarat ketentuan berupa surat ini dan itu serta bla... bla.. bla ...'),
(1002, 'Beasiswa pertamina', 'Pertamina ok', '2000000', '2014-07-01', '2014-12-31', 50, 2.75, 'beasiswa diterima tiap bulan dalam janga waktu 6 bulan'),
(1003, 'beasiswa sampoerna', 'sampoerna', '2000000', '2014-05-08', '2014-05-10', 10, 2, 'asgkwaghawh'),
(1020, 'beasiswa ajo', 'ajoj lole', '1000000', '2014-06-06', '2014-06-20', 1, 2, 'gawgawg'),
(1021, 'rasa pisang', 'pisang', '20000', '2014-06-06', '2014-06-14', 21, 3, 'gawgadwa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penerima_beasiswa`
--

CREATE TABLE IF NOT EXISTS `penerima_beasiswa` (
  `nomor_bp` varchar(10) NOT NULL,
  `nama_mahasiswa` varchar(50) NOT NULL,
  `nama_jurusan` enum('sistem informasi','sistem komputer') NOT NULL,
  `nama_fakultas` enum('teknologi informasi') NOT NULL,
  `id_beasiswa` int(10) NOT NULL,
  `jenis_kelamin` enum('laki-laki','wanita') NOT NULL,
  `agama` enum('islam','katolik','protestan','hindu','budha','konghucu') NOT NULL,
  `ipk` float NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `tanggal_terima` date NOT NULL,
  `tanggal_berakhir` date NOT NULL,
  PRIMARY KEY (`nomor_bp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penerima_beasiswa`
--

INSERT INTO `penerima_beasiswa` (`nomor_bp`, `nama_mahasiswa`, `nama_jurusan`, `nama_fakultas`, `id_beasiswa`, `jenis_kelamin`, `agama`, `ipk`, `keterangan`, `tanggal_terima`, `tanggal_berakhir`) VALUES
('1110001001', 'rpg', 'sistem informasi', 'teknologi informasi', 1002, 'laki-laki', 'islam', 2, 'eshaeh', '2014-06-05', '2014-06-05'),
('1110951005', 'anak teknik', 'sistem komputer', 'teknologi informasi', 1006, 'wanita', 'hindu', 4, 'aafawgag', '2014-06-04', '2014-06-27'),
('1110961001', 'winni', 'sistem informasi', 'teknologi informasi', 1001, 'wanita', 'islam', 3, 'qwerty', '2014-07-01', '2014-12-31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengajuan_beasiswa`
--

CREATE TABLE IF NOT EXISTS `pengajuan_beasiswa` (
  `nomor_bp` varchar(10) NOT NULL,
  `nama_mahasiswa` varchar(50) NOT NULL,
  `nama_jurusan` varchar(50) NOT NULL,
  `nama_fakultas` varchar(50) NOT NULL,
  `id_beasiswa` int(10) NOT NULL,
  `jenis_kelamin` enum('laki-laki','wanita') NOT NULL,
  `agama` enum('islam','katolik','protestan','hindu','budha','konghucu') NOT NULL,
  `ipk` float NOT NULL,
  `keterangan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengajuan_beasiswa`
--

INSERT INTO `pengajuan_beasiswa` (`nomor_bp`, `nama_mahasiswa`, `nama_jurusan`, `nama_fakultas`, `id_beasiswa`, `jenis_kelamin`, `agama`, `ipk`, `keterangan`) VALUES
('1110992020', 'epen', 'fti', 'teknologi informasi', 1004, 'laki-laki', 'islam', 3, 'awgwg'),
('1110961010', 'adjie cahyana', 'si', 'ti', 1001, 'laki-laki', 'islam', 3, 'wawawg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `level` enum('admin','user') NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`username`, `password`, `nama`, `level`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin'),
('user', 'ee11cbb19052e40b07aac0ca060c23ee', 'Adjie cahyana putra', 'user'),
('1110961010', 'ee11cbb19052e40b07aac0ca060c23ee', 'adjie cahyana putra', 'user');
