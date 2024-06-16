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

// 绘制图表
echo "<script src='https://www.chartjs.org/dist/2.9.4/Chart.min.js'></script>";
echo "<canvas id='myChart'></canvas>";

echo "<script>";
echo "var ctx = document.getElementById('myChart').getContext('2d');";
echo "var myChart = new Chart(ctx, {";
echo "type: 'bar',";
echo "data: {";
echo "labels: ['狂徒', '幻影', '戍卫', '獠犬','正义','鬼魅'],"; 
echo "datasets: [{";
echo "label: '# of Words',";
echo "data: [";
echo $data['狂徒'].",".$data['幻影'].",".$data['戍卫'].",".$data['獠犬'].",".$data['正义'].",".$data['鬼魅'];
echo "],";
echo "backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(255, 206, 86, 0.2)'],";
echo "borderColor: ['rgb(255, 99, 132)', 'rgb(54, 162, 235)', 'rgb(255, 206, 86)', 'rgb(75, 192, 192)', 'rgb(255, 206, 86)', 'rgb(255, 206, 86)'],"; 
echo "borderWidth: 1";
echo "}]";
echo "}";
echo "});";
echo "</script>";
?>
