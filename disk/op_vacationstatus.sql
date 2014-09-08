/*
Navicat MySQL Data Transfer

Source Server         : manage
Source Server Version : 50515
Source Host           : localhost:3306
Source Database       : op_attendance

Target Server Type    : MYSQL
Target Server Version : 50515
File Encoding         : 65001

Date: 2014-09-08 14:39:22
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
  `begindate` date DEFAULT NULL,
  `begintime` time DEFAULT NULL,
  `enddate` date DEFAULT NULL,
  `endtime` time DEFAULT NULL,
  `applytime` datetime DEFAULT NULL,
  `reason` varchar(300) DEFAULT NULL,
  `holiday` char(40) DEFAULT NULL,
  `fee` char(40) DEFAULT NULL,
  `transpot` char(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of op_vacationstatus
-- ----------------------------
INSERT INTO `op_vacationstatus` VALUES ('23', '1002', '1', '2', '0', '0', '1004', null, null, '2014-08-04', '08:30:00', '2014-08-04', '17:30:00', null, '3434', null, null, null);
INSERT INTO `op_vacationstatus` VALUES ('24', '1002', '1', '1', '0', '0', '1002', null, null, '2014-08-07', '08:30:00', '2014-08-07', '17:30:00', '2014-08-19 17:43:55', '3434', null, null, null);
INSERT INTO `op_vacationstatus` VALUES ('25', '1002', '2', '1', '0', '0', '1004', '1002', null, '2014-08-11', '08:30:00', '2014-08-11', '17:30:00', '2014-08-17 13:13:26', '3434', null, null, null);
INSERT INTO `op_vacationstatus` VALUES ('26', '1002', '1', '1', '0', '0', '1004', null, null, '2014-08-18', '08:30:00', '2014-08-18', '17:30:00', '2014-08-17 21:40:30', 'sd', null, null, null);
INSERT INTO `op_vacationstatus` VALUES ('27', '1002', '1', '1', '0', '0', '1002', null, null, '2014-08-20', '08:30:00', '2014-08-20', '17:30:00', '2014-08-17 21:40:50', '23', null, null, null);
INSERT INTO `op_vacationstatus` VALUES ('28', '1002', '1', '2', '0', '0', '1002', null, null, '2014-08-26', '08:30:00', '2014-08-26', '17:30:00', '2014-08-17 21:41:10', '2323', null, null, null);
INSERT INTO `op_vacationstatus` VALUES ('29', '1002', '1', '3', '0', '0', '1002', null, null, '2014-08-28', '22:53:11', '2014-08-28', '22:53:14', '2014-08-21 22:53:19', null, null, null, null);
INSERT INTO `op_vacationstatus` VALUES ('30', '1004', '2', '2', '0', '0', '1002', null, null, '2014-09-03', '08:30:00', '2014-09-16', '17:30:00', '2014-09-08 11:51:25', '速度多少', null, null, '火车');
INSERT INTO `op_vacationstatus` VALUES ('31', '1004', '2', '2', '0', '0', '1002', null, null, '2014-09-03', '08:30:00', '2014-09-17', '17:30:00', '2014-09-08 11:53:22', '为', null, null, '问问');
INSERT INTO `op_vacationstatus` VALUES ('32', '1004', '2', '2', '0', '0', '1002', null, null, '2014-09-03', '08:30:00', '2014-09-17', '17:30:00', '2014-09-08 11:54:00', '为', null, '454545', '问问3434');
INSERT INTO `op_vacationstatus` VALUES ('33', '1004', '2', '2', '0', '0', '1002', null, null, '2014-09-10', '08:30:00', '2014-09-25', '17:30:00', '2014-09-08 11:54:10', '3434', null, '3434', '3434');
INSERT INTO `op_vacationstatus` VALUES ('34', '1004', '2', '3', '0', '0', '1002', null, null, '2014-09-02', '08:30:00', '2014-09-09', '17:30:00', '2014-09-08 11:54:39', null, '病假', null, null);
