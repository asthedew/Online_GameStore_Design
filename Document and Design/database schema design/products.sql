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
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `pID` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `details` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `subcategory` varchar(100) NOT NULL,
  `date_added` date NOT NULL,
  PRIMARY KEY (`pID`),
  UNIQUE KEY `product_name` (`product_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pID`, `product_name`, `price`, `quantity`, `details`, `category`, `subcategory`, `date_added`) VALUES
(1, 'Halo:The master Chief Collection - Microsoft Xbox One', '29.99', 3, 'Condition: Brand New:An item that has never been opened or removed from the manufacturer''s sealing.\r\nRelease Year: 2014\r\nPublisher: Microsoft Studios', 'Video Games', 'Xbox One', '2015-04-20'),
(2, 'The Crew Xbox One Game Brand New Sealed **Clearance**', '27.99', 1, 'Condition: Brand New: An item that has never been opened or removed from the manufacturer'' s sealing (if applicable). Item is in original shrink wrap (if applicable). See the seller''s listing for full details.', 'Video Games', 'Xbox One', '2015-04-22'),
(3, 'Fifa Soccer 14 - Brand New Sealed 2014 Xbox One', '22.99', 1, 'Condition:Brand New: An item that has never been opened or removed from the manufacturer''s sealing (if applicable). Item is in original shrink wrap (if applicable). See the seller''s listing for full details.\r\nRelease Year: 2013\r\nPublisher: EA', 'Video Games', 'Xbox One', '2015-04-23'),
(4, 'Fighter Within Microsoft Xbox One', '13.99', 1, 'Condition:Brand New: An item that has never been opened or removed from the manufacturer''s sealing (if applicable). Item is in original shrink wrap (if applicable). See the seller''s listing for full details.\r\nRelease Year: 2014\r\nPublisher: Ubisoft', 'Video Games', 'Xbox One', '2015-04-23'),
(5, 'Madden NFL 15 Ultimate Edition Brand New Sealed - Xbox One', '74.99', 1, 'Conditions:Brand New: An item that has never been opened or removed from the manufacturer'' s sealing (if applicable). Item is in original shrink wrap (if applicable). See the seller''s listing for full details.', 'Video Games', 'Xbox One', '2015-04-25'),
(6, 'Evolve - Xbox One', '48.99', 1, 'Conditions:Brand New: An item that has never been opened or removed from the manufacturer''s sealing (if applicable). Item is in original shrink wrap (if applicable). See the seller''s listing for full details.\r\nRelease Year: 2015', 'Video Games', 'Xbox One', '2015-04-26'),
(14, 'New Sony PlayStation 4 PS4 Games The Order 1886 HK Version Chinese/English Subs', '61.99', 1, 'Condition:Brand New: An item that has never been opened or removed from the manufacturer'' s sealing (if applicable). Item is in original shrink wrap (if applicable). See the seller'' s listing for full details. Release Year:2015', 'VideoGames', 'PlayStation', '2015-04-27');
