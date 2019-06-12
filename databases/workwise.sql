/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : workwise

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2019-06-12 12:34:39
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for pre_admin
-- ----------------------------
DROP TABLE IF EXISTS `pre_admin`;
CREATE TABLE `pre_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `username` varchar(150) DEFAULT NULL COMMENT '用户名',
  `password` varchar(80) DEFAULT NULL COMMENT '密码',
  `salt` varchar(80) DEFAULT NULL COMMENT '密码盐',
  `avatar` varchar(255) DEFAULT NULL COMMENT '头像',
  `createtime` int(11) DEFAULT '0' COMMENT '注册时间',
  `status` tinyint(4) DEFAULT '1' COMMENT '0禁用 1启用',
  `groupid` int(10) unsigned DEFAULT NULL COMMENT '角色外键',
  PRIMARY KEY (`id`),
  KEY `groupid` (`groupid`),
  CONSTRAINT `group` FOREIGN KEY (`groupid`) REFERENCES `pre_group` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- ----------------------------
-- Records of pre_admin
-- ----------------------------
INSERT INTO `pre_admin` VALUES ('1', 'admin', 'd952de8d1fdddf0a67508c808f8561a1', 'y5ht5lrgabnlj42tnfj9u00ht9yktz', 'admin/images/profile/profile1.jpg', '0', '1', '1');

-- ----------------------------
-- Table structure for pre_comments
-- ----------------------------
DROP TABLE IF EXISTS `pre_comments`;
CREATE TABLE `pre_comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(10) unsigned DEFAULT NULL,
  `postid` int(10) unsigned DEFAULT NULL,
  `content` text,
  `createtime` int(11) DEFAULT '0',
  `pid` int(11) DEFAULT '0' COMMENT '评论的上级id',
  PRIMARY KEY (`id`),
  KEY `comment_user` (`userid`),
  KEY `comment_post` (`postid`),
  CONSTRAINT `comment_postid` FOREIGN KEY (`postid`) REFERENCES `pre_post` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `comment_userid` FOREIGN KEY (`userid`) REFERENCES `pre_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='评论表';

-- ----------------------------
-- Records of pre_comments
-- ----------------------------

-- ----------------------------
-- Table structure for pre_config
-- ----------------------------
DROP TABLE IF EXISTS `pre_config`;
CREATE TABLE `pre_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(255) DEFAULT NULL COMMENT '配置名称',
  `title` varchar(255) DEFAULT NULL COMMENT '配置的中文项',
  `values` text COMMENT '配置的内容',
  `groups` int(11) DEFAULT '0' COMMENT '分组',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='配置表';

-- ----------------------------
-- Records of pre_config
-- ----------------------------
INSERT INTO `pre_config` VALUES ('1', 'website', '网站地址', 'http://www.workwise.com', '1');

-- ----------------------------
-- Table structure for pre_follow
-- ----------------------------
DROP TABLE IF EXISTS `pre_follow`;
CREATE TABLE `pre_follow` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `follow` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '关注者',
  `userid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '被关注者',
  `createtime` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `follow` (`follow`),
  KEY `follow_user` (`userid`),
  CONSTRAINT `followid` FOREIGN KEY (`follow`) REFERENCES `pre_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `follow_userid` FOREIGN KEY (`userid`) REFERENCES `pre_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='粉丝关注表';

-- ----------------------------
-- Records of pre_follow
-- ----------------------------

-- ----------------------------
-- Table structure for pre_group
-- ----------------------------
DROP TABLE IF EXISTS `pre_group`;
CREATE TABLE `pre_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(150) DEFAULT NULL COMMENT '角色名称',
  `rules` text COMMENT '角色规则',
  `status` tinyint(4) DEFAULT '1' COMMENT '0禁用1启用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COMMENT='角色表';

