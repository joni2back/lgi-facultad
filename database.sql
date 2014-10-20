-- phpMyAdmin SQL Dump
-- version 4.1.13
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 29, 2014 at 09:36 AM
-- Server version: 5.5.38-0ubuntu0.12.04.1-log
-- PHP Version: 5.5.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

DROP DATABASE IF EXISTS `lgi`;
CREATE DATABASE `lgi`;
USE `lgi`;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lgi`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
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
  KEY `id_author` (`id_author`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id_article`, `id_article_category`, `id_article_type`, `id_author`, `title`, `description`, `location`, `address`, `price`) VALUES
(1, 1, 4, 3, 'Vendo Departamento 600 dormitorios como nuevo', 'Somos una empresa diversificada, que participa en la producciÃ³n y comercializaciÃ³n de semillas, fitosanitarios, nutriciÃ³n animal y vegetal, productos de jardinerÃ­a, sanidad ambiental y cuidado de mascotas. AdemÃ¡s contamos con una filial que presta servicios de mecanizaciÃ³n agrÃ­cola.\r\n\r\nContamos con especialistas en cada una de las lÃ­neas de productos que manejamos. \r\nRealizamos una permanente inversiÃ³n en tecnologÃ­a y desarrollo de productos.\r\n', 'Mar del tuyo', '4394399', 5000);

-- --------------------------------------------------------

--
-- Table structure for table `article_categories`
--

