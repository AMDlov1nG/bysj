<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>皮肤推荐系统</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        input[type="text"] {
            padding: 8px;
            width: 200px;
            margin-right: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            padding: 8px 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        h2 {
            margin-top: 20px;
            color: #333;
        }

        a {
            text-decoration: none;
            color: #007bff;
            margin-top: 20px;
            display: block;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>皮肤推荐系统</h1>
        <form method="post">
            <input type="text" name="keyword" placeholder="输入关键字搜索皮肤">
            <input type="submit" value="搜索">
        </form>
        <?php
        $host = '139.199.231.191';
        $user = '123123';
        $password = '123123';
        $database = 'allskin1.1';
        $charset = 'utf8mb4';
        $port = 3306;

        $conn = new mysqli($host, $user, $password, $database, $port);
        if ($conn->connect_error) {
            die("连接失败: " . $conn->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $keyword = $_POST['keyword'];

            $sql = "SELECT displayname FROM weapons_skins_all_languages1 WHERE displayname LIKE '%$keyword%' AND contentTierUuid IN ('e046854e-406c-37f4-6607-19a9ba8426fc', '411e4a55-4e59-7757-41f0-86a53f101bb5')";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $rows = [];
                while ($row = $result->fetch_assoc()) {
                    $rows[] = $row['displayname'];
                }

                $n = count($rows);
                for ($i = $n - 1; $i > 0; $i--) {
                    $j = mt_rand(0, $i);
                    [$rows[$i], $rows[$j]] = [$rows[$j], $rows[$i]];
                }

                $recommended_skin = $rows[0];
                echo "<h2>推荐的皮肤名：$recommended_skin</h2>";
            } else {
                echo "<h2>未找到符合条件的数据</h2>";
            }
        }

        $conn->close();
        ?>
        <a href="http://139.199.231.191:4070/tuijian2.0.php">返回查询系统</a>
    </div>
</body>
</html>
