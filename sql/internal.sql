-- phpMyAdmin SQL Dump
-- version 3.4.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 23, 2011 at 03:09 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `internal`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `SINGKATAN` char(1) NOT NULL,
  `KATEGORI` varchar(100) NOT NULL,
  `STATUS` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `SINGKATAN`, `KATEGORI`, `STATUS`) VALUES
(1, 'C', 'xxx', '1'),
(2, 'G', 'yyy', '1'),
(3, 'P', 'zzz', '1'),
(4, 'O', 'www', '1');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(50) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('a7ec10bf34050d130613f035d010e395', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:5.0) Gecko/', 1311402683, 'a:4:{s:7:"user_id";s:1:"1";s:8:"username";s:5:"pujie";s:5:"email";s:14:"pujie@padi.net";s:4:"salt";s:40:"a6e5230560ae5b8b39ff38dbacbf860d2bf56b42";}');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_WILAYAH` char(1) NOT NULL,
  `category_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `LAINNYA` varchar(100) NOT NULL,
  `NAMA_PELANGGAN` varchar(200) NOT NULL,
  `JENIS_USAHA` varchar(200) NOT NULL,
  `SIUP` varchar(200) NOT NULL,
  `NPWP` varchar(200) NOT NULL,
  `ALAMAT` varchar(255) NOT NULL,
  `TELP` varchar(15) NOT NULL,
  `FAX` varchar(15) NOT NULL,
  `NAMA_PEMOHON` varchar(200) NOT NULL,
  `NO_FB` varchar(20) DEFAULT NULL,
  `TGL_FB` date NOT NULL,
  `NO_ID` varchar(150) NOT NULL,
  `TELP_HP` varchar(50) NOT NULL,
  `HP` varchar(13) DEFAULT NULL,
  `HP2` varchar(13) DEFAULT NULL,
  `EMAIL` varchar(150) NOT NULL,
  `BIAYA_SETUP` double NOT NULL,
  `BIAYA_BERLANGGANAN_BULANAN` double NOT NULL,
  `BIAYA_PERANGKAT` double NOT NULL,
  `BIAYA_LAINNYA` double NOT NULL,
  `KETERANGAN_LAYANAN` tinytext,
  `TGL_AKTIFASI` date NOT NULL,
  `PERIODE_LANGGANAN` date NOT NULL,
  `REQUEST_KHUSUS` tinytext,
  `ACCOUNT_MANAGER` char(13) NOT NULL,
  `STATUS` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '0 = non aktif 1 = aktif 2 = mantan client',
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `KODE_PELANGGAN` varchar(30) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `IDX_KODE_PELANGGAN` (`KODE_PELANGGAN`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=156 ;

--
-- Dumping data for table `clients`
--


-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `name`) VALUES
(1, 'Administrator'),
(2, 'Marketing');

-- --------------------------------------------------------

--
-- Table structure for table `modules_simple_auth_users`
--

CREATE TABLE IF NOT EXISTS `modules_simple_auth_users` (
  `module_id` int(11) NOT NULL,
  `simple_auth_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modules_simple_auth_users`
--

INSERT INTO `modules_simple_auth_users` (`module_id`, `simple_auth_user_id`) VALUES
(1, 1),
(2, 1),
(2, 2),
(2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `idproduct` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `description` varchar(145) DEFAULT NULL,
  PRIMARY KEY (`idproduct`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`idproduct`, `name`, `description`) VALUES
(1, 'jajan', 'jajanan'),
(2, 'x', 'x'),
(3, 'a', 'a'),
(4, 'b', 'b'),
(5, 'c', 'c'),
(6, 'r', 'r'),
(7, 's', 's'),
(8, 't', 't'),
(9, 'n', 'n');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE IF NOT EXISTS `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `SINGKATAN` char(4) NOT NULL,
  `LAYANAN` varchar(100) NOT NULL,
  `USERNAME` varchar(30) NOT NULL,
  `TGL` date NOT NULL,
  `STATUS` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `services`
--


-- --------------------------------------------------------

--
-- Table structure for table `simple_auth_passwd_request`
--

CREATE TABLE IF NOT EXISTS `simple_auth_passwd_request` (
  `user_id` int(11) NOT NULL,
  `hash` varchar(40) NOT NULL,
  `request_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`hash`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `simple_auth_users`
--

CREATE TABLE IF NOT EXISTS `simple_auth_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  `salt` varchar(40) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `simple_auth_users`
--


-- --------------------------------------------------------

--
-- Table structure for table `tb_hub_pelanggan`
--

CREATE TABLE IF NOT EXISTS `tb_hub_pelanggan` (
  `ID_PELANGGAN` int(11) NOT NULL,
  `NAMA` varchar(200) DEFAULT NULL,
  `TELP_HP` varchar(50) DEFAULT NULL,
  `HP` varchar(13) DEFAULT NULL,
  `HP2` varchar(13) DEFAULT NULL,
  `EMAIL` varchar(200) DEFAULT NULL,
  `ALAMAT` text,
  `TIPE` enum('administrasi','teknis','penagihan','support') NOT NULL,
  `URUTAN` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_hub_pelanggan`
--


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `USERNAME` varchar(30) NOT NULL,
  `PASSWORD` varchar(32) NOT NULL,
  `ALIAS` varchar(50) NOT NULL,
  `TANGGAL` datetime NOT NULL,
  `LOGIN_AKHIR` datetime NOT NULL,
  `STATUS` enum('0','1') NOT NULL DEFAULT '0',
  `ONLINE` enum('0','1') NOT NULL DEFAULT '0',
  `ID_LEVEL` int(11) NOT NULL,
  `AM` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `USERNAME` (`USERNAME`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `users`
--

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