CREATE TABLE IF NOT EXISTS `article_categories` (
  `id_article_category` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`id_article_category`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `article_categories`
--

INSERT INTO `article_categories` (`id_article_category`, `name`) VALUES
(1, 'Departamentos'),
(2, 'Cocheras'),
(3, 'Pisos'),
(4, 'Locales comerciales');

-- --------------------------------------------------------

--
-- Table structure for table `article_types`
--

CREATE TABLE IF NOT EXISTS `article_types` (
  `id_article_type` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`id_article_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `article_types`
--

INSERT INTO `article_types` (`id_article_type`, `name`) VALUES
(1, 'Desde la maqueta o plano'),
(2, 'Desde el terreno o pozo con ubicacion confirmada'),
(3, 'Durante la construccion'),
(4, 'Construccion finalizada'),
(5, 'Listos para habitar');

-- --------------------------------------------------------

--
-- Table structure for table `bancos`
--

CREATE TABLE IF NOT EXISTS `bancos` (
  `id_banco` int(8) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(32) NOT NULL,
  `sucursal` varchar(32) NOT NULL,
  `direccion` varchar(64) NOT NULL,
  PRIMARY KEY (`id_banco`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `bancos`
--

INSERT INTO `bancos` (`id_banco`, `nombre`, `sucursal`, `direccion`) VALUES
(2, 'Banco Rio', '28', 'Cordoba 331'),
(3, 'Banco Galicia', '321', 'Oroño 911'),
(4, 'Banco Macro', '15', 'Bv Segui 3992'),
(5, 'Banco Frances', '9', 'Cordoba 7200');

-- --------------------------------------------------------

--
-- Table structure for table `cheques`
--

CREATE TABLE IF NOT EXISTS `cheques` (
  `id_cheque` int(8) NOT NULL AUTO_INCREMENT,
  `id_tipo_cheque` int(8) NOT NULL,
  `id_banco` int(8) NOT NULL,
  `numero` varchar(64) NOT NULL,
  `importe` float(8,2) NOT NULL,
  `fecha_emision` date NOT NULL,
  `fecha_cobro` date NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  PRIMARY KEY (`id_cheque`),
  KEY `id_tipo_cheque` (`id_tipo_cheque`),
  KEY `id_banco` (`id_banco`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cheques`
--

INSERT INTO `cheques` (`id_cheque`, `id_tipo_cheque`, `id_banco`, `numero`, `importe`, `fecha_cobro`, `fecha_emision`, `fecha_vencimiento`) VALUES
(1, 2, 2, 2147483647, 500, '2014-09-30', '2014-10-30', '2015-09-10');

-- --------------------------------------------------------

--
-- Table structure for table `conceptos`
--

CREATE TABLE IF NOT EXISTS `conceptos` (
  `id_concepto` int(8) NOT NULL AUTO_INCREMENT,
  `tipos_movimientos` varchar(64) NOT NULL,
  `detalle` varchar(100) NOT NULL,
  PRIMARY KEY (`id_concepto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6;

--
-- Dumping data for table `conceptos`
--

INSERT INTO `conceptos` (`id_concepto`, `tipos_movimientos`, `detalle`) VALUES
(1, 'Ingresos', 'Pagos Propietarios o Inquilinos'),
(2, 'Ingresos', 'Clientes otros servicios - Conf/Planos, Tasac, Asesor'),
(3, 'Egresos', 'Pagos a Proveedores'),
(4, 'Egresos', 'Pagos a obreros'),
(5, 'Egresos', 'Otros pagos');

-- --------------------------------------------------------

--
-- Table structure for table `consultas`
--

CREATE TABLE IF NOT EXISTS `consultas` (
  `id_consulta` int(8) NOT NULL AUTO_INCREMENT,
  `id_article` int(8) NOT NULL,
  `name` varchar(64) DEFAULT NULL,
  `email` varchar(64) NOT NULL,
  `phone` varchar(32) DEFAULT NULL,
  `message` text,
  `fecha` datetime DEFAULT NULL,
  `ip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id_consulta`),
  KEY `id_article` (`id_article`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `consultas`
--

INSERT INTO `consultas` (`id_consulta`, `id_article`, `name`, `email`, `phone`, `message`, `fecha`, `ip`) VALUES
(1, 1, 'Carlos Almagro', 'carlitos@mixmail.com', '0341-4579214', 'Sometimes we encounter odd application responses that seem to make no sense. One of these such issues is related to running virtual server instances (OS Containers not Para-Virtualized VMs) and attempting to back up their data to Amazonâ€™s S3 cloud storage. For moderately sized virtual machines running MySQL databases or Python/PHP based websites and code repositories this can be an inexpensive, quickly provisioned, and easy way to provide disaster recovery backups in numerous geographic locations, since we generally want DR content to be located in a physically distant location. Nevertheless, we can encounter errors if using an S3 mount in a distance location from our server if the timezone/sync data is incorrect.', '2014-09-17 15:03:02', '192.168.1.1');

--
-- Triggers `consultas`
--
DROP TRIGGER IF EXISTS `update_fecha`;
DELIMITER //
CREATE TRIGGER `update_fecha` BEFORE INSERT ON `consultas`
 FOR EACH ROW SET NEW.fecha = NOW()
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `formas_pago`
--

CREATE TABLE IF NOT EXISTS `formas_pago` (
  `id_forma_pago` int(8) NOT NULL AUTO_INCREMENT,
  `detalle` varchar(100) NOT NULL,
  PRIMARY KEY (`id_forma_pago`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `formas_pago`
--

INSERT INTO `formas_pago` (`id_forma_pago`, `detalle`) VALUES
(1, 'Efectivo');

-- --------------------------------------------------------

--
-- Table structure for table `movimientos_diarios`
--

CREATE TABLE IF NOT EXISTS `movimientos_diarios` (
  `id_movimiento` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(8) NOT NULL,
  `id_concepto` int(8) NOT NULL,
  `id_forma_pago` int(8) NOT NULL,
  `fecha` date NOT NULL,
  `id_tipo_comprobante` int(11) NOT NULL,
  `num_comprobante` int(11) NOT NULL,
  `debe` float(8,2) NOT NULL,
  `haber` float(8,2) NOT NULL,
  `iva` int(11) NOT NULL,
  `total` float NOT NULL,
  `descripcion` text,
  PRIMARY KEY (`id_movimiento`),
  KEY `id_user` (`id_user`),
  KEY `id_forma_pago` (`id_forma_pago`),
  KEY `id_concepto` (`id_concepto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id_role` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id_role`, `name`) VALUES
(1, 'Cliente'),
(2, 'Pulicador'),
(3, 'Administrador');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_cheques`
--

CREATE TABLE IF NOT EXISTS `tipo_cheques` (
  `id_tipo_cheque` int(8) NOT NULL AUTO_INCREMENT,
  `detalle` varchar(100) NOT NULL,
  PRIMARY KEY (`id_tipo_cheque`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tipo_cheques`
--

INSERT INTO `tipo_cheques` (`id_tipo_cheque`, `detalle`) VALUES
(1, 'De emision propia'),
(2, 'De terceros');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_comprobante`
--

CREATE TABLE IF NOT EXISTS `tipo_comprobante` (
  `id_tipo_comprobante` int(11) NOT NULL AUTO_INCREMENT,
  `detalle` varchar(50) NOT NULL,
  PRIMARY KEY (`id_tipo_comprobante`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tipo_comprobante`
--

INSERT INTO `tipo_comprobante` (`id_tipo_comprobante`, `detalle`) VALUES
(1, 'Factura A'),
(2, 'Factura B'),
(3, 'Monotributo');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(8) NOT NULL AUTO_INCREMENT,
  `id_role` int(2) DEFAULT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `first_name` varchar(64) DEFAULT NULL,
  `last_name` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  KEY `id_role` (`id_role`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `id_role`, `username`, `password`, `first_name`, `last_name`) VALUES
(1, 1, 'pepe', 'c6f6ce8aad57fa9cef49884a378f08dc', 'Jose', 'Lopez'),
(2, 2, 'tito', 'c6f6ce8aad57fa9cef49884a378f08dc', 'Carlos', 'Aguilera'),
(3, 3, 'topo', 'c6f6ce8aad57fa9cef49884a378f08dc', 'Ivan', 'Gomez');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `id_article_category` FOREIGN KEY (`id_article_category`) REFERENCES `article_categories` (`id_article_category`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_article_type` FOREIGN KEY (`id_article_type`) REFERENCES `article_types` (`id_article_type`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_author` FOREIGN KEY (`id_author`) REFERENCES `users` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `cheques`
--
ALTER TABLE `cheques`
  ADD CONSTRAINT `id_banco` FOREIGN KEY (`id_banco`) REFERENCES `bancos` (`id_banco`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_tipo_cheque` FOREIGN KEY (`id_tipo_cheque`) REFERENCES `tipo_cheques` (`id_tipo_cheque`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `consultas`
--
ALTER TABLE `consultas`
  ADD CONSTRAINT `id_article` FOREIGN KEY (`id_article`) REFERENCES `articles` (`id_article`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `movimientos_diarios`
--
ALTER TABLE `movimientos_diarios`
  ADD CONSTRAINT `id_concepto` FOREIGN KEY (`id_concepto`) REFERENCES `conceptos` (`id_concepto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_forma_pago` FOREIGN KEY (`id_forma_pago`) REFERENCES `formas_pago` (`id_forma_pago`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `id_role` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id_role`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;