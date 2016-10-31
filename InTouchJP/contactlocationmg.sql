/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50624
Source Host           : localhost:3306
Source Database       : contactlocationmg

Target Server Type    : MYSQL
Target Server Version : 50624
File Encoding         : 65001

Date: 2016-10-31 14:32:41
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `t_message`
-- ----------------------------
DROP TABLE IF EXISTS `t_message`;
CREATE TABLE `t_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `fid` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `note` varchar(500) DEFAULT NULL,
  `ndate` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `fusername` varchar(50) DEFAULT NULL,
  `attach` varchar(200) DEFAULT NULL,
  `attachname` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=149 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_message
-- ----------------------------
INSERT INTO `t_message` VALUES ('129', '369', '367', '1', '测试发送消息', '2016-10-31 09:06:09', 'ideabobo', 'Fabian Wentz', '', null);
INSERT INTO `t_message` VALUES ('130', '369', '367', '1', '测试发送消息2', '2016-10-31 09:06:56', 'ideabobo', 'Fabian Wentz', '', null);
INSERT INTO `t_message` VALUES ('131', '367', '369', '1', '我来了', '2016-10-31 09:09:49', 'Fabian Wentz', 'ideabobo', '', null);
INSERT INTO `t_message` VALUES ('132', '369', '367', '1', 'wolali', '2016-10-31 09:19:20', 'ideabobo', 'Fabian Wentz', '', null);
INSERT INTO `t_message` VALUES ('133', '367', '369', '1', 'nizaiganma', '2016-10-31 09:19:33', 'Fabian Wentz', 'ideabobo', '', null);
INSERT INTO `t_message` VALUES ('134', '367', '369', '1', '123123', '2016-10-31 09:22:31', 'Fabian Wentz', 'ideabobo', '', null);
INSERT INTO `t_message` VALUES ('135', '367', '369', '1', '123123123', '2016-10-31 09:22:42', 'Fabian Wentz', 'ideabobo', '', null);
INSERT INTO `t_message` VALUES ('136', '367', '369', '1', '水电费', '2016-10-31 09:25:06', 'Fabian Wentz', 'ideabobo', '', null);
INSERT INTO `t_message` VALUES ('137', '367', '369', '1', 'Fabianfaso', '2016-10-31 09:25:22', 'Fabian Wentz', 'ideabobo', '', null);
INSERT INTO `t_message` VALUES ('138', '367', '369', '1', 'hahah', '2016-10-31 09:29:08', 'Fabian Wentz', 'ideabobo', '', null);
INSERT INTO `t_message` VALUES ('139', '367', '369', '1', 'asdf', '2016-10-31 09:29:17', 'Fabian Wentz', 'ideabobo', '', null);
INSERT INTO `t_message` VALUES ('140', '367', '369', '1', '123123', '2016-10-31 09:32:44', 'Fabian Wentz', 'ideabobo', '', null);
INSERT INTO `t_message` VALUES ('141', '369', '369', '1', 'hsh', '2016-10-31 09:33:15', 'ideabobo', 'ideabobo', '', null);
INSERT INTO `t_message` VALUES ('142', '367', '369', '1', '123123', '2016-10-31 09:33:25', 'Fabian Wentz', 'ideabobo', '', null);
INSERT INTO `t_message` VALUES ('143', '367', '369', '1', '111', '2016-10-31 09:33:36', 'Fabian Wentz', 'ideabobo', '', null);
INSERT INTO `t_message` VALUES ('144', '369', '369', '1', '222', '2016-10-31 09:33:42', 'ideabobo', 'ideabobo', '', null);
INSERT INTO `t_message` VALUES ('145', '369', '369', '1', '333', '2016-10-31 09:34:01', 'ideabobo', 'ideabobo', '', null);
INSERT INTO `t_message` VALUES ('146', '367', '369', '1', '1212', '2016-10-31 09:34:09', 'Fabian Wentz', 'ideabobo', '', null);
INSERT INTO `t_message` VALUES ('147', '367', '369', '1', 'qqq', '2016-10-31 09:34:34', 'Fabian Wentz', 'ideabobo', '', null);
INSERT INTO `t_message` VALUES ('148', '369', '367', '1', 'www', '2016-10-31 09:34:38', 'ideabobo', 'Fabian Wentz', '', null);

-- ----------------------------
-- Table structure for `t_replay`
-- ----------------------------
DROP TABLE IF EXISTS `t_replay`;
CREATE TABLE `t_replay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` varchar(10) DEFAULT NULL,
  `note` varchar(500) DEFAULT NULL,
  `uid` varchar(10) DEFAULT NULL,
  `username` varchar(200) DEFAULT NULL,
  `ndate` varchar(50) DEFAULT NULL,
  `fid` varchar(50) DEFAULT NULL,
  `fusername` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_replay
-- ----------------------------
INSERT INTO `t_replay` VALUES ('14', null, null, '367', null, '2016-10-31 09:44:01', '369', null);

-- ----------------------------
-- Table structure for `t_user`
-- ----------------------------
DROP TABLE IF EXISTS `t_user`;
CREATE TABLE `t_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tel` varchar(50) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `dept` varchar(20) DEFAULT NULL,
  `address` varchar(20) DEFAULT NULL,
  `sex` varchar(20) DEFAULT NULL,
  `birth` varchar(20) DEFAULT NULL,
  `img` varchar(200) DEFAULT NULL,
  `username` varchar(200) DEFAULT NULL,
  `passwd` varchar(255) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `quickreplay` varchar(255) DEFAULT NULL,
  `notify` varchar(1) DEFAULT '0',
  `updates` varchar(255) DEFAULT NULL,
  `light` varchar(255) DEFAULT NULL,
  `vibra` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=370 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_user
-- ----------------------------
INSERT INTO `t_user` VALUES ('367', '04123231234', 'wang45851808@qq.com', 'IT', '重庆市璧山县皮鞋城一路136号', '男', '1988-06-26', 'Fabian Wentz.jpg', 'Fabian Wentz', '111111', '29.598804', '106.239215', 'Rest', 'I\'m have Rest', '0', null, null, null);
INSERT INTO `t_user` VALUES ('368', '04123231334', 'wang45851808@qq.com', 'IT', '重庆市璧山县皮鞋城一路136号', null, null, 'Sam Zhou.jpg', 'Sam Zhou', '111111', '29.598804', '106.239215', 'Metting', null, '0', null, null, null);
INSERT INTO `t_user` VALUES ('369', '04123231442', 'wang45851808@qq.com', 'IT', '重庆市璧山县皮鞋城一路136号', null, '1996-10-29', '1477751860.jpg', 'ideabobo', '123', '29.598804', '106.239262', 'my status', 'I\'m have Rest tes', '0', null, null, null);
