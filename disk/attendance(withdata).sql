/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50516
Source Host           : localhost:3306
Source Database       : op_attendance

Target Server Type    : MYSQL
Target Server Version : 50516
File Encoding         : 65001

Date: 2014-09-10 23:29:28
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
) ENGINE=MyISAM AUTO_INCREMENT=71 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of op_log
-- ----------------------------

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
  `holiday` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of op_staffinfo
-- ----------------------------
INSERT INTO op_staffinfo VALUES ('1', '100001', '产线员工', '1', null, '1', '2014-06-19', '1', '2', null, '2014-06-19 14:06:50', null);
INSERT INTO op_staffinfo VALUES ('2', '100002', '人事经理', '2', null, '1', '2014-06-19', '2', '1', '732121339@qq.com', '2014-06-19 23:29:00', null);
INSERT INTO op_staffinfo VALUES ('3', '100003', '产线班长', '1', '1111', '1', '2014-07-03', '3', '2', null, '2014-07-15 21:24:09', null);
INSERT INTO op_staffinfo VALUES ('4', '100004', '部门经理', '1', '2323', '1', '2014-07-01', '4', '1', null, '2014-07-01 21:24:46', null);
INSERT INTO op_staffinfo VALUES ('5', '100005', '老板', '1', '212', '1', '2014-07-01', '5', '1', '732121339@qq.com', '2014-07-08 21:25:22', null);
INSERT INTO op_staffinfo VALUES ('6', '100006', '管理员', '1', '121', '1', '2014-07-01', '6', '1', null, '2014-07-01 21:26:18', null);
INSERT INTO op_staffinfo VALUES ('8', '100007', '李伟', '1', '13000000000', '1', '2014-09-08', '1', '2', 'ewewe@163.com', '2014-09-08 18:17:57', null);
INSERT INTO op_staffinfo VALUES ('9', '100008', 'C组员工1', '1', '13000000000', '1', '2014-09-09', '1', '4', 'dsfwe@163.com', '2014-09-09 20:39:23', null);

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
  `type` int(2) DEFAULT NULL,
  `isapply` int(2) NOT NULL DEFAULT '0',
  `ps` varchar(255) DEFAULT NULL,
  `vacid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=257 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of op_unusualtime
-- ----------------------------
INSERT INTO op_unusualtime VALUES ('161', '0', '100001', '2014-09-05', '00:00:00', '08:00:00', '未打卡(上午)', '0', '0', null, null);
INSERT INTO op_unusualtime VALUES ('162', '0', '100001', '2014-09-05', '00:00:00', '17:00:00', '未打卡(下午)', '1', '0', null, null);
INSERT INTO op_unusualtime VALUES ('163', '64', '100001', '2014-09-06', '09:48:36', '08:00:00', '迟到', '0', '0', null, null);
INSERT INTO op_unusualtime VALUES ('164', '0', '100001', '2014-09-06', '00:00:00', '17:00:00', '未打卡(下午)', '1', '0', null, null);
INSERT INTO op_unusualtime VALUES ('165', '0', '100001', '2014-09-07', '00:00:00', '08:00:00', '未打卡(上午)', '0', '0', null, null);
INSERT INTO op_unusualtime VALUES ('166', '0', '100001', '2014-09-07', '15:52:19', '17:00:00', '早退', '1', '0', null, null);
INSERT INTO op_unusualtime VALUES ('167', '42', '100001', '2014-09-08', '10:21:46', '08:00:00', '迟到', '0', '0', null, null);
INSERT INTO op_unusualtime VALUES ('168', '42', '100001', '2014-09-08', '21:52:35', '17:00:00', '正常', '1', '0', null, null);
INSERT INTO op_unusualtime VALUES ('169', '0', '100001', '2014-09-09', '00:00:00', '08:00:00', '未打卡(上午)', '0', '0', null, null);
INSERT INTO op_unusualtime VALUES ('170', '0', '100001', '2014-09-09', '00:00:00', '17:00:00', '未打卡(下午)', '1', '0', null, null);
INSERT INTO op_unusualtime VALUES ('171', '0', '100001', '2014-09-10', '00:00:00', '08:00:00', '未打卡(上午)', '0', '0', null, null);
INSERT INTO op_unusualtime VALUES ('172', '0', '100001', '2014-09-10', '00:00:00', '17:00:00', '未打卡(下午)', '1', '0', null, null);
INSERT INTO op_unusualtime VALUES ('173', '0', '100002', '2014-09-05', '00:00:00', '08:30:00', '未打卡(上午)', '0', '0', null, null);
INSERT INTO op_unusualtime VALUES ('174', '0', '100002', '2014-09-05', '00:00:00', '17:30:00', '未打卡(下午)', '1', '0', null, null);
INSERT INTO op_unusualtime VALUES ('175', '0', '100002', '2014-09-06', '00:00:00', '08:30:00', '未打卡(上午)', '0', '0', null, null);
INSERT INTO op_unusualtime VALUES ('176', '0', '100002', '2014-09-06', '00:00:00', '17:30:00', '未打卡(下午)', '1', '0', null, null);
INSERT INTO op_unusualtime VALUES ('177', '0', '100002', '2014-09-07', '00:00:00', '08:30:00', '未打卡(上午)', '0', '0', null, null);
INSERT INTO op_unusualtime VALUES ('178', '0', '100002', '2014-09-07', '00:00:00', '17:30:00', '未打卡(下午)', '1', '0', null, null);
INSERT INTO op_unusualtime VALUES ('179', '0', '100002', '2014-09-08', '00:00:00', '08:30:00', '未打卡(上午)', '0', '0', null, null);
INSERT INTO op_unusualtime VALUES ('180', '0', '100002', '2014-09-08', '00:00:00', '17:30:00', '未打卡(下午)', '1', '0', null, null);
INSERT INTO op_unusualtime VALUES ('181', '0', '100002', '2014-09-09', '00:00:00', '08:30:00', '未打卡(上午)', '0', '0', null, null);
INSERT INTO op_unusualtime VALUES ('182', '0', '100002', '2014-09-09', '00:00:00', '17:30:00', '未打卡(下午)', '1', '0', null, null);
INSERT INTO op_unusualtime VALUES ('183', '0', '100002', '2014-09-10', '00:00:00', '08:30:00', '未打卡(上午)', '0', '0', null, null);
INSERT INTO op_unusualtime VALUES ('184', '0', '100002', '2014-09-10', '00:00:00', '17:30:00', '未打卡(下午)', '1', '0', null, null);
INSERT INTO op_unusualtime VALUES ('185', '0', '100003', '2014-09-05', '00:00:00', '08:00:00', '未打卡(上午)', '0', '0', null, null);
INSERT INTO op_unusualtime VALUES ('186', '0', '100003', '2014-09-05', '00:00:00', '17:00:00', '未打卡(下午)', '1', '0', null, null);
INSERT INTO op_unusualtime VALUES ('187', '0', '100003', '2014-09-06', '00:00:00', '08:00:00', '未打卡(上午)', '0', '0', null, null);
INSERT INTO op_unusualtime VALUES ('188', '0', '100003', '2014-09-06', '00:00:00', '17:00:00', '未打卡(下午)', '1', '0', null, null);
INSERT INTO op_unusualtime VALUES ('189', '0', '100003', '2014-09-07', '00:00:00', '08:00:00', '未打卡(上午)', '0', '0', null, null);
INSERT INTO op_unusualtime VALUES ('190', '0', '100003', '2014-09-07', '00:00:00', '17:00:00', '未打卡(下午)', '1', '0', null, null);
INSERT INTO op_unusualtime VALUES ('191', '0', '100003', '2014-09-08', '00:00:00', '08:00:00', '未打卡(上午)', '0', '0', null, null);
INSERT INTO op_unusualtime VALUES ('192', '0', '100003', '2014-09-08', '18:03:03', '17:00:00', '正常', '1', '0', null, null);
INSERT INTO op_unusualtime VALUES ('193', '0', '100003', '2014-09-09', '00:00:00', '08:00:00', '未打卡(上午)', '0', '0', null, null);
INSERT INTO op_unusualtime VALUES ('194', '0', '100003', '2014-09-09', '00:00:00', '17:00:00', '未打卡(下午)', '1', '0', null, null);
INSERT INTO op_unusualtime VALUES ('195', '0', '100003', '2014-09-10', '00:00:00', '08:00:00', '未打卡(上午)', '0', '0', null, null);
INSERT INTO op_unusualtime VALUES ('196', '0', '100003', '2014-09-10', '00:00:00', '17:00:00', '未打卡(下午)', '1', '0', null, null);
INSERT INTO op_unusualtime VALUES ('197', '0', '100004', '2014-09-05', '00:00:00', '08:30:00', '未打卡(上午)', '0', '0', null, null);
INSERT INTO op_unusualtime VALUES ('198', '0', '100004', '2014-09-05', '00:00:00', '17:30:00', '未打卡(下午)', '1', '0', null, null);
INSERT INTO op_unusualtime VALUES ('199', '0', '100004', '2014-09-06', '00:00:00', '08:30:00', '未打卡(上午)', '0', '0', null, null);
INSERT INTO op_unusualtime VALUES ('200', '0', '100004', '2014-09-06', '00:00:00', '17:30:00', '未打卡(下午)', '1', '0', null, null);
INSERT INTO op_unusualtime VALUES ('201', '0', '100004', '2014-09-07', '00:00:00', '08:30:00', '未打卡(上午)', '0', '0', null, null);
INSERT INTO op_unusualtime VALUES ('202', '0', '100004', '2014-09-07', '15:52:29', '17:30:00', '早退', '1', '0', null, null);
INSERT INTO op_unusualtime VALUES ('203', '0', '100004', '2014-09-08', '00:00:00', '08:30:00', '未打卡(上午)', '0', '0', null, null);
INSERT INTO op_unusualtime VALUES ('204', '0', '100004', '2014-09-08', '15:45:25', '17:30:00', '早退', '1', '0', null, null);
INSERT INTO op_unusualtime VALUES ('205', '0', '100004', '2014-09-09', '00:00:00', '08:30:00', '未打卡(上午)', '0', '0', null, null);
INSERT INTO op_unusualtime VALUES ('206', '0', '100004', '2014-09-09', '00:00:00', '17:30:00', '未打卡(下午)', '1', '0', null, null);
INSERT INTO op_unusualtime VALUES ('207', '0', '100004', '2014-09-10', '00:00:00', '08:30:00', '未打卡(上午)', '0', '0', null, null);
INSERT INTO op_unusualtime VALUES ('208', '0', '100004', '2014-09-10', '00:00:00', '17:30:00', '未打卡(下午)', '1', '0', null, null);
INSERT INTO op_unusualtime VALUES ('209', '0', '100005', '2014-09-05', '00:00:00', '08:30:00', '未打卡(上午)', '0', '0', null, null);
INSERT INTO op_unusualtime VALUES ('210', '0', '100005', '2014-09-05', '00:00:00', '17:30:00', '未打卡(下午)', '1', '0', null, null);
INSERT INTO op_unusualtime VALUES ('211', '0', '100005', '2014-09-06', '00:00:00', '08:30:00', '未打卡(上午)', '0', '0', null, null);
INSERT INTO op_unusualtime VALUES ('212', '0', '100005', '2014-09-06', '00:00:00', '17:30:00', '未打卡(下午)', '1', '0', null, null);
INSERT INTO op_unusualtime VALUES ('213', '0', '100005', '2014-09-07', '00:00:00', '08:30:00', '未打卡(上午)', '0', '0', null, null);
INSERT INTO op_unusualtime VALUES ('214', '0', '100005', '2014-09-07', '00:00:00', '17:30:00', '未打卡(下午)', '1', '0', null, null);
INSERT INTO op_unusualtime VALUES ('215', '0', '100005', '2014-09-08', '00:00:00', '08:30:00', '未打卡(上午)', '0', '0', null, null);
INSERT INTO op_unusualtime VALUES ('216', '0', '100005', '2014-09-08', '00:00:00', '17:30:00', '未打卡(下午)', '1', '0', null, null);
INSERT INTO op_unusualtime VALUES ('217', '68', '100005', '2014-09-09', '10:31:40', '08:30:00', '迟到', '0', '0', null, null);
INSERT INTO op_unusualtime VALUES ('218', '0', '100005', '2014-09-09', '00:00:00', '17:30:00', '未打卡(下午)', '1', '0', null, null);
INSERT INTO op_unusualtime VALUES ('219', '0', '100005', '2014-09-10', '00:00:00', '08:30:00', '未打卡(上午)', '0', '0', null, null);
INSERT INTO op_unusualtime VALUES ('220', '0', '100005', '2014-09-10', '00:00:00', '17:30:00', '未打卡(下午)', '1', '0', null, null);
INSERT INTO op_unusualtime VALUES ('221', '0', '100006', '2014-09-05', '00:00:00', '08:30:00', '未打卡(上午)', '0', '0', null, null);
INSERT INTO op_unusualtime VALUES ('222', '0', '100006', '2014-09-05', '00:00:00', '17:30:00', '未打卡(下午)', '1', '0', null, null);
INSERT INTO op_unusualtime VALUES ('223', '0', '100006', '2014-09-06', '00:00:00', '08:30:00', '未打卡(上午)', '0', '0', null, null);
INSERT INTO op_unusualtime VALUES ('224', '0', '100006', '2014-09-06', '00:00:00', '17:30:00', '未打卡(下午)', '1', '0', null, null);
INSERT INTO op_unusualtime VALUES ('225', '0', '100006', '2014-09-07', '00:00:00', '08:30:00', '未打卡(上午)', '0', '0', null, null);
INSERT INTO op_unusualtime VALUES ('226', '0', '100006', '2014-09-07', '00:00:00', '17:30:00', '未打卡(下午)', '1', '0', null, null);
INSERT INTO op_unusualtime VALUES ('227', '0', '100006', '2014-09-08', '00:00:00', '08:30:00', '未打卡(上午)', '0', '0', null, null);
INSERT INTO op_unusualtime VALUES ('228', '0', '100006', '2014-09-08', '00:00:00', '17:30:00', '未打卡(下午)', '1', '0', null, null);
INSERT INTO op_unusualtime VALUES ('229', '0', '100006', '2014-09-09', '00:00:00', '08:30:00', '未打卡(上午)', '0', '0', null, null);
INSERT INTO op_unusualtime VALUES ('230', '0', '100006', '2014-09-09', '00:00:00', '17:30:00', '未打卡(下午)', '1', '0', null, null);
INSERT INTO op_unusualtime VALUES ('231', '0', '100006', '2014-09-10', '00:00:00', '08:30:00', '未打卡(上午)', '0', '0', null, null);
INSERT INTO op_unusualtime VALUES ('232', '0', '100006', '2014-09-10', '00:00:00', '17:30:00', '未打卡(下午)', '1', '0', null, null);
INSERT INTO op_unusualtime VALUES ('233', '0', '100007', '2014-09-05', '00:00:00', '08:00:00', '未打卡(上午)', '0', '0', null, null);
INSERT INTO op_unusualtime VALUES ('234', '0', '100007', '2014-09-05', '00:00:00', '17:00:00', '未打卡(下午)', '1', '0', null, null);
INSERT INTO op_unusualtime VALUES ('235', '0', '100007', '2014-09-06', '00:00:00', '08:00:00', '未打卡(上午)', '0', '0', null, null);
INSERT INTO op_unusualtime VALUES ('236', '0', '100007', '2014-09-06', '00:00:00', '17:00:00', '未打卡(下午)', '1', '0', null, null);
INSERT INTO op_unusualtime VALUES ('237', '0', '100007', '2014-09-07', '00:00:00', '08:00:00', '未打卡(上午)', '0', '0', null, null);
INSERT INTO op_unusualtime VALUES ('238', '0', '100007', '2014-09-07', '00:00:00', '17:00:00', '未打卡(下午)', '1', '0', null, null);
INSERT INTO op_unusualtime VALUES ('239', '0', '100007', '2014-09-08', '00:00:00', '08:00:00', '未打卡(上午)', '0', '0', null, null);
INSERT INTO op_unusualtime VALUES ('240', '0', '100007', '2014-09-08', '00:00:00', '17:00:00', '未打卡(下午)', '1', '0', null, null);
INSERT INTO op_unusualtime VALUES ('241', '0', '100007', '2014-09-09', '00:00:00', '08:00:00', '未打卡(上午)', '0', '0', null, null);
INSERT INTO op_unusualtime VALUES ('242', '0', '100007', '2014-09-09', '00:00:00', '17:00:00', '未打卡(下午)', '1', '0', null, null);
INSERT INTO op_unusualtime VALUES ('243', '0', '100007', '2014-09-10', '00:00:00', '08:00:00', '未打卡(上午)', '0', '0', null, null);
INSERT INTO op_unusualtime VALUES ('244', '0', '100007', '2014-09-10', '00:00:00', '17:00:00', '未打卡(下午)', '1', '0', null, null);
INSERT INTO op_unusualtime VALUES ('245', '0', '100008', '2014-09-05', '00:00:00', '08:00:00', '未打卡(上午)', '0', '0', null, null);
INSERT INTO op_unusualtime VALUES ('246', '0', '100008', '2014-09-05', '00:00:00', '17:00:00', '未打卡(下午)', '1', '0', null, null);
INSERT INTO op_unusualtime VALUES ('247', '0', '100008', '2014-09-06', '00:00:00', '08:00:00', '未打卡(上午)', '0', '0', null, null);
INSERT INTO op_unusualtime VALUES ('248', '0', '100008', '2014-09-06', '00:00:00', '17:00:00', '未打卡(下午)', '1', '0', null, null);
INSERT INTO op_unusualtime VALUES ('249', '0', '100008', '2014-09-07', '00:00:00', '08:00:00', '未打卡(上午)', '0', '0', null, null);
INSERT INTO op_unusualtime VALUES ('250', '0', '100008', '2014-09-07', '00:00:00', '17:00:00', '未打卡(下午)', '1', '0', null, null);
INSERT INTO op_unusualtime VALUES ('251', '0', '100008', '2014-09-08', '00:00:00', '08:00:00', '未打卡(上午)', '0', '0', null, null);
INSERT INTO op_unusualtime VALUES ('252', '0', '100008', '2014-09-08', '00:00:00', '17:00:00', '未打卡(下午)', '1', '0', null, null);
INSERT INTO op_unusualtime VALUES ('253', '0', '100008', '2014-09-09', '00:00:00', '08:00:00', '未打卡(上午)', '0', '0', null, null);
INSERT INTO op_unusualtime VALUES ('254', '0', '100008', '2014-09-09', '00:00:00', '17:00:00', '未打卡(下午)', '1', '0', null, null);
INSERT INTO op_unusualtime VALUES ('255', '0', '100008', '2014-09-10', '00:00:00', '08:00:00', '未打卡(上午)', '0', '0', null, null);
INSERT INTO op_unusualtime VALUES ('256', '0', '100008', '2014-09-10', '00:00:00', '17:00:00', '未打卡(下午)', '1', '0', null, null);

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
INSERT INTO op_userinfo VALUES ('1', '100001', 'test', '827ccb0eea8a706c4c34a16891f84e7b', '产线员工', '0', '1', null, '1', '2014-06-19', '1', null, '2014-06-19 14:06:50');
INSERT INTO op_userinfo VALUES ('2', '100002', 'hr', '827ccb0eea8a706c4c34a16891f84e7b', '人事经理', '0', '2', null, '1', '2014-06-19', '2', '732121339@qq.com', '2014-06-19 23:29:00');
INSERT INTO op_userinfo VALUES ('3', '100003', 'monitor', '827ccb0eea8a706c4c34a16891f84e7b', '产线班长', '0', '1', null, '1', '2014-07-07', '3', null, '2014-07-12 17:38:26');
INSERT INTO op_userinfo VALUES ('4', '100004', 'dpmanager', '827ccb0eea8a706c4c34a16891f84e7b', '部门经理', '0', '1', null, '1', '2014-07-01', '4', null, '2014-07-10 17:39:28');
INSERT INTO op_userinfo VALUES ('5', '100005', 'boss', '827ccb0eea8a706c4c34a16891f84e7b', '老板', '0', '1', null, '1', '2014-06-04', '5', '732121339@qq.com', '2014-07-19 17:40:04');
INSERT INTO op_userinfo VALUES ('6', '100006', 'admin', '827ccb0eea8a706c4c34a16891f84e7b', '管理员', '0', '1', null, '1', '2014-07-01', '6', null, '2014-07-19 17:40:37');
INSERT INTO op_userinfo VALUES ('1000000', '100007', 'officestaff', '827ccb0eea8a706c4c34a16891f84e7b', '办公室员工', '0', '1', null, '1', '2014-09-07', '7', null, '2014-09-07 14:39:09');
INSERT INTO op_userinfo VALUES ('1000001', '100011', 'worker1', '827ccb0eea8a706c4c34a16891f84e7b', 'C组员工1', '1', '1', '13000000000', '1', '2014-09-09', '1', 'dsfwe@163.com', '2014-09-09 20:39:23');

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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of op_vacationstatus
-- ----------------------------

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
INSERT INTO op_worktime VALUES ('1', '1', '2014-01-01', '08:30:00', '2014-12-31', '17:30:00');
INSERT INTO op_worktime VALUES ('2', '2', '2014-01-01', '08:00:00', '2014-12-31', '17:00:00');
INSERT INTO op_worktime VALUES ('3', '3', '2014-01-01', '08:30:00', '2014-12-31', '17:30:00');
INSERT INTO op_worktime VALUES ('4', '4', '2014-01-01', '08:00:00', '2014-12-31', '17:00:00');
