/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50616
Source Host           : localhost:3306
Source Database       : fenqishop

Target Server Type    : MYSQL
Target Server Version : 50616
File Encoding         : 65001

Date: 2015-05-13 14:53:11
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `wct_beiwang`
-- ----------------------------
DROP TABLE IF EXISTS `wct_beiwang`;
CREATE TABLE `wct_beiwang` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `note` varchar(500) DEFAULT NULL,
  `ndate` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wct_beiwang
-- ----------------------------

-- ----------------------------
-- Table structure for `wct_bill`
-- ----------------------------
DROP TABLE IF EXISTS `wct_bill`;
CREATE TABLE `wct_bill` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `gids` varchar(100) DEFAULT NULL,
  `pirce` varchar(100) DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  `uid` int(10) DEFAULT NULL,
  `shop` varchar(100) DEFAULT NULL,
  `bill` varchar(2000) DEFAULT NULL,
  `openid` varchar(255) DEFAULT NULL,
  `ndate` varchar(255) DEFAULT NULL,
  `total` varchar(255) DEFAULT NULL,
  `way` varchar(50) DEFAULT NULL,
  `gnames` varchar(500) DEFAULT NULL,
  `sid` varchar(10) DEFAULT NULL,
  `state` int(1) DEFAULT NULL,
  `statecn` varchar(50) DEFAULT NULL,
  `tel` varchar(50) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `note` varchar(200) DEFAULT NULL,
  `fenqi` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wct_bill
-- ----------------------------
INSERT INTO `wct_bill` VALUES ('72', '26', null, 'wangbo', '97', '', null, null, '2015-03-16 21:30:00', '78', null, '复方薄荷脑软', '', null, null, '15123385885', '我的收货地址', '这里是收货备注', null);
INSERT INTO `wct_bill` VALUES ('73', '1', null, 'wangbo3', '103', '', null, null, '2015-05-03 20:34:14', '9999', null, '联想笔记本', '', null, null, '18602394120', '我的地址', ' 就看见', '6');
INSERT INTO `wct_bill` VALUES ('74', '1', null, '500228', '106', '', null, null, '2015-05-03 20:44:46', '9999', null, '联想笔记本', '', null, null, '15123385885', '我的地址呵呵', '这里是备注', '12');
INSERT INTO `wct_bill` VALUES ('75', '3', null, 'admin', '59', '', null, null, '2015-05-06 09:57:19', '789', null, '女装', '', null, '已付款', '', '', '', '3');
INSERT INTO `wct_bill` VALUES ('76', '2', null, '500228', '106', '', null, null, '2015-05-06 10:03:30', '7899', null, '戴尔电脑', '', null, '已付款', '15123385885', '我的地址呵呵', '', '3');
INSERT INTO `wct_bill` VALUES ('77', '1', null, '500228', '106', '', null, null, '2015-05-06 10:09:21', '9999', null, '联想笔记本', '', null, '未付款', '15123385885', '我的地址呵呵', '', '3');
INSERT INTO `wct_bill` VALUES ('78', '1', null, '500228', '106', '', null, null, '2015-05-06 10:10:45', '9999', null, '联想笔记本', '', null, '已付款', '15123385885', '我的地址呵呵', '', '3');
INSERT INTO `wct_bill` VALUES ('79', '2', null, '500228', '106', '', null, null, '2015-05-06 10:12:33', '7899', null, '戴尔电脑', '', null, '已付款', '15123385885', '我的地址呵呵', '', '3');
INSERT INTO `wct_bill` VALUES ('80', '3', null, '500228', '106', '', null, null, '2015-05-06 10:13:21', '789', null, '女装', '', null, '已付款', '15123385885', '我的地址呵呵', '', '3');
INSERT INTO `wct_bill` VALUES ('81', '2', null, '500228', '106', '', null, null, '2015-05-06 10:18:03', '7899', null, '戴尔电脑', '', null, '已付款', '15123385885', '我的地址呵呵', '', '3');
INSERT INTO `wct_bill` VALUES ('82', '1', null, 'wangbo', '97', '', null, null, '2015-05-06 10:27:34', '9999', null, '联想笔记本', '', null, '已付款', '15123385885', '我的收货地址', '备注', '3');
INSERT INTO `wct_bill` VALUES ('83', '1', null, 'wangbo', '97', '', null, null, '2015-05-06 10:27:58', '9999', null, '联想笔记本', '', null, '已付款', '15123385885', '我的收货地址', '备注', '3');
INSERT INTO `wct_bill` VALUES ('84', '1', null, 'wangbo', '97', '', null, null, '2015-05-06 10:28:18', '9999', null, '联想笔记本', '', null, '未付款', '15123385885', '我的收货地址', '备注', '3');
INSERT INTO `wct_bill` VALUES ('85', '1', null, 'wangbo', '97', '', null, null, '2015-05-06 10:31:03', '9999', null, '联想笔记本', '', null, '已付款', '15123385885', '我的收货地址', '备注', '3');
INSERT INTO `wct_bill` VALUES ('86', '3', null, 'bobo', '102', '', null, null, '2015-05-06 10:31:27', '789', null, '女装', '', null, '未付款', '15123385882', '我的地址', '备注', '6');

