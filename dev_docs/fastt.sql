/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50508
Source Host           : localhost:3306
Source Database       : fastt

Target Server Type    : MYSQL
Target Server Version : 50508
File Encoding         : 65001

Date: 2013-02-04 17:11:52
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `almacenes`
-- ----------------------------
DROP TABLE IF EXISTS `almacenes`;
CREATE TABLE `almacenes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of almacenes
-- ----------------------------
INSERT INTO `almacenes` VALUES ('1', 'Cocina');
INSERT INTO `almacenes` VALUES ('2', 'Barra');
INSERT INTO `almacenes` VALUES ('3', 'almacen A');
INSERT INTO `almacenes` VALUES ('4', 'Otro Almacen');

-- ----------------------------
-- Table structure for `articulopre`
-- ----------------------------
DROP TABLE IF EXISTS `articulopre`;
CREATE TABLE `articulopre` (
  `idarticulopre` int(11) NOT NULL AUTO_INCREMENT,
  `idarticulo` int(11) NOT NULL,
  `descripcion` varchar(20) NOT NULL,
  `factor` decimal(12,3) NOT NULL DEFAULT '1.000',
  `ultimocosto` decimal(12,5) NOT NULL DEFAULT '0.00000',
  `default` bit(1) DEFAULT NULL,
  PRIMARY KEY (`idarticulopre`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of articulopre
-- ----------------------------
INSERT INTO `articulopre` VALUES ('1', '1', 'pre 1', '1.000', '0.00000', '');
INSERT INTO `articulopre` VALUES ('2', '2', 'pre 2', '1.000', '0.00000', '');
INSERT INTO `articulopre` VALUES ('3', '3', 'pre 3', '1.000', '0.00000', '');
INSERT INTO `articulopre` VALUES ('4', '4', 'pre 4', '1.000', '0.00000', '');
INSERT INTO `articulopre` VALUES ('5', '5', 'pre 5', '1.000', '0.00000', '');
INSERT INTO `articulopre` VALUES ('6', '1', 'pre 6', '1.000', '0.00000', '');
INSERT INTO `articulopre` VALUES ('7', '2', 'a', '1.000', '0.00000', '');
INSERT INTO `articulopre` VALUES ('8', '3', 'a', '1.000', '0.00000', '');
INSERT INTO `articulopre` VALUES ('9', '4', 'a', '1.000', '0.00000', '');
INSERT INTO `articulopre` VALUES ('10', '5', 'a', '1.000', '0.00000', '');

-- ----------------------------
-- Table structure for `articulostock`
-- ----------------------------
DROP TABLE IF EXISTS `articulostock`;
CREATE TABLE `articulostock` (
  `idarticuloalmacen` int(11) NOT NULL AUTO_INCREMENT,
  `idarticulo` int(11) DEFAULT NULL,
  `idalmacen` int(11) DEFAULT NULL,
  `existencia` decimal(12,5) DEFAULT NULL,
  `minimo` decimal(12,5) DEFAULT NULL,
  `maximo` decimal(12,5) DEFAULT NULL,
  `puntoreorden` decimal(12,5) DEFAULT NULL,
  `idgrupo` int(11) DEFAULT NULL,
  `grupoposicion` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`idarticuloalmacen`),
  UNIQUE KEY `artalm` (`idarticulo`,`idalmacen`),
  KEY `articulo_idx` (`idarticulo`),
  KEY `almacen_idx` (`idalmacen`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of articulostock
-- ----------------------------
INSERT INTO `articulostock` VALUES ('1', '1', '1', '1.00000', '1.00000', '100.00000', '20.00000', '1', '1');
INSERT INTO `articulostock` VALUES ('2', '2', '1', '2.00000', '1.00000', '100.00000', '20.00000', '2', '2');
INSERT INTO `articulostock` VALUES ('3', '3', '1', '3.00000', '1.00000', '100.00000', '20.00000', '3', '3');
INSERT INTO `articulostock` VALUES ('4', '4', '1', '4.00000', '1.00000', '100.00000', '20.00000', '4', '4');
INSERT INTO `articulostock` VALUES ('5', '5', '1', '5.00000', '1.00000', '100.00000', '20.00000', '5', '5');
INSERT INTO `articulostock` VALUES ('6', '1', '2', '6.00000', '1.00000', '100.00000', '20.00000', '1', '1');
INSERT INTO `articulostock` VALUES ('7', '2', '2', '7.00000', '1.00000', '100.00000', '20.00000', '2', '2');
INSERT INTO `articulostock` VALUES ('8', '3', '2', '8.00000', '1.00000', '100.00000', '20.00000', '3', '3');
INSERT INTO `articulostock` VALUES ('9', '4', '2', '9.00000', '1.00000', '100.00000', '20.00000', '4', '4');
INSERT INTO `articulostock` VALUES ('10', '5', '2', '10.00000', '1.00000', '100.00000', '20.00000', '5', '5');
INSERT INTO `articulostock` VALUES ('11', '1', '3', '11.00000', '1.00000', '100.00000', '20.00000', '1', '1');
INSERT INTO `articulostock` VALUES ('12', '2', '3', '12.00000', '1.00000', '100.00000', '20.00000', '2', '2');
INSERT INTO `articulostock` VALUES ('13', '3', '3', '13.00000', '1.00000', '100.00000', '20.00000', '3', '3');
INSERT INTO `articulostock` VALUES ('14', '4', '3', '14.00000', '1.00000', '100.00000', '20.00000', '4', '4');
INSERT INTO `articulostock` VALUES ('15', '5', '3', '15.00000', '1.00000', '100.00000', '20.00000', '5', '5');
INSERT INTO `articulostock` VALUES ('16', '1', '4', '16.00000', '1.00000', '100.00000', '20.00000', '1', '1');
INSERT INTO `articulostock` VALUES ('17', '2', '4', '17.00000', '1.00000', '100.00000', '20.00000', '2', '2');
INSERT INTO `articulostock` VALUES ('18', '3', '4', '18.00000', '1.00000', '100.00000', '20.00000', '3', '3');
INSERT INTO `articulostock` VALUES ('19', '4', '4', '19.00000', '1.00000', '100.00000', '20.00000', '4', '4');
INSERT INTO `articulostock` VALUES ('20', '5', '4', '20.00000', '1.00000', '100.00000', '20.00000', '5', '5');

-- ----------------------------
-- Table structure for `estado_pedido`
-- ----------------------------
DROP TABLE IF EXISTS `estado_pedido`;
CREATE TABLE `estado_pedido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` char(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of estado_pedido
-- ----------------------------
INSERT INTO `estado_pedido` VALUES ('1', 'Solicitado');
INSERT INTO `estado_pedido` VALUES ('2', 'Concentrado');
INSERT INTO `estado_pedido` VALUES ('3', 'Parcialmente Surtido');
INSERT INTO `estado_pedido` VALUES ('4', 'Surtido');
INSERT INTO `estado_pedido` VALUES ('5', 'Cancelado');
INSERT INTO `estado_pedido` VALUES ('6', 'Caducado');

-- ----------------------------
-- Table structure for `grupo_de_productos`
-- ----------------------------
DROP TABLE IF EXISTS `grupo_de_productos`;
CREATE TABLE `grupo_de_productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` char(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of grupo_de_productos
-- ----------------------------
INSERT INTO `grupo_de_productos` VALUES ('1', 'GRUPO 001');
INSERT INTO `grupo_de_productos` VALUES ('2', 'GRUPO 002');
INSERT INTO `grupo_de_productos` VALUES ('3', 'GRUPO 003');
INSERT INTO `grupo_de_productos` VALUES ('4', 'GRUPO 004');
INSERT INTO `grupo_de_productos` VALUES ('5', 'GRUPO 005');

-- ----------------------------
-- Table structure for `pedidos`
-- ----------------------------
DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_almacen` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `vencimiento` datetime DEFAULT NULL,
  `idestado` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pedidos
