-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 06 月 23 日 14:05
-- 服务器版本: 5.5.36
-- PHP 版本: 5.3.28

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `weixin`
--

-- --------------------------------------------------------

--
-- 表的结构 `xb_ad`
--

CREATE TABLE IF NOT EXISTS `xb_ad` (
  `aid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `blank` tinyint(1) NOT NULL DEFAULT '0',
  `url` varchar(150) NOT NULL DEFAULT '',
  `pic_url` varchar(250) NOT NULL DEFAULT '',
  `order` smallint(30) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`aid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- 表的结构 `xb_article`
--

CREATE TABLE IF NOT EXISTS `xb_article` (
  `aid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '标题',
  `sort_id` mediumint(5) unsigned NOT NULL DEFAULT '0' COMMENT '分类',
  `state` tinyint(1) NOT NULL DEFAULT '-1',
  `seo_title` varchar(255) NOT NULL DEFAULT '',
  `seo_keywords` varchar(255) NOT NULL DEFAULT '',
  `seo_description` varchar(255) NOT NULL DEFAULT '',
  `tuijian` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `zhiding` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ctime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `content` text NOT NULL COMMENT '内容',
  `order` mediumint(5) unsigned NOT NULL COMMENT '排序',
  PRIMARY KEY (`aid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- 表的结构 `xb_caijitpl`
--

CREATE TABLE IF NOT EXISTS `xb_caijitpl` (
  `ctid` int(10) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(20) NOT NULL DEFAULT '',
  `cid` int(10) unsigned NOT NULL DEFAULT '0',
  `num` smallint(3) unsigned NOT NULL DEFAULT '40',
  `sort_id` int(10) unsigned NOT NULL DEFAULT '0',
  `mall_item` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `start_price` decimal(11,2) unsigned NOT NULL DEFAULT '0.00',
  `end_price` decimal(11,2) unsigned NOT NULL DEFAULT '0.00',
  `start_commissionRate` mediumint(4) unsigned NOT NULL DEFAULT '0',
  `end_commissionRate` mediumint(4) unsigned NOT NULL DEFAULT '0',
  `start_credit` varchar(30) NOT NULL DEFAULT '',
  `end_credit` varchar(30) NOT NULL DEFAULT '',
  `sort` varchar(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`ctid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- 表的结构 `xb_evaluate`
--

CREATE TABLE IF NOT EXISTS `xb_evaluate` (
  `eid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '评论id',
  `store_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '店铺id',
  `store_name` varchar(200) NOT NULL DEFAULT '' COMMENT '店铺名称',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '评价人id',
  `uname` varchar(255) NOT NULL DEFAULT '' COMMENT '评价人用户名',
  `score` int(1) NOT NULL DEFAULT '1' COMMENT '总分',
  `kouwei` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '口味',
  `service` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '服务',
  `speed` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '速度',
  `content` varchar(255) NOT NULL DEFAULT '' COMMENT '评价内容',
  `state` tinyint(1) NOT NULL DEFAULT '0' COMMENT '评价状态：0=关闭，1=显示',
  `ctime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`eid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- 表的结构 `xb_favor`
--

CREATE TABLE IF NOT EXISTS `xb_favor` (
  `fid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '收藏id',
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '店铺id',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '收藏人id',
  PRIMARY KEY (`fid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- 表的结构 `xb_goods`
--

CREATE TABLE IF NOT EXISTS `xb_goods` (
  `goods_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `num_iid` varchar(20) NOT NULL DEFAULT '0',
  `title` varchar(200) NOT NULL DEFAULT '' COMMENT '宝贝名称',
  `sort_id` int(10) unsigned NOT NULL DEFAULT '0',
  `tid` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_type` varchar(255) NOT NULL COMMENT '商品类型',
  `provcity` varchar(20) NOT NULL DEFAULT '',
  `nick` varchar(32) NOT NULL DEFAULT '' COMMENT '卖家名称',
  `add_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加人',
  `add_uname` varchar(30) NOT NULL DEFAULT '',
  `seller_credit` varchar(32) NOT NULL DEFAULT '' COMMENT '卖家信用',
  `discount_price` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '折扣价',
  `price` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '现价',
  `volume` int(10) NOT NULL DEFAULT '0' COMMENT '30天推广数量',
  `comment_count` int(10) NOT NULL,
  `pic_url` varchar(255) NOT NULL COMMENT '图片地址',
  `item_url` varchar(255) NOT NULL DEFAULT '' COMMENT '宝贝地址',
  `click_url` text NOT NULL COMMENT '推广地址',
  `shop_url` text NOT NULL COMMENT '店铺地址',
  `sclick_url` text NOT NULL COMMENT '店铺推广链接',
  `item_body` longtext NOT NULL COMMENT '宝贝内容',
  `state` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态，1审核通过，0未审核',
  `seo_title` varchar(255) DEFAULT '' COMMENT 'seo标题',
  `seo_keywords` varchar(255) DEFAULT '' COMMENT 'seo关键字',
  `seo_description` varchar(255) DEFAULT '',
  `ctime` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间（时间戳）',
  `hits` int(11) NOT NULL DEFAULT '0' COMMENT '商品点击数',
  `favor` int(11) NOT NULL DEFAULT '0' COMMENT '商品赞数',
  `order` smallint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`goods_id`),
  KEY `goods_id` (`goods_id`),
  KEY `num_iid` (`num_iid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- 表的结构 `xb_history`
--

CREATE TABLE IF NOT EXISTS `xb_history` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `scheme` smallint(5) unsigned DEFAULT NULL,
  `num` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '本次已采数量',
  `empty` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- 表的结构 `xb_history_list`
--

CREATE TABLE IF NOT EXISTS `xb_history_list` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `link` char(32) NOT NULL,
  `scheme` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- 表的结构 `xb_jf_goods`
--

CREATE TABLE IF NOT EXISTS `xb_jf_goods` (
  `jf_goods_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `jf_goods_name` varchar(255) NOT NULL DEFAULT '',
  `jf_goods_img` varchar(255) NOT NULL DEFAULT '',
  `jf_goods_jf` int(10) unsigned NOT NULL DEFAULT '0',
  `jf_goods_num` int(10) unsigned NOT NULL DEFAULT '0',
  `jf_goods_out_num` int(10) unsigned NOT NULL DEFAULT '0',
  `jf_goods_expire` int(10) unsigned NOT NULL DEFAULT '0',
  `intro` text NOT NULL,
  `ctime` int(10) unsigned NOT NULL DEFAULT '0',
  `state` int(1) unsigned NOT NULL DEFAULT '1',
  `order` mediumint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`jf_goods_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- 表的结构 `xb_jf_log`
--

CREATE TABLE IF NOT EXISTS `xb_jf_log` (
  `jf_log_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `uname` varchar(255) NOT NULL DEFAULT '',
  `order_id` int(10) unsigned NOT NULL DEFAULT '0',
  `jf_goods_jf` int(10) NOT NULL DEFAULT '0',
  `ctime` int(10) unsigned NOT NULL DEFAULT '0',
  `state` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `beizhu` text NOT NULL,
  PRIMARY KEY (`jf_log_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- 表的结构 `xb_link`
--

CREATE TABLE IF NOT EXISTS `xb_link` (
  `lid` mediumint(5) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '标题',
  `href` varchar(255) NOT NULL DEFAULT '' COMMENT '连接',
  `img` varchar(255) NOT NULL DEFAULT '' COMMENT '图片',
  `order` mediumint(2) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '连接',
  PRIMARY KEY (`lid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- 表的结构 `xb_member`
--

CREATE TABLE IF NOT EXISTS `xb_member` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `openid` varchar(255) NOT NULL DEFAULT '' COMMENT 'qq互联id',
  `uname` varchar(255) NOT NULL DEFAULT '',
  `pic_url` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `level` tinyint(1) NOT NULL DEFAULT '0' COMMENT '用户级别',
  `email` varchar(255) NOT NULL DEFAULT '',
  `ctime` int(10) unsigned NOT NULL DEFAULT '0',
  `last_login_time` int(10) unsigned NOT NULL DEFAULT '0',
  `sign` int(10) unsigned NOT NULL DEFAULT '0',
  `ip` char(20) NOT NULL DEFAULT '',
  `jifen` int(10) unsigned NOT NULL DEFAULT '0',
  `mobile` varchar(15) NOT NULL DEFAULT '' COMMENT '会员号码',
  `verify_code` int(6) NOT NULL DEFAULT '0',
  `device_token` char(44) NOT NULL DEFAULT '',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- 表的结构 `xb_menu`
--

CREATE TABLE IF NOT EXISTS `xb_menu` (
  `mid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(20) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `order` mediumint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`mid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=0;

-- --------------------------------------------------------

--
-- 表的结构 `xb_scheme_keyword`
--

CREATE TABLE IF NOT EXISTS `xb_scheme_keyword` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `keyword` varchar(255) NOT NULL,
  `oncenum` tinyint(3) unsigned NOT NULL DEFAULT '100',
  `sourcefrom` varchar(50) NOT NULL,
  `downimg` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `ctime` int(10) NOT NULL,
  `totalnum` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- 表的结构 `xb_setting`
--

CREATE TABLE IF NOT EXISTS `xb_setting` (
  `setting_key` varchar(20) NOT NULL DEFAULT '' COMMENT '配置key',
  `setting_val` varchar(255) NOT NULL DEFAULT '' COMMENT '配置val',
  `intro` varchar(255) NOT NULL DEFAULT '' COMMENT '描述'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `xb_slide`
--

CREATE TABLE IF NOT EXISTS `xb_slide` (
  `sid` mediumint(5) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '标题',
  `href` varchar(255) NOT NULL DEFAULT '' COMMENT '连接',
  `img` varchar(255) NOT NULL DEFAULT '' COMMENT '图片',
  `order` mediumint(2) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`sid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- 表的结构 `xb_sort`
--

CREATE TABLE IF NOT EXISTS `xb_sort` (
  `sort_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '宝贝分类id',
  `sort_name` varchar(255) NOT NULL DEFAULT '' COMMENT '宝贝分类名称',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `nav` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `fnav` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `p_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属店铺',
  `goods_num` int(3) NOT NULL DEFAULT '0' COMMENT '包含宝贝数量',
  `state` tinyint(1) NOT NULL DEFAULT '0' COMMENT '分类状态，与宝贝状态对应：0=关闭，1开启',
  `order` int(3) unsigned NOT NULL DEFAULT '0' COMMENT '宝贝排序',
  PRIMARY KEY (`sort_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- 表的结构 `xb_topic`
--

CREATE TABLE IF NOT EXISTS `xb_topic` (
  `tid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `topic_name` varchar(50) NOT NULL DEFAULT '',
  `pic_url` varchar(255) NOT NULL DEFAULT '',
  `shop_conditions` text NOT NULL,
  `price_conditions` text NOT NULL,
  `state` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `start_time` int(10) unsigned NOT NULL DEFAULT '0',
  `end_time` int(10) unsigned NOT NULL DEFAULT '0',
  `ctime` int(10) unsigned NOT NULL DEFAULT '0',
  `content` text NOT NULL,
  `num` int(5) unsigned NOT NULL DEFAULT '0',
  `order` mediumint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`tid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
