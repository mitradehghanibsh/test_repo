<?php include "db.php"; ?>

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
            <li><a href="cart.php">Cart</a></li>
        </ul>
    </div>
</nav>

<h1 style="text-align:center; margin-top:40px;">Our Collection</h1>
<div style="text-align:center; margin-top:20px;">
    <a href="add_product.php" class="btn">Add New Product</a>
</div>

<div class="products-container" style="display:flex; flex-wrap:wrap; justify-content:center; gap:40px; margin:40px;">

<?php
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
?>

    <div class="product-card" style="width:300px; text-align:center;">
        <img src="images/<?php echo $row['image']; ?>" style="width:100%; height:250px; object-fit:cover;">
        <h3><?php echo $row['name']; ?></h3>
        <p><?php echo $row['description']; ?></p>
        <p><strong>€<?php echo $row['price']; ?></strong></p>
        <a href="#" class="btn">Add to Cart</a>
    </div>

<?php
}
?>

</div>

</body>
</html>