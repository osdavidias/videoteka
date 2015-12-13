-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.1.0.4867
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for kolekcija
CREATE DATABASE IF NOT EXISTS `kolekcija` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `kolekcija`;


-- Dumping structure for table kolekcija.filmovi
CREATE TABLE IF NOT EXISTS `filmovi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `naslov` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `id_zanr` int(11) NOT NULL DEFAULT '0',
  `godina` int(11) NOT NULL DEFAULT '0',
  `trajanje` int(11) NOT NULL DEFAULT '0',
  `slika` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `naslov` (`naslov`),
  KEY `id_zanr` (`id_zanr`),
  CONSTRAINT `FK_filmovi_zanr` FOREIGN KEY (`id_zanr`) REFERENCES `zanr` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.


-- Dumping structure for table kolekcija.zanr
CREATE TABLE IF NOT EXISTS `zanr` (
  `id` int(11) NOT NULL,
  `naziv` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
