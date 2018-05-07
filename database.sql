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
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,0,'IMMOBILIER'),(2,1,'VENTE IMMOBILIERE'),(3,1,'Location immobili&amp;egrave;re'),(4,1,'Colocations'),(5,1,'Locations vacances'),(6,1,'Bureaux - Commerces'),(7,0,'EMPLOIS &amp;amp; FORMATIONS'),(9,0,'AUTO, MOTO, BATEAU'),(10,0,'ANIMAUX'),(11,0,'ELECTROMENAGER'),(12,0,'MAISON, DECO, JARDIN'),(13,0,'MODE, BEAUT&amp;Eacute;'),(14,0,'HIGH-TECH, INFORMATIQUE'),(15,0,'LOISIRS, CULTURES, SPORT'),(16,0,'SERVICES'),(17,0,'RENCONTRES'),(18,9,'Voitures'),(19,9,'Utilitaires'),(20,9,'Accessoires auto, moto'),(21,9,'Moto, Scooter'),(22,9,'Caravaning, Remorque'),(23,9,'B&amp;acirc;teaux, nautisme'),(24,9,'Autres v&amp;eacute;hicules'),(25,7,'Offres de formation'),(26,7,'Interim'),(27,7,'Offres d\'emploi'),(28,10,'Chiens'),(29,10,'Chats'),(30,10,'Accessoires (Cages, niches, etc...)'),(31,10,'Poissons, aquarium'),(32,11,'Lavage'),(33,11,'Cuisine'),(34,11,'Nettoyage, repassage'),(35,11,'Appareil et accessoires'),(36,12,'Meubles'),(37,12,'D&amp;eacute;corations, luminaires'),(38,12,'Jardin, bricolage'),(39,12,'Lit, literie'),(40,12,'Vaisselle, art de la table'),(41,12,'Materiel professionnel'),(42,12,'Climatisation, chauffage'),(43,12,'Linge de maison'),(44,13,'V&amp;ecirc;tements Femme'),(45,13,'V&amp;ecirc;tements Homme'),(46,13,'Chaussures'),(48,13,'Bijoux, Montres'),(49,13,'Beaut&amp;eacute;, soins'),(50,13,'Sac &amp;agrave; main, valise'),(51,13,'V&amp;ecirc;tements Enfant'),(52,13,'Lunettes de soleil'),(53,13,'Lingerie'),(54,14,'Ordinateur, informatique'),(55,14,'T&amp;eacute;l&amp;eacute;phones'),(56,14,'Son, Hifi'),(57,14,'Console, jeux vid&amp;eacute;os'),(58,14,'Autres High-tech'),(59,14,'Vid&amp;eacute;o, camescope'),(60,14,'Gps'),(61,15,'Livre, BD, Magazine'),(62,15,'Autres loisirs, culture'),(63,15,'Collection'),(64,15,'Equipement de sport'),(65,15,'CD, Vinyle, musique'),(66,15,'Jeux, jouets'),(67,15,'V&amp;eacute;lo'),(68,15,'Instrument de musique'),(69,15,'Billets spectacles, loisirs'),(70,15,'DVD, Blu-Ray'),(71,15,'Vin, alimentation'),(72,15,'Billets de train, avion'),(73,16,'Service &amp;agrave; la personne'),(74,16,'Autres services'),(75,16,'Artisans, d&amp;eacute;panneurs'),(77,16,'Horoscope, voyance'),(78,16,'Vie locale'),(79,16,'Organisation d\'&amp;eacute;v&amp;egrave;nements'),(80,17,'Rencontre s&amp;eacute;rieuse'),(81,17,'Rencontre amicale');
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
INSERT INTO `users` VALUES ('atsama','atsama.daryl@gmail.com','c984aed014aec7623a54f0591da07a85fd4b762d','Atsama','Daryl','douala bassa','661000998','customer',1,0),('duvent','claudeduvent@locahost.com','7c4a8d09ca3762af61e59520943dc26494f8941b','Duvent','Claude','','','manager',0,0),('dubois','dubois@site.com','7c4a8d09ca3762af61e59520943dc26494f8941b','','','','','customer',1,0),('machoudi','machoudi@localhost.com','7c4a8d09ca3762af61e59520943dc26494f8941b','GBADAMASSI','MACHOUDI','','','admin',1,0),('martine','martine.mireille@gmail.com','7c4a8d09ca3762af61e59520943dc26494f8941b','Ngono','Martine','douala bassa','661000998','manager',1,0),('seannomo','nomoserges@gmail.com','81d29e3dd118edbedbf941e4118889658c8832a8','Mvilongo','Serge Anselme','Yaound&eacute;, cameroun','694088948','admin',1,0);
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

-- Dump completed on 2018-05-07 18:13:56
