-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2021 at 09:40 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nursing_service`
--

-- --------------------------------------------------------

--
-- Table structure for table `elder`
--

CREATE TABLE `elder` (
  `elder_id` int(11) NOT NULL,
  `fname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `nname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `bed` int(11) NOT NULL,
  `birthday` date NOT NULL,
  `pic` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `elder`
--

INSERT INTO `elder` (`elder_id`, `fname`, `lname`, `nname`, `bed`, `birthday`, `pic`, `user_id`) VALUES
(1, 'คุณยาย', 'สดใส', 'ปอ', 1, '1963-01-01', 'e1-aj.jpg', 13),
(2, 'คุณยาย', 'ใจดี', 'วันจร้า', 3, '1981-12-03', 'e2-mali.jpg', 14);

-- --------------------------------------------------------

--
-- Table structure for table `nursenote`
--

CREATE TABLE `nursenote` (
  `note_id` int(11) NOT NULL,
  `elder_id` int(11) NOT NULL,
  `temp` float NOT NULL,
  `pleasuerup` int(11) NOT NULL,
  `pleasuerdown` int(11) NOT NULL,
  `hart` int(11) NOT NULL,
  `p` int(11) NOT NULL,
  `r` int(11) NOT NULL,
  `pam` tinyint(4) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `time_stampt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nursenote`
--

INSERT INTO `nursenote` (`note_id`, `elder_id`, `temp`, `pleasuerup`, `pleasuerdown`, `hart`, `p`, `r`, `pam`, `user_id`, `time_stampt`) VALUES
(19, 1, 0, 0, 0, 0, 0, 0, 1, 1, '2021-03-05 14:37:27'),
(20, 1, 37.6, 120, 70, 90, 96, 26, 0, 1, '2021-03-05 14:37:42');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `fname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `idcard` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `location` text COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `auth` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `createBy` int(11) NOT NULL,
  `createDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `birthday` date NOT NULL,
  `pic` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `fname`, `lname`, `idcard`, `location`, `is_active`, `auth`, `createBy`, `createDate`, `birthday`, `pic`, `phone`) VALUES
(1, 'admin', '123456', 'ศุภณัฐ', 'สัตยารัฐ', '0123456789012', '24/12 abc road\r\nggez dkjjkl; dfijijod\r\ndilfmgg jdil;s akljl;s', 1, 'admin', 0, '2021-02-28 09:06:51', '2000-01-01', 'nut.jpg', '0123456789'),
(3, 'jimmy', '123456', 'jim', 'jimmy', '0123456789123', 'dsfjkjdfsa;j dskfjkl;j;jsa\r\ndsgk;kdsg dsfj;kmcxmv.,ewijpfoidslamg', 1, 'admin', 0, '2021-03-05 14:12:23', '2000-12-31', '3-jimmy.jpg', '0123456789'),
(13, 'nut', '123456', 'suppanath', 'sattayarath', '0123456789123', 'asdfjk;lgdsjdsklfjgjdf;l', 0, 'ลูกค้า', 0, '2020-04-19 10:34:10', '2000-02-06', '13-nut.jpg', '0123456789');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `elder`
--
ALTER TABLE `elder`
  ADD PRIMARY KEY (`elder_id`);

--
-- Indexes for table `nursenote`
--
ALTER TABLE `nursenote`
  ADD PRIMARY KEY (`note_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `elder`
--
ALTER TABLE `elder`
  MODIFY `elder_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `nursenote`
--
ALTER TABLE `nursenote`
  MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
