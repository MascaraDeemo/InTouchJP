/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50624
Source Host           : localhost:3306
Source Database       : contactlocationmg

Target Server Type    : MYSQL
Target Server Version : 50624
File Encoding         : 65001

Date: 2016-10-29 22:54:31
*/
USE contactlocationmg;
SET FOREIGN_KEY_CHECKS=0;

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_replay
-- ----------------------------
INSERT INTO `t_replay` VALUES ('11', '367', 'test hah', '367', 'Fabian Wentz', '2016-10-29 18:50:22');
INSERT INTO `t_replay` VALUES ('12', '368', 'test oj', '369', 'ideabobo', '2016-10-29 20:19:27');
INSERT INTO `t_replay` VALUES ('13', '368', 'haha', '369', 'ideabobo', '2016-10-29 20:19:33');

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
INSERT INTO `t_user` VALUES ('369', '04123231442', 'wang45851808@qq.com', 'IT', '重庆市璧山县皮鞋城一路136号', null, '1996-10-29', '1477751860.jpg', 'ideabobo', '123', '29.598621', '106.239261', 'my status', 'I\'m have Rest tes', '0', null, null, null);
