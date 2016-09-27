-- MySQL dump 10.13  Distrib 5.6.31, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: web2
-- ------------------------------------------------------
-- Server version	5.6.31-0ubuntu0.15.10.1

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
-- Table structure for table `cli_clientes`
--

DROP TABLE IF EXISTS `cli_clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cli_clientes` (
  `cli_id` int(11) NOT NULL AUTO_INCREMENT,
  `cli_nome` varchar(100) NOT NULL,
  `cli_cpf` char(11) NOT NULL,
  `cli_nascimento` datetime NOT NULL,
  `cli_sexo` char(1) NOT NULL,
  `cli_email` varchar(100) NOT NULL,
  `cli_senha` char(32) NOT NULL,
  PRIMARY KEY (`cli_id`),
  UNIQUE KEY `cli_cpf` (`cli_cpf`),
  UNIQUE KEY `cli_email` (`cli_email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cli_clientes`
--

LOCK TABLES `cli_clientes` WRITE;
/*!40000 ALTER TABLE `cli_clientes` DISABLE KEYS */;
INSERT INTO `cli_clientes` VALUES (1,'Argel','01644705656','1994-09-28 00:00:00','M','argeljunior@gmail.com','e10adc3949ba59abbe56e057f20f883e'),(4,'Rafael Magno','52943383864','1988-11-17 00:00:00','M','rafael@magno.com.br','e10adc3949ba59abbe56e057f20f883e');
/*!40000 ALTER TABLE `cli_clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pac_pacotes`
--

DROP TABLE IF EXISTS `pac_pacotes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pac_pacotes` (
  `pac_id` int(11) NOT NULL AUTO_INCREMENT,
  `pac_nome` varchar(100) NOT NULL,
  `pac_descricao` longtext NOT NULL,
  `pac_url_foto` varchar(255) DEFAULT NULL,
  `pac_valor` double NOT NULL,
  PRIMARY KEY (`pac_id`),
  UNIQUE KEY `pac_nome` (`pac_nome`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pac_pacotes`
--

LOCK TABLES `pac_pacotes` WRITE;
/*!40000 ALTER TABLE `pac_pacotes` DISABLE KEYS */;
INSERT INTO `pac_pacotes` VALUES (23,'natal','sdfjkaldsjfaljl','a49c1643d4e12b6455ad8fe2ebf0374d.jpg',12.65),(24,'rio de janeiro','fksdjalfj gfgsdfgsdfgsdfg','0f5e8397342b6f721b7c47525d6dae46jpeg',21.45);
/*!40000 ALTER TABLE `pac_pacotes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usr_usuarios`
--

DROP TABLE IF EXISTS `usr_usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usr_usuarios` (
  `usr_id` int(11) NOT NULL AUTO_INCREMENT,
  `usr_nome` varchar(100) NOT NULL,
  `usr_senha` char(32) NOT NULL,
  PRIMARY KEY (`usr_id`),
  UNIQUE KEY `usr_nome` (`usr_nome`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usr_usuarios`
--

LOCK TABLES `usr_usuarios` WRITE;
/*!40000 ALTER TABLE `usr_usuarios` DISABLE KEYS */;
INSERT INTO `usr_usuarios` VALUES (1,'argel','e10adc3949ba59abbe56e057f20f883e'),(2,'rafael','e10adc3949ba59abbe56e057f20f883e'),(4,'teste','e10adc3949ba59abbe56e057f20f883e');
/*!40000 ALTER TABLE `usr_usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-09-27 17:07:40
