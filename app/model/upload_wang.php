<?php
/*
 * @Description: wang 编辑器的图片处理页面
 * @Version: 1.0
 * @Author: Humbert Cheung
 * @Date: 2021-11-02 23:12:23
 * @LastEditors: [Humbert Cheung]
 * @LastEditTime: 2021-11-03 00:02:07
 * @FilePath: /management-system-all/backend/server/upload_wang.php
 * Copyright (C) 2021 syzhang. All rights reserved.
 */

function json($code = 0, $message = '', $data = []) {
  $ret = [
      'errno' => $code,
      'message' => $message,
      'data' => $data
  ];
  exit(json_encode($ret, JSON_UNESCAPED_UNICODE));
}

if (! empty($_FILES['pic'])) {
  $file = $_FILES['pic'];
  move_uploaded_file($file['tmp_name'], './resource/' . $file['name']);
  // 构造当前文件的完整路径
  $url = 'http://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER["SERVER_PORT"] . $_SERVER["PHP_SELF"];
  // 构造图片的路径
  $icon = str_replace('upload_wang.php', '', $url) . 'resource/' . $file['name'];
  // 将图片路径返回
  json(0, '上传成功', [$icon]);
} else {
  json(-1, '图片不存在');
}