/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50516
Source Host           : localhost:3306
Source Database       : op_attendance

Target Server Type    : MYSQL
Target Server Version : 50516
File Encoding         : 65001

Date: 2014-08-09 13:27:57
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `op_clocktime`
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
-- Records of op_clocktime
-- ----------------------------
INSERT INTO op_clocktime VALUES ('1', '1001', '2014-06-19', '08:00:26');
INSERT INTO op_clocktime VALUES ('2', '1001', '2014-06-19', '08:02:33');
INSERT INTO op_clocktime VALUES ('3', '1001', '2014-06-19', '11:57:41');
INSERT INTO op_clocktime VALUES ('4', '1001', '2014-06-19', '13:41:56');
INSERT INTO op_clocktime VALUES ('5', '1001', '2014-06-19', '17:42:02');
INSERT INTO op_clocktime VALUES ('6', '1001', '2014-06-20', '08:30:15');
INSERT INTO op_clocktime VALUES ('7', '1001', '2014-06-20', '17:35:55');
INSERT INTO op_clocktime VALUES ('8', '1002', '2014-06-19', '08:10:22');
INSERT INTO op_clocktime VALUES ('9', '1002', '2014-06-19', '17:40:44');
INSERT INTO op_clocktime VALUES ('12', '1003', '2014-06-19', '08:00:00');
INSERT INTO op_clocktime VALUES ('11', '1002', '2014-06-20', '07:25:22');
INSERT INTO op_clocktime VALUES ('13', '1003', '2014-06-19', '17:00:00');
INSERT INTO op_clocktime VALUES ('14', '1003', '2014-06-20', '17:40:00');

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
  `id` int(11) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `logintime` datetime DEFAULT NULL,
  `quittime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of op_log
-- ----------------------------
INSERT INTO op_log VALUES ('0', '1001', '2014-07-31 21:55:21', null);

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
  `team` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of op_sample
-- ----------------------------
INSERT INTO op_sample VALUES ('888', '张XX', '1', '1', '2008-08-08', '2', '137XXXXXXXX', '2', 'oops@juying.com');

-- ----------------------------
-- Table structure for `op_staffinfo`
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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of op_staffinfo
-- ----------------------------
INSERT INTO op_staffinfo VALUES ('1', '1001', '产线员工', '1', null, '1', '2014-06-19', '1', '2', null, '2014-06-19 14:06:50');
INSERT INTO op_staffinfo VALUES ('2', '1002', '人事经理', '2', null, '1', '2014-06-19', '2', '1', null, '2014-06-19 23:29:00');
INSERT INTO op_staffinfo VALUES ('3', '1003', '产线班长', '1', '1111', '1', '2014-07-03', '3', '2', null, '2014-07-15 21:24:09');
INSERT INTO op_staffinfo VALUES ('4', '1004', '部门经理', '1', '2323', '1', '2014-07-01', '4', '1', null, '2014-07-01 21:24:46');
INSERT INTO op_staffinfo VALUES ('5', '1005', '老板', '1', '212', '1', '2014-07-01', '5', '1', null, '2014-07-08 21:25:22');
INSERT INTO op_staffinfo VALUES ('6', '1006', '管理员', '1', '121', '1', '2014-07-01', '6', '1', null, '2014-07-01 21:26:18');

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
  `pid` int(11) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `clockdate` date DEFAULT NULL,
  `clocktime` time DEFAULT NULL,
  `standardtime` time DEFAULT NULL,
  `static` varchar(255) DEFAULT NULL,
  `isapply` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of op_unusualtime
-- ----------------------------
INSERT INTO op_unusualtime VALUES ('1', '0', '1001', '2014-06-22', '00:00:00', '08:30:00', '未打卡(上午)', '0');
INSERT INTO op_unusualtime VALUES ('2', '0', '1001', '2014-06-22', '00:00:00', '17:30:00', '未打卡(下午)', '0');
INSERT INTO op_unusualtime VALUES ('3', '0', '1002', '2014-06-22', '00:00:00', '08:00:00', '未打卡(上午)', '0');
INSERT INTO op_unusualtime VALUES ('4', '0', '1002', '2014-06-22', '00:00:00', '18:00:00', '未打卡(下午)', '0');
INSERT INTO op_unusualtime VALUES ('5', '0', '1003', '2014-06-22', '00:00:00', '08:30:00', '未打卡(上午)', '0');
INSERT INTO op_unusualtime VALUES ('6', '0', '1003', '2014-06-22', '00:00:00', '17:30:00', '未打卡(下午)', '0');
INSERT INTO op_unusualtime VALUES ('7', '0', '1004', '2014-06-22', '00:00:00', '08:00:00', '未打卡(上午)', '0');
INSERT INTO op_unusualtime VALUES ('8', '0', '1004', '2014-06-22', '00:00:00', '18:00:00', '未打卡(下午)', '0');
INSERT INTO op_unusualtime VALUES ('9', '0', '1005', '2014-06-22', '00:00:00', '08:00:00', '未打卡(上午)', '0');
INSERT INTO op_unusualtime VALUES ('10', '0', '1005', '2014-06-22', '00:00:00', '18:00:00', '未打卡(下午)', '0');
INSERT INTO op_unusualtime VALUES ('11', '0', '1006', '2014-06-22', '00:00:00', '08:00:00', '未打卡(上午)', '0');
INSERT INTO op_unusualtime VALUES ('12', '0', '1006', '2014-06-22', '00:00:00', '18:00:00', '未打卡(下午)', '0');

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
) ENGINE=MyISAM AUTO_INCREMENT=1000000 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of op_userinfo
-- ----------------------------
INSERT INTO op_userinfo VALUES ('1', '1001', 'test', '827ccb0eea8a706c4c34a16891f84e7b', '产线员工', '0', '1', null, '1', '2014-06-19', '1', null, '2014-06-19 14:06:50');
INSERT INTO op_userinfo VALUES ('2', '1002', 'hr', '827ccb0eea8a706c4c34a16891f84e7b', '人事经理', '0', '2', null, '1', '2014-06-19', '2', null, '2014-06-19 23:29:00');
INSERT INTO op_userinfo VALUES ('3', '1003', 'monitor', '827ccb0eea8a706c4c34a16891f84e7b', '产线班长', '0', '1', null, '1', '2014-07-07', '3', null, '2014-07-12 17:38:26');
INSERT INTO op_userinfo VALUES ('4', '1004', 'dpmanager', '827ccb0eea8a706c4c34a16891f84e7b', '部门经理', '0', '1', null, '1', '2014-07-01', '4', null, '2014-07-10 17:39:28');
INSERT INTO op_userinfo VALUES ('5', '1005', 'boss', '827ccb0eea8a706c4c34a16891f84e7b', '老板', '0', '1', null, '1', '2014-06-04', '5', null, '2014-07-19 17:40:04');
INSERT INTO op_userinfo VALUES ('6', '1006', 'admin', '827ccb0eea8a706c4c34a16891f84e7b', '管理员', '0', '1', null, '1', '2014-07-01', '6', null, '2014-07-19 17:40:37');

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
INSERT INTO op_usertype VALUES ('1', '员工', 'staff_menu.json', '1');
INSERT INTO op_usertype VALUES ('2', '人事经理', 'hr_menu.json', '2');
INSERT INTO op_usertype VALUES ('3', '产线班长', 'monitor_menu.json', '3');
INSERT INTO op_usertype VALUES ('4', '部门经理', 'dp_menu.json', '4');
INSERT INTO op_usertype VALUES ('5', '老板', 'boss_menu.json', '5');
INSERT INTO op_usertype VALUES ('6', '管理员', 'admin_menu.json', '6');
INSERT INTO op_usertype VALUES ('999999', 'test', 'test_menu.json', '999999');

-- ----------------------------
-- Table structure for `op_worktime`
-- ----------------------------
DROP TABLE IF EXISTS `op_worktime`;
CREATE TABLE `op_worktime` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teamid` int(11) DEFAULT NULL,
  `worktime1` time NOT NULL,
  `worktime2` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of op_worktime
-- ----------------------------
INSERT INTO op_worktime VALUES ('1', '1', '08:00:00', '18:00:00');
INSERT INTO op_worktime VALUES ('2', '2', '08:30:00', '17:30:00');
INSERT INTO op_worktime VALUES ('3', '3', '09:00:00', '18:30:00');
INSERT INTO op_worktime VALUES ('4', '4', '09:30:00', '17:00:00');
