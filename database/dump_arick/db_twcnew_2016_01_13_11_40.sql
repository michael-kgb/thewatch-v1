-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2016 at 05:38 AM
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
-- Table structure for table `branches`
--

CREATE TABLE IF NOT EXISTS `branches` (
  `branch_id` int(11) NOT NULL,
  `companies_company_id` int(11) NOT NULL,
  `branch_name` varchar(50) NOT NULL,
  `branch_address` text NOT NULL,
  `branch_created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `branch_status` enum('active','inactive') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`branch_id`, `companies_company_id`, `branch_name`, `branch_address`, `branch_created_date`, `branch_status`) VALUES
(1, 2, 'HEAD OFFICE', 'tulodong', '2015-09-20 19:24:32', 'active'),
(2, 5, 'KCP', 'SCBD', '2016-01-13 11:30:33', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE IF NOT EXISTS `companies` (
  `company_id` int(11) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `company_email` varchar(50) NOT NULL,
  `company_address` text NOT NULL,
  `company_about` text NOT NULL,
  `company_profile` text NOT NULL,
  `company_phone` varchar(15) NOT NULL,
  `company_logo` text NOT NULL,
  `company_created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `company_status` enum('active','inactive') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`company_id`, `company_name`, `company_email`, `company_address`, `company_about`, `company_profile`, `company_phone`, `company_logo`, `company_created_date`, `company_status`) VALUES
