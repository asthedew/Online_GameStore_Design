-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 28, 2015 at 05:37 ÉÏÎç
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `onlinestore`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `oID` int(11) NOT NULL AUTO_INCREMENT,
  `pid_array` varchar(255) NOT NULL,
  `cid` int(11) NOT NULL,
  `cemail` varchar(255) NOT NULL,
  `order_addr` varchar(255) NOT NULL,
  `order_city` varchar(255) NOT NULL,
  `order_state` varchar(255) NOT NULL,
  `order_country` varchar(255) NOT NULL,
  `order_zip` varchar(255) NOT NULL,
  `totalprice` varchar(255) NOT NULL,
  `date_added` date NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`oID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`oID`, `pid_array`, `cid`, `cemail`, `order_addr`, `order_city`, `order_state`, `order_country`, `order_zip`, `totalprice`, `date_added`, `status`) VALUES
(1, '5-1,14-1', 4, 'ok', 'ok', 'ok', 'ok', 'ok', 'ok', '137', '2015-04-12', 'pending'),
(2, '2-1', 4, 'ok', 'ok', 'ok', 'ok', 'ok', 'ok', '28', '2015-04-19', 'pending'),
(3, '4-1', 4, 'ok', 'ok', 'ok', 'ok', 'ok', 'ok', '14', '2015-04-19', 'pending'),
(4, '2-1,1-1', 4, 'ok', 'ok', 'ok', 'ok', 'ok', 'ok', '58', '2015-04-28', 'Pending'),
(6, '1-1', 4, 'ok', 'ok', 'ok', 'ok', 'ok', 'ok', '30', '2015-04-28', 'Shipped'),
(7, '1-1', 4, 'ok', 'ok', 'ok', 'ok', 'ok', 'ok', '30', '2015-04-28', 'Shipped');
