/*
 Navicat MySQL Data Transfer

 Source Server         : localhost
 Source Server Version : 50509
 Source Host           : localhost
 Source Database       : op_attendance

 Target Server Version : 50509
 File Encoding         : utf-8

 Date: 09/04/2014 23:45:08 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `op_clocktime`
-- ----------------------------
DROP TABLE IF EXISTS `op_clocktime`;
CREATE TABLE `op_clocktime` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) NOT NULL,
  `clockdate` date DEFAULT NULL,
  `clocktime` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `op_clocktime`
-- ----------------------------
BEGIN;
INSERT INTO `op_clocktime` VALUES ('1', '1001', '2014-06-19', '08:00:26'), ('2', '1001', '2014-06-19', '08:02:33'), ('3', '1001', '2014-06-19', '11:57:41'), ('4', '1001', '2014-06-19', '13:41:56'), ('5', '1001', '2014-06-19', '17:42:02'), ('6', '1001', '2014-06-20', '08:30:15'), ('7', '1001', '2014-06-20', '17:35:55'), ('8', '1002', '2014-06-19', '08:10:22'), ('9', '1002', '2014-06-19', '17:40:44'), ('12', '1003', '2014-06-19', '08:00:00'), ('11', '1002', '2014-06-20', '07:25:22'), ('13', '1003', '2014-06-19', '17:00:00'), ('14', '1003', '2014-06-20', '17:40:00');
COMMIT;

-- ----------------------------
--  Table structure for `op_config`
-- ----------------------------
DROP TABLE IF EXISTS `op_config`;
CREATE TABLE `op_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `spacetime` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `op_config`
-- ----------------------------
BEGIN;
INSERT INTO `op_config` VALUES ('1', '0.05');
COMMIT;

-- ----------------------------
--  Table structure for `op_department`
-- ----------------------------
DROP TABLE IF EXISTS `op_department`;
CREATE TABLE `op_department` (
  `did` int(11) NOT NULL AUTO_INCREMENT,
  `departmentname` varchar(255) NOT NULL,
  PRIMARY KEY (`did`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `op_department`
-- ----------------------------
BEGIN;
INSERT INTO `op_department` VALUES ('1', '车间'), ('2', '人力资源部');
COMMIT;

-- ----------------------------
--  Table structure for `op_log`
-- ----------------------------
DROP TABLE IF EXISTS `op_log`;
CREATE TABLE `op_log` (
  `id` int(11) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `logintime` datetime DEFAULT NULL,
  `quittime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `op_log`
-- ----------------------------
BEGIN;
INSERT INTO `op_log` VALUES ('0', '1001', '2014-07-31 21:55:21', null);
COMMIT;

-- ----------------------------
--  Table structure for `op_sample`
-- ----------------------------
DROP TABLE IF EXISTS `op_sample`;
CREATE TABLE `op_sample` (
  `uid` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `username` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `department` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `usertype` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `entrydate` date DEFAULT NULL,
  `costcenterid` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `op_sample`
-- ----------------------------
BEGIN;
INSERT INTO `op_sample` VALUES ('888', '张XX', '后勤部', '产线班长', '2008-08-08', '二财务部', '137XXXXXXXX');
COMMIT;

-- ----------------------------
--  Table structure for `op_staffinfo`
-- ----------------------------
DROP TABLE IF EXISTS `op_staffinfo`;
CREATE TABLE `op_staffinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `departmentid` int(11) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `costcenterid` int(11) DEFAULT NULL,
  `entrydate` date DEFAULT NULL,
  `usertypeid` int(11) DEFAULT NULL,
  `teamid` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `op_staffinfo`
-- ----------------------------
BEGIN;
INSERT INTO `op_staffinfo` VALUES ('1', '1001', '产线员工', '1', null, '1', '2014-06-19', '1', '2', null, '2014-06-19 14:06:50'), ('2', '1002', '人事经理', '2', null, '1', '2014-06-19', '2', '1', null, '2014-06-19 23:29:00'), ('3', '1003', '产线班长', '1', '1111', '1', '2014-07-03', '3', '2', null, '2014-07-15 21:24:09'), ('4', '1004', '部门经理', '1', '2323', '1', '2014-07-01', '4', '1', null, '2014-07-01 21:24:46'), ('5', '1005', '老板', '1', '212', '1', '2014-07-01', '5', '1', null, '2014-07-08 21:25:22'), ('6', '1006', '管理员', '1', '121', '1', '2014-07-01', '6', '1', null, '2014-07-01 21:26:18');
COMMIT;

-- ----------------------------
--  Table structure for `op_teaminfo`
-- ----------------------------
DROP TABLE IF EXISTS `op_teaminfo`;
CREATE TABLE `op_teaminfo` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `teamname` varchar(255) NOT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `op_teaminfo`
-- ----------------------------
BEGIN;
INSERT INTO `op_teaminfo` VALUES ('1', '办公室'), ('2', 'A组'), ('3', 'B组'), ('4', 'C组');
COMMIT;

-- ----------------------------
--  Table structure for `op_unusualtime`
-- ----------------------------
DROP TABLE IF EXISTS `op_unusualtime`;
CREATE TABLE `op_unusualtime` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `clockdate` date DEFAULT NULL,
  `clocktime` time DEFAULT NULL,
  `standardtime` time DEFAULT NULL,
  `static` varchar(255) DEFAULT NULL,
  `isapply` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `op_userinfo`
-- ----------------------------
DROP TABLE IF EXISTS `op_userinfo`;
CREATE TABLE `op_userinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(11) NOT NULL,
  `loginname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `accountstatue` int(11) NOT NULL DEFAULT '0',
  `departmentid` int(11) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `costcenterid` int(11) DEFAULT NULL,
  `entrydate` date DEFAULT NULL,
  `usertypeid` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1000000 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `op_userinfo`
-- ----------------------------
BEGIN;
INSERT INTO `op_userinfo` VALUES ('1', '1001', 'test', '827ccb0eea8a706c4c34a16891f84e7b', '产线员工', '0', '1', null, '1', '2014-06-19', '1', null, '2014-06-19 14:06:50'), ('2', '1002', 'hr', '827ccb0eea8a706c4c34a16891f84e7b', '人事经理', '0', '2', null, '1', '2014-06-19', '2', null, '2014-06-19 23:29:00'), ('3', '1003', 'monitor', '827ccb0eea8a706c4c34a16891f84e7b', '产线班长', '0', '1', null, '1', '2014-07-07', '3', null, '2014-07-12 17:38:26'), ('4', '1004', 'dpmanager', '827ccb0eea8a706c4c34a16891f84e7b', '部门经理', '0', '1', null, '1', '2014-07-01', '4', null, '2014-07-10 17:39:28'), ('5', '1005', 'boss', '827ccb0eea8a706c4c34a16891f84e7b', '老板', '0', '1', null, '1', '2014-06-04', '5', null, '2014-07-19 17:40:04'), ('6', '1006', 'admin', '827ccb0eea8a706c4c34a16891f84e7b', '管理员', '0', '1', null, '1', '2014-07-01', '6', null, '2014-07-19 17:40:37');
COMMIT;

-- ----------------------------
--  Table structure for `op_usertype`
-- ----------------------------
DROP TABLE IF EXISTS `op_usertype`;
CREATE TABLE `op_usertype` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `typename` varchar(255) NOT NULL,
  `menu` varchar(255) DEFAULT NULL,
  `power` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`tid`)
) ENGINE=MyISAM AUTO_INCREMENT=1000000 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `op_usertype`
-- ----------------------------
BEGIN;
INSERT INTO `op_usertype` VALUES ('1', '员工', 'staff_menu.json', '1'), ('2', '人事经理', 'hr_menu.json', '2'), ('3', '产线班长', 'monitor_menu.json', '3'), ('4', '部门经理', 'dp_menu.json', '4'), ('5', '老板', 'boss_menu.json', '5'), ('6', '管理员', 'admin_menu.json', '6'), ('999999', 'test', 'test_menu.json', '999999');
COMMIT;

-- ----------------------------
--  Table structure for `op_vacationstatus`
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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `op_vacationstatus`
-- ----------------------------
BEGIN;
INSERT INTO `op_vacationstatus` VALUES ('23', '1002', '1', '2', '0', '0', '1004', null, null, '2014-08-04', '08:30:00', '2014-08-04', '17:30:00', null, '3434'), ('24', '1002', '1', '1', '0', '0', '1002', null, null, '2014-08-07', '08:30:00', '2014-08-07', '17:30:00', '2014-08-19 17:43:55', '3434'), ('25', '1002', '2', '1', '0', '0', '1004', '1002', null, '2014-08-11', '08:30:00', '2014-08-11', '17:30:00', '2014-08-17 13:13:26', '3434'), ('26', '1002', '1', '1', '0', '0', '1004', null, null, '2014-08-18', '08:30:00', '2014-08-18', '17:30:00', '2014-08-17 21:40:30', 'sd'), ('27', '1002', '1', '1', '0', '0', '1002', null, null, '2014-08-20', '08:30:00', '2014-08-20', '17:30:00', '2014-08-17 21:40:50', '23'), ('28', '1002', '1', '2', '0', '0', '1002', null, null, '2014-08-26', '08:30:00', '2014-08-26', '17:30:00', '2014-08-17 21:41:10', '2323'), ('29', '1002', '1', '3', '0', '0', '1002', null, null, '2014-08-28', '22:53:11', '2014-08-28', '22:53:14', '2014-08-21 22:53:19', null);
COMMIT;

-- ----------------------------
--  Table structure for `op_vacationtype`
-- ----------------------------
DROP TABLE IF EXISTS `op_vacationtype`;
CREATE TABLE `op_vacationtype` (
  `typedm` char(2) NOT NULL,
  `typemc` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`typedm`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `op_vacationtype`
-- ----------------------------
BEGIN;
INSERT INTO `op_vacationtype` VALUES ('1', '加班'), ('2', '出差'), ('3', '休假');
COMMIT;

-- ----------------------------
--  Table structure for `op_worktime`
-- ----------------------------
DROP TABLE IF EXISTS `op_worktime`;
CREATE TABLE `op_worktime` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teamid` int(11) DEFAULT NULL,
  `worktime1` time NOT NULL,
  `worktime2` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `op_worktime`
-- ----------------------------
BEGIN;
INSERT INTO `op_worktime` VALUES ('1', '1', '08:00:00', '18:00:00'), ('2', '2', '08:30:00', '17:30:00'), ('3', '3', '09:00:00', '18:30:00'), ('5', '4', '08:00:00', '17:00:00');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
