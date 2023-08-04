-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table db_rekamedis.tb_dokter
CREATE TABLE IF NOT EXISTS `tb_dokter` (
  `tb_dokter_id` int(6) NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(6) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(6) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `tempat_lahir` varchar(60) NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` text NOT NULL,
  `notelp` text NOT NULL,
  `shift` varchar(40) NOT NULL,
  `terdaftar` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`tb_dokter_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dumping data for table db_rekamedis.tb_dokter: ~1 rows (approximately)
/*!40000 ALTER TABLE `tb_dokter` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_dokter` ENABLE KEYS */;

-- Dumping structure for table db_rekamedis.tb_pasien
CREATE TABLE IF NOT EXISTS `tb_pasien` (
  `tb_pasien_id` int(6) NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(6) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(6) NOT NULL,
  `nomr` varchar(60) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `tempat_lahir` varchar(60) NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` text NOT NULL,
  `notelp` text NOT NULL,
  `riwayat` text NOT NULL,
  `terdaftar` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`tb_pasien_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table db_rekamedis.tb_pasien: ~2 rows (approximately)
/*!40000 ALTER TABLE `tb_pasien` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_pasien` ENABLE KEYS */;

-- Dumping structure for table db_rekamedis.tb_reg_pasien
CREATE TABLE IF NOT EXISTS `tb_reg_pasien` (
  `tb_reg_pasien_id` int(6) NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(6) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(6) NOT NULL,
  `nopendaftaran` varchar(60) NOT NULL,
  `nomr` varchar(60) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `alamat` text NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `tb_dokter_id` int(6) NOT NULL,
  `jam_kerja` varchar(40) NOT NULL,
  `terdaftar` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`tb_reg_pasien_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dumping data for table db_rekamedis.tb_reg_pasien: ~2 rows (approximately)
/*!40000 ALTER TABLE `tb_reg_pasien` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_reg_pasien` ENABLE KEYS */;

-- Dumping structure for table db_rekamedis.tb_user
CREATE TABLE IF NOT EXISTS `tb_user` (
  `tb_user_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(256) NOT NULL,
  `telp` varchar(16) NOT NULL,
  `email` varchar(256) NOT NULL,
  `username` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `level` varchar(16) NOT NULL,
  `foto` varchar(128) NOT NULL,
  `skin` varchar(8) NOT NULL,
  `terdaftar` datetime DEFAULT NULL,
  PRIMARY KEY (`tb_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table db_rekamedis.tb_user: ~1 rows (approximately)
/*!40000 ALTER TABLE `tb_user` DISABLE KEYS */;
INSERT INTO `tb_user` (`tb_user_id`, `nama`, `telp`, `email`, `username`, `password`, `level`, `foto`, `skin`, `terdaftar`) VALUES
	(1, 'Admin', '081234567890', '', 'admin', '$2y$10$tPaAMNwz8CCTVQaJ9WSuSOA7dhXPRJW0MSL/hKzrotArgnuHbli1O', 'Administrator', 'no-image.png', 'blue', NULL);
/*!40000 ALTER TABLE `tb_user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
