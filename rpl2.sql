-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Waktu pembuatan: 19. Juni 2014 jam 13:41
-- Versi Server: 5.5.8
-- Versi PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rpl2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `beasiswa`
--

CREATE TABLE IF NOT EXISTS `beasiswa` (
  `nomor_beasiswa` int(5) NOT NULL AUTO_INCREMENT,
  `nama_beasiswa` varchar(50) NOT NULL,
  `asal_beasiswa` varchar(50) NOT NULL,
  `besar_beasiswa` varchar(50) NOT NULL,
  `kuota` int(10) NOT NULL,
  `syarat_ipk` float NOT NULL,
  `syarat_penerima` varchar(50) NOT NULL,
  `tanggal_terima` date NOT NULL,
  `tanggal_berakhir` date NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `status_beasiswa` varchar(100) NOT NULL,
  PRIMARY KEY (`nomor_beasiswa`),
  KEY `nama_beasiswa` (`nama_beasiswa`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1002 ;

--
-- Dumping data untuk tabel `beasiswa`
--

INSERT INTO `beasiswa` (`nomor_beasiswa`, `nama_beasiswa`, `asal_beasiswa`, `besar_beasiswa`, `kuota`, `syarat_ipk`, `syarat_penerima`, `tanggal_terima`, `tanggal_berakhir`, `keterangan`, `status_beasiswa`) VALUES
(1001, 'Beasiswa Djarum', 'PT. Dja''Rum', '1jta/ bulan', 100, 33, 'tidak ada', '2014-06-17', '2014-06-24', 'beasiswa djarum', 'membuka pendaftaran');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE IF NOT EXISTS `mahasiswa` (
  `nomor_induk` varchar(20) NOT NULL,
  `level` enum('user') NOT NULL,
  `nama_mahasiswa` varchar(50) NOT NULL,
  `nama_jurusan` enum('sistem informasi','sistem komputer') NOT NULL,
  `nama_fakultas` enum('teknologi informasi') NOT NULL,
  `ipk` float NOT NULL,
  `penghasilan_ortu` bigint(20) NOT NULL,
  `prestasi` varchar(200) NOT NULL,
  `pengalaman_organisasi` varchar(200) NOT NULL,
  `jenis_kelamin` enum('laki-laki','wanita') NOT NULL,
  `agama` enum('islam','katholik','protestan','hindu','budha','konghucu') NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `angkatan` int(4) NOT NULL,
  `semester` int(2) NOT NULL,
  PRIMARY KEY (`nomor_induk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`nomor_induk`, `level`, `nama_mahasiswa`, `nama_jurusan`, `nama_fakultas`, `ipk`, `penghasilan_ortu`, `prestasi`, `pengalaman_organisasi`, `jenis_kelamin`, `agama`, `alamat`, `angkatan`, `semester`) VALUES
('1110961010', 'user', 'adjie cahyana putra', 'sistem informasi', 'teknologi informasi', 3, 3000000, 'qwerty', 'qwerty', 'laki-laki', 'islam', 'pondok kopi no. 181 siteba', 2011, 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE IF NOT EXISTS `pegawai` (
  `nomor_induk` varchar(20) NOT NULL,
  `level` enum('admin') NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `jenis_kelamin` enum('laki-laki','wanita') NOT NULL,
  PRIMARY KEY (`nomor_induk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`nomor_induk`, `level`, `nama`, `jabatan`, `jenis_kelamin`) VALUES
('admin', 'admin', 'mr admin', 'the admin', 'laki-laki');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengajuan_beasiswa`
--

CREATE TABLE IF NOT EXISTS `pengajuan_beasiswa` (
  `nomor_pengajuan` int(10) NOT NULL AUTO_INCREMENT,
  `nomor_induk` varchar(20) NOT NULL,
  `ipk` float NOT NULL,
  `syarat_penerima` varchar(50) NOT NULL,
  `nomor_beasiswa` int(5) NOT NULL,
  `nama_beasiswa` varchar(50) NOT NULL,
  `tanggal_mendaftar` date NOT NULL,
  `status_beasiswa` enum('active','pemeriksaan','waiting list','tidak active') NOT NULL,
  `tanggal_terima` date NOT NULL,
  `tanggal_berakhir` date NOT NULL,
  PRIMARY KEY (`nomor_pengajuan`),
  KEY `nomor_induk` (`nomor_induk`),
  KEY `nomor_beasiswa` (`nomor_beasiswa`),
  KEY `nama_beasiswa` (`nama_beasiswa`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=414000002 ;

--
-- Dumping data untuk tabel `pengajuan_beasiswa`
--

INSERT INTO `pengajuan_beasiswa` (`nomor_pengajuan`, `nomor_induk`, `ipk`, `syarat_penerima`, `nomor_beasiswa`, `nama_beasiswa`, `tanggal_mendaftar`, `status_beasiswa`, `tanggal_terima`, `tanggal_berakhir`) VALUES
(414000001, '1110961010', 3, '', 1001, '', '2014-06-19', 'pemeriksaan', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `nomor_induk` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `level` enum('admin','user') NOT NULL,
  `pesan` varchar(200) NOT NULL,
  PRIMARY KEY (`nomor_induk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`nomor_induk`, `password`, `nama`, `level`, `pesan`) VALUES
('1110961010', 'ee11cbb19052e40b07aac0ca060c23ee', 'adjie cahyana', 'user', ''),
('admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin', ''),
('user', 'ee11cbb19052e40b07aac0ca060c23ee', 'user', 'user', '');

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `mahasiswa_ibfk_1` FOREIGN KEY (`nomor_induk`) REFERENCES `user` (`nomor_induk`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`nomor_induk`) REFERENCES `user` (`nomor_induk`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `pengajuan_beasiswa`
--
ALTER TABLE `pengajuan_beasiswa`
  ADD CONSTRAINT `pengajuan_beasiswa_ibfk_1` FOREIGN KEY (`nomor_induk`) REFERENCES `mahasiswa` (`nomor_induk`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `pengajuan_beasiswa_ibfk_2` FOREIGN KEY (`nomor_beasiswa`) REFERENCES `beasiswa` (`nomor_beasiswa`) ON DELETE CASCADE ON UPDATE NO ACTION;
