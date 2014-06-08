-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 08, 2014 at 11:22 AM
-- Server version: 5.5.33
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `epigami`
--

-- --------------------------------------------------------

--
-- Table structure for table `phonebook`
--

CREATE TABLE `phonebook` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `phonebook`
--

INSERT INTO `phonebook` (`id`, `name`, `phone_number`, `created_at`, `status`) VALUES
(1, 'Abdul', '85015722', '2014-06-08 08:45:31', 0),
(2, 'Shamadhu', '98430123', '2014-06-08 08:45:48', 0),
(3, 'John Paul', '69722134', '2014-06-08 08:46:08', 0),
(4, 'Epigami', '65734655', '2014-06-08 08:46:32', 0),
(5, 'SP Sports Pte Ltd', '34394384', '2014-06-08 08:47:19', 0),
(6, 'iApps Asia', '98713113', '2014-06-08 08:47:35', 0),
(7, 'Lillian Koh', '79980899', '2014-06-08 08:47:54', 0),
(8, 'Veann', '75676575', '2014-06-08 08:48:07', 0),
(9, 'Evonne', '87777222', '2014-06-08 08:48:30', 0),
(10, 'Mike', '97677655', '2014-06-08 08:49:35', 0),
(11, 'Singa', '457657567', '2014-06-08 08:49:59', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
