-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 15, 2017 at 04:27 AM
-- Server version: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `utable`
--

-- --------------------------------------------------------

--
-- Table structure for table `st`
--

DROP TABLE IF EXISTS `st`;
CREATE TABLE IF NOT EXISTS `st` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `site_name` varchar(50) DEFAULT NULL,
  `site_id` varchar(20) DEFAULT NULL,
  `site_div` varchar(15) DEFAULT NULL,
  `street` varchar(25) DEFAULT NULL,
  `city` varchar(25) DEFAULT NULL,
  `county` varchar(25) DEFAULT NULL,
  `state` varchar(10) DEFAULT NULL,
  `zipcode` varchar(10) DEFAULT NULL,
  `lat_dec` decimal(10,0) DEFAULT NULL,
  `lat_dms` varchar(25) DEFAULT NULL,
  `lat_deg` varchar(4) DEFAULT NULL,
  `lat_min` varchar(3) DEFAULT NULL,
  `lat_sec` varchar(6) DEFAULT NULL,
  `long_dec` varchar(10) DEFAULT NULL,
  `long_dms` varchar(25) DEFAULT NULL,
  `long_deg` varchar(4) DEFAULT NULL,
  `long_min` varchar(3) DEFAULT NULL,
  `long_sec` varchar(6) DEFAULT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `str_type` varchar(25) DEFAULT NULL,
  `str_id` varchar(25) DEFAULT NULL,
  `twr_type` varchar(25) DEFAULT NULL,
  `elev_grd` varchar(10) DEFAULT NULL,
  `height` varchar(8) DEFAULT NULL,
  `agl` varchar(10) DEFAULT NULL,
  `amsl` varchar(10) DEFAULT NULL,
  `bta_nbr` varchar(10) DEFAULT NULL,
  `bta_name` varchar(25) DEFAULT NULL,
  `mta_nbr` varchar(10) DEFAULT NULL,
  `mta_name` varchar(25) DEFAULT NULL,
  `fcc_nbr` varchar(10) DEFAULT NULL,
  `faa_nbr` varchar(20) DEFAULT NULL,
  `fa_nbr` varchar(11) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `createdOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedBy` int(11) DEFAULT NULL,
  `modifiedOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `st`
--

INSERT INTO `st` (`id`, `site_name`, `site_id`, `site_div`, `street`, `city`, `county`, `state`, `zipcode`, `lat_dec`, `lat_dms`, `lat_deg`, `lat_min`, `lat_sec`, `long_dec`, `long_dms`, `long_deg`, `long_min`, `long_sec`, `first_name`, `last_name`, `phone`, `email`, `str_type`, `str_id`, `twr_type`, `elev_grd`, `height`, `agl`, `amsl`, `bta_nbr`, `bta_name`, `mta_nbr`, `mta_name`, `fcc_nbr`, `faa_nbr`, `fa_nbr`, `status`, `createdBy`, `createdOn`, `modifiedBy`, `modifiedOn`) VALUES
(1, 'Phenix City', 'AL-01', NULL, NULL, NULL, 'Russell', 'AL', 'n/a', '32', NULL, NULL, NULL, NULL, '-85.002222', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '340', NULL, '479', '819', NULL, NULL, NULL, NULL, '1037006', '1994-ASO-2485-OE', NULL, NULL, NULL, '2017-12-15 04:23:56', NULL, '2017-12-15 04:23:56'),
(2, 'Ozark', 'AL-02', NULL, NULL, NULL, 'Dale', 'AL', 'n/a', '31', NULL, NULL, NULL, NULL, '-85.636083', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '392', NULL, '373', '765', NULL, NULL, NULL, NULL, '1233618', '2004-ASO-939-OE', NULL, NULL, NULL, '2017-12-15 04:23:56', NULL, '2017-12-15 04:23:56'),
(3, 'Frost', 'AL-03', NULL, NULL, NULL, 'Walker', 'AL', '35504', '34', NULL, NULL, NULL, NULL, '-87.23061', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '340', '340', NULL, NULL, NULL, NULL, '1281701', '2011-ASO-2801-OE', NULL, NULL, NULL, '2017-12-15 04:23:56', NULL, '2017-12-15 04:23:56'),
(4, 'Titus', 'AL-04', NULL, NULL, NULL, 'Elmore', 'AL', '36080', '33', NULL, NULL, NULL, NULL, '-86.2365', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '157', NULL, '128', '285', NULL, NULL, NULL, NULL, '1274649', '2011-ASO-4354-OE ', NULL, NULL, NULL, '2017-12-15 04:23:56', NULL, '2017-12-15 04:23:56'),
(5, 'Montgomery', 'AL-05', NULL, NULL, NULL, 'Montgomery', 'AL', '36110', '32', NULL, NULL, NULL, NULL, '-86.282111', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '320', NULL, '163', '483', NULL, NULL, NULL, NULL, '1279267', '2011-ASO-1203-OE ', NULL, NULL, NULL, '2017-12-15 04:23:56', NULL, '2017-12-15 04:23:56'),
(6, 'Waterloo SE', 'AL-06', NULL, NULL, NULL, 'Lauderdale', 'AL', '35677', '35', NULL, NULL, NULL, NULL, '-87.966', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '349', NULL, '802', '1151', NULL, NULL, NULL, NULL, '1284252', '2012-ASO-3451-OE ', NULL, NULL, NULL, '2017-12-15 04:23:56', NULL, '2017-12-15 04:23:56'),
(7, 'Ethelsville', 'AL-07', NULL, NULL, NULL, 'Pickens', 'AL', '35461', '33', NULL, NULL, NULL, NULL, '-88.202306', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '398', NULL, '425', '823', NULL, NULL, NULL, NULL, '1284208', '2012-ASO-54-OE', NULL, NULL, NULL, '2017-12-15 04:23:56', NULL, '2017-12-15 04:23:56'),
(8, 'Phenix City 1', 'AL-08', NULL, NULL, NULL, 'Lee', 'AL', '36867', '33', NULL, NULL, NULL, NULL, '-85.01139', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '467', NULL, '463', '930', NULL, NULL, NULL, NULL, '1036628', '1997-ASO-2779-OE', NULL, NULL, NULL, '2017-12-15 04:23:56', NULL, '2017-12-15 04:23:56'),
(9, 'Phenix City 2 ', 'AL-09', NULL, NULL, NULL, 'Lee', 'AL', '36867', '33', NULL, NULL, NULL, NULL, '-85.01139', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '462', NULL, '459', '921', NULL, NULL, NULL, NULL, '1036628', '1997-ASO-2779-OE', NULL, NULL, NULL, '2017-12-15 04:23:56', NULL, '2017-12-15 04:23:56'),
(10, 'Pine Apple', 'AL-10', NULL, NULL, NULL, 'Wilcox', 'AL', '36768', '32', NULL, NULL, NULL, NULL, '-86.977306', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '336', NULL, '419.9', '755.9', NULL, NULL, NULL, NULL, '1274650', '2010-ASO-32-OE', NULL, NULL, NULL, '2017-12-15 04:23:56', NULL, '2017-12-15 04:23:56'),
(11, 'Phenix City', 'AL-01', NULL, NULL, NULL, 'Russell', 'AL', 'n/a', '32', NULL, NULL, NULL, NULL, '-85.002222', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '340', NULL, '479', '819', NULL, NULL, NULL, NULL, '1037006', '1994-ASO-2485-OE', NULL, NULL, NULL, '2017-12-15 04:24:50', NULL, '2017-12-15 04:24:50'),
(12, 'Ozark', 'AL-02', NULL, NULL, NULL, 'Dale', 'AL', 'n/a', '31', NULL, NULL, NULL, NULL, '-85.636083', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '392', NULL, '373', '765', NULL, NULL, NULL, NULL, '1233618', '2004-ASO-939-OE', NULL, NULL, NULL, '2017-12-15 04:24:50', NULL, '2017-12-15 04:24:50'),
(13, 'Frost', 'AL-03', NULL, NULL, NULL, 'Walker', 'AL', '35504', '34', NULL, NULL, NULL, NULL, '-87.23061', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '340', '340', NULL, NULL, NULL, NULL, '1281701', '2011-ASO-2801-OE', NULL, NULL, NULL, '2017-12-15 04:24:50', NULL, '2017-12-15 04:24:50'),
(14, 'Titus', 'AL-04', NULL, NULL, NULL, 'Elmore', 'AL', '36080', '33', NULL, NULL, NULL, NULL, '-86.2365', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '157', NULL, '128', '285', NULL, NULL, NULL, NULL, '1274649', '2011-ASO-4354-OE ', NULL, NULL, NULL, '2017-12-15 04:24:50', NULL, '2017-12-15 04:24:50'),
(15, 'Montgomery', 'AL-05', NULL, NULL, NULL, 'Montgomery', 'AL', '36110', '32', NULL, NULL, NULL, NULL, '-86.282111', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '320', NULL, '163', '483', NULL, NULL, NULL, NULL, '1279267', '2011-ASO-1203-OE ', NULL, NULL, NULL, '2017-12-15 04:24:50', NULL, '2017-12-15 04:24:50'),
(16, 'Waterloo SE', 'AL-06', NULL, NULL, NULL, 'Lauderdale', 'AL', '35677', '35', NULL, NULL, NULL, NULL, '-87.966', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '349', NULL, '802', '1151', NULL, NULL, NULL, NULL, '1284252', '2012-ASO-3451-OE ', NULL, NULL, NULL, '2017-12-15 04:24:50', NULL, '2017-12-15 04:24:50'),
(17, 'Ethelsville', 'AL-07', NULL, NULL, NULL, 'Pickens', 'AL', '35461', '33', NULL, NULL, NULL, NULL, '-88.202306', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '398', NULL, '425', '823', NULL, NULL, NULL, NULL, '1284208', '2012-ASO-54-OE', NULL, NULL, NULL, '2017-12-15 04:25:29', NULL, '2017-12-15 04:25:29'),
(18, 'Phenix City 1', 'AL-08', NULL, NULL, NULL, 'Lee', 'AL', '36867', '33', NULL, NULL, NULL, NULL, '-85.01139', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '467', NULL, '463', '930', NULL, NULL, NULL, NULL, '1036628', '1997-ASO-2779-OE', NULL, NULL, NULL, '2017-12-15 04:25:59', NULL, '2017-12-15 04:25:59'),
(19, 'Phenix City 2 ', 'AL-09', NULL, NULL, NULL, 'Lee', 'AL', '36867', '33', NULL, NULL, NULL, NULL, '-85.01139', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '462', NULL, '459', '921', NULL, NULL, NULL, NULL, '1036628', '1997-ASO-2779-OE', NULL, NULL, NULL, '2017-12-15 04:25:59', NULL, '2017-12-15 04:25:59'),
(20, 'Pine Apple', 'AL-10', NULL, NULL, NULL, 'Wilcox', 'AL', '36768', '32', NULL, NULL, NULL, NULL, '-86.977306', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '336', NULL, '419.9', '755.9', NULL, NULL, NULL, NULL, '1274650', '2010-ASO-32-OE', NULL, NULL, NULL, '2017-12-15 04:25:59', NULL, '2017-12-15 04:25:59'),
(21, 'Phenix City 1', 'AL-08', NULL, NULL, NULL, 'Lee', 'AL', '36867', '33', NULL, NULL, NULL, NULL, '-85.01139', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '467', NULL, '463', '930', NULL, NULL, NULL, NULL, '1036628', '1997-ASO-2779-OE', NULL, NULL, NULL, '2017-12-15 04:26:22', NULL, '2017-12-15 04:26:22'),
(22, 'Phenix City 2 ', 'AL-09', NULL, NULL, NULL, 'Lee', 'AL', '36867', '33', NULL, NULL, NULL, NULL, '-85.01139', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '462', NULL, '459', '921', NULL, NULL, NULL, NULL, '1036628', '1997-ASO-2779-OE', NULL, NULL, NULL, '2017-12-15 04:26:22', NULL, '2017-12-15 04:26:22'),
(23, 'Pine Apple', 'AL-10', NULL, NULL, NULL, 'Wilcox', 'AL', '36768', '32', NULL, NULL, NULL, NULL, '-86.977306', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '336', NULL, '419.9', '755.9', NULL, NULL, NULL, NULL, '1274650', '2010-ASO-32-OE', NULL, NULL, NULL, '2017-12-15 04:26:22', NULL, '2017-12-15 04:26:22');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;