-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- 主機: 127.0.0.1:3306
-- 產生時間： 
-- 伺服器版本: 5.7.24
-- PHP 版本： 7.0.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `baychaser`
--

-- --------------------------------------------------------

--
-- 資料表結構 `brand`
--

DROP TABLE IF EXISTS `brand`;
CREATE TABLE IF NOT EXISTS `brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `brand`
--

INSERT INTO `brand` (`id`, `name`) VALUES
(1, '三麗鷗'),
(2, 'Jack Wills'),
(3, 'Barbour'),
(4, 'Feedback'),
(5, 'Report a bug'),
(6, 'Feature request'),
(7, 'Nike'),
(8, 'Adidas '),
(9, 'HERMÈS');

-- --------------------------------------------------------

--
-- 資料表結構 `country`
--

DROP TABLE IF EXISTS `country`;
CREATE TABLE IF NOT EXISTS `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `country`
--

INSERT INTO `country` (`id`, `name`) VALUES
(1, '日本'),
(2, '印度'),
(3, '印尼'),
(4, '韓國'),
(5, '泰國'),
(6, '台灣'),
(7, '捷克'),
(8, '法國'),
(9, '德國'),
(10, '芬蘭'),
(11, '瑞典'),
(12, '英國'),
(13, '加拿大'),
(14, '美國');

-- --------------------------------------------------------

--
-- 資料表結構 `member`
--

DROP TABLE IF EXISTS `member`;
CREATE TABLE IF NOT EXISTS `member` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `member`
--

INSERT INTO `member` (`id`, `name`, `email`, `password`) VALUES
(1, 'test', 'test1@gmail.com', '1234'),
(2, 'test2', 'test2@gmail.com', '1234');

-- --------------------------------------------------------

--
-- 資料表結構 `order_record`
--

DROP TABLE IF EXISTS `order_record`;
CREATE TABLE IF NOT EXISTS `order_record` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `m_id` int(10) NOT NULL,
  `g_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `o_user` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `o_number` int(10) NOT NULL,
  `g_id` int(10) NOT NULL,
  `creat_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `order_record`
--

INSERT INTO `order_record` (`id`, `m_id`, `g_name`, `o_user`, `o_number`, `g_id`, `creat_time`) VALUES
(1, 1, 'Barbour jacket', '胖胖', 5, 3, '2019-09-18 11:33:31'),
(2, 1, 'SunnyLife 泳圈', '胖胖', 1, 2, '2019-09-18 11:34:25'),
(3, 1, 'Barbour jacket', '胖胖', 123, 3, '2019-09-18 11:37:03');

-- --------------------------------------------------------

--
-- 資料表結構 `pur_goods`
--

DROP TABLE IF EXISTS `pur_goods`;
CREATE TABLE IF NOT EXISTS `pur_goods` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `member_id` int(10) NOT NULL,
  `goods_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `goods_price` int(5) NOT NULL,
  `goods_img` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `goods_brand` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `goods_des` text COLLATE utf8_unicode_ci NOT NULL,
  `goods_lo` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `goods_color` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `goods_num` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `pur_goods`
--

INSERT INTO `pur_goods` (`id`, `member_id`, `goods_name`, `goods_price`, `goods_img`, `goods_brand`, `goods_des`, `goods_lo`, `goods_color`, `goods_num`) VALUES
(1, 1, '大學T', 500, '/static/index/upload/1/1.jpg', '三麗鷗', '[ Disney ] 超萌迪士尼三眼怪、火腿豬大學T～好姐妹一起穿！', '日本', '粉紅', 0),
(2, 1, 'SunnyLife 泳圈', 500, '/static/index/upload/1/2.jpg', '三麗鷗', '歐美火紅來自澳洲的 [SunnyLife 泳圈] 超大可愛紅鶴游泳圈~~ 你絕對不能不知道!!', '法國', '火紅', 1),
(3, 1, 'Barbour jacket', 500, '/static/index/upload/1/3.png', 'Barbour', '代購 英國 Barbour', '英國', '棕色', 2),
(4, 1, 'T-shirts', 500, '/static/index/upload/1/4.jpg', 'Jack Wills', '歐洲冬季折扣~英國 Jack wills 60%折扣！', '英國', '棕色', 0),
(9, 1, '測試', 500, '\\upload\\20190918\\2d0e0955190928544222ecbb70f739be.jpg', 'Jack Wills', '測試測試測試測試', '瑞典', '彩色', 0),
(8, 2, '兒通書籍', 100, '\\upload\\20190918\\440f39a0195f33c9f0eaa492eb2ce2df.jpg', 'Report a bug', '兒通書籍', '台灣', '彩色', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
