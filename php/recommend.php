<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>皮肤推荐系统</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        h1 {
            margin-top: 50px;
        }
        form {
            margin-top: 20px;
        }
        label {
            font-size: 20px;
        }
        input[type="text"] {
            padding: 10px;
            margin: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            padding: 10px 20px;
            margin: 10px;
            border-radius: 5px;
            border: none;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>皮肤推荐系统</h1>
        
        <?php
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

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $keyword = $_POST['keyword'];

    // 查询数据库，根据关键字检索数据
            $sql = "SELECT displayname FROM weapons_skins_all_languages1 WHERE displayname LIKE '%$keyword%' AND contentTierUuid IN ('e046854e-406c-37f4-6607-19a9ba8426fc', '411e4a55-4e59-7757-41f0-86a53f101bb5')";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
        // 将结果存入数组
                $rows = [];
                while ($row = $result->fetch_assoc()) {
                    $rows[] = $row['displayname'];
                }

        // 使用Fisher-Yates洗牌算法随机选择一条记录
                $n = count($rows);
                for ($i = $n - 1; $i > 0; $i--) {
                    $j = mt_rand(0, $i);
                    [$rows[$i], $rows[$j]] = [$rows[$j], $rows[$i]];
                }

                $recommended_skin = $rows[0];
            }
        }

        $conn->close();
        ?>
        <div class="recommendation">
            <?php
            if (isset($recommended_skin)) {
                echo "<h2>推荐的皮肤名：$recommended_skin</h2>";
            } else {
                echo "<h2>未找到符合条件的数据</h2>";
            }
            ?>
        </div>
        <button style="display: block; margin: 0 auto; border-radius: 5px; padding: 5px 10px;" onclick="window.location.href='http://139.199.231.191:4070/tuijian.php'">返回推荐系统</button>
    </div>
</body>
</html>
