/*
SQLyog Ultimate v11.33 (64 bit)
MySQL - 5.5.53 : Database - xm
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`xm` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `xm`;

/*Table structure for table `xm_admin` */

DROP TABLE IF EXISTS `xm_admin`;

CREATE TABLE `xm_admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '管理员ID',
  `admin_username` varchar(50) DEFAULT NULL COMMENT '管理员名',
  `admin_password` varchar(64) DEFAULT NULL COMMENT '管理员密码',
  `last_time` varchar(11) DEFAULT NULL COMMENT '上一次登录的时间',
  `login_count` int(11) DEFAULT NULL COMMENT '登录次数',
  `create_time` varchar(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `xm_admin` */

insert  into `xm_admin`(`admin_id`,`admin_username`,`admin_password`,`last_time`,`login_count`,`create_time`) values (1,'admin','fcea920f7412b5da7be0cf42b8c93759','1567048003',17,'1559269542');

/*Table structure for table `xm_assist` */

DROP TABLE IF EXISTS `xm_assist`;

CREATE TABLE `xm_assist` (
  `assist_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) DEFAULT NULL,
  `assist_name` varchar(100) DEFAULT NULL,
  `assist_num` int(11) DEFAULT NULL,
  `create_time` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`assist_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Data for the table `xm_assist` */

insert  into `xm_assist`(`assist_id`,`course_id`,`assist_name`,`assist_num`,`create_time`) values (1,12,'木耳',10,NULL),(2,12,'豆芽',10,NULL),(3,12,'木耳',10,NULL),(4,12,'豆芽',10,NULL),(5,13,'猪肉末',50,'1566799754'),(6,13,'香葱',10,'1566799754'),(9,13,'测试',1,'1566802836'),(10,11,'葱段',3,'1566803475'),(11,17,'健身辅料',45,'1566806400'),(12,15,'塑性辅料',10,'1566809658'),(13,18,'葱',7,'1566975708');

/*Table structure for table `xm_cdtype` */

DROP TABLE IF EXISTS `xm_cdtype`;

CREATE TABLE `xm_cdtype` (
  `cdtype_id` int(11) NOT NULL AUTO_INCREMENT,
  `cdtype_name` varchar(100) DEFAULT NULL,
  `create_time` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`cdtype_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `xm_cdtype` */

insert  into `xm_cdtype`(`cdtype_id`,`cdtype_name`,`create_time`) values (1,'健身3','1565140889'),(2,'游泳','1565141023'),(3,'乒乓球','1566525527');

/*Table structure for table `xm_collect` */

DROP TABLE IF EXISTS `xm_collect`;

