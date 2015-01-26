-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2015 at 02:56 AM
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

CREATE TABLE IF NOT EXISTS `aoCars` (
    `car_id` mediumint(6) unsigned NOT NULL,
    `make` varchar(30) NOT NULL,
    `year` int NOT NULL,
    `model` varchar(50) NOT NULL,
    `price` int NOT NULL,
    `info` char(128) NOT NULL,
)ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `aoCars` (`car_id`, `make`, year`, `model`, `price`, `info`) VALUES
    (1, 'Jaguar', 1969,'E-Type Series II 4.2 Roadster', 25000, 'default info'),
	(2, 'Chevrolet', 1969, 'Camaro RS-Z28 Sport Coupe', 18000, 'default info'),
	(3, 'GMC', 1997, 'Sierra', 12000, 'default info'),
    (4, 'Audi', 2013, 'S5 Coupe', 57000, 'default info');
--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `aoCars`
 ADD PRIMARY KEY (`car_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `aoCars`
MODIFY `car_id` mediumint(6) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=81;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
