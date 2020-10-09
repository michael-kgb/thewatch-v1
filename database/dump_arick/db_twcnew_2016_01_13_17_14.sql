-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2016 at 11:13 AM
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
  `module_group_id` int(11) NOT NULL,
  `module_controller` varchar(100) NOT NULL,
  `module_name` varchar(100) NOT NULL,
  `show_number` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`id`, `module_group_id`, `module_controller`, `module_name`, `show_number`) VALUES
(1, 1, 'user', 'Users', 1),
(2, 1, 'group', 'Group', 2),
(3, 2, 'products', 'Products', 1),
(4, 2, 'categories', 'Categories', 2),
(6, 2, 'monitoring', 'Monitoring', 3),
(7, 2, 'productAttributes', 'Product Attributes', 4),
(8, 2, 'brands', 'Brands', 6),
(9, 1, 'module', 'Module', 6),
(10, 1, 'permissions', 'Permissions', 8),
(11, 2, 'tags', 'Tags', 8),
(12, 1, 'departement', 'Departement', 3),
(13, 1, 'company', 'Company', 4),
(14, 1, 'branches', 'Branches', 5),
(15, 1, 'modulegroup', 'Module Group', 7),
(17, 2, 'productFeatures', 'Product Features', 5),
(18, 2, 'suppliers', 'Suppliers', 7),
(19, 2, 'attachments', 'Attachments', 9),
(20, 3, 'orders', 'Orders', 1),
(21, 3, 'invoices', 'Invoices', 2),
(22, 3, 'merchandiseReturns', 'Merchandise Returns', 3),
(23, 3, 'deliverySlips', 'Delivery Slips', 4),
(24, 3, 'statuses', 'Statuses', 5),
(25, 3, 'orderMessages', 'Order Messages', 6),
(26, 4, 'customers', 'Customers', 1),
(27, 4, 'addresses', 'Addresses', 2),
(28, 4, 'groups', 'Groups', 3),
(29, 4, 'shoppingCarts', 'Shopping Carts', 1),
(30, 4, 'customerService', 'Customer Service', 5),
(31, 4, 'contacts', 'Contacts', 6),
(32, 4, 'titles', 'Titles', 7),
(33, 5, 'carriers', 'Carriers', 1),
(34, 5, 'preferences', 'Preferences', 2),
(35, 6, 'localization', 'Localization', 1),
(36, 6, 'languages', 'Languages', 2),
(37, 6, 'currencies', 'Currencies', 3),
(38, 6, 'translations', 'Translations', 4),
(39, 7, 'homebanner', 'Home Banner', 1),
(40, 7, 'social', 'Social Media', 2);

-- --------------------------------------------------------

--
-- Table structure for table `module_group`
--