CREATE TABLE `xm_collect` (
  `collect_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `collect_flag` enum('1','2','3','4','5') DEFAULT NULL COMMENT '1名师，2吃动，3烹调，4妇幼，5食材，6营养',
  `create_time` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`collect_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `xm_collect` */

insert  into `xm_collect`(`collect_id`,`user_id`,`type_id`,`collect_flag`,`create_time`) values (2,1,3,'1','1566203343');

/*Table structure for table `xm_condiment` */

DROP TABLE IF EXISTS `xm_condiment`;

CREATE TABLE `xm_condiment` (
  `condiment_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) DEFAULT NULL,
  `condiment_name` varchar(100) DEFAULT NULL,
  `condiment_num` int(11) DEFAULT NULL,
  `create_time` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`condiment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Data for the table `xm_condiment` */

insert  into `xm_condiment`(`condiment_id`,`course_id`,`condiment_name`,`condiment_num`,`create_time`) values (1,12,'盐',1,NULL),(2,12,'白醋',1,NULL),(3,13,'麻椒',10,'1566799754'),(4,13,'盐',3,'1566799754'),(8,13,'郫县豆瓣酱',10,'1566802836'),(9,11,'盐',3,'1566803475'),(10,17,'调味品',1,'1566806400'),(11,15,'塑性调味',3,'1566809658'),(12,18,'盐',3,'1566975708'),(13,18,'醋',5,'1566975708');

/*Table structure for table `xm_cooking` */

DROP TABLE IF EXISTS `xm_cooking`;

CREATE TABLE `xm_cooking` (
  `cooking_id` int(11) NOT NULL AUTO_INCREMENT,
  `cooking_name` varchar(50) DEFAULT NULL,
  `pttype_id` int(11) DEFAULT NULL,
  `cooking_content` varchar(1000) DEFAULT NULL,
  `cooking_img` varchar(150) DEFAULT NULL,
  `cooking_thumbimg` varchar(150) DEFAULT NULL,
  `cooking_video` varchar(200) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `usertype_id` int(11) DEFAULT NULL,
  `cooking_ischarge` enum('1','2') DEFAULT NULL COMMENT '1免费，2收费',
  `cooking_standard` varchar(3) DEFAULT NULL,
  `cooking_isoff` enum('1','2') DEFAULT '2' COMMENT '1不下架，2下架',
  `create_time` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`cooking_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `xm_cooking` */

insert  into `xm_cooking`(`cooking_id`,`cooking_name`,`pttype_id`,`cooking_content`,`cooking_img`,`cooking_thumbimg`,`cooking_video`,`user_id`,`user_name`,`usertype_id`,`cooking_ischarge`,`cooking_standard`,`cooking_isoff`,`create_time`) values (2,'煮',7,'第三方士大夫撒旦法撒旦法师法<img src=\"/xm/public/static/uploads/pt_img/20190802/3961dfc4ffd8254ceab6af214c53b532.jpg\" alt=\"undefined\">','/public/static/uploads/pt_img/20190802/9d53ac630b19ed218d23e37f26e012dd.jpg','/public/static/uploads/pt_img/20190802/9d53ac630b19ed218d23e37f26e012ddthumb.jpg','http://pwmcv4411.bkt.clouddn.com/4ddf67d96e9e2d5932dfb1970ff82d18.mp4',2,'李向阳',2,'2','3','1','1564726659'),(3,'卤',6,'usID会放宽教师端会计法','/public/static/uploads/admin/20190822/8a5de8374553b2c2a755f323b84c73ab.jpg','/public/static/uploads/admin/20190822/8a5de8374553b2c2a755f323b84c73abthumb.jpg','http://pwmcv4411.bkt.clouddn.com/15664672831ae3f400ca4fa24e6ad1e06c11b5bd02.mp4',NULL,'齐胜科',NULL,'1','','1','1566456979'),(4,'测试',6,'GV结婚是看几行VB就会被&nbsp;','/public/static/uploads/admin/20190822/ec81704006799c890d4c1626f8253863.JPG','/public/static/uploads/admin/20190822/ec81704006799c890d4c1626f8253863thumb.JPG','http://pwmcv4411.bkt.clouddn.com/1566466357002adb188da33fb609a802d85b6f6499.mp4',NULL,'测试',NULL,'1','','1','1566466366');

/*Table structure for table `xm_course` */

DROP TABLE IF EXISTS `xm_course`;

CREATE TABLE `xm_course` (
  `course_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '菜品ID',
  `course_name` varchar(100) DEFAULT NULL COMMENT '菜品名称',
  `type_id` int(11) DEFAULT NULL COMMENT '菜品类别',
  `course_content` varchar(1000) DEFAULT NULL COMMENT '流程/烹调方法',
  `course_img` varchar(150) DEFAULT NULL COMMENT '图片',
  `course_thumbimg` varchar(150) DEFAULT NULL COMMENT '缩略图',
  `course_video` varchar(200) DEFAULT NULL COMMENT '菜品视频',
  `user_id` int(11) DEFAULT NULL COMMENT '用户ID',
  `user_name` varchar(50) DEFAULT NULL COMMENT '用户姓名',
  `usertype_id` int(11) DEFAULT NULL COMMENT '用户类别ID',
  `course_trait` varchar(300) DEFAULT NULL COMMENT '成品特点',
  `course_color` varchar(100) DEFAULT NULL COMMENT '色泽',
  `course_aroma` varchar(100) DEFAULT NULL COMMENT '香气',
  `course_taste` varchar(100) DEFAULT NULL COMMENT '味道',
  `course_shap` varchar(100) DEFAULT NULL COMMENT '形状',
  `course_texture` varchar(100) DEFAULT NULL COMMENT '质地',
  `course_people` varchar(100) DEFAULT NULL COMMENT '人群',
  `course_peoplenum` int(11) DEFAULT NULL COMMENT '人数',
  `course_effect` varchar(100) DEFAULT NULL COMMENT '菜品功效',
  `course_score` int(11) DEFAULT NULL COMMENT '评定1-5星',
  `course_ischarge` enum('1','2') DEFAULT '1' COMMENT '是否免费',
  `course_standard` varchar(3) DEFAULT NULL COMMENT '收费标准',
  `course_isoff` enum('1','2') DEFAULT '2' COMMENT '是否下架：1不下架，2下架',
  `course_flag` enum('1','2') DEFAULT NULL COMMENT '1:吃动平衡；2:名师制作',
  `balance_flag` enum('1','2') DEFAULT '1' COMMENT '吃动平衡标识：1菜品，2运动；',
  `create_time` varchar(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

/*Data for the table `xm_course` */

insert  into `xm_course`(`course_id`,`course_name`,`type_id`,`course_content`,`course_img`,`course_thumbimg`,`course_video`,`user_id`,`user_name`,`usertype_id`,`course_trait`,`course_color`,`course_aroma`,`course_taste`,`course_shap`,`course_texture`,`course_people`,`course_peoplenum`,`course_effect`,`course_score`,`course_ischarge`,`course_standard`,`course_isoff`,`course_flag`,`balance_flag`,`create_time`) values (3,'西红柿炒鸡蛋',3,'U岁闺女好个','/public/static/uploads/Ms_img/20190808/176c81d09013c91da3d3d02304d468df.jpg','/public/static/uploads/Ms_img/20190808/176c81d09013c91da3d3d02304d468dfthumb.jpg','http://pwmcv4411.bkt.clouddn.com/15665264661eab0ad5253ed5bb5945fefbee854c45.mp4',3,'欧文',3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2','7','1','2','1','1565235937'),(5,'木须肉',4,'上世纪福建省不对劲客服部圣诞节吧不舍得剪安保费','/public/static/uploads/Ms_img/20190808/0df7f17fc1c562332cf2e3948856bfd5.jpg','/public/static/uploads/Ms_img/20190808/0df7f17fc1c562332cf2e3948856bfd5thumb.jpg',NULL,3,'欧文',3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2','10','2','2','1','1565249750'),(6,'宫保鸡丁',5,'<p>看手机的课件大赛开发技术开发技术领导就你丝黛芬妮考试答卷<img src=\"/xm/public/static/uploads/Ms_img/20190809/de36d46d43e70cac963f3b1c83ebbe98.jpg\" alt=\"undefined\"></p><p>就是导航男方就是圣诞节发货单数据返回考试答卷返回数据付首付绝对是副科级时代峻峰空间时<img src=\"/xm/public/static/uploads/Ms_img/20190809/783ef136e4cc38ea93fe93061b2f6898.jpg\" alt=\"undefined\"></p>','/public/static/uploads/Ms_img/20190809/8b37ff4568302b7521b3da1b14d62e99.jpg','/public/static/uploads/Ms_img/20190809/8b37ff4568302b7521b3da1b14d62e99thumb.jpg',NULL,3,'欧文',3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2','4','1','2','1','1565314601'),(7,'牛油果培根',4,'时代峰峻搜地方将','/public/static/uploads/admin/20190822/e54a96e1f80c39fd94740633042c8d94.jpg','/public/static/uploads/admin/20190822/e54a96e1f80c39fd94740633042c8d94thumb.jpg','http://pwmcv4411.bkt.clouddn.com/3e7314ffdff887dea4211e54beb08168.mp4',0,'石启生',4,'测试','测试','测试','测试','测试','测试','测试',1,'水电费第三方',1,'1','','1','2','1','1566458017'),(8,'牛油果沙拉',1,'UI是覅互动四ufhds','/public/static/uploads/admin/20190822/903dde5b1f8f761ce8126d05234bdc8e.JPG','/public/static/uploads/admin/20190822/903dde5b1f8f761ce8126d05234bdc8ethumb.JPG','http://pwmcv4411.bkt.clouddn.com/15664630240ba8e582c509ba5612d40644eb337812.mp4',0,'王启胜',3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1','','1','1','1','1566458448'),(9,'拉伸',1,'刷黄飞鸿数据返回','/public/static/uploads/admin/20190823/b9b0a1af5ef2589f665afbf52ba9239e.jpg','/public/static/uploads/admin/20190823/b9b0a1af5ef2589f665afbf52ba9239ethumb.jpg','http://pwmcv4411.bkt.clouddn.com/15665421141eab0ad5253ed5bb5945fefbee854c45.mp4',0,'张继生',3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2','10','2','1','2','1566542123'),(10,'木须肉',3,'速度符和宽度首付款就是导航会计法','/public/static/uploads/admin/20190826/2ca59eddce9d3d1522742b6b62f1997b.jpg','/public/static/uploads/admin/20190826/2ca59eddce9d3d1522742b6b62f1997bthumb.jpg','http://pwmcv4411.bkt.clouddn.com/15667901491eab0ad5253ed5bb5945fefbee854c45.mp4',NULL,'张继生',3,'测试','测试','测试','测试','测试','测试','测试',1,'is多跟峰哥定界符低功耗加工费酒店好贵',2,'1','','2','2','1','1566790152'),(11,'辣椒炒肉',3,'睡觉打呼副科级当升科技复合大师讲课费','/public/static/uploads/admin/20190826/1ebb20774ae25c975cef4a71d43b8510.jpg','/public/static/uploads/admin/20190826/1ebb20774ae25c975cef4a71d43b8510thumb.jpg','http://pwmcv4411.bkt.clouddn.com/1566791592002adb188da33fb609a802d85b6f6499.mp4',NULL,'齐胜科',3,'测试','测试','测试','测试','测试','测试','测试',2,'我我电话费就可获得会计法',2,'2','2','2','2','1','1566791619'),(12,'酸菜鱼',3,'is佛我京东IG哈代发货更健康&nbsp;','/public/static/uploads/admin/20190826/5e20115e014150cf4689264568ae1c6c.jpg','/public/static/uploads/admin/20190826/5e20115e014150cf4689264568ae1c6cthumb.jpg','http://pwmcv4411.bkt.clouddn.com/15667917871eab0ad5253ed5bb5945fefbee854c45.mp4',NULL,'石启生',3,'测试','测试','测试','测试','测试','测试','测试',1,'我讲道理房管局雷锋精神的分类估计是浪蝶狂蜂',4,'1','','2','2','1','1566791803'),(13,'麻婆豆腐',3,'塑料袋哈方括号sad看风景','/public/static/uploads/admin/20190826/0420758310bf41757130d485bd10477e.JPG','/public/static/uploads/admin/20190826/0420758310bf41757130d485bd10477ethumb.JPG','http://pwmcv4411.bkt.clouddn.com/15667997061eab0ad5253ed5bb5945fefbee854c45.mp4',NULL,'王启胜',3,'测试','测试','测试','测试','测试','测试','测试',1,'四U盾回复是贷款粉红色的客户',4,'1','','2','2','1','1566799719'),(14,'蒜蓉西蓝花',1,'类似的会放宽华东师范会计核算多考虑','/public/static/uploads/admin/20190826/5a51e80a40c24c6d0bffb6a9fabda65e.JPG','/public/static/uploads/admin/20190826/5a51e80a40c24c6d0bffb6a9fabda65ethumb.JPG','http://pwmcv4411.bkt.clouddn.com/15668052021ae3f400ca4fa24e6ad1e06c11b5bd02.mp4',NULL,'王启胜',3,'','','','','','','',0,'速度合法化的说法客家话',0,'1','','2','1','1','1566805218'),(15,'塑性健身餐',1,'偶数的很腹黑上岛咖啡海带丝','/public/static/uploads/admin/20190826/748804df2043c4974c597ec0ecc74778.jpg','/public/static/uploads/admin/20190826/748804df2043c4974c597ec0ecc74778thumb.jpg','http://pwmcv4411.bkt.clouddn.com/15668058181ae3f400ca4fa24e6ad1e06c11b5bd02.mp4',NULL,'张继生',3,'测试','测试','测试','测试','测试','测试','测试',3,'士大夫撒旦',2,'1','','2','1','1','1566805824'),(16,'牛油果培根',1,'施蒂利克富家大室两级分类考试答卷翻看了','/public/static/uploads/admin/20190826/66d3f8e19fd643516e1cf9476b438252.jpg','/public/static/uploads/admin/20190826/66d3f8e19fd643516e1cf9476b438252thumb.jpg','http://pwmcv4411.bkt.clouddn.com/15668059251eab0ad5253ed5bb5945fefbee854c45.mp4',NULL,'石启生',3,'测试','测试','测试','测试','测试','测试','测试',1,'水电费客户手动夸奖粉红色款绝代风华',2,'1','','2','1','1','1566805944'),(17,'健身餐',1,'；肯定是解放路的时间里开发','/public/static/uploads/admin/20190826/c8e586fc3ddc774b88a5922244c7a174.png','/public/static/uploads/admin/20190826/c8e586fc3ddc774b88a5922244c7a174thumb.png','http://pwmcv4411.bkt.clouddn.com/15668063511eab0ad5253ed5bb5945fefbee854c45.mp4',NULL,'张继生',3,'测试哈','测试4','测试2','测试4','测试位','测试而发','测试是打发',4,'搜的就风刀霜剑佛你定界符',3,'1','','1','1','1','1566806362'),(18,'韭菜鸡蛋炒烧饼',3,'第三方吉林省的空间了开始家都烧了','/public/static/uploads/admin/20190828/4adbb3a7066b1c1a887c2a08c1f6cc01.jpg','/public/static/uploads/admin/20190828/4adbb3a7066b1c1a887c2a08c1f6cc01thumb.jpg','http://pwmcv4411.bkt.clouddn.com/1566975649002adb188da33fb609a802d85b6f6499.mp4',3,'欧文',6,'测试','测试','测试','测试','测试','测试','测试',1,'骷髅精灵看见了看见了',2,'1','','2','2','1','1566975659'),(19,'跑步',1,'第四节佛ID使肌肤教师端','/public/static/uploads/admin/20190828/4df9f5e91eeeed8fede1a5edd0856f94.jpg','/public/static/uploads/admin/20190828/4df9f5e91eeeed8fede1a5edd0856f94thumb.jpg','http://pwmcv4411.bkt.clouddn.com/1566976139002adb188da33fb609a802d85b6f6499.mp4',4,'方世玉',3,'','','','','','','',0,'',0,'1','','2','1','2','1566976144');

/*Table structure for table `xm_dosag` */

DROP TABLE IF EXISTS `xm_dosag`;

CREATE TABLE `xm_dosag` (
  `dosag_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) DEFAULT NULL,
  `dosag_name` varchar(100) DEFAULT NULL,
  `dosag_num` int(10) DEFAULT NULL,
  `dosag_flag` enum('1','2','3') DEFAULT NULL,
  `create_time` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`dosag_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

/*Data for the table `xm_dosag` */

insert  into `xm_dosag`(`dosag_id`,`course_id`,`dosag_name`,`dosag_num`,`dosag_flag`,`create_time`) values (2,1,'牛油果24',100,NULL,'1565344056'),(3,1,'沙拉酱',50,NULL,'1565344092'),(4,1,'生菜',10,NULL,'1565597148'),(5,1,'花生',12,NULL,'1565597298'),(12,6,'胡萝卜',200,NULL,'1565598924'),(13,6,'鸡肉',100,NULL,'1565598936'),(14,5,'木耳',10,NULL,'1565834490'),(15,5,'鸡蛋',100,NULL,'1565834496'),(16,3,'西红柿',50,NULL,'1566526504'),(17,3,'鸡蛋',10,NULL,'1566526518');

/*Table structure for table `xm_food` */

DROP TABLE IF EXISTS `xm_food`;

CREATE TABLE `xm_food` (
  `food_id` int(11) NOT NULL AUTO_INCREMENT,
  `recipes_id` int(11) DEFAULT NULL,
  `recipes_food` varchar(100) DEFAULT NULL,
  `recipes_food_num` int(11) DEFAULT NULL,
  PRIMARY KEY (`food_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

/*Data for the table `xm_food` */

insert  into `xm_food`(`food_id`,`recipes_id`,`recipes_food`,`recipes_food_num`) values (2,1,'燕麦',160),(6,1,'蒜蓉西兰花3',200),(7,1,'西红柿',50),(8,19,'蒜蓉西蓝花',100),(9,19,'鱼香茄子',100),(11,1,'测试菜品',1),(12,1,'菜品',2),(13,20,'手撕包菜',500),(14,22,'蒜蓉西兰花3',10),(15,22,'测试菜品',10);

/*Table structure for table `xm_fruits` */

DROP TABLE IF EXISTS `xm_fruits`;

CREATE TABLE `xm_fruits` (
  `fruit_id` int(11) NOT NULL AUTO_INCREMENT,
  `recipes_id` int(11) DEFAULT NULL,
  `recipes_fruits` varchar(100) DEFAULT NULL,
  `recipes_fruits_num` int(11) DEFAULT NULL,
  PRIMARY KEY (`fruit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

/*Data for the table `xm_fruits` */

insert  into `xm_fruits`(`fruit_id`,`recipes_id`,`recipes_fruits`,`recipes_fruits_num`) values (3,1,'苹果3',10),(31,1,'桃子',10),(32,19,'苹果',99),(35,1,'测试水果2',2),(36,1,'测试水果3',3),(37,19,'香蕉',20),(40,1,'测试水果4',20),(41,20,'甜瓜',100),(45,20,'葡萄',10),(46,22,'苹果',100),(48,22,'香蕉',1);

/*Table structure for table `xm_fytype` */

DROP TABLE IF EXISTS `xm_fytype`;

CREATE TABLE `xm_fytype` (
  `fytype_id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL,
  `fytype_name` varchar(50) DEFAULT NULL,
  `fytype_img` varchar(200) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `create_time` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`fytype_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `xm_fytype` */

insert  into `xm_fytype`(`fytype_id`,`pid`,`fytype_name`,`fytype_img`,`sort`,`level`,`create_time`) values (1,0,'孕产妇2','/public/static/uploads/Fytype_img/20190816/b8710a45e7166f0650a751762200cb35.jpg',1000000,1,'1564738143'),(2,0,'婴幼儿',NULL,2000000,1,'1564738452'),(3,1,'哺乳期',NULL,1001000,2,'1564738536'),(4,3,'早餐',NULL,1001001,3,'1564738755'),(5,3,'中餐',NULL,1001002,3,'1565839100'),(6,1,'孕早期','/public/static/uploads/Fytype_img/20190816/e9d3ba1a8e1ffd5563ae9ebfd58ed29c.jpg',1002000,2,'1565927969'),(7,2,'配方奶粉','/public/static/uploads/admin/20190823/dc67d51b227525e321ac5aedd641c601.JPG',2001000,2,'1566529800'),(8,7,'0岁-12个月','/public/static/uploads/admin/20190823/1d7edbbea3c32d8f47d8af47f5b21b32.jpg',2001001,3,'1566529843'),(9,0,'人群',NULL,1020000,1,'1566540824');

/*Table structure for table `xm_ingredients` */

DROP TABLE IF EXISTS `xm_ingredients`;

CREATE TABLE `xm_ingredients` (
  `ingredients_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '食材ID',
  `ingredients_name` varchar(50) DEFAULT NULL COMMENT '食材名称',
  `sctype_id` int(11) DEFAULT NULL COMMENT '食材类别',
  `ingredients_content` varchar(1000) DEFAULT NULL COMMENT '食材图文简介',
  `ingredients_img` varchar(150) DEFAULT NULL COMMENT '食材图',
  `ingredients_thumbimg` varchar(150) DEFAULT NULL COMMENT '食材缩略图',
  `ingredients_place` varchar(100) DEFAULT NULL COMMENT '食材产地',
  `ingredients_chang` varchar(100) DEFAULT NULL COMMENT '厂家',
  `ingredients_season` varchar(100) DEFAULT NULL COMMENT '时令季节',
  `ingredients_flag` set('1','2','3','4') DEFAULT NULL COMMENT '食材标识：1绿色，2有机，3无公害，4国家地理标识',
  `create_time` varchar(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`ingredients_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `xm_ingredients` */

insert  into `xm_ingredients`(`ingredients_id`,`ingredients_name`,`sctype_id`,`ingredients_content`,`ingredients_img`,`ingredients_thumbimg`,`ingredients_place`,`ingredients_chang`,`ingredients_season`,`ingredients_flag`,`create_time`) values (1,'圆叶芹菜',10,'；时代峻峰了快结束了的开发模式的类库南方','/public/static/uploads/admin/20190823/a1521e8800dcb06a569e2b092de4c9de.JPG','/public/static/uploads/admin/20190823/a1521e8800dcb06a569e2b092de4c9dethumb.JPG','石家庄5','加价','冬季','1,2,3','1564645442'),(2,'尖叶菠菜',9,'沙发撒发顺丰<img src=\"/xm/public/static/uploads/sc_img/20190801/f2af35c1703834fd0b16fc541dd8587a.jpg\" alt=\"undefined\">','/public/static/uploads/sc_img/20190801/de474aaac478853974a06399218cad2b.jpg','/public/static/uploads/sc_img/20190801/de474aaac478853974a06399218cad2bthumb.jpg','石家庄',NULL,'夏季',NULL,'1564646728'),(4,'圆叶菠菜3',8,'；时代峻峰了快结束了的开发模式的类库南方石佛寺京东方<img src=\"/xm/public/static/uploads/sc_img/20190801/7729a93f479ed9bdfb059575a73f8c37.jpg\" alt=\"undefined\">','/public/static/uploads/sc_img/20190801/afe8daa3dfc3b38689e483768b8643e8.jpg','/public/static/uploads/sc_img/20190801/afe8daa3dfc3b38689e483768b8643e8thumb.jpg','天津','江苏省','冬季','1,2','1564650915'),(5,'新土豆',26,'搜狐覅哈开发和是框架的划分<img src=\"/xm/public/static/uploads/admin/20190822/3a2156c9c545b76a488831fc08be2844.jpg\" alt=\"undefined\">','/public/static/uploads/admin/20190822/2dc3a246c457be104d936d8299e7aaf0.jpg','/public/static/uploads/admin/20190822/2dc3a246c457be104d936d8299e7aaf0thumb.jpg','石家庄',NULL,'夏季',NULL,'1566439778'),(6,'新土豆',26,'是噶分肯定是咖啡机手动夸奖返回的上课就发货谁看得见','/public/static/uploads/admin/20190823/6433cf08f6aaf307860bc63b61760af6.JPG','/public/static/uploads/admin/20190823/6433cf08f6aaf307860bc63b61760af6thumb.JPG','北京',NULL,'春天',NULL,'1566523932');

/*Table structure for table `xm_main` */

DROP TABLE IF EXISTS `xm_main`;

CREATE TABLE `xm_main` (
  `main_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) DEFAULT NULL,
  `main_name` varchar(100) DEFAULT NULL,
  `main_num` int(11) DEFAULT NULL,
  `create_time` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`main_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `xm_main` */

insert  into `xm_main`(`main_id`,`course_id`,`main_name`,`main_num`,`create_time`) values (1,12,'酸菜',100,NULL),(2,12,'鱼肉',100,NULL),(3,12,'酸菜',100,NULL),(4,12,'鱼肉',100,NULL),(5,13,'豆腐',300,'1566799754'),(6,0,'豆腐',300,'1566802643'),(7,13,'测试',3,'1566802836'),(8,11,'辣椒一号',10,'1566803474'),(9,11,'五花肉片',10,'1566803474'),(10,17,'健身主料',10,'1566806400'),(11,17,'健身主料2',4,'1566806400'),(12,17,'主料3',20,'1566809258'),(13,15,'塑性',100,'1566809658'),(14,18,'韭菜',200,'1566975708'),(15,18,'鸡蛋',50,'1566975708'),(16,18,'烧饼',100,'1566975708');

/*Table structure for table `xm_mstype` */

DROP TABLE IF EXISTS `xm_mstype`;

CREATE TABLE `xm_mstype` (
  `mstype_id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL,
  `mstype_name` varchar(100) DEFAULT NULL,
  `mstype_img` varchar(200) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `create_time` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`mstype_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `xm_mstype` */

insert  into `xm_mstype`(`mstype_id`,`pid`,`mstype_name`,`mstype_img`,`sort`,`level`,`create_time`) values (1,0,'中餐','/public/static/uploads/Mstype_img/20190816/15c12ff439f52c511b9c70b5143d0716.jpg',10000,1,'1565144714'),(2,0,'西餐',NULL,20000,1,'1565144722'),(3,1,'热菜','/public/static/uploads/Mstype_img/20190816/463119278897fca224068c1803113bb3.jpg',10001,2,'1565145753'),(4,2,'热菜',NULL,20001,2,'1565145981'),(5,1,'凉菜',NULL,10002,2,'1565145990'),(6,1,'创意菜','/public/static/uploads/Mstype_img/20190816/cc974b070bf31bc84ab78910c5550373.jpg',10003,2,'1565936175'),(7,0,'其他',NULL,30000,1,'1566541190');

/*Table structure for table `xm_nuts` */

DROP TABLE IF EXISTS `xm_nuts`;

CREATE TABLE `xm_nuts` (
  `nuts_id` int(11) NOT NULL AUTO_INCREMENT,
  `recipes_id` int(11) DEFAULT NULL,
  `recipes_nuts` varchar(100) DEFAULT NULL,
  `recipes_nuts_num` int(11) DEFAULT NULL,
  PRIMARY KEY (`nuts_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `xm_nuts` */

insert  into `xm_nuts`(`nuts_id`,`recipes_id`,`recipes_nuts`,`recipes_nuts_num`) values (3,1,'黑芝麻',1),(5,1,'黑芝麻',10),(6,1,'巴旦木',10),(7,19,'黑芝麻',10),(9,1,'测试坚果',1),(10,20,'黑芝麻',10),(11,19,'核桃',10),(12,22,'黑芝麻2',10);

/*Table structure for table `xm_order` */

DROP TABLE IF EXISTS `xm_order`;

CREATE TABLE `xm_order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_status` enum('1','2') DEFAULT NULL COMMENT '1待支付，2支付成功，3支付失败',
  `order_flag` enum('1','2','3','4','5','6') DEFAULT NULL COMMENT '1名师，2吃动，3烹调，4妇幼，5食材，6营养',
  `create_time` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `xm_order` */

insert  into `xm_order`(`order_id`,`type_id`,`user_id`,`order_status`,`order_flag`,`create_time`) values (3,1,1,'1','4',NULL);

/*Table structure for table `xm_pttype` */

DROP TABLE IF EXISTS `xm_pttype`;

CREATE TABLE `xm_pttype` (
  `pttype_id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL,
  `pttype_name` varchar(100) DEFAULT NULL,
  `pttype_img` varchar(200) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `create_time` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`pttype_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `xm_pttype` */

insert  into `xm_pttype`(`pttype_id`,`pid`,`pttype_name`,`pttype_img`,`sort`,`level`,`create_time`) values (1,0,'中餐','/public/static/uploads/Pttype_img/20190816/b3e8eaf43dd7df68c3e0605fbb15f7bb.jpg',10000,1,'1564707706'),(2,0,'西餐',NULL,20000,1,'1564707772'),(6,1,'烹调基本功','/public/static/uploads/Pttype_img/20190816/f15583263ac1290356f3fad581c0ec9f.jpg',10001,2,'1564708740'),(7,1,'热菜啊',NULL,10002,2,'1564708757'),(8,2,'烹调基本功',NULL,20001,2,'1564708773'),(9,2,'凉菜',NULL,20002,2,'1564708785'),(10,1,'创意菜','/public/static/uploads/Pttype_img/20190816/e109779f2a098b785af1de13a5299203.jpg',10003,2,'1565927403'),(11,0,'其他',NULL,30000,1,'1566541113');

/*Table structure for table `xm_recipes` */

DROP TABLE IF EXISTS `xm_recipes`;

CREATE TABLE `xm_recipes` (
  `recipes_id` int(11) NOT NULL AUTO_INCREMENT,
  `recipes_name` varchar(50) DEFAULT NULL,
  `recipes_img` varchar(200) DEFAULT NULL,
  `recipes_thumbimg` varchar(200) DEFAULT NULL,
  `recipes_content` varchar(1000) DEFAULT NULL,
  `fytype_id` int(11) DEFAULT NULL,
  `recipes_isoff` enum('1','2') DEFAULT '1',
  `create_time` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`recipes_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

/*Data for the table `xm_recipes` */

insert  into `xm_recipes`(`recipes_id`,`recipes_name`,`recipes_img`,`recipes_thumbimg`,`recipes_content`,`fytype_id`,`recipes_isoff`,`create_time`) values (1,'哺乳期早餐食谱3','/public/static/uploads/Fy_img/20190821/2ec142c0ba8240d18964dd8b8ae9c2e8.jpg','/public/static/uploads/Fy_img/20190821/2ec142c0ba8240d18964dd8b8ae9c2e8thumb.jpg',NULL,4,'2','1565833482'),(19,'哺乳期午餐食谱','/public/static/uploads/admin/20190822/2bc8717348d3b9daab2c2ddcbdd1ea6c.jpg','/public/static/uploads/admin/20190822/2bc8717348d3b9daab2c2ddcbdd1ea6cthumb.jpg',NULL,5,'1','1566176207'),(20,'哺乳期早餐食谱4','/public/static/uploads/admin/20190822/3119903a426b71b83cb24dc0513ec89e.JPG','/public/static/uploads/admin/20190822/3119903a426b71b83cb24dc0513ec89ethumb.JPG',NULL,4,'1','1566196302'),(21,'哺乳期无参食谱','/public/static/uploads/Fy_img/20190821/110b39ea5b5f674dbb36f7f2a3ce9dad.jpg','/public/static/uploads/Fy_img/20190821/110b39ea5b5f674dbb36f7f2a3ce9dadthumb.jpg',NULL,5,'1','1566380508'),(22,'哺乳期早餐食谱6','/public/static/uploads/admin/20190823/1f1bfad05d38fbe1b94ced6eaa531b0a.jpg','/public/static/uploads/admin/20190823/1f1bfad05d38fbe1b94ced6eaa531b0athumb.jpg',NULL,4,'1','1566525257'),(23,'1月份','/public/static/uploads/admin/20190823/23249c914d6c0211587ac8a7661013d4.jpg','/public/static/uploads/admin/20190823/23249c914d6c0211587ac8a7661013d4thumb.jpg',NULL,4,'1','1566526129'),(24,'惠氏','/public/static/uploads/admin/20190823/ebb1041e63d514423aa2695c265fefbb.jpg','/public/static/uploads/admin/20190823/ebb1041e63d514423aa2695c265fefbbthumb.jpg',NULL,8,'1','1566529886'),(25,'测试','/public/static/uploads/admin/20190823/422e85339d35bf470523c751a5d8bbf2.jpg','/public/static/uploads/admin/20190823/422e85339d35bf470523c751a5d8bbf2thumb.jpg','收代理费讲课的使肌肤卡都很少金卡戴珊不积跬步的身份科技改变的上课<img src=\"/xm/public/static/uploads/admin/20190823/89d1d544268bc5f46cc3e3af914b229b.jpg\" alt=\"undefined\"><img src=\"/xm/public/static/uploads/admin/20190823/fab53705141ff0d0a1326a9222673807.JPG\" alt=\"undefined\">',4,'1','1566540393');

/*Table structure for table `xm_scroll` */

DROP TABLE IF EXISTS `xm_scroll`;

CREATE TABLE `xm_scroll` (
  `scroll_id` int(11) NOT NULL AUTO_INCREMENT,
  `scroll_name` varchar(100) DEFAULT NULL,
  `scroll_img` varchar(200) DEFAULT NULL,
  `scroll_thumbimg` varchar(200) DEFAULT NULL,
  `create_time` varchar(11) DEFAULT NULL,
  `scroll_isoff` enum('1','2') DEFAULT '1' COMMENT '是否显示1显示，2不显示',
  PRIMARY KEY (`scroll_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `xm_scroll` */

insert  into `xm_scroll`(`scroll_id`,`scroll_name`,`scroll_img`,`scroll_thumbimg`,`create_time`,`scroll_isoff`) values (3,'首页轮播图','/public/static/uploads/admin/20190829/079fc1bf13790944245ffad844b9ca9e.jpg','/public/static/uploads/admin/20190829/079fc1bf13790944245ffad844b9ca9ethumb.jpg','1567044391','1');

/*Table structure for table `xm_sctype` */

DROP TABLE IF EXISTS `xm_sctype`;

CREATE TABLE `xm_sctype` (
  `sctype_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '分类ID',
  `pid` int(11) DEFAULT NULL COMMENT '上级分类',
  `sctype_name` varchar(50) DEFAULT NULL COMMENT '分类名称',
  `sctype_img` varchar(200) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL COMMENT '同深度排序',
  `create_time` varchar(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`sctype_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

/*Data for the table `xm_sctype` */

insert  into `xm_sctype`(`sctype_id`,`pid`,`sctype_name`,`sctype_img`,`sort`,`level`,`create_time`) values (1,0,'国内食材','/public/static/uploads/admin/20190823/9c7fb660989bcfcf1f8d2f99abcf1813.jpg',1000000,1,NULL),(2,0,'国外食材',NULL,2000000,1,NULL),(3,1,'蔬菜国内',NULL,1010000,2,NULL),(4,2,'每个','/public/static/uploads/admin/20190823/a3daf1d8b68094e64ac846dd9e4ed83c.jpg',2010000,2,NULL),(5,3,'茎菜类',NULL,1010100,3,NULL),(6,3,'根菜类',NULL,1010200,3,NULL),(7,3,'叶菜类',NULL,1010300,3,NULL),(8,7,'菠菜',NULL,1010301,4,NULL),(10,5,'芹菜',NULL,1010101,4,NULL),(11,1,'谷物',NULL,1020000,2,NULL),(12,1,'调料',NULL,1030000,2,'1564565848'),(13,12,'孜然粉',NULL,1030100,3,'1564565861'),(14,11,'大米',NULL,1020100,3,'1564619827'),(15,11,'小米',NULL,1020200,3,'1564620101'),(16,15,'锦州小米',NULL,1020201,4,'1564620418'),(17,4,'叶菜类',NULL,2010100,3,'1564622814'),(18,17,'小叶菠菜',NULL,2010101,4,'1564622829'),(19,1,'茶叶',NULL,1040000,2,'1565925050'),(20,19,'南查','/public/static/uploads/Sctype_img/20190816/2e1823e207c3829a8ae6ed29bc339bc1.jpg',1040100,3,'1565925440'),(21,1,'测试','/public/static/uploads/Sctype_img/20190821/4671851c53481401ccb5ac1f3b7fe70a.jpg',1050000,2,'1566354477'),(22,1,'测试2','/public/static/uploads/Sctype_img/20190821/dcbcc339ad21e52ff43a68b6aaa60fbb.jpg',1060000,2,'1566354492'),(23,1,'测试3','/public/static/uploads/Sctype_img/20190821/12f88556de3f0578aaf5763eee22676e.jpg',1070000,2,'1566354727'),(24,22,'测试22','/public/static/uploads/Sctype_img/20190821/6b6441401874e2a6e9674108b1be956a.jpg',1060100,3,'1566354789'),(25,1,'测试4','/public/static/uploads/Sctype_img/20190821/131f2d2f68a93e3a316c5cf4a4c60749.jpg',1080000,2,'1566354838'),(26,6,'土豆','/public/static/uploads/admin/20190822/d13dae3e2a0a815a1eafa25ac5cc7174.jpg',1010201,4,'1566439531'),(27,2,'谷物','/public/static/uploads/admin/20190823/8a530b241e866ae989f94b7035f0886f.jpg',2020000,2,'1566524021'),(28,27,'小米','/public/static/uploads/admin/20190823/e07e81964392c645e541e7d92467a210.JPEG',2020100,3,'1566524041'),(29,28,'沁州黄','/public/static/uploads/admin/20190823/9b640552ed71822c39ea8d9b36746130.jpg',2020101,4,'1566524068'),(30,0,'其他',NULL,3000000,1,'1566541163');

/*Table structure for table `xm_staple` */

DROP TABLE IF EXISTS `xm_staple`;

CREATE TABLE `xm_staple` (
  `staple_id` int(11) NOT NULL AUTO_INCREMENT,
  `recipes_id` int(11) DEFAULT NULL,
  `recipes_staple` varchar(100) DEFAULT NULL,
  `recipes_staple_num` int(11) DEFAULT NULL,
  PRIMARY KEY (`staple_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Data for the table `xm_staple` */

insert  into `xm_staple`(`staple_id`,`recipes_id`,`recipes_staple`,`recipes_staple_num`) values (1,1,'全麦面包',200),(3,1,'全麦面包2',2000),(5,1,'馒头',50),(6,1,'烧饼',50),(7,19,'全麦馒头',50),(8,19,'蔬菜饼',50),(10,1,'测试主食1',1),(11,1,'测试主食2',2),(12,20,'米饭',100),(13,22,'馒头',10);

/*Table structure for table `xm_user` */

DROP TABLE IF EXISTS `xm_user`;

CREATE TABLE `xm_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `user_nickname` varchar(50) DEFAULT NULL COMMENT '用户微信昵称',
  `user_phone` varchar(11) DEFAULT NULL COMMENT '用户绑定手机号',
  `user_name` varchar(50) DEFAULT NULL COMMENT '用户姓名',
  `usertype_id` int(11) DEFAULT '1' COMMENT '用户类别',
  `user_cardid` varchar(18) DEFAULT NULL COMMENT '用户身份证号',
  `user_cardpica` varchar(200) DEFAULT NULL COMMENT '用户身份证正面照',
  `user_cardpicb` varchar(200) DEFAULT NULL COMMENT '用户身份证反面照',
  `user_certificate` varchar(200) DEFAULT NULL COMMENT '资质证书图片',
  `user_pic` varchar(200) DEFAULT NULL COMMENT '用户个人形象照片',
  `user_address` varchar(100) DEFAULT NULL COMMENT '工作地址',
  `user_years` varchar(2) DEFAULT NULL COMMENT '工作年限',
  `user_audit` enum('1','2','3','4') DEFAULT '1' COMMENT '1无需审核，2待审核，3审核通过，4审核未通过',
  `create_time` varchar(11) DEFAULT 'time()' COMMENT '创建时间',
  `cdtype_id` int(11) DEFAULT NULL COMMENT '运动员的运动科目',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `xm_user` */

insert  into `xm_user`(`user_id`,`user_nickname`,`user_phone`,`user_name`,`usertype_id`,`user_cardid`,`user_cardpica`,`user_cardpicb`,`user_certificate`,`user_pic`,`user_address`,`user_years`,`user_audit`,`create_time`,`cdtype_id`) values (1,'小伟同学','13028698661','王伟',1,'131126199310161820','/public/static/uploads/user_img/20190729/6af1da69a552bb958d8a2c8a42cab32f.jpg','/public/static/uploads/user_img/20190729/75679e03d259fbcfa1db05a0f6db2f23.jpg','/public/static/uploads/user_img/20190729/6c8289b6c40461021bc9593a442e0a54.jpg','/public/static/uploads/user_img/20190729/1e3e9ffba65197bfbd88f101519ad220.jpg','河北省石家庄市','3','1','1564391041',NULL),(2,'襄阳','13323456789','李向阳',2,'131126188212112349','/public/static/uploads/user_img/20190806/b5e5cf5c10a24acdc4778e6f3f2d8477.jpg','/public/static/uploads/user_img/20190806/57909031a3537f7ad4883772e4ded636.jpg','/public/static/uploads/user_img/20190806/670b60c9eaa2a5ceab0602e1114d0e5c.jpg','/public/static/uploads/user_img/20190806/d3cc7626397e0c2687d448cd3e47a234.jpg','石家庄','2','4','1565074536',NULL),(3,'哈哈哈','13433145210','欧文',6,'132123188811234567','/public/static/uploads/user_img/20190808/57dd1f0e8b0ad4a345f8582633515898.jpg','/public/static/uploads/user_img/20190808/2b27bd5a9ed8f5e98a1ad9d89d7e5283.jpg','/public/static/uploads/user_img/20190808/99eb4e9f9857849705c1dbc368d7e63c.jpg','/public/static/uploads/user_img/20190808/77ae139e8510605e20808400cf4d0fe5.jpg','石家庄','3','4','1565248398',NULL),(4,'来日方长','13988776543','方世玉',2,'1303=13119986739','/public/static/uploads/admin/20190823/69c6845b46988b88f1e0a52b67599af7.JPG','/public/static/uploads/admin/20190823/38147cdf6e8e780cb01f695768d085fc.jpg','/public/static/uploads/admin/20190823/ab741faea353ee6de55e9dc682056664.jpg','/public/static/uploads/admin/20190823/7dc8c97fa3dcab91dc80dacb8cb92044.jpg','石家庄','1','1','1566522582',NULL),(5,'是什么','13423225678','张张张',2,'131125188881189267','/public/static/uploads/admin/20190829/fb6b9a64e5850d6cc8fb0da7efc76186.JPG','/public/static/uploads/admin/20190829/3d066d31c7bfda825265e64ea78eb7cb.jpg','/public/static/uploads/admin/20190829/077507c027c5512cda106c00d476f499.jpg','/public/static/uploads/admin/20190829/c24497c2d39e90d85ba61f8943f9963f.png','石家庄','1','1','1567039786',1),(6,'看电视剧弗兰克','13456789023','李丽丽',1,'134257199405201314','/public/static/uploads/admin/20190829/2d0d56fa6f8e1cc88b164e3c1d77933a.JPG','/public/static/uploads/admin/20190829/214e5819421d53d5623a6826b5ed7fc9.jpg','/public/static/uploads/admin/20190829/971d371e4def6534aef5677c531a9faf.png','/public/static/uploads/admin/20190829/c02aa4e0e60599471f63d8273ca3449d.jpg','北京','4','1','1567040266',0);

/*Table structure for table `xm_usertype` */

DROP TABLE IF EXISTS `xm_usertype`;

CREATE TABLE `xm_usertype` (
  `usertype_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户类别ID',
  `usertype_name` varchar(50) DEFAULT NULL COMMENT '用户类别名称',
  `create_time` varchar(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`usertype_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `xm_usertype` */

insert  into `xm_usertype`(`usertype_id`,`usertype_name`,`create_time`) values (1,'普通用户','1564383465'),(2,'运动员','1564383495'),(3,'名师','1565226343'),(4,'高工','1565230401'),(5,'技师','1565230408'),(6,'达人','1565230415');

/*Table structure for table `xm_yyarticle` */

DROP TABLE IF EXISTS `xm_yyarticle`;

CREATE TABLE `xm_yyarticle` (
  `yyarticle_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '营养知识文章ID',
  `yyarticle_title` varchar(100) DEFAULT NULL COMMENT '文章标题',
  `yyarticle_content` varchar(1000) DEFAULT NULL COMMENT '文章图文内容',
  `yyarticle_video` varchar(200) DEFAULT NULL COMMENT '文章视频',
  `yyarticle_img` varchar(200) DEFAULT NULL COMMENT '文章封面图',
  `yyarticle_thumbimg` varchar(200) DEFAULT NULL COMMENT '文章封面缩略图',
  `user_id` int(11) DEFAULT NULL COMMENT '用户ID',
  `user_name` varchar(50) DEFAULT NULL COMMENT '文章作者',
  `usertype_id` int(11) DEFAULT NULL COMMENT '用户类别',
  `yytype_id` int(11) DEFAULT NULL COMMENT '文章类别',
  `yyarticle_ischarge` enum('1','2') DEFAULT '1' COMMENT '1免费，2收费',
  `yyarticle_standard` varchar(3) DEFAULT NULL COMMENT '收费标准',
  `yyarticle_isoff` enum('1','2') DEFAULT '2' COMMENT '1不下架，2下架',
  `create_time` varchar(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`yyarticle_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `xm_yyarticle` */

insert  into `xm_yyarticle`(`yyarticle_id`,`yyarticle_title`,`yyarticle_content`,`yyarticle_video`,`yyarticle_img`,`yyarticle_thumbimg`,`user_id`,`user_name`,`usertype_id`,`yytype_id`,`yyarticle_ischarge`,`yyarticle_standard`,`yyarticle_isoff`,`create_time`) values (1,'每日一则','什么都没说，什么都没做收房产税DVD发<img src=\"/xm/public/static/uploads/yy_img/20190730/98a827a2b16b18a601c164809f79724b.jpg\" alt=\"undefined\">','http://pwmcv4411.bkt.clouddn.com/4ddf67d96e9e2d5932dfb1970ff82d18.mp4','/public/static/uploads/admin/20190828/c626149ee83ff1f56fddf7decffe37db.jpg','/public/static/uploads/admin/20190828/c626149ee83ff1f56fddf7decffe37dbthumb.jpg',NULL,'李汉成',NULL,1,'1','2','2','1564470058'),(2,'每日二则','<img src=\"/xm/public/static/uploads/yy_img/20190730/cfce8ff071b23c9c1a64dd64390dcd5b.jpg\" alt=\"undefined\">时代峰峻多斯拉克就能发考虑打算你看见纳斯达克家暴你肯定是不能福克斯DNF随你吧',NULL,'/public/static/uploads/yy_img/20190730/0ef6131a01e37d972d5cb30644613d67.jpg','/public/static/uploads/yy_img/20190730/0ef6131a01e37d972d5cb30644613d67thumb.jpg',NULL,'程以位2',NULL,3,'2','3','1','1564470284'),(3,'每日三则','<p>啥副科级哈萨克解放碑金卡司法部就恨不得司法局案件分别就把司法局</p><p style=\"text-align: center;\">就开始DNF会计核算看见对方</p><p style=\"text-align: center; \"><img src=\"/xm/public/static/uploads/yy_img/20190730/8e9b5566a84d9357531da8cc6d8b17e8.jpg\" alt=\"undefined\">删掉就好副科级撒谎开了房</p>',NULL,'/public/static/uploads/yy_img/20190730/3e9a8cdb05a92ce758fb57ed03cefbc4.jpg','/public/static/uploads/yy_img/20190730/3e9a8cdb05a92ce758fb57ed03cefbc4thumb.jpg',NULL,'杨涵',NULL,4,'1','','2','1564471436'),(5,'每周一则','撒旦法师法<img src=\"/xm/public/static/uploads/yy_img/20190730/33c2ae0a3b1a0fc56ff7acb2ad8de330.jpg\" alt=\"undefined\">',NULL,'/public/static/uploads/yy_img/20190730/d4f1f68c20f3c82b947a72d8bd5450ab.jpg','/public/static/uploads/yy_img/20190730/d4f1f68c20f3c82b947a72d8bd5450abthumb.jpg',NULL,'张洢豪',NULL,2,'2','4','1','1564471620'),(6,'每日三则3','按时覅哭啥手动夸奖发你<img src=\"/xm/public/static/uploads/admin/20190822/5c63fc89d235a005adf2dd9a9b2d9ed0.jpg\" alt=\"undefined\">','http://pwmcv4411.bkt.clouddn.com/15665244421eab0ad5253ed5bb5945fefbee854c45.mp4','/public/static/uploads/admin/20190823/c998061047b0a60a39e9bfe651f73390.jpg','/public/static/uploads/admin/20190823/c998061047b0a60a39e9bfe651f73390thumb.jpg',NULL,'张继生',NULL,3,'2','10','2','1566440061'),(7,'政策','莱克斯顿会放宽两集电视','http://pwmcv4411.bkt.clouddn.com/2a75d6826f63e45e49a50f2df9fdaafd.mp4','/public/static/uploads/admin/20190822/f9cec98c379ae3180abfa90117de1d37.jpg','/public/static/uploads/admin/20190822/f9cec98c379ae3180abfa90117de1d37thumb.jpg',NULL,'张继生',NULL,1,'1','','2','1566454672'),(8,'测试','肯定就付过款领导说家里开','http://pwmcv4411.bkt.clouddn.com/1566524721002adb188da33fb609a802d85b6f6499.mp4','/public/static/uploads/admin/20190823/435af9dac699eda48935c3d1162dbba0.JPG','/public/static/uploads/admin/20190823/435af9dac699eda48935c3d1162dbba0thumb.JPG',NULL,'石启生',NULL,3,'2','9','2','1566524753'),(9,'规划','老师就的划分课件上的河南开封江南时代会计法能看到健身房','http://pwmcv4411.bkt.clouddn.com/15669745001eab0ad5253ed5bb5945fefbee854c45.mp4','/public/static/uploads/admin/20190828/6eeb471f9ce7c85b44610c6a2a40ac09.JPG','/public/static/uploads/admin/20190828/6eeb471f9ce7c85b44610c6a2a40ac09thumb.JPG',1,'王伟',1,1,'2','5','2','1566974509'),(10,'星期三','了东风科技纳斯达克技能高考就非得','http://pwmcv4411.bkt.clouddn.com/15669748671eab0ad5253ed5bb5945fefbee854c45.mp4','/public/static/uploads/admin/20190828/d83e6ece98a164695ccfe9fbc026be1e.jpg','/public/static/uploads/admin/20190828/d83e6ece98a164695ccfe9fbc026be1ethumb.jpg',4,'方世玉',2,1,'1','','2','1566974874');

/*Table structure for table `xm_yytype` */

DROP TABLE IF EXISTS `xm_yytype`;

CREATE TABLE `xm_yytype` (
  `yytype_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '营养知识分类ID',
  `yytype_name` varchar(50) DEFAULT NULL COMMENT '分类名称',
  `create_time` varchar(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`yytype_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `xm_yytype` */

insert  into `xm_yytype`(`yytype_id`,`yytype_name`,`create_time`) values (1,'政策法规','1564451464'),(2,'国家标准','1564451498'),(3,'膳食指南','1564451513'),(4,'营养讲堂','1564451526');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
