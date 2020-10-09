-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2016 at 05:35 AM
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(12, 'arickTWC', 'arickTWC', 1, 0x617269636b545743, 'ZsVtrdOfApVM3wdRTwhzmEy2UPYT3_hO', '$2y$13$5lZzERcfWCxMONBXUUkFXO7esp9IjJZXXnJaLP7lz5Z02un5vQnhe', NULL, 'arickTWC@thewatch.co', 1, 10, 1452827657, 1452827657);

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