-- ----------------------------
-- Records of pre_group
-- ----------------------------
INSERT INTO `pre_group` VALUES ('1', '超级管理员', '1,2,3,19,20,21,4,11,12,13,5,6,7,8,9,10', '1');
INSERT INTO `pre_group` VALUES ('2', '超级管理员', '1,2,3,4,5,6,7,8,9,10,11,12,13', '1');
INSERT INTO `pre_group` VALUES ('3', '超级管理员', '1,2,3,4,5,6,7,8,9,10,11,12,13', '1');
INSERT INTO `pre_group` VALUES ('4', '超级管理员', '1,2,3,4,5,6,7,8,9,10,11,12,13', '1');
INSERT INTO `pre_group` VALUES ('5', '超级管理员', '1,2,3,4,5,6,7,8,9,10,11,12,13', '1');
INSERT INTO `pre_group` VALUES ('6', '超级管理员', '1,2,3,4,5,6,7,8,9,10,11,12,13', '1');
INSERT INTO `pre_group` VALUES ('7', '超级管理员', '1,2,3,4,5,6,7,8,9,10,11,12,13', '1');
INSERT INTO `pre_group` VALUES ('8', '超级管理员', '1,2,3,4,5,6,7,8,9,10,11,12,13', '1');
INSERT INTO `pre_group` VALUES ('9', '超级管理员', '1,2,3,4,5,6,7,8,9,10,11,12,13', '1');
INSERT INTO `pre_group` VALUES ('10', '超级管理员', '1,2,3,4,5,6,7,8,9,10,11,12,13', '1');
INSERT INTO `pre_group` VALUES ('11', '超级管理员', '1,2,3,4,5,6,7,8,9,10,11,12,13', '1');
INSERT INTO `pre_group` VALUES ('12', '超级管理员', '1,2,3,4,5,6,7,8,9,10,11,12,13', '1');
INSERT INTO `pre_group` VALUES ('13', '超级管理员', '1,2,3,4,5,6,7,8,9,10,11,12,13', '1');
INSERT INTO `pre_group` VALUES ('14', '超级管理员', '1,2,3,4,5,6,7,8,9,10,11,12,13', '1');
INSERT INTO `pre_group` VALUES ('15', '超级管理员', '1,2,3,4,5,6,7,8,9,10,11,12,13', '1');
INSERT INTO `pre_group` VALUES ('16', '超级管理员', '1,2,3,4,5,6,7,8,9,10,11,12,13', '1');
INSERT INTO `pre_group` VALUES ('17', '超级管理员', '1,2,3,4,5,6,7,8,9,10,11,12,13', '1');
INSERT INTO `pre_group` VALUES ('18', '超级管理员', '1,2,3,4,5,6,7,8,9,10,11,12,13', '1');
INSERT INTO `pre_group` VALUES ('19', '超级管理员', '1,2,3,4,5,6,7,8,9,10,11,12,13', '1');
INSERT INTO `pre_group` VALUES ('20', '超级管理员', '1,2,3,4,5,6,7,8,9,10,11,12,13', '1');
INSERT INTO `pre_group` VALUES ('21', '超级管理员', '1,2,3,4,5,6,7,8,9,10,11,12,13', '1');
INSERT INTO `pre_group` VALUES ('22', '超级管理员', '1,2,3,4,5,6,7,8,9,10,11,12,13', '1');
INSERT INTO `pre_group` VALUES ('23', '超级管理员', '1,2,3,4,5,6,7,8,9,10,11,12,13', '1');
INSERT INTO `pre_group` VALUES ('24', '超级管理员', '1,2,3,4,5,6,7,8,9,10,11,12,13', '1');
INSERT INTO `pre_group` VALUES ('25', '超级管理员', '1,2,3,4,5,6,7,8,9,10,11,12,13', '1');
INSERT INTO `pre_group` VALUES ('26', '超级管理员', '1,2,3,4,5,6,7,8,9,10,11,12,13', '1');
INSERT INTO `pre_group` VALUES ('27', '超级管理员', '1,2,3,4,5,6,7,8,9,10,11,12,13', '1');
INSERT INTO `pre_group` VALUES ('28', '超级管理员', '1,2,3,4,5,6,7,8,9,10,11,12,13', '1');
INSERT INTO `pre_group` VALUES ('29', '超级管理员', '1,2,3,4,5,6,7,8,9,10,11,12,13', '1');
INSERT INTO `pre_group` VALUES ('30', '超级管理员', '1,2,3,4,5,6,7,8,9,10,11,12,13', '1');
INSERT INTO `pre_group` VALUES ('31', '超级管理员', '1,2,3,4,5,6,7,8,9,10,11,12,13', '1');
INSERT INTO `pre_group` VALUES ('32', '超级管理员', '1,2,3,4,5,6,7,8,9,10,11,12,13', '1');
INSERT INTO `pre_group` VALUES ('33', '超级管理员', '1,2,3,4,5,6,7,8,9,10,11,12,13', '1');
INSERT INTO `pre_group` VALUES ('34', '普通管理员', '5,6,7,8,9,10', '1');

-- ----------------------------
-- Table structure for pre_links
-- ----------------------------
DROP TABLE IF EXISTS `pre_links`;
CREATE TABLE `pre_links` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `desc` text,
  `avatar` varchar(255) DEFAULT NULL,
  `createtime` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='友情链接表';

