-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.34-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for aristostar
CREATE DATABASE IF NOT EXISTS `aristostar` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `aristostar`;

-- Dumping structure for table aristostar.s_company
CREATE TABLE IF NOT EXISTS `s_company` (
  `company_id` varchar(30) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `short_name` varchar(100) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `company_address` varchar(200) NOT NULL,
  `website` varchar(100) DEFAULT NULL,
  `is_deleted` tinyint(4) DEFAULT '0',
  `created_user_id` varchar(50) NOT NULL,
  `updated_user_id` varchar(50) DEFAULT NULL,
  `date_created` datetime DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table aristostar.s_company: ~5 rows (approximately)
/*!40000 ALTER TABLE `s_company` DISABLE KEYS */;
INSERT INTO `s_company` (`company_id`, `company_name`, `short_name`, `phone`, `company_address`, `website`, `is_deleted`, `created_user_id`, `updated_user_id`, `date_created`, `date_updated`) VALUES
	('1d07f9bac0085b71a0eaf221c', 'Oracle', 'Oracle', '+971563444212', 'Dubai Internet City', 'www.oracle.com', 0, '804625ba55805b557db33dea5', '804625ba55805b557db33dea5', '2018-08-13 19:16:58', '2018-08-13 19:17:38'),
	('64e8a4f601c35b59ba14144ec', 'Samatech', 'Sama', '+971561231233', 'Dubai Internet City', 'www.samatech.ae', 1, '804625ba55805b557db33dea5', '804625ba55805b557db33dea5', '2018-07-26 16:09:56', '2018-08-14 00:11:15'),
	('6563af920ed25b59a5a24cdca', 'SplashTours', 'Splash', '+971561233123', 'Ibn Batuta Gate', 'splashtours.ae', 1, '804625ba55805b557db33dea5', '804625ba55805b557db33dea5', '2018-07-26 14:42:42', '2018-08-14 00:11:28'),
	('a2b868fb39f05b59a1e6c3d7d', 'Accenture', 'Accenture', '+971562123121', 'Sheikh Zayed Road', 'www.accenture.com', 0, '804625ba55805b557db33dea5', '804625ba55805b557db33dea5', '2018-07-26 14:26:46', '2018-08-14 00:08:29'),
	('aa2c9d1904cc5b59a64501fc3', 'SharafDG', 'Sharaf', '+971563123312', 'Sharaf DF', 'www.sharafDG.ae', 0, '804625ba55805b557db33dea5', NULL, '2018-07-26 14:45:25', '2018-07-26 14:56:11'),
	('bba401ddc7015b59a8a3b422a', 'Tech Advisor', 'Advisor', '+971563412334', 'Dubai Internet City', 'www.advisor.ae', 0, '804625ba55805b557db33dea5', '804625ba55805b557db33dea5', '2018-07-26 14:55:31', '2018-08-14 00:08:22');
/*!40000 ALTER TABLE `s_company` ENABLE KEYS */;

-- Dumping structure for table aristostar.s_employee
CREATE TABLE IF NOT EXISTS `s_employee` (
  `employee_id` varchar(30) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `company_id` varchar(100) NOT NULL,
  `date_created` datetime DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_user_id` varchar(50) NOT NULL,
  `updated_user_id` varchar(50) DEFAULT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`employee_id`),
  KEY `company_id` (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table aristostar.s_employee: ~3 rows (approximately)
/*!40000 ALTER TABLE `s_employee` DISABLE KEYS */;
INSERT INTO `s_employee` (`employee_id`, `first_name`, `last_name`, `email_address`, `designation`, `company_id`, `date_created`, `date_updated`, `created_user_id`, `updated_user_id`, `is_deleted`) VALUES
	('00c664d57bd85b71bbeaa1281', 'Khian', 'Lim', 'khian@samatech.com', 'Software Engineer', '64e8a4f601c35b59ba14144ec', '2018-08-13 21:12:10', '2018-08-13 23:50:13', '804625ba55805b557db33dea5', '804625ba55805b557db33dea5', 1),
	('453213c8294e5b71bad639aff', 'Gerald', 'Basilio', 'gerald@accenture.com', 'IT Manager', 'a2b868fb39f05b59a1e6c3d7d', '2018-08-13 21:07:34', '2018-08-13 23:27:06', '804625ba55805b557db33dea5', '804625ba55805b557db33dea5', 0),
	('6707aa91508f5b71df9d14749', 'Honeybee', 'Bride', 'honeybee@accenture.com', 'Project Coordinator', 'a2b868fb39f05b59a1e6c3d7d', '2018-08-13 23:44:29', '2018-08-15 21:58:55', '804625ba55805b557db33dea5', '804625ba55805b557db33dea5', 0),
	('a0cc2b15428c5b7469828c151', 'Royette', 'Angerson', 'royette@oracle.com', 'It Analyst', '1d07f9bac0085b71a0eaf221c', '2018-08-15 21:57:22', '2018-08-15 21:57:22', '804625ba55805b557db33dea5', NULL, 0);
/*!40000 ALTER TABLE `s_employee` ENABLE KEYS */;

-- Dumping structure for table aristostar.s_users
CREATE TABLE IF NOT EXISTS `s_users` (
  `user_id` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email_address` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `contact_number` varchar(50) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `role` tinyint(2) NOT NULL,
  `created_user_id` varchar(50) NOT NULL,
  `updated_user_id` varchar(50) NOT NULL,
  `is_deleted` tinyint(4) DEFAULT '0',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table aristostar.s_users: ~2 rows (approximately)
/*!40000 ALTER TABLE `s_users` DISABLE KEYS */;
INSERT INTO `s_users` (`user_id`, `first_name`, `last_name`, `email_address`, `password`, `contact_number`, `designation`, `role`, `created_user_id`, `updated_user_id`, `is_deleted`, `date_created`, `date_updated`) VALUES
	('015c7cf625cd5b7194671ea52', 'Yareld', 'Angerson', 'yerald@aristostar.com', '$2a$10$bbdbf02a918c9948166d7uSzCWQV3em2ye0uPSBt0fM7pggH6CnIy', '+971563412311', 'Sales Representative', 3, '804625ba55805b557db33dea5', '804625ba55805b557db33dea5', 0, '2018-08-13 18:23:35', '2018-08-13 18:23:48'),
	('804625ba55805b557db33dea5', 'Administrator', '', 'admin@aristostar.com', '$2a$10$2404bbac308504fe53556eTuyu1gFmWIWZ/ARNNFYy5qRVPjWCGJi', '+971555192830', 'CEO', 1, '804625ba55805b557db33dea5', '804625ba55805b557db33dea5', 0, '2018-07-23 11:02:26', '2018-08-13 23:58:02'),
	('b9a5b9dc2a565b718e287c49e', 'Marife', 'Zhian', 'marife@aristostar.com', '$2a$10$7304cbf7ce35f8441825fuRqT2wi3o9nr2BQ2St1ACflzYQ2KzO6u', '+971531234511', 'Sales Representative', 3, '804625ba55805b557db33dea5', '804625ba55805b557db33dea5', 1, '2018-08-13 17:56:56', '2018-08-14 00:14:28');
/*!40000 ALTER TABLE `s_users` ENABLE KEYS */;

-- Dumping structure for table aristostar.s_users_role
CREATE TABLE IF NOT EXISTS `s_users_role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(50) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table aristostar.s_users_role: ~3 rows (approximately)
/*!40000 ALTER TABLE `s_users_role` DISABLE KEYS */;
INSERT INTO `s_users_role` (`role_id`, `role`) VALUES
	(1, 'Administrator'),
	(2, 'Company'),
	(3, 'Staff');
/*!40000 ALTER TABLE `s_users_role` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
