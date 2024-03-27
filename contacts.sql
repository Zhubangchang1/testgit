-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 17, 2021 at 02:08 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `contacts`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `pid` int(10) UNSIGNED NOT NULL COMMENT '联系人id',
  `name` varchar(255) NOT NULL COMMENT '联系人姓名',
  `motto` varchar(255) NOT NULL COMMENT '联系人座右铭',
  `src` varchar(255) DEFAULT NULL COMMENT '联系人头像',
  `sex` tinyint(1) NOT NULL COMMENT '联系人性别'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`pid`, `name`, `motto`, `src`, `sex`) VALUES
(1, '江哲', '须交有道之人，莫结无义之友。饮清静之茶，莫贪花色之酒。开方便之门，闲是非之口。', 'img/1.png', 1),
(2, '欧阳锋', '“我欲”是贫穷的标志。事能常足，心常惬，人到无求品自高。', 'img/2.png', 1),
(3, '江小白', '势不可使尽，福不可享尽，便宜不可占尽，聪明不可用尽。', 'img/3.png', 1),
(4, '程浩然', '做事不必与俗同，亦不宜与俗异。做事不必令人喜，亦不可令人憎。', 'img/4.png', 1),
(5, '李志成', '人之心胸，多欲则窄，寡欲则宽。', 'img/5.png', 1),
(6, '王嫣然', '人的一生也可以是那一杯香醇的酒，慢慢地享受，细细地品味，自然也可以韵出生命的味道。', 'img/6.png', 2),
(7, '程美', '大千世界，人生百态。如何面对人生，是快乐，是悲伤？不能让你的人生去决定，也不是任由命运摆布着你，应该自己把握！', 'img/7.png', 2),
(8, '李梅芳', '人的一生是由色彩交织而成的，有善良的白，沉静的蓝，热情的红，希望的绿和温柔的紫。它们散发出的光彩，则是我们的生命。！', 'img/8.png', 2),
(9, '南宫小婉', '生活就是一块调色板，你选择了你喜欢的色彩，那么其色就更加美丽，人生就似一碗汤，你选择了你喜欢的味道，你才感觉有滋有味……', 'img/9.png', 2),
(10, '江苏颖', '势不可使尽，福不可享尽，便宜不可占尽，聪明不可用尽。', 'img/10.png', 2),
(26, '小南', '千金散尽还复来', './img/2.png', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`pid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `pid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '联系人id', AUTO_INCREMENT=27;
