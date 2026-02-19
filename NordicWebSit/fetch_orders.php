<?php
session_start();
include 'db.php';

if(!isset($_SESSION['email'])){
    echo "Please log in to view your orders.";
    exit;
}

// Get user ID
$stmt = $conn->prepare("SELECT id FROM users WHERE email=?");
$stmt->bind_param("s", $_SESSION['email']);
$stmt->execute();
$user_id = $stmt->get_result()->fetch_assoc()['id'];
$stmt->close();

// Fetch orders
$stmt = $conn->prepare("SELECT * FROM orders WHERE user_id=? ORDER BY order_date DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$orders_result = $stmt->get_result();
$stmt->close();

if($orders_result->num_rows == 0){
    echo "<p>You have no orders yet.</p>";
    exit;
}

// Loop through orders
while($order = $orders_result->fetch_assoc()){
    echo "<div style='border-bottom:1px solid #ccc;margin-bottom:15px;padding-bottom:10px;'>";
    echo "<strong>Order #{$order['id']}</strong> - <em>{$order['order_date']}</em><br>";
    echo "Total: €{$order['total_price']}<br>";

    // Fetch order items
    $stmt_items = $conn->prepare("SELECT oi.quantity, oi.price, p.name 
                                  FROM order_items oi 
                                  JOIN products p ON oi.product_id = p.id
                                  WHERE oi.order_id=?");
    $stmt_items->bind_param("i", $order['id']);
    $stmt_items->execute();
    $items_result = $stmt_items->get_result();

    while($item = $items_result->fetch_assoc()){
        echo "- {$item['name']} x {$item['quantity']} = €".($item['price']*$item['quantity'])."<br>";
    }

    $stmt_items->close();
    echo "</div>";
}
?>