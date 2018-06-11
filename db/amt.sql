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

-- Dumping structure for table amt.maintenance
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table amt.maintenance: ~4 rows (approximately)
DELETE FROM `maintenance`;
/*!40000 ALTER TABLE `maintenance` DISABLE KEYS */;
INSERT INTO `maintenance` (`id`, `id_vehicle`, `maintenance_name`, `cost`, `description`, `created_at`, `updated_at`, `active`) VALUES
	(12, 12, 'oil_change', 234, 'test', '2018-06-10 23:00:42', '2018-06-10 23:00:42', '1'),
	(13, 16, 'summer_tires', 2343, 'test', '2018-06-10 23:54:02', '2018-06-10 23:54:02', '1'),
	(14, 12, 'tire_rotation', 20, 'tire_rotation', '2018-06-10 23:59:23', '2018-06-11 00:02:08', '1');
/*!40000 ALTER TABLE `maintenance` ENABLE KEYS */;

-- Dumping structure for table amt.user
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
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table amt.user: ~4 rows (approximately)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `user_type`, `first_name`, `last_name`, `email`, `password`, `salt`, `token`, `created_at`, `updated_at`, `active`) VALUES
	(32, 'admin', 'Hardikkumar', 'Patel', 'hpca1644@gmail.com', '883cc717df533db5a132fa2e5289e49f23f0edde', 'a3307fa9e38b68bb07ef6f0957658108', '4a379e83fad6cff6703b92d246d58a84', '2018-06-06 15:52:13', '2018-06-10 22:56:26', '1'),
	(40, 'admin', 'testuser1', 'testuser1', 'testuser1@mailinator.com', '6b75259d2f72e3c5011b5404039b53280413e394', '77f599029542ae979a179de33fafa4d3', 'b368b1c274905e4c3c29a1906e461281', '2018-06-10 22:57:07', '2018-06-10 23:55:18', '1'),
	(41, 'customer', 'testuser2', 'testuser2', 'testuser2@mailinator.com', '43ad8c9205bc1cb163183315e74e9ffaf2ba5125', 'd5ca1dff8d086e9526417fba1fb1acf4', NULL, '2018-06-10 22:57:45', '2018-06-10 22:57:45', '1'),
	(42, 'admin', 'Hardikkumar12334', 'Patel123123', 'hpca@gmail.com', '1d1d0be7c151193c3009368fdb90453558ff56cf', '379b4086376cb663f905af1f7905c283', NULL, '2018-06-10 23:47:00', '2018-06-10 23:47:00', '1');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- Dumping structure for table amt.vehicle
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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table amt.vehicle: ~5 rows (approximately)
DELETE FROM `vehicle`;
/*!40000 ALTER TABLE `vehicle` DISABLE KEYS */;
INSERT INTO `vehicle` (`id`, `id_user`, `company`, `model`, `model_year`, `vehicle_type`, `licence_plate`, `color`, `vin_no`, `transmission`, `body_type`, `last_odometer`, `created_at`, `updated_at`, `active`) VALUES
	(12, 40, 'Acura', 'CSX', 2008, 'gas', '4565455', 'Siver', 'HHJ34435634FDFD', 'automatic', 'sedan', 20000, '2018-06-10 22:59:37', '2018-06-10 22:59:37', '1'),
	(13, 40, 'Honda', 'Civic', 2007, 'electric', '23434234', 'Black', '45452343fdsfff', 'manual', 'sedan', 3242444, '2018-06-10 23:00:21', '2018-06-10 23:00:21', '1'),
	(16, 40, 'Ford', 'fusion', 2018, 'electric', '324324', 'Red', 'FSSASAS232323', 'manual', 'sedan', 43434, '2018-06-10 23:53:37', '2018-06-10 23:53:37', '1'),
	(17, 40, 'Honda', 'Civic', 2012, 'gas', 'BQR456', 'Black', '4TWEEG344GEDFSF234434', 'automatic', 'sedan', 120000, '2018-06-10 23:55:28', '2018-06-10 23:57:56', '1'),
	(18, 40, 'Test12Toekn', 'Test12Toekn', 2006, '', 'BQR456', 'Black', '4TWEEG344GEDFSF234434', 'automatic', 'sedan', 120000, '2018-06-10 23:56:11', '2018-06-10 23:56:11', '1');
/*!40000 ALTER TABLE `vehicle` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
