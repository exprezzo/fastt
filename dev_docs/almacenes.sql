/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50508
Source Host           : localhost:3306
Source Database       : fastt

Target Server Type    : MYSQL
Target Server Version : 50508
File Encoding         : 65001

Date: 2013-01-31 14:06:13
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
-- Table structure for `pedidos`
-- ----------------------------
DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_almacen` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pedidos
-- ----------------------------
INSERT INTO `pedidos` VALUES ('1', '3', '2013-01-31 22:02:05');
INSERT INTO `pedidos` VALUES ('2', '1', '2013-01-31 19:53:30');
INSERT INTO `pedidos` VALUES ('3', '3', '2013-01-31 22:04:52');

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pedidos_productos
-- ----------------------------
INSERT INTO `pedidos_productos` VALUES ('1', '5', '1', '0.000000', '5');
INSERT INTO `pedidos_productos` VALUES ('2', '1', '1', '12.000000', '3');
INSERT INTO `pedidos_productos` VALUES ('4', '3', '2', '34.000000', '5');
INSERT INTO `pedidos_productos` VALUES ('5', '3', '2', '34.000000', '5');
INSERT INTO `pedidos_productos` VALUES ('6', '3', '2', '34.000000', '5');
INSERT INTO `pedidos_productos` VALUES ('7', '3', '2', '34.000000', '5');
INSERT INTO `pedidos_productos` VALUES ('8', '3', '2', '34.000000', '5');
INSERT INTO `pedidos_productos` VALUES ('9', '3', '2', '34.000000', '5');
INSERT INTO `pedidos_productos` VALUES ('10', '3', '2', '34.000000', '5');
INSERT INTO `pedidos_productos` VALUES ('11', '2', '3', '23.000000', '2');

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
  PRIMARY KEY (`id_tmp`)
) ENGINE=InnoDB AUTO_INCREMENT=138 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tmp_pedidos_productos
-- ----------------------------
INSERT INTO `tmp_pedidos_productos` VALUES ('4', '3', '2', '34.000000', '5', '54', '510ad0e8c9a1d');
INSERT INTO `tmp_pedidos_productos` VALUES ('5', '3', '2', '34.000000', '5', '55', '510ad0e8c9a1d');
INSERT INTO `tmp_pedidos_productos` VALUES ('6', '3', '2', '34.000000', '5', '56', '510ad0e8c9a1d');
INSERT INTO `tmp_pedidos_productos` VALUES ('7', '3', '2', '34.000000', '5', '57', '510ad0e8c9a1d');
INSERT INTO `tmp_pedidos_productos` VALUES ('8', '3', '2', '34.000000', '5', '58', '510ad0e8c9a1d');
INSERT INTO `tmp_pedidos_productos` VALUES ('9', '3', '2', '34.000000', '5', '59', '510ad0e8c9a1d');
INSERT INTO `tmp_pedidos_productos` VALUES ('10', '3', '2', '34.000000', '5', '60', '510ad0e8c9a1d');
INSERT INTO `tmp_pedidos_productos` VALUES ('4', '3', '2', '34.000000', '5', '61', '510ad18be1ab5');
INSERT INTO `tmp_pedidos_productos` VALUES ('5', '3', '2', '34.000000', '5', '62', '510ad18be1ab5');
INSERT INTO `tmp_pedidos_productos` VALUES ('6', '3', '2', '34.000000', '5', '63', '510ad18be1ab5');
INSERT INTO `tmp_pedidos_productos` VALUES ('7', '3', '2', '34.000000', '5', '64', '510ad18be1ab5');
INSERT INTO `tmp_pedidos_productos` VALUES ('8', '3', '2', '34.000000', '5', '65', '510ad18be1ab5');
INSERT INTO `tmp_pedidos_productos` VALUES ('9', '3', '2', '34.000000', '5', '66', '510ad18be1ab5');
INSERT INTO `tmp_pedidos_productos` VALUES ('10', '3', '2', '34.000000', '5', '67', '510ad18be1ab5');
INSERT INTO `tmp_pedidos_productos` VALUES ('4', '3', '2', '34.000000', '5', '68', '510ad639911f1');
INSERT INTO `tmp_pedidos_productos` VALUES ('5', '3', '2', '34.000000', '5', '69', '510ad639911f1');
INSERT INTO `tmp_pedidos_productos` VALUES ('6', '3', '2', '34.000000', '5', '70', '510ad639911f1');
INSERT INTO `tmp_pedidos_productos` VALUES ('7', '3', '2', '34.000000', '5', '71', '510ad639911f1');
INSERT INTO `tmp_pedidos_productos` VALUES ('8', '3', '2', '34.000000', '5', '72', '510ad639911f1');
INSERT INTO `tmp_pedidos_productos` VALUES ('9', '3', '2', '34.000000', '5', '73', '510ad639911f1');
INSERT INTO `tmp_pedidos_productos` VALUES ('10', '3', '2', '34.000000', '5', '74', '510ad639911f1');
INSERT INTO `tmp_pedidos_productos` VALUES ('4', '3', '2', '34.000000', '5', '75', '510ad6f000486');
INSERT INTO `tmp_pedidos_productos` VALUES ('5', '3', '2', '34.000000', '5', '76', '510ad6f000486');
INSERT INTO `tmp_pedidos_productos` VALUES ('6', '3', '2', '34.000000', '5', '77', '510ad6f000486');
INSERT INTO `tmp_pedidos_productos` VALUES ('7', '3', '2', '34.000000', '5', '78', '510ad6f000486');
INSERT INTO `tmp_pedidos_productos` VALUES ('8', '3', '2', '34.000000', '5', '79', '510ad6f000486');
INSERT INTO `tmp_pedidos_productos` VALUES ('9', '3', '2', '34.000000', '5', '80', '510ad6f000486');
INSERT INTO `tmp_pedidos_productos` VALUES ('10', '3', '2', '34.000000', '5', '81', '510ad6f000486');
INSERT INTO `tmp_pedidos_productos` VALUES ('4', '3', '2', '34.000000', '5', '82', '510ad7263791e');
INSERT INTO `tmp_pedidos_productos` VALUES ('5', '3', '2', '34.000000', '5', '83', '510ad7263791e');
INSERT INTO `tmp_pedidos_productos` VALUES ('6', '3', '2', '34.000000', '5', '84', '510ad7263791e');
INSERT INTO `tmp_pedidos_productos` VALUES ('7', '3', '2', '34.000000', '5', '85', '510ad7263791e');
INSERT INTO `tmp_pedidos_productos` VALUES ('8', '3', '2', '34.000000', '5', '86', '510ad7263791e');
INSERT INTO `tmp_pedidos_productos` VALUES ('9', '3', '2', '34.000000', '5', '87', '510ad7263791e');
INSERT INTO `tmp_pedidos_productos` VALUES ('10', '3', '2', '34.000000', '5', '88', '510ad7263791e');
INSERT INTO `tmp_pedidos_productos` VALUES ('4', '3', '2', '34.000000', '5', '89', '510ad7577cf3a');
INSERT INTO `tmp_pedidos_productos` VALUES ('5', '3', '2', '34.000000', '5', '90', '510ad7577cf3a');
INSERT INTO `tmp_pedidos_productos` VALUES ('6', '3', '2', '34.000000', '5', '91', '510ad7577cf3a');
INSERT INTO `tmp_pedidos_productos` VALUES ('7', '3', '2', '34.000000', '5', '92', '510ad7577cf3a');
INSERT INTO `tmp_pedidos_productos` VALUES ('8', '3', '2', '34.000000', '5', '93', '510ad7577cf3a');
INSERT INTO `tmp_pedidos_productos` VALUES ('9', '3', '2', '34.000000', '5', '94', '510ad7577cf3a');
INSERT INTO `tmp_pedidos_productos` VALUES ('10', '3', '2', '34.000000', '5', '95', '510ad7577cf3a');
INSERT INTO `tmp_pedidos_productos` VALUES ('4', '3', '2', '34.000000', '5', '96', '510ad798d5202');
INSERT INTO `tmp_pedidos_productos` VALUES ('5', '3', '2', '34.000000', '5', '97', '510ad798d5202');
INSERT INTO `tmp_pedidos_productos` VALUES ('6', '3', '2', '34.000000', '5', '98', '510ad798d5202');
INSERT INTO `tmp_pedidos_productos` VALUES ('7', '3', '2', '34.000000', '5', '99', '510ad798d5202');
INSERT INTO `tmp_pedidos_productos` VALUES ('8', '3', '2', '34.000000', '5', '100', '510ad798d5202');
INSERT INTO `tmp_pedidos_productos` VALUES ('9', '3', '2', '34.000000', '5', '101', '510ad798d5202');
INSERT INTO `tmp_pedidos_productos` VALUES ('10', '3', '2', '34.000000', '5', '102', '510ad798d5202');
INSERT INTO `tmp_pedidos_productos` VALUES ('4', '3', '2', '34.000000', '5', '103', '510ad7aacb823');
INSERT INTO `tmp_pedidos_productos` VALUES ('5', '3', '2', '34.000000', '5', '104', '510ad7aacb823');
INSERT INTO `tmp_pedidos_productos` VALUES ('6', '3', '2', '34.000000', '5', '105', '510ad7aacb823');
INSERT INTO `tmp_pedidos_productos` VALUES ('7', '3', '2', '34.000000', '5', '106', '510ad7aacb823');
INSERT INTO `tmp_pedidos_productos` VALUES ('8', '3', '2', '34.000000', '5', '107', '510ad7aacb823');
INSERT INTO `tmp_pedidos_productos` VALUES ('9', '3', '2', '34.000000', '5', '108', '510ad7aacb823');
INSERT INTO `tmp_pedidos_productos` VALUES ('10', '3', '2', '34.000000', '5', '109', '510ad7aacb823');
INSERT INTO `tmp_pedidos_productos` VALUES ('4', '3', '2', '34.000000', '5', '110', '510ad845c73da');
INSERT INTO `tmp_pedidos_productos` VALUES ('5', '3', '2', '34.000000', '5', '111', '510ad845c73da');
INSERT INTO `tmp_pedidos_productos` VALUES ('6', '3', '2', '34.000000', '5', '112', '510ad845c73da');
INSERT INTO `tmp_pedidos_productos` VALUES ('7', '3', '2', '34.000000', '5', '113', '510ad845c73da');
INSERT INTO `tmp_pedidos_productos` VALUES ('8', '3', '2', '34.000000', '5', '114', '510ad845c73da');
INSERT INTO `tmp_pedidos_productos` VALUES ('9', '3', '2', '34.000000', '5', '115', '510ad845c73da');
INSERT INTO `tmp_pedidos_productos` VALUES ('10', '3', '2', '34.000000', '5', '116', '510ad845c73da');
INSERT INTO `tmp_pedidos_productos` VALUES ('1', '1', '1', null, '3', '117', '510ad8e02dbfc');
INSERT INTO `tmp_pedidos_productos` VALUES ('2', '1', '1', '12.000000', '3', '118', '510ad8e02dbfc');
INSERT INTO `tmp_pedidos_productos` VALUES ('1', '1', '1', null, '3', '120', '510ad9bf172fb');
INSERT INTO `tmp_pedidos_productos` VALUES ('2', '1', '1', '12.000000', '3', '121', '510ad9bf172fb');
INSERT INTO `tmp_pedidos_productos` VALUES ('1', '1', '1', null, '3', '123', '510adadaec328');
INSERT INTO `tmp_pedidos_productos` VALUES ('2', '1', '1', '12.000000', '3', '124', '510adadaec328');
INSERT INTO `tmp_pedidos_productos` VALUES ('1', '5', '1', '0.000000', '5', '129', '510adbcd46514');
INSERT INTO `tmp_pedidos_productos` VALUES ('2', '1', '1', '12.000000', '3', '130', '510adbcd46514');
INSERT INTO `tmp_pedidos_productos` VALUES ('1', '5', '1', '0.000000', '5', '132', '510adbd4cc538');
INSERT INTO `tmp_pedidos_productos` VALUES ('2', '1', '1', '12.000000', '3', '133', '510adbd4cc538');
INSERT INTO `tmp_pedidos_productos` VALUES ('11', '2', '3', '23.000000', '2', '137', '510adc749576d');

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
