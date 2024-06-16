<?php
$servername = "139.199.231.191";
$username = "123123";
$password = "123123";
$dbname = "allskin1.1";

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);

// 检查连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

// 查询表中的所有数据
$sql = "SELECT uuid AS ID, displayname AS 名称, displayIcon AS 图标, contentTierUuid AS 等级, language AS 语言 FROM weapons_skins_all_languages1";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>数据库表格展示</title>
</head>
<body>
    <h1>weapons_skins_all_languages1表格展示</h1>
    <table border="1">
        <tr>
            <?php
            if ($result->num_rows > 0) {
                // 输出表头
                $row = $result->fetch_assoc();
                foreach ($row as $key => $value) {
                    echo "<th>$key</th>";
                }
                echo "</tr>";

                // 输出数据
                do {
                    echo "<tr>";
                    foreach ($row as $value) {
                        echo "<td>$value</td>";
                    }
                    echo "</tr>";
                } while ($row = $result->fetch_assoc());
            } else {
                echo "0 结果";
            }
            ?>
    </table>
</body>
</html>