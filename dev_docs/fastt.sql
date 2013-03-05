/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50508
Source Host           : localhost:3306
Source Database       : fastt

Target Server Type    : MYSQL
Target Server Version : 50508
File Encoding         : 65001

Date: 2013-03-05 12:56:38
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of almacenes
-- ----------------------------
INSERT INTO `almacenes` VALUES ('1', 'Figuras');
INSERT INTO `almacenes` VALUES ('2', 'Cocina');
INSERT INTO `almacenes` VALUES ('3', 'Compras');

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
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of articulostock
-- ----------------------------
INSERT INTO `articulostock` VALUES ('21', '1', '1', '7.00000', '1.00000', '5.00000', '2.00000', '1', '1');
INSERT INTO `articulostock` VALUES ('22', '2', '1', '8.00000', '1.00000', '5.00000', '2.00000', '1', '2');
INSERT INTO `articulostock` VALUES ('23', '3', '1', '3.00000', '1.00000', '5.00000', '2.00000', '1', '3');
INSERT INTO `articulostock` VALUES ('24', '4', '1', '6.00000', '1.00000', '5.00000', '2.00000', '2', '4');
INSERT INTO `articulostock` VALUES ('25', '5', '1', '4.00000', '1.00000', '5.00000', '2.00000', '1', '5');
INSERT INTO `articulostock` VALUES ('26', '6', '1', '5.00000', '1.00000', '5.00000', '2.00000', '2', '6');
INSERT INTO `articulostock` VALUES ('27', '7', '1', '2.00000', '1.00000', '5.00000', '2.00000', '2', '7');
INSERT INTO `articulostock` VALUES ('28', '8', '1', '4.00000', '1.00000', '5.00000', '2.00000', '2', '8');
INSERT INTO `articulostock` VALUES ('29', '9', '1', '3.00000', '1.00000', '5.00000', '2.00000', '2', '9');
INSERT INTO `articulostock` VALUES ('30', '10', '1', '2.00000', '1.00000', '5.00000', '2.00000', '2', '10');
INSERT INTO `articulostock` VALUES ('31', '11', '1', '2.00000', '1.00000', '5.00000', '2.00000', '2', '11');
INSERT INTO `articulostock` VALUES ('32', '12', '1', '2.00000', '1.00000', '5.00000', '2.00000', '2', '12');
INSERT INTO `articulostock` VALUES ('33', '13', '1', '2.00000', '1.00000', '5.00000', '2.00000', '2', '13');
INSERT INTO `articulostock` VALUES ('34', '14', '1', '3.00000', '1.00000', '5.00000', '2.00000', '2', '14');
INSERT INTO `articulostock` VALUES ('35', '15', '1', '2.00000', '1.00000', '5.00000', '2.00000', '2', '15');
INSERT INTO `articulostock` VALUES ('36', '16', '1', '2.00000', '1.00000', '5.00000', '2.00000', '2', '16');
INSERT INTO `articulostock` VALUES ('37', '17', '1', '2.00000', '1.00000', '5.00000', '2.00000', '2', '17');
INSERT INTO `articulostock` VALUES ('38', '18', '1', '3.00000', '1.00000', '5.00000', '2.00000', '2', '18');
INSERT INTO `articulostock` VALUES ('39', '19', '1', '0.00000', '1.00000', '5.00000', '2.00000', '3', '19');
INSERT INTO `articulostock` VALUES ('40', '20', '1', '2.00000', '1.00000', '5.00000', '2.00000', '3', '20');
INSERT INTO `articulostock` VALUES ('41', '21', '1', '1.00000', '1.00000', '5.00000', '2.00000', '2', '21');
INSERT INTO `articulostock` VALUES ('42', '22', '2', '0.00000', '11.00000', '50.00000', '10.00000', '4', '1');
INSERT INTO `articulostock` VALUES ('43', '23', '2', '0.00000', '12.00000', '51.00000', '11.00000', '4', '2');
INSERT INTO `articulostock` VALUES ('44', '24', '2', '0.00000', '13.00000', '52.00000', '12.00000', '4', '3');
INSERT INTO `articulostock` VALUES ('45', '25', '2', '0.00000', '14.00000', '53.00000', '13.00000', '4', '4');
INSERT INTO `articulostock` VALUES ('46', '26', '2', '0.00000', '15.00000', '54.00000', '14.00000', '4', '5');
INSERT INTO `articulostock` VALUES ('47', '27', '2', '0.00000', '16.00000', '55.00000', '15.00000', '4', '6');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of grupo_de_productos
-- ----------------------------
INSERT INTO `grupo_de_productos` VALUES ('1', 'CHICO');
INSERT INTO `grupo_de_productos` VALUES ('2', 'MEDIANO');
INSERT INTO `grupo_de_productos` VALUES ('3', 'GRANDE');
INSERT INTO `grupo_de_productos` VALUES ('4', 'insumos');

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
) ENGINE=InnoDB AUTO_INCREMENT=207 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of orden_compra
-- ----------------------------
INSERT INTO `orden_compra` VALUES ('189', '3', '2013-03-05 10:58:26', '2013-03-05 10:58:26', '1', '1', '81', '3');
INSERT INTO `orden_compra` VALUES ('190', '5', '2013-03-05 10:58:26', '2013-03-05 10:58:26', '1', '1', '82', '3');

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
INSERT INTO `orden_compra_pedido_origen` VALUES ('1667', '1439', '1500', '26');
INSERT INTO `orden_compra_pedido_origen` VALUES ('1667', '1441', '500', '27');

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
) ENGINE=InnoDB AUTO_INCREMENT=1727 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of orden_compra_productos
-- ----------------------------
INSERT INTO `orden_compra_productos` VALUES ('1664', '1', '189', '12.000000', '0');
INSERT INTO `orden_compra_productos` VALUES ('1665', '4', '189', '23.000000', '0');
INSERT INTO `orden_compra_productos` VALUES ('1666', '7', '189', '23.000000', '0');
INSERT INTO `orden_compra_productos` VALUES ('1667', '22', '190', '18000.000000', null);
INSERT INTO `orden_compra_productos` VALUES ('1668', '23', '190', '24.000000', null);
INSERT INTO `orden_compra_productos` VALUES ('1669', '24', '190', '12.000000', null);
INSERT INTO `orden_compra_productos` VALUES ('1670', '25', '190', '12.000000', null);

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
  `fk_serie` int(11) DEFAULT NULL,
  `folio` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pedidos
