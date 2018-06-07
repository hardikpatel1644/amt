-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.26-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table amt_test.maintainance
CREATE TABLE IF NOT EXISTS `maintainance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_vehicle` int(11) NOT NULL DEFAULT '0',
  `maintainance_name` enum('oil_change','tire_rotation','summer_tires','winter_tires','repair_and_maintenance','car_washing','wheel_alignment','break_inspection') COLLATE utf8_bin DEFAULT NULL,
  `cost` float NOT NULL DEFAULT '0',
  `description` text COLLATE utf8_bin,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active` enum('1','0') COLLATE utf8_bin NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id_vehicle` (`id_vehicle`),
  CONSTRAINT `fk_id_vehicle` FOREIGN KEY (`id_vehicle`) REFERENCES `vehicle` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table amt_test.maintainance: ~0 rows (approximately)
DELETE FROM `maintainance`;
/*!40000 ALTER TABLE `maintainance` DISABLE KEYS */;
/*!40000 ALTER TABLE `maintainance` ENABLE KEYS */;

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
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table amt_test.user: ~21 rows (approximately)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `user_type`, `first_name`, `last_name`, `email`, `password`, `salt`, `token`, `created_at`, `updated_at`, `active`) VALUES
	(32, 'admin', 'Hardikkumar', 'Patel', 'hpca1644@gmail.com', '883cc717df533db5a132fa2e5289e49f23f0edde', 'a3307fa9e38b68bb07ef6f0957658108', 'fc988449032127acb593fe648ff87143', '2018-06-06 15:52:13', '2018-06-07 10:45:09', '1'),
	(34, 'admin', 'Hardikkumar12334', 'Patel123123', 'hpca164412@gmail.com', '574dd9b5aa243442df96ba6c4a907701b175d5cc', 'c7f55c418b68d55858abdc0f58cdaf0b', NULL, '2018-06-06 16:51:27', '2018-06-06 16:51:27', '1'),
	(35, 'admin', 'Hardikkumar12334', 'Patel123123', 'hpca1644122213213@gmail.com', '7f25acbec159774a2fedde98fcb2bc2e8197e30b', 'dba3f2d061db55b7cc152746118e0c70', NULL, '2018-06-06 17:01:19', '2018-06-06 17:01:19', '1'),
	(36, 'admin', 'Hardikkumar12334', 'Patel123123', 'hpca1644122213213@gmail.com', '7f25acbec159774a2fedde98fcb2bc2e8197e30b', 'dba3f2d061db55b7cc152746118e0c70', NULL, '2018-06-06 17:01:28', '2018-06-06 17:01:28', '1'),
	(37, 'admin', 'Hardikkumar12334', 'Patel123123', 'hpca1644122213213@gmail.com', '7f25acbec159774a2fedde98fcb2bc2e8197e30b', 'dba3f2d061db55b7cc152746118e0c70', NULL, '2018-06-06 17:04:46', '2018-06-06 17:04:46', '1'),
	(38, 'admin', 'Hardikkumar', 'Patel', 'hpca12121212112122323@gmail.com', '1d1d0be7c151193c3009368fdb90453558ff56cf', '379b4086376cb663f905af1f7905c283', NULL, '2018-06-06 17:14:12', '2018-06-06 17:28:13', '1'),
	(39, 'admin', 'Hardikkumar12334', 'Patel123123', 'hpca@gmail.com', '1d1d0be7c151193c3009368fdb90453558ff56cf', '379b4086376cb663f905af1f7905c283', NULL, '2018-06-06 17:26:30', '2018-06-06 17:26:30', '1'),
	(45, 'admin', 'Entered By phpunit', 'Entered by phpunit', 'phpunit@php.com', '', '', NULL, '2018-06-07 17:14:03', '2018-06-07 17:14:03', '1'),
	(46, 'admin', 'Entered By phpunit', 'Entered by phpunit', 'phpunit@php.com', '', '', NULL, '2018-06-07 17:14:14', '2018-06-07 17:14:14', '1'),
	(47, 'admin', 'Entered By phpunit', 'Entered by phpunit', 'phpunit@php.com', '', '', NULL, '2018-06-07 17:14:23', '2018-06-07 17:14:23', '1'),
	(48, 'admin', 'Entered By phpunit', 'Entered by phpunit', 'phpunit@php.com', '', '', NULL, '2018-06-07 17:14:51', '2018-06-07 17:14:51', '1'),
	(49, 'customer', 'Updated  By phpunit', 'Updated by phpunit', 'Updatedphpunit@php.com', '', '', NULL, '2018-06-07 17:18:56', '2018-06-07 17:28:30', '1'),
	(51, 'admin', 'Entered By phpunit', 'Entered by phpunit', 'phpunit@php.com', '', '', NULL, '2018-06-07 17:22:26', '2018-06-07 17:22:26', '1'),
	(52, 'admin', 'Entered By phpunit', 'Entered by phpunit', 'phpunit@php.com', '', '', NULL, '2018-06-07 17:22:59', '2018-06-07 17:22:59', '1'),
	(53, 'admin', 'Entered By phpunit', 'Entered by phpunit', 'phpunit@php.com', '', '', NULL, '2018-06-07 17:23:42', '2018-06-07 17:23:42', '1'),
	(54, 'admin', 'Entered By phpunit', 'Entered by phpunit', 'phpunit@php.com', '', '', NULL, '2018-06-07 17:24:49', '2018-06-07 17:24:49', '1'),
	(55, 'admin', 'Entered By phpunit', 'Entered by phpunit', 'phpunit@php.com', '', '', NULL, '2018-06-07 17:25:28', '2018-06-07 17:25:28', '1'),
	(56, 'admin', 'Entered By phpunit', 'Entered by phpunit', 'phpunit@php.com', '', '', NULL, '2018-06-07 17:26:20', '2018-06-07 17:26:20', '1'),
	(57, 'admin', 'Entered By phpunit', 'Entered by phpunit', 'phpunit@php.com', 'test123', '', NULL, '2018-06-07 17:28:30', '2018-06-07 17:28:30', '1'),
	(58, 'admin', 'Entered By phpunit', 'Entered by phpunit', 'phpunit@php.com', 'test123', '', NULL, '2018-06-07 17:33:42', '2018-06-07 17:33:42', '1'),
	(59, 'admin', 'Entered By phpunit', 'Entered by phpunit', 'phpunit@php.com', 'test123', '', NULL, '2018-06-07 17:34:41', '2018-06-07 17:34:41', '1');
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table amt_test.vehicle: ~2 rows (approximately)
DELETE FROM `vehicle`;
/*!40000 ALTER TABLE `vehicle` DISABLE KEYS */;
INSERT INTO `vehicle` (`id`, `id_user`, `company`, `model`, `model_year`, `vehicle_type`, `licence_plate`, `color`, `vin_no`, `transmission`, `body_type`, `last_odometer`, `created_at`, `updated_at`, `active`) VALUES
	(13, 32, 'Test12Toekn', 'Test12Toekn', 2006, '', 'BQR456', 'Black', '4TWEEG344GEDFSF234434', 'automatic', 'sedan', 120000, '2018-06-07 11:04:19', '2018-06-07 11:04:19', '1'),
	(14, 32, 'Test12Toekn', 'Test12Toekn', 2006, '', 'BQR456', 'Black', '4TWEEG344GEDFSF234434', 'automatic', 'sedan', 120000, '2018-06-07 11:05:40', '2018-06-07 11:05:40', '1');
/*!40000 ALTER TABLE `vehicle` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