-- ----------------------------
-- Table structure for `wct_choice`
-- ----------------------------
DROP TABLE IF EXISTS `wct_choice`;
CREATE TABLE `wct_choice` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(500) DEFAULT NULL,
  `opa` varchar(200) DEFAULT NULL,
  `opb` varchar(200) DEFAULT NULL,
  `opc` varchar(200) DEFAULT NULL,
  `opd` varchar(200) DEFAULT NULL,
  `daan` varchar(1) DEFAULT NULL,
  `level` int(1) DEFAULT NULL,
  `type` int(10) DEFAULT NULL,
  `typecn` varchar(50) DEFAULT NULL,
  `chapter` varchar(50) DEFAULT NULL,
  `leixing` varchar(50) DEFAULT NULL,
  `fenxi` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wct_choice
-- ----------------------------
INSERT INTO `wct_choice` VALUES ('19', '使用灭火器的第一个', '拿起灭火器', '拔掉安全闩', '不知道', '不知道', '2', null, null, null, null, null, null);

-- ----------------------------
-- Table structure for `wct_dingzuo`
-- ----------------------------
DROP TABLE IF EXISTS `wct_dingzuo`;
CREATE TABLE `wct_dingzuo` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `openid` varchar(200) DEFAULT NULL,
  `username` varchar(200) DEFAULT NULL,
  `renshu` varchar(20) DEFAULT NULL,
  `xingming` varchar(200) DEFAULT NULL,
  `shouji` varchar(200) DEFAULT NULL,
  `shijian` varchar(200) DEFAULT NULL,
  `todate` varchar(200) DEFAULT NULL,
  `beizhu` varchar(600) DEFAULT NULL,
  `shopid` varchar(200) DEFAULT NULL,
  `shopname` varchar(200) DEFAULT NULL,
  `ndate` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wct_dingzuo
-- ----------------------------

-- ----------------------------
-- Table structure for `wct_good`
-- ----------------------------
DROP TABLE IF EXISTS `wct_good`;
CREATE TABLE `wct_good` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `gname` varchar(100) DEFAULT NULL,
  `price` varchar(10) DEFAULT NULL,
  `jifen` varchar(10) DEFAULT NULL,
  `note` varchar(500) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `img` varchar(500) DEFAULT NULL,
  `count` varchar(10) DEFAULT '0',
  `typeid` varchar(10) DEFAULT NULL,
  `xiaoliang` int(10) DEFAULT '0',
  `ownid` varchar(10) DEFAULT NULL,
  `sid` varchar(10) DEFAULT NULL,
  `shop` varchar(50) DEFAULT NULL,
  `btype` varchar(1) DEFAULT NULL,
  `video` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wct_good
-- ----------------------------
INSERT INTO `wct_good` VALUES ('1', '联想笔记本', '9999', null, '这里是商品说明等', null, '1430655588.jpg', '0', '1', '0', null, null, null, null, null);
INSERT INTO `wct_good` VALUES ('2', '戴尔电脑', '7899', null, '这里是商品的详细介绍', null, '1430656638.jpg', '0', '1', '0', null, null, null, null, null);
INSERT INTO `wct_good` VALUES ('3', '女装', '789', null, '很贵的衣服', null, '1430656670.jpg', '0', '3', '0', null, null, null, null, null);

-- ----------------------------
-- Table structure for `wct_pdt`
-- ----------------------------
DROP TABLE IF EXISTS `wct_pdt`;
CREATE TABLE `wct_pdt` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(500) DEFAULT NULL,
  `daan` varchar(1) DEFAULT NULL,
  `level` int(1) DEFAULT NULL,
  `type` int(10) DEFAULT NULL,
  `typecn` varchar(50) DEFAULT NULL,
  `chapter` varchar(50) DEFAULT NULL,
  `leixing` varchar(50) DEFAULT NULL,
  `fenxi` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wct_pdt
-- ----------------------------

-- ----------------------------
-- Table structure for `wct_replay`
-- ----------------------------
DROP TABLE IF EXISTS `wct_replay`;
CREATE TABLE `wct_replay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` varchar(10) DEFAULT NULL,
  `note` varchar(500) DEFAULT NULL,
  `uid` varchar(10) DEFAULT NULL,
  `username` varchar(200) DEFAULT NULL,
  `ndate` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wct_replay