-- ----------------------------
INSERT INTO `pedidos` VALUES ('1', '3', '2013-01-31 22:02:05', null, '1');
INSERT INTO `pedidos` VALUES ('2', '1', '2013-01-31 19:53:30', null, '2');
INSERT INTO `pedidos` VALUES ('3', '3', '2013-01-31 22:04:52', null, '3');
INSERT INTO `pedidos` VALUES ('4', '3', '2013-01-31 23:21:11', null, '4');
INSERT INTO `pedidos` VALUES ('5', '1', '2013-01-31 02:41:17', null, '5');
INSERT INTO `pedidos` VALUES ('6', '3', '2013-02-01 01:09:12', '2013-02-04 01:09:12', '6');
INSERT INTO `pedidos` VALUES ('7', '2', '2013-02-01 00:51:45', null, '1');
INSERT INTO `pedidos` VALUES ('8', '1', '2013-02-01 02:29:43', null, '2');
INSERT INTO `pedidos` VALUES ('9', '1', '2013-02-01 02:48:30', null, '3');
INSERT INTO `pedidos` VALUES ('10', '1', '2013-02-01 23:04:51', '2013-02-19 23:04:51', '4');
INSERT INTO `pedidos` VALUES ('11', '4', '2013-02-01 22:59:56', '2013-02-11 22:59:56', '5');
INSERT INTO `pedidos` VALUES ('12', '2', '2013-02-01 23:07:35', '2013-02-08 23:07:35', '6');
INSERT INTO `pedidos` VALUES ('13', '3', '2013-02-02 01:44:13', '2013-02-02 01:44:13', '1');
INSERT INTO `pedidos` VALUES ('15', '1', '2013-02-04 00:44:00', '2013-02-05 00:44:00', '1');

