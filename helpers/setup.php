<?php

/*
 * @Description: Smarty 配置类
 * @Version: 1.0
 * @Author: Humbert Cheung
 * @Date: 2021-11-10 09:10:09
 * @LastEditors: [Humbert Cheung]
 * @LastEditTime: 2021-11-15 09:45:17
 * @FilePath: /management-system/helpers/setup.php
 * Copyright (C) 2021 syzhang. All rights reserved.
 */

 define('BASE_DIR', $_SERVER['DOCUMENT_ROOT']); // 获取服务端站点目录
 define('APP_DIR', BASE_DIR . '/management-system/'); // 获取程序的根目录
require(APP_DIR . 'third_party/Smarty/Smarty.class.php');

class MS_Smarty extends Smarty
{
  function MS_Smarty()
  {
    //类构造函数.创建实例的时候自动配置
    $this->__construct();

    $this->template_dir = APP_DIR . 'app/view';
    $this->compile_dir = APP_DIR .'cache/smarty/compiled';
    $this->config_dir = APP_DIR .'config';
    $this->cache_dir = APP_DIR .'cache/smarty/cached';

    $this->assign('app_name', 'Smarty Extend');
  }
  /**
   * @description: 开启缓存
   * @param {*}
   * @return {*}
   * @Author: Humbert Cheung
   */
  public function enable_caching() {
    $this->caching = true;
  }

  /**
   * @description: 禁用缓存
   * @param {*}
   * @return {*}
   * @Author: Humbert Cheung
   */
  public function disable_caching() {
    $this->caching = false;
  }
}