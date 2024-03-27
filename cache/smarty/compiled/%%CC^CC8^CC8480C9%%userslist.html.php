<?php /* Smarty version 2.6.32, created on 2021-11-16 09:54:55
         compiled from userslist.html */ ?>
<!--
 * @Description: 用户列表模块view
 * @Version: 1.0
 * @Author: Humbert Cheung
 * @Date: 2021-11-16 09:29:53
 * @LastEditors: [Humbert Cheung]
 * @LastEditTime: 2021-11-16 09:52:34
 * @FilePath: /management-system/app/view/userslist.html
 * Copyright (C) 2021 syzhang. All rights reserved.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>首页</title>
  <link rel="stylesheet" href="./third_party/layui/css/layui.css">
  <style>
    <?php echo '
    #container {
      padding: 20px;
    }
    '; ?>

  </style>
</head>

<body class="layui-layout-body">
  <div class="layui-layout layui-layout-admin">
    <?php 
    require_once './app/view/common/nav.php';
     ?>
    <div class="layui-body">
      <div id="container">
        <a href="./index.php?controller=Users&method=add" class="layui-btn">
          <i class="layui-icon layui-icon-add-circle"></i>
          添加用户
        </a>
        <table class="layui-table">
          <thead>
            <tr>
              <th>编号</th>
              <th>头像</th>
              <th>姓名</th>
              <th>年龄</th>
              <th>分类</th>
              <th>生日</th>
              <th>创建时间</th>
              <th>操作</th>
            </tr>
          </thead>
          <tbody>
            <?php $_from = $this->_tpl_vars['data']; if (($_from instanceof StdClass) || (!is_array($_from) && !is_object($_from))) { settype($_from, 'array'); }$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['user']):
        $this->_foreach['name']['iteration']++;
?>
            <tr>
              <td><?php echo $this->_tpl_vars['user']['id']; ?>
</td>
              <td>
              <img src="./resource/<?php echo $this->_tpl_vars['user']['icon']; ?>
" class="layui-img" alt="无法加载头像">
              </td>
              <td><?php echo $this->_tpl_vars['user']['name']; ?>
</td>
              <td><?php echo $this->_tpl_vars['user']['age']; ?>
</td>
              <td><?php echo $this->_tpl_vars['user']['type_name']; ?>
</td>
              <td><?php echo $this->_tpl_vars['user']['birthday']; ?>
</td>
              <td><?php echo $this->_tpl_vars['user']['ctime']; ?>
</td>
              <td>
                <a class='layui-btn layui-btn-sm' href="./index.php?controller=Users&method=edit&id=<?php echo $this->_tpl_vars['user']['id']; ?>
">编辑</a>
                <button class="layui-btn layui-btn-sm layui-btn-danger" onclick="deleteUser(<?php echo $this->_tpl_vars['user']['id']; ?>
, '<?php echo $this->_tpl_vars['user']['name']; ?>
')">删除</button>
              </td>
            </tr>
            <?php endforeach; endif; unset($_from); ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="layui-footer">
      <!-- 底部固定区域 -->
      © web3 - 创业平台后台管理系统
    </div>
  </div>
  <script src="./third_party/layui/layui.js"></script>
  <script>
    <?php echo '
    function deleteUser(id, name) {
      // 获取弹出框对象
      var layer = layui.layer;
      layer.confirm(\'确认删除\' + name + "？", {
        btn: ["确定", "取消"] // 设置按钮
      }, function (index, ) {
        // 第一个按钮的回调函数
        location.href = "./index.php?controller=Users&method=delete&id=" + id
      }, function (index) {
        // 第二个按钮的回调函数
      })
    }
    '; ?>

  </script>
</body>

</html>