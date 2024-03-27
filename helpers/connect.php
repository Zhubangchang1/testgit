<?php
/*
 * @Description: 数据库配置文件
 * @Version: 1.0
 * @Author: Humbert Cheung
 * @Date: 2021-10-19 09:08:39
 * @LastEditors: [Humbert Cheung]
 * @LastEditTime: 2021-11-01 14:06:56
 * @FilePath: /management-system-all/backend/server/common/connect.php
 * Copyright (C) 2021 syzhang. All rights reserved.
 */
// 数据库配置参数
$config = array(
  'dsn' => 'mysql:host=localhost;dbname=myplatform;port=3306;charset=utf8',
  'username' => 'root',
  'password' => '123456'
);

//  数据库连接属性
$option = array(
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // 默认是 ：PDO::ERRMODE_SILENT,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
);

// 连接数据库
try {
  $pdo = new PDO($config['dsn'], $config['username'], $config['password'], $option);
} catch (PDOException $e) {
  die('数据库连接失败' . $e->getMessage());
}