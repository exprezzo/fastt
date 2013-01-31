/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50508
Source Host           : localhost:3306
Source Database       : fastt

Target Server Type    : MYSQL
Target Server Version : 50508
File Encoding         : 65001

Date: 2013-01-30 22:03:00
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
-- Table structure for `pedidos`
-- ----------------------------
DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_almacen` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=192 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pedidos
-- ----------------------------

-- ----------------------------
-- Table structure for `pedidos_productos`
-- ----------------------------
DROP TABLE IF EXISTS `pedidos_productos`;
CREATE TABLE `pedidos_productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_articulo` int(11) DEFAULT NULL,
  `fk_pedido` int(11) DEFAULT NULL,
  `cantidad` float(18,6) DEFAULT NULL,
  `fk_um` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pedidos_productos
-- ----------------------------

-- ----------------------------
-- Table structure for `productos`
-- ----------------------------
DROP TABLE IF EXISTS `productos`;
CREATE TABLE `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` char(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of productos
-- ----------------------------
INSERT INTO `productos` VALUES ('1', 'prod1');
INSERT INTO `productos` VALUES ('2', 'prod2');
INSERT INTO `productos` VALUES ('3', 'prod3');
INSERT INTO `productos` VALUES ('4', 'prod4');
INSERT INTO `productos` VALUES ('5', 'prod5');


-- ----------------------------
-- Table structure for `tmp_pedidos_productos`
-- ----------------------------
DROP TABLE IF EXISTS `tmp_pedidos_productos`;
CREATE TABLE `tmp_pedidos_productos` (
  `id` int(11) NOT NULL,
  `fk_articulo` int(11) DEFAULT NULL,
  `fk_pedido` int(11) DEFAULT NULL,
  `cantidad` float(18,6) DEFAULT NULL,
  `fk_um` int(11) unsigned DEFAULT NULL,
  `id_tmp` int(11) NOT NULL AUTO_INCREMENT,
  `fk_tmp` char(255) DEFAULT NULL,
  PRIMARY KEY (`id_tmp`)
) ENGINE=InnoDB AUTO_INCREMENT=687 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tmp_pedidos_productos
-- ----------------------------

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
