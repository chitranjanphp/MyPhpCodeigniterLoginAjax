-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.22-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for dic_task
CREATE DATABASE IF NOT EXISTS `dic_task` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `dic_task`;

-- Dumping structure for table dic_task.captcha
CREATE TABLE IF NOT EXISTS `captcha` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `captcha_val` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table dic_task.captcha: ~2 rows (approximately)
/*!40000 ALTER TABLE `captcha` DISABLE KEYS */;
INSERT INTO `captcha` (`id`, `captcha_val`) VALUES
	(1, 11);
/*!40000 ALTER TABLE `captcha` ENABLE KEYS */;

-- Dumping structure for table dic_task.users
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `filename` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table dic_task.users: ~2 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`user_id`, `fullname`, `username`, `email`, `mobile`, `password`, `is_active`, `created_at`, `update_at`, `filename`) VALUES
	(2, 'chitranjan kumar ranjan', 'ranjan1990', 'chitranjan21@gmail.com', '9504304862', 'MTIzNDU=', 1, '2022-11-18 14:08:35', '0000-00-00 00:00:00', ''),
	(26, 'chitranjan kumar ranjan', 'ranjan1994', 'chitranjan2@gmail.com', '9504304862', 'MTIzNDU=', 1, '2022-11-21 00:48:57', '2022-11-21 00:48:57', ''),
	(35, 'chitranjan kumar ranjan', 'demonp@ividyalaya.com', 'admin@gmail.com', '9504304862', 'MTIzNDU=', 1, '2022-11-21 09:44:30', '2022-11-21 09:44:30', 'satish_sinha.pdf');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
