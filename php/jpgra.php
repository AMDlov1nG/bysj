<?php
// 引入Jpgraph库

include ("/www/wwwroot/139.199.231.191/jpgraph-4.4.2/src/jpgraph.php");
include ("/www/wwwroot/139.199.231.191/jpgraph-4.4.2/src/jpgraph_bar.php");

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
$data['鬼魅'] = $data['鬼魅']/2;

// 创建画布  

$graph = new Graph(400, 300); // 设置画布大小为400x300  

$graph->SetScale("textlin");  

  

// 创建柱状图  

$barplot = new BarPlot([$data['狂徒'], $data['幻影'], $data['戍卫'], $data['獠犬'], $data['正义'], $data['鬼魅']]);  

$barplot->SetFillColor('lightblue');  

$barplot->SetWidth(0.6);  

  

// 在柱子顶部标明数据的数量  

$barplot->value->Show();  

$barplot->value->SetFont(FF_ARIAL, FS_NORMAL, 10);  

$barplot->value->SetFormat('%d');  

  

// 设置X轴标签  
$fontChinese = FF_SIMHEI;

$graph->xaxis->SetTickLabels(['狂徒', '幻影', '戍卫', '獠犬', '正义', '鬼魅']);  
$graph->xaxis->SetFont($fontChinese);

  

// 设置中文标题  

$graph->title->Set(iconv("UTF-8", "GB2312//IGNORE", '武器皮肤统计'));  

$graph->title->SetFont(FF_SIMSUN, FS_BOLD, 12);  

  

// 将柱状图添加到画布  

$graph->Add($barplot);  

  

// 显示图表  

$graph->Stroke();  

?>