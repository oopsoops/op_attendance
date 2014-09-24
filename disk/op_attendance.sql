/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50516
Source Host           : localhost:3306
Source Database       : op_attendance

Target Server Type    : MYSQL
Target Server Version : 50516
File Encoding         : 65001

Date: 2014-09-24 23:04:28
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `op_clocktime`
-- ----------------------------
DROP TABLE IF EXISTS `op_clocktime`;
CREATE TABLE `op_clocktime` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) NOT NULL,
  `clockdate` date NOT NULL,
  `clocktime` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of op_clocktime
-- ----------------------------

-- ----------------------------
-- Table structure for `op_config`
-- ----------------------------
DROP TABLE IF EXISTS `op_config`;
CREATE TABLE `op_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `spacetime` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of op_config
-- ----------------------------
INSERT INTO op_config VALUES ('1', '0.05');

-- ----------------------------
-- Table structure for `op_department`
-- ----------------------------
DROP TABLE IF EXISTS `op_department`;
CREATE TABLE `op_department` (
  `did` int(11) NOT NULL AUTO_INCREMENT,
  `departmentname` varchar(255) NOT NULL,
  PRIMARY KEY (`did`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of op_department
-- ----------------------------
INSERT INTO op_department VALUES ('1', '车间');
INSERT INTO op_department VALUES ('2', '人力资源部');

-- ----------------------------
-- Table structure for `op_log`
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
-- Records of op_log
-- ----------------------------
INSERT INTO op_log VALUES ('1', '1002', '2014-09-12 23:45:42', null);
INSERT INTO op_log VALUES ('2', '1002', '2014-09-16 00:56:35', null);
INSERT INTO op_log VALUES ('3', '1003', '2014-09-16 00:57:56', null);
INSERT INTO op_log VALUES ('4', '1004', '2014-09-16 00:58:29', null);
INSERT INTO op_log VALUES ('5', '1003', '2014-09-17 23:46:54', null);
INSERT INTO op_log VALUES ('6', '1003', '2014-09-22 01:01:28', null);
INSERT INTO op_log VALUES ('7', '1004', '2014-09-22 01:04:56', null);
INSERT INTO op_log VALUES ('8', '1003', '2014-09-22 01:06:05', null);
INSERT INTO op_log VALUES ('9', '1003', '2014-09-22 01:31:37', null);

-- ----------------------------
-- Table structure for `op_sample`
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
  `team` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `THoliday` float NOT NULL DEFAULT '0',
  `LHoliday` float NOT NULL DEFAULT '0',
  `TRest` float NOT NULL DEFAULT '0',
  `LRest` float NOT NULL DEFAULT '0',
  `loginname` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of op_sample
-- ----------------------------
INSERT INTO op_sample VALUES ('888', '张XX', '1', '1', '2008-08-08', '2', '137XXXXXXXX', '2', 'oops@juying.com', '7', '3.5', '2.5', '6', '(可以为空）');

-- ----------------------------
-- Table structure for `op_staffinfo`
-- ----------------------------
DROP TABLE IF EXISTS `op_staffinfo`;
CREATE TABLE `op_staffinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `departmentid` int(11) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `costcenterid` int(11) DEFAULT NULL,
  `entrydate` date DEFAULT NULL,
  `usertypeid` int(11) NOT NULL,
  `teamid` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `LHoliday` float NOT NULL DEFAULT '0',
  `THoliday` float NOT NULL DEFAULT '0',
  `LRest` float NOT NULL DEFAULT '0',
  `TRest` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of op_staffinfo