(2, 'PT KAMI GAWI BERJAYA', 'mail@kgbgroup.co.id', 'tulodong bawah 4 lama kebayoran baru', '', '', '02155445', '20150925_a35ff5ec3acebfa5ee6e109d61b1710e.jpg', '2015-09-25 15:12:03', 'active'),
(5, 'PT KGB Berjaya', 'kgbberjaya@kgb.co.id', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,', '087881103146', '20160113_77e0ed29e997c7f07bb1d07ef5feb9d2.jpg', '2016-01-13 11:10:44', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `departements`
--

CREATE TABLE IF NOT EXISTS `departements` (
  `departement_id` int(11) NOT NULL,
  `departement_name` varchar(50) NOT NULL,
  `branches_branch_id` int(11) NOT NULL,
  `companies_company_id` int(11) NOT NULL,
  `departement_created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `departement_status` enum('active','inactive') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departements`
--

INSERT INTO `departements` (`departement_id`, `departement_name`, `branches_branch_id`, `companies_company_id`, `departement_created_date`, `departement_status`) VALUES
(1, 'IT', 1, 2, '2015-09-20 19:25:08', 'active'),
(2, 'Marketing', 1, 2, '2016-01-12 16:13:59', 'active'),
(3, 'Finance', 1, 2, '2016-01-13 09:28:38', 'active'),
(4, 'Design', 1, 2, '2016-01-13 10:54:49', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE IF NOT EXISTS `module` (
  `id` int(11) NOT NULL,
  `module_controller` varchar(100) NOT NULL,
  `module_name` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`id`, `module_controller`, `module_name`) VALUES
(1, 'users', 'Users'),
(2, 'group', 'Group'),
(3, 'products', 'Products'),
(4, 'categories', 'Categories'),
(6, 'monitoring', 'Monitoring'),
(7, 'productAttributes', 'Product Attributes'),
(8, 'brands', 'Brands'),
(9, 'module', 'Module'),
(10, 'permissions', 'Permissions'),
(11, 'tags', 'Tags');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `view_access` int(11) NOT NULL,
  `add_access` int(11) NOT NULL,
  `update_access` int(11) NOT NULL,
  `delete_access` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `group_id`, `module_id`, `view_access`, `add_access`, `update_access`, `delete_access`) VALUES
(1, 1, 1, 1, 1, 1, 1),
(2, 1, 2, 1, 1, 1, 1),
(3, 1, 3, 1, 1, 1, 1),
(4, 1, 4, 1, 1, 1, 1),
(5, 2, 1, 0, 0, 0, 0),
(6, 2, 2, 0, 0, 0, 0),
(7, 2, 3, 1, 1, 1, 1),
(8, 2, 4, 1, 1, 1, 1),
(9, 3, 1, 1, 0, 0, 0),
(10, 3, 2, 0, 1, 0, 0),
(11, 3, 3, 0, 0, 1, 0),
(12, 3, 4, 0, 0, 0, 1),
(16, 1, 6, 1, 1, 1, 1),
(17, 2, 6, 1, 1, 1, 1),
(18, 3, 6, 0, 0, 0, 0),
(19, 1, 7, 1, 1, 1, 1),
(20, 2, 7, 1, 1, 1, 1),
(21, 3, 7, 0, 0, 0, 0),
(22, 5, 1, 0, 0, 0, 0),
(23, 5, 2, 0, 0, 0, 0),
(24, 5, 3, 1, 1, 1, 1),
(25, 5, 4, 0, 0, 0, 0),
(26, 5, 6, 0, 0, 0, 0),
(27, 5, 7, 0, 0, 0, 0),
(28, 1, 8, 1, 1, 1, 1),
(29, 2, 8, 1, 1, 1, 1),
(30, 3, 8, 0, 0, 0, 0),
(31, 5, 8, 0, 0, 0, 0),
(32, 1, 9, 1, 1, 1, 1),
(33, 2, 9, 0, 0, 0, 0),
(34, 3, 9, 0, 0, 0, 0),
(35, 5, 9, 0, 0, 0, 0),
(36, 1, 10, 1, 1, 1, 1),
(37, 2, 10, 0, 0, 0, 0),
(38, 3, 10, 0, 0, 0, 0),
(39, 5, 10, 0, 0, 0, 0),
(40, 6, 1, 0, 0, 0, 0),
(41, 6, 2, 0, 0, 0, 0),
(42, 6, 3, 0, 0, 0, 0),
(43, 6, 4, 0, 0, 0, 0),
(44, 6, 6, 0, 0, 0, 0),
(45, 6, 7, 0, 0, 0, 0),
(46, 6, 8, 0, 0, 0, 0),
(47, 6, 9, 0, 0, 0, 0),
(48, 6, 10, 0, 0, 0, 0),
(49, 1, 11, 1, 1, 1, 1),
(50, 2, 11, 0, 0, 0, 0),
(51, 3, 11, 0, 0, 0, 0),
(52, 5, 11, 0, 0, 0, 0),
(53, 6, 11, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_group`
--

CREATE TABLE IF NOT EXISTS `tbl_group` (
  `id` int(11) NOT NULL,
  `group_name` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_group`
--

INSERT INTO `tbl_group` (`id`, `group_name`) VALUES
(1, 'Super Admin'),
(2, 'Logistic'),
(3, 'Finance'),
(5, 'Marketing'),
(6, 'Design');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `group_id` int(11) NOT NULL,
  `profile_photo` blob NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `departements_departement_id` int(11) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `fullname`, `group_id`, `profile_photo`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `departements_departement_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'hari', 'Hari', 1, '', 'GQ4t0UsYts4dzaZOnsOOKHSNSf7PgPM8', '$2y$13$0R8ychOoZMtsNgS.h1Q/5.zswJu22SKPpp3QwWHy2STbbOUwy0CGO', NULL, 'hari@thewatch.co', 1, 1, 1441963409, 1441963409),
(5, 'admin', 'administrator', 1, 0x31, 'XB5ffUHlxGo3QuC5BmA3Ob_ID3zPO-1I', '$2y$13$xYbGQDAEx7xFf5XHdbNKEes.Dzw/Wu43SL7EHgatWhSAYKM9HtrwC', NULL, 'admin@mail.com', 1, 1, 1442990371, 1442990371),
(8, 'arick', 'Arick Anjasmara', 2, 0x3231, 'ECUWGA-wNdZBAqpvbRyy5pUIQen2q568', '$2y$13$rHxwPirmpaD/hIoKsA1GJ.rhDWEwducfPInXYEhLwjyEgPs7c9cEO', NULL, 'arick@thewatch.co', 1, 1, 1452494635, 1452494635),
(9, 'adminTWC', 'adminTWC', 3, 0x61646d696e545743, 'YpKYxxqWQtmL-sF1vA0xFoKRP6lTs9_d', '$2y$13$FVXehlPReoLxCaHZuWSHd.YroKwOQmbkt4H8X/biDpIZMnaKRdiu2', NULL, 'adminTWC@thewatch.co', 1, 1, 1452581500, 1452581500),
(10, 'admin3', 'admin3', 3, 0x61646d696e33, '3inUnhAkXHuCrYm0SD18xBKVX_onAuIE', '$2y$13$WXq2C0N8WaDEvaMIXFZ34OZC2CmkJbAbndjFpEFN10bHAEVT9fwAO', NULL, 'admin3@thewatch.co', 1, 1, 1452582375, 1452582375),
(11, 'marketing', 'marketing', 5, 0x6d61726b6574696e67, 'eGcW6OMAXrpRfpl9_Z7VIpyb2emQ7Rg1', '$2y$13$39hbbZ86SoBzFcL2hHLhAe5PSiZ9KBvGTUrbMAQ0BYVxKuvSTn5M.', NULL, 'marketing@thewatch.co', 2, 10, 1452587632, 1452587632),
(13, 'teknologi', 'teknologi', 5, 0x74656b6e6f6c6f6769, 'XCs2ctUz0jxj5RNrJtAqfWSpaUBnFpgp', '$2y$13$2QbacoFk2vaCWaOdnbM7PerqNvdPTFiJ1EcR180fwCNfUOzhJFKui', NULL, 'teknologi@twc.com', 1, 10, 1452589391, 1452589391),
(14, 'admin2', 'admin2', 1, 0x61646d696e32, 'gJgnRJ5NR2DLQwbXd7pxOmURoxj0E617', '$2y$13$v122EyFZZxcVVJaMSPjW/OG/xiNmajacKhT0gIi3q0b/Lh7yXB9uC', NULL, 'admin2@a.com', 1, 10, 1452591606, 1452591606),
(17, 'admin5', 'admin5', 5, 0x61646d696e35, '_TgLb4cep1SLb2Sa5hExEg3UCn9_GGVy', '$2y$13$iKyrDME1KDPILV81/7zikeHkzwZ14APJ0weorILvvi6ZZyvIdJxR6', NULL, 'admin5@thewatch.co', 2, 10, 1452592828, 1452592828),
(18, 'admin7', 'admin7', 1, 0x61646d696e37, '5xYQdbhNfsDA_heW08rRCgeReadE4lw-', '$2y$13$qCRZZaFMqm3XI5Pp8EEfpOlzIPxBasT2ePdf.kmVKb.RZqjIMpTVK', NULL, 'admin7@thewatch.co', 1, 10, 1452652321, 1452652321),
(19, 'admin10', 'admin10', 0, 0x61646d696e3130, 'MuOh3ByH_kVxFMha3f2aDzFcjfZSYxQX', '$2y$13$coRlmz1v1PZu.ha9OTlLnOuZ4q.WdfBxY9ikPg2IkD7Jsgo2YfEAe', NULL, 'admin10@thewatch.co', 0, 10, 1452656010, 1452656010),
(20, 'admin11', 'admin11', 2, 0x61646d696e3131, 'oLBPAHS8KHyW-ZpX4Ypo01XDApLX4QBz', '$2y$13$ZkLmT.SDAAtt0T38Y46houhpjY.mbzaOE8PrdZAo5VeOXw7X/H/0K', NULL, 'admin11@thewatch.co', 2, 10, 1452656367, 1452656367);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `departements`
--
ALTER TABLE `departements`
  ADD PRIMARY KEY (`departement_id`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_group`
--
ALTER TABLE `tbl_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `departements`
--
ALTER TABLE `departements`
  MODIFY `departement_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `tbl_group`
--
ALTER TABLE `tbl_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
