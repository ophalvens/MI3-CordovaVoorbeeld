-- phpMyAdmin SQL Dump
-- version 3.5.8.1
-- http://www.phpmyadmin.net
--

-- Generation Time: Oct 23, 2017 at 09:37 AM
-- Server version: 10.1.28-MariaDB-1~xenial
-- PHP Version: 5.4.45-0+deb7u11

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;



-- --------------------------------------------------------

--
-- Table structure for table `categorieen`
--

CREATE TABLE IF NOT EXISTS `categorieen` (
  `CT_ID` int(11) NOT NULL AUTO_INCREMENT,
  `CT_OM` varchar(20) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`CT_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `categorieen`
--

INSERT INTO `categorieen` (`CT_ID`, `CT_OM`) VALUES
(1, 'Fruit'),
(2, 'Groenten'),
(3, 'Vervoermiddel');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
