-- phpMyAdmin SQL Dump
-- version 3.4.8
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014 年 11 月 19 日 14:15
-- 服务器版本: 5.5.28
-- PHP 版本: 5.3.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `daiyun`
--

-- --------------------------------------------------------

--
-- 表的结构 `hh85_admin`
--

CREATE TABLE IF NOT EXISTS `hh85_admin` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nickname` varchar(100) NOT NULL,
  `logintime` int(11) NOT NULL,
  `loginip` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `administrator` varchar(100) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `hh85_admin`
--

INSERT INTO `hh85_admin` (`uid`, `username`, `password`, `nickname`, `logintime`, `loginip`, `status`, `administrator`) VALUES
(9, 'admin', '7fef6171469e80d32c0559f88b377245', '网站管理员', 1385888528, '113.214.206.57', 1, 'administrator');

-- --------------------------------------------------------

--
-- 表的结构 `hh85_announcement`
--

CREATE TABLE IF NOT EXISTS `hh85_announcement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `createtime` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `hh85_article`
--

CREATE TABLE IF NOT EXISTS `hh85_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(1000) NOT NULL,
  `cid` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `hh85_comment`
--

CREATE TABLE IF NOT EXISTS `hh85_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `createtime` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `evaluate` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

-- --------------------------------------------------------

--
-- 表的结构 `hh85_config`
--

