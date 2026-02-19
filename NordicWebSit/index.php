<?php
session_start();
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Nordic Essence | Timeless Finnish Design</title>
<link rel="stylesheet" href="style.css">
<style>
/* My Orders Sidebar */
#ordersSidebar {
    position: fixed;
    top: 0;
    right: -400px;
    width: 400px;
    height: 100%;
    background: #f9f9f9;
    box-shadow: -3px 0 10px rgba(0,0,0,0.3);
    padding: 20px;
    overflow-y: auto;
    transition: right 0.3s ease;
    z-index: 1000;
}
#ordersSidebar.open { right: 0; }
.orders-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
.order-item { border-bottom: 1px solid #ccc; padding: 10px 0; }
.order-total { font-weight: bold; text-align: right; margin-top: 10px; }
.btn-close { cursor: pointer; padding:5px 10px; background:#333; color:#fff; border:none; border-radius:5px; }
</style>
</head>
<body>

<nav>
    <div class="container">
        <a href="index.php" class="logo">NORDIC ESSENCE</a>
        <ul class="nav-links">
            <li><a href="products.php">Collections</a></li>
            <li><a href="designer.php">Designers</a></li>
            

            <?php if(isset($_SESSION['user'])): ?>
                <li><a href="#" onclick="toggleOrders()">My Orders</a></li>
                <li style="color:#333;">Welcome, <?php echo $_SESSION['user']; ?></li>
                <li><a href="logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="login.php">Login</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>

<!-- Orders Sidebar -->
<div id="ordersSidebar">
    <div class="orders-header">
        <h2>My Orders</h2>
        <button class="btn-close" onclick="toggleOrders()">Close</button>
    </div>
    <div id="ordersContent">
        <?php
        if(isset($_SESSION['email'])){
            $user_email = $_SESSION['email'];
            $stmt = $conn->prepare("SELECT id FROM users WHERE email=?");
            $stmt->bind_param("s", $user_email);
            $stmt->execute();
            $user_id = $stmt->get_result()->fetch_assoc()['id'];
            $stmt->close();

            // Get all orders
            $orders_res = $conn->query("SELECT * FROM orders WHERE user_id=$user_id ORDER BY order_date DESC");
            if($orders_res->num_rows > 0){
                while($order = $orders_res->fetch_assoc()){
                    echo "<div class='order-item'>";
                    echo "<div><strong>Order #{$order['id']}</strong> - {$order['order_date']}</div>";

                    // Get order items
                    $items_res = $conn->query("SELECT oi.quantity, oi.price, p.name FROM order_items oi JOIN products p ON oi.product_id=p.id WHERE oi.order_id={$order['id']}");
                    $order_total = 0;
                    while($item = $items_res->fetch_assoc()){
                        $subtotal = $item['quantity'] * $item['price'];
                        $order_total += $subtotal;
                        echo "<div>{$item['name']} x {$item['quantity']} = €{$subtotal}</div>";
                    }
                    echo "<div class='order-total'>Total: €{$order_total}</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>No orders yet.</p>";
            }
        } else {
            echo "<p>Please log in to see your orders.</p>";
        }
        ?>
    </div>
</div>

<script>
const ordersSidebar = document.getElementById('ordersSidebar');
function toggleOrders(){
    ordersSidebar.classList.toggle('open');
}
</script>
<script>
const ordersSidebar = document.getElementById('ordersSidebar');
const ordersContent = document.getElementById('ordersContent');

function toggleOrders(){
    ordersSidebar.classList.toggle('open');
    if(ordersSidebar.classList.contains('open')){
        loadOrders();
    }
}

// Load orders via AJAX
function loadOrders(){
    fetch('fetch_orders.php')
        .then(res => res.text())
        .then(html => {
            ordersContent.innerHTML = html;
        });
}

// Optional: after checkout, call loadOrders() to refresh sidebar automatically
</script>

<section class="large-section">
    <div class="section-image" style="background-image: url('images/Artek.jpg');"></div>
    <div class="section-content">
        <h1>Humanity in Space</h1>
        <p>Experience the harmony of Artek and modern Finnish living.</p>
        <a href="https://www.artek.fi/fi/" target="_blank" class="btn">Explore Artek</a>

    </div>
</section>

<section class="large-section reverse">
    <div class="section-image" style="background-image: url('images/iitalla.jpg');"></div>
    <div class="section-content">
        <h2>The Glass Light</h2>
        <p>Iittala Collection: Masterpieces of hand-blown brilliance.</p>
        <a href="https://www.iittala.com/fi-fi" target="_blank" class="btn">View Iittala</a>
    </div>
</section>

<section class="large-section">

<div class="section-image" style="background-image: url('images/marimekko.jpg');"></div>
    <div class="section-content">
        <h2>Spring Tableware</h2>
        <p>Bold patterns meet everyday functional design.</p>
        <a href="https://www.marimekko.com/fi_fi" target="_blank" class="btn">Discover Marimekko</a>
    </div>
</section>

<section class="large-section reverse">
    <div class="section-image" style="background-image: url('images/nannystill.jpg');"></div>
    <div class="section-content">
        <h2>Vibrant Sculptures</h2>
        <p>Art glass by Nanny Still: A symphony of color and form.</p>
        <a href="#" class="btn">View Gallery</a>
    </div>
</section>

<footer>
    <p>&copy; 2026 Nordic Essence Studio. Built for Web Programming Course.</p>
</footer>

</body>
</html>