-- ----------------------------
INSERT INTO `pedidos` VALUES ('119', '2', '2013-03-01 22:49:40', '2013-03-01 22:49:40', '2', '2', '2');
INSERT INTO `pedidos` VALUES ('120', '1', '2013-03-01 16:03:14', '2013-03-01 16:03:14', '2', '1', '49');

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
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1468 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pedidos_productos
-- ----------------------------
INSERT INTO `pedidos_productos` VALUES ('1438', '22', '119', '0.000000', '0', '1');
INSERT INTO `pedidos_productos` VALUES ('1439', '26', '119', '12.000000', '0', '1');
INSERT INTO `pedidos_productos` VALUES ('1440', '23', '119', '0.000000', '0', '1');
INSERT INTO `pedidos_productos` VALUES ('1441', '27', '119', '12.000000', '0', '1');
INSERT INTO `pedidos_productos` VALUES ('1442', '24', '119', '0.000000', '0', '1');
INSERT INTO `pedidos_productos` VALUES ('1443', '25', '119', '0.000000', '0', '1');
INSERT INTO `pedidos_productos` VALUES ('1444', '1', '120', '0.000000', '1', '1');
INSERT INTO `pedidos_productos` VALUES ('1445', '5', '120', '0.000000', '5', '1');
INSERT INTO `pedidos_productos` VALUES ('1446', '2', '120', '0.000000', '2', '1');
INSERT INTO `pedidos_productos` VALUES ('1447', '3', '120', '0.000000', '3', '1');
INSERT INTO `pedidos_productos` VALUES ('1448', '9', '120', '0.000000', '0', '1');
INSERT INTO `pedidos_productos` VALUES ('1449', '13', '120', '0.000000', '0', '1');
INSERT INTO `pedidos_productos` VALUES ('1450', '17', '120', '0.000000', '0', '1');
INSERT INTO `pedidos_productos` VALUES ('1451', '21', '120', '0.000000', '0', '1');
INSERT INTO `pedidos_productos` VALUES ('1452', '6', '120', '0.000000', '0', '1');
INSERT INTO `pedidos_productos` VALUES ('1453', '10', '120', '0.000000', '0', '1');
INSERT INTO `pedidos_productos` VALUES ('1454', '14', '120', '0.000000', '0', '1');
INSERT INTO `pedidos_productos` VALUES ('1455', '18', '120', '0.000000', '0', '1');
INSERT INTO `pedidos_productos` VALUES ('1456', '7', '120', '0.000000', '0', '1');
INSERT INTO `pedidos_productos` VALUES ('1457', '11', '120', '0.000000', '0', '1');
INSERT INTO `pedidos_productos` VALUES ('1458', '15', '120', '0.000000', '0', '1');
INSERT INTO `pedidos_productos` VALUES ('1459', '4', '120', '0.000000', '4', '1');
INSERT INTO `pedidos_productos` VALUES ('1460', '8', '120', '0.000000', '0', '1');
INSERT INTO `pedidos_productos` VALUES ('1461', '12', '120', '0.000000', '0', '1');
INSERT INTO `pedidos_productos` VALUES ('1462', '16', '120', '0.000000', '0', '1');
INSERT INTO `pedidos_productos` VALUES ('1463', '19', '120', '0.000000', '0', '1');
INSERT INTO `pedidos_productos` VALUES ('1464', '20', '120', '0.000000', '0', '1');
INSERT INTO `pedidos_productos` VALUES ('1465', '1', '119', '12.000000', '0', '1');
INSERT INTO `pedidos_productos` VALUES ('1466', '4', '119', '23.000000', '0', '1');
INSERT INTO `pedidos_productos` VALUES ('1467', '7', '119', '23.000000', '0', '1');

