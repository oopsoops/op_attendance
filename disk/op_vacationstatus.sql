/*
Navicat MySQL Data Transfer

Source Server         : manage
Source Server Version : 50515
Source Host           : localhost:3306
Source Database       : op_attendance

Target Server Type    : MYSQL
Target Server Version : 50515
File Encoding         : 65001

Date: 2014-09-04 22:49:43
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of op_vacationstatus
-- ----------------------------
INSERT INTO `op_vacationstatus` VALUES ('23', '1002', '1', '2', '0', '0', '1004', null, null, null, '08:30:00', null, '17:30:00', null, '3434');
INSERT INTO `op_vacationstatus` VALUES ('24', '1002', '2', '1', '0', '0', '1002', null, null, null, '08:30:00', null, '17:30:00', '2014-08-19 17:43:55', '3434');
INSERT INTO `op_vacationstatus` VALUES ('25', '1002', '1', '1', '0', '0', '1004', '1002', null, null, '08:30:00', null, '17:30:00', '2014-08-17 13:13:26', '3434');
INSERT INTO `op_vacationstatus` VALUES ('26', '1002', '1', '1', '0', '0', '1004', null, null, null, '08:30:00', null, '17:30:00', '2014-08-17 21:40:30', 'sd');
INSERT INTO `op_vacationstatus` VALUES ('27', '1002', '2', '1', '0', '0', '1002', null, null, null, '08:30:00', null, '17:30:00', '2014-08-17 21:40:50', '23');
INSERT INTO `op_vacationstatus` VALUES ('28', '1002', '1', '2', '0', '0', '1002', null, null, null, '08:30:00', null, '17:30:00', '2014-08-17 21:41:10', '2323');
INSERT INTO `op_vacationstatus` VALUES ('29', '1002', '1', '3', '0', '0', '1002', null, null, null, '22:53:11', null, '22:53:14', '2014-08-21 22:53:19', null);
INSERT INTO `op_vacationstatus` VALUES ('31', '1002', '1', '1', '0', '0', '2', null, null, null, '08:30:00', null, '17:30:00', '2014-09-04 22:15:46', '2');
INSERT INTO `op_vacationstatus` VALUES ('32', '1002', '1', '1', '0', '0', '2', null, null, null, '08:30:00', null, '17:30:00', '2014-09-04 22:16:05', '3');
INSERT INTO `op_vacationstatus` VALUES ('33', '1002', '1', '1', '0', '0', '2', null, null, null, '08:30:00', null, '17:30:00', '2014-09-04 22:16:08', '34');
INSERT INTO `op_vacationstatus` VALUES ('34', '1002', '1', '1', '0', '0', '2', null, null, null, '08:30:00', null, '17:30:00', '2014-09-04 22:16:10', '34545');
INSERT INTO `op_vacationstatus` VALUES ('35', '1002', '1', '1', '0', '0', '2', null, null, null, '00:00:00', null, '00:00:00', '2014-09-04 22:45:24', '33434');
INSERT INTO `op_vacationstatus` VALUES ('36', '1002', '1', '1', '0', '0', '2', null, null, '2014-09-04', '00:00:00', null, '00:00:00', '2014-09-04 22:46:46', 'ggggg');
INSERT INTO `op_vacationstatus` VALUES ('37', '1002', '1', '3', '0', '0', '2', null, null, '2014-09-04', '00:00:00', '2014-09-17', '00:00:00', '2014-09-04 22:47:46', 'sdjsjdsjdsd');
INSERT INTO `op_vacationstatus` VALUES ('38', '1002', '1', '1', '0', '0', '2', null, null, '2014-09-04', '08:30:00', '2014-09-04', '17:30:00', '2014-09-04 22:49:04', '777775656');
