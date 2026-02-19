<?php
session_start();
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Designer | Nordic Essence</title>
<link rel="stylesheet" href="style.css">
<style>
/* Designer Page Specific */
.designer-intro {
    text-align: center;
    padding: 50px 20px;
    background: #f5f5f5;
}
.designer-intro h1 {
    font-size: 3rem;
    margin-bottom: 20px;
}
.designer-intro p {
    max-width: 900px;
    margin: 0 auto;
    font-size: 1.2rem;
    line-height: 1.6;
}
.products-grid {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 30px;
    margin: 40px auto;
    max-width: 1400px;
}
.product-card {
    background: #fff;
    width: 220px;
    text-align: center;
    border-radius: 10px;
    padding: 15px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    transition: transform 0.2s;
}
.product-card:hover {
    transform: translateY(-5px);
}
.product-card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 10px;
    margin-bottom: 10px;
}
.product-card h3 {
    font-size: 1.1rem;
    margin-bottom: 10px;
}
.product-card p {
    font-size: 0.9rem;
    margin-bottom: 10px;
}
.product-card button {
    padding: 8px 15px;
    background: #333;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
.product-card button:hover {
    background: #555;
}
@media (max-width: 768px) {
    .products-grid {
        flex-direction: column;
        align-items: center;
    }
    .product-card {
        width: 90%;
    }
}
</style>
</head>
<body>

<!-- Navigation -->
<nav>
    <a href="index.php">Home</a> |
    <a href="products.php">Products</a> |
    <a href="#" onclick="toggleCart()">Cart (<span id="cart-count"><?php echo array_sum($_SESSION['cart'] ?? []); ?></span>)</a> |
    <a href="#" onclick="toggleOrders()">My Orders</a>
</nav>

<!-- Page Intro -->
<section class="designer-intro">
    <h1>Scandinavian & Nordic Design</h1>
    <p>
        Discover the elegance of Nordic design. Renowned for simplicity, functionality, and timeless aesthetics,
        Scandinavian products bring minimalism and craftsmanship into your home. From furniture to glassware,
        textiles, and decor, explore our curated collection of authentic Nordic pieces.
    </p>
</section>

<!-- Full Product Gallery -->
<section class="products-grid">
<?php
$result = $conn->query("SELECT * FROM products ORDER BY id ASC"); // all products
while($row = $result->fetch_assoc()){
    echo "<div class='product-card'>
            <img src='images/{$row['image']}' alt='{$row['name']}'>
            <h3>{$row['name']}</h3>
            <p>{$row['description']}</p>
            <p>€{$row['price']}</p>
            <button onclick='addToCart({$row['id']})'>Add to Cart</button>
        </div>";
}
?>
</section>

<!-- Cart Sidebar -->
<div id="cartSidebar" class="sidebar right-sidebar">
    <div class="sidebar-header">
        <h2>🛒 Shopping Cart</h2>
        <button class="close-btn" onclick="toggleCart()">×</button>
    </div>
    <div class="sidebar-content" id="cartItems"></div>
    <div class="sidebar-footer">
        <button class="primary-btn" onclick="checkout()">Checkout</button>
    </div>
</div>

<!-- Orders Sidebar -->
<div id="ordersSidebar" class="sidebar left-sidebar">
    <div class="sidebar-header">
        <h2>📦 My Orders</h2>
        <button class="close-btn" onclick="toggleOrders()">×</button>
    </div>
    <div class="sidebar-content" id="ordersContent"></div>
</div>

<script>
// Cart logic
function toggleCart(){ 
    const sidebar=document.getElementById('cartSidebar');
    sidebar.style.right = sidebar.style.right==='0px' ? '-400px' : '0px'; 
    if(sidebar.style.right==='0px') loadCart();
}

function addToCart(id){
    fetch('products.php',{
        method:'POST',
        headers:{'Content-Type':'application/x-www-form-urlencoded'},
        body:'add_to_cart=1&product_id='+id
    })
    .then(res=>res.json())
    .then(data=>{
        document.getElementById('cart-count').textContent=data.total;
        loadCart();
    });
}

function loadCart(){
    fetch('cart_ajax.php')
    .then(res=>res.json())
    .then(data=>{
        let html='', total=0;
        data.items.forEach(item=>{
            let subtotal=item.price*item.quantity;
            total+=subtotal;
            html+=`<div>${item.name} x ${item.quantity} = €${subtotal}</div>`;
        });
        document.getElementById('cartItems').innerHTML=html;
        document.getElementById('cartTotal').innerText='Total: €'+total;
    });
}

function checkout(){
    fetch('checkout.php')
    .then(res=>res.text())
    .then(msg=>{
        alert(msg);
        loadCart();
        loadOrders();
    });
}

// Orders logic
function toggleOrders(){
    const sidebar=document.getElementById('ordersSidebar');
    sidebar.style.left = sidebar.style.left==='0px' ? '-400px' : '0px';
    if(sidebar.style.left==='0px') loadOrders();
}

function loadOrders(){
    fetch('fetch_orders.php')
    .then(res=>res.text())
    .then(html=>{
        document.getElementById('ordersContent').innerHTML=html;
    });
}
</script>
<script src="script.js"></script>
</body>
</html>
