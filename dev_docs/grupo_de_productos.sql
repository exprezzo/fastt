/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50508
Source Host           : localhost:3306
Source Database       : fastt

Target Server Type    : MYSQL
Target Server Version : 50508
File Encoding         : 65001

Date: 2013-02-01 14:07:29
*/

SET FOREIGN_KEY_CHECKS=0;

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
