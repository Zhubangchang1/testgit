<?php
/*
 * @Description: 用户列表模块的控制器
 * @Version: 1.0
 * @Author: Humbert Cheung
 * @Date: 2021-11-15 10:30:26
 * @LastEditors: [Humbert Cheung]
 * @LastEditTime: 2021-11-16 11:39:00
 * @FilePath: /management-system/app/controller/UsersController.php
 * Copyright (C) 2021 syzhang. All rights reserved.
 */
require_once './app/model/UsersModel.php';

class UsersController {

  /**
   * @description: 用户列表方法
   * @param {*}
   * @return {*}
   * @Author: Humbert Cheung
   */
  public function userslist() {
    $this->isLogin();
    $usersModel = new UsersModel();
    $users = $usersModel->getUsers();
    global $smarty;
    $smarty->assign('data', $users);
    $smarty->display('userslist.html');
  }
  /**
   * @description: 登录拦截方法
   * @param {*}
   * @return {*}
   * @Author: Humbert Cheung
   */
  public function isLogin() {
    session_start();
    if (empty($_SESSION['username'])) {
      // 找不到session中的用户名，说明用户是没有登陆过，那么就需要弹窗提醒，并跳转到登录页面
      echo "<script>alert('请先登录！');location.href='./index.php'</script>";
    }
  }
  /**
   * @description: 跳转到添加用户界面
   * @param {*}
   * @return {*}
   * @Author: Humbert Cheung
   */
  public function add () {
    global $smarty;
    $smarty->display("useradd.html");
  }

  /**
   * @description: 添加用户处理方法
   * @param {*}
   * @return {*}
   * @Author: Humbert Cheung
   */
  public function addUser() {
    $usersModel = new UsersModel();
    $count = $usersModel->addUser();
    if($count > 0) {
      echo "<script>alert('添加成功！');location.href='index.php?controller=Users&method=userslist'</script>";
    } else {
      echo "<script>alert('添加失败！');location.href='index.php?controller=Users&method=add'</script>";
    }
  }
  /**
   * @description: 跳转到编辑用户页面
   * @param {*}
   * @return {*}
   * @Author: Humbert Cheung
   */
  public function edit () {
    // 获取被编辑的用户信息
    $usersModel = new UsersModel();
    $user = $usersModel->getEditingUser();
    global $smarty;
    $smarty->assign('user', $user);
    $smarty->display("useredit.html");
  }

  /**
   * @description: 编辑用户处理方法
   * @param {*}
   * @return {*}
   * @Author: Humbert Cheung
   */
  public function editUser(){
    $usersModel = new UsersModel();
    $count = $usersModel->editUser();
    if($count > 0) {
      echo "<script>alert('修改成功！');location.href='index.php?controller=Users&method=userslist'</script>";
    } else {
      echo "<script>alert('修改失败！');location.href='index.php?controller=Users&method=edit'</script>";
    }
  }

  public function delete () {
    $usersModel = new UsersModel();
    $count = $usersModel->deleteUser();
    echo $count;
    $msg = "删除失败！";
    if ($count > 0) {
      $msg = "删除成功！";
    }
    echo "<script>alert('$msg');location.href='index.php?controller=Users&method=userslist'</script>";
  }
}