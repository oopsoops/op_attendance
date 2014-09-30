/*
Navicat MySQL Data Transfer

Source Server         : manage
Source Server Version : 50515
Source Host           : localhost:3306
Source Database       : op_attendance

Target Server Type    : MYSQL
Target Server Version : 50515
File Encoding         : 65001

Date: 2014-10-01 00:58:20
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
INSERT INTO `op_config` VALUES ('1', '0.05');

-- ----------------------------
-- Table structure for `op_department`
-- ----------------------------
DROP TABLE IF EXISTS `op_department`;
CREATE TABLE `op_department` (
  `did` int(11) NOT NULL AUTO_INCREMENT,
  `departmentname` varchar(255) NOT NULL,
  PRIMARY KEY (`did`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of op_department
-- ----------------------------
INSERT INTO `op_department` VALUES ('1', '生产部');
INSERT INTO `op_department` VALUES ('2', '人事部');
INSERT INTO `op_department` VALUES ('3', '财务部');
INSERT INTO `op_department` VALUES ('4', '质量部');
INSERT INTO `op_department` VALUES ('5', '物流部');
INSERT INTO `op_department` VALUES ('6', '工程部');
INSERT INTO `op_department` VALUES ('7', '总经办');

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
) ENGINE=MyISAM AUTO_INCREMENT=81 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of op_log
-- ----------------------------
INSERT INTO `op_log` VALUES ('1', '1002', '2014-09-12 23:45:42', null);
INSERT INTO `op_log` VALUES ('2', '1002', '2014-09-16 00:56:35', null);
INSERT INTO `op_log` VALUES ('3', '1003', '2014-09-16 00:57:56', null);
INSERT INTO `op_log` VALUES ('4', '1004', '2014-09-16 00:58:29', null);
INSERT INTO `op_log` VALUES ('5', '1003', '2014-09-17 23:46:54', null);
INSERT INTO `op_log` VALUES ('6', '1003', '2014-09-22 01:01:28', null);
INSERT INTO `op_log` VALUES ('7', '1004', '2014-09-22 01:04:56', null);
INSERT INTO `op_log` VALUES ('8', '1003', '2014-09-22 01:06:05', null);
INSERT INTO `op_log` VALUES ('9', '1003', '2014-09-22 01:31:37', null);
INSERT INTO `op_log` VALUES ('10', '1003', '2014-09-25 07:57:31', null);
INSERT INTO `op_log` VALUES ('11', '1002', '2014-09-26 07:55:07', null);
INSERT INTO `op_log` VALUES ('12', '1003', '2014-09-27 12:06:45', null);
INSERT INTO `op_log` VALUES ('13', '1004', '2014-09-27 12:07:48', null);
INSERT INTO `op_log` VALUES ('14', '1002', '2014-09-27 12:08:26', null);
INSERT INTO `op_log` VALUES ('15', '1002', '2014-09-27 12:14:55', null);
INSERT INTO `op_log` VALUES ('16', '1002', '2014-09-27 21:15:41', null);
INSERT INTO `op_log` VALUES ('17', '1005', '2014-09-27 21:15:58', null);
INSERT INTO `op_log` VALUES ('18', '1002', '2014-09-27 21:16:50', null);
INSERT INTO `op_log` VALUES ('19', '1002', '2014-09-27 21:18:33', null);
INSERT INTO `op_log` VALUES ('20', '1002', '2014-09-27 21:20:28', null);
INSERT INTO `op_log` VALUES ('21', '1002', '2014-09-27 21:26:04', null);
INSERT INTO `op_log` VALUES ('22', '1004', '2014-09-27 21:27:39', null);
INSERT INTO `op_log` VALUES ('23', '1004', '2014-09-28 21:06:51', null);
INSERT INTO `op_log` VALUES ('78', '1002', '2014-09-30 00:41:20', null);
INSERT INTO `op_log` VALUES ('54', '1004', '2014-09-29 07:44:58', null);
INSERT INTO `op_log` VALUES ('55', '1005', '2014-09-29 07:45:50', null);
INSERT INTO `op_log` VALUES ('57', '1004', '2014-09-29 08:02:18', null);
INSERT INTO `op_log` VALUES ('58', '1005', '2014-09-29 08:03:02', null);
INSERT INTO `op_log` VALUES ('61', '1003', '2014-09-30 00:06:36', null);
INSERT INTO `op_log` VALUES ('62', '1004', '2014-09-30 00:07:10', null);
INSERT INTO `op_log` VALUES ('63', '1003', '2014-09-30 00:07:51', null);
INSERT INTO `op_log` VALUES ('64', '1004', '2014-09-30 00:08:31', null);
INSERT INTO `op_log` VALUES ('65', '1004', '2014-09-30 00:27:09', null);
INSERT INTO `op_log` VALUES ('66', '1005', '2014-09-30 00:27:32', null);
INSERT INTO `op_log` VALUES ('68', '1003', '2014-09-30 00:36:34', null);
INSERT INTO `op_log` VALUES ('80', '1004', '2014-09-30 00:49:38', null);
INSERT INTO `op_log` VALUES ('71', '1005', '2014-09-30 00:38:47', null);
INSERT INTO `op_log` VALUES ('75', '1003', '2014-09-30 00:40:18', null);

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
INSERT INTO `op_sample` VALUES ('888', '张XX', '1', '1', '2008-08-08', '2', '137XXXXXXXX', '2', 'oops@juying.com', '7', '3.5', '2.5', '6', '(可以为空）');

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
) ENGINE=MyISAM AUTO_INCREMENT=100582 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of op_staffinfo
-- ----------------------------
INSERT INTO `op_staffinfo` VALUES ('100581', '44444444', '李晓伍', '5', '13547990870', 'CD01L100', '2014-09-18', '1', '11', null, '2014-09-29 10:36:44', '0', '0.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100580', '28011640', '邹建', '5', '15547990807', 'CD01L100', '2014-08-30', '1', '11', null, '2014-09-29 10:36:44', '0', '0.9', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100579', '28011451', '卢国强', '5', '13488985953', 'CD01L100', '2014-08-08', '1', '10', null, '2014-09-29 10:36:44', '0', '1.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100578', '28011002', '裴宗福', '5', '13568958425', 'CD01L100', '2014-06-23', '1', '11', null, '2014-09-29 10:36:44', '0', '-0.3', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100577', '28011001', '谭旭', '5', '18284583181', 'CD01L100', '2014-06-23', '1', '11', null, '2014-09-29 10:36:44', '0', '-0.3', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100576', '28010999', '钟磊', '5', '15008253670', 'CD01L100', '2014-06-17', '1', '10', null, '2014-09-29 10:36:44', '0', '-0.1', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100575', '28010686', '陈波', '5', '13880608089', 'CD01L100', '2014-06-03', '1', '10', null, '2014-09-29 10:36:44', '0', '2', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100573', '28010368', '杨宗刚', '5', '13551897924', 'CD01L100', '2014-04-21', '1', '11', null, '2014-09-29 10:36:44', '0', '1.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100574', '28010370', '张淼', '5', '13550245225', 'CD01L100', '2014-05-05', '1', '20', null, '2014-09-29 10:36:44', '0', '0.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100572', '28010366', '郭会', '5', '18382058189', 'CD01L100', '2014-04-18', '1', '10', null, '2014-09-29 10:36:44', '0', '1', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100571', '28010007', '刘鸿', '5', '13688144086', 'CD01L100', '2014-04-03', '1', '11', null, '2014-09-29 10:36:44', '0', '2', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100570', '28009631', '袁宴平', '5', '13558894347', 'CD01L100', '2014-02-17', '1', '10', null, '2014-09-29 10:36:44', '0', '4.2', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100569', '28009394', '董千亮', '5', '15828417821', 'CD01L100', '2014-02-12', '1', '11', null, '2014-09-29 10:36:44', '0', '4.3', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100568', '28009393', '王鹏', '5', '15390441975', 'CD01L100', '2014-02-12', '1', '11', null, '2014-09-29 10:36:44', '0', '4.3', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100567', '28009160', '李放', '5', '18583223080', 'CD01L100', '2014-01-03', '1', '11', null, '2014-09-29 10:36:44', '0', '-0.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100566', '28005885', '黄远涛', '5', '18380238923', 'CD01L100', '2013-07-12', '1', '17', null, '2014-09-29 10:36:44', '0', '1.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100565', '28005814', '匡廷军', '5', '15520463684', 'CD01L100', '2013-06-27', '1', '11', null, '2014-09-29 10:36:44', '0', '0', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100564', '28004046', '熊益强', '5', '15528159558', 'CD01L100', '2013-04-23', '1', '11', null, '2014-09-29 10:36:44', '0', '1.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100563', '28004044', '林建', '5', '15982893659', 'CD01L100', '2013-04-15', '1', '10', null, '2014-09-29 10:36:44', '0', '-1.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100562', '28004043', '吕家元', '5', '18380496726', 'CD01L100', '2013-03-20', '1', '10', null, '2014-09-29 10:36:44', '0', '0', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100561', '28004037', '尹周东', '5', '18202828746', 'CD01L100', '2013-02-19', '1', '10', null, '2014-09-29 10:36:44', '0', '2', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100560', '28004035', '王实', '5', '15680691988 ', 'CD01L100', '2013-01-02', '1', '11', null, '2014-09-29 10:36:44', '0', '0', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100559', '28004034', '郭小林', '5', '18215671018', 'CD01L100', '2012-07-03', '1', '10', null, '2014-09-29 10:36:44', '0', '1.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100558', '28004033', '叶桂忠', '5', '13693447456', 'CD01L100', '2012-05-28', '1', '16', null, '2014-09-29 10:36:44', '0', '4.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100557', '28004031', '李华', '5', '15982083578', 'CD01L100', '2012-05-24', '1', '10', null, '2014-09-29 10:36:44', '0', '0', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100556', '28004027', '曾凯', '5', '15828686812', 'CD01L100', '2012-04-25', '1', '10', null, '2014-09-29 10:36:44', '0', '1', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100555', '28011450', '韩翔', '5', '18200385477', 'CD01L100', '2014-08-04', '1', '10', null, '2014-09-29 10:36:44', '0', '0.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100554', '28004024', '黄永灵', '5', '15282396513', 'CD01L100', '2012-11-08', '1', '10', null, '2014-09-29 10:36:44', '0', '0', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100553', '28009632', '张莉', '5', '13550216512', 'CD01L100', '2014-03-10', '1', '20', null, '2014-09-29 10:36:44', '0', '1.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100552', '28004026', '吴芑欣', '5', '13648047237', 'CD01L100', '2011-12-14', '7', '1', 'star.wu@faureciaxuyang.com', '2014-09-29 10:36:44', '0', '9.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100551', '28010002', '崔韬', '5', '18581858587', 'CD01L100', '2014-04-11', '7', '11', 'sam.cui@faureciaxuyang.com', '2014-09-29 10:36:44', '0', '10', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100550', '28004021', '李勇', '5', '18502866697', 'CD01L100', '2012-09-21', '7', '10', 'leo.li@faureciaxuyagn.com', '2014-09-29 10:36:44', '0', '8.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100549', '28011639', '孙铖', '5', '18828076656', 'CD01L100', '2014-09-01', '7', '1', 'charles.sun@faureciaxuyang.com', '2014-09-29 10:36:44', '0', '5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100548', '28004019', '李国琴', '5', '13488978182', 'CD01L100', '2011-04-12', '7', '1', 'guoqin.li@faureciaxuyang.com', '2014-09-29 10:36:44', '0', '8', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100547', '28004018', '唐茂蔷', '5', '18227664679', 'CD01L100', '2011-10-09', '4', '1', 'carol.tang@faureciaxuyang.com', '2014-09-29 10:36:44', '0', '11', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100546', '33333333', '彭闵扬', '1', '13880927995', 'CD011001', '2014-09-17', '1', '9', null, '2014-09-29 10:36:44', '0', '0.4', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100545', '28011638', '曾创', '1', '13608171784', 'CD011001', '2014-09-12', '1', '8', null, '2014-09-29 10:36:44', '0', '0.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100544', '28011637', '李明洋', '1', '18280136602', 'CD011001', '2014-09-11', '1', '8', null, '2014-09-29 10:36:44', '0', '0.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100543', '28010998', '徐迪', '1', '13881904855', 'CD011001', '2014-06-18', '1', '2', null, '2014-09-29 10:36:44', '0', '-2.1', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100542', '28010685', '周晓杰', '1', '15884444034', 'CD011001', '2014-05-15', '1', '6', null, '2014-09-29 10:36:44', '0', '2.8', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100541', '28010365', '岳康', '1', '18383526807', 'CD011001', '2014-05-15', '1', '5', null, '2014-09-29 10:36:44', '0', '0.3', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100540', '28010364', '李海涛', '1', '18628294352', 'CD011001', '2014-05-09', '1', '7', null, '2014-09-29 10:36:44', '0', '-0.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100539', '28010363', '钟武', '1', '18583676975', 'CD011001', '2014-05-02', '1', '2', null, '2014-09-29 10:36:44', '0', '1', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100538', '28010008', '曾云', '1', '18349121090', 'CD011001', '2014-04-03', '1', '6', null, '2014-09-29 10:36:44', '0', '4', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100537', '28010005', '刘伟', '1', '15882005705', 'CD011001', '2014-03-31', '1', '7', null, '2014-09-29 10:36:44', '0', '1', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100536', '28010004', '陈文刚', '1', '13540004149', 'CD011001', '2014-03-31', '1', '9', null, '2014-09-29 10:36:44', '0', '4', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100535', '28010003', '叶波', '1', '13648063529', 'CD011001', '2014-03-31', '1', '9', null, '2014-09-29 10:36:44', '0', '4', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100534', '28009627', '何运江', '1', '18382319606', 'CD011001', '2014-03-12', '1', '8', null, '2014-09-29 10:36:44', '0', '5.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100533', '28009626', '李林锋', '1', '18086803858', 'CD011001', '2014-03-12', '1', '3', null, '2014-09-29 10:36:44', '0', '4.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100532', '28009625', '胡仲廉', '1', '18349333872', 'CD011001', '2014-02-19', '1', '9', null, '2014-09-29 10:36:44', '0', '2.2', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100531', '28009624', '肖强', '1', '13408576017', 'CD011001', '2014-02-19', '1', '2', null, '2014-09-29 10:36:44', '0', '4.2', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100530', '28009623', '向申奇', '1', '13982053224', 'CD011001', '2014-02-19', '1', '6', null, '2014-09-29 10:36:44', '0', '5.2', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100529', '28003979', '鲁亿', '1', '13067514986', 'CD011001', '2014-02-17', '1', '7', null, '2014-09-29 10:36:44', '0', '3.2', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100528', '28009620', '林忠智', '1', '13558603987', 'CD011001', '2014-02-17', '1', '7', null, '2014-09-29 10:36:44', '0', '1.2', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100527', '28009619', '张廷清', '1', '13548067518', 'CD011001', '2014-02-17', '1', '2', null, '2014-09-29 10:36:44', '0', '3.2', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100526', '28009391', '王任超', '1', '13699057019', 'CD011001', '2014-02-14', '1', '8', null, '2014-09-29 10:36:44', '0', '3.3', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100525', '28009389', '杨鹏2', '1', '18382361567', 'CD011001', '2014-02-12', '1', '9', null, '2014-09-29 10:36:44', '0', '6.3', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100524', '28009388', '杨鹏1', '1', '18782012319', 'CD011001', '2014-02-12', '1', '6', null, '2014-09-29 10:36:44', '0', '2.3', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100523', '28009387', '刘应平', '1', '13881842753', 'CD011001', '2014-02-12', '1', '8', null, '2014-09-29 10:36:44', '0', '3.3', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100522', '28009386', '税杰', '1', '15308239181', 'CD011001', '2014-02-12', '1', '4', null, '2014-09-29 10:36:44', '0', '4.3', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100521', '28009385', '杨先港', '1', '18380138361', 'CD011001', '2014-02-12', '1', '8', null, '2014-09-29 10:36:44', '0', '0.8', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100520', '28009384', '钟鹏', '1', '18382343540', 'CD011001', '2014-02-12', '1', '4', null, '2014-09-29 10:36:44', '0', '3.3', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100519', '28009382', '代永强', '1', '13540475789', 'CD011001', '2014-02-12', '1', '3', null, '2014-09-29 10:36:44', '0', '2.3', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100518', '28006172', '付勇', '1', '18000519876', 'CD011001', '2013-08-16', '1', '4', null, '2014-09-29 10:36:44', '0', '-1.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100517', '28006120', '史本军', '1', '18782206710', 'CD011001', '2013-07-27', '1', '3', null, '2014-09-29 10:36:44', '0', '1', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100516', '28006119', '陈鹏', '1', '18215669534', 'CD011001', '2013-07-25', '1', '9', null, '2014-09-29 10:36:44', '0', '0.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100514', '28005809', '邹勋', '1', '13548003296', 'CD011001', '2013-06-25', '1', '2', null, '2014-09-29 10:36:44', '0', '3.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100515', '28005883', '周龙剑', '1', '13880640453', 'CD011001', '2013-07-10', '1', '2', null, '2014-09-29 10:36:44', '0', '1.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100513', '28005663', '伍少银', '1', '15882392035', 'CD011001', '2013-06-14', '1', '3', null, '2014-09-29 10:36:44', '0', '2.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100512', '28005652', '江坤', '1', '13981835756', 'CD011001', '2013-05-22', '1', '6', null, '2014-09-29 10:36:44', '0', '1.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100511', '28005651', '张彬', '1', '13458649297', 'CD011001', '2013-05-16', '1', '20', null, '2014-09-29 10:36:44', '0', '3', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100510', '28004010', '杨军', '1', '13880921785', 'CD011001', '2013-04-16', '1', '7', null, '2014-09-29 10:36:44', '0', '6.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100509', '28004009', '张兴', '1', '13882231440', 'CD011001', '2013-04-07', '1', '5', null, '2014-09-29 10:36:44', '0', '0.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100508', '28004006', '张建书', '1', '13408496317', 'CD011001', '2013-03-04', '1', '4', null, '2014-09-29 10:36:44', '0', '1.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100507', '28003998', '李志航', '1', '15008224476', 'CD011001', '2013-02-19', '1', '9', null, '2014-09-29 10:36:44', '0', '4.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100506', '28003997', '张杨', '1', '15828590960', 'CD011001', '2013-02-19', '1', '8', null, '2014-09-29 10:36:44', '0', '1.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100505', '28003994', '黄波', '1', '13881457904', 'CD011001', '2012-11-09', '1', '8', null, '2014-09-29 10:36:44', '0', '2.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100504', '28003993', '戴小惠', '1', '13548053997', 'CD011001', '2012-11-01', '1', '5', null, '2014-09-29 10:36:44', '0', '2', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100503', '28003991', '吴越', '1', '13666199481', 'CD011001', '2012-09-11', '1', '9', null, '2014-09-29 10:36:44', '0', '1', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100502', '28003990', '李东', '1', '13608069231', 'CD011001', '2012-09-05', '1', '2', null, '2014-09-29 10:36:44', '0', '2.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100501', '28003988', '李梦成', '1', '15928731732', 'CD011001', '2012-08-30', '1', '8', null, '2014-09-29 10:36:44', '0', '1.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100500', '28003985', '陈亮', '1', '13880383617', 'CD011001', '2012-07-06', '1', '3', null, '2014-09-29 10:36:44', '0', '-0.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100499', '28003984', '苟红', '1', '15908114253', 'CD011001', '2012-07-06', '1', '6', null, '2014-09-29 10:36:44', '0', '2.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100498', '28003983', '黄凯旋', '1', '15982112257', 'CD011001', '2012-07-05', '1', '8', null, '2014-09-29 10:36:44', '0', '3', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100497', '28003973', '黄应彬', '1', '13618030206', 'CD011001', '2012-06-18', '1', '9', null, '2014-09-29 10:36:44', '0', '2.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100496', '28003971', '袁庭鹏', '1', '18215534445', 'CD011001', '2012-06-08', '1', '4', null, '2014-09-29 10:36:44', '0', '2', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100495', '28003965', '宋冒建', '1', '13547993945', 'CD011001', '2012-05-02', '1', '4', null, '2014-09-29 10:36:44', '0', '3.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100494', '28003964', '文强兵', '1', '15202848747', 'CD011001', '2012-05-02', '1', '5', null, '2014-09-29 10:36:44', '0', '4.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100493', '28003962', '谢友康', '1', '18780050920', 'CD011001', '2012-05-02', '1', '6', null, '2014-09-29 10:36:44', '0', '4.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100492', '28003961', '钟超', '1', '15198023770', 'CD011001', '2012-04-24', '1', '7', null, '2014-09-29 10:36:44', '0', '3.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100491', '28003960', '何彬', '1', '13558815943', 'CD011001', '2012-04-19', '1', '3', null, '2014-09-29 10:36:44', '0', '1.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100490', '28011449', '杨鹏3', '1', '13551895172', 'CD011001', '2014-08-04', '1', '6', null, '2014-09-29 10:36:44', '0', '1.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100489', '28003957', '佘唐林', '1', '15208396360', 'CD011001', '2012-04-11', '1', '7', null, '2014-09-29 10:36:44', '0', '4.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100488', '28003952', '赖首君', '1', '15182205503', 'CD011001', '2012-03-05', '1', '9', null, '2014-09-29 10:36:44', '0', '2.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100487', '28003945', '徐兴意', '1', '18782213642', 'CD011001', '2011-12-26', '1', '7', null, '2014-09-29 10:36:44', '0', '2', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100486', '28003956', '邱林', '1', '18008010455', 'CD011001', '2012-04-09', '1', '4', null, '2014-09-29 10:36:44', '0', '5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100485', '28003989', '冯富鑫', '1', '15948797553', 'CD011001', '2012-09-03', '1', '1', 'fuxin.feng@faureciaxuyang.com', '2014-09-29 10:36:44', '0', '6', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100484', '28003955', '吴代亮', '1', '18208118356', 'CD011001', '2012-03-27', '1', '2', null, '2014-09-29 10:36:44', '0', '2.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100483', '28003970', '谢发东', '1', '13648074907', 'CD011001', '2012-06-07', '1', '3', null, '2014-09-29 10:36:44', '0', '-2.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100437', '28003901', '李继宏', '7', '13331666018', 'CD01A001', '2006-08-22', '5', '1', '105664046@qq.com', '2014-09-29 10:52:22', '0', '9', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100438', '28003902', '沈筱', '7', '18681278979', 'CD01S001', '2012-01-03', '4', '1', 'sabrina.shen@faureciaxuyang.com', '2014-09-29 10:36:44', '0', '6', '0', '8.5');
INSERT INTO `op_staffinfo` VALUES ('100439', '28003903', '杨健', '7', '18180624000', 'CD01S001', '2012-06-14', '1', '18', null, '2014-09-29 10:36:44', '0', '3', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100440', '28003904', '张建', '7', '13688078206', 'CD01S001', '2012-09-19', '1', '19', null, '2014-09-29 10:36:44', '0', '1', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100441', '28003905', '张庆', '7', '18608003951', 'CD01A001', '2011-08-05', '4', '1', 'andy.zhang@faureciaxuyang.com', '2014-09-29 10:36:44', '0', '5.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100442', '28006173', '付伟', '7', '15228840363', 'CD01A002', '2013-07-29', '7', '1', 'raymond.fu@faureciaxuyang.com', '2014-09-29 10:36:44', '0', '11.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100443', '28003906', '邓飞', '7', '13880351137', 'CD01P001', '2011-11-02', '7', '1', 'fei.deng@faureciaxuyang.com', '2014-09-29 10:36:44', '0', '1.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100444', '28003907', '王晶', '2', '18628071776', 'CD01H001', '2011-07-11', '2', '1', 'hr_attendance@163.com', '2014-09-29 10:52:04', '0', '-1', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100445', '28003909', '朱品容', '2', '15108420372', 'CD01H001', '2012-04-23', '7', '1', 'gillian.zhu@faureciaxuyang.com', '2014-09-29 10:36:44', '0', '2', '0', '7.5');
INSERT INTO `op_staffinfo` VALUES ('100446', '28003911', '罗琪', '2', '18381078870', 'CD01H001', '2012-12-11', '7', '1', 'letty.luo@faureciaxuyang.com', '2014-09-29 10:36:44', '0', '-2.5', '0', '3');
INSERT INTO `op_staffinfo` VALUES ('100447', '28010009', '张薇', '2', '18682559769', 'CD01H001', '2013-10-21', '7', '1', 'Receptionist.CFXAS-CD@faureciaxuyang.com', '2014-09-29 10:36:44', '0', '9', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100448', '28010001', '王鑫薷', '2', '18200435966', 'CD01H001', '2014-03-24', '7', '1', 'sarah.wang@faureciaxuyang.com', '2014-09-29 10:36:44', '0', '6.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100449', '28003912', '欧阳百贺', '3', '13882565165', 'CD01F001', '2011-09-21', '4', '1', 'yangend@163.com', '2014-09-29 10:51:40', '0', '10', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100450', '28003913', '葛振芳', '3', '15102830776', 'CD01F001', '2012-07-16', '7', '1', 'vivi.ge@faureciaxuyang.com', '2014-09-29 10:36:44', '0', '6', '0', '-4');
INSERT INTO `op_staffinfo` VALUES ('100451', '28003914', '杨华溢', '3', '13548155207', 'CD01F002', '2011-07-28', '7', '1', 'huayi.yang@faureciaxuyang.com', '2014-09-30 10:16:05', '0', '1', '0', '24');
INSERT INTO `op_staffinfo` VALUES ('100452', '28003915', '吴锋', '3', '13540640511', 'CD01F001', '2011-04-15', '7', '1', 'clint.wu@faureciaxuyang.com', '2014-09-29 10:36:44', '0', '6.5', '0', '44');
INSERT INTO `op_staffinfo` VALUES ('100453', '28003917', '刘铁柱', '4', '18615767060', 'CD01Q001', '2010-08-21', '4', '1', 'tim.liu@faureciaxuyagn.com', '2014-09-29 10:36:44', '0', '7', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100454', '28003918', '彭世文', '4', '13688364770', 'CD01Q001', '2011-07-11', '7', '1', 'shiwen.peng@faureciaxuyang.com', '2014-09-29 10:36:44', '0', '-1.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100455', '28003919', '江利桃', '4', '15828194009', 'CD01Q001', '2011-07-11', '7', '1', 'jason.jiang@faureciaxuyang.com', '2014-09-29 10:36:44', '0', '7', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100456', '28003920', '付全柏', '4', '15228798071', 'CD01Q001', '2013-04-01', '7', '1', 'jerry.fu@faureciaxuyang.com', '2014-09-29 10:36:44', '0', '9.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100457', '28003921', '黄付来', '4', '13018275637', 'CD01Q001', '2011-04-01', '1', '14', null, '2014-09-29 10:36:44', '0', '5.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100458', '28003924', '舒娟', '4', '13648095760', 'CD01Q001', '2012-01-29', '7', '1', 'sucy.shu@faureciaxuyang.com', '2014-09-29 10:36:44', '0', '1', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100459', '28011446', '封永川', '4', '15882071568', 'CD01Q001', '2014-08-04', '1', '4', null, '2014-09-29 10:36:44', '0', '4', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100460', '28003925', '曾亮', '4', '13551351033', 'CD01Q001', '2011-11-01', '1', '20', null, '2014-09-29 10:36:44', '0', '-0.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100461', '28006504', '赵毅', '4', '13880236563', 'CD01Q001', '2013-10-14', '1', '20', null, '2014-09-29 10:36:44', '0', '4.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100462', '28005807', '方超', '4', '13348916512', 'CD01Q001', '2013-07-04', '1', '15', null, '2014-09-29 10:36:44', '0', '0.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100463', '28003927', '杨爱民', '6', '18981956193', 'CD01E001', '2012-12-10', '4', '1', 'harry.yang@faureciaxuyang.com', '2014-09-29 10:36:44', '0', '10', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100464', '28003928', '王彦奎', '6', '18780227387', 'CD01E001', '2010-07-01', '7', '1', 'yankui.wang@faureciaxuyang.com', '2014-09-29 10:36:44', '0', '14', '0', '12.5');
INSERT INTO `op_staffinfo` VALUES ('100465', '28003930', '王林', '6', '13882029775', 'CD01E001', '2012-02-01', '7', '1', 'tiger.wang@faureciaxuyang.com', '2014-09-29 10:36:44', '0', '14', '0', '40.5');
INSERT INTO `op_staffinfo` VALUES ('100466', '28003931', '潘挺', '6', '13693499379', 'CD01E001', '2012-02-01', '7', '1', 'ting.pan@faureciaxuayng.com', '2014-09-29 10:36:44', '0', '11', '0', '8.5');
INSERT INTO `op_staffinfo` VALUES ('100467', '28003932', '雷鹏', '6', '15982027247', 'CD01E001', '2011-08-25', '1', '12', null, '2014-09-29 10:36:44', '0', '3.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100468', '28005808', '彭传刚', '6', '15928688317', 'CD01E001', '2013-07-01', '1', '13', null, '2014-09-29 10:36:44', '0', '2.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100469', '28009162', '王荣', '6', '18030501660', 'CD01E001', '2014-01-14', '1', '20', null, '2014-09-29 10:36:44', '0', '0.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100470', '28009633', '张波', '6', '15982167753', 'CD01E001', '2014-03-04', '7', '1', 'jacky.zhang@faureciaxuyang.com', '2014-09-29 10:36:44', '0', '7.5', '0', '4.5');
INSERT INTO `op_staffinfo` VALUES ('100471', '28003934', '施恂义', '1', '13917610267', 'CD011001', '2012-06-27', '4', '1', 'xunyi.shi@faureciaxuyang.com', '2014-09-29 10:36:44', '0', '8', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100472', '28003935', '陈彪', '1', '13660363699', 'CD011001', '2012-09-03', '7', '5', 'biao.chen@faureciaxuyang.com', '2014-09-29 10:36:44', '0', '11.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100473', '28003937', '刘杰', '1', '15208247287', 'CD011001', '2010-09-01', '7', '4', 'jie.liu@faureciaxuyang.com', '2014-09-29 10:36:44', '0', '14', '0', '93');
INSERT INTO `op_staffinfo` VALUES ('100474', '28003938', '彭万良', '1', '18349199369', 'CD011001', '2013-04-01', '7', '3', 'wanliang.peng@faureciaxuyang.com', '2014-09-29 10:36:44', '0', '12', '0', '94.5');
INSERT INTO `op_staffinfo` VALUES ('100475', '28003939', '王波', '1', '18010556829', 'CD011001', '2011-02-20', '1', '6', null, '2014-09-29 10:36:44', '0', '-0.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100476', '28003940', '王锐', '1', '13330963820', 'CD011001', '2011-11-01', '1', '9', null, '2014-09-29 10:36:44', '0', '-1', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100477', '28003941', '张小杰', '1', '18702832785', 'CD011001', '2011-11-01', '1', '3', null, '2014-09-29 10:36:44', '0', '-0.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100478', '28003942', '李浩', '1', '13709047854', 'CD011001', '2011-11-01', '1', '6', null, '2014-09-29 10:36:44', '0', '4.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100479', '28003944', '曾跃俊', '1', '13982099396', 'CD011001', '2011-12-26', '1', '5', null, '2014-09-29 10:36:44', '0', '-2', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100480', '28003946', '高锐', '1', '14780131873', 'CD011001', '2012-02-02', '1', '9', null, '2014-09-29 10:36:44', '0', '2', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100481', '28003951', '余东', '1', '13281222153', 'CD011001', '2012-03-05', '1', '8', null, '2014-09-29 10:36:44', '0', '5.5', '0', '0');
INSERT INTO `op_staffinfo` VALUES ('100482', '28003969', '周陈东', '1', '13882097462', 'CD011001', '2012-05-31', '1', '5', null, '2014-09-29 10:36:44', '0', '2.5', '0', '0');

-- ----------------------------
-- Table structure for `op_teaminfo`
-- ----------------------------
DROP TABLE IF EXISTS `op_teaminfo`;
CREATE TABLE `op_teaminfo` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `teamname` varchar(255) NOT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of op_teaminfo
-- ----------------------------
INSERT INTO `op_teaminfo` VALUES ('1', '办公室');
INSERT INTO `op_teaminfo` VALUES ('2', '靠背1线A');
INSERT INTO `op_teaminfo` VALUES ('3', '靠背1线B');
INSERT INTO `op_teaminfo` VALUES ('4', '靠背2线A');
INSERT INTO `op_teaminfo` VALUES ('5', '靠背2线B');
INSERT INTO `op_teaminfo` VALUES ('6', '2W座盆A');
INSERT INTO `op_teaminfo` VALUES ('7', '2W座盆B');
INSERT INTO `op_teaminfo` VALUES ('8', '4W座盆A');
INSERT INTO `op_teaminfo` VALUES ('9', '4W座盆B');
INSERT INTO `op_teaminfo` VALUES ('10', '物流A');
INSERT INTO `op_teaminfo` VALUES ('11', '物流B');
INSERT INTO `op_teaminfo` VALUES ('12', '工程A');
INSERT INTO `op_teaminfo` VALUES ('13', '工程B');
INSERT INTO `op_teaminfo` VALUES ('14', '质量A');
INSERT INTO `op_teaminfo` VALUES ('15', '质量B');
INSERT INTO `op_teaminfo` VALUES ('16', '发运A');
INSERT INTO `op_teaminfo` VALUES ('17', '发运B');
INSERT INTO `op_teaminfo` VALUES ('18', '销售A');
INSERT INTO `op_teaminfo` VALUES ('19', '销售B');
INSERT INTO `op_teaminfo` VALUES ('20', 'PDP白');

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
) ENGINE=MyISAM AUTO_INCREMENT=1000142 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of op_userinfo
-- ----------------------------
INSERT INTO `op_userinfo` VALUES ('1000107', '28003901', 'tracy.li', '827ccb0eea8a706c4c34a16891f84e7b', '李继宏', '0', '7', '13331666018', '0', '2006-08-22', '5', '105664046@qq.com', '2014-09-29 10:52:22');
INSERT INTO `op_userinfo` VALUES ('1000108', '28003902', 'sabrina.shen', '827ccb0eea8a706c4c34a16891f84e7b', '沈筱', '0', '7', '18681278979', '0', '2012-01-03', '4', 'sabrina.shen@faureciaxuyang.com', '2014-09-29 10:25:47');
INSERT INTO `op_userinfo` VALUES ('1000109', '28003905', 'andy.zhang', '827ccb0eea8a706c4c34a16891f84e7b', '张庆', '0', '7', '18608003951', '0', '2011-08-05', '4', 'andy.zhang@faureciaxuyang.com', '2014-09-29 10:25:47');
INSERT INTO `op_userinfo` VALUES ('1000110', '28006173', 'raymond.fu', '827ccb0eea8a706c4c34a16891f84e7b', '付伟', '0', '7', '15228840363', '0', '2013-07-29', '7', 'raymond.fu@faureciaxuyang.com', '2014-09-29 10:25:47');
INSERT INTO `op_userinfo` VALUES ('1000111', '28003906', 'david.deng', '827ccb0eea8a706c4c34a16891f84e7b', '邓飞', '0', '7', '13880351137', '0', '2011-11-02', '7', 'fei.deng@faureciaxuyang.com', '2014-09-29 10:25:47');
INSERT INTO `op_userinfo` VALUES ('1000141', '28003907', 'jamie.wang', '827ccb0eea8a706c4c34a16891f84e7b', '王晶', '0', '2', '18628071776', '0', '2011-07-11', '2', 'hr_attendance@163.com', '2014-09-29 10:52:04');
INSERT INTO `op_userinfo` VALUES ('1000112', '28003909', 'gillian.zhu', '827ccb0eea8a706c4c34a16891f84e7b', '朱品容', '0', '2', '15108420372', '0', '2012-04-23', '7', 'gillian.zhu@faureciaxuyang.com', '2014-09-29 10:25:47');
INSERT INTO `op_userinfo` VALUES ('1000113', '28003911', 'letty.luo', '827ccb0eea8a706c4c34a16891f84e7b', '罗琪', '0', '2', '18381078870', '0', '2012-12-11', '7', 'letty.luo@faureciaxuyang.com', '2014-09-29 10:25:47');
INSERT INTO `op_userinfo` VALUES ('1000114', '28010009', 'wei.zhang', '827ccb0eea8a706c4c34a16891f84e7b', '张薇', '0', '2', '18682559769', '0', '2013-10-21', '7', 'Receptionist.CFXAS-CD@faureciaxuyang.com', '2014-09-29 10:25:47');
INSERT INTO `op_userinfo` VALUES ('1000115', '28010001', 'sarah.wang', '827ccb0eea8a706c4c34a16891f84e7b', '王鑫薷', '0', '2', '18200435966', '0', '2014-03-24', '7', 'sarah.wang@faureciaxuyang.com', '2014-09-29 10:25:47');
INSERT INTO `op_userinfo` VALUES ('1000116', '28003912', 'rick.ouyang', '827ccb0eea8a706c4c34a16891f84e7b', '欧阳百贺', '0', '3', '13882565165', '0', '2011-09-21', '4', 'yangend@163.com', '2014-09-29 10:51:40');
INSERT INTO `op_userinfo` VALUES ('1000117', '28003913', 'vivi.ge', '827ccb0eea8a706c4c34a16891f84e7b', '葛振芳', '0', '3', '15102830776', '0', '2012-07-16', '7', 'vivi.ge@faureciaxuyang.com', '2014-09-29 10:25:47');
INSERT INTO `op_userinfo` VALUES ('1000118', '28003914', 'huayi.yang', '827ccb0eea8a706c4c34a16891f84e7b', '杨华溢', '0', '3', '13548155207', '0', '2011-07-28', '7', 'huayi.yang@faureciaxuyang.com', '2014-09-30 10:16:05');
INSERT INTO `op_userinfo` VALUES ('1000119', '28003915', 'clint.wu', '827ccb0eea8a706c4c34a16891f84e7b', '吴锋', '0', '3', '13540640511', '0', '2011-04-15', '7', 'clint.wu@faureciaxuyang.com', '2014-09-29 10:25:47');
INSERT INTO `op_userinfo` VALUES ('1000120', '28003917', 'tim.liu', '827ccb0eea8a706c4c34a16891f84e7b', '刘铁柱', '0', '4', '18615767060', '0', '2010-08-21', '4', 'tim.liu@faureciaxuyagn.com', '2014-09-29 10:25:47');
INSERT INTO `op_userinfo` VALUES ('1000121', '28003918', 'selwyn.peng', '827ccb0eea8a706c4c34a16891f84e7b', '彭世文', '0', '4', '13688364770', '0', '2011-07-11', '7', 'shiwen.peng@faureciaxuyang.com', '2014-09-29 10:25:47');
INSERT INTO `op_userinfo` VALUES ('1000122', '28003919', 'jason.jiang', '827ccb0eea8a706c4c34a16891f84e7b', '江利桃', '0', '4', '15828194009', '0', '2011-07-11', '7', 'jason.jiang@faureciaxuyang.com', '2014-09-29 10:25:47');
INSERT INTO `op_userinfo` VALUES ('1000123', '28003920', 'jerry.fu', '827ccb0eea8a706c4c34a16891f84e7b', '付全柏', '0', '4', '15228798071', '0', '2013-04-01', '7', 'jerry.fu@faureciaxuyang.com', '2014-09-29 10:25:47');
INSERT INTO `op_userinfo` VALUES ('1000124', '28003924', 'sucy.shu', '827ccb0eea8a706c4c34a16891f84e7b', '舒娟', '0', '4', '13648095760', '0', '2012-01-29', '7', 'sucy.shu@faureciaxuyang.com', '2014-09-29 10:25:47');
INSERT INTO `op_userinfo` VALUES ('1000125', '28003927', 'harry.yang', '827ccb0eea8a706c4c34a16891f84e7b', '杨爱民', '0', '6', '18981956193', '0', '2012-12-10', '4', 'harry.yang@faureciaxuyang.com', '2014-09-29 10:25:47');
INSERT INTO `op_userinfo` VALUES ('1000126', '28003928', 'yankui.wang', '827ccb0eea8a706c4c34a16891f84e7b', '王彦奎', '0', '6', '18780227387', '0', '2010-07-01', '7', 'yankui.wang@faureciaxuyang.com', '2014-09-29 10:25:47');
INSERT INTO `op_userinfo` VALUES ('1000127', '28003930', 'tiger.wang', '827ccb0eea8a706c4c34a16891f84e7b', '王林', '0', '6', '13882029775', '0', '2012-02-01', '7', 'tiger.wang@faureciaxuyang.com', '2014-09-29 10:25:47');
INSERT INTO `op_userinfo` VALUES ('1000128', '28003931', 'ting.pan', '827ccb0eea8a706c4c34a16891f84e7b', '潘挺', '0', '6', '13693499379', '0', '2012-02-01', '7', 'ting.pan@faureciaxuayng.com', '2014-09-29 10:25:47');
INSERT INTO `op_userinfo` VALUES ('1000129', '28009633', 'bo.zhang', '827ccb0eea8a706c4c34a16891f84e7b', '张波', '0', '6', '15982167753', '0', '2014-03-04', '7', 'jacky.zhang@faureciaxuyang.com', '2014-09-29 10:25:47');
INSERT INTO `op_userinfo` VALUES ('1000130', '28003934', 'simon.shi', '827ccb0eea8a706c4c34a16891f84e7b', '施恂义', '0', '1', '13917610267', '0', '2012-06-27', '4', 'xunyi.shi@faureciaxuyang.com', '2014-09-29 10:25:47');
INSERT INTO `op_userinfo` VALUES ('1000131', '28003935', 'biao.chen', '827ccb0eea8a706c4c34a16891f84e7b', '陈彪', '0', '1', '13660363699', '0', '2012-09-03', '7', 'biao.chen@faureciaxuyang.com', '2014-09-29 10:25:47');
INSERT INTO `op_userinfo` VALUES ('1000132', '28003937', 'jie.liu', '827ccb0eea8a706c4c34a16891f84e7b', '刘杰', '0', '1', '15208247287', '0', '2010-09-01', '7', 'jie.liu@faureciaxuyang.com', '2014-09-29 10:25:47');
INSERT INTO `op_userinfo` VALUES ('1000133', '28003938', 'wanliang.peng', '827ccb0eea8a706c4c34a16891f84e7b', '彭万良', '0', '1', '18349199369', '0', '2013-04-01', '7', 'wanliang.peng@faureciaxuyang.com', '2014-09-29 10:25:47');
INSERT INTO `op_userinfo` VALUES ('1000134', '28003989', 'fuxin.feng', '827ccb0eea8a706c4c34a16891f84e7b', '冯富鑫', '0', '1', '15948797553', '0', '2012-09-03', '1', 'fuxin.feng@faureciaxuyang.com', '2014-09-29 10:25:47');
INSERT INTO `op_userinfo` VALUES ('1000135', '28004018', 'carol.tang', '827ccb0eea8a706c4c34a16891f84e7b', '唐茂蔷', '0', '5', '18227664679', '0', '2011-10-09', '4', 'carol.tang@faureciaxuyang.com', '2014-09-29 10:25:47');
INSERT INTO `op_userinfo` VALUES ('1000136', '28004019', 'nancy.li', '827ccb0eea8a706c4c34a16891f84e7b', '李国琴', '0', '5', '13488978182', '0', '2011-04-12', '7', 'guoqin.li@faureciaxuyang.com', '2014-09-29 10:25:47');
INSERT INTO `op_userinfo` VALUES ('1000137', '28011639', 'charles.sun', '827ccb0eea8a706c4c34a16891f84e7b', '孙铖', '0', '5', '18828076656', '0', '2014-09-01', '7', 'charles.sun@faureciaxuyang.com', '2014-09-29 10:25:47');
INSERT INTO `op_userinfo` VALUES ('1000138', '28004021', 'leo.li', '827ccb0eea8a706c4c34a16891f84e7b', '李勇', '0', '5', '18502866697', '0', '2012-09-21', '7', 'leo.li@faureciaxuyagn.com', '2014-09-29 10:25:47');
INSERT INTO `op_userinfo` VALUES ('1000139', '28010002', 'sam.cui', '827ccb0eea8a706c4c34a16891f84e7b', '崔韬', '0', '5', '18581858587', '0', '2014-04-11', '7', 'sam.cui@faureciaxuyang.com', '2014-09-29 10:25:47');
INSERT INTO `op_userinfo` VALUES ('1000140', '28004026', 'star.wu', '827ccb0eea8a706c4c34a16891f84e7b', '吴芑欣', '0', '5', '13648047237', '0', '2011-12-14', '7', 'star.wu@faureciaxuyang.com', '2014-09-29 10:25:47');

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
INSERT INTO `op_usertype` VALUES ('1', '生产线员工', 'staff_menu.json', '1');
INSERT INTO `op_usertype` VALUES ('2', '人事经理', 'hr_menu.json', '2');
INSERT INTO `op_usertype` VALUES ('3', '产线班长', 'monitor_menu.json', '3');
INSERT INTO `op_usertype` VALUES ('4', '部门经理', 'dp_menu.json', '4');
INSERT INTO `op_usertype` VALUES ('5', '老板', 'boss_menu.json', '5');
INSERT INTO `op_usertype` VALUES ('6', '管理员', 'admin_menu.json', '6');
INSERT INTO `op_usertype` VALUES ('999999', 'test', 'test_menu.json', '999999');
INSERT INTO `op_usertype` VALUES ('7', '办公室员工', 'office_staff_menu.json', '7');

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
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of op_vacationstatus
-- ----------------------------
INSERT INTO `op_vacationstatus` VALUES ('57', '1010', '3', '3', '0', '1', '1004', '1002', '1005', '2014-09-22', '08:00:00', '2014-09-26', '17:00:00', '2014-09-30 00:36:57', null, null, '年假', null, '5');
INSERT INTO `op_vacationstatus` VALUES ('58', '1003', '2', '3', '0', '1', '1004', '1002', null, '2014-09-23', '08:00:00', '2014-09-26', '17:00:00', '2014-09-30 00:39:33', null, null, '年假', null, '4');
INSERT INTO `op_vacationstatus` VALUES ('59', '1003', '1', '3', '0', '1', '1004', null, null, '2014-09-24', '08:00:00', '2014-09-25', '17:00:00', '2014-09-30 00:40:39', null, null, '调休假', null, '2');
INSERT INTO `op_vacationstatus` VALUES ('56', '1004', '2', '3', '0', '1', null, '1002', null, '2014-09-17', '08:00:00', '2014-09-18', '17:00:00', '2014-09-30 00:27:23', null, null, '年假', null, null);
INSERT INTO `op_vacationstatus` VALUES ('52', '1001', '1', '1', '0', '0', '1004', null, null, '2014-09-23', '08:00:00', '2014-09-25', '17:00:00', '2014-09-30 00:07:01', '343434', null, null, null, null);
INSERT INTO `op_vacationstatus` VALUES ('53', '1003', '1', '1', '0', '0', '1004', null, null, '2014-09-23', '08:00:00', '2014-09-25', '17:00:00', '2014-09-30 00:07:01', '343434', null, null, null, null);
INSERT INTO `op_vacationstatus` VALUES ('54', '1010', '1', '1', '1', '0', '1004', null, null, '2014-09-23', '08:00:00', '2014-09-25', '17:00:00', '2014-09-30 00:07:01', '343434', null, null, null, null);
INSERT INTO `op_vacationstatus` VALUES ('55', '1010', '2', '3', '0', '0', '1004', '1002', null, '2014-09-23', '08:00:00', '2014-09-25', '17:00:00', '2014-09-30 00:08:22', null, null, '调休假', null, '3');

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
INSERT INTO `op_vacationtype` VALUES ('1', '加班');
INSERT INTO `op_vacationtype` VALUES ('2', '出差');
INSERT INTO `op_vacationtype` VALUES ('3', '休假');

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
INSERT INTO `op_worktime` VALUES ('1', '2', '2014-09-01', '08:00:00', '2014-09-05', '17:00:00');
INSERT INTO `op_worktime` VALUES ('2', '2', '2014-09-08', '08:00:00', '2014-09-12', '17:00:00');
INSERT INTO `op_worktime` VALUES ('3', '2', '2014-09-15', '08:00:00', '2014-09-19', '17:00:00');
INSERT INTO `op_worktime` VALUES ('4', '2', '2014-09-22', '08:00:00', '2014-09-26', '17:00:00');
