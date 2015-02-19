-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2015 at 02:56 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3
--
--This will be a php function, as this table needs to be generated
--for each user registered to the site
--
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
--
-- Database: `aoUsersDB`
-- --------------------------------------------------------
-- Table structure for table `user0`
--
CREATE TABLE IF NOT EXISTS `user0` (
    `car_id` int unsigned NOT NULL PRIMARY KEY,
    `drivetrain` int unsigned,
    `body` int unsigned,
    `interior` int unsigned,
    `docs` int unsigned,
    `repairs` int unsigned
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
--
-- Dumping data for table `user0`
--
INSERT INTO `user0` (`car_id`, `drivetrain`, `body`, `interior`, `docs`, `repairs`) VALUES
(24577, 0,0,0,0,0),
(16798977, 0,0,0,0,0);
