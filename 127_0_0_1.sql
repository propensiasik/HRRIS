-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 28 Apr 2016 pada 07.23
-- Versi Server: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cdcol`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cds`
--

CREATE TABLE IF NOT EXISTS `cds` (
  `titel` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `interpret` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `jahr` int(11) DEFAULT NULL,
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=7 ;

--
-- Dumping data untuk tabel `cds`
--

INSERT INTO `cds` (`titel`, `interpret`, `jahr`, `id`) VALUES
('Beauty', 'Ryuichi Sakamoto', 1990, 1),
('Goodbye Country (Hello Nightclub)', 'Groove Armada', 2001, 4),
('Glee', 'Bran Van 3000', 1997, 5);
--
-- Database: `hrris`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `applicant`
--

CREATE TABLE IF NOT EXISTS `applicant` (
  `id_applicant` char(10) NOT NULL,
  `nama_applicant` varchar(70) NOT NULL,
  `emai_applicant` varchar(70) NOT NULL,
  `alamat` text NOT NULL,
  `gender` smallint(5) NOT NULL,
  `no_hp` varchar(70) NOT NULL,
  `universitas` varchar(70) NOT NULL,
  `jurusan` varchar(70) NOT NULL,
  `ipk` varchar(70) NOT NULL,
  `thn_lulus` smallint(5) NOT NULL,
  `CV` blob NOT NULL,
  `portofolio` blob,
  `text` text,
  `status_terupdate` char(10) NOT NULL,
  PRIMARY KEY (`id_applicant`),
  KEY `status_terupdate` (`status_terupdate`),
  KEY `status_terupdate_2` (`status_terupdate`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `applicant`
--

INSERT INTO `applicant` (`id_applicant`, `nama_applicant`, `emai_applicant`, `alamat`, `gender`, `no_hp`, `universitas`, `jurusan`, `ipk`, `thn_lulus`, `CV`, `portofolio`, `text`, `status_terupdate`) VALUES
('APP01', 'Alice', 'alice@gmail.com', 'Jakarta', 0, '0857322352', 'UI', 'Sistem Informasi', '3,7', 2014, 0x687474703a2f2f78797a2e636f6d, '', 'aaaa', 'S01'),
('APP02', 'Bob', 'bob@gmail.com', 'Jakarta', 0, '0857322352', 'UI', 'Ilmu Komputer', '3,5', 2014, 0x687474703a2f2f78797a2e636f6d, '', 'bbbb', 'S01'),
('APP03', 'Charlie', 'charlie@gmail.com', 'Depok', 0, '0857322352', 'ITB', 'Teknik Elektro', '3,2', 2013, 0x687474703a2f2f78797a2e636f6d, 0x687474703a2f2f78797a2e636f6d, 'ccc', 'S01'),
('APP04', 'Darwin', 'darwin@gmail.com', 'Bogor', 0, '0857322352', 'Gunadarma', 'Ilmu Komputer', '2,8', 2015, 0x687474703a2f2f78797a2e636f6d, '', 'dddd', 'S01'),
('APP05', 'Edward', 'edward@gmail.com', 'Bandung', 0, '0857322352', 'UI', 'Sistem Informasi', '3,2', 2015, 0x687474703a2f2f78797a2e636f6d, '', 'eeee', 'S01'),
('APP06', 'Felix ma''rij, S.kom!$ ', 'felix@gmail.com', 'Bogor', 0, '0857322352', 'UI', 'Ilmu Komputer', '3,2', 2012, 0x687474703a2f2f78797a2e636f6d, '', 'ffff', 'S01'),
('APP07', 'George', 'george@gmail.com', 'Bekasi', 0, '0857322352', 'UGM', 'Teknik Informatika', '3,3', 2012, 0x687474703a2f2f78797a2e636f6d, 0x687474703a2f2f78797a2e636f6d, 'ggg', 'S01'),
('APP08', 'Hans', 'hans@gmail.com', 'Jakarta', 0, '0857322352', 'Binus', 'Teknik Informatika', '2,9', 2011, 0x687474703a2f2f78797a2e636f6d, '', 'hhhh', 'S01'),
('APP09', 'Iris', 'iris@gmail.com', 'Tangerang', 0, '0857322352', 'UI', 'Ilmu Komputer', '2,7', 2010, 0x687474703a2f2f78797a2e636f6d, '', 'iiii', 'S01'),
('APP10', 'Jessica', 'jessica@gmail.com', 'Jakarta', 0, '0857322352', 'Gunadarma', 'Ilmu Komputer', '2,4', 2014, 0x687474703a2f2f78797a2e636f6d, 0x687474703a2f2f78797a2e636f6d, 'jjj', 'S01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `apply`
--

CREATE TABLE IF NOT EXISTS `apply` (
  `id_job_vacant` char(10) NOT NULL,
  `id_applicant` char(10) NOT NULL,
  PRIMARY KEY (`id_job_vacant`,`id_applicant`),
  KEY `id_applicant` (`id_applicant`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `apply`
--

INSERT INTO `apply` (`id_job_vacant`, `id_applicant`) VALUES
('JV01', 'APP01'),
('JV03', 'APP01'),
('JV02', 'APP02'),
('JV05', 'APP02'),
('JV01', 'APP03'),
('JV03', 'APP03'),
('JV02', 'APP04'),
('JV05', 'APP04'),
('JV01', 'APP05'),
('JV03', 'APP05'),
('JV02', 'APP06'),
('JV05', 'APP06'),
('JV03', 'APP07'),
('JV05', 'APP08'),
('JV01', 'APP09'),
('JV02', 'APP10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `available_schedule`
--

CREATE TABLE IF NOT EXISTS `available_schedule` (
  `id_av_schedule` char(10) NOT NULL,
  `available_date` date NOT NULL,
  `notes` text,
  `email_users` varchar(70) NOT NULL,
  `is_used` tinyint(1) NOT NULL,
  `id_job_vacant` char(10) NOT NULL,
  `waktu` time NOT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_av_schedule`),
  KEY `email_users` (`email_users`),
  KEY `id_job_vacant` (`id_job_vacant`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `available_schedule`
--

INSERT INTO `available_schedule` (`id_av_schedule`, `available_date`, `notes`, `email_users`, `is_used`, `id_job_vacant`, `waktu`, `updated_at`, `created_at`) VALUES
('AS01', '2016-03-26', 'lala', 'khalilahunafa@gmail.com', 0, 'JV01', '07:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('AS02', '2016-03-24', 'lili', 'ferrisaputra@gmail.com', 0, 'JV02', '08:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('AS03', '2016-03-24', 'lulu', 'khalilahunafa@gmail.com', 0, 'JV03', '09:10:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('AS04', '2016-03-24', '', 'nabilaclydea@gmail.com', 0, 'JV01', '08:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('AS05', '2016-03-26', '', 'anestanggang@gmail.com', 0, 'JV03', '12:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('AS06', '2016-03-24', 'assasa', 'ferrisaputra@gmail.com', 1, 'JV02', '10:00:00', NULL, NULL),
('AS07', '2016-03-24', 'assasa', 'ferrisaputra@gmail.com', 1, 'JV02', '13:00:00', NULL, NULL),
('AS08', '2016-03-25', 'assasa', 'ferrisaputra@gmail.com', 0, 'JV02', '10:00:00', NULL, NULL),
('AS09', '2016-03-28', NULL, 'khalilahunafa@gmail.com', 0, 'JV02', '10:00:00', NULL, NULL),
('AS10', '2016-03-28', NULL, 'khalilahunafa@gmail.com', 0, 'JV02', '12:00:00', NULL, NULL),
('AS11', '2016-03-28', NULL, 'khalilahunafa@gmail.com', 0, 'JV02', '14:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `id_company` char(10) NOT NULL,
  `nama_company` varchar(70) NOT NULL,
  PRIMARY KEY (`id_company`),
  UNIQUE KEY `nama_company` (`nama_company`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `company`
--

INSERT INTO `company` (`id_company`, `nama_company`) VALUES
('COM03', 'Contender'),
('COM01', 'Definite'),
('COM02', 'Flipbox'),
('COM04', 'Inovacto'),
('COM05', 'Paperplan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `competency`
--

CREATE TABLE IF NOT EXISTS `competency` (
  `id_kompetensi` char(10) NOT NULL,
  `nama_kompetensi` varchar(70) NOT NULL,
  `penjelasan_kompetensi` text NOT NULL,
  PRIMARY KEY (`id_kompetensi`),
  UNIQUE KEY `nama_kompetensi` (`nama_kompetensi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `competency`
--

INSERT INTO `competency` (`id_kompetensi`, `nama_kompetensi`, `penjelasan_kompetensi`) VALUES
('COM01', 'Inisiatif', 'ini 1'),
('COM02', 'Inovatif', 'ini 2'),
('COM03', 'Adaptasi', 'ini 3'),
('COM04', 'Komunikasi', 'ini 4'),
('COM05', 'Kolaboratif', 'ini 5'),
('COM06', 'Pengambilan keputusan', 'ini 6'),
('COM07', 'Professionalitas', 'ini 7'),
('COM08', 'Kerjasama tim', 'ini 8'),
('COM09', 'Antusiasme', 'ini 9'),
('COM10', 'Berfikir logis', 'ini 10'),
('COM11', 'Kedisiplinan', 'ini 11'),
('COM12', 'Kerapihan', 'ini 12'),
('COM13', 'Analisa', 'ini 13'),
('COM14', 'Mengarahkan', 'ini 14'),
('COM15', 'Kemandirian', 'ini 15'),
('COM16', 'Pengendalian diri', 'ini 16'),
('COM17', 'Sikap diri', 'ini 17'),
('COM18', 'Kreatifitas', 'ini 18'),
('COM19', 'Estetika', 'ini 19'),
('COM20', 'Visi', 'ini 20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `competency_used`
--

CREATE TABLE IF NOT EXISTS `competency_used` (
  `id_kompetensi` char(10) NOT NULL,
  `id_report_form` char(10) NOT NULL,
  PRIMARY KEY (`id_kompetensi`,`id_report_form`),
  KEY `id_report_form` (`id_report_form`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `competency_used`
--

INSERT INTO `competency_used` (`id_kompetensi`, `id_report_form`) VALUES
('COM01', 'RF01'),
('COM02', 'RF01'),
('COM03', 'RF01'),
('COM04', 'RF01'),
('COM05', 'RF01'),
('COM06', 'RF01'),
('COM07', 'RF01'),
('COM08', 'RF01'),
('COM09', 'RF01'),
('COM10', 'RF01'),
('COM11', 'RF01'),
('COM12', 'RF01'),
('COM13', 'RF01'),
('COM06', 'RF02'),
('COM07', 'RF02'),
('COM08', 'RF02'),
('COM09', 'RF02'),
('COM10', 'RF02'),
('COM11', 'RF02'),
('COM12', 'RF02'),
('COM13', 'RF02'),
('COM14', 'RF02'),
('COM15', 'RF02'),
('COM16', 'RF02'),
('COM17', 'RF02'),
('COM18', 'RF02'),
('COM19', 'RF02'),
('COM20', 'RF02'),
('COM01', 'RF03'),
('COM02', 'RF03'),
('COM03', 'RF03'),
('COM04', 'RF03'),
('COM05', 'RF03'),
('COM06', 'RF03'),
('COM07', 'RF03'),
('COM08', 'RF03'),
('COM10', 'RF03'),
('COM11', 'RF03'),
('COM16', 'RF03'),
('COM17', 'RF03'),
('COM18', 'RF03'),
('COM19', 'RF03'),
('COM20', 'RF03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `divisi`
--

CREATE TABLE IF NOT EXISTS `divisi` (
  `id_divisi` char(10) NOT NULL,
  `nama_divisi` varchar(70) NOT NULL,
  `id_company` char(10) NOT NULL,
  PRIMARY KEY (`id_divisi`),
  UNIQUE KEY `nama_divisi` (`nama_divisi`,`id_company`),
  KEY `id_company` (`id_company`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `divisi`
--

INSERT INTO `divisi` (`id_divisi`, `nama_divisi`, `id_company`) VALUES
('DIV04', 'Analyst', 'COM02'),
('DIV01', 'COO', 'COM02'),
('DIV02', 'HR', 'COM01'),
('DIV05', 'PM', 'COM02'),
('DIV06', 'Programmer', 'COM02'),
('DIV03', 'UI/UX', 'COM02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `interview`
--

CREATE TABLE IF NOT EXISTS `interview` (
  `id_wawancara` char(10) NOT NULL,
  `cara_wawancara` varchar(70) DEFAULT NULL,
  `notes` text,
  `id_applicant` char(10) NOT NULL,
  `id_av_schedule` char(10) NOT NULL,
  `keterangan` char(5) DEFAULT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_wawancara`),
  KEY `id_applicant` (`id_applicant`),
  KEY `id_av_schedule` (`id_av_schedule`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `interview`
--

INSERT INTO `interview` (`id_wawancara`, `cara_wawancara`, `notes`, `id_applicant`, `id_av_schedule`, `keterangan`, `updated_at`, `created_at`) VALUES
('IN01', 'Meet', '', 'APP02', 'AS07', '1', '2016-04-18 12:44:34', '2016-04-18 12:44:34'),
('IN02', 'Meet', '', 'APP04', 'AS06', '1', '2016-04-27 14:42:45', '2016-04-27 14:42:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `involved_interview`
--

CREATE TABLE IF NOT EXISTS `involved_interview` (
  `id_wawancara` char(10) NOT NULL,
  `email_users` varchar(70) NOT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_wawancara`,`email_users`),
  KEY `email_users` (`email_users`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `involved_interview`
--

INSERT INTO `involved_interview` (`id_wawancara`, `email_users`, `updated_at`, `created_at`) VALUES
('IN01', 'anestanggang@gmail.com', '2016-04-18 12:44:34', '2016-04-18 12:44:34'),
('IN01', 'ferrisaputra@gmail.com', '2016-04-18 12:44:34', '2016-04-18 12:44:34'),
('IN02', 'anestanggang@gmail.com', '2016-04-27 14:42:45', '2016-04-27 14:42:45'),
('IN02', 'ferrisaputra@gmail.com', '2016-04-27 14:42:45', '2016-04-27 14:42:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `involved_job_vacant`
--

CREATE TABLE IF NOT EXISTS `involved_job_vacant` (
  `id_job_vacant` char(10) NOT NULL,
  `email_users` varchar(70) NOT NULL,
  PRIMARY KEY (`id_job_vacant`,`email_users`),
  KEY `email_users` (`email_users`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `involved_job_vacant`
--

INSERT INTO `involved_job_vacant` (`id_job_vacant`, `email_users`) VALUES
('JV01', 'anestanggang@gmail.com'),
('JV02', 'anestanggang@gmail.com'),
('JV03', 'anestanggang@gmail.com'),
('JV04', 'anestanggang@gmail.com'),
('JV05', 'anestanggang@gmail.com'),
('JV06', 'anestanggang@gmail.com'),
('JV07', 'anestanggang@gmail.com'),
('JV08', 'anestanggang@gmail.com'),
('JV09', 'anestanggang@gmail.com'),
('JV03', 'diniseprilia@gmail.com'),
('JV05', 'diniseprilia@gmail.com'),
('JV06', 'diniseprilia@gmail.com'),
('JV08', 'diniseprilia@gmail.com'),
('JV02', 'ferrisaputra@gmail.com'),
('JV04', 'ferrisaputra@gmail.com'),
('JV07', 'ferrisaputra@gmail.com'),
('JV01', 'khalilahunafa@gmail.com'),
('JV02', 'khalilahunafa@gmail.com'),
('JV03', 'khalilahunafa@gmail.com'),
('JV04', 'khalilahunafa@gmail.com'),
('JV05', 'khalilahunafa@gmail.com'),
('JV06', 'khalilahunafa@gmail.com'),
('JV07', 'khalilahunafa@gmail.com'),
('JV08', 'khalilahunafa@gmail.com'),
('JV09', 'khalilahunafa@gmail.com'),
('JV01', 'nabilaclydea@gmail.com'),
('JV09', 'nabilaclydea@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_vacant`
--

CREATE TABLE IF NOT EXISTS `job_vacant` (
  `id_job_vacant` char(10) NOT NULL,
  `posisi_ditawarkan` varchar(70) NOT NULL,
  `jml_kebutuhan` smallint(5) NOT NULL,
  `requirement` text NOT NULL,
  `is_open` tinyint(1) NOT NULL,
  `id_divisi` char(10) NOT NULL,
  `Description` varchar(255) NOT NULL,
  PRIMARY KEY (`id_job_vacant`),
  KEY `id_divisi` (`id_divisi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `job_vacant`
--

INSERT INTO `job_vacant` (`id_job_vacant`, `posisi_ditawarkan`, `jml_kebutuhan`, `requirement`, `is_open`, `id_divisi`, `Description`) VALUES
('JV01', 'UI/UX Developer', 3, 'lala', 1, 'DIV03', ''),
('JV010', 'Senior PM', 2, 'Familiar with Software Development', 0, 'DIV05', ''),
('JV02', 'Lead Programmer', 2, 'lala', 1, 'DIV06', ''),
('JV03', 'Junior Analyst', 3, 'alal', 1, 'DIV04', ''),
('JV04', 'Front end Programmer', 4, 'lala', 0, 'DIV06', ''),
('JV05', 'Back end Programmer', 5, 'lala', 1, 'DIV06', ''),
('JV06', 'Senior Analyst', 3, 'lala', 0, 'DIV04', ''),
('JV07', 'Mobile Developer', 3, 'Plis berhasil', 0, 'DIV06', ''),
('JV08', 'Old Analyst', 1, 'IPK 5', 0, 'DIV04', ''),
('JV09', 'Junior Designer UI/UX Baju', 1, 'Familiar with mesin jahit', 0, 'DIV03', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `report`
--

CREATE TABLE IF NOT EXISTS `report` (
  `id_report` char(10) NOT NULL,
  `isi_report` text,
  `tgl_last_update` date NOT NULL,
  `id_applicant` char(10) NOT NULL,
  `email_users` varchar(70) NOT NULL,
  `id_report_form` char(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_report`),
  UNIQUE KEY `id_applicant` (`id_applicant`,`email_users`),
  KEY `email_users` (`email_users`),
  KEY `id_report_form` (`id_report_form`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `report`
--

INSERT INTO `report` (`id_report`, `isi_report`, `tgl_last_update`, `id_applicant`, `email_users`, `id_report_form`, `created_at`, `updated_at`) VALUES
('REP01', 'rapot khalila 1', '2016-03-29', 'APP01', 'khalilahunafa@gmail.com', 'RF01', '2016-04-27 23:46:10', '2016-04-27 23:46:10'),
('REP02', 'rapot khalila 2', '2016-03-30', 'APP03', 'khalilahunafa@gmail.com', 'RF02', '2016-04-27 23:46:10', '2016-04-27 23:46:10'),
('REP03', 'rapot anes 1', '2016-03-30', 'APP01', 'anestanggang@gmail.com', 'RF01', '2016-04-27 23:46:10', '2016-04-27 23:46:10'),
('REP04', 'rapot anss 2', '2016-03-31', 'APP03', 'anestanggang@gmail.com', 'RF02', '2016-04-27 23:46:10', '2016-04-27 23:46:10'),
('REP05', 'rapot dini 1', '2016-03-31', 'APP03', 'diniseprilia@gmail.com', 'RF02', '2016-04-27 23:46:10', '2016-04-27 23:46:10'),
('REP06', 'rapot nacil 1', '2016-04-04', 'APP01', 'nabilaclydea@gmail.com', 'RF01', '2016-04-27 23:46:10', '2016-04-27 23:46:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `report_form`
--

CREATE TABLE IF NOT EXISTS `report_form` (
  `id_report_form` char(10) NOT NULL,
  `judul` varchar(70) NOT NULL,
  `id_job_vacant` char(10) NOT NULL,
  PRIMARY KEY (`id_report_form`),
  UNIQUE KEY `id_job_vacant` (`id_job_vacant`,`judul`),
  UNIQUE KEY `judul` (`judul`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `report_form`
--

INSERT INTO `report_form` (`id_report_form`, `judul`, `id_job_vacant`) VALUES
('RF01', 'Rapot UI/UX Developer', 'JV01'),
('RF02', 'Rapot Junior Analyst', 'JV03'),
('RF03', 'Rapot Senior Analyst', 'JV06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sla`
--

CREATE TABLE IF NOT EXISTS `sla` (
  `id_sla` char(10) NOT NULL,
  `nama_tahapan` varchar(70) NOT NULL,
  `jml_hari` smallint(5) NOT NULL,
  PRIMARY KEY (`id_sla`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sla`
--

INSERT INTO `sla` (`id_sla`, `nama_tahapan`, `jml_hari`) VALUES
('SLA01', 'ApplyToNotify', 1),
('SLA02', 'NotifyToInterview1', 2),
('SLA03', 'Interview1ToInterview2', 2),
('SLA04', 'Interview2ToOffering', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `id_status` char(10) NOT NULL,
  `nama_status` varchar(70) NOT NULL,
  PRIMARY KEY (`id_status`),
  UNIQUE KEY `nama_status` (`nama_status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `status`
--

INSERT INTO `status` (`id_status`, `nama_status`) VALUES
('S01', 'Apply'),
('S07', 'Hire'),
('S03', 'Interview 1'),
('S04', 'Interview 2'),
('S06', 'Offering Letter'),
('S02', 'Reject'),
('S05', 'Transfer');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_applicant`
--

CREATE TABLE IF NOT EXISTS `status_applicant` (
  `id_applicant_status` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_notifikasi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tgl_konfirmasi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_sla` char(10) NOT NULL,
  `id_status` char(10) NOT NULL,
  `id_applicant` char(10) NOT NULL,
  `id_job_vacant` char(10) NOT NULL,
  PRIMARY KEY (`id_applicant_status`),
  KEY `id_sla` (`id_sla`),
  KEY `id_status` (`id_status`),
  KEY `id_applicant` (`id_applicant`),
  KEY `id_job_vacant` (`id_job_vacant`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data untuk tabel `status_applicant`
--

INSERT INTO `status_applicant` (`id_applicant_status`, `tgl_notifikasi`, `tgl_konfirmasi`, `id_sla`, `id_status`, `id_applicant`, `id_job_vacant`) VALUES
(1, '2016-03-23 17:00:00', '2016-03-23 17:00:00', 'SLA01', 'S01', 'APP01', 'JV01'),
(2, '2016-03-23 17:00:00', '2016-03-23 17:00:00', 'SLA01', 'S01', 'APP02', 'JV02'),
(3, '2016-03-23 17:00:00', '2016-03-23 17:00:00', 'SLA01', 'S01', 'APP03', 'JV03'),
(4, '2016-03-24 17:00:00', '2016-03-24 17:00:00', 'SLA01', 'S01', 'APP04', 'JV05'),
(5, '2016-03-24 17:00:00', '2016-03-24 17:00:00', 'SLA01', 'S01', 'APP05', 'JV01'),
(6, '2016-03-24 17:00:00', '2016-03-24 17:00:00', 'SLA01', 'S01', 'APP06', 'JV02'),
(7, '2016-03-25 17:00:00', '2016-03-25 17:00:00', 'SLA01', 'S01', 'APP07', 'JV03'),
(8, '2016-03-25 17:00:00', '2016-03-25 17:00:00', 'SLA01', 'S01', 'APP08', 'JV05'),
(9, '2016-03-26 17:00:00', '2016-03-26 17:00:00', 'SLA01', 'S01', 'APP09', 'JV01'),
(10, '2016-03-26 17:00:00', '2016-03-26 17:00:00', 'SLA01', 'S01', 'APP10', 'JV02'),
(27, '2016-04-18 05:45:12', '2016-04-18 05:45:12', 'SLA01', 'S03', 'APP02', 'JV02'),
(28, '2016-04-18 07:44:06', '2016-04-18 07:44:06', 'SLA01', 'S03', 'APP04', 'JV05'),
(29, '2016-04-18 07:45:19', '2016-04-18 07:45:19', 'SLA01', 'S07', 'APP04', 'JV05'),
(30, '2016-04-18 07:45:24', '2016-04-18 07:45:24', 'SLA01', 'S03', 'APP04', 'JV05'),
(31, '2016-04-21 07:41:46', '2016-04-21 07:41:46', 'SLA01', 'S03', 'APP01', 'JV01'),
(32, '2016-04-21 07:48:56', '2016-04-21 07:48:56', 'SLA01', 'S03', 'APP03', 'JV03'),
(33, '2016-04-21 07:48:58', '2016-04-21 07:48:58', 'SLA01', 'S03', 'APP03', 'JV03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `email_users` varchar(70) NOT NULL,
  `nama_users` varchar(70) NOT NULL,
  `posisi` varchar(70) NOT NULL,
  `id_divisi` char(10) NOT NULL,
  `password` varchar(30) DEFAULT NULL,
  `Role` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`email_users`),
  KEY `id_divisi` (`id_divisi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`email_users`, `nama_users`, `posisi`, `id_divisi`, `password`, `Role`, `created_at`, `updated_at`) VALUES
('anestanggang@gmail.com', 'Yohanes', 'Head', 'DIV02', '123456', 'HR', '2016-04-27 23:31:34', '2016-04-27 23:31:34'),
('diniseprilia@gmail.com', 'Dini Seprilia', 'Head', 'DIV04', '234567', 'Recruiter', '2016-04-27 23:31:34', '2016-04-27 23:31:34'),
('ferrisaputra@gmail.com', 'Ferri Saputra', 'Head', 'DIV06', '345678', 'Recruiter', '2016-04-27 23:31:34', '2016-04-27 23:31:34'),
('khalila9616@gmail.com', 'Lala Lili', 'Staff', 'DIV06', 'aaaaa', 'HR', '2016-04-27 23:31:34', '2016-04-27 23:31:34'),
('khalilahunafa@gmail.com', 'Khalila Hunafa', 'COO', 'DIV01', 'admin', 'Recruiter', '2016-04-27 23:31:34', '2016-04-27 23:31:34'),
('nabilaclydea@gmail.com', 'Nabila Clydea', 'Head', 'DIV03', 'aaaaa', 'Recruiter', '2016-04-27 23:31:34', '2016-04-27 23:31:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `work_experience`
--

CREATE TABLE IF NOT EXISTS `work_experience` (
  `id_work_exp` char(10) NOT NULL,
  `position` varchar(70) NOT NULL,
  `company` varchar(70) NOT NULL,
  `periode_of_time` smallint(5) NOT NULL,
  `id_applicant` char(10) NOT NULL,
  PRIMARY KEY (`id_work_exp`),
  KEY `id_applicant` (`id_applicant`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `work_experience`
--

INSERT INTO `work_experience` (`id_work_exp`, `position`, `company`, `periode_of_time`, `id_applicant`) VALUES
('WE01', 'Programmer', 'PT. A', 12, 'APP01'),
('WE02', 'Business Analyst', 'PT. B', 6, 'APP03'),
('WE03', 'Web Designer', 'PT. C', 3, 'APP05'),
('WE04', 'Mobile Developer', 'PT. D', 15, 'APP01'),
('WE05', 'Project Manager', 'PT. E', 17, 'APP08');

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `applicant`
--
ALTER TABLE `applicant`
  ADD CONSTRAINT `applicant_ibfk_1` FOREIGN KEY (`status_terupdate`) REFERENCES `status` (`id_status`);

--
-- Ketidakleluasaan untuk tabel `apply`
--
ALTER TABLE `apply`
  ADD CONSTRAINT `apply_ibfk_1` FOREIGN KEY (`id_job_vacant`) REFERENCES `job_vacant` (`id_job_vacant`),
  ADD CONSTRAINT `apply_ibfk_2` FOREIGN KEY (`id_applicant`) REFERENCES `applicant` (`id_applicant`);

--
-- Ketidakleluasaan untuk tabel `available_schedule`
--
ALTER TABLE `available_schedule`
  ADD CONSTRAINT `available_schedule_ibfk_1` FOREIGN KEY (`email_users`) REFERENCES `users` (`email_users`),
  ADD CONSTRAINT `available_schedule_ibfk_2` FOREIGN KEY (`id_job_vacant`) REFERENCES `job_vacant` (`id_job_vacant`);

--
-- Ketidakleluasaan untuk tabel `competency_used`
--
ALTER TABLE `competency_used`
  ADD CONSTRAINT `competency_used_ibfk_1` FOREIGN KEY (`id_kompetensi`) REFERENCES `competency` (`id_kompetensi`),
  ADD CONSTRAINT `competency_used_ibfk_2` FOREIGN KEY (`id_report_form`) REFERENCES `report_form` (`id_report_form`);

--
-- Ketidakleluasaan untuk tabel `divisi`
--
ALTER TABLE `divisi`
  ADD CONSTRAINT `divisi_ibfk_1` FOREIGN KEY (`id_company`) REFERENCES `company` (`id_company`);

--
-- Ketidakleluasaan untuk tabel `interview`
--
ALTER TABLE `interview`
  ADD CONSTRAINT `interview_ibfk_1` FOREIGN KEY (`id_applicant`) REFERENCES `applicant` (`id_applicant`),
  ADD CONSTRAINT `interview_ibfk_2` FOREIGN KEY (`id_av_schedule`) REFERENCES `available_schedule` (`id_av_schedule`);

--
-- Ketidakleluasaan untuk tabel `involved_interview`
--
ALTER TABLE `involved_interview`
  ADD CONSTRAINT `involved_interview_ibfk_1` FOREIGN KEY (`id_wawancara`) REFERENCES `interview` (`id_wawancara`),
  ADD CONSTRAINT `involved_interview_ibfk_2` FOREIGN KEY (`email_users`) REFERENCES `users` (`email_users`);

--
-- Ketidakleluasaan untuk tabel `involved_job_vacant`
--
ALTER TABLE `involved_job_vacant`
  ADD CONSTRAINT `involved_job_vacant_ibfk_1` FOREIGN KEY (`id_job_vacant`) REFERENCES `job_vacant` (`id_job_vacant`),
  ADD CONSTRAINT `involved_job_vacant_ibfk_2` FOREIGN KEY (`email_users`) REFERENCES `users` (`email_users`);

--
-- Ketidakleluasaan untuk tabel `job_vacant`
--
ALTER TABLE `job_vacant`
  ADD CONSTRAINT `job_vacant_ibfk_1` FOREIGN KEY (`id_divisi`) REFERENCES `divisi` (`id_divisi`);

--
-- Ketidakleluasaan untuk tabel `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`id_applicant`) REFERENCES `applicant` (`id_applicant`),
  ADD CONSTRAINT `report_ibfk_2` FOREIGN KEY (`email_users`) REFERENCES `users` (`email_users`),
  ADD CONSTRAINT `report_ibfk_3` FOREIGN KEY (`id_report_form`) REFERENCES `report_form` (`id_report_form`);

--
-- Ketidakleluasaan untuk tabel `report_form`
--
ALTER TABLE `report_form`
  ADD CONSTRAINT `report_form_ibfk_1` FOREIGN KEY (`id_job_vacant`) REFERENCES `job_vacant` (`id_job_vacant`);

--
-- Ketidakleluasaan untuk tabel `status_applicant`
--
ALTER TABLE `status_applicant`
  ADD CONSTRAINT `status_applicant_ibfk_1` FOREIGN KEY (`id_sla`) REFERENCES `sla` (`id_sla`),
  ADD CONSTRAINT `status_applicant_ibfk_2` FOREIGN KEY (`id_status`) REFERENCES `status` (`id_status`),
  ADD CONSTRAINT `status_applicant_ibfk_3` FOREIGN KEY (`id_applicant`) REFERENCES `applicant` (`id_applicant`),
  ADD CONSTRAINT `status_applicant_ibfk_4` FOREIGN KEY (`id_job_vacant`) REFERENCES `job_vacant` (`id_job_vacant`);

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_divisi`) REFERENCES `divisi` (`id_divisi`);

--
-- Ketidakleluasaan untuk tabel `work_experience`
--
ALTER TABLE `work_experience`
  ADD CONSTRAINT `work_experience_ibfk_1` FOREIGN KEY (`id_applicant`) REFERENCES `applicant` (`id_applicant`);
--
-- Database: `kaskus`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `nama` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `ID` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`nama`, `password`, `email`, `ID`) VALUES
('admin', 'admin', 'coba@gila.com', 1);
--
-- Database: `phpmyadmin`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `pma_bookmark`
--

CREATE TABLE IF NOT EXISTS `pma_bookmark` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dbase` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `query` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pma_column_info`
--

CREATE TABLE IF NOT EXISTS `pma_column_info` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `column_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin' AUTO_INCREMENT=21 ;

--
-- Dumping data untuk tabel `pma_column_info`
--

INSERT INTO `pma_column_info` (`id`, `db_name`, `table_name`, `column_name`, `comment`, `mimetype`, `transformation`, `transformation_options`) VALUES
(1, 'kaskus', 'user', 'nama', '', '', '_', ''),
(2, 'kaskus', 'user', 'password', '', '', '_', ''),
(3, 'kaskus', 'user', 'email', '', '', '_', ''),
(4, 'kaskus', 'user', 'ID', '', '', '_', ''),
(5, 'hrris', 'users', 'password', '', '', '_', ''),
(9, 'hrris', 'interview', 'created_at', '', '', '_', ''),
(8, 'hrris', 'interview', 'updated_at', '', '', '_', ''),
(10, 'hrris', 'involved_interview', 'updated_at', '', '', '_', ''),
(11, 'hrris', 'involved_interview', 'created_at', '', '', '_', ''),
(12, 'hrris', 'available_schedule', 'updated_at', '', '', '_', ''),
(13, 'hrris', 'available_schedule', 'created_at', '', '', '_', ''),
(14, 'hrris', 'users', 'Role', '', '', '_', ''),
(15, 'hrris', 'job_vacant', 'Description', '', '', '_', ''),
(16, 'hrris', 'users', 'created_at', '', '', '_', ''),
(17, 'hrris', 'users', 'updated_at', '', '', '_', ''),
(18, 'hrris', 'applicant', 'status_terupdate', '', '', '_', ''),
(19, 'hrris', 'report', 'created_at', '', '', '_', ''),
(20, 'hrris', 'report', 'updated_at', '', '', '_', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pma_designer_coords`
--

CREATE TABLE IF NOT EXISTS `pma_designer_coords` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `x` int(11) DEFAULT NULL,
  `y` int(11) DEFAULT NULL,
  `v` tinyint(4) DEFAULT NULL,
  `h` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`db_name`,`table_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for Designer';

-- --------------------------------------------------------

--
-- Struktur dari tabel `pma_history`
--

CREATE TABLE IF NOT EXISTS `pma_history` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sqlquery` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`,`db`,`table`,`timevalue`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pma_pdf_pages`
--

CREATE TABLE IF NOT EXISTS `pma_pdf_pages` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `page_nr` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `page_descr` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  PRIMARY KEY (`page_nr`),
  KEY `db_name` (`db_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pma_recent`
--

CREATE TABLE IF NOT EXISTS `pma_recent` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Dumping data untuk tabel `pma_recent`
--

INSERT INTO `pma_recent` (`username`, `tables`) VALUES
('root', '[{"db":"hrris","table":"available_schedule"},{"db":"hrris","table":"interview"},{"db":"hrris","table":"report"},{"db":"hrris","table":"applicant"},{"db":"hrris","table":"status"},{"db":"hrris","table":"involved_interview"},{"db":"hrris","table":"status_applicant"},{"db":"hrris","table":"users"},{"db":"hrris","table":"job_vacant"},{"db":"hrris","table":"involved_job_vacant"}]');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pma_relation`
--

CREATE TABLE IF NOT EXISTS `pma_relation` (
  `master_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  KEY `foreign_field` (`foreign_db`,`foreign_table`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Struktur dari tabel `pma_table_coords`
--

CREATE TABLE IF NOT EXISTS `pma_table_coords` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT '0',
  `x` float unsigned NOT NULL DEFAULT '0',
  `y` float unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Struktur dari tabel `pma_table_info`
--

CREATE TABLE IF NOT EXISTS `pma_table_info` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `display_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`db_name`,`table_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Struktur dari tabel `pma_table_uiprefs`
--

CREATE TABLE IF NOT EXISTS `pma_table_uiprefs` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `prefs` text COLLATE utf8_bin NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`username`,`db_name`,`table_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

--
-- Dumping data untuk tabel `pma_table_uiprefs`
--

INSERT INTO `pma_table_uiprefs` (`username`, `db_name`, `table_name`, `prefs`, `last_update`) VALUES
('root', 'hrris', 'interview', '{"sorted_col":"`id_wawancara` DESC"}', '2016-04-27 07:14:36'),
('root', 'hrris', 'status_applicant', '{"sorted_col":"`id_applicant_status` ASC"}', '2016-04-18 05:33:55'),
('root', 'hrris', 'users', '{"sorted_col":"`email_users` ASC"}', '2016-04-27 07:12:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pma_tracking`
--

CREATE TABLE IF NOT EXISTS `pma_tracking` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `version` int(10) unsigned NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text COLLATE utf8_bin NOT NULL,
  `schema_sql` text COLLATE utf8_bin,
  `data_sql` longtext COLLATE utf8_bin,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') COLLATE utf8_bin DEFAULT NULL,
  `tracking_active` int(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`db_name`,`table_name`,`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=COMPACT COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Struktur dari tabel `pma_userconfig`
--

CREATE TABLE IF NOT EXISTS `pma_userconfig` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `config_data` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Dumping data untuk tabel `pma_userconfig`
--

INSERT INTO `pma_userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2016-01-27 08:23:32', '{"lang":"id","collation_connection":"utf8mb4_general_ci"}');
--
-- Database: `test`
--
--
-- Database: `webauth`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_pwd`
--

CREATE TABLE IF NOT EXISTS `user_pwd` (
  `name` char(30) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `pass` char(32) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `user_pwd`
--

INSERT INTO `user_pwd` (`name`, `pass`) VALUES
('xampp', 'wampp');
--
-- Database: `wordpress`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `wp_commentmeta`
--

CREATE TABLE IF NOT EXISTS `wp_commentmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `comment_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`meta_id`),
  KEY `comment_id` (`comment_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `wp_comments`
--

CREATE TABLE IF NOT EXISTS `wp_comments` (
  `comment_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `comment_post_ID` bigint(20) unsigned NOT NULL DEFAULT '0',
  `comment_author` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment_author_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_author_url` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_author_IP` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment_karma` int(11) NOT NULL DEFAULT '0',
  `comment_approved` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `comment_agent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_ID`),
  KEY `comment_post_ID` (`comment_post_ID`),
  KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  KEY `comment_date_gmt` (`comment_date_gmt`),
  KEY `comment_parent` (`comment_parent`),
  KEY `comment_author_email` (`comment_author_email`(10))
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `wp_comments`
--

INSERT INTO `wp_comments` (`comment_ID`, `comment_post_ID`, `comment_author`, `comment_author_email`, `comment_author_url`, `comment_author_IP`, `comment_date`, `comment_date_gmt`, `comment_content`, `comment_karma`, `comment_approved`, `comment_agent`, `comment_type`, `comment_parent`, `user_id`) VALUES
(1, 1, 'Mr WordPress', '', 'https://wordpress.org/', '', '2016-01-27 08:37:47', '2016-01-27 08:37:47', 'Hi, this is a comment.\nTo delete a comment, just log in and view the post&#039;s comments. There you will have the option to edit or delete them.', 0, '1', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `wp_links`
--

CREATE TABLE IF NOT EXISTS `wp_links` (
  `link_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `link_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_target` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_visible` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `link_owner` bigint(20) unsigned NOT NULL DEFAULT '1',
  `link_rating` int(11) NOT NULL DEFAULT '0',
  `link_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_rel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_notes` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_rss` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`link_id`),
  KEY `link_visible` (`link_visible`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `wp_options`
--

CREATE TABLE IF NOT EXISTS `wp_options` (
  `option_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `option_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `option_value` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `autoload` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`option_id`),
  UNIQUE KEY `option_name` (`option_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=189 ;

--
-- Dumping data untuk tabel `wp_options`
--

INSERT INTO `wp_options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(1, 'siteurl', 'http://localhost/wordpress', 'yes'),
(2, 'home', 'http://localhost/wordpress', 'yes'),
(3, 'blogname', 'lagibelajar', 'yes'),
(4, 'blogdescription', 'Aku Coba-coba wordpress', 'yes'),
(5, 'users_can_register', '0', 'yes'),
(6, 'admin_email', 'gilebro1995@gmail.com', 'yes'),
(7, 'start_of_week', '1', 'yes'),
(8, 'use_balanceTags', '0', 'yes'),
(9, 'use_smilies', '1', 'yes'),
(10, 'require_name_email', '1', 'yes'),
(11, 'comments_notify', '1', 'yes'),
(12, 'posts_per_rss', '10', 'yes'),
(13, 'rss_use_excerpt', '0', 'yes'),
(14, 'mailserver_url', 'mail.example.com', 'yes'),
(15, 'mailserver_login', 'login@example.com', 'yes'),
(16, 'mailserver_pass', 'password', 'yes'),
(17, 'mailserver_port', '110', 'yes'),
(18, 'default_category', '1', 'yes'),
(19, 'default_comment_status', 'open', 'yes'),
(20, 'default_ping_status', 'open', 'yes'),
(21, 'default_pingback_flag', '0', 'yes'),
(22, 'posts_per_page', '10', 'yes'),
(23, 'date_format', 'F j, Y', 'yes'),
(24, 'time_format', 'g:i a', 'yes'),
(25, 'links_updated_date_format', 'F j, Y g:i a', 'yes'),
(26, 'comment_moderation', '0', 'yes'),
(27, 'moderation_notify', '1', 'yes'),
(28, 'permalink_structure', '/%year%/%monthnum%/%day%/%postname%/', 'yes'),
(29, 'hack_file', '0', 'yes'),
(30, 'blog_charset', 'UTF-8', 'yes'),
(31, 'moderation_keys', '', 'no'),
(32, 'active_plugins', 'a:2:{i:0;s:19:"akismet/akismet.php";i:1;s:9:"hello.php";}', 'yes'),
(33, 'category_base', '', 'yes'),
(34, 'ping_sites', 'http://rpc.pingomatic.com/', 'yes'),
(35, 'comment_max_links', '2', 'yes'),
(36, 'gmt_offset', '0', 'yes'),
(37, 'default_email_category', '1', 'yes'),
(38, 'recently_edited', '', 'no'),
(39, 'template', 'twentyfifteen', 'yes'),
(40, 'stylesheet', 'twentyfifteen', 'yes'),
(41, 'comment_whitelist', '1', 'yes'),
(42, 'blacklist_keys', '', 'no'),
(43, 'comment_registration', '0', 'yes'),
(44, 'html_type', 'text/html', 'yes'),
(45, 'use_trackback', '0', 'yes'),
(46, 'default_role', 'subscriber', 'yes'),
(47, 'db_version', '35700', 'yes'),
(48, 'uploads_use_yearmonth_folders', '1', 'yes'),
(49, 'upload_path', '', 'yes'),
(50, 'blog_public', '0', 'yes'),
(51, 'default_link_category', '2', 'yes'),
(52, 'show_on_front', 'posts', 'yes'),
(53, 'tag_base', '', 'yes'),
(54, 'show_avatars', '1', 'yes'),
(55, 'avatar_rating', 'G', 'yes'),
(56, 'upload_url_path', '', 'yes'),
(57, 'thumbnail_size_w', '150', 'yes'),
(58, 'thumbnail_size_h', '150', 'yes'),
(59, 'thumbnail_crop', '1', 'yes'),
(60, 'medium_size_w', '300', 'yes'),
(61, 'medium_size_h', '300', 'yes'),
(62, 'avatar_default', 'mystery', 'yes'),
(63, 'large_size_w', '1024', 'yes'),
(64, 'large_size_h', '1024', 'yes'),
(65, 'image_default_link_type', 'none', 'yes'),
(66, 'image_default_size', '', 'yes'),
(67, 'image_default_align', '', 'yes'),
(68, 'close_comments_for_old_posts', '0', 'yes'),
(69, 'close_comments_days_old', '14', 'yes'),
(70, 'thread_comments', '1', 'yes'),
(71, 'thread_comments_depth', '5', 'yes'),
(72, 'page_comments', '0', 'yes'),
(73, 'comments_per_page', '50', 'yes'),
(74, 'default_comments_page', 'newest', 'yes'),
(75, 'comment_order', 'asc', 'yes'),
(76, 'sticky_posts', 'a:0:{}', 'yes'),
(77, 'widget_categories', 'a:2:{i:2;a:4:{s:5:"title";s:0:"";s:5:"count";i:0;s:12:"hierarchical";i:0;s:8:"dropdown";i:0;}s:12:"_multiwidget";i:1;}', 'yes'),
(78, 'widget_text', 'a:2:{i:1;a:0:{}s:12:"_multiwidget";i:1;}', 'yes'),
(79, 'widget_rss', 'a:2:{i:1;a:0:{}s:12:"_multiwidget";i:1;}', 'yes'),
(80, 'uninstall_plugins', 'a:0:{}', 'no'),
(81, 'timezone_string', '', 'yes'),
(82, 'page_for_posts', '0', 'yes'),
(83, 'page_on_front', '0', 'yes'),
(84, 'default_post_format', '0', 'yes'),
(85, 'link_manager_enabled', '0', 'yes'),
(86, 'finished_splitting_shared_terms', '1', 'yes'),
(87, 'site_icon', '5', 'yes'),
(88, 'medium_large_size_w', '768', 'yes'),
(89, 'medium_large_size_h', '0', 'yes'),
(90, 'initial_db_version', '35700', 'yes'),
(91, 'wp_user_roles', 'a:5:{s:13:"administrator";a:2:{s:4:"name";s:13:"Administrator";s:12:"capabilities";a:61:{s:13:"switch_themes";b:1;s:11:"edit_themes";b:1;s:16:"activate_plugins";b:1;s:12:"edit_plugins";b:1;s:10:"edit_users";b:1;s:10:"edit_files";b:1;s:14:"manage_options";b:1;s:17:"moderate_comments";b:1;s:17:"manage_categories";b:1;s:12:"manage_links";b:1;s:12:"upload_files";b:1;s:6:"import";b:1;s:15:"unfiltered_html";b:1;s:10:"edit_posts";b:1;s:17:"edit_others_posts";b:1;s:20:"edit_published_posts";b:1;s:13:"publish_posts";b:1;s:10:"edit_pages";b:1;s:4:"read";b:1;s:8:"level_10";b:1;s:7:"level_9";b:1;s:7:"level_8";b:1;s:7:"level_7";b:1;s:7:"level_6";b:1;s:7:"level_5";b:1;s:7:"level_4";b:1;s:7:"level_3";b:1;s:7:"level_2";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:17:"edit_others_pages";b:1;s:20:"edit_published_pages";b:1;s:13:"publish_pages";b:1;s:12:"delete_pages";b:1;s:19:"delete_others_pages";b:1;s:22:"delete_published_pages";b:1;s:12:"delete_posts";b:1;s:19:"delete_others_posts";b:1;s:22:"delete_published_posts";b:1;s:20:"delete_private_posts";b:1;s:18:"edit_private_posts";b:1;s:18:"read_private_posts";b:1;s:20:"delete_private_pages";b:1;s:18:"edit_private_pages";b:1;s:18:"read_private_pages";b:1;s:12:"delete_users";b:1;s:12:"create_users";b:1;s:17:"unfiltered_upload";b:1;s:14:"edit_dashboard";b:1;s:14:"update_plugins";b:1;s:14:"delete_plugins";b:1;s:15:"install_plugins";b:1;s:13:"update_themes";b:1;s:14:"install_themes";b:1;s:11:"update_core";b:1;s:10:"list_users";b:1;s:12:"remove_users";b:1;s:13:"promote_users";b:1;s:18:"edit_theme_options";b:1;s:13:"delete_themes";b:1;s:6:"export";b:1;}}s:6:"editor";a:2:{s:4:"name";s:6:"Editor";s:12:"capabilities";a:34:{s:17:"moderate_comments";b:1;s:17:"manage_categories";b:1;s:12:"manage_links";b:1;s:12:"upload_files";b:1;s:15:"unfiltered_html";b:1;s:10:"edit_posts";b:1;s:17:"edit_others_posts";b:1;s:20:"edit_published_posts";b:1;s:13:"publish_posts";b:1;s:10:"edit_pages";b:1;s:4:"read";b:1;s:7:"level_7";b:1;s:7:"level_6";b:1;s:7:"level_5";b:1;s:7:"level_4";b:1;s:7:"level_3";b:1;s:7:"level_2";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:17:"edit_others_pages";b:1;s:20:"edit_published_pages";b:1;s:13:"publish_pages";b:1;s:12:"delete_pages";b:1;s:19:"delete_others_pages";b:1;s:22:"delete_published_pages";b:1;s:12:"delete_posts";b:1;s:19:"delete_others_posts";b:1;s:22:"delete_published_posts";b:1;s:20:"delete_private_posts";b:1;s:18:"edit_private_posts";b:1;s:18:"read_private_posts";b:1;s:20:"delete_private_pages";b:1;s:18:"edit_private_pages";b:1;s:18:"read_private_pages";b:1;}}s:6:"author";a:2:{s:4:"name";s:6:"Author";s:12:"capabilities";a:10:{s:12:"upload_files";b:1;s:10:"edit_posts";b:1;s:20:"edit_published_posts";b:1;s:13:"publish_posts";b:1;s:4:"read";b:1;s:7:"level_2";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:12:"delete_posts";b:1;s:22:"delete_published_posts";b:1;}}s:11:"contributor";a:2:{s:4:"name";s:11:"Contributor";s:12:"capabilities";a:5:{s:10:"edit_posts";b:1;s:4:"read";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:12:"delete_posts";b:1;}}s:10:"subscriber";a:2:{s:4:"name";s:10:"Subscriber";s:12:"capabilities";a:2:{s:4:"read";b:1;s:7:"level_0";b:1;}}}', 'yes'),
(92, 'widget_search', 'a:2:{i:2;a:1:{s:5:"title";s:0:"";}s:12:"_multiwidget";i:1;}', 'yes'),
(93, 'widget_recent-posts', 'a:2:{i:2;a:2:{s:5:"title";s:0:"";s:6:"number";i:5;}s:12:"_multiwidget";i:1;}', 'yes'),
(94, 'widget_recent-comments', 'a:2:{i:2;a:2:{s:5:"title";s:0:"";s:6:"number";i:5;}s:12:"_multiwidget";i:1;}', 'yes'),
(95, 'widget_archives', 'a:2:{i:2;a:3:{s:5:"title";s:0:"";s:5:"count";i:0;s:8:"dropdown";i:0;}s:12:"_multiwidget";i:1;}', 'yes'),
(96, 'widget_meta', 'a:2:{i:2;a:1:{s:5:"title";s:0:"";}s:12:"_multiwidget";i:1;}', 'yes'),
(97, 'sidebars_widgets', 'a:3:{s:19:"wp_inactive_widgets";a:0:{}s:9:"sidebar-1";a:6:{i:0;s:8:"search-2";i:1;s:14:"recent-posts-2";i:2;s:17:"recent-comments-2";i:3;s:10:"archives-2";i:4;s:12:"categories-2";i:5;s:6:"meta-2";}s:13:"array_version";i:3;}', 'yes'),
(99, 'widget_pages', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(100, 'widget_calendar', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(101, 'widget_tag_cloud', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(102, 'widget_nav_menu', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(103, 'cron', 'a:4:{i:1458679069;a:3:{s:16:"wp_version_check";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}s:17:"wp_update_plugins";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}s:16:"wp_update_themes";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}}i:1458722300;a:1:{s:19:"wp_scheduled_delete";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:5:"daily";s:4:"args";a:0:{}s:8:"interval";i:86400;}}}i:1458723002;a:1:{s:30:"wp_scheduled_auto_draft_delete";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:5:"daily";s:4:"args";a:0:{}s:8:"interval";i:86400;}}}s:7:"version";i:2;}', 'yes'),
(108, '_site_transient_update_core', 'O:8:"stdClass":4:{s:7:"updates";a:1:{i:0;O:8:"stdClass":10:{s:8:"response";s:6:"latest";s:8:"download";s:59:"https://downloads.wordpress.org/release/wordpress-4.4.1.zip";s:6:"locale";s:5:"en_US";s:8:"packages";O:8:"stdClass":5:{s:4:"full";s:59:"https://downloads.wordpress.org/release/wordpress-4.4.1.zip";s:10:"no_content";s:70:"https://downloads.wordpress.org/release/wordpress-4.4.1-no-content.zip";s:11:"new_bundled";s:71:"https://downloads.wordpress.org/release/wordpress-4.4.1-new-bundled.zip";s:7:"partial";b:0;s:8:"rollback";b:0;}s:7:"current";s:5:"4.4.1";s:7:"version";s:5:"4.4.1";s:11:"php_version";s:5:"5.2.4";s:13:"mysql_version";s:3:"5.0";s:11:"new_bundled";s:3:"4.4";s:15:"partial_version";s:0:"";}}s:12:"last_checked";i:1458646693;s:15:"version_checked";s:5:"4.4.1";s:12:"translations";a:0:{}}', 'yes'),
(110, '_site_transient_update_plugins', 'O:8:"stdClass":5:{s:12:"last_checked";i:1458646694;s:7:"checked";a:2:{s:19:"akismet/akismet.php";s:5:"3.1.7";s:9:"hello.php";s:3:"1.6";}s:8:"response";a:0:{}s:12:"translations";a:0:{}s:9:"no_update";a:2:{s:19:"akismet/akismet.php";O:8:"stdClass":6:{s:2:"id";s:2:"15";s:4:"slug";s:7:"akismet";s:6:"plugin";s:19:"akismet/akismet.php";s:11:"new_version";s:5:"3.1.7";s:3:"url";s:38:"https://wordpress.org/plugins/akismet/";s:7:"package";s:56:"https://downloads.wordpress.org/plugin/akismet.3.1.7.zip";}s:9:"hello.php";O:8:"stdClass":6:{s:2:"id";s:4:"3564";s:4:"slug";s:11:"hello-dolly";s:6:"plugin";s:9:"hello.php";s:11:"new_version";s:3:"1.6";s:3:"url";s:42:"https://wordpress.org/plugins/hello-dolly/";s:7:"package";s:58:"https://downloads.wordpress.org/plugin/hello-dolly.1.6.zip";}}}', 'yes'),
(113, '_site_transient_update_themes', 'O:8:"stdClass":4:{s:12:"last_checked";i:1458646695;s:7:"checked";a:3:{s:13:"twentyfifteen";s:3:"1.4";s:14:"twentyfourteen";s:3:"1.6";s:13:"twentysixteen";s:3:"1.1";}s:8:"response";a:0:{}s:12:"translations";a:0:{}}', 'yes'),
(114, '_site_transient_timeout_browser_3e024e622df6d826a47d3afb10e8de2e', '1454488701', 'yes'),
(115, '_site_transient_browser_3e024e622df6d826a47d3afb10e8de2e', 'a:9:{s:8:"platform";s:7:"Windows";s:4:"name";s:6:"Chrome";s:7:"version";s:13:"47.0.2526.111";s:10:"update_url";s:28:"http://www.google.com/chrome";s:7:"img_src";s:49:"http://s.wordpress.org/images/browsers/chrome.png";s:11:"img_src_ssl";s:48:"https://wordpress.org/images/browsers/chrome.png";s:15:"current_version";s:2:"18";s:7:"upgrade";b:0;s:8:"insecure";b:0;}', 'yes'),
(117, 'can_compress_scripts', '1', 'yes'),
(137, '_transient_twentysixteen_categories', '1', 'yes'),
(138, 'widget_widget_twentyfourteen_ephemera', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(140, '_transient_twentyfourteen_category_count', '1', 'yes'),
(141, 'theme_mods_twentysixteen', 'a:1:{s:16:"sidebars_widgets";a:2:{s:4:"time";i:1453884113;s:4:"data";a:2:{s:19:"wp_inactive_widgets";a:0:{}s:9:"sidebar-1";a:6:{i:0;s:8:"search-2";i:1;s:14:"recent-posts-2";i:2;s:17:"recent-comments-2";i:3;s:10:"archives-2";i:4;s:12:"categories-2";i:5;s:6:"meta-2";}}}}', 'yes'),
(142, 'current_theme', 'Twenty Fifteen', 'yes'),
(143, 'theme_mods_twentyfourteen', 'a:6:{i:0;b:0;s:16:"header_textcolor";s:6:"ffffff";s:16:"background_color";s:6:"000000";s:12:"header_image";s:13:"remove-header";s:18:"nav_menu_locations";a:2:{s:7:"primary";i:0;s:9:"secondary";i:2;}s:16:"sidebars_widgets";a:2:{s:4:"time";i:1453884393;s:4:"data";a:4:{s:19:"wp_inactive_widgets";a:0:{}s:9:"sidebar-1";a:6:{i:0;s:8:"search-2";i:1;s:14:"recent-posts-2";i:2;s:17:"recent-comments-2";i:3;s:10:"archives-2";i:4;s:12:"categories-2";i:5;s:6:"meta-2";}s:9:"sidebar-2";a:0:{}s:9:"sidebar-3";a:0:{}}}}', 'yes'),
(144, 'theme_switched', '', 'yes'),
(145, 'theme_switched_via_customizer', '', 'yes'),
(163, 'nav_menu_options', 'a:1:{s:8:"auto_add";a:0:{}}', 'yes'),
(166, 'theme_mods_twentyfifteen', 'a:2:{i:0;b:0;s:18:"nav_menu_locations";a:2:{s:7:"primary";i:0;s:9:"secondary";i:2;}}', 'yes'),
(167, 'rewrite_rules', 'a:77:{s:11:"^wp-json/?$";s:22:"index.php?rest_route=/";s:14:"^wp-json/(.*)?";s:33:"index.php?rest_route=/$matches[1]";s:47:"category/(.+?)/feed/(feed|rdf|rss|rss2|atom)/?$";s:52:"index.php?category_name=$matches[1]&feed=$matches[2]";s:42:"category/(.+?)/(feed|rdf|rss|rss2|atom)/?$";s:52:"index.php?category_name=$matches[1]&feed=$matches[2]";s:35:"category/(.+?)/page/?([0-9]{1,})/?$";s:53:"index.php?category_name=$matches[1]&paged=$matches[2]";s:17:"category/(.+?)/?$";s:35:"index.php?category_name=$matches[1]";s:44:"tag/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?tag=$matches[1]&feed=$matches[2]";s:39:"tag/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?tag=$matches[1]&feed=$matches[2]";s:32:"tag/([^/]+)/page/?([0-9]{1,})/?$";s:43:"index.php?tag=$matches[1]&paged=$matches[2]";s:14:"tag/([^/]+)/?$";s:25:"index.php?tag=$matches[1]";s:45:"type/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?post_format=$matches[1]&feed=$matches[2]";s:40:"type/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?post_format=$matches[1]&feed=$matches[2]";s:33:"type/([^/]+)/page/?([0-9]{1,})/?$";s:51:"index.php?post_format=$matches[1]&paged=$matches[2]";s:15:"type/([^/]+)/?$";s:33:"index.php?post_format=$matches[1]";s:48:".*wp-(atom|rdf|rss|rss2|feed|commentsrss2)\\.php$";s:18:"index.php?feed=old";s:20:".*wp-app\\.php(/.*)?$";s:19:"index.php?error=403";s:18:".*wp-register.php$";s:23:"index.php?register=true";s:32:"feed/(feed|rdf|rss|rss2|atom)/?$";s:27:"index.php?&feed=$matches[1]";s:27:"(feed|rdf|rss|rss2|atom)/?$";s:27:"index.php?&feed=$matches[1]";s:20:"page/?([0-9]{1,})/?$";s:28:"index.php?&paged=$matches[1]";s:41:"comments/feed/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?&feed=$matches[1]&withcomments=1";s:36:"comments/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?&feed=$matches[1]&withcomments=1";s:44:"search/(.+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:40:"index.php?s=$matches[1]&feed=$matches[2]";s:39:"search/(.+)/(feed|rdf|rss|rss2|atom)/?$";s:40:"index.php?s=$matches[1]&feed=$matches[2]";s:32:"search/(.+)/page/?([0-9]{1,})/?$";s:41:"index.php?s=$matches[1]&paged=$matches[2]";s:14:"search/(.+)/?$";s:23:"index.php?s=$matches[1]";s:47:"author/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?author_name=$matches[1]&feed=$matches[2]";s:42:"author/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?author_name=$matches[1]&feed=$matches[2]";s:35:"author/([^/]+)/page/?([0-9]{1,})/?$";s:51:"index.php?author_name=$matches[1]&paged=$matches[2]";s:17:"author/([^/]+)/?$";s:33:"index.php?author_name=$matches[1]";s:69:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$";s:80:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]";s:64:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$";s:80:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]";s:57:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/page/?([0-9]{1,})/?$";s:81:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&paged=$matches[4]";s:39:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/?$";s:63:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]";s:56:"([0-9]{4})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$";s:64:"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]";s:51:"([0-9]{4})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$";s:64:"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]";s:44:"([0-9]{4})/([0-9]{1,2})/page/?([0-9]{1,})/?$";s:65:"index.php?year=$matches[1]&monthnum=$matches[2]&paged=$matches[3]";s:26:"([0-9]{4})/([0-9]{1,2})/?$";s:47:"index.php?year=$matches[1]&monthnum=$matches[2]";s:43:"([0-9]{4})/feed/(feed|rdf|rss|rss2|atom)/?$";s:43:"index.php?year=$matches[1]&feed=$matches[2]";s:38:"([0-9]{4})/(feed|rdf|rss|rss2|atom)/?$";s:43:"index.php?year=$matches[1]&feed=$matches[2]";s:31:"([0-9]{4})/page/?([0-9]{1,})/?$";s:44:"index.php?year=$matches[1]&paged=$matches[2]";s:13:"([0-9]{4})/?$";s:26:"index.php?year=$matches[1]";s:58:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:68:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:88:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:83:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:83:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:64:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/embed/?$";s:43:"index.php?attachment=$matches[1]&embed=true";s:53:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/embed/?$";s:91:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&embed=true";s:57:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/trackback/?$";s:85:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&tb=1";s:77:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:97:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&feed=$matches[5]";s:72:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:97:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&feed=$matches[5]";s:65:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/page/?([0-9]{1,})/?$";s:98:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&paged=$matches[5]";s:72:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/comment-page-([0-9]{1,})/?$";s:98:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&cpage=$matches[5]";s:61:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)(?:/([0-9]+))?/?$";s:97:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&page=$matches[5]";s:47:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:57:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:77:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:72:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:72:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:53:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/embed/?$";s:43:"index.php?attachment=$matches[1]&embed=true";s:64:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/comment-page-([0-9]{1,})/?$";s:81:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&cpage=$matches[4]";s:51:"([0-9]{4})/([0-9]{1,2})/comment-page-([0-9]{1,})/?$";s:65:"index.php?year=$matches[1]&monthnum=$matches[2]&cpage=$matches[3]";s:38:"([0-9]{4})/comment-page-([0-9]{1,})/?$";s:44:"index.php?year=$matches[1]&cpage=$matches[2]";s:27:".?.+?/attachment/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:37:".?.+?/attachment/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:57:".?.+?/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:52:".?.+?/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:52:".?.+?/attachment/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:33:".?.+?/attachment/([^/]+)/embed/?$";s:43:"index.php?attachment=$matches[1]&embed=true";s:16:"(.?.+?)/embed/?$";s:41:"index.php?pagename=$matches[1]&embed=true";s:20:"(.?.+?)/trackback/?$";s:35:"index.php?pagename=$matches[1]&tb=1";s:40:"(.?.+?)/feed/(feed|rdf|rss|rss2|atom)/?$";s:47:"index.php?pagename=$matches[1]&feed=$matches[2]";s:35:"(.?.+?)/(feed|rdf|rss|rss2|atom)/?$";s:47:"index.php?pagename=$matches[1]&feed=$matches[2]";s:28:"(.?.+?)/page/?([0-9]{1,})/?$";s:48:"index.php?pagename=$matches[1]&paged=$matches[2]";s:35:"(.?.+?)/comment-page-([0-9]{1,})/?$";s:48:"index.php?pagename=$matches[1]&cpage=$matches[2]";s:24:"(.?.+?)(?:/([0-9]+))?/?$";s:47:"index.php?pagename=$matches[1]&page=$matches[2]";}', 'yes'),
(168, 'recently_activated', 'a:0:{}', 'yes'),
(170, 'widget_akismet_widget', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(171, '_site_transient_timeout_poptags_40cd750bba9870f18aada2478b24840a', '1453895338', 'yes'),
(172, '_site_transient_poptags_40cd750bba9870f18aada2478b24840a', 'a:100:{s:6:"widget";a:3:{s:4:"name";s:6:"widget";s:4:"slug";s:6:"widget";s:5:"count";s:4:"5663";}s:4:"post";a:3:{s:4:"name";s:4:"Post";s:4:"slug";s:4:"post";s:5:"count";s:4:"3554";}s:6:"plugin";a:3:{s:4:"name";s:6:"plugin";s:4:"slug";s:6:"plugin";s:5:"count";s:4:"3503";}s:5:"admin";a:3:{s:4:"name";s:5:"admin";s:4:"slug";s:5:"admin";s:5:"count";s:4:"3011";}s:5:"posts";a:3:{s:4:"name";s:5:"posts";s:4:"slug";s:5:"posts";s:5:"count";s:4:"2738";}s:9:"shortcode";a:3:{s:4:"name";s:9:"shortcode";s:4:"slug";s:9:"shortcode";s:5:"count";s:4:"2224";}s:7:"sidebar";a:3:{s:4:"name";s:7:"sidebar";s:4:"slug";s:7:"sidebar";s:5:"count";s:4:"2168";}s:6:"google";a:3:{s:4:"name";s:6:"google";s:4:"slug";s:6:"google";s:5:"count";s:4:"2009";}s:7:"twitter";a:3:{s:4:"name";s:7:"twitter";s:4:"slug";s:7:"twitter";s:5:"count";s:4:"1956";}s:4:"page";a:3:{s:4:"name";s:4:"page";s:4:"slug";s:4:"page";s:5:"count";s:4:"1949";}s:6:"images";a:3:{s:4:"name";s:6:"images";s:4:"slug";s:6:"images";s:5:"count";s:4:"1939";}s:8:"comments";a:3:{s:4:"name";s:8:"comments";s:4:"slug";s:8:"comments";s:5:"count";s:4:"1886";}s:5:"image";a:3:{s:4:"name";s:5:"image";s:4:"slug";s:5:"image";s:5:"count";s:4:"1791";}s:8:"facebook";a:3:{s:4:"name";s:8:"Facebook";s:4:"slug";s:8:"facebook";s:5:"count";s:4:"1589";}s:3:"seo";a:3:{s:4:"name";s:3:"seo";s:4:"slug";s:3:"seo";s:5:"count";s:4:"1520";}s:9:"wordpress";a:3:{s:4:"name";s:9:"wordpress";s:4:"slug";s:9:"wordpress";s:5:"count";s:4:"1502";}s:11:"woocommerce";a:3:{s:4:"name";s:11:"woocommerce";s:4:"slug";s:11:"woocommerce";s:5:"count";s:4:"1447";}s:6:"social";a:3:{s:4:"name";s:6:"social";s:4:"slug";s:6:"social";s:5:"count";s:4:"1302";}s:5:"links";a:3:{s:4:"name";s:5:"links";s:4:"slug";s:5:"links";s:5:"count";s:4:"1262";}s:7:"gallery";a:3:{s:4:"name";s:7:"gallery";s:4:"slug";s:7:"gallery";s:5:"count";s:4:"1248";}s:5:"email";a:3:{s:4:"name";s:5:"email";s:4:"slug";s:5:"email";s:5:"count";s:4:"1140";}s:7:"widgets";a:3:{s:4:"name";s:7:"widgets";s:4:"slug";s:7:"widgets";s:5:"count";s:4:"1066";}s:5:"pages";a:3:{s:4:"name";s:5:"pages";s:4:"slug";s:5:"pages";s:5:"count";s:4:"1040";}s:6:"jquery";a:3:{s:4:"name";s:6:"jquery";s:4:"slug";s:6:"jquery";s:5:"count";s:3:"984";}s:5:"media";a:3:{s:4:"name";s:5:"media";s:4:"slug";s:5:"media";s:5:"count";s:3:"946";}s:3:"rss";a:3:{s:4:"name";s:3:"rss";s:4:"slug";s:3:"rss";s:5:"count";s:3:"901";}s:4:"ajax";a:3:{s:4:"name";s:4:"AJAX";s:4:"slug";s:4:"ajax";s:5:"count";s:3:"883";}s:9:"ecommerce";a:3:{s:4:"name";s:9:"ecommerce";s:4:"slug";s:9:"ecommerce";s:5:"count";s:3:"883";}s:5:"video";a:3:{s:4:"name";s:5:"video";s:4:"slug";s:5:"video";s:5:"count";s:3:"872";}s:7:"content";a:3:{s:4:"name";s:7:"content";s:4:"slug";s:7:"content";s:5:"count";s:3:"867";}s:5:"login";a:3:{s:4:"name";s:5:"login";s:4:"slug";s:5:"login";s:5:"count";s:3:"854";}s:10:"javascript";a:3:{s:4:"name";s:10:"javascript";s:4:"slug";s:10:"javascript";s:5:"count";s:3:"807";}s:10:"buddypress";a:3:{s:4:"name";s:10:"buddypress";s:4:"slug";s:10:"buddypress";s:5:"count";s:3:"766";}s:10:"responsive";a:3:{s:4:"name";s:10:"responsive";s:4:"slug";s:10:"responsive";s:5:"count";s:3:"747";}s:8:"security";a:3:{s:4:"name";s:8:"security";s:4:"slug";s:8:"security";s:5:"count";s:3:"740";}s:5:"photo";a:3:{s:4:"name";s:5:"photo";s:4:"slug";s:5:"photo";s:5:"count";s:3:"735";}s:4:"feed";a:3:{s:4:"name";s:4:"feed";s:4:"slug";s:4:"feed";s:5:"count";s:3:"729";}s:7:"youtube";a:3:{s:4:"name";s:7:"youtube";s:4:"slug";s:7:"youtube";s:5:"count";s:3:"725";}s:4:"link";a:3:{s:4:"name";s:4:"link";s:4:"slug";s:4:"link";s:5:"count";s:3:"721";}s:4:"spam";a:3:{s:4:"name";s:4:"spam";s:4:"slug";s:4:"spam";s:5:"count";s:3:"718";}s:5:"share";a:3:{s:4:"name";s:5:"Share";s:4:"slug";s:5:"share";s:5:"count";s:3:"706";}s:10:"e-commerce";a:3:{s:4:"name";s:10:"e-commerce";s:4:"slug";s:10:"e-commerce";s:5:"count";s:3:"701";}s:6:"photos";a:3:{s:4:"name";s:6:"photos";s:4:"slug";s:6:"photos";s:5:"count";s:3:"681";}s:8:"category";a:3:{s:4:"name";s:8:"category";s:4:"slug";s:8:"category";s:5:"count";s:3:"675";}s:5:"embed";a:3:{s:4:"name";s:5:"embed";s:4:"slug";s:5:"embed";s:5:"count";s:3:"657";}s:9:"analytics";a:3:{s:4:"name";s:9:"analytics";s:4:"slug";s:9:"analytics";s:5:"count";s:3:"655";}s:4:"form";a:3:{s:4:"name";s:4:"form";s:4:"slug";s:4:"form";s:5:"count";s:3:"648";}s:3:"css";a:3:{s:4:"name";s:3:"CSS";s:4:"slug";s:3:"css";s:5:"count";s:3:"642";}s:6:"search";a:3:{s:4:"name";s:6:"search";s:4:"slug";s:6:"search";s:5:"count";s:3:"635";}s:9:"slideshow";a:3:{s:4:"name";s:9:"slideshow";s:4:"slug";s:9:"slideshow";s:5:"count";s:3:"629";}s:6:"custom";a:3:{s:4:"name";s:6:"custom";s:4:"slug";s:6:"custom";s:5:"count";s:3:"608";}s:5:"stats";a:3:{s:4:"name";s:5:"stats";s:4:"slug";s:5:"stats";s:5:"count";s:3:"598";}s:6:"slider";a:3:{s:4:"name";s:6:"slider";s:4:"slug";s:6:"slider";s:5:"count";s:3:"595";}s:6:"button";a:3:{s:4:"name";s:6:"button";s:4:"slug";s:6:"button";s:5:"count";s:3:"589";}s:7:"comment";a:3:{s:4:"name";s:7:"comment";s:4:"slug";s:7:"comment";s:5:"count";s:3:"585";}s:5:"theme";a:3:{s:4:"name";s:5:"theme";s:4:"slug";s:5:"theme";s:5:"count";s:3:"578";}s:4:"menu";a:3:{s:4:"name";s:4:"menu";s:4:"slug";s:4:"menu";s:5:"count";s:3:"575";}s:4:"tags";a:3:{s:4:"name";s:4:"tags";s:4:"slug";s:4:"tags";s:5:"count";s:3:"574";}s:9:"dashboard";a:3:{s:4:"name";s:9:"dashboard";s:4:"slug";s:9:"dashboard";s:5:"count";s:3:"569";}s:10:"categories";a:3:{s:4:"name";s:10:"categories";s:4:"slug";s:10:"categories";s:5:"count";s:3:"561";}s:10:"statistics";a:3:{s:4:"name";s:10:"statistics";s:4:"slug";s:10:"statistics";s:5:"count";s:3:"546";}s:3:"ads";a:3:{s:4:"name";s:3:"ads";s:4:"slug";s:3:"ads";s:5:"count";s:3:"538";}s:6:"mobile";a:3:{s:4:"name";s:6:"mobile";s:4:"slug";s:6:"mobile";s:5:"count";s:3:"533";}s:4:"user";a:3:{s:4:"name";s:4:"user";s:4:"slug";s:4:"user";s:5:"count";s:3:"522";}s:6:"editor";a:3:{s:4:"name";s:6:"editor";s:4:"slug";s:6:"editor";s:5:"count";s:3:"521";}s:5:"users";a:3:{s:4:"name";s:5:"users";s:4:"slug";s:5:"users";s:5:"count";s:3:"510";}s:4:"list";a:3:{s:4:"name";s:4:"list";s:4:"slug";s:4:"list";s:5:"count";s:3:"504";}s:7:"picture";a:3:{s:4:"name";s:7:"picture";s:4:"slug";s:7:"picture";s:5:"count";s:3:"504";}s:9:"affiliate";a:3:{s:4:"name";s:9:"affiliate";s:4:"slug";s:9:"affiliate";s:5:"count";s:3:"499";}s:7:"plugins";a:3:{s:4:"name";s:7:"plugins";s:4:"slug";s:7:"plugins";s:5:"count";s:3:"498";}s:6:"simple";a:3:{s:4:"name";s:6:"simple";s:4:"slug";s:6:"simple";s:5:"count";s:3:"476";}s:9:"multisite";a:3:{s:4:"name";s:9:"multisite";s:4:"slug";s:9:"multisite";s:5:"count";s:3:"475";}s:12:"contact-form";a:3:{s:4:"name";s:12:"contact form";s:4:"slug";s:12:"contact-form";s:5:"count";s:3:"472";}s:12:"social-media";a:3:{s:4:"name";s:12:"social media";s:4:"slug";s:12:"social-media";s:5:"count";s:3:"462";}s:7:"contact";a:3:{s:4:"name";s:7:"contact";s:4:"slug";s:7:"contact";s:5:"count";s:3:"461";}s:8:"pictures";a:3:{s:4:"name";s:8:"pictures";s:4:"slug";s:8:"pictures";s:5:"count";s:3:"457";}s:10:"navigation";a:3:{s:4:"name";s:10:"navigation";s:4:"slug";s:10:"navigation";s:5:"count";s:3:"432";}s:3:"url";a:3:{s:4:"name";s:3:"url";s:4:"slug";s:3:"url";s:5:"count";s:3:"429";}s:5:"flash";a:3:{s:4:"name";s:5:"flash";s:4:"slug";s:5:"flash";s:5:"count";s:3:"422";}s:4:"html";a:3:{s:4:"name";s:4:"html";s:4:"slug";s:4:"html";s:5:"count";s:3:"421";}s:4:"shop";a:3:{s:4:"name";s:4:"shop";s:4:"slug";s:4:"shop";s:5:"count";s:3:"418";}s:3:"api";a:3:{s:4:"name";s:3:"api";s:4:"slug";s:3:"api";s:5:"count";s:3:"415";}s:10:"newsletter";a:3:{s:4:"name";s:10:"newsletter";s:4:"slug";s:10:"newsletter";s:5:"count";s:3:"414";}s:9:"marketing";a:3:{s:4:"name";s:9:"marketing";s:4:"slug";s:9:"marketing";s:5:"count";s:3:"408";}s:4:"meta";a:3:{s:4:"name";s:4:"meta";s:4:"slug";s:4:"meta";s:5:"count";s:3:"403";}s:3:"tag";a:3:{s:4:"name";s:3:"tag";s:4:"slug";s:3:"tag";s:5:"count";s:3:"400";}s:6:"events";a:3:{s:4:"name";s:6:"events";s:4:"slug";s:6:"events";s:5:"count";s:3:"400";}s:8:"calendar";a:3:{s:4:"name";s:8:"calendar";s:4:"slug";s:8:"calendar";s:5:"count";s:3:"398";}s:4:"news";a:3:{s:4:"name";s:4:"News";s:4:"slug";s:4:"news";s:5:"count";s:3:"396";}s:8:"tracking";a:3:{s:4:"name";s:8:"tracking";s:4:"slug";s:8:"tracking";s:5:"count";s:3:"389";}s:9:"thumbnail";a:3:{s:4:"name";s:9:"thumbnail";s:4:"slug";s:9:"thumbnail";s:5:"count";s:3:"389";}s:11:"advertising";a:3:{s:4:"name";s:11:"advertising";s:4:"slug";s:11:"advertising";s:5:"count";s:3:"389";}s:4:"code";a:3:{s:4:"name";s:4:"code";s:4:"slug";s:4:"code";s:5:"count";s:3:"382";}s:10:"shortcodes";a:3:{s:4:"name";s:10:"shortcodes";s:4:"slug";s:10:"shortcodes";s:5:"count";s:3:"380";}s:8:"lightbox";a:3:{s:4:"name";s:8:"lightbox";s:4:"slug";s:8:"lightbox";s:5:"count";s:3:"379";}s:4:"text";a:3:{s:4:"name";s:4:"text";s:4:"slug";s:4:"text";s:5:"count";s:3:"379";}s:9:"automatic";a:3:{s:4:"name";s:9:"automatic";s:4:"slug";s:9:"automatic";s:5:"count";s:3:"377";}s:6:"upload";a:3:{s:4:"name";s:6:"upload";s:4:"slug";s:6:"upload";s:5:"count";s:3:"375";}s:6:"paypal";a:3:{s:4:"name";s:6:"paypal";s:4:"slug";s:6:"paypal";s:5:"count";s:3:"375";}s:7:"profile";a:3:{s:4:"name";s:7:"profile";s:4:"slug";s:7:"profile";s:5:"count";s:3:"371";}}', 'yes'),
(174, '_site_transient_timeout_available_translations', '1453895469', 'yes');
INSERT INTO `wp_options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(175, '_site_transient_available_translations', 'a:73:{s:2:"ar";a:8:{s:8:"language";s:2:"ar";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2015-12-30 08:58:25";s:12:"english_name";s:6:"Arabic";s:11:"native_name";s:14:"العربية";s:7:"package";s:61:"https://downloads.wordpress.org/translation/core/4.4.1/ar.zip";s:3:"iso";a:2:{i:1;s:2:"ar";i:2;s:3:"ara";}s:7:"strings";a:1:{s:8:"continue";s:16:"المتابعة";}}s:3:"ary";a:8:{s:8:"language";s:3:"ary";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2015-12-12 10:15:45";s:12:"english_name";s:15:"Moroccan Arabic";s:11:"native_name";s:31:"العربية المغربية";s:7:"package";s:62:"https://downloads.wordpress.org/translation/core/4.4.1/ary.zip";s:3:"iso";a:2:{i:1;s:5:"ar_MA";i:3;s:3:"ary";}s:7:"strings";a:1:{s:8:"continue";s:16:"المتابعة";}}s:2:"az";a:8:{s:8:"language";s:2:"az";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2015-12-07 20:53:51";s:12:"english_name";s:11:"Azerbaijani";s:11:"native_name";s:16:"Azərbaycan dili";s:7:"package";s:61:"https://downloads.wordpress.org/translation/core/4.4.1/az.zip";s:3:"iso";a:2:{i:1;s:2:"az";i:2;s:3:"aze";}s:7:"strings";a:1:{s:8:"continue";s:5:"Davam";}}s:5:"bg_BG";a:8:{s:8:"language";s:5:"bg_BG";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2015-12-08 08:50:29";s:12:"english_name";s:9:"Bulgarian";s:11:"native_name";s:18:"Български";s:7:"package";s:64:"https://downloads.wordpress.org/translation/core/4.4.1/bg_BG.zip";s:3:"iso";a:2:{i:1;s:2:"bg";i:2;s:3:"bul";}s:7:"strings";a:1:{s:8:"continue";s:22:"Продължение";}}s:5:"bn_BD";a:8:{s:8:"language";s:5:"bn_BD";s:7:"version";s:5:"4.3.2";s:7:"updated";s:19:"2015-09-16 05:09:40";s:12:"english_name";s:7:"Bengali";s:11:"native_name";s:15:"বাংলা";s:7:"package";s:64:"https://downloads.wordpress.org/translation/core/4.3.2/bn_BD.zip";s:3:"iso";a:1:{i:1;s:2:"bn";}s:7:"strings";a:1:{s:8:"continue";s:23:"এগিয়ে চল.";}}s:5:"bs_BA";a:8:{s:8:"language";s:5:"bs_BA";s:7:"version";s:5:"4.3.2";s:7:"updated";s:19:"2015-08-18 21:20:44";s:12:"english_name";s:7:"Bosnian";s:11:"native_name";s:8:"Bosanski";s:7:"package";s:64:"https://downloads.wordpress.org/translation/core/4.3.2/bs_BA.zip";s:3:"iso";a:2:{i:1;s:2:"bs";i:2;s:3:"bos";}s:7:"strings";a:1:{s:8:"continue";s:7:"Nastavi";}}s:2:"ca";a:8:{s:8:"language";s:2:"ca";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2016-01-16 13:48:03";s:12:"english_name";s:7:"Catalan";s:11:"native_name";s:7:"Català";s:7:"package";s:61:"https://downloads.wordpress.org/translation/core/4.4.1/ca.zip";s:3:"iso";a:2:{i:1;s:2:"ca";i:2;s:3:"cat";}s:7:"strings";a:1:{s:8:"continue";s:8:"Continua";}}s:2:"cy";a:8:{s:8:"language";s:2:"cy";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2016-01-06 11:22:33";s:12:"english_name";s:5:"Welsh";s:11:"native_name";s:7:"Cymraeg";s:7:"package";s:61:"https://downloads.wordpress.org/translation/core/4.4.1/cy.zip";s:3:"iso";a:2:{i:1;s:2:"cy";i:2;s:3:"cym";}s:7:"strings";a:1:{s:8:"continue";s:6:"Parhau";}}s:5:"da_DK";a:8:{s:8:"language";s:5:"da_DK";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2015-12-08 22:48:20";s:12:"english_name";s:6:"Danish";s:11:"native_name";s:5:"Dansk";s:7:"package";s:64:"https://downloads.wordpress.org/translation/core/4.4.1/da_DK.zip";s:3:"iso";a:2:{i:1;s:2:"da";i:2;s:3:"dan";}s:7:"strings";a:1:{s:8:"continue";s:12:"Forts&#230;t";}}s:5:"de_CH";a:8:{s:8:"language";s:5:"de_CH";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2015-12-08 14:19:21";s:12:"english_name";s:20:"German (Switzerland)";s:11:"native_name";s:17:"Deutsch (Schweiz)";s:7:"package";s:64:"https://downloads.wordpress.org/translation/core/4.4.1/de_CH.zip";s:3:"iso";a:1:{i:1;s:2:"de";}s:7:"strings";a:1:{s:8:"continue";s:10:"Fortfahren";}}s:12:"de_DE_formal";a:8:{s:8:"language";s:12:"de_DE_formal";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2016-01-21 14:06:26";s:12:"english_name";s:15:"German (Formal)";s:11:"native_name";s:13:"Deutsch (Sie)";s:7:"package";s:71:"https://downloads.wordpress.org/translation/core/4.4.1/de_DE_formal.zip";s:3:"iso";a:1:{i:1;s:2:"de";}s:7:"strings";a:1:{s:8:"continue";s:10:"Fortfahren";}}s:5:"de_DE";a:8:{s:8:"language";s:5:"de_DE";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2016-01-21 14:09:02";s:12:"english_name";s:6:"German";s:11:"native_name";s:7:"Deutsch";s:7:"package";s:64:"https://downloads.wordpress.org/translation/core/4.4.1/de_DE.zip";s:3:"iso";a:1:{i:1;s:2:"de";}s:7:"strings";a:1:{s:8:"continue";s:10:"Fortfahren";}}s:2:"el";a:8:{s:8:"language";s:2:"el";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2016-01-24 09:26:28";s:12:"english_name";s:5:"Greek";s:11:"native_name";s:16:"Ελληνικά";s:7:"package";s:61:"https://downloads.wordpress.org/translation/core/4.4.1/el.zip";s:3:"iso";a:2:{i:1;s:2:"el";i:2;s:3:"ell";}s:7:"strings";a:1:{s:8:"continue";s:16:"Συνέχεια";}}s:5:"en_NZ";a:8:{s:8:"language";s:5:"en_NZ";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2015-12-08 13:34:17";s:12:"english_name";s:21:"English (New Zealand)";s:11:"native_name";s:21:"English (New Zealand)";s:7:"package";s:64:"https://downloads.wordpress.org/translation/core/4.4.1/en_NZ.zip";s:3:"iso";a:3:{i:1;s:2:"en";i:2;s:3:"eng";i:3;s:3:"eng";}s:7:"strings";a:1:{s:8:"continue";s:8:"Continue";}}s:5:"en_ZA";a:8:{s:8:"language";s:5:"en_ZA";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2015-12-15 11:52:35";s:12:"english_name";s:22:"English (South Africa)";s:11:"native_name";s:22:"English (South Africa)";s:7:"package";s:64:"https://downloads.wordpress.org/translation/core/4.4.1/en_ZA.zip";s:3:"iso";a:3:{i:1;s:2:"en";i:2;s:3:"eng";i:3;s:3:"eng";}s:7:"strings";a:1:{s:8:"continue";s:8:"Continue";}}s:5:"en_GB";a:8:{s:8:"language";s:5:"en_GB";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2016-01-14 21:14:29";s:12:"english_name";s:12:"English (UK)";s:11:"native_name";s:12:"English (UK)";s:7:"package";s:64:"https://downloads.wordpress.org/translation/core/4.4.1/en_GB.zip";s:3:"iso";a:3:{i:1;s:2:"en";i:2;s:3:"eng";i:3;s:3:"eng";}s:7:"strings";a:1:{s:8:"continue";s:8:"Continue";}}s:5:"en_CA";a:8:{s:8:"language";s:5:"en_CA";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2015-12-06 23:10:59";s:12:"english_name";s:16:"English (Canada)";s:11:"native_name";s:16:"English (Canada)";s:7:"package";s:64:"https://downloads.wordpress.org/translation/core/4.4.1/en_CA.zip";s:3:"iso";a:3:{i:1;s:2:"en";i:2;s:3:"eng";i:3;s:3:"eng";}s:7:"strings";a:1:{s:8:"continue";s:8:"Continue";}}s:5:"en_AU";a:8:{s:8:"language";s:5:"en_AU";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2015-12-07 04:39:48";s:12:"english_name";s:19:"English (Australia)";s:11:"native_name";s:19:"English (Australia)";s:7:"package";s:64:"https://downloads.wordpress.org/translation/core/4.4.1/en_AU.zip";s:3:"iso";a:3:{i:1;s:2:"en";i:2;s:3:"eng";i:3;s:3:"eng";}s:7:"strings";a:1:{s:8:"continue";s:8:"Continue";}}s:2:"eo";a:8:{s:8:"language";s:2:"eo";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2016-01-25 13:07:29";s:12:"english_name";s:9:"Esperanto";s:11:"native_name";s:9:"Esperanto";s:7:"package";s:61:"https://downloads.wordpress.org/translation/core/4.4.1/eo.zip";s:3:"iso";a:2:{i:1;s:2:"eo";i:2;s:3:"epo";}s:7:"strings";a:1:{s:8:"continue";s:8:"Daŭrigi";}}s:5:"es_MX";a:8:{s:8:"language";s:5:"es_MX";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2015-12-07 17:35:10";s:12:"english_name";s:16:"Spanish (Mexico)";s:11:"native_name";s:19:"Español de México";s:7:"package";s:64:"https://downloads.wordpress.org/translation/core/4.4.1/es_MX.zip";s:3:"iso";a:2:{i:1;s:2:"es";i:2;s:3:"spa";}s:7:"strings";a:1:{s:8:"continue";s:9:"Continuar";}}s:5:"es_CL";a:8:{s:8:"language";s:5:"es_CL";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2016-01-25 13:53:18";s:12:"english_name";s:15:"Spanish (Chile)";s:11:"native_name";s:17:"Español de Chile";s:7:"package";s:64:"https://downloads.wordpress.org/translation/core/4.4.1/es_CL.zip";s:3:"iso";a:2:{i:1;s:2:"es";i:2;s:3:"spa";}s:7:"strings";a:1:{s:8:"continue";s:9:"Continuar";}}s:5:"es_PE";a:8:{s:8:"language";s:5:"es_PE";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2016-01-24 15:17:36";s:12:"english_name";s:14:"Spanish (Peru)";s:11:"native_name";s:17:"Español de Perú";s:7:"package";s:64:"https://downloads.wordpress.org/translation/core/4.4.1/es_PE.zip";s:3:"iso";a:2:{i:1;s:2:"es";i:2;s:3:"spa";}s:7:"strings";a:1:{s:8:"continue";s:9:"Continuar";}}s:5:"es_ES";a:8:{s:8:"language";s:5:"es_ES";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2016-01-24 19:37:59";s:12:"english_name";s:15:"Spanish (Spain)";s:11:"native_name";s:8:"Español";s:7:"package";s:64:"https://downloads.wordpress.org/translation/core/4.4.1/es_ES.zip";s:3:"iso";a:1:{i:1;s:2:"es";}s:7:"strings";a:1:{s:8:"continue";s:9:"Continuar";}}s:5:"es_AR";a:8:{s:8:"language";s:5:"es_AR";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2015-12-23 00:46:01";s:12:"english_name";s:19:"Spanish (Argentina)";s:11:"native_name";s:21:"Español de Argentina";s:7:"package";s:64:"https://downloads.wordpress.org/translation/core/4.4.1/es_AR.zip";s:3:"iso";a:2:{i:1;s:2:"es";i:2;s:3:"spa";}s:7:"strings";a:1:{s:8:"continue";s:9:"Continuar";}}s:5:"es_CO";a:8:{s:8:"language";s:5:"es_CO";s:7:"version";s:6:"4.3-RC";s:7:"updated";s:19:"2015-08-04 06:10:33";s:12:"english_name";s:18:"Spanish (Colombia)";s:11:"native_name";s:20:"Español de Colombia";s:7:"package";s:65:"https://downloads.wordpress.org/translation/core/4.3-RC/es_CO.zip";s:3:"iso";a:2:{i:1;s:2:"es";i:2;s:3:"spa";}s:7:"strings";a:1:{s:8:"continue";s:9:"Continuar";}}s:5:"es_VE";a:8:{s:8:"language";s:5:"es_VE";s:7:"version";s:5:"4.2.6";s:7:"updated";s:19:"2015-10-29 16:32:18";s:12:"english_name";s:19:"Spanish (Venezuela)";s:11:"native_name";s:21:"Español de Venezuela";s:7:"package";s:64:"https://downloads.wordpress.org/translation/core/4.2.6/es_VE.zip";s:3:"iso";a:2:{i:1;s:2:"es";i:2;s:3:"spa";}s:7:"strings";a:1:{s:8:"continue";s:9:"Continuar";}}s:2:"et";a:8:{s:8:"language";s:2:"et";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2016-01-24 20:58:31";s:12:"english_name";s:8:"Estonian";s:11:"native_name";s:5:"Eesti";s:7:"package";s:61:"https://downloads.wordpress.org/translation/core/4.4.1/et.zip";s:3:"iso";a:2:{i:1;s:2:"et";i:2;s:3:"est";}s:7:"strings";a:1:{s:8:"continue";s:6:"Jätka";}}s:2:"eu";a:8:{s:8:"language";s:2:"eu";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2015-12-07 21:19:15";s:12:"english_name";s:6:"Basque";s:11:"native_name";s:7:"Euskara";s:7:"package";s:61:"https://downloads.wordpress.org/translation/core/4.4.1/eu.zip";s:3:"iso";a:2:{i:1;s:2:"eu";i:2;s:3:"eus";}s:7:"strings";a:1:{s:8:"continue";s:8:"Jarraitu";}}s:5:"fa_IR";a:8:{s:8:"language";s:5:"fa_IR";s:7:"version";s:5:"4.3.2";s:7:"updated";s:19:"2015-08-20 13:36:08";s:12:"english_name";s:7:"Persian";s:11:"native_name";s:10:"فارسی";s:7:"package";s:64:"https://downloads.wordpress.org/translation/core/4.3.2/fa_IR.zip";s:3:"iso";a:2:{i:1;s:2:"fa";i:2;s:3:"fas";}s:7:"strings";a:1:{s:8:"continue";s:10:"ادامه";}}s:2:"fi";a:8:{s:8:"language";s:2:"fi";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2015-12-23 06:49:15";s:12:"english_name";s:7:"Finnish";s:11:"native_name";s:5:"Suomi";s:7:"package";s:61:"https://downloads.wordpress.org/translation/core/4.4.1/fi.zip";s:3:"iso";a:2:{i:1;s:2:"fi";i:2;s:3:"fin";}s:7:"strings";a:1:{s:8:"continue";s:5:"Jatka";}}s:5:"fr_BE";a:8:{s:8:"language";s:5:"fr_BE";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2015-12-08 13:47:35";s:12:"english_name";s:16:"French (Belgium)";s:11:"native_name";s:21:"Français de Belgique";s:7:"package";s:64:"https://downloads.wordpress.org/translation/core/4.4.1/fr_BE.zip";s:3:"iso";a:2:{i:1;s:2:"fr";i:2;s:3:"fra";}s:7:"strings";a:1:{s:8:"continue";s:9:"Continuer";}}s:5:"fr_FR";a:8:{s:8:"language";s:5:"fr_FR";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2016-01-18 14:36:47";s:12:"english_name";s:15:"French (France)";s:11:"native_name";s:9:"Français";s:7:"package";s:64:"https://downloads.wordpress.org/translation/core/4.4.1/fr_FR.zip";s:3:"iso";a:1:{i:1;s:2:"fr";}s:7:"strings";a:1:{s:8:"continue";s:9:"Continuer";}}s:5:"fr_CA";a:8:{s:8:"language";s:5:"fr_CA";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2015-12-09 02:16:19";s:12:"english_name";s:15:"French (Canada)";s:11:"native_name";s:19:"Français du Canada";s:7:"package";s:64:"https://downloads.wordpress.org/translation/core/4.4.1/fr_CA.zip";s:3:"iso";a:2:{i:1;s:2:"fr";i:2;s:3:"fra";}s:7:"strings";a:1:{s:8:"continue";s:9:"Continuer";}}s:2:"gd";a:8:{s:8:"language";s:2:"gd";s:7:"version";s:5:"4.3.2";s:7:"updated";s:19:"2015-09-24 15:25:30";s:12:"english_name";s:15:"Scottish Gaelic";s:11:"native_name";s:9:"Gàidhlig";s:7:"package";s:61:"https://downloads.wordpress.org/translation/core/4.3.2/gd.zip";s:3:"iso";a:3:{i:1;s:2:"gd";i:2;s:3:"gla";i:3;s:3:"gla";}s:7:"strings";a:1:{s:8:"continue";s:15:"Lean air adhart";}}s:5:"gl_ES";a:8:{s:8:"language";s:5:"gl_ES";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2016-01-13 16:48:03";s:12:"english_name";s:8:"Galician";s:11:"native_name";s:6:"Galego";s:7:"package";s:64:"https://downloads.wordpress.org/translation/core/4.4.1/gl_ES.zip";s:3:"iso";a:2:{i:1;s:2:"gl";i:2;s:3:"glg";}s:7:"strings";a:1:{s:8:"continue";s:9:"Continuar";}}s:3:"haz";a:8:{s:8:"language";s:3:"haz";s:7:"version";s:5:"4.1.9";s:7:"updated";s:19:"2015-03-26 15:20:27";s:12:"english_name";s:8:"Hazaragi";s:11:"native_name";s:15:"هزاره گی";s:7:"package";s:62:"https://downloads.wordpress.org/translation/core/4.1.9/haz.zip";s:3:"iso";a:1:{i:3;s:3:"haz";}s:7:"strings";a:1:{s:8:"continue";s:10:"ادامه";}}s:5:"he_IL";a:8:{s:8:"language";s:5:"he_IL";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2015-12-09 18:10:01";s:12:"english_name";s:6:"Hebrew";s:11:"native_name";s:16:"עִבְרִית";s:7:"package";s:64:"https://downloads.wordpress.org/translation/core/4.4.1/he_IL.zip";s:3:"iso";a:1:{i:1;s:2:"he";}s:7:"strings";a:1:{s:8:"continue";s:12:"להמשיך";}}s:5:"hi_IN";a:8:{s:8:"language";s:5:"hi_IN";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2015-12-07 05:11:43";s:12:"english_name";s:5:"Hindi";s:11:"native_name";s:18:"हिन्दी";s:7:"package";s:64:"https://downloads.wordpress.org/translation/core/4.4.1/hi_IN.zip";s:3:"iso";a:2:{i:1;s:2:"hi";i:2;s:3:"hin";}s:7:"strings";a:1:{s:8:"continue";s:12:"जारी";}}s:2:"hr";a:8:{s:8:"language";s:2:"hr";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2016-01-22 20:44:15";s:12:"english_name";s:8:"Croatian";s:11:"native_name";s:8:"Hrvatski";s:7:"package";s:61:"https://downloads.wordpress.org/translation/core/4.4.1/hr.zip";s:3:"iso";a:2:{i:1;s:2:"hr";i:2;s:3:"hrv";}s:7:"strings";a:1:{s:8:"continue";s:7:"Nastavi";}}s:5:"hu_HU";a:8:{s:8:"language";s:5:"hu_HU";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2016-01-23 09:15:56";s:12:"english_name";s:9:"Hungarian";s:11:"native_name";s:6:"Magyar";s:7:"package";s:64:"https://downloads.wordpress.org/translation/core/4.4.1/hu_HU.zip";s:3:"iso";a:2:{i:1;s:2:"hu";i:2;s:3:"hun";}s:7:"strings";a:1:{s:8:"continue";s:7:"Tovább";}}s:2:"hy";a:8:{s:8:"language";s:2:"hy";s:7:"version";s:5:"4.3.2";s:7:"updated";s:19:"2015-08-17 13:36:47";s:12:"english_name";s:8:"Armenian";s:11:"native_name";s:14:"Հայերեն";s:7:"package";s:61:"https://downloads.wordpress.org/translation/core/4.3.2/hy.zip";s:3:"iso";a:2:{i:1;s:2:"hy";i:2;s:3:"hye";}s:7:"strings";a:1:{s:8:"continue";s:20:"Շարունակել";}}s:5:"id_ID";a:8:{s:8:"language";s:5:"id_ID";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2015-12-21 16:17:50";s:12:"english_name";s:10:"Indonesian";s:11:"native_name";s:16:"Bahasa Indonesia";s:7:"package";s:64:"https://downloads.wordpress.org/translation/core/4.4.1/id_ID.zip";s:3:"iso";a:2:{i:1;s:2:"id";i:2;s:3:"ind";}s:7:"strings";a:1:{s:8:"continue";s:9:"Lanjutkan";}}s:5:"is_IS";a:8:{s:8:"language";s:5:"is_IS";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2015-12-08 00:20:24";s:12:"english_name";s:9:"Icelandic";s:11:"native_name";s:9:"Íslenska";s:7:"package";s:64:"https://downloads.wordpress.org/translation/core/4.4.1/is_IS.zip";s:3:"iso";a:2:{i:1;s:2:"is";i:2;s:3:"isl";}s:7:"strings";a:1:{s:8:"continue";s:6:"Áfram";}}s:5:"it_IT";a:8:{s:8:"language";s:5:"it_IT";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2016-01-22 10:34:10";s:12:"english_name";s:7:"Italian";s:11:"native_name";s:8:"Italiano";s:7:"package";s:64:"https://downloads.wordpress.org/translation/core/4.4.1/it_IT.zip";s:3:"iso";a:2:{i:1;s:2:"it";i:2;s:3:"ita";}s:7:"strings";a:1:{s:8:"continue";s:8:"Continua";}}s:2:"ja";a:8:{s:8:"language";s:2:"ja";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2016-01-15 13:41:43";s:12:"english_name";s:8:"Japanese";s:11:"native_name";s:9:"日本語";s:7:"package";s:61:"https://downloads.wordpress.org/translation/core/4.4.1/ja.zip";s:3:"iso";a:1:{i:1;s:2:"ja";}s:7:"strings";a:1:{s:8:"continue";s:9:"続ける";}}s:5:"ko_KR";a:8:{s:8:"language";s:5:"ko_KR";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2015-12-09 07:35:25";s:12:"english_name";s:6:"Korean";s:11:"native_name";s:9:"한국어";s:7:"package";s:64:"https://downloads.wordpress.org/translation/core/4.4.1/ko_KR.zip";s:3:"iso";a:2:{i:1;s:2:"ko";i:2;s:3:"kor";}s:7:"strings";a:1:{s:8:"continue";s:6:"계속";}}s:5:"lt_LT";a:8:{s:8:"language";s:5:"lt_LT";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2015-12-08 20:07:24";s:12:"english_name";s:10:"Lithuanian";s:11:"native_name";s:15:"Lietuvių kalba";s:7:"package";s:64:"https://downloads.wordpress.org/translation/core/4.4.1/lt_LT.zip";s:3:"iso";a:2:{i:1;s:2:"lt";i:2;s:3:"lit";}s:7:"strings";a:1:{s:8:"continue";s:6:"Tęsti";}}s:5:"ms_MY";a:8:{s:8:"language";s:5:"ms_MY";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2015-12-15 05:49:00";s:12:"english_name";s:5:"Malay";s:11:"native_name";s:13:"Bahasa Melayu";s:7:"package";s:64:"https://downloads.wordpress.org/translation/core/4.4.1/ms_MY.zip";s:3:"iso";a:2:{i:1;s:2:"ms";i:2;s:3:"msa";}s:7:"strings";a:1:{s:8:"continue";s:8:"Teruskan";}}s:5:"my_MM";a:8:{s:8:"language";s:5:"my_MM";s:7:"version";s:5:"4.1.9";s:7:"updated";s:19:"2015-03-26 15:57:42";s:12:"english_name";s:17:"Myanmar (Burmese)";s:11:"native_name";s:15:"ဗမာစာ";s:7:"package";s:64:"https://downloads.wordpress.org/translation/core/4.1.9/my_MM.zip";s:3:"iso";a:2:{i:1;s:2:"my";i:2;s:3:"mya";}s:7:"strings";a:1:{s:8:"continue";s:54:"ဆက်လက်လုပ်ေဆာင်ပါ။";}}s:5:"nb_NO";a:8:{s:8:"language";s:5:"nb_NO";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2015-12-07 10:01:09";s:12:"english_name";s:19:"Norwegian (Bokmål)";s:11:"native_name";s:13:"Norsk bokmål";s:7:"package";s:64:"https://downloads.wordpress.org/translation/core/4.4.1/nb_NO.zip";s:3:"iso";a:2:{i:1;s:2:"nb";i:2;s:3:"nob";}s:7:"strings";a:1:{s:8:"continue";s:8:"Fortsett";}}s:5:"nl_NL";a:8:{s:8:"language";s:5:"nl_NL";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2016-01-20 13:36:47";s:12:"english_name";s:5:"Dutch";s:11:"native_name";s:10:"Nederlands";s:7:"package";s:64:"https://downloads.wordpress.org/translation/core/4.4.1/nl_NL.zip";s:3:"iso";a:2:{i:1;s:2:"nl";i:2;s:3:"nld";}s:7:"strings";a:1:{s:8:"continue";s:8:"Doorgaan";}}s:12:"nl_NL_formal";a:8:{s:8:"language";s:12:"nl_NL_formal";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2016-01-20 13:35:50";s:12:"english_name";s:14:"Dutch (Formal)";s:11:"native_name";s:20:"Nederlands (Formeel)";s:7:"package";s:71:"https://downloads.wordpress.org/translation/core/4.4.1/nl_NL_formal.zip";s:3:"iso";a:2:{i:1;s:2:"nl";i:2;s:3:"nld";}s:7:"strings";a:1:{s:8:"continue";s:8:"Doorgaan";}}s:5:"nn_NO";a:8:{s:8:"language";s:5:"nn_NO";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2015-12-14 12:19:44";s:12:"english_name";s:19:"Norwegian (Nynorsk)";s:11:"native_name";s:13:"Norsk nynorsk";s:7:"package";s:64:"https://downloads.wordpress.org/translation/core/4.4.1/nn_NO.zip";s:3:"iso";a:2:{i:1;s:2:"nn";i:2;s:3:"nno";}s:7:"strings";a:1:{s:8:"continue";s:9:"Hald fram";}}s:3:"oci";a:8:{s:8:"language";s:3:"oci";s:7:"version";s:6:"4.3-RC";s:7:"updated";s:19:"2015-08-02 07:53:33";s:12:"english_name";s:7:"Occitan";s:11:"native_name";s:7:"Occitan";s:7:"package";s:63:"https://downloads.wordpress.org/translation/core/4.3-RC/oci.zip";s:3:"iso";a:2:{i:1;s:2:"oc";i:2;s:3:"oci";}s:7:"strings";a:1:{s:8:"continue";s:9:"Contunhar";}}s:5:"pl_PL";a:8:{s:8:"language";s:5:"pl_PL";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2016-01-09 13:30:40";s:12:"english_name";s:6:"Polish";s:11:"native_name";s:6:"Polski";s:7:"package";s:64:"https://downloads.wordpress.org/translation/core/4.4.1/pl_PL.zip";s:3:"iso";a:2:{i:1;s:2:"pl";i:2;s:3:"pol";}s:7:"strings";a:1:{s:8:"continue";s:9:"Kontynuuj";}}s:2:"ps";a:8:{s:8:"language";s:2:"ps";s:7:"version";s:5:"4.1.9";s:7:"updated";s:19:"2015-03-29 22:19:48";s:12:"english_name";s:6:"Pashto";s:11:"native_name";s:8:"پښتو";s:7:"package";s:61:"https://downloads.wordpress.org/translation/core/4.1.9/ps.zip";s:3:"iso";a:2:{i:1;s:2:"ps";i:2;s:3:"pus";}s:7:"strings";a:1:{s:8:"continue";s:8:"دوام";}}s:5:"pt_BR";a:8:{s:8:"language";s:5:"pt_BR";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2015-12-10 18:05:56";s:12:"english_name";s:19:"Portuguese (Brazil)";s:11:"native_name";s:20:"Português do Brasil";s:7:"package";s:64:"https://downloads.wordpress.org/translation/core/4.4.1/pt_BR.zip";s:3:"iso";a:2:{i:1;s:2:"pt";i:2;s:3:"por";}s:7:"strings";a:1:{s:8:"continue";s:9:"Continuar";}}s:5:"pt_PT";a:8:{s:8:"language";s:5:"pt_PT";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2016-01-20 15:27:05";s:12:"english_name";s:21:"Portuguese (Portugal)";s:11:"native_name";s:10:"Português";s:7:"package";s:64:"https://downloads.wordpress.org/translation/core/4.4.1/pt_PT.zip";s:3:"iso";a:1:{i:1;s:2:"pt";}s:7:"strings";a:1:{s:8:"continue";s:9:"Continuar";}}s:5:"ro_RO";a:8:{s:8:"language";s:5:"ro_RO";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2015-12-09 18:41:28";s:12:"english_name";s:8:"Romanian";s:11:"native_name";s:8:"Română";s:7:"package";s:64:"https://downloads.wordpress.org/translation/core/4.4.1/ro_RO.zip";s:3:"iso";a:2:{i:1;s:2:"ro";i:2;s:3:"ron";}s:7:"strings";a:1:{s:8:"continue";s:9:"Continuă";}}s:5:"ru_RU";a:8:{s:8:"language";s:5:"ru_RU";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2016-01-02 00:04:31";s:12:"english_name";s:7:"Russian";s:11:"native_name";s:14:"Русский";s:7:"package";s:64:"https://downloads.wordpress.org/translation/core/4.4.1/ru_RU.zip";s:3:"iso";a:2:{i:1;s:2:"ru";i:2;s:3:"rus";}s:7:"strings";a:1:{s:8:"continue";s:20:"Продолжить";}}s:5:"sk_SK";a:8:{s:8:"language";s:5:"sk_SK";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2015-12-30 10:37:54";s:12:"english_name";s:6:"Slovak";s:11:"native_name";s:11:"Slovenčina";s:7:"package";s:64:"https://downloads.wordpress.org/translation/core/4.4.1/sk_SK.zip";s:3:"iso";a:2:{i:1;s:2:"sk";i:2;s:3:"slk";}s:7:"strings";a:1:{s:8:"continue";s:12:"Pokračovať";}}s:5:"sl_SI";a:8:{s:8:"language";s:5:"sl_SI";s:7:"version";s:5:"4.3.2";s:7:"updated";s:19:"2015-09-06 16:10:24";s:12:"english_name";s:9:"Slovenian";s:11:"native_name";s:13:"Slovenščina";s:7:"package";s:64:"https://downloads.wordpress.org/translation/core/4.3.2/sl_SI.zip";s:3:"iso";a:2:{i:1;s:2:"sl";i:2;s:3:"slv";}s:7:"strings";a:1:{s:8:"continue";s:10:"Nadaljujte";}}s:2:"sq";a:8:{s:8:"language";s:2:"sq";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2015-12-07 09:13:24";s:12:"english_name";s:8:"Albanian";s:11:"native_name";s:5:"Shqip";s:7:"package";s:61:"https://downloads.wordpress.org/translation/core/4.4.1/sq.zip";s:3:"iso";a:2:{i:1;s:2:"sq";i:2;s:3:"sqi";}s:7:"strings";a:1:{s:8:"continue";s:6:"Vazhdo";}}s:5:"sr_RS";a:8:{s:8:"language";s:5:"sr_RS";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2015-12-09 09:09:51";s:12:"english_name";s:7:"Serbian";s:11:"native_name";s:23:"Српски језик";s:7:"package";s:64:"https://downloads.wordpress.org/translation/core/4.4.1/sr_RS.zip";s:3:"iso";a:2:{i:1;s:2:"sr";i:2;s:3:"srp";}s:7:"strings";a:1:{s:8:"continue";s:14:"Настави";}}s:5:"sv_SE";a:8:{s:8:"language";s:5:"sv_SE";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2015-12-08 23:28:56";s:12:"english_name";s:7:"Swedish";s:11:"native_name";s:7:"Svenska";s:7:"package";s:64:"https://downloads.wordpress.org/translation/core/4.4.1/sv_SE.zip";s:3:"iso";a:2:{i:1;s:2:"sv";i:2;s:3:"swe";}s:7:"strings";a:1:{s:8:"continue";s:9:"Fortsätt";}}s:2:"th";a:8:{s:8:"language";s:2:"th";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2015-12-08 03:22:55";s:12:"english_name";s:4:"Thai";s:11:"native_name";s:9:"ไทย";s:7:"package";s:61:"https://downloads.wordpress.org/translation/core/4.4.1/th.zip";s:3:"iso";a:2:{i:1;s:2:"th";i:2;s:3:"tha";}s:7:"strings";a:1:{s:8:"continue";s:15:"ต่อไป";}}s:2:"tl";a:8:{s:8:"language";s:2:"tl";s:7:"version";s:5:"4.3.2";s:7:"updated";s:19:"2015-08-20 03:52:15";s:12:"english_name";s:7:"Tagalog";s:11:"native_name";s:7:"Tagalog";s:7:"package";s:61:"https://downloads.wordpress.org/translation/core/4.3.2/tl.zip";s:3:"iso";a:2:{i:1;s:2:"tl";i:2;s:3:"tgl";}s:7:"strings";a:1:{s:8:"continue";s:10:"Magpatuloy";}}s:5:"tr_TR";a:8:{s:8:"language";s:5:"tr_TR";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2015-12-17 23:12:27";s:12:"english_name";s:7:"Turkish";s:11:"native_name";s:8:"Türkçe";s:7:"package";s:64:"https://downloads.wordpress.org/translation/core/4.4.1/tr_TR.zip";s:3:"iso";a:2:{i:1;s:2:"tr";i:2;s:3:"tur";}s:7:"strings";a:1:{s:8:"continue";s:5:"Devam";}}s:5:"ug_CN";a:8:{s:8:"language";s:5:"ug_CN";s:7:"version";s:5:"4.1.9";s:7:"updated";s:19:"2015-03-26 16:45:38";s:12:"english_name";s:6:"Uighur";s:11:"native_name";s:9:"Uyƣurqə";s:7:"package";s:64:"https://downloads.wordpress.org/translation/core/4.1.9/ug_CN.zip";s:3:"iso";a:2:{i:1;s:2:"ug";i:2;s:3:"uig";}s:7:"strings";a:1:{s:8:"continue";s:26:"داۋاملاشتۇرۇش";}}s:2:"uk";a:8:{s:8:"language";s:2:"uk";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2016-01-03 22:04:41";s:12:"english_name";s:9:"Ukrainian";s:11:"native_name";s:20:"Українська";s:7:"package";s:61:"https://downloads.wordpress.org/translation/core/4.4.1/uk.zip";s:3:"iso";a:2:{i:1;s:2:"uk";i:2;s:3:"ukr";}s:7:"strings";a:1:{s:8:"continue";s:20:"Продовжити";}}s:2:"vi";a:8:{s:8:"language";s:2:"vi";s:7:"version";s:5:"4.3.2";s:7:"updated";s:19:"2015-11-27 09:19:03";s:12:"english_name";s:10:"Vietnamese";s:11:"native_name";s:14:"Tiếng Việt";s:7:"package";s:61:"https://downloads.wordpress.org/translation/core/4.3.2/vi.zip";s:3:"iso";a:2:{i:1;s:2:"vi";i:2;s:3:"vie";}s:7:"strings";a:1:{s:8:"continue";s:12:"Tiếp tục";}}s:5:"zh_TW";a:8:{s:8:"language";s:5:"zh_TW";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2015-12-11 18:51:41";s:12:"english_name";s:16:"Chinese (Taiwan)";s:11:"native_name";s:12:"繁體中文";s:7:"package";s:64:"https://downloads.wordpress.org/translation/core/4.4.1/zh_TW.zip";s:3:"iso";a:2:{i:1;s:2:"zh";i:2;s:3:"zho";}s:7:"strings";a:1:{s:8:"continue";s:6:"繼續";}}s:5:"zh_CN";a:8:{s:8:"language";s:5:"zh_CN";s:7:"version";s:5:"4.4.1";s:7:"updated";s:19:"2015-12-12 22:55:08";s:12:"english_name";s:15:"Chinese (China)";s:11:"native_name";s:12:"简体中文";s:7:"package";s:64:"https://downloads.wordpress.org/translation/core/4.4.1/zh_CN.zip";s:3:"iso";a:2:{i:1;s:2:"zh";i:2;s:3:"zho";}s:7:"strings";a:1:{s:8:"continue";s:6:"继续";}}}', 'yes'),
(176, '_transient_twentyfifteen_categories', '1', 'yes'),
(179, '_transient_is_multi_author', '0', 'yes'),
(182, '_transient_timeout_plugin_slugs', '1454388988', 'no'),
(183, '_transient_plugin_slugs', 'a:2:{i:0;s:19:"akismet/akismet.php";i:1;s:9:"hello.php";}', 'no'),
(184, '_transient_timeout_dash_88ae138922fe95674369b1cb3d215a2b', '1454345783', 'no'),
(185, '_transient_dash_88ae138922fe95674369b1cb3d215a2b', '<div class="rss-widget"><p><strong>RSS Error</strong>: WP HTTP Error: Could not resolve host: wordpress.org</p></div><div class="rss-widget"><p><strong>RSS Error</strong>: WP HTTP Error: Could not resolve host: planet.wordpress.org</p></div><div class="rss-widget"><ul></ul></div>', 'no'),
(187, '_site_transient_timeout_theme_roots', '1458648494', 'yes'),
(188, '_site_transient_theme_roots', 'a:3:{s:13:"twentyfifteen";s:7:"/themes";s:14:"twentyfourteen";s:7:"/themes";s:13:"twentysixteen";s:7:"/themes";}', 'yes');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wp_postmeta`
--

CREATE TABLE IF NOT EXISTS `wp_postmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`meta_id`),
  KEY `post_id` (`post_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=20 ;

--
-- Dumping data untuk tabel `wp_postmeta`
--

INSERT INTO `wp_postmeta` (`meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES
(1, 2, '_wp_page_template', 'default'),
(2, 4, '_wp_attached_file', '2016/01/PPicture.jpg'),
(3, 4, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:529;s:6:"height";i:529;s:4:"file";s:20:"2016/01/PPicture.jpg";s:5:"sizes";a:2:{s:9:"thumbnail";a:4:{s:4:"file";s:20:"PPicture-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}s:6:"medium";a:4:{s:4:"file";s:20:"PPicture-300x300.jpg";s:5:"width";i:300;s:6:"height";i:300;s:9:"mime-type";s:10:"image/jpeg";}}s:10:"image_meta";a:12:{s:8:"aperture";i:0;s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";i:0;s:9:"copyright";s:0:"";s:12:"focal_length";i:0;s:3:"iso";i:0;s:13:"shutter_speed";i:0;s:5:"title";s:0:"";s:11:"orientation";i:0;s:8:"keywords";a:0:{}}}'),
(4, 5, '_wp_attached_file', '2016/01/cropped-PPicture.jpg'),
(5, 5, '_wp_attachment_context', 'site-icon'),
(6, 5, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:512;s:6:"height";i:512;s:4:"file";s:28:"2016/01/cropped-PPicture.jpg";s:5:"sizes";a:6:{s:9:"thumbnail";a:4:{s:4:"file";s:28:"cropped-PPicture-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}s:6:"medium";a:4:{s:4:"file";s:28:"cropped-PPicture-300x300.jpg";s:5:"width";i:300;s:6:"height";i:300;s:9:"mime-type";s:10:"image/jpeg";}s:13:"site_icon-270";a:4:{s:4:"file";s:28:"cropped-PPicture-270x270.jpg";s:5:"width";i:270;s:6:"height";i:270;s:9:"mime-type";s:10:"image/jpeg";}s:13:"site_icon-192";a:4:{s:4:"file";s:28:"cropped-PPicture-192x192.jpg";s:5:"width";i:192;s:6:"height";i:192;s:9:"mime-type";s:10:"image/jpeg";}s:13:"site_icon-180";a:4:{s:4:"file";s:28:"cropped-PPicture-180x180.jpg";s:5:"width";i:180;s:6:"height";i:180;s:9:"mime-type";s:10:"image/jpeg";}s:12:"site_icon-32";a:4:{s:4:"file";s:26:"cropped-PPicture-32x32.jpg";s:5:"width";i:32;s:6:"height";i:32;s:9:"mime-type";s:10:"image/jpeg";}}s:10:"image_meta";a:12:{s:8:"aperture";i:0;s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";i:0;s:9:"copyright";s:0:"";s:12:"focal_length";i:0;s:3:"iso";i:0;s:13:"shutter_speed";i:0;s:5:"title";s:0:"";s:11:"orientation";i:0;s:8:"keywords";a:0:{}}}'),
(7, 6, '_wp_attached_file', '2016/01/cropped-cropped-PPicture.jpg'),
(8, 6, '_wp_attachment_context', 'custom-header'),
(9, 6, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:1260;s:6:"height";i:1260;s:4:"file";s:36:"2016/01/cropped-cropped-PPicture.jpg";s:5:"sizes";a:6:{s:9:"thumbnail";a:4:{s:4:"file";s:36:"cropped-cropped-PPicture-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}s:6:"medium";a:4:{s:4:"file";s:36:"cropped-cropped-PPicture-300x300.jpg";s:5:"width";i:300;s:6:"height";i:300;s:9:"mime-type";s:10:"image/jpeg";}s:12:"medium_large";a:4:{s:4:"file";s:36:"cropped-cropped-PPicture-768x768.jpg";s:5:"width";i:768;s:6:"height";i:768;s:9:"mime-type";s:10:"image/jpeg";}s:5:"large";a:4:{s:4:"file";s:38:"cropped-cropped-PPicture-1024x1024.jpg";s:5:"width";i:1024;s:6:"height";i:1024;s:9:"mime-type";s:10:"image/jpeg";}s:14:"post-thumbnail";a:4:{s:4:"file";s:36:"cropped-cropped-PPicture-672x372.jpg";s:5:"width";i:672;s:6:"height";i:372;s:9:"mime-type";s:10:"image/jpeg";}s:25:"twentyfourteen-full-width";a:4:{s:4:"file";s:37:"cropped-cropped-PPicture-1038x576.jpg";s:5:"width";i:1038;s:6:"height";i:576;s:9:"mime-type";s:10:"image/jpeg";}}s:10:"image_meta";a:12:{s:8:"aperture";i:0;s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";i:0;s:9:"copyright";s:0:"";s:12:"focal_length";i:0;s:3:"iso";i:0;s:13:"shutter_speed";i:0;s:5:"title";s:0:"";s:11:"orientation";i:0;s:8:"keywords";a:0:{}}}'),
(10, 6, '_wp_attachment_custom_header_last_used_twentyfourteen', '1453884172'),
(11, 6, '_wp_attachment_is_custom_header', 'twentyfourteen'),
(12, 7, '_wp_attached_file', '2016/01/cropped-cropped-PPicture-1.jpg'),
(13, 7, '_wp_attachment_context', 'custom-header'),
(14, 7, '_wp_attachment_metadata', 'a:5:{s:5:"width";i:1260;s:6:"height";i:241;s:4:"file";s:38:"2016/01/cropped-cropped-PPicture-1.jpg";s:5:"sizes";a:6:{s:9:"thumbnail";a:4:{s:4:"file";s:38:"cropped-cropped-PPicture-1-150x150.jpg";s:5:"width";i:150;s:6:"height";i:150;s:9:"mime-type";s:10:"image/jpeg";}s:6:"medium";a:4:{s:4:"file";s:37:"cropped-cropped-PPicture-1-300x57.jpg";s:5:"width";i:300;s:6:"height";i:57;s:9:"mime-type";s:10:"image/jpeg";}s:12:"medium_large";a:4:{s:4:"file";s:38:"cropped-cropped-PPicture-1-768x147.jpg";s:5:"width";i:768;s:6:"height";i:147;s:9:"mime-type";s:10:"image/jpeg";}s:5:"large";a:4:{s:4:"file";s:39:"cropped-cropped-PPicture-1-1024x196.jpg";s:5:"width";i:1024;s:6:"height";i:196;s:9:"mime-type";s:10:"image/jpeg";}s:14:"post-thumbnail";a:4:{s:4:"file";s:38:"cropped-cropped-PPicture-1-672x241.jpg";s:5:"width";i:672;s:6:"height";i:241;s:9:"mime-type";s:10:"image/jpeg";}s:25:"twentyfourteen-full-width";a:4:{s:4:"file";s:39:"cropped-cropped-PPicture-1-1038x241.jpg";s:5:"width";i:1038;s:6:"height";i:241;s:9:"mime-type";s:10:"image/jpeg";}}s:10:"image_meta";a:12:{s:8:"aperture";i:0;s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";i:0;s:9:"copyright";s:0:"";s:12:"focal_length";i:0;s:3:"iso";i:0;s:13:"shutter_speed";i:0;s:5:"title";s:0:"";s:11:"orientation";i:0;s:8:"keywords";a:0:{}}}'),
(15, 7, '_wp_attachment_custom_header_last_used_twentyfourteen', '1453884201'),
(16, 7, '_wp_attachment_is_custom_header', 'twentyfourteen'),
(17, 2, '_edit_lock', '1453884459:1'),
(18, 8, '_edit_last', '1'),
(19, 8, '_edit_lock', '1453884623:1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wp_posts`
--

CREATE TABLE IF NOT EXISTS `wp_posts` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_author` bigint(20) unsigned NOT NULL DEFAULT '0',
  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_excerpt` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `ping_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `post_password` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `post_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `to_ping` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pinged` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content_filtered` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `guid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT '0',
  `post_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'post',
  `post_mime_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_count` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `post_name` (`post_name`(191)),
  KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
  KEY `post_parent` (`post_parent`),
  KEY `post_author` (`post_author`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data untuk tabel `wp_posts`
--

INSERT INTO `wp_posts` (`ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES
(1, 1, '2016-01-27 08:37:47', '2016-01-27 08:37:47', 'Welcome to WordPress. This is your first post. Edit or delete it, then start writing!', 'Hello world!', '', 'publish', 'open', 'open', '', 'hello-world', '', '', '2016-01-27 08:37:47', '2016-01-27 08:37:47', '', 0, 'http://localhost/wordpress/?p=1', 0, 'post', '', 1),
(2, 1, '2016-01-27 08:37:47', '2016-01-27 08:37:47', 'This is an example page. It''s different from a blog post because it will stay in one place and will show up in your site navigation (in most themes). Most people start with an About page that introduces them to potential site visitors. It might say something like this:\n\n<blockquote>Hi there! I''m a bike messenger by day, aspiring actor by night, and this is my website. I live in Los Angeles, have a great dog named Jack, and I like pi&#241;a coladas. (And gettin'' caught in the rain.)</blockquote>\n\n...or something like this:\n\n<blockquote>The XYZ Doohickey Company was founded in 1971, and has been providing quality doohickeys to the public ever since. Located in Gotham City, XYZ employs over 2,000 people and does all kinds of awesome things for the Gotham community.</blockquote>\n\nAs a new WordPress user, you should go to <a href="http://localhost/wordpress/wp-admin/">your dashboard</a> to delete this page and create new pages for your content. Have fun!', 'Sample Page', '', 'publish', 'closed', 'open', '', 'sample-page', '', '', '2016-01-27 08:37:47', '2016-01-27 08:37:47', '', 0, 'http://localhost/wordpress/?page_id=2', 0, 'page', '', 0),
(4, 1, '2016-01-27 08:40:14', '2016-01-27 08:40:14', '', 'Ganteng bro', '', 'inherit', 'open', 'closed', '', 'ppicture', '', '', '2016-01-27 08:40:32', '2016-01-27 08:40:32', '', 0, 'http://localhost/wordpress/wp-content/uploads/2016/01/PPicture.jpg', 0, 'attachment', 'image/jpeg', 0),
(5, 1, '2016-01-27 08:41:17', '2016-01-27 08:41:17', 'http://localhost/wordpress/wp-content/uploads/2016/01/cropped-PPicture.jpg', 'cropped-PPicture.jpg', '', 'inherit', 'open', 'closed', '', 'cropped-ppicture-jpg', '', '', '2016-01-27 08:41:17', '2016-01-27 08:41:17', '', 0, 'http://localhost/wordpress/wp-content/uploads/2016/01/cropped-PPicture.jpg', 0, 'attachment', 'image/jpeg', 0),
(6, 1, '2016-01-27 08:42:49', '2016-01-27 08:42:49', '', 'cropped-cropped-PPicture.jpg', '', 'inherit', 'open', 'closed', '', 'cropped-cropped-ppicture-jpg', '', '', '2016-01-27 08:42:49', '2016-01-27 08:42:49', '', 0, 'http://localhost/wordpress/wp-content/uploads/2016/01/cropped-cropped-PPicture.jpg', 0, 'attachment', 'image/jpeg', 0),
(7, 1, '2016-01-27 08:43:19', '2016-01-27 08:43:19', '', 'cropped-cropped-PPicture-1.jpg', '', 'inherit', 'open', 'closed', '', 'cropped-cropped-ppicture-1-jpg', '', '', '2016-01-27 08:43:19', '2016-01-27 08:43:19', '', 0, 'http://localhost/wordpress/wp-content/uploads/2016/01/cropped-cropped-PPicture-1.jpg', 0, 'attachment', 'image/jpeg', 0),
(8, 1, '2016-01-27 08:50:23', '0000-00-00 00:00:00', 'asdsadasdas', 'Coba new page', '', 'draft', 'closed', 'closed', '', '', '', '', '2016-01-27 08:50:23', '2016-01-27 08:50:23', '', 0, 'http://localhost/wordpress/?page_id=8', 0, 'page', '', 0),
(9, 1, '2016-01-27 08:50:23', '2016-01-27 08:50:23', 'asdsadasdas', 'Coba new page', '', 'inherit', 'closed', 'closed', '', '8-revision-v1', '', '', '2016-01-27 08:50:23', '2016-01-27 08:50:23', '', 8, 'http://localhost/wordpress/2016/01/27/8-revision-v1/', 0, 'revision', '', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `wp_term_relationships`
--

CREATE TABLE IF NOT EXISTS `wp_term_relationships` (
  `object_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_taxonomy_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  KEY `term_taxonomy_id` (`term_taxonomy_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `wp_term_relationships`
--

INSERT INTO `wp_term_relationships` (`object_id`, `term_taxonomy_id`, `term_order`) VALUES
(1, 1, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `wp_term_taxonomy`
--

CREATE TABLE IF NOT EXISTS `wp_term_taxonomy` (
  `term_taxonomy_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `term_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `taxonomy` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `count` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_taxonomy_id`),
  UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  KEY `taxonomy` (`taxonomy`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `wp_term_taxonomy`
--

INSERT INTO `wp_term_taxonomy` (`term_taxonomy_id`, `term_id`, `taxonomy`, `description`, `parent`, `count`) VALUES
(1, 1, 'category', '', 0, 1),
(2, 2, 'nav_menu', '', 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `wp_termmeta`
--

CREATE TABLE IF NOT EXISTS `wp_termmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `term_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`meta_id`),
  KEY `term_id` (`term_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `wp_terms`
--

CREATE TABLE IF NOT EXISTS `wp_terms` (
  `term_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `slug` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `term_group` bigint(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_id`),
  KEY `slug` (`slug`(191)),
  KEY `name` (`name`(191))
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `wp_terms`
--

INSERT INTO `wp_terms` (`term_id`, `name`, `slug`, `term_group`) VALUES
(1, 'Uncategorized', 'uncategorized', 0),
(2, 'Makanan', 'makanan', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `wp_usermeta`
--

CREATE TABLE IF NOT EXISTS `wp_usermeta` (
  `umeta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`umeta_id`),
  KEY `user_id` (`user_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=18 ;

--
-- Dumping data untuk tabel `wp_usermeta`
--

INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES
(1, 1, 'nickname', 'admin'),
(2, 1, 'first_name', ''),
(3, 1, 'last_name', ''),
(4, 1, 'description', ''),
(5, 1, 'rich_editing', 'true'),
(6, 1, 'comment_shortcuts', 'false'),
(7, 1, 'admin_color', 'fresh'),
(8, 1, 'use_ssl', '0'),
(9, 1, 'show_admin_bar_front', 'true'),
(10, 1, 'wp_capabilities', 'a:1:{s:13:"administrator";b:1;}'),
(11, 1, 'wp_user_level', '10'),
(12, 1, 'dismissed_wp_pointers', ''),
(13, 1, 'show_welcome_panel', '1'),
(14, 1, 'session_tokens', 'a:1:{s:64:"2c89092116de513ffab7064aa4c9ba071d5d2b76918a2321d9e5a165c4b597c2";a:4:{s:10:"expiration";i:1454475378;s:2:"ip";s:9:"127.0.0.1";s:2:"ua";s:113:"Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.97 Safari/537.36";s:5:"login";i:1454302578;}}'),
(15, 1, 'wp_dashboard_quick_press_last_post_id', '3'),
(16, 1, 'wp_user-settings', 'libraryContent=browse&editor=html'),
(17, 1, 'wp_user-settings-time', '1453884598');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wp_users`
--

CREATE TABLE IF NOT EXISTS `wp_users` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_login` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_pass` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_nicename` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_url` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`ID`),
  KEY `user_login_key` (`user_login`),
  KEY `user_nicename` (`user_nicename`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `wp_users`
--

INSERT INTO `wp_users` (`ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`) VALUES
(1, 'admin', '$P$BI9PCLMzIU0s0msmYeb.TkzpEnjc2Z/', 'admin', 'gilebro1995@gmail.com', '', '2016-01-27 08:37:47', '', 0, 'admin');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
