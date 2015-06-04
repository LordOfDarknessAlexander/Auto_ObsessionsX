-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2015 at 02:56 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3
--
--first, drops the table for the Auto Obsession's vehicle database, if it exists
--then, creates a new table with the added property entries
--developer must then navigate to images\\cars\\sqlGen.php to fill the table with values
--
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
--
-- Database: `finalpost`
-- --------------------------------------------------------
-- Table structure for table `aoCars`
--
CREATE TABLE IF NOT EXISTS `aoCars` (
    `car_id` int unsigned NOT NULL PRIMARY KEY,
    `make` varchar(30) NOT NULL,
    `year` int NOT NULL,
    `model` varchar(50) NOT NULL,
    `price` int unsigned NOT NULL,
    `info` varchar(1024) NOT NULL,
    `type` char(16) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=latin1;
--
-- Data is added dynamically through php script!
--