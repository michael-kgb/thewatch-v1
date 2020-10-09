-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2016 at 05:24 AM
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
-- Table structure for table `module`
--

CREATE TABLE IF NOT EXISTS `module` (
  `id` int(11) NOT NULL,
  `module_group_id` int(11) NOT NULL,
  `module_controller` varchar(100) NOT NULL,
  `module_name` varchar(100) NOT NULL,
  `show_number` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

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
(40, 7, 'social', 'Social Media', 2),
(41, 8, 'dashboard', 'Dashboard', 1),
(42, 1, 'PermissionsCheck', 'Permissions Check', 1);

-- --------------------------------------------------------

--
-- Table structure for table `module_group`
--

CREATE TABLE IF NOT EXISTS `module_group` (
  `module_group_id` int(11) NOT NULL,
  `module_group_name` varchar(50) NOT NULL,
  `show_number` int(11) NOT NULL,
  `glyphicon` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module_group`
--

INSERT INTO `module_group` (`module_group_id`, `module_group_name`, `show_number`, `glyphicon`) VALUES
(1, 'Administration', 8, 'fa fa-key'),
(2, 'Catalogue', 2, 'glyphicon glyphicon-book'),
(3, 'Orders', 3, 'glyphicon glyphicon-shopping-cart'),
(4, 'Customers', 4, 'fa fa-users'),
(5, 'Shipping', 5, 'fa fa-truck'),
(6, 'Localization', 6, 'glyphicon glyphicon-globe'),
(7, 'Settings', 7, 'glyphicon glyphicon-cog'),
(8, 'Home', 1, 'glyphicon glyphicon-home');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `module_group`
--
ALTER TABLE `module_group`
  MODIFY `module_group_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
