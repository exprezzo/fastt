/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50508
Source Host           : localhost:3306
Source Database       : fastt

Target Server Type    : MYSQL
Target Server Version : 50508
File Encoding         : 65001

Date: 2013-03-25 17:17:37
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
INSERT INTO `grupo_de_productos` VALUES ('2', 'MEDIANO');
INSERT INTO `grupo_de_productos` VALUES ('4', 'insumos');
INSERT INTO `grupo_de_productos` VALUES ('5', 'b,bmbn');

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
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of orden_compra
-- ----------------------------
INSERT INTO `orden_compra` VALUES ('72', '5', '2013-03-19 17:04:13', '2013-03-19 17:04:13', '1', '4', '35', '3');
INSERT INTO `orden_compra` VALUES ('73', '5', '2013-03-20 21:51:33', '2013-03-20 21:51:33', '1', '4', '36', '3');
INSERT INTO `orden_compra` VALUES ('74', '0', '2013-03-21 11:49:28', '2013-03-21 11:49:28', '1', '4', '37', '3');
INSERT INTO `orden_compra` VALUES ('75', '0', '2013-03-21 11:50:21', '2013-03-21 11:50:21', '1', '4', '38', '3');
INSERT INTO `orden_compra` VALUES ('88', '5', '2013-03-21 22:24:58', '2013-03-23 22:24:58', '1', '4', '51', '3');
INSERT INTO `orden_compra` VALUES ('89', '3', '2013-03-22 12:56:05', '2013-03-22 12:56:05', '1', '4', '52', '3');
INSERT INTO `orden_compra` VALUES ('90', '5', '2013-03-22 18:30:28', '2013-03-22 18:30:28', '1', '4', '53', '3');
INSERT INTO `orden_compra` VALUES ('91', '0', '2013-03-22 15:44:24', '2013-03-22 15:44:24', '1', '4', '54', '3');
INSERT INTO `orden_compra` VALUES ('92', '0', '2013-03-22 15:44:27', '2013-03-22 15:44:27', '1', '4', '55', '3');
INSERT INTO `orden_compra` VALUES ('93', '0', '2013-03-22 15:46:15', '2013-03-22 15:46:15', '1', '4', '56', '3');
INSERT INTO `orden_compra` VALUES ('94', '0', '2013-03-22 16:10:58', '2013-03-22 16:10:58', '1', '4', '57', '3');
INSERT INTO `orden_compra` VALUES ('95', '0', '2013-03-22 17:00:16', '2013-03-22 17:00:16', '1', '4', '58', '3');
INSERT INTO `orden_compra` VALUES ('97', '0', '2013-03-25 09:50:28', '2013-03-25 09:50:28', '1', '1', '16', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=969 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of orden_compra_productos
-- ----------------------------
INSERT INTO `orden_compra_productos` VALUES ('617', '75', '22', '0', '12.000000', '0', '22', '0', '12.000000', '3');
INSERT INTO `orden_compra_productos` VALUES ('919', '88', '24', '44', '35.000000', '1922', '24', '0', '35.000000', '2');
INSERT INTO `orden_compra_productos` VALUES ('920', '88', '25', '45', '37.000000', '1923', '25', '0', '37.000000', '2');
INSERT INTO `orden_compra_productos` VALUES ('921', '88', '22', '42', '1.000000', '1924', '22', '0', '2.000000', '2');
INSERT INTO `orden_compra_productos` VALUES ('922', '88', '23', '43', '38.000000', '1926', '23', '0', '38.000000', '2');
INSERT INTO `orden_compra_productos` VALUES ('923', '88', '22', '46', '1.000000', '1925', '26', null, '92.500000', '2');
INSERT INTO `orden_compra_productos` VALUES ('924', '88', '23', '46', '55.000000', '1925', '26', '0', '55.000000', '2');
INSERT INTO `orden_compra_productos` VALUES ('925', '88', '24', '46', '40.000000', '1925', '26', '0', '40.000000', '2');
INSERT INTO `orden_compra_productos` VALUES ('926', '88', '25', '46', '40.000000', '1925', '26', '0', '40.000000', '2');
INSERT INTO `orden_compra_productos` VALUES ('927', '88', '22', '47', '1.000000', '1927', '27', '0', '34.500000', '2');
INSERT INTO `orden_compra_productos` VALUES ('931', '88', '2', '0', '2.000000', '0', '2', '0', '0.000000', '3');
INSERT INTO `orden_compra_productos` VALUES ('932', '88', '2', '0', '1.000000', '0', '2', '0', '0.000000', '3');
INSERT INTO `orden_compra_productos` VALUES ('934', '88', '23', '0', '13.000000', '0', '23', '0', '0.000000', '3');
INSERT INTO `orden_compra_productos` VALUES ('935', '88', '22', '0', '1.000000', '0', '22', '0', '10.000000', '3');
INSERT INTO `orden_compra_productos` VALUES ('936', '89', '21', '41', '22.000000', '1929', '21', null, '22.000000', '3');
INSERT INTO `orden_compra_productos` VALUES ('937', '89', '1', '1', '14.000000', '1931', '1', null, '14.000000', '3');
INSERT INTO `orden_compra_productos` VALUES ('938', '89', '9', '19', '122.000000', '1933', '9', null, '122.000000', '3');
INSERT INTO `orden_compra_productos` VALUES ('939', '89', '6', '16', '10.000000', '1940', '6', null, '10.000000', '3');
INSERT INTO `orden_compra_productos` VALUES ('940', '89', '15', '25', '17.000000', '1942', '15', null, '17.000000', '3');
INSERT INTO `orden_compra_productos` VALUES ('941', '89', '3', '3', '15.000000', '1946', '3', null, '15.000000', '3');
INSERT INTO `orden_compra_productos` VALUES ('942', '89', '11', '21', '24.000000', '1948', '11', null, '24.000000', '3');
INSERT INTO `orden_compra_productos` VALUES ('943', '90', '23', '43', '2.000000', '1944', '23', null, '2.000000', '3');
INSERT INTO `orden_compra_productos` VALUES ('944', '90', '22', '46', '61.000000', '1938', '26', null, '61.000000', '3');
INSERT INTO `orden_compra_productos` VALUES ('945', '90', '23', '46', '41.000000', '1938', '26', null, '41.000000', '3');
INSERT INTO `orden_compra_productos` VALUES ('946', '90', '24', '46', '33.000000', '1938', '26', null, '33.000000', '3');
INSERT INTO `orden_compra_productos` VALUES ('947', '90', '25', '46', '33.000000', '1938', '26', null, '33.000000', '3');
INSERT INTO `orden_compra_productos` VALUES ('948', '89', '22', '0', '0.000000', '0', '22', null, '0.000000', '3');
INSERT INTO `orden_compra_productos` VALUES ('949', '90', '23', '0', '0.000000', '0', '23', null, '0.000000', '3');
INSERT INTO `orden_compra_productos` VALUES ('950', '90', '22', '0', '3.000000', '0', '22', null, '0.000000', '3');
INSERT INTO `orden_compra_productos` VALUES ('951', '91', '22', '0', '0.000000', '0', '22', null, '0.000000', '3');
INSERT INTO `orden_compra_productos` VALUES ('952', '92', '22', '0', '0.000000', '0', '22', null, '0.000000', '3');
INSERT INTO `orden_compra_productos` VALUES ('953', '93', '22', '0', '0.000000', '0', '22', null, '0.000000', '3');
INSERT INTO `orden_compra_productos` VALUES ('955', '94', '22', '0', '0.000000', '0', '22', null, '0.000000', '3');
INSERT INTO `orden_compra_productos` VALUES ('957', '95', '22', '0', '0.000000', '0', '22', null, '0.000000', '3');
INSERT INTO `orden_compra_productos` VALUES ('958', '95', '23', '0', '0.000000', '0', '23', null, '0.000000', '3');
INSERT INTO `orden_compra_productos` VALUES ('959', '95', '22', '0', '0.000000', '0', '22', null, '0.000000', '3');
INSERT INTO `orden_compra_productos` VALUES ('960', '90', '2', '0', '14.000000', '0', '2', null, '14.000000', '3');
INSERT INTO `orden_compra_productos` VALUES ('966', '90', '2', '0', '14.000000', '0', '2', null, '14.000000', '3');
INSERT INTO `orden_compra_productos` VALUES ('967', '97', '2', '0', '4.000000', '0', '2', null, '4.000000', '1');

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
INSERT INTO `orden_compra_series` VALUES ('4', 'OC_3', '1', '1000', '59', '', '3');

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
) ENGINE=InnoDB AUTO_INCREMENT=158 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pedidos
-- ----------------------------
INSERT INTO `pedidos` VALUES ('156', '2', '2013-03-21 15:59:26', '2013-03-21 15:59:26', '2', '2', '24');
INSERT INTO `pedidos` VALUES ('157', '3', '2013-03-22 12:47:49', '2013-03-22 12:47:49', '2', '3', '10');

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
) ENGINE=InnoDB AUTO_INCREMENT=1955 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pedidos_productos
-- ----------------------------
INSERT INTO `pedidos_productos` VALUES ('1922', '24', '156', '12.000000', '44', '2', '12.000000');
INSERT INTO `pedidos_productos` VALUES ('1923', '25', '156', '13.000000', '45', '2', '13.000000');
INSERT INTO `pedidos_productos` VALUES ('1924', '22', '156', '14.000000', '42', '2', '14.000000');
INSERT INTO `pedidos_productos` VALUES ('1925', '26', '156', '15.000000', '46', '2', '15.000000');
INSERT INTO `pedidos_productos` VALUES ('1926', '23', '156', '16.000000', '43', '2', '16.000000');
INSERT INTO `pedidos_productos` VALUES ('1927', '27', '156', '17.000000', '47', '2', '17.000000');
INSERT INTO `pedidos_productos` VALUES ('1928', '17', '157', '0.000000', '27', '1', null);
INSERT INTO `pedidos_productos` VALUES ('1929', '21', '157', '2.000000', '41', '2', '2.000000');
INSERT INTO `pedidos_productos` VALUES ('1930', '25', '157', '0.000000', '45', '1', null);
INSERT INTO `pedidos_productos` VALUES ('1931', '1', '157', '11.000000', '1', '2', '11.000000');
INSERT INTO `pedidos_productos` VALUES ('1932', '5', '157', '0.000000', '5', '1', null);
INSERT INTO `pedidos_productos` VALUES ('1933', '9', '157', '12.000000', '19', '2', '12.000000');
INSERT INTO `pedidos_productos` VALUES ('1934', '13', '157', '0.000000', '23', '1', null);
INSERT INTO `pedidos_productos` VALUES ('1935', '14', '157', '0.000000', '24', '1', null);
INSERT INTO `pedidos_productos` VALUES ('1936', '18', '157', '0.000000', '28', '1', null);
INSERT INTO `pedidos_productos` VALUES ('1937', '22', '157', '0.000000', '42', '1', null);
INSERT INTO `pedidos_productos` VALUES ('1938', '26', '157', '8.000000', '46', '2', '8.000000');
INSERT INTO `pedidos_productos` VALUES ('1939', '2', '157', '0.000000', '2', '1', null);
INSERT INTO `pedidos_productos` VALUES ('1940', '6', '157', '3.000000', '16', '2', '3.000000');
INSERT INTO `pedidos_productos` VALUES ('1941', '10', '157', '0.000000', '20', '1', null);
INSERT INTO `pedidos_productos` VALUES ('1942', '15', '157', '2.000000', '25', '2', '2.000000');
INSERT INTO `pedidos_productos` VALUES ('1943', '19', '157', '0.000000', '39', '1', null);
INSERT INTO `pedidos_productos` VALUES ('1944', '23', '157', '5.000000', '43', '2', '5.000000');
INSERT INTO `pedidos_productos` VALUES ('1945', '27', '157', '0.000000', '47', '1', null);
INSERT INTO `pedidos_productos` VALUES ('1946', '3', '157', '10.000000', '3', '2', '10.000000');
INSERT INTO `pedidos_productos` VALUES ('1947', '7', '157', '0.000000', '17', '1', null);
INSERT INTO `pedidos_productos` VALUES ('1948', '11', '157', '13.000000', '21', '2', '13.000000');
INSERT INTO `pedidos_productos` VALUES ('1949', '16', '157', '0.000000', '26', '1', null);
INSERT INTO `pedidos_productos` VALUES ('1950', '20', '157', '0.000000', '40', '1', null);
INSERT INTO `pedidos_productos` VALUES ('1951', '24', '157', '0.000000', '44', '1', null);
INSERT INTO `pedidos_productos` VALUES ('1952', '4', '157', '0.000000', '4', '1', null);
INSERT INTO `pedidos_productos` VALUES ('1953', '8', '157', '0.000000', '18', '1', null);
INSERT INTO `pedidos_productos` VALUES ('1954', '12', '157', '0.000000', '22', '1', null);

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
INSERT INTO `productos` VALUES ('1', 'Piolin', 'pio-ch', '1');
INSERT INTO `productos` VALUES ('2', 'Flor Feliz', 'flo-ch', '1');
INSERT INTO `productos` VALUES ('3', 'Flor', 'flo-ch', '1');
INSERT INTO `productos` VALUES ('4', 'Corazon', 'cor-med', '1');
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
INSERT INTO `productos` VALUES ('29', 'Escoba', '', '0');

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
INSERT INTO `series` VALUES ('2', 'PC', '1', '100', '1', '', '2');
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
  `t_nuevo` char(255) DEFAULT NULL,
  `t_edicion` char(255) DEFAULT NULL,
  `t_eliminar` char(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of system_catalogos
-- ----------------------------
INSERT INTO `system_catalogos` VALUES ('8', 'Productos', 'productos', 'Producto', 'productos', '', '', '', '');
INSERT INTO `system_catalogos` VALUES ('11', 'Series', 'series', 'Serie', 'series', '', '', '', '');
INSERT INTO `system_catalogos` VALUES ('13', 'Almacenes', 'Almacenes', 'Almacen', 'almacenes', '', '', '', '');
INSERT INTO `system_catalogos` VALUES ('14', 'Stock', 'stocks', 'Stock', 'articulostock', '', '', '', '');
INSERT INTO `system_catalogos` VALUES ('15', 'Estado Pedido', 'estado_pedido', 'EstadoPedido', 'estado_pedido', '', '', '', '');
INSERT INTO `system_catalogos` VALUES ('16', 'Proveedores', 'proveedores', 'Proveedor', 'proveedor', '', '', '', '');
INSERT INTO `system_catalogos` VALUES ('17', 'UM', 'unidademedida', 'unidademedida', 'um', '', '', '', '');
INSERT INTO `system_catalogos` VALUES ('18', 'Usuarios', 'usuarios', 'Usuario', 'system_users', '', '', '', '');
INSERT INTO `system_catalogos` VALUES ('20', 'Grupo de Productos', 'grupo_productos', 'GrupoProducto', 'grupo_de_productos', null, null, null, null);

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
