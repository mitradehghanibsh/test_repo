<?php
session_start();
include 'db.php';
if(!isset($_SESSION['email'])) header("Location: login.php");

$stmt=$conn->prepare("SELECT id FROM users WHERE email=?");
$stmt->bind_param("s",$_SESSION['email']);
$stmt->execute();
$user_id=$stmt->get_result()->fetch_assoc()['id'];
$stmt->close();

$orders=$conn->query("SELECT * FROM orders WHERE user_id=$user_id ORDER BY order_date DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><title>My Orders</title></head>
<body>
<h2>My Orders</h2>
<a href="index.php">Home</a><br><br>
<?php if($orders->num_rows==0): ?>
<p>No orders yet.</p>
<?php else: ?>
<?php while($order=$orders->fetch_assoc()): ?>
<div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
Order #<?php echo $order['id']; ?> | Total: €<?php echo $order['total_price']; ?> | <?php echo $order['order_date']; ?><br>
Items:
<ul>
<?php
$items=$conn->query("SELECT oi.quantity,p.name,oi.price FROM order_items oi JOIN products p ON oi.product_id=p.id WHERE oi.order_id={$order['id']}");
while($item=$items->fetch_assoc()){
    echo "<li>{$item['name']} x{$item['quantity']} (€{$item['price']})</li>";
}
?>
</ul>
</div>
<?php endwhile; ?>
<?php endif; ?>
</body>
</html>