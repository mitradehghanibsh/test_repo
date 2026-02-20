<?php
$servername = "localhost";
$username = "root";
$password = "";  // XAMPP 默认空密码
$dbname = "webshop"; // 你的数据库名

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 自动插入测试商品（如果表为空）
$result = $conn->query("SELECT COUNT(*) AS count FROM products");
$row = $result->fetch_assoc();
if ($row['count'] == 0) {
    $conn->query("INSERT INTO products (name, price, description, image) VALUES
    ('Artek Chair', 450, 'Classic Finnish wooden chair', 'artek44.jpg'),
    ('Iittala Vase', 120, 'Hand-blown glass masterpiece', 'Iitttalla16.jpg'),
    ('Marimekko Plate', 35, 'Bold Nordic pattern tableware', 'marimekko4dl.jpg'),
    ('Nanny Still Glass', 200, 'Colorful Finnish art glass', 'nannystill001.jpg')");
}
?>
