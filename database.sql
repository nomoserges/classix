-- MySQL dump 10.16  Distrib 10.1.29-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: advertize
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
  `idadvert` char(36) NOT NULL,
  `pseudo` varchar(100) NOT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `city_name` varchar(100) NOT NULL,
  `title` varchar(45) NOT NULL,
  `description` longtext NOT NULL,
  `validity` tinyint(4) NOT NULL DEFAULT '1',
  `initial_price` int(11) DEFAULT NULL,
  `price_text` int(11) NOT NULL DEFAULT '0',
  `price_validity` int(11) NOT NULL DEFAULT '0',
  `price_images` int(11) NOT NULL DEFAULT '0',
  `price` int(11) NOT NULL DEFAULT '0',
  `tags` varchar(150) DEFAULT NULL,
  `contact_fullname` varchar(200) NOT NULL,
  `contact_email` varchar(150) NOT NULL,
  `contact_phone` varchar(15) NOT NULL,
  `contact_address` varchar(150) NOT NULL,
  `status` enum('online','offline','pending') NOT NULL,
  `nb_views` int(11) NOT NULL DEFAULT '0',
  `payment_visa` tinyint(1) DEFAULT NULL,
  `payment_paypal` tinyint(1) DEFAULT NULL,
  `payment_bank` tinyint(1) DEFAULT NULL,
  `payment_cashier` tinyint(1) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT '0',
  `publish_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idadvert`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adverts`
--

/*!40000 ALTER TABLE `adverts` DISABLE KEYS */;
INSERT INTO `adverts` (`idadvert`, `pseudo`, `cat_id`, `city_name`, `title`, `description`, `validity`, `initial_price`, `price_text`, `price_validity`, `price_images`, `price`, `tags`, `contact_fullname`, `contact_email`, `contact_phone`, `contact_address`, `status`, `nb_views`, `payment_visa`, `payment_paypal`, `payment_bank`, `payment_cashier`, `is_deleted`, `publish_date`, `register_date`) VALUES ('3gbi2rdo7e4z8s1tkvhymafpul6j9q05cwxn','dubois',3,'TIBATI','Salon de s&eacute;jour','One common flaw we\'ve seen in many frameworks is a lack of support for truly responsive text. While elements on the page resize fluidly, text still resizes on a fixed basis. To ameliorate this problem, for text heavy pages, we\'ve created a class that fluidly scales text size and line-height to optimize readability for the user. Line length stays between 45-80 characters and line height scales to be larger on smaller screens.',30,150000,200,2000,1500,153700,'OS,linux, software,kernel','Dubois Deschamps','dubois@site.com','00333 663 2255','12, Rue Abysse','pending',0,1,1,1,1,0,'2018-05-22 06:34:02','2018-05-22 06:34:02');
/*!40000 ALTER TABLE `adverts` ENABLE KEYS */;

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

/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`cat_id`, `parent_cid`, `category_name`) VALUES (1,0,'IMMOBILIER'),(2,1,'VENTE IMMOBILIERE'),(3,1,'Location immobili&amp;egrave;re'),(4,1,'Colocations'),(5,1,'Locations vacances'),(6,1,'Bureaux - Commerces'),(7,0,'EMPLOIS &amp;amp; FORMATIONS'),(9,0,'AUTO, MOTO, BATEAU'),(10,0,'ANIMAUX'),(11,0,'ELECTROMENAGER'),(12,0,'MAISON, DECO, JARDIN'),(13,0,'MODE, BEAUT&amp;Eacute;'),(14,0,'HIGH-TECH, INFORMATIQUE'),(15,0,'LOISIRS, CULTURES, SPORT'),(16,0,'SERVICES'),(17,0,'RENCONTRES'),(18,9,'Voitures'),(19,9,'Utilitaires'),(20,9,'Accessoires auto, moto'),(21,9,'Moto, Scooter'),(22,9,'Caravaning, Remorque'),(23,9,'B&amp;acirc;teaux, nautisme'),(24,9,'Autres v&amp;eacute;hicules'),(25,7,'Offres de formation'),(26,7,'Interim'),(27,7,'Offres d\'emploi'),(28,10,'Chiens'),(29,10,'Chats'),(30,10,'Accessoires (Cages, niches, etc...)'),(31,10,'Poissons, aquarium'),(32,11,'Lavage'),(33,11,'Cuisine'),(34,11,'Nettoyage, repassage'),(35,11,'Appareil et accessoires'),(36,12,'Meubles'),(37,12,'D&amp;eacute;corations, luminaires'),(38,12,'Jardin, bricolage'),(39,12,'Lit, literie'),(40,12,'Vaisselle, art de la table'),(41,12,'Materiel professionnel'),(42,12,'Climatisation, chauffage'),(43,12,'Linge de maison'),(44,13,'V&amp;ecirc;tements Femme'),(45,13,'V&amp;ecirc;tements Homme'),(46,13,'Chaussures'),(48,13,'Bijoux, Montres'),(49,13,'Beaut&amp;eacute;, soins'),(50,13,'Sac &amp;agrave; main, valise'),(51,13,'V&amp;ecirc;tements Enfant'),(52,13,'Lunettes de soleil'),(53,13,'Lingerie'),(54,14,'Ordinateur, informatique'),(55,14,'T&amp;eacute;l&amp;eacute;phones'),(56,14,'Son, Hifi'),(57,14,'Console, jeux vid&amp;eacute;os'),(58,14,'Autres High-tech'),(59,14,'Vid&amp;eacute;o, camescope'),(60,14,'Gps'),(61,15,'Livre, BD, Magazine'),(62,15,'Autres loisirs, culture'),(63,15,'Collection'),(64,15,'Equipement de sport'),(65,15,'CD, Vinyle, musique'),(66,15,'Jeux, jouets'),(67,15,'V&amp;eacute;lo'),(68,15,'Instrument de musique'),(69,15,'Billets spectacles, loisirs'),(70,15,'DVD, Blu-Ray'),(71,15,'Vin, alimentation'),(72,15,'Billets de train, avion'),(73,16,'Service &amp;agrave; la personne'),(74,16,'Autres services'),(75,16,'Artisans, d&amp;eacute;panneurs'),(77,16,'Horoscope, voyance'),(78,16,'Vie locale'),(79,16,'Organisation d\'&amp;eacute;v&amp;egrave;nements'),(80,17,'Rencontre s&amp;eacute;rieuse'),(81,17,'Rencontre amicale');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cities` (
  `regionid` int(11) NOT NULL,
  `code_postal` int(11) NOT NULL,
  `city_name` varchar(100) NOT NULL,
  PRIMARY KEY (`code_postal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Régions pour la localisation des annones';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cities`
--

/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
INSERT INTO `cities` (`regionid`, `code_postal`, `city_name`) VALUES (1,101,'YAOUNDÉ'),(1,102,'BOUMNYEBEL'),(10,121,'MAROUA'),(10,122,'YAGOUA'),(10,123,'M&Ocirc;K&Ocirc;L&Ocirc;'),(2,201,'DOUALA'),(2,202,'BONABERI'),(2,203,'EDEA'),(2,204,'POUMA'),(2,205,'NKONGSAMBA'),(2,206,'YABASSI'),(3,301,'EBOLOWA'),(3,302,'KRIBI'),(4,401,'GAROUA'),(4,402,'PITOA'),(4,403,'GUIDER'),(4,404,'NGONG'),(4,405,'TOUROUA'),(5,501,'BERTOUA'),(5,502,'GAROUA-BOULAYE'),(5,503,'NDOKAYO'),(5,504,'BELABO'),(6,601,'BAFOUSSAM'),(7,701,'BUEA'),(7,702,'LIMBE'),(8,801,'BAMENDA'),(9,901,'NGAOUNDÉRÉ'),(9,902,'MEIGANGA'),(9,903,'TIBATI');
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;

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

/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` (`country_code`, `name`, `phone_indicator`) VALUES ('CM','Cameroun','237'),('FR','FRANCE','33'),('Gab','Gabon','221');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `images` (
  `idadvert` char(36) NOT NULL,
  `file_name` varchar(41) NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `image_status` enum('online','deleted') NOT NULL DEFAULT 'online',
  `record_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `images_file_name_uindex` (`file_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='images des annonces';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` (`idadvert`, `file_name`, `is_default`, `image_status`, `record_date`) VALUES ('3gbi2rdo7e4z8s1tkvhymafpul6j9q05cwxn','e2amo6ybd70s1fi4qwjrxgl8nckp3u9h5zvt.png',0,'online','2018-05-22 06:34:02'),('3gbi2rdo7e4z8s1tkvhymafpul6j9q05cwxn','f3ls7athp01nvrzxie4qud29yj5mwgc8ob6k.png',0,'online','2018-05-22 06:34:02'),('3gbi2rdo7e4z8s1tkvhymafpul6j9q05cwxn','im56gya2r0qdeh3skxvpuln791o4cftwzb8j.png',1,'online','2018-05-22 06:34:02');
/*!40000 ALTER TABLE `images` ENABLE KEYS */;

--
-- Table structure for table `regions`
--

DROP TABLE IF EXISTS `regions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `regions` (
  `regionid` int(11) NOT NULL AUTO_INCREMENT,
  `region_name` varchar(100) NOT NULL,
  PRIMARY KEY (`regionid`),
  UNIQUE KEY `regions_region_name_uindex` (`region_name`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COMMENT='Régions du pays coniguré';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `regions`
--

/*!40000 ALTER TABLE `regions` DISABLE KEYS */;
INSERT INTO `regions` (`regionid`, `region_name`) VALUES (9,'ADAMAOUA'),(1,'CENTRE'),(5,'EST'),(10,'EXTR&Ecirc;ME-NORD'),(2,'LITTORAL'),(4,'NORD'),(8,'NORD-OUEST'),(6,'OUEST'),(3,'SUD'),(7,'SUD-OUEST');
/*!40000 ALTER TABLE `regions` ENABLE KEYS */;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `country_code` char(4) NOT NULL,
  `country_name` varchar(100) NOT NULL,
  `phone_indicator` char(4) NOT NULL,
  `currency` char(20) NOT NULL,
  `short_currency` char(5) NOT NULL,
  PRIMARY KEY (`country_code`),
  UNIQUE KEY `settings_country_code_uindex` (`country_code`),
  UNIQUE KEY `settings_country_name_uindex` (`country_name`),
  UNIQUE KEY `settings_phone_indicator_uindex` (`phone_indicator`),
  UNIQUE KEY `settings_currency_uindex` (`currency`),
  UNIQUE KEY `settings_short_currency_uindex` (`short_currency`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` (`country_code`, `country_name`, `phone_indicator`, `currency`, `short_currency`) VALUES ('CM','CAMEROUN','+237','Franc CFA','F CFA');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;

--
-- Table structure for table `settings_prices`
--

DROP TABLE IF EXISTS `settings_prices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings_prices` (
  `idprice` int(11) NOT NULL AUTO_INCREMENT,
  `category` enum('texte','duree','image') NOT NULL,
  `min_value` int(11) NOT NULL,
  `max_value` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  PRIMARY KEY (`idprice`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COMMENT='Tarifs en fonction des durée';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings_prices`
--

/*!40000 ALTER TABLE `settings_prices` DISABLE KEYS */;
INSERT INTO `settings_prices` (`idprice`, `category`, `min_value`, `max_value`, `price`) VALUES (1,'texte',1,100,100),(2,'texte',101,200,150),(3,'duree',1,14,1500),(4,'duree',15,30,2000),(5,'image',1,1,500),(6,'texte',201,300,125),(7,'texte',301,500,200),(8,'texte',501,1000,300),(9,'texte',1001,1500,500);
/*!40000 ALTER TABLE `settings_prices` ENABLE KEYS */;

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
  `user_group` enum('admin','gestionnaire','personnel','entreprise') NOT NULL,
  `is_enabled` tinyint(1) DEFAULT '1',
  `is_deleted` tinyint(1) DEFAULT '0',
  UNIQUE KEY `pseudo_UNIQUE` (`user_mail`),
  UNIQUE KEY `users_pseudo_uindex` (`pseudo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`pseudo`, `user_mail`, `user_password`, `last_name`, `first_name`, `address`, `phones`, `user_group`, `is_enabled`, `is_deleted`) VALUES ('atsama','atsama.daryl@gmail.com','c984aed014aec7623a54f0591da07a85fd4b762d','Atsama','Daryl','douala bassa','661000998','personnel',1,0),('duvent','claudeduvent@locahost.com','7c4a8d09ca3762af61e59520943dc26494f8941b','Duvent','Claude','','','gestionnaire',1,0),('dubois','dubois@site.com','7c4a8d09ca3762af61e59520943dc26494f8941b','Deschamps','Dubois','12, Rue Abysse','00333 663 2255','personnel',1,0),('machoudi','machoudi@localhost.com','7c4a8d09ca3762af61e59520943dc26494f8941b','GBADAMASSI','MACHOUDI','','','admin',1,0),('martine','martine.mireille@gmail.com','7c4a8d09ca3762af61e59520943dc26494f8941b','Ngono','Martine','douala bassa','661000998','gestionnaire',1,0),('seannomo','nomoserges@gmail.com','81d29e3dd118edbedbf941e4118889658c8832a8','Mvilongo','Serge Anselme','Yaound&eacute;, cameroun','694088948','admin',1,0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-23 17:19:01
