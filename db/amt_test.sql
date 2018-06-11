-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.25-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table amt_test.maintenance
CREATE TABLE IF NOT EXISTS `maintenance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_vehicle` int(11) NOT NULL DEFAULT '0',
  `maintenance_name` enum('oil_change','tire_rotation','summer_tires','winter_tires','repair_and_maintenance','car_washing','wheel_alignment','break_inspection') COLLATE utf8_bin DEFAULT NULL,
  `cost` float NOT NULL DEFAULT '0',
  `description` text COLLATE utf8_bin,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active` enum('1','0') COLLATE utf8_bin NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id_vehicle` (`id_vehicle`),
  CONSTRAINT `fk_id_vehicle` FOREIGN KEY (`id_vehicle`) REFERENCES `vehicle` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table amt_test.maintenance: ~3 rows (approximately)
DELETE FROM `maintenance`;
/*!40000 ALTER TABLE `maintenance` DISABLE KEYS */;
INSERT INTO `maintenance` (`id`, `id_vehicle`, `maintenance_name`, `cost`, `description`, `created_at`, `updated_at`, `active`) VALUES
	(35, 13, 'break_inspection', 33, '66', '2018-06-10 18:46:13', '2018-06-10 18:55:48', '1'),
	(36, 43, 'summer_tires', 23, 'Oil change', '2018-06-10 22:53:00', '2018-06-10 22:53:00', '1'),
	(37, 43, 'winter_tires', 56, 'Test', '2018-06-10 22:54:23', '2018-06-10 22:54:23', '1');
/*!40000 ALTER TABLE `maintenance` ENABLE KEYS */;

-- Dumping structure for table amt_test.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type` enum('admin','customer') COLLATE utf8_bin DEFAULT NULL,
  `first_name` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `last_name` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `salt` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `token` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active` enum('1','0') COLLATE utf8_bin DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table amt_test.user: ~2 rows (approximately)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `user_type`, `first_name`, `last_name`, `email`, `password`, `salt`, `token`, `created_at`, `updated_at`, `active`) VALUES
	(32, 'admin', 'Hardikkumar', 'Patel', 'hpca1644@gmail.com', '883cc717df533db5a132fa2e5289e49f23f0edde', 'a3307fa9e38b68bb07ef6f0957658108', '05b73ba5438b7e9bf85273ed6ef568b8', '2018-06-06 15:52:13', '2018-06-10 18:57:09', '1'),
	(102, 'customer', 'Testuser1', 'Testuser1', 'testuser1@mailinator.com', '6b75259d2f72e3c5011b5404039b53280413e394', '77f599029542ae979a179de33fafa4d3', '459ce1bca919f71d78f3a25f91bee903', '2018-06-10 22:50:32', '2018-06-10 22:51:08', '1');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- Dumping structure for table amt_test.vehicle
CREATE TABLE IF NOT EXISTS `vehicle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT '0',
  `company` varchar(50) COLLATE utf8_bin DEFAULT '0',
  `model` varchar(50) COLLATE utf8_bin DEFAULT '0',
  `model_year` int(4) DEFAULT '0',
  `vehicle_type` enum('electric','gas','diesel') COLLATE utf8_bin DEFAULT NULL,
  `licence_plate` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `color` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `vin_no` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `transmission` enum('automatic','manual') COLLATE utf8_bin DEFAULT NULL,
  `body_type` enum('suv','sedan','van','truck','hatchback') COLLATE utf8_bin DEFAULT NULL,
  `last_odometer` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active` enum('1','0') COLLATE utf8_bin DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `fk_id_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table amt_test.vehicle: ~3 rows (approximately)
DELETE FROM `vehicle`;
/*!40000 ALTER TABLE `vehicle` DISABLE KEYS */;
INSERT INTO `vehicle` (`id`, `id_user`, `company`, `model`, `model_year`, `vehicle_type`, `licence_plate`, `color`, `vin_no`, `transmission`, `body_type`, `last_odometer`, `created_at`, `updated_at`, `active`) VALUES
	(13, 32, 'Honda', 'Civic', 2018, 'gas', 'ZZZ454', 'Black', '4TWEEG344GEDFSF234434', 'automatic', 'sedan', 120000, '2018-06-07 11:04:19', '2018-06-07 23:30:14', '1'),
	(42, 32, 'Acura', 'CSX', 2006, 'gas', '4545454', 'Silver', '5454543423234', 'automatic', 'sedan', 2147483647, '2018-06-09 01:23:43', '2018-06-09 01:23:43', '1'),
	(43, 102, 'Honda', 'Civic', 2017, 'electric', '34455334', 'Black', 'wewerewrwrew2343244', 'automatic', 'sedan', 3000, '2018-06-10 22:52:20', '2018-06-10 22:52:20', '1');
/*!40000 ALTER TABLE `vehicle` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
