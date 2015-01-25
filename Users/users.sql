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

CREATE TABLE IF NOT EXISTS `users` (
`user_id` mediumint(6) unsigned NOT NULL,
  `title` char(10) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `psword` char(40) NOT NULL,
  `uname` char(12) NOT NULL,
  `registration_date` datetime NOT NULL,
  `user_level` tinyint(2) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `title`, `fname`, `lname`, `email`, `psword`, `uname`, `registration_date`, `user_level`) VALUES
(1, 'Mr', 'Alex', 'Sanchez', 'alexandermagus6@icloud.com', 'Dante777', 'LordOfDark', '2013-01-05 20:34:41', 1),
(2, 'Mr', 'James', 'Smith', 'jsmith@myisp.co.uk', '34ae707a963ad8a1fb248f8c1f50a4d3d5dd2e64', 'muscleman', '2013-01-06 11:37:02', 0),
(3, 'Mr', 'Mike', 'Rosoft', 'miker@myisp.com', '315806a3a2ae3ae81d1294746df09ac6ceaa587c', 'benefactor', '2013-02-02 13:02:34', 0),
(4, 'Ms', 'Olive', 'Branch', 'obranch@myisp.co.uk', 'e832f6808645a6c6304fd90e99f5685c1403b245', 'mspopeye', '2013-02-02 13:06:09', 0),
(5, 'Mr', 'Frank', 'Incense', 'fincense@myisp.net', '71ea58aa789b63d377fa73c441348da5840bd0dc', 'mythking', '2013-02-02 13:08:39', 0),
(52, 'Mrs', 'Annie', 'Versary', 'aversary@myisp.com', '2f635f6d20e3fde0c53075a84b68fb07dcec9b03', 'celebrate', '2013-03-29 12:13:30', 0),
(53, 'Mr', 'Terry', 'Fide', 'tforide@myisp.co.uk', '55deee02330052a7bb715168f9405b33ef752662', 'trembling', '2013-03-29 12:17:21', 0),
(54, 'Mrs', 'Annie', 'Mossity', 'amossity@myisp.org.uk', '5097e90d39e6fd70da7651222a400b843e77bc56', 'acrimony', '2013-03-29 12:27:52', 0),
(55, 'Mr', 'Percy', 'Veer', 'pveer@myisp.com', '4ac6f592d402e8f092fc0d9ce146f19e2cc089f7', 'doggedly', '2013-03-29 12:37:18', 0),
(56, 'Mr', 'Darrel', 'Doo', 'ddoo@myisp.co.uk', 'a34b2d93b414ea65c52ac05fb5aac57041ded75b', 'contented', '2013-03-29 12:41:12', 0),
(57, 'Mr', 'Stan', 'Dard', 'sdard@myisp.net', 'c46b524b22c5e2b8633474eb8045a8bab5bfef1c', 'warbanner', '2013-03-29 15:41:07', 0),
(58, 'Miss', 'Nora', 'Bone', 'nbone@myisp.com', '916671ef4cc4c2348d55d7d9da64340afef9c57d', 'strongteeth', '2013-03-29 15:55:35', 0),
(59, 'Mrs', 'Barry', 'Cade', 'bcade@myisp.co.uk', '2496e6e4e2f44fb00a6111369e0d8e108a8e3777', 'mybarrier', '2013-03-29 15:57:43', 0),
(60, 'Miss', 'Dee', 'Jected', 'djected@myisp.org.uk', '9b5a7d91f8f01eb9cb45b3fe4b349f6699ca44d7', 'pessimist', '2013-03-29 16:57:33', 0),
(61, 'Mrs', 'Lynn', 'Seed', 'lseed@myisp.com', 'a2614195adf5952916965acba1b4111058453ba4', 'artistic', '2013-03-29 17:10:19', 0),
(62, 'Mr', 'Barry', 'Tone', 'btone@myisp.net', '4070f1e15f4b49a01213ec61164b90100354fcf6', 'midrange', '2013-03-29 17:13:00', 0),
(68, 'Mr', 'Alexander', 'Sanchez', 'alexandermagus6@yahoo.com', '2401da7f306c93f409d45217a2e36db4bbe9fd31', 'Rufus', '2015-01-16 21:28:25', 0),
(69, 'Dr', 'Alexander', 'Santos', 'gorguts@gmail.com', 'b9dce362eab925826af04a3ee716b154f19aa387', 'Gorgo', '2015-01-16 21:36:16', 0),
(70, 'fgdfg', 'fgfdg', 'dffdgdfgfd', 'fdgdfg@fhgdg.com', '2401da7f306c93f409d45217a2e36db4bbe9fd31', 'Walter', '2015-01-16 22:57:13', 0),
(71, 'sr', 'dfsdf', 'dsfdsf', 'dfsdf@gmail.com', '90fbddf7d0d8c0481be68e5dd2ebc2e875bad1d9', 'Userss', '2015-01-17 08:48:29', 0),
(72, 'Mt', 'Dfdsg', 'fgfdgfd', 'akek@gnau.com', '90fbddf7d0d8c0481be68e5dd2ebc2e875bad1d9', 'Crapper', '2015-01-17 09:40:33', 0),
(73, 'fsd', 'dfsdfsdfsd', 'fsdfdsfsdf', 'fdsfsa@gmi.com', '90fbddf7d0d8c0481be68e5dd2ebc2e875bad1d9', 'Sunio', '2015-01-17 12:57:15', 0),
(74, 'etert', 'retere', 'retert', 'wles@gmail.com', '90fbddf7d0d8c0481be68e5dd2ebc2e875bad1d9', 'Alfrred', '2015-01-17 14:05:48', 0),
(75, 'Mr', 'Alan', 'Harper', 'adsd@gdsgsd.com', '90fbddf7d0d8c0481be68e5dd2ebc2e875bad1d9', 'Dante', '2015-01-20 13:13:54', 0),
(76, 'ms', 'm', 'mm', 'mmm@gmail.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'nox', '2015-01-22 15:56:57', 0),
(77, 'Mr', 'dsfdsfds', 'dsfdsdsf', 'alex@gmail.com', '90fbddf7d0d8c0481be68e5dd2ebc2e875bad1d9', 'Sancho', '2015-01-23 16:56:13', 0),
(78, 'Mrd', 'fdgsdfgdf', 'dfdsf', 'asdfd@gmail.com', '2401da7f306c93f409d45217a2e36db4bbe9fd31', 'Rex', '2015-01-23 17:03:08', 0),
(79, 'Mr', 'Alexander', 'Sanchez', 'alexandermagus@icloud.com', '90fbddf7d0d8c0481be68e5dd2ebc2e875bad1d9', 'Dante', '2015-01-24 20:05:44', 0),
(80, 'Mr', 'Flower', 'dfdfdfdsf', 'flower@gmail.com', '90fbddf7d0d8c0481be68e5dd2ebc2e875bad1d9', 'Flower', '2015-01-24 20:14:19', 0);

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
MODIFY `user_id` mediumint(6) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=81;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