CREATE TABLE IF NOT EXISTS `module_group` (
  `module_group_id` int(11) NOT NULL,
  `module_group_name` varchar(50) NOT NULL,
  `show_number` int(11) NOT NULL,
  `glyphicon` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module_group`
--

INSERT INTO `module_group` (`module_group_id`, `module_group_name`, `show_number`, `glyphicon`) VALUES
(1, 'Administration', 8, 'fa fa-key'),
(2, 'Catalogue', 1, 'glyphicon glyphicon-book'),
(3, 'Orders', 2, 'glyphicon glyphicon-shopping-cart'),
(4, 'Customers', 3, 'fa fa-users'),
(5, 'Shipping', 4, 'fa fa-truck'),
(6, 'Localization', 5, 'glyphicon glyphicon-globe'),
(7, 'Settings', 7, 'glyphicon glyphicon-cog');

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
) ENGINE=InnoDB AUTO_INCREMENT=194 DEFAULT CHARSET=latin1;

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
(53, 6, 11, 0, 0, 0, 0),
(54, 1, 12, 0, 0, 0, 0),
(55, 2, 12, 0, 0, 0, 0),
(56, 3, 12, 0, 0, 0, 0),
(57, 5, 12, 0, 0, 0, 0),
(58, 6, 12, 0, 0, 0, 0),
(59, 1, 13, 0, 0, 0, 0),
(60, 2, 13, 0, 0, 0, 0),
(61, 3, 13, 0, 0, 0, 0),
(62, 5, 13, 0, 0, 0, 0),
(63, 6, 13, 0, 0, 0, 0),
(64, 1, 14, 0, 0, 0, 0),
(65, 2, 14, 0, 0, 0, 0),
(66, 3, 14, 0, 0, 0, 0),
(67, 5, 14, 0, 0, 0, 0),
(68, 6, 14, 0, 0, 0, 0),
(69, 1, 15, 0, 0, 0, 0),
(70, 2, 15, 0, 0, 0, 0),
(71, 3, 15, 0, 0, 0, 0),
(72, 5, 15, 0, 0, 0, 0),
(73, 6, 15, 0, 0, 0, 0),
(74, 1, 17, 0, 0, 0, 0),
(75, 2, 17, 0, 0, 0, 0),
(76, 3, 17, 0, 0, 0, 0),
(77, 5, 17, 0, 0, 0, 0),
(78, 6, 17, 0, 0, 0, 0),
(79, 1, 18, 0, 0, 0, 0),
(80, 2, 18, 0, 0, 0, 0),
(81, 3, 18, 0, 0, 0, 0),
(82, 5, 18, 0, 0, 0, 0),
(83, 6, 18, 0, 0, 0, 0),
(84, 1, 19, 0, 0, 0, 0),
(85, 2, 19, 0, 0, 0, 0),
(86, 3, 19, 0, 0, 0, 0),
(87, 5, 19, 0, 0, 0, 0),
(88, 6, 19, 0, 0, 0, 0),
(89, 1, 20, 0, 0, 0, 0),
(90, 2, 20, 0, 0, 0, 0),
(91, 3, 20, 0, 0, 0, 0),
(92, 5, 20, 0, 0, 0, 0),
(93, 6, 20, 0, 0, 0, 0),
(94, 1, 21, 0, 0, 0, 0),
(95, 2, 21, 0, 0, 0, 0),
(96, 3, 21, 0, 0, 0, 0),
(97, 5, 21, 0, 0, 0, 0),
(98, 6, 21, 0, 0, 0, 0),
(99, 1, 22, 0, 0, 0, 0),
(100, 2, 22, 0, 0, 0, 0),
(101, 3, 22, 0, 0, 0, 0),
(102, 5, 22, 0, 0, 0, 0),
(103, 6, 22, 0, 0, 0, 0),
(104, 1, 23, 0, 0, 0, 0),
(105, 2, 23, 0, 0, 0, 0),
(106, 3, 23, 0, 0, 0, 0),
(107, 5, 23, 0, 0, 0, 0),
(108, 6, 23, 0, 0, 0, 0),
(109, 1, 24, 0, 0, 0, 0),
(110, 2, 24, 0, 0, 0, 0),
(111, 3, 24, 0, 0, 0, 0),
(112, 5, 24, 0, 0, 0, 0),
(113, 6, 24, 0, 0, 0, 0),
(114, 1, 25, 0, 0, 0, 0),
(115, 2, 25, 0, 0, 0, 0),
(116, 3, 25, 0, 0, 0, 0),
(117, 5, 25, 0, 0, 0, 0),
(118, 6, 25, 0, 0, 0, 0),
(119, 1, 26, 0, 0, 0, 0),
(120, 2, 26, 0, 0, 0, 0),
(121, 3, 26, 0, 0, 0, 0),
(122, 5, 26, 0, 0, 0, 0),
(123, 6, 26, 0, 0, 0, 0),
(124, 1, 27, 0, 0, 0, 0),
(125, 2, 27, 0, 0, 0, 0),
(126, 3, 27, 0, 0, 0, 0),
(127, 5, 27, 0, 0, 0, 0),
(128, 6, 27, 0, 0, 0, 0),
(129, 1, 28, 0, 0, 0, 0),
(130, 2, 28, 0, 0, 0, 0),
(131, 3, 28, 0, 0, 0, 0),
(132, 5, 28, 0, 0, 0, 0),
(133, 6, 28, 0, 0, 0, 0),
(134, 1, 29, 0, 0, 0, 0),
(135, 2, 29, 0, 0, 0, 0),
(136, 3, 29, 0, 0, 0, 0),
(137, 5, 29, 0, 0, 0, 0),
(138, 6, 29, 0, 0, 0, 0),
(139, 1, 30, 0, 0, 0, 0),
(140, 2, 30, 0, 0, 0, 0),
(141, 3, 30, 0, 0, 0, 0),
(142, 5, 30, 0, 0, 0, 0),
(143, 6, 30, 0, 0, 0, 0),
(144, 1, 31, 0, 0, 0, 0),
(145, 2, 31, 0, 0, 0, 0),
(146, 3, 31, 0, 0, 0, 0),
(147, 5, 31, 0, 0, 0, 0),
(148, 6, 31, 0, 0, 0, 0),
(149, 1, 32, 0, 0, 0, 0),
(150, 2, 32, 0, 0, 0, 0),
(151, 3, 32, 0, 0, 0, 0),
(152, 5, 32, 0, 0, 0, 0),
(153, 6, 32, 0, 0, 0, 0),
(154, 1, 33, 0, 0, 0, 0),
(155, 2, 33, 0, 0, 0, 0),
(156, 3, 33, 0, 0, 0, 0),
(157, 5, 33, 0, 0, 0, 0),
(158, 6, 33, 0, 0, 0, 0),
(159, 1, 34, 0, 0, 0, 0),
(160, 2, 34, 0, 0, 0, 0),
(161, 3, 34, 0, 0, 0, 0),
(162, 5, 34, 0, 0, 0, 0),
(163, 6, 34, 0, 0, 0, 0),
(164, 1, 35, 0, 0, 0, 0),
(165, 2, 35, 0, 0, 0, 0),
(166, 3, 35, 0, 0, 0, 0),
(167, 5, 35, 0, 0, 0, 0),
(168, 6, 35, 0, 0, 0, 0),
(169, 1, 36, 0, 0, 0, 0),
(170, 2, 36, 0, 0, 0, 0),
(171, 3, 36, 0, 0, 0, 0),
(172, 5, 36, 0, 0, 0, 0),
(173, 6, 36, 0, 0, 0, 0),
(174, 1, 37, 0, 0, 0, 0),
(175, 2, 37, 0, 0, 0, 0),
(176, 3, 37, 0, 0, 0, 0),
(177, 5, 37, 0, 0, 0, 0),
(178, 6, 37, 0, 0, 0, 0),
(179, 1, 38, 0, 0, 0, 0),
(180, 2, 38, 0, 0, 0, 0),
(181, 3, 38, 0, 0, 0, 0),
(182, 5, 38, 0, 0, 0, 0),
(183, 6, 38, 0, 0, 0, 0),
(184, 1, 39, 0, 0, 0, 0),
(185, 2, 39, 0, 0, 0, 0),
(186, 3, 39, 0, 0, 0, 0),
(187, 5, 39, 0, 0, 0, 0),
(188, 6, 39, 0, 0, 0, 0),
(189, 1, 40, 0, 0, 0, 0),
(190, 2, 40, 0, 0, 0, 0),
(191, 3, 40, 0, 0, 0, 0),
(192, 5, 40, 0, 0, 0, 0),
(193, 6, 40, 0, 0, 0, 0);

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
(11, 'marketing', 'marketing', 5, 0x6d61726b6574696e67, 'eGcW6OMAXrpRfpl9_Z7VIpyb2emQ7Rg1', '$2y$13$39hbbZ86SoBzFcL2hHLhAe5PSiZ9KBvGTUrbMAQ0BYVxKuvSTn5M.', NULL, 'marketing@thewatch.co', 2, 10, 1452587632, 1452587632);

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
-- Indexes for table `module_group`
--
ALTER TABLE `module_group`
  ADD PRIMARY KEY (`module_group_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `module_group`
--
ALTER TABLE `module_group`
  MODIFY `module_group_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=194;
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
