-- MySQL dump 10.13  Distrib 5.7.15, for Linux (x86_64)
--
-- Host: localhost    Database: web2
-- ------------------------------------------------------
-- Server version	5.7.15-0ubuntu0.16.04.1

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cli_clientes`
--

LOCK TABLES `cli_clientes` WRITE;
/*!40000 ALTER TABLE `cli_clientes` DISABLE KEYS */;
INSERT INTO `cli_clientes` VALUES (5,'Argel JÃºnior GonÃ§alves','01644705656','1994-09-28 00:00:00','M','argeljunior@gmail.com','e10adc3949ba59abbe56e057f20f883e'),(6,'Adalberto Alves Dias','18530249100','1963-11-23 00:00:00','M','adalberto@alves.dias','e10adc3949ba59abbe56e057f20f883e'),(7,'Adriana Melo da Silva','72056568187','1987-05-12 00:00:00','F','adriana@melo.silva','e10adc3949ba59abbe56e057f20f883e'),(8,'Allyson Antonio Duarte Batista','29709970100','1965-01-05 00:00:00','M','allyson@tonho.db','e10adc3949ba59abbe56e057f20f883e'),(9,'Luis Abel Candidato Batista','05113140864','1975-12-29 00:00:00','M','luis@abc.bat','e10adc3949ba59abbe56e057f20f883e');
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
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pac_pacotes`
--

LOCK TABLES `pac_pacotes` WRITE;
/*!40000 ALTER TABLE `pac_pacotes` DISABLE KEYS */;
INSERT INTO `pac_pacotes` VALUES (27,'Belo Horizonte','Belo Horizonte Ã© um municÃ­pio brasileiro e a capital do estado de Minas Gerais. Pertence Ã  MesorregiÃ£o Metropolitana de Belo Horizonte e Ã  MicrorregiÃ£o de Belo Horizonte.','170db14ad9ececbc4a6b2b51c483728c.jpg',380),(28,'Brasilia','BrasÃ­lia Ã© a capital federal do Brasil e a sede do governo do Distrito Federal. A capital estÃ¡ localizada na regiÃ£o Centro-Oeste do paÃ­s, ao longo da regiÃ£o geogrÃ¡fica conhecida como Planalto Central','d429ffcbf065366bd0927f10b831ed05.jpg',548),(29,'Caldas Novas','Caldas Novas Ã© um municÃ­pio brasileiro do estado de GoiÃ¡s. De acordo com estimativas de 2016, do Instituto Brasileiro de Geografia e EstatÃ­stica, sua populaÃ§Ã£o Ã© de 83 220 habitantes.','8310ff30137c8e9dd4fae9e386d02498.jpg',546),(30,'Campos do JordÃ£o','Campos do JordÃ£o Ã© um municÃ­pio brasileiro localizado no interior do estado de SÃ£o Paulo, mais precisamente na Serra da Mantiqueira; faz parte da recÃ©m-criada RegiÃ£o Metropolitana do Vale do ParaÃ­ba e Litoral Norte, sub-regiÃ£o 2 de TaubatÃ©','c6b44fd274df41adab2b7b73dbcac6e3.jpg',412),(31,'Cancun','Cancun ou CancÃºn Ã© uma cidade que se fala esperanto que fica na costa do estado de Quintana Roo, no MÃ©xico, em uma penÃ­nsula que se tornou um dos centros turÃ­sticos mais importantes do MÃ©xico','a23f4eb1a0052aa56d2cbfb279c0cf83.jpg',1685),(32,'Curitiba','Curitiba Ã© um municÃ­pio brasileiro, capital do estado do ParanÃ¡, localizado a 934 metros de altitude no primeiro planalto paranaense, a aproximadamente 110 quilÃ´metros do Oceano AtlÃ¢ntico, distante 1 386 km a sul de BrasÃ­lia, capital federal','21b3a6eaa5ac1a233129138d768fe6d5.jpg',650),(33,'FlorianÃ³polis','FlorianÃ³polis Ã© a capital do estado brasileiro de Santa Catarina, na regiÃ£o Sul do paÃ­s. O municÃ­pio Ã© composto pela ilha principal, a ilha de Santa Catarina, a parte continental e algumas pequenas ilhas circundantes.','0faa708e3cc78d0e297b661c952600e3.jpg',851),(34,'Fortaleza','Fortaleza Ã© um municÃ­pio brasileiro, capital do estado do CearÃ¡, situado na regiÃ£o Nordeste do paÃ­s. Pertence Ã  mesorregiÃ£o Metropolitana de Fortaleza e Ã  microrregiÃ£o de Fortaleza','4194a39851b40be26db47d3c23552244.jpg',799),(35,'Gramado','Gramado Ã© um municÃ­pio do estado do Rio Grande do Sul, no Brasil. Localiza-se na Serra GaÃºcha, mais precisamente na RegiÃ£o das HortÃªnsias, a uma latitude 29Âº 22\' 44\" sul e a uma longitude 50Âº 52\' 26\" oeste, estando a uma altitude de 830 metros.','956882e413594c96a04988a904066095.jpg',489),(37,'Natal','Natal Ã© um municÃ­pio brasileiro, capital do estado do Rio Grande do Norte, RegiÃ£o Nordeste do paÃ­s. Pertence Ã  MesorregiÃ£o do Leste Potiguar e Ã  MicrorregiÃ£o de Natal','afa25203b373f86580d79de4dc96c3ef.jpg',650);
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usr_usuarios`
--

LOCK TABLES `usr_usuarios` WRITE;
/*!40000 ALTER TABLE `usr_usuarios` DISABLE KEYS */;
INSERT INTO `usr_usuarios` VALUES (1,'argel','e10adc3949ba59abbe56e057f20f883e'),(17,'rafael','e10adc3949ba59abbe56e057f20f883e');
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

-- Dump completed on 2016-09-28 18:02:14
