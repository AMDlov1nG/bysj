<?php
// 设置数据库连接参数
$host = '139.199.231.191';
$user = '123123';
$password = '123123';
$database = 'allskin1.1';
$charset = 'utf8mb4';
$port = 3306;

// 连接数据库
$conn = new mysqli($host, $user, $password, $database, $port);
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

// 查询符合条件的数据
$sql = "SELECT * FROM weapons_skins_all_languages1 WHERE `language`='zh-CN'";
$result = $conn->query($sql);

// 初始化关键字计数数组
$keywordCounts = array_fill_keys(array('标配', '鬼魅', '奥丁', '战神', '狂怒', '獠犬', '幻影', '判官', '雄鹿', '正义', '短炮', '冥驹', '戍卫', '莽侠', '飞将', '骇灵', '蜂刺'), 0);

// 统计每个关键字的数量
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        foreach ($keywordCounts as $keyword => $count) {
            if (stripos($row['displayname'], $keyword) !== false) {
                $keywordCounts[$keyword]++;
            }
        }
    }
}

// 输出关键字计数结果

// 提取数据
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[$row['keyword']] = $row['count']; // 假设数据库中有count字段存储数量
}

// 输出数据供JavaScript使用
echo '<script>';
echo 'var keywordCountsFromPHP = ' . json_encode($keywordCounts) . ';';
echo '</script>';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Keyword Counts Line Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="keywordChart" width="200" height="70"></canvas>

    <script>
    // 创建您提供的数组并将PHP查询结果赋值给它
    var keywordCounts = {
        '标配': 0,
        '鬼魅': 0,
        '奥丁': 0,
        '战神': 0,
        '狂怒': 0,
        '獠犬': 0,
        '幻影': 0,
        '判官': 0,
        '雄鹿': 0,
        '正义': 0,
        '短炮': 0,
        '冥驹': 0,
        '戍卫': 0,
        '莽侠': 0,
        '飞将': 0,
        '骇灵': 0,
        '蜂刺': 0
    };
    Object.assign(keywordCounts, keywordCountsFromPHP);
        // 创建折线图
        const ctx = document.getElementById('keywordChart').getContext('2d');
        const keywordChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: Object.keys(keywordCounts),
                datasets: [{
                    label: '武器皮肤数量统计',
                    data: Object.values(keywordCounts),
                    borderColor: 'blue',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: false,
                        min: 3,
                        stepSize: 10
                    }
                }
            }
        });
    </script>
</body>
</html>

