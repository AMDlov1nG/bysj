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

// 找出数量最少的5个关键字
asort($keywordCounts);
$topKeywords = array_slice($keywordCounts, 0, 5);

// 计算推出概率
$totalCount = array_sum($keywordCounts);
$probabilities = array();
$minCounts = array_slice($keywordCounts, 0, 5);
$maxCount = max($keywordCounts);

foreach ($minCounts as $keyword => $count) {
    $weight = round((($maxCount - $count) / $maxCount) / array_sum(array_map(function($c) use ($maxCount) { return ($maxCount - $c) / $maxCount; }, $minCounts)) * 100, 2);
    $probabilities[$keyword] = $weight;
}

// 输出可能推出皮肤的枪械及概率

// 关闭数据库连接
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>推出皮肤概率</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f0f0f0;
    }
    .container {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    h1 {
        text-align: center;
        color: #333;
    }
    ul {
        list-style-type: none;
        padding: 0;
    }
    li {
        margin-bottom: 10px;
    }
</style>
</head>
<body>
<div class="container">
    <h1>可能推出皮肤的枪械及概率</h1>
    <ul>
        <?php foreach ($probabilities as $keyword => $probability): ?>
            <li><strong><?php echo $keyword; ?></strong> 推出概率：<?php echo $probability; ?>%</li>
        <?php endforeach; ?>
    </ul>
</div>
</body>
</html>