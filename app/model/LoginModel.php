<?php
/*
 * @Description: 登录模型
 * @Version: 1.0
 * @Author: Humbert Cheung
 * @Date: 2021-11-16 08:43:44
 * @LastEditors: [Humbert Cheung]
 * @LastEditTime: 2021-11-16 08:47:56
 * @FilePath: /management-system/app/model/LoginModel.php
 * Copyright (C) 2021 syzhang. All rights reserved.
 */
class LoginModel
{
  /**
   * @description: 根据用户名查询用户
   * @param {*} $username 用户名
   * @return {*} 查询到的用户
   * @Author: Humbert Cheung
   */
  public function getUser($username)
  {
    global $pdo;
    // 准备sql语句
    $sqlStr = "SELECT * FROM admin WHERE username = '$username'";
    // 执行sql查询
    $stmt = $pdo->query($sqlStr);
    // 提取结果集中的所有记录
    $user = $stmt->fetch();
    // 返回数据
    return $user;
  }
}
