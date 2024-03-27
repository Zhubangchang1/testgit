<?php
/*
 * @Description: 添加页面
 * @Version: 1.0
 * @Author: Humbert Cheung
 * @Date: 2021-11-02 22:20:35
 * @LastEditors: [Humbert Cheung]
 * @LastEditTime: 2021-11-04 21:05:02
 * @FilePath: /management-system/backend/view/newsadd.php
 * Copyright (C) 2021 syzhang. All rights reserved.
 */
// 登录拦截
session_start();
if (empty($_SESSION['username'])) {
  // 找不到session中的用户名，说明用户是没有登陆过，那么就需要弹窗提醒，并跳转到登录页面
  echo "<script>alert('请先登录！');location.href='./login.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>添加新闻</title>
  <link rel="stylesheet" href="../utils/layui/css/layui.css">
  <style>
    #container {
      padding: 20px;
    }

    .titleDiv {
      margin-bottom: 20px;
    }

    #show-img {
      display: none;
      width: 150px;
      height: 150px;
      margin-top: 15px;
    }
  </style>
</head>

<body class="layui-layout-body">
  <div class="layui-layout layui-layout-admin">
    <?php
    require_once "./common/nav.php";
    ?>
    <div class="layui-body">
      <div id="container">
        <div class="titleDiv">
          <h2>添加新闻</h2>
        </div>
        <form class="layui-form">
          <div class="layui-form-item">
            <label class="layui-form-label">标题</label>
            <div class="layui-input-inline">
              <input type="text" class="layui-input" name="title" require lay-verify="required" placeholder="请输入标题">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">分类</label>
            <div class="layui-input-inline">
              <select name="type_id">
                <option value="">选择分类</option>
                <option value="1">平台时讯</option>
                <option value="2">创业经验</option>
                <option value="3">优质加盟</option>
                <option value="4">团队协作</option>
              </select>
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">头像</label>
            <div class="layui-input-inline">
              <input type="hidden" name="img">
              <a class="layui-btn" id="upload-btn">
                <i class="layui-icon">&#xe67c;</i>上传图片
              </a>
              <img id="show-img">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">内容</label>
            <div class="layui-input-block">
              <input type="hidden" name="content">
              <div id="editor">
              </div>
            </div>
          </div>
          <div class="layui-form-item">
            <div class="layui-input-block">
              <a class="layui-btn" onclick="submit()">确认</a>
              <a class="layui-btn layui-btn-primary" onclick="location.href='./newslist.php'">返回</a>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="layui-footer">
      <!-- 底部固定区域 -->
      © web3 - 创业平台后台管理系统
    </div>
  </div>
  <script src="../utils/layui/layui.js"></script>
  <script src="../utils/jquery/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/wangeditor@latest/dist/wangEditor.min.js"></script>
  <script>
    var service = "add"
    $(document).ready(function() {
      // 获取 localStorage 中的 id，如果存在则说明是从编辑页面传过来的，则启用编辑功能
      if (typeof(localStorage.getItem('NEWS_ID')) != "undefined" && localStorage.getItem('NEWS_ID') != null) {
        service = 'edit'
        var news_id = localStorage.getItem('NEWS_ID')
        $.ajax({
          type: 'get',
          url: '../server/news.php',
          data: {
            news_id: news_id,
            service: service,
          },
          dataType: 'json',
          success: function(res) {
            console.log(res.content[0]);
            var news = res.content[0];
            // 将内容显示到页面中
            // 1, 设置标题
            $('input[name=title]').val(news.title)
            // 2, 设置下拉框
            $('select[name=type_id]').val(news.type_id)
            // 设置layui下拉框默认选中项
            $('select[name=type_id]').siblings("div.layui-form-select").find('dl').find('dd[lay-value=' + news.type_id + ']').click()
            // 3, 设置图片
            $('input[name=img]').val(news.img)
            $('#show-img').attr('src', '../server/resource/' + news.img); // 获取图片的路径，设置给 src 属性
            $('#show-img').css('display', 'inline-block'); // 显示图片
            // 4, 设置内容
            $('input[name=content]').val(news.content)
            editor.txt.html(news.content)
          },
          error: function(error) {
            console.log(error);
          }
        })
      }
    })
    // 监听页面关闭时的事件
    $(window).on('beforeunload', function() {
      // 页面关闭时，清除 localStorage 保存的 new_id
      localStorage.removeItem('NEWS_ID');
    })
    // 创建 wang 编辑器
    const E = window.wangEditor
    const editor = new E("#editor");
    editor.config.uploadImgServer = '../server/upload_wang.php'
    editor.config.uploadFileName = 'pic'
    editor.config.height = 400
    editor.create();

    layui.use(['upload', 'layer'], function() {
      // 获取上传控件实例
      var upload = layui.upload
      // 执行实例
      var uploadInst = upload.render({
        elem: '#upload-btn', // 绑定元素
        url: '../server/common/img_upload.php', // 上传接口
        field: 'icon', // 设置上传域的key，服务端通过此key来获取信息
        done: function(res, index, upload) {
          // res服务端返回的资源 ,其中的 code 如果是 100 则表示上传成功
          if (res.code == 100) {
            console.log(res);
            $('#show-img').attr('src', '../server/resource/' + res.img); // 获取图片的路径，设置给 src 属性
            $('#show-img').css('display', 'inline-block'); // 显示元素
            $('input[name=img]')[0].value = res.img; // 将图片的名字保存给隐藏域
          }
        },
        error: function(error) {
          // 请求异常回调
          console.log(error);
        }
      })
    })

    function submit() {
      // 获取富文本框的文本
      var content = document.querySelector('input[name=content]')
      content.value = editor.txt.html()
      $.ajax({
        type: service == 'add' ? 'post' : 'put',
        url: '../server/news.php',
        data: {
          'title': $('input[name=title]').val(),
          'type_id': $('select[name=type_id]').val(),
          'img': $('input[name=img]').val(),
          'content': $('input[name=content]').val(),
          'id': localStorage.getItem('NEWS_ID')
        },
        dataType: 'json',
        success: function(res) {
          if (service == 'add') {
            if (res.code == "10001") {
              // 添加成功
              layui.layer.confirm(res.message, {
                btn: ["返回新闻列表", "继续添加"]
              }, function() {
                history.go(-1);
              }, function() {
                location.reload();
              })
            }
          } else {
            // 修改成功
            if (res.code == "10001") {
              layui.layer.confirm(res.message, {
                btn: ["返回新闻列表"]
              }, function() {
                location.href = './newslist.php'
              })
            }
          }
        },
        error: function(error) {
          console.log(error);
        }
      })
    }
  </script>
</body>

</html>