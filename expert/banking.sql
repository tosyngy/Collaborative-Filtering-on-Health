-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 28, 2017 at 11:09 AM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `banking`
--
CREATE DATABASE `banking` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `banking`;

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE IF NOT EXISTS `registration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `phoneno` varchar(20) NOT NULL,
  `thumb_finger` longblob NOT NULL,
  `index_finger` longblob NOT NULL,
  `cardno` varchar(20) NOT NULL,
  `email` text NOT NULL,
  `cardtype` varchar(20) NOT NULL DEFAULT '0',
  `password` text NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `firstname`, `lastname`, `address`, `phoneno`, `thumb_finger`, `index_finger`, `cardno`, `email`, `cardtype`, `password`, `status`) VALUES
(1, 'user', 'user', 'here or there', '090786767367', 0x7468756d62, 0x66696e676572, '0897867646464565', 'me@u.com', 'verve', 'user1', '0'),
(2, 'ola', 'ola', 'here or ther', '09099997872', 0x7468756d62, 0x66696e676572, '0903289278278433', 'to@mail.com', 'master', 'user1', '0');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
