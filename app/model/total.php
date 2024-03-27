<?php
/*
 * @Description: 获取数据总条目数量
 * @Version: 1.0
 * @Author: Humbert Cheung
 * @Date: 2021-11-03 15:53:59
 * @LastEditors: [Humbert Cheung]
 * @LastEditTime: 2021-11-06 16:55:07
 * @FilePath: /management-system/backend/server/total.php
 * Copyright (C) 2021 syzhang. All rights reserved.
 */
require_once '../server/common/DB.php';

$sql = '';
// 获取总数
if ($_REQUEST['type'] == 'total') {
  // 查询表中所有记录的数量
  $sql = 'SELECT COUNT(*) FROM news';
} else {
  $title = $_REQUEST['search_title'];
  $type_id = $_REQUEST['type_id'] + 0;
  // 查询根据条件所匹配出的所有记录的数量
  $sql = "SELECT COUNT(*) FROM news WHERE title LIKE '%$title%' AND type_id=$type_id";
}
$stmt = DB::getInstance()->connect()->query($sql);
$countArr = $stmt->fetch();
echo $countArr["COUNT(*)"];
