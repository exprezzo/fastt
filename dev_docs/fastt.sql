/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50508
Source Host           : localhost:3306
Source Database       : fastt

Target Server Type    : MYSQL
Target Server Version : 50508
File Encoding         : 65001

Date: 2013-03-26 08:25:46
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of almacenes
-- ----------------------------
INSERT INTO `almacenes` VALUES ('1', 'Limpieza');
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
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of articulopre
-- ----------------------------
INSERT INTO `articulopre` VALUES ('1', '1', 'pre_Piolin', '1.000', '0.00000', '');
INSERT INTO `articulopre` VALUES ('2', '2', 'pre_Flor Feliz', '1.000', '0.00000', '');
INSERT INTO `articulopre` VALUES ('3', '3', 'pre_Flor', '1.000', '0.00000', '');
INSERT INTO `articulopre` VALUES ('4', '4', 'pre_Corazon', '1.000', '0.00000', '');
INSERT INTO `articulopre` VALUES ('5', '5', 'pre_Rosita', '1.000', '0.00000', '');
INSERT INTO `articulopre` VALUES ('16', '6', 'pre_Osito', '1.000', '0.00000', '');
INSERT INTO `articulopre` VALUES ('17', '7', 'pre_Pez', '1.000', '0.00000', '');
INSERT INTO `articulopre` VALUES ('18', '8', 'pre_Dinosaurio Trice', '1.000', '0.00000', '');
INSERT INTO `articulopre` VALUES ('19', '9', 'pre_Dinosaurio Diplo', '1.000', '0.00000', '');
INSERT INTO `articulopre` VALUES ('20', '10', 'pre_tortuga', '1.000', '0.00000', '');
INSERT INTO `articulopre` VALUES ('21', '11', 'pre_ELmo', '1.000', '0.00000', '');
INSERT INTO `articulopre` VALUES ('22', '12', 'pre_blanca nieves', '1.000', '0.00000', '');
INSERT INTO `articulopre` VALUES ('23', '13', 'pre_Wini poh', '1.000', '0.00000', '');
INSERT INTO `articulopre` VALUES ('24', '14', 'pre_Jessy vaquerita', '1.000', '0.00000', '');
INSERT INTO `articulopre` VALUES ('25', '15', 'pre_Perro lanudo', '1.000', '0.00000', '');
INSERT INTO `articulopre` VALUES ('26', '16', 'pre_Perro lasio', '1.000', '0.00000', '');
INSERT INTO `articulopre` VALUES ('27', '17', 'pre_Caballito', '1.000', '0.00000', '');
INSERT INTO `articulopre` VALUES ('28', '18', 'pre_Jaiba', '1.000', '0.00000', '');
INSERT INTO `articulopre` VALUES ('39', '19', 'pre_Austin', '1.000', '0.00000', '');
INSERT INTO `articulopre` VALUES ('40', '20', 'pre_Tasha', '1.000', '0.00000', '');
INSERT INTO `articulopre` VALUES ('41', '21', 'pre_pulpo', '1.000', '0.00000', '');
INSERT INTO `articulopre` VALUES ('42', '22', 'Kg', '1.000', '0.00000', '');
INSERT INTO `articulopre` VALUES ('43', '23', 'pre_cebolla', '1.000', '0.00000', '');
INSERT INTO `articulopre` VALUES ('44', '24', 'pre_ajo', '1.000', '0.00000', '');
INSERT INTO `articulopre` VALUES ('45', '25', 'pre_cilantro', '1.000', '0.00000', '');
INSERT INTO `articulopre` VALUES ('46', '26', 'Litro', '1.000', '0.00000', '');
INSERT INTO `articulopre` VALUES ('47', '27', 'Litro', '1.000', '0.00000', '');

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
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of articulostock
-- ----------------------------
INSERT INTO `articulostock` VALUES ('21', '1', '1', '1.00000', '1.00000', '5.00000', '2.00000', '1', '1');
INSERT INTO `articulostock` VALUES ('22', '2', '1', '1.00000', '1.00000', '5.00000', '2.00000', '1', '2');
INSERT INTO `articulostock` VALUES ('23', '3', '1', '1.00000', '1.00000', '5.00000', '2.00000', '1', '3');
INSERT INTO `articulostock` VALUES ('24', '4', '1', '2.00000', '1.00000', '5.00000', '2.00000', '2', '4');
INSERT INTO `articulostock` VALUES ('25', '5', '1', '2.00000', '1.00000', '5.00000', '2.00000', '1', '5');
INSERT INTO `articulostock` VALUES ('26', '6', '1', '2.00000', '1.00000', '5.00000', '2.00000', '2', '6');
INSERT INTO `articulostock` VALUES ('27', '7', '1', '2.00000', '1.00000', '5.00000', '2.00000', '2', '7');
INSERT INTO `articulostock` VALUES ('28', '8', '1', '3.00000', '1.00000', '5.00000', '2.00000', '2', '8');
INSERT INTO `articulostock` VALUES ('29', '9', '1', '3.00000', '1.00000', '5.00000', '2.00000', '2', '9');
INSERT INTO `articulostock` VALUES ('30', '10', '1', '3.00000', '1.00000', '5.00000', '2.00000', '2', '10');
INSERT INTO `articulostock` VALUES ('31', '11', '1', '4.00000', '1.00000', '5.00000', '2.00000', '2', '11');
INSERT INTO `articulostock` VALUES ('32', '12', '1', '4.00000', '1.00000', '5.00000', '2.00000', '2', '12');
INSERT INTO `articulostock` VALUES ('33', '13', '1', '4.00000', '1.00000', '5.00000', '2.00000', '2', '13');
INSERT INTO `articulostock` VALUES ('34', '14', '1', '5.00000', '1.00000', '5.00000', '2.00000', '2', '14');
INSERT INTO `articulostock` VALUES ('35', '15', '1', '5.00000', '1.00000', '5.00000', '2.00000', '29', '15');
INSERT INTO `articulostock` VALUES ('36', '16', '1', '5.00000', '1.00000', '5.00000', '2.00000', '9', '16');
INSERT INTO `articulostock` VALUES ('37', '17', '1', '5.00000', '1.00000', '5.00000', '2.00000', '9', '17');
INSERT INTO `articulostock` VALUES ('38', '18', '1', '6.00000', '1.00000', '5.00000', '2.00000', '2', '18');
INSERT INTO `articulostock` VALUES ('39', '19', '1', '6.00000', '1.00000', '5.00000', '2.00000', '3', '19');
INSERT INTO `articulostock` VALUES ('40', '20', '1', '6.00000', '1.00000', '5.00000', '2.00000', '3', '20');
INSERT INTO `articulostock` VALUES ('41', '21', '1', '6.00000', '1.00000', '5.00000', '2.00000', '2', '21');
INSERT INTO `articulostock` VALUES ('42', '22', '2', '6.00000', '11.00000', '50.00000', '10.00000', '4', '1');
INSERT INTO `articulostock` VALUES ('43', '23', '2', '7.00000', '12.00000', '51.00000', '11.00000', '4', '2');
INSERT INTO `articulostock` VALUES ('44', '24', '2', '7.00000', '13.00000', '52.00000', '12.00000', '4', '3');
INSERT INTO `articulostock` VALUES ('45', '25', '2', '7.00000', '14.00000', '53.00000', '13.00000', '4', '4');
INSERT INTO `articulostock` VALUES ('46', '26', '2', '7.00000', '15.00000', '54.00000', '14.00000', '4', '5');
INSERT INTO `articulostock` VALUES ('47', '27', '2', '7.00000', '16.00000', '55.00000', '15.00000', '4', '6');
INSERT INTO `articulostock` VALUES ('48', '1', '3', '8.00000', '1.00000', '11.00000', '3.00000', '1', '1');
INSERT INTO `articulostock` VALUES ('49', '2', '3', '6.00000', '2.00000', '20.00000', '6.00000', '1', '1');
INSERT INTO `articulostock` VALUES ('50', '3', '3', '8.00000', '1.00000', '13.00000', '3.00000', '1', '1');
INSERT INTO `articulostock` VALUES ('51', '4', '3', '8.00000', '1.00000', '14.00000', '3.00000', '1', '1');
INSERT INTO `articulostock` VALUES ('52', '5', '3', '9.00000', '1.00000', '15.00000', '3.00000', '1', '1');
INSERT INTO `articulostock` VALUES ('53', '6', '3', '9.00000', '1.00000', '16.00000', '3.00000', '1', '1');
INSERT INTO `articulostock` VALUES ('54', '7', '3', '9.00000', '1.00000', '17.00000', '3.00000', '1', '1');
INSERT INTO `articulostock` VALUES ('55', '8', '3', '9.00000', '1.00000', '18.00000', '3.00000', '1', '1');
INSERT INTO `articulostock` VALUES ('56', '9', '3', '9.00000', '1.00000', '119.00000', '3.00000', '1', '1');
INSERT INTO `articulostock` VALUES ('57', '10', '3', '10.00000', '1.00000', '20.00000', '3.00000', '1', '1');
INSERT INTO `articulostock` VALUES ('58', '11', '3', '10.00000', '1.00000', '21.00000', '3.00000', '1', '1');
INSERT INTO `articulostock` VALUES ('59', '12', '3', '10.00000', '1.00000', '22.00000', '3.00000', '1', '1');
INSERT INTO `articulostock` VALUES ('60', '13', '3', '10.00000', '1.00000', '23.00000', '3.00000', '1', '1');
INSERT INTO `articulostock` VALUES ('61', '14', '3', '10.00000', '1.00000', '24.00000', '3.00000', '1', '1');
INSERT INTO `articulostock` VALUES ('62', '15', '3', '10.00000', '1.00000', '25.00000', '3.00000', '1', '1');
INSERT INTO `articulostock` VALUES ('63', '16', '3', '10.00000', '1.00000', '26.00000', '3.00000', '1', '1');
INSERT INTO `articulostock` VALUES ('64', '17', '3', '10.00000', '1.00000', '27.00000', '3.00000', '1', '1');
INSERT INTO `articulostock` VALUES ('65', '18', '3', '11.00000', '1.00000', '28.00000', '3.00000', '1', '1');
INSERT INTO `articulostock` VALUES ('66', '19', '3', '11.00000', '1.00000', '29.00000', '3.00000', '1', '1');
INSERT INTO `articulostock` VALUES ('67', '20', '3', '11.00000', '1.00000', '30.00000', '3.00000', '1', '1');
INSERT INTO `articulostock` VALUES ('68', '21', '3', '11.00000', '1.00000', '31.00000', '3.00000', '1', '1');
INSERT INTO `articulostock` VALUES ('70', '22', '3', '8.00000', '6.00000', '10.00000', '7.00000', '1', '1');
INSERT INTO `articulostock` VALUES ('71', '23', '3', '4.00000', '2.00000', '1.00000', '3.00000', '1', '1');
INSERT INTO `articulostock` VALUES ('72', '24', '3', '11.00000', '1.00000', '34.00000', '3.00000', '1', '1');
INSERT INTO `articulostock` VALUES ('73', '25', '3', '11.00000', '1.00000', '35.00000', '3.00000', '1', '1');
INSERT INTO `articulostock` VALUES ('74', '26', '3', null, null, null, null, '1', '1');
INSERT INTO `articulostock` VALUES ('75', '27', '3', null, null, '0.00000', null, '1', '1');
INSERT INTO `articulostock` VALUES ('78', '22', '1', '1.00000', '11.00000', '1.00000', '1.00000', '1', '1');

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
INSERT INTO `articulo_detalle` VALUES ('26', '22', '4.50000', '5.00000', '5.00000');
INSERT INTO `articulo_detalle` VALUES ('26', '23', '2.00000', '6.00000', '6.00000');
INSERT INTO `articulo_detalle` VALUES ('26', '24', '1.00000', '1.00000', '1.00000');
INSERT INTO `articulo_detalle` VALUES ('26', '25', '1.00000', '1.00000', '1.00000');
INSERT INTO `articulo_detalle` VALUES ('27', '22', '0.50000', '5.00000', '5.00000');

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
INSERT INTO `grupo_de_productos` VALUES ('2', 'PREPARADOS');
INSERT INTO `grupo_de_productos` VALUES ('4', 'insumos');
INSERT INTO `grupo_de_productos` VALUES ('5', 'OTRO');

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
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of orden_compra
-- ----------------------------
INSERT INTO `orden_compra` VALUES ('98', '5', '2013-03-25 18:46:56', '2013-03-25 18:46:56', '1', '4', '59', '3');

