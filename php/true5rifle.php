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
$data['鬼魅'] = $data['鬼魅']/2;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>主战武器皮肤统计</title>
    <script src="https://www.chartjs.org/dist/2.9.4/Chart.min.js"></script>
</head>
<body>
    <canvas id="myChart"width="200" height="70"></canvas>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['狂徒', '幻影', '戍卫', '獠犬', '正义', '鬼魅'],
                datasets: [{
                    label: '主战武器皮肤统计',
                    data: [<?php echo $data['狂徒'] . "," . $data['幻影'] . "," . $data['戍卫'] . "," . $data['獠犬'] . "," . $data['正义'] . "," . $data['鬼魅']; ?>],
                    backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(109, 99, 78, 0.2)', 'rgba(298, 206, 186, 0.2'],
                    borderColor: ['rgb(255, 99, 132)', 'rgb(54, 162, 235)', 'rgb(255, 206, 86)', 'rgb(75, 192, 192)', 'rgb(222, 206, 86)', 'rgb(109, 211, 32)'],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            stepSize: 20
                        }
                    }]
                }
            }
        });
    </script>
</body>
</html>
