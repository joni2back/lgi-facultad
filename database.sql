-- MySQL dump 10.13  Distrib 5.5.38, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: lgi
-- ------------------------------------------------------
-- Server version	5.5.38-0ubuntu0.12.04.1-log

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
-- Table structure for table `article_categories`
--

DROP TABLE IF EXISTS `article_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article_categories` (
  `id_article_category` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`id_article_category`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article_categories`
--

LOCK TABLES `article_categories` WRITE;
/*!40000 ALTER TABLE `article_categories` DISABLE KEYS */;
INSERT INTO `article_categories` (`id_article_category`, `name`) VALUES (1,'Departamentos'),(2,'Cocheras'),(3,'Pisos'),(4,'Locales comerciales');
/*!40000 ALTER TABLE `article_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `article_types`
--

DROP TABLE IF EXISTS `article_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article_types` (
  `id_article_type` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`id_article_type`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article_types`
--

LOCK TABLES `article_types` WRITE;
/*!40000 ALTER TABLE `article_types` DISABLE KEYS */;
INSERT INTO `article_types` (`id_article_type`, `name`) VALUES (1,'Desde la maqueta o plano'),(2,'Desde el terreno o pozo con ubicacion confirmada'),(3,'Durante la construccion'),(4,'Construccion finalizada'),(5,'Listos para habitar');
/*!40000 ALTER TABLE `article_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articles` (
  `id_article` int(8) NOT NULL AUTO_INCREMENT,
  `id_article_category` int(2) NOT NULL,
  `id_article_type` int(2) NOT NULL,
  `id_author` int(2) NOT NULL,
  `title` varchar(128) NOT NULL,
  `description` text,
  `location` varchar(128) DEFAULT NULL,
  `address` varchar(64) DEFAULT NULL,
  `price` float DEFAULT NULL,
  PRIMARY KEY (`id_article`),
  KEY `id_article_category` (`id_article_category`),
  KEY `id_article_type` (`id_article_type`),
  KEY `id_author` (`id_author`),
  CONSTRAINT `id_article_category` FOREIGN KEY (`id_article_category`) REFERENCES `article_categories` (`id_article_category`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `id_article_type` FOREIGN KEY (`id_article_type`) REFERENCES `article_types` (`id_article_type`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `id_author` FOREIGN KEY (`id_author`) REFERENCES `users` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3137 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` (`id_article`, `id_article_category`, `id_article_type`, `id_author`, `title`, `description`, `location`, `address`, `price`) VALUES (3136,1,5,3,'Vendo Departamento 600 dormitorios como nuevo','Somos una empresa diversificada, que participa en la producciÃ³n y comercializaciÃ³n de semillas, fitosanitarios, nutriciÃ³n animal y vegetal, productos de jardinerÃ­a, sanidad ambiental y cuidado de mascotas. AdemÃ¡s contamos con una filial que presta servicios de mecanizaciÃ³n agrÃ­cola.\r\n\r\nContamos con especialistas en cada una de las lÃ­neas de productos que manejamos. \r\nRealizamos una permanente inversiÃ³n en tecnologÃ­a y desarrollo de productos.\r\n','Mar del tuyo','4394399',5000);
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bancos`
--

DROP TABLE IF EXISTS `bancos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bancos` (
  `id_banco` int(8) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(32) NOT NULL,
  `sucursal` varchar(32) NOT NULL,
  `direccion` varchar(64) NOT NULL,
  PRIMARY KEY (`id_banco`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bancos`
--

LOCK TABLES `bancos` WRITE;
/*!40000 ALTER TABLE `bancos` DISABLE KEYS */;
INSERT INTO `bancos` (`id_banco`, `nombre`, `sucursal`, `direccion`) VALUES (2,'Banco Rio','28','Cordoba 331 Bis');
/*!40000 ALTER TABLE `bancos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caja`
--

DROP TABLE IF EXISTS `caja`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caja` (
  `id_caja` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `saldo` float NOT NULL,
  PRIMARY KEY (`id_caja`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caja`
--

LOCK TABLES `caja` WRITE;
/*!40000 ALTER TABLE `caja` DISABLE KEYS */;
/*!40000 ALTER TABLE `caja` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cheques`
--

DROP TABLE IF EXISTS `cheques`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cheques` (
  `id_cheque` int(8) NOT NULL AUTO_INCREMENT,
  `id_tipo_cheque` int(8) NOT NULL,
  `id_banco` int(8) NOT NULL,
  `numero` int(8) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id_cheque`),
  KEY `id_tipo_cheque` (`id_tipo_cheque`),
  KEY `id_banco` (`id_banco`),
  CONSTRAINT `id_banco` FOREIGN KEY (`id_banco`) REFERENCES `bancos` (`id_banco`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `id_tipo_cheque` FOREIGN KEY (`id_tipo_cheque`) REFERENCES `tipo_cheques` (`id_tipo_cheque`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cheques`
--

LOCK TABLES `cheques` WRITE;
/*!40000 ALTER TABLE `cheques` DISABLE KEYS */;
INSERT INTO `cheques` (`id_cheque`, `id_tipo_cheque`, `id_banco`, `numero`, `fecha`) VALUES (1,2,2,2147483647,'2014-09-30');
/*!40000 ALTER TABLE `cheques` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conceptos`
--

DROP TABLE IF EXISTS `conceptos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conceptos` (
  `id_concepto` int(8) NOT NULL AUTO_INCREMENT,
  `tipos_movimientos` varchar(64) NOT NULL,
  `detalle` varchar(100) NOT NULL,
  PRIMARY KEY (`id_concepto`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conceptos`
--

LOCK TABLES `conceptos` WRITE;
/*!40000 ALTER TABLE `conceptos` DISABLE KEYS */;
INSERT INTO `conceptos` (`id_concepto`, `tipos_movimientos`, `detalle`) VALUES (1,'Movimientos de caja','Esto es para la caja');
/*!40000 ALTER TABLE `conceptos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consultas`
--

DROP TABLE IF EXISTS `consultas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consultas` (
  `id_consulta` int(8) NOT NULL AUTO_INCREMENT,
  `id_article` int(8) NOT NULL,
  `name` varchar(64) DEFAULT NULL,
  `email` varchar(64) NOT NULL,
  `phone` varchar(32) DEFAULT NULL,
  `message` text,
  `fecha` datetime DEFAULT NULL,
  `ip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id_consulta`),
  KEY `id_article` (`id_article`),
  CONSTRAINT `id_article` FOREIGN KEY (`id_article`) REFERENCES `articles` (`id_article`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultas`
--

LOCK TABLES `consultas` WRITE;
/*!40000 ALTER TABLE `consultas` DISABLE KEYS */;
INSERT INTO `consultas` (`id_consulta`, `id_article`, `name`, `email`, `phone`, `message`, `fecha`, `ip`) VALUES (1,3136,'Carlos Almagro','carlitos@mixmail.com','0341-4579214','Sometimes we encounter odd application responses that seem to make no sense. One of these such issues is related to running virtual server instances (OS Containers not Para-Virtualized VMs) and attempting to back up their data to Amazonâ€™s S3 cloud storage. For moderately sized virtual machines running MySQL databases or Python/PHP based websites and code repositories this can be an inexpensive, quickly provisioned, and easy way to provide disaster recovery backups in numerous geographic locations, since we generally want DR content to be located in a physically distant location. Nevertheless, we can encounter errors if using an S3 mount in a distance location from our server if the timezone/sync data is incorrect.','2014-09-17 15:03:02','192.168.1.1'),(2,3136,'Dante Spinetta','dante@mixmail.com','0341-4579214','Sometimes we encounter odd application responses that seem to make no sense. One of these such issues is related to running virtual server instances (OS Containers not Para-Virtualized VMs) and attempting to back up their data to Amazonâ€™s S3 cloud storage. For moderately sized virtual machines running MySQL databases.','2014-09-17 15:14:37','192.168.1.1');
/*!40000 ALTER TABLE `consultas` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `update_fecha` BEFORE INSERT ON `consultas`
FOR EACH ROW SET NEW.fecha = NOW() */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `formas_pago`
--

DROP TABLE IF EXISTS `formas_pago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `formas_pago` (
  `id_forma_pago` int(8) NOT NULL AUTO_INCREMENT,
  `detalle` varchar(100) NOT NULL,
  PRIMARY KEY (`id_forma_pago`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `formas_pago`
--

LOCK TABLES `formas_pago` WRITE;
/*!40000 ALTER TABLE `formas_pago` DISABLE KEYS */;
INSERT INTO `formas_pago` (`id_forma_pago`, `detalle`) VALUES (1,'Efectivo');
/*!40000 ALTER TABLE `formas_pago` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movimientos_diarios`
--

DROP TABLE IF EXISTS `movimientos_diarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `movimientos_diarios` (
  `id_movimiento` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(8) NOT NULL,
  `id_concepto` int(8) NOT NULL,
  `id_forma_pago` int(8) NOT NULL,
  `fecha` date NOT NULL,
  `debe` float(5,2) NOT NULL,
  `haber` float(5,2) NOT NULL,
  PRIMARY KEY (`id_movimiento`),
  KEY `id_user` (`id_user`),
  KEY `id_forma_pago` (`id_forma_pago`),
  KEY `id_concepto` (`id_concepto`),
  CONSTRAINT `id_concepto` FOREIGN KEY (`id_concepto`) REFERENCES `conceptos` (`id_concepto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `id_forma_pago` FOREIGN KEY (`id_forma_pago`) REFERENCES `formas_pago` (`id_forma_pago`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `id_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movimientos_diarios`
--

LOCK TABLES `movimientos_diarios` WRITE;
/*!40000 ALTER TABLE `movimientos_diarios` DISABLE KEYS */;
INSERT INTO `movimientos_diarios` (`id_movimiento`, `id_user`, `id_concepto`, `id_forma_pago`, `fecha`, `debe`, `haber`) VALUES (1,1,1,1,'2014-09-10',32132.00,3232.00),(2,1,1,1,'2014-09-10',32132.00,3232.00),(3,1,1,1,'2014-09-10',321.00,66.00),(4,1,1,1,'2014-09-10',55.00,55.00),(5,1,1,1,'2014-09-10',55.00,55.00),(6,1,1,1,'2014-09-10',55.00,55.00),(7,1,1,1,'2014-09-10',55.00,55.00),(8,1,1,1,'2014-09-10',55.20,55.20);
/*!40000 ALTER TABLE `movimientos_diarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id_role` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id_role`, `name`) VALUES (1,'Cliente'),(2,'Pulicador'),(3,'Administrador');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_cheques`
--

DROP TABLE IF EXISTS `tipo_cheques`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_cheques` (
  `id_tipo_cheque` int(8) NOT NULL AUTO_INCREMENT,
  `detalle` varchar(100) NOT NULL,
  PRIMARY KEY (`id_tipo_cheque`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_cheques`
--

LOCK TABLES `tipo_cheques` WRITE;
/*!40000 ALTER TABLE `tipo_cheques` DISABLE KEYS */;
INSERT INTO `tipo_cheques` (`id_tipo_cheque`, `detalle`) VALUES (1,'Cheque Vencido'),(2,'Cheque Rechazado');
/*!40000 ALTER TABLE `tipo_cheques` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id_user` int(8) NOT NULL AUTO_INCREMENT,
  `id_role` int(2) DEFAULT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `first_name` varchar(64) DEFAULT NULL,
  `last_name` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  KEY `id_role` (`id_role`),
  CONSTRAINT `id_role` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id_role`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id_user`, `id_role`, `username`, `password`, `first_name`, `last_name`) VALUES (1,1,'pepe','c6f6ce8aad57fa9cef49884a378f08dc','Jose','Lopez'),(2,2,'tito','c6f6ce8aad57fa9cef49884a378f08dc','Carlos','Aguilera'),(3,3,'topo','c6f6ce8aad57fa9cef49884a378f08dc','Ivan','Gomez');
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

-- Dump completed on 2014-09-18 11:48:28
