-- MySQL dump 10.13  Distrib 5.5.46, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: internal
-- ------------------------------------------------------
-- Server version	5.5.46-0ubuntu0.14.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `activity_logs`
--

DROP TABLE IF EXISTS `activity_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `act_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `act` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ipaddr` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=260 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `branches`
--

DROP TABLE IF EXISTS `branches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `branches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `abbr` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `branches_users`
--

DROP TABLE IF EXISTS `branches_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `branches_users` (
  `branch_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `business_fields`
--

DROP TABLE IF EXISTS `business_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `business_fields` (
  `name` varchar(200) NOT NULL DEFAULT '',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `abbreviation` char(1) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(50) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `branch_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `business_field_id` int(11) DEFAULT NULL,
  `lainnya` varchar(100) NOT NULL DEFAULT '',
  `name` varchar(200) NOT NULL DEFAULT '',
  `siup` varchar(200) NOT NULL DEFAULT '',
  `npwp` varchar(200) NOT NULL DEFAULT '',
  `address` varchar(255) NOT NULL DEFAULT '',
  `telp` varchar(15) DEFAULT NULL,
  `phone_area_pemohon` varchar(4) DEFAULT NULL,
  `phone_area` varchar(4) DEFAULT NULL,
  `fax` varchar(15) DEFAULT NULL,
  `applicant` varchar(200) DEFAULT NULL,
  `applicant_religion_id` smallint(6) DEFAULT NULL,
  `applicant_position` varchar(15) DEFAULT NULL,
  `no_fb` varchar(20) DEFAULT 'id',
  `fb_date` date DEFAULT NULL,
  `no_id` varchar(150) NOT NULL DEFAULT '',
  `telp_hp` varchar(50) DEFAULT NULL,
  `hp` varchar(13) DEFAULT NULL,
  `hp2` varchar(13) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `setup_fee` decimal(15,2) DEFAULT NULL,
  `setup_fee_cur` varchar(1) DEFAULT NULL,
  `monthly_subscription_fee` decimal(15,2) DEFAULT NULL,
  `monthly_subscription_fee_cur` varchar(1) DEFAULT NULL,
  `device_fee` decimal(15,2) DEFAULT NULL,
  `device_fee_cur` varchar(1) DEFAULT NULL,
  `other_fee` decimal(15,2) DEFAULT NULL,
  `other_fee_cur` varchar(1) DEFAULT NULL,
  `service_information` tinytext,
  `activation_date` date DEFAULT NULL,
  `subscription_period` date DEFAULT NULL,
  `subscription_period2` date DEFAULT NULL,
  `special_request` tinytext,
  `sale_id` int(11) DEFAULT NULL,
  `status_id` enum('0','1','2') NOT NULL DEFAULT '1' COMMENT '0 = non aktif 1 = aktif 2 = mantan client',
  `tanggal` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `kode_pelanggan` varchar(30) DEFAULT NULL,
  `state_id` int(11) DEFAULT '1',
  `security_deposit` decimal(15,2) DEFAULT NULL,
  `security_deposit_ppn` varchar(1) DEFAULT NULL,
  `security_deposit_cur` varchar(1) DEFAULT NULL,
  `security_deposit2` decimal(15,2) DEFAULT NULL,
  `security_deposit2_cur` varchar(1) DEFAULT NULL,
  `setup_fee_ppn` varchar(1) DEFAULT 'n',
  `monthly_subscription_fee_ppn` varchar(1) DEFAULT 'n',
  `device_fee_ppn` varchar(1) DEFAULT 'n',
  `other_fee_ppn` varchar(1) DEFAULT 'n',
  `faktur_pajak` varchar(1) DEFAULT 'n',
  `setup_fee_pph` varchar(1) DEFAULT 'n',
  `biaya_material` decimal(15,2) DEFAULT NULL,
  `biaya_material_cur` varchar(1) DEFAULT NULL,
  `biaya_material_ppn` varchar(1) DEFAULT NULL,
  `biaya_material_pph` varchar(1) DEFAULT NULL,
  `subscription_freqwency_id` int(11) DEFAULT NULL,
  `maintenance_freqwency_id` int(11) DEFAULT NULL,
  `payment_freqwency` smallint(6) DEFAULT NULL,
  `payment_freqwency_period` varchar(1) DEFAULT NULL,
  `device_date` datetime DEFAULT NULL,
  `device_warranty` varchar(1) DEFAULT NULL,
  `server_location` varchar(1) DEFAULT NULL,
  `domainperiode1` datetime DEFAULT NULL,
  `domainperiode2` datetime DEFAULT NULL,
  `hostingperiode1` datetime DEFAULT NULL,
  `hostingperiode2` datetime DEFAULT NULL,
  `hosting_package_id` smallint(6) DEFAULT NULL,
  `domainname` varchar(20) DEFAULT NULL,
  `maintenance_fee` double DEFAULT NULL,
  `maintenance_fee_cur` varchar(1) DEFAULT NULL,
  `maintenanceperiode1` datetime DEFAULT NULL,
  `maintenanceperiode2` datetime DEFAULT NULL,
  `projectdp_fee` double DEFAULT NULL,
  `projectdp_fee_ppn` varchar(1) DEFAULT NULL,
  `projectdp_fee_pph` varchar(1) DEFAULT NULL,
  `projectdp_fee_cur` varchar(1) DEFAULT NULL,
  `projecttermin1_fee` double DEFAULT NULL,
  `projecttermin1_fee_ppn` varchar(1) DEFAULT NULL,
  `projecttermin1_fee_pph` varchar(1) DEFAULT NULL,
  `projecttermin1_fee_cur` varchar(1) DEFAULT NULL,
  `projecttermin2_fee` double DEFAULT NULL,
  `projecttermin2_fee_ppn` varchar(1) DEFAULT NULL,
  `projecttermin2_fee_pph` varchar(1) DEFAULT NULL,
  `projecttermin2_fee_cur` varchar(1) DEFAULT NULL,
  `projecttermin3_fee` double DEFAULT NULL,
  `projecttermin3_fee_ppn` varchar(1) DEFAULT NULL,
  `projecttermin3_fee_pph` varchar(1) DEFAULT NULL,
  `projecttermin3_fee_cur` varchar(1) DEFAULT NULL,
  `projecttermin4_fee` double DEFAULT NULL,
  `projecttermin4_fee_ppn` varchar(1) DEFAULT NULL,
  `projecttermin4_fee_pph` varchar(1) DEFAULT NULL,
  `project_faktur_pajak` varchar(1) DEFAULT NULL,
  `projecttermin4_fee_cur` varchar(1) DEFAULT NULL,
  `projecttermin1_jt` datetime DEFAULT NULL,
  `projecttermin2_jt` datetime DEFAULT NULL,
  `projecttermin3_jt` datetime DEFAULT NULL,
  `projecttermin4_jt` datetime DEFAULT NULL,
  `webappdp_fee` double DEFAULT NULL,
  `webappdp_fee_ppn` varchar(1) DEFAULT NULL,
  `webappdp_fee_pph` varchar(1) DEFAULT NULL,
  `webappdp_fee_cur` varchar(1) DEFAULT NULL,
  `webapptermin1_fee` double DEFAULT NULL,
  `webapptermin1_fee_ppn` varchar(1) DEFAULT NULL,
  `webapptermin1_fee_pph` varchar(1) DEFAULT NULL,
  `webapptermin1_fee_cur` varchar(1) DEFAULT NULL,
  `webapptermin2_fee` double DEFAULT NULL,
  `webapptermin2_fee_ppn` varchar(1) DEFAULT NULL,
  `webapptermin2_fee_pph` varchar(1) DEFAULT NULL,
  `webapptermin2_fee_cur` varchar(1) DEFAULT NULL,
  `webapptermin3_fee` double DEFAULT NULL,
  `webapptermin3_fee_ppn` varchar(1) DEFAULT NULL,
  `webapptermin3_fee_pph` varchar(1) DEFAULT NULL,
  `webapptermin3_fee_cur` varchar(1) DEFAULT NULL,
  `webapptermin4_fee` double DEFAULT NULL,
  `webapptermin4_fee_ppn` varchar(1) DEFAULT NULL,
  `webapp_faktur_pajak` varchar(1) DEFAULT NULL,
  `webapptermin4_fee_pph` varchar(1) DEFAULT NULL,
  `webapptermin4_fee_cur` varchar(1) DEFAULT NULL,
  `note` blob,
  `fax_kode_area` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `IDX_KODE_PELANGGAN` (`kode_pelanggan`)
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `internal`.`no_fb` BEFORE INSERT ON `internal`.`clients`
 FOR EACH ROW BEGIN
DECLARE next_id INT;
DECLARE branch varchar(5);
declare branch2 varchar(1);
declare category varchar(1);
declare service varchar(4);
declare total_rows int;
select abbr into branch from branches where id=new.branch_id;
   SET next_id = (SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME='clients');
   SET NEW.no_fb=concat(branch,'-',year(curdate()),month(curdate()),'-',lpad(next_id,4,'0'));
select left(name,1) into branch2 from branches where id=new.branch_id;
select abbreviation into category from categories where id=new.category_id;
select singkatan into service from services where id=new.service_id;
select count(*)+1 into total_rows from clients;
set new.kode_pelanggan=concat(branch2,category,service,lpad(total_rows,4,'0'));
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `clients_sales`
--

DROP TABLE IF EXISTS `clients_sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients_sales` (
  `client_id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `telp_hp` varchar(50) DEFAULT NULL,
  `hp` varchar(13) DEFAULT NULL,
  `hp2` varchar(13) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `address` text,
  `tipe` enum('administrasi','teknis','penagihan','support','penanggungjawab') NOT NULL,
  `ktp` varchar(20) DEFAULT NULL,
  `position` varchar(30) DEFAULT NULL,
  `phone_area` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=326 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `currencies`
--

DROP TABLE IF EXISTS `currencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `currencies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `departments_users`
--

DROP TABLE IF EXISTS `departments_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departments_users` (
  `department_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `domains`
--

DROP TABLE IF EXISTS `domains`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domains` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `periode1` date DEFAULT NULL,
  `periode2` date DEFAULT NULL,
  `active` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=104 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hosting_packages`
--

DROP TABLE IF EXISTS `hosting_packages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hosting_packages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `maintenance_freqwencies`
--

DROP TABLE IF EXISTS `maintenance_freqwencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `maintenance_freqwencies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `modules`
--

DROP TABLE IF EXISTS `modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `url` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `modules_users`
--

DROP TABLE IF EXISTS `modules_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modules_users` (
  `module_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `observers_users`
--

DROP TABLE IF EXISTS `observers_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `observers_users` (
  `observer_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `obsolete_table_users`
--

DROP TABLE IF EXISTS `obsolete_table_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `obsolete_table_users` (
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `idproduct` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `description` varchar(145) DEFAULT NULL,
  PRIMARY KEY (`idproduct`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `religions`
--

DROP TABLE IF EXISTS `religions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `religions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 COMMENT='inherited from user';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `singkatan` char(4) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(30) NOT NULL,
  `tgl` date NOT NULL,
  `status` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `simple_auth_passwd_request`
--

DROP TABLE IF EXISTS `simple_auth_passwd_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `simple_auth_passwd_request` (
  `user_id` int(11) NOT NULL,
  `hash` varchar(40) NOT NULL,
  `request_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`hash`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `spvs_users`
--

DROP TABLE IF EXISTS `spvs_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `spvs_users` (
  `user_id` int(11) DEFAULT NULL,
  `spv_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `states`
--

DROP TABLE IF EXISTS `states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subscription_freqwencies`
--

DROP TABLE IF EXISTS `subscription_freqwencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscription_freqwencies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tb_hub_pelanggan`
--

DROP TABLE IF EXISTS `tb_hub_pelanggan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_hub_pelanggan` (
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `todel1`
--

DROP TABLE IF EXISTS `todel1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `todel1` (
  `id` int(11) NOT NULL DEFAULT '0',
  `branch_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `business_field_id` int(11) DEFAULT NULL,
  `lainnya` varchar(100) NOT NULL DEFAULT '',
  `name` varchar(200) NOT NULL DEFAULT '',
  `siup` varchar(200) NOT NULL DEFAULT '',
  `npwp` varchar(200) NOT NULL DEFAULT '',
  `address` varchar(255) NOT NULL DEFAULT '',
  `telp` varchar(15) DEFAULT NULL,
  `phone_area_pemohon` varchar(4) DEFAULT NULL,
  `phone_area` varchar(4) DEFAULT NULL,
  `fax` varchar(15) DEFAULT NULL,
  `applicant` varchar(200) DEFAULT NULL,
  `applicant_religion_id` smallint(6) DEFAULT NULL,
  `applicant_position` varchar(15) DEFAULT NULL,
  `no_fb` varchar(20) DEFAULT 'id',
  `fb_date` date DEFAULT NULL,
  `no_id` varchar(150) NOT NULL DEFAULT '',
  `telp_hp` varchar(50) DEFAULT NULL,
  `hp` varchar(13) DEFAULT NULL,
  `hp2` varchar(13) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `setup_fee` decimal(15,2) DEFAULT NULL,
  `setup_fee_cur` varchar(1) DEFAULT NULL,
  `monthly_subscription_fee` decimal(15,2) DEFAULT NULL,
  `monthly_subscription_fee_cur` varchar(1) DEFAULT NULL,
  `device_fee` decimal(15,2) DEFAULT NULL,
  `device_fee_cur` varchar(1) DEFAULT NULL,
  `other_fee` decimal(15,2) DEFAULT NULL,
  `other_fee_cur` varchar(1) DEFAULT NULL,
  `service_information` tinytext,
  `activation_date` date DEFAULT NULL,
  `subscription_period` date DEFAULT NULL,
  `subscription_period2` date DEFAULT NULL,
  `special_request` tinytext,
  `sale_id` int(11) DEFAULT NULL,
  `status_id` enum('0','1','2') NOT NULL DEFAULT '1' COMMENT '0 = non aktif 1 = aktif 2 = mantan client',
  `tanggal` timestamp NULL DEFAULT NULL,
  `kode_pelanggan` varchar(30) DEFAULT NULL,
  `state_id` int(11) DEFAULT '1',
  `security_deposit` decimal(15,2) DEFAULT NULL,
  `security_deposit_ppn` varchar(1) DEFAULT NULL,
  `security_deposit_cur` varchar(1) DEFAULT NULL,
  `security_deposit2` decimal(15,2) DEFAULT NULL,
  `security_deposit2_cur` varchar(1) DEFAULT NULL,
  `setup_fee_ppn` varchar(1) DEFAULT 'n',
  `monthly_subscription_fee_ppn` varchar(1) DEFAULT 'n',
  `device_fee_ppn` varchar(1) DEFAULT 'n',
  `other_fee_ppn` varchar(1) DEFAULT 'n',
  `faktur_pajak` varchar(1) DEFAULT 'n',
  `setup_fee_pph` varchar(1) DEFAULT 'n',
  `biaya_material` decimal(15,2) DEFAULT NULL,
  `biaya_material_cur` varchar(1) DEFAULT NULL,
  `biaya_material_ppn` varchar(1) DEFAULT NULL,
  `biaya_material_pph` varchar(1) DEFAULT NULL,
  `subscription_freqwency_id` int(11) DEFAULT NULL,
  `maintenance_freqwency_id` int(11) DEFAULT NULL,
  `payment_freqwency` smallint(6) DEFAULT NULL,
  `payment_freqwency_period` varchar(1) DEFAULT NULL,
  `device_date` datetime DEFAULT NULL,
  `device_warranty` varchar(1) DEFAULT NULL,
  `server_location` varchar(1) DEFAULT NULL,
  `domainperiode1` datetime DEFAULT NULL,
  `domainperiode2` datetime DEFAULT NULL,
  `hostingperiode1` datetime DEFAULT NULL,
  `hostingperiode2` datetime DEFAULT NULL,
  `hosting_package_id` smallint(6) DEFAULT NULL,
  `domainname` varchar(20) DEFAULT NULL,
  `maintenance_fee` double DEFAULT NULL,
  `maintenance_fee_cur` varchar(1) DEFAULT NULL,
  `maintenanceperiode1` datetime DEFAULT NULL,
  `maintenanceperiode2` datetime DEFAULT NULL,
  `projectdp_fee` double DEFAULT NULL,
  `projectdp_fee_ppn` varchar(1) DEFAULT NULL,
  `projectdp_fee_pph` varchar(1) DEFAULT NULL,
  `projectdp_fee_cur` varchar(1) DEFAULT NULL,
  `projecttermin1_fee` double DEFAULT NULL,
  `projecttermin1_fee_ppn` varchar(1) DEFAULT NULL,
  `projecttermin1_fee_pph` varchar(1) DEFAULT NULL,
  `projecttermin1_fee_cur` varchar(1) DEFAULT NULL,
  `projecttermin2_fee` double DEFAULT NULL,
  `projecttermin2_fee_ppn` varchar(1) DEFAULT NULL,
  `projecttermin2_fee_pph` varchar(1) DEFAULT NULL,
  `projecttermin2_fee_cur` varchar(1) DEFAULT NULL,
  `projecttermin3_fee` double DEFAULT NULL,
  `projecttermin3_fee_ppn` varchar(1) DEFAULT NULL,
  `projecttermin3_fee_pph` varchar(1) DEFAULT NULL,
  `projecttermin3_fee_cur` varchar(1) DEFAULT NULL,
  `projecttermin4_fee` double DEFAULT NULL,
  `projecttermin4_fee_ppn` varchar(1) DEFAULT NULL,
  `projecttermin4_fee_pph` varchar(1) DEFAULT NULL,
  `project_faktur_pajak` varchar(1) DEFAULT NULL,
  `projecttermin4_fee_cur` varchar(1) DEFAULT NULL,
  `projecttermin1_jt` datetime DEFAULT NULL,
  `projecttermin2_jt` datetime DEFAULT NULL,
  `projecttermin3_jt` datetime DEFAULT NULL,
  `projecttermin4_jt` datetime DEFAULT NULL,
  `webappdp_fee` double DEFAULT NULL,
  `webappdp_fee_ppn` varchar(1) DEFAULT NULL,
  `webappdp_fee_pph` varchar(1) DEFAULT NULL,
  `webappdp_fee_cur` varchar(1) DEFAULT NULL,
  `webapptermin1_fee` double DEFAULT NULL,
  `webapptermin1_fee_ppn` varchar(1) DEFAULT NULL,
  `webapptermin1_fee_pph` varchar(1) DEFAULT NULL,
  `webapptermin1_fee_cur` varchar(1) DEFAULT NULL,
  `webapptermin2_fee` double DEFAULT NULL,
  `webapptermin2_fee_ppn` varchar(1) DEFAULT NULL,
  `webapptermin2_fee_pph` varchar(1) DEFAULT NULL,
  `webapptermin2_fee_cur` varchar(1) DEFAULT NULL,
  `webapptermin3_fee` double DEFAULT NULL,
  `webapptermin3_fee_ppn` varchar(1) DEFAULT NULL,
  `webapptermin3_fee_pph` varchar(1) DEFAULT NULL,
  `webapptermin3_fee_cur` varchar(1) DEFAULT NULL,
  `webapptermin4_fee` double DEFAULT NULL,
  `webapptermin4_fee_ppn` varchar(1) DEFAULT NULL,
  `webapp_faktur_pajak` varchar(1) DEFAULT NULL,
  `webapptermin4_fee_pph` varchar(1) DEFAULT NULL,
  `webapptermin4_fee_cur` varchar(1) DEFAULT NULL,
  `note` blob,
  `fax_kode_area` varchar(5) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  `salt` varchar(40) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `default_page` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `vieweds`
--

DROP TABLE IF EXISTS `vieweds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vieweds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `dt` datetime DEFAULT NULL,
  `ipaddr` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=147 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-08-24  8:55:24
