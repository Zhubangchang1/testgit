<?php
/*
 * @Description: 项目入口文件
 * @Version: 1.0
 * @Author: Humbert Cheung
 * @Date: 2021-11-15 09:47:23
 * @LastEditors: [Humbert Cheung]
 * @LastEditTime: 2021-11-17 20:58:34
 * @FilePath: /management-system/index.php
 * Copyright (C) 2021 syzhang. All rights reserved.
 */
require_once './helpers/setup.php';
require_once './helpers/DB.php';

// 实例化Smarty对象
$smarty = new MS_Smarty();
// 先禁用缓存
$smarty->disable_caching();

// 实例化pdo对象
$pdo = DB::getInstance()->connect();
// 浏览者 -> 向浏览器发送指令
// 获取控制器名称
$controller = empty($_REQUEST['controller']) ? 'Login' : $_REQUEST['controller'];
$method = empty($_REQUEST['method']) ? 'index' : $_REQUEST['method'];

// 引入控制器文件
eval("require_once './app/controller/{$controller}Controller.php';");
// 实例化对应的控制器
eval('$obj = new ' . $controller . 'Controller();');
// 让实例化出的对象去调用方法
// echo '$obj->' . $method . '();';
eval('$obj->' . $method . '();');