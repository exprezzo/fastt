/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50508
Source Host           : localhost:3306
Source Database       : fastt

Target Server Type    : MYSQL
Target Server Version : 50508
File Encoding         : 65001

Date: 2013-01-31 16:37:52
*/

SET FOREIGN_KEY_CHECKS=0;

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
INSERT INTO `articulostock` VALUES ('1', '1', '1', '1.00000', '1.00000', '100.00000', '20.00000', null, null);
INSERT INTO `articulostock` VALUES ('2', '2', '1', '2.00000', '1.00000', '100.00000', '20.00000', null, null);
INSERT INTO `articulostock` VALUES ('3', '3', '1', '3.00000', '1.00000', '100.00000', '20.00000', null, null);
INSERT INTO `articulostock` VALUES ('4', '4', '1', '4.00000', '1.00000', '100.00000', '20.00000', null, null);
INSERT INTO `articulostock` VALUES ('5', '5', '1', '5.00000', '1.00000', '100.00000', '20.00000', null, null);
INSERT INTO `articulostock` VALUES ('6', '1', '2', '6.00000', '1.00000', '100.00000', '20.00000', null, null);
INSERT INTO `articulostock` VALUES ('7', '2', '2', '7.00000', '1.00000', '100.00000', '20.00000', null, null);
INSERT INTO `articulostock` VALUES ('8', '3', '2', '8.00000', '1.00000', '100.00000', '20.00000', null, null);
INSERT INTO `articulostock` VALUES ('9', '4', '2', '9.00000', '1.00000', '100.00000', '20.00000', null, null);
INSERT INTO `articulostock` VALUES ('10', '5', '2', '10.00000', '1.00000', '100.00000', '20.00000', null, null);
INSERT INTO `articulostock` VALUES ('11', '1', '3', '11.00000', '1.00000', '100.00000', '20.00000', null, null);
INSERT INTO `articulostock` VALUES ('12', '2', '3', '12.00000', '1.00000', '100.00000', '20.00000', null, null);
INSERT INTO `articulostock` VALUES ('13', '3', '3', '13.00000', '1.00000', '100.00000', '20.00000', null, null);
INSERT INTO `articulostock` VALUES ('14', '4', '3', '14.00000', '1.00000', '100.00000', '20.00000', null, null);
INSERT INTO `articulostock` VALUES ('15', '5', '3', '15.00000', '1.00000', '100.00000', '20.00000', null, null);
INSERT INTO `articulostock` VALUES ('16', '1', '4', '16.00000', '1.00000', '100.00000', '20.00000', null, null);
INSERT INTO `articulostock` VALUES ('17', '2', '4', '17.00000', '1.00000', '100.00000', '20.00000', null, null);
INSERT INTO `articulostock` VALUES ('18', '3', '4', '18.00000', '1.00000', '100.00000', '20.00000', null, null);
INSERT INTO `articulostock` VALUES ('19', '4', '4', '19.00000', '1.00000', '100.00000', '20.00000', null, null);
INSERT INTO `articulostock` VALUES ('20', '5', '4', '20.00000', '1.00000', '100.00000', '20.00000', null, null);
