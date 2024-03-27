<!--
/*
 * @Description: 导航栏模块
 * @Version: 1.0
 * @Author: Humbert Cheung
 * @Date: 2021-10-19 15:09:12
 * @LastEditors: [Humbert Cheung]
 * @LastEditTime: 2021-11-16 10:28:26
 * @FilePath: /management-system/app/view/common/nav.php
 * Copyright (C) 2021 syzhang. All rights reserved.
 */
 -->
<div class="layui-header">
  <div class="layui-logo">创业平台后台管理系统</div>
  <ul class="layui-nav layui-layout-left">
    <li class="layui-nav-item"><a href="">控制台</a></li>
    <li class="layui-nav-item"><a href="">用户管理</a></li>
    <li class="layui-nav-item"><a href="">用户</a></li>
    <li class="layui-nav-item">
      <a href="">其他系统</a>
      <dl class="layui-nav-child">
        <dd><a href="">邮件管理</a></dd>
        <dd><a href="">消息管理</a></dd>
        <dd><a href="">授权管理</a></dd>
      </dl>
    </li>
  </ul>
  <ul class="layui-nav layui-layout-right">
    <li class="layui-nav-item">
      <a href="">
        <img class="layui-nav-img" src="http://t.cn/RCzsdCq">
        贤心
      </a>
      <dl class="layui-nav-child">
        <dd><a href="">修改信息</a></dd>
        <dd><a href="">安全设置</a></dd>
      </dl>
    </li>
    <li class="layui-nav-item"><a href="index.php?controller=Login&method=logout">退了</a></li>
  </ul>
</div>
<!-- 侧边栏 -->
<div class="layui-side layui-bg-black">
  <div class="layui-side-scroll">
    <ul class="layui-nav layui-nav-tree">
      <li class="layui-nav-item layui-nav-itemed">
        <a href="#">所有用户</a>
        <dl class="layui-nav-child">
          <dd><a href="./userlist.php">用户列表</a></dd>
          <dd><a href="">添加列表</a></dd>
        </dl>
      </li>
      <li class="layui-nav-item">
        <a href="#">新闻管理</a>
        <dl class="layui-nav-child">
          <dd><a href="./newslist.php">新闻列表</a></dd>
          <dd><a href="">新闻分类</a></dd>
        </dl>
      </li>
      <li class="layui-nav-item"><a href="">云市场</a></li>
      <li class="layui-nav-item"><a href="">发布商场</a></li>
    </ul>
  </div>
</div>