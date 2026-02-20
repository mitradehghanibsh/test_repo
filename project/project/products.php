<?php
include "db.php";
session_start();

// AJAX 添加商品
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
<style>
.cart-sidebar {
    position: fixed;
    top:0; right:-350px;
    width:350px; height:100%;
    background:#f9f9f9;
    box-shadow:-3px 0 10px rgba(0,0,0,0.3);
    padding:20px; overflow-y:auto;
    transition:right 0.3s ease;
    z-index:1000;
}
.cart-sidebar.open{ right:0; }
.cart-header{ display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; }
.cart-item{ display:flex; justify-content:space-between; margin-bottom:15px; align-items:center; }
.cart-item img{ width:50px; height:50px; object-fit:cover; margin-right:10px; }
.btn-close{ cursor:pointer; padding:5px 10px; background:#333; color:#fff; border:none; border-radius:5px; }
.cart-total{ font-weight:bold; margin-top:20px; text-align:right; font-size:18px; }
.quantity-btn{ padding:2px 6px; margin:0 3px; cursor:pointer; background:#333; color:#fff; border:none; border-radius:3px; }
</style>
</head>
<body>

<nav>
    <div class="container">
        <a href="index.php" class="logo">NORDIC ESSENCE</a>
        <ul class="nav-links">
            <li><a href="products.php">Collections</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="#" onclick="toggleCart()">Cart (<span id="cart-count"><?php echo array_sum($_SESSION['cart']??[]); ?></span>)</a></li>
        </ul>
    </div>
</nav>
<div style="height:80px;"></div>
<div class="products-container" style="display:flex; flex-wrap:wrap; justify-content:center; gap:40px; margin:40px;">

<?php
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
if($result->num_rows>0){
    while($row=$result->fetch_assoc()){
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
}else{
    echo "<p style='text-align:center;'>No products found.</p>";
}
?>
</div>

<!-- 购物车侧边栏 -->
<div id="cartSidebar" class="cart-sidebar">
    <div class="cart-header">
        <h2>Shopping Cart</h2>
        <button class="btn-close" onclick="toggleCart()">Close</button>
    </div>
    <div id="cart-items"></div>
    <div class="cart-total" id="cart-total"></div>
</div>

<script>
const cartSidebar = document.getElementById('cartSidebar');
const cartItemsDiv = document.getElementById('cart-items');
const cartTotalDiv = document.getElementById('cart-total');

function toggleCart(){
    cartSidebar.classList.toggle('open');
    if(cartSidebar.classList.contains('open')) loadCart();
}

// 添加商品
document.querySelectorAll('.add-to-cart').forEach(btn=>{
    btn.addEventListener('click', ()=>{
        fetch('products.php',{
            method:'POST',
            headers:{'Content-Type':'application/x-www-form-urlencoded'},
            body:'add_to_cart=1&product_id='+btn.dataset.id
        }).then(res=>res.json())
          .then(data=>document.getElementById('cart-count').textContent=data.total);
    });
});

// 加载购物车内容
function loadCart(){
    let form = new FormData();
    form.append('action','load');
    fetch('cart_handler.php',{method:'POST', body:form})
        .then(res=>res.json())
        .then(updateCartUI);
}

// 更新购物车界面
function updateCartUI(data){
    cartItemsDiv.innerHTML='';
    data.items.forEach(item=>{
        const div = document.createElement('div');
        div.className='cart-item';
        div.innerHTML = `
            <img src="images/${item.image}">
            <div style="flex:1;">
                <div>${item.name}</div>
                <div>€${item.price} x ${item.quantity}</div>
            </div>
            <div>
                <button class="quantity-btn" onclick="changeQty(${item.id},'add')">+</button>
                <button class="quantity-btn" onclick="changeQty(${item.id},'subtract')">-</button>
                <button class="quantity-btn" onclick="changeQty(${item.id},'remove')">×</button>
            </div>
        `;
        cartItemsDiv.appendChild(div);
    });
    cartTotalDiv.textContent = 'Total: €'+data.total.toFixed(2);
    document.getElementById('cart-count').textContent = data.items.reduce((acc,i)=>acc+i.quantity,0);
}

// 改变数量或删除
function changeQty(id, action){
    let form = new FormData();
    form.append('action', action);
    form.append('product_id', id);
    fetch('cart_handler.php',{method:'POST', body:form})
        .then(res=>res.json())
        .then(updateCartUI);
}
</script>

</body>
</html>