-- ----------------------------
-- Table structure for `productos`
-- ----------------------------
DROP TABLE IF EXISTS `productos`;
CREATE TABLE `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` char(255) DEFAULT NULL,
  `codigo` char(20) DEFAULT NULL,
  `tipo` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of productos
-- ----------------------------
INSERT INTO `productos` VALUES ('1', 'Piolin', 'pio-ch', '1');
INSERT INTO `productos` VALUES ('2', 'Flor Feliz', 'flo-ch', '1');
INSERT INTO `productos` VALUES ('3', 'Flor', 'flo-ch', '1');
INSERT INTO `productos` VALUES ('4', 'Corazon', 'cor-med', '1');
INSERT INTO `productos` VALUES ('5', 'Rosita', 'ro-ch', '1');
INSERT INTO `productos` VALUES ('6', 'Osito', 'oso-med', '1');
INSERT INTO `productos` VALUES ('7', 'Pez', 'pez-med', '1');
INSERT INTO `productos` VALUES ('8', 'Dinosaurio Triceratop', 'tri-med', '1');
INSERT INTO `productos` VALUES ('9', 'Dinosaurio Diplodocus', 'dip-med', '1');
INSERT INTO `productos` VALUES ('10', 'tortuga', 'tor-med', '1');
INSERT INTO `productos` VALUES ('11', 'ELmo', 'el-med', '1');
INSERT INTO `productos` VALUES ('12', 'blanca nieves', 'bla-med', '1');
INSERT INTO `productos` VALUES ('13', 'Wini poh', 'win-med', '1');
INSERT INTO `productos` VALUES ('14', 'Jessy vaquerita', 'jes-med', '1');
INSERT INTO `productos` VALUES ('15', 'Perro lanudo', 'per-med', '1');
INSERT INTO `productos` VALUES ('16', 'Perro lasio', 'per-las', '1');
INSERT INTO `productos` VALUES ('17', 'Caballito', 'cab-med', '1');
INSERT INTO `productos` VALUES ('18', 'Jaiba', 'jai-med', '1');
INSERT INTO `productos` VALUES ('19', 'Austin', 'aus-gra', '1');
INSERT INTO `productos` VALUES ('20', 'Tasha', 'tash-gra', '1');
INSERT INTO `productos` VALUES ('21', 'pulpo', 'pul-med', '1');
INSERT INTO `productos` VALUES ('22', 'Tomate', 'tomate', '1');
INSERT INTO `productos` VALUES ('23', 'cebolla', 'cebolla', '1');
INSERT INTO `productos` VALUES ('24', 'ajo', 'ajo', '1');
INSERT INTO `productos` VALUES ('25', 'cilantro', 'cilantro', '1');
INSERT INTO `productos` VALUES ('26', 'Salsa de tomate', 'salsa', '2');
INSERT INTO `productos` VALUES ('27', 'Jugo de Tomate', 'jugo tomate', '2');

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
-- Table structure for `series`
-- ----------------------------
DROP TABLE IF EXISTS `series`;
CREATE TABLE `series` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `serie` char(255) NOT NULL,
  `folio_i` int(11) DEFAULT NULL,
  `folio_f` int(11) DEFAULT NULL,
  `sig_folio` int(11) DEFAULT NULL,
  `es_default` bit(1) DEFAULT NULL,
  `idalmacen` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of series
-- ----------------------------
INSERT INTO `series` VALUES ('1', 'A', '1', '100', '99', '', '1');
INSERT INTO `series` VALUES ('2', 'C', '1', '100', '3', '', '2');

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
