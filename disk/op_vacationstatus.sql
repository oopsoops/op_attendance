/*
Navicat MySQL Data Transfer

Source Server         : manage
Source Server Version : 50515
Source Host           : localhost:3306
Source Database       : op_attendance

Target Server Type    : MYSQL
Target Server Version : 50515
File Encoding         : 65001

Date: 2014-08-23 23:14:36
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `op_vacationstatus`
-- ----------------------------
DROP TABLE IF EXISTS `op_vacationstatus`;
CREATE TABLE `op_vacationstatus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `status` char(2) DEFAULT NULL,
  `transtype` char(2) DEFAULT NULL,
  `isrejected` int(1) unsigned zerofill DEFAULT '0',
  `isapproved` int(1) unsigned zerofill DEFAULT '0',
  `departmanagerid` int(11) DEFAULT NULL,
  `hrmanagerid` int(11) DEFAULT NULL,
  `bossid` int(11) DEFAULT NULL,
  `begintime` datetime DEFAULT NULL,
  `endtime` datetime DEFAULT NULL,
  `applytime` datetime DEFAULT NULL,
  `reason` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of op_vacationstatus
-- ----------------------------
INSERT INTO `op_vacationstatus` VALUES ('23', '1002', '1', '2', '0', '0', '1004', null, null, '2014-08-06 08:30:00', '2014-08-27 17:30:00', null, '3434');
INSERT INTO `op_vacationstatus` VALUES ('24', '1002', '1', '1', '0', '0', '1002', null, null, '2014-08-06 08:30:00', '2014-08-21 17:30:00', '2014-08-19 17:43:55', '3434');
INSERT INTO `op_vacationstatus` VALUES ('25', '1002', '2', '1', '0', '0', '1004', '1002', null, '2014-08-13 08:30:00', '2014-08-29 17:30:00', '2014-08-17 13:13:26', '3434');
INSERT INTO `op_vacationstatus` VALUES ('26', '1002', '1', '1', '0', '0', '1004', null, null, '2014-08-05 08:30:00', '2014-08-27 17:30:00', '2014-08-17 21:40:30', 'sd');
INSERT INTO `op_vacationstatus` VALUES ('27', '1002', '1', '1', '0', '0', '1002', null, null, '2014-08-05 08:30:00', '2014-09-04 17:30:00', '2014-08-17 21:40:50', '23');
INSERT INTO `op_vacationstatus` VALUES ('28', '1002', '1', '2', '0', '0', '1002', null, null, '2014-08-05 08:30:00', '2014-08-20 17:30:00', '2014-08-17 21:41:10', '2323');
INSERT INTO `op_vacationstatus` VALUES ('29', '1002', '1', '3', '0', '0', '1002', null, null, '2014-08-21 22:53:11', '2014-08-29 22:53:14', '2014-08-21 22:53:19', null);
