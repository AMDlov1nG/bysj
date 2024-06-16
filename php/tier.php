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
$sql = "SELECT contentTierUuid FROM weapons_skins_all_languages1 WHERE language = 'zh-CN' ";
$result = $conn->query($sql);

// 初始化等级计数数组
$levelCounts = array(
    '等级一' => 0,
    '等级二' => 0,
    '等级三' => 0,
    '等级四' => 0,
    '等级五' => 0,
    '其他' => 0
);

// 统计每个等级的数量
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        switch ($row['contentTierUuid']) {
            case '12683d76-48d7-84a3-4e09-6985794f0445':
                $levelCounts['等级一']++;
                break;
            case '0cebb8be-46d7-c12a-d306-e9907bfc5a25':
                $levelCounts['等级二']++;
                break;
            case '60bca009-4182-7998-dee7-b8a2558dc369':
                $levelCounts['等级三']++;
                break;
            case '411e4a55-4e59-7757-41f0-86a53f101bb5':
                $levelCounts['等级四']++;
                break;
            case 'e046854e-406c-37f4-6607-19a9ba8426fc':
                $levelCounts['等级五']++;
                break;
            default:
                $levelCounts['其他']++;
                break;
        }
    }
}

// 输出数据供JavaScript使用
echo '<script>';
echo 'var levelCounts = ' . json_encode($levelCounts) . ';';
echo '</script>';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>武器皮肤等级占比情况</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="levelChart" width="400" height="400"></canvas>
    <script>
        const ctx = document.getElementById('levelChart').getContext('2d');
        const levelChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: Object.keys(levelCounts),
                datasets: [{
                    data: Object.values(levelCounts),
                    backgroundColor: [
                        'blue', // 等级一
                        'green', // 等级二
                        'red', // 等级三
                        'gold', // 等级四
                        'orange', // 等级五
                        'gray' // 其他
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>
</body>
</html>
