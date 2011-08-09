-- phpMyAdmin SQL Dump
-- version 3.4.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 09, 2011 at 05:31 PM
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
-- Table structure for table `branches`
--

CREATE TABLE IF NOT EXISTS `branches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`) VALUES
(1, 'Surabaya'),
(2, 'Malang'),
(3, 'Jakarta'),
(4, 'semarang');

-- --------------------------------------------------------

--
-- Table structure for table `branches_simple_auth_users`
--

CREATE TABLE IF NOT EXISTS `branches_simple_auth_users` (
  `branch_id` int(11) NOT NULL,
  `simple_auth_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branches_simple_auth_users`
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
('1b12aa4335c0b703c2abce5f01f11045', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:5.0) Gecko/', 1312882093, 'a:4:{s:2:"id";s:1:"1";s:8:"username";s:5:"pujie";s:5:"email";s:14:"pujie@padi.net";s:4:"salt";s:40:"a6e5230560ae5b8b39ff38dbacbf860d2bf56b42";}');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `branch_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `LAINNYA` varchar(100) NOT NULL DEFAULT '',
  `NAMA_PELANGGAN` varchar(200) NOT NULL DEFAULT '',
  `JENIS_USAHA` varchar(200) NOT NULL DEFAULT '',
  `SIUP` varchar(200) NOT NULL DEFAULT '',
  `NPWP` varchar(200) NOT NULL DEFAULT '',
  `ALAMAT` varchar(255) NOT NULL DEFAULT '',
  `TELP` varchar(15) DEFAULT NULL,
  `FAX` varchar(15) DEFAULT '',
  `NAMA_PEMOHON` varchar(200) DEFAULT NULL,
  `NO_FB` varchar(20) DEFAULT NULL,
  `TGL_FB` date DEFAULT NULL,
  `NO_ID` varchar(150) NOT NULL DEFAULT '',
  `TELP_HP` varchar(50) DEFAULT '',
  `HP` varchar(13) DEFAULT NULL,
  `HP2` varchar(13) DEFAULT NULL,
  `EMAIL` varchar(150) DEFAULT NULL,
  `BIAYA_SETUP` double DEFAULT NULL,
  `BIAYA_BERLANGGANAN_BULANAN` double DEFAULT NULL,
  `BIAYA_PERANGKAT` double DEFAULT NULL,
  `BIAYA_LAINNYA` double DEFAULT NULL,
  `KETERANGAN_LAYANAN` tinytext,
  `TGL_AKTIFASI` date DEFAULT NULL,
  `PERIODE_LANGGANAN` date DEFAULT NULL,
  `REQUEST_KHUSUS` tinytext,
  `ACCOUNT_MANAGER` char(13) DEFAULT NULL,
  `STATUS` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '0 = non aktif 1 = aktif 2 = mantan client',
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `KODE_PELANGGAN` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `IDX_KODE_PELANGGAN` (`KODE_PELANGGAN`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=754 ;



-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `url` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `name`, `url`) VALUES
(1, 'Administrator', 'administrator'),
(2, 'Marketing', 'clients/list_clients');

-- --------------------------------------------------------

--
-- Table structure for table `modules_simple_auth_users`
--

CREATE TABLE IF NOT EXISTS `modules_simple_auth_users` (
  `module_id` int(11) NOT NULL,
  `simple_auth_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `simple_auth_users`
--

INSERT INTO `simple_auth_users` (`id`, `username`, `email`, `password`, `salt`, `status`) VALUES
(1, 'pujie', 'pujie@padi.net', 'c11926cf527f8553e8b9c56ec0e5c8de83696d48', 'a6e5230560ae5b8b39ff38dbacbf860d2bf56b42', 1),

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


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `ALIAS` varchar(50) NOT NULL,
  `TANGGAL` datetime NOT NULL,
  `LOGIN_AKHIR` datetime NOT NULL,
  `STATUS` enum('0','1') NOT NULL DEFAULT '0',
  `ONLINE` enum('0','1') NOT NULL DEFAULT '0',
  `ID_LEVEL` int(11) NOT NULL,
  `AM` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `USERNAME` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
