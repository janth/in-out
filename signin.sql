-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 19, 2012 at 07:24 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `signin`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(30) DEFAULT NULL,
  `surname` varchar(30) DEFAULT NULL,
  `floor` int(11) DEFAULT NULL,
  `keyholder` tinyint(1) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=71 ;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `firstname`, `surname`, `floor`, `keyholder`, `status`) VALUES
(1, 'Debbie', 'Brooks', 0, 1, 0),
(2, 'Carol', 'Green', 0, 1, 0),
(3, 'Pete', 'Crowley', 0, 1, 0),
(4, 'Emma', 'Whelan', 1, 1, 1),
(5, 'Mark', 'Wilson', 1, 1, 0),
(6, 'Gabs', 'Abrahams', 1, 0, 0),
(7, 'Lucy', 'Sinclair', 1, 0, 0),
(8, 'Eloise', 'Lewis', 1, 0, 2),
(9, 'Chloe', 'Leeser', 1, 0, 0),
(10, 'Rachel', 'Malham', 1, 0, 0),
(11, 'Sarah', 'Lines', 1, 0, 0),
(12, 'Jo', 'Baxter', 1, 0, 1),
(13, 'Thomas', 'Muirhead', 1, 1, 0),
(14, 'Jim', 'South', 1, 1, 0),
(15, 'Owen', 'Bowden', 1, 0, 1),
(16, 'Rich', 'Oakey', 1, 0, 3),
(17, 'Tom', 'Preston', 1, 0, 1),
(18, 'Kim', 'Pryor', 1, 0, 1),
(19, 'Jonathan', 'Satchell', 1, 0, 1),
(20, 'Jason', 'O''Dwyer', 1, 0, 0),
(21, 'Chris', 'Wolfe', 1, 0, 0),
(22, 'Ray', 'Williams', 1, 0, 1),
(23, 'Hannah', 'Duggan', 1, 0, 0),
(24, 'Nicci', 'Bicknell', 1, 0, 1),
(25, 'Lola', 'Ariran', 1, 0, 0),
(26, 'Charlie', 'Sivell', 1, 0, 0),
(27, 'Alex', 'Rolfe-Sanders', 1, 0, 0),
(28, 'Sally', 'Clark', 2, 1, 0),
(29, 'Henry', 'Winter', 2, 1, 0),
(30, 'Stephanie', 'Cade', 2, 0, 0),
(31, 'Jess', 'Strudwick', 2, 0, 0),
(32, 'Tilly', 'Sims', 2, 0, 1),
(33, 'David', 'Grant', 2, 1, 0),
(34, 'Chris', 'Bunce', 2, 1, 0),
(35, 'Amy', 'Everard', 2, 0, 0),
(36, 'Sara', 'Darling', 2, 0, 0),
(37, 'Priscilla', 'Appiah', 2, 0, 0),
(38, 'Cathy', 'Gilman', 2, 1, 0),
(39, 'Ann', 'Woodham', 2, 0, 0),
(40, 'Amy', 'Facer', 2, 0, 0),
(41, 'Ken', 'Campbell', 2, 0, 0),
(42, 'Dan', 'Solley', 3, 0, 0),
(43, 'Nicki', 'Sharp', 3, 0, 0),
(44, 'Matt', 'Lawley', 3, 0, 0),
(45, 'Sarah', 'Osborne', 3, 0, 0),
(46, 'Rebecca', 'Andlaw', 3, 0, 0),
(47, 'Bekah', 'Morris', 3, 0, 0),
(48, 'Lauren', 'Scarlett', 3, 0, 0),
(49, 'Chris', 'Pyatt', 3, 0, 0),
(50, 'Matt', 'Short', 3, 1, 0),
(51, 'Sami', 'Hamilton', 3, 0, 0),
(52, 'Lucy', 'Holmes', 3, 0, 0),
(53, 'James', 'Wright', 3, 0, 0),
(54, 'Claire', 'Hoyle', 3, 1, 1),
(55, 'Ben', 'Sykes', 3, 0, 1),
(56, 'Justin', 'Cliff', 3, 0, 0),
(57, 'Ash', 'Davies', 3, 0, 0),
(58, 'Tracey', 'Sweeney', 3, 0, 0),
(59, 'Tanya', 'Douglas', 3, 0, 2),
(60, 'Hiliary', 'Jenkins', 3, 0, 0),
(61, 'Jo', 'Sheikh', 3, 0, 0),
(62, 'Alex', 'Speke', 3, 0, 0),
(63, 'Sam', 'Hicks', 5, 0, 0),
(64, 'Sam', 'Twomey', 5, 0, 0),
(65, 'Blerina', 'Rrapushi', 5, 0, 0),
(66, 'Gemma', 'Hackett', 5, 0, 0),
(67, 'Yolandio', 'Gomes', 5, 0, 0),
(68, 'Tracey', 'Menet', 5, 0, 0),
(69, 'Monica', 'Whitefield', 5, 1, 0),
(70, 'Mike', 'Poole', 5, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `floors`
--

CREATE TABLE IF NOT EXISTS `floors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `floors`
--

INSERT INTO `floors` (`id`, `name`) VALUES
(0, 'Ground Floor'),
(1, 'First Floor'),
(2, 'Second Floor'),
(3, 'Third Floor'),
(4, 'Fourth Floor'),
(5, 'Fifth Floor');

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE IF NOT EXISTS `statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(30) DEFAULT NULL,
  `colour` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `text`, `colour`) VALUES
(0, 'Out', 'cccccc'),
(1, 'In', '66cc66'),
(2, 'On leave', '9999aa'),
(3, 'Off sick', '9999aa');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
