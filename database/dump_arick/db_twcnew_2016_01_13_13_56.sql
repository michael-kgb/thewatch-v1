-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2016 at 07:55 AM
-- Server version: 5.6.26
-- PHP Version: 5.5.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_twcnew`
--

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `id` int(11) NOT NULL,
  `fullname` varchar(20) NOT NULL,
  `module` varchar(20) NOT NULL,
  `action` varchar(10) NOT NULL,
  `id_onChanged` int(11) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `fullname`, `module`, `action`, `id_onChanged`, `date_time`) VALUES
(3, 'Hari', 'products', 'create', 1, '2016-01-12 06:18:42'),
(4, 'Hari', 'user', 'create', 9, '2016-01-12 06:51:40'),
(5, 'Hari', 'user', 'create', 10, '2016-01-12 07:06:16'),
(7, 'Hari', 'group', 'create', 5, '2016-01-12 07:11:50'),
(8, 'Hari', 'module', 'create', 8, '2016-01-12 07:15:54'),
(9, 'Hari', 'group', 'update', 1, '2016-01-12 07:43:06'),
(10, 'Hari', 'group', 'update', 1, '2016-01-12 07:43:17'),
(11, 'Hari', 'module', 'update', 1, '2016-01-12 07:50:50'),
(12, 'Hari', 'module', 'update', 1, '2016-01-12 07:50:58'),
(13, 'Hari', 'user', 'create', 11, '2016-01-12 08:33:52'),
(14, 'Hari', 'module', 'create', 9, '2016-01-12 08:35:49'),
(15, 'Hari', 'module', 'create', 10, '2016-01-12 08:36:44'),
(16, 'marketing', 'user', 'create', 12, '2016-01-12 08:59:59'),
(17, 'marketing', 'user', 'create', 13, '2016-01-12 09:03:11'),
(18, 'marketing', 'departement', 'create', 2, '2016-01-12 09:14:00'),
(19, 'marketing', 'user', 'create', 14, '2016-01-12 09:40:06'),
(20, 'marketing', 'user', 'create', 17, '2016-01-12 10:00:28'),
(21, 'marketing', 'user', 'create', 20, '2016-01-13 03:39:27'),
(22, 'marketing', 'group', 'create', 6, '2016-01-13 03:43:56'),
(23, 'marketing', 'group', 'update', 1, '2016-01-13 03:46:11'),
(24, 'marketing', 'group', 'update', 1, '2016-01-13 03:46:20'),
(25, 'marketing', 'module', 'create', 11, '2016-01-13 03:50:23'),
(26, 'marketing', 'module', 'update', 1, '2016-01-13 03:51:12'),
(27, 'marketing', 'module', 'update', 1, '2016-01-13 03:51:27'),
(28, 'marketing', 'departement', 'create', 4, '2016-01-13 03:54:50'),
(29, 'marketing', 'departement', 'update', 1, '2016-01-13 03:57:51'),
(30, 'marketing', 'departement', 'update', 1, '2016-01-13 03:58:06'),
(31, 'marketing', 'departement', 'update', 1, '2016-01-13 04:00:03'),
(32, 'marketing', 'company', 'create', 5, '2016-01-13 04:10:44'),
(33, 'marketing', 'branches', 'create', 2, '2016-01-13 04:30:34'),
(34, 'marketing', 'branches', 'update', 1, '2016-01-13 04:33:31'),
(35, 'marketing', 'branches', 'update', 1, '2016-01-13 04:33:40'),
(36, 'marketing', 'branches', 'update', 1, '2016-01-13 04:34:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
