-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 01, 2021 at 10:55 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `myplatform`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(1) NOT NULL,
  `username` varchar(64) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `type` tinyint(1) DEFAULT NULL COMMENT '类型：1-超级管理员；2-普通管理员',
  `create_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `type`, `create_time`) VALUES
(1, 'admin', '111', NULL, NULL),
(2147483647, '剩下的表剩下的表', NULL, 127, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` mediumtext,
  `img` varchar(255) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL COMMENT '分类id',
  `user_id` int(11) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `img`, `type_id`, `user_id`, `create_time`) VALUES
(1, '欢迎平台成立', NULL, NULL, NULL, 1, '2020-11-11 14:46:00'),
(2, 'success', '<p>欢迎使用 <b>wangEditor</b> 富文本编辑器</p><p>kjkl&nbsp;</p><p><img src=\"./admin/uploads/1605575194校徽(1).png\" style=\"max-width:100%;\"><br></p>', '1605575179coin.png', 2, NULL, '2020-11-17 09:06:22'),
(3, '你好', '<p>hello</p>', 'user1.jpg', 1, NULL, '2020-11-12 14:46:00'),
(4, '你好111', '<p>hello</p>', 'user1.jpg', 2, NULL, '2020-11-13 14:46:00'),
(5, '大家好', '<p>hello</p>', 'user1.jpg', 1, NULL, '2020-11-14 14:46:00'),
(6, '我很好', '<p>hello</p>', 'user1.jpg', 1, NULL, '2020-11-15 14:46:00'),
(7, 'very好', '<p>hello</p>', 'user1.jpg', 1, NULL, '2020-11-16 14:46:00'),
(8, '欢迎平台成立', NULL, NULL, 3, 1, '2020-11-17 14:46:00'),
(9, '欢迎平台成立', NULL, NULL, 3, 1, '2020-11-11 14:46:00'),
(10, 'success', '<p>欢迎使用 <b>wangEditor</b> 富文本编辑器</p><p>kjkl&nbsp;</p><p><img src=\"./admin/uploads/1605575194校徽(1).png\" style=\"max-width:100%;\"><br></p>', '1605575179coin.png', 2, NULL, '2020-11-18 09:06:22'),
(11, '你好', '<p>hello</p>', 'user1.jpg', 1, NULL, '2020-11-19 14:46:00'),
(12, '你好111', '<p>hello</p>', 'user1.jpg', 2, NULL, '2020-11-11 14:46:00'),
(13, '大家好', '<p>hello</p>', 'user1.jpg', 1, NULL, '2020-11-11 14:46:00'),
(14, '我很好', '<p>hello</p>', 'user1.jpg', 1, NULL, '2020-11-11 14:46:00'),
(15, 'very好', '<p>hello</p>', 'user1.jpg', 1, NULL, '2020-11-11 14:46:00'),
(16, '地方', '<p>欢迎使用 <b>wangEditor</b> 富文本编辑器</p><p>范德萨<img src=\"./admin/uploads/1606190404兵哥学编程.jpg\" style=\"max-width: 100%;\"></p>', '1606190374android.jpg', 1, NULL, '2020-11-24 00:00:00'),
(17, '2', '<p>欢迎使用 <b>wangEditor</b> 富文本编辑器</p><p><img src=\"./admin/uploads/1606705241兵哥学编程.jpg\" style=\"max-width:100%;\"><br></p>', '20201215\\59880283a0cc8c58a7badda6f76c9bb7.png', 2, NULL, '2020-11-25 00:00:00'),
(18, '2', '<p>欢迎使用 <b>wangEditor</b> 富文本编辑器</p><p><img src=\"./admin/uploads/1606706987token讲解.png\" style=\"max-width:100%;\"><br></p><p><img src=\"http://localhost:80/phpworkspace/HRSystem/base/demo/teach/admin/uploads/1606707426安信工.jpg\" style=\"max-width:100%;\"><br></p>', '', 2, NULL, '2020-11-17 00:00:00'),
(19, '地方', '', '', 1, NULL, '2021-10-19 07:43:17'),
(20, '李白', '<p>PHP与Web页面交互<br/></p>', '', 1, NULL, '2021-10-19 07:43:43');

-- --------------------------------------------------------

--
-- Table structure for table `news_type`
--

CREATE TABLE `news_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `state` tinyint(3) UNSIGNED DEFAULT '1' COMMENT '状态：1-开通；2-关闭',
  `create_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news_type`
--

INSERT INTO `news_type` (`id`, `name`, `state`, `create_time`) VALUES
(1, '平台时讯', 1, 1605172258),
(2, '创业经验', 1, 1605172258),
(3, '优质加盟', 1, 1605172258),
(4, '团队协作', 1, 1605172258);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(64) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `name` varchar(64) DEFAULT NULL,
  `icon` varchar(64) DEFAULT NULL,
  `type` tinyint(3) DEFAULT NULL COMMENT '分类：1-普通员工；2-项目经理；3-项目组长',
  `age` smallint(3) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `name`, `icon`, `type`, `age`, `birthday`, `create_time`) VALUES
(3, 'worker', '111', '白伟', 'user3.jpg', 2, 30, '2020-10-26', 1634853466),
(5, NULL, NULL, '陆游', 'user5.jpeg', 3, 36, '1985-10-21', 1634850942),
(6, NULL, NULL, '郑明', 'user6.png', 3, 32, '1985-10-20', 1634773871),
(7, NULL, NULL, 'GAKKI', 'user7.png', 2, 36, '1989-10-10', 1634773195),
(8, NULL, NULL, '张伟', 'user8.jpg', 3, 36, NULL, 1609117198),
(10, NULL, NULL, 'Malody', 'mla2.jpg', 1, 25, '2020-12-15', 1634773832),
(11, NULL, NULL, '方宏', 'user11.png', 2, 32, '2020-12-15', 1634773803),
(13, NULL, NULL, 'k娘', 'kfc.png', 2, 24, '2021-10-14', 1634600417),
(15, NULL, NULL, '丽雅', 'oresama01.jpg', 1, 20, '1991-01-31', 1634805321),
(17, NULL, NULL, 'Juno', '', 1, 18, '2002-10-10', 1634852625),
(19, NULL, NULL, '李蕾', '', 1, 30, '2021-10-13', 1634775086),
(20, NULL, NULL, '朱莉', 'mla.jpg', 2, 20, '1990-10-18', 1634805269),
(21, NULL, NULL, '杨丽', 'IMG_7442.JPG', 1, 29, '2021-10-12', 1634853485),
(23, NULL, NULL, '凯瑞', 'SEKAI NO OWARI.jpeg', 2, 52, '1979-06-25', 1634853648);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_type`
--
ALTER TABLE `news_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483647;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `news_type`
--
ALTER TABLE `news_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