-- ----------------------------
INSERT INTO op_staffinfo VALUES ('1', '1001', '产线员工', '1', null, '1', '2014-06-19', '1', '2', '732121339@qq.com', '2014-06-19 14:06:50', '0', '0', '0', '0');
INSERT INTO op_staffinfo VALUES ('2', '1002', '人事经理', '2', null, '1', '2014-06-19', '2', '1', '732121339@qq.com', '2014-06-19 23:29:00', '0', '0', '0', '0');
INSERT INTO op_staffinfo VALUES ('3', '1003', '产线班长', '1', '1111', '1', '2014-07-03', '3', '2', '732121339@qq.com', '2014-07-15 21:24:09', '0', '0', '0', '0');
INSERT INTO op_staffinfo VALUES ('4', '1004', '部门经理', '1', '2323', '1', '2014-07-01', '4', '1', '732121339@qq.com', '2014-07-01 21:24:46', '0', '0', '0', '0');
INSERT INTO op_staffinfo VALUES ('5', '1005', '老板', '1', '212', '1', '2014-07-01', '5', '1', '732121339@qq.com', '2014-07-08 21:25:22', '0', '0', '0', '0');
INSERT INTO op_staffinfo VALUES ('6', '1006', '管理员', '1', '121', '1', '2014-07-01', '6', '1', '732121339@qq.com', '2014-07-01 21:26:18', '0', '0', '0', '0');
INSERT INTO op_staffinfo VALUES ('8', '1010', '李伟', '1', '13000000000', '1', '2014-09-08', '1', '2', '732121339@qq.com', '2014-09-08 18:17:57', '0', '0', '0', '0');
INSERT INTO op_staffinfo VALUES ('9', '1011', 'C组员工1', '1', '13000000000', '1', '2014-09-09', '1', '4', '732121339@qq.com', '2014-09-09 20:39:23', '0', '0', '0', '0');

-- ----------------------------
-- Table structure for `op_teaminfo`
-- ----------------------------
DROP TABLE IF EXISTS `op_teaminfo`;
CREATE TABLE `op_teaminfo` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `teamname` varchar(255) NOT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of op_teaminfo
-- ----------------------------
INSERT INTO op_teaminfo VALUES ('1', '办公室');
INSERT INTO op_teaminfo VALUES ('2', 'A组');
INSERT INTO op_teaminfo VALUES ('3', 'B组');
INSERT INTO op_teaminfo VALUES ('4', 'C组');

-- ----------------------------
-- Table structure for `op_unusualtime`
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
-- Records of op_unusualtime
-- ----------------------------

-- ----------------------------
-- Table structure for `op_userinfo`
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
-- Records of op_userinfo
-- ----------------------------
INSERT INTO op_userinfo VALUES ('1', '1001', 'test', '827ccb0eea8a706c4c34a16891f84e7b', '产线员工', '0', '1', null, '1', '2014-06-19', '1', '732121339@qq.com', '2014-06-19 14:06:50');
INSERT INTO op_userinfo VALUES ('2', '1002', 'hr', '827ccb0eea8a706c4c34a16891f84e7b', '人事经理', '0', '2', null, '1', '2014-06-19', '2', '732121339@qq.com', '2014-06-19 23:29:00');
INSERT INTO op_userinfo VALUES ('3', '1003', 'monitor', '827ccb0eea8a706c4c34a16891f84e7b', '产线班长', '0', '1', null, '1', '2014-07-07', '3', '732121339@qq.com', '2014-07-12 17:38:26');
INSERT INTO op_userinfo VALUES ('4', '1004', 'dpmanager', '827ccb0eea8a706c4c34a16891f84e7b', '部门经理', '0', '1', null, '1', '2014-07-01', '4', '732121339@qq.com', '2014-07-10 17:39:28');
INSERT INTO op_userinfo VALUES ('5', '1005', 'boss', '827ccb0eea8a706c4c34a16891f84e7b', '老板', '0', '1', null, '1', '2014-06-04', '5', '732121339@qq.com', '2014-07-19 17:40:04');
INSERT INTO op_userinfo VALUES ('6', '1006', 'admin', '827ccb0eea8a706c4c34a16891f84e7b', '管理员', '0', '1', null, '1', '2014-07-01', '6', '732121339@qq.com', '2014-07-19 17:40:37');
INSERT INTO op_userinfo VALUES ('1000000', '1007', 'officestaff', '827ccb0eea8a706c4c34a16891f84e7b', '办公室员工', '0', '1', null, '1', '2014-09-07', '7', '732121339@qq.com', '2014-09-07 14:39:09');
INSERT INTO op_userinfo VALUES ('1000001', '1011', 'worker1', '827ccb0eea8a706c4c34a16891f84e7b', 'C组员工1', '1', '1', '13000000000', '1', '2014-09-09', '1', 'dsfwe@163.com', '2014-09-09 20:39:23');

