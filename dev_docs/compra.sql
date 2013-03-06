/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50508
Source Host           : localhost:3306
Source Database       : fastt

Target Server Type    : MYSQL
Target Server Version : 50508
File Encoding         : 65001

Date: 2013-03-05 16:52:53
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `articulo_detalle`
-- ----------------------------
DROP TABLE IF EXISTS `articulo_detalle`;
CREATE TABLE `articulo_detalle` (
  `idarticulo` int(11) NOT NULL DEFAULT '0' COMMENT 'id del maestro',
  `fk_articulo` int(11) NOT NULL COMMENT 'id del detalle',
  `cantidad` decimal(12,5) DEFAULT NULL,
  `precio_compra` decimal(12,5) DEFAULT NULL,
  `costo_total` decimal(12,5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of articulo_detalle
-- ----------------------------
INSERT INTO `articulo_detalle` VALUES ('26', '22', '500.00000', '5.00000', '5.00000');
INSERT INTO `articulo_detalle` VALUES ('26', '23', '2.00000', '6.00000', '6.00000');
INSERT INTO `articulo_detalle` VALUES ('26', '24', '1.00000', '1.00000', '1.00000');
INSERT INTO `articulo_detalle` VALUES ('26', '25', '1.00000', '1.00000', '1.00000');
INSERT INTO `articulo_detalle` VALUES ('27', '22', '1000.00000', '5.00000', '5.00000');

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
  `fk_almacen` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=199 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of orden_compra
-- ----------------------------

-- ----------------------------
-- Table structure for `orden_compra_pedido_origen`
-- ----------------------------
DROP TABLE IF EXISTS `orden_compra_pedido_origen`;
CREATE TABLE `orden_compra_pedido_origen` (
  `fk_detalle_orden_compra` int(11) DEFAULT NULL,
  `fk_detalle_pedidoi` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `fk_producto_origen` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of orden_compra_pedido_origen
-- ----------------------------

-- ----------------------------
-- Table structure for `orden_compra_productos`
-- ----------------------------
DROP TABLE IF EXISTS `orden_compra_productos`;
CREATE TABLE `orden_compra_productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_articulo` int(11) DEFAULT NULL,
  `fk_orden_compra` int(11) DEFAULT NULL,
  `cantidad` float(18,6) DEFAULT NULL,
  `idarticulopre` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1700 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of orden_compra_productos
-- ----------------------------

-- ----------------------------
-- Table structure for `proveedor`
-- ----------------------------
DROP TABLE IF EXISTS `proveedor`;
CREATE TABLE `proveedor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of proveedor
-- ----------------------------
INSERT INTO `proveedor` VALUES ('1', 'Exprezzo');
INSERT INTO `proveedor` VALUES ('2', 'Surti Tec');
INSERT INTO `proveedor` VALUES ('3', 'Poliformas');
INSERT INTO `proveedor` VALUES ('4', 'Fruteria Del Valle');
INSERT INTO `proveedor` VALUES ('5', 'Fruteria Juarez');

-- ----------------------------
-- Table structure for `proveedor_producto`
-- ----------------------------
DROP TABLE IF EXISTS `proveedor_producto`;
CREATE TABLE `proveedor_producto` (
  `fk_producto` int(11) DEFAULT NULL,
  `fk_proveedor` int(11) DEFAULT NULL,
  `prioridad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of proveedor_producto
-- ----------------------------
INSERT INTO `proveedor_producto` VALUES ('22', '5', '1');
INSERT INTO `proveedor_producto` VALUES ('23', '5', '1');
INSERT INTO `proveedor_producto` VALUES ('24', '5', '1');
INSERT INTO `proveedor_producto` VALUES ('25', '5', '1');
INSERT INTO `proveedor_producto` VALUES ('26', '5', '1');
INSERT INTO `proveedor_producto` VALUES ('1', '3', '1');
INSERT INTO `proveedor_producto` VALUES ('2', '3', '1');
INSERT INTO `proveedor_producto` VALUES ('3', '3', '1');
INSERT INTO `proveedor_producto` VALUES ('4', '3', '1');
INSERT INTO `proveedor_producto` VALUES ('5', '3', '1');
INSERT INTO `proveedor_producto` VALUES ('6', '3', '1');
INSERT INTO `proveedor_producto` VALUES ('7', '3', '1');
INSERT INTO `proveedor_producto` VALUES ('8', '3', '1');
INSERT INTO `proveedor_producto` VALUES ('9', '3', '1');
INSERT INTO `proveedor_producto` VALUES ('10', '3', '1');
INSERT INTO `proveedor_producto` VALUES ('11', '3', '1');
INSERT INTO `proveedor_producto` VALUES ('12', '3', '1');
INSERT INTO `proveedor_producto` VALUES ('13', '3', '1');
INSERT INTO `proveedor_producto` VALUES ('14', '3', '1');
INSERT INTO `proveedor_producto` VALUES ('15', '3', '1');
INSERT INTO `proveedor_producto` VALUES ('16', '3', '1');
INSERT INTO `proveedor_producto` VALUES ('17', '3', '1');
INSERT INTO `proveedor_producto` VALUES ('18', '3', '1');
INSERT INTO `proveedor_producto` VALUES ('19', '3', '1');
INSERT INTO `proveedor_producto` VALUES ('20', '3', '1');
INSERT INTO `proveedor_producto` VALUES ('21', '3', '1');
INSERT INTO `proveedor_producto` VALUES ('22', '3', '1');

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
