<!DOCTYPE html>
<html>
<head>
    <title>皮肤推荐系统</title>
    <meta charset="UTF-8">
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
    <h1>皮肤推荐系统</h1>
    <form method="post" action="recommend.php">
        <label for="keyword">请输入关键字：</label>
        <input type="text" name="keyword" id="keyword">
        <button type="submit">搜索</button>
    </form>
</body>
</html>
