<?php
/*
 * @Description: 用户列表模型
 * @Version: 1.0
 * @Author: Humbert Cheung
 * @Date: 2021-11-16 09:57:16
 * @LastEditors: [Humbert Cheung]
 * @LastEditTime: 2021-11-16 11:32:41
 * @FilePath: /management-system/app/model/UsersModel.php
 * Copyright (C) 2021 syzhang. All rights reserved.
 */
class UsersModel
{
  /**
   * @description: 获取所有用户列表
   * @param {*}
   * @return {*} 所有用户的数组
   * @Author: Humbert Cheung
   */
  public function getUsers()
  {
    global $pdo;
    // 准备sql语句
    $sql = "SELECT * FROM user";

    // 执行sql查询
    $stmt = $pdo->query($sql);
    $users = $stmt->fetchAll();
    $data = [];
    foreach ($users as $u) {
      // 对类型进行转化
      switch ($u['type']) {
        case 1:
          $u['type_name'] = "普通员工";
          break;
        case 2:
          $u['type_name'] = "项目经理";
          break;
        case 3:
          $u['type_name'] = "项目组长";
          break;
        default:
          break;
      }
      $u['icon'] = $u['icon'] ? $u['icon'] : 'default.jpeg';
      $u['ctime'] = date('Y-m-d H:i', $u['create_time']);
      array_push($data, $u);
    }
    return $data;
  }

  /**
   * @description: 添加用户
   * @param {*}
   * @return {*} 添加的结果
   * @Author: Humbert Cheung
   */
  public function addUser()
  {
    global $pdo;
    $name = $_REQUEST['name'];
    $age = $_REQUEST['age'];
    $birthday = $_REQUEST['birthday'];
    $type = $_REQUEST['type'];
    $icon = $_REQUEST['icon'];
    $create_time = time();

    $sql = "INSERT INTO user(name, age, birthday, type, icon, create_time) VALUES('$name', $age, '$birthday', $type, '$icon', $create_time)";

    $count = $pdo->exec($sql);
    return $count;
  }
  /**
   * @description: 获取正在编辑的用户
   * @param {*}
   * @return {*} 用户
   * @Author: Humbert Cheung
   */
  public function getEditingUser()
  {
    global $pdo;
    $id = $_REQUEST["id"];
    $sql = "SELECT * FROM user WHERE id='$id'";
    $stmt = $pdo->query($sql);
    $user = $stmt->fetch();
    return $user;
  }

  /**
   * @description: 编辑用户处理方法
   * @param {*}
   * @return {*}
   * @Author: Humbert Cheung
   */
  public function editUser()
  {
    global $pdo;
    $id = $_REQUEST['id'];
    $name = $_REQUEST['name'];
    $age = $_REQUEST['age'];
    $birthday = $_REQUEST['birthday'];
    $type = $_REQUEST['type'];
    $icon = $_REQUEST['icon'];
    $create_time = time();
    $sql = "UPDATE user SET name='$name', age=$age, birthday='$birthday', type=$type, icon='$icon', create_time=$create_time WHERE id='$id'";
    $count = $pdo->exec($sql);
    return $count;
  }
  /**
   * @description: 删除用户处理方法
   * @param {*}
   * @return {*}
   * @Author: Humbert Cheung
   */
  public function deleteUser()
  {
    global $pdo;
    $id = $_REQUEST["id"];
    $sql = "DELETE FROM user WHERE id='$id'";
    $count = $pdo->exec($sql);
    return $count;
  }
}
