/*
Navicat MySQL Data Transfer

Source Server         : op_attendance
Source Server Version : 50515
Source Host           : localhost:3306
Source Database       : op_attendance

Target Server Type    : MYSQL
Target Server Version : 50515
File Encoding         : 65001

Date: 2014-11-07 23:59:39
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
) ENGINE=MyISAM AUTO_INCREMENT=11212 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of op_department
-- ----------------------------
INSERT INTO op_department VALUES ('1', '生产部');
INSERT INTO op_department VALUES ('2', '人事部');
INSERT INTO op_department VALUES ('3', '财务部');
INSERT INTO op_department VALUES ('4', '质量部');
INSERT INTO op_department VALUES ('5', '物流部');
INSERT INTO op_department VALUES ('6', '工程部');
INSERT INTO op_department VALUES ('7', '总经办');
INSERT INTO op_department VALUES ('8', '销售部');
INSERT INTO op_department VALUES ('9', 'FES');

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
) ENGINE=MyISAM AUTO_INCREMENT=807 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of op_log
-- ----------------------------
INSERT INTO op_log VALUES ('553', '28003914', '2014-11-06 11:52:50', null);
INSERT INTO op_log VALUES ('554', '28003912', '2014-11-06 11:52:58', null);
INSERT INTO op_log VALUES ('555', '28003914', '2014-11-06 11:53:07', null);
INSERT INTO op_log VALUES ('556', '10000000', '2014-11-06 12:04:35', null);
INSERT INTO op_log VALUES ('557', '10000000', '2014-11-06 12:19:10', null);
INSERT INTO op_log VALUES ('558', '28003914', '2014-11-06 12:33:42', null);
INSERT INTO op_log VALUES ('559', '28011639', '2014-11-06 14:14:18', null);
INSERT INTO op_log VALUES ('560', '28010370', '2014-11-06 14:15:48', null);
INSERT INTO op_log VALUES ('561', '28011639', '2014-11-06 14:18:03', null);
INSERT INTO op_log VALUES ('562', '28004026', '2014-11-06 14:21:17', null);
INSERT INTO op_log VALUES ('563', '28009632', '2014-11-06 14:21:51', null);
INSERT INTO op_log VALUES ('564', '28009632', '2014-11-06 14:23:42', null);
INSERT INTO op_log VALUES ('565', '28004019', '2014-11-06 14:27:46', null);
INSERT INTO op_log VALUES ('566', '10000000', '2014-11-06 14:32:01', null);
INSERT INTO op_log VALUES ('567', '10000000', '2014-11-06 14:32:06', null);
INSERT INTO op_log VALUES ('568', '10000000', '2014-11-06 14:32:09', null);
INSERT INTO op_log VALUES ('569', '10000000', '2014-11-06 14:32:10', null);
INSERT INTO op_log VALUES ('570', '28010009', '2014-11-06 14:32:20', null);
INSERT INTO op_log VALUES ('571', '28010009', '2014-11-06 14:32:54', null);
INSERT INTO op_log VALUES ('572', '28003940', '2014-11-06 14:36:13', null);
INSERT INTO op_log VALUES ('573', '28003914', '2014-11-06 14:39:59', null);
INSERT INTO op_log VALUES ('574', '28003914', '2014-11-06 14:40:40', null);
INSERT INTO op_log VALUES ('575', '28003938', '2014-11-06 14:42:16', null);
INSERT INTO op_log VALUES ('576', '28003940', '2014-11-06 14:42:23', null);
INSERT INTO op_log VALUES ('577', '28003935', '2014-11-06 14:42:38', null);
INSERT INTO op_log VALUES ('578', '28004021', '2014-11-06 14:44:00', null);
INSERT INTO op_log VALUES ('579', '28003940', '2014-11-06 14:45:51', null);
INSERT INTO op_log VALUES ('580', '28003924', '2014-11-06 14:46:11', null);
INSERT INTO op_log VALUES ('581', '28003925', '2014-11-06 14:52:29', null);
INSERT INTO op_log VALUES ('582', '28003944', '2014-11-06 14:57:44', null);
INSERT INTO op_log VALUES ('583', '28006504', '2014-11-06 14:59:07', null);
INSERT INTO op_log VALUES ('584', '28003944', '2014-11-06 15:00:11', null);
INSERT INTO op_log VALUES ('585', '28004019', '2014-11-06 15:01:46', null);
INSERT INTO op_log VALUES ('586', '10000004', '2014-11-06 15:02:25', null);
INSERT INTO op_log VALUES ('587', '28003921', '2014-11-06 15:03:01', null);
INSERT INTO op_log VALUES ('588', '28010009', '2014-11-06 15:03:36', null);
INSERT INTO op_log VALUES ('589', '10000004', '2014-11-06 15:03:38', null);
INSERT INTO op_log VALUES ('590', '28003925', '2014-11-06 15:03:46', null);
INSERT INTO op_log VALUES ('591', '10000004', '2014-11-06 15:04:46', null);
INSERT INTO op_log VALUES ('592', '28003944', '2014-11-06 15:06:17', null);
INSERT INTO op_log VALUES ('593', '28003914', '2014-11-06 15:07:54', null);
INSERT INTO op_log VALUES ('594', '28003928', '2014-11-06 15:08:09', null);
INSERT INTO op_log VALUES ('595', '28003940', '2014-11-06 15:08:57', null);
INSERT INTO op_log VALUES ('596', '28006173', '2014-11-06 15:09:36', null);
INSERT INTO op_log VALUES ('597', '28003941', '2014-11-06 15:09:57', null);
INSERT INTO op_log VALUES ('598', '28003941', '2014-11-06 15:11:58', null);
INSERT INTO op_log VALUES ('599', '10000002', '2014-11-06 15:12:18', null);
INSERT INTO op_log VALUES ('600', '10000008', '2014-11-06 15:12:19', null);
INSERT INTO op_log VALUES ('601', '28003909', '2014-11-06 15:14:52', null);
INSERT INTO op_log VALUES ('602', '28003909', '2014-11-06 15:14:56', null);
INSERT INTO op_log VALUES ('603', '28003927', '2014-11-06 15:16:07', null);
INSERT INTO op_log VALUES ('604', '10000000', '2014-11-06 15:16:25', null);
INSERT INTO op_log VALUES ('605', '28003927', '2014-11-06 15:16:44', null);
INSERT INTO op_log VALUES ('606', '28003928', '2014-11-06 15:16:58', null);
INSERT INTO op_log VALUES ('607', '28004018', '2014-11-06 15:18:25', null);
INSERT INTO op_log VALUES ('608', '28004021', '2014-11-06 15:18:48', null);
INSERT INTO op_log VALUES ('609', '28004019', '2014-11-06 15:19:26', null);
INSERT INTO op_log VALUES ('610', '28003927', '2014-11-06 15:21:47', null);
INSERT INTO op_log VALUES ('611', '10000000', '2014-11-06 15:23:41', null);
INSERT INTO op_log VALUES ('612', '10000000', '2014-11-06 15:23:44', null);
INSERT INTO op_log VALUES ('613', '10000000', '2014-11-06 15:23:53', null);
INSERT INTO op_log VALUES ('786', '10000000', '2014-11-07 18:15:01', null);
INSERT INTO op_log VALUES ('618', '28003909', '2014-11-06 15:25:00', null);
INSERT INTO op_log VALUES ('619', '28003909', '2014-11-06 15:25:04', null);
INSERT INTO op_log VALUES ('620', '28003937', '2014-11-06 15:28:31', null);
INSERT INTO op_log VALUES ('621', '28003905', '2014-11-06 15:32:22', null);
INSERT INTO op_log VALUES ('622', '28003932', '2014-11-06 15:36:15', null);
INSERT INTO op_log VALUES ('624', '28003904', '2014-11-06 15:40:11', null);
INSERT INTO op_log VALUES ('625', '28003903', '2014-11-06 15:40:32', null);
INSERT INTO op_log VALUES ('626', '28003903', '2014-11-06 15:43:54', null);
INSERT INTO op_log VALUES ('628', '28005807', '2014-11-06 15:51:44', null);
INSERT INTO op_log VALUES ('629', '28003925', '2014-11-06 15:51:59', null);
INSERT INTO op_log VALUES ('630', '28006504', '2014-11-06 15:54:42', null);
INSERT INTO op_log VALUES ('631', '28003921', '2014-11-06 15:55:35', null);
INSERT INTO op_log VALUES ('632', '28005807', '2014-11-06 15:56:28', null);
INSERT INTO op_log VALUES ('633', '28005808', '2014-11-06 16:14:58', null);
INSERT INTO op_log VALUES ('636', '28009162', '2014-11-06 16:29:31', null);
INSERT INTO op_log VALUES ('637', '28006504', '2014-11-06 16:37:03', null);
INSERT INTO op_log VALUES ('638', '28005807', '2014-11-06 16:37:33', null);
INSERT INTO op_log VALUES ('639', '28006504', '2014-11-06 16:37:57', null);
INSERT INTO op_log VALUES ('640', '28005807', '2014-11-06 16:38:59', null);
INSERT INTO op_log VALUES ('641', '28003925', '2014-11-06 16:39:13', null);
INSERT INTO op_log VALUES ('642', '28003907', '2014-11-06 16:40:52', null);
INSERT INTO op_log VALUES ('643', '28003907', '2014-11-06 16:41:49', null);
INSERT INTO op_log VALUES ('644', '28003907', '2014-11-06 16:42:11', null);
INSERT INTO op_log VALUES ('648', '28003989', '2014-11-06 17:04:35', null);
INSERT INTO op_log VALUES ('649', '10000003', '2014-11-06 17:14:16', null);
INSERT INTO op_log VALUES ('651', '28006504', '2014-11-06 17:36:33', null);
INSERT INTO op_log VALUES ('653', '28006504', '2014-11-06 17:37:03', null);
INSERT INTO op_log VALUES ('654', '28004024', '2014-11-06 17:56:32', null);
INSERT INTO op_log VALUES ('655', '28004027', '2014-11-06 18:00:12', null);
INSERT INTO op_log VALUES ('656', '28010001', '2014-11-06 18:17:08', null);
INSERT INTO op_log VALUES ('657', '28010002', '2014-11-06 18:19:54', null);
INSERT INTO op_log VALUES ('658', '28010370', '2014-11-06 18:30:22', null);
INSERT INTO op_log VALUES ('659', '28003937', '2014-11-06 18:31:18', null);
INSERT INTO op_log VALUES ('660', '28011639', '2014-11-06 18:33:33', null);
INSERT INTO op_log VALUES ('661', '28010370', '2014-11-06 18:33:43', null);
INSERT INTO op_log VALUES ('662', '28010370', '2014-11-06 18:34:05', null);
INSERT INTO op_log VALUES ('663', '28010002', '2014-11-06 18:35:22', null);
INSERT INTO op_log VALUES ('664', '28003921', '2014-11-06 18:42:40', null);
INSERT INTO op_log VALUES ('665', '28006504', '2014-11-06 18:44:20', null);
INSERT INTO op_log VALUES ('666', '28003951', '2014-11-06 18:46:42', null);
INSERT INTO op_log VALUES ('667', '28003951', '2014-11-06 18:53:37', null);
INSERT INTO op_log VALUES ('668', '28004024', '2014-11-06 19:17:01', null);
INSERT INTO op_log VALUES ('669', '28004024', '2014-11-06 19:16:50', null);
INSERT INTO op_log VALUES ('670', '28003937', '2014-11-06 20:10:40', null);
INSERT INTO op_log VALUES ('671', '28003939', '2014-11-06 20:47:15', null);
INSERT INTO op_log VALUES ('672', '28003904', '2014-11-06 21:08:46', null);
INSERT INTO op_log VALUES ('673', '28003903', '2014-11-06 21:11:06', null);
INSERT INTO op_log VALUES ('674', '28003904', '2014-11-06 21:12:38', null);
INSERT INTO op_log VALUES ('675', '28003903', '2014-11-06 21:11:44', null);
INSERT INTO op_log VALUES ('676', '28003903', '2014-11-06 21:12:38', null);
INSERT INTO op_log VALUES ('677', '28003904', '2014-11-06 21:16:52', null);
INSERT INTO op_log VALUES ('678', '28003939', '2014-11-06 21:24:49', null);
INSERT INTO op_log VALUES ('679', '28010002', '2014-11-06 22:36:35', null);
INSERT INTO op_log VALUES ('682', '28004024', '2014-11-06 22:42:49', null);
INSERT INTO op_log VALUES ('684', '28010002', '2014-11-06 23:01:17', null);
INSERT INTO op_log VALUES ('688', '28003938', '2014-11-07 00:37:11', null);
INSERT INTO op_log VALUES ('689', '28003904', '2014-11-07 03:52:54', null);
INSERT INTO op_log VALUES ('690', '28003925', '2014-11-07 09:25:37', null);
INSERT INTO op_log VALUES ('691', '28006504', '2014-11-07 09:26:02', null);
INSERT INTO op_log VALUES ('692', '28003930', '2014-11-07 09:35:33', null);
INSERT INTO op_log VALUES ('693', '28003918', '2014-11-07 10:50:25', null);
INSERT INTO op_log VALUES ('698', '28004044', '2014-11-07 11:07:02', null);
INSERT INTO op_log VALUES ('699', '28004027', '2014-11-07 11:07:22', null);
INSERT INTO op_log VALUES ('700', '28004034', '2014-11-07 11:07:33', null);
INSERT INTO op_log VALUES ('701', '28004043', '2014-11-07 11:07:45', null);
INSERT INTO op_log VALUES ('702', '28009631', '2014-11-07 11:07:57', null);
INSERT INTO op_log VALUES ('703', '28010366', '2014-11-07 11:08:07', null);
INSERT INTO op_log VALUES ('704', '28010686', '2014-11-07 11:08:17', null);
INSERT INTO op_log VALUES ('705', '28010999', '2014-11-07 11:08:27', null);
INSERT INTO op_log VALUES ('706', '28011450', '2014-11-07 11:08:36', null);
INSERT INTO op_log VALUES ('707', '28004037', '2014-11-07 11:09:26', null);
INSERT INTO op_log VALUES ('708', '28004031', '2014-11-07 11:09:41', null);
INSERT INTO op_log VALUES ('709', '28004033', '2014-11-07 11:09:49', null);
INSERT INTO op_log VALUES ('710', '28009160', '2014-11-07 11:14:55', null);
INSERT INTO op_log VALUES ('712', '28009160', '2014-11-07 11:24:49', null);
INSERT INTO op_log VALUES ('713', '28003918', '2014-11-07 11:29:39', null);
INSERT INTO op_log VALUES ('714', '28011446', '2014-11-07 11:36:55', null);
INSERT INTO op_log VALUES ('715', '28011446', '2014-11-07 11:46:39', null);
INSERT INTO op_log VALUES ('716', '28011446', '2014-11-07 11:51:14', null);
INSERT INTO op_log VALUES ('717', '28003903', '2014-11-07 11:58:07', null);
INSERT INTO op_log VALUES ('718', '28003903', '2014-11-07 12:01:55', null);
INSERT INTO op_log VALUES ('719', '28003903', '2014-11-07 12:24:24', null);
INSERT INTO op_log VALUES ('720', '28003903', '2014-11-07 12:28:19', null);
INSERT INTO op_log VALUES ('721', '28003904', '2014-11-07 12:29:01', null);
INSERT INTO op_log VALUES ('722', '28003903', '2014-11-07 12:30:12', null);
INSERT INTO op_log VALUES ('723', '28004044', '2014-11-07 13:45:15', null);
INSERT INTO op_log VALUES ('724', '28004034', '2014-11-07 13:47:58', null);
INSERT INTO op_log VALUES ('725', '28003925', '2014-11-07 14:02:25', null);
INSERT INTO op_log VALUES ('726', '28009160', '2014-11-07 14:52:29', null);
INSERT INTO op_log VALUES ('727', '28004037', '2014-11-07 14:55:02', null);
INSERT INTO op_log VALUES ('728', '28010999', '2014-11-07 15:15:38', null);
INSERT INTO op_log VALUES ('729', '28010366', '2014-11-07 15:16:38', null);
INSERT INTO op_log VALUES ('730', '28009160', '2014-11-07 15:17:30', null);
INSERT INTO op_log VALUES ('731', '28004027', '2014-11-07 15:17:53', null);
INSERT INTO op_log VALUES ('732', '28010686', '2014-11-07 15:18:17', null);
INSERT INTO op_log VALUES ('733', '28009631', '2014-11-07 15:19:11', null);
INSERT INTO op_log VALUES ('734', '28004034', '2014-11-07 15:19:54', null);
INSERT INTO op_log VALUES ('735', '28004044', '2014-11-07 15:20:59', null);
INSERT INTO op_log VALUES ('736', '28004034', '2014-11-07 15:21:37', null);
INSERT INTO op_log VALUES ('737', '28010686', '2014-11-07 15:21:47', null);
INSERT INTO op_log VALUES ('738', '28004027', '2014-11-07 15:22:00', null);
INSERT INTO op_log VALUES ('739', '28009631', '2014-11-07 15:22:16', null);
INSERT INTO op_log VALUES ('740', '28010999', '2014-11-07 15:22:35', null);
INSERT INTO op_log VALUES ('741', '28004043', '2014-11-07 15:23:12', null);
INSERT INTO op_log VALUES ('742', '28004037', '2014-11-07 15:23:29', null);
INSERT INTO op_log VALUES ('743', '28010366', '2014-11-07 15:23:38', null);
INSERT INTO op_log VALUES ('744', '28011450', '2014-11-07 15:23:51', null);
INSERT INTO op_log VALUES ('745', '28009160', '2014-11-07 15:24:23', null);
INSERT INTO op_log VALUES ('746', '28009160', '2014-11-07 15:24:33', null);
INSERT INTO op_log VALUES ('747', '28011450', '2014-11-07 15:25:03', null);
INSERT INTO op_log VALUES ('748', '28003914', '2014-11-07 15:25:18', null);
INSERT INTO op_log VALUES ('750', '28003914', '2014-11-07 15:29:13', null);
INSERT INTO op_log VALUES ('751', '28003915', '2014-11-07 16:24:01', null);
INSERT INTO op_log VALUES ('753', '28003914', '2014-11-07 16:30:40', null);
INSERT INTO op_log VALUES ('755', '28003914', '2014-11-07 16:34:41', null);
INSERT INTO op_log VALUES ('756', '28003914', '2014-11-07 16:37:24', null);
INSERT INTO op_log VALUES ('757', '28003913', '2014-11-07 16:39:35', null);
INSERT INTO op_log VALUES ('758', '28011639', '2014-11-07 16:42:42', null);
INSERT INTO op_log VALUES ('759', '28012017', '2014-11-07 16:43:52', null);
INSERT INTO op_log VALUES ('761', '28011639', '2014-11-07 16:46:19', null);
INSERT INTO op_log VALUES ('763', '28003944', '2014-11-07 16:47:11', null);
INSERT INTO op_log VALUES ('764', '10000004', '2014-11-07 16:49:22', null);
INSERT INTO op_log VALUES ('765', '28011639', '2014-11-07 16:56:32', null);
INSERT INTO op_log VALUES ('766', '28003932', '2014-11-07 17:01:29', null);
INSERT INTO op_log VALUES ('768', '28003919', '2014-11-07 17:11:57', null);
INSERT INTO op_log VALUES ('769', '28003909', '2014-11-07 17:13:58', null);
INSERT INTO op_log VALUES ('773', '28003913', '2014-11-07 17:24:23', null);
INSERT INTO op_log VALUES ('774', '28005808', '2014-11-07 17:26:46', null);
INSERT INTO op_log VALUES ('775', '28006504', '2014-11-07 17:29:12', null);
INSERT INTO op_log VALUES ('776', '28003925', '2014-11-07 17:29:30', null);
INSERT INTO op_log VALUES ('781', '28003903', '2014-11-07 17:40:30', null);
INSERT INTO op_log VALUES ('779', '28003904', '2014-11-07 17:36:26', null);
INSERT INTO op_log VALUES ('780', '28003904', '2014-11-07 17:38:45', null);
INSERT INTO op_log VALUES ('782', '28005807', '2014-11-07 17:50:21', null);
INSERT INTO op_log VALUES ('783', '28003925', '2014-11-07 17:59:17', null);
INSERT INTO op_log VALUES ('784', '28011639', '2014-11-07 18:04:59', null);
INSERT INTO op_log VALUES ('785', '28006504', '2014-11-07 18:07:04', null);
INSERT INTO op_log VALUES ('787', '28003921', '2014-11-07 18:21:47', null);
INSERT INTO op_log VALUES ('788', '28003939', '2014-11-07 18:48:20', null);
INSERT INTO op_log VALUES ('789', '28003942', '2014-11-07 18:57:47', null);
INSERT INTO op_log VALUES ('790', '28003956', '2014-11-07 19:29:12', null);
INSERT INTO op_log VALUES ('791', '28003956', '2014-11-07 19:32:36', null);
INSERT INTO op_log VALUES ('792', '28003955', '2014-11-07 19:40:53', null);
INSERT INTO op_log VALUES ('793', '10000003', '2014-11-07 19:48:06', null);
INSERT INTO op_log VALUES ('794', '28003956', '2014-11-07 19:53:36', null);
INSERT INTO op_log VALUES ('795', '28003955', '2014-11-07 19:57:15', null);
INSERT INTO op_log VALUES ('796', '10000001', '2014-11-07 20:05:58', null);
INSERT INTO op_log VALUES ('797', '10000005', '2014-11-07 20:14:10', null);
INSERT INTO op_log VALUES ('798', '28003939', '2014-11-07 20:27:55', null);
INSERT INTO op_log VALUES ('799', '10000005', '2014-11-07 20:29:13', null);
INSERT INTO op_log VALUES ('800', '28003937', '2014-11-07 20:36:49', null);
INSERT INTO op_log VALUES ('801', '28003904', '2014-11-07 20:39:00', null);
INSERT INTO op_log VALUES ('802', '28003937', '2014-11-07 20:45:38', null);
INSERT INTO op_log VALUES ('803', '28003937', '2014-11-07 20:49:35', null);
INSERT INTO op_log VALUES ('804', '28010002', '2014-11-07 22:12:26', null);
INSERT INTO op_log VALUES ('805', '28009162', '2014-11-07 22:50:52', null);
INSERT INTO op_log VALUES ('806', '28003904', '2014-11-07 23:55:16', null);

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
  `costcenterid` varchar(255) NOT NULL DEFAULT '0',
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
) ENGINE=MyISAM AUTO_INCREMENT=100884 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of op_staffinfo
-- ----------------------------
INSERT INTO op_staffinfo VALUES ('100869', '28011001', '谭旭', '5', '18284583181', 'CD01L100', '2014-06-23', '3', '65', 'logistical.cfxas-cd@faureciaxyang.com', '2014-11-03 17:08:56', '0', '0', '0', '0');
INSERT INTO op_staffinfo VALUES ('100868', '28010999', '钟磊', '5', '15008253670', 'CD01L100', '2014-06-17', '3', '64', 'logistical.cfxas-cd@faureciaxyang.com', '2014-11-03 17:08:20', '0', '0', '0', '0');
INSERT INTO op_staffinfo VALUES ('100867', '28010686', '陈波', '5', '13880608089', 'CD01L100', '2014-06-03', '3', '63', 'logistical.cfxas-cd@faureciaxyang.com', '2014-11-03 17:07:55', '0', '2', '0', '0');
INSERT INTO op_staffinfo VALUES ('100866', '28010370', '张淼', '5', '13550245225', 'CD01L100', '2014-05-05', '3', '62', 'miao.zhang@faureciaxyang.com', '2014-11-03 17:07:34', '0', '0.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100865', '28010368', '杨宗刚', '5', '13551897924', 'CD01L100', '2014-04-21', '3', '61', 'logistical.cfxas-cd@faureciaxyang.com', '2014-11-03 17:07:14', '0', '1.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100864', '28010366', '郭会', '5', '18382058189', 'CD01L100', '2014-04-18', '3', '60', 'logistical.cfxas-cd@faureciaxyang.com', '2014-11-03 17:06:50', '0', '1', '0', '0');
INSERT INTO op_staffinfo VALUES ('100863', '28010007', '刘鸿', '5', '13688144086', 'CD01L100', '2014-04-03', '3', '32', 'logistical.cfxas-cd@faureciaxyang.com', '2014-10-24 10:33:00', '0', '2', '0', '0');
INSERT INTO op_staffinfo VALUES ('100862', '28009631', '袁宴平', '5', '13558894347', 'CD01L100', '2014-02-17', '3', '58', 'logistical.cfxas-cd@faureciaxyang.com', '2014-11-03 17:05:49', '0', '4', '0', '0');
INSERT INTO op_staffinfo VALUES ('100861', '28009394', '董千亮', '5', '15828417821', 'CD01L100', '2014-02-12', '3', '57', 'logistical.cfxas-cd@faureciaxyang.com', '2014-11-03 17:05:21', '0', '4', '0', '0');
INSERT INTO op_staffinfo VALUES ('100860', '28009393', '王鹏', '5', '15390441975', 'CD01L100', '2014-02-12', '3', '56', 'logistical.cfxas-cd@faureciaxyang.com', '2014-11-03 17:04:45', '0', '4', '0', '0');
INSERT INTO op_staffinfo VALUES ('100859', '28009160', '李放', '5', '18583223080', 'CD01L100', '2014-01-03', '3', '55', 'logistical.cfxas-cd@faureciaxyang.com', '2014-11-07 11:13:44', '0', '-0.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100858', '28005885', '黄远涛', '5', '18380238923', 'CD01L100', '2013-07-12', '3', '54', 'logistical.cfxas-cd@faureciaxyang.com', '2014-11-03 17:03:51', '0', '1.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100857', '28005814', '匡廷军', '5', '15520463684', 'CD01L100', '2013-06-27', '3', '53', 'logistical.cfxas-cd@faureciaxyang.com', '2014-11-03 17:03:06', '0', '0', '0', '0');
INSERT INTO op_staffinfo VALUES ('100856', '28004046', '熊益强', '5', '15528159558', 'CD01L100', '2013-04-23', '3', '52', 'logistical.cfxas-cd@faureciaxyang.com', '2014-11-03 17:00:59', '0', '1.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100855', '28004044', '林建', '5', '15982893659', 'CD01L100', '2013-04-15', '3', '51', 'logistical.cfxas-cd@faureciaxyang.com', '2014-11-03 17:00:39', '0', '-1.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100854', '28004043', '吕家元', '5', '18380496726', 'CD01L100', '2013-03-20', '3', '50', 'logistical.cfxas-cd@faureciaxyang.com', '2014-11-03 17:00:05', '0', '0', '0', '0');
INSERT INTO op_staffinfo VALUES ('100853', '28004037', '尹周东', '5', '18202828746', 'CD01L100', '2013-02-19', '3', '31', 'logistical.cfxas-cd@faureciaxyang.com', '2014-10-24 10:32:24', '0', '2', '0', '0');
INSERT INTO op_staffinfo VALUES ('100852', '28004035', '王实', '5', '15680691988 ', 'CD01L100', '2013-01-02', '3', '49', 'logistical.cfxas-cd@faureciaxyang.com', '2014-11-03 16:59:42', '0', '0', '0', '0');
INSERT INTO op_staffinfo VALUES ('100851', '28004034', '郭小林', '5', '18215671018', 'CD01L100', '2012-07-03', '3', '48', 'logistical.cfxas-cd@faureciaxyang.com', '2014-11-03 16:56:52', '0', '1.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100850', '28004033', '叶桂忠', '5', '13693447456', 'CD01L100', '2012-05-28', '3', '36', 'logistical.cfxas-cd@faureciaxyang.com', '2014-10-24 10:31:35', '0', '4.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100849', '28004031', '李华', '5', '15982083578', 'CD01L100', '2012-05-24', '3', '20', 'logistical.cfxas-cd@faureciaxyang.com', '2014-10-24 10:31:22', '0', '0', '0', '0');
INSERT INTO op_staffinfo VALUES ('100848', '28004027', '曾凯', '5', '15828686812', 'CD01L100', '2012-04-25', '3', '47', 'logistical.cfxas-cd@faureciaxyang.com', '2014-11-03 16:56:28', '0', '1', '0', '0');
INSERT INTO op_staffinfo VALUES ('100847', '28011450', '韩翔', '5', '18200385477', 'CD01L100', '2014-08-04', '3', '67', 'logistical.cfxas-cd@faureciaxyang.com', '2014-11-03 17:10:01', '0', '0.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100846', '28004024', '黄永灵', '5', '15282396513', 'CD01L100', '2012-11-08', '3', '46', 'logistical.cfxas-cd@faureciaxyang.com', '2014-11-03 16:55:56', '0', '0', '0', '0');
INSERT INTO op_staffinfo VALUES ('100845', '28009632', '张莉', '5', '13550216512', 'CD01L100', '2014-03-10', '3', '59', 'bely.zhang@faureciaxuyang.com', '2014-11-03 17:06:29', '0', '1.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100844', '28004026', '吴芑欣', '5', '13648047237', 'CD01L100', '2011-12-14', '7', '1', 'star.wu@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '9.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100843', '28010002', '崔韬', '5', '18581858587', 'CD01L100', '2014-04-11', '3', '33', 'sam.cui@faureciaxuyang.com', '2014-10-24 11:22:12', '0', '10', '0', '0');
INSERT INTO op_staffinfo VALUES ('100842', '28004021', '李勇', '5', '18502866697', 'CD01L100', '2012-09-21', '3', '34', 'leo.li@faureciaxuyagn.com', '2014-10-24 11:21:58', '0', '8.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100841', '28011639', '孙铖', '5', '18828076656', 'CD01L100', '2014-09-01', '7', '1', 'charles.sun@faureciaxuyang.com', '2014-11-07 17:22:25', '0', '5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100840', '28004019', '李国琴', '5', '13488978182', 'CD01L100', '2011-04-12', '7', '1', 'guoqin.li@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '8', '0', '0');
INSERT INTO op_staffinfo VALUES ('100839', '28004018', '唐茂蔷', '5', '18227664679', 'CD01L100', '2011-10-09', '4', '1', 'carol.tang@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '11', '0', '0');
INSERT INTO op_staffinfo VALUES ('100838', '33333333', '彭闵扬', '1', '13880927995', 'CD011001', '2014-09-17', '3', '71', 'rui.wang@faureciaxuyang.com', '2014-11-05 16:27:47', '0', '0.5', '0', '-70.5');
INSERT INTO op_staffinfo VALUES ('100837', '28011638', '曾创', '1', '13608171784', 'CD011001', '2014-09-12', '1', '8', 'dong.yu@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '0.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100836', '28011637', '李明洋', '1', '18280136602', 'CD011001', '2014-09-11', '1', '8', 'dong.yu@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '0.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100874', '10000001', 'wudailiang', '1', '', 'CD010001', null, '3', '38', 'dailiang.wu@faurecixuyang.com', '2014-10-31 14:20:57', '0', '0', '0', '0');
INSERT INTO op_staffinfo VALUES ('100834', '28010685', '周晓杰', '1', '15884444034', 'CD011001', '2014-05-15', '1', '42', 'bowb.wang@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '2.8', '0', '0');
INSERT INTO op_staffinfo VALUES ('100833', '28010365', '岳康', '1', '18383526807', 'CD011001', '2014-05-15', '1', '5', 'yuejun.zeng@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '0.3', '0', '0');
INSERT INTO op_staffinfo VALUES ('100832', '28010364', '李海涛', '1', '18628294352', 'CD011001', '2014-05-09', '1', '7', 'tanglin.she@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '-0.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100831', '28010363', '钟武', '1', '18583676975', 'CD011001', '2014-05-02', '1', '2', 'dailiang.wu@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '1', '0', '0');
INSERT INTO op_staffinfo VALUES ('100830', '28010008', '曾云', '1', '18349121090', 'CD011001', '2014-04-03', '1', '6', 'bowb.wang@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '4', '0', '0');
INSERT INTO op_staffinfo VALUES ('100829', '28010005', '刘伟', '1', '15882005705', 'CD011001', '2014-03-31', '1', '43', 'tanglin.she@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '1', '0', '0');
INSERT INTO op_staffinfo VALUES ('100828', '28010004', '陈文刚', '1', '13540004149', 'CD011001', '2014-03-31', '1', '45', 'rui.wang@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '4', '0', '0');
INSERT INTO op_staffinfo VALUES ('100827', '28010003', '叶波', '1', '13648063529', 'CD011001', '2014-03-31', '1', '9', 'rui.wang@faureciaxuyang.com', '2014-11-05 16:23:07', '0', '4', '0', '-70.5');
INSERT INTO op_staffinfo VALUES ('100826', '28009627', '何运江', '1', '18382319606', 'CD011001', '2014-03-12', '1', '8', 'dong.yu@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '5.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100825', '28009626', '李林锋', '1', '18086803858', 'CD011001', '2014-03-12', '1', '39', 'xiaojie.zhang@faureciaxuyang.com', '2014-11-04 14:10:37', '0', '4.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100824', '28009625', '胡仲廉', '1', '18349333872', 'CD011001', '2014-02-19', '1', '5', 'rui.wang@faureciaxuyang.com', '2014-11-05 16:22:13', '0', '2', '0', '-39.5');
INSERT INTO op_staffinfo VALUES ('100823', '28009624', '肖强', '1', '13408576017', 'CD011001', '2014-02-19', '1', '38', 'dailiang.wu@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '4.2', '0', '0');
INSERT INTO op_staffinfo VALUES ('100822', '28009623', '向申奇', '1', '13982053224', 'CD011001', '2014-02-19', '1', '6', 'bowb.wang@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '5.2', '0', '0');
INSERT INTO op_staffinfo VALUES ('100821', '28003979', '鲁亿', '1', '13067514986', 'CD011001', '2014-02-17', '1', '43', 'tanglin.she@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '3.2', '0', '0');
INSERT INTO op_staffinfo VALUES ('100820', '28009620', '林忠智', '1', '13558603987', 'CD011001', '2014-02-17', '1', '7', 'tanglin.she@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '1.2', '0', '0');
INSERT INTO op_staffinfo VALUES ('100819', '28009619', '张廷清', '1', '13548067518', 'CD011001', '2014-02-17', '1', '2', 'dailiang.wu@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '3.2', '0', '0');
INSERT INTO op_staffinfo VALUES ('100818', '28009391', '王任超', '1', '13699057019', 'CD011001', '2014-02-14', '1', '8', 'dong.yu@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '3.3', '0', '0');
INSERT INTO op_staffinfo VALUES ('100817', '28009389', '杨鹏2', '1', '18382361567', 'CD011001', '2014-02-12', '1', '45', 'rui.wang@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '6.3', '0', '0');
INSERT INTO op_staffinfo VALUES ('100816', '28009388', '杨鹏1', '1', '18782012319', 'CD011001', '2014-02-12', '1', '6', 'bowb.wang@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '2.3', '0', '0');
INSERT INTO op_staffinfo VALUES ('100815', '28009387', '刘应平', '1', '13881842753', 'CD011001', '2014-02-12', '1', '44', 'dong.yu@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '3.3', '0', '0');
INSERT INTO op_staffinfo VALUES ('100814', '28009386', '税杰', '1', '15308239181', 'CD011001', '2014-02-12', '1', '40', 'lin.qiu@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '4.3', '0', '0');
INSERT INTO op_staffinfo VALUES ('100813', '28009385', '杨先港', '1', '18380138361', 'CD011001', '2014-02-12', '1', '44', 'dong.yu@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '0.8', '0', '0');
INSERT INTO op_staffinfo VALUES ('100812', '28009384', '钟鹏', '1', '18382343540', 'CD011001', '2014-02-12', '1', '4', 'lin.qiu@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '3.3', '0', '0');
INSERT INTO op_staffinfo VALUES ('100811', '28009382', '代永强', '1', '13540475789', 'CD011001', '2014-02-12', '1', '3', 'xiaojie.zhang@faureciaxuyang.com', '2014-11-04 14:08:27', '0', '2', '0', '0');
INSERT INTO op_staffinfo VALUES ('100810', '28006172', '付勇', '1', '18000519876', 'CD011001', '2013-08-16', '1', '4', 'lin.qiu@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '-1.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100809', '28006120', '史本军', '1', '18782206710', 'CD011001', '2013-07-27', '1', '3', 'xiaojie.zhang@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '1', '0', '0');
INSERT INTO op_staffinfo VALUES ('100808', '28006119', '陈鹏', '1', '18215669534', 'CD011001', '2013-07-25', '1', '9', 'rui.wang@faureciaxuyang.com', '2014-11-05 16:21:17', '0', '0.5', '0', '-70.5');
INSERT INTO op_staffinfo VALUES ('100807', '28005883', '周龙剑', '1', '13880640453', 'CD011001', '2013-07-10', '1', '2', 'dailiang.wu@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '1.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100806', '28005809', '邹勋', '1', '13548003296', 'CD011001', '2013-06-25', '1', '38', 'dailiang.wu@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '3.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100805', '28005663', '伍少银', '1', '15882392035', 'CD011001', '2013-06-14', '1', '3', 'xiaojie.zhang@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '2.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100803', '28005651', '张彬', '1', '13458649297', 'CD011001', '2013-05-16', '3', '37', 'peng.lei@faureciaxuyang.com', '2014-10-24 11:20:01', '0', '3', '0', '0');
INSERT INTO op_staffinfo VALUES ('100804', '28005652', '江坤', '1', '13981835756', 'CD011001', '2013-05-22', '1', '6', 'bowb.wang@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '1.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100802', '28004010', '杨军', '1', '13880921785', 'CD011001', '2013-04-16', '1', '43', 'tanglin.she@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '6.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100801', '28004009', '张兴', '1', '13882231440', 'CD011001', '2013-04-07', '1', '41', 'yuejun.zeng@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '0.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100800', '28004006', '张建书', '1', '13408496317', 'CD011001', '2013-03-04', '1', '40', 'lin.qiu@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '1.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100799', '28003998', '李志航', '1', '15008224476', 'CD011001', '2013-02-19', '1', '45', 'rui.wang@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '4.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100798', '28003997', '张杨', '1', '15828590960', 'CD011001', '2013-02-19', '1', '8', 'dong.yu@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '1.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100797', '28003994', '黄波', '1', '13881457904', 'CD011001', '2012-11-09', '1', '44', 'dong.yu@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '2.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100796', '28003993', '戴小惠', '1', '13548053997', 'CD011001', '2012-11-01', '1', '41', 'yuejun.zeng@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '2', '0', '0');
INSERT INTO op_staffinfo VALUES ('100795', '28003991', '吴越', '1', '13666199481', 'CD011001', '2012-09-11', '1', '45', 'rui.wang@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '1', '0', '0');
INSERT INTO op_staffinfo VALUES ('100794', '28003990', '李东', '1', '13608069231', 'CD011001', '2012-09-05', '1', '2', 'dailiang.wu@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '2.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100793', '28003988', '李梦成', '1', '15928731732', 'CD011001', '2012-08-30', '1', '44', 'dong.yu@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '1.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100792', '28003985', '陈亮', '1', '13880383617', 'CD011001', '2012-07-06', '3', '21', 'xiaojie.zhang@faureciaxuyang.com', '2014-10-24 11:16:24', '0', '-0.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100791', '28003984', '苟红', '1', '15908114253', 'CD011001', '2012-07-06', '1', '8', 'bowb.wang@faureciaxuyang.com', '2014-10-31 13:49:37', '0', '2.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100790', '28003983', '黄凯旋', '1', '15982112257', 'CD011001', '2012-07-05', '3', '25', 'dong.yu@faureciaxuyang.com', '2014-10-31 13:52:46', '0', '3', '0', '0');
INSERT INTO op_staffinfo VALUES ('100789', '28003973', '黄应彬', '1', '13618030206', 'CD011001', '2012-06-18', '1', '9', 'rui.wang@faureciaxuyang.com', '2014-11-05 16:20:01', '0', '2.5', '0', '-70.5');
INSERT INTO op_staffinfo VALUES ('100788', '28003971', '袁庭鹏', '1', '18215534445', 'CD011001', '2012-06-08', '1', '4', 'lin.qiu@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '2', '0', '0');
INSERT INTO op_staffinfo VALUES ('100787', '28003965', '宋昌建\r\n', '1', '13547993945', 'CD011001', '2012-05-02', '1', '40', 'lin.qiu@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '3.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100786', '28003964', '文强兵', '1', '15202848747', 'CD011001', '2012-05-02', '1', '5', 'yuejun.zeng@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '4.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100785', '28003962', '谢友康', '1', '18780050920', 'CD011001', '2012-05-02', '1', '6', 'bowb.wang@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '4.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100784', '28003961', '钟超', '1', '15198023770', 'CD011001', '2012-04-24', '1', '7', 'tanglin.she@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '3.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100783', '28003960', '何彬', '1', '13558815943', 'CD011001', '2012-04-19', '1', '3', 'xiaojie.zhang@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '1.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100782', '28011449', '杨鹏3', '1', '13551895172', 'CD011001', '2014-08-04', '1', '42', 'bowb.wang@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '1.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100781', '28003957', '佘唐林', '1', '15208396360', 'CD011001', '2012-04-11', '3', '7', 'tanglin.she@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '4.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100780', '28003952', '赖首君', '1', '15182205503', 'CD011001', '2012-03-05', '1', '9', 'rui.wang@faureciaxuyang.com', '2014-11-05 16:19:11', '0', '2.5', '0', '-70.5');
INSERT INTO op_staffinfo VALUES ('100779', '28003945', '徐兴意', '1', '18782213642', 'CD011001', '2011-12-26', '1', '7', 'tanglin.she@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '2', '0', '0');
INSERT INTO op_staffinfo VALUES ('100778', '28003956', '邱林', '1', '18008010455', 'CD011001', '2012-04-09', '3', '4', 'lin.qiu@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100777', '28003989', '冯富鑫', '9', '15948797553', 'CD011001', '2012-09-03', '7', '1', 'fuxin.feng@faureciaxuyang.com', '2014-10-31 13:57:04', '0', '6', '0', '-39.5');
INSERT INTO op_staffinfo VALUES ('100776', '28003955', '吴代亮', '1', '18208118356', 'CD011001', '2012-03-27', '3', '2', 'dailiang.wu@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '2.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100775', '28003970', '谢发东', '1', '13648074907', 'CD011001', '2012-06-07', '1', '39', 'xiaojie.zhang@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '-2.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100774', '28003969', '周陈东', '1', '13882097462', 'CD011001', '2012-05-31', '1', '41', 'yuejun.zeng@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '2.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100773', '28003951', '余东', '1', '13281222153', 'CD011001', '2012-03-05', '3', '8', 'dong.yu@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '5.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100772', '28003946', '高锐', '1', '14780131873', 'CD011001', '2012-02-02', '3', '22', 'rui.gao@faureciaxuyang.com', '2014-10-24 11:17:16', '0', '2', '0', '0');
INSERT INTO op_staffinfo VALUES ('100771', '28003944', '曾跃俊', '1', '13982099396', 'CD011001', '2011-12-26', '3', '5', 'yuejun.zeng@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '-2', '0', '0');
INSERT INTO op_staffinfo VALUES ('100770', '28003942', '李浩', '1', '13709047854', 'CD011001', '2011-11-01', '3', '42', 'hao.li@faureciaxuyang.com', '2014-10-24 11:18:06', '0', '4.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100582', '10000000', '超级管理员', '2', '', '0', null, '6', '1', '', '2014-10-10 12:26:17', '0', '0', '0', '0');
INSERT INTO op_staffinfo VALUES ('100768', '28003940', '王锐', '1', '13330963820', 'CD011001', '2011-11-01', '3', '9', 'rui.wang@faureciaxuyang.com', '2014-11-05 16:17:44', '0', '-1', '0', '-144.5');
INSERT INTO op_staffinfo VALUES ('100769', '28003941', '张小杰', '1', '18702832785', 'CD011001', '2011-11-01', '3', '3', 'xiaojie.zhang@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '-0.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100767', '28003939', '王波', '1', '18010556829', 'CD011001', '2011-02-20', '3', '6', 'bowb.wang@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '-0.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100763', '28003934', '施恂义', '1', '13917610267', 'CD011001', '2012-06-27', '4', '1', 'xunyi.shi@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '8', '0', '0');
INSERT INTO op_staffinfo VALUES ('100764', '28003935', '陈彪', '1', '13660363699', 'CD011001', '2012-09-03', '3', '26', 'biao.chen@faureciaxuyang.com', '2014-10-24 11:20:40', '0', '11.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100765', '28003937', '刘杰', '1', '15208247287', 'CD011001', '2010-09-01', '3', '28', 'jie.liu@faureciaxuyang.com', '2014-10-24 11:21:38', '0', '14', '0', '93');
INSERT INTO op_staffinfo VALUES ('100766', '28003938', '彭万良', '1', '18349199369', 'CD011001', '2013-04-01', '3', '27', 'wanliang.peng@faureciaxuyang.com', '2014-10-24 11:21:02', '0', '12', '0', '94.5');
INSERT INTO op_staffinfo VALUES ('100762', '28009633', '张波', '6', '15982167753', 'CD01E001', '2014-03-04', '7', '1', 'jacky.zhang@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '7.5', '0', '4.5');
INSERT INTO op_staffinfo VALUES ('100761', '28009162', '王荣', '6', '18030501660', 'CD01E001', '2014-01-14', '3', '11', 'rong.wang@faureciaxuyang.com', '2014-11-06 15:47:49', '0', '0.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100760', '28005808', '彭传刚', '6', '15928688317', 'CD01E001', '2013-07-01', '3', '12', 'chuangang.peng@faureciaxuyang.com', '2014-11-06 15:47:29', '0', '2.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100759', '28003932', '雷鹏', '6', '15982027247', 'CD01E001', '2011-08-25', '3', '10', 'peng.lei@faureciaxuyang.com', '2014-11-06 15:47:12', '0', '3.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100758', '28003931', '潘挺', '6', '13693499379', 'CD01E001', '2012-02-01', '7', '1', 'ting.pan@faureciaxuayng.com', '2014-10-22 16:11:33', '0', '11', '0', '8.5');
INSERT INTO op_staffinfo VALUES ('100757', '28003930', '王林', '6', '13882029775', 'CD01E001', '2012-02-01', '7', '1', 'tiger.wang@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '14', '0', '40.5');
INSERT INTO op_staffinfo VALUES ('100756', '28003928', '王彦奎', '6', '18780227387', 'CD01E001', '2010-07-01', '7', '1', 'yankui.wang@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '14', '0', '12.5');
INSERT INTO op_staffinfo VALUES ('100755', '28003927', '杨爱民', '6', '18981956193', 'CD01E001', '2012-12-10', '4', '1', 'harry.yang@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '10', '0', '0');
INSERT INTO op_staffinfo VALUES ('100754', '28005807', '方超', '4', '13348916512', 'CD01Q001', '2013-07-04', '3', '15', 'fulai.huang@faureciaxuyang.com', '2014-11-06 15:49:46', '0', '0.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100753', '28006504', '赵毅', '4', '13880236563', 'CD01Q001', '2013-10-14', '3', '16', 'yi.zhao@faureciaxuyang.com', '2014-11-06 17:36:56', '0', '4.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100752', '28003925', '曾亮', '4', '13551351033', 'CD01Q001', '2011-11-01', '3', '14', 'liang.zeng@faureciaxuyang.com', '2014-11-06 15:48:27', '0', '-0.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100751', '28011446', '封永川', '4', '15882071568', 'CD01Q001', '2014-08-04', '3', '17', 'yongchuan.feng@faureciaxuyang.com', '2014-11-07 11:05:58', '0', '4', '0', '0');
INSERT INTO op_staffinfo VALUES ('100750', '28003924', '舒娟', '4', '13648095760', 'CD01Q001', '2012-01-29', '7', '1', 'sucy.shu@faureciaxuyang.com', '2014-10-24 09:57:49', '0', '-2', '0', '-80');
INSERT INTO op_staffinfo VALUES ('100749', '28003921', '黄付来', '4', '13018275637', 'CD01Q001', '2011-04-01', '3', '13', 'fulai.huang@faureciaxuyang.com', '2014-11-06 15:48:11', '0', '5.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100748', '28003920', '付全柏', '4', '15228798071', 'CD01Q001', '2013-04-01', '7', '1', 'jerry.fu@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '9.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100747', '28003919', '江利桃', '4', '15828194009', 'CD01Q001', '2011-07-11', '7', '1', 'jason.jiang@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '7', '0', '0');
INSERT INTO op_staffinfo VALUES ('100746', '28003918', '彭世文', '4', '13688364770', 'CD01Q001', '2011-07-11', '7', '1', 'shiwen.peng@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '-1.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100745', '28003917', '刘铁柱', '4', '18615767060', 'CD01Q001', '2010-08-21', '4', '1', 'tim.liu@faureciaxuyang.com', '2014-10-30 13:21:13', '0', '1', '0', '-8.5');
INSERT INTO op_staffinfo VALUES ('100744', '28003915', '吴锋', '3', '13540640511', 'CD01F001', '2011-04-15', '7', '1', 'clint.wu@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '6.5', '0', '59');
INSERT INTO op_staffinfo VALUES ('100743', '28003914', '杨华溢', '3', '13548155207', 'CD01F002', '2011-07-28', '7', '1', 'huayi.yang@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '0', '0', '16.5');
INSERT INTO op_staffinfo VALUES ('100742', '28003913', '葛振芳', '3', '15102830776', 'CD01F001', '2012-07-16', '7', '1', 'vivi.ge@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '6', '0', '-4');
INSERT INTO op_staffinfo VALUES ('100741', '28003912', '欧阳百贺', '3', '13882565165', 'CD01F001', '2011-09-21', '4', '1', 'rick.ouyang@faureciaxuyang.com', '2014-10-22 20:32:16', '0', '10', '0', '0');
INSERT INTO op_staffinfo VALUES ('100740', '28010001', '王鑫薷', '2', '18200435966', 'CD01H001', '2014-03-24', '7', '1', 'sarah.wang@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '6.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100739', '28010009', '张薇', '2', '18682559769', 'CD01H001', '2013-10-21', '7', '1', 'Receptionist.CFXAS-CD@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '9', '0', '0');
INSERT INTO op_staffinfo VALUES ('100738', '28003911', '罗琪', '2', '18381078870', 'CD01H001', '2012-12-11', '7', '1', 'letty.luo@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '-2.5', '0', '3');
INSERT INTO op_staffinfo VALUES ('100737', '28003909', '朱品容', '2', '15108420372', 'CD01H001', '2012-04-23', '7', '1', 'gillian.zhu@faureciaxuyang.com', '2014-10-22 17:50:04', '0', '-18', '0', '17');
INSERT INTO op_staffinfo VALUES ('100736', '28003907', '王晶', '2', '18628071776', 'CD01H001', '2011-07-11', '7', '1', 'jamie.wang@faureciaxuyang.com', '2014-11-07 11:17:19', '0', '-1', '0', '0');
INSERT INTO op_staffinfo VALUES ('100735', '28003906', '邓飞', '7', '13880351137', 'CD01P001', '2011-11-02', '7', '1', 'fei.deng@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '1.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100734', '28006173', '付伟', '7', '15228840363', 'CD01A002', '2013-07-29', '7', '1', 'raymond.fu@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '11.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100733', '28003905', '张庆', '9', '18608003951', 'CD01A001', '2011-08-05', '4', '1', 'andy.zhang@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '5.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100732', '28003904', '张建', '8', '13688078206', 'CD01S001', '2012-09-19', '3', '19', 'sales.cfxas-cd@faureciaxuyang.com', '2014-11-06 15:50:19', '0', '1', '0', '0');
INSERT INTO op_staffinfo VALUES ('100731', '28003903', '杨健', '8', '18180624000', 'CD01S001', '2012-06-14', '3', '18', 'sales.cfxas-cd@faureciaxuyang.com', '2014-11-06 15:50:36', '0', '3', '0', '0');
INSERT INTO op_staffinfo VALUES ('100730', '28003902', '沈筱', '8', '18681278979', 'CD01S001', '2012-01-03', '4', '1', 'sabrina.shen@faureciaxuyang.com', '2014-10-22 16:11:33', '0', '6', '0', '-8.5');
INSERT INTO op_staffinfo VALUES ('100729', '28003901', '李继宏', '7', '13331666018', 'CD01A001', '2006-08-22', '5', '1', 'tracy.li@faureciaxuyang.com', '2014-11-06 16:51:26', '0', '9', '0', '0');
INSERT INTO op_staffinfo VALUES ('100870', '28011002', '裴宗福', '5', '13568958425', 'CD01L100', '2014-06-23', '3', '66', 'logistical.cfxas-cd@faureciaxyang.com', '2014-11-03 17:09:40', '0', '0', '0', '0');
INSERT INTO op_staffinfo VALUES ('100871', '28011451', '卢国强', '5', '13488985953', 'CD01L100', '2014-08-08', '3', '68', 'logistical.cfxas-cd@faureciaxyang.com', '2014-11-03 17:10:25', '0', '1.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100872', '28011640', '邹建', '5', '15547990807', 'CD01L100', '2014-08-30', '3', '69', 'logistical.cfxas-cd@faureciaxyang.com', '2014-11-03 17:10:59', '0', '1', '0', '0');
INSERT INTO op_staffinfo VALUES ('100873', '44444444', '李晓伍', '5', '13547990870', 'CD01L100', '2014-09-18', '3', '70', 'logistical.cfxas-cd@faureciaxyang.com', '2014-11-03 17:11:23', '0', '0.5', '0', '0');
INSERT INTO op_staffinfo VALUES ('100875', '10000002', 'zhangxiaojie', '1', '', 'cdcdcdcd', null, '3', '39', 'xiaojie.zhang@faureciaxuyang.com', '2014-10-31 14:21:06', '0', '0', '0', '0');
INSERT INTO op_staffinfo VALUES ('100876', '10000003', 'qiulin', '1', '', 'cdcdcdcd', null, '3', '40', 'lin.qiu@faureciaxuyang.com', '2014-10-31 14:21:14', '0', '0', '0', '0');
INSERT INTO op_staffinfo VALUES ('100877', '10000004', 'zengyuejun', '1', '', 'ccdcdcdcd', null, '3', '41', 'yuejun.zeng@faureciaxuyang.com', '2014-10-31 14:21:22', '0', '0', '0', '0');
INSERT INTO op_staffinfo VALUES ('100878', '10000005', 'wangbo', '1', '', 'cdcdcdcd', null, '3', '42', 'bowb.wang@faureciaxuyang.com', '2014-10-31 14:21:30', '0', '0', '0', '0');
INSERT INTO op_staffinfo VALUES ('100879', '10000006', 'shetanglin', '1', '', 'cdcdcdcd', null, '3', '43', 'tanglin.she@faureciaxuyang.com', '2014-10-31 14:21:45', '0', '0', '0', '0');
INSERT INTO op_staffinfo VALUES ('100880', '10000007', 'yudong', '1', '', 'cdcdcd', null, '3', '44', 'dong.yu@faureciaxuyang.com', '2014-10-31 14:21:51', '0', '0', '0', '0');
INSERT INTO op_staffinfo VALUES ('100881', '10000008', 'wangrui', '1', '', 'cdcdcd', null, '3', '45', 'rui.wang@faureciaxuyang.com', '2014-10-31 14:21:59', '0', '0', '0', '0');
INSERT INTO op_staffinfo VALUES ('100882', '00000000', '刘爽', '2', '', 'CD01H001', '2014-11-12', '4', '1', 'shiree.liu@faurecixuyang.com', '2014-11-07 11:08:25', '0', '0', '0', '0');
INSERT INTO op_staffinfo VALUES ('100883', '28012017', '陈柚君', '2', '13693431023', 'CD01H001', '2014-10-08', '7', '1', 'yoyo.chen@faureciaxuyang.com', '2014-11-07 11:13:15', '0', '0', '0', '0');

-- ----------------------------
-- Table structure for `op_teaminfo`
-- ----------------------------
DROP TABLE IF EXISTS `op_teaminfo`;
CREATE TABLE `op_teaminfo` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `teamname` varchar(255) NOT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=MyISAM AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of op_teaminfo
-- ----------------------------
INSERT INTO op_teaminfo VALUES ('1', '办公室');
INSERT INTO op_teaminfo VALUES ('2', '靠背1线焊接A');
INSERT INTO op_teaminfo VALUES ('3', '靠背1线焊接B');
INSERT INTO op_teaminfo VALUES ('4', '靠背2线焊接A');
INSERT INTO op_teaminfo VALUES ('5', '靠背2线焊接B');
INSERT INTO op_teaminfo VALUES ('6', '2W座盆焊接A');
INSERT INTO op_teaminfo VALUES ('7', '2W座盆焊接B');
INSERT INTO op_teaminfo VALUES ('8', '4W座盆焊接A');
INSERT INTO op_teaminfo VALUES ('9', '4W座盆焊接B');
INSERT INTO op_teaminfo VALUES ('10', '雷鹏');
INSERT INTO op_teaminfo VALUES ('11', '王荣');
INSERT INTO op_teaminfo VALUES ('12', '彭传刚');
INSERT INTO op_teaminfo VALUES ('13', '黄付来');
INSERT INTO op_teaminfo VALUES ('14', '曾亮');
INSERT INTO op_teaminfo VALUES ('15', '方超');
INSERT INTO op_teaminfo VALUES ('16', '赵毅');
INSERT INTO op_teaminfo VALUES ('17', '封永川');
INSERT INTO op_teaminfo VALUES ('18', '杨健');
INSERT INTO op_teaminfo VALUES ('19', '张建');
INSERT INTO op_teaminfo VALUES ('20', '李华');
INSERT INTO op_teaminfo VALUES ('21', '陈亮');
INSERT INTO op_teaminfo VALUES ('22', '高锐');
INSERT INTO op_teaminfo VALUES ('24', '李浩');
INSERT INTO op_teaminfo VALUES ('25', '黄凯旋');
INSERT INTO op_teaminfo VALUES ('37', '张彬');
INSERT INTO op_teaminfo VALUES ('26', '陈彪');
INSERT INTO op_teaminfo VALUES ('27', '彭万良');
INSERT INTO op_teaminfo VALUES ('28', '刘杰');
INSERT INTO op_teaminfo VALUES ('31', '尹周东');
INSERT INTO op_teaminfo VALUES ('32', '刘鸿');
INSERT INTO op_teaminfo VALUES ('33', '崔韬');
INSERT INTO op_teaminfo VALUES ('34', '李勇');
INSERT INTO op_teaminfo VALUES ('36', '叶桂忠');
INSERT INTO op_teaminfo VALUES ('38', '靠背1线装配A');
INSERT INTO op_teaminfo VALUES ('39', '靠背1线装配B');
INSERT INTO op_teaminfo VALUES ('40', '靠背2线装配A');
INSERT INTO op_teaminfo VALUES ('41', '靠背2线装配B');
INSERT INTO op_teaminfo VALUES ('42', '2W坐盆装配A');
INSERT INTO op_teaminfo VALUES ('43', '2W坐盆装配B');
INSERT INTO op_teaminfo VALUES ('44', '4W坐盆装配A');
INSERT INTO op_teaminfo VALUES ('45', '4W坐盆装配B');
INSERT INTO op_teaminfo VALUES ('46', '黄永灵');
INSERT INTO op_teaminfo VALUES ('47', '曾凯');
INSERT INTO op_teaminfo VALUES ('48', '郭小林');
INSERT INTO op_teaminfo VALUES ('49', '王实');
INSERT INTO op_teaminfo VALUES ('50', '吕家元');
INSERT INTO op_teaminfo VALUES ('51', '林建');
INSERT INTO op_teaminfo VALUES ('52', '熊益强');
INSERT INTO op_teaminfo VALUES ('53', '匡廷军');
INSERT INTO op_teaminfo VALUES ('54', '黄远涛');
INSERT INTO op_teaminfo VALUES ('55', '李放');
INSERT INTO op_teaminfo VALUES ('56', '王鹏');
INSERT INTO op_teaminfo VALUES ('57', '董千亮');
INSERT INTO op_teaminfo VALUES ('58', '袁宴平');
INSERT INTO op_teaminfo VALUES ('59', '张莉');
INSERT INTO op_teaminfo VALUES ('60', '郭会');
INSERT INTO op_teaminfo VALUES ('61', '杨宗刚');
INSERT INTO op_teaminfo VALUES ('62', '张淼');
INSERT INTO op_teaminfo VALUES ('63', '陈波');
INSERT INTO op_teaminfo VALUES ('64', '钟磊');
INSERT INTO op_teaminfo VALUES ('65', '谭旭');
INSERT INTO op_teaminfo VALUES ('66', '裴宗福');
INSERT INTO op_teaminfo VALUES ('67', '韩翔');
INSERT INTO op_teaminfo VALUES ('68', '卢国强');
INSERT INTO op_teaminfo VALUES ('69', '邹建');
INSERT INTO op_teaminfo VALUES ('70', '李晓伍');
INSERT INTO op_teaminfo VALUES ('71', '彭闵扬');

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
) ENGINE=MyISAM AUTO_INCREMENT=11979 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of op_unusualtime
-- ----------------------------
INSERT INTO op_unusualtime VALUES ('11579', '28010686', '2014-11-07', '07:52:52', '2014-11-07', '08:00:00', '正常', '0', '0', null, '8941');
INSERT INTO op_unusualtime VALUES ('11580', '28010686', '2014-11-07', '00:00:00', '2014-11-07', '17:30:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11581', '28010366', '2014-11-07', '07:57:40', '2014-11-07', '08:00:00', '正常', '0', '0', null, '8953');
INSERT INTO op_unusualtime VALUES ('11582', '28010366', '2014-11-07', '00:00:00', '2014-11-07', '17:30:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11583', '28009631', '2014-11-07', '07:50:59', '2014-11-07', '08:00:00', '正常', '0', '0', null, '8934');
INSERT INTO op_unusualtime VALUES ('11584', '28009631', '2014-11-07', '00:00:00', '2014-11-07', '17:30:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11585', '28009160', '2014-11-07', '08:03:30', '2014-11-07', '08:00:00', '正常', '0', '0', null, '11210');
INSERT INTO op_unusualtime VALUES ('11586', '28009160', '2014-11-07', '00:00:00', '2014-11-07', '17:30:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11587', '28004037', '2014-11-07', '07:48:21', '2014-11-07', '08:00:00', '正常', '0', '0', null, '8931');
INSERT INTO op_unusualtime VALUES ('11588', '28004037', '2014-11-07', '00:00:00', '2014-11-07', '17:30:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11589', '28004034', '2014-11-07', '00:00:00', '2014-11-07', '08:00:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11590', '28004034', '2014-11-07', '00:00:00', '2014-11-07', '20:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11591', '28004027', '2014-11-07', '07:57:45', '2014-11-07', '08:00:00', '正常', '0', '0', null, '8954');
INSERT INTO op_unusualtime VALUES ('11592', '28004027', '2014-11-07', '00:00:00', '2014-11-07', '17:30:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11593', '28011450', '2014-11-07', '07:55:43', '2014-11-07', '08:00:00', '正常', '0', '0', null, '8946');
INSERT INTO op_unusualtime VALUES ('11594', '28011450', '2014-11-07', '00:00:00', '2014-11-07', '17:30:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11595', '28009632', '2014-11-01', '07:55:57', '2014-11-01', '08:00:00', '正常', '0', '0', null, '8361');
INSERT INTO op_unusualtime VALUES ('11596', '28009632', '2014-11-01', '16:31:08', '2014-11-01', '16:30:00', '正常', '1', '0', null, '8372');
INSERT INTO op_unusualtime VALUES ('11597', '28009632', '2014-11-02', '00:00:00', '2014-11-02', '08:00:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11598', '28009632', '2014-11-02', '00:00:00', '2014-11-02', '16:30:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11599', '28009632', '2014-11-03', '07:53:50', '2014-11-03', '08:00:00', '正常', '0', '0', null, '8493');
INSERT INTO op_unusualtime VALUES ('11600', '28009632', '2014-11-03', '16:36:19', '2014-11-03', '16:30:00', '正常', '1', '0', null, '8510');
INSERT INTO op_unusualtime VALUES ('11601', '28009632', '2014-11-04', '07:57:53', '2014-11-04', '08:00:00', '正常', '0', '0', null, '8615');
INSERT INTO op_unusualtime VALUES ('11602', '28009632', '2014-11-04', '16:32:33', '2014-11-04', '16:30:00', '正常', '1', '0', null, '8628');
INSERT INTO op_unusualtime VALUES ('11603', '28009632', '2014-11-05', '07:53:26', '2014-11-05', '08:00:00', '正常', '0', '0', null, '8715');
INSERT INTO op_unusualtime VALUES ('11604', '28009632', '2014-11-05', '16:37:03', '2014-11-05', '16:30:00', '正常', '1', '0', null, '8741');
INSERT INTO op_unusualtime VALUES ('11605', '28009632', '2014-11-06', '08:00:21', '2014-11-06', '08:00:00', '正常', '0', '0', null, '8844');
INSERT INTO op_unusualtime VALUES ('11606', '28009632', '2014-11-06', '16:38:48', '2014-11-06', '16:30:00', '正常', '1', '0', null, '11125');
INSERT INTO op_unusualtime VALUES ('11607', '28009632', '2014-11-07', '07:58:30', '2014-11-07', '08:00:00', '正常', '0', '0', null, '8955');
INSERT INTO op_unusualtime VALUES ('11608', '28009632', '2014-11-07', '00:00:00', '2014-11-07', '16:30:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11609', '28004026', '2014-11-03', '08:24:36', '2014-11-03', '08:30:00', '正常', '0', '0', null, '10123');
INSERT INTO op_unusualtime VALUES ('11610', '28004026', '2014-11-03', '00:00:00', '2014-11-03', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11611', '28004026', '2014-11-04', '08:26:56', '2014-11-04', '08:30:00', '正常', '0', '0', null, '10161');
INSERT INTO op_unusualtime VALUES ('11612', '28004026', '2014-11-04', '00:00:00', '2014-11-04', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11613', '28004026', '2014-11-05', '08:19:00', '2014-11-05', '08:30:00', '正常', '0', '0', null, '10203');
INSERT INTO op_unusualtime VALUES ('11614', '28004026', '2014-11-05', '18:31:10', '2014-11-05', '17:00:00', '正常', '1', '0', null, '10232');
INSERT INTO op_unusualtime VALUES ('11615', '28004026', '2014-11-06', '08:24:20', '2014-11-06', '08:30:00', '正常', '0', '0', null, '10238');
INSERT INTO op_unusualtime VALUES ('11616', '28004026', '2014-11-06', '17:40:35', '2014-11-06', '17:00:00', '正常', '1', '0', null, '10263');
INSERT INTO op_unusualtime VALUES ('11617', '28004026', '2014-11-07', '08:26:13', '2014-11-07', '08:30:00', '正常', '0', '0', null, '10282');
INSERT INTO op_unusualtime VALUES ('11618', '28004026', '2014-11-07', '00:00:00', '2014-11-07', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11619', '28004021', '2014-11-07', '08:36:15', '2014-11-07', '08:00:00', '迟到', '0', '0', null, '8971');
INSERT INTO op_unusualtime VALUES ('11620', '28004021', '2014-11-07', '00:00:00', '2014-11-07', '17:30:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11621', '28011639', '2014-11-03', '00:00:00', '2014-11-03', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11622', '28011639', '2014-11-03', '00:00:00', '2014-11-03', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11623', '28011639', '2014-11-04', '00:00:00', '2014-11-04', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11624', '28011639', '2014-11-04', '00:00:00', '2014-11-04', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11625', '28011639', '2014-11-05', '00:00:00', '2014-11-05', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11626', '28011639', '2014-11-05', '00:00:00', '2014-11-05', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11627', '28011639', '2014-11-06', '00:00:00', '2014-11-06', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11628', '28011639', '2014-11-06', '00:00:00', '2014-11-06', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11629', '28011639', '2014-11-07', '00:00:00', '2014-11-07', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11630', '28011639', '2014-11-07', '00:00:00', '2014-11-07', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11631', '28004019', '2014-11-03', '00:00:00', '2014-11-03', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11632', '28004019', '2014-11-03', '00:00:00', '2014-11-03', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11633', '28004019', '2014-11-04', '00:00:00', '2014-11-04', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11634', '28004019', '2014-11-04', '00:00:00', '2014-11-04', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11635', '28004019', '2014-11-05', '00:00:00', '2014-11-05', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11636', '28004019', '2014-11-05', '00:00:00', '2014-11-05', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11637', '28004019', '2014-11-06', '00:00:00', '2014-11-06', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11638', '28004019', '2014-11-06', '17:10:50', '2014-11-06', '17:00:00', '正常', '1', '0', null, '10251');
INSERT INTO op_unusualtime VALUES ('11639', '28004019', '2014-11-07', '08:31:38', '2014-11-07', '08:30:00', '正常', '0', '0', null, '10285');
INSERT INTO op_unusualtime VALUES ('11640', '28004019', '2014-11-07', '00:00:00', '2014-11-07', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11641', '28004018', '2014-11-03', '00:00:00', '2014-11-03', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11642', '28004018', '2014-11-03', '00:00:00', '2014-11-03', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11643', '28004018', '2014-11-04', '00:00:00', '2014-11-04', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11644', '28004018', '2014-11-04', '00:00:00', '2014-11-04', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11645', '28004018', '2014-11-05', '00:00:00', '2014-11-05', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11646', '28004018', '2014-11-05', '00:00:00', '2014-11-05', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11647', '28004018', '2014-11-06', '00:00:00', '2014-11-06', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11648', '28004018', '2014-11-06', '00:00:00', '2014-11-06', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11649', '28004018', '2014-11-07', '00:00:00', '2014-11-07', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11650', '28004018', '2014-11-07', '00:00:00', '2014-11-07', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11651', '28005651', '2014-11-03', '07:52:06', '2014-11-03', '08:00:00', '正常', '0', '0', null, '8489');
INSERT INTO op_unusualtime VALUES ('11652', '28005651', '2014-11-03', '00:00:00', '2014-11-03', '16:30:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11653', '28005651', '2014-11-04', '07:55:23', '2014-11-04', '08:00:00', '正常', '0', '0', null, '8606');
INSERT INTO op_unusualtime VALUES ('11654', '28005651', '2014-11-04', '16:34:27', '2014-11-04', '16:30:00', '正常', '1', '0', null, '8629');
INSERT INTO op_unusualtime VALUES ('11655', '28005651', '2014-11-05', '07:59:27', '2014-11-05', '08:00:00', '正常', '0', '0', null, '8730');
INSERT INTO op_unusualtime VALUES ('11656', '28005651', '2014-11-05', '16:32:56', '2014-11-05', '16:30:00', '正常', '1', '0', null, '8739');
INSERT INTO op_unusualtime VALUES ('11657', '28005651', '2014-11-06', '08:06:03', '2014-11-06', '08:00:00', '正常', '0', '0', null, '8848');
INSERT INTO op_unusualtime VALUES ('11658', '28005651', '2014-11-06', '16:35:07', '2014-11-06', '16:30:00', '正常', '1', '0', null, '8860');
INSERT INTO op_unusualtime VALUES ('11659', '28005651', '2014-11-07', '07:57:34', '2014-11-07', '08:00:00', '正常', '0', '0', null, '8951');
INSERT INTO op_unusualtime VALUES ('11660', '28005651', '2014-11-07', '00:00:00', '2014-11-07', '16:30:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11661', '28003989', '2014-11-03', '08:29:53', '2014-11-03', '08:30:00', '正常', '0', '0', null, '8507');
INSERT INTO op_unusualtime VALUES ('11662', '28003989', '2014-11-03', '18:49:38', '2014-11-03', '17:00:00', '正常', '1', '0', null, '8557');
INSERT INTO op_unusualtime VALUES ('11663', '28003989', '2014-11-04', '08:30:55', '2014-11-04', '08:30:00', '正常', '0', '0', null, '8625');
INSERT INTO op_unusualtime VALUES ('11664', '28003989', '2014-11-04', '18:42:32', '2014-11-04', '17:00:00', '正常', '1', '0', null, '10188');
INSERT INTO op_unusualtime VALUES ('11665', '28003989', '2014-11-05', '08:32:40', '2014-11-05', '08:30:00', '正常', '0', '0', null, '8736');
INSERT INTO op_unusualtime VALUES ('11666', '28003989', '2014-11-05', '00:00:00', '2014-11-05', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11667', '28003989', '2014-11-06', '08:29:56', '2014-11-06', '08:30:00', '正常', '0', '0', null, '8852');
INSERT INTO op_unusualtime VALUES ('11668', '28003989', '2014-11-06', '00:00:00', '2014-11-06', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11669', '28003989', '2014-11-07', '08:33:18', '2014-11-07', '08:30:00', '正常', '0', '0', null, '8970');
INSERT INTO op_unusualtime VALUES ('11670', '28003989', '2014-11-07', '00:00:00', '2014-11-07', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11671', '10000000', '2014-11-03', '00:00:00', '2014-11-03', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11672', '10000000', '2014-11-03', '00:00:00', '2014-11-03', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11673', '10000000', '2014-11-04', '00:00:00', '2014-11-04', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11674', '10000000', '2014-11-04', '00:00:00', '2014-11-04', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11675', '10000000', '2014-11-05', '00:00:00', '2014-11-05', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11676', '10000000', '2014-11-05', '00:00:00', '2014-11-05', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11677', '10000000', '2014-11-06', '00:00:00', '2014-11-06', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11678', '10000000', '2014-11-06', '00:00:00', '2014-11-06', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11679', '10000000', '2014-11-07', '00:00:00', '2014-11-07', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11680', '10000000', '2014-11-07', '00:00:00', '2014-11-07', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11681', '28003934', '2014-11-03', '00:00:00', '2014-11-03', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11682', '28003934', '2014-11-03', '00:00:00', '2014-11-03', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11683', '28003934', '2014-11-04', '00:00:00', '2014-11-04', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11684', '28003934', '2014-11-04', '00:00:00', '2014-11-04', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11685', '28003934', '2014-11-05', '00:00:00', '2014-11-05', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11686', '28003934', '2014-11-05', '00:00:00', '2014-11-05', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11687', '28003934', '2014-11-06', '00:00:00', '2014-11-06', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11688', '28003934', '2014-11-06', '00:00:00', '2014-11-06', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11689', '28003934', '2014-11-07', '00:00:00', '2014-11-07', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11690', '28003934', '2014-11-07', '00:00:00', '2014-11-07', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11691', '28003935', '2014-11-03', '08:42:37', '2014-11-03', '08:00:00', '迟到', '0', '0', null, '10130');
INSERT INTO op_unusualtime VALUES ('11692', '28003935', '2014-11-03', '18:09:44', '2014-11-03', '17:30:00', '正常', '1', '0', null, '10148');
INSERT INTO op_unusualtime VALUES ('11693', '28003935', '2014-11-04', '08:15:43', '2014-11-04', '08:00:00', '迟到', '0', '0', null, '10158');
INSERT INTO op_unusualtime VALUES ('11694', '28003935', '2014-11-04', '18:47:36', '2014-11-04', '17:30:00', '正常', '1', '0', null, '10189');
INSERT INTO op_unusualtime VALUES ('11695', '28003935', '2014-11-05', '08:18:17', '2014-11-05', '08:00:00', '迟到', '0', '0', null, '10202');
INSERT INTO op_unusualtime VALUES ('11696', '28003935', '2014-11-05', '00:00:00', '2014-11-05', '17:30:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11697', '28003935', '2014-11-06', '08:30:36', '2014-11-06', '08:00:00', '迟到', '0', '0', null, '10241');
INSERT INTO op_unusualtime VALUES ('11698', '28003935', '2014-11-06', '17:54:08', '2014-11-06', '17:30:00', '正常', '1', '0', null, '10268');
INSERT INTO op_unusualtime VALUES ('11699', '28003935', '2014-11-07', '10:38:18', '2014-11-07', '08:00:00', '迟到', '0', '0', null, '10291');
INSERT INTO op_unusualtime VALUES ('11700', '28003935', '2014-11-07', '00:00:00', '2014-11-07', '17:30:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11701', '28003937', '2014-11-06', '16:10:33', '2014-11-06', '16:30:00', '正常', '0', '0', null, '8858');
INSERT INTO op_unusualtime VALUES ('11702', '28003937', '2014-11-07', '03:00:27', '2014-11-06', '02:00:00', '正常', '1', '0', null, '11181');
INSERT INTO op_unusualtime VALUES ('11703', '28003937', '2014-11-07', '00:00:00', '2014-11-07', '16:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11704', '28003937', '2014-11-08', '00:00:00', '2014-11-07', '02:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11705', '28009633', '2014-11-03', '08:34:38', '2014-11-03', '08:30:00', '正常', '0', '0', null, '8508');
INSERT INTO op_unusualtime VALUES ('11706', '28009633', '2014-11-03', '18:03:17', '2014-11-03', '17:00:00', '正常', '1', '0', null, '10147');
INSERT INTO op_unusualtime VALUES ('11707', '28009633', '2014-11-04', '08:20:24', '2014-11-04', '08:30:00', '正常', '0', '0', null, '8620');
INSERT INTO op_unusualtime VALUES ('11708', '28009633', '2014-11-04', '18:08:42', '2014-11-04', '17:00:00', '正常', '1', '0', null, '10184');
INSERT INTO op_unusualtime VALUES ('11709', '28009633', '2014-11-05', '08:26:12', '2014-11-05', '08:30:00', '正常', '0', '0', null, '8734');
INSERT INTO op_unusualtime VALUES ('11710', '28009633', '2014-11-05', '18:25:15', '2014-11-05', '17:00:00', '正常', '1', '0', null, '10231');
INSERT INTO op_unusualtime VALUES ('11711', '28009633', '2014-11-06', '08:32:53', '2014-11-06', '08:30:00', '正常', '0', '0', null, '8857');
INSERT INTO op_unusualtime VALUES ('11712', '28009633', '2014-11-06', '17:52:29', '2014-11-06', '17:00:00', '正常', '1', '0', null, '10266');
INSERT INTO op_unusualtime VALUES ('11713', '28009633', '2014-11-07', '08:23:52', '2014-11-07', '08:30:00', '正常', '0', '0', null, '8964');
INSERT INTO op_unusualtime VALUES ('11714', '28009633', '2014-11-07', '00:00:00', '2014-11-07', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11715', '28003931', '2014-11-03', '08:18:17', '2014-11-03', '08:30:00', '正常', '0', '0', null, '10121');
INSERT INTO op_unusualtime VALUES ('11716', '28003931', '2014-11-03', '17:13:29', '2014-11-03', '17:00:00', '正常', '1', '0', null, '10139');
INSERT INTO op_unusualtime VALUES ('11717', '28003931', '2014-11-04', '08:27:17', '2014-11-04', '08:30:00', '正常', '0', '0', null, '10163');
INSERT INTO op_unusualtime VALUES ('11718', '28003931', '2014-11-04', '17:15:27', '2014-11-04', '17:00:00', '正常', '1', '0', null, '10176');
INSERT INTO op_unusualtime VALUES ('11719', '28003931', '2014-11-05', '08:13:27', '2014-11-05', '08:30:00', '正常', '0', '0', null, '10201');
INSERT INTO op_unusualtime VALUES ('11720', '28003931', '2014-11-05', '17:30:42', '2014-11-05', '17:00:00', '正常', '1', '0', null, '10221');
INSERT INTO op_unusualtime VALUES ('11721', '28003931', '2014-11-06', '08:31:57', '2014-11-06', '08:30:00', '正常', '0', '0', null, '10243');
INSERT INTO op_unusualtime VALUES ('11722', '28003931', '2014-11-06', '17:22:45', '2014-11-06', '17:00:00', '正常', '1', '0', null, '10261');
INSERT INTO op_unusualtime VALUES ('11723', '28003931', '2014-11-07', '08:27:30', '2014-11-07', '08:30:00', '正常', '0', '0', null, '10283');
INSERT INTO op_unusualtime VALUES ('11724', '28003931', '2014-11-07', '00:00:00', '2014-11-07', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11725', '28003930', '2014-11-03', '00:00:00', '2014-11-03', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11726', '28003930', '2014-11-03', '00:00:00', '2014-11-03', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11727', '28003930', '2014-11-04', '00:00:00', '2014-11-04', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11728', '28003930', '2014-11-04', '00:00:00', '2014-11-04', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11729', '28003930', '2014-11-05', '00:00:00', '2014-11-05', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11730', '28003930', '2014-11-05', '00:00:00', '2014-11-05', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11731', '28003930', '2014-11-06', '00:00:00', '2014-11-06', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11732', '28003930', '2014-11-06', '00:00:00', '2014-11-06', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11733', '28003930', '2014-11-07', '08:16:27', '2014-11-07', '08:30:00', '正常', '0', '0', null, '10280');
INSERT INTO op_unusualtime VALUES ('11734', '28003930', '2014-11-07', '00:00:00', '2014-11-07', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11735', '28003928', '2014-11-03', '08:26:01', '2014-11-03', '08:30:00', '正常', '0', '0', null, '10124');
INSERT INTO op_unusualtime VALUES ('11736', '28003928', '2014-11-03', '00:00:00', '2014-11-03', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11737', '28003928', '2014-11-04', '08:29:05', '2014-11-04', '08:30:00', '正常', '0', '0', null, '10164');
INSERT INTO op_unusualtime VALUES ('11738', '28003928', '2014-11-04', '17:06:11', '2014-11-04', '17:00:00', '正常', '1', '0', null, '10173');
INSERT INTO op_unusualtime VALUES ('11739', '28003928', '2014-11-05', '08:29:21', '2014-11-05', '08:30:00', '正常', '0', '0', null, '10207');
INSERT INTO op_unusualtime VALUES ('11740', '28003928', '2014-11-05', '17:34:39', '2014-11-05', '17:00:00', '正常', '1', '0', null, '10226');
INSERT INTO op_unusualtime VALUES ('11741', '28003928', '2014-11-06', '08:28:20', '2014-11-06', '08:30:00', '正常', '0', '0', null, '10240');
INSERT INTO op_unusualtime VALUES ('11742', '28003928', '2014-11-06', '17:09:16', '2014-11-06', '17:00:00', '正常', '1', '0', null, '10250');
INSERT INTO op_unusualtime VALUES ('11743', '28003928', '2014-11-07', '08:31:27', '2014-11-07', '08:30:00', '正常', '0', '0', null, '10284');
INSERT INTO op_unusualtime VALUES ('11744', '28003928', '2014-11-07', '00:00:00', '2014-11-07', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11745', '28003927', '2014-11-03', '00:00:00', '2014-11-03', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11746', '28003927', '2014-11-03', '00:00:00', '2014-11-03', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11747', '28003927', '2014-11-04', '00:00:00', '2014-11-04', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11748', '28003927', '2014-11-04', '00:00:00', '2014-11-04', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11749', '28003927', '2014-11-05', '00:00:00', '2014-11-05', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11750', '28003927', '2014-11-05', '00:00:00', '2014-11-05', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11751', '28003927', '2014-11-06', '00:00:00', '2014-11-06', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11752', '28003927', '2014-11-06', '00:00:00', '2014-11-06', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11753', '28003927', '2014-11-07', '00:00:00', '2014-11-07', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11754', '28003927', '2014-11-07', '00:00:00', '2014-11-07', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11755', '28003924', '2014-11-03', '08:31:38', '2014-11-03', '08:30:00', '正常', '0', '0', null, '10125');
INSERT INTO op_unusualtime VALUES ('11756', '28003924', '2014-11-03', '17:12:30', '2014-11-03', '17:00:00', '正常', '1', '0', null, '10138');
INSERT INTO op_unusualtime VALUES ('11757', '28003924', '2014-11-04', '08:32:45', '2014-11-04', '08:30:00', '正常', '0', '0', null, '8626');
INSERT INTO op_unusualtime VALUES ('11758', '28003924', '2014-11-04', '17:10:27', '2014-11-04', '17:00:00', '正常', '1', '0', null, '10175');
INSERT INTO op_unusualtime VALUES ('11759', '28003924', '2014-11-05', '00:00:00', '2014-11-05', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11760', '28003924', '2014-11-05', '17:31:19', '2014-11-05', '17:00:00', '正常', '1', '0', null, '10224');
INSERT INTO op_unusualtime VALUES ('11761', '28003924', '2014-11-06', '08:31:54', '2014-11-06', '08:30:00', '正常', '0', '0', null, '10242');
INSERT INTO op_unusualtime VALUES ('11762', '28003924', '2014-11-06', '17:14:02', '2014-11-06', '17:00:00', '正常', '1', '0', null, '10253');
INSERT INTO op_unusualtime VALUES ('11763', '28003924', '2014-11-07', '08:30:50', '2014-11-07', '08:30:00', '正常', '0', '0', null, '8966');
INSERT INTO op_unusualtime VALUES ('11764', '28003924', '2014-11-07', '00:00:00', '2014-11-07', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11765', '28003921', '2014-11-03', '00:00:00', '2014-11-03', '17:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11766', '28003921', '2014-11-04', '04:18:03', '2014-11-03', '03:00:00', '正常', '1', '0', null, '10153');
INSERT INTO op_unusualtime VALUES ('11767', '28003921', '2014-11-04', '17:16:45', '2014-11-04', '17:30:00', '正常', '0', '0', null, '10177');
INSERT INTO op_unusualtime VALUES ('11768', '28003921', '2014-11-05', '03:12:31', '2014-11-04', '03:00:00', '正常', '1', '0', null, '10195');
INSERT INTO op_unusualtime VALUES ('11769', '28003921', '2014-11-05', '17:27:55', '2014-11-05', '17:30:00', '正常', '0', '0', null, '8753');
INSERT INTO op_unusualtime VALUES ('11770', '28003921', '2014-11-06', '03:00:27', '2014-11-05', '03:00:00', '正常', '1', '0', null, '8793');
INSERT INTO op_unusualtime VALUES ('11771', '28003921', '2014-11-06', '17:24:09', '2014-11-06', '17:30:00', '正常', '0', '0', null, '8872');
INSERT INTO op_unusualtime VALUES ('11772', '28003921', '2014-11-07', '03:00:25', '2014-11-06', '03:00:00', '正常', '1', '0', null, '8916');
INSERT INTO op_unusualtime VALUES ('11773', '28003921', '2014-11-07', '00:00:00', '2014-11-07', '17:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11774', '28003921', '2014-11-08', '00:00:00', '2014-11-07', '03:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11775', '28003920', '2014-11-03', '00:00:00', '2014-11-03', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11776', '28003920', '2014-11-03', '00:00:00', '2014-11-03', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11777', '28003920', '2014-11-04', '00:00:00', '2014-11-04', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11778', '28003920', '2014-11-04', '00:00:00', '2014-11-04', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11779', '28003920', '2014-11-05', '00:00:00', '2014-11-05', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11780', '28003920', '2014-11-05', '00:00:00', '2014-11-05', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11781', '28003920', '2014-11-06', '00:00:00', '2014-11-06', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11782', '28003920', '2014-11-06', '00:00:00', '2014-11-06', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11783', '28003920', '2014-11-07', '07:52:39', '2014-11-07', '08:30:00', '正常', '0', '0', null, '10276');
INSERT INTO op_unusualtime VALUES ('11784', '28003920', '2014-11-07', '00:00:00', '2014-11-07', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11785', '28003919', '2014-11-03', '08:32:48', '2014-11-03', '08:30:00', '正常', '0', '0', null, '10126');
INSERT INTO op_unusualtime VALUES ('11786', '28003919', '2014-11-03', '18:03:13', '2014-11-03', '17:00:00', '正常', '1', '0', null, '10146');
INSERT INTO op_unusualtime VALUES ('11787', '28003919', '2014-11-04', '08:26:59', '2014-11-04', '08:30:00', '正常', '0', '0', null, '10162');
INSERT INTO op_unusualtime VALUES ('11788', '28003919', '2014-11-04', '17:19:32', '2014-11-04', '17:00:00', '正常', '1', '0', null, '10178');
INSERT INTO op_unusualtime VALUES ('11789', '28003919', '2014-11-05', '08:21:19', '2014-11-05', '08:30:00', '正常', '0', '0', null, '10204');
INSERT INTO op_unusualtime VALUES ('11790', '28003919', '2014-11-05', '17:19:24', '2014-11-05', '17:00:00', '正常', '1', '0', null, '10219');
INSERT INTO op_unusualtime VALUES ('11791', '28003919', '2014-11-06', '08:27:41', '2014-11-06', '08:30:00', '正常', '0', '0', null, '8850');
INSERT INTO op_unusualtime VALUES ('11792', '28003919', '2014-11-06', '18:12:25', '2014-11-06', '17:00:00', '正常', '1', '0', null, '10271');
INSERT INTO op_unusualtime VALUES ('11793', '28003919', '2014-11-07', '08:12:25', '2014-11-07', '08:30:00', '正常', '0', '0', null, '8962');
INSERT INTO op_unusualtime VALUES ('11794', '28003919', '2014-11-07', '00:00:00', '2014-11-07', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11795', '28003918', '2014-11-03', '00:00:00', '2014-11-03', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11796', '28003918', '2014-11-03', '00:00:00', '2014-11-03', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11797', '28003918', '2014-11-04', '00:00:00', '2014-11-04', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11798', '28003918', '2014-11-04', '00:00:00', '2014-11-04', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11799', '28003918', '2014-11-05', '00:00:00', '2014-11-05', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11800', '28003918', '2014-11-05', '00:00:00', '2014-11-05', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11801', '28003918', '2014-11-06', '00:00:00', '2014-11-06', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11802', '28003918', '2014-11-06', '00:00:00', '2014-11-06', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11803', '28003918', '2014-11-07', '08:36:10', '2014-11-07', '08:30:00', '正常', '0', '0', null, '10287');
INSERT INTO op_unusualtime VALUES ('11804', '28003918', '2014-11-07', '00:00:00', '2014-11-07', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11805', '28003917', '2014-11-03', '00:00:00', '2014-11-03', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11806', '28003917', '2014-11-03', '00:00:00', '2014-11-03', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11807', '28003917', '2014-11-04', '00:00:00', '2014-11-04', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11808', '28003917', '2014-11-04', '00:00:00', '2014-11-04', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11809', '28003917', '2014-11-05', '00:00:00', '2014-11-05', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11810', '28003917', '2014-11-05', '00:00:00', '2014-11-05', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11811', '28003917', '2014-11-06', '00:00:00', '2014-11-06', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11812', '28003917', '2014-11-06', '00:00:00', '2014-11-06', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11813', '28003917', '2014-11-07', '00:00:00', '2014-11-07', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11814', '28003917', '2014-11-07', '00:00:00', '2014-11-07', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11815', '28003915', '2014-11-03', '08:27:26', '2014-11-03', '08:30:00', '正常', '0', '0', null, '8506');
INSERT INTO op_unusualtime VALUES ('11816', '28003915', '2014-11-03', '18:18:42', '2014-11-03', '17:00:00', '正常', '1', '0', null, '10149');
INSERT INTO op_unusualtime VALUES ('11817', '28003915', '2014-11-04', '08:32:48', '2014-11-04', '08:30:00', '正常', '0', '0', null, '8627');
INSERT INTO op_unusualtime VALUES ('11818', '28003915', '2014-11-04', '17:43:15', '2014-11-04', '17:00:00', '正常', '1', '0', null, '10183');
INSERT INTO op_unusualtime VALUES ('11819', '28003915', '2014-11-05', '08:36:32', '2014-11-05', '08:30:00', '正常', '0', '0', null, '10210');
INSERT INTO op_unusualtime VALUES ('11820', '28003915', '2014-11-05', '18:01:18', '2014-11-05', '17:00:00', '正常', '1', '0', null, '10230');
INSERT INTO op_unusualtime VALUES ('11821', '28003915', '2014-11-06', '08:30:37', '2014-11-06', '08:30:00', '正常', '0', '0', null, '8853');
INSERT INTO op_unusualtime VALUES ('11822', '28003915', '2014-11-06', '17:14:11', '2014-11-06', '17:00:00', '正常', '1', '0', null, '10254');
INSERT INTO op_unusualtime VALUES ('11823', '28003915', '2014-11-07', '08:30:53', '2014-11-07', '08:30:00', '正常', '0', '0', null, '8967');
INSERT INTO op_unusualtime VALUES ('11824', '28003915', '2014-11-07', '00:00:00', '2014-11-07', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11825', '28003914', '2014-11-03', '08:46:50', '2014-11-03', '08:30:00', '迟到', '0', '0', null, '10133');
INSERT INTO op_unusualtime VALUES ('11826', '28003914', '2014-11-03', '17:23:04', '2014-11-03', '17:00:00', '正常', '1', '0', null, '10142');
INSERT INTO op_unusualtime VALUES ('11827', '28003914', '2014-11-04', '08:41:06', '2014-11-04', '08:30:00', '迟到', '0', '0', null, '10167');
INSERT INTO op_unusualtime VALUES ('11828', '28003914', '2014-11-04', '17:22:46', '2014-11-04', '17:00:00', '正常', '1', '0', null, '10179');
INSERT INTO op_unusualtime VALUES ('11829', '28003914', '2014-11-05', '08:34:35', '2014-11-05', '08:30:00', '正常', '0', '0', null, '10209');
INSERT INTO op_unusualtime VALUES ('11830', '28003914', '2014-11-05', '17:33:15', '2014-11-05', '17:00:00', '正常', '1', '0', null, '10225');
INSERT INTO op_unusualtime VALUES ('11831', '28003914', '2014-11-06', '08:39:10', '2014-11-06', '08:30:00', '正常', '0', '0', null, '10244');
INSERT INTO op_unusualtime VALUES ('11832', '28003914', '2014-11-06', '17:18:47', '2014-11-06', '17:00:00', '正常', '1', '0', null, '10259');
INSERT INTO op_unusualtime VALUES ('11833', '28003914', '2014-11-07', '08:34:06', '2014-11-07', '08:30:00', '正常', '0', '0', null, '10286');
INSERT INTO op_unusualtime VALUES ('11834', '28003914', '2014-11-07', '00:00:00', '2014-11-07', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11835', '28003913', '2014-11-03', '08:43:20', '2014-11-03', '08:30:00', '迟到', '0', '0', null, '10131');
INSERT INTO op_unusualtime VALUES ('11836', '28003913', '2014-11-03', '16:03:58', '2014-11-03', '16:00:00', '早退', '1', '0', null, '10135');
INSERT INTO op_unusualtime VALUES ('11837', '28003913', '2014-11-04', '08:39:59', '2014-11-04', '08:30:00', '正常', '0', '0', null, '10166');
INSERT INTO op_unusualtime VALUES ('11838', '28003913', '2014-11-04', '16:46:53', '2014-11-04', '16:00:00', '早退', '1', '0', null, '10172');
INSERT INTO op_unusualtime VALUES ('11839', '28003913', '2014-11-05', '08:40:12', '2014-11-05', '08:30:00', '迟到', '0', '0', null, '10213');
INSERT INTO op_unusualtime VALUES ('11840', '28003913', '2014-11-05', '18:01:15', '2014-11-05', '16:00:00', '正常', '1', '0', null, '10229');
INSERT INTO op_unusualtime VALUES ('11841', '28003913', '2014-11-06', '09:41:10', '2014-11-06', '08:30:00', '迟到', '0', '0', null, '10247');
INSERT INTO op_unusualtime VALUES ('11842', '28003913', '2014-11-06', '16:26:20', '2014-11-06', '16:00:00', '早退', '1', '0', null, '10249');
INSERT INTO op_unusualtime VALUES ('11843', '28003913', '2014-11-07', '08:48:07', '2014-11-07', '08:30:00', '迟到', '0', '0', null, '10289');
INSERT INTO op_unusualtime VALUES ('11844', '28003913', '2014-11-07', '00:00:00', '2014-11-07', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11845', '28003912', '2014-11-03', '00:00:00', '2014-11-03', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11846', '28003912', '2014-11-03', '00:00:00', '2014-11-03', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11847', '28003912', '2014-11-04', '00:00:00', '2014-11-04', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11848', '28003912', '2014-11-04', '00:00:00', '2014-11-04', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11849', '28003912', '2014-11-05', '00:00:00', '2014-11-05', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11850', '28003912', '2014-11-05', '00:00:00', '2014-11-05', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11851', '28003912', '2014-11-06', '00:00:00', '2014-11-06', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11852', '28003912', '2014-11-06', '00:00:00', '2014-11-06', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11853', '28003912', '2014-11-07', '00:00:00', '2014-11-07', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11854', '28003912', '2014-11-07', '00:00:00', '2014-11-07', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11855', '28010001', '2014-11-03', '00:00:00', '2014-11-03', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11856', '28010001', '2014-11-03', '00:00:00', '2014-11-03', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11857', '28010001', '2014-11-04', '08:26:18', '2014-11-04', '08:30:00', '正常', '0', '0', null, '8624');
INSERT INTO op_unusualtime VALUES ('11858', '28010001', '2014-11-04', '00:00:00', '2014-11-04', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11859', '28010001', '2014-11-05', '08:27:31', '2014-11-05', '08:30:00', '正常', '0', '0', null, '8735');
INSERT INTO op_unusualtime VALUES ('11860', '28010001', '2014-11-05', '17:30:47', '2014-11-05', '17:00:00', '正常', '1', '0', null, '10222');
INSERT INTO op_unusualtime VALUES ('11861', '28010001', '2014-11-06', '08:31:06', '2014-11-06', '08:30:00', '正常', '0', '0', null, '8854');
INSERT INTO op_unusualtime VALUES ('11862', '28010001', '2014-11-06', '17:21:16', '2014-11-06', '17:00:00', '正常', '1', '0', null, '10260');
INSERT INTO op_unusualtime VALUES ('11863', '28010001', '2014-11-07', '08:32:16', '2014-11-07', '08:30:00', '正常', '0', '0', null, '8969');
INSERT INTO op_unusualtime VALUES ('11864', '28010001', '2014-11-07', '00:00:00', '2014-11-07', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11865', '28010009', '2014-11-03', '08:33:33', '2014-11-03', '08:30:00', '正常', '0', '0', null, '10127');
INSERT INTO op_unusualtime VALUES ('11866', '28010009', '2014-11-03', '00:00:00', '2014-11-03', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11867', '28010009', '2014-11-04', '08:26:16', '2014-11-04', '08:30:00', '正常', '0', '0', null, '8623');
INSERT INTO op_unusualtime VALUES ('11868', '28010009', '2014-11-04', '00:00:00', '2014-11-04', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11869', '28010009', '2014-11-05', '08:31:02', '2014-11-05', '08:30:00', '正常', '0', '0', null, '10208');
INSERT INTO op_unusualtime VALUES ('11870', '28010009', '2014-11-05', '17:31:09', '2014-11-05', '17:00:00', '正常', '1', '0', null, '10223');
INSERT INTO op_unusualtime VALUES ('11871', '28010009', '2014-11-06', '08:28:56', '2014-11-06', '08:30:00', '正常', '0', '0', null, '8851');
INSERT INTO op_unusualtime VALUES ('11872', '28010009', '2014-11-06', '17:16:50', '2014-11-06', '17:00:00', '正常', '1', '0', null, '10256');
INSERT INTO op_unusualtime VALUES ('11873', '28010009', '2014-11-07', '00:00:00', '2014-11-07', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11874', '28010009', '2014-11-07', '00:00:00', '2014-11-07', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11875', '28003911', '2014-11-03', '00:00:00', '2014-11-03', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11876', '28003911', '2014-11-03', '00:00:00', '2014-11-03', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11877', '28003911', '2014-11-04', '00:00:00', '2014-11-04', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11878', '28003911', '2014-11-04', '00:00:00', '2014-11-04', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11879', '28003911', '2014-11-05', '00:00:00', '2014-11-05', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11880', '28003911', '2014-11-05', '00:00:00', '2014-11-05', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11881', '28003911', '2014-11-06', '00:00:00', '2014-11-06', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11882', '28003911', '2014-11-06', '00:00:00', '2014-11-06', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11883', '28003911', '2014-11-07', '00:00:00', '2014-11-07', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11884', '28003911', '2014-11-07', '00:00:00', '2014-11-07', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11885', '28003909', '2014-11-03', '08:41:32', '2014-11-03', '08:30:00', '迟到', '0', '0', null, '10129');
INSERT INTO op_unusualtime VALUES ('11886', '28003909', '2014-11-03', '18:01:48', '2014-11-03', '17:00:00', '正常', '1', '0', null, '10144');
INSERT INTO op_unusualtime VALUES ('11887', '28003909', '2014-11-04', '08:35:11', '2014-11-04', '08:30:00', '正常', '0', '0', null, '10165');
INSERT INTO op_unusualtime VALUES ('11888', '28003909', '2014-11-04', '18:56:41', '2014-11-04', '17:00:00', '正常', '1', '0', null, '10190');
INSERT INTO op_unusualtime VALUES ('11889', '28003909', '2014-11-05', '08:46:06', '2014-11-05', '08:30:00', '迟到', '0', '0', null, '10214');
INSERT INTO op_unusualtime VALUES ('11890', '28003909', '2014-11-05', '17:21:01', '2014-11-05', '17:00:00', '正常', '1', '0', null, '10220');
INSERT INTO op_unusualtime VALUES ('11891', '28003909', '2014-11-06', '08:39:59', '2014-11-06', '08:30:00', '正常', '0', '0', null, '10245');
INSERT INTO op_unusualtime VALUES ('11892', '28003909', '2014-11-06', '17:39:41', '2014-11-06', '17:00:00', '正常', '1', '0', null, '10262');
INSERT INTO op_unusualtime VALUES ('11893', '28003909', '2014-11-07', '08:43:42', '2014-11-07', '08:30:00', '迟到', '0', '0', null, '10288');
INSERT INTO op_unusualtime VALUES ('11894', '28003909', '2014-11-07', '00:00:00', '2014-11-07', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11895', '28003907', '2014-11-03', '00:00:00', '2014-11-03', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11896', '28003907', '2014-11-03', '00:00:00', '2014-11-03', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11897', '28003907', '2014-11-04', '00:00:00', '2014-11-04', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11898', '28003907', '2014-11-04', '00:00:00', '2014-11-04', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11899', '28003907', '2014-11-05', '00:00:00', '2014-11-05', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11900', '28003907', '2014-11-05', '00:00:00', '2014-11-05', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11901', '28003907', '2014-11-06', '00:00:00', '2014-11-06', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11902', '28003907', '2014-11-06', '00:00:00', '2014-11-06', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11903', '28003907', '2014-11-07', '00:00:00', '2014-11-07', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11904', '28003907', '2014-11-07', '00:00:00', '2014-11-07', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11905', '28003906', '2014-11-03', '08:44:55', '2014-11-03', '08:30:00', '迟到', '0', '0', null, '10858');
INSERT INTO op_unusualtime VALUES ('11906', '28003906', '2014-11-03', '00:00:00', '2014-11-03', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11907', '28003906', '2014-11-04', '08:24:52', '2014-11-04', '08:30:00', '正常', '0', '0', null, '10159');
INSERT INTO op_unusualtime VALUES ('11908', '28003906', '2014-11-04', '00:00:00', '2014-11-04', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11909', '28003906', '2014-11-05', '08:27:28', '2014-11-05', '08:30:00', '正常', '0', '0', null, '10206');
INSERT INTO op_unusualtime VALUES ('11910', '28003906', '2014-11-05', '00:00:00', '2014-11-05', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11911', '28003906', '2014-11-06', '00:00:00', '2014-11-06', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11912', '28003906', '2014-11-06', '00:00:00', '2014-11-06', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11913', '28003906', '2014-11-07', '08:41:03', '2014-11-07', '08:30:00', '迟到', '0', '0', null, '11211');
INSERT INTO op_unusualtime VALUES ('11914', '28003906', '2014-11-07', '00:00:00', '2014-11-07', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11915', '28006173', '2014-11-03', '00:00:00', '2014-11-03', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11916', '28006173', '2014-11-03', '00:00:00', '2014-11-03', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11917', '28006173', '2014-11-04', '00:00:00', '2014-11-04', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11918', '28006173', '2014-11-04', '00:00:00', '2014-11-04', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11919', '28006173', '2014-11-05', '08:23:23', '2014-11-05', '08:30:00', '正常', '0', '0', null, '10205');
INSERT INTO op_unusualtime VALUES ('11920', '28006173', '2014-11-05', '17:35:47', '2014-11-05', '17:00:00', '正常', '1', '0', null, '10228');
INSERT INTO op_unusualtime VALUES ('11921', '28006173', '2014-11-06', '08:31:14', '2014-11-06', '08:30:00', '正常', '0', '0', null, '8856');
INSERT INTO op_unusualtime VALUES ('11922', '28006173', '2014-11-06', '17:16:15', '2014-11-06', '17:00:00', '正常', '1', '0', null, '10255');
INSERT INTO op_unusualtime VALUES ('11923', '28006173', '2014-11-07', '00:00:00', '2014-11-07', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11924', '28006173', '2014-11-07', '00:00:00', '2014-11-07', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11925', '28003905', '2014-11-03', '08:37:04', '2014-11-03', '08:30:00', '正常', '0', '0', null, '10128');
INSERT INTO op_unusualtime VALUES ('11926', '28003905', '2014-11-03', '17:08:17', '2014-11-03', '17:00:00', '正常', '1', '0', null, '10136');
INSERT INTO op_unusualtime VALUES ('11927', '28003905', '2014-11-04', '00:00:00', '2014-11-04', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11928', '28003905', '2014-11-04', '00:00:00', '2014-11-04', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11929', '28003905', '2014-11-05', '08:38:06', '2014-11-05', '08:30:00', '正常', '0', '0', null, '10212');
INSERT INTO op_unusualtime VALUES ('11930', '28003905', '2014-11-05', '17:18:16', '2014-11-05', '17:00:00', '正常', '1', '0', null, '10218');
INSERT INTO op_unusualtime VALUES ('11931', '28003905', '2014-11-06', '08:41:26', '2014-11-06', '08:30:00', '迟到', '0', '0', null, '10246');
INSERT INTO op_unusualtime VALUES ('11932', '28003905', '2014-11-06', '17:18:33', '2014-11-06', '17:00:00', '正常', '1', '0', null, '10258');
INSERT INTO op_unusualtime VALUES ('11933', '28003905', '2014-11-07', '08:50:20', '2014-11-07', '08:30:00', '迟到', '0', '0', null, '10290');
INSERT INTO op_unusualtime VALUES ('11934', '28003905', '2014-11-07', '00:00:00', '2014-11-07', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11935', '28003904', '2014-11-06', '17:53:28', '2014-11-06', '18:00:00', '正常', '0', '0', null, '10267');
INSERT INTO op_unusualtime VALUES ('11936', '28003904', '2014-11-07', '08:50:20', '2014-11-06', '08:00:00', '正常', '1', '0', null, '10290');
INSERT INTO op_unusualtime VALUES ('11937', '28003904', '2014-11-07', '00:00:00', '2014-11-07', '18:00:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11938', '28003904', '2014-11-08', '00:00:00', '2014-11-07', '08:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11939', '28003902', '2014-11-03', '08:43:39', '2014-11-03', '08:30:00', '迟到', '0', '0', null, '10132');
INSERT INTO op_unusualtime VALUES ('11940', '28003902', '2014-11-03', '17:11:38', '2014-11-03', '17:00:00', '正常', '1', '0', null, '10137');
INSERT INTO op_unusualtime VALUES ('11941', '28003902', '2014-11-04', '00:00:00', '2014-11-04', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11942', '28003902', '2014-11-04', '17:10:18', '2014-11-04', '17:00:00', '正常', '1', '0', null, '10174');
INSERT INTO op_unusualtime VALUES ('11943', '28003902', '2014-11-05', '00:00:00', '2014-11-05', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11944', '28003902', '2014-11-05', '00:00:00', '2014-11-05', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11945', '28003902', '2014-11-06', '00:00:00', '2014-11-06', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11946', '28003902', '2014-11-06', '00:00:00', '2014-11-06', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11947', '28003902', '2014-11-07', '00:00:00', '2014-11-07', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11948', '28003902', '2014-11-07', '00:00:00', '2014-11-07', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11949', '28003901', '2014-11-03', '00:00:00', '2014-11-03', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11950', '28003901', '2014-11-03', '00:00:00', '2014-11-03', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11951', '28003901', '2014-11-04', '00:00:00', '2014-11-04', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11952', '28003901', '2014-11-04', '00:00:00', '2014-11-04', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11953', '28003901', '2014-11-05', '00:00:00', '2014-11-05', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11954', '28003901', '2014-11-05', '00:00:00', '2014-11-05', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11955', '28003901', '2014-11-06', '00:00:00', '2014-11-06', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11956', '28003901', '2014-11-06', '00:00:00', '2014-11-06', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11957', '28003901', '2014-11-07', '00:00:00', '2014-11-07', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11958', '28003901', '2014-11-07', '00:00:00', '2014-11-07', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11959', '00000000', '2014-11-03', '00:00:00', '2014-11-03', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11960', '00000000', '2014-11-03', '00:00:00', '2014-11-03', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11961', '00000000', '2014-11-04', '00:00:00', '2014-11-04', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11962', '00000000', '2014-11-04', '00:00:00', '2014-11-04', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11963', '00000000', '2014-11-05', '00:00:00', '2014-11-05', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11964', '00000000', '2014-11-05', '00:00:00', '2014-11-05', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11965', '00000000', '2014-11-06', '00:00:00', '2014-11-06', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11966', '00000000', '2014-11-06', '00:00:00', '2014-11-06', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11967', '00000000', '2014-11-07', '00:00:00', '2014-11-07', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11968', '00000000', '2014-11-07', '00:00:00', '2014-11-07', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11969', '28012017', '2014-11-03', '00:00:00', '2014-11-03', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11970', '28012017', '2014-11-03', '00:00:00', '2014-11-03', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11971', '28012017', '2014-11-04', '00:00:00', '2014-11-04', '08:30:00', '未打卡(上班)', '0', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11972', '28012017', '2014-11-04', '00:00:00', '2014-11-04', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11973', '28012017', '2014-11-05', '08:10:32', '2014-11-05', '08:30:00', '正常', '0', '0', null, '8732');
INSERT INTO op_unusualtime VALUES ('11974', '28012017', '2014-11-05', '00:00:00', '2014-11-05', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11975', '28012017', '2014-11-06', '08:31:11', '2014-11-06', '08:30:00', '正常', '0', '0', null, '8855');
INSERT INTO op_unusualtime VALUES ('11976', '28012017', '2014-11-06', '00:00:00', '2014-11-06', '17:00:00', '未打卡(下班)', '1', '0', null, '0');
INSERT INTO op_unusualtime VALUES ('11977', '28012017', '2014-11-07', '08:20:25', '2014-11-07', '08:30:00', '正常', '0', '0', null, '8963');
INSERT INTO op_unusualtime VALUES ('11978', '28012017', '2014-11-07', '00:00:00', '2014-11-07', '17:00:00', '未打卡(下班)', '1', '0', null, '0');

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
) ENGINE=MyISAM AUTO_INCREMENT=1000206 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of op_userinfo
-- ----------------------------
INSERT INTO op_userinfo VALUES ('1000107', '28003901', 'tracy.li', '827ccb0eea8a706c4c34a16891f84e7b', '李继宏', '0', '7', '13331666018', '0', '2006-08-22', '5', 'tracy.li@faureciaxuyang.com', '2014-11-06 16:51:26');
INSERT INTO op_userinfo VALUES ('1000108', '28003902', 'sabrina.shen', '827ccb0eea8a706c4c34a16891f84e7b', '沈筱', '0', '8', '18681278979', '0', '2012-01-03', '4', 'sabrina.shen@faureciaxuyang.com', '2014-10-21 16:31:28');
INSERT INTO op_userinfo VALUES ('1000109', '28003905', 'andy.zhang', '827ccb0eea8a706c4c34a16891f84e7b', '张庆', '0', '9', '18608003951', '0', '2011-08-05', '4', 'andy.zhang@faureciaxuyang.com', '2014-10-22 16:09:48');
INSERT INTO op_userinfo VALUES ('1000110', '28006173', 'raymond.fu', '827ccb0eea8a706c4c34a16891f84e7b', '付伟', '0', '7', '15228840363', '0', '2013-07-29', '7', 'raymond.fu@faureciaxuyang.com', '2014-09-29 10:25:47');
INSERT INTO op_userinfo VALUES ('1000111', '28003906', 'david.deng', '827ccb0eea8a706c4c34a16891f84e7b', '邓飞', '0', '7', '13880351137', '0', '2011-11-02', '7', 'fei.deng@faureciaxuyang.com', '2014-10-11 11:06:06');
INSERT INTO op_userinfo VALUES ('1000141', '28003907', 'jamie.wang', '91504053cf339c91b7c283eb8075e0ef', '王晶', '0', '2', '18628071776', '0', '2011-07-11', '7', 'jamie.wang@faureciaxuyang.com', '2014-11-07 11:17:19');
INSERT INTO op_userinfo VALUES ('1000112', '28003909', 'gillian.zhu', 'ed2b1f468c5f915f3f1cf75d7068baae', '朱品容', '0', '2', '15108420372', '0', '2012-04-23', '7', 'gillian.zhu@faureciaxuyang.com', '2014-11-06 15:25:40');
INSERT INTO op_userinfo VALUES ('1000113', '28003911', 'letty.luo', '827ccb0eea8a706c4c34a16891f84e7b', '罗琪', '1', '2', '18381078870', '0', '2012-12-11', '7', 'letty.luo@faureciaxuyang.com', '2014-09-29 10:25:47');
INSERT INTO op_userinfo VALUES ('1000114', '28010009', 'wei.zhang', 'b0d0ea0b44c258f9e94f9a1b09392839', '张薇', '0', '2', '18682559769', '0', '2013-10-21', '7', 'Receptionist.CFXAS-CD@faureciaxuyang.com', '2014-11-06 15:03:54');
INSERT INTO op_userinfo VALUES ('1000115', '28010001', 'sarah.wang', '827ccb0eea8a706c4c34a16891f84e7b', '王鑫薷', '0', '2', '18200435966', '0', '2014-03-24', '7', 'sarah.wang@faureciaxuyang.com', '2014-09-29 10:25:47');
INSERT INTO op_userinfo VALUES ('1000116', '28003912', 'rick.ouyang', '827ccb0eea8a706c4c34a16891f84e7b', '欧阳百贺', '0', '3', '13882565165', '0', '2011-09-21', '4', 'rick.ouyang@faureciaxuyang.com', '2014-10-22 20:32:16');
INSERT INTO op_userinfo VALUES ('1000117', '28003913', 'vivi.ge', '827ccb0eea8a706c4c34a16891f84e7b', '葛振芳', '0', '3', '15102830776', '0', '2012-07-16', '7', 'vivi.ge@faureciaxuyang.com', '2014-09-29 10:25:47');
INSERT INTO op_userinfo VALUES ('1000118', '28003914', 'huayi.yang', '6fcb5f091ab85321e2b2f8aa7199f4d0', '杨华溢', '0', '3', '13548155207', '0', '2011-07-28', '7', 'huayi.yang@faureciaxuyang.com', '2014-11-06 14:40:23');
INSERT INTO op_userinfo VALUES ('1000119', '28003915', 'clint.wu', 'd57953db1853eb1a3457675284313d45', '吴锋', '0', '3', '13540640511', '0', '2011-04-15', '7', 'clint.wu@faureciaxuyang.com', '2014-11-07 16:27:12');
INSERT INTO op_userinfo VALUES ('1000120', '28003917', 'tim.liu', '827ccb0eea8a706c4c34a16891f84e7b', '刘铁柱', '0', '4', '18615767060', '0', '2010-08-21', '4', 'tim.liu@faureciaxuyang.com', '2014-10-30 13:21:13');
INSERT INTO op_userinfo VALUES ('1000121', '28003918', 'selwyn.peng', '0801290628eb1aab513d79ce2c1d64e1', '彭世文', '0', '4', '13688364770', '0', '2011-07-11', '7', 'shiwen.peng@faureciaxuyang.com', '2014-11-07 10:50:45');
INSERT INTO op_userinfo VALUES ('1000122', '28003919', 'jason.jiang', '827ccb0eea8a706c4c34a16891f84e7b', '江利桃', '0', '4', '15828194009', '0', '2011-07-11', '7', 'jason.jiang@faureciaxuyang.com', '2014-09-29 10:25:47');
INSERT INTO op_userinfo VALUES ('1000123', '28003920', 'jerry.fu', '827ccb0eea8a706c4c34a16891f84e7b', '付全柏', '0', '4', '15228798071', '0', '2013-04-01', '7', 'jerry.fu@faureciaxuyang.com', '2014-09-29 10:25:47');
INSERT INTO op_userinfo VALUES ('1000124', '28003924', 'sucy.shu', '827ccb0eea8a706c4c34a16891f84e7b', '舒娟', '0', '4', '13648095760', '0', '2012-01-29', '7', 'sucy.shu@faureciaxuyang.com', '2014-10-24 09:57:49');
INSERT INTO op_userinfo VALUES ('1000125', '28003927', 'harry.yang', 'e1749093a0c4e7280fb94d60413ed00b', '杨爱民', '0', '6', '18981956193', '0', '2012-12-10', '4', 'harry.yang@faureciaxuyang.com', '2014-11-06 15:17:19');
INSERT INTO op_userinfo VALUES ('1000126', '28003928', 'yankui.wang', '827ccb0eea8a706c4c34a16891f84e7b', '王彦奎', '0', '6', '18780227387', '0', '2010-07-01', '7', 'yankui.wang@faureciaxuyang.com', '2014-09-29 10:25:47');
INSERT INTO op_userinfo VALUES ('1000127', '28003930', 'tiger.wang', '43b90920409618f188bfc6923f16b9fa', '王林', '0', '6', '13882029775', '0', '2012-02-01', '7', 'tiger.wang@faureciaxuyang.com', '2014-11-07 09:37:11');
INSERT INTO op_userinfo VALUES ('1000128', '28003931', 'ting.pan', '827ccb0eea8a706c4c34a16891f84e7b', '潘挺', '0', '6', '13693499379', '0', '2012-02-01', '7', 'ting.pan@faureciaxuayng.com', '2014-09-29 10:25:47');
INSERT INTO op_userinfo VALUES ('1000129', '28009633', 'bo.zhang', '827ccb0eea8a706c4c34a16891f84e7b', '张波', '0', '6', '15982167753', '0', '2014-03-04', '7', 'jacky.zhang@faureciaxuyang.com', '2014-09-29 10:25:47');
INSERT INTO op_userinfo VALUES ('1000130', '28003934', 'simon.shi', '827ccb0eea8a706c4c34a16891f84e7b', '施恂义', '0', '1', '13917610267', '0', '2012-06-27', '4', 'xunyi.shi@faureciaxuyang.com', '2014-09-29 10:25:47');
INSERT INTO op_userinfo VALUES ('1000131', '28003935', 'biao.chen', '75bf7adfd206e7ba15f3dafdf4f582b3', '陈彪', '0', '1', '13660363699', '0', '2012-09-03', '3', 'biao.chen@faureciaxuyang.com', '2014-11-06 14:50:10');
INSERT INTO op_userinfo VALUES ('1000132', '28003937', 'jie.liu', 'aa08da998710d7b4244b0571c94495e5', '刘杰', '0', '1', '15208247287', '0', '2010-09-01', '3', 'jie.liu@faureciaxuyang.com', '2014-11-06 20:12:05');
INSERT INTO op_userinfo VALUES ('1000133', '28003938', 'wanliang.peng', '827ccb0eea8a706c4c34a16891f84e7b', '彭万良', '0', '1', '18349199369', '0', '2013-04-01', '3', 'wanliang.peng@faureciaxuyang.com', '2014-10-24 11:21:02');
INSERT INTO op_userinfo VALUES ('1000134', '28003989', 'fuxin.feng', 'e95a0135ffe2ef09919b118470706893', '冯富鑫', '0', '9', '15948797553', '0', '2012-09-03', '7', 'fuxin.feng@faureciaxuyang.com', '2014-11-06 17:05:19');
INSERT INTO op_userinfo VALUES ('1000135', '28004018', 'carol.tang', 'd0970714757783e6cf17b26fb8e2298f', '唐茂蔷', '0', '5', '18227664679', '0', '2011-10-09', '4', 'carol.tang@faureciaxuyang.com', '2014-11-06 15:19:38');
INSERT INTO op_userinfo VALUES ('1000136', '28004019', 'nancy.li', '4a7a6a3ea2991a91cbbb05a09fe38f4c', '李国琴', '0', '5', '13488978182', '0', '2011-04-12', '7', 'guoqin.li@faureciaxuyang.com', '2014-11-06 15:19:49');
INSERT INTO op_userinfo VALUES ('1000137', '28011639', 'charles.sun', '827ccb0eea8a706c4c34a16891f84e7b', '孙铖', '0', '5', '18828076656', '0', '2014-09-01', '7', 'charles.sun@faureciaxuyang.com', '2014-11-07 17:22:25');
INSERT INTO op_userinfo VALUES ('1000138', '28004021', 'leo.li', '827ccb0eea8a706c4c34a16891f84e7b', '李勇', '0', '5', '18502866697', '0', '2012-09-21', '3', 'leo.li@faureciaxuyang.com', '2014-10-24 11:21:58');
INSERT INTO op_userinfo VALUES ('1000139', '28010002', 'sam.cui', 'c0c6b0ccf4e95c817f33cc29f4571704', '崔韬', '0', '5', '18581858587', '0', '2014-04-11', '3', 'sam.cui@faureciaxuyang.com', '2014-11-06 18:37:56');
INSERT INTO op_userinfo VALUES ('1000140', '28004026', 'star.wu', '827ccb0eea8a706c4c34a16891f84e7b', '吴芑欣', '0', '5', '13648047237', '0', '2011-12-14', '7', 'star.wu@faureciaxuyang.com', '2014-09-29 10:25:47');
INSERT INTO op_userinfo VALUES ('1000142', '28003940', 'rui.wang', 'e10adc3949ba59abbe56e057f20f883e', '王锐', '0', '1', '13330963820', '0', '2011-11-01', '3', 'rui.wang@faureciaxuyang.com', '2014-11-06 15:11:42');
INSERT INTO op_userinfo VALUES ('1000143', '10000000', 'admin', 'f5bb0c8de146c67b44babbf4e6584cc0', '超级管理员', '0', '2', '', '0', null, '6', '', '2014-11-06 15:19:39');
INSERT INTO op_userinfo VALUES ('1000144', '28004024', 'yongling.huang', 'a2c3b1d364cea29dc18e7f64d1b0aa47', '黄永灵', '0', '5', '15282396513', '0', '2012-11-08', '3', 'logistical.cfxas-cd@faureciaxyang.com', '2014-11-06 19:48:39');
INSERT INTO op_userinfo VALUES ('1000145', '28004044', 'jian.lin', '827ccb0eea8a706c4c34a16891f84e7b', '林建', '0', '5', '15982893659', '0', '2013-04-15', '3', 'logistical.cfxas-cd@faureciaxyang.com', '2014-11-03 17:00:39');
INSERT INTO op_userinfo VALUES ('1000146', '28009160', 'fang.li', '8b22d59ba6582c1724a1bf15d1b94ef2', '李放', '0', '5', '18583223080', '0', '2014-01-03', '3', 'logistical.cfxas-cd@faureciaxyang.com', '2014-11-07 14:53:03');
INSERT INTO op_userinfo VALUES ('1000147', '28004035', 'shi.wang', '827ccb0eea8a706c4c34a16891f84e7b', '王实', '1', '5', '15680691988 ', '0', '2013-01-02', '3', 'logistical.cfxas-cd@faureciaxyang.com', '2014-11-03 16:59:42');
INSERT INTO op_userinfo VALUES ('1000148', '28003932', 'peng.lei', '827ccb0eea8a706c4c34a16891f84e7b', '雷鹏', '0', '6', '15982027247', '0', '2011-08-25', '3', 'peng.lei@faureciaxuyang.com', '2014-11-06 15:47:12');
INSERT INTO op_userinfo VALUES ('1000149', '28005808', 'chuangang.peng', '107882762b3c233c4ff8b910374d3ae7', '彭传刚', '0', '6', '15928688317', '0', '2013-07-01', '3', 'chuangang.peng@faureciaxuyang.com', '2014-11-06 16:23:00');
INSERT INTO op_userinfo VALUES ('1000150', '28009162', 'rong.wang', '827ccb0eea8a706c4c34a16891f84e7b', '王荣', '0', '6', '18030501660', '0', '2014-01-14', '3', 'rong.wang@faureciaxuyang.com', '2014-11-06 15:47:49');
INSERT INTO op_userinfo VALUES ('1000151', '28003903', 'jian.yang', '9bf3da5fa6dc05bae89b5544de084513', '杨健', '0', '8', '18180624000', '0', '2012-06-14', '3', 'sales.cfxas-cd@faureciaxuyang.com', '2014-11-07 12:26:34');
INSERT INTO op_userinfo VALUES ('1000152', '28003904', 'jian.zhang', '827ccb0eea8a706c4c34a16891f84e7b', '张建', '0', '8', '13688078206', '0', '2012-09-19', '3', 'sales.cfxas-cd@faureciaxuyang.com', '2014-11-06 15:50:19');
INSERT INTO op_userinfo VALUES ('1000153', '28003921', 'fulai.huang', '2beda422a9d4c2bb3f22fc744689a85d', '黄付来', '0', '4', '13018275637', '0', '2011-04-01', '3', 'huayi.yang@faureciaxuyang.com', '2014-11-06 18:51:30');
INSERT INTO op_userinfo VALUES ('1000154', '28003925', 'liang.zeng', '32198c8c69f563bdb133e2abf945147d', '曾亮', '0', '4', '13551351033', '0', '2011-11-01', '3', 'liang.zeng@faureciaxuyang.com', '2014-11-06 15:48:27');
INSERT INTO op_userinfo VALUES ('1000155', '28003939', 'bo.wang', '827ccb0eea8a706c4c34a16891f84e7b', '王波', '0', '1', '18010556829', '0', '2011-02-20', '3', 'bowb.wang@faureciaxuyang.com', '2014-10-22 15:02:30');
INSERT INTO op_userinfo VALUES ('1000156', '28003941', 'xiaojie.zhang', '25f9e794323b453885f5181f1b624d0b', '张小杰', '0', '1', '18702832785', '0', '2011-11-01', '3', 'xiaojie.zhang@faureciaxuyang.com', '2014-11-06 15:11:37');
INSERT INTO op_userinfo VALUES ('1000157', '28003944', 'yuejun.zeng', '472563ee662f001ed3d0fa91e3dd4fb3', '曾跃俊', '0', '1', '13982099396', '0', '2011-12-26', '3', 'yuejun.zeng@faureciaxuyang.com', '2014-11-06 15:06:42');
INSERT INTO op_userinfo VALUES ('1000158', '28003951', 'dong.yu', '5ceb6bdb3870813fa779c28740a52a13', '余东', '0', '1', '13281222153', '0', '2012-03-05', '3', 'dong.yu@faureciaxuyang.com', '2014-11-06 18:48:44');
INSERT INTO op_userinfo VALUES ('1000159', '28003955', 'dailiang.wu', '827ccb0eea8a706c4c34a16891f84e7b', '吴代亮', '0', '1', '18208118356', '0', '2012-03-27', '3', 'dailiang.wu@faureciaxuyang.com', '2014-10-22 15:05:12');
INSERT INTO op_userinfo VALUES ('1000160', '28003956', 'lin.qiu', '827ccb0eea8a706c4c34a16891f84e7b', '邱林', '0', '1', '18008010455', '0', '2012-04-09', '3', 'lin.qiu@faureciaxuyang.com', '2014-10-22 15:05:46');
INSERT INTO op_userinfo VALUES ('1000161', '28003957', 'tanglin.she', '827ccb0eea8a706c4c34a16891f84e7b', '佘唐林', '0', '1', '15208396360', '0', '2012-04-11', '3', 'tanglin.she@faureciaxuyang.com', '2014-10-22 15:06:09');
INSERT INTO op_userinfo VALUES ('1000162', '28006504', 'yi.zhao', '827ccb0eea8a706c4c34a16891f84e7b', '赵毅', '0', '4', '13880236563', '0', '2013-10-14', '3', 'yi.zhao@faureciaxuyang.com', '2014-11-06 17:36:56');
INSERT INTO op_userinfo VALUES ('1000163', '28009632', 'bely.zhang', '827ccb0eea8a706c4c34a16891f84e7b', '张莉', '0', '5', '13550216512', '0', '2014-03-10', '3', 'bely.zhang@faureciaxuyang.com', '2014-11-03 17:06:29');
INSERT INTO op_userinfo VALUES ('1000164', '28010370', 'miao.zhang', '827ccb0eea8a706c4c34a16891f84e7b', '张淼', '0', '5', '13550245225', '0', '2014-05-05', '3', 'miao.zhang@faureciaxyang.com', '2014-11-03 17:07:34');
INSERT INTO op_userinfo VALUES ('1000165', '28004031', 'hua.li', '827ccb0eea8a706c4c34a16891f84e7b', '李华', '0', '5', '15982083578', '0', '2012-05-24', '3', 'logistical.cfxas-cd@faureciaxyang.com', '2014-10-24 10:31:22');
INSERT INTO op_userinfo VALUES ('1000166', '28004033', 'guizhong.ye', '827ccb0eea8a706c4c34a16891f84e7b', '叶桂忠', '0', '5', '13693447456', '0', '2012-05-28', '3', 'logistical.cfxas-cd@faureciaxyang.com', '2014-10-24 10:31:35');
INSERT INTO op_userinfo VALUES ('1000167', '28004037', 'zhoudong.yin', '827ccb0eea8a706c4c34a16891f84e7b', '尹周东', '0', '5', '18202828746', '0', '2013-02-19', '3', 'logistical.cfxas-cd@faureciaxyang.com', '2014-10-24 10:32:24');
INSERT INTO op_userinfo VALUES ('1000168', '28010007', 'hong.liu', '827ccb0eea8a706c4c34a16891f84e7b', '刘鸿', '0', '5', '13688144086', '0', '2014-04-03', '3', 'logistical.cfxas-cd@faureciaxyang.com', '2014-10-24 10:33:00');
INSERT INTO op_userinfo VALUES ('1000169', '28003985', 'liang.chen', '827ccb0eea8a706c4c34a16891f84e7b', '陈亮', '0', '1', '13880383617', '0', '2012-07-06', '3', 'xiaojie.zhang@faureciaxuyang.com', '2014-10-24 11:16:24');
INSERT INTO op_userinfo VALUES ('1000170', '28003946', 'rui.gao', '827ccb0eea8a706c4c34a16891f84e7b', '高锐', '0', '1', '14780131873', '0', '2012-02-02', '3', 'rui.gao@faureciaxuyang.com', '2014-10-24 11:17:16');
INSERT INTO op_userinfo VALUES ('1000171', '28003942', 'hao.li', '827ccb0eea8a706c4c34a16891f84e7b', '李浩', '0', '1', '13709047854', '0', '2011-11-01', '3', 'hao.li@faureciaxuyang.com', '2014-10-24 11:18:06');
INSERT INTO op_userinfo VALUES ('1000172', '28003983', 'kaixuan.huang', '827ccb0eea8a706c4c34a16891f84e7b', '黄凯旋', '0', '1', '15982112257', '0', '2012-07-05', '3', 'dong.yu@faureciaxuyang.com', '2014-10-31 13:52:46');
INSERT INTO op_userinfo VALUES ('1000173', '28005651', 'bin.zhang', '827ccb0eea8a706c4c34a16891f84e7b', '张彬', '0', '1', '13458649297', '0', '2013-05-16', '3', 'peng.lei@faureciaxuyang.com', '2014-10-24 11:20:01');
INSERT INTO op_userinfo VALUES ('1000174', '10000001', 'dailiang.wu1', '827ccb0eea8a706c4c34a16891f84e7b', 'wudailiang', '0', '1', '', '0', null, '3', 'dailiang.wu@faurecixuyang.com', '2014-10-31 14:20:57');
INSERT INTO op_userinfo VALUES ('1000175', '10000002', 'xiaojie.zhang1', '25f9e794323b453885f5181f1b624d0b', 'zhangxiaojie', '0', '1', '', '0', null, '3', 'xiaojie.zhang@faureciaxuyang.com', '2014-11-06 15:12:33');
INSERT INTO op_userinfo VALUES ('1000176', '10000003', 'lin.qiu1', '827ccb0eea8a706c4c34a16891f84e7b', 'qiulin', '0', '1', '', '0', null, '3', 'lin.qiu@faureciaxuyang.com', '2014-10-31 14:21:14');
INSERT INTO op_userinfo VALUES ('1000177', '10000004', 'yuejun.zeng1', '472563ee662f001ed3d0fa91e3dd4fb3', 'zengyuejun', '0', '1', '', '0', null, '3', 'yuejun.zeng@faureciaxuyang.com', '2014-11-06 15:05:52');
INSERT INTO op_userinfo VALUES ('1000178', '10000005', 'bo.wang1', '827ccb0eea8a706c4c34a16891f84e7b', 'wangbo', '0', '1', '', '0', null, '3', 'bowb.wang@faureciaxuyang.com', '2014-10-31 14:21:30');
INSERT INTO op_userinfo VALUES ('1000179', '10000006', 'tanglin.she1', '827ccb0eea8a706c4c34a16891f84e7b', 'shetanglin', '0', '1', '', '0', null, '3', 'tanglin.she@faureciaxuyang.com', '2014-10-31 14:21:45');
INSERT INTO op_userinfo VALUES ('1000180', '10000007', 'dong.yu1', '827ccb0eea8a706c4c34a16891f84e7b', 'yudong', '0', '1', '', '0', null, '3', 'dong.yu@faureciaxuyang.com', '2014-10-31 14:21:51');
INSERT INTO op_userinfo VALUES ('1000181', '10000008', 'rui.wang1', 'e10adc3949ba59abbe56e057f20f883e', 'wangrui', '0', '1', '', '0', null, '3', 'rui.wang@faureciaxuyang.com', '2014-11-06 15:12:35');
INSERT INTO op_userinfo VALUES ('1000182', '28004027', 'kai.zeng', '827ccb0eea8a706c4c34a16891f84e7b', '曾凯', '0', '5', '15828686812', '0', '2012-04-25', '3', 'logistical.cfxas-cd@faureciaxyang.com', '2014-11-03 16:56:28');
INSERT INTO op_userinfo VALUES ('1000183', '28004034', 'xiaolin.guo', '827ccb0eea8a706c4c34a16891f84e7b', '郭小林', '0', '5', '18215671018', '0', '2012-07-03', '3', 'logistical.cfxas-cd@faureciaxyang.com', '2014-11-03 16:56:52');
INSERT INTO op_userinfo VALUES ('1000184', '28004043', 'jiayuan.lv', '827ccb0eea8a706c4c34a16891f84e7b', '吕家元', '0', '5', '18380496726', '0', '2013-03-20', '3', 'logistical.cfxas-cd@faureciaxyang.com', '2014-11-03 17:00:05');
INSERT INTO op_userinfo VALUES ('1000185', '28004046', 'yiqiang.xiong', '827ccb0eea8a706c4c34a16891f84e7b', '熊益强', '0', '5', '15528159558', '0', '2013-04-23', '3', 'logistical.cfxas-cd@faureciaxyang.com', '2014-11-03 17:00:59');
INSERT INTO op_userinfo VALUES ('1000186', '28005814', 'tinjun.kuang', '827ccb0eea8a706c4c34a16891f84e7b', '匡廷军', '0', '5', '15520463684', '0', '2013-06-27', '3', 'logistical.cfxas-cd@faureciaxyang.com', '2014-11-03 17:03:06');
INSERT INTO op_userinfo VALUES ('1000187', '28005885', 'yuantao.huang', '827ccb0eea8a706c4c34a16891f84e7b', '黄远涛', '0', '5', '18380238923', '0', '2013-07-12', '3', 'logistical.cfxas-cd@faureciaxyang.com', '2014-11-03 17:03:51');
INSERT INTO op_userinfo VALUES ('1000188', '28009393', 'peng.wang', '827ccb0eea8a706c4c34a16891f84e7b', '王鹏', '0', '5', '15390441975', '0', '2014-02-12', '3', 'logistical.cfxas-cd@faureciaxyang.com', '2014-11-03 17:04:45');
INSERT INTO op_userinfo VALUES ('1000189', '28009394', 'qianliang.dong', '827ccb0eea8a706c4c34a16891f84e7b', '董千亮', '0', '5', '15828417821', '0', '2014-02-12', '3', 'logistical.cfxas-cd@faureciaxyang.com', '2014-11-03 17:05:21');
INSERT INTO op_userinfo VALUES ('1000190', '28009631', 'yanping.yuan', '827ccb0eea8a706c4c34a16891f84e7b', '袁宴平', '0', '5', '13558894347', '0', '2014-02-17', '3', 'logistical.cfxas-cd@faureciaxyang.com', '2014-11-03 17:05:49');
INSERT INTO op_userinfo VALUES ('1000191', '28010366', 'hui.guo', '827ccb0eea8a706c4c34a16891f84e7b', '郭会', '0', '5', '18382058189', '0', '2014-04-18', '3', 'logistical.cfxas-cd@faureciaxyang.com', '2014-11-03 17:06:50');
INSERT INTO op_userinfo VALUES ('1000192', '28010368', 'zonggang.yang', '827ccb0eea8a706c4c34a16891f84e7b', '杨宗刚', '0', '5', '13551897924', '0', '2014-04-21', '3', 'logistical.cfxas-cd@faureciaxyang.com', '2014-11-03 17:07:14');
INSERT INTO op_userinfo VALUES ('1000193', '28010686', 'bo.chen', '827ccb0eea8a706c4c34a16891f84e7b', '陈波', '0', '5', '13880608089', '0', '2014-06-03', '3', 'logistical.cfxas-cd@faureciaxyang.com', '2014-11-03 17:07:55');
INSERT INTO op_userinfo VALUES ('1000194', '28010999', 'lei.zhong', '827ccb0eea8a706c4c34a16891f84e7b', '钟磊', '0', '5', '15008253670', '0', '2014-06-17', '3', 'logistical.cfxas-cd@faureciaxyang.com', '2014-11-03 17:08:20');
INSERT INTO op_userinfo VALUES ('1000195', '28011001', 'xu.tan', '827ccb0eea8a706c4c34a16891f84e7b', '谭旭', '0', '5', '18284583181', '0', '2014-06-23', '3', 'logistical.cfxas-cd@faureciaxyang.com', '2014-11-03 17:08:56');
INSERT INTO op_userinfo VALUES ('1000196', '28011002', 'zongfu.pei', '827ccb0eea8a706c4c34a16891f84e7b', '裴宗福', '0', '5', '13568958425', '0', '2014-06-23', '3', 'logistical.cfxas-cd@faureciaxyang.com', '2014-11-03 17:09:40');
INSERT INTO op_userinfo VALUES ('1000197', '28011450', 'xiang.han', '827ccb0eea8a706c4c34a16891f84e7b', '韩翔', '0', '5', '18200385477', '0', '2014-08-04', '3', 'logistical.cfxas-cd@faureciaxyang.com', '2014-11-03 17:10:01');
INSERT INTO op_userinfo VALUES ('1000198', '28011451', 'guoqiang.lu', '827ccb0eea8a706c4c34a16891f84e7b', '卢国强', '0', '5', '13488985953', '0', '2014-08-08', '3', 'logistical.cfxas-cd@faureciaxyang.com', '2014-11-03 17:10:25');
INSERT INTO op_userinfo VALUES ('1000199', '28011640', 'jian.zou', '827ccb0eea8a706c4c34a16891f84e7b', '邹建', '0', '5', '15547990807', '0', '2014-08-30', '3', 'logistical.cfxas-cd@faureciaxyang.com', '2014-11-03 17:10:59');
INSERT INTO op_userinfo VALUES ('1000200', '44444444', 'xiaowu.li', '827ccb0eea8a706c4c34a16891f84e7b', '李晓伍', '0', '5', '13547990870', '0', '2014-09-18', '3', 'logistical.cfxas-cd@faureciaxyang.com', '2014-11-03 17:11:23');
INSERT INTO op_userinfo VALUES ('1000201', '33333333', 'minyang.peng', '827ccb0eea8a706c4c34a16891f84e7b', '彭闵扬', '0', '1', '13880927995', '0', '2014-09-17', '3', 'rui.wang@faureciaxuyang.com', '2014-11-05 16:27:47');
INSERT INTO op_userinfo VALUES ('1000202', '28005807', 'chao.fang', '6f1a2c24c6bcf400e15b24c09c234e67', '方超', '0', '4', '13348916512', '0', '2013-07-04', '3', 'fulai.huang@faureciaxuyang.com', '2014-11-07 17:53:44');
INSERT INTO op_userinfo VALUES ('1000203', '28011446', 'yongchuan.feng', '733d7be2196ff70efaf6913fc8bdcabf', '封永川', '0', '4', '15882071568', '0', '2014-08-04', '3', 'yongchuan.feng@faureciaxuyang.com', '2014-11-07 11:50:51');
INSERT INTO op_userinfo VALUES ('1000204', '00000000', 'shiree.liu', '827ccb0eea8a706c4c34a16891f84e7b', '刘爽', '0', '2', '', '0', '2014-11-12', '4', 'shiree.liu@faurecixuyang.com', '2014-11-07 11:08:25');
INSERT INTO op_userinfo VALUES ('1000205', '28012017', 'yoyo.chen', '827ccb0eea8a706c4c34a16891f84e7b', '陈柚君', '0', '2', '13693431023', '0', '2014-10-08', '7', 'yoyo.chen@faureciaxuyang.com', '2014-11-07 11:13:15');

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
INSERT INTO op_usertype VALUES ('1', '现场员工', 'staff_menu.json', '1');
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
  `cwid` int(11) DEFAULT NULL,
  `begindate` date DEFAULT NULL,
  `begintime` time DEFAULT NULL,
  `enddate` date DEFAULT NULL,
  `endtime` time DEFAULT NULL,
  `applytime` datetime DEFAULT NULL,
  `reason` varchar(300) DEFAULT NULL,
  `stayfee` varchar(20) DEFAULT NULL,
  `foodfee` varchar(20) DEFAULT NULL,
  `otherfee` varchar(20) DEFAULT NULL,
  `totalfee` char(40) DEFAULT NULL,
  `place` varchar(200) DEFAULT NULL,
  `ccbz` varchar(200) DEFAULT NULL,
  `holiday` char(40) DEFAULT NULL,
  `transpot` char(40) DEFAULT NULL,
  `days` float DEFAULT NULL,
  `reject_reason` varchar(255) DEFAULT NULL,
  `flag` int(11) DEFAULT NULL,
  `ispl` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=303 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of op_vacationstatus
-- ----------------------------
INSERT INTO op_vacationstatus VALUES ('294', '28003940', '1', '3', '0', '0', '28003934', null, null, null, '2014-11-19', '08:30:00', '2014-11-28', '17:30:00', '2014-11-06 14:39:46', null, null, null, null, null, null, null, '陪产假', null, null, null, null, null);
INSERT INTO op_vacationstatus VALUES ('295', '28010363', '1', '1', '0', '0', '28003934', null, null, null, '2014-11-02', '16:30:00', '2014-11-02', '17:30:00', '2014-11-07 20:01:43', '周末5S大扫除', null, null, null, null, null, null, null, null, '1', null, null, '1');
INSERT INTO op_vacationstatus VALUES ('296', '28009619', '1', '1', '0', '0', '28003934', null, null, null, '2014-11-02', '16:30:00', '2014-11-02', '17:30:00', '2014-11-07 20:01:43', '周末5S大扫除', null, null, null, null, null, null, null, null, '1', null, null, '1');
INSERT INTO op_vacationstatus VALUES ('297', '28005883', '1', '1', '0', '0', '28003934', null, null, null, '2014-11-02', '16:30:00', '2014-11-02', '17:30:00', '2014-11-07 20:01:43', '周末5S大扫除', null, null, null, null, null, null, null, null, '1', null, null, '1');
INSERT INTO op_vacationstatus VALUES ('298', '28003990', '1', '1', '0', '0', '28003934', null, null, null, '2014-11-02', '16:30:00', '2014-11-02', '17:30:00', '2014-11-07 20:01:43', '周末5S大扫除', null, null, null, null, null, null, null, null, '1', null, null, '1');
INSERT INTO op_vacationstatus VALUES ('299', '28003955', '1', '1', '0', '0', '28003934', null, null, null, '2014-11-02', '16:30:00', '2014-11-02', '17:30:00', '2014-11-07 20:01:43', '周末5S大扫除', null, null, null, null, null, null, null, null, '1', null, null, '1');
INSERT INTO op_vacationstatus VALUES ('300', '10000001', '1', '1', '0', '0', '28003934', null, null, null, '2014-11-02', '16:30:00', '2014-11-02', '17:30:00', '2014-11-07 20:08:54', '周末5S打扫', null, null, null, null, null, null, null, null, '1', null, null, '1');
INSERT INTO op_vacationstatus VALUES ('301', '28009624', '1', '1', '0', '0', '28003934', null, null, null, '2014-11-02', '16:30:00', '2014-11-02', '17:30:00', '2014-11-07 20:08:54', '周末5S打扫', null, null, null, null, null, null, null, null, '1', null, null, '1');
INSERT INTO op_vacationstatus VALUES ('302', '28005809', '1', '1', '0', '0', '28003934', null, null, null, '2014-11-02', '16:30:00', '2014-11-02', '17:30:00', '2014-11-07 20:08:54', '周末5S打扫', null, null, null, null, null, null, null, null, '1', null, null, '1');

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
  `uid` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=234 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of op_worktime
-- ----------------------------
INSERT INTO op_worktime VALUES ('151', '59', '2014-11-01', '08:00:00', '2014-11-30', '16:30:00', null);
INSERT INTO op_worktime VALUES ('152', '34', '2014-11-07', '08:00:00', '2014-11-07', '17:30:00', null);
INSERT INTO op_worktime VALUES ('153', '34', '2014-11-08', '08:30:00', '2014-11-08', '17:00:00', null);
INSERT INTO op_worktime VALUES ('154', '1', '2014-11-03', '08:30:00', '2014-11-07', '17:00:00', null);
INSERT INTO op_worktime VALUES ('155', '1', '2014-11-10', '08:30:00', '2014-11-14', '17:00:00', null);
INSERT INTO op_worktime VALUES ('156', '1', '2014-11-17', '08:30:00', '2014-11-21', '17:00:00', null);
INSERT INTO op_worktime VALUES ('159', '26', '2014-11-03', '08:00:00', '2014-11-08', '17:30:00', null);
INSERT INTO op_worktime VALUES ('158', '1', '2014-11-24', '08:30:00', '2014-11-28', '17:00:00', null);
INSERT INTO op_worktime VALUES ('160', '37', '2014-11-03', '08:00:00', '2014-11-08', '16:30:00', null);
INSERT INTO op_worktime VALUES ('161', '1', '2014-12-01', '08:30:00', '2014-12-05', '17:00:00', null);
INSERT INTO op_worktime VALUES ('162', '1', '2014-12-08', '08:30:00', '2014-12-12', '17:00:00', null);
INSERT INTO op_worktime VALUES ('163', '33', '2014-11-12', '08:30:00', '2014-11-16', '17:30:00', null);
INSERT INTO op_worktime VALUES ('164', '13', '2014-11-03', '17:30:00', '2014-11-08', '03:00:00', null);
INSERT INTO op_worktime VALUES ('165', '28', '2014-11-06', '16:30:00', '2014-11-08', '02:00:00', null);
INSERT INTO op_worktime VALUES ('187', '19', '2014-11-01', '20:00:00', '2014-11-08', '08:00:00', null);
INSERT INTO op_worktime VALUES ('167', '17', '2014-11-10', '08:00:00', '2014-11-15', '17:30:00', null);
INSERT INTO op_worktime VALUES ('183', '14', '2014-11-10', '08:00:00', '2014-11-14', '18:00:00', null);
INSERT INTO op_worktime VALUES ('169', '55', '2014-11-07', '08:00:00', '2014-11-08', '17:30:00', null);
INSERT INTO op_worktime VALUES ('170', '31', '2014-11-07', '08:00:00', '2014-11-08', '17:30:00', null);
INSERT INTO op_worktime VALUES ('171', '64', '2014-11-08', '08:00:00', '2014-11-08', '17:30:00', null);
INSERT INTO op_worktime VALUES ('172', '60', '2014-11-07', '08:00:00', '2014-11-08', '17:30:00', null);
INSERT INTO op_worktime VALUES ('173', '47', '2014-11-07', '08:00:00', '2014-11-08', '17:30:00', null);
INSERT INTO op_worktime VALUES ('174', '63', '2014-11-07', '08:00:00', '2014-11-08', '17:30:00', null);
INSERT INTO op_worktime VALUES ('175', '58', '2014-11-07', '08:00:00', '2014-11-08', '17:30:00', null);
INSERT INTO op_worktime VALUES ('176', '48', '2014-11-07', '08:00:00', '2014-11-08', '20:00:00', null);
INSERT INTO op_worktime VALUES ('178', '67', '2014-11-07', '08:00:00', '2014-11-08', '17:30:00', null);
INSERT INTO op_worktime VALUES ('179', '12', '2014-11-01', '18:30:00', '2014-11-01', '05:30:00', null);
INSERT INTO op_worktime VALUES ('180', '12', '2014-11-03', '08:00:00', '2014-11-08', '17:30:00', null);
INSERT INTO op_worktime VALUES ('181', '14', '2014-11-01', '08:00:00', '2014-11-01', '17:30:00', null);
INSERT INTO op_worktime VALUES ('182', '14', '2014-11-03', '08:00:00', '2014-11-08', '17:30:00', null);
INSERT INTO op_worktime VALUES ('184', '18', '2014-11-01', '08:30:00', '2014-11-08', '20:30:00', null);
INSERT INTO op_worktime VALUES ('185', '18', '2014-11-10', '20:00:00', '2014-11-22', '08:00:00', null);
INSERT INTO op_worktime VALUES ('186', '12', '2014-11-10', '17:30:00', '2014-11-15', '03:00:00', null);
INSERT INTO op_worktime VALUES ('188', '19', '2014-11-10', '08:30:00', '2014-11-22', '20:30:00', null);
INSERT INTO op_worktime VALUES ('190', '15', '2014-11-01', '18:30:00', '2014-11-02', '05:30:00', null);
INSERT INTO op_worktime VALUES ('192', '15', '2014-11-03', '08:00:00', '2014-11-08', '17:30:00', null);
INSERT INTO op_worktime VALUES ('193', '15', '2014-11-10', '17:30:00', '2014-11-16', '03:00:00', null);
INSERT INTO op_worktime VALUES ('204', '13', '2014-11-02', '08:00:00', '2014-11-02', '16:30:00', null);
INSERT INTO op_worktime VALUES ('203', '13', '2014-11-01', '08:00:00', '2014-11-01', '18:30:00', null);
INSERT INTO op_worktime VALUES ('200', '16', '2014-11-01', '08:00:00', '2014-11-08', '18:00:00', null);
INSERT INTO op_worktime VALUES ('201', '16', '2014-11-10', '08:00:00', '2014-11-15', '18:00:00', null);
INSERT INTO op_worktime VALUES ('202', '13', '2014-11-10', '08:00:00', '2014-11-16', '17:30:00', null);
INSERT INTO op_worktime VALUES ('205', '4', '2014-11-01', '08:00:00', '2014-11-01', '19:00:00', null);
INSERT INTO op_worktime VALUES ('206', '4', '2014-11-02', '08:00:00', '2014-11-02', '19:00:00', null);
INSERT INTO op_worktime VALUES ('207', '4', '2014-11-03', '17:30:00', '2014-11-08', '03:00:00', null);
INSERT INTO op_worktime VALUES ('208', '4', '2014-11-10', '08:00:00', '2014-11-15', '17:30:00', null);
INSERT INTO op_worktime VALUES ('210', '2', '2014-11-01', '08:00:00', '2014-11-01', '19:00:00', null);
INSERT INTO op_worktime VALUES ('211', '2', '2014-11-02', '08:00:00', '2014-11-02', '16:30:00', null);
INSERT INTO op_worktime VALUES ('223', '38', '2014-11-01', '08:00:00', '2014-11-01', '19:00:00', null);
INSERT INTO op_worktime VALUES ('222', '4', '2014-11-16', '08:00:00', '2014-11-16', '16:30:00', null);
INSERT INTO op_worktime VALUES ('224', '38', '2014-11-02', '08:00:00', '2014-11-02', '16:30:00', null);
INSERT INTO op_worktime VALUES ('215', '2', '2014-11-04', '17:30:00', '2014-11-08', '03:00:00', null);
INSERT INTO op_worktime VALUES ('216', '40', '2014-11-01', '08:00:00', '2014-11-01', '19:00:00', null);
INSERT INTO op_worktime VALUES ('217', '40', '2014-11-02', '08:00:00', '2014-11-02', '17:00:00', null);
INSERT INTO op_worktime VALUES ('218', '40', '2014-11-03', '17:30:00', '2014-11-08', '02:00:00', null);
INSERT INTO op_worktime VALUES ('219', '40', '2014-11-10', '08:00:00', '2014-11-12', '16:30:00', null);
INSERT INTO op_worktime VALUES ('220', '40', '2014-11-13', '08:00:00', '2014-11-15', '17:30:00', null);
INSERT INTO op_worktime VALUES ('221', '40', '2014-11-09', '08:00:00', '2014-11-09', '16:30:00', null);
INSERT INTO op_worktime VALUES ('225', '38', '2014-11-03', '17:30:00', '2014-11-08', '03:00:00', null);
INSERT INTO op_worktime VALUES ('227', '42', '2014-11-01', '08:00:00', '2014-11-02', '17:30:00', null);
INSERT INTO op_worktime VALUES ('228', '42', '2014-11-03', '17:30:00', '2014-11-08', '02:00:00', null);
INSERT INTO op_worktime VALUES ('229', '6', '2014-11-01', '08:00:00', '2014-11-02', '17:30:00', null);
INSERT INTO op_worktime VALUES ('230', '6', '2014-11-03', '17:30:00', '2014-11-08', '02:00:00', null);
INSERT INTO op_worktime VALUES ('231', '28', '2014-11-01', '08:00:00', '2014-11-02', '16:30:00', null);
INSERT INTO op_worktime VALUES ('232', '28', '2014-11-03', '16:30:00', '2014-11-05', '03:00:00', null);
INSERT INTO op_worktime VALUES ('233', '28', '2014-11-10', '08:00:00', '2014-11-16', '18:00:00', null);