-- ----------------------------
-- Table structure for `orden_compra_estado`
-- ----------------------------
DROP TABLE IF EXISTS `orden_compra_estado`;
CREATE TABLE `orden_compra_estado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` char(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of orden_compra_estado
-- ----------------------------
INSERT INTO `orden_compra_estado` VALUES ('1', 'borrador');
INSERT INTO `orden_compra_estado` VALUES ('2', 'ordenado');
INSERT INTO `orden_compra_estado` VALUES ('3', 'surtido');
INSERT INTO `orden_compra_estado` VALUES ('4', 'parcialmente surtido');

-- ----------------------------
-- Table structure for `orden_compra_productos`
-- ----------------------------
DROP TABLE IF EXISTS `orden_compra_productos`;
CREATE TABLE `orden_compra_productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_orden_compra` int(11) DEFAULT NULL,
  `fk_articulo` int(11) DEFAULT NULL,
  `idarticulopre` int(11) DEFAULT NULL,
  `cantidad` decimal(18,6) DEFAULT NULL,
  `fk_pedido_detalle` int(11) DEFAULT NULL,
  `fk_producto_origen` int(11) DEFAULT NULL,
  `fk_pedido` int(11) DEFAULT NULL,
  `pedidoi` decimal(18,6) DEFAULT NULL,
  `fk_almacen` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=979 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of orden_compra_productos
-- ----------------------------
INSERT INTO `orden_compra_productos` VALUES ('969', '98', '25', '45', '39.000000', '1961', '25', null, '39.000000', '2');
INSERT INTO `orden_compra_productos` VALUES ('970', '98', '22', '42', '14.000000', '1962', '22', null, '14.000000', '2');
INSERT INTO `orden_compra_productos` VALUES ('971', '98', '23', '43', '10.000000', '1964', '23', null, '10.000000', '2');
INSERT INTO `orden_compra_productos` VALUES ('972', '98', '24', '44', '37.000000', '1966', '24', null, '37.000000', '2');
INSERT INTO `orden_compra_productos` VALUES ('973', '98', '22', '46', '0.000000', '1963', '26', null, '0.000000', '2');
INSERT INTO `orden_compra_productos` VALUES ('974', '98', '23', '46', '0.000000', '1963', '26', null, '0.000000', '2');
INSERT INTO `orden_compra_productos` VALUES ('975', '98', '24', '46', '0.000000', '1963', '26', null, '0.000000', '2');
INSERT INTO `orden_compra_productos` VALUES ('976', '98', '25', '46', '0.000000', '1963', '26', null, '0.000000', '2');
INSERT INTO `orden_compra_productos` VALUES ('977', '98', '22', '47', '0.000000', '1965', '27', null, '0.000000', '2');
INSERT INTO `orden_compra_productos` VALUES ('978', '98', '22', '0', '12.000000', '0', '22', null, '0.000000', '3');

-- ----------------------------
-- Table structure for `orden_compra_series`
-- ----------------------------
DROP TABLE IF EXISTS `orden_compra_series`;
CREATE TABLE `orden_compra_series` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `serie` char(255) NOT NULL,
  `folio_i` int(11) DEFAULT NULL,
  `folio_f` int(11) DEFAULT NULL,
  `sig_folio` int(11) DEFAULT NULL,
  `es_default` bit(1) DEFAULT NULL,
  `idalmacen` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of orden_compra_series
-- ----------------------------
INSERT INTO `orden_compra_series` VALUES ('1', 'OC_1', '1', '1000', '17', '', '1');
INSERT INTO `orden_compra_series` VALUES ('2', 'OC_2', '1', '1000', '1', '', '2');
INSERT INTO `orden_compra_series` VALUES ('4', 'OC_3', '1', '1000', '60', '', '3');

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
) ENGINE=InnoDB AUTO_INCREMENT=161 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pedidos
-- ----------------------------
INSERT INTO `pedidos` VALUES ('159', '2', '2013-03-25 18:39:34', '2013-03-25 18:39:34', '2', '2', '2');
INSERT INTO `pedidos` VALUES ('160', '2', '2013-03-26 06:43:00', '2013-03-26 06:43:00', '1', '2', '3');

