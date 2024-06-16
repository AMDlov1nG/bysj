<?php
// 引入Jpgraph库

include ("/www/wwwroot/139.199.231.191/jpgraph-4.4.2/src/jpgraph.php");
include ("/www/wwwroot/139.199.231.191/jpgraph-4.4.2/src/jpgraph_bar.php");

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
$data['鬼魅'] = $data['鬼魅']/2;
// 创建画布
$fontChinese = FF_FONT1; // 这里假设FF_FONT1是你在jpgraph_ttf.inc.php中定义的中文字体常量  
  
// 创建画布  
$graph = new Graph(400, 300);  
$graph->SetScale("textlin");  
  
// 创建柱状图（略）  
  
// 设置X轴标签  
$graph->xaxis->SetTickLabels(['狂徒', '幻影', '戍卫', '獠犬', '正义', '鬼魅']);  
$graph->xaxis->SetFont($fontChinese); // 设置X轴字体为中文支持字体  
  
// 设置中文标题并设置字体  
$graph->title->Set(iconv("UTF-8", "GBK", '武器皮肤统计')); // 注意这里使用了GBK编码，因为某些中文字体可能不支持UTF-8  
$graph->title->SetFont($fontChinese, FS_BOLD, 12);  
  
// 将柱状图添加到画布（略）  
  
// 显示图表  
$graph->Stroke();  
?>