CREATE TABLE IF NOT EXISTS `hh85_config` (
  `id` int(11) NOT NULL,
  `sitename` varchar(255) NOT NULL,
  `siteurl` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL COMMENT '公司地址',
  `phone` varchar(255) NOT NULL COMMENT '公司电话',
  `email` varchar(255) NOT NULL COMMENT '公司邮箱',
  `icp` varchar(255) NOT NULL,
  `pic3` varchar(255) NOT NULL,
  `link3` varchar(255) NOT NULL,
  `pic4` varchar(255) NOT NULL,
  `link4` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `hh85_config`
--

INSERT INTO `hh85_config` (`id`, `sitename`, `siteurl`, `address`, `phone`, `email`, `icp`, `pic3`, `link3`, `pic4`, `link4`) VALUES
(1, '桐乡科慧电脑', 'http://www.ke-hui.cn', '桐乡市振兴东路319号', '0573-88131555', 'txtyf@163.com', '', '', '', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `hh85_msg`
--

CREATE TABLE IF NOT EXISTS `hh85_msg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `createtime` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `zan` int(11) NOT NULL,
  `good` int(11) NOT NULL COMMENT '置顶',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- 转存表中的数据 `hh85_msg`
--

INSERT INTO `hh85_msg` (`id`, `cid`, `title`, `photo`, `content`, `createtime`, `uid`, `status`, `zan`, `good`) VALUES
(1, 1, '二234234', '', '最后的帖子', 0, 0, 1, 0, 0),
(2, 2, '玩儿2万(⊙o⊙)…2', '', '234234234', 0, 0, 1, 0, 0),
(3, 2, '维尔瓦而2', '', '234234234234324324', 1413442612, 0, 1, 0, 1),
(4, 2, '而然4324', '', '234234324324', 1413442672, 3, 0, 0, 0),
(5, 2, '路口兔兔了', '', '图去体验下无路可', 1413443160, 3, 0, 0, 0),
(6, 2, '路口兔兔了', 'http://daiyun.hh85.com//data/photo/201410/543f6db49b0d9.jpg|http://daiyun.hh85.com//data/photo/201410/543f6e422fd8e.jpg', '图去体验下无路可', 1413443207, 3, 0, 20, 1),
(7, 2, 'werwer', '', 'werwer', 1413533946, 8, 1, 0, 0),
(8, 2, '天气不错', '', '好像不错', 1414223335, 3, 1, 0, 0),
(12, 2, '小说里', '', '问', 1415013159, 15, 0, 0, 0),
(13, 2, '34223423', '', '234234324额外人味儿', 1415066023, 3, 0, 0, 0),
(14, 2, '额外热污染', '', '234324324324', 1415071855, 3, 0, 0, 0),
(15, 2, '1111', '', '1111', 1415071965, 3, 1, 0, 0),
(16, 2, '维尔瓦而', '', '32423234234', 1415072022, 3, 0, 0, 0),
(17, 2, '我企鹅我去额', '', '213123123', 1415072056, 3, 0, 0, 0),
(18, 2, '没了开拓', 'aHR0cDovL2RhaXl1bi5oaDg1LmNvbS8vZGF0YS9waG90by8yMDE0MTEvNTQ1ODRhNjE3ZmZmMy5qcGc=', '…58988888', 1415072362, 3, 0, 0, 0),
(19, 1, '昨日精力充沛', 'aHR0cDovL2RhaXl1bi5oaDg1LmNvbS8vZGF0YS9waG90by8yMDE0MTEvNTQ1ODRkODQzNzBiNC5wbmc=', '55888999', 1415073162, 3, 0, 0, 0),
(20, 2, '55685', 'http://daiyun.hh85.com//data/photo/201411/54584e6ea5e2b.png', '太累了我', 1415073394, 3, 0, 0, 0),
(21, 2, '15545', 'http://daiyun.hh85.com//data/photo/201411/54586b0e4169f.jpg', '最后的内容', 1415080724, 3, 0, 0, 0),
(22, 1, '工l己工', '', '了下ca', 1415674980, 15, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `hh85_msg_cate`
--

CREATE TABLE IF NOT EXISTS `hh85_msg_cate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `hh85_msg_cate`
--

INSERT INTO `hh85_msg_cate` (`id`, `name`) VALUES
(1, '孕期保养'),
(2, '谈天说地'),
(3, '测试类目');

-- --------------------------------------------------------

--
-- 表的结构 `hh85_news`
--

CREATE TABLE IF NOT EXISTS `hh85_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `cover` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `createtime` int(11) NOT NULL,
  `hits` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `sides` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `good` int(11) NOT NULL,
  `zuozhe` varchar(100) NOT NULL,
  `laiyuan` varchar(100) NOT NULL,
  `fubiaoti` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `hh85_news`
--

INSERT INTO `hh85_news` (`id`, `cid`, `title`, `cover`, `content`, `createtime`, `hits`, `status`, `sides`, `uid`, `good`, `zuozhe`, `laiyuan`, `fubiaoti`) VALUES
(1, 1, '公司新闻1111', '', '瑞特让他', 1410941844, 0, 1, 0, 0, 0, '', '', ''),
(2, 2, 'iPhone 5用什么处理器', '', '<p style="color:#333333;font-size:14px;font-family:宋体;background-color:#FAFDFF;">\r\n	&nbsp; 三星和苹果再次催动了他们旗下庞大的律师团队打响了一场惊世骇俗赌注近数十亿美元的律师大战，目前iPhone共推出5代，分别是第一代2G的GSM网络及其升级版GPRS和EDGE，其他型号均支持3G的WCDMA网络。从iPhone 4开始，推出了支持CDMA版本的型号。不同的是iPhone 4的GSM•WCDMA版本手机和CDMA版本的手机互不兼容，但在iPhone 4S开始，可以使用一部手机兼容两个版本。\r\n</p>\r\n<p style="color:#333333;font-size:14px;font-family:宋体;background-color:#FAFDFF;">\r\n	<br />\r\n</p>\r\n<p style="color:#333333;font-size:14px;font-family:宋体;background-color:#FAFDFF;">\r\n	<br />\r\n&nbsp;&nbsp;&nbsp; 根据业内消息透露，iPhone 5将搭载型号为S5L8950X的处理器，但这款处理器采用的究竟是双核还是四核芯片，还有待观察。业内称新款iPhone将使用三星生产的处理器。还传言iPhone 5——或许会命名为“new iPhone”，尽管这一名词称使人十分困惑——将由四核“A6”处理器带动。也就是说，该处理器将与三星Galaxy S III的非LTE(长期演进技术)国际版所采用的猎户座四核(Exynos 4)芯片相仿。也有人不是这样认为，他们认为iPhone5将继续采用苹果自己的处理器苹果A5处理器，这个处理器和以往的不一样，之前是A4单核1GHz的处理器。而iPhone5则采用苹果A5双核1GHz处理器。苹果自己研发的处理器很稳定，而且，苹果公司为了实现更好的体验效果，同时对ios系统更佳的专注。让系统在iPhone手机上运行的更流畅!基于新iPad搭载的S5L8945X处理器和iPhone 4S的S5L8940X推测，S5L8950X应该是基于32nm工艺的低能耗双核处理器。而有一点几乎能够确定的是，iPhone 5将搭载苹果下一代iOS 6操作系统。<br />\r\n&nbsp;&nbsp;&nbsp; iphone5参数<br />\r\n&nbsp;&nbsp;&nbsp; 这款手机是年底即将要上市的苹果iphone5手机，这款将采用双核处理器。先让我们看看这款手机的详细参数<br />\r\n&nbsp;&nbsp;&nbsp; 1、屏幕：4寸IPS电容屏，支持多点触控(十点)<br />\r\n&nbsp;&nbsp;&nbsp; 2、分辨率：640X960像素<br />\r\n&nbsp;&nbsp;&nbsp; 3、网络模式：GSM,CDMA2000，WCDMA等网络<br />\r\n&nbsp;&nbsp;&nbsp; 4、系统：IOS5系统<br />\r\n&nbsp;&nbsp;&nbsp; 5、处理器：苹果A5 双核1GHz处理器，携带Imagination PowerVR SGX535图形处理芯片<br />\r\n&nbsp;&nbsp;&nbsp; 6、机身内存：16G、32G、64G三个版本的内存<br />\r\n&nbsp;&nbsp;&nbsp; 7、其他功能：GPS导航，电子罗盘，重力感应器，加速传感器，光线传感器，距离传感器，3D加速，内置800万像素，双LED补光灯，支持JAVA扩展，蓝牙3.0传输，红外遥控，WIFI等功能。<br />\r\n&nbsp;&nbsp;&nbsp; 三星处理器和苹果处理器之间的比较<br />\r\n&nbsp;&nbsp;&nbsp; 苹果在处理器的运算能力方面并不怎么出色，事实上苹果公司也一直都是这样。其竞争对手也一直拿这来嘲笑苹果的配置。直到后来，苹果产品在零售店和运营商那里大受欢迎，此时嘲笑之声才戛然而止。现在热销的iPhone 4S和iPad 2一样使用的是A5的处理器，当然，在他各方面都一样的情况下，四核CPU在普通运算方面肯定比双核CPU更快。但是在一般上网等信息的处理方面并没有多大的区别，我们也是感觉不出来的。其实双核仍未过时，除了喜新厌旧之外，把尚未公布的四核A6芯片强塞进想象中的iPhone 5有什么作用吗？iPhone用户并不是很关心其手机内部处理器的时钟频率是多少，只要手机运行顺畅就行。<br />\r\n&nbsp;&nbsp;&nbsp; 的确，这款手机真的非常不错，只是价格稍微贵了点，要是有的朋友拆过iphone手机的话，就知道苹果手机是一款真正的科技产物。这款手机融入了很高的科技含金量。可以说苹果手机就是一个科技的结晶。\r\n</p>', 1411024243, 0, 1, 0, 0, 0, '', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `hh85_photo`
--

CREATE TABLE IF NOT EXISTS `hh85_photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `photo_url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `hh85_product`
--

CREATE TABLE IF NOT EXISTS `hh85_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `cover` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `createtime` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- 转存表中的数据 `hh85_product`
--

INSERT INTO `hh85_product` (`id`, `cid`, `cover`, `price`, `title`, `content`, `createtime`, `status`) VALUES
(33, 1, '/Public/upload/201409/541a51eb9be97.jpg', 0.00, '联想小新2（V1000 FHD-ISE）', '笔记本', 1411011068, 1),
(34, 1, '/Public/upload/201409/541a89a02ab5c.jpg', 0.00, '高性能交换机', '<p>\r\n	&nbsp; 通信科技有限公司系列通信开关电源专为各种通信电子设备如程控交换机、微波设备、光纤通信设备等设计的高效率、高性能、高稳定、高可靠的通信电源，它采用国际最先进的PWM技术和最稳定可靠的电路拓朴结构。整机具有体积小、重量轻、效率高、工作温度范围宽、抗干扰能力强、电网适应力强、动态响应快、稳定度高、杂音纹波小、保护功能强等特点。适用于数控机床、数据处理等设备，亦可作为蓄电池的充放电设备。\r\n</p>\r\n<p>\r\n	<p style="color:#333333;font-family:宋体;background-color:#FAFDFF;">\r\n		&nbsp;ZMUX-30是由通信科技有限公司自主研发及生产的，采用最新大规模数字集成电路和厚薄膜工艺技术而推出的一款紧凑型PCM多业务复用设备。\r\n	</p>\r\n	<p style="color:#333333;font-family:宋体;background-color:#FAFDFF;">\r\n		&nbsp; &nbsp; ZMUX-30采用模块化设计，可兼容电话、4W音频、RS232、以太网四种用户模块，1片模块对应1路用户接口，各用户模块均以子卡形式插装在主板上，故障互不影响，安全性更高、扩容非常方便。设备背面设有30个RJ45接口，每个RJ45接口对应1路用户接口，安装、维护非常方便。\r\n	</p>\r\n	<p style="color:#333333;font-family:宋体;background-color:#FAFDFF;">\r\n		&nbsp; &nbsp; ZMUX-30设备为1U高机架式设计，占用空间小，设备稳定可靠，特别适用于业务量不多的用户站进行综合接入及复用，目前已广泛应用于国内电力、部队、公安、煤矿、政府、石油、企业等多个行业的专网通信中。设备简单、易懂，具有齐全的状态指示灯，能够正确直观的显示设备运行状态或故障原因，管理与维护相当方便。\r\n	</p>\r\n	<table align="center" border="2" bordercolor="#000000" width="700" style="color:#333333;font-family:宋体;font-size:12px;background-color:#FAFDFF;">\r\n		<tbody>\r\n			<tr>\r\n				<td width="100">\r\n					<p align="center">\r\n						<span style="color:#0162F4;">接口号码</span>\r\n					</p>\r\n				</td>\r\n				<td width="120">\r\n					<p align="center">\r\n						<span style="color:#0162F4;">接口名称</span>\r\n					</p>\r\n				</td>\r\n				<td width="480">\r\n					<p align="center">\r\n						<span style="color:#0162F4;">接口说明</span>\r\n					</p>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td>\r\n					<p align="center">\r\n						①\r\n					</p>\r\n				</td>\r\n				<td>\r\n					<p align="center">\r\n						传输链路接口\r\n					</p>\r\n				</td>\r\n				<td>\r\n					<p align="center">\r\n						1路E1（2M）电口，75欧或125欧可选\r\n					</p>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td>\r\n					<p align="center">\r\n						②\r\n					</p>\r\n				</td>\r\n				<td>\r\n					<p align="center">\r\n						用户业务接口\r\n					</p>\r\n				</td>\r\n				<td>\r\n					<p align="center">\r\n						30路用户接口，模块化设计，根据实际应用插装。（可兼容：语音电话、4W音频、RS232、n*64k以太网）\r\n					</p>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td>\r\n					<p align="center">\r\n						③\r\n					</p>\r\n				</td>\r\n				<td>\r\n					<p align="center">\r\n						系统指示灯\r\n					</p>\r\n				</td>\r\n				<td>\r\n					<p align="center">\r\n						设备告警指示灯、运行状态指示灯\r\n					</p>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td>\r\n					<p align="center">\r\n						④\r\n					</p>\r\n				</td>\r\n				<td>\r\n					<p align="center">\r\n						电源接口及开关\r\n					</p>\r\n				</td>\r\n				<td>\r\n					<p align="center">\r\n						-48V直流电源插头（绿色），设备电源开关（红色）\r\n					</p>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td>\r\n					<p align="center">\r\n						⑤\r\n					</p>\r\n				</td>\r\n				<td>\r\n					<p align="center">\r\n						接地端子\r\n					</p>\r\n				</td>\r\n				<td>\r\n					<p align="center">\r\n						设备接地\r\n					</p>\r\n				</td>\r\n			</tr>\r\n		</tbody>\r\n	</table>\r\n</p>', 1411025606, 1),
(35, 1, '/Public/upload/201409/541a89d35dd00.jpg', 0.00, '笔记本电源线', '<p>\r\n	品字尾电源线、适配器、接线端子组合而成，主要应用于通讯设备、工业自动化控制、军工设备、科研设备、LED照明、工控设备、电力设备、仪器仪表、医疗设备、半导体制冷制热、空气净化器、电子冰箱、液晶显示器、LED灯具、通讯设备、视听产品、安防、电脑机箱、数码产品和仪器类等领域。\r\n</p>', 1411025370, 1);

-- --------------------------------------------------------

--
-- 表的结构 `hh85_reply`
--

CREATE TABLE IF NOT EXISTS `hh85_reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `msg_id` int(11) NOT NULL,
  `reply_uid` int(11) NOT NULL COMMENT '回复的人UID',
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf32 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `hh85_reply`
--

INSERT INTO `hh85_reply` (`id`, `uid`, `content`, `photo`, `msg_id`, `reply_uid`, `status`) VALUES
(1, 6, 'werwerewrewrewrewr', 'http://daiyun.hh85.com//data/photo/201410/543f6db49b0d9.jpg|http://daiyun.hh85.com//data/photo/201410/543f6e422fd8e.jpg', 6, 0, 0),
(2, 5, 'xiewerkj温热我日 324324324234234维尔瓦而234234', 'http://daiyun.hh85.com//data/photo/201410/543f6db49b0d9.jpg|http://daiyun.hh85.com//data/photo/201410/543f6e422fd8e.jpg', 6, 3, 0),
(3, 7, '热特让他345435', '', 6, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `hh85_trip`
--

CREATE TABLE IF NOT EXISTS `hh85_trip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `uid` int(11) NOT NULL,
  `createtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `hh85_trip`
--

INSERT INTO `hh85_trip` (`id`, `title`, `content`, `uid`, `createtime`) VALUES
(1, '赴美注意事项', 'werwer', 0, 0),
(2, '美国安全指南', '额外热', 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
