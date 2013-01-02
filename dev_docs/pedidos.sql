/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50508
Source Host           : localhost:3306
Source Database       : fastt

Target Server Type    : MYSQL
Target Server Version : 50508
File Encoding         : 65001

Date: 2013-01-02 14:47:45
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `pedidos`
-- ----------------------------
DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_almacen` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pedidos
-- ----------------------------
INSERT INTO `pedidos` VALUES ('1', '1', '2012-12-18 13:02:43');
INSERT INTO `pedidos` VALUES ('2', '2', '2012-12-18 13:02:52');
INSERT INTO `pedidos` VALUES ('3', '1', '2012-12-24 13:03:01');
INSERT INTO `pedidos` VALUES ('40', '1', '2012-12-24 13:03:01');
INSERT INTO `pedidos` VALUES ('41', '1', '2012-12-24 13:03:01');
INSERT INTO `pedidos` VALUES ('42', '1', '2012-12-24 13:03:01');
INSERT INTO `pedidos` VALUES ('43', '2', '2012-12-24 13:03:01');
INSERT INTO `pedidos` VALUES ('44', '3', '2012-12-24 13:03:01');
INSERT INTO `pedidos` VALUES ('45', '1', '2012-12-24 13:03:01');
INSERT INTO `pedidos` VALUES ('46', '2', '2012-12-24 13:03:01');
INSERT INTO `pedidos` VALUES ('47', '3', '2012-12-24 13:03:01');
INSERT INTO `pedidos` VALUES ('48', '1', '2012-12-24 13:03:01');
INSERT INTO `pedidos` VALUES ('49', '2', '2012-12-24 13:03:01');
INSERT INTO `pedidos` VALUES ('50', '3', '2012-12-24 13:03:01');
INSERT INTO `pedidos` VALUES ('51', '1', '2012-12-24 13:03:01');
