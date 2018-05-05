-- MySQL dump 10.16  Distrib 10.1.29-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: advertize
-- ------------------------------------------------------
-- Server version	10.1.29-MariaDB-6

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `adverts`
--

DROP TABLE IF EXISTS `adverts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adverts` (
  `idadvert` int(11) NOT NULL AUTO_INCREMENT,
  `useremail` varchar(255) NOT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `title` varchar(45) NOT NULL,
  `description` tinytext NOT NULL,
  `date_published` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `close_published` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` enum('online','offline') NOT NULL,
  `payment_visa` tinyint(1) DEFAULT NULL,
  `payment_paypal` tinyint(1) DEFAULT NULL,
  `payment_cashier` tinyint(1) DEFAULT NULL,
  `location_id` int(11) NOT NULL,
  `is_deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`idadvert`),
  KEY `fk_adverts_users` (`useremail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adverts`
--

LOCK TABLES `adverts` WRITE;
/*!40000 ALTER TABLE `adverts` DISABLE KEYS */;
/*!40000 ALTER TABLE `adverts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_cid` int(11) NOT NULL DEFAULT '0',
  `category_name` varchar(150) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,0,'T&amp;Eacute;L&amp;Eacute;PHONES &amp;amp; TABLETTES'),(2,0,'INFORMATIQUE'),(3,0,'TV &amp;amp; MULTIMEDIAS'),(4,0,'IMMOBILIER'),(5,0,'RENCONTRES'),(6,0,'LOISIRS'),(7,0,'AUTOMOBILES'),(8,1,'Smartphones'),(10,1,'Smartphones IOS'),(11,0,'MOTORS &amp; BIKES'),(12,1,'Tablettes Samsung'),(13,2,'Ordinateurs de bureau'),(14,2,'Ordinateurs portables'),(15,2,'Ecrans'),(16,2,'Unit&amp;eacute;s centrales'),(17,2,'Accessoires');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cities` (
  `country_code` char(3) NOT NULL,
  `code_postal` int(11) NOT NULL,
  `city_name` varchar(100) NOT NULL,
  PRIMARY KEY (`code_postal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Régions pour la localisation des annones';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cities`
--

LOCK TABLES `cities` WRITE;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
INSERT INTO `cities` VALUES ('CM',101,'Yaoundé'),('CM',102,'Kribi'),('CM',103,'Douala'),('CM',105,'Limbé'),('CM',106,'Bamenda'),('CM',107,'Buéa'),('CM',108,'Bertoua'),('CM',109,'Obala'),('CM',110,'Okola'),('Gab',2536,'Libreville'),('Gab',56632,'FranceVille');
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countries` (
  `country_code` char(3) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone_indicator` char(4) NOT NULL,
  PRIMARY KEY (`country_code`),
  UNIQUE KEY `countries_code_uindex` (`country_code`),
  UNIQUE KEY `countries_name_uindex` (`name`),
  UNIQUE KEY `countries_phone_indicator_uindex` (`phone_indicator`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Liste des pays, leurs codes et indicateurs téléphoniques';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES ('CM','Cameroun','237'),('FR','FRANCE','33'),('Gab','Gabon','221');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `images` (
  `filename` varchar(32) NOT NULL,
  `idadvert` int(11) NOT NULL,
  `status` enum('online','offline') NOT NULL DEFAULT 'online',
  PRIMARY KEY (`filename`),
  KEY `fk_adverts_images_adverts1_idx` (`idadvert`),
  CONSTRAINT `fk_adverts_images` FOREIGN KEY (`idadvert`) REFERENCES `adverts` (`idadvert`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `locations` (
  `location_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_name` varchar(150) DEFAULT NULL,
  `region` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`location_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locations`
--

LOCK TABLES `locations` WRITE;
/*!40000 ALTER TABLE `locations` DISABLE KEYS */;
/*!40000 ALTER TABLE `locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `idsetting` int(11) NOT NULL AUTO_INCREMENT,
  `is_default` tinyint(1) NOT NULL,
  `text_limit` tinyint(4) NOT NULL,
  `text_price` int(11) DEFAULT NULL,
  `image_price` int(11) NOT NULL,
  PRIMARY KEY (`idsetting`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `pseudo` varchar(100) NOT NULL,
  `user_mail` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `phones` varchar(100) DEFAULT NULL,
  `user_group` enum('admin','manager','customer') NOT NULL,
  `is_enabled` tinyint(1) DEFAULT '1',
  `is_deleted` tinyint(1) DEFAULT '0',
  UNIQUE KEY `pseudo_UNIQUE` (`user_mail`),
  UNIQUE KEY `users_pseudo_uindex` (`pseudo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('atsama','atsama.daryl@gmail.com','c984aed014aec7623a54f0591da07a85fd4b762d','Atsama','Daryl','douala bassa','661000998','customer',1,0),('duvent','claudeduvent@locahost.com','7c4a8d09ca3762af61e59520943dc26494f8941b','Duvent','Claude','','','manager',1,0),('dubois','dubois@site.com','7c4a8d09ca3762af61e59520943dc26494f8941b','','','','','customer',1,0),('machoudi','machoudi@localhost.com','7c4a8d09ca3762af61e59520943dc26494f8941b','GBADAMASSI','MACHOUDI','','','admin',1,0),('martine','martine.mireille@gmail.com','7c4a8d09ca3762af61e59520943dc26494f8941b','Ngono','Martine','douala bassa','661000998','manager',1,0),('seannomo','nomoserges@gmail.com','81d29e3dd118edbedbf941e4118889658c8832a8','Mvilongo','Serge','YaoundÃ©, cameroun','694088948','admin',1,0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-05  1:10:54
