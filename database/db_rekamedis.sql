-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2023 at 03:08 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_rekamedis`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_dokter`
--

CREATE TABLE `tb_dokter` (
  `tb_dokter_id` int(6) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(6) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(6) NOT NULL,
  `noinduk` char(15) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `haripraktek` varchar(50) NOT NULL,
  `shift` varchar(40) NOT NULL,
  `terdaftar` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_dokter`
--

INSERT INTO `tb_dokter` (`tb_dokter_id`, `created`, `created_by`, `updated`, `updated_by`, `noinduk`, `nama`, `haripraktek`, `shift`, `terdaftar`) VALUES
(1, '2023-08-07 06:49:04', 1, '2023-08-23 13:22:14', 1, '12345', 'dr.Shabrina Ghassani Roza', 'Senin, Selasa, Kamis', 'pagi', '2023-08-07 06:49:04'),
(2, '2023-08-16 03:54:11', 1, '2023-08-23 13:22:27', 1, '689', 'dr. Rosnur Rezeki', 'Jumat,Sabtu, Minggu', 'pagi', '2023-08-16 03:54:11');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pasien`
--

CREATE TABLE `tb_pasien` (
  `tb_pasien_id` char(6) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(6) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(6) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `tempat_lahir` varchar(60) NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` text NOT NULL,
  `notelp` char(13) NOT NULL,
  `riwayat` text NOT NULL,
  `terdaftar` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pasien`
--

INSERT INTO `tb_pasien` (`tb_pasien_id`, `created`, `created_by`, `updated`, `updated_by`, `nama`, `tempat_lahir`, `tgl_lahir`, `alamat`, `notelp`, `riwayat`, `terdaftar`) VALUES
('000002', '2023-08-15 09:05:47', 1, '2023-08-21 06:03:24', 1, 'Carudin', 'Indramayu', '2023-08-15', 'setu', '81', '-', '2023-08-15 09:05:47'),
('000003', '2023-08-19 07:29:03', 1, '2023-08-19 07:29:03', 1, 'Saniyyah Novianti', 'Jakarta', '2002-03-03', 'Permata hijau permai blok e2 no 14', '2147483647', 'Gol. obat Sulfa', '2023-08-19 07:29:03'),
('000004', '2023-08-19 17:28:11', 1, '2023-08-19 17:28:11', 1, 'Putri', 'bekasi', '1111-11-11', 'bekasi', '93830', '-', '2023-08-19 17:28:11'),
('000005', '2023-08-26 12:40:29', 1, '2023-08-26 12:40:29', 1, 'Novi', 'Bekasi', '2009-11-11', 'bekasi', '08975144084', 'tidak ada', '2023-08-26 12:40:29');

-- --------------------------------------------------------

--
-- Table structure for table `tb_reg_pasien`
--

CREATE TABLE `tb_reg_pasien` (
  `tb_reg_pasien_id` char(12) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(6) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(6) NOT NULL,
  `tb_pasien_id` char(6) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `alamat` text NOT NULL,
  `umur` int(11) DEFAULT NULL,
  `tb_dokter_id` int(6) NOT NULL,
  `jam_kerja` varchar(40) NOT NULL,
  `terdaftar` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_reg_pasien`
--

INSERT INTO `tb_reg_pasien` (`tb_reg_pasien_id`, `created`, `created_by`, `updated`, `updated_by`, `tb_pasien_id`, `nama`, `alamat`, `umur`, `tb_dokter_id`, `jam_kerja`, `terdaftar`) VALUES
('230821000001', '2023-08-21 06:05:47', 1, '2023-08-23 06:46:39', 1, '000003', 'Saniyyah Novianti', 'Permata hijau permai blok e2 no 14', 21, 2, 'malam', '2023-08-21 06:05:47'),
('230824000002', '2023-08-23 17:51:10', 1, '2023-08-23 17:51:10', 1, '000002', 'Carudin', 'setu', 0, 2, 'pagi', '2023-08-23 17:51:10'),
('230825000003', '2023-08-25 13:59:31', 2, '2023-08-25 13:59:31', 2, '000003', 'Saniyyah Novianti', 'Permata hijau permai blok e2 no 14', 21, 2, 'pagi', '2023-08-25 13:59:31'),
('230826000004', '2023-08-26 12:40:51', 1, '2023-08-26 12:40:51', 1, '000005', 'Novi', 'bekasi', 14, 1, 'malam', '2023-08-26 12:40:51');

-- --------------------------------------------------------

--
-- Table structure for table `tb_soap`
--

CREATE TABLE `tb_soap` (
  `tb_soap_id` int(11) NOT NULL,
  `tb_reg_pasien_id` char(12) NOT NULL,
  `tanggalwaktu` datetime NOT NULL,
  `tb_pasien_id` char(6) NOT NULL,
  `tb_dokter_id` int(11) NOT NULL,
  `keluhan` text NOT NULL,
  `pemeriksaan_fisik` text NOT NULL,
  `diagnosa` text NOT NULL,
  `resep` text NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_soap`
--

INSERT INTO `tb_soap` (`tb_soap_id`, `tb_reg_pasien_id`, `tanggalwaktu`, `tb_pasien_id`, `tb_dokter_id`, `keluhan`, `pemeriksaan_fisik`, `diagnosa`, `resep`, `created_by`) VALUES
(1, '230815000001', '2023-08-19 15:16:34', '000002', 1, 'Keluhan', 'Pemeriksaan Pisik', 'Diagnosa', 'Resep', 1),
(5, '230820000003', '2023-08-20 00:29:23', '000004', 2, 'panas', 'td', 'commoncold', 'cotri\r\n', 1),
(6, '230820000004', '2023-08-20 00:31:28', '000003', 1, 'Batuk', 'hsdh', 'sdfsd', 'sdfb', 1),
(7, '230815000001', '2023-08-21 12:35:32', '000002', 1, 'batuk pilek', 'bb : 50 kg', 'ispa', 'amoxciln, tera f , proxona', 1),
(9, '230825000003', '2023-08-26 18:16:13', '000003', 0, 'batuk pilek', 'bb 70', 'ispa', 'amoxcilim, teraf\r\n', 2),
(10, '230821000001', '2023-08-26 18:26:01', '000003', 0, 'panas', 's : 39\r\n', 'common cold', 'paraccetamol', 2),
(11, '230826000004', '2023-08-26 19:45:57', '000005', 0, 'radang', 's : 38', 'ispa', 'proxona, amox,', 2),
(12, '230824000002', '2023-08-26 19:48:22', '000002', 0, 'Panas ', 's : 39', 'commond cold', 'flutop c', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `tb_user_id` int(11) NOT NULL,
  `nama` varchar(256) NOT NULL,
  `telp` varchar(16) NOT NULL,
  `email` varchar(256) NOT NULL,
  `username` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `level` varchar(16) NOT NULL,
  `foto` varchar(128) NOT NULL,
  `skin` varchar(8) NOT NULL,
  `terdaftar` datetime DEFAULT NULL,
  `ref` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`tb_user_id`, `nama`, `telp`, `email`, `username`, `password`, `level`, `foto`, `skin`, `terdaftar`, `ref`) VALUES
(1, 'Admin', '081234567890', '', 'admin', '$2y$10$tPaAMNwz8CCTVQaJ9WSuSOA7dhXPRJW0MSL/hKzrotArgnuHbli1O', 'Administrator', 'no-image.png', 'blue', NULL, NULL),
(2, 'sabrina', '08975144084', 'sabrina@gmail.com', 'dokter', '$2y$10$tPaAMNwz8CCTVQaJ9WSuSOA7dhXPRJW0MSL/hKzrotArgnuHbli1O', 'Dokter', '', 'blue', '2023-08-01 00:55:05', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_dokter`
--
ALTER TABLE `tb_dokter`
  ADD PRIMARY KEY (`tb_dokter_id`) USING BTREE;

--
-- Indexes for table `tb_pasien`
--
ALTER TABLE `tb_pasien`
  ADD PRIMARY KEY (`tb_pasien_id`);

--
-- Indexes for table `tb_reg_pasien`
--
ALTER TABLE `tb_reg_pasien`
  ADD PRIMARY KEY (`tb_reg_pasien_id`) USING BTREE;

--
-- Indexes for table `tb_soap`
--
ALTER TABLE `tb_soap`
  ADD PRIMARY KEY (`tb_soap_id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`tb_user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_dokter`
--
ALTER TABLE `tb_dokter`
  MODIFY `tb_dokter_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_soap`
--
ALTER TABLE `tb_soap`
  MODIFY `tb_soap_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `tb_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
