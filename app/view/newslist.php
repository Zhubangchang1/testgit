<?php
/*
 * @Description: 新闻列表页面
 * @Version: 1.0
 * @Author: Humbert Cheung
 * @Date: 2021-11-02 19:55:16
 * @LastEditors: [Humbert Cheung]
 * @LastEditTime: 2021-11-06 20:52:09
 * @FilePath: /management-system/backend/view/newslist.php
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
  <title>新闻列表</title>
  <link rel="stylesheet" href="../utils/layui/css/layui.css">
  <style>
    #container {
      padding: 20px;
    }

    .search-form {
      display: inline-block;
    }

    .search-form-container {
      display: flex;
    }

    .search-form-container>* {
      margin-left: 10px;
    }

    .search-form-container>*:first-child {
      margin-left: 50px;
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
        <a href="./newsadd.php" class="layui-btn">
          <i class="layui-icon layui-icon-add-circle"></i>
          添加新闻
        </a>
        <form class="layui-form search-form">
          <div class="search-form-container">
            <input class="layui-input" type="text" name="search_title" placeholder="搜索标题">
            <select name="type">
              <option value=""></option>
              <option value="1">平台时讯</option>
              <option value="2">创业经验</option>
              <option value="3">优质加盟</option>
              <option value="4">团队协作</option>
            </select>
            <div onclick="search()" class="layui-btn layui-btn-primary">提交</div>
          </div>
        </form>
        <table class="layui-table">
          <thead>
            <tr>
              <th>编号</th>
              <th>标题</th>
              <th>主图</th>
              <th>分类</th>
              <th>发布时间</th>
              <th>操作</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
        <div id="pager"></div>
      </div>
    </div>
    <div class="layui-footer">
      <!-- 底部固定区域 -->
      © web3 - 创业平台后台管理系统
    </div>
  </div>
  <script src="../utils/layui/layui.js"></script>
  <script src="../utils/jquery/jquery-3.6.0.min.js"></script>
  <script>
    var total = 0; // 总数
    var page_num = 5; // 每页展示的数量
    var current_page = 1; // 当前页
    $(window).on('load', () => {
      // 准备请求参数
      var requestData = {
        service: 'all',
      }
      // 获取数据
      getData('total', requestData)
    })

    /**
     * @description: 搜索的事件
     * @param {*}
     * @return {*}
     * @Author: Humbert Cheung
     */
    function search() {
      if(!$('input[name=search_title]').val() || !$('select[name=type]').val()){
        var layer = layui.layer
        layer.alert('标题和类别不能为空！')
      }
      // 准备请求参数
      var requestData = {
        search_title: $('input[name=search_title]').val(),
        type_id: $('select[name=type]').val(),
        service: 'all',
      }
      // 获取数据
      getData('search', requestData)
    }
    /**
     * @description: 获取数据
     * @param {*} totalType: 获取总数的参数，如果是 total则表示获取的是所有的总数，如果是 search 表示获取的是根据条件匹配出的记录的总数
     * @param {*} requestData: 请求的参数。
     * @return {*}
     * @Author: Humbert Cheung
     */
    function getData(totalType, requestData) {
      // 获取所有数据的总数
      $.ajax({
        type: 'get',
        url: '../server/total.php',
        data: {
          type: totalType,
          search_title: $('input[name=search_title]').val(),
          type_id: $('select[name=type]').val(),
        },
        success: function(res) {
          total = res
          console.log("总共有" + total + "条记录。");
          // 根据返回的总数来设置分页
          layui.use("laypage", function() {
            var laypage = layui.laypage
            laypage.render({
              elem: "pager", // 此处的 pager 是id，不需要加引号
              page: true, // 开启分页
              count: total,
              limit: page_num, // 每页展示的数量,
              limits: [10, 20, 30, 40],
              jump: function(obj) {
                requestData['limit'] = obj.limit // 补充参数： 每页的数量
                requestData['curr'] = obj.curr // 补充参数：当前页
                initial(requestData) // 请求每页的内容
              }
            })
          })
        },
        error: function(error) {
          console.log(error);
        }
      })
    }
    // 初始化新闻列表
    function initial(data) {
      $.ajax({
        type: 'get',
        url: '../server/news.php',
        dataType: 'json',
        data: data,
        success: function(res) {
          console.log(res.content);
          var content = "";
          res.content.forEach(element => {
            var tmpType = ""
            switch (element.type_id) {
              case "1":
                tmpType = "平台时讯";
                break;
              case "2":
                tmpType = "创业经验";
                break;
              case "3":
                tmpType = "优质加盟";
                break;
              case "4":
                tmpType = "团队协作";
                break;
              default:
                tmpType = "平台时讯";
            }
            content += '<tr>\
            <td>' + element.id + '</td>\
            <td>' + element.title + '</td>\
            <td><img src="../server/resource/' + element.img + '" alt="暂无图片"></td>\
            <td>' + tmpType + '</td>\
            <td>' + element.create_time + '</td><td>\
            <button class="layui-btn layui-btn-xs" onclick="editNews(' + element.id + ')">编辑</button>\
            <button class="layui-btn layui-btn-danger layui-btn-xs" onclick="deleteNews(' + element.id + ',\'' + element.title + '\')">删除</button>\
            </td></tr>'
            //以上代码中的删除按钮，因为是通过字符串拼接而成，所以在按钮单击事件中，如果传递字符串类型的参数，像中文或英文等，那么就需要添加引号，因此添加了 \'
          });
          $('tbody').html(content);
        },
        error: function(error) {
          console.log(error);
        }
      })
    }
    /**
     * @description: 编辑新闻
     * @param {*} id 新闻id
     * @return {*}
     * @Author: Humbert Cheung
     */
    function editNews(id) {
      // 将 id 存储到本地中
      localStorage.setItem("NEWS_ID", id);
      // 跳转到编辑（和添加共用一个页面）
      location.href = './newsadd.php';
    }
    /**
     * @description: 删除新闻
     * @param {*} id: 新闻id，title: 新闻标题
     * @return {*}
     * @Author: Humbert Cheung
     */
    function deleteNews(id, title) {
      var layer = layui.layer
      layer.confirm("确定要删除“" + title + "”吗？", {
        btn: ["确定", "取消"]
      }, function() {
        // 关闭弹窗
        layer.closeAll()
        $.ajax({
          type: 'delete',
          url: '../server/news.php',
          data: {
            news_id: id
          },
          dataType: 'json',
          success: function(res) {
            alert(res.message);
            location.reload();
          },
          error: function(error) {
            console.log(error);
          }
        })
      }, function() {})
    }
  </script>
</body>

</html>