-- ----------------------------
INSERT INTO `wct_replay` VALUES ('3', '26', '这里可以对买过的药评价', '97', 'wangbo', '2015-03-16 21:30:29');
INSERT INTO `wct_replay` VALUES ('4', '30', '这里可以发表自己的看法', '99', 'wangbo2', '2015-03-29 23:24:00');
INSERT INTO `wct_replay` VALUES ('5', '34', '这里回复', '101', 'ideabobo', '2015-04-04 12:28:45');
INSERT INTO `wct_replay` VALUES ('6', '36', '这里可以交流', '102', 'bobo', '2015-04-04 12:42:59');
INSERT INTO `wct_replay` VALUES ('7', '37', '同样这里可以交流', '102', 'bobo', '2015-04-04 12:43:31');
INSERT INTO `wct_replay` VALUES ('8', '1', '购买的商品还可以评价', '106', '500228', '2015-05-03 20:45:12');

-- ----------------------------
-- Table structure for `wct_shop`
-- ----------------------------
DROP TABLE IF EXISTS `wct_shop`;
CREATE TABLE `wct_shop` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `sname` varchar(100) DEFAULT NULL,
  `img` varchar(500) DEFAULT NULL,
  `note` varchar(500) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `longitude` varchar(100) DEFAULT NULL,
  `latitude` varchar(100) DEFAULT NULL,
  `tel` varchar(100) DEFAULT NULL,
  `ownid` varchar(10) DEFAULT NULL,
  `passwd` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wct_shop
-- ----------------------------
INSERT INTO `wct_shop` VALUES ('24', '健康到家药房', '1426511730.jpg', '这里是药房的说明呵呵呵', '重庆市璧山县', null, null, '15123386866', '59', null);
INSERT INTO `wct_shop` VALUES ('25', '健一药店', '1426511968.jpg', '本店转售各种日常用药', '健一药店地址', null, null, '18708766677', '59', null);

-- ----------------------------
-- Table structure for `wct_type`
-- ----------------------------
DROP TABLE IF EXISTS `wct_type`;
CREATE TABLE `wct_type` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(500) DEFAULT NULL,
  `ownid` varchar(10) DEFAULT NULL,
  `guide` varchar(500) DEFAULT NULL,
  `about` varchar(500) DEFAULT NULL,
  `tuijian` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wct_type
-- ----------------------------
INSERT INTO `wct_type` VALUES ('1', '数码', null, null, null, null);
INSERT INTO `wct_type` VALUES ('2', '日用品', null, null, null, null);
INSERT INTO `wct_type` VALUES ('3', '服装', null, null, null, null);

-- ----------------------------
-- Table structure for `wct_user`
-- ----------------------------
DROP TABLE IF EXISTS `wct_user`;
CREATE TABLE `wct_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `passwd` varchar(50) DEFAULT NULL,
  `roletype` varchar(50) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `tel` varchar(50) DEFAULT NULL,
  `qq` varchar(20) DEFAULT NULL,
  `wechat` varchar(20) DEFAULT NULL,
  `sex` varchar(20) DEFAULT NULL,
  `birth` varchar(20) DEFAULT NULL,
  `img` varchar(200) DEFAULT NULL,
  `sid` varchar(10) DEFAULT NULL,
  `money` int(10) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=107 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wct_user
-- ----------------------------
INSERT INTO `wct_user` VALUES ('59', 'admin', 'admin', '1', '', null, null, null, null, null, null, null, null, '1');
INSERT INTO `wct_user` VALUES ('99', 'wangbo2', '111111', '2', '', '这里是我的第一', '15123385853', '8866552', '665555', '男', '2004-03-29', null, null, null);
INSERT INTO `wct_user` VALUES ('98', 'admin2', '1', '1', null, null, null, null, null, null, null, null, null, null);
INSERT INTO `wct_user` VALUES ('97', 'wangbo', '1', '2', '', '我的收货地址', '15123385885', '543548596', '', '女', '2005-03-16', null, null, '10100');
INSERT INTO `wct_user` VALUES ('101', 'ideabobo', '1', '2', '', '123123', '15123385885', '', '', '男', '', null, null, null);
INSERT INTO `wct_user` VALUES ('102', 'bobo', '111111', '2', '', '我的地址', '15123385882', '54354859', '', '男', '2015-04-04', null, null, null);
INSERT INTO `wct_user` VALUES ('103', 'wangbo3', '1', '2', '', '我的地址', '18602394120', '', '', '男', '', null, null, null);
INSERT INTO `wct_user` VALUES ('105', '500227', '1', '2', '', '4栋501', '15123385885', '', '', '男', '1995-05-03', null, null, null);
INSERT INTO `wct_user` VALUES ('106', '500228', '111111', '2', '', '我的地址呵呵', '15123385885', '543548596', '', '男', '2015-05-03', null, null, '42102');

-- ----------------------------
-- Table structure for `wct_vip`
-- ----------------------------
DROP TABLE IF EXISTS `wct_vip`;
CREATE TABLE `wct_vip` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `qq` varchar(255) DEFAULT NULL,
  `sex` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `openid` varchar(255) DEFAULT NULL,
  `vname` varchar(255) DEFAULT NULL,
  `wname` varchar(255) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wct_vip
-- ----------------------------
