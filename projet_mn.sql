CREATE DATABASE  IF NOT EXISTS `projet_mn` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `projet_mn`;
-- MySQL dump 10.13  Distrib 5.7.21, for Linux (x86_64)
--
-- Host: localhost    Database: projet_mn
-- ------------------------------------------------------
-- Server version	5.7.21-0ubuntu0.17.10.1

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
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `date` datetime NOT NULL,
  `email` varchar(255) NOT NULL,
  `wilder` tinyint(1) DEFAULT NULL,
  `avatar` varchar(255) NOT NULL,
  `profession` varchar(45) DEFAULT NULL,
  `company` varchar(45) DEFAULT NULL,
  `valid` tinyint(1) NOT NULL,
  `like` int(11) NOT NULL,
  `question1` text,
  `question2` text,
  `question3` text,
  `job_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Comment_Job1_idx` (`job_id`),
  CONSTRAINT `fk_Comment_Job1` FOREIGN KEY (`job_id`) REFERENCES `job` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES (2,'Julien','ALEXANDRE','2018-04-11 09:42:00','juluien.alexandre26@gmail.com',1,'https://i58.servimg.com/u/f58/18/21/55/18/5fa8ef10.jpg','Développeur PHP','Wild Code School',0,3,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam quis convallis nunc, vel fermentum ante. Vivamus lobortis malesuada hendrerit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Suspendisse ac convallis ligula. Pellentesque tincidunt nunc a erat rutrum, quis malesuada libero rutrum.','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam quis convallis nunc, vel fermentum ante. Vivamus lobortis malesuada hendrerit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Suspendisse ac convallis ligula. Pellentesque tincidunt nunc a erat rutrum, quis malesuada libero rutrum.','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam quis convallis nunc, vel fermentum ante. Vivamus lobortis malesuada hendrerit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Suspendisse ac convallis ligula. Pellentesque tincidunt nunc a erat rutrum, quis malesuada libero rutrum.',1),(3,'John','Doe','2018-04-11 09:59:15','john.doe@email.com',0,'http://lorempicsum.com/futurama/255/200/5','Designer','La super équipe design',1,10,'\'2\', \'Julien\', \'ALEXANDRE\', \'2018-04-11 09:42:00\', \'juluien.alexandre26@gmail.com\', \'1\', \'https://i58.servimg.com/u/f58/18/21/55/18/5fa8ef10.jpg\', \'Développeur PHP\', \'Wild Code School\', \'0\', \'3\', \'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam quis convallis nunc, vel fermentum ante. Vivamus lobortis malesuada hendrerit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Suspendisse ac convallis ligula. Pellentesque tincidunt nunc a erat rutrum, quis malesuada libero rutrum.\', \'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam quis convallis nunc, vel fermentum ante. Vivamus lobortis malesuada hendrerit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Suspendisse ac convallis ligula. Pellentesque tincidunt nunc a erat rutrum, quis malesuada libero rutrum.\', \'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam quis convallis nunc, vel fermentum ante. Vivamus lobortis malesuada hendrerit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Suspendisse ac convallis ligula. Pellentesque tincidunt nunc a erat rutrum, quis malesuada libero rutrum.\', \'1\'\n','\'2\', \'Julien\', \'ALEXANDRE\', \'2018-04-11 09:42:00\', \'juluien.alexandre26@gmail.com\', \'1\', \'https://i58.servimg.com/u/f58/18/21/55/18/5fa8ef10.jpg\', \'Développeur PHP\', \'Wild Code School\', \'0\', \'3\', \'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam quis convallis nunc, vel fermentum ante. Vivamus lobortis malesuada hendrerit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Suspendisse ac convallis ligula. Pellentesque tincidunt nunc a erat rutrum, quis malesuada libero rutrum.\', \'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam quis convallis nunc, vel fermentum ante. Vivamus lobortis malesuada hendrerit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Suspendisse ac convallis ligula. Pellentesque tincidunt nunc a erat rutrum, quis malesuada libero rutrum.\', \'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam quis convallis nunc, vel fermentum ante. Vivamus lobortis malesuada hendrerit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Suspendisse ac convallis ligula. Pellentesque tincidunt nunc a erat rutrum, quis malesuada libero rutrum.\', \'1\'\n','\'2\', \'Julien\', \'ALEXANDRE\', \'2018-04-11 09:42:00\', \'juluien.alexandre26@gmail.com\', \'1\', \'https://i58.servimg.com/u/f58/18/21/55/18/5fa8ef10.jpg\', \'Développeur PHP\', \'Wild Code School\', \'0\', \'3\', \'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam quis convallis nunc, vel fermentum ante. Vivamus lobortis malesuada hendrerit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Suspendisse ac convallis ligula. Pellentesque tincidunt nunc a erat rutrum, quis malesuada libero rutrum.\', \'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam quis convallis nunc, vel fermentum ante. Vivamus lobortis malesuada hendrerit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Suspendisse ac convallis ligula. Pellentesque tincidunt nunc a erat rutrum, quis malesuada libero rutrum.\', \'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam quis convallis nunc, vel fermentum ante. Vivamus lobortis malesuada hendrerit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Suspendisse ac convallis ligula. Pellentesque tincidunt nunc a erat rutrum, quis malesuada libero rutrum.\', \'1\'\n',2);
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job`
--

DROP TABLE IF EXISTS `job`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `resum` text NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `question1` varchar(255) NOT NULL,
  `question2` varchar(255) NOT NULL,
  `question3` varchar(255) NOT NULL,
  `theme_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Job_Theme_idx` (`theme_id`),
  CONSTRAINT `fk_Job_Theme` FOREIGN KEY (`theme_id`) REFERENCES `theme` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job`
--

LOCK TABLES `job` WRITE;
/*!40000 ALTER TABLE `job` DISABLE KEYS */;
INSERT INTO `job` VALUES (1,'Développeur PHP','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent nec lobortis enim, sed placerat ante.','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent nec lobortis enim, sed placerat ante. Sed vel tempor mi. In pharetra non nunc eget condimentum. Integer odio tortor, vulputate vulputate viverra sed, feugiat ac dui. Cras vel arcu eu lorem bibendum molestie.','http://lorempicsum.com/futurama/255/200/2',NULL,'http://lorempicsum.com/futurama/350/200/1','Voici la première question ?','Voici la deuxième question ?','Voici la troisième question ?',1),(2,'Web Designer','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent nec lobortis enim, sed placerat ante.','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent nec lobortis enim, sed placerat ante. Sed vel tempor mi. In pharetra non nunc eget condimentum. Integer odio tortor, vulputate vulputate viverra sed, feugiat ac dui. Cras vel arcu eu lorem bibendum molestie.','http://lorempicsum.com/futurama/255/200/2',NULL,'http://lorempicsum.com/futurama/350/200/1','Voici la première question ?','Voici la deuxième question ?','Voici la troisième question ?',4);
/*!40000 ALTER TABLE `job` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `theme`
--

DROP TABLE IF EXISTS `theme`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `theme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `theme`
--

LOCK TABLES `theme` WRITE;
/*!40000 ALTER TABLE `theme` DISABLE KEYS */;
INSERT INTO `theme` VALUES (1,'Développement'),(2,'Design'),(3,'Système'),(4,'Design');
/*!40000 ALTER TABLE `theme` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-04-11 10:03:31