-- ----------------------------
-- Table structure for `pedidos_productos`
-- ----------------------------
DROP TABLE IF EXISTS `pedidos_productos`;
CREATE TABLE `pedidos_productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_articulo` int(11) DEFAULT NULL,
  `fk_pedido` int(11) DEFAULT NULL,
  `cantidad` decimal(18,6) DEFAULT NULL,
  `idarticulopre` int(11) unsigned DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `concentrado` decimal(18,6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1974 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pedidos_productos
-- ----------------------------
INSERT INTO `pedidos_productos` VALUES ('1961', '25', '159', '15.000000', '45', '2', '15.000000');
INSERT INTO `pedidos_productos` VALUES ('1962', '22', '159', '12.000000', '42', '2', '12.000000');
INSERT INTO `pedidos_productos` VALUES ('1963', '26', '159', '16.000000', '46', '2', '16.000000');
INSERT INTO `pedidos_productos` VALUES ('1964', '23', '159', '13.000000', '43', '2', '13.000000');
INSERT INTO `pedidos_productos` VALUES ('1965', '27', '159', '17.000000', '47', '2', '17.000000');
INSERT INTO `pedidos_productos` VALUES ('1966', '24', '159', '14.000000', '44', '2', '14.000000');
INSERT INTO `pedidos_productos` VALUES ('1967', '25', '160', '12.000000', '45', '1', null);
INSERT INTO `pedidos_productos` VALUES ('1968', '22', '160', '32.000000', '42', '1', null);
INSERT INTO `pedidos_productos` VALUES ('1969', '26', '160', '11.000000', '46', '1', null);
INSERT INTO `pedidos_productos` VALUES ('1970', '23', '160', '2.000000', '43', '1', null);
INSERT INTO `pedidos_productos` VALUES ('1971', '27', '160', '21.000000', '47', '1', null);
INSERT INTO `pedidos_productos` VALUES ('1972', '24', '160', '0.000000', '44', '1', null);

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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of productos
-- ----------------------------
INSERT INTO `productos` VALUES ('1', 'Piolinx', 'pio-ch', '1');
INSERT INTO `productos` VALUES ('2', 'Flor Feliz', 'flo-ch', '1');
INSERT INTO `productos` VALUES ('3', 'Flor', 'flo-ch', '1');
INSERT INTO `productos` VALUES ('5', 'Rosita', 'ro-ch', '1');
INSERT INTO `productos` VALUES ('6', null, 'oso-med', '1');
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
INSERT INTO `productos` VALUES ('28', 'Vaso', 'vaso', '2');
INSERT INTO `productos` VALUES ('29', 'Escoba', '', '1');

-- ----------------------------
-- Table structure for `producto_tipo`
-- ----------------------------
DROP TABLE IF EXISTS `producto_tipo`;
CREATE TABLE `producto_tipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` char(255) DEFAULT NULL,
  `descripcion` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of producto_tipo
-- ----------------------------
INSERT INTO `producto_tipo` VALUES ('1', 'Insumos', 'Articulos usados para elaborar productos.');
INSERT INTO `producto_tipo` VALUES ('2', 'Wacal', null);

-- ----------------------------
-- Table structure for `proveedor`
-- ----------------------------
DROP TABLE IF EXISTS `proveedor`;
CREATE TABLE `proveedor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of proveedor
-- ----------------------------
INSERT INTO `proveedor` VALUES ('1', 'Exprezzo...');
INSERT INTO `proveedor` VALUES ('2', 'Surti Tec');
INSERT INTO `proveedor` VALUES ('3', 'Poliformas');
INSERT INTO `proveedor` VALUES ('4', 'Fruteria Del Valle');
INSERT INTO `proveedor` VALUES ('5', 'Fruteria Juarez');
INSERT INTO `proveedor` VALUES ('6', 'Otro proveedor');

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
INSERT INTO `proveedor_producto` VALUES ('27', '5', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of series
-- ----------------------------
INSERT INTO `series` VALUES ('1', 'PA', '1', '100', '4', '', '1');
INSERT INTO `series` VALUES ('2', 'PC', '1', '100', '4', '', '2');
INSERT INTO `series` VALUES ('3', 'PI_3', '1', '1000', '11', '', '3');

-- ----------------------------
-- Table structure for `system_catalogos`
-- ----------------------------
DROP TABLE IF EXISTS `system_catalogos`;
CREATE TABLE `system_catalogos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` char(255) DEFAULT NULL,
  `controlador` char(255) DEFAULT NULL,
  `modelo` char(255) DEFAULT NULL,
  `tabla` char(255) DEFAULT NULL,
  `icono` char(255) DEFAULT NULL,
  `titulo_nuevo` char(255) DEFAULT NULL,
  `titulo_edicion` char(255) DEFAULT NULL,
  `titulo_busqueda` char(255) DEFAULT NULL,
  `msg_creado` char(255) DEFAULT NULL,
  `msg_actualizado` char(255) DEFAULT NULL,
  `pregunta_eliminar` char(255) DEFAULT NULL,
  `msg_eliminado` char(255) DEFAULT NULL,
  `msg_cambios` char(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of system_catalogos
-- ----------------------------
INSERT INTO `system_catalogos` VALUES ('8', 'Productos', 'productos', 'Producto', 'productos', '', 'Nuevo Producto', '{nombre}:{id}', 'Buscar Productos', 'Producto Creado ({nombre}:{id})', 'Producto Actualizado ({nombre}:{id})', 'Â¿Desea Eliminar el Producto: {nombre}:{id} ?', 'Producto <b> {nombre}:{id} </b> eliminado', 'Â¿Guardar Producto antes de salir?');
INSERT INTO `system_catalogos` VALUES ('11', 'Series', 'series', 'Serie', 'series', '', '', '', '', null, null, null, null, null);
INSERT INTO `system_catalogos` VALUES ('13', 'Almacenes', 'Almacenes', 'Almacen', 'almacenes', '', '', '', '', null, null, null, null, null);
INSERT INTO `system_catalogos` VALUES ('14', 'Stock', 'stocks', 'Stock', 'articulostock', '', '', '', '', null, null, null, null, null);
INSERT INTO `system_catalogos` VALUES ('15', 'Estado Pedido', 'estado_pedido', 'EstadoPedido', 'estado_pedido', '', '', '', '', null, null, null, null, null);
INSERT INTO `system_catalogos` VALUES ('16', 'Proveedores', 'proveedores', 'Proveedor', 'proveedor', '', '', '', '', null, null, null, null, null);
INSERT INTO `system_catalogos` VALUES ('17', 'UM', 'unidademedida', 'unidademedida', 'um', '', '', '', '', null, null, null, null, null);
INSERT INTO `system_catalogos` VALUES ('18', 'Usuarios', 'usuarios', 'Usuario', 'system_users', '', '', '', '', null, null, null, null, null);
INSERT INTO `system_catalogos` VALUES ('20', 'Grupo de Productos', 'grupo_productos', 'GrupoProducto', 'grupo_de_productos', null, null, null, null, null, null, null, null, null);
INSERT INTO `system_catalogos` VALUES ('21', 'Tipo de producto', 'producto_tipo', 'producto_tipo', 'producto_tipo', '', 'Nuevo Tipo de Producto', '{nombre}:{id}', 'Busqueda de Tipos de Producto', 'Producto Creado', '', '', '', null);

-- ----------------------------
-- Table structure for `system_users`
-- ----------------------------
DROP TABLE IF EXISTS `system_users`;
CREATE TABLE `system_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nick` char(255) NOT NULL,
  `pass` blob,
  `email` char(255) NOT NULL,
  `rol` int(11) DEFAULT '1',
  `fbid` int(11) DEFAULT NULL,
  `name` char(255) NOT NULL DEFAULT '0',
  `picture` varchar(255) DEFAULT NULL,
  `originalName` char(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `nick` (`nick`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of system_users
-- ----------------------------
INSERT INTO `system_users` VALUES ('1', 'zesar1', 0x1E398E80A894F4559B8CB0E74C8BEBBA, 'cbibriesca@hotmail.com', '2', '0', 'Zesar X', 'pic_1.jpg', 'retro_blue_background.jpg');

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
INSERT INTO `um` VALUES ('1', 'PZA', 'esta es la descripcion');
INSERT INTO `um` VALUES ('2', 'U', null);
INSERT INTO `um` VALUES ('3', 'Kg', '');
INSERT INTO `um` VALUES ('4', 'M', 'as');
INSERT INTO `um` VALUES ('5', 'Km', null);
