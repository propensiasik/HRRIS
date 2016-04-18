-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 18 Apr 2016 pada 15.50
-- Versi Server: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

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
  PRIMARY KEY (`id_applicant`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `applicant`
--

INSERT INTO `applicant` (`id_applicant`, `nama_applicant`, `emai_applicant`, `alamat`, `gender`, `no_hp`, `universitas`, `jurusan`, `ipk`, `thn_lulus`, `CV`, `portofolio`, `text`) VALUES
('APP01', 'Alice', 'alice@gmail.com', 'Jakarta', 0, '0857322352', 'UI', 'Sistem Informasi', '3,7', 2014, 0x687474703a2f2f78797a2e636f6d, '', 'aaaa'),
('APP02', 'Bob', 'bob@gmail.com', 'Jakarta', 0, '0857322352', 'UI', 'Ilmu Komputer', '3,5', 2014, 0x687474703a2f2f78797a2e636f6d, '', 'bbbb'),
('APP03', 'Charlie', 'charlie@gmail.com', 'Depok', 0, '0857322352', 'ITB', 'Teknik Elektro', '3,2', 2013, 0x687474703a2f2f78797a2e636f6d, 0x687474703a2f2f78797a2e636f6d, 'ccc'),
('APP04', 'Darwin', 'darwin@gmail.com', 'Bogor', 0, '0857322352', 'Gunadarma', 'Ilmu Komputer', '2,8', 2015, 0x687474703a2f2f78797a2e636f6d, '', 'dddd'),
('APP05', 'Edward', 'edward@gmail.com', 'Bandung', 0, '0857322352', 'UI', 'Sistem Informasi', '3,2', 2015, 0x687474703a2f2f78797a2e636f6d, '', 'eeee'),
('APP06', 'Felix', 'felix@gmail.com', 'Bogor', 0, '0857322352', 'UI', 'Ilmu Komputer', '3,2', 2012, 0x687474703a2f2f78797a2e636f6d, '', 'ffff'),
('APP07', 'George', 'george@gmail.com', 'Bekasi', 0, '0857322352', 'UGM', 'Teknik Informatika', '3,3', 2012, 0x687474703a2f2f78797a2e636f6d, 0x687474703a2f2f78797a2e636f6d, 'ggg'),
('APP08', 'Hans', 'hans@gmail.com', 'Jakarta', 0, '0857322352', 'Binus', 'Teknik Informatika', '2,9', 2011, 0x687474703a2f2f78797a2e636f6d, '', 'hhhh'),
('APP09', 'Iris', 'iris@gmail.com', 'Tangerang', 0, '0857322352', 'UI', 'Ilmu Komputer', '2,7', 2010, 0x687474703a2f2f78797a2e636f6d, '', 'iiii'),
('APP10', 'Jessica', 'jessica@gmail.com', 'Jakarta', 0, '0857322352', 'Gunadarma', 'Ilmu Komputer', '2,4', 2014, 0x687474703a2f2f78797a2e636f6d, 0x687474703a2f2f78797a2e636f6d, 'jjj');

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
('AS02', '2016-03-24', 'lili', 'ferrisaputra@gmail.com', 1, 'JV02', '08:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('AS03', '2016-03-24', 'lulu', 'khalilahunafa@gmail.com', 0, 'JV03', '09:10:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('AS04', '2016-03-24', '', 'nabilaclydea@gmail.com', 0, 'JV01', '08:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('AS05', '2016-03-26', '', 'anestanggang@gmail.com', 0, 'JV03', '12:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('AS06', '2016-03-24', 'assasa', 'ferrisaputra@gmail.com', 1, 'JV02', '10:00:00', NULL, NULL),
('AS07', '2016-03-24', 'assasa', 'ferrisaputra@gmail.com', 1, 'JV02', '13:00:00', NULL, NULL),
('AS08', '2016-03-25', 'assasa', 'ferrisaputra@gmail.com', 1, 'JV02', '10:00:00', NULL, NULL),
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
('IN02', 'Meet', '', 'APP04', 'AS02', '1', '2016-04-18 14:43:56', '2016-04-18 14:43:56'),
('IN03', 'Skype', '', 'APP06', 'AS06', '1', '2016-04-18 14:51:29', '2016-04-18 14:51:29'),
('IN04', 'Meet', '', 'APP10', 'AS08', '1', '2016-04-18 14:51:51', '2016-04-18 14:51:51');

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
('IN02', 'anestanggang@gmail.com', '2016-04-18 14:43:56', '2016-04-18 14:43:56'),
('IN02', 'ferrisaputra@gmail.com', '2016-04-18 14:43:56', '2016-04-18 14:43:56'),
('IN03', 'anestanggang@gmail.com', '2016-04-18 14:51:29', '2016-04-18 14:51:29'),
('IN03', 'ferrisaputra@gmail.com', '2016-04-18 14:51:29', '2016-04-18 14:51:29'),
('IN04', 'anestanggang@gmail.com', '2016-04-18 14:51:51', '2016-04-18 14:51:51'),
('IN04', 'ferrisaputra@gmail.com', '2016-04-18 14:51:51', '2016-04-18 14:51:51');

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
('JV09', 'diniseprilia@gmail.com'),
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
('JV01', 'nabilaclydea@gmail.com');

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
  PRIMARY KEY (`id_job_vacant`),
  KEY `id_divisi` (`id_divisi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `job_vacant`
--

INSERT INTO `job_vacant` (`id_job_vacant`, `posisi_ditawarkan`, `jml_kebutuhan`, `requirement`, `is_open`, `id_divisi`) VALUES
('JV01', 'UI/UX Developer', 3, 'lala', 1, 'DIV03'),
('JV02', 'Lead Programmer', 2, 'lala', 1, 'DIV06'),
('JV03', 'Junior Analyst', 3, 'alal', 1, 'DIV04'),
('JV04', 'Front end Programmer', 4, 'lala', 0, 'DIV06'),
('JV05', 'Back end Programmer', 5, 'lala', 1, 'DIV06'),
('JV06', 'Senior Analyst', 3, 'lala', 0, 'DIV04'),
('JV07', 'Mobile Developer', 3, 'Plis berhasil', 0, 'DIV06'),
('JV08', 'Old Analyst', 1, 'IPK 5', 0, 'DIV04'),
('JV09', '', 0, '', 0, 'DIV04');

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
-- Struktur dari tabel `report`
--

CREATE TABLE IF NOT EXISTS `report` (
  `id_report` char(10) NOT NULL,
  `isi_report` text,
  `tgl_last_update` date NOT NULL,
  `id_applicant` char(10) NOT NULL,
  `email_users` varchar(70) NOT NULL,
  `id_report_form` char(10) NOT NULL,
  PRIMARY KEY (`id_report`),
  UNIQUE KEY `id_applicant` (`id_applicant`,`email_users`),
  KEY `email_users` (`email_users`),
  KEY `id_report_form` (`id_report_form`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `report`
--

INSERT INTO `report` (`id_report`, `isi_report`, `tgl_last_update`, `id_applicant`, `email_users`, `id_report_form`) VALUES
('REP01', 'rapot khalila 1', '2016-03-29', 'APP01', 'khalilahunafa@gmail.com', 'RF01'),
('REP02', 'rapot khalila 2', '2016-03-30', 'APP03', 'khalilahunafa@gmail.com', 'RF02'),
('REP03', 'rapot anes 1', '2016-03-30', 'APP01', 'anestanggang@gmail.com', 'RF01'),
('REP04', 'rapot anss 2', '2016-03-31', 'APP03', 'anestanggang@gmail.com', 'RF02'),
('REP05', 'rapot dini 1', '2016-03-31', 'APP03', 'diniseprilia@gmail.com', 'RF02'),
('REP06', 'rapot nacil 1', '2016-04-04', 'APP01', 'nabilaclydea@gmail.com', 'RF01');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

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
(30, '2016-04-18 07:45:24', '2016-04-18 07:45:24', 'SLA01', 'S03', 'APP04', 'JV05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `email_users` varchar(70) NOT NULL,
  `nama_users` varchar(70) NOT NULL,
  `posisi` varchar(70) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `id_divisi` char(10) NOT NULL,
  `password` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`email_users`),
  KEY `id_divisi` (`id_divisi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`email_users`, `nama_users`, `posisi`, `is_admin`, `id_divisi`, `password`) VALUES
('anestanggang@gmail.com', 'Yohanes', 'Head', 0, 'DIV02', '123456'),
('diniseprilia@gmail.com', 'Dini Seprilia', 'Head', 0, 'DIV04', '234567'),
('ferrisaputra@gmail.com', 'Ferri Saputra', 'Head', 0, 'DIV06', '345678'),
('khalila9616@gmail.com', 'Lala Lili', 'Staff', 1, 'DIV06', 'aaaaa'),
('khalilahunafa@gmail.com', 'Khalila Hunafa', 'COO', 0, 'DIV01', 'admin'),
('nabilaclydea@gmail.com', 'Nabila Clydea', 'Head', 0, 'DIV03', 'aaaaa');

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
