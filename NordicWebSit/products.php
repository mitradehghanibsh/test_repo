<?php
session_start();
include 'db.php';

// AJAX add to cart
if(isset($_POST['add_to_cart'])){
    $id = intval($_POST['product_id']);
    if(!isset($_SESSION['cart'][$id])) $_SESSION['cart'][$id]=1;
    else $_SESSION['cart'][$id]++;
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
    <a href="index.php">Home</a> |
    <a href="#" onclick="toggleCart()">Cart (<span id="cart-count"><?php echo array_sum($_SESSION['cart']??[]); ?></span>)</a> |
    <a href="#" onclick="toggleOrders()">My Orders</a>
</nav>

<h1>Our Products</h1>
<div style="display:flex; flex-wrap:wrap; gap:20px;">
<?php
$result = $conn->query("SELECT * FROM products");
while($row = $result->fetch_assoc()){
    echo "<div style='border:1px solid #ccc;padding:10px;width:200px;text-align:center;'>
        <img src='images/{$row['image']}' style='width:100%;height:150px;object-fit:cover;'>
        <h3>{$row['name']}</h3>
        <p>€{$row['price']}</p>
        <button onclick='addToCart({$row['id']})'>Add to Cart</button>
    </div>";
}
?>
</div>

<!-- Cart Sidebar -->
<div id="cartSidebar" class="sidebar right-sidebar">
    <div class="sidebar-header">
        <h2>🛒 Shopping Cart</h2>
        <button class="close-btn" onclick="toggleCart()">×</button>
    </div>

    <div class="sidebar-content">
        <div id="cartItems"></div>
        <div id="cartTotal"></div>
    </div>

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
    fetch('products.php',{method:'POST', headers:{'Content-Type':'application/x-www-form-urlencoded'}, body:'add_to_cart=1&product_id='+id})
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
        let html='',total=0;
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