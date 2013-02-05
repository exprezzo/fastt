/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50508
Source Host           : localhost:3306
Source Database       : fastt

Target Server Type    : MYSQL
Target Server Version : 50508
File Encoding         : 65001

Date: 2013-02-04 22:04:49
*/

SET FOREIGN_KEY_CHECKS=0;

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of series
-- ----------------------------
INSERT INTO `series` VALUES ('1', 'A1', '1', '100', '1', '', '1');
INSERT INTO `series` VALUES ('2', 'B1', '1', '100', '1', '', '1');
INSERT INTO `series` VALUES ('3', 'A2', '1', '100', '1', '', '2');
INSERT INTO `series` VALUES ('4', 'B2', '1', '100', '1', '', '2');
INSERT INTO `series` VALUES ('5', 'A3', '1', '100', '1', '', '3');
INSERT INTO `series` VALUES ('6', 'B3', '1', '100', '1', '', '3');
INSERT INTO `series` VALUES ('7', 'A4', '1', '100', '1', '', '4');
INSERT INTO `series` VALUES ('8', 'B4', '1', '100', '1', '', '4');
