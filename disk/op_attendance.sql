/*
 Navicat MySQL Data Transfer

 Source Server         : localhost
 Source Server Version : 50509
 Source Host           : localhost
 Source Database       : op_attendance

 Target Server Version : 50509
 File Encoding         : utf-8

 Date: 09/13/2014 21:27:28 PM
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) NOT NULL,
  `logintime` datetime DEFAULT NULL,
  `quittime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `op_log`
-- ----------------------------
BEGIN;
INSERT INTO `op_log` VALUES ('1', '1002', '2014-09-11 21:35:03', null), ('2', '100002', '2014-09-12 00:54:13', null), ('3', '100003', '2014-09-13 19:27:17', null), ('4', '100002', '2014-09-13 20:00:03', null), ('5', '100002', '2014-09-13 20:40:14', null), ('6', '100005', '2014-09-13 20:41:17', null), ('7', '100004', '2014-09-13 20:41:25', null), ('8', '100005', '2014-09-13 20:42:18', null), ('9', '100002', '2014-09-13 20:46:49', null);
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
  `team` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `op_sample`
-- ----------------------------
BEGIN;
INSERT INTO `op_sample` VALUES ('888', '张XX', '1', '1', '2008-08-08', '2', '137XXXXXXXX', '2', 'oops@juying.com');
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
  `holiday` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `op_staffinfo`
-- ----------------------------
BEGIN;
INSERT INTO `op_staffinfo` VALUES ('1', '100001', '产线员工', '1', null, '1', '2014-06-19', '1', '2', null, '2014-06-19 14:06:50', null), ('2', '100002', '人事经理', '2', null, '1', '2014-06-19', '2', '1', '732121339@qq.com', '2014-06-19 23:29:00', null), ('3', '100003', '产线班长', '1', '1111', '1', '2014-07-03', '3', '2', null, '2014-07-15 21:24:09', null), ('4', '100004', '部门经理', '1', '2323', '1', '2014-07-01', '4', '1', null, '2014-07-01 21:24:46', null), ('5', '100005', '老板', '1', '212', '1', '2014-07-01', '5', '1', '732121339@qq.com', '2014-07-08 21:25:22', null), ('6', '100006', '管理员', '1', '121', '1', '2014-07-01', '6', '1', null, '2014-07-01 21:26:18', null), ('8', '100010', '李伟', '1', '13000000000', '1', '2014-09-08', '1', '2', 'ewewe@163.com', '2014-09-08 18:17:57', null), ('9', '100011', 'C组员工1', '1', '13000000000', '1', '2014-09-09', '1', '4', 'dsfwe@163.com', '2014-09-09 20:39:23', null);
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
  `uid` varchar(255) NOT NULL,
  `clockdate` date DEFAULT NULL,
  `clocktime` time DEFAULT NULL,
  `standarddate` date DEFAULT NULL,
  `standardtime` time DEFAULT NULL,
  `static` varchar(255) DEFAULT NULL,
  `type` int(2) DEFAULT NULL,
  `isapply` int(2) NOT NULL DEFAULT '0',
  `ps` varchar(255) DEFAULT NULL,
  `vacid` int(11) DEFAULT NULL,
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
) ENGINE=MyISAM AUTO_INCREMENT=1000002 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `op_userinfo`
-- ----------------------------
BEGIN;
INSERT INTO `op_userinfo` VALUES ('1', '100001', 'test', '827ccb0eea8a706c4c34a16891f84e7b', '产线员工', '0', '1', null, '1', '2014-06-19', '1', null, '2014-06-19 14:06:50'), ('2', '100002', 'hr', '827ccb0eea8a706c4c34a16891f84e7b', '人事经理', '0', '2', null, '1', '2014-06-19', '2', '732121339@qq.com', '2014-06-19 23:29:00'), ('3', '100003', 'monitor', '827ccb0eea8a706c4c34a16891f84e7b', '产线班长', '0', '1', null, '1', '2014-07-07', '3', null, '2014-07-12 17:38:26'), ('4', '100004', 'dpmanager', '827ccb0eea8a706c4c34a16891f84e7b', '部门经理', '0', '1', null, '1', '2014-07-01', '4', null, '2014-07-10 17:39:28'), ('5', '100005', 'boss', '827ccb0eea8a706c4c34a16891f84e7b', '老板', '0', '1', null, '1', '2014-06-04', '5', '732121339@qq.com', '2014-07-19 17:40:04'), ('6', '100006', 'admin', '827ccb0eea8a706c4c34a16891f84e7b', '管理员', '0', '1', null, '1', '2014-07-01', '6', null, '2014-07-19 17:40:37'), ('1000000', '100007', 'officestaff', '827ccb0eea8a706c4c34a16891f84e7b', '办公室员工', '0', '1', null, '1', '2014-09-07', '7', null, '2014-09-07 14:39:09'), ('1000001', '100011', 'worker1', '827ccb0eea8a706c4c34a16891f84e7b', 'C组员工1', '1', '1', '13000000000', '1', '2014-09-09', '1', 'dsfwe@163.com', '2014-09-09 20:39:23');
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
INSERT INTO `op_usertype` VALUES ('1', '生产线员工', 'staff_menu.json', '1'), ('2', '人事经理', 'hr_menu.json', '2'), ('3', '产线班长', 'monitor_menu.json', '3'), ('4', '部门经理', 'dp_menu.json', '4'), ('5', '老板', 'boss_menu.json', '5'), ('6', '管理员', 'admin_menu.json', '6'), ('999999', 'test', 'test_menu.json', '999999'), ('7', '办公室员工', 'office_staff_menu.json', '7');
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
  `fee` char(40) DEFAULT NULL,
  `holiday` char(40) DEFAULT NULL,
  `transpot` char(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `op_vacationstatus`
-- ----------------------------
BEGIN;
INSERT INTO `op_vacationstatus` VALUES ('1', '100002', '3', '1', '0', '1', null, null, '5', '2014-09-08', '17:00:00', '2014-09-08', '19:00:00', '2014-09-13 20:40:57', 'hr加班', null, null, null);
COMMIT;

-- ----------------------------
--  Table structure for `op_vacationtype`
-- ----------------------------
DROP TABLE IF EXISTS `op_vacationtype`;
CREATE TABLE `op_vacationtype` (
  `typedm` char(2) NOT NULL,
  `typemc` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`typedm`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
  `teamid` int(11) NOT NULL,
  `workdate1` date NOT NULL,
  `worktime1` time NOT NULL,
  `workdate2` date NOT NULL,
  `worktime2` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `op_worktime`
-- ----------------------------
BEGIN;
INSERT INTO `op_worktime` VALUES ('1', '1', '2014-01-01', '08:00:00', '2014-12-31', '17:00:00'), ('2', '2', '2014-01-01', '20:00:00', '2014-12-31', '01:00:00'), ('3', '3', '2014-01-01', '08:30:00', '2014-12-31', '17:30:00'), ('4', '4', '2014-01-01', '08:00:00', '2014-12-31', '17:00:00');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
