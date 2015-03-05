-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2015 at 10:39 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `finalpost`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`user_id`  int(11) NOT NULL,
`car_id`  int(60) unsigned NOT NULL,
  `title` char(10) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `psword` char(40) NOT NULL,
  `uname` char(12) NOT NULL,
  `registration_date` datetime NOT NULL,
  `user_level` tinyint(2) unsigned NOT NULL,
  `money` float(20,2) NOT NULL,
  `tokens` int(40) NOT NULL,
  `prestige` int(40) NOT NULL,
  `m_marker` int(40) NOT NULL,
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `car_id`, `title`, `fname`, `lname`, `email`, `psword`, `uname`, `registration_date`, `user_level`, `money`, `m_marker`, `tokens`, `prestige`) VALUES
(1,1, 'Mr', 'Donald', 'Gorguts', 'dgorguts@gmail.com', '8be3c943b1609fffbfc51aad666d0a04adf83c9d', 'Gorguts', '2015-02-03 15:08:19', 0, 0, 0, 0, 0),
(2,2, 'mr', 'Alexander', 'Sanchez', 'alexandermagus66@icloud.com', '2401da7f306c93f409d45217a2e36db4bbe9fd31', 'Dante', '2015-02-05 11:08:25', 0, 0, 0, 0, 0),
(3,7, 'Mr', 'Tyler', 'Drury', 'that_canadianguy@hotmail.com', 'asdfasdf', 'Vigilance', '2015-02-05 11:08:25', 0, 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;

