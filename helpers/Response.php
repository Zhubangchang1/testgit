<?php
/*
 * @Description: php响应类
 * @Version: 1.0
 * @Author: Humbert Cheung
 * @Date: 2021-11-01 23:51:06
 * @LastEditors: [Humbert Cheung]
 * @LastEditTime: 2021-11-01 23:53:49
 * @FilePath: /management-system-all/backend/server/common/Response.php
 * Copyright (C) 2021 syzhang. All rights reserved.
 */

//解决跨域问题
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Headers:x-requested-with,content-type');

class Response {
  static public function json($code = 0, $message = 0, $content=[]) {
    $response = [
      "code" => $code,
      "message" => $message,
      "content" => $content
    ];
    exit(json_encode($response, JSON_UNESCAPED_UNICODE));
  }
}

?>
