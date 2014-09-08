/*
Navicat MySQL Data Transfer

Source Server         : manage
Source Server Version : 50515
Source Host           : localhost:3306
Source Database       : op_attendance

Target Server Type    : MYSQL
Target Server Version : 50515
File Encoding         : 65001

Date: 2014-08-23 23:12:44
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `op_vacationtype`
-- ----------------------------
DROP TABLE IF EXISTS `op_vacationtype`;
CREATE TABLE `op_vacationtype` (
  `typedm` char(2) NOT NULL,
  `typemc` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`typedm`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of op_vacationtype
-- ----------------------------
INSERT INTO `op_vacationtype` VALUES ('1', '加班');
INSERT INTO `op_vacationtype` VALUES ('2', '出差');
INSERT INTO `op_vacationtype` VALUES ('3', '休假');
