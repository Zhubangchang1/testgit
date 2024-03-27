<?php
/*
 * @Description: 新闻模块服务端处理文件
 * @Version: 1.0
 * @Author: Humbert Cheung
 * @Date: 2021-11-02 21:16:36
 * @LastEditors: [Humbert Cheung]
 * @LastEditTime: 2021-11-15 14:17:09
 * @FilePath: /management-system/app/model/news.php
 * Copyright (C) 2021 syzhang. All rights reserved.
 */

require_once './common/DB.php';
require_once './common/Response.php';

// 获取请求方式
$method = $_SERVER["REQUEST_METHOD"];

switch ($method) {
  case "GET":
    //  判断业务类别，如果是 edit， 说明是编辑新闻，则根据id获取新闻
    if ($_REQUEST['service'] == 'edit') {
      //  [GET] /server/news.php?news_id
      $news_id = $_REQUEST['news_id'];
      $sql = "SELECT * FROM news WHERE id='$news_id'";
      $stmt = DB::getInstance()->connect()->query($sql);
      $news = $stmt->fetch();
      if($news) {
        Response::json("10001", "数据请求成功", [$news]);
      } else {
        Response::json("-10001", "数据请求失败!");
      }
    } else {
      //  [GET] /server/news.php
      // 查询新闻列表操作
      $limit = $_REQUEST['limit'] ? $_REQUEST['limit'] : 5;
      $curr = $_REQUEST['curr'] ? $_REQUEST['curr'] : 1;
      // 判断是否有传递查询的参数
      $sql = "";
      if(!empty($_REQUEST['search_title']) && !empty($_REQUEST['type_id'])) {
        // 根据条件查询数据
        $title = $_REQUEST['search_title'];
        $type_id = $_REQUEST['type_id'] + 0;
        $sql = "SELECT * FROM news WHERE title LIKE '%$title%' AND type_id=$type_id ORDER BY id LIMIT " . ($curr - 1) * $limit . ", $limit";
      } else {
        // 直接查询所有数据
        $sql = "SELECT * FROM news ORDER BY id LIMIT " . ($curr - 1) * $limit . ", $limit";
      }
      $stmt = DB::getInstance()->connect()->query($sql);
      if ($stmt->rowCount() > 0) {
        $news = $stmt->fetchAll();
        Response::json("10001", "数据请求成功!", $news);
      } else {
        Response::json("-10001", "数据请求失败!");
      }
    }
    break;
    //  [POST] /server/news.php
  case "POST":
    // 添加操作
    parse_str(file_get_contents('php://input'), $data);
    // $data = array_merge($_GET, $_POST, $data);
    $title = $data['title'];
    $type_id = $data['type_id'];
    $img = $data['img'];
    $content = $data['content'];
    $create_time = date('Y-m-d H:i:s', time() + 8 * 3600);
    //4 新增
    $sql = "INSERT INTO
     news (title, content, img, type_id, create_time)
     VALUES
     ('$title', '$content', '$img', $type_id, '$create_time')";
    $count = DB::getInstance()->connect()->exec($sql);
    if ($count >= 1) {
      Response::json("10001", "添加成功!");
    } else {
      Response::json("-10001", "添加失败!");
    }
    break;
    //  [PUT] /server/news.php?news_id
  case "PUT":
    // 更新操作
    parse_str(file_get_contents('php://input'), $data);
    $title = $data['title'];
    $type_id = $data['type_id'];
    $img = $data['img'];
    $content = $data['content'];
    $id = $data['id'] + 0;
    $create_time = date('Y-m-d H:i:s', time() + 8 * 3600);
    //4 新增
    $sql = "UPDATE news SET title='$title', content='$content', img='$img', type_id=$type_id, create_time='$create_time' WHERE id=$id";
    $count = DB::getInstance()->connect()->exec($sql);
    if ($count >= 1) {
      Response::json("10001", "更新成功!");
    } else {
      Response::json("-10001", "更新失败!");
    }
    break;
    //  [DELETE] /server/news.php?news_id
  case "DELETE":
    // 删除操作
    parse_str(file_get_contents('php://input'), $data);
    $id = $data['news_id'];
    $sql = "DELETE FROM news WHERE id='$id'";
    $count = DB::getInstance()->connect()->exec($sql);
    if ($count > 0) {
      Response::json('10001', '删除成功！');
    } else {
      Response::json('-10001', '删除失败！');
    }
    break;
  default:
    break;
}