-- ----------------------------
-- Table structure for `pedidos_productos`
-- ----------------------------
DROP TABLE IF EXISTS `pedidos_productos`;
CREATE TABLE `pedidos_productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_articulo` int(11) DEFAULT NULL,
  `fk_pedido` int(11) DEFAULT NULL,
  `cantidad` float(18,6) DEFAULT NULL,
  `idarticulopre` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pedidos_productos
-- ----------------------------
INSERT INTO `pedidos_productos` VALUES ('12', '4', '4', '7.000000', '4');
INSERT INTO `pedidos_productos` VALUES ('13', '4', '7', '11.000000', '4');
INSERT INTO `pedidos_productos` VALUES ('14', '5', '8', '15.000000', '5');
INSERT INTO `pedidos_productos` VALUES ('15', '1', '5', '19.000000', '1');
INSERT INTO `pedidos_productos` VALUES ('16', '1', '9', '19.000000', '1');
INSERT INTO `pedidos_productos` VALUES ('17', '1', '10', '19.000000', '1');
INSERT INTO `pedidos_productos` VALUES ('18', '2', '11', '1.000000', '2');
INSERT INTO `pedidos_productos` VALUES ('19', '4', '11', '1.000000', '4');
INSERT INTO `pedidos_productos` VALUES ('20', '1', '13', '9.000000', '1');
INSERT INTO `pedidos_productos` VALUES ('21', '2', '14', '18.000000', '2');
INSERT INTO `pedidos_productos` VALUES ('22', '2', '15', '18.000000', '2');
INSERT INTO `pedidos_productos` VALUES ('23', '4', '15', '16.000000', '4');

