<?php
session_start();
include 'db.php';

if(!isset($_SESSION['email'])) header("Location: login.php");

if(empty($_SESSION['cart'])){
    echo "Cart is empty. <a href='products.php'>Shop Now</a>";
    exit;
}

// Get user id
$stmt=$conn->prepare("SELECT id FROM users WHERE email=?");
$stmt->bind_param("s",$_SESSION['email']);
$stmt->execute();
$user_id=$stmt->get_result()->fetch_assoc()['id'];
$stmt->close();

// Calculate total
$total=0;
foreach($_SESSION['cart'] as $pid=>$qty){
    $res=$conn->query("SELECT price FROM products WHERE id=$pid");
    $price=$res->fetch_assoc()['price'];
    $total+=$price*$qty;
}

// Insert order
$stmt=$conn->prepare("INSERT INTO orders (user_id,total_price,order_date) VALUES (?,?,NOW())");
$stmt->bind_param("id",$user_id,$total);
$stmt->execute();
$order_id=$stmt->insert_id;
$stmt->close();

// Insert items
foreach($_SESSION['cart'] as $pid=>$qty){
    $res=$conn->query("SELECT price FROM products WHERE id=$pid");
    $price=$res->fetch_assoc()['price'];
    $stmt=$conn->prepare("INSERT INTO order_items (order_id,product_id,quantity,price) VALUES (?,?,?,?)");
    $stmt->bind_param("iiid",$order_id,$pid,$qty,$price);
    $stmt->execute();
    $stmt->close();
}

unset($_SESSION['cart']);
echo "Order placed! <a href='my_orders.php'>View My Orders</a>";
?>