-- ----------------------------
-- Records of pre_links
-- ----------------------------

-- ----------------------------
-- Table structure for pre_message
-- ----------------------------
DROP TABLE IF EXISTS `pre_message`;
CREATE TABLE `pre_message` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` text,
  `createtime` int(11) DEFAULT '0',
  `from` int(11) NOT NULL DEFAULT '0' COMMENT '发送方的用户id',
  `to` int(11) NOT NULL DEFAULT '0' COMMENT '接收方 0 所有人接收',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='消息表';

-- ----------------------------
-- Records of pre_message
-- ----------------------------

-- ----------------------------
-- Table structure for pre_post
-- ----------------------------
DROP TABLE IF EXISTS `pre_post`;
CREATE TABLE `pre_post` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `gallery` text,
  `createtime` int(11) DEFAULT '0',
  `like` text,
  `userid` int(10) unsigned NOT NULL DEFAULT '0',
  `tagsid` text COMMENT '关联的标签外键',
  PRIMARY KEY (`id`),
  KEY `post_user` (`userid`),
  CONSTRAINT `post_userid` FOREIGN KEY (`userid`) REFERENCES `pre_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='帖子表';

-- ----------------------------
-- Records of pre_post
-- ----------------------------

-- ----------------------------
-- Table structure for pre_rule
-- ----------------------------
DROP TABLE IF EXISTS `pre_rule`;
CREATE TABLE `pre_rule` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `url` varchar(255) DEFAULT NULL COMMENT '规则路径',
  `title` varchar(100) DEFAULT NULL COMMENT '规则名称',
  `pid` int(11) DEFAULT '0' COMMENT '父Id',
  `ismenu` tinyint(4) DEFAULT '1' COMMENT '1显示 0隐藏',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COMMENT='规则表';

-- ----------------------------
-- Records of pre_rule
-- ----------------------------
INSERT INTO `pre_rule` VALUES ('1', '', '权限管理', '0', '1');
INSERT INTO `pre_rule` VALUES ('2', null, '管理员', '1', '1');
INSERT INTO `pre_rule` VALUES ('3', '/admin/grouplist.php', '角色管理', '1', '1');
INSERT INTO `pre_rule` VALUES ('4', '/admin/rulelist.php', '菜单规则', '1', '1');
INSERT INTO `pre_rule` VALUES ('5', null, '系统配置', '0', '1');
INSERT INTO `pre_rule` VALUES ('6', null, '基本设置', '5', '1');
INSERT INTO `pre_rule` VALUES ('7', null, '友情链接', '5', '1');
INSERT INTO `pre_rule` VALUES ('8', null, '用户管理', '0', '1');
INSERT INTO `pre_rule` VALUES ('9', null, '会员管理', '8', '1');
INSERT INTO `pre_rule` VALUES ('10', '/admin/index.php', '控制台', '0', '1');
INSERT INTO `pre_rule` VALUES ('11', '/admin/ruleadd.php', '规则添加', '4', '1');
INSERT INTO `pre_rule` VALUES ('12', '/admin/ruleedit.php', '规则编辑', '4', '1');
INSERT INTO `pre_rule` VALUES ('13', '/admin/ruledelete.php', '规则删除', '4', '1');
INSERT INTO `pre_rule` VALUES ('19', '/admin/groupadd.php', '角色添加', '3', '1');
INSERT INTO `pre_rule` VALUES ('20', '/admin/groupedit.php', '角色编辑', '3', '1');
INSERT INTO `pre_rule` VALUES ('21', '/admin/groupdelete.php', '角色删除', '3', '1');

-- ----------------------------
-- Table structure for pre_tags
-- ----------------------------
DROP TABLE IF EXISTS `pre_tags`;
CREATE TABLE `pre_tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '标签名称',
  `userid` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `tags_user` (`userid`),
  CONSTRAINT `tags_userid` FOREIGN KEY (`userid`) REFERENCES `pre_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='标签表';

-- ----------------------------
-- Records of pre_tags
-- ----------------------------

-- ----------------------------
-- Table structure for pre_user
-- ----------------------------
DROP TABLE IF EXISTS `pre_user`;
CREATE TABLE `pre_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `username` varchar(150) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `salt` varchar(80) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `desc` text,
  `createtime` int(11) DEFAULT '0' COMMENT '注册时间',
  `gallery` text COMMENT '图片集',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of pre_user
-- ----------------------------
