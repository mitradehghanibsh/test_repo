<?php
session_start();
include 'db.php';

// Remove
if(isset($_GET['remove'])){
    $id=intval($_GET['remove']);
    unset($_SESSION['cart'][$id]);
    header("Location: cart.php");
    exit;
}

// Update quantities
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['update'])){
    foreach($_POST['quantity'] as $id=>$qty){
        $id=intval($id);
        $qty=intval($qty);
        if($qty<=0) unset($_SESSION['cart'][$id]);
        else $_SESSION['cart'][$id]=$qty;
    }
    header("Location: cart.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><title>Cart</title></head>
<body>
<h2>Your Cart</h2>
<?php if(empty($_SESSION['cart'])): ?>
<p>Cart is empty. <a href="products.php">Shop Now</a></p>
<?php else: ?>
<form method="post">
<table border="1" cellpadding="5">
<tr><th>Product</th><th>Price</th><th>Qty</th><th>Subtotal</th><th>Action</th></tr>
<?php
$total=0;
foreach($_SESSION['cart'] as $id=>$qty){
    $stmt=$conn->prepare("SELECT * FROM products WHERE id=?");
    $stmt->bind_param("i",$id);
    $stmt->execute();
    $product=$stmt->get_result()->fetch_assoc();
    $subtotal=$product['price']*$qty;
    $total+=$subtotal;
    echo "<tr>
        <td>{$product['name']}</td>
        <td>€{$product['price']}</td>
        <td><input type='number' name='quantity[$id]' value='$qty' min='1'></td>
        <td>€$subtotal</td>
        <td><a href='cart.php?remove=$id'>Remove</a></td>
    </tr>";
    $stmt->close();
}
?>
<tr><td colspan="3" align="right"><strong>Total</strong></td><td colspan="2">€<?php echo $total; ?></td></tr>
</table>
<input type="submit" name="update" value="Update Cart">
<a href="checkout.php">Checkout</a>
</form>
<?php endif; ?>
</body>
</html>