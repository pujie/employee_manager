-- phpMyAdmin SQL Dump
-- version 3.4.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 11, 2011 at 05:58 PM
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



-- --------------------------------------------------------

--
-- Table structure for table `business_fields`
--

CREATE TABLE IF NOT EXISTS `business_fields` (
  `name` varchar(200) NOT NULL DEFAULT '',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=71 ;

--
-- Dumping data for table `business_fields`
--

INSERT INTO `business_fields` (`name`, `id`) VALUES
('Jasa Pendidikan', 1),
('Rumah Sakit', 2),
('Marketer and Distributor of Healtcare & Consumer Goods', 3),
('Apartemen', 4),
('', 5),
('Perusahaan Jasa Tenaga Kerja Indonesia', 6),
('Game on line', 7),
('Multiplayer Game', 8),
('Supermarket', 9),
('Karet', 10),
('Cafe', 11),
('Pialang Bursa Berjangka', 12),
('Personal', 13),
('Perbankan', 14),
('Elektronik Retail', 15),
('Konstruksi', 16),
('Jasa Survey dan Mapping', 17),
('Supplier alat kantor', 18),
('Perhotelan', 19),
('Jasa Penunjang Hiburan', 20),
('Medical Suplier', 21),
('Jasa Angkutan', 22),
('Perorangan', 23),
('perdagangan Barang', 24),
('Machinery', 25),
('Corporate', 26),
('Gereja', 27),
('Perdagangan BarangTeknik', 28),
('Kontraktor', 29),
('Perdagangan Elektronik', 30),
('Export - Import', 31),
('Jasa Sistem Komunikasi', 32),
('Manufaktur', 33),
('Wood Manufacturing', 34),
('Exportir, Manufacturer', 35),
('Perseorangan', 36),
('Franchise Bakso Kepala Sapi', 37),
('Jasa Perjalanan Wisata', 38),
('Perdagangan', 39),
('Jasa Periklanan', 40),
('Jasa', 41),
('Distributor elektronik', 42),
('IT Integrator', 43),
('Content Provider', 44),
('Kertas Industri, buku tulis', 45),
('Hotel/Hospitaly', 46),
('Pelayaran/cargo', 47),
('Industri', 48),
('Trading', 49),
('Manufactur', 50),
('Security system', 51),
('Developer real estate', 52),
('Autorizhed Dealler Indosat', 53),
('Resto', 54),
('Internet Service Provider', 55),
('Variasi velg', 56),
('Lembaga Pendidikan', 57),
('Sekolah', 58),
('Export Import ProdukPertanian', 59),
('Pabrik Kertas', 60),
('Perdagangan barang dan jasa', 61),
('Jasa Konstruksi dan Manufaktur', 62),
('Universitas', 63),
('Warnet', 64),
('Manufactured', 65),
('Edukasi', 66),
('Akademik', 67),
('Finance Sekuritas', 68),
('Perusahaan', 69),
('Pulsa Online', 70);

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
('963720f29b2b07748793aed763a016be', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:5.0) Gecko/', 1313056389, 'a:4:{s:2:"id";s:1:"1";s:8:"username";s:5:"pujie";s:5:"email";s:14:"pujie@padi.net";s:4:"salt";s:40:"a6e5230560ae5b8b39ff38dbacbf860d2bf56b42";}');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `branch_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `business_field_id` int(11) DEFAULT NULL,
  `lainnya` varchar(100) NOT NULL DEFAULT '',
  `name` varchar(200) NOT NULL DEFAULT '',
  `SIUP` varchar(200) NOT NULL DEFAULT '',
  `NPWP` varchar(200) NOT NULL DEFAULT '',
  `address` varchar(255) NOT NULL DEFAULT '',
  `telp` varchar(15) DEFAULT NULL,
  `fax` varchar(15) DEFAULT NULL,
  `applicant` varchar(200) DEFAULT NULL,
  `NO_FB` varchar(20) DEFAULT NULL,
  `fb_date` date DEFAULT NULL,
  `NO_ID` varchar(150) NOT NULL DEFAULT '',
  `TELP_HP` varchar(50) DEFAULT '',
  `HP` varchar(13) DEFAULT NULL,
  `HP2` varchar(13) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `BIAYA_SETUP` double DEFAULT NULL,
  `BIAYA_BERLANGGANAN_BULANAN` double DEFAULT NULL,
  `BIAYA_PERANGKAT` double DEFAULT NULL,
  `BIAYA_LAINNYA` double DEFAULT NULL,
  `KETERANGAN_LAYANAN` tinytext,
  `activation_date` date DEFAULT NULL,
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

--
-- Dumping data for table `modules_simple_auth_users`
--


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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

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

--
-- Dumping data for table `users`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
