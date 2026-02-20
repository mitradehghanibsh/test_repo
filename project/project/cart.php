<?php
include "db.php";
session_start();

// 处理 AJAX 请求添加商品
if(isset($_POST['add_to_cart'])) {
    $id = intval($_POST['product_id']);
    if(!isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id] = 1;
    } else {
        $_SESSION['cart'][$id]++;
    }
    echo json_encode(['status'=>'ok','total'=>array_sum($_SESSION['cart'])]);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Collections | Nordic Essence</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<nav>
    <div class="container">
        <a href="index.php" class="logo">NORDIC ESSENCE</a>
        <ul class="nav-links">
            <li><a href="products.php">Collections</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="cart.php">Cart (<span id="cart-count"><?php echo array_sum($_SESSION['cart']??[]); ?></span>)</a></li>
        </ul>
    </div>
</nav>

<h1 style="text-align:center; margin-top:40px;">Our Collection</h1>

<div class="products-container" style="display:flex; flex-wrap:wrap; justify-content:center; gap:40px; margin:40px;">
<?php
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()) {
        ?>
        <div class="product-card" style="width:300px; text-align:center;">
            <img src="images/<?php echo $row['image']; ?>" style="width:100%; height:250px; object-fit:cover;">
            <h3><?php echo $row['name']; ?></h3>
            <p><?php echo $row['description']; ?></p>
            <p><strong>€<?php echo $row['price']; ?></strong></p>
            <button class="btn add-to-cart" data-id="<?php echo $row['id']; ?>">Add to Cart</button>
        </div>
        <?php
    }
} else {
    echo "<p style='text-align:center;'>No products found.</p>";
}
?>
</div>

<script>
// 给所有 Add to Cart 按钮绑定事件
document.querySelectorAll('.add-to-cart').forEach(btn=>{
    btn.addEventListener('click', ()=>{
        const productId = btn.dataset.id;

        fetch('products.php', {
            method:'POST',
            headers:{'Content-Type':'application/x-www-form-urlencoded'},
            body:'add_to_cart=1&product_id='+productId
        })
        .then(res=>res.json())
        .then(data=>{
            if(data.status==='ok'){
                document.getElementById('cart-count').textContent = data.total;
               
            }
        });
    });
});
</script>

</body>
</html>

