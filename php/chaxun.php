<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8' />
		<title>查询MYSQL数据</title>
	</head>
	
	<body>
		<table border="1">
			<tr>
				<th>name</th>
				<th>single</th>
				<th>note</th>
			</tr>
			
			<?php
				$servername = "139.199.231.191";  
                $username = "123123";  
                $password = "123123";  
                $dbname = "allskin1.1"; 
				$port = 3306;
				
				$conn = new mysqli($host, $username, $password, $database, $port);
 
				if ($conn->connect_error) {
					die('连接失败：' . $conn->connect_error);
				}
				
				$sql = "SELECT name, singer, note FROM song";
				$result = $conn->query($sql);
				
				if ($result->num_rows > 0) {
					// 输出数据
					while($row = $result->fetch_assoc()) {
						echo <<<EOF
							<tr>
								<td>$row[ID]</td>
								<td>$row[名称]</td>
								<td>$row[图标]</td>
                                <td>$row[等级]</td>
								<td>$row[语言]</td>
							</tr>
						EOF;
					}
				}
				
 
				$conn->close();
			?>
		</table>
	</body>
</html>