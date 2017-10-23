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
-- Table structure for table `producten`
--

CREATE TABLE IF NOT EXISTS `producten` (
  `PR_ID` int(11) NOT NULL AUTO_INCREMENT,
  `PR_CT_ID` int(11) NOT NULL,
  `PR_naam` varchar(50) CHARACTER SET utf8 NOT NULL,
  `prijs` double NOT NULL,
  PRIMARY KEY (`PR_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `producten`
--

INSERT INTO `producten` (`PR_ID`, `PR_CT_ID`, `PR_naam`, `prijs`) VALUES
(23, 0, 'Tomaat', 1),
(2, 1, 'Appel', 2),
(4, 3, 'Sloef (Rechter)', 0.75),
(5, 3, 'Sloef (Linker)', 0.75),
(6, 3, 'Fiets', 375),
(10, 0, 'Aubergine', 20),
(16, 0, 'Ananananananananas', 15),
(15, 0, 'Kaki', 2.5),
(17, 0, 'Banananananananananananananaan', 123),
(24, 0, 'Appelflap', 15),
(22, 0, 'Trololololololo', 10);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
