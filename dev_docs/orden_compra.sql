/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50508
Source Host           : localhost:3306
Source Database       : fastt

Target Server Type    : MYSQL
Target Server Version : 50508
File Encoding         : 65001

Date: 2013-02-25 18:49:10
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `estado_orden_compra`
-- ----------------------------
DROP TABLE IF EXISTS `estado_orden_compra`;
CREATE TABLE `estado_orden_compra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` char(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of estado_orden_compra
-- ----------------------------
INSERT INTO `estado_orden_compra` VALUES ('1', 'Solicitado');
INSERT INTO `estado_orden_compra` VALUES ('2', 'Concentrado');
INSERT INTO `estado_orden_compra` VALUES ('3', 'Parcialmente Surtido');
INSERT INTO `estado_orden_compra` VALUES ('4', 'Surtido');
INSERT INTO `estado_orden_compra` VALUES ('5', 'Cancelado');
INSERT INTO `estado_orden_compra` VALUES ('6', 'Caducado');

-- ----------------------------
-- Table structure for `orden_compra`
-- ----------------------------
DROP TABLE IF EXISTS `orden_compra`;
CREATE TABLE `orden_compra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idproveedor` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `vencimiento` datetime DEFAULT NULL,
  `idestado` tinyint(1) DEFAULT '1',
  `fk_serie` int(11) DEFAULT NULL,
  `folio` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of orden_compra
-- ----------------------------
INSERT INTO `orden_compra` VALUES ('110', '1', '2013-02-24 23:03:29', '2013-02-24 23:03:29', '1', '1', '1');
INSERT INTO `orden_compra` VALUES ('112', '1', '2013-02-25 18:54:39', '2013-02-25 18:54:39', '1', '1', '3');

-- ----------------------------
-- Table structure for `proveedor`
-- ----------------------------
DROP TABLE IF EXISTS `proveedor`;
CREATE TABLE `proveedor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of proveedor
-- ----------------------------
INSERT INTO `proveedor` VALUES ('1', 'Exprezzo');
INSERT INTO `proveedor` VALUES ('2', 'Surti Tec');
INSERT INTO `proveedor` VALUES ('3', 'Poliformas');

-- ----------------------------
-- Table structure for `series_orden_compra`
-- ----------------------------
DROP TABLE IF EXISTS `series_orden_compra`;
CREATE TABLE `series_orden_compra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `serie` char(255) NOT NULL,
  `folio_i` int(11) DEFAULT NULL,
  `folio_f` int(11) DEFAULT NULL,
  `sig_folio` int(11) DEFAULT NULL,
  `es_default` bit(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of series_orden_compra
-- ----------------------------
INSERT INTO `series_orden_compra` VALUES ('1', 'A', '1', '100', '4', '');
