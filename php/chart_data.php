<?php
// 连接数据库
$conn = mysqli_connect("139.199.231.191", "123123", "123123", "allskin1.1");

// 查询语句
$sql = "SELECT 
    SUM(CASE WHEN displayname LIKE '%狂徒%' THEN 1 ELSE 0 END) AS '狂徒',
    SUM(CASE WHEN displayname LIKE '%幻影%' THEN 1 ELSE 0 END) AS '幻影', 
    SUM(CASE WHEN displayname LIKE '%戍卫%' THEN 1 ELSE 0 END) AS '戍卫',
    SUM(CASE WHEN displayname LIKE '%獠犬%' THEN 1 ELSE 0 END) AS '獠犬',
    SUM(CASE WHEN displayname LIKE '%正义%' THEN 1 ELSE 0 END) AS '正义',
    SUM(CASE WHEN displayname LIKE '%鬼魅%' THEN 1 ELSE 0 END) AS '鬼魅'
FROM weapons_skins_all_languages1";

$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);
?>