-- ----------------------------
-- Table structure for `op_usertype`
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
-- Records of op_usertype
-- ----------------------------
INSERT INTO op_usertype VALUES ('1', '生产线员工', 'staff_menu.json', '1');
INSERT INTO op_usertype VALUES ('2', '人事经理', 'hr_menu.json', '2');
INSERT INTO op_usertype VALUES ('3', '产线班长', 'monitor_menu.json', '3');
INSERT INTO op_usertype VALUES ('4', '部门经理', 'dp_menu.json', '4');
INSERT INTO op_usertype VALUES ('5', '老板', 'boss_menu.json', '5');
INSERT INTO op_usertype VALUES ('6', '管理员', 'admin_menu.json', '6');
INSERT INTO op_usertype VALUES ('999999', 'test', 'test_menu.json', '999999');
INSERT INTO op_usertype VALUES ('7', '办公室员工', 'office_staff_menu.json', '7');

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
  `fee` char(40) DEFAULT NULL,
  `holiday` char(40) DEFAULT NULL,
  `transpot` char(40) DEFAULT NULL,
  `days` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of op_vacationstatus
-- ----------------------------
INSERT INTO op_vacationstatus VALUES ('1', '1010', '2', '2', '0', '0', '1004', null, null, '2014-09-10', '08:30:00', '2014-09-10', '17:30:00', '2014-09-16 00:58:13', '224444444', '2', null, '22', '4.5');
INSERT INTO op_vacationstatus VALUES ('2', '1010', '1', '3', '0', '0', '1004', null, null, '2014-09-11', '08:30:00', '2014-09-11', '17:30:00', '2014-09-22 01:02:03', null, null, '年假', null, '3');
INSERT INTO op_vacationstatus VALUES ('3', '1010', '1', '3', '0', '0', '1004', null, null, '2014-09-12', '08:30:00', '2014-09-12', '17:30:00', '2014-09-22 01:02:57', null, null, '年假', null, '3.5');
INSERT INTO op_vacationstatus VALUES ('4', '1001', '1', '3', '0', '0', '1004', null, null, '2014-09-12', '08:30:00', '2014-09-12', '17:30:00', '2014-09-22 01:03:28', null, null, '调休假', null, '2');
INSERT INTO op_vacationstatus VALUES ('5', '1001', '1', '3', '0', '0', '1004', null, null, '2014-09-12', '08:30:00', '2014-09-12', '17:30:00', '2014-09-22 01:06:22', null, null, '年假', null, null);
INSERT INTO op_vacationstatus VALUES ('6', '1010', '1', '3', '0', '0', '1004', null, null, '2014-09-12', '08:30:00', '2014-09-12', '17:30:00', '2014-09-22 01:08:43', null, null, '年假', null, null);
INSERT INTO op_vacationstatus VALUES ('7', '1010', '1', '3', '0', '0', '1004', null, null, '2014-09-12', '08:30:00', '2014-09-12', '17:30:00', '2014-09-22 01:10:11', null, null, '年假', null, null);
INSERT INTO op_vacationstatus VALUES ('8', '1010', '1', '3', '0', '0', '1004', null, null, '2014-09-12', '08:30:00', '2014-09-12', '17:30:00', '2014-09-22 01:21:04', '732121339@qq.com', null, '婚假', null, null);
INSERT INTO op_vacationstatus VALUES ('9', '1010', '1', '3', '0', '0', '1004', null, null, '2014-09-12', '08:30:00', '2014-09-12', '17:30:00', '2014-09-22 01:23:24', null, null, '调休假', null, null);
INSERT INTO op_vacationstatus VALUES ('10', '1003', '1', '3', '0', '0', '1004', null, null, '2014-09-12', '08:30:00', '2014-09-12', '17:30:00', '2014-09-22 01:24:16', null, null, '产假', null, null);
INSERT INTO op_vacationstatus VALUES ('11', '1003', '1', '3', '0', '0', '1004', null, null, '2014-09-12', '08:30:00', '2014-09-12', '17:30:00', '2014-09-22 01:24:19', null, null, '产假', null, null);
INSERT INTO op_vacationstatus VALUES ('12', '1003', '1', '3', '0', '0', '1004', null, null, '2014-09-12', '08:30:00', '2014-09-12', '17:30:00', '2014-09-22 01:26:03', null, null, '其他', null, null);
INSERT INTO op_vacationstatus VALUES ('13', '1010', '1', '3', '0', '0', '1004', null, null, '2014-09-18', '08:30:00', '2014-09-18', '17:30:00', '2014-09-22 01:28:06', null, null, '病假', null, null);
INSERT INTO op_vacationstatus VALUES ('14', '1003', '1', '3', '0', '0', '1004', null, null, '2014-09-18', '08:30:00', '2014-09-18', '17:30:00', '2014-09-22 01:30:17', null, null, '病假', null, null);
INSERT INTO op_vacationstatus VALUES ('15', '1001', '1', '3', '0', '0', '1004', null, null, '2014-09-12', '08:30:00', '2014-09-12', '17:30:00', '2014-09-22 01:31:50', null, null, '调休假', null, null);
INSERT INTO op_vacationstatus VALUES ('16', '1001', '1', '3', '0', '0', '1004', null, null, '2014-09-12', '08:30:00', '2014-09-12', '17:30:00', '2014-09-22 01:34:00', null, null, null, null, null);
INSERT INTO op_vacationstatus VALUES ('17', '1001', '1', '3', '0', '0', '1004', null, null, '2014-09-12', '08:30:00', '2014-09-24', '17:30:00', '2014-09-22 01:37:44', null, null, null, null, null);
INSERT INTO op_vacationstatus VALUES ('18', '1001', '1', '3', '0', '0', '1004', null, null, '2014-09-25', '08:30:00', '2014-09-26', '17:30:00', '2014-09-22 01:38:31', null, null, null, null, null);
INSERT INTO op_vacationstatus VALUES ('19', '1001', '1', '3', '0', '0', '1004', null, null, '2014-09-25', '08:30:00', '2014-09-26', '17:30:00', '2014-09-22 01:38:32', null, null, null, null, null);
INSERT INTO op_vacationstatus VALUES ('20', '1001', '1', '3', '0', '0', '1004', null, null, '2014-09-25', '08:30:00', '2014-09-26', '17:30:00', '2014-09-22 01:38:33', null, null, null, null, null);
INSERT INTO op_vacationstatus VALUES ('21', '1001', '1', '3', '0', '0', '1004', null, null, '2014-09-25', '08:30:00', '2014-09-26', '17:30:00', '2014-09-22 01:38:33', null, null, null, null, null);
INSERT INTO op_vacationstatus VALUES ('22', '1001', '1', '3', '0', '0', '1004', null, null, '2014-09-25', '08:30:00', '2014-09-26', '17:30:00', '2014-09-22 01:38:33', null, null, null, null, null);
INSERT INTO op_vacationstatus VALUES ('23', '1001', '1', '3', '0', '0', '1004', null, null, '2014-09-12', '08:30:00', '2014-09-17', '17:30:00', '2014-09-22 01:39:26', null, null, null, null, null);
INSERT INTO op_vacationstatus VALUES ('24', '1003', '1', '3', '0', '0', '1004', null, null, '2014-09-26', '08:30:00', '2014-09-26', '17:30:00', '2014-09-22 01:40:11', null, null, null, null, null);
INSERT INTO op_vacationstatus VALUES ('25', '1010', '1', '3', '0', '0', '1004', null, null, '2014-09-10', '08:30:00', '2014-09-24', '17:30:00', '2014-09-22 01:40:30', null, null, null, null, null);
INSERT INTO op_vacationstatus VALUES ('26', '1010', '1', '3', '0', '0', '1004', null, null, '2014-09-11', '08:30:00', '2014-09-12', '17:30:00', '2014-09-22 01:42:02', null, null, null, null, null);
INSERT INTO op_vacationstatus VALUES ('27', '1010', '1', '3', '0', '0', '1004', null, null, '2014-09-11', '08:30:00', '2014-09-12', '17:30:00', '2014-09-22 01:42:04', null, null, null, null, null);
INSERT INTO op_vacationstatus VALUES ('28', '1010', '1', '3', '0', '0', '1004', null, null, '2014-09-11', '08:30:00', '2014-09-12', '17:30:00', '2014-09-22 01:42:05', null, null, null, null, null);
INSERT INTO op_vacationstatus VALUES ('29', '1010', '1', '3', '0', '0', '1004', null, null, '2014-09-11', '08:30:00', '2014-09-12', '17:30:00', '2014-09-22 01:42:05', null, null, null, null, null);
INSERT INTO op_vacationstatus VALUES ('30', '1010', '1', '3', '0', '0', '1004', null, null, '2014-09-11', '08:30:00', '2014-09-12', '17:30:00', '2014-09-22 01:42:05', null, null, null, null, null);
INSERT INTO op_vacationstatus VALUES ('31', '1010', '1', '3', '0', '0', '1004', null, null, '2014-09-11', '08:30:00', '2014-09-12', '17:30:00', '2014-09-22 01:42:05', null, null, null, null, null);
INSERT INTO op_vacationstatus VALUES ('32', '1010', '1', '3', '0', '0', '1004', null, null, '2014-09-11', '08:30:00', '2014-09-12', '17:30:00', '2014-09-22 01:42:06', null, null, null, null, null);
INSERT INTO op_vacationstatus VALUES ('33', '1010', '1', '3', '0', '0', '1004', null, null, '2014-09-11', '08:30:00', '2014-09-12', '17:30:00', '2014-09-22 01:42:06', null, null, null, null, null);
INSERT INTO op_vacationstatus VALUES ('34', '1010', '1', '3', '0', '0', '1004', null, null, '2014-09-11', '08:30:00', '2014-09-12', '17:30:00', '2014-09-22 01:42:06', null, null, null, null, null);
INSERT INTO op_vacationstatus VALUES ('35', '1003', '1', '3', '0', '0', '1004', null, null, '2014-09-04', '08:30:00', '2014-09-10', '17:30:00', '2014-09-22 01:42:24', null, null, null, null, null);
INSERT INTO op_vacationstatus VALUES ('36', '1003', '1', '3', '0', '0', '1004', null, null, '2014-09-03', '08:30:00', '2014-09-18', '17:30:00', '2014-09-22 01:42:53', null, null, '732121339@qq.com', null, null);
INSERT INTO op_vacationstatus VALUES ('37', '1003', '1', '3', '0', '0', '1004', null, null, '2014-09-17', '08:30:00', '2014-09-24', '17:30:00', '2014-09-22 01:44:16', null, null, '732121339@qq.com', null, null);
INSERT INTO op_vacationstatus VALUES ('38', '1001', '1', '3', '0', '0', '1004', null, null, '2014-09-12', '08:30:00', '2014-09-12', '17:30:00', '2014-09-22 01:45:24', null, null, '732121339@qq.com', null, null);
INSERT INTO op_vacationstatus VALUES ('39', '1003', '1', '3', '0', '0', '1004', null, null, '2014-09-12', '08:30:00', '2014-09-21', '17:30:00', '2014-09-22 01:47:08', null, null, '732121339@qq.com', null, null);
INSERT INTO op_vacationstatus VALUES ('40', '1001', '1', '3', '0', '0', '1004', null, null, '2014-09-25', '08:00:00', '2014-09-25', '17:00:00', '2014-09-22 01:49:25', null, null, '年假', null, null);
INSERT INTO op_vacationstatus VALUES ('41', '1010', '1', '3', '0', '0', '1004', null, null, '2014-09-25', '08:00:00', '2014-09-25', '17:00:00', '2014-09-22 01:51:00', null, null, '年假', null, null);
INSERT INTO op_vacationstatus VALUES ('42', '1003', '1', '3', '0', '0', '1004', null, null, '2014-09-12', '08:30:00', '2014-09-12', '17:30:00', '2014-09-22 01:55:20', null, null, '年假', null, null);
INSERT INTO op_vacationstatus VALUES ('43', '1003', '1', '3', '0', '0', '1004', null, null, '2014-09-19', '08:30:00', '2014-09-25', '17:30:00', '2014-09-22 01:57:45', null, null, '年假', null, null);
INSERT INTO op_vacationstatus VALUES ('44', '1003', '1', '3', '0', '0', '1004', null, null, '2014-09-11', '08:30:00', '2014-09-17', '17:30:00', '2014-09-22 01:59:12', null, null, '婚假', null, null);
INSERT INTO op_vacationstatus VALUES ('45', '1003', '1', '3', '0', '0', '1004', null, null, '2014-09-26', '08:00:00', '2014-09-26', '17:00:00', '2014-09-22 02:00:01', null, null, '产假', null, '1');
INSERT INTO op_vacationstatus VALUES ('46', '1010', '1', '3', '0', '0', '1004', null, null, '2014-09-25', '08:00:00', '2014-09-25', '17:00:00', '2014-09-22 02:01:46', null, null, '其他', null, '1');
INSERT INTO op_vacationstatus VALUES ('47', '1003', '1', '3', '0', '0', '1004', null, null, '2014-09-25', '08:00:00', '2014-09-26', '17:00:00', '2014-09-22 02:02:57', null, null, '病假', null, '-1');
INSERT INTO op_vacationstatus VALUES ('48', '1003', '1', '3', '0', '0', '1004', null, null, '2014-09-18', '08:00:00', '2014-09-26', '17:00:00', '2014-09-22 02:04:27', null, null, '病假', null, '12');

-- ----------------------------
-- Table structure for `op_vacationtype`
-- ----------------------------
DROP TABLE IF EXISTS `op_vacationtype`;
CREATE TABLE `op_vacationtype` (
  `typedm` char(2) NOT NULL,
  `typemc` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`typedm`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of op_vacationtype
-- ----------------------------
INSERT INTO op_vacationtype VALUES ('1', '加班');
INSERT INTO op_vacationtype VALUES ('2', '出差');
INSERT INTO op_vacationtype VALUES ('3', '休假');

-- ----------------------------
-- Table structure for `op_worktime`
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
-- Records of op_worktime
-- ----------------------------
INSERT INTO op_worktime VALUES ('1', '2', '2014-09-01', '08:00:00', '2014-09-05', '17:00:00');
INSERT INTO op_worktime VALUES ('2', '2', '2014-09-08', '08:00:00', '2014-09-12', '17:00:00');
INSERT INTO op_worktime VALUES ('3', '2', '2014-09-15', '08:00:00', '2014-09-19', '17:00:00');
INSERT INTO op_worktime VALUES ('4', '2', '2014-09-22', '08:00:00', '2014-09-26', '17:00:00');