-- ----------------------------
-- Table structure for `productos`
-- ----------------------------
DROP TABLE IF EXISTS `productos`;
CREATE TABLE `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` char(255) DEFAULT NULL,
  `codigo` char(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of productos
-- ----------------------------
INSERT INTO `productos` VALUES ('1', 'prod1', 'p1');
INSERT INTO `productos` VALUES ('2', 'prod2', 'p2');
INSERT INTO `productos` VALUES ('3', 'prod3', 'p3');
INSERT INTO `productos` VALUES ('4', 'prod4', 'p4');
INSERT INTO `productos` VALUES ('5', 'prod5', 'p5');

-- ----------------------------
-- Table structure for `system_users`
-- ----------------------------
DROP TABLE IF EXISTS `system_users`;
CREATE TABLE `system_users` (
  `nick` char(255) NOT NULL,
  `pass` blob,
  `email` char(255) NOT NULL,
  `rol` int(11) DEFAULT '1',
  `fbid` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(255) NOT NULL DEFAULT '0',
  `picture` varchar(255) DEFAULT NULL,
  `originalName` char(255) DEFAULT NULL,
  `bio` varchar(150) DEFAULT NULL,
  `allowFavorites` tinyint(1) DEFAULT '1',
  `allowShared` tinyint(1) DEFAULT '1',
  `allowLiked` tinyint(1) DEFAULT '1',
  `keepLoged` tinyint(1) DEFAULT '0',
  `request` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `nick` (`nick`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of system_users
-- ----------------------------
INSERT INTO `system_users` VALUES ('zesar1', 0x1E398E80A894F4559B8CB0E74C8BEBBA, 'cbibriesca@hotmail.com', '2', null, '1', 'Zesar X', 'pic_1.jpg', 'retro_blue_background.jpg', 'sdfas ad asdasd a dasd ad asd asd asd asd as asd asd asd asd asd asd asd asd asd asd asd asd asd asd asd  as as as dasd sad asd asd asd asd asd asd as', '0', '1', '1', '1', '1355958733');
INSERT INTO `system_users` VALUES ('cesarx', 0x1E398E80A894F4559B8CB0E74C8BEBBA, 'cesar@correo.com', '1', null, '2', '0', null, null, 'asdf', '1', '1', '1', '1', null);
INSERT INTO `system_users` VALUES ('asdfasdf', 0x1E398E80A894F4559B8CB0E74C8BEBBA, 'asd@asd.com', '1', null, '3', '0', null, null, 'asdf', '1', '1', '1', '1', null);
INSERT INTO `system_users` VALUES ('', 0x1E398E80A894F4559B8CB0E74C8BEBBA, '', '1', null, '4', '0', null, null, 'asfd', '1', '1', '1', '1', '1355891612');
INSERT INTO `system_users` VALUES ('username', 0x1E398E80A894F4559B8CB0E74C8BEBBA, 'asdf@sadf.com', '1', null, '5', 'name', null, null, 'asdf', '1', '1', '1', '1', null);
INSERT INTO `system_users` VALUES ('zesar2', 0x1E398E80A894F4559B8CB0E74C8BEBBA, 'zesar2@test.com', '1', null, '6', 'Zesar 2', null, null, null, '1', '1', '1', '0', null);
INSERT INTO `system_users` VALUES ('fouser', 0x1E398E80A894F4559B8CB0E74C8BEBBA, 'userx2@email.com', '1', null, '10', '0', null, null, null, '1', '1', '1', '0', null);

-- ----------------------------
-- Table structure for `tmp_pedidos_productos`
-- ----------------------------
DROP TABLE IF EXISTS `tmp_pedidos_productos`;
CREATE TABLE `tmp_pedidos_productos` (
  `id` int(11) NOT NULL,
  `fk_articulo` int(11) DEFAULT NULL,
  `fk_pedido` int(11) DEFAULT NULL,
  `cantidad` float(18,6) DEFAULT NULL,
  `idarticulopre` int(11) unsigned DEFAULT NULL,
  `id_tmp` int(11) NOT NULL AUTO_INCREMENT,
  `fk_tmp` char(255) DEFAULT NULL,
  `maximo` int(11) DEFAULT NULL,
  `minimo` int(11) DEFAULT NULL,
  `puntoreorden` int(11) DEFAULT NULL,
  `existencia` int(11) DEFAULT NULL,
  `sugerido` int(11) DEFAULT NULL,
  `pendiente` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_tmp`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tmp_pedidos_productos
-- ----------------------------
INSERT INTO `tmp_pedidos_productos` VALUES ('18', '2', '11', '1.000000', '2', '1', '510b79c351729', '100', '1', '20', '17', null, null);
INSERT INTO `tmp_pedidos_productos` VALUES ('0', '1', '0', '14.000000', '1', '2', '510c0d7f9e7af', '100', '1', '20', '6', null, null);
INSERT INTO `tmp_pedidos_productos` VALUES ('18', '2', '11', '1.000000', '2', '3', '510c12b1610f8', '100', '1', '20', '17', null, null);
INSERT INTO `tmp_pedidos_productos` VALUES ('13', '5', '7', '10.000000', '5', '4', '510c191a268af', '100', '1', '20', '10', null, null);
INSERT INTO `tmp_pedidos_productos` VALUES ('18', '2', '11', '1.000000', '2', '5', '510c1fc6a8e49', '100', '1', '20', '17', null, null);
INSERT INTO `tmp_pedidos_productos` VALUES ('0', '2', '11', '3.000000', '2', '6', '510c1fc6a8e49', '100', '1', '20', '17', null, null);
INSERT INTO `tmp_pedidos_productos` VALUES ('18', '2', '11', '1.000000', '2', '7', '510c22c2f37b7', '100', '1', '20', '17', null, null);
INSERT INTO `tmp_pedidos_productos` VALUES ('18', '2', '11', '1.000000', '2', '8', '510c240e29422', '100', '1', '20', '17', null, null);
INSERT INTO `tmp_pedidos_productos` VALUES ('18', '2', '11', '0.000000', '2', '10', '510c24a55aa4e', '0', '0', '0', '0', null, null);
INSERT INTO `tmp_pedidos_productos` VALUES ('18', '2', '11', '1.000000', '2', '14', '510c25a34a845', '100', '1', '20', '17', null, null);
INSERT INTO `tmp_pedidos_productos` VALUES ('18', '2', '11', '1.000000', '2', '16', '510c262ca3fe9', '100', '1', '20', '17', null, null);
INSERT INTO `tmp_pedidos_productos` VALUES ('18', '2', '11', '1.000000', '2', '18', '510c269858e86', '100', '1', '20', '17', null, null);
INSERT INTO `tmp_pedidos_productos` VALUES ('18', '2', '11', '1.000000', '2', '19', '510c270311f14', '100', '1', '20', '17', null, null);
INSERT INTO `tmp_pedidos_productos` VALUES ('18', '2', '11', '1.000000', '2', '20', '510c27576c818', '100', '1', '20', '17', null, null);
INSERT INTO `tmp_pedidos_productos` VALUES ('18', '2', '11', '1.000000', '2', '22', '510c2914b0add', '100', '1', '20', '17', null, null);
INSERT INTO `tmp_pedidos_productos` VALUES ('18', '2', '11', '1.000000', '2', '23', '510c293d1b28a', '100', '1', '20', '17', null, null);
INSERT INTO `tmp_pedidos_productos` VALUES ('18', '2', '11', '1.000000', '2', '24', '510c2966e06aa', '100', '1', '20', '17', null, null);
INSERT INTO `tmp_pedidos_productos` VALUES ('18', '2', '11', '1.000000', '2', '25', '510c297b4f25d', '100', '1', '20', '17', null, null);
INSERT INTO `tmp_pedidos_productos` VALUES ('18', '2', '11', '1.000000', '2', '26', '510c2996da1ea', '100', '1', '20', '17', null, null);
INSERT INTO `tmp_pedidos_productos` VALUES ('18', '2', '11', '1.000000', '2', '27', '510c29a3177e2', '100', '1', '20', '17', null, null);
INSERT INTO `tmp_pedidos_productos` VALUES ('18', '2', '11', '1.000000', '2', '28', '510c29b688a97', '100', '1', '20', '17', null, null);
INSERT INTO `tmp_pedidos_productos` VALUES ('18', '2', '11', '1.000000', '2', '29', '510c29bff1be1', '100', '1', '20', '17', null, null);
INSERT INTO `tmp_pedidos_productos` VALUES ('0', '2', '11', '3.000000', '2', '30', '510c29bff1be1', '100', '1', '20', '17', null, null);
INSERT INTO `tmp_pedidos_productos` VALUES ('0', '5', '11', '0.000000', '5', '31', '510c29bff1be1', '100', '1', '20', '20', null, null);
INSERT INTO `tmp_pedidos_productos` VALUES ('18', '2', '11', '1.000000', '2', '32', '510c2aaae9661', '100', '1', '20', '17', null, null);
INSERT INTO `tmp_pedidos_productos` VALUES ('18', '2', '11', '1.000000', '2', '33', '510c2ad06d696', '100', '1', '20', '17', null, null);
INSERT INTO `tmp_pedidos_productos` VALUES ('18', '2', '11', '1.000000', '2', '34', '510c2afddbddb', '100', '1', '20', '17', null, null);
INSERT INTO `tmp_pedidos_productos` VALUES ('18', '2', '11', '1.000000', '2', '37', '510c2c4b48828', '100', '1', '20', '17', null, null);
INSERT INTO `tmp_pedidos_productos` VALUES ('18', '2', '11', '1.000000', '2', '38', '510c2c8137668', '100', '1', '20', '17', null, null);
INSERT INTO `tmp_pedidos_productos` VALUES ('18', '2', '11', '1.000000', '2', '39', '510c2ca197420', '100', '1', '20', '17', null, null);
INSERT INTO `tmp_pedidos_productos` VALUES ('18', '2', '11', '1.000000', '2', '48', '510c2d1517a65', '100', '1', '20', '17', null, null);
INSERT INTO `tmp_pedidos_productos` VALUES ('19', '4', '11', '1.000000', '4', '49', '510c2d1517a65', '100', '1', '20', '19', null, null);
INSERT INTO `tmp_pedidos_productos` VALUES ('18', '2', '11', '1.000000', '2', '51', '510c2d49c7d10', '100', '1', '20', '17', null, null);
INSERT INTO `tmp_pedidos_productos` VALUES ('19', '4', '11', '1.000000', '4', '52', '510c2d49c7d10', '100', '1', '20', '19', null, null);
INSERT INTO `tmp_pedidos_productos` VALUES ('18', '2', '11', '1.000000', '2', '54', '510c2d646dcca', '100', '1', '20', '17', null, null);
INSERT INTO `tmp_pedidos_productos` VALUES ('19', '4', '11', '1.000000', '4', '55', '510c2d646dcca', '100', '1', '20', '19', null, null);
INSERT INTO `tmp_pedidos_productos` VALUES ('18', '2', '11', '1.000000', '2', '63', '510c30df09da0', '100', '1', '20', '17', null, null);
INSERT INTO `tmp_pedidos_productos` VALUES ('19', '4', '11', '1.000000', '4', '64', '510c30df09da0', '100', '1', '20', '19', null, null);
INSERT INTO `tmp_pedidos_productos` VALUES ('18', '2', '11', '1.000000', '2', '66', '510c3145d97cc', '100', '1', '20', '17', null, null);
INSERT INTO `tmp_pedidos_productos` VALUES ('19', '4', '11', '1.000000', '4', '67', '510c3145d97cc', '100', '1', '20', '19', null, null);
INSERT INTO `tmp_pedidos_productos` VALUES ('18', '2', '11', '1.000000', '2', '69', '510c317ea6383', '100', '1', '20', '17', null, null);
INSERT INTO `tmp_pedidos_productos` VALUES ('19', '4', '11', '1.000000', '4', '70', '510c317ea6383', '100', '1', '20', '19', null, null);
INSERT INTO `tmp_pedidos_productos` VALUES ('18', '2', '11', '1.000000', '2', '72', '510c324108a43', '100', '1', '20', '17', null, null);
INSERT INTO `tmp_pedidos_productos` VALUES ('19', '4', '11', '1.000000', '4', '73', '510c324108a43', '100', '1', '20', '19', null, null);
INSERT INTO `tmp_pedidos_productos` VALUES ('17', '1', '10', '19.000000', '1', '86', '510c3318212fb', '100', '1', '20', '1', null, null);
INSERT INTO `tmp_pedidos_productos` VALUES ('0', '2', '0', '0.000000', '2', '87', '510c595323667', '0', '0', '0', '0', null, null);
INSERT INTO `tmp_pedidos_productos` VALUES ('20', '1', '13', '9.000000', '1', '92', '510c615d41a70', '100', '1', '20', '11', null, null);
INSERT INTO `tmp_pedidos_productos` VALUES ('0', '1', '0', '19.000000', '1', '93', '510c6165ddbb4', '100', '1', '20', '1', null, null);
INSERT INTO `tmp_pedidos_productos` VALUES ('17', '1', '10', '19.000000', '1', '94', '510c63db7c403', '100', '1', '20', '1', null, null);
INSERT INTO `tmp_pedidos_productos` VALUES ('21', '2', '14', '18.000000', '2', '96', '511014c198671', '100', '1', '20', '2', null, null);
INSERT INTO `tmp_pedidos_productos` VALUES ('21', '2', '14', '18.000000', '2', '97', '51101dfc91228', '100', '1', '20', '2', null, null);
INSERT INTO `tmp_pedidos_productos` VALUES ('21', '2', '14', '18.000000', '2', '98', '51103ff64c32e', '100', '1', '20', '2', null, null);
INSERT INTO `tmp_pedidos_productos` VALUES ('0', '4', '0', '0.000000', '4', '100', '511046c7e0892', '0', '0', '0', '0', null, null);

-- ----------------------------
-- Table structure for `um`
-- ----------------------------
DROP TABLE IF EXISTS `um`;
CREATE TABLE `um` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `abrev` char(255) NOT NULL,
  `descripcion` char(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of um
-- ----------------------------
INSERT INTO `um` VALUES ('1', 'PZA', null);
INSERT INTO `um` VALUES ('2', 'U', null);
INSERT INTO `um` VALUES ('3', 'Kg', null);
INSERT INTO `um` VALUES ('4', 'M', null);
INSERT INTO `um` VALUES ('5', 'Km', null);
