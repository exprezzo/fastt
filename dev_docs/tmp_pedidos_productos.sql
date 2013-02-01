/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50508
Source Host           : localhost:3306
Source Database       : fastt

Target Server Type    : MYSQL
Target Server Version : 50508
File Encoding         : 65001

Date: 2013-01-31 19:38:38
*/

SET FOREIGN_KEY_CHECKS=0;

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
) ENGINE=InnoDB AUTO_INCREMENT=181 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tmp_pedidos_productos
-- ----------------------------
